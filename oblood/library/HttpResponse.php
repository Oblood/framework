<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/28 0028
 * Time: 下午 5:35
 */

namespace oblood\library;

use oblood\core\App;
use oblood\core\Object;

class HttpResponse extends Object
{
    public static $returnType = self::OUTPUT_TYPE_HTML;
    public static $returnData;


    const OUTPUT_TYPE_JSON = 'json';
    const OUTPUT_TYPE_XML = 'xml';
    const OUTPUT_TYPE_HTML = 'html';
    const OUTPUT_TYPE_JSONP = 'jsonp';
    const OUTPUT_TYPE_SCRIPT = 'script';
    const OUTPUT_TYPE_TEXT = 'text';

    /**
     * 跳转立即执行
     * @param $url
     * @param int $statusCode
     * @return $this
     */
    public function redirect($url, $statusCode = 302)
    {
        header('Location: ' . $url, true, $statusCode);
        return $this;
    }

    /**
     * 程序执行结果输出给客户端，程序到此结束
     * @param $content
     * @param string $type
     */
    public function output($content, $type = '')
    {
        $headers = [
            'json' => 'application/json',
            'xml' => 'text/xml',
            'html' => 'text/html',
            'jsonp' => 'application/javascript',
            'script' => 'application/javascript',
            'text' => 'text/plain',
        ];

        $headerObject = App::$httpContext->header;

        $type = empty($type) ? static::$returnType : $type;

        if (!$headerObject->headerIsSend() && isset($headers[$type])) {
            $headerObject->addHeader('Content-type: '.$headers[$type].'; charset=' . Config::get('DEFAULT_CHARSET'));

            //屏蔽 X-Powered-By 不告诉别人这个是用php写的
            ini_get('expose_php') && $headerObject->addHeader('X-Powered-By:Oblood');
        }

        if (is_object($content) && $content instanceof HttpResponse) {
            $content = static::$returnData;
        }

        switch ($type) {
            case self::OUTPUT_TYPE_JSON :
            case self::OUTPUT_TYPE_JSONP:
                $content = json_encode($content);
                break;

            //容我想想
            case self::OUTPUT_TYPE_HTML:
            case self::OUTPUT_TYPE_TEXT:
            case self::OUTPUT_TYPE_SCRIPT:
                break;
            //Libxml 2.6.0,
            case self::OUTPUT_TYPE_XML :
                $content = json_decode(json_encode((array)simplexml_load_string($content)), true);
                break;
        }

        echo $content;
        exit;
        //程序到这里就结束了 end
    }
}