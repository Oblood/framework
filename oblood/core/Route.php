<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 上午 3:26
 */

namespace oblood\core;


use oblood\exception\RouteException;
use oblood\library\Config;
use oblood\library\HttpRequest;
use oblood\library\RequestMethod;
use oblood\library\Web;

class Route extends Object
{

    public function execute()
    {
        require BASE_ROOT . DIRECTORY_SEPARATOR . APP_NAME . DIRECTORY_SEPARATOR . 'routes.php';

        //拦截器

        //执行控制器
        $requestRouteConfig = $this->requestRouteConfig();
        $controller = $this->createController($requestRouteConfig['controller']);

        return $this->runAction($controller, $requestRouteConfig['action']);
    }

    /**
     * 创建一个控制器类
     * @param $clazz
     * @return mixed
     */
    protected function createController($clazz)
    {
        return call_user_func_array([$clazz, 'instance'], []);
    }

    protected function runAction($controller, $actionName)
    {
        if (!method_exists($controller, $actionName)) {
            throw new RouteException(' action不存在 ');
        }

        //执行action的前置方法
        if (method_exists($controller, Config::get('ACTION_BEFORE') . $actionName)) {
            if (call_user_func_array([$controller, Config::get('ACTION_BEFORE') . $actionName], []) === false) {
                exit;
            }
        }

        $result = call_user_func_array([$controller, $actionName], App::$httpContext->request->get());

        //执行action的后置方法
        if (method_exists($controller, Config::get('ACTION_AFTER') . $actionName)) {
            call_user_func_array([$controller, Config::get('ACTION_AFTER') . $actionName], []);
        }

        return $result;
    }

    /**
     * 获取需要执行控制器配置项
     * @return array
     */
    protected function requestRouteConfig()
    {
        $uri = App::$httpContext->request->requestUri;

        switch (App::$httpContext->request->method) {

            case RequestMethod::GET    :
                return Web::$requestGet [$uri];
                break;
            case RequestMethod::POST   :
                return Web::$requestPost[$uri];
                break;
            case RequestMethod::PUT    :
                return Web::$requestPut [$uri];
                break;
            case RequestMethod::DELETE :
                return Web::$requestDelete[$uri];
                break;
            default :
                return Web::$requestGet[$uri];
        }
    }


}