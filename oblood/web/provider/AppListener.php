<?php
/**
 * Created by PhpStorm.
 * User: clover
 * Date: 16-1-5
 * Time: 下午12:36
 */

namespace oblood\web\provider;


interface AppListener
{
    /**
     * App容器初始化完成之后被调用
     */
    public function Initialized();

    /**
     * App容器销毁时被调用，也就是程序结束时被调用
     */
    public function destroy();
}