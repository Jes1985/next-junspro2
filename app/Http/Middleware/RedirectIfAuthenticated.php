<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  ...$guards
   * @return mixed
   */
  public function handle(Request $request, Closure $next, ...$guards)
  {
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
      if ($guard == 'admin' && Auth::guard($guard)->check()) {
        return redirect()->route('admin.dashboard');
      }
      if ($guard == 'web' && Auth::guard($guard)->check()) {
        $user = Auth::guard($guard)->user();
        // Vérifier si l'utilisateur a un profil freelance
        if ($user->freelancerProfile) {
          return redirect()->route('freelance.dashboard');
        } elseif ($user->clientProfile) {
          return redirect()->route('client.dashboard.index');
        }
        return redirect()->route('user.dashboard');
      }
      if ($guard == 'seller' && Auth::guard($guard)->check()) {
        return redirect()->route('seller.dashboard');
      }
    }

    return $next($request);
  }
}
