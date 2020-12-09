<?php


namespace Core\Events;


interface EventHandler
{
    public function handle(Event $event);
}