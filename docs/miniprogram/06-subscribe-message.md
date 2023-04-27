# 发送订阅消息

官方文档：https://developers.weixin.qq.com/miniprogram/dev/OpenApiDoc/mp-message-management/subscribe-message/sendMessage.html

```php
// 发送订阅消息
$data = [
    'template_id' => 'xxx', // 所需下发的订阅模板id
    'touser' => 'xxx',     // 接收者（用户）的 openid
    'page' => 'xxx',       // 点击模板卡片后的跳转页面，仅限本小程序内的页面。支持带参数,（示例index?foo=bar）。该字段不填则模板无跳转。
    'data' => [         // 模板内容，格式形如 { "key1": { "value": any }, "key2": { "value": any } }
        'thing1' => [
        'value' => '哈哈哈',
        ],
        'thing2' => [
            'value' => 10,
        ]
    ],
];
        
$response = $app->subscribe_message->send($data)
```
