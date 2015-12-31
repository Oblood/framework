<?php
namespace oblood\db;

use oblood\db\base\BaseStatement;
use oblood\db\base\BaseTransaction;
use \oblood\db\provider\DbManage;

class BaseDb implements DbManage
{
    public $dsn;

    public $username;

    public $password;

    public $pdoOption = [];

    /**
     * @var \PDO
     */
    public static $connection = null;


    public function openConnection()
    {
        if (static::$connection === null) {
            static::$connection = new \PDO($this->dsn, $this->username, $this->password, $this->pdoOption);
        }
    }

    public function closeConnection()
    {
        static::$connection = null;
    }

    public function beginTransaction()
    {
        static::$connection->beginTransaction();
        return new BaseTransaction();
    }


    public function createQuery($sql)
    {

    }

    public function createUpdate($sql)
    {
        return new BaseStatement($sql);
    }
}