<?php

namespace Laracademy\Commands;

use Illuminate\Support\ServiceProvider;

class ArtisanJokeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.laracademy.artison-joke',function($app){
	    return $app['Laracademy\Commands\JokeCommand'];
	});
	$this->commands('command.laracademy.artisan-joke');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
