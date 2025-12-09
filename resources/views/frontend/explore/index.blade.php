@extends('frontend.layout')

@section('pageHeading')
  {{ __('Explorer les freelances') }}
@endsection

@section('metaKeywords')
  {{ __('freelance, projet, abonnement, junspro') }}
@endsection

@section('metaDescription')
  {{ __('Trouvez un freelance expert pour votre projet avec abonnements hebdomadaires flexibles.') }}
@endsection

@section('style')
  <style>
    /* En-tête avec dégradé - Même style que la page de contact */
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

    /* Assurer la visibilité des liens de navigation sur fond sombre */
    body .header-area .nav-link,
    html body .header-area .nav-link,
    body .header-area .main-navbar .nav-link,
    html body .header-area .main-navbar .nav-link,
    body .header-area .navbar-nav .nav-link,
    html body .header-area .navbar-nav .nav-link,
    body .header-area .navbar-nav .nav-item .nav-link,
    html body .header-area .navbar-nav .nav-item .nav-link {
      color: rgba(255, 255, 255, 0.95) !important;
      -webkit-text-fill-color: rgba(255, 255, 255, 0.95) !important;
    }

    body .header-area .nav-link:hover,
    body .header-area .nav-link.active,
    html body .header-area .nav-link:hover,
    html body .header-area .nav-link.active {
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
    }

    /* Logo blanc sur fond sombre */
    body .header-area .junspro-logo-text {
      background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 50%, #c7d2fe 100%) !important;
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      background-clip: text !important;
      color: #ffffff !important;
    }
  </style>
@endsection

