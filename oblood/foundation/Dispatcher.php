<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/13
 * Time: 10:38
 */

namespace Oblood\Foundation;


use Oblood\Support\Facade\Response;

class Dispatcher extends Application
{

    /**
     * @return Response
     */
    public function request()
    {
        return $this->response;
    }



}