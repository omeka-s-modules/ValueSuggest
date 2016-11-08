<?php
namespace ValueSuggest\DataType;

use Omeka\Api\Adapter\AbstractEntityAdapter;
use Omeka\Api\Representation\ValueRepresentation;
use Omeka\DataType\AbstractDataType as BaseAbstractDataType;
use Omeka\Entity\Value;
use ValueSuggest\DataType\DataTypeInterface;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Renderer\PhpRenderer;

abstract class AbstractDataType extends BaseAbstractDataType implements DataTypeInterface
{
    /**
     * @var ServiceManager
     */
    protected $services;

    /**
     * @param ServiceManager $services
     */
    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    public function form(PhpRenderer $view)
    {
        $labelInput = new Hidden('valuesuggest-label');
        $labelInput->setAttributes([
            'data-value-key' => 'o:label',
        ]);

        $idInput = new Hidden('valuesuggest-id');
        $idInput->setAttributes([
            'data-value-key' => '@id',
        ]);

        $valueInput = new Hidden('valuesuggest-value');
        $valueInput->setAttributes([
            'data-value-key' => '@value',
        ]);

        return sprintf(
            '<span class="o-icon-vocab label" title="%1$s">%1$s</span>',
            $view->escapeHtml($this->getLabel())
        )
        . '<input type="text" class="valuesuggest-input">'
        . $view->formHidden($labelInput)
        . $view->formHidden($idInput)
        . $view->formHidden($valueInput)
        . '
<div class="valuesuggest-id-container">
    <span class="o-icon-uri"></span>
    <span class="valuesuggest-id"></span>
    <a href="#" class="valuesuggest-id-remove o-icon-close" title="' . $view->escapeHtml($view->translate('Remove URI')) . '"></a>
</div>';
    }

    public function isValid(array $valueObject)
    {
        if (isset($valueObject['@id'])
            && is_string($valueObject['@id'])
            && '' !== trim($valueObject['@id'])
        ) {
             return true;
        }
        if (isset($valueObject['@value'])
            && is_string($valueObject['@value'])
            && '' !== trim($valueObject['@value'])
        ) {
            return true;
        }
        return false;
    }

    public function hydrate(array $valueObject, Value $value, AbstractEntityAdapter $adapter)
    {
        $uriStr = null;
        $valueStr = null;

        if (isset($valueObject['@id'])) {
            $uriStr = $valueObject['@id'];
            if (isset($valueObject['o:label'])) {
                $valueStr = $valueObject['o:label'];
            }
        } elseif (isset($valueObject['@value'])) {
            $valueStr = $valueObject['@value'];
        }

        $value->setUri($uriStr);
        $value->setValue($valueStr);
        $value->setLang(null);
        $value->setValueResource(null);
    }

    public function render(PhpRenderer $view, ValueRepresentation $value)
    {
        if ($value->uri()) {
            if ('' !== trim($value->value())) {
                return $view->hyperlink($value->value(), $value->uri());
            }
            return $view->hyperlink($value->uri(), $value->uri());
        }
        return $value->value();
    }

    public function getJsonLd(ValueRepresentation $value)
    {
        $jsonLd = [];
        if ($value->uri()) {
            $jsonLd['@id'] = $value->uri();
            if ('' !== trim($value->value())) {
                $jsonLd['o:label'] = $value->value();
            }
        } else {
            $jsonLd['@value'] = $value->value();
        }
        return $jsonLd;
    }
}
