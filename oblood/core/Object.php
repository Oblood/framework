<?php


namespace oblood\core;

/**
 * 本框架中所有对象的顶级父类，
 * 所有对象的构造方法改为对象名称，与java一致
 * 例：类名为：UserController 那么构造方法名称为：UserController (注:其父类的构造方法也是会执行的,循序为顶级父类开始依次向下)
 * Class Object
 */
abstract class Object
{

    private $_attribute;

    public function __construct()
    {

        $classes[] = self::className();

        while (true) {
            if ($class = get_parent_class($classes[count($classes) - 1])) {
                $classes[] = $class;
            } else {
                break;
            }
        }

        $reflectionClass = new \ReflectionClass($this);

        for ($i = count($classes) - 1; $i >= 0; $i--) {
            $method = array_pop(explode('\\', $classes[$i]));
            if ($reflectionClass->hasMethod($method)) {
                $reflectionMethod = $reflectionClass->getMethod($method);
                if (!$reflectionMethod->isPrivate()) {
                    call_user_func_array([$this, $method], func_get_args());
                }
            }
        }

    }

    public function __set($name, $value)
    {
        $this->_attribute[$name] = $value;
    }

    public function __get($name)
    {
        if (isset($this->_attribute[$name])) {
            return $this->_attribute[$name];
        } else {
            $method = 'get' . ucfirst($name);
            $reflectionClass = new \ReflectionClass($this);

            if ($reflectionClass->hasMethod($method) && $reflectionClass->getMethod($method)->isPublic()) {

                $this->_attribute[$name] = call_user_func_array([$this, $method], []);
                return $this->_attribute[$name];
            } else {
                throw new \ErrorException();
            }
        }
    }

    /**
     * 获取当前类名
     * @return string
     */
    public static function className()
    {
        return get_called_class();
    }
}