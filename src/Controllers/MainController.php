<?php


namespace App\Controllers;


use Core\AbstractController;
use Core\Request;
use Core\Response;

class MainController extends AbstractController
{
    public function index(Request $request): Response
    {
        return new Response(
            body: "Main page!",
        );
    }
}