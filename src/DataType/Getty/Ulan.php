<?php
namespace ValueSuggest\DataType\Getty;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Getty\Sparql;

class Ulan extends AbstractDataType
{
    public function getSuggester()
    {
        return new Sparql($this->services->get('Omeka\HttpClient'), 'ulan');
    }

    public function getName()
    {
        return 'valuesuggest:getty:ulan';
    }

    public function getLabel()
    {
        return 'Getty: The Union List of Artist Names (ULAN)'; // @translate
    }
}
