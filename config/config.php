<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/10/11
 * Time: 9:37
 */
return [
    'user_table' => [
        'id'    => 'id',
        'name'  => 'users',
        'model' => \App\Models\User::class, //change to your user model class
    ],
    'router' => [
        'prefix' => 'admin',
    ],
    'middleware' => [
        'common' => 'web',
        'auth'   => 'auth',
    ],
];