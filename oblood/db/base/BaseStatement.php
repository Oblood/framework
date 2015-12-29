<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/30 0030
 * Time: 上午 2:05
 */

namespace oblood\db\base;


use oblood\db\provider\Statement;

class BaseStatement implements Statement
{
    public $sql;

    private $param;

    public function __construct($sql)
    {
        $this->sql = $sql;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }

    public function bindParam($parameter, $value)
    {
        $this->param[$parameter] = $value;
    }

    public function lastInsertId()
    {
        // TODO: Implement lastInsertId() method.
    }

    public function rowCount()
    {
        // TODO: Implement rowCount() method.
    }
}