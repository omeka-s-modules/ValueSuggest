<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Any\Any;
use Zend\ServiceManager\Factory\FactoryInterface;

class AnyDataTypeFactory implements FactoryInterface
{
    protected $types = [
        'valuesuggest:any' => [
            'label' => 'Global type for any vocabulary', // @translate
            'graph' => 'any',
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Any($services);
        return $dataType
            ->setAnyName($requestedName)
            ->setAnyLabel($this->types[$requestedName]['label'])
            ->setAnyGraph($this->types[$requestedName]['graph']);
    }
}
