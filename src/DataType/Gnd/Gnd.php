<?php
namespace ValueSuggest\DataType\Gnd;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Gnd\GndSuggest;

class Gnd extends AbstractDataType
{
    public function getSuggester()
    {
        return new GndSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:gnd:gnd';
    }

    public function getLabel()
    {
        return 'GND: Die Gemeinsame Normdatei'; // @translate
    }
}
