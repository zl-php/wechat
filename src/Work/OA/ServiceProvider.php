<?php
namespace Zuogechengxu\Wechat\Work\OA;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        isset($app['oa']) || $app['oa'] = function ($app) {
            return new Client($app);
        };
    }
}
