<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use ValueSuggest\DataType\Omeka\PropertyResourceTemplate;

class OmekaPropertyResourceTemplateDataTypeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new PropertyResourceTemplate($services);
    }
}
