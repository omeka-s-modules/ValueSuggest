<?php
namespace ValueSuggest\Suggester;

interface SuggesterInterface
{
    /**
     * Get an array of suggestions given a query.
     *
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null);
}
