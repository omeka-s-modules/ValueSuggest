<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Unesco\Unesco;
use Laminas\ServiceManager\Factory\FactoryInterface;

class UnescoDataTypeFactory implements FactoryInterface
{
    protected $types = [
        'valuesuggest:unesco:unescothes' => [
            'label' => 'UNESCO: Tesauro', // @translate
            'graph' => 'http://skos.um.es/unescothes',
        ],
        'valuesuggest:unesco:unesco6' => [
            'label' => 'UNESCO: Nomenclatura de Ciencia y Tecnología', // @translate
            'graph' => 'http://skos.um.es/unesco6',
        ],
        'valuesuggest:unesco:floridablanca' => [
            'label' => 'UNESCO: Biblioteca Digital Floridablanca', // @translate
            'graph' => 'http://skos.um.es/floridablanca',
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Unesco($services);
        $dataType->setUnescoName($requestedName);
        $dataType->setUnescoLabel($this->types[$requestedName]['label']);
        $dataType->setUnescoGraph($this->types[$requestedName]['graph']);
        return $dataType;
    }
}
