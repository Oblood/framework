<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 上午 1:34
 */

namespace oblood\library;
use oblood\core\Object;


/**
 * Class HttpContext
 * @package oblood\library
 * @property HttpRequest $request
 * @property HttpResponse $response
 * @property HttpHeader $header
 * @property HttpSession $session
 */
class HttpContext extends Object
{

    protected function getRequest()
    {
        return new HttpRequest();
    }

    protected function getResponse()
    {
        return new HttpResponse();
    }

    protected function getHeader()
    {
        return new HttpHeader();
    }

    protected function getSession()
    {
        return new HttpSession();
    }

}