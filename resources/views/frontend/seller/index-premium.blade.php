@extends('frontend.layout')

@section('pageHeading')
  {{ replaceSellerWithFreelance($pageHeading->seller_page_title ?? __('Freelances')) }}
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->seller_page_meta_keywords ?? '' }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->seller_page_meta_description ?? '' }}
  @endif
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/front/css/freelancers-premium.css') }}?v={{ time() }}">
<style>
  /* Styles inline pour le panneau de filtres et les cartes */
  :root {
    --junspro-primary: #4F46E5;
    --junspro-primary-light: #6366F1;
    --junspro-primary-dark: #4338CA;
    --junspro-violet: #7C3AED;
    --junspro-gray-50: #F9FAFB;
    --junspro-gray-100: #F3F4F6;
    --junspro-gray-200: #E5E7EB;
    --junspro-gray-300: #D1D5DB;
    --junspro-gray-400: #9CA3AF;
    --junspro-gray-500: #6B7280;
    --junspro-gray-600: #4B5563;
    --junspro-gray-700: #374151;
    --junspro-gray-800: #1F2937;
    --junspro-gray-900: #111827;
  }
</style>
@endsection

@section('content')
  {{-- Suppression du breadcrumb pour design premium --}}
  {{-- @includeIf('frontend.partials.breadcrumb', [
      'breadcrumb' => $breadcrumb ?? '',
      'title' => replaceSellerWithFreelance($pageHeading->seller_page_title ?? __('Freelances')),
  ]) --}}

  <!-- Hero Section Premium -->
  <section class="freelancers-hero-premium">
    <div class="freelancers-hero-container">
      <div class="freelancers-hero-content">
        <h1 class="freelancers-hero-title">
          <span class="hero-title-line-1">{{ __('Trouvez le') }} <span class="highlight">{{ __('freelance idéal') }}</span></span>
          <span class="hero-title-line-2">{{ __('pour votre projet') }}</span>
        </h1>
        <p class="freelancers-hero-subtitle">
          {{ __('Des experts vérifiés pour vos projets clés en main : landing pages, tunnels de vente, branding, automatisation...') }}
        </p>
        <div class="freelancers-hero-stats">
          <span class="hero-stat-item">
            <strong>{{ count($sellers) > 0 ? $sellers->total() : '0' }}+</strong> {{ __('freelances') }}
          </span>
          <span class="hero-stat-item">
            <strong>5/5</strong> {{ __('note moyenne') }}
          </span>
          <span class="hero-stat-item">
            <strong>2j</strong> {{ __('délai moyen') }}
          </span>
        </div>
      </div>
    </div>
  </section>

  <!-- Page Freelances Premium -->
  <div class="freelancers-page-premium">
    <div class="freelancers-container-premium">
      <div class="freelancers-layout-premium">
        
        <!-- ============================================
             COLONNE FILTRES (GAUCHE) - STICKY DESKTOP
             ============================================ -->
        <aside class="freelancers-sidebar-premium" id="freelancers-sidebar">
          <div class="sidebar-content">
            <!-- Header Mobile -->
            <div class="sidebar-header-mobile">
              <h3>{{ __('Filtres') }}</h3>
              <button class="sidebar-close-btn" type="button" aria-label="Fermer">
                <i class="fas fa-times"></i>
              </button>
            </div>

            <form action="{{ route('frontend.sellers') }}" method="get" id="freelancers-filter-form">
              
              <!-- RECHERCHE -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('RECHERCHE') }}</h4>
                <div class="filter-content">
                  <input type="text" 
                         name="search" 
                         class="filter-search-input" 
                         placeholder="{{ __('Mot-clé, compétence, type de projet ou secteur') }}"
                         value="{{ request()->input('search') }}">
                </div>
              </div>

              <!-- TARIF -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('TARIF') }}</h4>
                <div class="filter-content">
                  <!-- Toggle Tarif horaire / Budget par projet -->
                  <div class="filter-toggle-group">
                    <button type="button" class="filter-toggle-btn active" data-mode="hourly">
                      {{ __('Tarif horaire') }}
                    </button>
                    <button type="button" class="filter-toggle-btn" data-mode="project">
                      {{ __('Budget par projet') }}
                    </button>
                  </div>
                  
                  <!-- Slider Tarif horaire -->
                  <div class="price-filter-wrapper" id="hourly-price-filter">
                    <div id="hourly-rate-slider" class="price-slider"></div>
                    <div class="price-range-display">
                      <span>{{ __('De') }}:</span>
                      <input type="number" name="hourly_min" id="hourly-min" class="price-input" min="0" max="500" value="{{ request()->input('hourly_min', 10) }}">
                      <span>{{ __('à') }}:</span>
                      <input type="number" name="hourly_max" id="hourly-max" class="price-input" min="0" max="500" value="{{ request()->input('hourly_max', 299) }}">
                      <span class="price-unit">€/h</span>
                    </div>
                  </div>

                  <!-- Budget par projet -->
                  <div class="price-filter-wrapper" id="project-price-filter" style="display: none;">
                    <div class="price-range-display">
                      <span>{{ __('Budget estimé') }}:</span>
                      <input type="number" name="project_min" id="project-min" class="price-input" min="0" max="50000" value="{{ request()->input('project_min', 300) }}">
                      <span>{{ __('à') }}:</span>
                      <input type="number" name="project_max" id="project-max" class="price-input" min="0" max="50000" value="{{ request()->input('project_max', 3000) }}">
                      <span class="price-unit">€ / {{ __('projet') }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- DISPONIBILITÉ -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('DISPONIBILITÉ') }}</h4>
                <div class="filter-content">
                  <div class="filter-pills">
                    <label class="filter-pill {{ empty(request()->input('availability')) ? 'active' : '' }}">
                      <input type="radio" name="availability" value="" {{ empty(request()->input('availability')) ? 'checked' : '' }}>
                      <span>{{ __('Toutes les disponibilités') }}</span>
                    </label>
                    <label class="filter-pill {{ request()->input('availability') == '1-8' ? 'active' : '' }}">
                      <input type="radio" name="availability" value="1-8" {{ request()->input('availability') == '1-8' ? 'checked' : '' }}>
                      <span>1 à 8h/semaine</span>
                    </label>
                    <label class="filter-pill {{ request()->input('availability') == '8-16' ? 'active' : '' }}">
                      <input type="radio" name="availability" value="8-16" {{ request()->input('availability') == '8-16' ? 'checked' : '' }}>
                      <span>8 à 16h/semaine</span>
                    </label>
                    <label class="filter-pill {{ request()->input('availability') == '16-24' ? 'active' : '' }}">
                      <input type="radio" name="availability" value="16-24" {{ request()->input('availability') == '16-24' ? 'checked' : '' }}>
                      <span>16 à 24h/semaine</span>
                    </label>
                  </div>

                  <!-- Délai de démarrage -->
                  <div class="filter-subsection">
                    <h5 class="filter-subtitle">{{ __('Délai de démarrage') }}</h5>
                    <div class="filter-checkboxes">
                      <label class="filter-checkbox-item">
                        <input type="checkbox" name="start_delay[]" value="immediate" {{ in_array('immediate', (array)request()->input('start_delay', [])) ? 'checked' : '' }}>
                        <span>{{ __('Immédiat (cette semaine)') }}</span>
                      </label>
                      <label class="filter-checkbox-item">
                        <input type="checkbox" name="start_delay[]" value="15days" {{ in_array('15days', (array)request()->input('start_delay', [])) ? 'checked' : '' }}>
                        <span>{{ __('Sous 15 jours') }}</span>
                      </label>
                      <label class="filter-checkbox-item">
                        <input type="checkbox" name="start_delay[]" value="1-3months" {{ in_array('1-3months', (array)request()->input('start_delay', [])) ? 'checked' : '' }}>
                        <span>{{ __('Sous 1-3 mois') }}</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <!-- PAYS -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('PAYS') }}</h4>
                <div class="filter-content">
                  <input type="text" 
                         name="country" 
                         class="filter-search-input" 
                         id="country-autocomplete"
                         placeholder="{{ __('FR, BE, CH...') }}"
                         value="{{ request()->input('country') }}">
                  <div class="filter-checkboxes mt-2">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="remote_only" value="1" {{ request()->input('remote_only') == '1' ? 'checked' : '' }}>
                      <span>{{ __('Remote uniquement') }}</span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- LANGUES -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('LANGUES') }}</h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="languages[]" value="fr" {{ in_array('fr', (array)request()->input('languages', [])) ? 'checked' : '' }}>
                      <span>Français</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="languages[]" value="en" {{ in_array('en', (array)request()->input('languages', [])) ? 'checked' : '' }}>
                      <span>English</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="languages[]" value="es" {{ in_array('es', (array)request()->input('languages', [])) ? 'checked' : '' }}>
                      <span>Español</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="languages[]" value="de" {{ in_array('de', (array)request()->input('languages', [])) ? 'checked' : '' }}>
                      <span>Deutsch</span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- TYPE DE FREELANCE -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('TYPE DE FREELANCE') }}</h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="freelance_type[]" value="verified" {{ in_array('verified', (array)request()->input('freelance_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Freelances vérifiés / premium') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="freelance_type[]" value="top" {{ in_array('top', (array)request()->input('freelance_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Top Junspro') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="freelance_type[]" value="new" {{ in_array('new', (array)request()->input('freelance_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Nouveaux talents') }}</span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- ÉVALUATION -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('ÉVALUATION') }}</h4>
                <div class="filter-content">
                  <div class="filter-pills">
                    <label class="filter-pill {{ empty(request()->input('rating')) ? 'active' : '' }}">
                      <input type="radio" name="rating" value="" {{ empty(request()->input('rating')) ? 'checked' : '' }}>
                      <span>{{ __('Toutes') }}</span>
                    </label>
                    <label class="filter-pill {{ request()->input('rating') == '5' ? 'active' : '' }}">
                      <input type="radio" name="rating" value="5" {{ request()->input('rating') == '5' ? 'checked' : '' }}>
                      <span>⭐⭐⭐⭐⭐ 5 {{ __('étoiles') }}</span>
                    </label>
                    <label class="filter-pill {{ request()->input('rating') == '4' ? 'active' : '' }}">
                      <input type="radio" name="rating" value="4" {{ request()->input('rating') == '4' ? 'checked' : '' }}>
                      <span>⭐⭐⭐⭐ 4+ {{ __('étoiles') }}</span>
                    </label>
                    <label class="filter-pill {{ request()->input('rating') == '3' ? 'active' : '' }}">
                      <input type="radio" name="rating" value="3" {{ request()->input('rating') == '3' ? 'checked' : '' }}>
                      <span>⭐⭐⭐ 3+ {{ __('étoiles') }}</span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- TYPE DE PROJET -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('TYPE DE PROJET') }}</h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="landing-page" {{ in_array('landing-page', (array)request()->input('project_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Landing page') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="site-vitrine" {{ in_array('site-vitrine', (array)request()->input('project_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Site vitrine') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="tunnel-vente" {{ in_array('tunnel-vente', (array)request()->input('project_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Tunnel de vente') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="brand-kit" {{ in_array('brand-kit', (array)request()->input('project_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Brand kit') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="emailing" {{ in_array('emailing', (array)request()->input('project_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Emailing') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="ads" {{ in_array('ads', (array)request()->input('project_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Ads') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="automatisation" {{ in_array('automatisation', (array)request()->input('project_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Automatisation') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="coaching-strategique" {{ in_array('coaching-strategique', (array)request()->input('project_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Coaching stratégique') }}</span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- SECTEUR / INDUSTRIE -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('SECTEUR / INDUSTRIE') }}</h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="sector[]" value="infopreneurs-coachs" {{ in_array('infopreneurs-coachs', (array)request()->input('sector', [])) ? 'checked' : '' }}>
                      <span>{{ __('Infopreneurs & coachs') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="sector[]" value="ecommerce" {{ in_array('ecommerce', (array)request()->input('sector', [])) ? 'checked' : '' }}>
                      <span>{{ __('E-commerce') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="sector[]" value="services-locaux" {{ in_array('services-locaux', (array)request()->input('sector', [])) ? 'checked' : '' }}>
                      <span>{{ __('Services locaux') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="sector[]" value="associations-ong" {{ in_array('associations-ong', (array)request()->input('sector', [])) ? 'checked' : '' }}>
                      <span>{{ __('Associations / ONG') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="sector[]" value="autres" {{ in_array('autres', (array)request()->input('sector', [])) ? 'checked' : '' }}>
                      <span>{{ __('Autres') }}</span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- TYPE DE MISSION -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('TYPE DE MISSION') }}</h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="mission_type[]" value="one-shot" {{ in_array('one-shot', (array)request()->input('mission_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Projet unique (one-shot)') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="mission_type[]" value="long-term" {{ in_array('long-term', (array)request()->input('mission_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Accompagnement long terme') }}</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="mission_type[]" value="maintenance" {{ in_array('maintenance', (array)request()->input('mission_type', [])) ? 'checked' : '' }}>
                      <span>{{ __('Maintenance / optimisation continue') }}</span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- Bouton Réinitialiser -->
              <div class="filter-section">
                <button type="button" class="filter-reset-btn" id="reset-filters">
                  {{ __('Réinitialiser') }}
                </button>
              </div>

            </form>
          </div>
        </aside>

        <!-- ============================================
             CONTENU PRINCIPAL (CARTES FREELANCES)
             ============================================ -->
        <main class="freelancers-main-premium">
          <!-- Bouton Filtrer Mobile -->
          <button class="filter-mobile-btn" id="filter-mobile-btn">
            <i class="fas fa-filter"></i> {{ __('Filtrer') }}
          </button>

          <!-- Liste des freelances -->
          <div class="freelancers-list-premium" id="freelancers-list">
            @if (count($sellers) > 0)
              @foreach ($sellers as $seller)
                @include('frontend.seller.partials.freelancer-card-premium', ['seller' => $seller])
              @endforeach
            @else
              <div class="freelancers-empty">
                <h3>{{ __('Aucun freelance trouvé') }}</h3>
                <p>{{ __('Essayez de modifier vos critères de recherche.') }}</p>
              </div>
            @endif
          </div>

          <!-- Pagination -->
          @if (count($sellers) > 0)
            <div class="freelancers-pagination">
              {{ $sellers->appends(request()->query())->links() }}
            </div>
          @endif
        </main>

      </div>
    </div>
  </div>

  <!-- Section "Pourquoi Junspro" -->
  @include('frontend.seller.partials.why-junspro-section')

@endsection

@section('script')
<script src="{{ asset('assets/front/js/freelancers-premium.js') }}?v={{ time() }}"></script>
@endsection




