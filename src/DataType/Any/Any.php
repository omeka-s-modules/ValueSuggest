<?php
namespace ValueSuggest\DataType\Any;

use ValueSuggest\DataType\AbstractDataType;

class Any extends AbstractDataType
{
    protected $anyName;
    protected $anyLabel;
    protected $anyGraph;

    public function setAnyName($anyName)
    {
        $this->anyName = $anyName;
        return $this;
    }

    public function setAnyLabel($anyLabel)
    {
        $this->anyLabel = $anyLabel;
        return $this;
    }

    public function setAnyGraph($anyGraph)
    {
        $this->anyGraph = $anyGraph;
        return $this;
    }

    public function getSuggester()
    {
    }

    public function getName()
    {
        return $this->anyName;
    }

    public function getLabel()
    {
        return $this->anyLabel;
    }
}
