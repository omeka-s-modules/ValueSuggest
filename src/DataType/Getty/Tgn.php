<?php
namespace ValueSuggest\DataType\Getty;

class Tgn extends AbstractGettyDataType
{
    public function getScheme()
    {
        return 'tgn';
    }

    public function getName()
    {
        return 'valuesuggest:getty:tgn';
    }

    public function getLabel()
    {
        return 'Value Suggest: Getty: The Getty Thesaurus of Geographic Names (TGN)'; // @translate
    }
}
