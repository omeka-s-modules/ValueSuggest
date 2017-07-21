<?php
namespace ValueSuggest\DataType\Getty;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Getty\Sparql;

class Tgn extends AbstractDataType
{
    public function getSuggester()
    {
        return new Sparql($this->services->get('Omeka\HttpClient'), 'tgn');
    }

    public function getName()
    {
        return 'valuesuggest:getty:tgn';
    }

    public function getLabel()
    {
        return 'Getty: The Getty Thesaurus of Geographic Names (TGN)'; // @translate
    }
}
