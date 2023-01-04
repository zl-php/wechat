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
     * @param string $path
     * @param array $optional
     * @return string
     */
    public function get(string $path, array $optional = [])
    {
        $params = array_merge([
            'path' => $path,
        ], $optional);

        return $this->getStream('wxa/getwxacode', $params);
    }

    /**
     * @param string $scene
     * @param array $optional
     * @return string
     */
    public function getUnlimit(string $scene, array $optional = [])
    {
        $params = array_merge([
            'scene' => $scene,
        ], $optional);

        return $this->getStream('wxa/getwxacodeunlimit', $params);
    }

    /**
     * @param string $path
     * @param int|null $width
     * @return string
     */
    public function getQrCode(string $path, int $width = null)
    {
        return $this->getStream('cgi-bin/wxaapp/createwxaqrcode', compact('path', 'width'));
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @return mixed|string
     */
    protected function getStream(string $endpoint, array $params)
    {
        $response = $this->request($endpoint, 'POST', ['json' => $params], true);

        if (false !== stripos($response->getHeaderLine('Content-disposition'), 'attachment')) {
            return $response->getBody()->getContents();
        }

        return $this->response($response);
    }
}
