<?php

namespace Zuogechengxu\Wechat\MiniProgram;

use Zuogechengxu\Wechat\Kernel\ServiceContainer;

class Application extends ServiceContainer
{
    protected $providers = [
        Auth\ServiceProvider::class,
        AppCode\ServiceProvider::class,
        PhoneNumber\ServiceProvider::class,
        SubscribeMessage\ServiceProvider::class,
        UrlScheme\ServiceProvider::class,
        UrlLink\ServiceProvider::class,
        ShortLink\ServiceProvider::class,
    ];
}
