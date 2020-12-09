<?php
namespace Core\Events;

use Core\Events\Event;

class AfterControllerEvent extends Event
{

    /**
     * AfterControllerEvent constructor.
     * @param mixed $controllerResult
     */
    public function __construct(
        private mixed $controllerResult,
    ){}

    /**
     * @return mixed
     */
    public function getControllerResult(): mixed
    {
        return $this->controllerResult;
    }
}