<?php
namespace Zuogechengxu\Wechat\Work\User;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        isset($app['user']) || $app['user'] = function ($app) {
            return new Client($app);
        };
    }
}