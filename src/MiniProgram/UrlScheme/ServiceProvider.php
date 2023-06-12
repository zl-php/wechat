<?php
/**
 * FILE: ServiceProvider.php.
 * User: zhoulei
 * Date: 2022/5/5 14:19
 */
namespace Zuogechengxu\Wechat\MiniProgram\UrlScheme;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        isset($app['url_scheme']) || $app['url_scheme'] = function ($app) {
            return new Client($app);
        };
    }
}
