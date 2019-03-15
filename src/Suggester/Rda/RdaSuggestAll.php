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
     * @return array
     */
    public function getSuggestions($query)
    {
        $response = $this->client->setUri($this->url)->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON-LD response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['@graph'] as $result) {
            if ('Concept' !== $result['@type']) {
                continue;
            }
            $suggestions[] = [
                'value' => $result['prefLabel']['en'],
                'data' => [
                    'uri' => $result['@id'],
                    'info' => $result['definition']['en'],
                ],
            ];
        }

        return $suggestions;
    }
}
