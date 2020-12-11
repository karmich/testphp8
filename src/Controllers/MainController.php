<?php


namespace App\Controllers;


use App\Models\User;
use Core\AbstractController;
use Core\ModelMapper;
use Core\Request;
use Core\Response;

class MainController extends AbstractController
{
    public function index(Request $request): Response
    {
        $data = [
            ['id' => 1, 'email' => 'test@test.com', 'password' => 'asdf876234ahsdf', 'name' => 'My name is Slim Shady'],
        ];

        $users = [];

        foreach ($data as $datum) {
            $users[] = ModelMapper::map($datum, User::class);
        }

        echo '<pre>';
        var_dump($users); die;

        return new Response(
            body: "Main page!",
        );
    }
}