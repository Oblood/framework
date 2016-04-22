<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/22
 * Time: 14:49
 */

namespace OBlood\Foundation;


class Facade extends OBlood
{
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (!isset($this->attributes[$name]) && method_exists($this, $method)) {
            $this->offsetSet($name , call_user_func_array([$this , $method] , []));
        }

        return $this->offsetGet($name);
    }
}