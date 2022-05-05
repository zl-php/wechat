<?php

namespace Zuogechengxu\Wechat\Work;

use Zuogechengxu\Wechat\Kernel\ServiceContainer;

class Application extends ServiceContainer
{
    protected $providers = [
        Auth\ServiceProvider::class,
        OAuth\ServiceProvider::class,
        User\ServiceProvider::class,
        Jssdk\ServiceProvider::class,
        Message\ServiceProvider::class,
    ];

    protected $defaultConfig = [
        'http' => [
            'base_uri' => 'https://qyapi.weixin.qq.com/',
        ],
    ];

}