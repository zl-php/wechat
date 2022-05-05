<h1 align="center">wechat</h1>

一个基于 Laravel 开发的，轻量的，代码易懂的微信/企业微信 SDK

目前仅支持部分小程序以及企业微信功能，持续增加中

## 运行环境
- PHP >= 7.4
- composer

## 安装
```bash
composer require zuogechengxu/wechat
```

## 帮助文档（企业微信，小程序）

### 企业微信

#### 初始化
```
use Zuogechengxu\Wechat\Factory;

$config = [
    'corp_id' => 'xxx',
    'agent_id' => xxx,
    'secret'   => 'xxx'
];

$app = Factory::work($config);
```

#### 获取 access_token
```
# 获取 access_token 可传参数为 true 表示不走缓存重新获取
$token = $app->access_token->getAccessToken()
```

#### 网页授权
```
# 授权回调地址，需企业微信设置为可信域名
$callbackUrl = 'https://xxxx';

# 构造网页授权链接，返回 redirect 实例
$redirect = $app->oauth->redirect($callbackUrl);

# 获取url
$targetUrl = $redirect->getTargetUrl();

# 直接跳转
$redirect->send();

# 获取访问用户身份 (UserId)
$code = '回调接收到的code';

# 返回数组格式
$users = $app->oauth->user($code)
```

#### 通讯录管理
```
# 读取成员, 返回成员详细信息数组
$user = $app->user->get($userid);

```
#### JSSDK
```
# 获取企业的 jsapi_ticket 可传参数为 true 表示不走缓存重新获取
$ticket = $app->jssdk->getCompanyTicket()

# 获取应用的jsapi_ticket 可传参数为 true 表示不走缓存重新获取
$ticket = $app->jssdk->getAgentTicket()

# 生成前端jssdk 所需要的配置数组，方便前端注入（企业身份注入）
$config = $app->jssdk->getCompanyConfigArray()

# 生成前端jssdk 所需要的配置数组，方便前端注入（应用身份注入）
$config = $app->jssdk->getAgentConfigArray()
```

#### 发送应用消息
```
# 发送文本消息，toUser 不传为all，返回数组格式
$result = $app->message->setText('普通文本消息')->toUser('xxxx')->send()

# 发送文本卡片消息，toUser 不传为all，返回数组格式
$data = [
    'title' => '测试卡片信息',
    'description' => '<font color='info'>卡片信息测试</div>',
    'url' => 'https://www.baidu.com'
];
        
$result = $app->message->setTextCard($data)->toUser('xxxx')->send()

# 发送markdown消息，toUser 不传为all，返回数组格式
$content = "### markdown消息测试
> 测试详情
>
> 接收人：<font color='info'>zhoulei1</font>
>
> 时间：<font color='warning'>2022年5月5日11:20:38</font>";

$result = $app->message->setMarkdown($content)->toUser('xxxx')->send()

```
### 微信小程序

#### 初始化
```
use Zuogechengxu\Wechat\Factory;

$config = [
    'app_id' => 'xxx',
    'secret' => 'xxx',
];

$app = Factory::miniProgram($config);
```

#### 获取 access_token
```
# 获取 access_token 可传参数为 true 表示不走缓存重新获取
$token = $app->access_token->getAccessToken()
```

#### 登录
``` 
# 获取 session_key，返回数组
$result = $app->auth->session($code)

```
#### 换取用户手机号
``` 
# 根据 code 获取手机号码，返回数组
# 前端组件获取code：https://developers.weixin.qq.com/miniprogram/dev/framework/open-ability/getPhoneNumber.html
$result = $app->phone_number->getUserPhoneNumber($code)

```

#### 小程序码
``` 
## 小程序码接口返回的是 StreamResponse 示例，需自行保存为图片

# 实现微信小程序 wxacode.get 接口，第二个数组参数为可选
$response = $app->app_code->get('pages/index/index', [
    'width' => 600
])

# 实现微信小程序 wxacode.getUnlimited 接口，第二个数组参数为可选
$response = $app->app_code->getUnlimit('a=1', [
    'page'  => 'pages/index/index',
    'width' => 600,
])

# 实现微信小程序 wxacode.createQRCode 接口，第二个数组参数为可选
$response = $app->app_code->getQrCode('pages/index/index', [
    'width' => 600,
])

```