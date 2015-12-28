<?php
use \oblood\library\Web;

Web::get('/' , [
    'controller'   => 'application\Controller\Index\IndexController',
    'action'       => 'index',
]);
Web::get('/welcome' , [
    'controller'   => 'application\Controller\Index\IndexController',
    'action'       => 's',
]);