<?php
namespace ValueSuggest\DataType\Pbcore;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Pbcore\PbcoreSuggestAll;

class Pbcore extends AbstractDataType
{
    protected $pbcoreName;
    protected $pbcoreLabel;
    protected $pbcoreFilename;

    public function setPbcoreName($pbcoreName)
    {
        $this->pbcoreName = $pbcoreName;
    }

    public function setPbcoreLabel($pbcoreLabel)
    {
        $this->pbcoreLabel = $pbcoreLabel;
    }

    public function setPbcoreFilename($pbcoreFilename)
    {
        $this->pbcoreFilename = $pbcoreFilename;
    }

    public function getSuggester()
    {
        return new PbcoreSuggestAll($this->pbcoreFilename);
    }

    public function getName()
    {
        return $this->pbcoreName;
    }

    public function getLabel()
    {
        return $this->pbcoreLabel;
    }
}
