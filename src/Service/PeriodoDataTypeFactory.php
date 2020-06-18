<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Periodo\Periodo;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PeriodoDataTypeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new Periodo($services);
    }
}
