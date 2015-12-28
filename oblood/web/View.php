<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 下午 8:42
 */

namespace oblood\web;


use oblood\core\App;
use oblood\core\Object;
use oblood\library\Config;

class View extends Object
{
    /**
     * @var \SmartyBC
     */
    private $smarty;

    /**
     * 初始化 smarty 模板引擎
     */
    protected function View()
    {
        $smarty = new \SmartyBC();

        $smarty->setTemplateDir(Config::get('SMARTY_TEMPLATE_DIR'));
        $smarty->setCompileDir(Config::get('SMARTY_COMPILE_DIR'));
        $smarty->setCacheDir(APP_DEBUG ? 0 : Config::get('SMARTY_CACHE_DIR'));
        $smarty->setLeftDelimiter(Config::get('SMARTY_L_DELIM'));
        $smarty->setRightDelimiter(Config::get('SMARTY_R_DELIM'));
        $smarty->php_handling = $smarty::PHP_ALLOW;

        if (!APP_DEBUG) {
            $smarty->setCaching(true);
            $smarty->setCacheLifetime(Config::get('SMARTY_CACHE_TIME'));
        }


        $this->smarty = $smarty;
    }

    /**
     * 渲染页面,与smarty一致
     * @param null $template
     * @param null $cache_id
     * @param null $compile_id
     * @param null $parent
     * @return \oblood\library\HttpResponse
     */
    public function display($template = null, $cache_id = null, $compile_id = null, $parent = null)
    {
        return $this->fetch($template, $cache_id, $compile_id, $parent);
    }

    /**
     * 传递属性给模板
     * @param $tpl_var
     * @param null $value
     * @param bool|false $nocache
     * @return $this
     */
    public function assign($tpl_var, $value = null, $nocache = false)
    {
        $this->smarty->assign($tpl_var, $value, $nocache);
        return $this;
    }

    /**
     * 获取输出页面内容
     * 可用于生成模板，或生成自定义静态文件等
     * @param string $template
     * @param null $cache_id
     * @param null $compile_id
     * @param null $parent
     * @return string
     */
    public function fetch($template = null, $cache_id = null, $compile_id = null, $parent = null)
    {
        if (strpos($template, '.') === false) {
            $template .= Config::get('SMARTY_TEMPLATE_Suffix');
        }
        return $this->smarty->fetch($template, $cache_id, $compile_id, $parent);
    }

    /**
     * 清除已设置的模板变量
     * @param null $name
     */
    public function clearAssign($name = null)
    {
        if ($name === null) {
            $this->smarty->clear_all_assign();
        } else {
            $this->smarty->clear_assign($name);
        }
    }


}