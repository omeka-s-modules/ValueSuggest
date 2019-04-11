<?php
namespace ValueSuggest\DataType\Tesauros;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Tesauros\Sparql;

class Tesauros extends AbstractDataType
{
    protected $tesaurosName;
    protected $tesaurosLabel;
    protected $tesaurosScheme;

    public function setTesaurosName($tesaurosName)
    {
        $this->tesaurosName = $tesaurosName;
    }

    public function setTesaurosLabel($tesaurosLabel)
    {
        $this->tesaurosLabel = $tesaurosLabel;
    }

    public function setTesaurosScheme($tesaurosScheme)
    {
        $this->tesaurosScheme = $tesaurosScheme;
    }

    public function getSuggester()
    {
        return new Sparql(
            $this->services->get('Omeka\HttpClient'),
            $this->tesaurosScheme
        );
    }

    public function getName()
    {
        return $this->tesaurosName;
    }

    public function getLabel()
    {
        return $this->tesaurosLabel;
    }
}
