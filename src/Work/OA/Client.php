<?php
namespace Zuogechengxu\Wechat\Work\OA;

use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取企业所有打卡规则
     * @return mixed
     */
    public function corpCheckinRules()
    {
        return $this->httpPostJson('cgi-bin/checkin/getcorpcheckinoption');
    }

    /**
     * 获取员工打卡规则
     *
     * @param int $datetime
     * @param array $userList
     * @return mixed
     */
    public function checkinRules(int $datetime, array $userList)
    {
        $params = [
            'datetime' => $datetime,
            'useridlist' => $userList,
        ];

        return $this->httpPostJson('cgi-bin/checkin/getcheckinoption', $params);
    }

    /**
     * 获取打卡记录数据
     * @param int $startTime
     * @param int $endTime
     * @param array $userList
     * @param $type
     * @return mixed
     */
    public function checkinData(int $startTime, int $endTime, array $userList = [], $type = 3)
    {
        $params = [
            'opencheckindatatype' => $type,
            'starttime' => $startTime,
            'endtime' => $endTime,
            'useridlist' => $userList,
        ];

        return $this->httpPostJson('cgi-bin/checkin/getcheckindata', $params);
    }

    /**
     * 获取打卡日报数据
     *
     * @param int $startTime
     * @param int $endTime
     * @param array $userids array
     * @return mixed
     */
    public function checkinDayData(int $startTime, int $endTime, array $userids)
    {
        $params = [
            'starttime' => $startTime,
            'endtime' => $endTime,
            'useridlist' => $userids,
        ];

        return $this->httpPostJson('cgi-bin/checkin/getcheckin_daydata', $params);
    }

    /**
     * 获取打卡月报数据
     *
     * @param int $startTime
     * @param int $endTime
     * @param array $userids
     * @return mixed
     */
    public function checkinMonthData(int $startTime, int $endTime, array $userids)
    {
        $params = [
            'starttime' => $startTime,
            'endtime' => $endTime,
            'useridlist' => $userids,
        ];

        return $this->httpPostJson('cgi-bin/checkin/getcheckin_monthdata', $params);
    }

    /**
     * 获取公费电话拨打记录
     *
     * @param int $startTime
     * @param int $endTime
     * @param int $offset
     * @param $limit
     * @return mixed
     */
    public function dialRecords(int $startTime, int $endTime, int $offset = 0, $limit = 100)
    {
        $params = [
            'start_time' => $startTime,
            'end_time' => $endTime,
            'offset' => $offset,
            'limit' => $limit
        ];

        return $this->httpPostJson('cgi-bin/dial/get_dial_record', $params);
    }
}
