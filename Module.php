<?php
namespace ValueSuggest;

use Omeka\Module\AbstractModule;
use ValueSuggest\Service\DataTypeAbstractFactory;
use Zend\EventManager\Event;
use Zend\EventManager\SharedEventManagerInterface;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.add.after',
            [$this, 'prepareResourceForm']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.edit.after',
            [$this, 'prepareResourceForm']
        );
    }

    /**
     * Prepare resource forms for value suggest.
     *
     * @see https://github.com/devbridge/jQuery-Autocomplete
     * @param Event $event
     */
    public function prepareResourceForm(Event $event)
    {
        $view = $event->getTarget();
        $view->headLink()->appendStylesheet($view->assetUrl('css/valuesuggest.css', 'ValueSuggest'));
        $view->headScript()->appendFile($view->assetUrl('js/jQuery-Autocomplete/1.2.26/jquery.autocomplete.min.js', 'ValueSuggest'));
        $view->headScript()->appendFile($view->assetUrl('js/valuesuggest.js', 'ValueSuggest'));
        $view->headScript()->appendScript(sprintf(
            'var valueSuggestProxyUrl = "%s";',
            $view->escapeJs($view->url('admin/value-suggest/proxy'))
        ));
    }
}
