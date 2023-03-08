<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use ValueSuggest\DataType\Omeka\Omeka;

class OmekaDataTypeFactory implements FactoryInterface
{
    protected $dataTypes = [
        'valuesuggest:omeka:property' => [
            'label' => 'Omeka: Property', // @translate
        ],
        'valuesuggest:omeka:propertyResourceTemplate' => [
            'label' => 'Omeka: Property / Resource template', // @translate
        ],
        'valuesuggest:omeka:propertyResourceClass' => [
            'label' => 'Omeka: Property / Resource class', // @translate
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Omeka($services);
        $dataType->setName($requestedName);
        $dataType->setLabel($this->dataTypes[$requestedName]['label']);
        return $dataType;
    }
}
