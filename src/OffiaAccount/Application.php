<?php
namespace Zuogechengxu\Wechat\OffiaAccount;

use Zuogechengxu\Wechat\Kernel\ServiceContainer;

class Application extends ServiceContainer
{
    protected $providers = [
        Auth\ServiceProvider::class,
        Jssdk\ServiceProvider::class,
    ];
}
