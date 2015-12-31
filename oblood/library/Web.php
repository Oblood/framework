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
        static::setRequest(RequestMethod::GET, $uri, $option);
    }

    public static function post($uri, $option = [])
    {
        static::setRequest(RequestMethod::POST, $uri, $option);
    }

    public static function put($uri, $option = [])
    {
        static::setRequest(RequestMethod::PUT, $uri, $option);
    }

    public static function delete($uri, $option = [])
    {
        static::setRequest(RequestMethod::DELETE, $uri, $option);
    }

    public static function match(array $method, $uri, $option = [])
    {
        foreach ($method as $value) {
            static::setRequest($value, $uri, $option);
        }
    }

    private static function setRequest($method, $uri, $option = [])
    {
        switch ($method) {
            case RequestMethod::GET :
                static::$requestGet[$uri] = $option;
                break;
            case RequestMethod::POST :
                static::$requestPost[$uri] = $option;
                break;
            case RequestMethod::PUT :
                static::$requestPut[$uri] = $option;
                break;
            case RequestMethod::DELETE :
                static::$requestDelete[$uri] = $option;
                break;
            default :
                static::$requestGet[$uri] = $option;
        }
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