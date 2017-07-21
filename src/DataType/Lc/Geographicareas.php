<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Suggest;

class Geographicareas extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'http://id.loc.gov/vocabulary/geographicAreas/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:geographicAreas';
    }

    public function getLabel()
    {
        return 'LC: MARC Geographic Areas'; // @translate
    }
}
