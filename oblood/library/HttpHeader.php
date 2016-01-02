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

    /**
     * 函数检查 HTTP 标头是否已被发送以及在哪里被发送。 如果报头已发送
     * @return bool
     */
    public function headerIsSend()
    {
        return headers_sent();
    }

}