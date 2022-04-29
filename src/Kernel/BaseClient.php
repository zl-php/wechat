<?php
/**
 * FILE: BaseClient.php.
 * User: zhoulei
 * Date: 2022/4/29 16:09
 */

namespace Zuogechengxu\Wechat\Kernel;

use Psr\Http\Message\RequestInterface;
use Zuogechengxu\Wechat\Kernel\Traits\HasHttpRequest;
use Zuogechengxu\Wechat\Kernel\Contracts\AccessTokenInterface;

class BaseClient
{
    use HasHttpRequest{
        request as performRequest;
    }

    protected $app;
    protected $accessToken = null;

    public function __construct(ServiceContainer $app, AccessTokenInterface $accessToken = null)
    {
        $this->app = $app;
        $this->accessToken = $accessToken ?? $this->app['access_token'];
    }

    public function httpGet($url, array $query = [])
    {
        return $this->request($url, 'GET', ['query' => $query]);
    }

    public function httpPost($url, array $data = [])
    {
        return $this->request($url, 'POST', ['form_params' => $data]);
    }

    public function httpPostJson($url, array $data = [], array $query = [])
    {
        return $this->request($url, 'POST', ['query' => $query, 'json' => $data]);
    }

    public function request($url, $method = 'GET', array $options = [])
    {
        if (empty($this->middlewares)) {
            $this->registerHttpMiddlewares();
        }

        $response = $this->performRequest($url, $method, $options);

        return $response;
    }

    protected function registerHttpMiddlewares()
    {
        // access token
        $this->pushMiddleware($this->accessTokenMiddleware(), 'access_token');
    }

    protected function accessTokenMiddleware()
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                if ($this->accessToken) {
                    $request = $this->accessToken->applyToRequest($request, $options);
                }

                return $handler($request, $options);
            };
        };
    }
}