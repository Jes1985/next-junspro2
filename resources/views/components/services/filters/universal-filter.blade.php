@props([
    'universe' => 'projects', // projects|lessons|at-home|wellnesslive|homeswap|corporate
    'categories' => [],
    'lessonGoals' => [],
    'routeName' => 'services.projects',
    'accentColor' => '#8B5CF6', // Couleur accent par défaut (violet)
    'embedded' => false,       // true = contenu seul, sans section ni form (pour inclusion dans search-filter)
    'excludeBudgetRituel' => false, // true = ne pas afficher Budget en Rituel (déjà rendu au‑dessus)
    'hierarchyMode' => false,   // true = hiérarchie premium /services/projects (Niveau 2 + 3)
    'hideDomainSpecInAdvanced' => false, // true = ne pas afficher Domaine + Spécialisation (déjà dans hero, ex: projects)
    'disableExpertFilter' => false, // true = masque "Profils d'experts" (onboarding miroir)
])

@php
    /**
     * Fonction helper pour normaliser une valeur en string sûre pour les comparaisons et les value=""
     * Gère les strings simples et les arrays structurés
     */
    if (!function_exists('normalizeValue')) {
        function normalizeValue($item) {
            if (is_string($item)) {
                return \Illuminate\Support\Str::slug($item);
            }
            if (is_array($item)) {
                $rawValue = $item['value'] ?? $item['slug'] ?? $item['label'] ?? $item['name'] ?? $item['title'] ?? '';
                return \Illuminate\Support\Str::slug($rawValue);
            }
            return '';
        }
    }
    
    /**
     * Fonction helper pour obtenir le label d'un item (string ou array)
     */
    if (!function_exists('getLabel')) {
        function getLabel($item) {
            if (is_string($item)) {
                return $item;
            }
            if (is_array($item)) {
                return $item['label'] ?? $item['name'] ?? $item['title'] ?? '';
            }
            return '';
        }
    }
    
    // Configuration par univers
    $universeConfig = [
        'projects' => [
            'accent' => '#8B5CF6',
            'budgetLabel' => 'Engagement en Rituel',
            'showSpecialization' => true,
            'showSector' => true,
            'showAvailability' => true,
            'showExperience' => true,
            'showTeacherSpeaks' => false,  // Supprimé de l'UI pour /services/projects
            'showNativeOnly' => false,    // Supprimé de l'UI pour /services/projects
            'showCategoryFilter' => true,
        ],
        'lessons' => [
            'accent' => '#3B82F6',
            'budgetLabel' => 'Budget en Rituel',
            'showSpecialization' => true,
            'showSector' => true,
            'showAvailability' => true,
            'showExperience' => true,
            'showTeacherSpeaks' => false,  // Supprimé de l'UI pour /services/lessons
            'showNativeOnly' => false,     // Supprimé de l'UI pour /services/lessons
            'showCategoryFilter' => true,
            'showLessonGoal' => true,
        ],
        'at-home' => [
            'accent' => '#10B981',
            'budgetLabel' => 'Tarif par Rituel',
            'showSpecialization' => true,
            'showSector' => true,
            'showAvailability' => true,
            'showTeacherSpeaks' => true,
            'showNativeOnly' => true,
            'showCategoryFilter' => true,
            'showServiceType' => true,
            'showRating' => true,
        ],
        'wellnesslive' => [
            'accent' => '#F59E0B',
            'budgetLabel' => 'Tarif par Rituel',
            'showSpecialization' => true,
            'showSector' => true,
            'showAvailability' => true,
            'showTeacherSpeaks' => true,
            'showNativeOnly' => true,
            'showCategoryFilter' => true,
            'showMode' => true,
        ],
        'homeswap' => [
            'accent' => '#EC4899',
            'budgetLabel' => 'Durée',
            'showSpecialization' => true,
            'showSector' => false,
            'showAvailability' => true,
            'showTeacherSpeaks' => false,
            'showNativeOnly' => false,
            'showCategoryFilter' => true,
        ],
        'corporate' => [
            'accent' => '#6366F1',
            'budgetLabel' => 'Tarif par Rituel',
            'showSpecialization' => true,
            'showSector' => false,
            'showAvailability' => true,
            'showTeacherSpeaks' => true,
            'showNativeOnly' => true,
            'showCategoryFilter' => true,
        ],
    ];
    
    $config = $universeConfig[$universe] ?? $universeConfig['projects'];
    if ($disableExpertFilter) {
      $config['showCategoryFilter'] = false;
    }
    $accentColor = $config['accent'] ?? $accentColor;
@endphp

