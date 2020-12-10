<?php


namespace Core;


use ReflectionClass;
use ReflectionParameter;

class DI
{
    public function create($what): object
    {
        $rc = new ReflectionClass($what);
        $constructor = $rc->getConstructor();

        if (!$constructor) {
            return $rc->newInstanceWithoutConstructor();
        }

        $parameters = $constructor->getParameters();
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

        return $rc->newInstance(...$arguments);
    }
}