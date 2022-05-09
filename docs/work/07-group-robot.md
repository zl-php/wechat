# 群机器人

官方文档：https://developer.work.weixin.qq.com/document/path/91770

目前文本消息只支持全部成员接收

```php
// 群机器人 webhook 分配的 key
$key = 'xxx-xx-xx-xx-xxxxx';

// 发送文本消息，返回数组格式, [ "errcode" => 0, "errmsg" => "ok"]
$result = $app->group_robot->setText('普通文本消息')->toGroup($key)->send()

// 发送 Markdown 消息
$content = "### markdown消息测试
> 测试详情
>
> 接收人：<font color='info'>zhoulei1</font>
>
> 时间：<font color='warning'>2022年5月9日22:18:43</font>";

$result = $app->group_robot->setMarkdown($content)->toGroup($key)->send();
```
