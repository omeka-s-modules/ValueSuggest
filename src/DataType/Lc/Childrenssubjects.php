<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Search;

class Childrenssubjects extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/authorities/childrensSubjects'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:childrensSubjects';
    }

    public function getLabel()
    {
        return 'LC: Children\'s Subject Headings'; // @translate
    }
}
