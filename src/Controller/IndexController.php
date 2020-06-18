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
        $response = $this->getResponse();
        if (!$this->getRequest()->isXmlHttpRequest()) {
            return $response->setStatusCode('415')
                ->setContent('The request must be a XMLHttpRequest.');
        }

        $type = $this->params()->fromQuery('type');
        if ('' === trim($type)) {
            return $response->setStatusCode('400')
                ->setContent(sprintf('The request must include a data type.', $type));
        }

        try {
            $dataType = $this->dataTypes->get($type);
        } catch (ServiceNotFoundException $e) {
            return $response->setStatusCode('400')
                ->setContent(sprintf('The "%s" data type not found.', $type));
        }
        if (!$dataType instanceof DataTypeInterface) {
            return $response->setStatusCode('500')
                ->setContent(sprintf('The "%s" data type does not implement ValueSuggest\DataType\DataTypeInterface.', $type));
        }

        $suggester = $dataType->getSuggester();
        if (!$suggester instanceof SuggesterInterface) {
            return $response->setStatusCode('500')
                ->setContent(sprintf('The "%s" suggester does not implement ValueSuggest\Suggester\SuggesterInterface.', $type));
        }

        $suggestions = $suggester->getSuggestions(
            $this->params()->fromQuery('query'),
            $this->params()->fromQuery('lang') ?: null
        );
        if (!is_array($suggestions)) {
            return $response->setStatusCode('500')
                ->setContent(sprintf('The "%s" data type must return an array; %s given.', $type, gettype($suggestions)));
        }

        // Set the response format defined by Ajax Autocomplete.
        // @see https://github.com/devbridge/jQuery-Autocomplete#response-format
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        return $response->setContent(json_encode(['suggestions' => $suggestions]));
    }
}
