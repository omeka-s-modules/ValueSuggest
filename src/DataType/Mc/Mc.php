<?php
namespace ValueSuggest\DataType\Mc;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Mc\Sparql;

class Mc extends AbstractDataType
{
    protected $mcName;
    protected $mcLabel;
    protected $mcScheme;

    public function setMcName($mcName)
    {
        $this->mcName = $mcName;
    }

    public function setMcLabel($mcLabel)
    {
        $this->mcLabel = $mcLabel;
    }

    public function setMcScheme($mcScheme)
    {
        $this->mcScheme = $mcScheme;
    }

    public function getSuggester()
    {
        return new Sparql(
            $this->services->get('Omeka\HttpClient'),
            $this->mcScheme
        );
    }

    public function getName()
    {
        return $this->mcName;
    }

    public function getLabel()
    {
        return $this->mcLabel;
    }
}
