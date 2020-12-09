<?php


namespace Core;

use Core\Events\AfterControllerEvent;
use Core\Events\BeforeControllerEvent;
use Core\Events\BeforeResponseEvent;

class Router
{
    /**
     * Router constructor.
     * @param array $routes
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(
        public array $routes,
        public EventDispatcher $eventDispatcher
    ){}

    public function run(Request $request): Response
    {
        foreach ($this->routes as $route => $controller) {
            if ($route == $request->getPath()) {
                $controllerToExec = $this->getController($controller);
                return $this->runController($controllerToExec);
            }
        }

        $response = new Response("<h2>404</h2>",404);

        $this->eventDispatcher->dispatch(new BeforeResponseEvent($response));

        return $response;
    }

    private function getController(string $string): array
    {
        str_contains($string, "::")
            ? [$controller, $action] = explode('::', $string)
            : [$controller, $action] = [$string, '__invoke'];
        $controller = new $controller;

        if ($controller instanceof AbstractController) {
            $controller->setEventListener($this->eventDispatcher);
            $controller->init();
        }

        return [$controller, $action];
    }

    private function runController($controllerToExec): Response
    {
        $this->eventDispatcher->dispatch(new BeforeControllerEvent($controllerToExec[0], $controllerToExec[1]));
        $result = call_user_func($controllerToExec);
        $this->eventDispatcher->dispatch(new AfterControllerEvent($result));

        $response = $result instanceof Response
            ? $result
            : new Response(strval($result));

        $this->eventDispatcher->dispatch(new BeforeResponseEvent($response));
        return $response;
    }
}