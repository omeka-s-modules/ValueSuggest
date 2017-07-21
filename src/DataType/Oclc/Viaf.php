<?php
namespace ValueSuggest\DataType\Oclc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Oclc\ViafSuggest;

class Viaf extends AbstractDataType
{
    public function getSuggester()
    {
        return new ViafSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:oclc:viaf';
    }

    public function getLabel()
    {
        return 'OCLC: The Virtual International Authority File (VIAF)'; // @translate
    }
}
