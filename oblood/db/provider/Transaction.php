<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/30 0030
 * Time: 上午 1:10
 */

namespace oblood\db\provider;


interface Transaction
{
    public function commit();

    public function rollBack();

    /**
     * 检查是否在一个事务内
     * 如果当前事务处于激活，则返回 TRUE ，否则返回 FALSE 。
     * @return boolean
     */
    public function inTransaction();
}