<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/22
 * Time: 14:10
 */

namespace OBlood\Foundation\Facades;


use controllers\Admin;
use FastRoute\RouteCollector;
use OBlood\Exception\RouteException;
use OBlood\Foundation\OBlood;
use OBlood\Http\HttpProviders;
use OBlood\Http\HttpRequest;
use OBlood\Http\HttpResponse;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class Dispatcher extends OBlood
{
    protected $controllerNamespace;

    protected $defaultRoute;

    public function Dispatcher($bootstrap)
    {
        $this->loadData(array_shift($bootstrap));
    }

    /**
     * 程序开始的入口
     * @param HttpProviders $providers
     * @return HttpResponse
     */
    public function request(HttpProviders $providers)
    {
        $this->handleBefore();

        $providers->handle();

        $response = static::$app->make(HttpResponse::class);
        $response->content = static::$app->call([$this, 'handleAction']);

        return $response;
    }

    /**
     * 注册各种各样的东西
     */
    public function handleBefore()
    {
        //注册自动加载（两个自动加载：一个composer的，一个自己的）
        spl_autoload_register([Dispatcher::class, 'autoload']);

        //注册 whoops 错误提示
        $whoops = static::$app->make(Run::class);
        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();
    }

    /**
     * 执行http操作，解析路由执行控制器
     * @param HttpRequest $request
     * @return mixed
     * @throws RouteException
     * @throws \Exception
     */
    public function handleAction(HttpRequest $request)
    {
        $route = \FastRoute\simpleDispatcher(function (RouteCollector $route) {
            $route->addRoute('*', '/', $this->defaultRoute);
            $route->addRoute('*', '{controller:(?![/?]{2,})[a-zA-Z/]{1,}}/{action:[a-zA-Z]{1}[a-zA-Z0-9]{0,}}', '');
        });

        $result = $route->dispatch($request->getMethod(), $request->getBaseURI());
        if (!array_shift($result)) {
            throw new RouteException('invalid url');
        }

        $this->resolveAction($result, $request);

        return $this->runController($request);
    }

    /**
     * 确定控制器，并且将处理好的控制器名称和操作名称丢到request里面
     * @param $dispatchResult
     * @param HttpRequest $request
     */
    protected function resolveAction($dispatchResult, HttpRequest $request)
    {
        list($handle, $parameters) = $dispatchResult;

        if (!empty($handle)) {
            $handle = explode('/', $handle);
            $parameters['action'] = array_pop($handle);
            $parameters['controller'] = implode('/', $handle);
        }

        $request::$action = $parameters['action'];
        $request::$controller = $parameters['controller'];
    }

    /**
     * 执行控制器并且返回结果
     * @param HttpRequest $request
     * @return mixed
     * @throws RouteException
     */
    public function runController(HttpRequest $request)
    {
        $controller = $this->controllerNamespace . str_replace('/', '\\', $request::getController());

        if (!class_exists($controller)) {
            throw new RouteException('controller not found');
        }

        $controller = static::$app->make($controller);

        if (method_exists($controller, $request::getAction())) {
            $reflectionClass = new \ReflectionClass($controller);
            $method = $reflectionClass->getMethod($request::getAction());

            $methodParameters = [];
            foreach ($method->getParameters() as $value) {
                if ($value->getClass() != null) {
                    $methodParameters[$value->getName()] = static::$app->make($value->getClass()->getName());
                } else if ($request->hasParameter($value->getName())) {
                    $methodParameters[$value->getName()] = $request->getParameter($value->getName());
                }
            }

            return call_user_func_array([$controller , $request::getAction()] , $methodParameters);
        }

        throw new RouteException('action not found');
    }

    /**
     * 框架本身的自动加载
     * @param string $class
     */
    public static function autoload($class)
    {
        $classFile = BASIC_ROOT . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

        if (is_file($classFile) && !in_array($classFile, get_required_files())) {
            require $classFile;
        }
    }
}