<?php


namespace Core;


class Kernel
{


    /**
     * Kernel constructor.
     * @param DI $di
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(
        public DI $di,
        public EventDispatcher $eventDispatcher,
    ){}

    public function run(Request $request): Response
    {
        $router = $this->di->create(Router::class);

        $bundles = require_once ('../config/bundles.php');

        foreach ($bundles as $bundle) {
            $b = new $bundle($this->eventDispatcher, $router);
            $b->init();
        }

        $this->eventDispatcher->parseEventHandlers();

        try {
            return $router->run($request);
        } catch(\Throwable $e) {
            return new Response(body: $e->getMessage());
        }
    }
}