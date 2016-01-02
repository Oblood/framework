<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/27 0027
 * Time: 下午 11:08
 */

namespace oblood\core;


use Illuminate\Database\Capsule\Manager;
use oblood\library\Config;
use oblood\library\Debug;
use oblood\library\HttpContext;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

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
        require BASE_ROOT . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

        //错误汇总
        $this->registerError();

        //初始化容器
        $this->initContext();

        //初始化客户端请求数据
        $this->initClient();

        //初始化DB
        $this->initDb();

        //设置时区
        date_default_timezone_set(Config::get('DEFAULT_TIMEZONE'));

        $result = (new Route())->execute();

        //output  app end
        static::$httpContext->response->output($result);

    }

    protected function initContext()
    {
        static::$httpContext = new HttpContext();
    }

    protected function initClient()
    {
        //请求安全过滤
        array_walk_recursive($_GET, 'oblood\core\App::requestFilter');
        array_walk_recursive($_POST, 'oblood\core\App::requestFilter');
        array_walk_recursive($_REQUEST, 'oblood\core\App::requestFilter');
    }

    public function initDb()
    {
        $capsule = new Manager();
        $capsule->addConnection(Config::get('DB'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    /**
     * 加载格式为 包名/类名
     * 例1： application\HelloController 对应文件夹  /application/HelloController.php
     * 例2： application\Controller\HelloController 对应文件夹  /application/Controller/HelloController.php
     * @param $class
     */
    protected static function autoload($class)
    {
        $classArray = explode('\\', $class);

        $classPath = BASE_ROOT . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $classArray) . '.php';

        if (!in_array($classPath, get_required_files())) {
            if (is_file($classPath)) {
                require_once $classPath;
            }
        }
    }

    protected function registerError()
    {
        if(APP_DEBUG) {
            $whoops = new Run();

        } else {
            $whoops = new Debug();
        }

        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();
    }

    /**
     * 过滤查询特殊字符
     * @param $value
     */
    protected static function requestFilter(&$value)
    {
        // 过滤查询特殊字符
        if (preg_match('/^(EXP|NEQ|GT|EGT|LT|ELT|OR|XOR|LIKE|NOTLIKE|NOT BETWEEN|NOTBETWEEN|BETWEEN|NOTIN|NOT IN|IN)$/i', $value)) {
            $value .= ' ';
        }
    }
}