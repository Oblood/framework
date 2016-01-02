<?php

namespace application;

use oblood\web\Controller;

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
        $this->assign('body'  , 'hello world');
        return $this->display('index');
    }

}