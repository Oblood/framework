<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-4
 * Time: 上午10:58
 */

namespace oblood\route;


use Whoops\Exception\ErrorException;

class RequestMapping
{

    public static $requestMappingConfig;
    public static $filterConfig;
    public static $errorConfig;
    private static $alias;


    /**
     * @param $url
     * @param array $option = [
     *                  'controller'   =>  '控制器名称,带空间命名',   [必填]
     *                  'action'       =>  'actionName',             [必填]
     *                  'initAttribute'=>   [],                     [可选]
     *                  'method'       =>   '默认不区分'          [可选]
     *              ]
     */
    public static function controller($url, $option = [])
    {
        $mappingController = new MappingController();

        foreach(static::$alias as $key => $value) {
            $url = str_replace($key , $value , $url);
        }

        $mappingController->setUrl($url);
        $mappingController->setController($option['controller']);
        $mappingController->setAction($option['action']);
        $mappingController->setMethod(isset($option['method']) ? $option['method'] : '');
        $mappingController->setInitAttribute(isset($option['initAttribute']) ? $option['initAttribute'] : []);


        static::$requestMappingConfig[] = $mappingController;
    }


    public static function view($url, $option = [])
    {
        $mappingView = new MappingView();

        $mappingView->setUrl($url);
        $mappingView->setTemplate($option['template']);
        $mappingView->setInitAttribute(isset($option['initAttribute']) ? $option['initAttribute'] : []);
        $mappingView->setMethod(isset($option['method']) ? $option['method'] : '');

        static::$requestMappingConfig[] = $mappingView;
    }


    public static function filter($url, $filterClass)
    {

    }

    /**
     * @param $option = [
     *              'url'       =>  '...'       三选一  ,此项优先
     *
     *              'template'  =>  '...',
     *
     *              'controller'    =>  '..',
     *              'action'        =>  '..'
     *        ]
     *
     * @throws ErrorException
     */
    public static function error($option)
    {
        if (isset($option['template'])) {
            static::$errorConfig[] = ['template' => $option['template']];
        } else if (isset($option['controller']) && isset($option['action'])) {
            static::$errorConfig[] = $option;
        }

        throw new ErrorException('必须填写 template 或者 controller和action');
    }

    /**
     * url别名
     * @param $alias
     * @param $value
     */
    public static function alias($alias , $value) {
        static::$alias[ '@' . $alias] = $value;
    }
}