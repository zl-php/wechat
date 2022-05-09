# 企业微信模块初始化

``` php
use Zuogechengxu\Wechat\Factory;

$config = [
    'corp_id' => 'xxx',
    'agent_id' => xxx,
    'secret'   => 'xxx'
];

$app = Factory::work($config);
```
