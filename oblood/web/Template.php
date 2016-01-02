<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-2
 * Time: 上午3:19
 */

namespace oblood\web;


use oblood\library\Config;
use Whoops\Exception\ErrorException;

class Template extends \oblood\web\provider\Template
{
    public function compile($_file)
    {
        ob_start();

        $_file = $_file . '.php';

        require APP_ROOT . Config::get('TEMPLATE_DIR') . $_file;

        $content = ob_get_contents();

        ob_clean();

        if(!empty(Config::get('TEMPLATE_LAYOUT')) && is_file(APP_ROOT . Config::get('TEMPLATE_LAYOUT'))) {
            require APP_ROOT . Config::get('TEMPLATE_LAYOUT');
            $content = ob_get_contents();
        }

        ob_end_clean();

        return $content;
    }



    public function runTemplate($_file)
    {
        $_file = APP_ROOT . Config::get('TEMPLATE_DIR') . $_file;

        if(!is_file($_file)) {
            throw new ErrorException('模板文件不存在 :' .$_file);
        }

        ob_start();

        require $_file;

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }
}