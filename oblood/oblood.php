<?php
/**
 * 框架入口文件
 */

define('BASE_ROOT' , dirname(dirname(__FILE__)));


//require BASE_ROOT. '/vendor/autoload.php';

require 'core/App.php';



(new \oblood\core\App())->run();