@if($embedded && ($hierarchyMode ?? false) && in_array($universe, ['projects', 'lessons', 'homeswap', 'at-home', 'wellnesslive']))
  {{-- Hiérarchie premium /services/projects ET /services/lessons (copie stricte) : Niveau 2 (Affiner) + Niveau 3 (Critères avancés) — contenu seul, sans section/form --}}
  @php
  if (in_array($universe, ['lessons', 'at-home', 'wellnesslive']) && !empty($categories)) {
    $categoriesLessonsRoot = $categories;
    $categories = array_map(function($k) { 
      if (is_string($k)) {
        return ['slug' => \Illuminate\Support\Str::slug($k), 'label' => $k];
      }
      return ['slug' => normalizeValue($k), 'label' => getLabel($k)]; 
    }, array_keys($categories));
    $domainSpecializations = [];
    foreach ($categoriesLessonsRoot as $domainName => $subs) {
      $slug = normalizeValue($domainName);
      $domainSpecializations[$slug] = [];
      foreach ((array) $subs as $s) {
        $domainSpecializations[$slug][] = [normalizeValue($s), getLabel($s)];
      }
    }
  }
  // Pour lessons / at-home / wellnesslive, $domainSpecializations est construit ci-dessus.
  @endphp
  <div class="filters-level filters-level-2" data-level="affiner">
    <h3 class="filters-level-title">Affiner la recherche</h3>
    <div class="filters-level-inner">
      @include('components.services.filters.partials.level-2-filters', array_merge(
        ['universe' => $universe, 'config' => $config, 'categories' => $categories ?? [], 'hideDomainSpec' => $hideDomainSpecInAdvanced ?? false],
        in_array($universe, ['lessons', 'at-home', 'wellnesslive']) ? ['domainSpecializations' => $domainSpecializations ?? []] : []
      ))
    </div>
  </div>
  <div class="filters-level filters-level-3" data-level="avances">
    <h3 class="filters-level-title">Critères avancés</h3>
    <div class="filters-level-inner">
      @include('components.services.filters.partials.level-3-filters', [
        'universe' => $universe,
        'config' => $config
      ])
    </div>
  </div>
