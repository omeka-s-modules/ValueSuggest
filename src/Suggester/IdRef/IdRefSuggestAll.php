<?php

namespace ValueSuggest\Suggester\IdRef;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

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
        $query = trim($query);
        if (strpos($query, ' ')) {
            $query = '(' . implode('%20AND%20', array_map('urlencode', explode(' ', $query))) . ')';
        } else {
            $query = urlencode($query);
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

        // Check the result key.
        foreach ($results['response']['docs'] as $result) {
            if (empty($result['ppn_z'])) {
                continue;
            }
            // "affcourt" may be not present in some results (empty words).
            if (isset($result['affcourt_r'])) {
                $value = is_array($result['affcourt_r']) ? reset($result['affcourt_r']) : $result['affcourt_r'];
            } elseif (isset($result['affcourt_z'])) {
                $value = is_array($result['affcourt_z']) ? reset($result['affcourt_z']) : $result['affcourt_z'];
            } else {
                $value = $result['ppn_z'];
            }
            $suggestions[] = [
                'value' => $value,
                'data' => [
                    'uri' => 'https://www.idref.fr/' . $result['ppn_z'],
                    'info' => null,
                ],
            ];
        }

        return $suggestions;
    }
}
