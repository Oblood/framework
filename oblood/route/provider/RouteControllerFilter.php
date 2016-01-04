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
interface RouteControllerFilter
{
    /**
     * @param MappingController|MappingView $mapping
     * @return boolean
     */
    public function doFilter($mapping);


}