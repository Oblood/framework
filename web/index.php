<?php

require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

$dispatcher = new \OBlood\Foundation\Facades\Dispatcher();

$dispatcher->request();

$request = new \OBlood\Http\Facades\RequestFacade();

//var_dump($request->getMethod());
echo "<pre>";
var_dump($request->queryString);