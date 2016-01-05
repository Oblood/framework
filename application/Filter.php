<?php

namespace application;


use oblood\core\App;
use oblood\web\provider\RouteFilterManager;

class Filter implements RouteFilterManager
{

    /**
     * 拦截
     * @return boolean 返回true将继续执行，false，程序终止
     */
    public function doFilter()
    {
        App::$httpContext->response->redirect('/hello/say');
        return false;
    }

    /**
     * 拦截之前执行
     */
    public function filterBefore()
    {
        // TODO: Implement filterBefore() method.
    }

    /**
     * 拦截之后执行
     */
    public function filterAlter()
    {
        // TODO: Implement filterAlter() method.
    }
}