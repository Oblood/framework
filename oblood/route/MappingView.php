<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-4
 * Time: 下午12:01
 */

namespace oblood\route;


use oblood\route\provider\Mapping;

class MappingView extends Mapping
{
    private $url;

    private $template;

    /**
     * @var array
     */
    private $initAttribute;

    private $method;

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setInitAttribute($initAttribute)
    {
        $this->initAttribute = $initAttribute;
    }

    public function getInitAttribute()
    {
        return $this->initAttribute;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }
}