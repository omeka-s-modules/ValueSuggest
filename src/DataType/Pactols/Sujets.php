<?php
namespace ValueSuggest\DataType\Pactols;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Pactols\PactolsSujets;

class Sujets extends AbstractDataType
{
    public function getSuggester()
    {
        return new PactolsSujets($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:pactols:sujets';
    }

    public function getLabel()
    {
        return 'Pactols: Sujets (Subject)'; // @translate
    }
}
