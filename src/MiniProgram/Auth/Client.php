<?php
/**
 * FILE: Client.php.
 * User: zhoulei
 * Date: 2022/5/5 14:23
 */
namespace Zuogechengxu\Wechat\MiniProgram\Auth;

use Zuogechengxu\Wechat\Kernel\BaseClient;
use Zuogechengxu\Wechat\Kernel\Exceptions\InvalidArgumentException;

class Client extends BaseClient
{
    /**
     * 实现小程序 auth.code2Session 接口
     *
     * @param $code
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function session($code)
    {
        $params = [
            'appid' => $this->app['config']['app_id'],
            'secret' => $this->app['config']['secret'],
            'js_code' => $code,
            'grant_type' => 'authorization_code',
        ];

        $response = $this->httpGet('sns/jscode2session', $params);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0 || empty($result['openid'])) {
            throw new InvalidArgumentException('Failed to session key:'. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }
}