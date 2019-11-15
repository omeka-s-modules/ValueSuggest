<?php

namespace ValueSuggest\Suggester\IdRef;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class IdRefSuggestAll implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $url;

    public function __construct(Client $client, $url)
    {
        $this->client = $client;
        $this->url = $url;
    }

    /**
     * Retrieve suggestions from the IdRef web services API (based on Solr).
     *
     * @see https://www.idref.fr
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        // Convert the query into a Solr query.
        $query = str_replace('  ', ' ', trim($query));
        if (strpos($query, ' ')) {
            $query = '(' . implode(' AND ', explode(' ', $query)) . ')';
        }

        $url = $this->url . $query;

        $response = $this->client->setUri($url)->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);

        if (empty($results['response']['docs'])) {
            return [];
        }

        // Check "forme privilégiée".
        $keyValue = isset($results['response']['docs'][0]['affcourt_r'])
            ? 'affcourt_r'
            : 'affcourt_z';
        foreach ($results['response']['docs'] as $result) {
            $suggestions[] = [
                'value' => is_array($result[$keyValue]) ? $result[$keyValue][0] : $result[$keyValue],
                'data' => [
                    'uri' => 'https://www.idref.fr/' . $result['ppn_z'],
                    'info' => null,
                ],
            ];
        }

        return $suggestions;
    }
}
