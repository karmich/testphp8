<?php


namespace Core;


class ParameterBag
{

    /**
     * ParameterBag constructor.
     * @param array $parameters
     */
    public function __construct(
        private array $parameters = []
    ){}

    public function add($key, $value)
    {
        $this->parameters[$key] = $value;
    }
}