<?php
namespace ValueSuggest\DataType\Ns;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Ns\Sparql;

class Ns extends AbstractDataType
{
    protected $nsName;
    protected $nsLabel;
    protected $nsScheme;

    public function setNsName($nsName)
    {
        $this->nsName = $nsName;
    }

    public function setNsLabel($nsLabel)
    {
        $this->nsLabel = $nsLabel;
    }

    public function setNsScheme($nsScheme)
    {
        $this->nsScheme = $nsScheme;
    }

    public function getSuggester()
    {
        return new Sparql(
            $this->services->get('Omeka\HttpClient'),
            $this->nsScheme
        );
    }

    public function getName()
    {
        return $this->nsName;
    }

    public function getLabel()
    {
        return $this->nsLabel;
    }
}
