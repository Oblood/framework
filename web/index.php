<?php

require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

$dispatcher = new \Oblood\Foundation\Dispatcher();

$response = $dispatcher->request();

$request = new \Oblood\Support\Facade\Request();

echo "<pre>";
//var_dump($_SERVER);
var_dump($_REQUEST);
$response->send();