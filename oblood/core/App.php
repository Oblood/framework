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

        spl_autoload_register('\oblood\core\App::autoload');

    }


    protected static function runBefore() {

    }

    protected static function runAfter() {

    }


    /**
     * 框架自动加载
     * @param $class
     */
    public static function autoload($class) {

        $classArray = explode('\\' , $class);

        $classPath = BASE_ROOT . '/' . implode('/' , $classArray);

        if(!in_array($classPath , get_required_files())) {
            require_once $classPath . '.php';
        }
    }
}