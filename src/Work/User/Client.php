<?php
namespace Zuogechengxu\Wechat\Work\User;

use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    protected $endpointToUserGet = 'cgi-bin/user/get';

    /**
     * 获取用企业用户详细信息
     *
     * @param $userId
     * @return mixed
     */
    public function get($userId)
    {
        return $this->httpGet($this->endpointToUserGet, ['userid' => $userId]);
    }
}
