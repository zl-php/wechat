<?php
namespace Zuogechengxu\Wechat\Work\OAuth;

use Zuogechengxu\Wechat\Kernel\BaseClient;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Client extends BaseClient
{
    protected $endpointToGetUser = 'cgi-bin/user/getuserinfo';

    /**
     * @param $callbackUrl
     * @return RedirectResponse
     */
    public function redirect($callbackUrl)
    {
        $queries = [
            'appid' => $this->app['config']['corp_id'],
            'redirect_uri' => $callbackUrl,
            'response_type' => 'code',
            'scope' => $this->app['config']->get('oauth.scope') ?? 'snsapi_base',
            'state' => $this->app['config']->get('oauth.state') ?? 'state'
        ];

        $url = sprintf('https://open.weixin.qq.com/connect/oauth2/authorize?%s#wechat_redirect', http_build_query($queries));

        // 返回一个 redirect 实例
        return new RedirectResponse($url);
    }

    /**
     * @param $code
     * @return mixed
     */
    public function user($code)
    {
        return $this->httpGet($this->endpointToGetUser, ['code' => $code]);
    }
}
