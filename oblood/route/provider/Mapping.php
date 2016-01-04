<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-4
 * Time: 下午12:12
 */

namespace oblood\route\provider;


abstract class Mapping
{
    public abstract function setUrl($url);
    public abstract function getUrl();

    public abstract function setMethod($method);
    public abstract function getMethod();

    public function className()
    {
        return get_called_class();
    }

}