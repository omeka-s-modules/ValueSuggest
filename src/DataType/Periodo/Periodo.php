<?php
namespace ValueSuggest\DataType\Periodo;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Periodo\PeriodoSuggest;

class Periodo extends AbstractDataType
{
    public function getSuggester()
    {
        return new PeriodoSuggest;
    }

    public function getName()
    {
        return 'valuesuggest:periodo:periodo';
    }

    public function getLabel()
    {
        return 'PeriodO: A public domain gazetteer of scholarly definitions of historical, art-historical, and archaeological periods'; // @translate
    }
}
