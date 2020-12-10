<?php


namespace Core;


class Kernel
{


    /**
     * Kernel constructor.
     * @param DI $di
     */
    public function __construct(
        public DI $di
    ){}

    public function run(Request $request): Response
    {
        $router = $this->di->create(Router::class);
        $eventDispatcher = $router->getEventDispatcher();

        $bundles = require_once ('../config/bundles.php');

        foreach ($bundles as $bundle) {
            $b = new $bundle($eventDispatcher, $router);
            $b->init();
        }

        $eventDispatcher->parseEventHandlers();

        try {
            return $router->run($request);
        } catch(\Throwable $e) {
            return new Response(body: $e->getMessage());
        }
    }
}