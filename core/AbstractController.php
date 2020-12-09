<?php


namespace Core;


class AbstractController
{
    private EventDispatcher $eventListener;

    /**
     * @return EventDispatcher
     */
    public function getEventListener(): EventDispatcher
    {
        return $this->eventListener;
    }

    /**
     * @param EventDispatcher $eventListener
     */
    public function setEventListener(EventDispatcher $eventListener): void
    {
        $this->eventListener = $eventListener;
    }

    public function init(){}
}