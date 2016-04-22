<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/22
 * Time: 11:27
 */

namespace OBlood\Http;


interface HttpRequest
{

    public function getSession();

    public function getCookie();

    public function getServer();

    public function getMethod();

    public function getQueryString();

    public function getRequestURL();

    public function getServerName();

    public function getServerPort();

    public function getParameter($name, $default = null);

    public function getParameters();

    public function getRemoteAddr();

    public function getRemoteHost();
}