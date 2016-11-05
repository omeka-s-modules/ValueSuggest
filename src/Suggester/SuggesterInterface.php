<?php
namespace ValueSuggest\Suggester;

interface SuggesterInterface
{
    /**
     * Get an array of suggestions given a query.
     *
     * @param string $query
     * @return array
     */
    public function getSuggestions($query);
}
