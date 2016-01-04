<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-4
 * Time: 上午11:43
 */

namespace oblood\route;


use oblood\core\App;
use oblood\core\Object;
use oblood\route\provider\Mapping;
use oblood\web\provider\RouteManage;

class ObloodRoute extends Object implements RouteManage
{

    public function execute()
    {
        require BASE_ROOT . DIRECTORY_SEPARATOR . APP_NAME . DIRECTORY_SEPARATOR . 'routes.php';

        $requestUrl = App::$httpContext->request->requestUri;

        foreach (RequestMapping::$requestMappingConfig as $key => $value) {

            /**
             * @var $value Mapping
             */

            if(!empty($value->getMethod()) && App::$httpContext->request->method != $value->getMethod()) {
                continue;
            }

            if ($value->getUrl() == $requestUrl) {
                return RequestMapping::$requestMappingConfig[$key];
            }

            $pattern = $this->resolvePattern($value->getUrl());

            $parameterKeys = $this->requestParameterKeys($value->getUrl());

            foreach ($parameterKeys as $v) {
                $pattern = str_replace('\\{' . $v . '\\}', '[a-zA-Z0-9]{0,}', $pattern);
            }

            if ($row =preg_match($pattern, $requestUrl)) {

                $parameterValues = $this->requestParameterValues($value->getUrl(), $requestUrl, $parameterKeys);

                $parameters = $this->resolveRequestParameters($parameterKeys , $parameterValues);

                $this->resolveParametersWildcard($parameters , $value);

                return RequestMapping::$requestMappingConfig[$key];
            }
        }

        return null;
    }

    protected function resolveParametersWildcard($parameters , $className) {

        $reflectionClass = new \ReflectionClass($className);
        $reflectionProperties = $reflectionClass->getProperties();

        foreach($reflectionProperties as $value) {
            if(!$value->isPublic()) $value->setAccessible(true);

            $classPropertyValue = $value->getValue($className);

            foreach($parameters as $k => $v) {

                $wildcard = '{' . $k . '}';
                $value->setValue($className , str_replace($wildcard, $v, $classPropertyValue));
            }
        }


        if($reflectionClass->hasMethod('setActionParams')) {
            $className->setActionParams($parameters);
        }

    }

    /**
     * 获取请求url中的通配符参数的value
     * @param
     * @return array
     */
    protected function resolveRequestParameters($parameterKeys, $parameterValues)
    {
        $result = [];
        for ($i = 0; $i < count($parameterKeys); $i++) {
            $result[$parameterKeys[$i]] = $parameterValues[$i];
        }

        return $result;
    }

    /**
     * 获取请求url中的通配符参数的key
     * @param $configUri
     * @return array
     */
    protected function requestParameterKeys($configUri)
    {

        if (preg_match_all('/\{(.[a-zA-Z0-9]{0,})\}/', $configUri, $parameterKeys) === 0) {
            return [];
        }

        array_shift($parameterKeys);
        $result = array_shift($parameterKeys);

        return $result;
    }

    /**
     * 获取请求url中的通配符参数的value
     * @param $configUrl
     * @param $requestUrl
     * @param array $parameterKeys
     * @return mixed
     */
    protected function requestParameterValues($configUrl, $requestUrl, $parameterKeys = [])
    {

        $pattern = $this->resolvePattern($configUrl);
        $parameterKeys = empty($parameterKeys) ? $this->requestParameterKeys($configUrl) : $parameterKeys;

        foreach ($parameterKeys as $value) {
            $pattern = str_replace('\\{' . $value . '\\}', '(.*)', $pattern);
        }

        preg_match($pattern, $requestUrl, $parameterValues);

        array_shift($parameterValues);

        return $parameterValues;
    }

    /**
     * 将字符串转换成匹配该字符串的正则表达式
     * @param string $str
     * @return string
     */
    protected function resolvePattern($str)
    {
        $array = ['.', '/', '+', '*', '?', '[', '^', ']', '$', '(', ')', '{', '}', '=', '!', '<', '>', '|', ':'];
        foreach ($array as $value) {
            if (strpos($str, $value) !== false) {
                $str = str_replace($value, '\\' . $value, $str);
            }
        }

        return '/^' . $str . '$/';
    }
}