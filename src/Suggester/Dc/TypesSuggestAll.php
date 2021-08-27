<?php
namespace ValueSuggest\Suggester\Dc;

use ValueSuggest\Suggester\SuggesterInterface;

class TypesSuggestAll implements SuggesterInterface
{
    /**
     * Return Dublin Core types.
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
                'value' => 'Collection',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/Collection',
                    'info' => 'An aggregation of resources.',
                ],
            ],
            [
                'value' => 'Dataset',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/Dataset',
                    'info' => 'Data encoded in a defined structure.',
                ],
            ],
            [
                'value' => 'Event',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/Event',
                    'info' => 'A non-persistent, time-based occurrence.',
                ],
            ],
            [
                'value' => 'Image',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/Image',
                    'info' => 'A visual representation other than text.',
                ],
            ],
            [
                'value' => 'Interactive Resource',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/InteractiveResource',
                    'info' => 'A resource requiring interaction from the user to be understood, executed, or experienced.',
                ],
            ],
            [
                'value' => 'Moving Image',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/MovingImage',
                    'info' => 'A series of visual representations imparting an impression of motion when shown in succession.',
                ],
            ],
            [
                'value' => 'Physical Object',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/PhysicalObject',
                    'info' => 'An inanimate, three-dimensional object or substance.',
                ],
            ],
            [
                'value' => 'Service',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/Service',
                    'info' => 'A system that provides one or more functions.',
                ],
            ],
            [
                'value' => 'Software',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/Software',
                    'info' => 'A computer program in source or compiled form.',
                ],
            ],
            [
                'value' => 'Sound',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/Sound',
                    'info' => 'A resource primarily intended to be heard.',
                ],
            ],
            [
                'value' => 'Still Image',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/StillImage',
                    'info' => 'A static visual representation.',
                ],
            ],
            [
                'value' => 'Text',
                'data' => [
                    'uri' => 'http://purl.org/dc/dcmitype/Text',
                    'info' => 'A resource consisting primarily of words for reading.',
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
