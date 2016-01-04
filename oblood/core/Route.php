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
use oblood\route\MappingController;
use oblood\route\MappingView;
use oblood\route\provider\RouteControllerFilter;
use oblood\web\Controller;
use oblood\web\provider\RouteManage;
use oblood\web\Template;
use Whoops\Exception\ErrorException;

class Route extends Object
{

    public function execute()
    {
        //筛选路由
        $routeConfig = Config::get('ROUTE');
        $mappingObject = $this->createRoute($routeConfig['class'], $routeConfig)->execute();

        //拦截器
        $routeControllerFilterConfig = Config::get('ROUTE_CONTROLLER_FILTER');
        if (isset($routeControllerFilterConfig['class']) && !empty($routeControllerFilterConfig['class'])) {
            $routeControllerFilter = $this->createFilter($routeControllerFilterConfig['class']);
            if (!$routeControllerFilter->doFilter($mappingObject)) {
                return null;
            }
        }

        //执行控制器
        if ($mappingObject instanceof MappingController) {
            return $this->runControllerAction($mappingObject);
        } elseif ($mappingObject instanceof MappingView) {
            return $this->runTemplate($mappingObject);
        } else {
            return null;
        }
    }

    /**
     * 创建需要使用的路由class
     * @param string $routeClass class名称（带空间命名的哦）
     * @param array $option
     * @return RouteManage
     */
    protected function createRoute($routeClass, $option = [])
    {
        if (method_exists($routeClass, 'instance')) {
            return call_user_func_array([$routeClass, 'instance'], $option);
        } else {
            return (new \ReflectionClass($routeClass))->newInstance($option);
        }
    }

    /**
     *
     * @param $clazz
     * @return RouteControllerFilter object
     * @throws ErrorException
     */
    protected function createFilter($clazz)
    {
        if (class_exists($clazz)) {
            $reflectionClass = new \ReflectionClass($clazz);
            return $reflectionClass->newInstance();
        } else {
            throw new ErrorException('没有找到 :' . $clazz);
        }
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

    /**
     * 运行控制器的action，返回action处理的返回结果
     * @param  MappingController $mappingObject
     * @return mixed
     * @throws ErrorException
     * @throws RouteException
     */
    protected function runControllerAction($mappingObject)
    {
        $controller = $this->createController($mappingObject->getController());

        $this->initControllerAttribute($controller , $mappingObject->getInitAttribute());

        if (!method_exists($controller, $mappingObject->getAction())) {
            throw new ErrorException('action 没有找到');
        }

        //执行action的前置方法
        if (method_exists($controller, Config::get('ACTION_BEFORE') . $mappingObject->getAction())) {
            if (call_user_func_array([$controller, Config::get('ACTION_BEFORE') . $mappingObject->getAction()]
                    , $mappingObject->getActionParams()) === false
            ) {
                exit;
            }
        }

        $result = call_user_func_array([$controller, $mappingObject->getAction()],$mappingObject->getActionParams());

        //执行action的后置方法
        if (method_exists($controller, Config::get('ACTION_AFTER') . $mappingObject->getAction())) {
            call_user_func_array([$controller, Config::get('ACTION_AFTER') . $mappingObject->getAction()], $mappingObject->getActionParams());
        }

        return $result;

    }

    /**
     * 直接读取模板,将初始化数据带入模板
     * @param MappingView $mappingObject
     * @return mixed|string
     * @throws ErrorException
     */
    protected function runTemplate($mappingObject) {

        $template = new Template();

        foreach($mappingObject->getInitAttribute() as $key => $value) {
            $template->$key = $value;
        }

        return $template->runTemplate($mappingObject->getTemplate());
    }
}