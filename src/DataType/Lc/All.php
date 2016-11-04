<?php
namespace ValueSuggest\DataType\Lc;

class All extends AbstractLcDataType
{
    public function getScheme()
    {
        return '';
    }

    public function getName()
    {
        return 'valuesuggest:lc:all';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: All'; // @translate
    }
}
