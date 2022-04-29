<?php
namespace Zuogechengxu\Wechat\Kernel\Contracts;

interface AccessTokenInterface
{
    /**
     * Get access token.
     *
     * @return mixed.
     */
    public function getAccessToken();

    public function refresh();
}