<?php
namespace ValueSuggest\Suggester;

interface SuggesterInterface
{
    /**
     * Get an array of suggestions given a query.
     *
     * Implementations must return an array in the following format:
     *
     * [
     *   [
     *     'value' => <value>,
     *     'data' => [
     *       'uri' => <uri>,
     *       'info' => <info>,
     *     ],
     *   ],
     *   <...>
     * ]
     *
     * <value>: (string) the suggestion text, preferably in the passed language
     * <uri>: (string|null) the suggestion's canonical URI
     * <info>: (string|null) any disambiguating text, preferably in the passed language
     *
     * @param string $query The query
     * @param string $lang The language code
     * @return array
     */
    public function getSuggestions($query, $lang = null);
}
