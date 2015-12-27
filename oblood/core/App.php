<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/27 0027
 * Time: 下午 11:08
 */

namespace oblood\core;


class App
{

    public function run()
    {
        //自动加载
        spl_autoload_register('oblood\core\App::autoload');

        //错误汇总
        register_shutdown_function(['oblood\core\Error' , 'fatalError']);//致命错误
        set_error_handler(['oblood\core\Error' , 'errorHandler']);  //常规错误
        set_exception_handler(['oblood\core\Error' , 'exceptionHandler']);  //常规异常

    }

    public static function autoload($class)
    {
        $classArray = explode('\\', $class);


        $classPath = BASE_ROOT . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $classArray) . '.php';

        if (!in_array($classPath, get_required_files())) {
            require_once $classPath;
            if (is_file($classPath)) {
                require_once $classPath;
            }
        }
    }

}