<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ChangeLanguage
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    // Priorité : 1) session, 2) cookie persistant, 3) langue par défaut
      $locale = ($request->hasSession() ? $request->session()->get('currentLocaleCode') : null)
        ?? $request->cookie('junspro_locale');

    // Valider que la locale est connue en DB
    static $validCodes = null;
    if ($validCodes === null) {
      try {
        $validCodes = \App\Models\Language::pluck('code')->toArray();
      } catch (\Exception $e) {
        $validCodes = ['fr', 'en'];
      }
    }

    if (empty($locale) || !in_array($locale, $validCodes)) {
      $locale = null;
    }

    // Si locale lue du cookie mais pas en session, synchroniser la session
    if (!empty($locale) && $request->hasSession() && !$request->session()->has('currentLocaleCode')) {
      $request->session()->put('currentLocaleCode', $locale);
    }

    // Appliquer la locale (ou laisser Laravel utiliser la langue par défaut)
    if (!empty($locale)) {
      App::setLocale($locale);
    }

    return $next($request);
  }
}
