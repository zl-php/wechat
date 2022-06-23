<?php
namespace Zuogechengxu\Wechat\Work\User;

use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * Get user
     *
     * @param $userId
     * @return mixed
     */
    public function get($userId)
    {
        return $this->httpGet('cgi-bin/user/get', ['userid' => $userId]);
    }

    /**
     * Get simple user list
     *
     * @param int $departmentId
     * @param bool $fetchChild
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getDepartmentUsers(int $departmentId, bool $fetchChild = false)
    {
        $params = [
            'department_id' => $departmentId,
            'fetch_child' => (int) $fetchChild,
        ];

        return $this->httpGet('cgi-bin/user/simplelist', $params);
    }

    /**
     * Get user list
     *
     * @param int $departmentId
     * @param bool $fetchChild
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getDetailedDepartmentUsers(int $departmentId, bool $fetchChild = false)
    {
        $params = [
            'department_id' => $departmentId,
            'fetch_child' => (int) $fetchChild,
        ];

        return $this->httpGet('cgi-bin/user/list', $params);
    }
}
