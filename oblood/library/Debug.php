<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-2
 * Time: 上午5:18
 */

namespace oblood\library;


use oblood\core\App;
use Whoops\Run;

class Debug extends Run
{
    public function handleException(\Exception $exception)
    {
        exit;
    }

    public function handleError($level, $message, $file = null, $line = null)
    {
        exit;
    }

    public function handleShutdown()
    {
        exit;
    }
}