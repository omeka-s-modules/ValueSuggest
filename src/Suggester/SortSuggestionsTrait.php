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
        usort($suggestions, function ($a, $b) {
            return $this->compareLabels($a['value'], $b['value']);
        });
        return $suggestions;
    }

    /**
     * Compare two labels alphabetically.
     *
     * Uses the intl extension's collator when available, so accented letters
     * sort with their base letters ("Ética" before "Zoología"). Otherwise
     * compares case-insensitively.
     *
     * @param string $a
     * @param string $b
     * @return int
     */
    protected function compareLabels($a, $b)
    {
        static $collator;
        if (null === $collator) {
            $collator = class_exists('Collator') ? new \Collator('root') : false;
        }
        return $collator
            ? $collator->compare($a, $b)
            : strcmp(mb_strtolower($a), mb_strtolower($b));
    }
}
