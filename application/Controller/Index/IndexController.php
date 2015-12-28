<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 上午 2:20
 */

namespace application\Controller\Index;

use oblood\core\App;
use oblood\web\Controller;


class IndexController extends Controller
{

    public function _before_index() {

    }

    public function index()
    {
        $this->view->assign('username' , 'dsa')->assign('user' , 'dsaqq');
        return $this->view->display('s/index');
    }

    public function _after_index() {

    }

    public function s() {

    }

}