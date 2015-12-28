<?php

return [

    //公共配置项
    'COMMON_CONFIGS'  =>  [
        BASE_ROOT . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'
    ],                      //项目配置项路径,全路径哦

    //项目配置项路径
    'APPLICATION_CONFIGS' => [],

    //smarty模板引擎配置
    'SMARTY_L_DELIM'        =>  '{',            // 模板引擎普通标签开始标记
    'SMARTY_R_DELIM'        =>  '}',            // 模板引擎普通标签结束标记
    'SMARTY_CACHE_TIME'     =>  120,         // 模板缓存有效期 -1 为永久，(以数字为值，单位:秒)
    'SMARTY_TEMPLATE_DIR'   =>  APP_ROOT . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR,
    'SMARTY_COMPILE_DIR'    =>  APP_ROOT . DIRECTORY_SEPARATOR . 'Runtime' . DIRECTORY_SEPARATOR . 'compile' . DIRECTORY_SEPARATOR,
    'SMARTY_CACHE_DIR'      =>  APP_ROOT . DIRECTORY_SEPARATOR . 'Runtime' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR,
    'SMARTY_TEMPLATE_Suffix'=>  '.php',

    //默认设定
    'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
    'DEFAULT_TIMEZONE'      =>  'PRC',	// 默认时区
    'ACTION_BEFORE'         =>  '_before_',
    'ACTION_AFTER'          =>  '_after_',

    /* 数据库设置 */
    'DB_TYPE'               =>  '',         // 数据库类型
    'DB_HOST'               =>  '',         // 服务器地址
    'DB_NAME'               =>  '',         // 数据库名
    'DB_USER'               =>  '',         // 用户名
    'DB_PWD'                =>  '',         // 密码
    'DB_PORT'               =>  '',         // 端口
    'DB_PREFIX'             =>  '',         // 数据库表前缀
    'DB_CHARSET'            =>  'utf8',     // 数据库编码默认采用utf8


];