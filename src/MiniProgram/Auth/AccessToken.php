<?php
namespace Zuogechengxu\Wechat\MiniProgram\Auth;

use Zuogechengxu\Wechat\Kernel\AccessToken as BaseAccessToken;

class AccessToken extends BaseAccessToken
{
    protected $endpointToGetToken = 'cgi-bin/token';

    /**
     * Credential for get token. 实现父类的抽象方法
     *
     * @return array
     */
    protected function getCredentials(): array
    {
        return [
            'grant_type' => 'client_credential',
            'appid' => $this->app['config']['app_id'],
            'secret' => $this->app['config']['secret'],
        ];
    }
}