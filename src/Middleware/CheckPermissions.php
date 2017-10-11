<?php

namespace Zmecust\LaravelPermission\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Zmecust\LaravelPermission\Models\Permission;

class CheckPermissions extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $uri_name = Route::currentRouteName(); //后端路由必须全部命名，否则此处为null
        $permission_info = Permission::where('name', $uri_name)->first();
        //如果查不到路由名对应的权限则直接放行

        if (empty($permission_info)) {
            return $next($request);
        }  //检查是否有权限
        
        if (config('zmecust.service_name')) {
            $access_token = $request->header('authorization');
            $user_id = Cache::get(config('zmecust.service_name') . $access_token);
            $permissions = app(config('zmecust.user_table.model'))->where('id', $user_id)->first()
                ->roles()->first()
                ->perms()->pluck('name')->toArray(); //获取当前用户所有权限名
        } else {
            $permissions = Auth::user()->roles()->first()
                ->perms()->pluck('name')->toArray(); //获取当前用户所有权限名
        }

        if (!in_array($uri_name, $permissions)) {
            return $this->response->json([
                'status' => 0,
                'message' => '对不起，您没有权限操作',
                'data' => null
            ]);
        }  //根据路由名称查询权限

        return $next($request);
    }
}
