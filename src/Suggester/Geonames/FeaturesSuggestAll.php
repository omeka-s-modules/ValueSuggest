<?php
namespace ValueSuggest\Suggester\Geonames;

use ValueSuggest\Suggester\SuggesterInterface;

class FeaturesSuggestAll implements SuggesterInterface
{
    public function getSuggestions($query, $lang = null)
    {
        // Load the feature codes TSV file into an array.
        $features = array_map(
            fn ($line) => str_getcsv($line, "\t"),
            file(__DIR__ . '/featureCodes_en.txt')
        );
        // Sort the array alphabetically by value.
        usort($features, function ($a, $b) {
            return strcasecmp($a[1], $b[1]);
        });
        // Build the suggestions array.
        $suggestions = [];
        foreach ($features as $feature) {
            $suggestions[] = [
                'value' => $feature[1],
                'data' => [
                    'uri' => null,
                    'info' => $feature[2],
                ],
            ];
        }
        return $suggestions;
    }
}
