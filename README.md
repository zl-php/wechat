<h1 align="center">wechat</h1>

一个 Laravel 微信开发 SDK

## 运行环境
- PHP >= 7.4
- composer

## 安装

## 使用
### 初始化
```
$config = [
    'corp_id' => 'xxx',
    'agent_id' => xxx,
    'secret'   => 'xxx'
];

$app = Factory::work($config);
```

### 企业微信

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