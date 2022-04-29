<?php
namespace Zuogechengxu\Wechat\Work\Auth;

use Zuogechengxu\Wechat\Kernel\AccessToken as BaseAccessToken;

class AccessToken extends BaseAccessToken
{
    protected $endpointToGetToken = 'cgi-bin/gettoken';

    /**
     * Credential for get token. 实现父类的抽象方法
     *
     * @return array
     */
    protected function getCredentials(): array
    {
        return [
            'corpid' => $this->app['config']['corp_id'],
            'corpsecret' => $this->app['config']['secret'],
        ];
    }
}