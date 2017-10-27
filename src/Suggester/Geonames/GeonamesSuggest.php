<?php
namespace ValueSuggest\Suggester\Geonames;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class GeonamesSuggest implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve suggestions from the Geonames web services API.
     *
     * @see http://www.geonames.org/export/geonames-search.html
     * @param string $query
     * @return array
     */
    public function getSuggestions($query)
    {
        $response = $this->client
            ->setUri('http://api.geonames.org/searchJSON')
            ->setParameterGet(['q' => $query, 'maxRows' => 100, 'username' => 'kdlinfo'])
            ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['geonames'] as $result) {
            $suggestions[] = [
                'value' => $result['name'],
                'data' => [
                    'uri' => sprintf('http://www.geonames.org/%s', $result['geonameId']),
                    'info' => null,
                ],
            ];
        }

        return $suggestions;
    }
}
