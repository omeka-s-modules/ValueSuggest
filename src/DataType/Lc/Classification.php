<?php
namespace ValueSuggest\DataType\Lc;

class Classification extends AbstractLcDataType
{
    public function getScheme()
    {
        return 'scheme:http://id.loc.gov/authorities/classification';
    }

    public function getName()
    {
        return 'valuesuggest:lc:classification';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: Classification'; // @translate
    }
}
