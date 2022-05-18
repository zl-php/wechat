<?php
namespace Zuogechengxu\Wechat\Work\OAuth;

use Zuogechengxu\Wechat\Kernel\BaseClient;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Client extends BaseClient
{
    protected $endpointToGetUser = 'cgi-bin/user/getuserinfo';

    /**
     * 获取网页授权url
     * @param $callbackUrl
     * @return RedirectResponse
     */
    public function redirect($callbackUrl)
    {
        $queries = [
            'appid' => $this->app['config']['corp_id'],
            'redirect_uri' => $callbackUrl,
            'response_type' => 'code',
            'scope' => $this->app['config']['oauth.scopes'] ?? 'snsapi_base',
            'state' => $this->app['config']['oauth.state'] ?? 'state'
        ];

        $url = sprintf('https://open.weixin.qq.com/connect/oauth2/authorize?%s#wechat_redirect', http_build_query($queries));

        // 返回一个 redirect 实例
        return new RedirectResponse($url);
    }

    /**
     * 获取用户信息
     *
     * @param $code
     * @return mixed
     */
    public function user($code)
    {
        return $this->httpGet($this->endpointToGetUser, ['code' => $code]);
    }

}
