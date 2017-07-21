<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Search;

class Graphicmaterials extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/vocabulary/graphicMaterials'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:graphicMaterials';
    }

    public function getLabel()
    {
        return 'LC: Thesaurus for Graphic Materials'; // @translate
    }
}
