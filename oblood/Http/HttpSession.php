<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/22
 * Time: 12:35
 */

namespace OBlood\Http;


interface HttpSession
{
    public function getAttributes();

    public function getAttribute($name);

    public function setAttribute($name , $value);

    public function removeAttribute($name);

    /**
     * 销毁session
     * @return mixed
     */
    public function destroy();

    /**
     * 获取session_id
     * @return string
     */
    public function getId();

    /**
     * @param $sessionId
     * @return mixed
     */
    public function setId($sessionId);

    /**
     * 开启session
     * @return mixed
     */
    public function start();

    /**
     * 清空session
     * @return void
     */
    public function clear();
}