<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-4
 * Time: 上午11:45
 */

namespace oblood\route;

use oblood\route\provider\Mapping;

class MappingController extends Mapping
{
    private $url;

    private $controller;

    private $action;

    private $method;

    /**
     * @var array
     */
    private $initAttribute = [];

    private $actionParams = [];

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setInitAttribute($initAttribute)
    {
        $this->initAttribute = $initAttribute;
    }

    public function getInitAttribute()
    {
        return $this->initAttribute;
    }

    public function setActionParams($params = [])
    {
        $this->actionParams = $params;
    }

    public function getActionParams()
    {
        return $this->actionParams;
    }

}