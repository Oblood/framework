<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/30 0030
 * Time: 上午 2:12
 */

namespace oblood\db\provider;


interface Query
{

    /**
     * @return mixed
     */
    public function execute();

    /**
     * @param int|string $parameter
     * @param int|string $value
     * @return void
     */
    public function bindParam($parameter , $value);


}