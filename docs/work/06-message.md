# 消息推送

官方文档：https://developer.work.weixin.qq.com/document/path/90236

```php

/**
 * 支持的方法，详细可查看源码
 * 
 * toUser($userIds) $userIds array|string 
 * toParty($partyIds) $partyIds array|string
 * toTag($tagIds) $tagIds array|string
 * 
*/

// 发送文本消息，不使用 toUser 方法则向该企业应用的全部成员发送，返回数组格式
$result = $app->message->setText('普通文本消息')->toUser('xxxx')->send()


// 发送文本卡片消息，不使用 toUser 方法则向该企业应用的全部成员发送，返回数组格式
$data = [
'title' => '测试卡片信息',
'description' => '<font color='info'>卡片信息测试</div>',
'url' => 'https://www.baidu.com'
];

$result = $app->message->setTextCard($data)->toUser('xxxx')->send()


// 发送markdown消息，不使用 toUser 方法则向该企业应用的全部成员发送，返回数组格式
$content = "### markdown消息测试
> 测试详情
>
> 接收人：<font color='info'>zhoulei1</font>
>
> 时间：<font color='warning'>2022年5月5日11:20:38</font>";

$result = $app->message->setMarkdown($content)->toUser('xxxx')->send()


// 发送图文消息，图文消息（mpnews）
$content = [
    'title' => 'Title',
    ......
];

$result = $app->message->setNews($content)->toUser('xxxx')->send()
$result = $app->message->setMpNews($content)->toUser('xxxx')->send()

// 模板卡片消息，不使用 toUser 方法则向该企业应用的全部成员发送，返回数组格式
// 以图文展示型为例，调用
$message = [
    'card_type' => 'news_notice',
    'source' => [
        "icon_url" => '图片的url',
        "desc": "企业微信",
        "desc_color": 1
    ],
    ......
];

$result = $app->message->setTemplateCard($message)->toUser('xxxx')->send()

```
