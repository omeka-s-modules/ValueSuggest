<?php
namespace ValueSuggest\DataType\RightsStatements;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\RightsStatements\RightsStatementsSuggestAll;

class Rightsstatements extends AbstractDataType
{
    public function getSuggester()
    {
        return new RightsStatementsSuggestAll($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggestall:rightsstatements:rightsstatements';
    }

    public function getLabel()
    {
        return 'RightsStatements.org: Standardized rights statements for online cultural heritage'; // @translate
    }
}
