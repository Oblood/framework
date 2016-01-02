<?php
use \oblood\library\Web;

/**
 * $option = [
 *      'controller' => '..',
 *      'action'     => '..',
 *      'initAttribute' => [],
 *      'template'   => '..'   优先级最高
 * ]
 */


Web::get('/', ['template' => 'index.php' , 'initAttribute' => [
    'title' =>  'OBlood',
    'body'  =>  'this is a framework'
]]);

//url  /hell
Web::get('/hello', [
    'initAttribute' => [
        'title' =>  'OBlood',
        'body'  =>  'hello world'
    ],
    'controller'    =>  'application\HelloController',
    'action'        =>  'say'
]);

//url  /hello/helloworld
Web::get('/hello/{body}', [
    'initAttribute' => [
        'title' =>  'OBlood',
        'body'  =>  '{body}'
    ],
    'controller'    =>  'application\HelloController',
    'action'        =>  'say'
]);