<?php


namespace oblood\library;


use oblood\core\Object;

/**
 * Class HttpRequest
 * @package oblood\library
 * @property string $method
 * @property string clientIp
 * @property string requestHost
 * @property string serverPort
 * @property string uri
 */
class HttpRequest extends Object
{

    public function getParameter($name) {
        return $this->$_GET[$name];
    }

    public function getParameters() {
        return $_GET;
    }

    /**
     * 获取请求域名
     * @return string|null
     */
    public function getRequestHost() {
        return isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : null;
    }

    /**
     * 获取客户端ip
     * @return string|null
     */
    public function getClientIp() {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
    }

    /**
     * 获取请求方式
     * @return string
     */
    public function getMethod() {
        return isset($_SERVER['REQUEST_METHOD']) ? strtoupper($_SERVER['REQUEST_METHOD']) : 'GET';
    }

    /**
     * 获取请求端口
     * @return int
     */
    public function getServerPort() {
        return (int) $_SERVER['SERVER_PORT'];
    }

    /**
     * 获取请求uri
     * @return mixed|string
     * @throws \ErrorException
     */
    public function getUri() {

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
            throw new \ErrorException('Unable to determine the request URI.');
        }

        return $requestUri;
    }
}