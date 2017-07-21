<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Search;

class All extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search($this->services->get('Omeka\HttpClient'), '');
    }

    public function getName()
    {
        return 'valuesuggest:lc:all';
    }

    public function getLabel()
    {
        return 'LC: All'; // @translate
    }
}
