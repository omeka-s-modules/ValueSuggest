<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Search;

class Performancemediums extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/authorities/performanceMediums'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:performanceMediums';
    }

    public function getLabel()
    {
        return 'LC: Medium of Performance Thesaurus for Music'; // @translate
    }
}
