<?php

namespace App\Bundles\UserBundle\EventHandlers;

use Core\Attributes\ListensTo;
use Core\Events\BeforeResponseEvent;
use Core\Events\Event;

class UserEventHandler
{
    #[ListensTo(BeforeResponseEvent::class)]
    public static function f(Event $e)
    {
        /** @var BeforeResponseEvent $e */
        $e->getResponse()->setHeaders(['test' => 'proceed']);
    }
}