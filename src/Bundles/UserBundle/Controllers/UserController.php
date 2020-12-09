<?php


namespace App\Bundles\UserBundle\Controllers;


use Core\Response;

class UserController
{
    public function index()
    {
        return new Response(
            body: "I'm a user!"
        );
    }
}