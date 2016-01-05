<?php
/**
 * Created by PhpStorm.
 * User: clover
 * Date: 16-1-5
 * Time: 下午1:40
 */

namespace oblood\route;


use oblood\web\provider\AppListener;

class InitRoutes implements AppListener
{

    /**
     * App容器初始化完成之后被调用
     */
    public function Initialized()
    {
        require BASE_ROOT . DIRECTORY_SEPARATOR . APP_NAME . DIRECTORY_SEPARATOR . 'routes.php';
    }

    /**
     * App容器销毁时被调用，也就是程序结束时被调用
     */
    public function destroy()
    {

    }
}