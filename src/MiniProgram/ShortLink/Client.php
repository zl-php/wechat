<?php
/**
 * User：zhoulei
 * File: Client.php
 * Date: 2023/6/12 17:31
 * Email: <lei_0668@sina.com>
 */
namespace Zuogechengxu\Wechat\MiniProgram\ShortLink;

use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取小程序 Short Link
     *
     * @param string $pageUrl
     * @param string $pageTitle
     * @param bool $isPermanent
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getShortLink(string $pageUrl, string $pageTitle, bool $isPermanent = false)
    {
        $params = [
            'page_url' => $pageUrl,
            'page_title' => $pageTitle,
            'is_permanent' => $isPermanent,
        ];

        return $this->httpPostJson('wxa/genwxashortlink', $params);
    }
}
