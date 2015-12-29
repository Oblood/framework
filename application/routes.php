<?php
use \oblood\library\Web;


Web::get('/{action}' , [
    'controller'   => 'application\Controller\Index\IndexController',
    'action'       => '{action}',
]);


Web::get('/welcome/{qqq}/{www}.html' , [
    'controller'   => 'application\Controller\Index\IndexController',
    'action'       => '{www}',
]);


Web::get('/welcome/{qqq}.html' , [
    'controller'   => 'application\Controller\Index\IndexController',
    'action'       => 's',
]);