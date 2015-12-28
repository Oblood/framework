<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 下午 6:35
 */

namespace oblood\web;

use oblood\core\Object;

/**
 * Class Controller
 * @package oblood\web
 * @property View $view
 */
class Controller extends Object
{

    protected function getView()
    {
        if (!$this->hasAttribute('view')) {
            $this->__set('view' , View::instance());
        }
        return $this->__get('view');
    }
}