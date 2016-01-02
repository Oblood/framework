<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 下午 8:42
 */

namespace oblood\web;

use oblood\core\Object;
use oblood\library\Config;

class View extends Object
{
    /**
     * @var \oblood\web\provider\Template
     */
    private $template;

    protected function View()
    {
        $this->template = new Template();
    }

    /**
     * @param string $template
     * @return string
     */
    public function display($template)
    {
        return $this->fetch($template);
    }

    /**
     * 传递属性给模板
     * @param $name
     * @param mixed $value
     */
    public function assign($name, $value = null)
    {
        $this->template->$name = $value;
    }

    /**
     * 获取输出页面内容
     * 可用于生成模板，或生成自定义静态文件等
     * @param string $template
     * @return string
     */
    public function fetch($template)
    {
        return $this->template->compile($template);
    }

    /**
     * 清除已设置的模板变量
     * @param string $name
     */
    public function removeAssign($name)
    {
        $this->template->removeAttribute($name);
    }

}