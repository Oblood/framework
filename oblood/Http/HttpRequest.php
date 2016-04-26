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

    public function getMethod();

    public function getQueryString();

    public function getBaseURI();

    public function getRequestURI();

    public function getReferrer();

    public function getServerName();

    public function getServerPort();

    public function getParameter($name, $default = null);

    public function getParameters();

    public function hasParameter($name);

    public function getRemoteAddr();

    public function getRemoteHost();

    public static function getController();

    public static function getAction();
}