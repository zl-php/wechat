<?php
namespace Zuogechengxu\Wechat\Work\Department;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        isset($app['department']) || $app['department'] = function ($app) {
            return new Client($app);
        };
    }
}
