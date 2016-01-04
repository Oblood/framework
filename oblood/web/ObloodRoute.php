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
use Whoops\Exception\ErrorException;

class ObloodRoute extends Object implements RouteManage
{

    protected $requestParameterKeys;

    protected $requestParameterValues;

    /**
     * @var array 匹配成功的路由的配置项
     * 在 $this->requestRouteConfig() 执行过后产生
     */
    protected $routeConfig;

    public function execute()
    {
        require BASE_ROOT . DIRECTORY_SEPARATOR . APP_NAME . DIRECTORY_SEPARATOR . 'routes.php';

        $config = $this->requestRouteConfig();

        if ($config == null) throw new RouteException('routes.php 文件中没有找到配置项');

        $parameters = $config['wildcard'] ? $this->resolveRequestParameters($config['configUri']) : [];

        //整理通配符转换正指定的值
        foreach ($parameters as $key => $value) {
            $wildcard = '{' . $key . '}';
            foreach ($config as $k => $v) {
                if ($k != 'wildcard' && $k != 'configUri') {
                    $config[$k] = str_replace($wildcard, $value, $v);
                }
            }
        }

        //判断是否直接读取模板
        if (isset($config['template'])) {
            return $this->readTemplate($config['template'], isset($config['initAttribute']) ? $config['initAttribute'] : []);
        }

        $controller = $this->createController($config['controller']);

        //判断是否需要初始化控制器的属性
        if (isset($config['initAttribute'])) {
            $this->initControllerAttribute($controller, $config['initAttribute']);
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
        if (class_exists($clazz) && method_exists($clazz, 'instance')) {
            return call_user_func_array([$clazz, 'instance'], []);
        } else {
            throw new RouteException(' controller not found ');
        }
    }

    /**
     * 初始化控制器属性
     * @param $controller
     * @param $attributes
     */
    protected function initControllerAttribute(&$controller, $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($controller, $key)) {
                $controller->$key = $value;
            }
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


    protected function readTemplate($file, $params = [])
    {
        if(!is_array($params)) throw new ErrorException('配置项类型不正确,应为键值对数组');

        $template = new Template();
        foreach ($params as $name => $value) {
            is_string($name) && $template->$name = $value;
        }

        return $template->runTemplate($file);
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

        if ($config === null) return null;

        if (isset($config[App::$httpContext->request->requestUri])) {
            $this->routeConfig = $config[App::$httpContext->request->requestUri];
            $this->routeConfig['wildcard'] = false;
            return $this->routeConfig;
        }

        foreach ($config as $key => $value) {

            $pattern = $this->resolvePattern($key);

            $check = preg_match_all('/\{(.[a-zA-Z0-9]{0,})\}/', $key, $parameterKeys);
            if ($check === 0) continue;

            foreach ($parameterKeys[1] as $v) {
                $pattern = str_replace('\\{' . $v . '\\}', '[a-zA-Z0-9]{0,}', $pattern);
            }

            if (preg_match($pattern, App::$httpContext->request->requestUri)) {
                $this->routeConfig = $config[$key];
                $this->routeConfig['wildcard'] = true;
                $this->routeConfig['configUri'] = $key;
                return $this->routeConfig;
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

    /**
     * 获取请求url中的通配符参数的value
     * @param $configUri
     * @return array
     */
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