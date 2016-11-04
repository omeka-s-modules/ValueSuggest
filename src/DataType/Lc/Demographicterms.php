<?php
namespace ValueSuggest\DataType\Lc;

class Demographicterms extends AbstractLcDataType
{
    public function getScheme()
    {
        return 'scheme:http://id.loc.gov/authorities/demographicTerms';
    }

    public function getName()
    {
        return 'valuesuggest:lc:demographicTerms';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: Demographic Group Terms'; // @translate
    }
}
