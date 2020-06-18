<?php
namespace ValueSuggest\Suggester\Lc;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class Suggest implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string The endpoint of the suggest query.
     */
    protected $endpoint;

    public function __construct(Client $client, $endpoint)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    /**
     * Retrieve suggestions from the LC Linked Data Service suggest.
     *
     * The suggest endpoints are undocumented and only return the first ten
     * results in alphabetical order, so they are only useful for very small
     * data sets.
     *
     * @see http://id.loc.gov/search/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $response = $this->client
            ->setUri($this->endpoint)
            ->setParameterGet(['q' => $query])
            ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response. LC does not provide disambiguating
        // information.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results[1] as $key => $result) {
            $suggestions[] = [
                'value' => $result,
                'data' => [
                    'uri' => $results[3][$key],
                    'info' => null,
                ],
            ];
        }

        return $suggestions;
    }
}
