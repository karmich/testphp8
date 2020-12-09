<?php


namespace App\Controllers;


use Core\Response;

class InvokableController
{
    public function __invoke()
    {
        return new Response(
            body: 'Im an Invokable controller!'
        );
    }
}