<?php
use oblood\route\RequestMapping;

/**
 * $option = [
 *      'controller' => '..',
 *      'action'     => '..',
 *      'initAttribute' => [],
 *      'template'   => '..'   优先级最高
 * ]
 */

RequestMapping::alias('foo', '/hello');

RequestMapping::view('/', [
    'template' => 'index.php',
    'initAttribute' => [
        'title' => 'OBlood',
        'body' => 'this\'s a framework'
    ]
]);


RequestMapping::controller('@foo/say', [
    'controller' => 'application\HelloController',
    'action' => 'say',
    'initAttribute' => [
        'title' => 'hello world',
        'body' => 'say'
    ]
]);

RequestMapping::controller('@foo/say/{id}', [
    'controller' => 'application\HelloController',
    'action' => 'sayId',
    'initAttribute' => [
        'title' => 'hello world',
        'body' => 'say'
    ]
]);

RequestMapping::controller('@foo/say/{id}', [
    'controller' => 'application\HelloController',
    'action' => 'sayId',
    'initAttribute' => [
        'title' => 'hello world',
        'body' => 'say'
    ]
]);