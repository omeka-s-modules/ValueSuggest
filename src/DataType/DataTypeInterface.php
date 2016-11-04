<?php
namespace ValueSuggest\DataType;

interface DataTypeInterface
{
    /**
     * Get an array of suggestions given a query.
     *
     * @param string $query
     * @return array
     */
    public function getSuggestions($query);
}
