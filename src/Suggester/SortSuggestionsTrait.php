<?php
namespace ValueSuggest\Suggester;

trait SortSuggestionsTrait
{
    /**
     * Sort suggestions alphabetically by value.
     *
     * @param array $suggestions
     * @return array
     */
    protected function sortSuggestions(array $suggestions)
    {
        $keys = [];
        foreach ($suggestions as $index => $suggestion) {
            $keys[$index] = $this->getSortKey($suggestion['value']);
        }
        asort($keys, SORT_STRING);
        $sorted = [];
        foreach (array_keys($keys) as $index) {
            $sorted[] = $suggestions[$index];
        }
        return $sorted;
    }

    /**
     * Get a key that sorts a label alphabetically when compared byte by byte.
     *
     * Uses the intl extension's collator when available, so accented letters
     * sort with their base letters ("Ética" before "Zoología"). Otherwise
     * lowercases the label and strips its accents.
     *
     * @param string $label
     * @return string
     */
    protected function getSortKey($label)
    {
        static $collator;
        if (null === $collator) {
            $collator = class_exists('Collator') ? new \Collator('root') : false;
        }
        if ($collator) {
            return (string) $collator->getSortKey((string) $label);
        }
        $label = mb_strtolower((string) $label);
        if (class_exists('Normalizer')) {
            $label = preg_replace('/\p{Mn}/u', '', (string) \Normalizer::normalize($label, \Normalizer::FORM_D));
        }
        return (string) $label;
    }
}
