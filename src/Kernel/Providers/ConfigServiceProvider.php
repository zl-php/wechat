<?php
namespace Zuogechengxu\Wechat\Kernel\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Zuogechengxu\Wechat\Kernel\Config;

class ConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        !isset($pimple['config']) && $pimple['config'] = function ($app) {
            return new Config($app->getConfig());
        };
    }
}