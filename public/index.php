<?php

use Core\DI;
use Core\Kernel;
use Core\Request;

include_once('../vendor/autoload.php');

$di = new DI;
$di->singleton(DI::class, $di);
$di->singleton(Request::class, Request::createFromGlobals());

$kernel = $di->create(Kernel::class);
$response = $di->call($kernel, 'run');
$response->send();