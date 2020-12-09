<?php


namespace Core;



use Core\Events\Event;
use Core\Events\EventHandler;

class EventDispatcher
{
    /**
     * EventListener constructor.
     * @param array $events
     */
    public function __construct(
        public array $events = []
    ){}

    public function on(string $event, string|EventHandler $handler)
    {
        if (!array_key_exists($event, $this->events)) {
            $this->events[$event] = [];
        }

        $this->events[$event][] = $handler;
    }

    public function dispatch(string|Event $eventName, ?Event $data = null)
    {
        if ($eventName instanceof Event){
            $data = $eventName;
            $eventName = $eventName::class;
        }

        if (!array_key_exists($eventName, $this->events)) {
            return;
        }

        foreach ($this->events[$eventName] as $e => $handler) {
            if (is_string($handler)) {
                $this->events[$eventName][$e] = new $handler;
                $handler = $this->events[$eventName][$e];
            }

            $handler->handle($data);
        }
    }
}