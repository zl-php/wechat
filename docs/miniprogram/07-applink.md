# 小程序码

官方文档：https://developers.weixin.qq.com/miniprogram/dev/OpenApiDoc/qrcode-link/qr-code/getQRCode.html

```php
// 获取小程序scheme码
$response = $app->url_scheme->generate();

// 获取小程序 URL Link
$response = $app->url_link->generate(array $params);

// 获取小程序 Short Link
$response = $app->short_link->getShortLink(string $pageUrl, string $pageTitle, bool $isPermanent = false);

```
