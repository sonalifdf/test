<?php

namespace Bitfumes\Contact;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
	$this->loadViewsFrom(__DIR__.'/views','contact');
	$this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }



    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      
    }

   
}
