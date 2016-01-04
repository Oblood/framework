<?php

namespace application;

use oblood\route\ObloodRoute;
use oblood\web\Controller;
use Whoops\Exception\ErrorException;


/**
 * 当然，控制器你可以放在任何地方,不一定放在这里
 * 但是要注意空间命名哦,详情见自动加载
 * Class HelloController
 * @package application
 */
class HelloController extends Controller
{
    public $title;

    public $body;

    public function say()
    {


        $this->assign('title' , $this->title);
        $this->assign('body'  , $this->body);
        return $this->display('index');
    }

    public function sayId($id = 213)
    {
        $this->assign('title' , $this->title);
        $this->assign('body'  , $id);
        return $this->display('index');
    }

}