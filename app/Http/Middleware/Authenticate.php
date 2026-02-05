<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
  /**
   * Get the path the user should be redirected to when they are not authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return string|null
   */
  protected function redirectTo($request)
  {
    if (!$request->expectsJson()) {
      if (Route::is('admin.*')) {
        return route('admin.login');
      }

      if (Route::is('user.*')) {
        return route('user.login');
      }
      if (Route::is('seller.*')) {
        // Si secret_login est défini, rediriger vers le dashboard freelance au lieu de seller.login
        // pour éviter les boucles de redirection
        if (\Illuminate\Support\Facades\Session::get('secret_login') == 1) {
          return route('freelance.dashboard', ['tab' => 'services']);
        }
        return route('seller.login');
      }
    }
  }
}
