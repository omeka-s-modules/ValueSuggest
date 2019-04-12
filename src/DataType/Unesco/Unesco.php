<?php
namespace ValueSuggest\DataType\Unesco;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Unesco\Sparql;

class Unesco extends AbstractDataType
{
    protected $unescoName;
    protected $unescoLabel;
    protected $unescoGraph;

    public function setUnescoName($unescoName)
    {
        $this->unescoName = $unescoName;
    }

    public function setUnescoLabel($unescoLabel)
    {
        $this->unescoLabel = $unescoLabel;
    }

    public function setUnescoGraph($unescoGraph)
    {
        $this->unescoGraph = $unescoGraph;
    }

    public function getSuggester()
    {
        return new Sparql(
            $this->services->get('Omeka\HttpClient'),
            $this->unescoGraph
        );
    }

    public function getName()
    {
        return $this->unescoName;
    }

    public function getLabel()
    {
        return $this->unescoLabel;
    }
}
