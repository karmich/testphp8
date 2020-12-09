<?php
namespace Core\Events;

use Core\Response;

class BeforeResponseEvent extends \Core\Events\Event
{
    /**
     * BeforeController constructor.
     * @param Response $response
     */
    public function __construct(
        private Response $response,
    ){}

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }
}