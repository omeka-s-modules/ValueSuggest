<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Search;

class Ethnographicterms extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/vocabulary/ethnographicTerms'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:ethnographicTerms';
    }

    public function getLabel()
    {
        return 'LC: AFS Ethnographic Thesaurus'; // @translate
    }
}
