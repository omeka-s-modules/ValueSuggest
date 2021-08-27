<?php
namespace ValueSuggest\Suggester\Dc;

use ValueSuggest\Suggester\SuggesterInterface;

class ElementsSuggestAll implements SuggesterInterface
{
    /**
     * Return Dublin Core elements.
     *
     * @see https://www.dublincore.org/specifications/dublin-core/dcmi-terms/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $suggestions = [
            [
                'value' => 'Contributor',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/contributor',
                    'info' => 'An entity responsible for making contributions to the resource.',
                ],
            ],
            [
                'value' => 'Coverage',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/coverage',
                    'info' => 'The spatial or temporal topic of the resource, spatial applicability of the resource, or jurisdiction under which the resource is relevant.',
                ],
            ],
            [
                'value' => 'Creator',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/creator',
                    'info' => 'An entity primarily responsible for making the resource.',
                ],
            ],
            [
                'value' => 'Date',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/date',
                    'info' => 'A point or period of time associated with an event in the lifecycle of the resource.',
                ],
            ],
            [
                'value' => 'Description',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/description',
                    'info' => 'An account of the resource.',
                ],
            ],
            [
                'value' => 'Format',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/format',
                    'info' => 'The file format, physical medium, or dimensions of the resource.',
                ],
            ],
            [
                'value' => 'Identifier',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/identifier',
                    'info' => 'An unambiguous reference to the resource within a given context.',
                ],
            ],
            [
                'value' => 'Language',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/language',
                    'info' => 'A language of the resource.',
                ],
            ],
            [
                'value' => 'Publisher',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/publisher',
                    'info' => 'An entity responsible for making the resource available.',
                ],
            ],
            [
                'value' => 'Relation',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/relation',
                    'info' => 'A related resource.',
                ],
            ],
            [
                'value' => 'Rights',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/rights',
                    'info' => 'Information about rights held in and over the resource.',
                ],
            ],
            [
                'value' => 'Source',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/source',
                    'info' => 'A related resource from which the described resource is derived.',
                ],
            ],
            [
                'value' => 'Subject',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/subject',
                    'info' => 'The topic of the resource.',
                ],
            ],
            [
                'value' => 'Title',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/title',
                    'info' => 'A name given to the resource.',
                ],
            ],
            [
                'value' => 'Type',
                'data' => [
                    'uri' => 'http://purl.org/dc/elements/1.1/type',
                    'info' => 'The nature or genre of the resource.',
                ],
            ],
        ];
        // Alphabetize by value.
        usort($suggestions, function ($a, $b) {
            return $a['value'] <=> $b['value'];
        });
        return $suggestions;
    }
}
