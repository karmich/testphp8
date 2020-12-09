<?php


namespace App\Bundles\UserBundle;


use Core\EventDispatcher;

class UserBundle
{
    public EventDispatcher $eventDispatcher;

    /**
     * UserBundle constructor.
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(
        EventDispatcher $eventDispatcher
    ){
        $this->eventDispatcher = $eventDispatcher;

    }
}