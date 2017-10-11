# laravel-permission
> A laravel package about permission management

## 演示地址

- http://admin.laravue.org

## 项目概述

- 前后端分离后端权限管理的最佳实现方式（提供 API 配合前端使用）

## 安装

- composer require zmecust/laravel-permission

## 配置

- 添加 service provider: `\Zmecust\LaravelPermission\ZmecustServiceProvider::class`

- 添加 UserTrait: 在用户表模型中添加 `use Zmecust\LaravelPermission\Traits\ZmecustUserTrait`

- 添加 Middleware: 在 Http kernel.php 添加 `'check.login' => \Zmecust\LaravelPermission\Middleware\CheckLogin::class` 和 `'check.permission' => \Zmecust\LaravelPermission\Middleware\CheckPermissions::class`, 并在 zmecust.php 文件中配置 middleware

- 配置文件: `php artisan vendor:publish --provider="Zmecust\\LaravelPermission\\ZmecustServiceProvider"`

## 配置说明
```
return [
    'user_table' => [
        'name'  => 'users',
        'model' => \App\User::class, //用户模型
    ],

    'router' => [
        'prefix' => 'admin', //路由前缀
    ],

    'middleware' => ['auth'], //中间件

    'service_name' => '' //项目名，非必须
];
```

- 如有任何疑问或者 bug，欢迎联系 `root@laravue.org`
