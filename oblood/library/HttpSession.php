<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 下午 5:37
 */

namespace oblood\library;


use oblood\core\Object;

class HttpSession extends Object
{
    /**
     * session是否打开
     * @var boolean
     */
    public static $isOpen = false;

    /**
     * 实例化该类时 session自动打开
     */
    public function HttpSession()
    {
        $this->open();
    }

    /**
     * 判断session属性是否存在
     * @param string $name
     * @return bool
     */
    public function hasAttribute($name) {
        return isset($_SESSION[$name]) ? true : false;
    }

    /**
     * 实例化该类时 session自动打开
     */
    public function open()
    {
        if (!$this->isOpen) {
            if (Config::get('CROSS_DOMAIN') == true) {
                session_id($_COOKIE[Config::get('CROSS_DOMAIN_KEY')]);
            }
            session_start();
            $this->isOpen = true;
        }
    }

    /**
     * 判断session是否打开
     * @return bool
     */
    public function isOpen()
    {
        return $this->isOpen;
    }

    /**
     * 获取session的值
     * 设置session的值
     * @param $name
     * @param $value
     */
    public function setAttribute($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * 获取session的值
     * @param null|string $name
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getAttribute($name = null, $defaultValue)
    {
        if ($name === null) {
            return $_SESSION;
        }

        return isset($_SESSION[$name]) ? $_SESSION[$name] : $defaultValue;
    }

    /**
     * 移除session属性
     * @param $name
     */
    public function removeAttribute($name)
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * 销毁session
     */
    public function destroy()
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
    }
}