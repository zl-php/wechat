# 微信公众号模块初始化

```php
use Zuogechengxu\Wechat\Factory;

$config = [
    'app_id' => 'xxx',
    'secret' => 'xxx',
];

$this->app = Factory::OffiaAccount($config);
```
