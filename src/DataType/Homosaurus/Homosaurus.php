<?php
namespace ValueSuggest\DataType\Homosaurus;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Homosaurus\HomosaurusSuggest;

class Homosaurus extends AbstractDataType
{
    public function getSuggester()
    {
        return new HomosaurusSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:homosaurus:homosaurus';
    }

    public function getLabel()
    {
        return 'Homosaurus: the International Thesaurus of Lesbian, Gay, Bisexual and Transgender Index Terms that is currently used by https://www.digitaltransgenderarchive.net.'; // @translate
    }
}
