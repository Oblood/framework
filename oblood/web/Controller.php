<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 下午 6:35
 */

namespace oblood\web;

use oblood\core\App;
use oblood\core\Object;
use oblood\library\HttpRequest;
use oblood\library\HttpResponse;

/**
 * Class Controller
 * @package oblood\web
 * @property View $view
 * @property HttpRequest $request
 * @property HttpResponse $response
 */
class Controller extends Object
{
    /**
     * 获取视图
     * @return View
     * @throws \ErrorException
     */
    protected function getView()
    {
        if (!$this->hasAttribute('view')) {
            $this->__set('view', View::instance());
        }
        return $this->__get('view');
    }

    /**
     * 获取请求
     * @return HttpRequest
     */
    protected function getRequest()
    {
        return App::$httpContext->request;
    }

    /**
     * 获取响应
     * @return HttpResponse
     */
    protected function getResponse()
    {
        return App::$httpContext->response;
    }
}