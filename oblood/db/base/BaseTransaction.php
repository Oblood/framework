<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/30 0030
 * Time: 上午 1:15
 */

namespace oblood\db\base;


class BaseTransaction implements \oblood\db\provider\Transaction
{

    public function commit(){}

    public function rollBack(){}

    public function inTransaction(){}

}