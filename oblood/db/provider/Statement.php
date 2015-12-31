<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/30 0030
 * Time: 上午 1:41
 */

namespace oblood\db\provider;


interface Statement
{

    public function execute();

    /**
     * @param int|string $parameter
     * @param int|string $value
     * @return void
     */
    public function bindParam($parameter , $value);

    /**
     * 上一次插入的id
     * @return int
     */
    public function lastInsertId();

    /**
     * 获取上一次 更新|删除 影响的行数
     * @return int
     */
    public function rowCount();

}