<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Search;

class Names extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/authorities/names'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:names';
    }

    public function getLabel()
    {
        return 'LC: Name Authority File'; // @translate
    }
}
