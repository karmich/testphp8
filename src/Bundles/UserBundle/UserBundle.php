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
        $routes = require_once (__DIR__ . '/config/routes.php');
        $this->router->mergeRoutes($routes);
    }
}