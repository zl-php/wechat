<h1 align="center">Laravel Wechat SDK</h1>

一个基于 Laravel 开发的微信/企业微信 SDK

目前仅支持部分小程序、公众号以及企业微信功能，持续增加中

## 目录
- [环境要求](#环境要求)
- [安装](#安装)
- [企业微信](docs/work/01-initialize.md)
    - [初始化](docs/work/01-initialize.md)
    - [获取access_token](docs/work/02-access-token.md)
    - [网页授权](docs/work/03-oauth.md)
    - [OA](docs/work/08-oa.md)
    - [通讯录](docs/work/04-contacts.md)
    - [部门管理](docs/work/09-department.md)
    - [JS-SDK](docs/work/05-jssdk.md)
    - [消息发送](docs/work/06-message.md)
    - [群机器人](docs/work/07-group-robot.md)
- [微信公众号](docs/offiaaccount/01-initialize.md)
    - [初始化](docs/offiaaccount/01-initialize.md)
    - [获取access_token](docs/offiaaccount/02-access-token.md)
    - [JS-SDK](docs/offiaaccount/03-jssdk.md)
- [微信小程序](docs/miniprogram/01-initialize.md)
    - [初始化](docs/miniprogram/01-initialize.md)
    - [获取access_token](docs/miniprogram/02-access-token.md)
    - [登录](docs/miniprogram/03-login.md)
    - [获取手机](docs/miniprogram/04-phonenumber.md)
    - [小程序QR](docs/miniprogram/05-appcode.md)
## 环境要求
- PHP >= 7.4

## 安装
使用 [composer](http://getcomposer.org/):

目前阿里云Composer镜像同步问题尚未解决，建议使用官方镜像或者腾讯等镜像

```shell
# 取消当前镜像配置
composer config -g --unset repos.packagist

# 使用腾讯镜像
composer config -g repos.packagist composer https://mirrors.tencent.com/composer/

# 安装
composer require zuogechengxu/wechat
```
## 说明
因该项目缓存 Token 直接使用了Laravel Cache 的 Facades，建议将 CACHE_DRIVER=file 改为 CACHE_DRIVER=redis
