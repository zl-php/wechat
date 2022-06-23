<?php
namespace Zuogechengxu\Wechat\Work\Department;

use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * Get department lists
     *
     * @param int|null $id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function list(?int $id = null)
    {
        return $this->httpGet('cgi-bin/department/list', compact('id'));
    }

    /**
     * Get sub department lists
     *
     * @param null|int $id
     * @return mixed
     */
    public function simpleList(?int $id = null)
    {
        return $this->httpGet('cgi-bin/department/simplelist', compact('id'));
    }
}
