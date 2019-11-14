<?php

namespace ValueSuggest\Suggester\IdRef;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class IdRefSuggest implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    const IDREF_SUGGEST_URL = 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=0&rows=50&indent=on&fl=id,ppn_z,affcourt_r';

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->client->setUri(self::IDREF_SUGGEST_URL);
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
        if (!isset($this->client)) {
            $this->client = new Client(self::IDREF_SUGGEST_URL);
        }

        $url = self::IDREF_SUGGEST_URL . '&q=all:' . $query;

        $response = $this->client->setUri($url)->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);

        foreach ($results['response']['docs'] as $result) {
            $suggestions[] = [
                'value' => is_array($result['affcourt_r']) ? $result['affcourt_r'][0] : $result['affcourt_r'],
                'data' => [
                    'uri' => 'https://www.idref.fr/' . $result['ppn_z'],
                    'info' => null,
                ],
            ];
        }

        return $suggestions;
    }
}
