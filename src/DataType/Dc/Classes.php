<?php
namespace ValueSuggest\DataType\Dc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Dc\ClassesSuggestAll;

class Classes extends AbstractDataType
{
    public function getSuggester()
    {
        return new ClassesSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:dc:classes';
    }

    public function getLabel()
    {
        return 'Dublin Core: Classes'; // @translate
    }
}
