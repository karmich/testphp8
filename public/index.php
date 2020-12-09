<?php

include_once('../vendor/autoload.php');

$request = \Core\Request::createFromGlobals();
$eventDispatcher = new \Core\EventDispatcher(require_once ('../config/eventHandlers.php'));
$router = new \Core\Router(
    routes: require_once ('../config/routes.php'),
    eventDispatcher: $eventDispatcher,
);

$bundles = require_once ('../config/bundles.php');

foreach ($bundles as $bundle) {
    $b = new $bundle($eventDispatcher, $router);
    $b->init();
}

try {
    $response = $router->run($request);
    $response->send();
} catch(\Throwable $e) {
    (new \Core\Response(body: $e->getMessage()))->send();
}