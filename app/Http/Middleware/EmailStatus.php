<?php

namespace App\Http\Middleware;

use App\Models\BasicSettings\Basic;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmailStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $type = null)
    {
        if (Session::get('secret_login') != 1) {
            if ($type == 'user') {
                $userInfo = Auth::guard('web')->user();
                if ($userInfo->email_verified != 1) {
                    Auth::guard('web')->logout();
                    Session::flash('error', 'Your email is not verified!');
                    return redirect()->route('user.login');
                }
            } elseif ($type == 'seller') {
                try {
                    $basic = Basic::where('uniqid', 12345)->select('seller_email_verification')->first();
                    // Vérifier si $basic existe et si l'utilisateur seller existe
                    if ($basic && Auth::guard('seller')->check() && Auth::guard('seller')->user()) {
                        if ($basic->seller_email_verification == 1 && Auth::guard('seller')->user()->email_verified_at == null) {
                            // Si secret_login est défini, ne pas rediriger vers seller.login pour éviter les boucles
                            if (Session::get('secret_login') == 1) {
                                // Continuer sans bloquer si secret_login est défini
                                return $next($request);
                            }
                            Session::flash('alert', 'Please verify your email address..!');
                            Auth::guard('seller')->logout();
                            return redirect()->route('seller.login');
                        }
                    }
                } catch (\Exception $e) {
                    // Si erreur de base de données, continuer sans bloquer
                    // Cela évite les boucles si MySQL n'est pas démarré
                    \Log::warning('EmailStatus middleware: Database error - ' . $e->getMessage());
                }
            }
        }
        return $next($request);
    }
}
