<?php


namespace App\Bundles\UserBundle;


use Core\EventDispatcher;
use Core\Router;

class UserBundle
{

    /**
     * UserBundle constructor.
     * @param EventDispatcher $eventDispatcher
     * @param Router $router
     */
    public function __construct(
        public EventDispatcher $eventDispatcher,
        public Router $router
    ){
    }

    public function init() {
        $this->router->mergeRoutes(require_once (__DIR__ . '/config/routes.php'));
        $this->eventDispatcher->mergeHandlers(require_once (__DIR__ . '/config/eventHandlers.php'));
    }
}