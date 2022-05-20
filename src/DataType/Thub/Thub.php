<?php
namespace ValueSuggest\DataType\Thub;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Thub\Sparql;

class Thub extends AbstractDataType
{
    public function getSuggester()
    {
        return new Sparql($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:thub:thub';
    }

    public function getLabel()
    {
        return 'Thesaurus de la Universitat de Barcelona (THUB)'; // @translate
    }
}
