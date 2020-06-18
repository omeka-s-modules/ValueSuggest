<?php
namespace ValueSuggest\Suggester\Geonames;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

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
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $params = ['q' => $query, 'maxRows' => 100, 'username' => 'kdlinfo'];
        if ($lang) {
            // Geonames requires an ISO-639 2-letter language code. Remove the
            // first underscore and anything after it ("zh_CN" becomes "zh").
            $params['lang'] = strstr($lang, '_', true) ?: $lang;
        }
        $response = $this->client
        ->setUri('http://api.geonames.org/searchJSON')
        ->setParameterGet($params)
        ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['geonames'] as $result) {
            $info = [];
            if (isset($result['fcodeName']) && $result['fcodeName']) {
                $info[] = sprintf('Feature: %s', $result['fcodeName']);
            }
            if (isset($result['countryName']) && $result['countryName']) {
                $info[] = sprintf('Country: %s', $result['countryName']);
            }
            if (isset($result['adminName1']) && $result['adminName1']) {
                $info[] = sprintf('Admin name: %s', $result['adminName1']);
            }
            if (isset($result['population']) && $result['population']) {
                $info[] = sprintf('Population: %s', number_format($result['population']));
            }
            $suggestions[] = [
                'value' => $result['name'],
                'data' => [
                    'uri' => sprintf('http://www.geonames.org/%s', $result['geonameId']),
                    'info' => implode("\n", $info),
                ],
            ];
        }

        return $suggestions;
    }
}
