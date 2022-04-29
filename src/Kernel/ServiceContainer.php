<?php

namespace Zuogechengxu\Wechat\Kernel;

use Pimple\Container;
use Zuogechengxu\Wechat\Kernel\Providers\HttpClientServiceProvider;
use Zuogechengxu\Wechat\Kernel\Providers\ConfigServiceProvider;

class ServiceContainer extends Container
{
    protected $providers = [];

    protected $defaultConfig = [];

    protected $userConfig = [];

    public function __construct(array $config = [])
    {
        parent::__construct();

        $this->userConfig = $config;

        $this->registerProviders($this->getProviders());
    }

    // 获取配置参数
    public function getConfig()
    {
        $base = [
            'http' => [
                'timeout' => 10,
                'base_uri' => 'https://api.weixin.qq.com/',
            ],
        ];

        return array_replace_recursive($base, $this->defaultConfig, $this->userConfig);
    }

    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }

    public function getProviders()
    {
        return array_merge([
            ConfigServiceProvider::class,
            HttpClientServiceProvider::class,
        ], $this->providers);
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }
}