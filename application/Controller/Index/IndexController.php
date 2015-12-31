<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 上午 2:20
 */

namespace application\Controller\Index;

use oblood\web\Controller;


class IndexController extends Controller
{


    public function index()
    {

        $this->view->assign('username', 'dsa')->assign('user', 'dsaqq');
        return $this->view->display('index');
    }


}