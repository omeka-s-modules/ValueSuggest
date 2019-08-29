<?php
namespace ValueSuggest\Suggester\Rda;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class RdaSuggestAll implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string The JSON-LD URL.
     */
    protected $url;

    public function __construct(Client $client, $url)
    {
        $this->client = $client;
        $this->url = $url;
    }

    /**
     * Retrieve suggestions from RDA value vocabularies.
     *
     * @see http://www.rdaregistry.info/termList/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        // The RDA Registry may return a 404 Not Found error if the Accept
        // header is not set to "application/json+ld".
        $headers = $this->client->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json+ld');
        $response = $this->client->setUri($this->url)->send();
        if (!$response->isSuccess()) {
            return [];
        }
        $lang = $lang ?: 'en'; // set english as the default language

        // Parse the JSON-LD response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['@graph'] as $result) {
            if ('Concept' !== $result['@type']) {
                continue;
            }
            $value = isset($result['prefLabel'][$lang])
                ? $result['prefLabel'][$lang]
                : $result['prefLabel']['en'];
            $info = isset($result['definition'][$lang])
                ? $result['definition'][$lang]
                : (isset($result['definition']['en']) ? $result['definition']['en'] : null);
            $suggestions[] = [
                'value' => $value,
                'data' => [
                    'uri' => $result['@id'],
                    'info' => $info,
                ],
            ];
        }
        usort($suggestions, function ($a, $b) {
            return strcmp($a['value'], $b['value']);
        });

        return $suggestions;
    }
}
