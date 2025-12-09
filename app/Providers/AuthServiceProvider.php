<?php

namespace App\Providers;

use App\Providers\CustomUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();

    // Enregistrer le provider personnalisé pour gérer email_address
    Auth::provider('custom', function ($app, array $config) {
      return new CustomUserProvider($app->make($config['model']));
    });
  }
}
