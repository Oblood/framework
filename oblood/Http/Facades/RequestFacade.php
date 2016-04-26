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
 * @property String baseURI         //请求url
 * @property String requestURI      //请求url带查询字符串
 * @property String referrer        //上一页面url
 * @property string serverName      //服务名称
 * @property int port               //端口号
 * @property string remoteAddr      //请求地址
 * @property string remoteHost      //请求主机
 */
class RequestFacade extends Facade implements HttpRequest
{

    public static $controller;

    public static $action;

    //请求参数
    protected $parameters;

    //方法欺骗
    protected $methodParam = '_method';

    protected function RequestFacade()
    {
        $this->parameters = array_merge($_GET, $_POST);
    }

    public function getMethod()
    {
        if (null != $this->getParameter($this->methodParam)) {
            return strtoupper($this->getParameter($this->methodParam));
        }

        if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            return strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        }

        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }

        return 'GET';
    }

    public function getQueryString()
    {
        return isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
    }

    public function getBaseURI()
    {
        if(strpos($this->requestURI , '?')) {
            return explode('?' , $this->requestURI)[0];
        } else {
            return $this->requestURI;
        }
    }

    public function getRequestURI()
    {
        if (isset($_SERVER['HTTP_X_REWRITE_URL'])) { // IIS
            $requestUri = $_SERVER['HTTP_X_REWRITE_URL'];
        } elseif (isset($_SERVER['REQUEST_URI'])) {
            $requestUri = $_SERVER['REQUEST_URI'];
            if ($requestUri !== '' && $requestUri[0] !== '/') {
                $requestUri = preg_replace('/^(http|https):\/\/[^\/]+/i', '', $requestUri);
            }
        } elseif (isset($_SERVER['ORIG_PATH_INFO'])) { // IIS 5.0 CGI
            $requestUri = $_SERVER['ORIG_PATH_INFO'];
            if (!empty($_SERVER['QUERY_STRING'])) {
                $requestUri .= '?' . $_SERVER['QUERY_STRING'];
            }
        } else {
            throw new \Exception('Unable to determine the request URI.');
        }

        return $requestUri;
    }

    public function getReferrer()
    {
        return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
    }

    public function getServerName()
    {
        return $_SERVER['SERVER_NAME'];
    }

    public function getServerPort()
    {
        return (int) $_SERVER['SERVER_PORT'];
    }

    public function getParameter($name, $default = null)
    {
        return isset($this->parameters[$name]) ? $this->parameters[$name] : $default;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getRemoteAddr()
    {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
    }

    public function getRemoteHost()
    {
        return isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : null;
    }

    public function getSession()
    {
        // TODO: Implement getSession() method.
    }

    public function getCookie()
    {
        // TODO: Implement getCookie() method.
    }

    public static function getController()
    {
        return static::$controller;
    }

    public static function getAction()
    {
        return static::$action;
    }

    public function hasParameter($name)
    {
        return isset($this->parameters[$name]);
    }
}