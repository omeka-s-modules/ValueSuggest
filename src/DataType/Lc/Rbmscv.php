<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Suggest;

class Rbmscv extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'http://id.loc.gov/vocabulary/rbmscv/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:rbmscv';
    }

    public function getLabel()
    {
        return 'LC: Rare Materials Cataloging'; // @translate
    }
}
