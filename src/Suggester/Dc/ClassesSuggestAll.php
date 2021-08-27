<?php
namespace ValueSuggest\Suggester\Dc;

use ValueSuggest\Suggester\SuggesterInterface;

class ClassesSuggestAll implements SuggesterInterface
{
    /**
     * Return Dublin Core classes.
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
                'value' => 'Agent',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/Agent',
                    'info' => 'A resource that acts or has the power to act.',
                ],
            ],
            [
                'value' => 'Agent Class',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/AgentClass',
                    'info' => 'A group of agents.',
                ],
            ],
            [
                'value' => 'Bibliographic Resource',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/BibliographicResource',
                    'info' => 'A book, article, or other documentary resource.',
                ],
            ],
            [
                'value' => 'File Format',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/FileFormat',
                    'info' => 'A digital resource format.',
                ],
            ],
            [
                'value' => 'Frequency',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/Frequency',
                    'info' => 'A rate at which something recurs.',
                ],
            ],
            [
                'value' => 'Jurisdiction',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/Jurisdiction',
                    'info' => 'The extent or range of judicial, law enforcement, or other authority.',
                ],
            ],
            [
                'value' => 'License Document',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/LicenseDocument',
                    'info' => 'A legal document giving official permission to do something with a resource.',
                ],
            ],
            [
                'value' => 'Linguistic System',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/LinguisticSystem',
                    'info' => 'A system of signs, symbols, sounds, gestures, or rules used in communication.',
                ],
            ],
            [
                'value' => 'Location',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/Location',
                    'info' => 'A spatial region or named place.',
                ],
            ],
            [
                'value' => 'Location, Period, or Jurisdiction',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/LocationPeriodOrJurisdiction',
                    'info' => 'A location, period of time, or jurisdiction.',
                ],
            ],
            [
                'value' => 'Media Type',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/MediaType',
                    'info' => 'A file format or physical medium.',
                ],
            ],
            [
                'value' => 'Media Type or Extent',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/MediaTypeOrExtent',
                    'info' => 'A media type or extent.',
                ],
            ],
            [
                'value' => 'Method of Accrual',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/MethodOfAccrual',
                    'info' => 'A method by which resources are added to a collection.',
                ],
            ],
            [
                'value' => 'Method of Instruction',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/MethodOfInstruction',
                    'info' => 'A process that is used to engender knowledge, attitudes, and skills.',
                ],
            ],
            [
                'value' => 'Period of Time',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/PeriodOfTime',
                    'info' => 'An interval of time that is named or defined by its start and end dates.',
                ],
            ],
            [
                'value' => 'Physical Medium',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/PhysicalMedium',
                    'info' => 'A physical material or carrier.',
                ],
            ],
            [
                'value' => 'Physical Resource',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/PhysicalResource',
                    'info' => 'A material thing.',
                ],
            ],
            [
                'value' => 'Policy',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/Policy',
                    'info' => 'A plan or course of action by an authority, intended to influence and determine decisions, actions, and other matters.',
                ],
            ],
            [
                'value' => 'Provenance Statement',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/ProvenanceStatement',
                    'info' => 'Any changes in ownership and custody of a resource since its creation that are significant for its authenticity, integrity, and interpretation.',
                ],
            ],
            [
                'value' => 'Rights Statement',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/RightsStatement',
                    'info' => 'A statement about the intellectual property rights (IPR) held in or over a resource, a legal document giving official permission to do something with a resource, or a statement about access rights.',
                ],
            ],
            [
                'value' => 'Size or Duration',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/SizeOrDuration',
                    'info' => 'A dimension or extent, or a time taken to play or execute.',
                ],
            ],
            [
                'value' => 'Standard',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/Standard',
                    'info' => 'A reference point against which other things can be evaluated or compared.',
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
