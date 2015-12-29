<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 上午 2:20
 */

namespace application\Controller\Index;

use oblood\core\App;
use oblood\db\BaseDb;
use oblood\web\Controller;


class IndexController extends Controller
{



    public function index($qqq=111,$www=22)
    {

        $BaseDb = new BaseDb();
//        $BaseDb->openConnection();
//        $Transaction = $BaseDb->beginTransaction();
//        $Transaction->rollBack();

        $this->view->assign('username', 'dsa')->assign('user', 'dsaqq');
        return $this->view->display('s/index');
    }



    public function s()
    {

        return "daskldaskd";
    }

}