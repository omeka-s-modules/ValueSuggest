<?php
namespace ValueSuggest\DataType;

use Omeka\Api\Adapter\AbstractEntityAdapter;
use Omeka\Api\Representation\ValueRepresentation;
use Omeka\DataType\AbstractDataType as BaseAbstractDataType;
use Omeka\DataType\ConversionTargetInterface;
use Omeka\DataType\ValueAnnotatingInterface;
use Omeka\Entity\Value;
use Laminas\Form\Element\Hidden;
use Laminas\ServiceManager\ServiceManager;
use Laminas\View\Renderer\PhpRenderer;

abstract class AbstractDataType extends BaseAbstractDataType implements DataTypeInterface, ValueAnnotatingInterface, ConversionTargetInterface
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

    public function getOptgroupLabel()
    {
        return 'Value Suggest'; // @translate
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

        $rdfLabel = $this->getLabel();

        return $view->partial('common/data-type/suggested', [
            'labelInput' => $labelInput,
            'idInput' => $idInput,
            'valueInput' => $valueInput,
            'rdfLabel' => $rdfLabel,
        ]);
    }

    public function isValid(array $valueObject)
    {
        if ($this->isUsableUri($valueObject['@id'] ?? null)) {
            return true;
        }
        return null !== $this->getLiteralValue($valueObject);
    }

    public function hydrate(array $valueObject, Value $value, AbstractEntityAdapter $adapter)
    {
        $uriStr = null;
        $valueStr = null;
        $langStr = null;

        if ($this->isUsableUri($valueObject['@id'] ?? null)) {
            $uriStr = $valueObject['@id'];
            if (isset($valueObject['o:label'])) {
                $valueStr = $valueObject['o:label'];
            }
        } else {
            $valueStr = $this->getLiteralValue($valueObject);
        }
        if (isset($valueObject['@language'])) {
            $langStr = $valueObject['@language'];
        }

        $value->setUri($uriStr);
        $value->setValue($valueStr);
        $value->setLang($langStr);
        $value->setValueResource(null);
    }

    public function render(PhpRenderer $view, ValueRepresentation $value)
    {
        $uri = $value->uri();
        if ($uri) {
            $label = '' !== trim((string) $value->value()) ? $value->value() : $uri;
            if (!$this->isUsableUri($uri)) {
                // Don't link an unsafe URI saved before they were rejected.
                return $view->escapeHtml($label);
            }
            return $view->hyperlink($label, $uri, ['class' => 'uri-value-link']);
        }
        return nl2br($view->escapeHtml((string) $value->value()));
    }

    public function getFulltextText(PhpRenderer $view, ValueRepresentation $value)
    {
        // Index the URI as well as the label, as core's URI data type does.
        return trim(sprintf('%s %s', $value->uri(), $value->value()));
    }

    public function getJsonLd(ValueRepresentation $value)
    {
        $jsonLd = [];
        if ($value->uri()) {
            $jsonLd['@id'] = $value->uri();
            if ('' !== trim((string) $value->value())) {
                $jsonLd['o:label'] = $value->value();
            }
        } else {
            $jsonLd['@value'] = $value->value();
        }
        if ($value->lang()) {
            $jsonLd['@language'] = $value->lang();
        }
        return $jsonLd;
    }

    public function valueAnnotationPrepareForm(PhpRenderer $view)
    {
    }

    public function valueAnnotationForm(PhpRenderer $view)
    {
        $html = '<div class="input-body">';
        $html .= $this->form($view);
        $html .= '</div>';
        return $html;
    }

    public function convert(Value $valueObject, string $dataTypeTarget): bool
    {
        $value = $valueObject->getValue();
        $uri = $valueObject->getUri();

        if ($this->isUsableUri($uri)) {
            // The value object has a URI.
            return true;
        }
        if (is_string($value) && filter_var($value, FILTER_VALIDATE_URL) && $this->isUsableUri($value)) {
            // The value object has no usable URI, but the value is a URL. Move
            // the value to the URI.
            $valueObject->setValue(null);
            $valueObject->setUri($value);
            return true;
        }

        return false;
    }

    /**
     * Check that a URI is a non-empty string whose scheme can't run script
     * (javascript:, data: or vbscript:).
     *
     * Browsers ignore case, tabs, newlines and control characters in a URL's
     * scheme, so they're ignored here too.
     *
     * @param mixed $uri
     * @return bool
     */
    private function isUsableUri($uri)
    {
        if (!is_string($uri) || '' === trim($uri)) {
            return false;
        }
        $normalized = strtolower(preg_replace('/[\x00-\x20]/', '', $uri));
        return !preg_match('/^(javascript|data|vbscript):/', $normalized);
    }

    /**
     * Get the text to save for a value without a usable URI.
     *
     * That's its @value or, when its URI was rejected (such as javascript:),
     * the URI's label, so the label is kept as plain text.
     *
     * @param array $valueObject
     * @return string|null
     */
    private function getLiteralValue(array $valueObject)
    {
        $keys = ['@value'];
        if (isset($valueObject['@id']) && is_string($valueObject['@id']) && '' !== trim($valueObject['@id'])) {
            $keys[] = 'o:label';
        }
        foreach ($keys as $key) {
            if (isset($valueObject[$key]) && is_string($valueObject[$key]) && '' !== trim($valueObject[$key])) {
                return $valueObject[$key];
            }
        }
        return null;
    }
}
