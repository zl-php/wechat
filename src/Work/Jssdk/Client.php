<?php
namespace Zuogechengxu\Wechat\Work\Jssdk;

use Zuogechengxu\Wechat\Kernel\ServiceContainer;

class Client
{
    public function __construct(ServiceContainer $app, $accessToken = 1111)
    {
        parent::__construct($app, $accessToken);

        //$this->ticketEndpoint = \rtrim($app->config->get('http.base_uri'), '/').'/cgi-bin/get_jsapi_ticket';
    }

    public function test()
    {
        echo 1111111222;
    }
}