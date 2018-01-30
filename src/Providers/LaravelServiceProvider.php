<?php

namespace Zimosworld\SSLTools\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Zimosworld\SSLTools\SSLTools;


class LaravelServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Zimosworld\SSLTools\SSLTools', function () {
            return SSLTools::getInstance();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Zimosworld\SSLTools\SSLTools'];
    }
}
