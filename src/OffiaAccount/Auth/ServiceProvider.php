<?php
namespace Zuogechengxu\Wechat\OffiaAccount\Auth;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        !isset($app['access_token']) && $app['access_token'] = function ($app) {
            return new AccessToken($app);
        };
    }
}
