<?php
namespace ValueSuggest\DataType\IdRef;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\IdRef\IdRefSuggest;

class All extends AbstractDataType
{
    public function getSuggester()
    {
        return new IdRefSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:idref:all';
    }

    public function getLabel()
    {
        return 'IdRef: The French national database for research'; // @translate
    }
}
