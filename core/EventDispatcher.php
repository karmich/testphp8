<?php


namespace Core;



use Core\Attributes\ListensTo;
use Core\Events\Event;
use Core\Events\EventHandler;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;

class EventDispatcher
{
    private array $events = [];

    private array $eventHandlers = [];

    /**
     * EventListener constructor.
     * @param array $eventHandlers
     */
    public function __construct(
        array $eventHandlers = []
    ){
        $this->eventHandlers = $eventHandlers;
        $this->parseEventHandlers();
    }

    public function on(string $event, callable $handler)
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

            call_user_func_array($handler, [$data]);
        }
    }

    private function parseEventHandlers()
    {
        foreach ($this->eventHandlers as $eventHandler) {
            $rc = new ReflectionClass($eventHandler);
            foreach ($rc->getMethods() as /** @var ReflectionMethod */$method) {
                $attributes = $method->getAttributes(ListensTo::class);

                foreach ($attributes as /** @var ReflectionAttribute */$attribute) {
                    $this->on($attribute->getArguments()[0], [$rc->getName(), $method->getName()]);
                }
            }
        }
    }
}