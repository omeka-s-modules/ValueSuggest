<?php
namespace ValueSuggest\DataType\Lc;

class Subjects extends AbstractLcDataType
{
    public function getScheme()
    {
        return 'scheme:http://id.loc.gov/authorities/subjects';
    }

    public function getName()
    {
        return 'valuesuggest:lc:subjects';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: Subject Headings'; // @translate
    }
}
