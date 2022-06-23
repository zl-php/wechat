# 部门管理

官方文档：https://developer.work.weixin.qq.com/document/path/90205

```php
// 获取部门列表
$app->department->list();
// 获取指定部门及其下的子部门
$app->department->list($id);

// 获取子部门ID列表
$app->department->simpleList();
// 获取指定子部门及其下的子部门，递归
$app->department->simpleList($id);
```
