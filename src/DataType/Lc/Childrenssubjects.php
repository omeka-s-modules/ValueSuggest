<?php
namespace ValueSuggest\DataType\Lc;

class Childrenssubjects extends AbstractLcDataType
{
    public function getScheme()
    {
        return 'scheme:http://id.loc.gov/authorities/childrensSubjects';
    }

    public function getName()
    {
        return 'valuesuggest:lc:childrensSubjects';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: Children\'s Subject Headings'; // @translate
    }
}
