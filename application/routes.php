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

Web::get('/{controller}/{action}.html' , [
    'controller'   => 'application\Controller\Index\{controller}Controller',
    'action'       => '{action}',
    'initAttribute' =>  [
        'qqqq'  =>  '{controller}'
    ]
]);
