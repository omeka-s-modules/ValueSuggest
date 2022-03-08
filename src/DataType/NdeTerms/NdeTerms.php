<?php
namespace ValueSuggest\DataType\NdeTerms;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\NdeTerms\NdeTermsSuggest;

class NdeTerms extends AbstractDataType
{
    protected $ndeTermsName;
    protected $ndeTermsLabel;
    protected $ndeTermsSource;

    public function setNdeTermsName($ndeTermsName)
    {
        $this->ndeTermsName = $ndeTermsName;
    }

    public function setNdeTermsLabel($ndeTermsLabel)
    {
        $this->ndeTermsLabel = $ndeTermsLabel;
    }

    public function setNdeTermsSource($ndeTermsSource)
    {
        $this->ndeTermsSource = $ndeTermsSource;
    }

    public function getSuggester()
    {
        return new NdeTermsSuggest(
            $this->services->get('Omeka\HttpClient'),
            $this->ndeTermsSource
        );
    }

    public function getName()
    {
        return $this->ndeTermsName;
    }

    public function getLabel()
    {
        return $this->ndeTermsLabel;
    }
}
