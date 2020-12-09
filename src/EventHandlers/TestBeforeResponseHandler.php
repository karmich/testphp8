<?php


namespace App\EventHandlers;


use Core\Attributes\ListensTo;
use Core\Events\BeforeResponseEvent;
use Core\Events\Event;
use Core\Events\EventHandler;

class TestBeforeResponseHandler implements EventHandler
{
    #[ListensTo(BeforeResponseEvent::class)]
    public static function BeforeResponseEvent(Event $event)
    {
        /** @var BeforeResponseEvent $event */
        $response = $event->getResponse();

        $headers = $response->getHeaders();
        $headers['X-powered-with'] = 'kma';

        $response->setHeaders($headers);
    }
}