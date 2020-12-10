<?php


namespace App\Controllers;


use Core\AbstractController;
use Core\Response;

class MainController extends AbstractController
{
    public function index(): Response
    {
        return new Response(
            body: "Main page!",
        );
    }
}