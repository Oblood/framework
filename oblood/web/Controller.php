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
use oblood\library\Config;
use oblood\library\HttpRequest;
use oblood\library\HttpResponse;

/**
 * Class Controller
 * @package oblood\web
 * @property HttpRequest $request
 * @property HttpResponse $response
 * @property View $view
 */
class Controller extends Object
{
    /**
     * @var string 模板布局文件
     * 填写此项可动态修改布局文件所在位置
     */
    protected $layout;

    /**
     * @var string 模板文件夹路径
     * 填写此项可动态修改模板文件夹路径所在位置
     */
    protected $templateDir;


    /**
     * 初始化控制器
     */
    protected function Controller()
    {
        isset($this->layout) && Config::set('TEMPLATE_LAYOUT', $this->layout);
        isset($this->templateDir) && Config::set('TEMPLATE_DIR', $this->templateDir);

    }

    protected function getView()
    {
        if(!$this->hasAttribute('view')) {
            $this->__set('view' , View::instance());
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

    /**
     * @param $template
     * @return string
     */
    public function display($template)
    {
        return $this->view->display($template);
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function assign($name, $value)
    {
        $this->view->assign($name, $value);
    }
}