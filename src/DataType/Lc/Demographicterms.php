<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Search;

class Demographicterms extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/authorities/demographicTerms'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:demographicTerms';
    }

    public function getLabel()
    {
        return 'LC: Demographic Group Terms'; // @translate
    }
}
