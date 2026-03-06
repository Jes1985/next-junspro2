@extends('frontend.layout')

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->services_page_title }}
  @endif
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_services }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_services }}
  @endif
@endsection

@section('content')
  @php
    $title = $pageHeading->services_page_title ?? __('No Page Title Found');
    $servicesCount = isset($services) && count($services) > 0 ? $services->total() : 0;
  @endphp

  <!-- Hero Services Premium -->
  <section class="services-hero-premium">
    <div class="services-hero-container">
      <div class="services-hero-content">
          <h1 class="services-hero-title">
            <span class="hero-title-line-1">{{ __('Trouvez le') }} <span class="highlight">{{ __('service idéal') }}</span></span>
            <span class="hero-title-line-2">{{ __('pour votre Rituel') }}</span>
          </h1>
        <p class="services-hero-subtitle">
          {{ __('Filtrez par prix horaire, langues, pays et découvrez les profils les plus adaptés à votre besoin.') }}
        </p>
        <div class="services-hero-stats">
          <span class="hero-stat-text">{{ __('+10 000 freelances vérifiés') }}</span>
            </div>
      </div>
    </div>
  </section>

  <!-- Page Services Junspro - Version Premium -->
  <div class="services-page-premium">
    <div class="services-container-premium">
      <div class="services-layout-premium">
        
        <!-- Colonne Filtres (gauche) - UNIQUEMENT filtres, pas de catégories -->
        <aside class="services-sidebar-premium">
          <div class="sidebar-content">
            <div class="sidebar-header-mobile">
              <h3>{{ __('Filtres') }}</h3>
              <button class="sidebar-close-btn" type="button" aria-label="Fermer">
                <i class="fas fa-times"></i>
              </button>
            </div>

            <!-- Catégories - Version Premium -->
                @if (count($categories) > 0)
              <div class="filter-section">
                <h4 class="filter-title">{{ __('Catégories') }}</h4>
                <div class="categories-premium-card">
                  <!-- Option "Tout" -->
                  <div class="category-parent-item {{ empty(request()->input('category')) ? 'active' : '' }}">
                    <a href="{{ route('services') }}" class="category-parent-link">
                      <div class="category-parent-content">
                        <span class="category-icon">📋</span>
                        <span class="category-name">{{ strtoupper(__('Tout')) }}</span>
                      </div>
                    </a>
                  </div>

                      @foreach ($categories as $category)
                    @php
                      $shouldHide = $loop->index >= 5; // Masquer après les 5 premières catégories 
                      $subcategories = $category->subcategories ?? [];
                      $currentCategorySlug = request()->input('category');
                      $currentSubcategorySlug = request()->input('subcategory');
                      $isCategoryActive = $category->slug == $currentCategorySlug;
                      $isCategoryOpen = $isCategoryActive || (empty($currentCategorySlug) && $loop->first);
                      $categoryIconMap = [
                        'graphisme' => '🎨',
                        'design' => '🎨',
                        'marketing' => '📣',
                        'programmation' => '💻',
                        'tech' => '💻',
                        'technologie' => '💻',
                        'video' => '🎬',
                        'animation' => '🎬',
                        'redaction' => '✍️',
                        'traduction' => '🌐',
                        'musique' => '🎵',
                        'audio' => '🎵',
                        'business' => '💼',
                        'coaching' => '🎯',
                        'conseil' => '💡',
                        'style de vie' => '✨',
                        'lifestyle' => '✨',
                        'donnees' => '📊',
                        'analyse' => '📊',
                        'data' => '📊',
                        'analytics' => '📊',
                        'ingenierie' => '🏗️',
                        'architecture' => '🏛️',
                        'engineering' => '🏗️',
                        'ia' => '🤖',
                        'intelligence' => '🤖',
                        'ai' => '🤖',
                        'artificielle' => '🤖',
                        'photographie' => '📸',
                        'photo' => '📸',
                        'trading' => '📈',
                        'finance' => '💰',
                        'financier' => '💰',
                        'comptabilite' => '📋',
                        'accounting' => '📋',
                        'juridique' => '⚖️',
                        'legal' => '⚖️',
                        'droit' => '⚖️',
                        'sante' => '🏥',
                        'health' => '🏥',
                        'medical' => '🏥',
                        'education' => '📚',
                        'enseignement' => '📚',
                        'formation' => '📚',
                        'sport' => '⚽',
                        'fitness' => '💪',
                        'nutrition' => '🥗',
                        'cuisine' => '🍳',
                        'food' => '🍳',
                        'voyage' => '✈️',
                        'travel' => '✈️',
                        'immobilier' => '🏠',
                        'real estate' => '🏠',
                        'beaute' => '💄',
                        'beauty' => '💄',
                        'mode' => '👗',
                        'fashion' => '👗',
                      ];
                      $categoryNameLower = strtolower($category->name);
                      $categorySlugLower = strtolower($category->slug ?? '');
                      $categoryIcon = '📁'; // Icône par défaut
                      
                      // Chercher d'abord dans le nom, puis dans le slug
                      $found = false;
                      foreach ($categoryIconMap as $key => $icon) {
                        if (strpos($categoryNameLower, $key) !== false || strpos($categorySlugLower, $key) !== false) {
                          $categoryIcon = $icon;
                          $found = true;
                          break;
                        }
                      }
                      
                      // Si pas trouvé, essayer de détecter par mots-clés
                      if (!$found) {
                        if (preg_match('/\b(style|lifestyle|vie)\b/i', $categoryNameLower)) {
                          $categoryIcon = '✨';
                        } elseif (preg_match('/\b(donnee|data|analyse|analytics|statistique)\b/i', $categoryNameLower)) {
                          $categoryIcon = '📊';
                        } elseif (preg_match('/\b(ingenierie|engineering|architecture|construction|batiment)\b/i', $categoryNameLower)) {
                          $categoryIcon = '🏗️';
                        } elseif (preg_match('/\b(ia|ai|intelligence|artificielle|machine|learning|deep)\b/i', $categoryNameLower)) {
                          $categoryIcon = '🤖';
                        } elseif (preg_match('/\b(photo|photographie|image|cliche)\b/i', $categoryNameLower)) {
                          $categoryIcon = '📸';
                        } elseif (preg_match('/\b(trading|finance|bourse|investissement|forex|crypto)\b/i', $categoryNameLower)) {
                          $categoryIcon = '📈';
                        }
                      }
                    @endphp
                    <div class="category-parent-item {{ $isCategoryActive ? 'active' : '' }} {{ $isCategoryOpen ? 'open' : '' }} {{ $shouldHide ? 'category-hidden' : '' }}" 
                         data-category-id="category-{{ $category->id }}">
                      <button type="button" class="category-parent-toggle" data-category-id="category-{{ $category->id }}">
                        <div class="category-parent-content">
                          <span class="category-icon">{{ $categoryIcon }}</span>
                          <span class="category-name">{{ strtoupper($category->name) }}</span>
                        </div>
                        <svg class="category-chevron" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                      </button>

                          @if (count($subcategories) > 0)
                        <div class="category-children {{ $isCategoryOpen ? 'open' : '' }}">
                              @foreach ($subcategories as $subcategory)
                            <a href="{{ route('services', ['category' => $category->slug, 'subcategory' => $subcategory->slug]) }}" 
                               class="category-child-link {{ ($subcategory->slug == $currentSubcategorySlug && $isCategoryActive) ? 'active' : '' }}">
                                    {{ $subcategory->name }}
                                  </a>
                              @endforeach
                        </div>
                          @endif
                    </div>
                      @endforeach
                  
                  @if (count($categories) > 5)
                    <button type="button" class="show-more-categories-btn" id="show-more-categories-btn">
                      <span class="btn-text-show">{{ __('Afficher plus') }}</span>
                      <span class="btn-text-hide" style="display: none;">{{ __('Afficher moins') }}</span>
                    </button>
                  @endif
                </div>
                  </div>
                @endif

            <!-- Compétences -->
            <div class="filter-section">
              <h4 class="filter-title">{{ __('Compétences') }}</h4>
              <div class="filter-content">
                <!-- Barre de recherche pour les compétences -->
                <div class="skills-search-wrapper">
                  <input type="text" 
                         id="skills-search-input" 
                         class="filter-search-input" 
                         placeholder="{{ __('Rechercher une compétence...') }}">
                </div>
                <div class="filter-checkboxes" id="skills-checkboxes-container">
                    @foreach ($skills as $skill)
                    <label class="filter-checkbox-item" data-skill-name="{{ strtolower($skill->name) }}">
                      <input type="checkbox" 
                             class="filter-checkbox" 
                             name="skills[]" 
                             value="{{ $skill->id }}"
                             @checked(in_array($skill->id, (array)request()->input('skills', [])))>
                      <span>{{ $skill->name }}</span>
                    </label>
                    @endforeach
                </div>
              </div>
                </div>

            <!-- Tarif horaire -->
            <div class="filter-section">
              <h4 class="filter-title">{{ __('Tarif horaire') }}</h4>
              <div class="filter-content">
                <div id="hourly-rate-slider" class="price-slider"></div>
                <div class="price-range-display">
                  <span>{{ __('Tarif') }} :</span>
                  <input type="text" id="hourly-rate-amount" readonly class="price-input">
                  <span class="price-unit">€/h</span>
                  </div>
                <div class="filter-info-text">
                  <small>{{ __('Tarifs entre 10€ et 299€ par heure') }}</small>
                  </div>
                  </div>
                </div>

            <!-- Heures par semaine (disponibilité) -->
            <div class="filter-section">
              <h4 class="filter-title">{{ __('Disponibilité') }}</h4>
              <div class="filter-content">
                <div class="filter-options">
                  <label class="filter-option">
                    <input type="radio" class="filter-radio" name="hours_per_week" value="" {{ empty(request()->input('hours_per_week')) ? 'checked' : '' }}>
                    <span>{{ __('Toutes les disponibilités') }}</span>
                  </label>
                  <label class="filter-option">
                    <input type="radio" class="filter-radio" name="hours_per_week" value="1-8" {{ request()->input('hours_per_week') == '1-8' ? 'checked' : '' }}>
                    <span>{{ __('1 à 8h/semaine') }}</span>
                  </label>
                  <label class="filter-option">
                    <input type="radio" class="filter-radio" name="hours_per_week" value="8-16" {{ request()->input('hours_per_week') == '8-16' ? 'checked' : '' }}>
                    <span>{{ __('8 à 16h/semaine') }}</span>
                  </label>
                  <label class="filter-option">
                    <input type="radio" class="filter-radio" name="hours_per_week" value="16-24" {{ request()->input('hours_per_week') == '16-24' ? 'checked' : '' }}>
                    <span>{{ __('16 à 24h/semaine') }}</span>
                  </label>
                </div>
                  </div>
                  </div>

            <!-- Pays -->
            @if (isset($countries) && count($countries) > 0)
              <div class="filter-section">
                <h4 class="filter-title">{{ __('Pays') }}</h4>
                <div class="filter-content">
                  <select class="filter-select" name="country">
                    <option value="">{{ __('Tous les pays') }}</option>
                    @foreach ($countries as $country)
                      <option value="{{ $country }}" {{ request()->input('country') == $country ? 'selected' : '' }}>
                        {{ $country }}
                      </option>
                    @endforeach
                  </select>
                  </div>
                  </div>
            @endif

            <!-- Langues -->
            @if (isset($languages) && count($languages) > 0)
              <div class="filter-section">
                <h4 class="filter-title">{{ __('Langues') }}</h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    @foreach ($languages as $lang)
                      <label class="filter-checkbox-item">
                        <input type="checkbox" 
                               class="filter-checkbox" 
                               name="languages[]" 
                               value="{{ $lang }}"
                               @checked(in_array($lang, (array)request()->input('languages', [])))>
                        <span>{{ $lang }}</span>
                      </label>
                    @endforeach
                  </div>
                  </div>
                </div>
            @endif

            <!-- Délai de livraison -->
            <div class="filter-section">
              <h4 class="filter-title">{{ __('Délai de livraison') }}</h4>
              <div class="filter-content">
                <div class="filter-checkboxes">
                  <label class="filter-checkbox-item">
                    <input type="radio" 
                           class="filter-radio" 
                           name="delivery_mode" 
                           value="standard"
                           @checked(request()->input('delivery_mode') == 'standard' || empty(request()->input('delivery_mode')))>
                    <span>📦 {{ __('Standard') }} <small class="text-muted">({{ __('Livraison hebdomadaire') }})</small></span>
                  </label>
                  <label class="filter-checkbox-item">
                    <input type="radio" 
                           class="filter-radio" 
                           name="delivery_mode" 
                           value="express_72h"
                           @checked(request()->input('delivery_mode') == 'express_72h')>
                    <span>⚡ {{ __('Express 72h') }} <small class="text-muted">(+10%)</small></span>
                  </label>
                  <label class="filter-checkbox-item">
                    <input type="radio" 
                           class="filter-radio" 
                           name="delivery_mode" 
                           value="express_48h"
                           @checked(request()->input('delivery_mode') == 'express_48h')>
                    <span>⚡⚡ {{ __('Express 48h') }} <small class="text-muted">(+20%)</small></span>
                  </label>
                  <label class="filter-checkbox-item">
                    <input type="radio" 
                           class="filter-radio" 
                           name="delivery_mode" 
                           value="express_24h"
                           @checked(request()->input('delivery_mode') == 'express_24h')>
                    <span>🚀 {{ __('Express 24h') }} <small class="text-muted">(+30%)</small></span>
                  </label>
                </div>
              </div>
                </div>

            <!-- Évaluation -->
            <div class="filter-section">
              <h4 class="filter-title">{{ __('Évaluation') }}</h4>
              <div class="filter-content">
                <div class="filter-options">
                  <label class="filter-option">
                    <input type="radio" class="filter-radio rating-search" name="filter_rating" value="" {{ empty(request()->input('rating')) ? 'checked' : '' }}>
                    <span>{{ __('Toutes') }}</span>
                  </label>
                  <label class="filter-option">
                    <input type="radio" class="filter-radio rating-search" name="filter_rating" value="5" {{ request()->input('rating') == 5 ? 'checked' : '' }}>
                    <span>{{ __('5 étoiles') }}</span>
                  </label>
                  <label class="filter-option">
                    <input type="radio" class="filter-radio rating-search" name="filter_rating" value="4" {{ request()->input('rating') == 4 ? 'checked' : '' }}>
                    <span>{{ __('4 étoiles et plus') }}</span>
                  </label>
                  <label class="filter-option">
                    <input type="radio" class="filter-radio rating-search" name="filter_rating" value="3" {{ request()->input('rating') == 3 ? 'checked' : '' }}>
                    <span>{{ __('3 étoiles et plus') }}</span>
                  </label>
              </div>
            </div>
          </div>

            <!-- Bouton Reset -->
            <div class="filter-reset">
              <button type="button" class="reset-filters-btn">
                <i class="fas fa-redo-alt"></i>
                <span>{{ __('Réinitialiser') }}</span>
              </button>
        </div>
          </div>
        </aside>

        <!-- Zone Principale (droite) -->
        <main class="services-main-premium">
          <!-- Barre de recherche mobile -->
          <div class="search-bar-mobile">
                <form action="" id="serviceSearch">
              <div class="search-input-wrapper">
                <input type="text" 
                       placeholder="{{ __('Rechercher un service...') }}"
                       class="search-input"
                      value="{{ !empty(request()->input('keyword')) ? request()->input('keyword') : '' }}"
                      name="keyword">
                <button type="submit" class="search-btn">
                  <i class="fas fa-search"></i>
                </button>
                  </div>
                </form>
            <button class="filter-toggle-btn" type="button" aria-label="Ouvrir les filtres">
              <i class="fas fa-filter"></i>
            </button>
              </div>

          <!-- Stats de catégorie (optionnel, peut être supprimé si redondant) -->
          @if (!empty($currentCategory))
            <div class="current-category-info">
              <h2 class="current-category-title">{{ $currentCategory->name }}</h2>
              <p class="current-category-description">
                {{ __('Logos, identités visuelles et visuels pour vos campagnes, créés par des freelances triés sur le volet.') }}
              </p>
            </div>
          @endif

          <!-- Barre de contexte + Tri -->
          <div class="services-context-bar">
            <div class="context-bar-left">
              <span class="context-text">
                @if ($servicesCount == 0)
                  {{ __('Aucun service trouvé pour le moment') }}
                @else
                  {{ $servicesCount }} {{ $servicesCount == 1 ? __('service trouvé') : __('services trouvés') }}
                @endif
              </span>
            </div>
            <div class="context-bar-right">
              <select class="sort-select" id="sort-search">
                <option selected disabled>{{ __('Trier par') }}</option>
                  <option {{ request()->input('sort') == 'new' ? 'selected' : '' }} value="new">
                  {{ __('Plus récents') }}
                  </option>
                  <option {{ request()->input('sort') == 'old' ? 'selected' : '' }} value="old">
                  {{ __('Plus anciens') }}
                  </option>
                  <option {{ request()->input('sort') == 'ascending' ? 'selected' : '' }} value="ascending">
                  {{ __('Prix croissant') }}
                  </option>
                  <option {{ request()->input('sort') == 'descending' ? 'selected' : '' }} value="descending">
                  {{ __('Prix décroissant') }}
                  </option>
                </select>
              </div>
            </div>

          <!-- Zone Résultats -->
          <div class="services-results">
            @if (count($services) == 0)
              <!-- Empty State Premium -->
              <div class="empty-state-premium">
                <div class="empty-state-icon">
                  <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="40" cy="40" r="38" stroke="#E5E7EB" stroke-width="2"/>
                    <path d="M28 40L36 48L52 32" stroke="#9CA3AF" stroke-width="3" stroke-linecap="round"/>
                  </svg>
                </div>
                <h2 class="empty-state-title">
                  @if ($servicesCount == 0 && empty(request()->input('category')))
                    {{ __('Aucun service disponible pour le moment') }}
            @else
                    {{ __('Aucun service ne correspond à vos filtres.') }}
                  @endif
                </h2>
                <p class="empty-state-description">
                  @if ($servicesCount == 0 && empty(request()->input('category')))
                    {{ __('Les services seront bientôt disponibles sur la plateforme.') }}
                                @else
                    {{ __('Essayez de modifier vos critères ou de réinitialiser la recherche.') }}
                                @endif
                </p>
                <div class="empty-state-actions">
                  @if (!empty(request()->input('category')) || !empty(request()->input('keyword')))
                    <a href="{{ route('services') }}" class="btn-primary-premium">
                      {{ __('Réinitialiser les filtres') }}
                    </a>
                                @endif
                  @if (!empty($currentCategory) && $servicesCount == 0)
                    <a href="{{ route('services') }}" class="btn-secondary-premium">
                      {{ __('Voir toutes les catégories') }}
                    </a>
                          @endif
                            @auth('web')
                    @if (Auth::guard('web')->user()->is_seller ?? false)
                      <a href="{{ route('seller.service.create') ?? '#' }}" class="btn-secondary-premium">
                        {{ __('Créer mon premier service') }}
                      </a>
                    @endif
                  @endauth
                        </div>
                          </div>

              <!-- Services Populaires (si disponibles) -->
              @if (isset($popularServices) && count($popularServices) > 0)
                <div class="popular-services-premium">
                  <div class="popular-header">
                    <h3 class="popular-title">{{ __('Services populaires') }}</h3>
                    @if (!empty($currentCategory))
                      <p class="popular-subtitle">{{ __('dans') }} {{ $currentCategory->name }}</p>
                          @endif
                        </div>
                  <div class="services-grid-premium">
                    @foreach ($popularServices as $service)
                      @include('frontend.service.partials.service-card', [
                        'service' => $service,
                        'currencyInfo' => $currencyInfo ?? null,
                        'languageId' => $languageId ?? 1
                      ])
                    @endforeach
                      </div>
                    </div>
              @endif

            @else
              <!-- Grille de Services Premium -->
              <div class="services-grid-premium">
                @foreach ($services as $service)
                  @include('frontend.service.partials.service-card', [
                    'service' => $service,
                    'currencyInfo' => $currencyInfo ?? null,
                    'languageId' => $languageId ?? 1
                  ])
                @endforeach
              </div>

              <!-- Pagination -->
              @if ($services->hasPages())
                <div class="services-pagination">
                      {{ $services->appends([
                              'keyword' => request()->input('keyword'),
                              'category' => request()->input('category'),
                              'subcategory' => request()->input('subcategory'),
                              'tag' => request()->input('tag'),
                              'rating' => request()->input('rating'),
                              'min' => request()->input('min'),
                              'max' => request()->input('max'),
                              'sort' => request()->input('sort'),
                          ])->links() }}
              </div>
              @endif
            @endif
          </div>
        </main>
        </div>
          </div>
      </div>

  <!-- Formulaire de recherche caché -->
  <form class="d-none" action="{{ route('services') }}" method="GET" id="searchForm">
    <input type="hidden" id="keyword-id" name="keyword" value="{{ !empty(request()->input('keyword')) ? request()->input('keyword') : '' }}">
    <input type="hidden" id="category-id" name="category" value="{{ !empty(request()->input('category')) ? request()->input('category') : '' }}">
    <input type="hidden" id="subcategory-id" name="subcategory" value="{{ !empty(request()->input('subcategory')) ? request()->input('subcategory') : '' }}">
    <input type="hidden" id="tag-id" name="tag" value="{{ !empty(request()->input('tag')) ? request()->input('tag') : '' }}">
    <input type="hidden" id="hours_per_week-id" name="hours_per_week" value="{{ !empty(request()->input('hours_per_week')) ? request()->input('hours_per_week') : '' }}">
    <input type="hidden" id="country-id" name="country" value="{{ !empty(request()->input('country')) ? request()->input('country') : '' }}">
    <input type="hidden" id="delivery-mode-id" name="delivery_mode" value="{{ !empty(request()->input('delivery_mode')) ? request()->input('delivery_mode') : '' }}">
    <input type="hidden" id="rating-id" name="rating" value="{{ !empty(request()->input('rating')) ? request()->input('rating') : '' }}">
    <input type="hidden" id="min-hourly-rate" name="min_hourly_rate" value="{{ !empty(request()->input('min_hourly_rate')) ? request()->input('min_hourly_rate') : '10' }}">
    <input type="hidden" id="max-hourly-rate" name="max_hourly_rate" value="{{ !empty(request()->input('max_hourly_rate')) ? request()->input('max_hourly_rate') : '299' }}">
    <input type="hidden" id="sort-id" name="sort" value="{{ !empty(request()->input('sort')) ? request()->input('sort') : '' }}">
    <textarea class="d-none" name="skills" id="skills" cols="30" rows="10">
      @if (request()->filled('skills') && !empty(request()->input('skills')))
        {{ json_encode(request()->input('skills')) }}
      @endif
    </textarea>
    <textarea class="d-none" name="languages" id="languages" cols="30" rows="10">
      @if (request()->filled('languages') && !empty(request()->input('languages')))
        {{ json_encode(request()->input('languages')) }}
      @endif
    </textarea>
    <button type="submit" id="submitBtn"></button>
  </form>

  <!-- Styles Premium -->
  <style>
    /* Variables Premium */
    :root {
      --premium-primary: #1e40af;
      --premium-primary-dark: #1e3a8a;
      --premium-secondary: #7c3aed;
      --premium-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --premium-gradient-soft: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(245, 243, 255, 0.6) 100%);
      --premium-text: #111827;
      --premium-text-medium: #4B5563;
      --premium-text-light: #6B7280;
      --premium-border: #E5E7EB;
      --premium-bg: #FFFFFF;
      --premium-bg-light: #F9FAFB;
      --premium-shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
      --premium-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
      --premium-shadow-lg: 0 10px 20px rgba(30, 64, 175, 0.15);
      --premium-shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
    }

    /* Reset et base */
    .services-page-premium * {
      box-sizing: border-box;
    }

    /* Layout Global Premium */
    .services-page-premium {
      background: var(--premium-bg-light);
      min-height: calc(100vh - 200px);
      padding: 60px 0 80px;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Inter', 'Helvetica Neue', Arial, sans-serif;
      margin-top: 0;
      position: relative;
      z-index: 1;
    }

    /* Correction pour éviter que le dropdown des catégories recouvre le hero */
    /* Le dropdown reste fonctionnel, mais on ajoute de l'espace pour éviter la superposition */
    /* NE PAS surcharger le CSS global, juste ajuster le z-index et l'espacement */
    .header-area .categories-menu .sub-menu.menu-panel {
      z-index: 998 !important;
    }

    .services-container-premium {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 24px;
    }

    .services-layout-premium {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 32px;
      align-items: start;
    }

    /* Sidebar Filtres Premium - Design consolidé */
    .services-sidebar-premium {
      position: sticky;
      top: 120px; /* Espacement réduit car plus de barre de catégories */
      background: var(--premium-bg);
      border-radius: 24px;
      padding: 28px 24px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid var(--premium-border);
      max-height: calc(100vh - 140px);
      overflow-y: auto;
      overflow-x: hidden;
      align-self: start;
    }

    /* Scrollbar personnalisée pour la sidebar */
    .services-sidebar-premium::-webkit-scrollbar {
      width: 6px;
    }

    .services-sidebar-premium::-webkit-scrollbar-track {
      background: var(--premium-bg-light);
      border-radius: 3px;
    }

    .services-sidebar-premium::-webkit-scrollbar-thumb {
      background: var(--premium-border);
      border-radius: 3px;
    }

    .services-sidebar-premium::-webkit-scrollbar-thumb:hover {
      background: var(--premium-text-light);
    }

    .sidebar-header-mobile {
      display: none;
    }

    .filter-section {
      margin-bottom: 28px;
    }

    .filter-section:last-of-type {
      margin-bottom: 0;
    }

    .filter-title {
      font-size: 13px;
      font-weight: 700;
      color: var(--premium-text);
      text-transform: uppercase;
      letter-spacing: 0.8px;
      margin: 0 0 18px 0;
      padding-bottom: 10px;
      border-bottom: 2px solid transparent;
      border-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%) 1;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .filter-title::before {
      content: '';
      width: 3px;
      height: 16px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      border-radius: 2px;
    }

    .filter-content {
      margin-top: 0;
    }


    /* Catégories Premium - Version Haut de Gamme */
    .categories-premium-card {
      background: #FFFFFF;
      border-radius: 18px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      padding: 12px;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .category-parent-item {
      margin-bottom: 4px;
    }

    .category-parent-item:last-child {
      margin-bottom: 0;
    }

    .category-parent-item.category-hidden {
      display: none;
    }

    .category-parent-item.category-hidden.visible {
      display: block;
    }

    .show-more-categories-btn {
      width: 100%;
      margin-top: 12px;
      padding: 10px 16px;
      background: transparent;
      border: 1px solid var(--premium-border);
      border-radius: 10px;
      color: var(--premium-text-medium);
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.25s ease;
      text-align: center;
      font-family: inherit;
    }

    .show-more-categories-btn:hover {
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.08) 0%, rgba(124, 58, 237, 0.08) 100%);
      border-color: #1e40af;
      color: #1e40af;
    }

    .show-more-categories-btn .btn-text-show,
    .show-more-categories-btn .btn-text-hide {
      display: inline-block;
    }

    .category-parent-link {
      display: block;
      text-decoration: none;
      width: 100%;
    }

    .category-parent-toggle {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 12px;
      background: transparent;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
      text-align: left;
      font-family: inherit;
    }

    .category-parent-content {
      display: flex;
      align-items: center;
      gap: 10px;
      flex: 1;
    }

    .category-icon {
      font-size: 16px;
      line-height: 1;
      flex-shrink: 0;
    }

    .category-name {
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.5px;
      color: #374151;
      transition: color 0.25s ease;
    }

    .category-chevron {
      width: 12px;
      height: 12px;
      color: #9CA3AF;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), color 0.25s ease;
      flex-shrink: 0;
      transform: rotate(0deg);
    }

    .category-parent-item.open .category-chevron {
      transform: rotate(90deg);
    }

    .category-parent-item.open .category-children {
      display: block !important;
      visibility: visible !important;
    }

    .category-parent-item.open .category-parent-toggle {
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
    }

    .category-parent-item.open .category-name {
      color: #1e40af;
      font-weight: 700;
    }

    .category-parent-item.open .category-chevron {
      color: #1e40af;
    }

    .category-parent-toggle:hover {
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.08) 0%, rgba(124, 58, 237, 0.08) 100%);
    }

    .category-parent-toggle:hover .category-name {
      color: #1e40af;
    }

    .category-parent-toggle:hover .category-chevron {
      color: #1e40af;
    }

    .category-parent-item.active .category-parent-toggle {
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.12) 0%, rgba(124, 58, 237, 0.12) 100%);
      border-radius: 12px;
    }

    .category-parent-item.active .category-name {
      color: #1e40af;
      font-weight: 700;
    }

    .category-parent-item.active .category-chevron {
      color: #1e40af;
    }

    .category-parent-item.active .category-icon {
      filter: grayscale(0);
    }

    .category-parent-link {
      padding: 10px 12px;
      border-radius: 12px;
      transition: all 0.25s ease;
      display: block;
    }

    .category-parent-link:hover {
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.08) 0%, rgba(124, 58, 237, 0.08) 100%);
    }

    .category-parent-link:hover .category-name {
      color: #1e40af;
    }

    .category-parent-item.active .category-parent-link {
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.12) 0%, rgba(124, 58, 237, 0.12) 100%);
    }

    .category-parent-item.active .category-parent-link .category-name {
      color: #1e40af;
      font-weight: 700;
    }

    /* Sous-catégories */
    .category-children {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease;
      opacity: 0;
      padding-left: 0;
      display: block;
      visibility: hidden;
    }

    .category-children.open,
    .category-parent-item.open .category-children {
      max-height: 2000px !important;
      opacity: 1 !important;
      padding-left: 0;
      margin-top: 4px;
      display: block !important;
      visibility: visible !important;
    }

    .category-child-link {
      display: block;
      padding: 8px 12px 8px 42px;
      color: #6B7280;
      text-decoration: none;
      font-size: 13px;
      line-height: 1.5;
      border-radius: 8px;
      transition: all 0.2s ease;
      position: relative;
      margin-bottom: 2px;
    }

    .category-child-link:hover {
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.06) 0%, rgba(124, 58, 237, 0.06) 100%);
      color: #1e40af;
    }

    .category-child-link.active {
      color: #1e40af;
      font-weight: 600;
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
      border-left: 3px solid transparent;
      border-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%) 1;
      padding-left: 39px;
    }

    .category-child-link.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 3px;
      height: 60%;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      border-radius: 0 2px 2px 0;
    }

    .show-more-categories-btn,
    .show-more-skills-btn {
      width: 100%;
      margin-top: 12px;
      padding: 8px;
      background: transparent;
      border: none;
      color: var(--premium-text-medium);
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: color 0.2s ease;
      text-align: left;
    }

    .show-more-categories-btn:hover,
    .show-more-skills-btn:hover {
      color: var(--premium-primary);
    }


    /* ─ Pill rose — filtres checkboxes (service index) ─ */
    .filter-checkboxes {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 0;
    }

    .filter-checkboxes.collapsed {
      max-height: none;
    }

    .filter-checkboxes::-webkit-scrollbar { display: none; }

    .filter-checkbox-item {
      display: inline-flex;
      align-items: center;
      gap: 0;
      padding: 0;
      border-radius: 0;
      cursor: pointer;
      user-select: none;
    }

    .filter-checkbox-item span {
      display: inline-flex;
      align-items: center;
      padding: 6px 13px;
      border: 1.5px solid #f3e8f0;
      background: #fdf9fc;
      color: #374151;
      border-radius: 10px;
      font-size: .84rem;
      cursor: pointer;
      transition: all .18s ease;
      white-space: nowrap;
    }

    .filter-checkbox-item span:hover { border-color: rgba(236,72,153,.45); background: rgba(236,72,153,.05); color: #EC4899; }

    .filter-checkbox {
      position: absolute;
      opacity: 0;
      pointer-events: none;
      width: 0;
      height: 0;
    }

    .filter-checkbox-item:has(.filter-checkbox:checked) {
      background: none;
    }

    .filter-checkbox-item:has(.filter-checkbox:checked) span {
      border-color: #EC4899;
      background: rgba(236,72,153,.09);
      color: #EC4899;
      font-weight: 700;
      box-shadow: 0 2px 8px rgba(236,72,153,.18);
    }

    .filter-select {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid var(--premium-border);
      border-radius: 8px;
      font-size: 14px;
      color: var(--premium-text);
      background: var(--premium-bg);
      transition: border-color 0.2s ease;
    }

    .filter-select:focus {
      outline: none;
      border-color: var(--premium-primary);
    }

    .filter-options {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .filter-option {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 12px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 14px;
      color: var(--premium-text-medium);
    }

    .filter-option:hover {
      background: var(--premium-bg-light);
    }

    .filter-radio {
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: var(--premium-primary);
    }

    /* Radios dans filter-checkbox-item : masqués, pill checked rose */
    .filter-checkbox-item .filter-radio {
      position: absolute; opacity: 0; pointer-events: none; width: 0; height: 0;
    }

    .filter-checkbox-item:has(.filter-radio:checked) span {
      border-color: #EC4899;
      background: rgba(236,72,153,.09);
      color: #EC4899;
      font-weight: 700;
      box-shadow: 0 2px 8px rgba(236,72,153,.18);
    }

    .filter-option:has(.filter-radio:checked) {
      background: rgba(236,72,153,.05);
      color: #EC4899;
      font-weight: 500;
    }

    .price-slider {
      margin: 16px 0;
    }

    .price-range-display {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 14px;
      color: var(--premium-text-medium);
      margin-top: 12px;
    }

    .price-input {
      border: none;
      background: transparent;
      font-weight: 600;
      color: var(--premium-primary);
      font-size: 14px;
      width: 100px;
      text-align: right;
    }

    .price-unit {
      font-size: 12px;
      color: var(--premium-text-light);
      font-weight: 400;
    }

    .filter-info-text {
      margin-top: 8px;
    }

    .filter-info-text small {
      color: var(--premium-text-light);
      font-size: 12px;
      font-style: italic;
    }

    .filter-reset {
      margin-top: 24px;
      padding-top: 24px;
      border-top: 1px solid var(--premium-border);
    }

    .reset-filters-btn {
      width: 100%;
      padding: 10px 16px;
      background: transparent;
      border: 1px solid var(--premium-border);
      border-radius: 8px;
      color: var(--premium-text-medium);
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.2s ease;
    }

    .reset-filters-btn:hover {
      border-color: var(--premium-primary);
      color: var(--premium-primary);
      background: var(--premium-bg-light);
    }

    /* Zone Principale */
    .services-main-premium {
      min-width: 0;
    }

    .search-bar-mobile {
      display: none;
    }

    /* Hero Services Premium - Style page d'accueil (raffiné et classe) */
    .services-hero-premium {
      background: linear-gradient(135deg, #020617 0%, #111827 30%, #1d2a6d 70%, #5b21b6 100%);
      position: relative;
      overflow: hidden;
      padding: 120px 0 90px;
      margin-top: 0;
      min-height: 60vh;
      display: flex;
      align-items: center;
      z-index: 1;
    }

    /* S'assurer que le header ne se superpose pas au hero */
    body .services-hero-premium {
      margin-top: 0 !important;
      padding-top: 120px !important;
    }

    /* SUPPRESSION DÉFINITIVE de la barre de catégories horizontale */
    body .header-area .categories-menu {
      display: none !important;
      visibility: hidden !important;
      height: 0 !important;
      overflow: hidden !important;
    }

    /* Texture abstraite bleu/violet (comme le drapé doré de ComeUp) */
    .services-hero-premium::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 50%, rgba(79, 70, 229, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(124, 58, 237, 0.12) 0%, transparent 50%),
        linear-gradient(135deg, rgba(65, 105, 225, 0.08) 0%, transparent 50%);
      opacity: 0.6;
      z-index: 1;
    }

    /* Dégradé noir transparent sur la moitié gauche pour garantir la lisibilité */
    .services-hero-premium::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 55%;
      height: 100%;
      background: linear-gradient(to right, rgba(2, 6, 23, 0.4) 0%, transparent 100%);
      z-index: 1;
    }

    .services-hero-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
      position: relative;
      z-index: 2;
    }

    .services-hero-content {
      text-align: center;
      color: white;
      max-width: 900px;
      margin: 0 auto;
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .services-hero-title {
      font-size: 3.8rem;
      font-weight: 400;
      color: #FFFFFF;
      line-height: 1.2;
      margin-bottom: 2rem;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      display: block;
      letter-spacing: -0.02em;
      max-width: 100%;
      width: 100%;
      text-align: center;
    }

    /* Style ComeUp : 2 lignes avec mot-clé en couleur accent */
    .services-hero-title .hero-title-line-1 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #FFFFFF;
      margin-bottom: 0.75rem;
      white-space: nowrap;
    }

    .services-hero-title .hero-title-line-1 .highlight {
      font-weight: 600;
      background: linear-gradient(135deg, #60A5FA 0%, #A78BFA 50%, #C084FC 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      color: #60A5FA;
      display: inline-block;
    }

    .services-hero-title .hero-title-line-2 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #FFFFFF;
      white-space: nowrap;
    }

    .services-hero-subtitle {
      font-size: 1.15rem;
      color: rgba(255, 255, 255, 0.85);
      margin-bottom: 2.5rem;
      text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
      font-weight: 400;
      line-height: 1.6;
      max-width: 90%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }

    .services-hero-stats {
      margin-top: 1rem;
    }

    .hero-stat-text {
      display: inline-block;
      padding: 10px 24px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 50px;
      font-size: 0.95rem;
      font-weight: 600;
      color: white;
      border: 1px solid rgba(124, 58, 237, 0.3);
      box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
    }


    /* Info de catégorie actuelle (si nécessaire) */
    .current-category-info {
      margin-top: 32px;
      margin-bottom: 24px;
    }

    .current-category-title {
      font-size: 1.75rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 0.5rem;
    }

    .current-category-description {
      font-size: 1rem;
      color: #6B7280;
      line-height: 1.6;
    }

    /* Ajustements pour le layout principal */
    .services-page-premium {
      padding-top: 0;
    }

    .services-container-premium {
      max-width: 1280px;
      margin: 0 auto;
      padding: 40px 24px;
    }

    .category-hero-premium::before {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      width: 200px;
      height: 200px;
      background: radial-gradient(circle, rgba(79, 70, 229, 0.03) 0%, transparent 70%);
      border-radius: 50%;
      transform: translate(30%, -30%);
      pointer-events: none;
    }

    .category-hero-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 32px;
      position: relative;
      z-index: 1;
    }

    .category-hero-left {
      display: flex;
      align-items: center;
      gap: 24px;
      flex: 1;
    }

    .category-icon-badge {
      flex-shrink: 0;
      width: 80px;
      height: 80px;
      border-radius: 20px;
      background: var(--premium-gradient);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 16px rgba(79, 70, 229, 0.25);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .category-hero-premium:hover .category-icon-badge {
      transform: translateY(-2px);
      box-shadow: 0 12px 24px rgba(79, 70, 229, 0.3);
    }

    .category-icon {
      width: 48px;
      height: 48px;
      object-fit: contain;
    }

    .category-icon-placeholder {
      color: white;
      font-size: 32px;
    }

    .category-hero-text {
      flex: 1;
    }

    .category-title {
      font-size: 32px;
      font-weight: 700;
      color: var(--premium-text);
      margin: 0 0 12px 0;
      line-height: 1.2;
      letter-spacing: -0.5px;
    }

    .category-subtitle {
      font-size: 16px;
      color: var(--premium-text-medium);
      margin: 0;
      line-height: 1.7;
      max-width: 600px;
    }

    .category-hero-right {
      flex-shrink: 0;
    }

    .category-stats {
      text-align: right;
    }

    .stat-number {
      font-size: 42px;
      font-weight: 700;
      color: var(--premium-primary);
      line-height: 1;
      margin-bottom: 6px;
      letter-spacing: -1px;
    }

    .stat-number.stat-empty {
      font-size: 36px;
      color: var(--premium-text-light);
      font-weight: 600;
      opacity: 0.7;
    }

    .stat-label {
      font-size: 14px;
      color: var(--premium-text-light);
      font-weight: 500;
      text-transform: lowercase;
    }

    /* Barre de contexte */
    .services-context-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 24px;
      background: var(--premium-bg);
      border-radius: 12px;
      border: 1px solid var(--premium-border);
      margin-bottom: 32px;
      box-shadow: var(--premium-shadow-sm);
      transition: box-shadow 0.2s ease;
    }

    .services-context-bar:hover {
      box-shadow: var(--premium-shadow);
    }

    .context-text {
      font-size: 15px;
      color: var(--premium-text-medium);
      font-weight: 500;
    }

    .sort-select {
      padding: 10px 40px 10px 16px;
      border: 1.5px solid var(--premium-border);
      border-radius: 10px;
      font-size: 14px;
      font-weight: 500;
      color: var(--premium-text);
      background: var(--premium-bg);
      cursor: pointer;
      transition: all 0.2s ease;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%231e40af' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
      min-width: 160px;
    }

    .sort-select:hover {
      border-color: var(--premium-primary);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.05);
    }

    .sort-select:focus {
      outline: none;
      border-color: var(--premium-primary);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    /* Grille de Services Premium */
    .services-grid-premium {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px;
      margin-bottom: 48px;
    }

    /* En-tête résultats */
    .services-main-premium .results-header {
      margin-bottom: 32px;
      padding-bottom: 16px;
      border-bottom: 1px solid var(--premium-border);
    }

    .services-main-premium .results-count {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--premium-text);
    }

    @media (min-width: 1400px) {
      .services-grid-premium {
        gap: 32px;
      }
    }

    /* Styles supplémentaires pour les cartes (déjà dans le partial mais on les garde ici aussi) */
    .service-card-premium {
      background: var(--premium-bg);
      border-radius: 24px;
      overflow: hidden;
      border: 1px solid var(--premium-border);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .service-card-premium:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 32px rgba(79, 70, 229, 0.15);
      border-color: var(--premium-primary);
    }

    .service-card-image-wrapper {
      position: relative;
      width: 100%;
      padding-top: 56.25%;
      overflow: hidden;
      background: var(--premium-bg-light);
    }

    .service-image-link {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: block;
    }

    .service-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .service-card-premium:hover .service-image {
      transform: scale(1.08);
    }

    .service-wishlist-icon {
      position: absolute;
      top: 12px;
      right: 12px;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--premium-text-light);
      text-decoration: none;
      transition: all 0.2s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      z-index: 2;
    }

    .service-wishlist-icon:hover {
      background: white;
      color: #ef4444;
      transform: scale(1.1);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .service-card-body {
      padding: 20px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .service-card-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--premium-text);
      margin: 0 0 12px 0;
      line-height: 1.4;
      min-height: 44px;
    }

    .service-card-title a {
      color: var(--premium-text);
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .service-card-title a:hover {
      color: var(--premium-primary);
    }

    .service-freelancer-info {
      margin-bottom: 12px;
    }

    .freelancer-link {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      transition: opacity 0.2s ease;
    }

    .freelancer-avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      object-fit: cover;
      flex-shrink: 0;
    }

    .freelancer-avatar-initials {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: var(--premium-gradient);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 600;
      flex-shrink: 0;
    }

    .freelancer-details {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .freelancer-name {
      font-size: 14px;
      font-weight: 500;
      color: var(--premium-text);
    }

    .freelancer-location {
      font-size: 12px;
      color: var(--premium-text-light);
    }

    .service-rating {
      margin-bottom: 16px;
    }

    .rating-stars {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .star-background {
      width: 80px;
      height: 14px;
      position: relative;
      background: url("data:image/svg+xml,%3Csvg width='80' height='14' viewBox='0 0 80 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 0L8.5 5H14L9.75 8L11.25 13L7 10L2.75 13L4.25 8L0 5H5.5L7 0Z' fill='%23E5E7EB'/%3E%3Cpath d='M23 0L24.5 5H30L25.75 8L27.25 13L23 10L18.75 13L20.25 8L16 5H21.5L23 0Z' fill='%23E5E7EB'/%3E%3Cpath d='M39 0L40.5 5H46L41.75 8L43.25 13L39 10L34.75 13L36.25 8L32 5H37.5L39 0Z' fill='%23E5E7EB'/%3E%3Cpath d='M55 0L56.5 5H62L57.75 8L59.25 13L55 10L50.75 13L52.25 8L48 5H53.5L55 0Z' fill='%23E5E7EB'/%3E%3Cpath d='M71 0L72.5 5H78L73.75 8L75.25 13L71 10L66.75 13L68.25 8L64 5H69.5L71 0Z' fill='%23E5E7EB'/%3E%3C/svg%3E") no-repeat;
    }

    .star-fill {
      height: 100%;
      background: url("data:image/svg+xml,%3Csvg width='80' height='14' viewBox='0 0 80 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 0L8.5 5H14L9.75 8L11.25 13L7 10L2.75 13L4.25 8L0 5H5.5L7 0Z' fill='%23FBBF24'/%3E%3Cpath d='M23 0L24.5 5H30L25.75 8L27.25 13L23 10L18.75 13L20.25 8L16 5H21.5L23 0Z' fill='%23FBBF24'/%3E%3Cpath d='M39 0L40.5 5H46L41.75 8L43.25 13L39 10L34.75 13L36.25 8L32 5H37.5L39 0Z' fill='%23FBBF24'/%3E%3Cpath d='M55 0L56.5 5H62L57.75 8L59.25 13L55 10L50.75 13L52.25 8L48 5H53.5L55 0Z' fill='%23FBBF24'/%3E%3Cpath d='M71 0L72.5 5H78L73.75 8L75.25 13L71 10L66.75 13L68.25 8L64 5H69.5L71 0Z' fill='%23FBBF24'/%3E%3C/svg%3E") no-repeat;
    }

    .rating-text {
      font-size: 13px;
      color: var(--premium-text-medium);
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .rating-text strong {
      color: var(--premium-text);
      font-weight: 600;
    }

    .rating-count {
      color: var(--premium-text-light);
    }

    .service-card-footer {
      margin-top: auto;
      padding-top: 16px;
      border-top: 1px solid var(--premium-border);
    }

    .price-label {
      display: block;
      font-size: 12px;
      color: var(--premium-text-light);
      margin-bottom: 4px;
    }

    .price-info {
      display: flex;
      align-items: baseline;
      gap: 6px;
      flex-wrap: wrap;
    }

    .price-value {
      font-size: 20px;
      font-weight: 700;
      color: var(--premium-primary);
      line-height: 1;
    }

    .price-old {
      font-size: 14px;
      color: var(--premium-text-light);
      text-decoration: line-through;
    }

    /* Empty State Premium */
    .empty-state-premium {
      text-align: center;
      padding: 100px 20px;
      max-width: 640px;
      margin: 0 auto;
    }

    .empty-state-icon {
      margin: 0 auto 32px;
      width: 100px;
      height: 100px;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0.4;
      transition: opacity 0.3s ease;
    }

    .empty-state-premium:hover .empty-state-icon {
      opacity: 0.6;
    }

    .empty-state-title {
      font-size: 28px;
      font-weight: 700;
      color: var(--premium-text);
      margin: 0 0 16px 0;
      letter-spacing: -0.3px;
    }

    .empty-state-description {
      font-size: 16px;
      color: var(--premium-text-medium);
      margin: 0 0 40px 0;
      line-height: 1.7;
    }

    .empty-state-actions {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .btn-primary-premium {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 32px;
      background: var(--premium-gradient);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25);
      position: relative;
      overflow: hidden;
    }

    .btn-primary-premium::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }

    .btn-primary-premium:hover::before {
      width: 300px;
      height: 300px;
    }

    .btn-primary-premium:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
      color: white;
    }

    .btn-primary-premium:active {
      transform: translateY(-1px);
    }

    .btn-secondary-premium {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 32px;
      background: var(--premium-bg);
      color: var(--premium-text-medium);
      border: 1.5px solid var(--premium-border);
      border-radius: 12px;
      font-size: 15px;
      font-weight: 500;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-secondary-premium:hover {
      border-color: var(--premium-primary);
      color: var(--premium-primary);
      background: rgba(79, 70, 229, 0.04);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
    }

    /* Services Populaires */
    .popular-services-premium {
      margin-top: 60px;
      padding-top: 40px;
      border-top: 1px solid var(--premium-border);
    }

    .popular-header {
      margin-bottom: 32px;
    }

    .popular-title {
      font-size: 20px;
      font-weight: 600;
      color: var(--premium-text);
      margin: 0 0 4px 0;
    }

    .popular-subtitle {
      font-size: 14px;
      color: var(--premium-text-light);
      margin: 0;
    }

    /* Pagination */
    .services-pagination {
      margin-top: 48px;
      display: flex;
      justify-content: center;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .services-layout-premium {
        grid-template-columns: 280px 1fr;
        gap: 24px;
      }

      .services-grid-premium {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
      }

      .category-hero-content {
        gap: 24px;
      }

      .services-hero-premium {
        padding: 130px 0 90px !important;
      }

      .services-hero-title {
        font-size: 2.8rem;
      }
    }

    @media (max-width: 991px) {
      .services-hero-premium {
        padding: 80px 0 60px !important;
      }

      .services-hero-title {
        font-size: 2.25rem;
      }
    }

    @media (max-width: 768px) {
      .services-page-premium {
        padding: 24px 0 40px;
        margin-top: 0;
      }

      .services-container-premium {
        padding: 0 16px;
      }

      .services-layout-premium {
        grid-template-columns: 1fr;
        gap: 0;
      }

      .services-hero-premium {
        padding: 100px 0 70px !important;
        min-height: auto;
      }

      .services-hero-title {
        font-size: 2rem;
      }

      .services-hero-subtitle {
        font-size: 1rem;
      }

      .services-container-premium {
        padding: 24px 16px;
      }

      .services-sidebar-premium {
        position: relative;
        top: auto;
        max-height: none;
      }

      .services-sidebar-premium {
        position: fixed;
        top: 0;
        left: -100%;
        width: 320px;
        max-width: 85vw;
        height: 100vh;
        z-index: 10000;
        transition: left 0.3s ease;
        border-radius: 0;
        box-shadow: var(--premium-shadow-xl);
      }

      .services-sidebar-premium.active {
        left: 0;
      }

      .sidebar-header-mobile {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--premium-border);
      }

      .sidebar-header-mobile h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
      }

      .sidebar-close-btn {
        background: none;
        border: none;
        font-size: 20px;
        color: var(--premium-text-medium);
        cursor: pointer;
        padding: 4px;
      }

      .search-bar-mobile {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
      }

      .search-input-wrapper {
        flex: 1;
        position: relative;
      }

      .search-input {
        width: 100%;
        padding: 12px 44px 12px 16px;
        border: 1px solid var(--premium-border);
        border-radius: 12px;
        font-size: 14px;
      }

      .search-btn {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--premium-text-light);
        cursor: pointer;
        padding: 8px;
      }

      .filter-toggle-btn {
        padding: 12px 20px;
        background: var(--premium-bg);
        border: 1px solid var(--premium-border);
        border-radius: 12px;
        color: var(--premium-text-medium);
        cursor: pointer;
        font-size: 16px;
      }

      .services-hero-premium {
        padding: 80px 0 60px !important;
      }

      .services-hero-title {
        font-size: 2rem;
        line-height: 1.2;
      }

      .services-sidebar-premium {
        top: 100px;
      }

      .services-hero-subtitle {
        font-size: 1rem;
      }


      .hero-stat-text {
        font-size: 0.875rem;
        padding: 8px 18px;
      }

      .category-hero-left {
        width: 100%;
      }

      .category-title {
        font-size: 24px;
      }

      .category-subtitle {
        font-size: 14px;
      }

      .category-hero-right {
        width: 100%;
      }

      .category-stats {
        text-align: left;
      }

      .services-context-bar {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
      }

      .services-grid-premium {
        grid-template-columns: 1fr;
        gap: 16px;
      }

      .empty-state-premium {
        padding: 40px 20px;
      }

      .empty-state-title {
        font-size: 20px;
      }
    }
  </style>

