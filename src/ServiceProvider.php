<?php

namespace CleanCodeStudio\LaravelTextMessages\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'studio');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->publishes([
            __DIR__.'/config/gateway.php' => config_path('gateway.php'),
            __DIR__.'/config/textable.php' => config_path('textable.php'),
        ]);
    }
}
