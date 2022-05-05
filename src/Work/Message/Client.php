<?php
namespace Zuogechengxu\Wechat\Work\Message;

use Illuminate\Support\Arr;
use Zuogechengxu\Wechat\Kernel\BaseClient;
use Zuogechengxu\Wechat\Kernel\Exceptions\InvalidArgumentException;

class Client extends BaseClient
{
    protected $patch;
    protected $to = ['touser' => '@all'];
    protected $agentId;
    protected $secretive = false;
    protected $endpointToMessage = 'cgi-bin/message/send';

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
     * 文本卡片消息
     *
     * @param array $message ['title', 'description', 'url']
     * @param string $btn_txt
     * @return $this
     */
    public function setTextCard(array $message, $btn_txt = '详情')
    {
        $this->patch = [
            'msgtype' => 'textcard',
            'textcard' => array_merge($message, ['btntxt' => $btn_txt])
        ];

        return $this;
    }

    /**
     * 发送markdown消息
     *
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

    /**
     * 接收消息的成员，默认为all
     *
     * @param array|string $userIds
     * @return Client
     */
    public function toUser($userIds)
    {
        return $this->setRecipients($userIds, 'touser');
    }

    /**
     *  接收消息的部门
     *
     * @param $partyIds array|string $partyIds
     * @return Client
     */
    public function toParty($partyIds)
    {
        return $this->setRecipients($partyIds, 'toparty');
    }

    /**
     * 获取应用id
     *
     * @param $agentId
     * @return $this
     */
    public function ofAgent($agentId)
    {
        $this->agentId = $agentId;

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
        $message = array_merge($this->to, $this->patch, [
            'agentid' => $this->agentId,
            'safe' => intval($this->secretive),
        ]);

        $this->secretive = false;

        $response = $this->httpPostJson($this->endpointToMessage, $message);
        $result = json_decode($response->getBody()->getContents(), true);

        if (($result['errcode'] ?? 1) > 0 || empty($result['msgid'])) {
            throw new InvalidArgumentException('Failed to Send the message successfully:'. json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }
    
    protected function setRecipients($ids, $key)
    {
        if (is_array($ids)) {
            $ids = implode('|', $ids);
        }

        $this->to = Arr::get($this->to, 'touser') === '@all' ? [$key => $ids] : array_merge($this->to, [$key => $ids]);

        return $this;
    }

}