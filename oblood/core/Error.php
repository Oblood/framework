<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/27 0027
 * Time: 下午 11:49
 */

namespace oblood\core;


class Error extends Object
{

    public static function fatalError() {
exit();
    }

    public static function errorHandler($code, $message, $file, $line, $context)
    {
        switch ($code) {
            case E_ERROR:
            case E_PARSE:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
                exit("<h3>error info : $message</h3> <br /> error file : $file 第 $line 行.");
        }
    }

    public static function exceptionHandler($code, $message, $file, $line, $context) {
        exit("<h3>error info : $message</h3> <br /> error file : $file 第 $line 行.");
    }

}