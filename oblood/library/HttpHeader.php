<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 下午 5:36
 */

namespace oblood\library;


use oblood\core\Object;

class HttpHeader extends Object
{

    public function addHeader($string, $replace = true, $http_response_code = null)
    {
        header($string, $replace, $http_response_code);
    }

}