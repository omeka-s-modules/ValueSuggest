<?php
namespace ValueSuggest\Form;

use Laminas\Form\Form;
use Omeka\Stdlib\Message;

/**
 * The module's configuration: credentials for vocabulary services.
 *
 * Each service that needs an account or key gets a text field here, saved as
 * the global setting "valuesuggest_<service>_<credential>". Its data type reads
 * the setting and passes it to its suggester's constructor, which falls back on
 * a default or throws a clear error when it's blank. Credentials are
 * used only by the server-side proxy, never sent to the browser.
 */
class ConfigForm extends Form
{
    public function init()
    {
        // A text field, not a password field: a password field shows blank
        // after a reload, so saving the form unchanged would erase the value.
        $this->add([
            'type' => 'text',
            'name' => 'geonames_username',
            'options' => [
                'label' => 'GeoNames username', // @translate
                'info' => new Message(
                    'Set a GeoNames username so GeoNames suggestions work reliably. Register a free account at %s and enter its username here.', // @translate
                    '<a href="https://www.geonames.org/login" target="_blank">https://www.geonames.org/login</a>'
                ),
                // The info text carries a link, and holds no user-supplied content.
                'escape_info' => false,
            ],
            'attributes' => [
                'id' => 'valuesuggest-geonames-username',
            ],
        ]);

        $inputFilter = $this->getInputFilter();
        $inputFilter->add([
            'name' => 'geonames_username',
            'required' => false,
            'allow_empty' => true,
            'filters' => [['name' => 'StringTrim']],
        ]);
    }
}
