# 小程序码

官方文档：https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/qr-code/wxacode.createQRCode.html

```php
// 小程序码接口返回的是array|图片流，需自行保存为图片

// 实现微信小程序 wxacode.get 接口，第二个数组参数为可选
$response = $app->app_code->get('pages/index/index', [
    'width' => 600
])

// 实现微信小程序 wxacode.getUnlimited 接口，第二个数组参数为可选
$response = $app->app_code->getUnlimit('a=1', [
    'page'  => 'pages/index/index',
    'width' => 600,
])

// 实现微信小程序 wxacode.createQRCode 接口，第二个数组参数为可选
// 修改记录：2023年1月4日，修改了 getQrCode 第二个参数的传参类型，请按以下修改
$response = $app->app_code->getQrCode('pages/index/index', 600)

```
