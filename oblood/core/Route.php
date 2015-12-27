<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 上午 3:26
 */

namespace oblood\core;


use oblood\library\HttpRequest;

class Route
{


    protected function createController($uri, $routeMap)
    {

        if (isset($routeMap[$uri])) {

            $reflectionClass = new \ReflectionClass($routeMap[$uri]['controller']);
            return $reflectionClass->newInstance();
        } else {
            throw new \ReflectionException;
        }
    }

    protected function runAction($controller, $actionName)
    {
        call_user_func_array([$controller , $actionName] , []);

    }

    public function execute()
    {

        $uri = App::$httpContext->request->getUri();
        $routeMap = include BASE_ROOT . DIRECTORY_SEPARATOR . APP_NAME . DIRECTORY_SEPARATOR . 'routes.php';

        $controller = $this->createController($uri, $routeMap);

        $templode = include BASE_ROOT . '/application/View/index.php';
        return $templode;
    }
}