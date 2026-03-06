<?php

namespace App\Providers;

use App\Models\BasicSettings\SEO;
use App\Models\BasicSettings\SocialMedia;
use App\Models\Footer\FooterContent;
use App\Models\HomePage\Section;
use App\Models\Language;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    // Fix pour Laravel 12 : créer une requête HTTP simulée pour les commandes artisan
    if (app()->runningInConsole() && !app()->bound('request')) {
      $url = config('app.url', 'http://localhost:8000');
      $request = Request::create($url, 'GET');
      app()->instance('request', $request);
    }
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Paginator::useBootstrap();

    if (!app()->runningInConsole()) {
      try {
        $data = Cache::remember('website_info', 600, function () {
          return DB::table('basic_settings')->select('favicon', 'website_title', 'logo', 'updated_at', 'base_currency_text', 'base_currency_text_position')->first();
        });
      } catch (\Exception $e) {
        $data = null;
      }


      // send this information to only back-end view files
      View::composer('backend.*', function ($view) {
        static $backendSharedData = null;
        static $backendRoleInfo = null;

        if ($backendSharedData === null) {
          $language        = Cache::remember('backend_default_lang', 600, fn() => Language::query()->where('is_default', 1)->first());
          $websiteSettings = Cache::remember('backend_website_settings', 600, fn() => DB::table('basic_settings')->select('website_title', 'email_address', 'address', 'contact_number', 'admin_theme_version', 'theme_version', 'base_currency_symbol', 'base_currency_symbol_position', 'base_currency_text', 'base_currency_text_position', 'base_currency_rate', 'tax', 'life_time_earning', 'total_profit')->first());
          $footerText      = Cache::remember('backend_footer_' . $language->id, 600, fn() => $language->footerContent()->first());

          $backendSharedData = [
            'defaultLang'   => $language,
            'settings'      => $websiteSettings,
            'footerTextInfo' => $footerText,
          ];
        }

        if ($backendRoleInfo === null && Auth::guard('admin')->check()) {
          $authAdmin   = Auth::guard('admin')->user();
          $backendRoleInfo = !is_null($authAdmin->role_id) ? $authAdmin->role()->first() : null;
        }

        $view->with($backendSharedData);
        if ($backendRoleInfo !== null) {
          $view->with('roleInfo', $backendRoleInfo);
        }
      });

      // send this information to only vendors view files
      View::composer('seller.*', function ($view) {
        static $sellerSharedData = null;

        if ($sellerSharedData === null) {
          $language        = Cache::remember('seller_default_lang', 600, fn() => Language::where('is_default', 1)->first());
          $websiteSettings = Cache::remember('seller_website_settings', 600, fn() => DB::table('basic_settings')->select('base_currency_symbol', 'base_currency_symbol_position', 'base_currency_text', 'base_currency_text_position', 'base_currency_rate')->first());
          $seo             = Cache::remember('seller_seo_' . $language->id, 600, fn() => SEO::where('language_id', $language->id)->first());
          $footerText      = Cache::remember('seller_footer_' . $language->id, 600, fn() => FooterContent::where('language_id', $language->id)->first());

          $sellerSharedData = [
            'defaultLang'    => $language,
            'settings'       => $websiteSettings,
            'seo'            => $seo,
            'footerTextInfo' => $footerText,
          ];
        }

        $view->with($sellerSharedData);
      });


      // send this information to only front-end view files
      // PERF: static guard — ne tourne qu'une seule fois par requête HTTP
      // même si des dizaines de partials "frontend.*" sont inclus dans la même page.
      View::composer('frontend.*', function ($view) {
        static $frontendSharedData = null;

        if ($frontendSharedData === null) {
          $locale = Session::get('currentLocaleCode');

          // Données statiques : mises en cache 10 minutes (ne changent qu'en admin)
          $basicData = Cache::remember('frontend_basic_settings', 600, function () {
            return DB::table('basic_settings')
              ->select('theme_version', 'footer_logo', 'email_address', 'contact_number', 'address', 'primary_color', 'secondary_color', 'breadcrumb_overlay_color', 'whatsapp_status', 'whatsapp_number', 'whatsapp_header_title', 'whatsapp_popup_status', 'whatsapp_popup_message', 'support_ticket_status', 'is_language', 'is_service', 'breadcrumb_overlay_opacity', 'base_currency_symbol', 'base_currency_symbol_position', 'tax')
              ->first();
          });

          $allLanguages = Cache::remember('frontend_all_languages', 600, function () {
            return Language::all();
          });

          $socialMedias = Cache::remember('frontend_social_medias', 600, function () {
            return SocialMedia::query()->orderBy('serial_number', 'asc')->get();
          });

          $footerSectionStatus = Cache::remember('frontend_footer_section_status', 600, function () {
            return Section::query()->pluck('footer_section_status')->first();
          });

          // Langue courante : dépend de la session, pas mis en cache global
          $cacheKeyLang = 'frontend_lang_' . ($locale ?? 'default');
          $language = Cache::remember($cacheKeyLang, 600, function () use ($locale) {
            if (empty($locale)) {
              return Language::query()->where('is_default', 1)->first();
            }
            return Language::query()->where('code', $locale)->first();
          });

          // Données liées à la langue : mises en cache par langue
          $langId = $language->id;

          $menus = Cache::remember('frontend_menus_' . $langId, 600, function () use ($language) {
            $siteMenuInfo = $language->menuInfo;
            if (is_null($siteMenuInfo)) {
              return json_encode([]);
            }
            $m = $siteMenuInfo->menus;
            return str_replace(
              ['"Vendeurs"', '"Vendeur"', '"vendeurs"', '"vendeur"', '"Sellers"', '"Seller"', '"sellers"', '"seller"'],
              ['"Freelances"', '"Freelance"', '"freelances"', '"freelance"', '"Freelances"', '"Freelance"', '"freelances"', '"freelance"'],
              $m
            );
          });

          $popups      = Cache::remember('frontend_popups_' . $langId,      600, fn() => $language->announcementPopup()->where('status', 1)->orderBy('serial_number', 'asc')->get());
          $cookieAlert = Cache::remember('frontend_cookie_' . $langId,      600, fn() => $language->cookieAlertInfo()->first());
          $footerData  = Cache::remember('frontend_footer_' . $langId,      600, fn() => $language->footerContent()->first());
          $basicExtend = Cache::remember('frontend_basic_extend_' . $langId, 600, fn() => $language->basicExtend()->first());
          $quickLinks  = Cache::remember('frontend_quick_links_' . $langId,  600, fn() => $language->footerQuickLink()->orderBy('serial_number', 'asc')->get());
          $menuCats    = Cache::remember('frontend_menu_cats_' . $langId,    600, fn() => $language->serviceCategory()->where('add_to_menu', 1)->orderBy('serial_number', 'asc')->get());

          $frontendSharedData = [
            'basicInfo'           => $basicData,
            'allLanguageInfos'    => $allLanguages,
            'currentLanguageInfo' => $language,
            'socialMediaInfos'    => $socialMedias,
            'menuInfos'           => $menus,
            'menu_categories'     => $menuCats,
            'popupInfos'          => $popups,
            'cookieAlertInfo'     => $cookieAlert,
            'footerInfo'          => $footerData,
            'quickLinkInfos'      => $quickLinks,
            'footerSectionStatus' => $footerSectionStatus,
            'basicExtend'         => $basicExtend,
          ];
        }

        $view->with($frontendSharedData);
      });


      // send this information to both front-end & back-end view files
      View::share(['websiteInfo' => $data ?? (object)[]]);
    }
  }
}
