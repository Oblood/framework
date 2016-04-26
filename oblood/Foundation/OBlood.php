<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/22
 * Time: 13:32
 */

namespace OBlood\Foundation;

/**
 * Class OBlood
 * @package OBlood\Foundation
 */
class OBlood implements \ArrayAccess
{
    /**
     * @var Application $app
     */
    public static $app;

    protected $attributes;

    public function __construct()
    {
        /**
         * 实例化容器，并且保存在此载体中
         */
        if (empty(static::$app)) {
            static::$app = new Application();
        }

        /**
         * 通过反射获取所有父类，并且获取他们的类名，通过这些类名来形成构造函数
         * 比如当前类的构造函数为 $this->OBlood()
         * 切记：Application类不能继承此类
         */
        $reflectionClass = new \ReflectionClass($this);
        $constructs[] = $reflectionClass->getShortName();

        $parentClass = $reflectionClass->getParentClass();
        while ($parentClass != false) {

            $constructs[] = $parentClass->getShortName();
            $parentClass = $parentClass->getParentClass();
        }

        /**
         * 这里采用倒叙的方式来进行排列，
         * 主要是以顶级父类为最先执行,一次向下
         */
        rsort($constructs);
        foreach ($constructs as $construct) {
            if (method_exists($this, $construct)) {
                call_user_func_array([$this, $construct], func_get_args());
            }
        }
    }

    /**
     * @param array $data 需要装载的数据
     */
    protected function loadData(array $data = [])
    {
        foreach ($data as $name => $value) {
            if (property_exists($this , $name)) {
                $this->$name = $value;
            }
        }
    }

    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }

    public function offsetGet($name)
    {
        return $this->attributes[$name];
    }

    public function offsetSet($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function offsetExists($offset)
    {
        return isset($this->attributes[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    public static function getInstance()
    {
        return new static(func_get_args());
    }
}