<!DOCTYPE html>
<html lang="{{ $currentLanguageInfo->code }}" @if ($currentLanguageInfo->direction == 1) dir="rtl" @endif>

<head>
  {{-- csrf-token for ajax request --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover, maximum-scale=5">
  <meta name="keywords" content="@yield('metaKeywords')">
  <meta name="description" content="@yield('metaDescription')">

  {{-- title --}}
  <title>@yield('pageHeading') {{ '| ' . ($websiteInfo->website_title ?? 'Junspro') }}</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/img/' . ($websiteInfo->favicon ?? 'favicon.png')) }}" type="image/x-icon">

  {{-- include styles --}}
  @if ($basicInfo->theme_version == 1)
    @includeIf('frontend.partials.styles.style-v1')
  @elseif ($basicInfo->theme_version == 2)
    @includeIf('frontend.partials.styles.style-v2')
  @elseif ($basicInfo->theme_version == 3)
    @includeIf('frontend.partials.styles.style-v3')
  @else
    {{-- Par défaut, utiliser la version 3 (la plus récente) --}}
    @includeIf('frontend.partials.styles.style-v3')
  @endif

  {{-- CSS Menu Utilisateur Premium --}}
  <link rel="stylesheet" href="{{ asset('assets/front/css/user-menu-premium.css') }}">
  {{-- CSS Sélecteur de Langue Premium --}}
  <link rel="stylesheet" href="{{ asset('assets/front/css/language-selector-premium.css') }}">
  {{-- CSS Chatbot Junspro Premium --}}
  <link rel="stylesheet" href="{{ asset('assets/front/css/junspro-chatbot-premium.css') }}?v=6.3">
  @php
    $primaryColor = $basicInfo->primary_color;
  @endphp
  <style>
    :root {
      --color-primary: #{{ $primaryColor }};
      --color-primary-rgb: {{ hexToRgb($primaryColor) }};
      --color-primary-junspro: #4F46E5;
      --color-primary-junspro-rgb: 79, 70, 229;
    }

    /* En-tête avec dégradé violet/bleu Junspro */
    body .header-area,
    html body .header-area,
    body .header-area.header_v1,
    html body .header-area.header_v1,
    body .header-area.header_v1:not(.is-sticky),
    html body .header-area.header_v1:not(.is-sticky) {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      background-color: transparent !important;
      background-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      position: relative;
      z-index: 1000 !important;
    }

    /* Main navbar avec dégradé */
    body .header-area .main-navbar,
    html body .header-area .main-navbar,
    body .header-area .main-responsive-nav,
    html body .header-area .main-responsive-nav,
    body .header-area .main-navbar .navbar,
    html body .header-area .main-navbar .navbar,
    body .header-area .main-navbar .container-fluid,
    html body .header-area .main-navbar .container-fluid {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      background-color: transparent !important;
      background-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
    }

    /* Assurer que le header reste au-dessus de tout */
    .header-area {
      z-index: 1000 !important;
    }

    .header-area.is-sticky {
      z-index: 1000 !important;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
    }

    .main-navbar {
      z-index: 1000 !important;
    }

    /* Liens de navigation - Couleur blanche pour visibilité */
    .header-area .nav-link {
      color: rgba(255, 255, 255, 0.9) !important;
      transition: color 0.3s ease !important;
    }

    .header-area .nav-link.active {
      color: #FFFFFF !important;
      font-weight: 600 !important;
    }

    .header-area .nav-link:hover {
      color: rgba(255, 255, 255, 1) !important;
    }
  </style>
  {{-- Fix transparence globale - Force background opaque sur html/body et masque preloader --}}
  <style>
    html {
      background: #ffffff !important;
      min-height: 100% !important;
      background-color: #ffffff !important;
    }
    body {
      background: #ffffff !important;
      background-color: #ffffff !important;
      opacity: 1 !important;
      min-height: 100vh !important;
      position: relative !important;
    }
    .main-wrapper {
      background: #ffffff !important;
      background-color: #ffffff !important;
      opacity: 1 !important;
      position: relative !important;
      min-height: 100vh !important;
    }
    /* S'assurer que request-loader est masqué par défaut */
    .request-loader:not(.show) {
      display: none !important;
    }
  </style>
  {{-- Additional styles from pages --}}
  @yield('style')
</head>

<body>

  <!-- Preloader start -->
  <div id="preLoader">
    <div class="loader"></div>
  </div>
  <!-- Preloader end -->
  <div class="request-loader">
    <div class="loader-inner">
      <span class="loader"></span>
    </div>
  </div>

  <div class="main-wrapper">
    <!-- Header-area start -->
    @if ($basicInfo->theme_version == 1)
      @includeIf('frontend.partials.header.header-nav-v1')
    @elseif ($basicInfo->theme_version == 2)
      @includeIf('frontend.partials.header.header-nav-v2')
    @elseif ($basicInfo->theme_version == 3)
      @includeIf('frontend.partials.header.header-nav-v3')
    @else
      {{-- Par défaut, utiliser la version 3 --}}
      @includeIf('frontend.partials.header.header-nav-v3')
    @endif
    <!-- Header-area end -->
    
    {{-- Navigation Freelance (remplace la navigation client) --}}
    @includeIf('frontend.freelance.partials.navbar')
    
    @yield('content')
  </div>

  {{-- announcement popup --}}
  @includeIf('frontend.partials.popups')

  {{-- cookie alert --}}
  @if (!is_null($cookieAlertInfo) && $cookieAlertInfo->cookie_alert_status == 1)
    @includeIf('cookie-consent::index')
  @endif

  <!-- Footer-area start -->
  @includeIf('frontend.partials.footer.footer-v3')
  <!-- Footer-area end-->

  <!-- Jquery JS -->
  @if ($basicInfo->theme_version == 1)
    @includeIf('frontend.partials.scripts.script-v1')
  @elseif ($basicInfo->theme_version == 2)
    @includeIf('frontend.partials.scripts.script-v2')
  @elseif ($basicInfo->theme_version == 3)
    @includeIf('frontend.partials.scripts.script-v3')
  @else
    {{-- Par défaut, utiliser la version 3 --}}
    @includeIf('frontend.partials.scripts.script-v3')
  @endif
  {{-- additional script --}}
  @yield('script')
  @stack('scripts')
  
  {{-- Fix transparence globale - Script pour forcer background opaque et masquer preloader --}}
  <script>
    (function() {
      // Forcer background opaque sur html et body immédiatement
      document.documentElement.style.setProperty('background', '#ffffff', 'important');
      document.documentElement.style.setProperty('background-color', '#ffffff', 'important');
      document.body.style.setProperty('background', '#ffffff', 'important');
      document.body.style.setProperty('background-color', '#ffffff', 'important');
      document.body.style.setProperty('opacity', '1', 'important');
      
      // Fonction pour forcer le masquage du preloader après chargement
      function forceHidePreloader() {
        const preloader = document.getElementById('preLoader');
        if (preloader) {
          preloader.style.display = 'none';
          preloader.style.visibility = 'hidden';
          preloader.style.opacity = '0';
        }
        
        // Masquer request-loader si visible
        const requestLoader = document.querySelector('.request-loader');
        if (requestLoader && !requestLoader.classList.contains('show')) {
          requestLoader.style.display = 'none';
        }
      }
      
      // Masquer le preloader immédiatement après DOM chargé
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', forceHidePreloader);
      } else {
        forceHidePreloader();
      }
      
      // Masquer aussi après chargement complet de la page
      window.addEventListener('load', function() {
        setTimeout(forceHidePreloader, 100);
      });
      
      // Masquer aussi après un délai de sécurité
      setTimeout(forceHidePreloader, 2000);
    })();
  </script>
  
  {{-- Chatbot Junspro Premium --}}
  <script>
    // Passer l'email de l'utilisateur connecté au chatbot
    window.junsproUserEmail = @json(Auth::guard('web')->check() ? Auth::guard('web')->user()->email : '');
  </script>
  <script type="text/javascript" src="{{ asset('assets/front/js/junspro-chatbot-premium.js') }}?v=6.3"></script>
</body>

</html>

