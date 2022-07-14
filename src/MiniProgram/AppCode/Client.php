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
     * @param $path
     * @param array $optional
     * @return mixed
     */
    public function get($path, array $optional = [])
    {
        $params = array_merge([
            'path' => $path,
        ], $optional);

        $response = $this->request('wxa/getwxacode', 'POST', ['json' => $params], true);

        return $response->getBody()->getContents();
    }

    /**
     * @param $scene
     * @param array $optional
     * @return mixed
     */
    public function getUnlimit($scene, array $optional = [])
    {
        $params = array_merge([
            'scene' => $scene,
        ], $optional);

        $response = $this->request('wxa/getwxacodeunlimit', 'POST', ['json' => $params], true);

        return $response->getBody()->getContents();
    }

    /**
     * @param $path
     * @param null $width
     * @return mixed
     */
    public function getQrCode($path, $width = null)
    {
        $response = $this->request('cgi-bin/wxaapp/createwxaqrcode', 'POST', ['json' => compact('path', 'width')], true);

        return $response->getBody()->getContents();
    }
}
