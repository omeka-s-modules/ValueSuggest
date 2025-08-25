<?php
namespace ValueSuggest\DataType\Cc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Cc\CcSuggestAll;

class Cc extends AbstractDataType
{
    public function getSuggester()
    {
        return new CcSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:cc:cc';
    }

    public function getLabel()
    {
        return 'Creative Commons (CC): Free, easy-to-use copyright licenses'; // @translate
    }
}
