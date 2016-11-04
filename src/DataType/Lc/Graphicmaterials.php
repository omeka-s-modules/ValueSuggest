<?php
namespace ValueSuggest\DataType\Lc;

class Graphicmaterials extends AbstractLcDataType
{
    public function getScheme()
    {
        return 'scheme:http://id.loc.gov/vocabulary/graphicMaterials';
    }

    public function getName()
    {
        return 'valuesuggest:lc:graphicMaterials';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: Thesaurus for Graphic Materials'; // @translate
    }
}
