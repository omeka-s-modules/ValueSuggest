<?php
namespace ValueSuggest\DataType\Lc;

class Organizations extends AbstractLcDataType
{
    public function getScheme()
    {
        return 'scheme:http://id.loc.gov/vocabulary/organizations';
    }

    public function getName()
    {
        return 'valuesuggest:lc:organizations';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: Cultural Heritage Organizations'; // @translate
    }
}
