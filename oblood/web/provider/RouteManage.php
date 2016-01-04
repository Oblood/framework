<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/29 0029
 * Time: 下午 5:37
 */

namespace oblood\web\provider;

interface RouteManage
{
    /**
     * 返回筛选成功的路由对象
     * @return mixed
     */
    public function execute();
}