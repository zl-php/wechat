<?php
namespace Zuogechengxu\Wechat\Work\OAuth;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        isset($app['oauth']) || $app['oauth'] = function ($app) {
            return new Client($app);
        };
    }
}