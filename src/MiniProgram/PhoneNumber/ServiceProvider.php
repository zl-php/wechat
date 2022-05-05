<?php
/**
 * FILE: ServiceProvider.php.
 * User: zhoulei
 * Date: 2022/5/5 14:19
 */
namespace Zuogechengxu\Wechat\MiniProgram\PhoneNumber;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        isset($app['phone_number']) || $app['phone_number'] = function ($app) {
            return new Client($app);
        };
    }
}