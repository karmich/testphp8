<?php

use Core\DI;
use Core\Kernel;
use Core\Request;

include_once('../vendor/autoload.php');

$request = Request::createFromGlobals();
$kernel = new Kernel(new DI());
$response = $kernel->run($request);
$response->send();