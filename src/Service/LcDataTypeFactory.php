<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class LcDataTypeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $name = ucfirst(strtolower(substr($requestedName, strrpos($requestedName, ':') + 1)));
        $dataType = sprintf('ValueSuggest\DataType\Lc\%s', $name);
        return new $dataType($services);
    }
}
