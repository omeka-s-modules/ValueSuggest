<?php
namespace ValueSuggest\DataType\Lc;

class Names extends AbstractLcDataType
{
    public function getScheme()
    {
        return 'scheme:http://id.loc.gov/authorities/names';
    }

    public function getName()
    {
        return 'valuesuggest:lc:names';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: Name Authority File'; // @translate
    }
}
