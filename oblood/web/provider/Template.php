<?php

namespace oblood\web\provider;


abstract class Template
{

    private $_attribute;

    public function __set($name, $value)
    {
        $this->_attribute[$name] = $value;
    }

    public function __get($name)
    {
        return isset($this->_attribute[$name]) ? $this->_attribute[$name] : '';
    }

    public function hasAttribute($name)
    {
        return isset($this->_attribute[$name]) ? true : false;
    }

    public function removeAttribute($name)
    {
        if (isset($this->_attribute[$name])) {
            unset($this->_attribute[$name]);
        }
    }

    /**
     * 编译模板
     * @return string
     */
    public abstract function compile($file);

}