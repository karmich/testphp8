<?php

include_once('../vendor/autoload.php');

$request = \Core\Request::createFromGlobals();
$router = new \Core\Router(
    routes: require_once ('../config/routes.php'),
    eventDispatcher: new \Core\EventDispatcher()
);

try {
    $response = $router->run($request);
    $response->send();
} catch(\Throwable $e) {
    (new \Core\Response(body: $e->getMessage()))->send();
}