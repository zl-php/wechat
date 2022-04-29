<?php
namespace Zuogechengxu\Wechat\Kernel\Contracts;

use Psr\Http\Message\RequestInterface;

interface AccessTokenInterface
{
    /**
     * Get access token.
     *
     * @return mixed.
     */
    public function getAccessToken();

    public function refresh();

    public function applyToRequest(RequestInterface $request, array $requestOptions = []);
}