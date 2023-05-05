<?php
namespace ValueSuggest\DataType\Ror;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Ror\RorSuggest;

class Ror extends AbstractDataType
{
    public function getSuggester()
    {
        return new RorSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:ror:ror';
    }

    public function getLabel()
    {
        return 'ROR: Research Organization Registry'; // @translate
    }
}
