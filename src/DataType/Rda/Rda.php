<?php
namespace ValueSuggest\DataType\Rda;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Rda\RdaSuggestAll;

class Rda extends AbstractDataType
{
    protected $rdaName;
    protected $rdaLabel;
    protected $rdaUrl;

    public function setRdaName($rdaName)
    {
        $this->rdaName = $rdaName;
    }

    public function setRdaLabel($rdaLabel)
    {
        $this->rdaLabel = $rdaLabel;
    }

    public function setRdaUrl($rdaUrl)
    {
        $this->rdaUrl = $rdaUrl;
    }

    public function getSuggester()
    {
        return new RdaSuggestAll(
            $this->services->get('Omeka\HttpClient'),
            $this->rdaUrl
        );
    }

    public function getName()
    {
        return $this->rdaName;
    }

    public function getLabel()
    {
        return $this->rdaLabel;
    }
}
