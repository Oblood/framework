<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-2
 * Time: 上午3:19
 */

namespace oblood\web;


use oblood\library\Config;

class Template extends \oblood\web\provider\Template
{
    public function compile($file)
    {
        ob_start();

        $file = $file . '.php';

        require APP_ROOT . Config::get('TEMPLATE_DIR') . $file;

        $content = ob_get_contents();

        ob_clean();

        if(!empty(Config::get('TEMPLATE_LAYOUT')) && is_file(APP_ROOT . Config::get('TEMPLATE_LAYOUT'))) {
            require APP_ROOT . Config::get('TEMPLATE_LAYOUT');
            $content = ob_get_contents();
        }

        ob_end_clean();

        return $content;
    }
}