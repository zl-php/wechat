# 网页授权

官方文档：https://developer.work.weixin.qq.com/document/path/91335

```php
// 授权回调地址，需企业微信设置为可信域名
$callbackUrl = 'https://xxxx';

// 构造网页授权链接，返回 redirect 实例
$redirect = $app->oauth->redirect($callbackUrl);

// 获取url
$targetUrl = $redirect->getTargetUrl();

// 直接跳转
$redirect->send();

// 获取访问用户身份，返回数组格式 $user['UserId']
$code = '回调接收到的code';
$user = $app->oauth->user($code)
```
