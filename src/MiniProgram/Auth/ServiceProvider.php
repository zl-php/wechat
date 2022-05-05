<?php
/**
 * FILE: ServiceProvider.php.
 * User: zhoulei
 * Date: 2022/5/5 14:19
 */
namespace Zuogechengxu\Wechat\MiniProgram\Auth;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        !isset($app['access_token']) && $app['access_token'] = function ($app) {
            return new AccessToken($app);
        };

        !isset($app['auth']) && $app['auth'] = function ($app) {
            return new Client($app);
        };
    }
}