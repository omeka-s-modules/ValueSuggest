<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Cc\Cc;
use Laminas\ServiceManager\Factory\FactoryInterface;

class CcDataTypeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new Cc($services);
    }
}
