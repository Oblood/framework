<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/16 0016
 * Time: 上午 12:43
 */

namespace oblood\core;


/**
 * 本框架中所有对象的顶级父类，
 * 所有对象的构造方法改为对象名称，与java一致
 * 例：类名为：UserController 那么构造方法名称为：UserController (注:其父类的构造方法也是会执行的,循序为顶级父类开始依次向下)
 * Class Object
 * @package oblood\core
 */
class Object {

    public function __construct () {

        $classes[] = self::className();

        while(true) {
            if($class = get_parent_class($classes[count($classes) - 1])) {
                $classes[] = $class;
            } else {
                break;
            }
        }

        $reflectionClass = new \ReflectionClass($this);

        //关键是倒叙见鬼了,好久没用过这样的for了
        for($i = count($classes) - 1 ; $i >= 0 ; $i--) {
            $method = array_pop(explode('\\' , $classes[$i]));
            if($reflectionClass->hasMethod($method)) {
                $reflectionMethod = $reflectionClass->getMethod($method);
                if(!$reflectionMethod->isPrivate()) {
                    call_user_func_array([$this , $method] , func_get_args());
                }
            }
        }

    }

    /**
     * 魔术方法的属性数组
     * 意味着所有子类的动态（魔术）属性都将是 public的访问权限
     * @var $_attribute
     */
    protected $_attribute;


    public function __set($name , $value) {
        $this->_attribute[$name] = $value;
    }

    public function __get($name) {
        return $this->_attribute[$name];
    }

    /**
     * 动态调用属性，也就是动态提供动态属性的 get和set方法
     * 其他功能还没想好
     * @param string $funcName 方法名称
     * @param array $parameters 参数名称
     * @return mixed
     * @throws \ErrorException
     */
    public function __call($funcName , array $parameters) {

        $attributeProfit = substr($funcName , 0 , 3);
        $attributeName = substr($funcName , 3 , strlen($funcName));
        $attributeName = lcfirst($attributeName);

        if($attributeProfit == 'get') {
            if(isset($this->_attribute[$attributeName])) {
                return $this->__get($attributeName);
            }
        } else if($attributeProfit == 'set') {
            $this->__set($attributeName , current($parameters));
        } else {
            throw new \ErrorException;
        }
    }

    /**
     * @return string 当前对象的名称（带空间命名的哦）
     */
    public static function className() {
        return get_called_class();
    }
}