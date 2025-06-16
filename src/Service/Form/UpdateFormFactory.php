<?php
namespace ValueSuggest\Service\Form;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use ValueSuggest\Form\UpdateForm;

class UpdateFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataTypeManager = $services->get('Omeka\DataTypeManager');

        $form = new UpdateForm(null, $options ?? []);
        $form->setDataTypeManager($dataTypeManager);

        return $form;
    }
}
