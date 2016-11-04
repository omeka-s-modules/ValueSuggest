<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;

abstract class AbstractLcDataType extends AbstractDataType
{
    const ENDPOINT = 'http://id.loc.gov/search/';

    /**
     * Get the scheme portion of the search query.
     *
     * @return string
     */
    abstract function getScheme();

    /**
     * Retrieve suggestions from the LC Linked Data Service search.
     *
     * LC provides suggest endpoints for their authorities and vocabularies
     * (e.g. http://id.loc.gov/authorities/subjects/suggest?q=foo) but
     * the service is undocumented and only returns the first 10 results in
     * alphabetical order. The search service we use here is slower but returns
     * better (fulltext) and more (20) results than the suggest service.
     *
     * @see http://id.loc.gov/search/
     * @param string $query
     * @return array
     */
    public function getSuggestions($query)
    {
        // Must build the URL by hand because the client and http_build_query()
        // overwrite identical query keys. Note the use of two "q" keys.
        $uri = sprintf(
            '%s?format=json&q=%s&q=%s',
            self::ENDPOINT,
            urlencode($query),
            urlencode($this->getScheme())
        );

        $client = $this->services->get('Omeka\HttpClient')->setUri($uri);
        $response = $client->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the Atom-formatted JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results as $result) {
            if (isset($result[0]) && 'atom:entry' === $result[0]) {
                $suggestions[] = $result[2][2];
            }
        }

        return $suggestions;
    }
}
