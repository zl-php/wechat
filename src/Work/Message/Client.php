<?php
namespace Zuogechengxu\Wechat\Work\Message;

use Illuminate\Support\Arr;
use Zuogechengxu\Wechat\Kernel\BaseClient;

class Client extends BaseClient
{
    protected $patch;
    protected $to = ['touser' => '@all'];
    protected $agentId;
    protected $secretive = false;
    protected $endpointToMessage = 'cgi-bin/message/send';

    /**
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
     * news
     * @param $message
     * @return $this
     */
    public function setNews($message)
    {
        $this->patch = [
            'msgtype' => 'news',
            'news' => ['articles' => $message]
        ];

        return $this;
    }

    /**
     * mpnews
     * @param $message
     * @return $this
     */
    public function setMpNews($message)
    {
        $this->patch = [
            'msgtype' => 'mpnews',
            'mpnews' => ['articles' => $message]
        ];

        return $this;
    }

    /**
     * markdown
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
     * Template Card Message
     * @param $message ('text_notice', 'news_notice', 'vote_interaction', 'multiple_interaction')
     * @return $this
     */
    public function setTemplateCard(array $message)
    {
        $this->patch = [
            'msgtype' => 'template_card',
            'template_card' => $message
        ];

        return $this;
    }

    /**
     * @param array|string $userIds
     * @return Client
     */
    public function toUser($userIds)
    {
        return $this->setRecipients($userIds, 'touser');
    }

    /**
     * @param $partyIds array|string $partyIds
     * @return Client
     */
    public function toParty($partyIds)
    {
        return $this->setRecipients($partyIds, 'toparty');
    }

    /**
     * @param $agentId
     * @return $this
     */
    public function ofAgent($agentId)
    {
        $this->agentId = $agentId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function send()
    {
        $message = array_merge($this->to, $this->patch, [
            'agentid' => $this->agentId,
            'safe' => intval($this->secretive),
        ]);

        $this->secretive = false;

        return $this->httpPostJson($this->endpointToMessage, $message);
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
