# 企业微信模块初始化

``` php
use Zuogechengxu\Wechat\Factory;

$config = [
    'corp_id' => 'xxx',
    'agent_id' => xxx,
    'secret'   => 'xxx',
    
    // 网页授权配置选项，选填
    'oauth' => [
        'scope'   => 'snsapi_privateinfo',
        'state'   => '34343434'
    ],
];

$app = Factory::work($config);
```
