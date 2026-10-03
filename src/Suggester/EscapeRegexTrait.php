<?php
namespace ValueSuggest\Suggester;

trait EscapeRegexTrait
{
    /**
     * Escape a string for use as a literal in a SPARQL regex() pattern.
     *
     * Escapes regular expression metacharacters with a backslash, so a query
     * like "Painting (" matches literally instead of breaking the pattern.
     * Pass the result through addslashes() before putting it in a SPARQL
     * string literal.
     *
     * @param string $string
     * @return string
     */
    private function escapeRegex($string)
    {
        return preg_replace('/[.\\\\+*?\[\]^$(){}|]/', '\\\\$0', (string) $string);
    }
}
