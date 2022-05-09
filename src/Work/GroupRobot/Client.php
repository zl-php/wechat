<?php
namespace Zuogechengxu\Wechat\Work\GroupRobot;

use Illuminate\Support\Arr;
use Zuogechengxu\Wechat\Kernel\BaseClient;
use Zuogechengxu\Wechat\Kernel\Exceptions\InvalidArgumentException;

class Client extends BaseClient
{
    protected $patch = [];
    protected $groupKey;
    protected $endpointToMessage = 'cgi-bin/webhook/send';

    /**
     * 文本消息
     *
     * @param $message
     * @return $this
     */
    public function setText($message)
    {
        $this->patch = [
            'msgtype' => 'text',
            'text' => ['content' => $message]
        ];

        return $this;
    }

    /**
     * 发送markdown消息
     * @param $message
     * @return $this
     */
    public function setMarkdown($message)
    {
        $this->patch = [
            'msgtype' => 'markdown',
            'markdown' => ['content' => $message]
        ];

        return $this;
    }

    public function toGroup($groupKey)
    {
        $this->groupKey = $groupKey;

        return $this;
    }

    /**
     * 发送消息
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function send()
    {
        $this->accessToken = null;

        $response = $this->httpPostJson($this->endpointToMessage, $this->patch, ['key' => $this->groupKey]);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0) {
            throw new InvalidArgumentException('Failed to Send the message successfully:'. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }


}
