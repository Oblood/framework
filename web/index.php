<?php

define('BASIC_ROOT' , dirname(dirname(__FILE__)));

require BASIC_ROOT . '/vendor/autoload.php';

$bootstrap = require BASIC_ROOT . '/config/bootstrap.php';

$dispatcher = \OBlood\Foundation\Facades\Dispatcher::getInstance($bootstrap);

$response = $dispatcher::$app->call([$dispatcher , 'request']);

$response->send();

