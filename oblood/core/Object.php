<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/16 0016
 * Time: ���� 12:43
 */

namespace oblood\core;


/**
 * ����������ж���Ķ������࣬
 * ���ж���Ĺ��췽����Ϊ�������ƣ���javaһ��
 * ��������Ϊ��UserController ��ô���췽������Ϊ��UserController (ע:�丸��Ĺ��췽��Ҳ�ǻ�ִ�е�,ѭ��Ϊ�������࿪ʼ��������)
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

        //�ؼ��ǵ��������,�þ�û�ù�������for��
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
     * ħ����������������
     * ��ζ����������Ķ�̬��ħ�������Զ����� public�ķ���Ȩ��
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
     * ��̬�������ԣ�Ҳ���Ƕ�̬�ṩ��̬���Ե� get��set����
     * �������ܻ�û���
     * @param string $funcName ��������
     * @param array $parameters ��������
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
     * @return string ��ǰ��������ƣ����ռ�������Ŷ��
     */
    public static function className() {
        return get_called_class();
    }
}