@endsection

@section('script')
  <script>
    let currency_info = {!! json_encode($currencyInfo ?? (object)['base_currency_symbol_position' => 'right', 'base_currency_symbol' => '€']) !!};
    let position = currency_info.base_currency_symbol_position || 'right';
    let symbol = currency_info.base_currency_symbol || '€';
    
    // Tarif horaire (10€ - 299€ selon le modèle Junspro)
    let min_hourly_rate = 10;
    let max_hourly_rate = 299;
    let curr_min_rate = {{ (int)(request()->input('min_hourly_rate', 10)) }};
    let curr_max_rate = {{ (int)(request()->input('max_hourly_rate', 299)) }};
    
    var searchUrl = "{{ route('search-service') }}";
    var serviceUrl = "{{ route('services') }}";
    
    // Initialiser le slider de tarif horaire si présent
    if (typeof $('#hourly-rate-slider').length !== 'undefined' && $('#hourly-rate-slider').length > 0) {
      // Le slider sera initialisé par le script service.js si disponible
      // Sinon, utiliser une implémentation simple
      $(document).ready(function() {
        if (typeof $('#hourly-rate-slider').slider !== 'undefined') {
          $('#hourly-rate-slider').slider({
            range: true,
            min: min_hourly_rate,
            max: max_hourly_rate,
            values: [curr_min_rate, curr_max_rate],
            slide: function(event, ui) {
              $('#hourly-rate-amount').val(ui.values[0] + '€ - ' + ui.values[1] + '€');
              $('#min-hourly-rate').val(ui.values[0]);
              $('#max-hourly-rate').val(ui.values[1]);
            }
          });
          $('#hourly-rate-amount').val(curr_min_rate + '€ - ' + curr_max_rate + '€');
        }
      });
    }
  </script>

  <script type="text/javascript" src="{{ asset('assets/js/service.js') }}"></script>

  <!-- Script Mobile Sidebar + Recherche Compétences + Accordéon Catégories -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sidebar = document.querySelector('.services-sidebar-premium');
      const filterToggle = document.querySelector('.filter-toggle-btn');
      const sidebarClose = document.querySelector('.sidebar-close-btn');

      if (filterToggle) {
        filterToggle.addEventListener('click', function() {
          sidebar.classList.add('active');
        });
      }

      if (sidebarClose) {
        sidebarClose.addEventListener('click', function() {
          sidebar.classList.remove('active');
        });
      }

      // Fermer sidebar en cliquant en dehors
      document.addEventListener('click', function(e) {
        if (sidebar && sidebar.classList.contains('active')) {
          if (!sidebar.contains(e.target) && !filterToggle.contains(e.target)) {
            sidebar.classList.remove('active');
          }
        }
      });

      // Barre de recherche pour les compétences
      const skillsSearchInput = document.getElementById('skills-search-input');
      const skillsCheckboxes = document.querySelectorAll('#skills-checkboxes-container .filter-checkbox-item');
      
      if (skillsSearchInput && skillsCheckboxes.length > 0) {
        skillsSearchInput.addEventListener('input', function(e) {
          const searchTerm = e.target.value.toLowerCase().trim();
          
          skillsCheckboxes.forEach(function(item) {
            const skillName = item.getAttribute('data-skill-name') || '';
            
            if (skillName.includes(searchTerm)) {
              item.style.display = '';
            } else {
              item.style.display = 'none';
            }
          });
        });
      }

      // Bouton "Afficher plus / Afficher moins" pour les catégories
      const showMoreCategoriesBtn = document.getElementById('show-more-categories-btn');
      const hiddenCategories = document.querySelectorAll('.category-parent-item.category-hidden');
      
      if (showMoreCategoriesBtn && hiddenCategories.length > 0) {
        let isExpanded = false;
        const btnTextShow = showMoreCategoriesBtn.querySelector('.btn-text-show');
        const btnTextHide = showMoreCategoriesBtn.querySelector('.btn-text-hide');
        
        showMoreCategoriesBtn.addEventListener('click', function() {
          isExpanded = !isExpanded;
          
          hiddenCategories.forEach(function(item) {
            if (isExpanded) {
              item.classList.add('visible');
              item.style.display = 'block';
            } else {
              item.classList.remove('visible');
              item.style.display = 'none';
            }
          });
          
          if (isExpanded) {
            btnTextShow.style.display = 'none';
            btnTextHide.style.display = 'inline-block';
          } else {
            btnTextShow.style.display = 'inline-block';
            btnTextHide.style.display = 'none';
          }
        });
      }

      // Accordéon Premium pour les Catégories
      (function() {
        console.log('[Accordéon] Initialisation...');
        
        // Fonction pour fermer toutes les catégories
        function closeAllCategories() {
          document.querySelectorAll('.category-parent-item').forEach(function(item) {
            item.classList.remove('open');
            const children = item.querySelector('.category-children');
            if (children) {
              children.classList.remove('open');
            }
          });
        }

        // Gérer le clic sur "Tout"
        const allCategoryLink = document.querySelector('.category-parent-item:first-child .category-parent-link');
        if (allCategoryLink) {
          console.log('[Accordéon] Lien "Tout" trouvé');
          allCategoryLink.addEventListener('click', function(e) {
            console.log('[Accordéon] Clic sur "Tout"');
            closeAllCategories();
          });
        } else {
          console.warn('[Accordéon] Lien "Tout" non trouvé');
        }

        // Gérer le clic sur les catégories parentes
        const categoryToggles = document.querySelectorAll('.category-parent-toggle');
        console.log('[Accordéon] Nombre de toggles trouvés:', categoryToggles.length);
        
        if (categoryToggles.length === 0) {
          console.warn('[Accordéon] Aucun toggle trouvé, réessai dans 500ms...');
          setTimeout(function() {
            const retryToggles = document.querySelectorAll('.category-parent-toggle');
            console.log('[Accordéon] Réessai - toggles trouvés:', retryToggles.length);
            if (retryToggles.length > 0) {
              setupToggles(retryToggles);
            }
          }, 500);
        } else {
          setupToggles(categoryToggles);
        }
        
        function setupToggles(toggles) {
          toggles.forEach(function(toggle, index) {
            // Vérifier si un listener existe déjà
            if (toggle.dataset.listenerAdded === 'true') {
              return;
            }
            toggle.dataset.listenerAdded = 'true';
            
            toggle.addEventListener('click', function(e) {
              e.preventDefault();
              e.stopPropagation();
              console.log('[Accordéon] Clic sur toggle', index);
              
              const categoryItem = this.closest('.category-parent-item');
              if (!categoryItem) {
                console.warn('[Accordéon] Category item not found');
                return;
              }
              
              // Ignorer si c'est l'item "Tout"
              if (categoryItem.querySelector('.category-parent-link')) {
                console.log('[Accordéon] Item "Tout" ignoré');
                return;
              }
              
              const children = categoryItem.querySelector('.category-children');
              if (!children) {
                console.log('[Accordéon] Pas de sous-catégories');
                return;
              }
              
              const isOpen = categoryItem.classList.contains('open');
              console.log('[Accordéon] État actuel:', isOpen ? 'ouvert' : 'fermé');
              
              // Fermer toutes les autres catégories
              document.querySelectorAll('.category-parent-item').forEach(function(item) {
                if (item !== categoryItem) {
                  item.classList.remove('open');
                  const otherChildren = item.querySelector('.category-children');
                  if (otherChildren) {
                    otherChildren.classList.remove('open');
                  }
                }
              });
              
              // Toggle la catégorie cliquée
              if (isOpen) {
                categoryItem.classList.remove('open');
                children.classList.remove('open');
                console.log('[Accordéon] Catégorie fermée');
              } else {
                categoryItem.classList.add('open');
                children.classList.add('open');
                console.log('[Accordéon] Catégorie ouverte');
              }
            });
          });
        }

        // Gérer le clic sur les sous-catégories
        const subcategoryLinks = document.querySelectorAll('.category-child-link');
        console.log('[Accordéon] Nombre de liens sous-catégories:', subcategoryLinks.length);
        
        subcategoryLinks.forEach(function(link) {
          link.addEventListener('click', function(e) {
            // Retirer l'état actif de toutes les sous-catégories
            document.querySelectorAll('.category-child-link').forEach(function(l) {
              l.classList.remove('active');
            });
            
            // Ajouter l'état actif à la sous-catégorie cliquée
            this.classList.add('active');
            
            // S'assurer que la catégorie parente reste ouverte
            const categoryItem = this.closest('.category-parent-item');
            if (categoryItem) {
              categoryItem.classList.add('open');
              const children = categoryItem.querySelector('.category-children');
              if (children) {
                children.classList.add('open');
              }
            }
          });
        });
      })();
    });
  </script>
@endsection
