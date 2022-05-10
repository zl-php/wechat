<?php
namespace Zuogechengxu\Wechat\OffiaAccount\Jssdk;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        !isset($app['jssdk']) && $app['jssdk'] = function ($app) {
            return new Client($app);
        };
    }
}
