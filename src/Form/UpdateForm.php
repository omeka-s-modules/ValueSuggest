<?php

namespace ValueSuggest\Form;

use Laminas\Form\Element\MultiCheckbox;
use Laminas\Form\Form;
use Omeka\DataType\Manager as DataTypeManager;
use ValueSuggest\DataType\UpdatableDataTypeInterface;

class UpdateForm extends Form
{
    protected DataTypeManager $dataTypeManager;

    public function init()
    {
        $this->add([
            'name' => 'data_types',
            'type' => MultiCheckbox::class,
            'options' => [
                'label' => 'Data types to update', // @translate
                'info' => 'Only values of selected data types will be updated. Selecting none have the same effect as selecting all.', // @translate
                'value_options' => $this->getDataTypesValueOptions(),
            ],
        ]);

        $inputFilter = $this->getInputFilter();

        $inputFilter->add([
            'name' => 'data_types',
            'required' => false,
        ]);
    }

    protected function getDataTypesValueOptions()
    {
        $dataTypeManager = $this->getDataTypeManager();

        $valueOptions = [];

        $names = $dataTypeManager->getRegisteredNames(true);
        foreach ($names as $name) {
            $dataType = $dataTypeManager->get($name);
            if ($dataType instanceof UpdatableDataTypeInterface) {
                $valueOptions[$dataType->getName()] = $dataType->getLabel();
            }
        }

        return $valueOptions;
    }

    public function setDataTypeManager(DataTypeManager $dataTypeManager)
    {
        $this->dataTypeManager = $dataTypeManager;
    }

    public function getDataTypeManager(): DataTypeManager
    {
        return $this->dataTypeManager;
    }
}
