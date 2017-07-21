<?php
namespace ValueSuggest\DataType\Getty;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Getty\Sparql;

class Aat extends AbstractDataType
{
    public function getSuggester()
    {
        return new Sparql($this->services->get('Omeka\HttpClient'), 'aat');
    }

    public function getName()
    {
        return 'valuesuggest:getty:aat';
    }

    public function getLabel()
    {
        return 'Getty: The Art & Architecture Thesaurus (AAT)'; // @translate
    }
}
