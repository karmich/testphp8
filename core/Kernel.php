<?php


namespace Core;


class Kernel
{
    public function run(Request $request): Response
    {
        $eventDispatcher = new EventDispatcher(require_once ('../config/eventHandlers.php'));
        $router = new Router(
            routes: require_once ('../config/routes.php'),
            eventDispatcher: $eventDispatcher,
        );

        $bundles = require_once ('../config/bundles.php');

        foreach ($bundles as $bundle) {
            $b = new $bundle($eventDispatcher, $router);
            $b->init();
        }

        $eventDispatcher->parseEventHandlers();

        try {
            $response = $router->run($request);
            return $response;
        } catch(\Throwable $e) {
            return new Response(body: $e->getMessage());
        }
    }
}