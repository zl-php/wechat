<?php
namespace Zuogechengxu\Wechat\Work\Message;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        isset($app['message']) || $app['message'] = function ($app) {
            $message = new Client($app);

            if (is_numeric($app['config']['agent_id'])) {
                $message->ofAgent($app['config']['agent_id']);
            }

            return $message;
        };
    }
}