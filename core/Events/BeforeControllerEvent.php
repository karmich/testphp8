<?php
namespace Core\Events;

use Core\Events\Event;

class BeforeControllerEvent extends Event
{

    /**
     * BeforeController constructor.
     * @param object $controller
     * @param string $action
     */
    public function __construct(
        private object $controller,
        private string $action
    ){}

    /**
     * @return object
     */
    public function getController(): object
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }
}