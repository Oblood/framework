<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/29 0029
 * Time: 下午 11:47
 */

namespace oblood\db\provider;


interface DbManage
{
    public function openConnection();

    public function closeConnection();

    /**
     * @return Transaction
     */
    public function beginTransaction();

    /**
     * @param $sql
     * @return Query
     */
    public function createQuery($sql);

    /**
     * @param $sql
     * @return Statement
     */
    public function createUpdate($sql);


}