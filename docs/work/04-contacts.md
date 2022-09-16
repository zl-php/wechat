# 通讯录管理

官方文档：https://developer.work.weixin.qq.com/document/path/90195

```php
// 创建成员
$data = [
    "userid" => "test",
    "name" => "测试",
    "english_name" => "test"
    "mobile" => "13800138000",
];
$user = $app->user->create($data);

// 读取成员, 返回数组格式的成员详细信息
$user = $app->user->get($userid);

// 更新成员
$data =[
    "mobile" => '13800138000',
    'position' => 'PHP 开发工程师',
    //...
]
$user = $app->user->update('overtrue', $data);

// 删除成员
$user = $app->user->delete('test');
// 批量删除多个
$user = $app->user->delete(['test', 'test1', 'test2']);

// 获取部门成员
$app->user->getDepartmentUsers($departmentId);
// 递归获取子部门下面的成员
$app->user->getDepartmentUsers($departmentId, true);

// 获取部门成员详情
$app->user->getDetailedDepartmentUsers($departmentId);
// 递归获取子部门下面的成员
$app->user->getDetailedDepartmentUsers($departmentId, true);

// userid转openid
$app->user->userIdToOpenid($userId);

// openid转userid
$app->user->openidToUserId($openid);

// 手机号获取userid
$app->user->mobileToUserId($mobile);

// 邮箱获取userid, email_type可不传，默认为1
$app->user->emailToUserId($email, $email_type);

// 获取成员ID列表，仅支持通过“通讯录同步secret”调用。
// 默认参数：$cursor = null, $limit = null
$app->user->userIdList();
```
