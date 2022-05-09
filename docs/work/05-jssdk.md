# JS-SDK

官方文档：https://developer.work.weixin.qq.com/document/path/90513

```php
// 获取企业的 jsapi_ticket 可传参数为 true 表示不走缓存重新获取
$ticket = $app->jssdk->getCompanyTicket()

// 获取应用的jsapi_ticket 可传参数为 true 表示不走缓存重新获取
$ticket = $app->jssdk->getAgentTicket()

// 生成前端jssdk 所需要的配置数组，方便前端注入（企业身份注入）
$config = $app->jssdk->getCompanyConfigArray()

// 生成前端jssdk 所需要的配置数组，方便前端注入（应用身份注入）
$config = $app->jssdk->getAgentConfigArray()
```
