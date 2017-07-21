<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Suggest;

class Iso6392 extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'http://id.loc.gov/vocabulary/iso639-2/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:iso6392';
    }

    public function getLabel()
    {
        return 'LC: ISO639-2 Languages'; // @translate
    }
}
