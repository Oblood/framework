<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/25
 * Time: 13:02
 */

namespace OBlood\Http\Facades;


use OBlood\Foundation\Facade;
use OBlood\Http\HttpHeader;

class HeaderFacade extends Facade implements HttpHeader
{

    protected $headers = [];

    /**
     * 获取所有的头部
     * @return mixed
     */
    public function all()
    {
        return $this->headers;
    }

    public function add($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function get($name)
    {
        return $this->headers[$name];
    }

    public function remove($name)
    {
        unset($this->headers[$name]);
    }

    public function has($name)
    {
        return isset($this->headers[$name]);
    }
}