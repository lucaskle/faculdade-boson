<?php

namespace Secretaria;

use Laminas\Mvc\MvcEvent;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }



    public function onBootstrap(MvcEvent $e)
    {
        $application = $e->getApplication();
        $eventManager = $application->getEventManager();

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function (MvcEvent $e) {
            $routeMatch = $e->getRouteMatch();
            if (!$routeMatch) {
                return;
            }

            $controllerNamespace = explode('\\', $routeMatch->getParam('controller'))[0];

            if ($controllerNamespace === 'Secretaria') {
                $e->getViewModel()->setTemplate('layout/secretaria');
            }
        }, 100);
    }
}
