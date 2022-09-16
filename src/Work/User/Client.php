<?php
namespace Zuogechengxu\Wechat\Work\User;

use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * Create a user.
     *
     * @param array $data
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function create(array $data)
    {
        return $this->httpPostJson('cgi-bin/user/create', $data);
    }

    /**
     * Get user.
     *
     * @param $userId
     * @return mixed
     */
    public function get($userId)
    {
        return $this->httpGet('cgi-bin/user/get', ['userid' => $userId]);
    }

    /**
     * Update an exist user.
     *
     * @param string $id
     * @param array $data
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function update(string $id, array $data)
    {
        return $this->httpPostJson('cgi-bin/user/update', array_merge(['userid' => $id], $data));
    }

    /** Delete a user.
     *
     * @param $userId
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function delete($userId)
    {
        if (is_array($userId)) {
            return $this->batchDelete($userId);
        }

        return $this->httpGet('cgi-bin/user/delete', ['userid' => $userId]);
    }

    /**
     * Batch delete users.
     *
     * @param array $userIds
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function batchDelete(array $userIds)
    {
        return $this->httpPostJson('cgi-bin/user/batchdelete', ['useridlist' => $userIds]);
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

    /**
     * userid转openid.
     *
     * @param string $userId
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function userIdToOpenid(string $userId)
    {
        return $this->httpPostJson('cgi-bin/user/convert_to_openid', ['userid' => $userId]);
    }

    /**
     * openid转userid
     *
     * @param string $openid
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function openidToUserId(string $openid)
    {
        return $this->httpPostJson('cgi-bin/user/convert_to_userid', ['openid' => $openid]);
    }

    /**
     * 手机号获取userid
     * @param string $mobile
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function mobileToUserId(string $mobile)
    {
        return $this->httpPostJson('cgi-bin/user/getuserid', ['mobile' => $mobile]);
    }

    /**
     * 邮箱获取userid
     *
     * @param string $email
     * @param int $email_type
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function emailToUserId(string $email, int $email_type = 1)
    {
        $params = [
            'email' => $email,
            'email_type' => $email_type
        ];

        return $this->httpPostJson('cgi-bin/user/get_userid_by_email', $params);
    }

    /**
     * 获取成员ID列表
     *
     * @param string|null $cursor
     * @param int|null $limit
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function userIdList(string $cursor = null, int $limit = null)
    {
        $params = [
            'cursor' => $cursor,
            'limit' => $limit
        ];

        return $this->httpPostJson('cgi-bin/user/list_id', $params);
    }
}
