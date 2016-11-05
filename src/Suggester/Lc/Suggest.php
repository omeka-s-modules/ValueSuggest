<?php
namespace ValueSuggest\Suggester\Lc;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

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
     * @return array
     */
    public function getSuggestions($query)
    {
        $response = $this->client
            ->setUri($this->endpoint)
            ->setParameterGet(['q' => $query])
            ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results[1] as $result) {
            $suggestions[] = $result;
        }

        return $suggestions;
    }
}
