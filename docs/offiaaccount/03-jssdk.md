# JS-SDK

官方文档：https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/JS-SDK.html

```php
// 获取 jsapi_ticket 返回数组 $ticket['ticket']
$ticket = $app->jssdk->getTicket()

// 不走缓存，直接获取获取
$ticket = $app->jssdk->getTicket(true)

// 生成前端jssdk 所需要的配置数组，方便前端注入
$config = $app->jssdk->getConfigSignatureArray()
```
