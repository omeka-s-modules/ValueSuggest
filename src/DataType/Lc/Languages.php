<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Suggest;

class Languages extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'http://id.loc.gov/vocabulary/languages/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:languages';
    }

    public function getLabel()
    {
        return 'LC: MARC Languages'; // @translate
    }
}
