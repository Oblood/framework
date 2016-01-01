<?php

if(version_compare(PHP_VERSION,'5.6.0','<'))  die('require PHP > 5.6.0 !');

define('APP_DEBUG',true);

define('APP_NAME' , 'application');

define('APP_ROOT' , dirname(dirname(__FILE__)));

require '../../oblood/oblood.php';


