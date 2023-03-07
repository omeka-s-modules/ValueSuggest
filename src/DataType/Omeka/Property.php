<?php
namespace ValueSuggest\DataType\Omeka;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Omeka\Property as PropertySuggester;

class Property extends AbstractDataType
{
    public function getName()
    {
        return 'valuesuggest:omeka:property';
    }

    public function getLabel()
    {
        return 'Omeka: Property'; // @translate
    }

    public function getSuggester()
    {
        return new PropertySuggester($this->services);
    }
}
