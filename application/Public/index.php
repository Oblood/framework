<?php

if(version_compare(PHP_VERSION,'5.4.0','<'))  die('require PHP > 5.4.0 !');

define('APP_DEBUG',true);

define('APP_NAME' , 'application');

define('APP_ROOT' , dirname(dirname(__FILE__)));

require '../../oblood/oblood.php';


