<?php
namespace ValueSuggest\DataType\Lc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Lc\Search;

class Genreforms extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/authorities/genreForms'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:genreForms';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: Genre/Form Terms'; // @translate
    }
}
