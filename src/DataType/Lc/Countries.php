<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Suggest;

class Countries extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'http://id.loc.gov/vocabulary/countries/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:countries';
    }

    public function getLabel()
    {
        return 'LC: MARC Countries'; // @translate
    }
}
