<?php
/**
 * FILE: Client.php.
 * User: zhoulei
 * Date: 2022/5/5 14:23
 */
namespace Zuogechengxu\Wechat\MiniProgram\AppCode;

use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取小程序码，适用于需要的码数量较少的业务场景。通过该接口生成的小程序码，永久有效，有数量限制
     *
     * @param $path
     * @param array $optional
     * @return mixed
     */
    public function get($path, array $optional = [])
    {
        $params = array_merge([
            'path' => $path,
        ], $optional);

        $response = $this->httpPostJson('wxa/getwxacode', $params);

        return $response->getBody()->getContents();
    }

    /**
     * 获取小程序码，适用于需要的码数量极多的业务场景。通过该接口生成的小程序码，永久有效，数量暂无限制
     *
     * @param $scene
     * @param array $optional
     * @return mixed
     */
    public function getUnlimit($scene, array $optional = [])
    {
        $params = array_merge([
            'scene' => $scene,
        ], $optional);

        $response = $this->httpPostJson('wxa/getwxacodeunlimit', $params);

        return $response->getBody()->getContents();
    }

    /**
     * 获取小程序二维码，适用于需要的码数量较少的业务场景。通过该接口生成的小程序码，永久有效，有数量限制
     *
     * @param $path
     * @param null $width
     * @return mixed
     */
    public function getQrCode($path, $width = null)
    {
        $response = $this->httpPostJson('cgi-bin/wxaapp/createwxaqrcode', compact('path', 'width'));

        return $response->getBody()->getContents();
    }
}