<?php
/**
 * FILE: ServiceProvider.php.
 * User: zhoulei
 * Date: 2022/5/5 14:19
 */
namespace Zuogechengxu\Wechat\MiniProgram\UrlLink;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        isset($app['url_link']) || $app['url_link'] = function ($app) {
            return new Client($app);
        };
    }
}
