<?php
/**
 * FILE: Client.php.
 * User: zhoulei
 * Date: 2022/5/5 14:23
 */
namespace Zuogechengxu\Wechat\MiniProgram\PhoneNumber;

use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * @param $code
     * @return mixed
     */
    public function getUserPhoneNumber($code)
    {
        $params = [
            'code' => $code
        ];

        $result = $this->httpPostJson('wxa/business/getuserphonenumber', $params);

        return $result['phone_info'];
    }
}
