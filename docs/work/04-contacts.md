# 通讯录管理

官方文档：https://developer.work.weixin.qq.com/document/path/90195

```php
// 读取成员, 返回数组格式的成员详细信息
$user = $app->user->get($userid);

// 获取部门成员
$app->user->getDepartmentUsers($departmentId);
// 递归获取子部门下面的成员
$app->user->getDepartmentUsers($departmentId, true);

// 获取部门成员详情
$app->user->getDetailedDepartmentUsers($departmentId);
// 递归获取子部门下面的成员
$app->user->getDetailedDepartmentUsers($departmentId, true);
```
