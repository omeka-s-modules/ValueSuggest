<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Ror\Ror;
use Laminas\ServiceManager\Factory\FactoryInterface;

class RorDataTypeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new Ror($services);
    }
}
