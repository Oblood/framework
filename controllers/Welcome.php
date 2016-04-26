<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/26
 * Time: 15:04
 */

namespace controllers;


use OBlood\Http\HttpRequest;

class Welcome
{
    public function index(HttpRequest $request)
    {
        return $request::getAction();
    }
}