<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Search;

class Organizations extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/vocabulary/organizations'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:organizations';
    }

    public function getLabel()
    {
        return 'LC: Cultural Heritage Organizations'; // @translate
    }
}
