<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/25
 * Time: 13:05
 */

namespace OBlood\Http\Facades;


use OBlood\Foundation\Facade;
use OBlood\Foundation\OBlood;
use OBlood\Http\HttpHeader;
use OBlood\Http\HttpResponse;

class ResponseFacade extends Facade implements HttpResponse
{

    public $content;

    /**
     * @var HttpHeader $header
     */
    protected $header;


    public function ResponseFacade()
    {
        $this->header = OBlood::$app->make(HttpHeader::class);
    }

    /**
     * 添加响应头
     * @param $name
     * @param $value
     * @return mixed
     */
    public function addHeader($name, $value)
    {
        $this->header->add($name, $value);
    }

    /**
     * 设置状态码
     * @param $num
     * @return mixed
     */
    public function setStatusCode($num)
    {

    }

    /**
     * 设置编码
     * @param $charset
     * @return void
     */
    public function setCharset($charset = 'utf-8')
    {
        // TODO: Implement setCharset() method.
    }

    /**
     * 发送请求头
     * @return void
     */
    public function sendHeaders()
    {

    }

    /**
     * 发送结果到客户端
     * @return mixed
     */
    public function send()
    {
        if (is_array($this->content)) {
            echo json_encode($this->content);
        } else {
            echo $this->content;
        }
    }

    /**
     * 跳转
     * @param $url
     * @param $code
     * @return mixed
     */
    public static function redirect($url, $code = 302)
    {
        $response = new static();
    }


    protected $statusCode = [
        // 消息（1字头）
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        // 成功（2字头）
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        // 重定向（3字头）
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Temporarily Moved',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy', // 在最新版的规范中，306状态码已经不再被使用
        307 => 'Temporary Redirect',
        // 请求错误（4字头）
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        421 => 'There are too many connections from your internet address',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        449 => 'Retry With', // 由微软扩展，代表请求应当在执行完适当的操作后进行重试。
        // 服务器错误（5字头）
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended',
        600 => 'Unparseable Response Headers',
    ];
}