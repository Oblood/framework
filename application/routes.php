<?php

return [
    'uri' => [
        'method'       => '访问方式',
        'controller'   => '全类名 \app\controller\ConController',
        'action'       => 'index',
    ],

    '/index.html' => [
        'method'       => 'GET' ,
        'controller'   => 'application\Controller\Index\IndexController',
        'action'       => 'index',
    ]
];