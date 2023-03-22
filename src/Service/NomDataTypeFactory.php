<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Nom\Nom;
use Laminas\ServiceManager\Factory\FactoryInterface;

class NomDataTypeFactory implements FactoryInterface
{
    protected $types = [
        'valuesuggest:nom:all' => [
            'label' => 'Nomenclature: All', // @translate
            'category' => null,
        ],
        'valuesuggest:nom:nom2' => [
            'label' => 'Nomenclature: Built Environment Objects', // @translate
            'category' => 'nom:2',
        ],
        'valuesuggest:nom:nom967' => [
            'label' => 'Nomenclature: Furnishings', // @translate
            'category' => 'nom:967',
        ],
        'valuesuggest:nom:nom1934' => [
            'label' => 'Nomenclature: Personal Objects', // @translate
            'category' => 'nom:1934',
        ],
        'valuesuggest:nom:nom3176' => [
            'label' => 'Nomenclature: Tools & Equipment for Materials', // @translate
            'category' => 'nom:3176',
        ],
        'valuesuggest:nom:nom7685' => [
            'label' => 'Nomenclature: Tools & Equipment for Science & Technology', // @translate
            'category' => 'nom:7685',
        ],
        'valuesuggest:nom:nom10378' => [
            'label' => 'Nomenclature: Tools & Equipment for Communication', // @translate
            'category' => 'nom:10378',
        ],
        'valuesuggest:nom:nom11633' => [
            'label' => 'Nomenclature: Distribution & Transportation Objects', // @translate
            'category' => 'nom:11633',
        ],
        'valuesuggest:nom:nom12838' => [
            'label' => 'Nomenclature: Communication Objects', // @translate
            'category' => 'nom:12838',
        ],
        'valuesuggest:nom:nom14135' => [
            'label' => 'Nomenclature: Recreational Objects', // @translate
            'category' => 'nom:14135',
        ],
        'valuesuggest:nom:nom14897' => [
            'label' => 'Nomenclature: Unclassifiable Objects', // @translate
            'category' => 'nom:14897',
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Nom($services);
        $dataType->setNomName($requestedName);
        $dataType->setNomLabel($this->types[$requestedName]['label']);
        $dataType->setNomCategory($this->types[$requestedName]['category']);
        return $dataType;
    }
}
