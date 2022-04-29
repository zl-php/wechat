<?php
namespace Zuogechengxu\Wechat\Kernel\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Trait HasHttpRequest.
 *
 * @property string $baseUri
 * @property float  $timeout
 * @property float  $connectTimeout
 */
trait HasHttpRequest
{
    /**
     * Http client.
     *
     * @var Client|null
     */
    protected $httpClient = null;

    /**
     * Http client options.
     *
     * @var array
     */
    protected $httpOptions = [];


    /**
     * Set http client.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return $this
     */
    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Return http client.
     */
    public function getHttpClient(): ClientInterface
    {
        if (!($this->httpClient instanceof ClientInterface)) {
            if (property_exists($this, 'app') && $this->app['http_client']) {
                $this->httpClient = $this->app['http_client'];
            } else {
                $this->httpClient = new Client();
            }
        }

        return $this->httpClient;
    }

    public function request($url, $method = 'GET', $options = [])
    {
        $method = strtoupper($method);

        $options = $this->fixJsonIssue($options);

        if (property_exists($this, 'baseUri') && !is_null($this->baseUri)) {
            $options['base_uri'] = $this->baseUri;
        }

        $response = $this->getHttpClient()->request($method, $url, $options);
        $response->getBody()->rewind();

        return $response;
    }

    /**
     * @param array $options
     *
     * @return array
     */
    protected function fixJsonIssue(array $options): array
    {
        if (isset($options['json']) && is_array($options['json'])) {
            $options['headers'] = array_merge($options['headers'] ?? [], ['Content-Type' => 'application/json']);

            if (empty($options['json'])) {
                $options['body'] = \GuzzleHttp\json_encode($options['json'], JSON_FORCE_OBJECT);
            } else {
                $options['body'] = \GuzzleHttp\json_encode($options['json'], JSON_UNESCAPED_UNICODE);
            }

            unset($options['json']);
        }

        return $options;
    }
}