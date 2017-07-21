<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Suggest;

class Relators extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'http://id.loc.gov/vocabulary/relators/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:relators';
    }

    public function getLabel()
    {
        return 'LC: MARC Relators'; // @translate
    }
}
