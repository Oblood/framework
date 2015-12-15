<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/16 0016
 * Time: 上午 12:43
 */

namespace oblood\core;


class Object {

    /**
     * 魔术方法的属性数组
     * @var
     */
    public $_attribute;


    public function __set($name , $value) {
        
    }

    public function __get($name) {

    }

    public function __call($funcName , array $args) {



    }
}