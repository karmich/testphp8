<?php

use Core\DI;
use Core\Kernel;
use Core\Request;

include_once('../vendor/autoload.php');

$request = Request::createFromGlobals();
$di = new DI;
$di->bind(DI::class, $di);
$di->bind(Request::class, $request);
$kernel = new Kernel($di);
$response = $kernel->run($request);
$response->send();