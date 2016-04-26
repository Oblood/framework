<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/25
 * Time: 12:57
 */

namespace OBlood\Http;


interface HttpHeader
{
    /**
     * 获取所有的头部
     * @return mixed
     */
    public function all();

    public function add($name , $value);

    public function get($name);

    public function remove($name);

    public function has($name);

}