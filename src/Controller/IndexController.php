<?php
namespace ValueSuggest\Controller;

use Omeka\DataType\Manager as DataTypeManager;
use ValueSuggest\DataType\DataTypeInterface;
use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;

class IndexController extends AbstractActionController
{
    protected $dataTypes;

    public function __construct(DataTypeManager $dataTypes)
    {
        $this->dataTypes = $dataTypes;
    }

    /**
     * Generic proxy for suggest requests.
     *
     * Responsible for accepting an AJAX request, retrieving suggestions from
     * the data type, and formatting the response according to specs.
     */
    public function proxyAction()
    {
        if (!$this->getRequest()->isXmlHttpRequest()) {
            return $this->errorResponse(415, 'The request must be a XMLHttpRequest.');
        }

        $type = $this->params()->fromQuery('type');
        if (!is_string($type) || '' === trim($type)) {
            return $this->errorResponse(400, 'The request must include a data type.');
        }

        try {
            $dataType = $this->dataTypes->get($type);
        } catch (ServiceNotFoundException $e) {
            return $this->errorResponse(400, sprintf('The "%s" data type not found.', $type));
        }
        if (!$dataType instanceof DataTypeInterface) {
            return $this->errorResponse(500, sprintf('The "%s" data type does not implement ValueSuggest\DataType\DataTypeInterface.', $type));
        }

        $suggester = $dataType->getSuggester();
        if (!$suggester instanceof SuggesterInterface) {
            return $this->errorResponse(500, sprintf('The "%s" suggester does not implement ValueSuggest\Suggester\SuggesterInterface.', $type));
        }

        // All query params except for "query" and "type" are considered
        // contextual. Note that although "lang" is contextual, it is passed as
        // a separate argument for legacy reasons.
        $context = $this->params()->fromQuery();
        unset($context['query'], $context['type']);

        try {
            $suggestions = $suggester->getSuggestions(
                $this->params()->fromQuery('query'),
                $this->params()->fromQuery('lang') ?: null,
                $context
            );
        } catch (\Exception $e) {
            // The vocabulary service failed, for example with a timeout. Log it
            // and return no suggestions rather than an error page.
            $this->logger()->warn(sprintf('ValueSuggest: the "%s" suggester failed: %s', $type, $e->getMessage()));
            $suggestions = [];
        }
        if (!is_array($suggestions)) {
            return $this->errorResponse(500, sprintf('The "%s" data type must return an array; %s given.', $type, gettype($suggestions)));
        }

        // Set the response format defined by Ajax Autocomplete.
        // @see https://github.com/devbridge/jQuery-Autocomplete#response-format
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        return $response->setContent(json_encode(['suggestions' => $suggestions]));
    }

    /**
     * Return a plain-text error response.
     *
     * @param int $statusCode
     * @param string $message
     * @return \Laminas\Http\Response
     */
    private function errorResponse($statusCode, $message)
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'text/plain; charset=utf-8');
        return $response->setStatusCode($statusCode)->setContent($message);
    }
}
