<?php

use Core\Kernel;
use Core\Request;

include_once('../vendor/autoload.php');

$request = Request::createFromGlobals();
$kernel = new Kernel();
$response = $kernel->run($request);
$response->send();