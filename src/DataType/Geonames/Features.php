<?php
namespace ValueSuggest\DataType\Geonames;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Geonames\FeaturesSuggestAll;

class Features extends AbstractDataType
{
    public function getSuggester()
    {
        return new FeaturesSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:geonames:features';
    }

    public function getLabel()
    {
        return 'Geonames: GeoNames features'; // @translate
    }
}
