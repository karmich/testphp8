<?php


namespace Core;

use Core\Events\AfterControllerEvent;
use Core\Events\BeforeControllerEvent;
use Core\Events\BeforeResponseEvent;

class Router
{
    public array $routes = [];
    public EventDispatcher $eventDispatcher;

    /**
     * Router constructor.
     * @param array $routes
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(
        array $routes,
        EventDispatcher $eventDispatcher
    ){
        $this->eventDispatcher = $eventDispatcher;

        foreach ($routes as $url => $callback) {
            $this->addRoute($url, $callback);
        }
    }

    /**
     * @return EventDispatcher
     */
    public function getEventDispatcher(): EventDispatcher
    {
        return $this->eventDispatcher;
    }

    public function addRoute($url, $callback)
    {
        $this->routes[$url] = $this->parseCallback($callback);
    }

    private function parseCallback(string $callback)
    {
        if (str_contains($callback, '::')) {
            $parts = explode('::', $callback);
            return [
                '_controller' => $parts[0],
                '_action' => $parts[1]
            ];
        } else {
            return [
                '_controller' => $callback,
                '_action' => '__invoke'
            ];
        }
    }

    public function mergeRoutes(array $routes)
    {
        foreach ($routes as $url => $callback) {
            $this->addRoute($url, $callback);
        }
    }

    public function run(Request $request, DI $di): Response
    {
        foreach ($this->routes as $route => $controller) {
            if ($route == $request->getPath()) {
                $controllerToExec = $di->create($controller['_controller']);
                return $this->runController([$controllerToExec, $controller['_action']]);
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