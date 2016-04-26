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

    /**
     * 添加响应头
     * @param $name
     * @param $value
     * @return mixed
     */
    public function addHeader($name, $value);

    /**
     * 设置状态码
     * @param $num
     * @return mixed
     */
    public function setStatusCode($num);

    /**
     * 设置编码
     * @param $charset
     * @return void
     */
    public function setCharset($charset);

    /**
     * 发送请求头
     * @return void
     */
    public function sendHeaders();

    /**
     * 发送结果到客户端
     * @return mixed
     */
    public function send();

    /**
     * 跳转
     * @param $url
     * @return mixed
     */
    public static function redirect($url);
}