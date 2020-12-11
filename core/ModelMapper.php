<?php


namespace Core;


use ReflectionProperty;

class ModelMapper
{
    public static function map(array $data, $model)
    {
        $instance = new $model;
        $rc = new \ReflectionClass($instance);
        $properties = $rc->getProperties();

        foreach ($properties as /** @var ReflectionProperty */ $property) {
            $name = $property->getName();

            if (!array_key_exists($name, $data)) {
                continue;
            }

            $property->setAccessible(true);
            $property->setValue($instance, $data[$name]);
            $property->setAccessible(false);
        }

        return $instance;
    }
}