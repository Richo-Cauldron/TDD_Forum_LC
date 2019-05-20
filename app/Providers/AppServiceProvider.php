<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Channel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // throws errors as the sql query below, runs before the DB migrations run for the tests
        // \View::share('channels', Channel::all());
        
        \View::composer('*', function($view){
            $view->with('channels', Channel::all());
        });
    }
}
