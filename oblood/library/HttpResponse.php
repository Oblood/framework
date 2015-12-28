<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 下午 5:35
 */

namespace oblood\library;


class HttpResponse
{
    public function redirect($url, $statusCode = 302)
    {
        header('Location: ' . $url);

        return $this;
    }
}