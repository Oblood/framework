<?php
/**
 * Created by PhpStorm.
 * User: clover
 * Date: 16-1-5
 * Time: 上午8:21
 */

namespace oblood\route;


use oblood\route\provider\Mapping;

class MappingFilter extends Mapping
{

    private $url;
    private $method;
    private $class;

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setClass($filterClass)
    {
        $this->class = $filterClass;
    }

    public function getClass()
    {
        return $this->class;
    }
}