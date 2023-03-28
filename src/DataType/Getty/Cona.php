<?php
namespace ValueSuggest\DataType\Getty;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Getty\ConaSearch;

class Cona extends AbstractDataType
{
    public function getSuggester()
    {
        return new ConaSearch($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:getty:cona';
    }

    public function getLabel()
    {
        return 'Getty: Cultural Objects Name Authority (CONA)'; // @translate
    }
}
