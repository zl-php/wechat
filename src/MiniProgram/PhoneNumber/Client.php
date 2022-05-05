<?php
/**
 * FILE: Client.php.
 * User: zhoulei
 * Date: 2022/5/5 14:23
 */
namespace Zuogechengxu\Wechat\MiniProgram\PhoneNumber;

use Zuogechengxu\Wechat\Kernel\BaseClient;
use Zuogechengxu\Wechat\Kernel\Exceptions\InvalidArgumentException;

class Client extends BaseClient
{
    /**
     * code换取用户手机号。 每个code只能使用一次
     *
     * @param $code
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function getUserPhoneNumber($code)
    {
        $params = [
            'code' => $code
        ];

        $response = $this->httpPostJson('wxa/business/getuserphonenumber', $params);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0 || empty($result['phone_info'])) {
            throw new InvalidArgumentException('Failed to user phone:'. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result['phone_info'];
    }
}