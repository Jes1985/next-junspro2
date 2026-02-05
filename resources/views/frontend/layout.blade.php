<!DOCTYPE html>
<html lang="{{ $currentLanguageInfo->code ?? 'fr' }}" @if (($currentLanguageInfo->direction ?? 0) == 1) dir="rtl" @endif>

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

  {{-- Intercepteur fetch pour /api/me/subscription - désactivé car route API créée --}}

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
      /* Force la couleur primaire à Junspro (bleu/violet) pour remplacer le vert */
      --color-primary-junspro: #4F46E5;
      --color-primary-junspro-rgb: 79, 70, 229;
    }

    /* Les styles du menu utilisateur premium sont maintenant dans user-menu-premium.css */

    /* ============================================
       SUPPRESSION DÉFINITIVE DE LA BARRE DE CATÉGORIES
       ============================================ */
    /* Suppression complète de la barre de catégories horizontale - TOUTES VARIANTES */
    .header-area .categories-menu,
    .categories-menu,
    .header-area .categories-menu-nav,
    .categories-menu-nav,
    .header-area .categories,
    ul.categories,
    .category-menu,
    .category-nav,
    .categories-menu-wrapper,
    .header-area .categories-menu-wrapper,
    nav.categories-menu-nav,
    .header-area nav.categories-menu-nav,
    .categories-menu-nav ul,
    .categories-menu ul,
    .header-area .categories-menu-nav ul,
    .header-area .categories-menu ul,
    .categories-menu-nav .categories,
    .categories-menu .categories,
    .header-area .categories-menu-nav .categories,
    .header-area .categories-menu .categories,
    .categories-menu-nav .sub-menu-item,
    .categories-menu .sub-menu-item,
    .header-area .categories-menu-nav .sub-menu-item,
    .header-area .categories-menu .sub-menu-item {
      display: none !important;
      visibility: hidden !important;
      height: 0 !important;
      max-height: 0 !important;
      overflow: hidden !important;
      margin: 0 !important;
      padding: 0 !important;
      opacity: 0 !important;
      pointer-events: none !important;
      position: absolute !important;
      left: -9999px !important;
      width: 0 !important;
      max-width: 0 !important;
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

    /* En-tête fond blanc, textes noirs */
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
    }

    /* Main navbar fond blanc */
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

    /* Assurer que le header reste au-dessus de tout */
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

    /* Liens de navigation - texte noir */
    .header-area .nav-link {
      color: #111827 !important;
      transition: color 0.3s ease !important;
    }

    /* Override pour les liens de navigation actifs */
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

    /* Style des liens Freelance dans la navbar */
    .nav-link-freelance {
      color: inherit;
      text-decoration: none;
      transition: color 0.2s ease, text-decoration 0.2s ease;
    }
    
    .nav-link-freelance:hover {
      color: var(--color-primary-junspro, #4F46E5) !important;
      text-decoration: underline;
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

    /* Bouton de recherche - Dégradé violet (visible sur fond blanc) */
    /* Style pour la capsule Pause Souffle dans le header */
    .pause-souffle-header-capsule-item {
      display: flex;
      align-items: center;
    }
    
    @media (max-width: 991px) {
      .pause-souffle-header-capsule-item {
        order: -1; /* Afficher en premier sur mobile */
        margin-bottom: 0.5rem;
      }
    }

    .header-area .more-option .item .btn-search,
    .header-area .more-option .item .btn-search.btn-icon {
      background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
      border: 1px solid rgba(79, 70, 229, 0.3) !important;
      color: #FFFFFF !important;
      box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3) !important;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .header-area .more-option .item .btn-search:hover,
    .header-area .more-option .item .btn-search.btn-icon:hover {
      background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%) !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4) !important;
    }

    .header-area .more-option .item .btn-search:focus,
    .header-area .more-option .item .btn-search.btn-icon:focus {
      background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%) !important;
      box-shadow: 0 4px 16px rgba(79, 70, 229, 0.45) !important;
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

    /* Bouton "Freelance" / langue - texte noir sur fond blanc */
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
      border-color: #D1D5DB !important;
      color: #111827 !important;
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

    /* Hover du bouton Freelance / langue */
    html body .header-area .more-option .btn-outline:hover {
      background: transparent !important;
      background-color: transparent !important;
      background-image: none !important;
      border-color: #4F46E5 !important;
      color: #4F46E5 !important;
      box-shadow: 0 0 0 1px rgba(79, 70, 229, 0.15) !important;
    }

    /* Menu hamburger mobile - traits noirs sur fond blanc */
    .header-area .menu-toggler {
      background: transparent !important;
    }
    .header-area .menu-toggler span {
      background: #111827 !important;
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

    /* ============================================
       LOGO JUNSPRO - Style Luxe Doux (PNG optimisé)
       ============================================ */
    /* Conteneur logo - flex row pour aligner texte + icône */
    .junspro-logo,
    .junspro-logo-brand .junspro-logo {
      display: inline-flex !important;
      flex-direction: row !important;
      align-items: center !important;
    }
    /* Ligne texte + logo image (alignement horizontal premium avec espacement luxe) */
    .junspro-logo-top {
      display: inline-flex !important;
      flex-direction: row !important;
      align-items: center !important;
      gap: 14px !important;
    }
    /* Wrapper texte (simplifié, plus de colonne nécessaire) */
    .junspro-logo-text-wrapper {
      display: inline-flex !important;
      flex-direction: row !important;
      align-items: center !important;
    }
    /* Wrapper pour l'icône infini avec overlay "+" premium */
    /* IMPORTANT : L'ombre est UNIQUEMENT sur le "+" (pseudo-éléments), JAMAIS sur le PNG */
    .brand-icon-wrapper {
      position: relative !important;
      display: inline-block !important;
      line-height: 0 !important;
    }
    /* S'assurer qu'aucune ombre n'est appliquée sur l'image PNG elle-même */
    .brand-icon-wrapper .junspro-logo-icon {
      filter: none !important;
      box-shadow: none !important;
    }
    /* Icône / logo PNG - rendu luxe doux (hauteur augmentée +15%, netteté optimale) */
    .junspro-logo-icon {
      height: 62px !important;
      width: auto !important;
      max-height: 62px !important;
      object-fit: contain !important;
      display: block !important;
      image-rendering: -webkit-optimize-contrast !important;
      image-rendering: auto !important;
      -webkit-font-smoothing: antialiased !important;
      -moz-osx-font-smoothing: grayscale !important;
      transform: translateY(-1px) !important;
      transition: opacity 0.2s ease !important;
      backface-visibility: hidden !important;
      -webkit-backface-visibility: hidden !important;
    }
    /* Overlay "+" premium - noir doux avec micro-ombre UNIQUEMENT sur le "+" (luxe doux) */
    /* Barre verticale du "+" */
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
    /* Barre horizontale du "+" */
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
    /* Conteneur navbar-brand pour alignement vertical parfait */
    .navbar-brand.junspro-logo-brand {
      display: flex !important;
      align-items: center !important;
      padding-right: 0 !important;
      margin-right: 20px !important;
    }
    /* Logo JUNSPRO - typographie premium ultra */
    .junspro-logo-text,
    .junspro-logo .junspro-logo-text,
    .navbar-brand .junspro-logo-text,
    .junspro-logo-brand .junspro-logo-text {
      color: #0B0F1A !important;
      font-weight: 600 !important;
      font-size: 25px !important;
      letter-spacing: 0.08em !important;
      text-transform: uppercase !important;
      font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
      line-height: 1 !important;
      position: relative !important;
      display: inline-block !important;
      text-shadow: none !important;
    }

    /* Ligne sous le texte JUNSPRO - MASQUÉE (premium sans barre) */
    .junspro-logo-line,
    .junspro-logo-text-wrapper .junspro-logo-line,
    .junspro-logo .junspro-logo-text-wrapper .junspro-logo-line,
    .navbar-brand .junspro-logo-text-wrapper .junspro-logo-line,
    .junspro-logo-brand .junspro-logo-text-wrapper .junspro-logo-line {
      display: none !important;
    }

    /* Responsive - ajustement de la taille sur mobile (luxe doux préservé) */
    @media (max-width: 768px) {
      .junspro-logo-text,
      .junspro-logo .junspro-logo-text,
      .navbar-brand .junspro-logo-text,
      .junspro-logo-brand .junspro-logo-text {
        font-size: 20px !important;
        letter-spacing: 0.06em !important;
      }
      /* Logo PNG mobile - taille réduite mais nette (éviter upscale) */
      .junspro-logo-icon {
        height: 28px !important;
        max-height: 28px !important;
        transform: translateY(0) !important;
      }
      /* Overlay "+" mobile - taille proportionnelle réduite (luxe doux préservé) */
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
      .junspro-logo-top { gap: 10px !important; }
      .navbar-brand.junspro-logo-brand {
        margin-right: 12px !important;
      }
      
      /* Barre toujours masquée sur mobile */
      .junspro-logo-line,
      .junspro-logo-text-wrapper .junspro-logo-line,
      .junspro-logo .junspro-logo-text-wrapper .junspro-logo-line,
      .navbar-brand .junspro-logo-text-wrapper .junspro-logo-line,
      .junspro-logo-brand .junspro-logo-text-wrapper .junspro-logo-line {
        display: none !important;
      }
    }

    /* Hover logo - transition premium douce */
    .junspro-logo:hover .junspro-logo-text,
    .junspro-logo-brand:hover .junspro-logo-text,
    .navbar-brand:hover .junspro-logo-text {
      color: #4F46E5 !important;
      transition: color 0.3s ease !important;
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
  {{-- TOUJOURS utiliser footer-v3 pour cohérence du design premium --}}
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
  
  {{-- Suppression complète de la barre de catégories - VERSION RENFORCÉE --}}
  <script>
    (function() {
      // Fonction pour supprimer la barre de catégories
      function removeCategoriesMenu() {
        // Sélecteurs multiples pour trouver toutes les variantes
        const selectors = [
          '.categories-menu',
          '.categories-menu-nav',
          '.header-area .categories-menu',
          '.header-area .categories-menu-nav',
          'nav.categories-menu-nav',
          '.category-menu',
          '.category-nav',
          '.categories-menu-wrapper',
          '.header-area .categories-menu-wrapper',
          '[class*="categories-menu"]',
          '[class*="category-menu"]'
        ];
        
        selectors.forEach(selector => {
          try {
            const elements = document.querySelectorAll(selector);
            elements.forEach(el => {
              if (el && el.parentNode) {
                // Forcer le masquage avant suppression
                el.style.display = 'none';
                el.style.visibility = 'hidden';
                el.style.height = '0';
                el.style.opacity = '0';
                el.style.pointerEvents = 'none';
                // Supprimer du DOM
                el.parentNode.removeChild(el);
              }
            });
          } catch(e) {
            console.warn('Erreur lors de la suppression:', e);
          }
        });
      }
      
      // Supprimer immédiatement
      removeCategoriesMenu();
      
      // Supprimer au chargement du DOM
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
          removeCategoriesMenu();
          // Forcer aussi via CSS
          const style = document.createElement('style');
          style.textContent = `
            .categories-menu,
            .categories-menu-nav,
            .header-area .categories-menu,
            .header-area .categories-menu-nav,
            nav.categories-menu-nav,
            .category-menu,
            .category-nav { 
              display: none !important; 
              visibility: hidden !important; 
              height: 0 !important; 
              opacity: 0 !important; 
            }
          `;
          document.head.appendChild(style);
        });
      } else {
        removeCategoriesMenu();
        // Forcer aussi via CSS
        const style = document.createElement('style');
        style.textContent = `
          .categories-menu,
          .categories-menu-nav,
          .header-area .categories-menu,
          .header-area .categories-menu-nav,
          nav.categories-menu-nav,
          .category-menu,
          .category-nav { 
            display: none !important; 
            visibility: hidden !important; 
            height: 0 !important; 
            opacity: 0 !important; 
          }
        `;
        document.head.appendChild(style);
      }
      
      // Supprimer aussi après des délais pour les éléments chargés dynamiquement
      setTimeout(removeCategoriesMenu, 50);
      setTimeout(removeCategoriesMenu, 200);
      setTimeout(removeCategoriesMenu, 500);
      setTimeout(removeCategoriesMenu, 1000);
      setTimeout(removeCategoriesMenu, 2000);
      
      // Observer pour supprimer les éléments ajoutés dynamiquement
      const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
          mutation.addedNodes.forEach(function(node) {
            if (node.nodeType === 1) { // Element node
              const classes = node.className || '';
              if (typeof classes === 'string' && (
                classes.includes('categories-menu') ||
                classes.includes('category-menu') ||
                classes.includes('categories-menu-nav')
              )) {
                // Masquer immédiatement
                node.style.display = 'none';
                node.style.visibility = 'hidden';
                node.style.height = '0';
                node.style.opacity = '0';
                // Supprimer du DOM
                if (node.parentNode) {
                  node.parentNode.removeChild(node);
                }
              }
              // Vérifier aussi les enfants
              if (node.querySelectorAll) {
                const children = node.querySelectorAll('.categories-menu, .categories-menu-nav, .category-menu');
                children.forEach(child => {
                  child.style.display = 'none';
                  if (child.parentNode) {
                    child.parentNode.removeChild(child);
                  }
                });
              }
            }
          });
        });
      });
      
      observer.observe(document.body, {
        childList: true,
        subtree: true,
        attributes: true,
        attributeFilter: ['class']
      });
    })();
  </script>
  
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


</body>

</html>
