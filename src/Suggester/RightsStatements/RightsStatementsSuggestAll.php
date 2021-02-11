<?php
namespace ValueSuggest\Suggester\RightsStatements;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class RightsStatementsSuggestAll implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Return suggestions taken from RightsStatements.org.
     *
     * @see https://rightsstatements.org/page/1.0/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        return [
            [
                'value' => 'IN COPYRIGHT',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/InC/1.0/',
                    'info' => 'This Rights Statement can be used for an Item that is in copyright. Using this statement implies that the organization making this Item available has determined that the Item is in copyright and either is the rights-holder, has obtained permission from the rights-holder(s) to make their Work(s) available, or makes the Item available under an exception or limitation to copyright (including Fair Use) that entitles it to make the Item available.',
                ],
            ],
            [
                'value' => 'IN COPYRIGHT - EU ORPHAN WORK',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/InC-OW-EU/1.0/',
                    'info' => 'This Rights Statement is intended for use with Items for which the underlying Work has been identified as an Orphan Work in accordance with Directive 2012/28/EU of the European Parliament and of the Council of 25 October 2012 on certain permitted uses of Orphan Works. It can only be applied to Items derived from Works that are covered by the Directive: Works published in the form of books, journals, newspapers, magazines or other writings as well as cinematographic or audiovisual works and phonograms (note: this excludes photography and visual arts). It can only be applied by organizations that are beneficiaries of the Directive: publicly accessible libraries, educational establishments and museums, archives, film or audio heritage institutions and public-service broadcasting organizations, established in one of the EU member states. The beneficiary is also expected to have registered the work in the EU Orphan Works Database maintained by EUIPO.',
                ],
            ],
            [
                'value' => 'IN COPYRIGHT - EDUCATIONAL USE PERMITTED',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/InC-EDU/1.0/',
                    'info' => 'This Rights Statement can be used only for copyrighted Items for which the organization making the Item available is the rights-holder or has been explicitly authorized by the rights-holder(s) to allow third parties to use their Work(s) for educational purposes without first obtaining permission.',
                ],
            ],
            [
                'value' => 'IN COPYRIGHT - NON-COMMERCIAL USE PERMITTED',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/InC-NC/1.0/',
                    'info' => 'This Rights Statement can be used only for copyrighted Items for which the organization making the Item available is the rights-holder or has been explicitly authorized by the rights-holder(s) to allow third parties to use their Work(s) for non-commercial purposes without obtaining permission first.',
                ],
            ],
            [
                'value' => 'IN COPYRIGHT - RIGHTS-HOLDER(S) UNLOCATABLE OR UNIDENTIFIABLE',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/InC-RUU/1.0/',
                    'info' => 'This Rights Statement is intended for use with an Item that has been identified as in copyright but for which no rights-holder(s) has been identified or located after some reasonable investigation. This Rights Statement should only be used if the organization that intends to make the Item available is reasonably sure that the underlying Work is in copyright. This Rights Statement is not intended for use by EU-based organizations who have identified works as Orphan Works in accordance with the EU Orphan Works Directive (they must use InC-OW-EU instead).',
                ],
            ],
            [
                'value' => 'NO COPYRIGHT - CONTRACTUAL RESTRICTIONS',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/NoC-CR/1.0/',
                    'info' => 'This Rights Statement can only be used for Items that are in the Public Domain but for which the organization that intends to make the Item available has entered into contractual agreement that requires it to take steps to restrict third party uses of the Item. In order for this Rights Statement to be conclusive, the organization that intends to make the Item available should provide a link to a page detailing the contractual restrictions that apply to the use of the Item.',
                ],
            ],
            [
                'value' => 'NO COPYRIGHT - NON-COMMERCIAL USE ONLY',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/NoC-NC/1.0/',
                    'info' => 'This Rights Statement can only be used for Works that are in the Public Domain and have been digitized in a public-private partnership as part of which, the partners have agreed to limit commercial uses of this digital representation of the Work by third parties. It has been developed specifically to allow the inclusion of Works that have been digitized as part of the partnerships between European Libraries and Google, but can in theory be applied to Items that have been digitized in similar public-private partnerships.',
                ],
            ],
            [
                'value' => 'NO COPYRIGHT - OTHER KNOWN LEGAL RESTRICTIONS',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/NoC-OKLR/1.0/',
                    'info' => 'This Rights Statement should be used for Items that are in the Public Domain but that cannot be freely re-used as the consequence of known legal restrictions that prevent the organization that intends to make the Item available from allowing free re-use of the Item, such as cultural heritage or traditional cultural expression protections. In order for this Rights Statement to be conclusive, the organization that intends to make the Item available should provide a link to a page detailing the legal restrictions that limit re-use of the Item.',
                ],
            ],
            [
                'value' => 'NO COPYRIGHT - UNITED STATES',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/NoC-US/1.0/',
                    'info' => 'This Rights Statement should be used for Items for which the organization that intends to make the Item available has determined are free of copyright under the laws of the United States. This Rights Statement should not be used for Orphan Works (which are assumed to be in-copyright) or for Items where the organization that intends to make the Item available has not undertaken an effort to ascertain the copyright status of the underlying Work.',
                ],
            ],
            [
                'value' => 'COPYRIGHT NOT EVALUATED',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/CNE/1.0/',
                    'info' => 'This Rights Statement should be used for Items for which the copyright status is unknown and for which the organization that intends to make the Item available has not undertaken an effort to determine the copyright status of the underlying Work.',
                ],
            ],
            [
                'value' => 'COPYRIGHT UNDETERMINED',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/UND/1.0/',
                    'info' => 'This Rights Statement should be used for Items for which the copyright status is unknown and for which the organization that has made the Item available has undertaken an (unsuccessful) effort to determine the copyright status of the underlying Work. Typically, this Rights Statement is used when the organization is missing key facts essential to making an accurate copyright status determination.',
                ],
            ],
            [
                'value' => 'NO KNOWN COPYRIGHT',
                'data' => [
                    'uri' => 'http://rightsstatements.org/vocab/NKC/1.0/',
                    'info' => 'This Rights Statement should be used for Items for which the copyright status has not been determined conclusively, but for which the organization that intends to make the Item available has reasonable cause to believe that the underlying Work is not covered by copyright or related rights anymore. This Rights Statement should not be used for Orphan Works (which are assumed to be in-copyright) or for Items where the organization that intends to make the Item available has not undertaken an effort to ascertain the copyright status of the underlying Work.',
                ],
            ],
        ];
    }
}
