<?php
namespace ValueSuggest\DataType\Dc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Dc\ElementsSuggestAll;

class Elements extends AbstractDataType
{
    public function getSuggester()
    {
        return new ElementsSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:dc:elements';
    }

    public function getLabel()
    {
        return 'Dublin Core: Elements'; // @translate
    }
}
