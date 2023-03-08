<?php
namespace ValueSuggest\DataType\Omeka;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Omeka\Omeka as OmekaSuggester;

class Omeka extends AbstractDataType
{
    protected $name;
    protected $label;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getSuggester()
    {
        return new OmekaSuggester($this->services, $this->name);
    }
}
