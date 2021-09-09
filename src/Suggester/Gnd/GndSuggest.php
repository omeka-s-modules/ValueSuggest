<?php
namespace ValueSuggest\Suggester\Gnd;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class GndSuggest implements SuggesterInterface
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
     * Retrieve suggestions from the lobid-gnd API.
     *
     * @see http://lobid.org/gnd/api
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $params = ['q' => $query, 'format' => 'json', 'size' => 100];
        $response = $this->client
            ->setUri('http://lobid.org/gnd/search')
            ->setParameterGet($params)
            ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['member'] as $result) {
            $info = [];
            // type
            if (isset($result['type'])) {
                $types = array_diff($result['type'], ['AuthorityResource']); // remove AuthorityResource
                $info[] = implode('; ', $types);
            }
            // professionOrOccupation
            if (isset($result['professionOrOccupation'])) {
                $info[] = $result['professionOrOccupation'][0]['label'];
            }
            // biographicalOrHistoricalInformation
            if (isset($result['biographicalOrHistoricalInformation'])) {
                $info[] = $result['biographicalOrHistoricalInformation'][0];
            }
            // dateOfBirth & dateOfDeath
            if (isset($result['dateOfBirth'])) {
                $info[] = sprintf('%s–%s', $result['dateOfBirth'][0], $result['dateOfDeath'][0] ?? null);
            }
            $suggestions[] = [
                'value' => $result['preferredName'],
                'data' => [
                    'uri' => $result['id'],
                    'info' => implode("\n", $info),
                ],
            ];
        }

        return $suggestions;
    }
}
