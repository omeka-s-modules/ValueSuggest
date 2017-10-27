<?php
namespace ValueSuggest\DataType\Geonames;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Geonames\GeonamesSuggest;

class Geonames extends AbstractDataType
{
    public function getSuggester()
    {
        return new GeonamesSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:geonames:geonames';
    }

    public function getLabel()
    {
        return 'Geonames: The GeoNames geographical database'; // @translate
    }
}
