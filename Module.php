<?php
namespace ValueSuggest;

use Composer\Semver\Comparator;
use Omeka\Module\AbstractModule;
use Laminas\EventManager\Event;
use Laminas\EventManager\SharedEventManagerInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\Mvc\MvcEvent;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $event)
    {
        parent::onBootstrap($event);
        $acl = $this->getServiceLocator()->get('Omeka\Acl');
        $acl->allow(null, 'ValueSuggest\Controller\Index', 'proxy');
    }

    public function upgrade($oldVersion, $newVersion, ServiceLocatorInterface $services)
    {
        $conn = $services->get('Omeka\Connection');
        if (Comparator::lessThan($oldVersion, '1.16.1')) {
            // OCLC VIAF URIs were invalid. Fix them here.
            $conn->exec("UPDATE value SET uri = REPLACE(uri, 'www.viaf.org', 'viaf.org') WHERE type = 'valuesuggest:oclc:viaf';");
        }
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
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\ItemSet',
            'view.add.after',
            [$this, 'prepareResourceForm']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\ItemSet',
            'view.edit.after',
            [$this, 'prepareResourceForm']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Media',
            'view.add.after',
            [$this, 'prepareResourceForm']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Media',
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
        $assetUrl = $view->plugin('assetUrl');
        $view->headLink()
            ->appendStylesheet($assetUrl('css/valuesuggest.css', 'ValueSuggest'));
        $view->headScript()
            ->appendFile($assetUrl('js/jQuery-Autocomplete/1.2.26/jquery.autocomplete.min.js', 'ValueSuggest'))
            ->appendFile($assetUrl('js/valuesuggest.js', 'ValueSuggest'))
            ->appendScript(sprintf(
                'var valueSuggestProxyUrl = "%s";',
                $view->escapeJs($view->url('admin/value-suggest/proxy'))
            ));
    }
}
