<?php
namespace ValueSuggest\DataType\Lc;

class Performancemediums extends AbstractLcDataType
{
    public function getScheme()
    {
        return 'scheme:http://id.loc.gov/authorities/performanceMediums';
    }

    public function getName()
    {
        return 'valuesuggest:lc:performanceMediums';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: Medium of Performance Thesaurus for Music'; // @translate
    }
}
