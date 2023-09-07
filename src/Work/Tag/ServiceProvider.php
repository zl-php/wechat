<?php
/**
 * User：zhoulei
 * File: ServiceProvider.php
 * Date: 2023/9/7 20:01
 * Email: <lei_0668@sina.com>
 * Describe: ...
 */
namespace Zuogechengxu\Wechat\Work\Tag;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        isset($app['tag']) || $app['tag'] = function ($app) {
            return new Client($app);
        };
    }
}