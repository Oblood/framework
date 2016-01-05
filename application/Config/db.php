<?php

/**
 *      主从数据库可以这样子
 *      如果三五个数据库那就没办法了
 *
 *     'read' => [
 *          'host' => '192.168.1.99',
 *      ],
 *      'write' => [
 *          'host' => 'localhost'
 *      ],
 */

return [
    'driver'    => 'mysql',             // 数据库类型
    'host'      => 'localhost',         // 服务器地址
    'database'  => 'oblood',            // 数据库名
    'username'  => 'root',              // 用户名
    'password'  => 'root',                  // 密码
    'charset'   => 'utf8',              // 数据库编码默认采用utf8
    'collation' => 'utf8_unicode_ci',   // 数据库字符集编码
    'prefix'    => '',                  // 数据库表前缀
];