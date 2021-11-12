<?php

namespace app\Providers;

use Illuminate\Support\ServiceProvider;

class SerchServiceProvider extends ServiceProvider
{
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
        $this->app->bind(
            'serch',
            'App\Http\Compornents\Serch'
          );
    }
}
