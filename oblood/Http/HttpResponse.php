<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/22
 * Time: 12:55
 */

namespace OBlood\Http;


interface HttpResponse
{

    public function getHeaders();

    /**
     * 设置响应头
     * @param $name
     * @param $value
     * @return mixed
     */
    public function setHeader($name , $value);

    /**
     * 设置状态码
     * @param $num
     * @return mixed
     */
    public function setStatus($num);

    /**
     * 发送结果到客户端
     * @return mixed
     */
    public function send();

    public function redirect($url);
}