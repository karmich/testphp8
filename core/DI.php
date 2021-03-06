<?php


namespace Core;


use ReflectionClass;
use ReflectionParameter;

class DI
{
    private $cache = [];

    private $singletones = [];

    public function singleton($key, $value)
    {
        $this->singletones[$key] = $value;
    }

    public function bind($key, $value)
    {
        $this->cache[$key] = $value;
    }

    public function create($what): object
    {
        if (array_key_exists($what, $this->singletones)) {
            return $this->singletones[$what];
        }

        if (array_key_exists($what, $this->cache)) {
            return $this->cache[$what];
        }

        return $this->cache[$what] = $this->instantiate($what);
    }

    private function instantiate($what): object
    {
        $rc = new ReflectionClass($what);
        $constructor = $rc->getConstructor();

        if (!$constructor) {
            return $rc->newInstanceWithoutConstructor();
        }

        $parameters = $constructor->getParameters();
        $arguments = $this->resolveMethodArguments($parameters);

        return $rc->newInstance(...$arguments);
    }

    public function call($object, $method): mixed
    {
        $rm = new \ReflectionMethod($object, $method);
        $arguments = $this->resolveMethodArguments($rm->getParameters());
        return $rm->invokeArgs($object, $arguments);
    }

    private function resolveMethodArguments($parameters): array
    {
        $arguments = [];
        foreach ($parameters as /** @var ReflectionParameter */ $parameter) {
            if ($parameter->getName() == 'eventHandlers') {
                $arguments[] = require('../config/eventHandlers.php');
            } elseif ($parameter->getName() == 'routes') {
                $arguments[] = require('../config/routes.php');
            } else {
                $arguments[] = $this->create($parameter->getType()->getName());
            }
        }
        return $arguments;
    }
}