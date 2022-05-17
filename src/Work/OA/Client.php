<?php
namespace Zuogechengxu\Wechat\Work\OA;

use Zuogechengxu\Wechat\Kernel\BaseClient;
use Zuogechengxu\Wechat\Kernel\Exceptions\InvalidArgumentException;

class Client extends BaseClient
{
    /**
     * 获取企业所有打卡规则
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function corpCheckinRules()
    {
        $response = $this->httpPostJson('cgi-bin/checkin/getcorpcheckinoption');
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0) {
            throw new InvalidArgumentException('Failed to get checkin data: '. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }

    /**
     * 获取员工打卡规则
     *
     * @param int $datetime
     * @param array $userList
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function checkinRules(int $datetime, array $userList)
    {
        $params = [
            'datetime' => $datetime,
            'useridlist' => $userList,
        ];

        $response = $this->httpPostJson('cgi-bin/checkin/getcheckinoption', $params);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0) {
            throw new InvalidArgumentException('Failed to get checkin data: '. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }

    /**
     * 获取打卡记录数据
     * @param int $startTime
     * @param int $endTime
     * @param array $userList
     * @param $type
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function checkinData(int $startTime, int $endTime, array $userList = [], $type = 3)
    {
        $params = [
            'opencheckindatatype' => $type,
            'starttime' => $startTime,
            'endtime' => $endTime,
            'useridlist' => $userList,
        ];

        $response = $this->httpPostJson('cgi-bin/checkin/getcheckindata', $params);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0) {
            throw new InvalidArgumentException('Failed to get checkin data: '. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }

    /**
     * 获取打卡日报数据
     *
     * @param int $startTime
     * @param int $endTime
     * @param array $userids array
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function checkinDayData(int $startTime, int $endTime, array $userids)
    {
        $params = [
            'starttime' => $startTime,
            'endtime' => $endTime,
            'useridlist' => $userids,
        ];

        $response = $this->httpPostJson('cgi-bin/checkin/getcheckin_daydata', $params);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0) {
            throw new InvalidArgumentException('Failed to get checkin data: '. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }

    /**
     * 获取打卡月报数据
     *
     * @param int $startTime
     * @param int $endTime
     * @param array $userids
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function checkinMonthData(int $startTime, int $endTime, array $userids)
    {
        $params = [
            'starttime' => $startTime,
            'endtime' => $endTime,
            'useridlist' => $userids,
        ];

        $response = $this->httpPostJson('cgi-bin/checkin/getcheckin_monthdata', $params);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0) {
            throw new InvalidArgumentException('Failed to get checkin data: '. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }

    /**
     * 获取公费电话拨打记录
     *
     * @param int $startTime
     * @param int $endTime
     * @param int $offset
     * @param $limit
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function dialRecords(int $startTime, int $endTime, int $offset = 0, $limit = 100)
    {
        $params = [
            'start_time' => $startTime,
            'end_time' => $endTime,
            'offset' => $offset,
            'limit' => $limit
        ];

        $response = $this->httpPostJson('cgi-bin/dial/get_dial_record', $params);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0) {
            throw new InvalidArgumentException('Failed to get dial record: '. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }
}
