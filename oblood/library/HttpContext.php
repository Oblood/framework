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
 *
 */
class HttpContext extends Object
{

    public $response;

    public $header;

    public $session;

    public function getRequest() {

        return new HttpRequest();
    }
}