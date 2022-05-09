<?php
namespace Zuogechengxu\Wechat\Work\GroupRobot;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        isset($app['group_robot']) || $app['group_robot'] = function ($app) {
            return new Client($app);
        };
    }
}
