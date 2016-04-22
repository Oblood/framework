<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/22
 * Time: 11:26
 */

namespace OBlood\Http\Facades;


use OBlood\Foundation\Facade;
use OBlood\Foundation\OBlood;
use OBlood\Http\HttpRequest;

/**
 * Class RequestFacade
 * @package OBlood\Http\Facades
 *
 * @property String method          //请求方式GET,POST....
 * @property String queryString     //查询字符串
 * @property String requestUrl      //请求url
 */
class RequestFacade extends Facade implements HttpRequest
{

    protected $parameters;

    protected $methodParam = '_method';

    protected function RequestFacade()
    {
        $this->parameters = array_merge($_GET, $_POST);
    }

    public function getMethod()
    {
        if (!is_null($this->getParameter($this->methodParam))) {
            return strtoupper($this->getParameter($this->methodParam));
        }

        if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            return strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        }

        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }

        throw new \Exception;
    }

    public function getQueryString()
    {

    }

    public function getRequestURL()
    {
        // TODO: Implement getRequestURL() method.
    }

    public function getServerName()
    {
        // TODO: Implement getServerName() method.
    }

    public function getServerPort()
    {
        // TODO: Implement getServerPort() method.
    }

    public function getParameter($name, $default = null)
    {
        return isset($this->parameters[$name]) ? $this->parameters[$name] : $default;
    }

    public function getParameters()
    {

    }

    public function getRemoteAddr()
    {
        // TODO: Implement getRemoteAddr() method.
    }

    public function getRemoteHost()
    {

    }

    public function getSession()
    {
        // TODO: Implement getSession() method.
    }

    public function getCookie()
    {
        // TODO: Implement getCookie() method.
    }

    public function getServer()
    {
        // TODO: Implement getServer() method.
    }
}