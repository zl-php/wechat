# 标签管理

官方文档：https://developer.work.weixin.qq.com/document/path/90210

```php
// 创建标签
$app->tag->create($tagName, $tagId);

// 更新标签名字
$app->tag->update($tagId, $tagName);
    
// 删除标签
$app->tag->delete($tagId);

// 获取标签列表
$app->tag->list();

// 获取标签成员
$app->tag->get($tagId);

// 增加标签成员
$app->tag->tagUsers($tagId, [$userId1, $userId2, ...]);
// 指定部门
$app->tag->tagDepartments($tagId, [$departmentId1, $departmentId2, ...]);

// 删除标签成员
$app->tag->untagUsers($tagId, [$userId1, $userId2, ...]);
// 指定部门
$app->tag->untagDepartments($tagId, [$departmentId1, $departmentId2, ...]);
```
