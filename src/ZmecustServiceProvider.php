<?php
/**
 * Created by PhpStorm.
 * User: zhangmin
 * Date: 2017/10/11
 * Time: 9:30
 */
namespace Zmecust\LaravelPermission;

use Illuminate\Support\ServiceProvider;

class ZmecustServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function register()
    {
        // TODO: Implement register() method.
    }

    /**
     * @inheritdoc
     */
    public function boot()
    {
        // require __DIR__.'/Utils/helpers.php';

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Http/routes.php';
        }

        $this->publishes(
            [
                __DIR__.'/../config/config.php' => config_path('zmecust.php'),
            ],
            'config'
        );

        $this->publishes(
            [
                __DIR__.'/../database/migrations/' => database_path('migrations'),
            ],
            'migrations'
        );
    }
}