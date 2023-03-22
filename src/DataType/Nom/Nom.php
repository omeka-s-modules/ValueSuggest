<?php
namespace ValueSuggest\DataType\Nom;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Nom\Sparql;

class Nom extends AbstractDataType
{
    protected $nomName;
    protected $nomLabel;
    protected $nomCategory;

    public function setNomName($nomName)
    {
        $this->nomName = $nomName;
    }

    public function setNomLabel($nomLabel)
    {
        $this->nomLabel = $nomLabel;
    }

    public function setNomCategory($nomCategory)
    {
        $this->nomCategory = $nomCategory;
    }

    public function getSuggester()
    {
        return new Sparql(
            $this->services->get('Omeka\HttpClient'),
            $this->nomCategory
        );
    }

    public function getName()
    {
        return $this->nomName;
    }

    public function getLabel()
    {
        return $this->nomLabel;
    }
}
