<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-1
 * Time: 上午6:09
 */

namespace oblood\library;


use oblood\core\Object;

class HttpCookie extends Object
{
    /**
     * 添加一个cookies
     * @param $name
     * @param null $value
     * @param null|int $expire 到期时间
     */
    public function addCookie($name, $value = null, $expire = null)
    {
        setcookie($name, $value, $expire);
    }

    /**
     * 添加一个跨域的 cookie
     * @param $name
     * @param null $value
     * @param null $expire
     * @param $domain
     */
    public function addCrossCookie($name, $value = null, $expire = null, $domain)
    {
        setcookie($name, $value, $expire, '/', $domain);
    }

    public function get($name = null)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    public function remove($name)
    {
        if(isset($_COOKIE[$name])) {
            unset($_COOKIE);
        }
    }
}