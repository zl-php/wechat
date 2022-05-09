# 获取access_token

官方文档：https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/access-token/auth.getAccessToken.html

```php
// 获取 access_token 可接受参数为 true 表示
// 返回数组 token['access_token']
$token = $app->access_token->getAccessToken()

// 不走缓存，直接获取获取
$token = $app->access_token->getAccessToken(true)
```
