<?php
namespace ValueSuggest\DataType\Getty;

class Ulan extends AbstractGettyDataType
{
    public function getScheme()
    {
        return 'ulan';
    }

    public function getName()
    {
        return 'valuesuggest:getty:ulan';
    }

    public function getLabel()
    {
        return 'Value Suggest: Getty: The Union List of Artist Names (ULAN)'; // @translate
    }
}
