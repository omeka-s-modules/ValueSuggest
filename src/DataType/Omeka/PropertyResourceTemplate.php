<?php
namespace ValueSuggest\DataType\Omeka;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Omeka\PropertyResourceTemplate as PropertyResourceTemplateSuggester;

class PropertyResourceTemplate extends AbstractDataType
{
    public function getName()
    {
        return 'valuesuggest:omeka:propertyResourceTemplate';
    }

    public function getLabel()
    {
        return 'Omeka: Property resource template'; // @translate
    }

    public function getSuggester()
    {
        return new PropertyResourceTemplateSuggester($this->services);
    }
}
