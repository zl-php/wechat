<?php
namespace Zuogechengxu\Wechat\Work\OAuth;

use Zuogechengxu\Wechat\Kernel\BaseClient;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Zuogechengxu\Wechat\Kernel\Exceptions\InvalidArgumentException;

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
     * @throws InvalidArgumentException
     */
    public function user($code)
    {
        $response = $this->httpGet($this->endpointToGetUser, ['code' => $code]);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0 || (empty($result['UserId']) && empty($result['OpenId']))) {
            throw new InvalidArgumentException('Failed to get user userid: '. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }

}