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
        $label = new Text('valuesuggest-label');
        $label->setAttributes([
            'data-value-key' => 'o:label',
        ]);
        $uri = new Hidden('valuesuggest-uri');
        $uri->setAttributes([
            'class' => 'to-require',
            'data-value-key' => '@id',
        ]);
        return sprintf(
            '<span class="o-icon-vocab label" title="%1$s">%1$s</span>',
            $view->escapeHtml($this->getLabel())
        ) . $view->formText($label)
          . $view->formHidden($uri);
    }

    public function isValid(array $valueObject)
    {
        if (isset($valueObject['o:label'])
            && is_string($valueObject['o:label'])
            && '' !== trim($valueObject['o:label'])
        ) {
             return true;
        }
        return false;
    }

    public function hydrate(array $valueObject, Value $value, AbstractEntityAdapter $adapter)
    {
        $value->setValue($valueObject['o:label']);
        if (isset($valueObject['@id'])) {
            $value->setUri($valueObject['@id']);
        } else {
            $value->setUri(null); // set default
        }
        $value->setLang(null); // set default
        $value->setValueResource(null); // set default
    }

    public function render(PhpRenderer $view, ValueRepresentation $value)
    {
        return $value->uri()
            ? $view->hyperlink($value->value(), $value->uri())
            : $value->value();
    }

    public function getJsonLd(ValueRepresentation $value)
    {
        $jsonLd = ['o:label' => $value->value()];
        if ($value->uri()) {
            $jsonLd['@id'] = $value->uri();
        }
        return $jsonLd;
    }
}
