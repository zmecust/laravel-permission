<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/10/11
 * Time: 9:37
 */
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
