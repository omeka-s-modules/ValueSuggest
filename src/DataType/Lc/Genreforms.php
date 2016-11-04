<?php
namespace ValueSuggest\DataType\Lc;

class Genreforms extends AbstractLcDataType
{
    public function getScheme()
    {
        return 'scheme:http://id.loc.gov/authorities/genreForms';
    }

    public function getName()
    {
        return 'valuesuggest:lc:genreForms';
    }

    public function getLabel()
    {
        return 'Value Suggest: LC: Genre/Form Terms'; // @translate
    }
}
