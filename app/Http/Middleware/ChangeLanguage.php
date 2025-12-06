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
    try {
      if ($request->session()->has('currentLocaleCode')) {
        $localeCode = $request->session()->get('currentLocaleCode');
        $locale = Language::query()->where('code', '=', $localeCode)
          ->pluck('code')
          ->first();
      }

      if (empty($locale)) {
        // set the default language as system locale
        $languageCode = Language::query()->where('is_default', '=', 1)
          ->pluck('code')
          ->first();
        
        if ($languageCode) {
          session()->put('currentLocaleCode', $languageCode);
          App::setLocale($languageCode);
        } else {
          // Fallback si aucune langue trouvée
          App::setLocale('en');
        }
      } else {
        // set the selected language as system locale
        App::setLocale($locale);
      }
    } catch (\Exception $e) {
      // Si la base de données n'existe pas encore, utiliser la langue par défaut
      App::setLocale('en');
    }

    return $next($request);
  }
}
