<?php
namespace ValueSuggest\Suggester;

trait PrimaryLanguageTrait
{
    /**
     * Get the primary subtag of a language tag ("en" for "en-US" or "en_US").
     *
     * Vocabularies tag their labels with bare languages, so a regional tag from
     * the value's language input would otherwise match nothing. Only letters
     * are kept, so the result is safe to put in a query.
     *
     * @param string|null $lang
     * @param string $default Returned when $lang has no primary subtag
     * @return string
     */
    private function getPrimaryLanguage($lang, $default)
    {
        preg_match('/^[a-z]+/', strtolower((string) $lang), $matches);
        return $matches[0] ?? $default;
    }
}
