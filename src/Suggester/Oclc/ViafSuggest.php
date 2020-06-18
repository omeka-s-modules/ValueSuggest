<?php
namespace ValueSuggest\Suggester\Oclc;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class ViafSuggest implements SuggesterInterface
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
     * Retrieve suggestions from the VIAF auto suggest service.
     *
     * @see https://platform.worldcat.org/api-explorer/apis/VIAF
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $response = $this->client
            ->setUri('http://www.viaf.org/viaf/AutoSuggest')
            ->setParameterGet(['query' => $query])
            ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['result'] as $result) {
            $suggestions[] = [
                'value' => $result['term'],
                'data' => [
                    'uri' => sprintf('http://www.viaf.org/viaf/%s', $result['viafid']),
                    'info' => null,
                ],
            ];
        }

        return $suggestions;
    }
}
