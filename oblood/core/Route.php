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
use oblood\web\provider\RouteManage;
use Whoops\Exception\ErrorException;

class Route extends Object
{

    public function execute()
    {
        //拦截器

        //执行控制器

        $routeConfig = Config::get('ROUTE');
        $routeClass = $this->createRoute($routeConfig['class'] , $routeConfig);
        return $routeClass->execute();
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
}