@section('content')
  <!-- Hero Explore Premium -->
  <section class="explore-hero-premium">
    <div class="explore-hero-container">
      <div class="explore-hero-content">
        <h1 class="explore-hero-title">
          <span class="hero-title-line-1">{{ __('Trouvez le') }} <span class="highlight">{{ __('freelance parfait') }}</span></span>
          <span class="hero-title-line-2">{{ __('pour votre projet') }}</span>
        </h1>
        <p class="explore-hero-subtitle">
          {{ __('Filtrez par prix horaire, langues, pays et découvrez les profils les plus adaptés à votre besoin.') }}
        </p>
        <div class="explore-hero-stats">
          <span class="hero-stat-text">{{ __('+10 000 freelances vérifiés') }}</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Page Explore Junspro - Version Premium -->
  <div class="explore-page-premium">
    <div class="explore-container-premium">
      <div class="explore-layout-premium">
        
        <!-- Colonne Filtres (gauche) - Même modèle que Services -->
        <aside class="explore-sidebar-premium">
          <div class="sidebar-content">
            <div class="sidebar-header-mobile">
              <h3>{{ __('Filtres') }}</h3>
              <button class="sidebar-close-btn" type="button" aria-label="Fermer">
                <i class="fas fa-times"></i>
              </button>
            </div>

            <form method="GET" action="{{ route('explore') }}" id="explore-filters-form">
              
              <!-- Recherche -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('Recherche') }}</h4>
                <div class="filter-content">
                  <input type="text" 
                         name="search" 
                         value="{{ $filters['search'] ?? '' }}" 
                         class="filter-input"
                         placeholder="{{ __('Mot-clé, compétence, type de pro...') }}">
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
                  <input type="hidden" id="min-hourly-rate" name="price_min" value="{{ $filters['price_min'] ?? 10 }}">
                  <input type="hidden" id="max-hourly-rate" name="price_max" value="{{ $filters['price_max'] ?? 299 }}">
                  <div class="filter-info-text">
                    <small>{{ __('Tarifs entre 10€ et 299€ par heure') }}</small>
                  </div>
                </div>
              </div>

              <!-- Disponibilité -->
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
              <div class="filter-section">
                <h4 class="filter-title">{{ __('Pays') }}</h4>
                <div class="filter-content">
                  <input type="text" 
                         name="country" 
                         class="filter-input"
                         value="{{ $filters['country'] ?? '' }}"
                         placeholder="{{ __('Code pays (ex: FR, BE, CH)') }}">
                </div>
              </div>

              <!-- Langues -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('Langues') }}</h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    @foreach ($allLanguages as $language)
                      <label class="filter-checkbox-item">
                        <input type="checkbox" 
                               class="filter-checkbox" 
                               name="languages[]" 
                               value="{{ $language->code }}"
                               @checked(in_array($language->code, $filters['languages'] ?? []))>
                        <span>{{ $language->name }}</span>
                      </label>
                    @endforeach
                  </div>
                </div>
              </div>

              <!-- Freelances vérifiés / Premium -->
              <div class="filter-section">
                <h4 class="filter-title">{{ __('Type de freelance') }}</h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" 
                             class="filter-checkbox" 
                             name="is_premium" 
                             value="1"
                             @checked(request()->boolean('is_premium'))>
                      <span>{{ __('Freelances vérifiés / premium') }}</span>
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
                      <input type="radio" class="filter-radio" name="rating" value="" {{ empty(request()->input('rating')) ? 'checked' : '' }}>
                      <span>{{ __('Toutes') }}</span>
                    </label>
                    <label class="filter-option">
                      <input type="radio" class="filter-radio" name="rating" value="5" {{ request()->input('rating') == 5 ? 'checked' : '' }}>
                      <span>{{ __('5 étoiles') }}</span>
                    </label>
                    <label class="filter-option">
                      <input type="radio" class="filter-radio" name="rating" value="4" {{ request()->input('rating') == 4 ? 'checked' : '' }}>
                      <span>{{ __('4 étoiles et plus') }}</span>
                    </label>
                    <label class="filter-option">
                      <input type="radio" class="filter-radio" name="rating" value="3" {{ request()->input('rating') == 3 ? 'checked' : '' }}>
                      <span>{{ __('3 étoiles et plus') }}</span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- Tri (caché dans le formulaire) -->
              <input type="hidden" name="sort" value="{{ $filters['sort'] ?? 'best_match' }}">

              <!-- Bouton Reset -->
              <div class="filter-reset">
                <button type="button" class="reset-filters-btn">
                  <i class="fas fa-redo-alt"></i>
                  <span>{{ __('Réinitialiser') }}</span>
                </button>
              </div>
            </form>
          </div>
        </aside>

        <!-- Zone Principale (droite) -->
        <main class="explore-main-premium">
          
          <!-- Results Header -->
          @if (!$freelancers->isEmpty())
            <div class="results-header-premium mb-4">
              <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                  <h2 class="results-count-premium mb-0">
                    {{ $freelancers->total() }} 
                    <span class="text-muted" style="font-weight: 400; font-size: 1rem;">
                      {{ $freelancers->total() > 1 ? __('freelances trouvés') : __('freelance trouvé') }}
                    </span>
                  </h2>
                </div>
              </div>
            </div>
          @endif

          <!-- Freelancers Grid -->
          @if ($freelancers->isEmpty())
            <div class="empty-state-premium">
              <div class="empty-icon-premium mb-4">
                <i class="fas fa-user-friends" style="font-size: 4rem; color: #CBD5E1;"></i>
              </div>
              <h3 class="empty-title-premium mb-3">{{ __('Aucun freelance trouvé') }}</h3>
              <p class="empty-text-premium mb-4">
                {{ __('Aucun freelance ne correspond à vos critères pour le moment. Essayez de modifier vos filtres.') }}
              </p>
              <a href="{{ route('explore') }}" class="btn-empty-reset-premium">
                <i class="fas fa-redo me-2"></i>
                {{ __('Réinitialiser les filtres') }}
              </a>
            </div>
          @else
            <div class="freelancers-grid-premium">
              @foreach ($freelancers as $freelancer)
                @php
                  $user = $freelancer->user;
                  $initial = strtoupper(substr($user->name ?? 'F', 0, 1));
                  $avatarColor = '#' . substr(md5($user->name ?? 'F'), 0, 6);
                  $skills = is_array($freelancer->skills) ? $freelancer->skills : [];
                @endphp
                <div class="freelancer-card-premium" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                  <div class="freelancer-card-inner">
                    
                    <!-- Header Card -->
                    <div class="freelancer-header-premium">
                      <div class="freelancer-avatar-premium" style="background: linear-gradient(135deg, {{ $avatarColor }} 0%, {{ $avatarColor }}dd 100%);">
                        <span class="avatar-initial">{{ $initial }}</span>
                        @if($user->is_verified_freelancer ?? false)
                          <div class="verified-badge-premium">
                            <i class="fas fa-check-circle"></i>
                          </div>
                        @endif
                      </div>
                      <div class="freelancer-info-premium">
                        <h4 class="freelancer-name-premium">{{ $user->name }}</h4>
                        <p class="freelancer-location-premium">
                          <i class="fas fa-map-marker-alt me-1"></i>
                          {{ $user->country_code ?? __('Non spécifié') }}
                        </p>
                      </div>
                      @if($user->is_super_freelancer ?? false)
                        <div class="super-badge-premium">
                          <i class="fas fa-crown me-1"></i>
                          {{ __('Super') }}
                        </div>
                      @endif
                    </div>

                    <!-- Bio / Skills -->
                    @if(!empty($freelancer->bio))
                      <p class="freelancer-bio-premium">{{ Str::limit($freelancer->bio, 80) }}</p>
                    @endif

                    @if(!empty($skills))
                      <div class="freelancer-skills-premium">
                        @foreach (array_slice($skills, 0, 3) as $skill)
                          <span class="skill-tag-premium">{{ $skill }}</span>
                        @endforeach
                        @if(count($skills) > 3)
                          <span class="skill-more-premium">+{{ count($skills) - 3 }}</span>
                        @endif
                      </div>
                    @endif

                    <!-- Stats -->
                    <div class="freelancer-stats-premium">
                      <div class="stat-item-premium">
                        <div class="stat-icon-premium" style="background: rgba(79, 70, 229, 0.1);">
                          <i class="fas fa-euro-sign" style="color: #4F46E5;"></i>
                        </div>
                        <div class="stat-content-premium">
                          <span class="stat-value-premium">{{ number_format($freelancer->hourly_rate, 0, ',', ' ') }} €</span>
                          <span class="stat-label-premium">{{ __('/ heure') }}</span>
                        </div>
                      </div>
                      <div class="stat-item-premium">
                        <div class="stat-icon-premium" style="background: rgba(79, 70, 229, 0.1);">
                          <i class="fas fa-shield-alt" style="color: #4F46E5;"></i>
                        </div>
                        <div class="stat-content-premium">
                          <span class="stat-value-premium">{{ $freelancer->reliability_score ?? 0 }}</span>
                          <span class="stat-label-premium">{{ __('/ 100') }}</span>
                        </div>
                      </div>
                    </div>

                    <!-- CTA Button -->
                    <a href="{{ route('freelance.show', $freelancer->id) }}" class="freelancer-cta-premium">
                      <span>{{ __('Voir le profil') }}</span>
                      <i class="fas fa-arrow-right ms-2"></i>
                    </a>

                  </div>
                </div>
              @endforeach
            </div>

            <!-- Pagination Premium -->
            @if($freelancers->hasPages())
              <div class="pagination-wrapper-premium mt-5">
                {{ $freelancers->appends(request()->query())->links() }}
              </div>
            @endif
          @endif

        </main>
      </div>
    </div>
  </section>

  <style>
    :root {
      --premium-primary: #4F46E5;
      --premium-primary-dark: #4338CA;
      --premium-gradient: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
      --premium-text: #111827;
      --premium-text-medium: #374151;
      --premium-text-light: #6B7280;
      --premium-border: #E5E7EB;
      --premium-bg: #FFFFFF;
      --premium-bg-light: #F9FAFB;
      --premium-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      --explore-primary: #4F46E5;
      --explore-primary-dark: #4338CA;
      --explore-gradient: linear-gradient(135deg, #4169E1 0%, #7C3AED 100%);
      --explore-text: #111827;
      --explore-text-light: #6B7280;
      --explore-border: #E5E7EB;
      --explore-bg: #FFFFFF;
      --explore-bg-light: #F9FAFB;
    }

    /* Layout Global Premium - Même modèle que Services */
    .explore-page-premium {
      background: var(--premium-bg-light);
      min-height: calc(100vh - 200px);
      padding: 60px 0 80px;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Inter', 'Helvetica Neue', Arial, sans-serif;
      margin-top: 0;
      position: relative;
      z-index: 1;
    }

    .explore-container-premium {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 24px;
    }

    .explore-layout-premium {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 32px;
      align-items: start;
    }

    /* Sidebar Filtres Premium - Même modèle que Services */
    .explore-sidebar-premium {
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

    .explore-sidebar-premium::-webkit-scrollbar {
      width: 6px;
    }

    .explore-sidebar-premium::-webkit-scrollbar-track {
      background: var(--premium-bg-light);
      border-radius: 3px;
    }

    .explore-sidebar-premium::-webkit-scrollbar-thumb {
      background: var(--premium-border);
      border-radius: 3px;
    }

    .explore-sidebar-premium::-webkit-scrollbar-thumb:hover {
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
      border-bottom: 2px solid var(--premium-primary);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .filter-title::before {
      content: '';
      width: 3px;
      height: 16px;
      background: var(--premium-primary);
      border-radius: 2px;
    }

    .filter-content {
      margin-top: 0;
    }

    .filter-input {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid var(--premium-border);
      border-radius: 8px;
      font-size: 14px;
      color: var(--premium-text);
      background: var(--premium-bg);
      transition: border-color 0.2s ease;
    }

    .filter-input:focus {
      outline: none;
      border-color: var(--premium-primary);
    }

    .filter-checkboxes {
      display: flex;
      flex-direction: column;
      gap: 8px;
      max-height: 300px;
      overflow-y: auto;
      overflow-x: hidden;
      margin-top: 0;
    }

    .filter-checkboxes::-webkit-scrollbar {
      width: 4px;
    }

    .filter-checkboxes::-webkit-scrollbar-track {
      background: transparent;
    }

    .filter-checkboxes::-webkit-scrollbar-thumb {
      background: var(--premium-border);
      border-radius: 2px;
    }

    .filter-checkboxes::-webkit-scrollbar-thumb:hover {
      background: var(--premium-text-light);
    }

    .filter-checkbox-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 14px;
      color: var(--premium-text-medium);
      user-select: none;
    }

    .filter-checkbox-item:hover {
      background: rgba(79, 70, 229, 0.05);
    }

    .filter-checkbox {
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: var(--premium-primary);
      flex-shrink: 0;
    }

    .filter-checkbox-item:has(.filter-checkbox:checked) {
      background: rgba(79, 70, 229, 0.08);
      color: var(--premium-primary);
      font-weight: 500;
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

    .filter-checkbox-item .filter-radio {
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: var(--premium-primary);
    }

    .filter-checkbox-item:has(.filter-radio:checked) {
      background: rgba(79, 70, 229, 0.08);
      color: var(--premium-primary);
      font-weight: 500;
    }

    .filter-option:has(.filter-radio:checked) {
      background: rgba(79, 70, 229, 0.08);
      color: var(--premium-primary);
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

    .explore-main-premium {
      min-width: 0;
    }

    /* Results Header */
    .results-header-premium {
      padding: 20px 0;
    }

    .results-count-premium {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--explore-text);
    }

    /* Freelancers Grid */
    .freelancers-grid-premium {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 24px;
    }

    /* Freelancer Card Premium */
    .freelancer-card-premium {
      background: var(--explore-bg);
      border-radius: 24px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
      border: 1px solid var(--explore-border);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      overflow: hidden;
    }

    .freelancer-card-premium:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 32px rgba(79, 70, 229, 0.15);
      border-color: var(--explore-primary);
    }

    .freelancer-card-inner {
      padding: 24px;
    }

    .freelancer-header-premium {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      margin-bottom: 16px;
      position: relative;
    }

    .freelancer-avatar-premium {
      width: 64px;
      height: 64px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      position: relative;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .avatar-initial {
      font-size: 24px;
      font-weight: 700;
      color: white;
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .verified-badge-premium {
      position: absolute;
      bottom: -4px;
      right: -4px;
      width: 24px;
      height: 24px;
      background: #4F46E5;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 12px;
      border: 2px solid white;
      box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .freelancer-info-premium {
      flex: 1;
      min-width: 0;
    }

    .freelancer-name-premium {
      font-size: 18px;
      font-weight: 700;
      color: var(--explore-text);
      margin: 0 0 4px 0;
      line-height: 1.3;
    }

    .freelancer-location-premium {
      font-size: 13px;
      color: var(--explore-text-light);
      margin: 0;
    }

    .super-badge-premium {
      position: absolute;
      top: 0;
      right: 0;
      background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
      color: white;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 600;
      box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }

    .freelancer-bio-premium {
      font-size: 14px;
      color: var(--explore-text-light);
      line-height: 1.6;
      margin: 0 0 16px 0;
    }

    .freelancer-skills-premium {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      margin-bottom: 20px;
    }

    .skill-tag-premium {
      background: rgba(79, 70, 229, 0.08);
      color: var(--explore-primary);
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 500;
    }

    .skill-more-premium {
      background: var(--explore-border);
      color: var(--explore-text-light);
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 500;
    }

    .freelancer-stats-premium {
      display: flex;
      gap: 16px;
      margin-bottom: 20px;
      padding: 16px;
      background: var(--explore-bg-light);
      border-radius: 12px;
    }

    .stat-item-premium {
      display: flex;
      align-items: center;
      gap: 12px;
      flex: 1;
    }

    .stat-icon-premium {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .stat-content-premium {
      display: flex;
      flex-direction: column;
    }

    .stat-value-premium {
      font-size: 18px;
      font-weight: 700;
      color: var(--explore-text);
      line-height: 1;
    }

    .stat-label-premium {
      font-size: 11px;
      color: var(--explore-text-light);
      margin-top: 2px;
    }

    .freelancer-cta-premium {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      padding: 12px 20px;
      background: var(--explore-gradient);
      color: white;
      text-decoration: none;
      border-radius: 10px;
      font-weight: 600;
      font-size: 14px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .freelancer-cta-premium:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(79, 70, 229, 0.3);
      color: white;
    }

    /* Empty State */
    .empty-state-premium {
      text-align: center;
      padding: 80px 20px;
      background: var(--explore-bg);
      border-radius: 20px;
      border: 2px dashed var(--explore-border);
    }

    .empty-title-premium {
      font-size: 24px;
      font-weight: 700;
      color: var(--explore-text);
      margin-bottom: 12px;
    }

    .empty-text-premium {
      font-size: 16px;
      color: var(--explore-text-light);
      max-width: 500px;
      margin: 0 auto;
    }

    .btn-empty-reset-premium {
      display: inline-flex;
      align-items: center;
      padding: 12px 24px;
      background: var(--explore-gradient);
      color: white;
      text-decoration: none;
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .btn-empty-reset-premium:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
      color: white;
    }

    /* Pagination */
    .pagination-wrapper-premium {
      display: flex;
      justify-content: center;
    }

    .pagination-wrapper-premium .pagination {
      gap: 8px;
    }

    .pagination-wrapper-premium .page-link {
      border-radius: 8px;
      border: 1px solid var(--explore-border);
      color: var(--explore-text);
      padding: 10px 16px;
      transition: all 0.2s ease;
    }

    .pagination-wrapper-premium .page-link:hover {
      background: rgba(79, 70, 229, 0.1);
      border-color: var(--explore-primary);
      color: var(--explore-primary);
    }

    .pagination-wrapper-premium .page-item.active .page-link {
      background: var(--explore-gradient);
      border-color: var(--explore-primary);
      color: white;
    }

    /* Hero Explore Premium - Style page d'accueil (raffiné et classe) */
    .explore-hero-premium {
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
    body .explore-hero-premium {
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
    .explore-hero-premium::before {
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
    .explore-hero-premium::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 55%;
      height: 100%;
      background: linear-gradient(to right, rgba(2, 6, 23, 0.4) 0%, transparent 100%);
      z-index: 1;
    }

    .explore-hero-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
      position: relative;
      z-index: 2;
    }

    .explore-hero-content {
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

    .explore-hero-title {
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
    .explore-hero-title .hero-title-line-1 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #FFFFFF;
      margin-bottom: 0.75rem;
      white-space: nowrap;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .explore-hero-title .hero-title-line-1 .highlight {
      font-weight: 600;
      background: linear-gradient(135deg, #60A5FA 0%, #A78BFA 50%, #C084FC 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      color: #60A5FA;
      display: inline-block;
    }

    .explore-hero-title .hero-title-line-2 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #FFFFFF;
      white-space: nowrap;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .explore-hero-subtitle {
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

    .explore-hero-stats {
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

    /* Responsive */
    @media (max-width: 1024px) {
      .explore-hero-premium {
        padding: 130px 0 90px !important;
      }

      .explore-hero-title {
        font-size: 2.8rem;
      }
    }

    @media (max-width: 992px) {
      .explore-layout-premium {
        grid-template-columns: 1fr;
      }

      .explore-sidebar-premium {
        position: static;
        margin-bottom: 32px;
      }

      .freelancers-grid-premium {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
      }
    }

    @media (max-width: 768px) {
      .explore-hero-premium {
        padding: 100px 0 70px !important;
      }

      .explore-hero-title {
        font-size: 2rem;
      }

      .explore-hero-subtitle {
        font-size: 1rem;
      }

      .explore-sidebar-premium {
        position: relative;
        top: 0;
        margin-bottom: 24px;
      }

      .explore-layout-premium {
        grid-template-columns: 1fr;
      }

      .hero-stat-text {
        font-size: 0.875rem;
        padding: 8px 18px;
      }

      .freelancers-grid-premium {
        grid-template-columns: 1fr;
      }
    }
  </style>
@endsection

@section('script')
  <script>
    // Forcer l'application du dégradé sur l'en-tête
    (function() {
      function applyHeaderGradient() {
        const gradient = 'linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%)';
        
        const headerArea = document.querySelector('.header-area');
        const mainNavbar = document.querySelector('.header-area .main-navbar');
        const mainResponsiveNav = document.querySelector('.header-area .main-responsive-nav');
        const navbar = document.querySelector('.header-area .main-navbar .navbar');
        const containerFluid = document.querySelector('.header-area .main-navbar .container-fluid');
        
        [headerArea, mainNavbar, mainResponsiveNav, navbar, containerFluid].forEach(function(element) {
          if (element) {
            element.style.setProperty('background', gradient, 'important');
            element.style.setProperty('background-color', 'transparent', 'important');
            element.style.setProperty('background-image', gradient, 'important');
          }
        });
        
        // Forcer la couleur blanche sur tous les liens de navigation
        const navLinks = document.querySelectorAll('.header-area .nav-link, .header-area .navbar-nav a, .header-area .main-navbar a');
        navLinks.forEach(function(link) {
          if (link) {
            link.style.setProperty('color', 'rgba(255, 255, 255, 0.95)', 'important');
            link.style.setProperty('-webkit-text-fill-color', 'rgba(255, 255, 255, 0.95)', 'important');
          }
        });
      }
      
      applyHeaderGradient();
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
          applyHeaderGradient();
          setTimeout(applyHeaderGradient, 100);
          setTimeout(applyHeaderGradient, 500);
        });
      } else {
        setTimeout(applyHeaderGradient, 100);
        setTimeout(applyHeaderGradient, 500);
      }
    })();

    // Tarif horaire (10€ - 299€ selon le modèle Junspro)
    let min_hourly_rate = 10;
    let max_hourly_rate = 299;
    let curr_min_rate = {{ (int)($filters['price_min'] ?? 10) }};
    let curr_max_rate = {{ (int)($filters['price_max'] ?? 299) }};
    
    // Initialiser le slider de tarif horaire si présent
    $(document).ready(function() {
      if ($('#hourly-rate-slider').length > 0 && typeof $.fn.slider !== 'undefined') {
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

    // Gestion du formulaire de filtres
    document.addEventListener('DOMContentLoaded', function() {
      const filterForm = document.getElementById('explore-filters-form');
      const resetBtn = document.querySelector('.reset-filters-btn');
      
      // Soumission automatique du formulaire lors du changement de filtres
      if (filterForm) {
        const inputs = filterForm.querySelectorAll('input[type="checkbox"], input[type="radio"], select');
        inputs.forEach(function(input) {
          input.addEventListener('change', function() {
            // Ne pas soumettre automatiquement pour les radios/checkboxes, seulement pour les selects
            if (input.tagName === 'SELECT') {
              filterForm.submit();
            }
          });
        });
      }

      // Bouton Reset
      if (resetBtn) {
        resetBtn.addEventListener('click', function() {
          window.location.href = '{{ route("explore") }}';
        });
      }
    });
  </script>
@endsection
