<?php
namespace ValueSuggest\Suggester\Lc;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class Search implements SuggesterInterface
{
    const ENDPOINT = 'http://id.loc.gov/search/';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string The scheme portion of the search query.
     */
    protected $scheme;

    public function __construct(Client $client, $scheme)
    {
        $this->client = $client;
        $this->scheme = $scheme;
    }

    /**
     * Retrieve suggestions from the LC Linked Data Service search.
     *
     * The search service is slow, but it's ideal for large data sets because it
     * returns more (20) and better (fulltext) results than the suggest service.
     *
     * @see http://id.loc.gov/search/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        // Must build the URL by hand because the client and http_build_query()
        // overwrite identical query keys. Note the use of two "q" keys.
        $uri = sprintf(
            '%s?format=json&q=%s&q=%s',
            self::ENDPOINT,
            urlencode($query),
            urlencode($this->scheme)
        );

        $response = $this->client->setUri($uri)->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the Atom-formatted JSON response. LC does not provide
        // disambiguating information.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        if (null === $results) {
            // The response may be invalid JSON; json_decode() returns NULL.
            return [];
        }
        foreach ($results as $result) {
            if (isset($result[0]) && 'atom:entry' === $result[0]) {
                $suggestions[] = [
                    'value' => $result[2][2],
                    'data' => [
                        'uri' => $result[3][1]['href'],
                        'info' => null,
                    ],
                ];
            }
        }

        return $suggestions;
    }
}
