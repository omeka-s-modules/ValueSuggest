<?php
namespace ValueSuggest\DataType\Dc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Dc\TypesSuggestAll;

class Types extends AbstractDataType
{
    public function getSuggester()
    {
        return new TypesSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:dc:types';
    }

    public function getLabel()
    {
        return 'Dublin Core: Types'; // @translate
    }
}
