<?php
namespace Zuogechengxu\Wechat\Work\User;

use Zuogechengxu\Wechat\Kernel\BaseClient;
use Zuogechengxu\Wechat\Kernel\Exceptions\InvalidArgumentException;

class Client extends BaseClient
{
    protected $endpointToUserGet = 'cgi-bin/user/get';

    /**
     * 获取用企业用户详细信息
     *
     * @param $userId
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get($userId)
    {
        $response = $this->httpGet($this->endpointToUserGet, ['userid' => $userId]);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0 || empty($result['userid'])) {
            throw new InvalidArgumentException('Failed to get user:'. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }



}