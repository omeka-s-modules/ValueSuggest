<?php
namespace ValueSuggest\DataType\Lc;

class Ethnographicterms extends AbstractLcDataType
{
    public function getScheme()
    {
        return 'scheme:http://id.loc.gov/vocabulary/ethnographicTerms';
    }

    public function getName()
    {
        return 'valuesuggest:lc:ethnographicTerms';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: AFS Ethnographic Thesaurus'; // @translate
    }
}
