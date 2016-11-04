<?php
namespace ValueSuggest\DataType\Getty;

class Aat extends AbstractGettyDataType
{
    public function getScheme()
    {
        return 'aat';
    }

    public function getName()
    {
        return 'valuesuggest:getty:aat';
    }

    public function getLabel()
    {
        return 'Value Suggest: Getty: The Art & Architecture Thesaurus (AAT)'; // @translate
    }
}
