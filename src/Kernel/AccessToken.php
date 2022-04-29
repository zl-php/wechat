<?php
namespace Zuogechengxu\Wechat\Kernel;

use Illuminate\Support\Facades\Cache;
use Zuogechengxu\Wechat\Kernel\Traits\HasHttpRequest;
use Zuogechengxu\Wechat\Kernel\Contracts\AccessTokenInterface;
use Zuogechengxu\Wechat\Kernel\Exceptions\AccessTokenException;
use Psr\Http\Message\RequestInterface;

abstract class AccessToken implements AccessTokenInterface
{
    use HasHttpRequest;

    protected $app;

    protected $accessToken;

    protected $queryName;

    protected $requestMethod = 'GET';

    protected $tokenKey = 'access_token';

    protected $endpointToGetToken = 'cgi-bin/gettoken';

    protected $cachePrefix = 'wechat.access_token.';

    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * get access_token
     *
     * @param bool $refresh
     * @return mixed
     * @throws AccessTokenException
     */
    public function getAccessToken($refresh = false)
    {
        $cacheKey = $this->getCacheKey();

        if (!$refresh && Cache::has($cacheKey) && $result = Cache::get($cacheKey)) {
            return $result;
        }

        // 获取accessToken
        $accessToken = $this->requestToken($this->getCredentials());

        $this->setAccessToken($accessToken[$this->tokenKey], $accessToken['expires_in'] ?? 7200);

        $this->accessToken = $accessToken[$this->tokenKey];

        return $this->accessToken;
    }

    /**
     * set access_token
     *
     * @param $accessToken
     * @param int $lifetime
     * @return $this
     * @throws AccessTokenException
     */
    public function setAccessToken($accessToken, $lifetime = 7200)
    {
        Cache::put($this->getCacheKey(), $accessToken, $lifetime);

        if (!Cache::has($this->getCacheKey())) {
            throw new AccessTokenException('Failed to cache access token.');
        }

        return $this;
    }

    /**
     * refresh access_token
     *
     * @return $this
     * @throws AccessTokenException
     */
    public function refresh()
    {
        $this->getAccessToken(true);

        return $this;
    }

    protected function requestToken(array $credentials)
    {
        $response = $this->sendRequest($credentials);
        $result = json_decode($response->getBody()->getContents(), true);

        if (empty($result[$this->tokenKey])) {
            throw new AccessTokenException('Request access_token fail: '.json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }

    protected function sendRequest(array $credentials)
    {
        $options = [
            ('GET' === $this->requestMethod) ? 'query' : 'json' => $credentials,
        ];

        return $this->setHttpClient($this->app['http_client'])->request($this->getEndpoint(), $this->requestMethod, $options);
    }

    protected function getEndpoint()
    {
        if (empty($this->endpointToGetToken)) {
            throw new AccessTokenException('No endpoint for access token request.', []);
        }

        return $this->endpointToGetToken;
    }

    protected function getCacheKey()
    {
        return $this->cachePrefix.md5(json_encode($this->getCredentials()));
    }

    /**
     * 追加默认参数
     *
     * @param RequestInterface $request
     * @param array $requestOptions
     * @return RequestInterface
     */
    public function applyToRequest(RequestInterface $request, array $requestOptions = [])
    {
        parse_str($request->getUri()->getQuery(), $query);

        $query = http_build_query(array_merge($this->getQuery(), $query));

        return $request->withUri($request->getUri()->withQuery($query));
    }

    protected function getQuery()
    {
        return [$this->queryName ?? $this->tokenKey => $this->getAccessToken()];
    }

    /**
     * Credential for get token.
     *
     * @return array
     */
    abstract protected function getCredentials(): array;
}