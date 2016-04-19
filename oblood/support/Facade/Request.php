<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/13
 * Time: 10:01
 */

namespace Oblood\Support\Facade;

/**
 * Class Request
 * @package Oblood\Support\Facade
 *
 * @property string method      请求类型 POST,GET,PUT等
 * @property string clientIp    客户端ip
 * @property string contentType 请求内容类型
 * @property int port           请求端口
 * @property string host        请求域名
 * @property string uri
 * @property string url
 */
class Request extends Facade
{
    /**
     * @var string 请求欺骗
     */
    protected $methodParam = '_method';

//    protected $

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function isPost()
    {
        return $this->getMethod() == 'POST';
    }

    public function isGet()
    {
        return $this->getMethod() == 'GET';
    }

    public function input()
    {

    }

    public function getMethod()
    {
        if (isset($_POST[$this->methodParam])) {
            return strtoupper($_POST[$this->methodParam]);
        } elseif (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            return strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        } else {
            return isset($_SERVER['REQUEST_METHOD']) ? strtoupper($_SERVER['REQUEST_METHOD']) : 'GET';
        }
    }

    public function getClientIp()
    {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
    }

    /**
     * 获取内容类型 content-type
     * @return string|null
     */
    public function getContentType()
    {
        if (isset($_SERVER["CONTENT_TYPE"])) {
            return $_SERVER["CONTENT_TYPE"];
        } elseif (isset($_SERVER["HTTP_CONTENT_TYPE"])) {
            //fix bug https://bugs.php.net/bug.php?id=66606
            return $_SERVER["HTTP_CONTENT_TYPE"];
        }

        return null;
    }

    public function getPort()
    {
        return (int)$_SERVER['SERVER_PORT'];
    }

    public function getHost()
    {
        return isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : null;
    }

    /**
     * 获取请求uri
     * @return mixed|string
     * @throws \Exception 无效的uri
     */
    public function getUri()
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
            throw new \Exception('invalid request URI');
        }

        return $requestUri;
    }

    /**
     * 获取请求url
     * @return string
     * @throws \Exception
     */
    public function getUrl()
    {
        return $this->getHost() . $this->getUri();
    }

    protected function filterParams($value)
    {

    }
}