<?php
namespace ValueSuggest\DataType\Dc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Dc\TermsSuggestAll;

class Terms extends AbstractDataType
{
    public function getSuggester()
    {
        return new TermsSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:dc:terms';
    }

    public function getLabel()
    {
        return 'Dublin Core: Terms'; // @translate
    }
}
