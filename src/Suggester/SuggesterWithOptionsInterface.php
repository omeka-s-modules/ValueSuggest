<?php
namespace ValueSuggest\Suggester;

interface SuggesterWithOptionsInterface extends SuggesterInterface
{
    public function getSuggestions($query, $lang = null, array $options = []);
}
