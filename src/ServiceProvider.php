<?php

namespace Hogus\LaravelMiniProgram;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/config.php';

        $this->publishes([$configPath => config_path('miniprogram.php')], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MiniProgramManager::class,function ($app){
           return new MiniProgramManager($app->config->get('miniprogram'));
        });

        $this->app->alias(MiniProgramManager::class, 'miniprogram');

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [MiniProgramManager::class];
    }
}
