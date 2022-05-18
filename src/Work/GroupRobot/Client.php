<?php
namespace Zuogechengxu\Wechat\Work\GroupRobot;

use Zuogechengxu\Wechat\Kernel\BaseClient;

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
     */
    public function send()
    {
        $this->accessToken = null;

        return $this->httpPostJson($this->endpointToMessage, $this->patch, ['key' => $this->groupKey]);
    }
}
