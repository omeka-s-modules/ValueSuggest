<?php
namespace ValueSuggest\Suggester\Dc;

use ValueSuggest\Suggester\SuggesterInterface;

class TermsSuggestAll implements SuggesterInterface
{
    /**
     * Return Dublin Core terms.
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
                'value' => 'Abstract',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/abstract',
                    'info' => 'A summary of the resource.',
                ],
            ],
            [
                'value' => 'Access Rights',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/accessRights',
                    'info' => 'Information about who access the resource or an indication of its security status.',
                ],
            ],
            [
                'value' => 'Accrual Method',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/accrualMethod',
                    'info' => 'The method by which items are added to a collection.',
                ],
            ],
            [
                'value' => 'Accrual Periodicity',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/accrualPeriodicity',
                    'info' => 'The frequency with which items are added to a collection.',
                ],
            ],
            [
                'value' => 'Accrual Policy',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/accrualPolicy',
                    'info' => 'The policy governing the addition of items to a collection.',
                ],
            ],
            [
                'value' => 'Alternative Title',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/alternative',
                    'info' => 'An alternative name for the resource.',
                ],
            ],
            [
                'value' => 'Audience',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/audience',
                    'info' => 'A class of agents for whom the resource is intended or useful.',
                ],
            ],
            [
                'value' => 'Date Available',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/available',
                    'info' => 'Date that the resource became or will become available.',
                ],
            ],
            [
                'value' => 'Bibliographic Citation',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/bibliographicCitation',
                    'info' => 'A bibliographic reference for the resource.',
                ],
            ],
            [
                'value' => 'Conforms To',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/conformsTo',
                    'info' => 'An established standard to which the described resource conforms.',
                ],
            ],
            [
                'value' => 'Contributor',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/contributor',
                    'info' => 'An entity responsible for making contributions to the resource.',
                ],
            ],
            [
                'value' => 'Coverage',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/coverage',
                    'info' => 'The spatial or temporal topic of the resource, spatial applicability of the resource, or jurisdiction under which the resource is relevant.',
                ],
            ],
            [
                'value' => 'Date Created',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/created',
                    'info' => 'Date of creation of the resource.',
                ],
            ],
            [
                'value' => 'Creator',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/creator',
                    'info' => 'An entity responsible for making the resource.',
                ],
            ],
            [
                'value' => 'Date',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/date',
                    'info' => 'A point or period of time associated with an event in the lifecycle of the resource.',
                ],
            ],
            [
                'value' => 'Date Accepted',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/dateAccepted',
                    'info' => 'Date of acceptance of the resource.',
                ],
            ],
            [
                'value' => 'Date Copyrighted',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/dateCopyrighted',
                    'info' => 'Date of copyright of the resource.',
                ],
            ],
            [
                'value' => 'Date Submitted',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/dateSubmitted',
                    'info' => 'Date of submission of the resource.',
                ],
            ],
            [
                'value' => 'Description',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/description',
                    'info' => 'An account of the resource.',
                ],
            ],
            [
                'value' => 'Audience Education Level',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/educationLevel',
                    'info' => 'A class of agents, defined in terms of progression through an educational or training context, for which the described resource is intended.',
                ],
            ],
            [
                'value' => 'Extent',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/extent',
                    'info' => 'The size or duration of the resource.',
                ],
            ],
            [
                'value' => 'Format',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/format',
                    'info' => 'The file format, physical medium, or dimensions of the resource.',
                ],
            ],
            [
                'value' => 'Has Format',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/hasFormat',
                    'info' => 'A related resource that is substantially the same as the pre-existing described resource, but in another format.',
                ],
            ],
            [
                'value' => 'Has Part',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/hasPart',
                    'info' => 'A related resource that is included either physically or logically in the described resource.',
                ],
            ],
            [
                'value' => 'Has Version',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/hasVersion',
                    'info' => 'A related resource that is a version, edition, or adaptation of the described resource.',
                ],
            ],
            [
                'value' => 'Identifier',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/identifier',
                    'info' => 'An unambiguous reference to the resource within a given context.',
                ],
            ],
            [
                'value' => 'Instructional Method',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/instructionalMethod',
                    'info' => 'A process, used to engender knowledge, attitudes and skills, that the described resource is designed to support.',
                ],
            ],
            [
                'value' => 'Is Format Of',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/isFormatOf',
                    'info' => 'A pre-existing related resource that is substantially the same as the described resource, but in another format.',
                ],
            ],
            [
                'value' => 'Is Part Of',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/isPartOf',
                    'info' => 'A related resource in which the described resource is physically or logically included.',
                ],
            ],
            [
                'value' => 'Is Referenced By',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/isReferencedBy',
                    'info' => 'A related resource that references, cites, or otherwise points to the described resource.',
                ],
            ],
            [
                'value' => 'Is Replaced By',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/isReplacedBy',
                    'info' => 'A related resource that supplants, displaces, or supersedes the described resource.',
                ],
            ],
            [
                'value' => 'Is Required By',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/isRequiredBy',
                    'info' => 'A related resource that requires the described resource to support its function, delivery, or coherence.',
                ],
            ],
            [
                'value' => 'Date Issued',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/issued',
                    'info' => 'Date of formal issuance of the resource.',
                ],
            ],
            [
                'value' => 'Is Version Of',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/isVersionOf',
                    'info' => 'A related resource of which the described resource is a version, edition, or adaptation.',
                ],
            ],
            [
                'value' => 'Language',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/language',
                    'info' => 'A language of the resource.',
                ],
            ],
            [
                'value' => 'License',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/license',
                    'info' => 'A legal document giving official permission to do something with the resource.',
                ],
            ],
            [
                'value' => 'Mediator',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/mediator',
                    'info' => 'An entity that mediates access to the resource.',
                ],
            ],
            [
                'value' => 'Medium',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/medium',
                    'info' => 'The material or physical carrier of the resource.',
                ],
            ],
            [
                'value' => 'Date Modified',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/modified',
                    'info' => 'Date on which the resource was changed.',
                ],
            ],
            [
                'value' => 'Provenance',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/provenance',
                    'info' => 'A statement of any changes in ownership and custody of the resource since its creation that are significant for its authenticity, integrity, and interpretation.',
                ],
            ],
            [
                'value' => 'Publisher',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/publisher',
                    'info' => 'An entity responsible for making the resource available.',
                ],
            ],
            [
                'value' => 'References',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/references',
                    'info' => 'A related resource that is referenced, cited, or otherwise pointed to by the described resource.',
                ],
            ],
            [
                'value' => 'Relation',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/relation',
                    'info' => 'A related resource.',
                ],
            ],
            [
                'value' => 'Replaces',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/replaces',
                    'info' => 'A related resource that is supplanted, displaced, or superseded by the described resource.',
                ],
            ],
            [
                'value' => 'Requires',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/requires',
                    'info' => 'A related resource that is required by the described resource to support its function, delivery, or coherence.',
                ],
            ],
            [
                'value' => 'Rights',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/rights',
                    'info' => 'Information about rights held in and over the resource.',
                ],
            ],
            [
                'value' => 'Rights Holder',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/rightsHolder',
                    'info' => 'A person or organization owning or managing rights over the resource.',
                ],
            ],
            [
                'value' => 'Source',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/source',
                    'info' => 'A related resource from which the described resource is derived.',
                ],
            ],
            [
                'value' => 'Spatial Coverage',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/spatial',
                    'info' => 'Spatial characteristics of the resource.',
                ],
            ],
            [
                'value' => 'Subject',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/subject',
                    'info' => 'A topic of the resource.',
                ],
            ],
            [
                'value' => 'Table Of Contents',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/tableOfContents',
                    'info' => 'A list of subunits of the resource.',
                ],
            ],
            [
                'value' => 'Temporal Coverage',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/temporal',
                    'info' => 'Temporal characteristics of the resource.',
                ],
            ],
            [
                'value' => 'Title',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/title',
                    'info' => 'A name given to the resource.',
                ],
            ],
            [
                'value' => 'Type',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/type',
                    'info' => 'The nature or genre of the resource.',
                ],
            ],
            [
                'value' => 'Date Valid',
                'data' => [
                    'uri' => 'http://purl.org/dc/terms/valid',
                    'info' => 'Date (often a range) of validity of a resource.',
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
