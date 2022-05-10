<?php
namespace Zuogechengxu\Wechat\OffiaAccount\Jssdk;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Zuogechengxu\Wechat\Kernel\BaseClient;
use Zuogechengxu\Wechat\Kernel\Contracts\AccessTokenInterface;
use Zuogechengxu\Wechat\Kernel\ServiceContainer;
use Zuogechengxu\Wechat\Kernel\Exceptions\InvalidArgumentException;

class Client extends BaseClient
{
    protected $url;
    protected $nonceStr;
    protected $timestamp;
    protected $ticketEndpoint = 'cgi-bin/ticket/getticket';

    public function __construct(ServiceContainer $app, AccessTokenInterface $accessToken = null)
    {
        parent::__construct($app, $accessToken);

        $this->url = $this->current_url();
        $this->nonceStr = Str::random(16);
        $this->timestamp =  time();
    }

    /**
     * 获取 jsapi_ticket
     *
     * @param $refresh
     * @param $type
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function getTicket($refresh = false, $type = 'jsapi')
    {
        $cacheKey = sprintf('wechat.jssdk.ticket.%s.%s', $type, $this->getAppId());

        if (!$refresh && Cache::has($cacheKey) && $result = Cache::get($cacheKey)) {
            return $result;
        }

        $response = $this->httpGet($this->ticketEndpoint, []);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0 || empty($result['ticket'])) {
            throw new InvalidArgumentException('Failed to cache jssdk ticket:'. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        Cache::put($cacheKey, $result,  $result['expires_in'] - 500);

        return $result;
    }

    /**
     * 获取企业身份注入配置
     *
     * @return array
     * @throws InvalidArgumentException
     */
    public function getConfigSignatureArray()
    {
        $conf = [
            'appId'    => $this->getAppId(),
            'nonceStr'  => $this->nonceStr,
            'timestamp' => $this->timestamp,
            'url'       => $this->url,
            'signature' => $this->getTicketSignature($this->getTicket()['ticket'], $this->nonceStr, $this->timestamp, $this->url),
        ];

        return $conf;
    }

    protected function getAppId()
    {
        return $this->app['config']->get('app_id');
    }

    protected function current_url()
    {
        $protocol = 'http://';

        if ((!empty($_SERVER['HTTPS']) && 'off' !== $_SERVER['HTTPS']) || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'http') === 'https') {
            $protocol = 'https://';
        }

        return $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }

    protected function getTicketSignature($ticket, $nonceStr, $timestamp, $url)
    {
        return sha1(sprintf('jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s', $ticket, $nonceStr, $timestamp, $url));
    }

}
