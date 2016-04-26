<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/25
 * Time: 13:09
 */

namespace OBlood\Http;

use OBlood\Foundation\OBlood;
use OBlood\Http\Facades\HeaderFacade;
use OBlood\Http\Facades\RequestFacade;
use OBlood\Http\Facades\ResponseFacade;
use OBlood\Http\HttpRequest;
use OBlood\Http\HttpResponse;
use OBlood\Http\HttpHeader;

class HttpProviders
{
    public $providers = [
        HttpRequest::class => RequestFacade::class,
        HttpResponse::class => ResponseFacade::class,
        HttpHeader::class => HeaderFacade::class
    ];

    public function handle()
    {
        foreach($this->providers as $abstract => $provider) {
            OBlood::$app->bind($abstract , $provider);
        }
    }
}