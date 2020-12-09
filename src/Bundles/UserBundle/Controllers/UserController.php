<?php


namespace App\Bundles\UserBundle\Controllers;


use Core\Response;

class UserController
{
    public function index(): Response
    {
        return new Response("I'm a user!");
    }
}