<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/16 0016
 * Time: 上午 3:08
 */

namespace oblood\core;


class Request extends Object{

    /**
     * 获取请求参数
     * @param $name
     * @return string
     */
    public function getParameter($name) {}

    /**
     * 获取全部的请求参数
     * 因为没有类型限制所以可能会出现 String[]的情况
     * @return array
     */
    public function getParameters(){}

    /**
     * 设置请求参数
     * @param $name
     * @param $value
     */
    public function setParameter($name , $value) {}

    /**
     * 过滤敏感字符
     * 将$_GET和$_POST请求参数中的敏感字符过滤掉
     */
    private function filterSensitiveCharacters() {

    }

}