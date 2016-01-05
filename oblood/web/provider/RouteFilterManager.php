<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-4
 * Time: 下午1:57
 */

namespace oblood\route\provider;
use oblood\route\MappingController;
use oblood\route\MappingView;


/**
 * 路由与控制器的中间拦截器
 * Interface RouteControllerFilter
 * @package oblood\route\provider
 */
interface RouteFilterManager
{
    /**
     * 拦截
     * @return boolean 返回true将继续执行，false，程序终止
     */
    public function doFilter();

    /**
     * 拦截之前执行
     */
    public function filterBefore();

    /**
     * 拦截之后执行
     */
    public function filterAlter();

}