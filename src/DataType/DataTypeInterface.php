<?php
namespace ValueSuggest\DataType;

interface DataTypeInterface
{
    /**
     * Get the suggestor needed to retrieve suggestions.
     *
     * @return \ValueSuggest\Suggester\SuggesterInterface
     */
    public function getSuggester();
}
