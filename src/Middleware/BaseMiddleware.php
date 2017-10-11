<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/10/11
 * Time: 15:59
 */
namespace Zmecust\LaravelPermission\Middleware;

use Illuminate\Contracts\Routing\ResponseFactory;

abstract class BaseMiddleware
{
    /**
     * @var \Illuminate\Contracts\Routing\ResponseFactory
     */
    protected $response;

    /**
     * BaseMiddleware constructor.
     * @param ResponseFactory $response
     */
    public function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }
}
