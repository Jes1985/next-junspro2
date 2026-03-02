<!DOCTYPE html>
<html lang="{{ $currentLanguageInfo->code }}" @if ($currentLanguageInfo->direction == 1) dir="rtl" @endif>

<head>
  {{-- csrf-token for ajax request --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <link rel="stylesheet" href="{{ asset('assets/front/css/junspro-logo-premium.css') }}">
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

    /* En-tête fond blanc, textes noirs — copie exacte de layout.blade.php */
    body .header-area,
    html body .header-area,
    body .header-area.header_v1,
    html body .header-area.header_v1,
    body .header-area.header_v1:not(.is-sticky),
    html body .header-area.header_v1:not(.is-sticky) {
      background: #FFFFFF !important;
      background-color: #FFFFFF !important;
      background-image: none !important;
      position: relative;
      z-index: 1000 !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
      border-bottom: 2px solid #7c3aed;
    }

    body .header-area .main-navbar,
    html body .header-area .main-navbar,
    body .header-area .main-responsive-nav,
    html body .header-area .main-responsive-nav,
    body .header-area .main-navbar .navbar,
    html body .header-area .main-navbar .navbar,
    body .header-area .main-navbar .container-fluid,
    html body .header-area .main-navbar .container-fluid {
      background: #FFFFFF !important;
      background-color: #FFFFFF !important;
      background-image: none !important;
    }

    .header-area {
      z-index: 1000 !important;
    }

    .header-area.is-sticky {
      z-index: 1000 !important;
      background: #FFFFFF !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
    }

    .main-navbar {
      z-index: 1000 !important;
    }

    .header-area .nav-link {
      color: #111827 !important;
      transition: color 0.3s ease !important;
    }

    .header-area .nav-link.active {
      color: #111827 !important;
      font-weight: 600 !important;
      position: relative !important;
    }

    .header-area .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: 20px;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(90deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      border-radius: 2px;
    }

    .header-area .nav-link:hover {
      color: #4F46E5 !important;
    }

    .header-area .more-option .item .btn-search,
    .header-area .more-option .item .btn-search.btn-icon {
      background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
      border: 1px solid rgba(79, 70, 229, 0.3) !important;
      color: #FFFFFF !important;
      box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3) !important;
    }

    .pause-souffle-header-capsule-item {
      display: flex;
      align-items: center;
    }

    /* Fix transparence body */
    html {
      background: #ffffff !important;
      background-color: #ffffff !important;
    }
    body {
      background: #ffffff !important;
      background-color: #ffffff !important;
      opacity: 1 !important;
    }
    body::before {
      display: none !important;
      content: none !important;
    }
    .main-wrapper {
      background: #ffffff !important;
      opacity: 1 !important;
      position: relative !important;
      min-height: 100vh !important;
    }
    #preLoader,
    .request-loader {
      display: none !important;
      visibility: hidden !important;
      opacity: 0 !important;
      width: 0 !important;
      height: 0 !important;
      pointer-events: none !important;
    }

    /* ── Logo identique à /services ── */
    .junspro-logo-top {
      display: inline-flex !important;
      flex-direction: row !important;
      align-items: center !important;
      gap: 14px !important;
    }
    .junspro-logo-text-wrapper {
      display: inline-flex !important;
      flex-direction: row !important;
      align-items: center !important;
    }
    .brand-icon-wrapper {
      position: relative !important;
      display: inline-block !important;
      line-height: 0 !important;
    }
    .brand-icon-wrapper .junspro-logo-icon {
      filter: none !important;
      box-shadow: none !important;
    }
    /* Overlay "+" premium - barre verticale */
    .brand-icon-wrapper::before {
      content: '' !important;
      position: absolute !important;
      top: 50% !important;
      left: 50% !important;
      transform: translate(-50%, -50%) translateY(-1px) !important;
      width: 1.8px !important;
      height: 20px !important;
      background: #1A1A1A !important;
      filter: drop-shadow(0 0.5px 1.5px rgba(0, 0, 0, 0.10)) !important;
      pointer-events: none !important;
      z-index: 1 !important;
      will-change: transform !important;
    }
    /* Overlay "+" premium - barre horizontale */
    .brand-icon-wrapper::after {
      content: '' !important;
      position: absolute !important;
      top: 50% !important;
      left: 50% !important;
      transform: translate(-50%, -50%) translateY(-1px) !important;
      width: 20px !important;
      height: 1.8px !important;
      background: #1A1A1A !important;
      filter: drop-shadow(0 0.5px 1.5px rgba(0, 0, 0, 0.10)) !important;
      pointer-events: none !important;
      z-index: 1 !important;
      will-change: transform !important;
    }
    .junspro-logo-icon {
      height: 62px !important;
      width: auto !important;
      max-height: 62px !important;
      object-fit: contain !important;
      display: block !important;
      transform: translateY(-1px) !important;
      mix-blend-mode: normal !important;
      filter: none !important;
    }
    .navbar-brand.junspro-logo-brand {
      display: flex !important;
      align-items: center !important;
      padding-right: 0 !important;
      margin-right: 20px !important;
    }
    /* Texte JUNSPRO — couleur sombre, poids moyen, sans dégradé */
    .junspro-logo-text,
    .junspro-logo .junspro-logo-text,
    .navbar-brand .junspro-logo-text,
    .junspro-logo-brand .junspro-logo-text,
    .header-area .junspro-logo-text,
    .header-area.header-light .junspro-logo-text {
      color: #0B0F1A !important;
      font-weight: 600 !important;
      font-size: 25px !important;
      letter-spacing: 0.08em !important;
      text-transform: uppercase !important;
      font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
      line-height: 1 !important;
      display: inline-block !important;
      text-shadow: none !important;
      /* Annuler tout effet de dégradé webkit */
      background: none !important;
      -webkit-background-clip: unset !important;
      background-clip: unset !important;
      -webkit-text-fill-color: #0B0F1A !important;
    }
    /* Barre sous JUNSPRO — masquée */
    .junspro-logo-line,
    .junspro-logo-text-wrapper .junspro-logo-line,
    .junspro-logo .junspro-logo-text-wrapper .junspro-logo-line,
    .navbar-brand .junspro-logo-text-wrapper .junspro-logo-line,
    .junspro-logo-brand .junspro-logo-text-wrapper .junspro-logo-line,
    .header-area .junspro-logo-line,
    .header-area.header-light .junspro-logo-line {
      display: none !important;
    }
    @media (max-width: 768px) {
      .junspro-logo-text,
      .junspro-logo .junspro-logo-text,
      .navbar-brand .junspro-logo-text,
      .junspro-logo-brand .junspro-logo-text {
        font-size: 20px !important;
        letter-spacing: 0.06em !important;
        -webkit-text-fill-color: #0B0F1A !important;
      }
      .junspro-logo-icon {
        height: 28px !important;
        max-height: 28px !important;
        transform: translateY(0) !important;
      }
      .brand-icon-wrapper::before {
        width: 1.5px !important;
        height: 10px !important;
        background: #1A1A1A !important;
        filter: drop-shadow(0 0.5px 1px rgba(0, 0, 0, 0.10)) !important;
        transform: translate(-50%, -50%) translateY(0) !important;
      }
      .brand-icon-wrapper::after {
        width: 10px !important;
        height: 1.5px !important;
        background: #1A1A1A !important;
        filter: drop-shadow(0 0.5px 1px rgba(0, 0, 0, 0.10)) !important;
        transform: translate(-50%, -50%) translateY(0) !important;
      }
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

      // Supprimer toute masse sombre résiduelle ajoutée après le footer
      function stripDarkBlocksAfterFooter() {
        const footer = document.querySelector('.junspro-footer');
        if (!footer) return;
        let node = footer.nextElementSibling;
        while (node) {
          const style = window.getComputedStyle(node);
          const bg = style.backgroundColor || '';
          const match = bg.match(/rgb\((\d+),\s*(\d+),\s*(\d+)/);
          const rect = node.getBoundingClientRect();
          if (match && rect.height > window.innerHeight * 0.3 && rect.width > window.innerWidth * 0.3) {
            const [r, g, b] = match.slice(1).map(Number);
            const darkness = (r + g + b) / 3;
            if (darkness < 32) {
              node.style.display = 'none';
            }
          }
          node = node.nextElementSibling;
        }
      }

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', stripDarkBlocksAfterFooter);
      } else {
        stripDarkBlocksAfterFooter();
      }
      window.addEventListener('load', stripDarkBlocksAfterFooter);
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

