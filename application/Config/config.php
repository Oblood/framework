<?php

/**
 * 更多配置参数 见 /oblood/config/convention.php
 */

return [

    'LISTENER'  =>  [
        'oblood\route\InitRoutes'
    ],

    'TEMPLATE_DIR'  =>  '/View/',                         //模板资源文件所在路径
    'DB'    =>   include 'db.php'
];