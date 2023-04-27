<?php
/**
 * User：zhoulei
 * File: ServiceProvider.php
 * Date: 2023/4/27 9:22
 * Email: <lei_0668@sina.com>
 */
namespace Zuogechengxu\Wechat\MiniProgram\SubscribeMessage;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['subscribe_message'] = function ($app) {
            return new Client($app);
        };
    }
}
