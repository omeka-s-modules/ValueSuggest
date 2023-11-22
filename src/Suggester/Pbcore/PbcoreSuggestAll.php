<?php
namespace ValueSuggest\Suggester\Pbcore;

use ValueSuggest\Suggester\SuggesterInterface;

class PbcoreSuggestAll implements SuggesterInterface
{
    /**
     * @var string The CSV filename.
     */
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Retrieve suggestions from PBCore controlled vocabularies.
     *
     * @see https://pbcore.org/pbcore-controlled-vocabularies
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        // Vocabularies converted from a PBCore-provided XLSX to JSON using a
        // third-party service. The XLSXs must be edited to correct the URIs.
        $terms = json_decode(file_get_contents(sprintf('%s/%s', __DIR__, $this->filename)), true);
        // Build the suggestions array.
        $suggestions = [];
        foreach ($terms as $term) {
            $suggestions[] = [
                'value' => $term['Term'],
                'data' => [
                    'uri' => $term['URI'],
                    'info' => $term['Definition'],
                ],
            ];
        }
        return $suggestions;
    }
}
