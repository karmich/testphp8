<?php
return array_merge(
    [
        '/' => '\App\Controllers\MainController::index',
        '/invoke' => '\App\Controllers\InvokableController',
    ],

    require_once ('../src/Bundles/UserBundle/config/routes.php'),
);