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
  <title>@yield('pageHeading') {{ '| ' . $websiteInfo->website_title }}</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/img/' . $websiteInfo->favicon) }}" type="image/x-icon">

  {{-- Blocage IMMÉDIAT des appels à /api/me/subscription pour éviter la boucle infinie --}}
  <script>
    (function() {
      // Sauvegarder fetch original si il existe
      if (window.fetch) {
        window._originalFetch = window.fetch;
      }
      
      // Remplacer fetch par une version qui bloque /api/me/subscription
      window.fetch = function(...args) {
        const url = args[0];
        
        // Bloquer complètement les appels à /api/me/subscription
        if (typeof url === 'string' && url.includes('/api/me/subscription')) {
          // Retourner immédiatement une réponse avec isPremium: false
          return Promise.resolve({
            ok: true,
            status: 200,
            statusText: 'OK',
            json: function() { return Promise.resolve({ isPremium: false }); },
            text: function() { return Promise.resolve('{"isPremium":false}'); },
            clone: function() { return this; }
          });
        }
        
        // Pour les autres URLs, utiliser fetch original
        if (window._originalFetch) {
          return window._originalFetch.apply(this, args);
        }
        
        // Fallback si fetch n'existe pas
        return Promise.reject(new Error('Fetch not available'));
      };
    })();
  </script>

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
  <link rel="stylesheet" href="{{ asset('assets/front/css/junspro-chatbot-premium.css') }}">
  @php
    $primaryColor = $basicInfo->primary_color;
  @endphp
  <style>
    :root {
      --color-primary: #{{ $primaryColor }};
      --color-primary-rgb: {{ hexToRgb($primaryColor) }};
      /* Force la couleur primaire à Junspro (bleu/violet) pour remplacer le vert */
      --color-primary-junspro: #4F46E5;
      --color-primary-junspro-rgb: 79, 70, 229;
    }

    /* Les styles du menu utilisateur premium sont maintenant dans user-menu-premium.css */

    /* Suppression définitive de la barre de catégories horizontale */
    .header-area .categories-menu {
      display: none !important;
    }

    .breadcrumbs-area::after {
      background-color: #{{ $basicInfo->breadcrumb_overlay_color }};
      opacity: {{ $basicInfo->breadcrumb_overlay_opacity }};
    }

    @media only screen and (max-width: 1200px) {
      #nav-logo {
        width: 70px;
        height: 55px;
      }
    }

    /* Remplacer toutes les couleurs vertes par les couleurs Junspro (bleu/violet) */
    .text-success {
      color: #4F46E5 !important;
    }

    .badge-success:not(.badge-warning):not(.badge-danger):not(.badge-info) {
      background: rgba(79, 70, 229, 0.12) !important;
      color: #4F46E5 !important;
    }

    /* Liens de navigation - Couleur blanche pour visibilité */
    .header-area .nav-link {
      color: rgba(255, 255, 255, 0.9) !important;
      transition: color 0.3s ease !important;
    }

    /* Override pour les liens de navigation actifs */
    .header-area .nav-link.active {
      color: #FFFFFF !important;
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
      color: rgba(255, 255, 255, 1) !important;
    }

    /* Override pour les catégories actives dans la sidebar */
    .category-child-link.active {
      color: #4F46E5 !important;
      background: #EEF2FF !important;
      border-left: 3px solid #4F46E5 !important;
    }

    /* Override pour les boutons success */
    .btn-success,
    .btn-success:hover,
    .btn-success:focus {
      background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
      border-color: #4F46E5 !important;
      color: #ffffff !important;
    }

    /* Override pour les éléments actifs avec couleur primaire si elle est verte */
    .nav-link.active[style*="green"],
    .nav-link.active[style*="#00B67A"],
    .nav-link.active[style*="#10b981"],
    .nav-link.active[style*="#28a745"] {
      color: #4F46E5 !important;
    }

    /* Bouton de recherche - Dégradé bleu royal → violet */
    .header-area .more-option .item .btn-search,
    .header-area .more-option .item .btn-search.btn-icon {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%) !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      color: #FFFFFF !important;
      box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3) !important;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .header-area .more-option .item .btn-search:hover,
    .header-area .more-option .item .btn-search.btn-icon:hover {
      background: linear-gradient(135deg, #2563eb 0%, #5b21b6 50%, #8b5cf6 100%) !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 4px 12px rgba(30, 64, 175, 0.4) !important;
    }

    .header-area .more-option .item .btn-search:focus,
    .header-area .more-option .item .btn-search.btn-icon:focus {
      background: linear-gradient(135deg, #2563eb 0%, #5b21b6 50%, #8b5cf6 100%) !important;
      box-shadow: 0 4px 16px rgba(30, 64, 175, 0.45) !important;
      outline: none !important;
    }

    /* Force la couleur primaire à Junspro partout où elle est utilisée */
    .header-area .nav-link.active,
    .header-area .nav-link:hover,
    .header-area .nav-link:focus,
    .gigs-sidebar .widget.widget-categories .widget-link li.active a,
    .gigs-sidebar .widget.widget-categories .widget-link li a:hover,
    .tabs-navigation .nav .nav-link.active,
    .page-item.active .page-link,
    .user-sidebar .links li a.active,
    .user-sidebar .links li:hover > a {
      color: #4F46E5 !important;
    }

    /* Override pour les backgrounds utilisant la couleur primaire */
    .tabs-navigation .nav .nav-link.active,
    .page-item.active .page-link,
    .tabs-navigation .nav[data-hover=fancyHover] .nav-item.active .nav-link {
      background-color: #4F46E5 !important;
    }

    /* Override pour les bordures */
    .header-area .main-navbar .menu-dropdown .nav-link.active {
      border-inline-start-color: #4F46E5 !important;
    }

    /* Override spécifique pour les sous-catégories dans les dropdowns */
    .header-area .categories-menu .categories .sub-menu-item .sub-menu a,
    .header-area .categories-menu .categories .sub-menu-item .sub-menu a.active,
    .header-area .categories-menu .categories .sub-menu-item .sub-menu a:hover {
      color: #4F46E5 !important;
      border-inline-start-color: #4F46E5 !important;
    }

    /* Override pour le fond actif des sous-catégories */
    .header-area .categories-menu .categories .sub-menu-item .sub-menu a.active,
    .header-area .categories-menu .categories .sub-menu-item .sub-menu a:hover {
      background-color: #EEF2FF !important;
    }

    /* Override pour les liens actifs dans les menu-dropdown */
    .header-area .main-navbar .menu-dropdown .nav-link.active,
    .header-area .main-navbar .menu-dropdown .nav-link:hover,
    .header-area .main-navbar .menu-dropdown .nav-link.active:hover {
      color: #4F46E5 !important;
      border-inline-start-color: #4F46E5 !important;
      background-color: #EEF2FF !important;
    }

    /* Override pour les menu-list et menu-item actifs */
    .menu-panel .menu-list .menu-item a.active,
    .menu-panel .menu-list .menu-item a:hover,
    .sub-menu .menu-list .menu-item a.active,
    .sub-menu .menu-list .menu-item a:hover {
      color: #4F46E5 !important;
      background-color: #EEF2FF !important;
      border-left: 3px solid #4F46E5 !important;
    }

    /* Override global pour TOUS les liens dans les sous-menus de catégories */
    .header-area .categories-menu .sub-menu a,
    .header-area .categories-menu .sub-menu .menu-list a,
    .header-area .categories-menu .sub-menu .menu-item a,
    .header-area .categories-menu .menu-panel a,
    .header-area .categories-menu .menu-panel .menu-list a,
    .header-area .categories-menu .menu-panel .menu-item a {
      color: #374151 !important;
    }

    /* Override pour les liens actifs dans les sous-menus (détection par URL ou classe active) */
    .header-area .categories-menu .sub-menu a[class*="active"],
    .header-area .categories-menu .sub-menu a.active,
    .header-area .categories-menu .menu-panel a[class*="active"],
    .header-area .categories-menu .menu-panel a.active {
      color: #4F46E5 !important;
      background-color: #EEF2FF !important;
      border-left: 3px solid #4F46E5 !important;
      padding-left: 17px !important;
    }

    /* Override pour les hover dans les sous-menus */
    .header-area .categories-menu .sub-menu a:hover,
    .header-area .categories-menu .menu-panel a:hover {
      color: #4F46E5 !important;
      background-color: #F9FAFF !important;
    }

    /* Force la couleur pour les éléments avec style inline vert */
    .header-area .categories-menu .sub-menu a[style*="green"],
    .header-area .categories-menu .sub-menu a[style*="#00B67A"],
    .header-area .categories-menu .sub-menu a[style*="#10b981"],
    .header-area .categories-menu .menu-panel a[style*="green"],
    .header-area .categories-menu .menu-panel a[style*="#00B67A"],
    .header-area .categories-menu .menu-panel a[style*="#10b981"] {
      color: #4F46E5 !important;
      background-color: #EEF2FF !important;
      border-left: 3px solid #4F46E5 !important;
    }

    /* Override ULTRA-SPECIFIQUE pour forcer la couleur Junspro sur TOUS les liens de sous-catégories */
    .header-area .categories-menu .categories .sub-menu-item .sub-menu.menu-panel .menu-list .menu-item a,
    .header-area .categories-menu .categories .sub-menu-item .sub-menu.menu-panel .menu-list li.menu-item a,
    .header-area .categories-menu .categories .sub-menu-item .sub-menu .menu-list .menu-item a,
    .header-area .categories-menu .categories .sub-menu-item .sub-menu .menu-list li.menu-item a {
      color: #374151 !important;
      border-left: 2px solid transparent !important;
    }

    /* Override pour les états actifs/hover avec spécificité maximale */
    .header-area .categories-menu .categories .sub-menu-item .sub-menu.menu-panel .menu-list .menu-item a:hover,
    .header-area .categories-menu .categories .sub-menu-item .sub-menu.menu-panel .menu-list li.menu-item a:hover,
    .header-area .categories-menu .categories .sub-menu-item .sub-menu .menu-list .menu-item a:hover,
    .header-area .categories-menu .categories .sub-menu-item .sub-menu .menu-list li.menu-item a:hover {
      color: #4F46E5 !important;
      background-color: #F9FAFF !important;
      border-left-color: #4F46E5 !important;
    }

    /* Override pour les éléments actifs (peuvent être détectés par URL ou classe) */
    body .header-area .categories-menu .categories .sub-menu-item .sub-menu.menu-panel .menu-list .menu-item a.active,
    body .header-area .categories-menu .categories .sub-menu-item .sub-menu.menu-panel .menu-list li.menu-item a.active,
    body .header-area .categories-menu .categories .sub-menu-item .sub-menu .menu-list .menu-item a.active,
    body .header-area .categories-menu .categories .sub-menu-item .sub-menu .menu-list li.menu-item a.active,
    body .header-area .categories-menu .categories .sub-menu-item .sub-menu.menu-panel .menu-list .menu-item a[class*="active"],
    body .header-area .categories-menu .categories .sub-menu-item .sub-menu.menu-panel .menu-list li.menu-item a[class*="active"] {
      color: #4F46E5 !important;
      background-color: #EEF2FF !important;
      border-left: 3px solid #4F46E5 !important;
      padding-left: 17px !important;
      font-weight: 600 !important;
    }

    /* Override ULTRA-SPECIFIQUE pour le bouton "Freelance" - Force les couleurs Junspro */
    html body .header-area .more-option .item .dropdown .btn-outline,
    html body .header-area .more-option .item .dropdown .btn-outline.show,
    html body .header-area .more-option .item .dropdown .btn-outline:hover,
    html body .header-area .more-option .item .dropdown .btn-outline:focus,
    html body .header-area .more-option .item .dropdown .btn-outline.active,
    html body .header-area .more-option .item .dropdown .btn-outline.btn:first-child:active,
    html body .header-area .more-option .btn-outline,
    html body .header-area .more-option .btn-outline.show,
    html body .header-area .more-option .btn-outline:hover,
    html body .header-area .more-option .btn-outline:focus,
    html body .header-area .more-option .btn-outline.active {
      border-color: #E5E7EB !important;
      color: #6B7280 !important;
      background-color: transparent !important;
      background: transparent !important;
      background-image: none !important;
      box-shadow: none !important;
    }

    /* Force la couleur si le bouton a un fond vert (override maximal) */
    html body .header-area .more-option .btn-outline[style*="green"],
    html body .header-area .more-option .btn-outline[style*="#00B67A"],
    html body .header-area .more-option .btn-outline[style*="#10b981"],
    html body .header-area .more-option .btn-outline[style*="#9CCC65"],
    html body .header-area .more-option .btn-outline[style*="background-color"],
    html body .header-area .more-option .btn-outline[style*="background:"],
    html body .header-area .more-option .btn-outline[style*="var(--color-primary)"] {
      background-color: transparent !important;
      background: transparent !important;
      background-image: none !important;
      border-color: #E5E7EB !important;
      color: #6B7280 !important;
      box-shadow: none !important;
    }

    /* Override pour le hover du bouton Freelance - utiliser les couleurs Junspro */
    html body .header-area .more-option .btn-outline:hover {
      background: transparent !important;
      background-color: transparent !important;
      background-image: none !important;
      border-color: #4F46E5 !important;
      color: #4F46E5 !important;
      box-shadow: 0 0 0 1px rgba(79, 70, 229, 0.1) !important;
    }

    /* Override pour le bouton "Client" (btn-primary) - remplacer le vert par Junspro */
    html body .header-area .more-option .btn-primary,
    html body .header-area .more-option .btn-primary:hover,
    html body .header-area .more-option .btn-primary:focus,
    html body .header-area .more-option .btn-primary.active,
    html body .header-area .more-option .btn-primary.show {
      background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
      background-color: #4F46E5 !important;
      background-image: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
      border-color: #4F46E5 !important;
      color: #ffffff !important;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3) !important;
    }

    /* Override pour le bouton Client avec styles inline verts */
    html body .header-area .more-option .btn-primary[style*="green"],
    html body .header-area .more-option .btn-primary[style*="#00B67A"],
    html body .header-area .more-option .btn-primary[style*="#10b981"],
    html body .header-area .more-option .btn-primary[style*="#28a745"] {
      background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
      background-color: #4F46E5 !important;
      border-color: #4F46E5 !important;
      color: #ffffff !important;
    }

    /* Override pour le box-shadow inset vert */
    html body .header-area .more-option .btn-outline:hover,
    html body .header-area .more-option .btn-outline.show {
      box-shadow: 0 0 0 1px rgba(79, 70, 229, 0.1) !important;
    }

    /* Override pour tous les éléments avec couleur verte détectée */
    *[style*="color: #00B67A"],
    *[style*="color: #10b981"],
    *[style*="color: #28a745"],
    *[style*="color: #22c55e"],
    *[style*="background: #00B67A"],
    *[style*="background: #10b981"],
    *[style*="background: #28a745"],
    *[style*="background: #22c55e"],
    *[style*="background-color: #00B67A"],
    *[style*="background-color: #10b981"],
    *[style*="background-color: #28a745"],
    *[style*="background-color: #22c55e"] {
      color: #4F46E5 !important;
      background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
      background-color: #4F46E5 !important;
    }

    /* Remplacement JavaScript pour "Vendeurs" → "Freelances" dans tout le DOM */
    @if (request()->is('*seller*') || request()->is('*sellers*'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Fonction pour remplacer le texte dans un nœud
        function replaceTextInNode(node) {
          if (node.nodeType === Node.TEXT_NODE) {
            let text = node.textContent;
            text = text.replace(/Vendeurs/g, 'Freelances');
            text = text.replace(/Vendeur/g, 'Freelance');
            text = text.replace(/vendeurs/g, 'freelances');
            text = text.replace(/vendeur/g, 'freelance');
            if (text !== node.textContent) {
              node.textContent = text;
            }
          } else {
            for (let child of node.childNodes) {
              replaceTextInNode(child);
            }
          }
        }
        
        // Observer pour les changements dynamiques
        const observer = new MutationObserver(function(mutations) {
          mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
              if (node.nodeType === Node.ELEMENT_NODE || node.nodeType === Node.TEXT_NODE) {
                replaceTextInNode(node);
              }
            });
          });
        });
        
        // Observer tout le document
        observer.observe(document.body, {
          childList: true,
          subtree: true
        });
        
        // Remplacement initial
        replaceTextInNode(document.body);
      });
    </script>
    @endif
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
  {{-- WhatsApp widget supprimé - remplacé par chatbot Junspro --}}

  <!-- Footer-area start -->
  @if ($basicInfo->theme_version == 1)
    @includeIf('frontend.partials.footer.footer-v1')
  @elseif ($basicInfo->theme_version == 2)
    @includeIf('frontend.partials.footer.footer-v2')
  @elseif ($basicInfo->theme_version == 3)
    @includeIf('frontend.partials.footer.footer-v3')
  @else
    {{-- Par défaut, utiliser la version 3 --}}
    @includeIf('frontend.partials.footer.footer-v3')
  @endif
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
  
  {{-- Chatbot Junspro Premium --}}
  <script type="text/javascript" src="{{ asset('assets/front/js/junspro-chatbot-premium.js') }}"></script>
</body>

</html>
