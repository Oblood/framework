<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/13
 * Time: 9:53
 */

namespace Oblood\Support\Facade;

use Oblood\Foundation\Application;

abstract class Facade
{
    /**
     * @var Application $app
     */
    protected static $app;

    protected $vars = [];

    public function __construct()
    {
        if (!static::$app) {
            static::$app = new Application();
        }
    }

    public function __get($name)
    {
        $methodName = 'get' . ucfirst($name);

        if (method_exists($this, $methodName) && !isset($this->vars[$name])) {
            $reflectionClass = new \ReflectionClass($this);

            $method = $reflectionClass->getMethod($methodName);

            $parameters = $method->getParameters();

            $param = [];

            foreach ($parameters as $parameter) {
                if (!is_null($parameter->getClass())) {
                    $param[$parameter->getName()] = static::$app->make($parameter->getClass()->getName());
                }
            }

            $this->vars[$name] = call_user_func_array([$this, $methodName], $param);
        }

        return $this->vars[$name];
    }

    public function __set($name, $value)
    {
        $this->vars[$name] = $value;
    }
}