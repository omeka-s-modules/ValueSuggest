<?php

namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PactolsDataTypeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $name = ucfirst(strtolower(substr($requestedName, strrpos($requestedName, ':') + 1)));
        $dataType = sprintf('ValueSuggest\DataType\Pactols\%s', $name);
        return new $dataType($services);
    }
}
