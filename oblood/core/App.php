<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/16 0016
 * Time: 上午 12:58
 */

namespace oblood\core;


class App extends Object{

    /**
     * 框架开始启动
     */
    public static function run() {



        //自动加载
        spl_autoload_register('\oblood\core\App::autoload');

        //错误汇总..... 略过

        //异常汇总..... 略过

        //读取全局配置项和项目配置项

        //启动拦截器

        //处理控制器

        new Test();

    }


    /**
     * 框架自动加载
     * 自动加载规则：以空间命名为问价路径来加载
     * 例： \oblood\core\App   ,自动加载的文件路径为： {BASE_ROOT}/oblood/core/App.php
     * @param $class
     */
    public static function autoload($class) {

        $classArray = explode('\\' , $class);

        $classPath = BASE_ROOT . '/' . implode('/' , $classArray) . '.php';

        if(!in_array($classPath , get_required_files())) {
            if(is_file($classPath)) {
                require_once $classPath;
            }
        }
    }
}