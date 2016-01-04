<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/29 0029
 * Time: 下午 5:37
 */

namespace oblood\web\provider;
use oblood\route\provider\Mapping;

interface RouteManage
{
    /**
     * 返回筛选成功的路由对象
     * @return Mapping
     */
    public function execute();
}