@else
<section class="preply-filters-section" data-universe="{{ $universe }}">
  <div class="preply-filters-container">
    <form method="GET" action="{{ route($routeName) }}" id="preplyFiltersForm">
      <div class="preply-filters-row">
        {{-- Domaine/Catégorie --}}
        @if(!empty($categories))
          <div class="preply-filter-group">
            <label class="preply-filter-label preply-filter-label-icon">
              <i class="fas fa-folder-open me-2"></i>
              @if($universe === 'lessons')
                Domaine
              @elseif($universe === 'at-home' || $universe === 'corporate')
                Type de service
              @elseif($universe === 'wellnesslive')
                Type de session
              @elseif($universe === 'homeswap')
                Type de logement
              @else
                Domaine
              @endif
            </label>
            @if($universe === 'projects' || $universe === 'lessons' || $universe === 'homeswap')
              {{-- Dropdown avec sous-domaines (structure accordéon) --}}
              <div class="domain-dropdown-wrapper">
                <div class="domain-dropdown-trigger" id="domainDropdownTrigger">
                  <span class="domain-selected-text" id="domainSelectedText">
                    @if(request('category'))
                      @if($universe === 'lessons')
                        @php
                          $selectedCategory = request('category');
                          $foundCategory = null;
                          foreach($categories as $domainName => $subDomains) {
                            if (is_array($subDomains)) {
                              foreach($subDomains as $subDomain) {
                                if (normalizeValue($subDomain) === $selectedCategory) {
                                  $foundCategory = getLabel($subDomain);
                                  break 2;
                                }
                              }
                            }
                          }
                          echo $foundCategory ?? 'Domaine sélectionné';
                        @endphp
                      @elseif(($universe === 'projects' || $universe === 'homeswap') && isset($categories[0]['slug']))
                        @php
                          $sel = request('category');
                          $l = 'Tous les domaines';
                          foreach($categories as $c) { 
                            $catSlug = normalizeValue($c);
                            if ($catSlug === $sel) { 
                              $l = getLabel($c); 
                              break; 
                            } 
                          }
                          echo $l;
                        @endphp
                      @else
                        Tous les domaines
                      @endif
                    @else
                      Tous les domaines
                    @endif
                  </span>
                  <i class="fas fa-chevron-down domain-arrow" id="domainArrow"></i>
                </div>
                <div class="domain-dropdown-menu" id="domainDropdownMenu" style="display: none;">
                  <div class="domain-option" data-value="">
                    <span>Tous les domaines</span>
                  </div>
                  @if(($universe === 'projects' || $universe === 'homeswap') && isset($categories[0]['slug']))
                    {{-- Format V1 premium : domaines (liste simple, pas d'accordéon) --}}
                    @foreach($categories as $cat)
                      @php
                        $catValue = normalizeValue($cat);
                        $catLabel = getLabel($cat);
                        $catDesc = is_array($cat) ? ($cat['description'] ?? '') : '';
                      @endphp
                      <div class="domain-option" data-value="{{ $catValue }}">
                        <span class="domain-option-label">{{ $catLabel }}</span>
                        @if(!empty($catDesc))
                          <span class="domain-option-desc">{{ $catDesc }}</span>
                        @endif
                      </div>
                    @endforeach
                  @else
                    {{-- Format accordéon (lessons, etc.) --}}
                    @foreach($categories as $domainName => $subDomains)
                      @php
                        $domainValue = normalizeValue(is_array($subDomains) ? $domainName : $subDomains);
                        $hasSubDomains = is_array($subDomains) && count($subDomains) > 0;
                        $domainLabel = is_array($subDomains) ? getLabel($domainName) : getLabel($subDomains);
                      @endphp
                      <div class="domain-option-group">
                        <div class="domain-option-main" data-value="{{ $domainValue }}" data-has-subdomains="{{ $hasSubDomains ? 'true' : 'false' }}">
                          @if($hasSubDomains)
                            <i class="fas fa-chevron-right domain-arrow-inline"></i>
                          @endif
                          <span>{{ $domainLabel }}</span>
                        </div>
                        @if($hasSubDomains)
                          <div class="domain-submenu" style="display: none;">
                            @foreach($subDomains as $subDomain)
                              @php
                                $subValue = normalizeValue($subDomain);
                                $subLabel = getLabel($subDomain);
                              @endphp
                              <div class="domain-option domain-suboption" data-value="{{ $subValue }}">
                                <span>{{ $subLabel }}</span>
                              </div>
                            @endforeach
                          </div>
                        @endif
                      </div>
                    @endforeach
                  @endif
                </div>
                <input type="hidden" name="category" id="domainInput" value="{{ request('category') }}">
              </div>
              {{-- Micro-description premium sous le filtre Domaine (affiché uniquement lorsqu'un domaine est sélectionné) --}}
              <div id="domainPremiumDesc" class="domain-premium-desc" style="display: none;" aria-live="polite">
                <span class="domain-premium-desc-icon" aria-hidden="true">✦</span>
                <span id="domainPremiumDescText"></span>
              </div>
              @php
                $domainLongDescriptions = [
                  'strategie-conseil' => "Vision, structuration et décisions à fort enjeu.",
                  'marketing-croissance' => "Positionnement, acquisition et développement durable.",
                  'tech-produits-digitaux' => "Conception, évolution et performance des solutions digitales.",
                  'creation-image-marque' => "Identité, narration et impact de marque.",
                  'formation-accompagnement' => "Accompagnement stratégique et transmission ciblée.",
                ];
              @endphp
              <script>
                window.__domainLongDescriptions = @json($domainLongDescriptions);
              </script>
            @else
              {{-- Select simple pour les autres univers --}}
              <select name="category" class="preply-filter-select">
                <option value="">
                  @if($universe === 'at-home' || $universe === 'corporate')
                    Tous les services
                  @elseif($universe === 'wellnesslive')
                    Toutes les catégories
                  @elseif($universe === 'homeswap')
                    Tous les types
                  @else
                    Tous les domaines
                  @endif
                </option>
                @if($universe === 'wellnesslive')
                  @foreach($categories as $groupName => $groupCategories)
                    @if(is_array($groupCategories))
                      @foreach($groupCategories as $category)
                        @php
                          $catValue = normalizeValue($category);
                          $catLabel = getLabel($category);
                          $isSelected = request('category') === $catValue;
                        @endphp
                        <option value="{{ $catValue }}" {{ $isSelected ? 'selected' : '' }}>
                          {{ $catLabel }}
                        </option>
                      @endforeach
                    @else
                      @php
                        $groupValue = normalizeValue($groupName);
                        $groupLabel = getLabel($groupName);
                        $isSelected = request('category') === $groupValue;
                      @endphp
                      <option value="{{ $groupValue }}" {{ $isSelected ? 'selected' : '' }}>
                        {{ $groupLabel }}
                      </option>
                    @endif
                  @endforeach
                @else
                  @foreach($categories as $category)
                    @php
                      $catValue = normalizeValue($category);
                      $catLabel = getLabel($category);
                      $isSelected = request('category') === $catValue;
                    @endphp
                    <option value="{{ $catValue }}" {{ $isSelected ? 'selected' : '' }}>
                      {{ $catLabel }}
                    </option>
                  @endforeach
                @endif
              </select>
            @endif
          </div>
        @endif

        {{-- Objectif du Rituel (uniquement lessons) --}}
        @if($universe === 'lessons' && !empty($lessonGoals))
          <div class="preply-filter-group">
            <label class="preply-filter-label">Objectif du Rituel</label>
            <select name="lesson_goal" class="preply-filter-select">
              <option value="">Tous les objectifs</option>
              @foreach($lessonGoals as $key => $label)
                <option value="{{ $key }}" {{ request('lesson_goal') == $key ? 'selected' : '' }}>
                  {{ $label }}
                </option>
              @endforeach
            </select>
          </div>
        @endif

        {{-- Mode (uniquement wellnesslive) --}}
        @if($universe === 'wellnesslive')
          <div class="preply-filter-group">
            <label class="preply-filter-label">Mode</label>
            <select name="mode" class="preply-filter-select">
              <option value="">Tous les modes</option>
              <option value="live" {{ (is_string(request('mode')) && request('mode') == 'live') ? 'selected' : '' }}>LIVE</option>
              <option value="vod" {{ (is_string(request('mode')) && request('mode') == 'vod') ? 'selected' : '' }}>VOD</option>
            </select>
          </div>
        @endif

        {{-- Budget/Tarif (masqué si excludeBudgetRituel, ex. quand déplacé dans Filtres avancés) --}}
        @if(!$excludeBudgetRituel)
        <div class="preply-filter-group">
          <label class="preply-filter-label">{{ $config['budgetLabel'] ?? 'Budget' }}</label>
          @if($universe === 'projects')
          <div class="engagement-select-wrapper">
            <select name="price_range" class="preply-filter-select budget-filter" id="budgetFilter">
              <option value="" {{ empty(request('price_range')) ? 'selected' : '' }}>Tous les engagements</option>
              <option value="0-1000" data-min="0" data-max="1000" {{ request('price_range') == '0-1000' ? 'selected' : '' }}>0 – 1 000 € — Engagement exploratoire</option>
              <option value="1000-2500" data-min="1000" data-max="2500" {{ request('price_range') == '1000-2500' ? 'selected' : '' }}>1 000 – 2 500 € — Engagement ciblé</option>
              <option value="2500-5000" data-min="2500" data-max="5000" {{ request('price_range') == '2500-5000' ? 'selected' : '' }}>2 500 – 5 000 € — Engagement structuré</option>
              <option value="5000-10000" data-min="5000" data-max="10000" {{ request('price_range') == '5000-10000' ? 'selected' : '' }}>5 000 – 10 000 € — Engagement stratégique</option>
              {{-- Paliers progressifs (masqués par défaut, révélés progressivement) --}}
              <option value="10000-20000" class="engagement-progressive engagement-level-1" data-min="10000" data-max="20000" {{ request('price_range') == '10000-20000' ? 'selected' : '' }}>10 000 – 20 000 € — Engagement de partenariat</option>
              <option value="20000-60000" class="engagement-progressive engagement-level-2" data-min="20000" data-max="60000" {{ request('price_range') == '20000-60000' ? 'selected' : '' }}>20 000 – 60 000 € — Partenariat long terme</option>
              <option value="60000+" class="engagement-progressive engagement-level-3" data-min="60000" data-max="999999" {{ request('price_range') == '60000+' ? 'selected' : '' }}>60 000 € et + — Partenariat stratégique étendu</option>
            </select>
            {{-- Micro-invitations progressives (niveau 1, 2, 3) --}}
            <a href="#" class="engagement-progressive-link engagement-link-level-1" id="engagementLinkLevel1" style="display: none; margin-top: 6px; font-size: 11px; color: #6b7280; text-decoration: underline; cursor: pointer; font-family: inherit;">Explorer des engagements plus avancés</a>
            <a href="#" class="engagement-progressive-link engagement-link-level-2" id="engagementLinkLevel2" style="display: none; margin-top: 6px; font-size: 11px; color: #6b7280; text-decoration: underline; cursor: pointer; font-family: inherit;">Découvrir les partenariats long terme</a>
            <a href="#" class="engagement-progressive-link engagement-link-level-3" id="engagementLinkLevel3" style="display: none; margin-top: 6px; font-size: 11px; color: #6b7280; text-decoration: underline; cursor: pointer; font-family: inherit;">Voir les collaborations stratégiques étendues</a>
            {{-- Retour aux paliers essentiels --}}
            <a href="#" class="engagement-progressive-link engagement-link-reset" id="engagementLinkReset" style="display: none; margin-top: 6px; font-size: 11px; color: #6b7280; text-decoration: underline; cursor: pointer; font-family: inherit;">Revenir à l'essentiel</a>
          </div>
          @else
          <select name="price_range" class="preply-filter-select budget-filter">
            @if($universe === 'homeswap')
              <option value="">Toutes les durées</option>
              <option value="3-20" {{ request('price_range') == '3-20' ? 'selected' : '' }}>Courte durée</option>
              <option value="20-30" {{ request('price_range') == '20-30' ? 'selected' : '' }}>Moyenne durée</option>
              <option value="30-40" {{ request('price_range') == '30-40' ? 'selected' : '' }}>Longue durée</option>
            @elseif($universe === 'corporate')
              <option value="">Tous les rituels</option>
              <option value="3-20" {{ request('price_range') == '3-20' ? 'selected' : '' }}>Sur devis</option>
              <option value="20-30" {{ request('price_range') == '20-30' ? 'selected' : '' }}>Abonnement mensuel</option>
              <option value="30-40" {{ request('price_range') == '30-40' ? 'selected' : '' }}>Forfait trimestriel</option>
              <option value="40-50" {{ request('price_range') == '40-50' ? 'selected' : '' }}>Forfait annuel</option>
            @else
              <option value="">Tous les rituels</option>
              <option value="3-20" {{ request('price_range') == '3-20' ? 'selected' : '' }}>3-20 €</option>
              <option value="20-30" {{ request('price_range') == '20-30' ? 'selected' : '' }}>20-30 €</option>
              <option value="30-40" {{ request('price_range') == '30-40' ? 'selected' : '' }}>30-40 €</option>
              <option value="40-50" {{ request('price_range') == '40-50' ? 'selected' : '' }}>40-50 €</option>
              <option value="50+" {{ request('price_range') == '50+' ? 'selected' : '' }}>50€ et +</option>
            @endif
          </select>
          @endif
          @if($universe === 'projects')
            <div class="budget-estimate" id="budgetEstimate" style="font-size: 12px; margin-top: 6px; color: #6B7280; opacity: 0.8; font-weight: 400;"></div>
          @endif
        </div>
        @endif

        {{-- Pays de naissance (supprimé pour /services/projects et /services/lessons) --}}
        @if($universe !== 'projects' && $universe !== 'lessons')
        <div class="preply-filter-group">
          <label class="preply-filter-label">Pays de naissance</label>
          <div class="country-dropdown-wrapper">
            <div class="country-dropdown-trigger" id="countryDropdownTrigger">
              <span class="country-selected-text" id="countrySelectedText">
                @if(request('country'))
                  @php
                    $countryNames = [
                      'GB' => 'Royaume-Uni', 'FR' => 'France', 'US' => 'États-Unis d\'Amérique', 'CA' => 'Canada',
                      'ZA' => 'Afrique du Sud', 'ES' => 'Espagne', 'DE' => 'Allemagne', 'IT' => 'Italie',
                      'PT' => 'Portugal', 'BE' => 'Belgique', 'CH' => 'Suisse', 'NL' => 'Pays-Bas',
                      'AT' => 'Autriche', 'SE' => 'Suède', 'NO' => 'Norvège', 'DK' => 'Danemark',
                      'FI' => 'Finlande', 'PL' => 'Pologne', 'GR' => 'Grèce', 'IE' => 'Irlande',
                      'AU' => 'Australie', 'NZ' => 'Nouvelle-Zélande', 'BR' => 'Brésil', 'MX' => 'Mexique',
                      'AR' => 'Argentine', 'CL' => 'Chili', 'CO' => 'Colombie', 'PE' => 'Pérou',
                      'VE' => 'Venezuela', 'JP' => 'Japon', 'CN' => 'Chine', 'KR' => 'Corée du Sud',
                      'IN' => 'Inde', 'TH' => 'Thaïlande', 'VN' => 'Vietnam', 'ID' => 'Indonésie',
                      'MY' => 'Malaisie', 'SG' => 'Singapour', 'PH' => 'Philippines', 'AE' => 'Émirats arabes unis',
                      'SA' => 'Arabie saoudite', 'IL' => 'Israël', 'TR' => 'Turquie', 'EG' => 'Égypte',
                      'MA' => 'Maroc', 'TN' => 'Tunisie', 'DZ' => 'Algérie', 'SN' => 'Sénégal',
                      'CI' => 'Côte d\'Ivoire', 'CM' => 'Cameroun', 'KE' => 'Kenya', 'NG' => 'Nigeria',
                      'GH' => 'Ghana', 'RU' => 'Russie', 'UA' => 'Ukraine', 'RO' => 'Roumanie',
                      'CZ' => 'République tchèque', 'HU' => 'Hongrie',
                    ];
                    $selectedCountryName = $countryNames[request('country')] ?? request('country');
                  @endphp
                  {{ $selectedCountryName }}
                @else
                  Tous les pays
                @endif
              </span>
              <input type="hidden" name="country" id="countryInput" value="{{ request('country') ?? '' }}">
              <i class="fas fa-chevron-down country-arrow" id="countryArrow"></i>
            </div>
            <div class="country-dropdown-menu" id="countryDropdownMenu" style="display: none;">
              <div class="country-search-wrapper">
                <i class="fas fa-search country-search-icon"></i>
                <input type="text" class="country-search-input" id="countrySearchInput" placeholder="Tapez votre recherche…" autocomplete="off">
              </div>
              <div class="country-popular-section">
                <div class="country-popular-header">Populaires</div>
                <div class="country-list" id="countryPopularList">
                  <!-- Rempli dynamiquement par JS -->
                </div>
              </div>
              <div class="country-all-section" id="countryAllSection" style="display: none;">
                <div class="country-list" id="countryAllList">
                  <!-- Rempli dynamiquement par JS -->
                </div>
              </div>
              <div class="country-no-results" id="countryNoResults" style="display: none;">
                Aucun résultat
              </div>
            </div>
          </div>
        </div>
        @endif

        {{-- Disponibilités --}}
        @if($config['showAvailability'] ?? true)
          <div class="preply-filter-group preply-availability-group">
            <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-calendar-alt me-2"></i>Mes disponibilités</label>
            @if($universe === 'lessons')
              {{-- /services/lessons : modèle simplifié (capture 2) — select à 4 options — sans toucher aux autres univers --}}
              <select name="availability" class="preply-filter-select">
                <option value="" {{ empty(request('availability')) ? 'selected' : '' }}>Toutes les heures</option>
                <option value="9-12" {{ request('availability') == '9-12' ? 'selected' : '' }}>9h-12h</option>
                <option value="12-18" {{ request('availability') == '12-18' ? 'selected' : '' }}>12h-18h</option>
                <option value="18-21" {{ request('availability') == '18-21' ? 'selected' : '' }}>18h-21h</option>
              </select>
            @else
              {{-- Autres univers : modèle complet Heures + Jours (capture 1) --}}
              <button type="button" class="preply-availability-trigger" onclick="toggleAvailabilityPanel()">
                <span class="availability-selected-text">Toutes les heures</span>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="preply-availability-panel" id="availabilityPanel">
                <div class="availability-section">
                  <h4 class="availability-section-title">Heures</h4>
                  
                  <div class="availability-time-group">
                    <div class="availability-time-label">Journée</div>
                    <div class="availability-time-slots">
                      <button type="button" class="availability-time-btn" data-time="9-12">
                        <i class="fas fa-sun"></i>
                        <span>9-12</span>
                      </button>
                      <button type="button" class="availability-time-btn" data-time="12-15">
                        <i class="fas fa-sun"></i>
                        <span>12-15</span>
                      </button>
                      <button type="button" class="availability-time-btn" data-time="15-18">
                        <i class="fas fa-sun"></i>
                        <span>15-18</span>
                      </button>
                    </div>
                  </div>
                  
                  <div class="availability-time-group">
                    <div class="availability-time-label">Soir et nuit</div>
                    <div class="availability-time-slots">
                      <button type="button" class="availability-time-btn" data-time="18-21">
                        <i class="fas fa-sun"></i>
                        <span>18-21</span>
                      </button>
                      <button type="button" class="availability-time-btn" data-time="21-24">
                        <i class="fas fa-moon"></i>
                        <span>21-24</span>
                      </button>
                      <button type="button" class="availability-time-btn" data-time="0-3">
                        <i class="fas fa-moon"></i>
                        <span>0-3</span>
                      </button>
                    </div>
                  </div>
                  
                  <div class="availability-time-group">
                    <div class="availability-time-label">Tôt le matin</div>
                    <div class="availability-time-slots">
                      <button type="button" class="availability-time-btn" data-time="3-6">
                        <i class="fas fa-moon"></i>
                        <span>3-6</span>
                      </button>
                      <button type="button" class="availability-time-btn" data-time="6-9">
                        <i class="fas fa-sun"></i>
                        <span>6-9</span>
                      </button>
                    </div>
                  </div>
                </div>
                
                <div class="availability-section">
                  <h4 class="availability-section-title">Jours</h4>
                  <div class="availability-days">
                    <button type="button" class="availability-day-btn" data-day="0">Dim</button>
                    <button type="button" class="availability-day-btn" data-day="1">Lun</button>
                    <button type="button" class="availability-day-btn" data-day="2">Mar</button>
                    <button type="button" class="availability-day-btn" data-day="3">Mer</button>
                    <button type="button" class="availability-day-btn" data-day="4">Jeu</button>
                    <button type="button" class="availability-day-btn" data-day="5">Ven</button>
                    <button type="button" class="availability-day-btn" data-day="6">Sam</button>
                  </div>
                </div>
                
                <div class="availability-actions">
                  <button type="button" class="availability-clear-btn" onclick="clearAvailabilitySelection()">Effacer</button>
                  <button type="button" class="availability-apply-btn" onclick="applyAvailabilityFilter()">Appliquer</button>
                </div>
              </div>
            @endif
          </div>
        @endif

        {{-- Mon expérience (projects uniquement) — dropdown ouvert vers le haut --}}
        @if($config['showExperience'] ?? false)
          <div class="preply-filter-group preply-experience-group">
            <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-briefcase me-2"></i>Mon expérience</label>
            <div class="experience-dropdown-wrapper">
              <div class="experience-dropdown-trigger" id="experienceDropdownTrigger">
                <span class="experience-selected-text" id="experienceSelectedText">
                  @if(request('experience_level') == '0-2')0-2 ans
                  @elseif(request('experience_level') == '3-7')3-7 ans
                  @elseif(request('experience_level') == '8-15')8-15 ans
                  @elseif(request('experience_level') == '16+')16 ans et plus
                  @else Niveau d'expertise attendu
                  @endif
                </span>
                <i class="fas fa-chevron-down experience-arrow" id="experienceArrow"></i>
              </div>
              <div class="experience-dropdown-menu" id="experienceDropdownMenu" style="display: none;">
                <div class="experience-option" data-value="">Niveau d'expertise attendu</div>
                <div class="experience-option" data-value="0-2">0-2 ans</div>
                <div class="experience-option" data-value="3-7">3-7 ans</div>
                <div class="experience-option" data-value="8-15">8-15 ans</div>
                <div class="experience-option" data-value="16+">16 ans et plus</div>
              </div>
              <input type="hidden" name="experience_level" id="experienceLevelInput" value="{{ request('experience_level') }}">
            </div>
          </div>
        @endif

      </div>

      <div class="preply-filters-advanced">
        {{-- Spécialisation --}}
        @if($config['showSpecialization'] ?? false)
          <div class="preply-filter-advanced">
            <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-graduation-cap me-2"></i>Spécialisation</label>
            <select name="specialization" class="preply-filter-select">
              <option value="">Spécialisation</option>
              @if($universe === 'projects')
                <option value="strategie_de_communication">Stratégie de communication</option>
                <option value="reseaux_sociaux">Réseaux sociaux</option>
                <option value="strategie_webmarketing">Stratégie webmarketing</option>
                <option value="branding">Branding</option>
                <option value="marketing_de_contenu">Marketing de contenu</option>
                <option value="redaction_web">Rédaction web</option>
                <option value="google_analytics">Google Analytics</option>
                <option value="strategie_entreprise">Stratégie d'entreprise</option>
                <option value="ecommerce">E-commerce</option>
                <option value="google_adwords">Google AdWords</option>
              @elseif($universe === 'at-home')
                <option value="beauty">Beauté</option>
                <option value="wellness">Bien-être</option>
                <option value="cleaning">Ménage</option>
              @elseif($universe === 'lessons')
                <option value="beginner">Débutant</option>
                <option value="intermediate">Intermédiaire</option>
                <option value="advanced">Avancé</option>
              @elseif($universe === 'homeswap')
                <option value="beginner">Débutant</option>
                <option value="intermediate">Intermédiaire</option>
                <option value="advanced">Avancé</option>
              @else
                <option value="beginner">Débutant</option>
                <option value="intermediate">Intermédiaire</option>
                <option value="advanced">Avancé</option>
              @endif
            </select>
          </div>
        @endif

        {{-- Type de prestation (at-home uniquement) --}}
        @if(($config['showServiceType'] ?? false) && $universe === 'at-home')
          <div class="preply-filter-advanced">
            <label class="preply-filter-label">Type de prestation</label>
            <select name="service_type" class="preply-filter-select">
              <option value="">Type de prestation</option>
              <option value="at-home">À domicile</option>
              <option value="on-site">Sur site</option>
            </select>
          </div>
        @endif

        {{-- Note minimale (at-home uniquement) --}}
        @if(($config['showRating'] ?? false) && $universe === 'at-home')
          <div class="preply-filter-advanced">
            <label class="preply-filter-label">Note minimale</label>
            <select name="rating" class="preply-filter-select">
              <option value="">Note minimale</option>
              <option value="4">4 étoiles et +</option>
              <option value="4.5">4.5 étoiles et +</option>
              <option value="5">5 étoiles</option>
            </select>
          </div>
        @endif

        {{-- Le freelance parle --}}
        @if($config['showTeacherSpeaks'] ?? false)
          <x-services.filters.teacher-speaks />
        @endif

        {{-- Langue maternelle --}}
        @if($config['showNativeOnly'] ?? false)
          <x-services.filters.native-language-filter />
        @endif

        {{-- Profils d'experts --}}
        @if($config['showCategoryFilter'] ?? false)
          <x-services.filters.category-filter />
        @endif

        {{-- Univers d'activité (ex-Secteur/Industrie, projects uniquement) --}}
        @if(($config['showSector'] ?? false) && $universe === 'projects')
          <div class="preply-filter-advanced sector-filter-container">
            <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-industry me-2"></i>Univers d'activité</label>
            <div class="sector-dropdown-wrapper">
              <div class="sector-dropdown-trigger" id="sectorDropdownTrigger">
                <span class="sector-selected-text" id="sectorSelectedText">
                  @if(request('sector'))
                    @php
                      $sectorNames = [
                        'business_strategie' => 'Business & Stratégie',
                        'tech_digital' => 'Tech & Digital',
                        'marketing_marques_croissance' => 'Marketing, Marques & Croissance',
                        'sante_bien_etre' => 'Santé & Bien-être',
                        'impact_culture_societe' => 'Impact, Culture & Société',
                        'formation_transmission' => 'Formation & Transmission',
                      ];
                      $selectedSectorName = $sectorNames[request('sector')] ?? request('sector');
                    @endphp
                    {{ $selectedSectorName }}
                  @else
                    Tous les univers d'activité
                  @endif
                </span>
                <input type="hidden" name="sector" id="sectorInput" value="{{ request('sector') ?? '' }}">
                <i class="fas fa-chevron-down sector-arrow" id="sectorArrow"></i>
              </div>
              <div class="sector-dropdown-menu" id="sectorDropdownMenu" style="display: none;">
                <div class="sector-search-wrapper">
                  <i class="fas fa-search sector-search-icon"></i>
                  <input type="text" class="sector-search-input" id="sectorSearchInput" placeholder="Tapez votre recherche…" autocomplete="off">
                </div>
                <div class="sector-popular-section">
                  <div class="sector-list" id="sectorPopularList">
                    <!-- Rempli dynamiquement par JS -->
                  </div>
                </div>
                <div class="sector-all-section" id="sectorAllSection" style="display: none;">
                  <div class="sector-list" id="sectorAllList">
                    <!-- Rempli dynamiquement par JS -->
                  </div>
                </div>
                <div class="sector-no-results" id="sectorNoResults" style="display: none;">
                  Aucun résultat
                </div>
                <div class="sector-reset-option" id="sectorResetOption" role="button" tabindex="0">Tous les univers d'activité</div>
              </div>
            </div>
          </div>
        @endif

        {{-- Barre de recherche (supprimée pour /services/projects et /services/lessons) --}}
        @if($universe !== 'projects' && $universe !== 'lessons')
        <x-services.filters.search-bar placeholder="Rechercher un service..." />
        @endif
      </div>
@if(!$embedded)
    </form>
  </div>
</section>
@else
</div>
@endif
@endif

@once
@push('styles')
<style>
  /* Accent couleur dynamique selon l'univers */
  [data-universe="{{ $universe }}"] .preply-filter-select:focus,
  [data-universe="{{ $universe }}"] .domain-dropdown-trigger:focus,
  [data-universe="{{ $universe }}"] .country-dropdown-trigger:focus,
  [data-universe="{{ $universe }}"] .category-filter-toggle-input:checked + .category-filter-toggle-slider {
    border-color: {{ $accentColor }};
  }
  
  [data-universe="{{ $universe }}"] .category-filter-toggle-input:checked + .category-filter-toggle-slider {
    background-color: {{ $accentColor }};
  }
</style>
@endpush
@endonce
