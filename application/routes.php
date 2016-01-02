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

Web::get('/index.html', [
    'initAttribute' => [
        'title' =>  'OBlood',
        'body'  =>  'this is a framework'
    ],
    'controller'    =>  'application\HelloController',
    'action'        =>  'say'
]);