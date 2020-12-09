<?php


namespace App\Controllers;


use App\EventHandlers\TestBeforeResponseHandler;
use Core\AbstractController;
use Core\Events\BeforeResponseEvent;
use Core\Response;

class MainController extends AbstractController
{
    public function init()
    {
        $this->getEventListener()->on(
            BeforeResponseEvent::class,
            TestBeforeResponseHandler::class
        );
    }

    public function index(): Response
    {
        return new Response(
            body: "Main page!",
        );
    }
}