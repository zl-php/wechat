<?php
/**
 * User：zhoulei
 * File: Client.php
 * Date: 2023/6/12 17:31
 * Email: <lei_0668@sina.com>
 */
namespace Zuogechengxu\Wechat\MiniProgram\UrlScheme;

use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取小程序scheme码
     *
     * @param array $param
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function generate(array $param = [])
    {
        return $this->httpPostJson('wxa/generatescheme', $param);
    }
}
