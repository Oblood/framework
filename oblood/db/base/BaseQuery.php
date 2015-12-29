<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/30 0030
 * Time: 上午 2:04
 */

namespace oblood\db\base;


use oblood\db\provider\Query;

class BaseQuery implements Query
{

    /**
     * @return mixed
     */
    public function execute()
    {
        // TODO: Implement execute() method.
    }

    /**
     * @param int|string $parameter
     * @param int|string $value
     * @return void
     */
    public function bindParam($parameter, $value)
    {
        // TODO: Implement bindParam() method.
    }
}