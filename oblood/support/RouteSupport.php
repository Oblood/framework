<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/13
 * Time: 11:52
 */

namespace Oblood\Support;


interface RouteSupport
{
    const CONTROLLER = 1;
    const TEMPLATE = 2;
    const RESULT = 3;

    public function mappingWay();

    public function findController();

    public function findAction();

    public function findParam();

    public function findTemplate();

    public function findResult();
}