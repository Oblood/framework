<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/27 0027
 * Time: 下午 11:08
 */

namespace oblood\core;


use oblood\library\Config;
use oblood\library\HttpContext;

class App
{

    /**
     * @var HttpContext
     */
    public static $httpContext;

    public function run()
    {
        //自动加载
        spl_autoload_register('oblood\core\App::autoload');

        //错误汇总
//        register_shutdown_function(['oblood\core\Error' , 'fatalError']);//致命错误
//        set_error_handler(['oblood\core\Error' , 'errorHandler']);  //常规错误
//        set_exception_handler(['oblood\core\Error' , 'exceptionHandler']);  //常规异常

        $this->initClient();

        $this->initContext();

        exit((new Route())->execute());
    }

    protected function initClient() {

        //请求安全过滤
        array_walk_recursive($_GET,		'oblood\core\App::requestFilter');
        array_walk_recursive($_POST,	'oblood\core\App::requestFilter');
        array_walk_recursive($_REQUEST,	'oblood\core\App::requestFilter');

        //设置时区
        date_default_timezone_set(Config::get('DEFAULT_TIMEZONE'));
    }

    protected function initContext() {
        self::$httpContext = new HttpContext();
    }


    public static function autoload($class)
    {
        $classArray = explode('\\', $class);

        $classPath = BASE_ROOT . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $classArray) . '.php';

        if (!in_array($classPath, get_required_files())) {
            require_once $classPath;
            if (is_file($classPath)) {
                require_once $classPath;
            }
        }
    }

    /**
     * 过滤查询特殊字符
     * @param $value
     */
    protected static function requestFilter(&$value){
        // 过滤查询特殊字符
        if(preg_match('/^(EXP|NEQ|GT|EGT|LT|ELT|OR|XOR|LIKE|NOTLIKE|NOT BETWEEN|NOTBETWEEN|BETWEEN|NOTIN|NOT IN|IN)$/i',$value)){
            $value .= ' ';
        }
    }
}