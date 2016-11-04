<?php
namespace ValueSuggest\DataType;

use Omeka\DataType\Literal;
use ValueSuggest\DataType\DataTypeInterface;
use Zend\Form\Element\Text;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Renderer\PhpRenderer;

abstract class AbstractDataType extends Literal implements DataTypeInterface
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
        $text = new Text('valuesuggest');
        $text->setAttributes([
                'class' => 'to-require',
                'data-value-key' => '@value',
            ]);
        return sprintf(
            '<span class="o-icon-vocab label" title="%1$s">%1$s</span>',
            $view->escapeHtml($this->getLabel())
        ) . $view->formText($text);
    }
}
