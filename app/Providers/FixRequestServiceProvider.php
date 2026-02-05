<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class FixRequestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Fix pour Laravel 12 : créer une requête si elle n'existe pas (pour les commandes artisan)
        if (!$this->app->bound('request') && php_sapi_name() === 'cli') {
            $url = $this->app->bound('config') 
                ? ($this->app['config']['app.url'] ?? 'http://localhost:8000')
                : 'http://localhost:8000';
            
            $request = Request::create($url, 'GET');
            $this->app->instance('request', $request);
        }
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


