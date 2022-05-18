<?php
/**
 * FILE: Client.php.
 * User: zhoulei
 * Date: 2022/5/5 14:23
 */
namespace Zuogechengxu\Wechat\MiniProgram\Auth;

use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 实现小程序 auth.code2Session 接口
     *
     * @param $code
     * @return mixed
     */
    public function session($code)
    {
        $params = [
            'appid' => $this->app['config']['app_id'],
            'secret' => $this->app['config']['secret'],
            'js_code' => $code,
            'grant_type' => 'authorization_code',
        ];

        return $this->httpGet('sns/jscode2session', $params);
    }
}
