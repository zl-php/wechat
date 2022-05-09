# 获取access_token

官方文档：https://developer.work.weixin.qq.com/document/path/91039

```php
// 获取 access_token 可接受参数为 true 表示
// 返回数组 token['access_token']
$token = $app->access_token->getAccessToken()

// 不走缓存，直接获取获取
$token = $app->access_token->getAccessToken(true)
```
