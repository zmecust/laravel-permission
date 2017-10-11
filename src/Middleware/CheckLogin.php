<?php

namespace Zmecust\LaravelPermission\Middleware;

use Illuminate\Support\Facades\Cache;

class CheckLogin extends BaseMiddleware
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
        if (config('zmecust.service_name')) {
            $access_token  = $request->header('authorization') ?: $request->get('authorization');

            if(empty($access_token)) {
                return $this->response->json([
                    'status' => -1,
                    'message' => 'error token',
                    'data' => null
                ]);
            } elseif (empty(Cache::get(config('zmecust.service_name') . $access_token))) {

                return $this->response->json([
                    'status' => -1,
                    'message' => 'token out of data',
                    'data' => null
                ]);
            }
        }

        return $next($request);
    }
}
