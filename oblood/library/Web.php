<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 下午 5:20
 */

namespace oblood\library;


class Web
{

    public static $requestGet;
    public static $requestPost;
    public static $requestPut;
    public static $requestDelete;
    public static $requestError;


    public static function get($uri, $option = [])
    {
        self::$requestGet[$uri] = $option;
    }

    public static function post($uri, $option = [])
    {
        self::$requestPost[$uri] = $option;
    }

    public static function put($uri, $option = [])
    {
        self::$requestPut[$uri] = $option;
    }

    public static function delete($uri, $option = [])
    {
        self::$requestDelete[$uri] = $option;
    }

    /**
     * @param $code
     * @param array $option = ['class'=>'..' , 'action'=>'..' , 'view'=>'..']
     */
    public static function error($code, $option = [])
    {
        self::$requestError[$code] = $option;
    }

    public static function filter($uri, $option = [])
    {

    }
}