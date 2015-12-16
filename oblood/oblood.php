<?php

//程序开始的地方,这里一大堆define

define('BASE_ROOT' , dirname(dirname(__FILE__)));


/*************邪恶的分隔线之define结束程序开始*************/


require 'core/Object.php';
require 'core/App.php';


\oblood\core\App::run();

/************邪恶的分割线程序结束*************/