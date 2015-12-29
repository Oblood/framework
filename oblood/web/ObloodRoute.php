<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/29 0029
 * Time: 下午 5:57
 */

namespace oblood\web;


use oblood\core\App;
use oblood\core\Object;
use oblood\exception\RouteException;
use oblood\library\Config;
use oblood\library\RequestMethod;
use oblood\library\Web;
use oblood\web\provider\RouteManage;

class ObloodRoute extends Object implements RouteManage
{

    protected $requestParameterKeys;

    protected $requestParameterValues;

    public function execute()
    {
        require BASE_ROOT . DIRECTORY_SEPARATOR . APP_NAME . DIRECTORY_SEPARATOR . 'routes.php';

        $config = $this->requestRouteConfig();

        if ($config == null) return null;

        $controller = $this->createController($config['controller']);

        $parameters = $config['wildcard'] ? $this->resolveRequestParameters($config['configUri']) : [];

        foreach ($parameters as $key => $value) {
            if(('{'.$key.'}') == $config['action']) {
                $config['action'] = $value;
            }
        }

        return $this->runAction($controller, $config['action'], $parameters);
    }

    /**
     * @param $clazz
     * @return Controller
     * @throws RouteException
     */
    protected function createController($clazz)
    {
        if (class_exists($clazz)) {
            return call_user_func_array([$clazz, 'instance'], []);
        } else {
            throw new RouteException(' controller not found ');
        }
    }

    protected function runAction($controller, $actionName, $option = [])
    {
        if (!method_exists($controller, $actionName)) {
            throw new RouteException(' action not found ' . $actionName);
        }

        //执行action的前置方法
        if (method_exists($controller, Config::get('ACTION_BEFORE') . $actionName)) {
            if (call_user_func_array([$controller, Config::get('ACTION_BEFORE') . $actionName], $option) === false) {
                exit;
            }
        }

        //执行action
        $result = call_user_func_array([$controller, $actionName], $option);

        //执行action的后置方法
        if (method_exists($controller, Config::get('ACTION_AFTER') . $actionName)) {
            call_user_func_array([$controller, Config::get('ACTION_AFTER') . $actionName], $option);
        }

        return $result;
    }

    /**
     * 获取需要执行控制器配置项
     * @return array
     */
    protected function requestRouteConfig()
    {
        switch (App::$httpContext->request->method) {

            case RequestMethod::GET    :
                $config = Web::$requestGet;
                break;
            case RequestMethod::POST   :
                $config = Web::$requestPost;
                break;
            case RequestMethod::PUT    :
                $config = Web::$requestPut;
                break;
            case RequestMethod::DELETE :
                $config = Web::$requestDelete;
                break;
            default :
                $config = Web::$requestGet;
        }

        if (isset($config[App::$httpContext->request->requestUri])) {
            $result = $config[App::$httpContext->request->requestUri];
            $result['wildcard'] = false;
            return $result;
        }

        foreach ($config as $key => $value) {

            $pattern = $this->resolvePattern($key);

            $check = preg_match_all('/\{(.[a-zA-Z0-9]{0,})\}/', $key, $parameterKeys);
            if ($check === 0) continue;

            foreach ($parameterKeys[1] as $v) {
                $pattern = str_replace('\\{' . $v . '\\}', '[a-zA-Z0-9]{0,}', $pattern);
            }

            if (preg_match($pattern, App::$httpContext->request->requestUri)) {
                $result = $config[$key];
                $result['wildcard'] = true;
                $result['configUri'] = $key;
                return $result;
            }
        }

        return null;
    }

    /**
     * 获取请求url中的通配符参数的value
     * @param $configUri
     * @return array
     */
    protected function resolveRequestParameters($configUri)
    {
        $parameterKeys = $this->requestParameterKeys($configUri);
        if (empty($parameterKeys)) return $parameterKeys;

        $parameterValues = $this->requestParameterValues($configUri);

        $result = [];
        for ($i = 0; $i < count($parameterKeys); $i++) {
            $result[$parameterKeys[$i]] = $parameterValues[$i];
        }

        return $result;
    }

    /**
     * 获取请求url中的通配符参数的key
     * @param $configUri
     * @return array
     */
    protected function requestParameterKeys($configUri)
    {
        if (!isset($this->requestParameterKeys)) {
            if (preg_match_all('/\{(.[a-zA-Z0-9]{0,})\}/', $configUri, $parameterKeys) === 0) {
                $this->requestParameterKeys = [];
            }

            array_shift($parameterKeys);
            $this->requestParameterKeys = array_shift($parameterKeys);
        }

        return $this->requestParameterKeys;
    }

    protected function requestParameterValues($configUri)
    {
        if (!isset($this->requestParameterValues)) {
            $pattern = $this->resolvePattern($configUri);
            $parameterKeys = $this->requestParameterKeys($configUri);

            foreach ($parameterKeys as $value) {
                $pattern = str_replace('\\{' . $value . '\\}', '(.*)', $pattern);
            }

            preg_match($pattern, App::$httpContext->request->requestUri, $parameterValues);
            array_shift($parameterValues);
            $this->requestParameterValues = $parameterValues;
        }

        return $this->requestParameterValues;
    }

    /**
     * 将字符串转换成匹配该字符串的正则表达式
     * @param string $str
     * @return string
     */
    protected function resolvePattern($str)
    {
        $array = ['.', '/', '+', '*', '?', '[', '^', ']', '$', '(', ')', '{', '}', '=', '!', '<', '>', '|', ':'];
        foreach ($array as $value) {
            if (strpos($str, $value) !== false) {
                $str = str_replace($value, '\\' . $value, $str);
            }
        }

        return '/^' . $str . '$/';
    }
}