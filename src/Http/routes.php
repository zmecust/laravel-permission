<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/10/11
 * Time: 9:44
 */
$options = [
    'prefix'    => config('zmecust.router.prefix'),
    'namespace' => '\Zmecust\LaravelPermission\Http\Controllers',
];

if (config('zmecust.middleware')) {
    $options['middleware'] = config('zmecust.middleware');
}

Route::group(
    $options,
    function () {
        Route::get('menu', 'MenusController@getSidebarTree'); //获取后台左侧菜单
        Route::get('group_permissions', 'PermissionsController@groupPermissions'); //获取权限组
        Route::resource('roles', 'RolesController');
        Route::resource('users', 'UsersController');
        Route::resource('menus', 'MenusController');
        Route::resource('permissions', 'PermissionsController');
    }
);
