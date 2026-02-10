@props([
  'formId' => 'homeSearchFilterForm',
  'formAction' => null,
  'universe' => null,
  'keywordPlaceholder' => null,
  'locationPlaceholder' => null,
  'categories' => [], // pour /services/projects : intégration des filtres avancés (Domaine, Budget en Rituel, etc.)
  'categoryDescriptions' => [], // pour /services/lessons : micro-descriptions des domaines (slug => texte)
  'lessonGoals' => [], // pour /services/lessons : Objectif du cours dans Filtres avancés
  'domainSpecializations' => [], // pour /services/projects : spécialisations par domaine (hero Domaine + Spécialisation)
  'hubUniverses' => [], // pour /services (hub) : liste [['slug'=>'...','label'=>'...'], ...]
  'hubUniverseDomains' => [], // pour /services (hub) : map universe_slug => [[slug, label], ...]
])

@php
  $formAction = $formAction ?? route('services');
  $keywordPlaceholder = $keywordPlaceholder ?? __('Essayez "Pilates", "Marketing Digital", "Anglais"...');
  $locationPlaceholder = $locationPlaceholder ?? __('Lieu de la mission (ex: Paris, Lyon...)');
@endphp

<div class="home-search-filter-section" id="homeSearchFilter" style="scroll-margin-top: 100px;">
  <!-- Onglets -->
  <div class="filter-tabs-container">
    <div class="filter-tabs">
      <button type="button" class="filter-tab active" data-tab="search" id="tabSearch">
        <i class="fas fa-search me-2"></i>
        {{ __('Rechercher un Rituel') }}
      </button>
      <button type="button" class="filter-tab" data-tab="submit" id="tabSubmit">
        <i class="fas fa-paper-plane me-2"></i>
        {{ __('Déposer un projet') }}
      </button>
    </div>
  </div>

  <!-- Contenu Onglet Recherche -->
  <div class="filter-content active" id="contentSearch">
    @php
  $hasLocationDuo = in_array($universe, ['lessons', 'projects', 'corporate', 'at-home', 'wellnesslive', 'hub']);
  $locationCountryId = match($universe) {
    'lessons' => 'lessonsFilterCountry',
    'projects' => 'projectsFilterCountry',
    'corporate' => 'corporateFilterCountry',
    'at-home' => 'atHomeFilterCountry',
    'wellnesslive' => 'wellnessliveFilterCountry',
    'hub' => 'hubFilterCountry',
    default => 'corporateFilterCountry',
  };
  $locationCityId = match($universe) {
    'lessons' => 'lessonsFilterCity',
    'projects' => 'projectsFilterCity',
    'corporate' => 'corporateFilterCity',
    'at-home' => 'atHomeFilterCity',
    'wellnesslive' => 'wellnessliveFilterCity',
    'hub' => 'hubFilterCity',
    default => 'corporateFilterCity',
  };
  $locationCityWrapperId = match($universe) {
    'lessons' => 'lessonsCityWrapper',
    'projects' => 'projectsCityWrapper',
    'corporate' => 'corporateCityWrapper',
    'at-home' => 'atHomeCityWrapper',
    'wellnesslive' => 'wellnessliveCityWrapper',
    'hub' => 'hubCityWrapper',
    default => 'corporateCityWrapper',
  };
  $hasHeroDomainSpec = in_array($universe, ['projects', 'lessons', 'at-home', 'wellnesslive', 'corporate', 'hub']);
  $isHub = ($universe === 'hub');
  $isProjects = ($universe === 'projects');
  $isLessons = ($universe === 'lessons');
  $isCorporate = ($universe === 'corporate');
  $isAtHome = ($universe === 'at-home');
  $isWellnesslive = ($universe === 'wellnesslive');
  // Déterminer le scope selon le formId pour distinguer /home de /services
  $heroFilterScope = ($formId === 'homeHubSearchFilter') ? 'home' : ($universe === 'projects' ? 'projects' : ($universe === 'lessons' ? 'lessons' : ($universe === 'corporate' ? 'corporate' : ($universe === 'at-home' ? 'at-home' : ($universe === 'wellnesslive' ? 'wellnesslive' : 'hub')))));
  $isHomePage = ($formId === 'homeHubSearchFilter');
  $heroCategories = [];
  $heroDomainSpecs = [];
  $heroDomainSelectId = 'projectsHeroDomainSelect';
  $heroSpecSelectId = 'projectsHeroSpecializationSelect';
  $heroSpecWrapperId = 'projectsHeroSpecializationWrapper';
  $heroDomainSpecsMapId = 'projectsDomainSpecsMap';
  if ($hasHeroDomainSpec) {
    $heroDomainSelectId = match($universe) {
      'projects' => 'projectsHeroDomainSelect',
      'lessons' => 'lessonsHeroDomainSelect',
      'at-home' => 'atHomeHeroDomainSelect',
      'wellnesslive' => 'wellnessliveHeroDomainSelect',
      'corporate' => 'corporateHeroDomainSelect',
      'hub' => 'hubHeroUniversSelect',
      default => 'projectsHeroDomainSelect',
    };
    $heroSpecSelectId = match($universe) {
      'projects' => 'projectsHeroSpecializationSelect',
      'lessons' => 'lessonsHeroSpecializationSelect',
      'at-home' => 'atHomeHeroSpecializationSelect',
      'wellnesslive' => 'wellnessliveHeroSpecializationSelect',
      'corporate' => 'corporateHeroSpecializationSelect',
      'hub' => 'hubHeroSpecializationSelect',
      default => 'projectsHeroSpecializationSelect',
    };
    $heroSpecWrapperId = match($universe) {
      'projects' => 'projectsHeroSpecializationWrapper',
      'lessons' => 'lessonsHeroSpecializationWrapper',
      'at-home' => 'atHomeHeroSpecializationWrapper',
      'wellnesslive' => 'wellnessliveHeroSpecializationWrapper',
      'corporate' => 'corporateHeroSpecializationWrapper',
      'hub' => 'hubHeroSpecializationWrapper',
      default => 'projectsHeroSpecializationWrapper',
    };
    $heroDomainSpecsMapId = match($universe) {
      'projects' => 'projectsDomainSpecsMap',
      'lessons' => 'lessonsDomainSpecsMap',
      'at-home' => 'atHomeDomainSpecsMap',
      'wellnesslive' => 'wellnessliveDomainSpecsMap',
      'corporate' => 'corporateDomainSpecsMap',
      'hub' => 'hubUniverseDomainsMap',
      default => 'projectsDomainSpecsMap',
    };
    if ($isHub) {
      $heroCategories = $hubUniverses ?? [];
      $heroDomainSpecs = $hubUniverseDomains ?? [];
    } elseif (in_array($universe, ['projects', 'corporate'])) {
      $heroCategories = $categories ?? [];
      $heroDomainSpecs = $domainSpecializations ?? [];
    } else {
      $cats = $categories ?? [];
      $categoryDescriptions = $categoryDescriptions ?? [];
      foreach ($cats as $dom => $subs) {
        $slug = \Illuminate\Support\Str::slug($dom);
        $item = ['slug' => $slug, 'label' => $dom];
        if (in_array($universe, ['lessons', 'at-home', 'wellnesslive']) && !empty($categoryDescriptions) && isset($categoryDescriptions[$slug])) {
          $item['description'] = $categoryDescriptions[$slug];
        }
        $heroCategories[] = $item;
        $heroDomainSpecs[$slug] = collect((array) $subs)->map(fn($s) => [\Illuminate\Support\Str::slug($s), $s])->values()->all();
      }
    }
  }
@endphp
<form action="{{ $formAction }}" method="GET" id="{{ $formId }}" class="search-filter-form" data-lock-route="{{ $universe ? '1' : '0' }}" data-universe="{{ $universe ?? '' }}" @if($hasLocationDuo) data-initial-city="{{ request('city') }}" data-has-location-duo="1" @endif>
      <!-- Ligne 1: Domaine + Spécialisation (projects, lessons, at-home, wellnesslive, corporate) ou Recherche + Localisation -->
      <div class="filter-row-main @if($hasHeroDomainSpec) filter-row-main--projects-hero @elseif($hasLocationDuo) filter-row-main--has-location-duo @endif">
        @if($hasHeroDomainSpec)
        {{-- Domaine/Univers + Spécialisation (même modèle que projects) : select natif, cascade — hub, lessons, at-home, wellnesslive, corporate --}}
        <div data-hero-filter="{{ $universe }}" class="hero-filter-module" @if($isHub) style="overflow:visible;position:relative;z-index:50;" @endif>
        <div class="filter-input-group filter-hero-domain-spec filter-hero-domain-select-wrapper">
          <i class="fas fa-folder-open filter-input-icon" style="left: 1rem;" aria-hidden="true"></i>
          @if($isHub)
          <select name="universe" id="{{ $heroDomainSelectId }}" class="filter-input filter-select filter-select-domain-hero" aria-label="{{ __('Tous les univers') }}">
            <option value="">{{ __('Tous les univers') }}</option>
            @foreach($heroCategories as $cat)
              <option value="{{ $cat['slug'] ?? '' }}" {{ request('universe') === ($cat['slug'] ?? '') ? 'selected' : '' }}>{{ $cat['label'] ?? '' }}</option>
            @endforeach
          </select>
          @elseif(in_array($universe, ['projects', 'corporate', 'lessons', 'at-home', 'wellnesslive']) && !empty($heroCategories) && isset($heroCategories[0]['description']))
          {{-- Dropdown custom Hero : Titre + micro-description (même source $heroCategories) — champ caché pour form --}}
          <input type="hidden" name="category" id="{{ $heroDomainSelectId }}" value="{{ request('category') }}">
          <div class="hero-domain-custom-wrapper" style="position:relative;width:100%;">
            <div class="hero-domain-trigger filter-input filter-select filter-select-domain-hero" id="heroDomainTrigger-{{ $universe }}" role="button" tabindex="0" aria-haspopup="listbox" aria-expanded="false" aria-label="{{ __('Tous les domaines') }}" style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;padding-left:3rem;">
              <span class="hero-domain-trigger-text">{{ __('Tous les domaines') }}</span>
              <i class="fas fa-chevron-down hero-domain-arrow" style="font-size:0.75rem;color:var(--preply-text-light, #6b7280);transition:transform 0.2s;"></i>
            </div>
            <div class="hero-domain-menu" id="heroDomainMenu-{{ $universe }}" role="listbox" style="display:none;position:absolute;top:100%;left:0;right:0;margin-top:4px;background:#fff;border:1px solid var(--preply-border, #e5e7eb);border-radius:12px;box-shadow:0 10px 40px rgba(0,0,0,0.12);max-height:320px;overflow-y:auto;z-index:100;">
              <div class="hero-domain-option" data-value="" role="option">{{ __('Tous les domaines') }}</div>
              @foreach($heroCategories as $cat)
              <div class="hero-domain-option" data-value="{{ $cat['slug'] ?? '' }}" role="option">
                <span class="domain-option-label">{{ $cat['label'] ?? '' }}</span>
                @if(!empty($cat['description'] ?? ''))
                <span class="domain-option-desc">{{ $cat['description'] }}</span>
                @endif
              </div>
              @endforeach
            </div>
          </div>
          @else
          <select name="category" id="{{ $heroDomainSelectId }}" class="filter-input filter-select filter-select-domain-hero" aria-label="{{ __('Tous les domaines') }}">
            <option value="">{{ __('Tous les domaines') }}</option>
            @foreach($heroCategories as $cat)
              <option value="{{ $cat['slug'] ?? '' }}" {{ request('category') === ($cat['slug'] ?? '') ? 'selected' : '' }}>{{ $cat['label'] ?? '' }}</option>
            @endforeach
          </select>
          @endif
        </div>
        <div class="filter-input-group filter-hero-domain-spec" id="{{ $heroSpecWrapperId }}" data-initial-specialization="{{ request('specialization') ?? '' }}" data-spec-disabled-text="{{ $isHub ? __('Tous les domaines') : 'Spécialisation' }}" @if($isHub) style="overflow:visible;position:relative;z-index:50;" @endif>
          <i class="fas fa-folder-open filter-input-icon" style="left: 1rem;" aria-hidden="true"></i>
          <select name="specialization" id="{{ $heroSpecSelectId }}" class="filter-input filter-select" disabled aria-label="{{ $isHub ? __('Tous les domaines') : 'Spécialisation' }}">
            <option value="">{{ $isHub ? __('Tous les domaines') : 'Spécialisation' }}</option>
          </select>
        </div>
        </div>
        <script type="application/json" id="{{ $heroDomainSpecsMapId }}">@json($heroDomainSpecs)</script>
        @if($isHub)
        {{-- Hub /services : script dédié Univers → Spécialisation (réinstall propre) — Spécialisation doit s'ouvrir au clic --}}
        <script>
        (function() {
          var HUB_MAP_ID = 'hubUniverseDomainsMap';
          var HUB_UNIVERS_ID = 'hubHeroUniversSelect';
          var HUB_SPEC_ID = 'hubHeroSpecializationSelect';
          var HUB_SPEC_WRAPPER_ID = 'hubHeroSpecializationWrapper';
          var DISABLED_TEXT = 'Tous les domaines';
          function runHubDomainSpec() {
            var mapEl = document.getElementById(HUB_MAP_ID);
            var universSelect = document.getElementById(HUB_UNIVERS_ID);
            var specSelect = document.getElementById(HUB_SPEC_ID);
            var specWrapper = document.getElementById(HUB_SPEC_WRAPPER_ID);
            if (!mapEl || !universSelect || !specSelect) return false;
            var spMap = {};
            try { spMap = JSON.parse(mapEl.textContent || '{}'); } catch (e) {}
            var specDisabledText = (specWrapper && specWrapper.getAttribute('data-spec-disabled-text')) || DISABLED_TEXT;
            function updateSpec() {
              var chosen = universSelect.value || '';
              specSelect.innerHTML = '<option value="">' + (specDisabledText || 'Tous les domaines') + '</option>';
              if (chosen) {
                specSelect.removeAttribute('disabled');
                specSelect.style.pointerEvents = 'auto';
                specSelect.style.cursor = 'pointer';
                var opts = spMap[chosen];
                if (opts && Array.isArray(opts)) {
                  for (var i = 0; i < opts.length; i++) {
                    var opt = document.createElement('option');
                    opt.value = opts[i][0];
                    opt.textContent = opts[i][1];
                    specSelect.appendChild(opt);
                  }
                  var init = specWrapper ? specWrapper.getAttribute('data-initial-specialization') : '';
                  if (init && opts.some(function(x) { return x[0] === init; })) specSelect.value = init;
                }
              } else {
                specSelect.setAttribute('disabled', 'disabled');
              }
            }
            if (universSelect._hubSpecBound) {
              updateSpec();
              return true;
            }
            universSelect._hubSpecBound = true;
            universSelect.addEventListener('change', updateSpec);
            updateSpec();
            return true;
          }
          function schedule() {
            if (runHubDomainSpec()) return;
            setTimeout(schedule, 50);
          }
          if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
              schedule();
              setTimeout(runHubDomainSpec, 150);
            });
          } else {
            schedule();
            setTimeout(runHubDomainSpec, 150);
          }
        })();
        </script>
        @else
        <script>
        (function() {
          var mapId = '{{ $heroDomainSpecsMapId }}';
          var domainSelectId = '{{ $heroDomainSelectId }}';
          var specSelectId = '{{ $heroSpecSelectId }}';
          var specWrapperId = '{{ $heroSpecWrapperId }}';
          var universe = '{{ $universe }}';
          var mapEl = document.getElementById(mapId);
          var spMap = (mapEl && mapEl.textContent) ? JSON.parse(mapEl.textContent) : {};
          var domainSelect = document.getElementById(domainSelectId);
          var specSelect = document.getElementById(specSelectId);
          var specWrapper = document.getElementById(specWrapperId);
          var specDisabledText = (specWrapper && specWrapper.getAttribute('data-spec-disabled-text')) ? specWrapper.getAttribute('data-spec-disabled-text') : 'Spécialisation';
          function updateSpec() {
            if (!specSelect) return;
            var domain = domainSelect ? domainSelect.value : '';
            specSelect.innerHTML = '<option value="">' + (specDisabledText || 'Spécialisation') + '</option>';
            if (domain) {
              specSelect.removeAttribute('disabled');
            } else {
              specSelect.setAttribute('disabled', 'disabled');
            }
            if (domain && spMap[domain] && Array.isArray(spMap[domain])) {
              for (var i = 0; i < spMap[domain].length; i++) {
                var o = document.createElement('option');
                o.value = spMap[domain][i][0];
                o.textContent = spMap[domain][i][1];
                specSelect.appendChild(o);
              }
              var init = specWrapper ? specWrapper.getAttribute('data-initial-specialization') : '';
              if (init && spMap[domain].some(function(x) { return x[0] === init; })) specSelect.value = init;
            }
          }
          function bindDomainSpec() {
            domainSelect = document.getElementById(domainSelectId);
            specSelect = document.getElementById(specSelectId);
            specWrapper = document.getElementById(specWrapperId);
            if (!domainSelect || !specSelect || domainSelect._domainSpecBound) return;
            domainSelect._domainSpecBound = true;
            domainSelect.addEventListener('change', updateSpec);
            updateSpec();
          }
          bindDomainSpec();
          if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', bindDomainSpec);
          setTimeout(bindDomainSpec, 0);
          if (universe === 'projects' || universe === 'corporate' || universe === 'lessons' || universe === 'at-home' || universe === 'wellnesslive') {
            var heroTrigger = document.getElementById('heroDomainTrigger-' + universe);
            var heroMenu = document.getElementById('heroDomainMenu-' + universe);
            if (heroTrigger && heroMenu) {
              var heroOptions = heroMenu.querySelectorAll('.hero-domain-option');
              var triggerTextEl = heroTrigger.querySelector('.hero-domain-trigger-text');
              var hiddenInput = document.getElementById(domainSelectId);
              var allDomainsLabel = 'Tous les domaines';
              function setTriggerText(label) { if (triggerTextEl) triggerTextEl.textContent = label || allDomainsLabel; }
              function closeMenu() { heroMenu.style.display = 'none'; heroTrigger.setAttribute('aria-expanded', 'false'); heroTrigger.classList.remove('active'); var arrow = heroTrigger.querySelector('.hero-domain-arrow'); if (arrow) arrow.style.transform = 'rotate(0deg)'; }
              function openMenu() { heroMenu.style.display = 'block'; heroTrigger.setAttribute('aria-expanded', 'true'); heroTrigger.classList.add('active'); var arrow = heroTrigger.querySelector('.hero-domain-arrow'); if (arrow) arrow.style.transform = 'rotate(180deg)'; }
              heroOptions.forEach(function(opt) {
                opt.addEventListener('click', function(e) {
                  e.stopPropagation();
                  var val = this.getAttribute('data-value') || '';
                  var labelEl = this.querySelector('.domain-option-label');
                  var label = labelEl ? labelEl.textContent.trim() : (this.textContent.trim());
                  if (!val) label = allDomainsLabel;
                  if (hiddenInput) { hiddenInput.value = val; hiddenInput.dispatchEvent(new Event('change', { bubbles: true })); }
                  setTriggerText(label);
                  heroOptions.forEach(function(o) { o.classList.remove('selected'); });
                  this.classList.add('selected');
                  closeMenu();
                });
              });
              heroTrigger.addEventListener('click', function(e) { e.stopPropagation(); if (heroMenu.style.display === 'block') closeMenu(); else openMenu(); });
              document.addEventListener('click', function(e) { if (!heroTrigger.contains(e.target) && !heroMenu.contains(e.target)) closeMenu(); });
              var cur = hiddenInput ? hiddenInput.value : '';
              heroOptions.forEach(function(o) {
                o.classList.remove('selected');
                if ((o.getAttribute('data-value') || '') === cur) {
                  o.classList.add('selected');
                  var labelEl = o.querySelector('.domain-option-label');
                  if (labelEl && triggerTextEl) triggerTextEl.textContent = labelEl.textContent.trim();
                }
              });
              if (!cur && triggerTextEl) triggerTextEl.textContent = allDomainsLabel;
            }
          }
          if (universe === 'projects') {
            function initProjectsCountryCity() {
              var countrySelect = document.getElementById('projectsFilterCountry');
              var citySelect = document.getElementById('projectsFilterCity');
              var cityWrapper = document.getElementById('projectsCityWrapper');
              if (!countrySelect || !citySelect) return;
              var citiesByCountry = {'FR':['Paris','Lyon','Marseille','Bordeaux','Nantes','Lille','Strasbourg','Rennes','Montpellier','Toulouse','Nice'],'BE':['Bruxelles','Anvers','Liège'],'CH':['Zurich','Genève','Bâle'],'ES':['Barcelone','Palma de Majorque','Valence','Séville','Madrid','Ibiza','Tenerife'],'DE':['Berlin','Munich','Hambourg'],'IT':['Rome','Milan','Turin','Palerme','Toscane','Florence','Naples'],'PT':['Lisbonne','Porto','Faro','Coimbra'],'NL':['Amsterdam','Rotterdam','La Haye'],'GB':['Londres','Manchester','Birmingham','Brighton','Édimbourg'],'CA':['Montréal','Toronto','Vancouver'],'US':['New York','Los Angeles','Chicago','San Francisco','Miami'],'MT':['Valetta','Sliema','Saint Julien','Msida','Gzira','Ta\'Xbiex','Pieta'],'MC':['Monte-Carlo','La Condamine','Fontvieille'],'LU':['Luxembourg-Ville','Kirchberg','Esch-sur-Alzette'],'MA':['Casablanca','Rabat','Tanger'],'TN':['Tunis','Sfax','Sousse'],'SN':['Dakar','Diamniadio','Thiès'],'CI':['Abidjan','Yamoussoukro','San Pedro'],'IE':['Dublin'],'HR':['Split','Dubrovnik'],'GP':['Pointe-à-Pitre','Basse-Terre','Saint-François'],'MQ':['Fort-de-France','Le Lamentin','Sainte-Anne'],'GF':['Cayenne','Kourou','Saint-Laurent-du-Maroni'],'RE':['Saint-Denis','Saint-Pierre','Saint-Gilles-les-Bains'],'NC':['Nouméa','Dumbéa','Mont-Dore'],'PF':['Papeete','Faa\'a','Moorea']};
              function updateCities() {
                var country = countrySelect.value;
                citySelect.innerHTML = '<option value="">Sélectionner une ville</option>';
                citySelect.disabled = !country;
                if (country && citiesByCountry[country]) {
                  var cities = citiesByCountry[country];
                  for (var i = 0; i < cities.length; i++) {
                    var opt = document.createElement('option');
                    opt.value = cities[i];
                    opt.textContent = cities[i];
                    citySelect.appendChild(opt);
                  }
                  if (cityWrapper) cityWrapper.classList.add('show');
                  var form = document.getElementById('{{ $formId }}');
                  var sel = (form && form.getAttribute('data-initial-city')) || '';
                  if (sel && cities.indexOf(sel) !== -1) citySelect.value = sel;
                } else {
                  if (cityWrapper) cityWrapper.classList.remove('show');
                }
              }
              countrySelect.addEventListener('change', updateCities);
              updateCities();
            }
            setTimeout(initProjectsCountryCity, 0);
            if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initProjectsCountryCity);
          }
        })();
        </script>
        @endif
        @else
        <div class="filter-input-group">
          <i class="fas fa-search filter-input-icon"></i>
          <input 
            type="text" 
            name="search" 
            id="searchKeyword"
            value="{{ request('search') }}"
            placeholder="{{ $keywordPlaceholder }}"
            class="filter-input"
            autocomplete="off"
          >
        </div>
        @endif
        @if($hasLocationDuo)
        {{-- Mode d'intervention (pour hub/home, hub/services, projects, lessons, corporate, at-home et wellnesslive) : segmented control premium avant Pays/Ville --}}
        @if($isHub || $isProjects || $isLessons || $isCorporate || $isAtHome || $isWellnesslive)
        <div class="filter-input-group filter-mode-intervention-hero" data-hero-filter="{{ $heroFilterScope }}">
          <label class="filter-label-visually-hidden">{{ __('Mode d\'intervention') }}</label>
          <div class="mode-intervention-segmented" role="group" aria-label="{{ __('Mode d\'intervention') }}">
            @php
              $currentMode = request('mode', []);
              $isOnline = is_array($currentMode) && in_array('online', $currentMode);
              $isOnsite = (is_array($currentMode) && in_array('onsite', $currentMode)) || empty($currentMode);
              // Par défaut, si aucun mode n'est sélectionné, on considère "En présentiel"
              $hasNoMode = !$isOnline && !$isOnsite;
            @endphp
            <label class="mode-intervention-pill {{ $isOnline ? 'is-active' : '' }}" data-mode="online">
              <input type="radio" name="mode[]" value="online" {{ $isOnline ? 'checked' : '' }} class="sr-only mode-intervention-radio">
              <span class="mode-intervention-pill-text">{{ __('En ligne') }}</span>
            </label>
            <label class="mode-intervention-pill {{ ($isOnsite || $hasNoMode) ? 'is-active' : '' }}" data-mode="onsite">
              <input type="radio" name="mode[]" value="onsite" {{ ($isOnsite || $hasNoMode) ? 'checked' : '' }} class="sr-only mode-intervention-radio">
              <span class="mode-intervention-pill-text">{{ __('En présentiel') }}</span>
            </label>
          </div>
        </div>
        @endif
        {{-- Lessons / Projects / Corporate : duo Pays + Ville (identique HomeSwap), pas de champ Lieu — Hub : Ville sous Pays, colonne unique élargie --}}
        @if($isHub)<div class="hub-location-stack">@endif
        <div class="filter-input-group filter-location-hero" id="homeLocationCountryGroup" data-hero-filter="{{ $isProjects ? 'projects' : ($isLessons ? 'lessons' : ($isCorporate ? 'corporate' : ($isAtHome ? 'at-home' : ($isWellnesslive ? 'wellnesslive' : ($heroFilterScope ?? 'hub'))))) }}">
          <i class="fas fa-map-marker-alt filter-input-icon"></i>
          <select name="country" id="{{ $locationCountryId }}" class="filter-input filter-select home-location-country" data-location-country="true">
            <option value="">{{ $isHub ? __('Pays') : __('Sélectionner un pays') }}</option>
            <option value="FR" {{ request('country') == 'FR' ? 'selected' : '' }}>{{ __('France') }}</option>
            <option value="GP" {{ request('country') == 'GP' ? 'selected' : '' }}>{{ __('Guadeloupe') }}</option>
            <option value="MQ" {{ request('country') == 'MQ' ? 'selected' : '' }}>{{ __('Martinique') }}</option>
            <option value="GF" {{ request('country') == 'GF' ? 'selected' : '' }}>{{ __('Guyane') }}</option>
            <option value="RE" {{ request('country') == 'RE' ? 'selected' : '' }}>{{ __('La Réunion') }}</option>
            <option value="NC" {{ request('country') == 'NC' ? 'selected' : '' }}>{{ __('Nouvelle-Calédonie') }}</option>
            <option value="PF" {{ request('country') == 'PF' ? 'selected' : '' }}>{{ __('Polynésie française') }}</option>
            <option value="BE" {{ request('country') == 'BE' ? 'selected' : '' }}>{{ __('Belgique') }}</option>
            <option value="CH" {{ request('country') == 'CH' ? 'selected' : '' }}>{{ __('Suisse') }}</option>
            <option value="ES" {{ request('country') == 'ES' ? 'selected' : '' }}>{{ __('Espagne') }}</option>
            <option value="DE" {{ request('country') == 'DE' ? 'selected' : '' }}>{{ __('Allemagne') }}</option>
            <option value="IT" {{ request('country') == 'IT' ? 'selected' : '' }}>{{ __('Italie') }}</option>
            <option value="PT" {{ request('country') == 'PT' ? 'selected' : '' }}>{{ __('Portugal') }}</option>
            <option value="NL" {{ request('country') == 'NL' ? 'selected' : '' }}>{{ __('Pays-Bas') }}</option>
            <option value="GB" {{ request('country') == 'GB' ? 'selected' : '' }}>{{ __('Royaume-Uni') }}</option>
            <option value="CA" {{ request('country') == 'CA' ? 'selected' : '' }}>{{ __('Canada') }}</option>
            <option value="US" {{ request('country') == 'US' ? 'selected' : '' }}>{{ __('États-Unis') }}</option>
            <option value="MT" {{ request('country') == 'MT' ? 'selected' : '' }}>{{ __('Malte') }}</option>
            <option value="MC" {{ request('country') == 'MC' ? 'selected' : '' }}>{{ __('Monaco') }}</option>
            <option value="LU" {{ request('country') == 'LU' ? 'selected' : '' }}>{{ __('Luxembourg') }}</option>
            <option value="MA" {{ request('country') == 'MA' ? 'selected' : '' }}>{{ __('Maroc') }}</option>
            <option value="TN" {{ request('country') == 'TN' ? 'selected' : '' }}>{{ __('Tunisie') }}</option>
            <option value="SN" {{ request('country') == 'SN' ? 'selected' : '' }}>{{ __('Sénégal') }}</option>
            <option value="CI" {{ request('country') == 'CI' ? 'selected' : '' }}>{{ __('Côte d\'Ivoire') }}</option>
            <option value="IE" {{ request('country') == 'IE' ? 'selected' : '' }}>{{ __('Irlande') }}</option>
            <option value="HR" {{ request('country') == 'HR' ? 'selected' : '' }}>{{ __('Croatie') }}</option>
          </select>
        </div>
        <div class="filter-input-group filter-location-hero" id="{{ $locationCityWrapperId }}" data-filter="city-wrapper" data-filter-label="Filtre Ville (Pays → Ville)" data-hero-filter="{{ $isProjects ? 'projects' : ($isLessons ? 'lessons' : ($isCorporate ? 'corporate' : ($isAtHome ? 'at-home' : ($isWellnesslive ? 'wellnesslive' : ($heroFilterScope ?? 'hub'))))) }}">
          <i class="fas fa-map-marker-alt filter-input-icon"></i>
          <select name="city" id="{{ $locationCityId }}" class="filter-input filter-select home-location-city" disabled data-filter="city-select" data-location-city="true" aria-label="{{ $isHub ? __('Ville') : __('Sélectionner une ville') }}">
            <option value="">{{ $isHub ? __('Ville') : __('Sélectionner une ville') }}</option>
          </select>
        </div>
        @if($isHub)</div>@endif
        @if($isHub || $isProjects || $isLessons || $isAtHome || $isWellnesslive)
        {{-- Helper text pour mode "En ligne" (affiché sous Pays/Ville) --}}
        <div class="location-helper-text-wrapper" style="width: 100%; grid-column: 1 / -1;">
          <div class="location-helper-text" id="{{ $isProjects ? 'projectsLocationHelper' : ($isLessons ? 'lessonsLocationHelper' : ($isCorporate ? 'corporateLocationHelper' : ($isAtHome ? 'atHomeLocationHelper' : ($isWellnesslive ? 'wellnessliveLocationHelper' : 'hubLocationHelper')))) }}" style="display: none; margin-top: 0.5rem; font-size: 0.875rem; color: #6b7280;">
            <i class="fas fa-info-circle me-1" style="font-size: 0.75rem;"></i>
            {{ $isHomePage ? __('Le lieu n\'est pas requis') : __('En ligne : le lieu n\'est pas requis.') }}
          </div>
        </div>
        @endif
        @if($isHub || $isProjects || $isLessons || $isCorporate || $isAtHome || $isWellnesslive)
        {{-- Script Mode d'intervention → Pays/Ville (pour hub/home, hub/services, projects, lessons, corporate, at-home et wellnesslive) --}}
        <script>
        (function() {
          // Scoper au module Hero selon l'univers (wrapper Mode d'intervention)
          var heroFilterScope = '{{ $heroFilterScope }}';
          var form = document.getElementById('{{ $formId }}');
          if (!form) return;
          
          // Chercher le module mode-intervention dans le form (plus robuste)
          var heroModule = form.querySelector('.filter-mode-intervention-hero[data-hero-filter="' + heroFilterScope + '"]') || form.querySelector('.filter-mode-intervention-hero');
          if (!heroModule) return;
          
          var modeRadios = heroModule.querySelectorAll('.mode-intervention-radio');
          // Sélecteurs pour Pays/Ville selon l'univers (utiliser les IDs spécifiques)
          var countrySelect = document.getElementById('{{ $locationCountryId }}') || form.querySelector('[data-location-country="true"]');
          var citySelect = document.getElementById('{{ $locationCityId }}') || form.querySelector('[data-location-city="true"]');
          var cityWrapper = citySelect ? citySelect.closest('.filter-input-group') : null;
          var countryWrapper = countrySelect ? countrySelect.closest('.filter-input-group') : null;
          var helperTextId = '{{ $isProjects ? 'projectsLocationHelper' : ($isLessons ? 'lessonsLocationHelper' : ($isCorporate ? 'corporateLocationHelper' : ($isAtHome ? 'atHomeLocationHelper' : ($isWellnesslive ? 'wellnessliveLocationHelper' : 'hubLocationHelper')))) }}';
          var helperText = document.querySelector('#' + helperTextId) || form.querySelector('#' + helperTextId);
          
          function updateLocationFields() {
            if (!modeRadios.length || !countrySelect || !citySelect) return;
            
            var selectedMode = null;
            modeRadios.forEach(function(radio) {
              if (radio.checked) selectedMode = radio.value;
            });
            
            var isOnline = selectedMode === 'online';
            
            // Mettre à jour les pills visuellement
            var pills = heroModule.querySelectorAll('.mode-intervention-pill');
            pills.forEach(function(pill) {
              var pillMode = pill.getAttribute('data-mode');
              if (pillMode === selectedMode) {
                pill.classList.add('is-active');
              } else {
                pill.classList.remove('is-active');
              }
            });
            
            if (isOnline) {
              // Mode "En ligne" : désactiver Pays/Ville, vider leurs valeurs
              countrySelect.disabled = true;
              countrySelect.value = '';
              citySelect.disabled = true;
              citySelect.value = '';
              
              // Ajouter attribut pour ne pas soumettre dans le form
              countrySelect.setAttribute('data-skip-submit', 'true');
              citySelect.setAttribute('data-skip-submit', 'true');
              
              // Afficher helper text
              if (helperText) helperText.style.display = 'flex';
              
              // Style visuel désactivé
              if (cityWrapper) {
                cityWrapper.style.opacity = '0.5';
                cityWrapper.style.pointerEvents = 'none';
              }
              if (countryWrapper) {
                countryWrapper.style.opacity = '0.5';
                countryWrapper.style.pointerEvents = 'none';
              }
            } else {
              // Mode "En présentiel" : réactiver Pays/Ville
              countrySelect.disabled = false;
              citySelect.disabled = false;
              
              // Retirer attribut skip-submit
              countrySelect.removeAttribute('data-skip-submit');
              citySelect.removeAttribute('data-skip-submit');
              
              // Masquer helper text
              if (helperText) helperText.style.display = 'none';
              
              // Style visuel activé
              if (cityWrapper) {
                cityWrapper.style.opacity = '';
                cityWrapper.style.pointerEvents = '';
              }
              if (countryWrapper) {
                countryWrapper.style.opacity = '';
                countryWrapper.style.pointerEvents = '';
              }
            }
          }
          
          // Écouter les changements sur les radios
          modeRadios.forEach(function(radio) {
            radio.addEventListener('change', function() {
              updateLocationFields();
            });
          });
          
          // Intercepter la soumission du formulaire pour exclure Pays/Ville si mode "En ligne"
          if (form) {
            form.addEventListener('submit', function(e) {
              var selectedMode = null;
              modeRadios.forEach(function(radio) {
                if (radio.checked) selectedMode = radio.value;
              });
              
              if (selectedMode === 'online') {
                // Vider et désactiver les champs Pays/Ville pour qu'ils ne soient pas soumis
                if (countrySelect) {
                  countrySelect.value = '';
                  countrySelect.disabled = true;
                  countrySelect.removeAttribute('name');
                }
                if (citySelect) {
                  citySelect.value = '';
                  citySelect.disabled = true;
                  citySelect.removeAttribute('name');
                }
                
                // Réactiver après un court délai pour permettre la soumission
                setTimeout(function() {
                  if (countrySelect) {
                    countrySelect.disabled = false;
                    countrySelect.setAttribute('name', 'country');
                  }
                  if (citySelect) {
                    citySelect.disabled = false;
                    citySelect.setAttribute('name', 'city');
                  }
                }, 100);
              }
            }, false);
          }
          
          // Initialiser au chargement
          function initModeIntervention() {
            // Vérifier le paramètre URL mode=online
            var urlParams = new URLSearchParams(window.location.search);
            var urlMode = urlParams.get('mode');
            
            if (urlMode === 'online') {
              // Si mode=online dans l'URL, sélectionner "En ligne"
              var onlineRadio = Array.prototype.find.call(modeRadios, function(r) { return r.value === 'online'; });
              if (onlineRadio) {
                onlineRadio.checked = true;
                var onlinePill = heroModule.querySelector('.mode-intervention-pill[data-mode="online"]');
                if (onlinePill) onlinePill.classList.add('is-active');
                var onsitePill = heroModule.querySelector('.mode-intervention-pill[data-mode="onsite"]');
                if (onsitePill) onsitePill.classList.remove('is-active');
              }
            } else {
              // S'assurer qu'au moins un mode est sélectionné (par défaut "En présentiel")
              var hasChecked = false;
              modeRadios.forEach(function(radio) {
                if (radio.checked) hasChecked = true;
              });
              if (!hasChecked && modeRadios.length > 0) {
                // Sélectionner "En présentiel" par défaut
                var onsiteRadio = Array.prototype.find.call(modeRadios, function(r) { return r.value === 'onsite'; });
                if (onsiteRadio) {
                  onsiteRadio.checked = true;
                  var onsitePill = heroModule.querySelector('.mode-intervention-pill[data-mode="onsite"]');
                  if (onsitePill) onsitePill.classList.add('is-active');
                }
              }
            }
            updateLocationFields();
          }
          
          initModeIntervention();
          
          // Réinitialiser après un délai pour s'assurer que le DOM est prêt
          setTimeout(initModeIntervention, 100);
          setTimeout(initModeIntervention, 300);
        })();
        </script>
        @endif
        @if(in_array($universe, ['at-home', 'wellnesslive', 'hub']))
        <script>
        (function() {
          var countryId = '{{ $locationCountryId }}';
          var cityId = '{{ $locationCityId }}';
          var cityWrapperId = '{{ $locationCityWrapperId }}';
          var isHub = {{ $isHub ? 'true' : 'false' }};
          var citiesByCountry = {
            'FR': ['Paris', 'Lyon', 'Marseille', 'Bordeaux', 'Nantes', 'Lille', 'Strasbourg', 'Rennes', 'Montpellier', 'Toulouse', 'Nice'],
            'GP': ['Pointe-à-Pitre', 'Les Abymes', 'Baie-Mahault', 'Le Gosier', 'Sainte-Anne'],
            'MQ': ['Fort-de-France', 'Le Lamentin', 'Sainte-Marie', 'Schoelcher', 'Ducos'],
            'GF': ['Cayenne', 'Kourou', 'Saint-Laurent-du-Maroni', 'Matoury', 'Remire-Montjoly'],
            'RE': ['Saint-Denis', 'Saint-Paul', 'Saint-Pierre', 'Le Tampon', 'Saint-André', 'Saint-Louis', 'Le Port'],
            'NC': ['Nouméa', 'Mont-Dore', 'Dumbéa', 'Païta', 'Le Mont-Dore'],
            'PF': ['Papeete', 'Pirae', 'Mahina', 'Punaauia', 'Arue'],
            'BE': ['Bruxelles', 'Anvers', 'Liège'],
            'CH': ['Zurich', 'Genève', 'Bâle'],
            'ES': ['Madrid', 'Barcelone', 'Valence', 'Séville', 'Ibiza'],
            'DE': ['Berlin', 'Munich', 'Hambourg'],
            'IT': ['Rome', 'Milan', 'Turin', 'Palerme', 'Toscane', 'Florence', 'Naples'],
            'PT': ['Lisbonne', 'Porto', 'Coimbra', 'Faro'],
            'NL': ['Amsterdam', 'Rotterdam', 'La Haye'],
            'GB': ['Londres', 'Manchester', 'Birmingham', 'Brighton', 'Édimbourg'],
            'CA': ['Toronto', 'Montréal', 'Vancouver'],
            'US': ['New York', 'Los Angeles', 'Chicago', 'San Francisco', 'Miami'],
            'MT': ['Valetta', 'Sliema', 'Saint Julien', 'Msida', 'Gzira', 'Ta\'Xbiex', 'Pieta'],
            'MC': ['Monte-Carlo', 'La Condamine', 'Fontvieille'],
            'LU': ['Luxembourg-Ville', 'Esch-sur-Alzette', 'Differdange'],
            'MA': ['Casablanca', 'Rabat', 'Tanger', 'Marrakech', 'Fès'],
            'TN': ['Tunis', 'Sfax', 'Sousse', 'Nabeul', 'Bizerte'],
            'SN': ['Dakar', 'Thiès', 'Saint-Louis', 'Rufisque', 'Mbour'],
            'CI': ['Abidjan', 'Yamoussoukro', 'Bouaké', 'San-Pédro'],
            'IE': ['Dublin', 'Cork', 'Galway', 'Limerick', 'Waterford'],
            'HR': ['Zagreb', 'Split', 'Dubrovnik', 'Rijeka', 'Zadar']
          };
          var cityBadges = {
            'Paris': ['Business', 'Langue'], 'Lyon': ['Business', 'Famille'], 'Marseille': ['Famille', 'Langue'], 'Bordeaux': ['Workation', 'Repos'],
            'Nantes': ['Business', 'Famille'], 'Lille': ['Business', 'Famille'], 'Strasbourg': ['Business', 'Langue'], 'Rennes': ['Business', 'Famille'],
            'Montpellier': ['Workation', 'Famille'], 'Toulouse': ['Business', 'Famille'], 'Nice': ['Repos', 'Famille'],
            'Barcelone': ['Workation', 'Famille'], 'Madrid': ['Business', 'Langue'], 'Valence': ['Famille', 'Repos'],
            'Séville': ['Famille', 'Culture'], 'Ibiza': ['Repos'],
            'Lisbonne': ['Workation', 'Business'], 'Porto': ['Repos', 'Langue'], 'Faro': ['Repos', 'Famille'], 'Coimbra': ['Langue', 'Culture'],
            'Londres': ['Business', 'Langue'], 'Brighton': ['Langue', 'Famille'], 'Manchester': ['Business', 'Langue'], 'Birmingham': ['Business', 'Famille'], 'Édimbourg': ['Culture', 'Langue'],
            'Dublin': ['Langue', 'Business'], 'Montréal': ['Langue', 'Famille'], 'Toronto': ['Business', 'Langue'], 'Vancouver': ['Workation', 'Repos'],
            'New York': ['Business'], 'San Francisco': ['Business', 'Workation'], 'Miami': ['Repos', 'Business'], 'Los Angeles': ['Business', 'Repos'], 'Chicago': ['Business', 'Famille'],
            'Rome': ['Famille', 'Culture'], 'Florence': ['Repos', 'Culture'], 'Milan': ['Business'], 'Turin': ['Business', 'Famille'], 'Palerme': ['Repos', 'Famille'], 'Toscane': ['Repos', 'Culture'], 'Naples': ['Famille', 'Culture'],
            'Amsterdam': ['Business', 'Langue'], 'Rotterdam': ['Business', 'Famille'], 'La Haye': ['Business', 'Famille'],
            'Berlin': ['Business', 'Langue'], 'Munich': ['Business', 'Famille'], 'Hambourg': ['Business', 'Langue'],
            'Zurich': ['Business', 'Langue'], 'Genève': ['Business', 'Langue'], 'Bâle': ['Business', 'Famille'],
            'Bruxelles': ['Business', 'Langue'], 'Anvers': ['Business', 'Famille'], 'Liège': ['Famille', 'Langue'],
            'Monte-Carlo': ['Repos', 'Business'], 'La Condamine': ['Repos', 'Famille'], 'Fontvieille': ['Repos', 'Famille'],
            'Luxembourg-Ville': ['Business', 'Langue'], 'Esch-sur-Alzette': ['Famille', 'Business'],
            'Casablanca': ['Business', 'Langue'], 'Rabat': ['Business', 'Famille'], 'Tanger': ['Repos', 'Langue'], 'Marrakech': ['Repos', 'Famille'], 'Fès': ['Culture', 'Langue'],
            'Tunis': ['Business', 'Langue'], 'Sfax': ['Business', 'Famille'], 'Sousse': ['Repos', 'Famille'], 'Nabeul': ['Repos', 'Famille'], 'Bizerte': ['Business', 'Famille'],
            'Dakar': ['Business', 'Langue'], 'Thiès': ['Famille', 'Repos'], 'Saint-Louis': ['Culture', 'Repos'], 'Rufisque': ['Business', 'Famille'], 'Mbour': ['Repos', 'Famille'],
            'Abidjan': ['Business', 'Langue'], 'Yamoussoukro': ['Famille', 'Repos'], 'Bouaké': ['Business', 'Famille'], 'San-Pédro': ['Repos', 'Famille'],
            'Split': ['Repos', 'Famille'], 'Dubrovnik': ['Repos', 'Culture'], 'Zagreb': ['Business', 'Langue'], 'Rijeka': ['Repos', 'Langue'], 'Zadar': ['Repos', 'Famille']
          };
          var highDemandCitiesLaunch = ['Paris', 'Lyon', 'Barcelone', 'Lisbonne', 'Montréal', 'Madrid', 'Nice', 'Bordeaux'];
          var allowedObjectives = ['Workation', 'Famille', 'Langue', 'Business', 'Repos', 'Culture'];
          function getDisplayBadges(badges) {
            if (!badges || !Array.isArray(badges)) return [];
            return badges.filter(function(b) { return allowedObjectives.indexOf(b) !== -1; }).slice(0, 2);
          }
          var objectiveIcons = {
            'Business': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.5 4.5V11.5H10.5V4.5M3.5 4.5H10.5M3.5 4.5V2.5C3.5 2.22386 3.72386 2 4 2H10C10.2761 2 10.5 2.22386 10.5 2.5V4.5M5.5 7H8.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            'Workation': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 3.5C2.5 3.22386 2.72386 3 3 3H11C11.2761 3 11.5 3.22386 11.5 3.5V10.5C11.5 10.7761 11.2761 11 11 11H3C2.72386 11 2.5 10.7761 2.5 10.5V3.5Z" stroke="currentColor" stroke-width="1.25"/><path d="M5.5 7L6.5 8L8.5 6" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            'Famille': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 2.5L3.5 5.5V11.5H5.5V7.5H8.5V11.5H10.5V5.5L7 2.5Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            'Langue': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="1.25"/><path d="M2 7H12M7 2C7.5 3.5 7.5 4.5 7 7C6.5 9.5 6.5 10.5 7 12" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>',
            'Repos': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.5 7C3.5 5.067 5.067 3.5 7 3.5C8.933 3.5 10.5 5.067 10.5 7C10.5 8.933 8.933 10.5 7 10.5C5.067 10.5 3.5 8.933 3.5 7Z" stroke="currentColor" stroke-width="1.25"/><path d="M5 7L6.5 8.5L9 6" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            'Culture': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 2V12M2 7H12" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/><circle cx="7" cy="7" r="4" stroke="currentColor" stroke-width="1.25"/></svg>'
          };
          var placeholderCity = isHub ? 'Ville' : 'Sélectionner une ville';
          function init() {
            var countrySelect = document.getElementById(countryId);
            var citySelect = document.getElementById(cityId);
            var cityWrapper = document.getElementById(cityWrapperId);
            if (!countrySelect || !citySelect || countrySelect._locationCascadeBound) return;
            countrySelect._locationCascadeBound = true;
            function updateCityAssistant() {
              if (!citySelect || !cityWrapper) return;
              var ex = cityWrapper.querySelector('.location-city-assistant');
              if (ex) ex.remove();
              citySelect.style.paddingRight = '';
              var opt = citySelect.options[citySelect.selectedIndex];
              if (!opt || !opt.value) return;
              var cityName = opt.value;
              var badges = [];
              try { if (opt.getAttribute('data-badges')) badges = JSON.parse(opt.getAttribute('data-badges')); } catch (e) {}
              var isVeryPopular = opt.getAttribute('data-very-popular') === 'true';
              var displayBadges = getDisplayBadges(badges);
              var assistant = document.createElement('div');
              assistant.className = 'location-city-assistant';
              assistant.setAttribute('aria-label', 'Informations sur ' + cityName);
              if (displayBadges.length > 0) {
                var icons = document.createElement('div');
                icons.className = 'location-city-icons';
                for (var i = 0; i < displayBadges.length; i++) {
                  var w = document.createElement('span');
                  w.className = 'location-city-icon';
                  w.setAttribute('aria-label', displayBadges[i]);
                  w.innerHTML = objectiveIcons[displayBadges[i]] || '';
                  icons.appendChild(w);
                }
                assistant.appendChild(icons);
              }
              if (isVeryPopular) {
                var popularIcon = document.createElement('span');
                popularIcon.className = 'location-city-icon location-city-icon-popular';
                popularIcon.setAttribute('aria-label', 'Ville très demandée en ce moment');
                popularIcon.innerHTML = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="6" cy="6" r="4.5" stroke="currentColor" stroke-width="1.25"/><circle cx="6" cy="6" r="1.5" fill="currentColor"/></svg>';
                assistant.appendChild(popularIcon);
              }
              var infoBtn = document.createElement('button');
              infoBtn.type = 'button';
              infoBtn.className = 'location-city-info-btn';
              infoBtn.setAttribute('aria-label', 'Informations sur ' + cityName);
              infoBtn.setAttribute('aria-expanded', 'false');
              infoBtn.innerHTML = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.25"/><path d="M6 4V4.5M6 7.5V8" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>';
              infoBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                togglePopover(cityName, displayBadges, isVeryPopular, infoBtn);
              });
              assistant.appendChild(infoBtn);
              cityWrapper.appendChild(assistant);
              citySelect.style.paddingRight = '8rem';
            }
            function togglePopover(cityName, badges, isVeryPopular, triggerBtn) {
              var existing = document.querySelector('.location-city-popover');
              if (existing && existing.dataset.city === cityName) {
                existing.remove();
                triggerBtn.setAttribute('aria-expanded', 'false');
                return;
              }
              document.querySelectorAll('.location-city-popover').forEach(function(p) { p.remove(); });
              document.querySelectorAll('.location-city-info-btn').forEach(function(btn) { btn.setAttribute('aria-expanded', 'false'); });
              var popover = document.createElement('div');
              popover.className = 'location-city-popover';
              popover.setAttribute('role', 'dialog');
              popover.setAttribute('aria-label', 'Informations sur ' + cityName);
              popover.dataset.city = cityName;
              var content = document.createElement('div');
              content.className = 'location-city-popover-content';
              var displayBadgesPopover = badges && badges.length > 0 ? getDisplayBadges(badges) : [];
              if (displayBadgesPopover.length > 0) {
                var p1 = document.createElement('p');
                p1.className = 'location-city-popover-text';
                p1.textContent = 'Souvent choisie pour : ' + displayBadgesPopover.join(' • ');
                content.appendChild(p1);
              }
              if (isVeryPopular) {
                var p2 = document.createElement('p');
                p2.className = 'location-city-popover-text location-city-popover-badge';
                p2.textContent = 'Ville très demandée en ce moment';
                content.appendChild(p2);
              }
              popover.appendChild(content);
              document.body.appendChild(popover);
              var rect = triggerBtn.getBoundingClientRect();
              var w = popover.offsetWidth || 280;
              var h = popover.offsetHeight || 120;
              var left = rect.left + rect.width / 2 - w / 2;
              var top = rect.bottom + 8;
              if (left < 8) left = 8;
              if (left + w > window.innerWidth - 8) left = window.innerWidth - w - 8;
              if (top + h > window.innerHeight - 8) top = rect.top - h - 8;
              popover.style.left = left + 'px';
              popover.style.top = top + 'px';
              triggerBtn.setAttribute('aria-expanded', 'true');
              setTimeout(function() {
                document.addEventListener('click', function closePopover(e) {
                  if (!popover.contains(e.target) && e.target !== triggerBtn) {
                    popover.remove();
                    triggerBtn.setAttribute('aria-expanded', 'false');
                    document.removeEventListener('click', closePopover);
                  }
                });
              }, 10);
            }
            function updateCities() {
              var country = countrySelect.value;
              citySelect.innerHTML = '<option value="">' + placeholderCity + '</option>';
              citySelect.value = '';
              citySelect.setAttribute('disabled', 'disabled');
              if (!country) return;
              if (citiesByCountry[country] && citiesByCountry[country].length > 0) {
                var cities = citiesByCountry[country];
                for (var i = 0; i < cities.length; i++) {
                  var cityName = cities[i];
                  var opt = document.createElement('option');
                  opt.value = cityName;
                  opt.textContent = cityName;
                  if (cityBadges[cityName] && cityBadges[cityName].length) opt.setAttribute('data-badges', JSON.stringify(cityBadges[cityName]));
                  if (highDemandCitiesLaunch.indexOf(cityName) !== -1) opt.setAttribute('data-very-popular', 'true');
                  citySelect.appendChild(opt);
                }
                citySelect.removeAttribute('disabled');
                setTimeout(updateCityAssistant, 50);
              }
            }
            function onCitySelectionChange() {
              setTimeout(updateCityAssistant, 0);
              setTimeout(updateCityAssistant, 50);
              setTimeout(updateCityAssistant, 150);
            }
            function startCityValueWatch() {
              var lastVal = citySelect.value;
              var n = 0;
              var tick = function() {
                if (citySelect.value !== lastVal) {
                  lastVal = citySelect.value;
                  updateCityAssistant();
                }
                n++;
                if (n < 20) setTimeout(tick, 50);
              };
              setTimeout(tick, 50);
            }
            countrySelect.addEventListener('change', updateCities);
            citySelect.addEventListener('change', onCitySelectionChange);
            citySelect.addEventListener('input', onCitySelectionChange);
            citySelect.addEventListener('blur', function() {
              if (citySelect.value) setTimeout(updateCityAssistant, 10);
              startCityValueWatch();
            });
            citySelect.addEventListener('focus', startCityValueWatch);
            cityWrapper.addEventListener('change', function(e) {
              if (e.target && e.target.id === cityId) onCitySelectionChange();
            });
            updateCities();
            setTimeout(function() { if (citySelect.value) updateCityAssistant(); }, 100);
            setTimeout(updateCities, 150);
          }
          if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
          } else {
            init();
          }
          setTimeout(init, 200);
          setTimeout(init, 200);
        })();
        </script>
        @endif
        @else
        <div class="filter-input-group">
          <i class="fas fa-map-marker-alt filter-input-icon"></i>
          <input 
            type="text" 
            name="location" 
            id="searchLocation"
            value="{{ request('location') }}"
            placeholder="{{ $locationPlaceholder }}"
            class="filter-input"
            autocomplete="off"
          >
        </div>
        @endif
        <button type="submit" class="filter-submit-btn">
          <i class="fas fa-search me-2"></i>
          {{ __('Rechercher') }}
        </button>
      </div>

      <!-- Ligne 2: Filtres avancés (repliable) -->
      <div class="filter-advanced-toggle">
        <button type="button" class="filter-advanced-btn" id="toggleAdvancedFilters">
          <i class="fas fa-sliders-h me-2"></i>
          {{ __('Filtres avancés') }}
          <i class="fas fa-chevron-down ms-2" id="chevronIcon"></i>
        </button>
      </div>

      <div class="filter-advanced-content" id="advancedFilters" style="display: none;">
        @if(in_array($universe, ['projects', 'lessons', 'corporate', 'homeswap', 'at-home', 'wellnesslive']) && !empty($categories))
        {{-- Hiérarchie premium /services/projects ET /services/lessons (copie stricte) : Niveau 1 → 2 → 3 — Je pose mon besoin / Affiner / Critères avancés --}}
        {{-- Lessons : Type de mission en cartes segmentées + Langues (maternelle + CECRL). Projects : checkboxes inchangés. --}}
        <div class="filters-level filters-level-1 @if($universe === 'lessons') besoin-lessons @endif" data-level="besoin">
          <h3 class="filters-level-title filters-level-1-title">Je pose mon besoin</h3>
          <div class="filters-level-inner">
            @if($universe === 'lessons')
            {{-- Lessons : Type de rituel — cartes segmentées (une seule sélection), même name/values — libellés adaptés Cours & Tutorat --}}
            <div class="filter-group filter-group--full">
              <label class="filter-label"><i class="fas fa-tasks me-2"></i>Type de rituel</label>
              <div class="besoin-mission-segmented" role="group" aria-label="Type de rituel">
                @php $mt = (array) request('mission_type', []); @endphp
                <label class="besoin-mission-card {{ in_array('one-shot', $mt) ? 'is-active' : '' }}">
                  <input type="radio" name="mission_type[]" value="one-shot" {{ in_array('one-shot', $mt) ? 'checked' : '' }} class="sr-only">
                  <span class="besoin-mission-card-text">Séance ponctuelle</span>
                </label>
                <label class="besoin-mission-card {{ in_array('long-term', $mt) ? 'is-active' : '' }}">
                  <input type="radio" name="mission_type[]" value="long-term" {{ in_array('long-term', $mt) ? 'checked' : '' }} class="sr-only">
                  <span class="besoin-mission-card-text">Suivi régulier</span>
                </label>
                <label class="besoin-mission-card {{ in_array('maintenance', $mt) ? 'is-active' : '' }}">
                  <input type="radio" name="mission_type[]" value="maintenance" {{ in_array('maintenance', $mt) ? 'checked' : '' }} class="sr-only">
                  <span class="besoin-mission-card-text">Programme structuré</span>
                </label>
              </div>
            </div>
            @php
              $besoin_languages = ['fr' => 'Français', 'en' => 'Anglais', 'es' => 'Espagnol', 'de' => 'Allemand', 'it' => 'Italien', 'pt' => 'Portugais', 'nl' => 'Néerlandais', 'ru' => 'Russe', 'zh' => 'Chinois', 'ar' => 'Arabe', 'ja' => 'Japonais', 'pl' => 'Polonais', 'el' => 'Grec', 'tr' => 'Turc', 'sv' => 'Suédois', 'ko' => 'Coréen', 'hi' => 'Hindi'];
              $cecrl_levels = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
            @endphp
            <div class="filter-group besoin-langues filter-group--full">
              <label class="filter-label"><i class="fas fa-language me-2"></i>Ma langue maternelle</label>
              <div class="besoin-langues-row">
                <div class="besoin-mother-tongue-wrap">
                  <select name="mother_tongue" id="besoin_mother_tongue" class="filter-select">
                    <option value="">{{ __('Langue maternelle') }}</option>
                    @foreach($besoin_languages as $code => $label)
                      <option value="{{ $code }}" {{ request('mother_tongue') === $code ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="besoin-other-langs-wrap" id="besoin_other_langs_wrap">
                  <span class="besoin-other-langs-label">Autres langues parlées</span>
                  <div class="besoin-lang-chips" id="besoin_lang_chips"></div>
                  <button type="button" class="besoin-add-lang-btn" id="besoin_add_lang_btn" aria-haspopup="true" aria-expanded="false">+ Ajouter</button>
                  <input type="hidden" name="other_languages" id="other_languages_input" value="{{ is_string(request('other_languages')) ? request('other_languages') : '' }}">
                  <div class="cecrl-popover" id="cecrl_popover" role="dialog" aria-label="Niveaux CECRL" hidden>
                    <div class="cecrl-popover-inner">
                      <div class="cecrl-table">
                        <div class="cecrl-table-head">
                          <span class="cecrl-th-lang">Langue</span>
                          <span class="cecrl-th-level">Niveau</span>
                        </div>
                        @foreach($besoin_languages as $code => $label)
                        <div class="cecrl-row" data-lang="{{ $code }}" data-lang-label="{{ $label }}">
                          <span class="cecrl-lang">{{ $label }}</span>
                          <div class="cecrl-pills">
                            @foreach($cecrl_levels as $l)
                            <button type="button" class="cecrl-pill" data-level="{{ $l }}" title="{{ $l }}">{{ $l }}</button>
                            @endforeach
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @elseif($universe === 'at-home')
            {{-- At-home : Type de prestation — cartes segmentées (services à domicile) --}}
            <div class="filter-group filter-group--full">
              <label class="filter-label"><i class="fas fa-tasks me-2"></i>Type de prestation</label>
              <div class="besoin-mission-segmented" role="group" aria-label="Type de prestation">
                @php $mt = (array) request('mission_type', []); @endphp
                <label class="besoin-mission-card {{ in_array('one-shot', $mt) ? 'is-active' : '' }}">
                  <input type="radio" name="mission_type[]" value="one-shot" {{ in_array('one-shot', $mt) ? 'checked' : '' }} class="sr-only">
                  <span class="besoin-mission-card-text">Ponctuelle</span>
                </label>
                <label class="besoin-mission-card {{ in_array('long-term', $mt) ? 'is-active' : '' }}">
                  <input type="radio" name="mission_type[]" value="long-term" {{ in_array('long-term', $mt) ? 'checked' : '' }} class="sr-only">
                  <span class="besoin-mission-card-text">Récurrente</span>
                </label>
                <label class="besoin-mission-card {{ in_array('maintenance', $mt) ? 'is-active' : '' }}">
                  <input type="radio" name="mission_type[]" value="maintenance" {{ in_array('maintenance', $mt) ? 'checked' : '' }} class="sr-only">
                  <span class="besoin-mission-card-text">Programme structuré</span>
                </label>
              </div>
            </div>
            @elseif($universe === 'wellnesslive')
            {{-- Junspro Ritual Motion : Type de session — cartes segmentées (Live / VOD / Routines) --}}
            <div class="filter-group filter-group--full">
              <label class="filter-label"><i class="fas fa-tasks me-2"></i>Type de session Ritual Motion</label>
              <div class="besoin-mission-segmented" role="group" aria-label="Type de session">
                @php $mt = (array) request('mission_type', []); @endphp
                <label class="besoin-mission-card {{ in_array('live', $mt) ? 'is-active' : '' }}">
                  <input type="radio" name="mission_type[]" value="live" {{ in_array('live', $mt) ? 'checked' : '' }} class="sr-only">
                  <span class="besoin-mission-card-text">Live</span>
                </label>
                <label class="besoin-mission-card {{ in_array('vod', $mt) ? 'is-active' : '' }}">
                  <input type="radio" name="mission_type[]" value="vod" {{ in_array('vod', $mt) ? 'checked' : '' }} class="sr-only">
                  <span class="besoin-mission-card-text">VOD</span>
                </label>
                <label class="besoin-mission-card {{ in_array('routines', $mt) ? 'is-active' : '' }}">
                  <input type="radio" name="mission_type[]" value="routines" {{ in_array('routines', $mt) ? 'checked' : '' }} class="sr-only">
                  <span class="besoin-mission-card-text">Routines</span>
                </label>
              </div>
            </div>
            @else
            <div class="filter-group">
              <label class="filter-label"><i class="fas fa-tasks me-2"></i>{{ __('Type de mission') }}</label>
              <div class="filter-checkboxes">
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="mission_type[]" value="one-shot" {{ in_array('one-shot', (array) request('mission_type', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Projet Unique</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="mission_type[]" value="long-term" {{ in_array('long-term', (array) request('mission_type', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Accompagnement à Long Terme</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="mission_type[]" value="maintenance" {{ in_array('maintenance', (array) request('mission_type', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Maintenance / Optimisation Continue</span>
                </label>
              </div>
            </div>
            @if($universe === 'corporate')
            @php
              $besoin_languages = $besoin_languages ?? ['fr' => 'Français', 'en' => 'Anglais', 'es' => 'Espagnol', 'de' => 'Allemand', 'it' => 'Italien', 'pt' => 'Portugais', 'nl' => 'Néerlandais', 'ru' => 'Russe', 'zh' => 'Chinois', 'ar' => 'Arabe', 'ja' => 'Japonais', 'pl' => 'Polonais', 'el' => 'Grec', 'tr' => 'Turc', 'sv' => 'Suédois', 'ko' => 'Coréen', 'hi' => 'Hindi'];
              $cecrl_levels = $cecrl_levels ?? ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
            @endphp
            <div class="filter-group besoin-langues filter-group--full">
              <label class="filter-label"><i class="fas fa-language me-2"></i>Ma langue maternelle</label>
              <div class="besoin-langues-row">
                <div class="besoin-mother-tongue-wrap">
                  <select name="mother_tongue" id="besoin_mother_tongue" class="filter-select">
                    <option value="">{{ __('Langue maternelle') }}</option>
                    @foreach($besoin_languages as $code => $label)
                      <option value="{{ $code }}" {{ request('mother_tongue') === $code ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="besoin-other-langs-wrap" id="besoin_other_langs_wrap">
                  <span class="besoin-other-langs-label">Autres langues parlées</span>
                  <div class="besoin-lang-chips" id="besoin_lang_chips"></div>
                  <button type="button" class="besoin-add-lang-btn" id="besoin_add_lang_btn" aria-haspopup="true" aria-expanded="false">+ Ajouter</button>
                  <input type="hidden" name="other_languages" id="other_languages_input" value="{{ is_string(request('other_languages')) ? request('other_languages') : '' }}">
                  <div class="cecrl-popover" id="cecrl_popover" role="dialog" aria-label="Niveaux CECRL" hidden>
                    <div class="cecrl-popover-inner">
                      <div class="cecrl-table">
                        <div class="cecrl-table-head">
                          <span class="cecrl-th-lang">Langue</span>
                          <span class="cecrl-th-level">Niveau</span>
                        </div>
                        @foreach($besoin_languages as $code => $label)
                        <div class="cecrl-row" data-lang="{{ $code }}" data-lang-label="{{ $label }}">
                          <span class="cecrl-lang">{{ $label }}</span>
                          <div class="cecrl-pills">
                            @foreach($cecrl_levels as $l)
                            <button type="button" class="cecrl-pill" data-level="{{ $l }}" title="{{ $l }}">{{ $l }}</button>
                            @endforeach
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @endif
            @if($universe === 'homeswap')
            @php
              $besoin_languages = $besoin_languages ?? ['fr' => 'Français', 'en' => 'Anglais', 'es' => 'Espagnol', 'de' => 'Allemand', 'it' => 'Italien', 'pt' => 'Portugais', 'nl' => 'Néerlandais', 'ru' => 'Russe', 'zh' => 'Chinois', 'ar' => 'Arabe', 'ja' => 'Japonais', 'pl' => 'Polonais', 'el' => 'Grec', 'tr' => 'Turc', 'sv' => 'Suédois', 'ko' => 'Coréen', 'hi' => 'Hindi'];
              $cecrl_levels = $cecrl_levels ?? ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
            @endphp
            <div class="filter-group besoin-langues filter-group--full">
              <label class="filter-label"><i class="fas fa-language me-2"></i>Ma langue maternelle</label>
              <div class="besoin-langues-row">
                <div class="besoin-mother-tongue-wrap">
                  <select name="mother_tongue" id="besoin_mother_tongue_homeswap" class="filter-select">
                    <option value="">{{ __('Langue maternelle') }}</option>
                    @foreach($besoin_languages as $code => $label)
                      <option value="{{ $code }}" {{ request('mother_tongue') === $code ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="besoin-other-langs-wrap" id="besoin_other_langs_wrap_homeswap">
                  <span class="besoin-other-langs-label">Autres langues parlées</span>
                  <div class="besoin-lang-chips" id="besoin_lang_chips_homeswap"></div>
                  <button type="button" class="besoin-add-lang-btn" id="besoin_add_lang_btn_homeswap" aria-haspopup="true" aria-expanded="false">+ Ajouter</button>
                  <input type="hidden" name="other_languages" id="other_languages_input_homeswap" value="{{ is_string(request('other_languages')) ? request('other_languages') : '' }}">
                  <div class="cecrl-popover" id="cecrl_popover_homeswap" role="dialog" aria-label="Niveaux CECRL" hidden>
                    <div class="cecrl-popover-inner">
                      <div class="cecrl-table">
                        <div class="cecrl-table-head">
                          <span class="cecrl-th-lang">Langue</span>
                          <span class="cecrl-th-level">Niveau</span>
                        </div>
                        @foreach($besoin_languages as $code => $label)
                        <div class="cecrl-row" data-lang="{{ $code }}" data-lang-label="{{ $label }}">
                          <span class="cecrl-lang">{{ $label }}</span>
                          <div class="cecrl-pills">
                            @foreach($cecrl_levels as $l)
                            <button type="button" class="cecrl-pill" data-level="{{ $l }}" title="{{ $l }}">{{ $l }}</button>
                            @endforeach
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if($universe === 'lessons' || $universe === 'at-home' || $universe === 'wellnesslive')
            {{-- Lessons / At-home / Ritual Motion : Tarif du rituel (slider premium) + Format du rituel — binding price_min/price_max --}}
            <div class="besoin-rituel-row">
              <div class="filter-group besoin-tarif-rituel">
                <label class="filter-label"><i class="fas fa-coins me-2"></i>Tarif du rituel / h</label>
                <div class="rituel-price-filter-wrapper">
                  <div id="rituel-price-slider" class="rituel-price-slider"></div>
                  <div class="rituel-price-range-display">
                    <input type="number" name="price_min" id="rituel-price-min" class="rituel-price-input" min="10" max="100" value="{{ request('price_min', 10) }}" step="1">
                    <span class="rituel-price-separator">-</span>
                    <input type="number" name="price_max" id="rituel-price-max" class="rituel-price-input" min="10" max="100" value="{{ request('price_max', 50) }}" step="1">
                    <span class="rituel-price-unit">€</span>
                  </div>
                </div>
              </div>
              <div class="filter-group besoin-format-rituel">
                <label class="filter-label"><i class="fas fa-clock me-2"></i>Format du rituel</label>
                <div class="besoin-format-rituel-value">50 min focus · 10 min restitution</div>
                <p class="besoin-format-rituel-micro">Un temps dédié à l'action, suivi d'un retour structuré et concret.</p>
              </div>
            </div>
            @else
            @if(!in_array($universe, ['projects', 'corporate', 'homeswap']))
            <div class="filter-group" id="budgetGroup">
              <label class="filter-label"><i class="fas fa-euro-sign me-2"></i>{{ __('Budget') }} (€)</label>
              <div class="filter-budget-range">
                <input type="number" name="budget_min" id="budgetMin" placeholder="{{ __('Min') }}" class="filter-input-small" value="{{ request('budget_min') }}">
                <span class="filter-budget-separator">-</span>
                <input type="number" name="budget_max" id="budgetMax" placeholder="{{ __('Max') }}" class="filter-input-small" value="{{ request('budget_max') }}">
              </div>
            </div>
            @endif
            <div class="filter-group filter-group-rituel">
              <label class="filter-label"><i class="fas fa-coins me-2"></i>Engagement en Rituel</label>
              <div class="engagement-select-wrapper">
              <select name="price_range" class="filter-select budget-filter" id="budgetFilter">
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
              <div class="budget-estimate" id="budgetEstimate" style="font-size: 12px; margin-top: 6px; color: #6B7280; opacity: 0.8; font-weight: 400;">Sélectionnez un engagement pour afficher une estimation en rituels.</div>
              <div class="budget-estimate-hourly" id="budgetEstimateHourly" style="font-size: 11px; margin-top: 4px; color: #059669; opacity: 0.9; font-weight: 400; display: none;"></div>
            </div>
            @endif
          </div>
        </div>

        @php
          $filterUniverse = $universe === 'corporate' ? 'projects' : ($universe === 'homeswap' ? 'projects' : $universe);
          $filterRouteName = match($universe) {
            'projects' => 'services.projects',
            'corporate' => 'services.corporate',
            'homeswap' => 'services.homeswap',
            'at-home' => 'services.at-home',
            'wellnesslive' => 'services.wellnesslive',
            default => 'services.lessons',
          };
          $filterCategories = $categories;
          // Ne transformer que si les catégories sont des strings simples (ancien format)
          if (($universe === 'corporate' || $universe === 'homeswap') && !empty($categories) && isset($categories[0]) && is_string($categories[0])) {
            $filterCategories = array_map(fn($l) => ['slug' => \Illuminate\Support\Str::slug($l), 'label' => $l], $categories);
          }
        @endphp
        <x-services.filters.universal-filter
          :universe="$filterUniverse"
          :categories="$filterCategories"
          :routeName="$filterRouteName"
          :embedded="true"
          :excludeBudgetRituel="true"
          :hierarchyMode="in_array($universe, ['projects', 'lessons', 'corporate', 'homeswap', 'at-home', 'wellnesslive'])"
          :hideDomainSpecInAdvanced="false"
        />

        <div class="filters-level filters-level-3-extra" data-level="avances-extra">
          @if($universe === 'homeswap')
            {{-- FILTRES SPÉCIFIQUES HOMESWAP --}}
            
            {{-- Dates du séjour --}}
            <div class="filter-group">
              <label class="filter-label"><i class="fas fa-calendar me-2"></i>Dates du séjour</label>
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                <div>
                  <label style="font-size: 0.8125rem; color: var(--preply-text-light); margin-bottom: 4px; display: block;">Du</label>
                  <input type="date" name="date_from" class="filter-input" value="{{ request('date_from') }}" style="width: 100%; padding: 8px 12px; border: 1px solid var(--preply-border); border-radius: 8px; font-size: 0.9375rem;">
                </div>
                <div>
                  <label style="font-size: 0.8125rem; color: var(--preply-text-light); margin-bottom: 4px; display: block;">Au</label>
                  <input type="date" name="date_to" class="filter-input" value="{{ request('date_to') }}" style="width: 100%; padding: 8px 12px; border: 1px solid var(--preply-border); border-radius: 8px; font-size: 0.9375rem;">
                </div>
              </div>
              <input type="text" name="date_text" class="filter-input" placeholder="Dates (texte libre) ex: Juillet 2026, flexible" value="{{ request('date_text') }}" style="margin-bottom: 8px;">
              <div class="filter-checkboxes" style="display: flex; gap: 16px;">
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="date_flexible" value="1" {{ request('date_flexible') ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Dates flexibles</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="date_fixed" value="1" {{ request('date_fixed') ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Dates fixes</span>
                </label>
              </div>
            </div>

            {{-- Caractéristiques du logement --}}
            <div class="filter-group">
              <label class="filter-label"><i class="fas fa-home me-2"></i>Caractéristiques du logement</label>
              <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px;">
                <div>
                  <label style="font-size: 0.8125rem; color: var(--preply-text-light); margin-bottom: 4px; display: block;">Chambres</label>
                  <select name="bedrooms" class="filter-select" style="width: 100%;">
                    <option value="">Toutes</option>
                    <option value="1" {{ request('bedrooms') == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ request('bedrooms') == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ request('bedrooms') == '3' ? 'selected' : '' }}>3</option>
                    <option value="4" {{ request('bedrooms') == '4' ? 'selected' : '' }}>4+</option>
                  </select>
                </div>
                <div>
                  <label style="font-size: 0.8125rem; color: var(--preply-text-light); margin-bottom: 4px; display: block;">Salles de bain</label>
                  <select name="bathrooms" class="filter-select" style="width: 100%;">
                    <option value="">Toutes</option>
                    <option value="1" {{ request('bathrooms') == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ request('bathrooms') == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ request('bathrooms') == '3' ? 'selected' : '' }}>3+</option>
                  </select>
                </div>
                <div>
                  <label style="font-size: 0.8125rem; color: var(--preply-text-light); margin-bottom: 4px; display: block;">Adultes</label>
                  <select name="adults" class="filter-select" style="width: 100%;">
                    <option value="">Tous</option>
                    <option value="1" {{ request('adults') == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ request('adults') == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ request('adults') == '3' ? 'selected' : '' }}>3+</option>
                  </select>
                </div>
                <div>
                  <label style="font-size: 0.8125rem; color: var(--preply-text-light); margin-bottom: 4px; display: block;">Enfants</label>
                  <select name="children" class="filter-select" style="width: 100%;">
                    <option value="">Tous</option>
                    <option value="0" {{ request('children') == '0' ? 'selected' : '' }}>0</option>
                    <option value="1" {{ request('children') == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ request('children') == '2' ? 'selected' : '' }}>2+</option>
                  </select>
                </div>
              </div>
              <div style="margin-top: 12px;">
                <label style="font-size: 0.8125rem; color: var(--preply-text-light); margin-bottom: 4px; display: block;">Capacité d'accueil</label>
                <select name="capacity" class="filter-select" style="width: 100%;">
                  <option value="">Toutes</option>
                  <option value="1-2" {{ request('capacity') == '1-2' ? 'selected' : '' }}>1-2</option>
                  <option value="3-4" {{ request('capacity') == '3-4' ? 'selected' : '' }}>3-4</option>
                  <option value="5-6" {{ request('capacity') == '5-6' ? 'selected' : '' }}>5-6</option>
                  <option value="7+" {{ request('capacity') == '7+' ? 'selected' : '' }}>7+</option>
                </select>
              </div>
            </div>

            {{-- Équipements & confort --}}
            <div class="filter-group">
              <label class="filter-label"><i class="fas fa-couch me-2"></i>Équipements & confort</label>
              <div class="filter-checkboxes" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px;">
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="equipment[]" value="wifi" {{ in_array('wifi', (array) request('equipment', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">WiFi</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="equipment[]" value="bureau" {{ in_array('bureau', (array) request('equipment', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Bureau</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="equipment[]" value="cuisine" {{ in_array('cuisine', (array) request('equipment', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Cuisine équipée</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="equipment[]" value="lave-linge" {{ in_array('lave-linge', (array) request('equipment', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Lave-linge</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="equipment[]" value="lave-vaisselle" {{ in_array('lave-vaisselle', (array) request('equipment', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Lave-vaisselle</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="equipment[]" value="seche-linge" {{ in_array('seche-linge', (array) request('equipment', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Sèche-linge</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="equipment[]" value="climatisation" {{ in_array('climatisation', (array) request('equipment', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Climatisation</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="equipment[]" value="chauffage" {{ in_array('chauffage', (array) request('equipment', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Chauffage</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="equipment[]" value="lit-bebe" {{ in_array('lit-bebe', (array) request('equipment', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Lit bébé</span>
                </label>
              </div>
            </div>

            {{-- Espaces extérieurs --}}
            <div class="filter-group">
              <label class="filter-label"><i class="fas fa-tree me-2"></i>Espaces extérieurs</label>
              <div class="filter-checkboxes" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px;">
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="outdoor[]" value="balcon" {{ in_array('balcon', (array) request('outdoor', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Balcon</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="outdoor[]" value="terrasse" {{ in_array('terrasse', (array) request('outdoor', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Terrasse</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="outdoor[]" value="cour" {{ in_array('cour', (array) request('outdoor', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Cour</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="outdoor[]" value="jardin" {{ in_array('jardin', (array) request('outdoor', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Jardin</span>
                </label>
              </div>
            </div>

            {{-- Règles & préférences --}}
            <div class="filter-group">
              <label class="filter-label"><i class="fas fa-shield-alt me-2"></i>Règles & préférences</label>
              <div class="filter-checkboxes" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="rules[]" value="non-fumeurs" {{ in_array('non-fumeurs', (array) request('rules', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Non-fumeurs</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="rules[]" value="animaux-non-acceptes" {{ in_array('animaux-non-acceptes', (array) request('rules', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Animaux non acceptés</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="rules[]" value="enfants-acceptes" {{ in_array('enfants-acceptes', (array) request('rules', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Enfants acceptés</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="rules[]" value="calme" {{ in_array('calme', (array) request('rules', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Logement calme</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="rules[]" value="teletravail" {{ in_array('teletravail', (array) request('rules', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Adapté au télétravail</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="rules[]" value="voisinage" {{ in_array('voisinage', (array) request('rules', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Respect du voisinage requis</span>
                </label>
              </div>
            </div>

            {{-- Type d'échange --}}
            <div class="filter-group">
              <label class="filter-label"><i class="fas fa-exchange-alt me-2"></i>Type d'échange</label>
              <div class="filter-checkboxes" style="display: flex; gap: 16px;">
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="exchange_type[]" value="simultane" {{ in_array('simultane', (array) request('exchange_type', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Échange simultané</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="exchange_type[]" value="non-simultane" {{ in_array('non-simultane', (array) request('exchange_type', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Échange non simultané</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="exchange_type[]" value="points" {{ in_array('points', (array) request('exchange_type', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Échange à points</span>
                </label>
              </div>
            </div>

            {{-- Objectif du séjour --}}
            <div class="filter-group">
              <label class="filter-label"><i class="fas fa-bullseye me-2"></i>Objectif du séjour</label>
              <div class="filter-checkboxes" style="display: flex; gap: 16px; flex-wrap: wrap;">
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="trip_purpose[]" value="vacances" {{ in_array('vacances', (array) request('trip_purpose', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Vacances</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="trip_purpose[]" value="travail-distance" {{ in_array('travail-distance', (array) request('trip_purpose', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Travail à distance</span>
                </label>
                <label class="filter-checkbox-label">
                  <input type="checkbox" name="trip_purpose[]" value="echange-linguistique" {{ in_array('echange-linguistique', (array) request('trip_purpose', [])) ? 'checked' : '' }}>
                  <span class="filter-checkbox-custom"></span>
                  <span class="filter-checkbox-text">Échange linguistique</span>
                </label>
              </div>
            </div>
          @else
            {{-- FILTRES STANDARDS (Projects, Lessons, etc.) --}}
          <div class="filter-group">
            <label class="filter-label"><i class="fas fa-laptop me-2"></i>{{ __('Mode d\'intervention') }}</label>
            <div class="filter-checkboxes">
              <label class="filter-checkbox-label">
                <input type="checkbox" name="mode[]" value="online" {{ in_array('online', (array) request('mode', [])) ? 'checked' : '' }}>
                <span class="filter-checkbox-custom"></span>
                <span class="filter-checkbox-text">{{ __('En ligne') }}</span>
              </label>
              @if(!$isHub && !$isProjects && !$isLessons && !$isCorporate && !$isAtHome && !$isWellnesslive)
              <label class="filter-checkbox-label">
                <input type="checkbox" name="mode[]" value="offline" {{ in_array('offline', (array) request('mode', [])) ? 'checked' : '' }}>
                <span class="filter-checkbox-custom"></span>
                <span class="filter-checkbox-text">{{ __('Hors ligne') }}</span>
              </label>
              @endif
              <label class="filter-checkbox-label">
                <input type="checkbox" name="mode[]" value="onsite" {{ in_array('onsite', (array) request('mode', [])) ? 'checked' : '' }}>
                <span class="filter-checkbox-custom"></span>
                <span class="filter-checkbox-text">{{ __('Présentiel') }}</span>
              </label>
            </div>
          </div>
          @if(!in_array($universe, ['lessons', 'projects', 'corporate', 'at-home', 'wellnesslive']))
          <div class="filter-group">
            <label class="filter-label"><i class="fas fa-map-marker-alt me-2"></i>{{ __('Lieu') }}</label>
            <div class="filter-location-wrapper">
              <div class="filter-select-wrapper" style="margin-bottom: 1rem;">
                <select name="country" id="filterCountry" class="filter-select">
                  <option value="">{{ __('Sélectionner un pays') }}</option>
                  <option value="FR" {{ request('country') == 'FR' ? 'selected' : '' }}>{{ __('France') }}</option>
                  <option value="BE" {{ request('country') == 'BE' ? 'selected' : '' }}>{{ __('Belgique') }}</option>
                  <option value="CH" {{ request('country') == 'CH' ? 'selected' : '' }}>{{ __('Suisse') }}</option>
                  <option value="ES" {{ request('country') == 'ES' ? 'selected' : '' }}>{{ __('Espagne') }}</option>
                  <option value="DE" {{ request('country') == 'DE' ? 'selected' : '' }}>{{ __('Allemagne') }}</option>
                  <option value="IT" {{ request('country') == 'IT' ? 'selected' : '' }}>{{ __('Italie') }}</option>
                  <option value="PT" {{ request('country') == 'PT' ? 'selected' : '' }}>{{ __('Portugal') }}</option>
                  <option value="NL" {{ request('country') == 'NL' ? 'selected' : '' }}>{{ __('Pays-Bas') }}</option>
                  <option value="GB" {{ request('country') == 'GB' ? 'selected' : '' }}>{{ __('Royaume-Uni') }}</option>
                  <option value="CA" {{ request('country') == 'CA' ? 'selected' : '' }}>{{ __('Canada') }}</option>
                  <option value="US" {{ request('country') == 'US' ? 'selected' : '' }}>{{ __('États-Unis') }}</option>
                  <option value="MT" {{ request('country') == 'MT' ? 'selected' : '' }}>{{ __('Malte') }}</option>
                </select>
              </div>
              <div class="filter-select-wrapper" id="cityWrapper">
                <select name="city" id="filterCity" class="filter-select">
                  <option value="">{{ __('Sélectionner une ville') }}</option>
                </select>
              </div>
            </div>
          </div>
          @endif
          @endif
        </div>
        @else
        <!-- Mode d'intervention + Type de mission (même ligne) -->
        <div class="filter-row-mode-type">
          <div class="filter-group">
            <label class="filter-label"><i class="fas fa-laptop me-2"></i>{{ __('Mode d\'intervention') }}</label>
            <div class="filter-checkboxes">
              <label class="filter-checkbox-label">
                <input type="checkbox" name="mode[]" value="online" {{ in_array('online', (array) request('mode', [])) ? 'checked' : '' }}>
                <span class="filter-checkbox-custom"></span>
                <span class="filter-checkbox-text">{{ __('En ligne') }}</span>
              </label>
              @if(!$isHub && !$isProjects && !$isLessons && !$isCorporate && !$isAtHome && !$isWellnesslive)
              <label class="filter-checkbox-label">
                <input type="checkbox" name="mode[]" value="offline" {{ in_array('offline', (array) request('mode', [])) ? 'checked' : '' }}>
                <span class="filter-checkbox-custom"></span>
                <span class="filter-checkbox-text">{{ __('Hors ligne') }}</span>
              </label>
              @endif
              <label class="filter-checkbox-label">
                <input type="checkbox" name="mode[]" value="onsite" {{ in_array('onsite', (array) request('mode', [])) ? 'checked' : '' }}>
                <span class="filter-checkbox-custom"></span>
                <span class="filter-checkbox-text">{{ __('Présentiel') }}</span>
              </label>
            </div>
          </div>
          <div class="filter-group">
            <label class="filter-label"><i class="fas fa-tasks me-2"></i>{{ __('Type de mission') }}</label>
            <div class="filter-checkboxes">
              <label class="filter-checkbox-label">
                <input type="checkbox" name="mission_type[]" value="one-shot" {{ in_array('one-shot', (array) request('mission_type', [])) ? 'checked' : '' }}>
                <span class="filter-checkbox-custom"></span>
                <span class="filter-checkbox-text">Projet Unique</span>
              </label>
              <label class="filter-checkbox-label">
                <input type="checkbox" name="mission_type[]" value="long-term" {{ in_array('long-term', (array) request('mission_type', [])) ? 'checked' : '' }}>
                <span class="filter-checkbox-custom"></span>
                <span class="filter-checkbox-text">Accompagnement à Long Terme</span>
              </label>
              <label class="filter-checkbox-label">
                <input type="checkbox" name="mission_type[]" value="maintenance" {{ in_array('maintenance', (array) request('mission_type', [])) ? 'checked' : '' }}>
                <span class="filter-checkbox-custom"></span>
                <span class="filter-checkbox-text">Maintenance / Optimisation Continue</span>
              </label>
            </div>
          </div>
        </div>

        @if(!$universe)
        <div class="filter-group">
          <label class="filter-label"><i class="fas fa-globe me-2"></i>{{ __('Univers') }}</label>
          <div class="filter-checkboxes">
            @php
              $selectedUniverses = request('universe', []);
              if (!is_array($selectedUniverses)) { $selectedUniverses = $selectedUniverses ? [$selectedUniverses] : []; }
              $universes = ['projects' => __('Projets et Consulting'), 'lessons' => __('Cours'), 'at-home' => __('Services at Home'), 'wellnesslive' => __('WellnessLive'), 'corporate' => __('Bien-être en entreprise'), 'homeswap' => __('Échanges de logement')];
            @endphp
            @foreach($universes as $key => $label)
              <label class="filter-checkbox-label">
                <input type="checkbox" name="universe[]" value="{{ $key }}" {{ in_array($key, $selectedUniverses) ? 'checked' : '' }}>
                <span class="filter-checkbox-custom"></span>
                <span class="filter-checkbox-text">{{ $label }}</span>
              </label>
            @endforeach
          </div>
        </div>
        @endif

        <div class="filter-group">
          <label class="filter-label"><i class="fas fa-map-marker-alt me-2"></i>{{ __('Lieu') }}</label>
          <div class="filter-location-wrapper">
            <div class="filter-select-wrapper" style="margin-bottom: 1rem;">
              <select name="country" id="filterCountry" class="filter-select">
                <option value="">{{ __('Sélectionner un pays') }}</option>
                <option value="FR" {{ request('country') == 'FR' ? 'selected' : '' }}>{{ __('France') }}</option>
                <option value="BE" {{ request('country') == 'BE' ? 'selected' : '' }}>{{ __('Belgique') }}</option>
                <option value="CH" {{ request('country') == 'CH' ? 'selected' : '' }}>{{ __('Suisse') }}</option>
                <option value="ES" {{ request('country') == 'ES' ? 'selected' : '' }}>{{ __('Espagne') }}</option>
                <option value="DE" {{ request('country') == 'DE' ? 'selected' : '' }}>{{ __('Allemagne') }}</option>
                <option value="IT" {{ request('country') == 'IT' ? 'selected' : '' }}>{{ __('Italie') }}</option>
                <option value="PT" {{ request('country') == 'PT' ? 'selected' : '' }}>{{ __('Portugal') }}</option>
                <option value="NL" {{ request('country') == 'NL' ? 'selected' : '' }}>{{ __('Pays-Bas') }}</option>
                <option value="GB" {{ request('country') == 'GB' ? 'selected' : '' }}>{{ __('Royaume-Uni') }}</option>
                <option value="CA" {{ request('country') == 'CA' ? 'selected' : '' }}>{{ __('Canada') }}</option>
                <option value="US" {{ request('country') == 'US' ? 'selected' : '' }}>{{ __('États-Unis') }}</option>
                <option value="MT" {{ request('country') == 'MT' ? 'selected' : '' }}>{{ __('Malte') }}</option>
              </select>
            </div>
            <div class="filter-select-wrapper" id="cityWrapper">
              <select name="city" id="filterCity" class="filter-select">
                <option value="">{{ __('Sélectionner une ville') }}</option>
              </select>
            </div>
          </div>
        </div>

        <div class="filter-group" id="budgetGroup" style="display: none;">
          <label class="filter-label"><i class="fas fa-euro-sign me-2"></i>{{ __('Budget') }}</label>
          <div class="filter-budget-range">
            <input type="number" name="budget_min" id="budgetMin" placeholder="{{ __('Min') }}" class="filter-input-small" value="{{ request('budget_min') }}">
            <span class="filter-budget-separator">-</span>
            <input type="number" name="budget_max" id="budgetMax" placeholder="{{ __('Max') }}" class="filter-input-small" value="{{ request('budget_max') }}">
          </div>
        </div>
        @endif

        <!-- Filtres spécifiques par univers (dynamiques) -->
        <div class="filter-group" id="universeSpecificFilters" style="display: none;">
          <!-- Sera rempli dynamiquement selon l'univers sélectionné -->
        </div>
      </div>
    </form>
  </div>

  <!-- Contenu Onglet Déposer un projet -->
  <div class="filter-content" id="contentSubmit" style="display: none;">
    <div class="submit-project-cta">
      <div class="submit-project-content">
        <h3 class="submit-project-title">{{ __('Déposez votre projet et trouvez le freelance idéal') }}</h3>
        <p class="submit-project-text">{{ __('Décrivez votre besoin, définissez votre budget et recevez des propositions de freelances qualifiés.') }}</p>
        <a href="{{ route('deposer-projet') }}" class="submit-project-btn">
          <i class="fas fa-paper-plane me-2"></i>
          {{ __('Déposer mon projet') }}
        </a>
      </div>
    </div>
  </div>
</div>

@once
<style>
  /* Section Filtre Home - Style Premium */
  .home-search-filter-section {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(250, 248, 255, 0.95) 100%);
    border-radius: 32px;
    padding: 2.5rem;
    margin: -60px auto 4rem;
    max-width: 1200px;
    box-shadow: 0 20px 60px rgba(124, 58, 237, 0.15), 0 8px 24px rgba(124, 58, 237, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.9);
    border: 1.5px solid rgba(196, 181, 253, 0.2);
    backdrop-filter: blur(30px);
    position: relative;
    z-index: 10;
  }

  /* Onglets */
  .filter-tabs-container {
    margin-bottom: 2rem;
  }

  .filter-tabs {
    display: flex;
    gap: 1rem;
    border-bottom: 2px solid rgba(196, 181, 253, 0.2);
    padding-bottom: 0.5rem;
  }

  .filter-tab {
    background: none;
    border: none;
    padding: 0.875rem 1.75rem;
    font-size: 1rem;
    font-weight: 600;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 12px 12px 0 0;
    position: relative;
    display: flex;
    align-items: center;
  }

  .filter-tab:hover {
    color: #7c3aed;
    background: rgba(124, 58, 237, 0.05);
  }

  .filter-tab.active {
    color: #7c3aed;
    background: rgba(124, 58, 237, 0.1);
  }

  .filter-tab.active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%);
    border-radius: 2px 2px 0 0;
  }

  /* Contenu des onglets */
  .filter-content {
    display: none;
  }

  .filter-content.active {
    display: block;
  }

  /* Formulaire de recherche */
  .search-filter-form {
    width: 100%;
  }

  .filter-row-main {
    display: grid;
    grid-template-columns: 2fr 1.5fr auto;
    gap: 1rem;
    margin-bottom: 1.5rem;
  }

  /* Projets : Domaine + Spécialisation + Pays + Ville — 5 colonnes */
  .filter-row-main--projects-hero {
    grid-template-columns: minmax(180px, 1.5fr) minmax(180px, 1.5fr) minmax(160px, 1fr) minmax(160px, 1fr) auto;
  }
  /* WellnessLive / At-home / Hub / Corporate : aligner filtre Pays et filtre Ville sur la même ligne (même hauteur) */
  .search-filter-form[data-universe="wellnesslive"] .filter-row-main--projects-hero,
  .search-filter-form[data-universe="at-home"] .filter-row-main--projects-hero,
  .search-filter-form[data-universe="hub"] .filter-row-main--projects-hero,
  .search-filter-form[data-universe="corporate"] .filter-row-main--projects-hero {
    align-items: center;
  }
  /* Hub / Corporate /services : Spécialisation doit s'ouvrir — pas de clip, z-index au-dessus */
  .search-filter-form[data-universe="hub"] .filter-row-main--projects-hero,
  .search-filter-form[data-universe="corporate"] .filter-row-main--projects-hero {
    overflow: visible;
  }
  .search-filter-form[data-universe="hub"] #hubHeroSpecializationWrapper,
  .search-filter-form[data-universe="hub"] #hubHeroSpecializationSelect {
    overflow: visible !important;
    position: relative;
    z-index: 60;
  }
  .search-filter-form[data-universe="hub"] #hubHeroSpecializationSelect:not([disabled]) {
    pointer-events: auto;
    cursor: pointer;
  }
  /* Cours & Tutorat : duo Pays + Ville — 4 colonnes, bordures et padding identiques (référence HomeSwap) */
  .filter-row-main--has-location-duo:not(.filter-row-main--projects-hero) {
    grid-template-columns: 2fr minmax(180px, 1fr) minmax(180px, 1fr) auto;
  }
  
  /* Hub/Home/Projects/Lessons/At-Home/WellnessLive : avec Mode d'intervention — ajuster la grille pour inclure le mode */
  .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero) {
    grid-template-columns: 2fr minmax(200px, 1fr) minmax(180px, 1fr) minmax(180px, 1fr) auto;
  }
  /* Hub uniquement : largeurs ajustées — univers/domaines +1cm, Pays/Ville -2cm */
  .search-filter-form[data-universe="hub"] .filter-row-main--projects-hero:has(.hub-location-stack) {
    grid-template-columns: minmax(140px, 1fr) minmax(260px, 1fr) minmax(180px, 1fr) auto;
    column-gap: 0.75rem;
  }
  .search-filter-form[data-universe="hub"] .hero-filter-module {
    max-width: calc(100% - 1cm);
    min-width: 0;
  }
  .search-filter-form[data-universe="hub"] .hub-location-stack {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    min-width: 180px;
    max-width: calc(100% - 2cm);
  }
  .search-filter-form[data-universe="hub"] .hub-location-stack .filter-input-group.filter-location-hero {
    min-width: 100%;
  }
  .search-filter-form[data-universe="hub"] .hub-location-stack .filter-input,
  .search-filter-form[data-universe="hub"] .hub-location-stack .filter-select {
    min-width: 0;
    width: 100%;
  }
  .search-filter-form[data-universe="hub"] .filter-mode-intervention-hero {
    position: relative;
    z-index: 2;
    min-width: 260px;
    max-width: 100%;
  }
  .search-filter-form[data-universe="hub"] .mode-intervention-pill-text {
    white-space: nowrap;
  }
  .search-filter-form[data-universe="hub"] .mode-intervention-pill {
    padding-top: calc(0.625rem + 0.1cm);
    padding-bottom: calc(0.625rem + 0.1cm);
  }
  .search-filter-form[data-universe="hub"] .filter-row-main--projects-hero:has(.hub-location-stack) .filter-submit-btn {
    grid-column: 1;
    grid-row: 2;
    width: 100%;
    max-width: calc(100% - 1cm);
    padding: 1rem 1.5rem;
    height: auto;
    min-height: 3.25rem;
    box-sizing: border-box;
  }
  
  /* Correctifs superposition/coupé pour hub/services, projects, lessons, at-home et wellnesslive */
  .search-filter-form[data-universe="hub"] .filter-row-main--has-location-duo,
  .search-filter-form[data-universe="projects"] .filter-row-main--has-location-duo,
  .search-filter-form[data-universe="lessons"] .filter-row-main--has-location-duo,
  .search-filter-form[data-universe="corporate"] .filter-row-main--has-location-duo,
  .search-filter-form[data-universe="at-home"] .filter-row-main--has-location-duo,
  .search-filter-form[data-universe="wellnesslive"] .filter-row-main--has-location-duo {
    overflow: visible;
  }
  
  /* Min-width sur les triggers pour éviter troncature */
  .search-filter-form[data-universe="hub"] .filter-input-group.filter-mode-intervention-hero,
  .search-filter-form[data-universe="hub"] .filter-input-group.filter-location-hero,
  .search-filter-form[data-universe="projects"] .filter-input-group.filter-mode-intervention-hero,
  .search-filter-form[data-universe="projects"] .filter-input-group.filter-location-hero,
  .search-filter-form[data-universe="lessons"] .filter-input-group.filter-mode-intervention-hero,
  .search-filter-form[data-universe="lessons"] .filter-input-group.filter-location-hero,
  .search-filter-form[data-universe="corporate"] .filter-input-group.filter-mode-intervention-hero,
  .search-filter-form[data-universe="corporate"] .filter-input-group.filter-location-hero,
  .search-filter-form[data-universe="at-home"] .filter-input-group.filter-mode-intervention-hero,
  .search-filter-form[data-universe="at-home"] .filter-input-group.filter-location-hero,
  .search-filter-form[data-universe="wellnesslive"] .filter-input-group.filter-mode-intervention-hero,
  .search-filter-form[data-universe="wellnesslive"] .filter-input-group.filter-location-hero {
    min-width: 160px;
  }
  
  /* Dropdown z-index + overflow uniquement sur le menu ouvert */
  .search-filter-form[data-universe="hub"] .filter-input-group.filter-location-hero select:focus,
  .search-filter-form[data-universe="hub"] .filter-input-group.filter-location-hero select:active,
  .search-filter-form[data-universe="projects"] .filter-input-group.filter-location-hero select:focus,
  .search-filter-form[data-universe="projects"] .filter-input-group.filter-location-hero select:active,
  .search-filter-form[data-universe="lessons"] .filter-input-group.filter-location-hero select:focus,
  .search-filter-form[data-universe="lessons"] .filter-input-group.filter-location-hero select:active,
  .search-filter-form[data-universe="corporate"] .filter-input-group.filter-location-hero select:focus,
  .search-filter-form[data-universe="corporate"] .filter-input-group.filter-location-hero select:active,
  .search-filter-form[data-universe="at-home"] .filter-input-group.filter-location-hero select:focus,
  .search-filter-form[data-universe="at-home"] .filter-input-group.filter-location-hero select:active,
  .search-filter-form[data-universe="wellnesslive"] .filter-input-group.filter-location-hero select:focus,
  .search-filter-form[data-universe="wellnesslive"] .filter-input-group.filter-location-hero select:active {
    position: relative;
    z-index: 100;
  }
  
  /* Wrap responsive pour petits écrans */
  @media (max-width: 1024px) {
    .search-filter-form[data-universe="hub"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero),
    .search-filter-form[data-universe="projects"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero),
    .search-filter-form[data-universe="lessons"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero),
    .search-filter-form[data-universe="corporate"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero),
    .search-filter-form[data-universe="at-home"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero),
    .search-filter-form[data-universe="wellnesslive"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero) {
      grid-template-columns: 1fr 1fr;
      gap: 0.75rem;
    }
    .search-filter-form[data-universe="hub"] .filter-input-group.filter-mode-intervention-hero,
    .search-filter-form[data-universe="projects"] .filter-input-group.filter-mode-intervention-hero,
    .search-filter-form[data-universe="lessons"] .filter-input-group.filter-mode-intervention-hero,
    .search-filter-form[data-universe="corporate"] .filter-input-group.filter-mode-intervention-hero,
    .search-filter-form[data-universe="at-home"] .filter-input-group.filter-mode-intervention-hero,
    .search-filter-form[data-universe="wellnesslive"] .filter-input-group.filter-mode-intervention-hero {
      grid-column: 1 / -1;
    }
  }
  
  @media (max-width: 768px) {
    .search-filter-form[data-universe="hub"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero),
    .search-filter-form[data-universe="projects"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero),
    .search-filter-form[data-universe="lessons"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero),
    .search-filter-form[data-universe="corporate"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero),
    .search-filter-form[data-universe="at-home"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero),
    .search-filter-form[data-universe="wellnesslive"] .filter-row-main--has-location-duo:has(.filter-mode-intervention-hero) {
      grid-template-columns: 1fr;
    }
  }
  
  /* Helper text pour mode "En ligne" — s'affiche sur toute la largeur sous Pays/Ville */
  .location-helper-text-wrapper {
    grid-column: 1 / -1;
    width: 100%;
  }
  .search-filter-form[data-universe="hub"] .filter-row-main--projects-hero:has(.hub-location-stack) .location-helper-text-wrapper {
    grid-row: 3;
  }
  .filter-input-group.filter-location-hero .filter-input.filter-select,
  .filter-input-group.filter-location-hero .filter-select {
    padding-left: 3.5rem;
    border: 2px solid rgba(196, 181, 253, 0.3);
    min-width: 0;
    position: relative;
    z-index: 2;
  }
  .filter-input-group.filter-location-hero .filter-select:focus {
    outline: none;
    border-color: #7c3aed;
    box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
  }
  .filter-input-group.filter-location-hero .filter-select:disabled {
    border: 2px solid rgba(196, 181, 253, 0.3);
    opacity: 0.85;
    cursor: default;
  }

  /* Assistant ville (at-home, wellnesslive) : icônes + bouton info + popover */
  .home-search-filter-section .filter-input-group.filter-location-hero {
    position: relative;
  }
  /* Zone droite : [ icônes ] [ chevron natif ]. right = marge pour laisser le chevron toujours visible et cliquable */
  .location-city-assistant {
    position: absolute;
    right: 2rem;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    pointer-events: none;
    z-index: 2;
    flex-shrink: 0;
  }
  /* Réserver l’espace : texte | icônes | zone chevron (aucune icône ne recouvre la flèche) */
  .filter-input-group.filter-location-hero:has(.location-city-assistant) .home-location-city {
    padding-right: 8rem !important;
  }
  .location-city-assistant > * {
    pointer-events: auto;
    flex-shrink: 0;
  }
  .location-city-icons {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-shrink: 0;
  }
  .location-city-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    min-width: 18px;
    min-height: 18px;
    color: #94a3b8;
    opacity: 0.85;
    flex-shrink: 0;
  }
  .location-city-icon svg {
    width: 100%;
    height: 100%;
  }
  .location-city-icon-popular {
    color: #6b7280;
    opacity: 0.75;
  }
  .location-city-info-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    padding: 0;
    border: none;
    background: none;
    color: #94a3b8;
    cursor: pointer;
    opacity: 0.7;
    transition: all 0.2s ease;
  }
  .location-city-info-btn:hover {
    opacity: 1;
    color: #7c3aed;
  }
  .location-city-info-btn:focus-visible {
    outline: 2px solid #7c3aed;
    outline-offset: 2px;
    border-radius: 3px;
  }
  .location-city-info-btn svg {
    width: 100%;
    height: 100%;
  }
  .location-city-popover {
    position: fixed;
    z-index: 10000;
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
    min-width: 240px;
    max-width: 320px;
    animation: locationPopoverFadeIn 0.2s ease;
  }
  @keyframes locationPopoverFadeIn {
    from { opacity: 0; transform: translateY(-4px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .location-city-popover-content {
    padding: 1rem;
  }
  .location-city-popover-content p + p {
    margin-top: 0.5rem;
  }
  .location-city-popover-text {
    font-size: 0.75rem;
    color: #64748b;
    line-height: 1.5;
    margin: 0;
  }
  .location-city-popover-badge {
    color: #6b7280;
    font-weight: 500;
  }

  .filter-input-group {
    position: relative;
    display: flex;
    align-items: center;
  }

  .filter-input-icon {
    position: absolute;
    left: 1.25rem;
    color: #7c3aed;
    font-size: 1.1rem;
    z-index: 2;
    pointer-events: none;
  }
  /* Tous les univers : éviter que l’icône chevauche le texte */
  .filter-hero-domain-select-wrapper .filter-input-icon {
    left: 1rem;
  }
  .filter-hero-domain-select-wrapper .filter-input {
    padding-left: 4rem;
  }
  /* Tous les domaines (hub) : icône au-dessus du select pour rester visible */
  .filter-input-group.filter-hero-domain-spec .filter-input-icon {
    z-index: 3;
  }
  .search-filter-form[data-universe="hub"] #hubHeroSpecializationWrapper .filter-input-icon {
    z-index: 61;
  }
  /* Tous les domaines (hub) : éviter que l’icône chevauche le texte */
  .search-filter-form[data-universe="hub"] #hubHeroSpecializationWrapper .filter-input {
    padding-left: 4rem;
  }
  /* Tous les domaines (hub) : aligner le texte sur Tous les univers (alignement à gauche) */
  .search-filter-form[data-universe="hub"] #hubHeroSpecializationSelect {
    text-align: left;
  }
  .search-filter-form[data-universe="hub"] #hubHeroSpecializationWrapper .nice-select,
  .search-filter-form[data-universe="hub"] #hubHeroSpecializationWrapper .nice-select .current {
    text-align: left;
  }
  .search-filter-form[data-universe="hub"] #hubHeroSpecializationWrapper .nice-select .list {
    background: #fff;
    border: 1px solid var(--preply-border, #e5e7eb);
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.12);
  }
  .search-filter-form[data-universe="hub"] #hubHeroSpecializationWrapper .nice-select .list .option {
    text-align: left;
  }

  .filter-input {
    width: 100%;
    padding: 1rem 1rem 1rem 3.5rem;
    border: 2px solid rgba(196, 181, 253, 0.3);
    border-radius: 16px;
    font-size: 1rem;
    background: #ffffff;
    transition: all 0.3s ease;
    color: #1a202c;
  }

  .filter-input:focus {
    outline: none;
    border-color: #7c3aed;
    box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
  }

  .filter-input::placeholder {
    color: #9ca3af;
  }

  .filter-submit-btn {
    padding: 1rem 2.5rem;
    background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%);
    color: #ffffff;
    border: none;
    border-radius: 16px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .filter-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(124, 58, 237, 0.4);
  }

  /* Filtres avancés */
  .filter-advanced-toggle {
    text-align: center;
    margin: 1.5rem 0;
  }

  .filter-advanced-btn {
    background: none;
    border: none;
    color: #7c3aed;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    padding: 0.5rem 1rem;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
  }

  .filter-advanced-btn:hover {
    color: #2563eb;
  }

  .filter-advanced-content {
    padding-top: 1.5rem;
    border-top: 1px solid rgba(196, 181, 253, 0.2);
    overflow: visible;
  }

  /* Hiérarchie premium /services/projects : 3 niveaux visuels */
  .filters-level {
    margin-bottom: 2rem;
  }

  .filters-level-title {
    font-size: 1rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 1rem;
    display: block;
  }

  .filters-level-1-title {
    font-size: 1.05rem;
    color: #1f2937;
    margin-bottom: 1.25rem;
  }

  .filters-level-1 {
    padding: 1.5rem 0;
    margin-bottom: 2rem;
    border-bottom: 1px solid rgba(196, 181, 253, 0.15);
  }

  .filters-level-1 .filters-level-inner {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem 2rem;
    align-items: flex-start;
  }

  .filters-level-1 .filter-group {
    margin-bottom: 0;
    min-width: 200px;
  }

  .filters-level-1 .filter-group-rituel {
    border-left: 2px solid rgba(139, 92, 246, 0.25);
    padding-left: 1rem;
    margin-left: 0.25rem;
  }

  /* Affichage progressif des paliers d'engagement */
  .engagement-select-wrapper {
    position: relative;
  }
  
  .engagement-progressive-link {
    transition: color 0.2s ease;
    font-family: inherit;
    display: inline-block;
  }
  
  .engagement-progressive-link:hover {
    color: #4b5563;
  }

  /* ---------- Je pose mon besoin — Lessons : cartes segmentées + Langues (CECRL) — scopé .besoin-lessons ---------- */
  .besoin-lessons .filter-group--full { min-width: 100%; }
  .besoin-mission-segmented { display: flex; flex-wrap: wrap; gap: 0.5rem; }
  
  /* Mode d'intervention segmented control (premium) - uniquement pour hub/home */
  .mode-intervention-segmented {
    display: flex;
    gap: 0.5rem;
    background: #f3f4f6;
    border-radius: 12px;
    padding: 4px;
    border: 1px solid #e5e7eb;
  }
  
  .mode-intervention-pill {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.625rem 1.25rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    background: transparent;
    border: none;
    position: relative;
  }
  
  .mode-intervention-pill:hover {
    background: rgba(255, 255, 255, 0.6);
  }
  
  .mode-intervention-pill.is-active {
    background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
    color: #ffffff;
    box-shadow: 0 2px 8px rgba(124, 58, 237, 0.25);
  }
  
  .mode-intervention-pill-text {
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    transition: color 0.2s ease;
  }
  
  .mode-intervention-pill.is-active .mode-intervention-pill-text {
    color: #ffffff;
  }
  
  .filter-mode-intervention-hero {
    min-width: 200px;
  }
  
  /* Correctifs supplémentaires pour éviter superposition dropdown */
  .search-filter-form[data-universe="hub"] .filter-input-group.filter-location-hero,
  .search-filter-form[data-universe="projects"] .filter-input-group.filter-location-hero,
  .search-filter-form[data-universe="lessons"] .filter-input-group.filter-location-hero,
  .search-filter-form[data-universe="at-home"] .filter-input-group.filter-location-hero,
  .search-filter-form[data-universe="wellnesslive"] .filter-input-group.filter-location-hero {
    position: relative;
  }
  
  /* Z-index sur les options du select quand ouvert (natif) */
  .search-filter-form[data-universe="hub"] .filter-input-group.filter-location-hero select option,
  .search-filter-form[data-universe="projects"] .filter-input-group.filter-location-hero select option,
  .search-filter-form[data-universe="lessons"] .filter-input-group.filter-location-hero select option,
  .search-filter-form[data-universe="at-home"] .filter-input-group.filter-location-hero select option,
  .search-filter-form[data-universe="wellnesslive"] .filter-input-group.filter-location-hero select option {
    position: relative;
    z-index: 101;
  }
  
  .location-helper-text {
    display: flex;
    align-items: center;
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: #6b7280;
    line-height: 1.4;
  }
  
  .filter-location-hero:has(.home-location-country:disabled),
  .filter-location-hero:has(.home-location-city:disabled) {
    opacity: 0.5;
    pointer-events: none;
  }
  
  @media (max-width: 768px) {
    .mode-intervention-segmented {
      flex-direction: column;
      gap: 0.25rem;
    }
    
    .mode-intervention-pill {
      width: 100%;
    }
  }
  .besoin-mission-card {
    display: flex; align-items: center; justify-content: center;
    padding: 0.625rem 1.25rem; border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.08); background: #fafafa;
    cursor: pointer; transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
  }
  .besoin-mission-card:hover { background: #f5f5f5; border-color: rgba(0,0,0,0.12); }
  .besoin-mission-card.is-active {
    background: rgba(255,255,255,0.95); border-color: rgba(6, 182, 212, 0.45);
    box-shadow: 0 2px 8px rgba(6, 182, 212, 0.12);
  }
  .page-lessons .besoin-mission-card.is-active { border-color: rgba(6, 182, 212, 0.5); }
  .besoin-mission-card-text { font-size: 0.9rem; font-weight: 500; color: #4b5563; }
  .besoin-mission-card.is-active .besoin-mission-card-text { color: #1f2937; }
  .besoin-mission-card input.sr-only { position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);border:0; }

  .besoin-langues-row { display: flex; flex-wrap: wrap; align-items: flex-start; gap: 1rem 1.5rem; }
  .besoin-mother-tongue-wrap { min-width: 180px; max-width: 220px; }
  .besoin-mother-tongue-wrap .filter-select { width: 100%; }
  .besoin-other-langs-wrap { position: relative; flex: 1; min-width: 200px; display: flex; flex-wrap: wrap; align-items: center; gap: 0.4rem 0.6rem; }
  .besoin-other-langs-label { font-size: 0.8rem; color: #6b7280; margin: 0; flex-shrink: 0; }
  .besoin-lang-chips {
    display: inline-flex; flex-wrap: wrap; align-items: center; gap: 0.4rem 0.6rem;
    min-height: 2rem; padding: 0.1rem 0; flex: 1; min-width: 0;
  }
  .besoin-lang-chip {
    display: inline-flex; align-items: center; gap: 0.35rem;
    padding: 0.25rem 0.5rem; border-radius: 10px;
    background: rgba(6, 182, 212, 0.08); border: 1px solid rgba(6, 182, 212, 0.2);
    font-size: 0.8rem; color: #1f2937;
  }
  .besoin-lang-chip-remove { background:none; border:none; padding:0; margin:0; cursor:pointer; color:#9ca3af; font-size:0.9em; line-height:1; }
  .besoin-lang-chip-remove:hover { color: #ef4444; }
  .besoin-add-lang-btn {
    display: inline-flex; align-items: center; padding: 0.25rem 0.5rem; flex-shrink: 0;
    background: none; border: none; color: #6b7280; font-size: 0.85rem; font-weight: 500;
    cursor: pointer; transition: color 0.2s;
  }
  .besoin-add-lang-btn:hover { color: #06B6D4; }

  .cecrl-popover {
    display: none; position: absolute; z-index: 100; top: 100%; left: 0; margin-top: 0.35rem;
    min-width: 320px; max-width: 420px; max-height: 280px; overflow-y: auto;
    background: #fff; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.12), 0 2px 8px rgba(0,0,0,0.06);
    border: 1px solid rgba(0,0,0,0.08);
  }
  .cecrl-popover[aria-expanded="true"], .cecrl-popover:not([hidden]) { display: block; }
  .cecrl-popover[hidden] { display: none !important; }
  .cecrl-popover-inner { padding: 0.75rem 1rem; }
  .cecrl-table-head { display: flex; padding: 0 0 0.5rem; margin-bottom: 0.5rem; border-bottom: 1px solid #eee; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; }
  .cecrl-th-lang { width: 100px; flex-shrink: 0; }
  .cecrl-th-level { flex: 1; }
  .cecrl-row { display: flex; align-items: center; gap: 0.5rem; padding: 0.35rem 0; font-size: 0.85rem; }
  .cecrl-lang { width: 100px; flex-shrink: 0; color: #374151; }
  .cecrl-pills { display: flex; flex-wrap: wrap; gap: 0.25rem; }
  .cecrl-pill {
    padding: 0.2rem 0.45rem; border-radius: 8px; border: 1px solid #e5e7eb;
    background: #fafafa; color: #6b7280; font-size: 0.75rem; font-weight: 500;
    cursor: pointer; transition: background 0.2s, border-color 0.2s, color 0.2s;
  }
  .cecrl-pill:hover { background: #f3f4f6; border-color: #d1d5db; color: #374151; }
  .cecrl-pill.is-selected { background: rgba(6, 182, 212, 0.12); border-color: rgba(6, 182, 212, 0.4); color: #0891B2; }

  /* ---------- Je pose mon besoin — Lessons : Tarif du rituel (slider premium) + Format du rituel (50+10) ---------- */
  .besoin-rituel-row {
    display: flex; flex-wrap: wrap; gap: 1.5rem 2rem; align-items: flex-start;
    min-width: 100%;
  }
  .besoin-rituel-row .besoin-tarif-rituel { min-width: 200px; flex: 1; }
  .besoin-rituel-row .besoin-format-rituel { min-width: 200px; flex: 1; }
  .besoin-format-rituel-value {
    padding: 0.875rem 1.25rem; border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.08); background: #fafafa;
    font-size: 0.95rem; font-weight: 500; color: #374151;
    min-height: 2.75rem; display: flex; align-items: center;
  }
  .besoin-format-rituel-micro {
    font-size: 0.75rem; color: #6b7280; margin: 0.4rem 0 0; line-height: 1.35;
  }

  /* Slider premium Tarif du rituel / h */
  .rituel-price-filter-wrapper {
    margin-top: 0.5rem;
  }
  .rituel-price-slider {
    height: 6px;
    background: #e5e7eb;
    border-radius: 3px;
    margin-bottom: 16px;
    position: relative;
  }
  .rituel-price-slider .ui-slider-handle {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #06B6D4;
    border: 2px solid #fff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    top: -6px;
    outline: none;
  }
  .rituel-price-slider .ui-slider-handle:hover {
    background: #0891B2;
    box-shadow: 0 2px 8px rgba(6, 182, 212, 0.3);
  }
  .rituel-price-slider .ui-slider-range {
    background: linear-gradient(135deg, #06B6D4 0%, #0891B2 50%, #2563EB 80%, #1E40AF 100%);
    border-radius: 3px;
    height: 6px;
  }
  .rituel-price-range-display {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 8px;
  }
  .rituel-price-input {
    width: 70px;
    padding: 6px 10px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
    text-align: center;
    color: #374151;
  }
  .rituel-price-input:focus {
    outline: none;
    border-color: #06B6D4;
    box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
  }
  .rituel-price-separator {
    color: #6b7280;
    font-weight: 500;
  }
  .rituel-price-unit {
    color: #6b7280;
    font-size: 14px;
  }
  .rituel-equivalence-line {
    font-size: 12px;
    color: #9ca3af;
    margin-top: 4px;
    line-height: 1.4;
  }

  @media (max-width: 768px) {
    .besoin-langues-row { flex-direction: column; }
    .besoin-mother-tongue-wrap { max-width: 100%; }
    .besoin-other-langs-wrap { min-width: 100%; }
    .besoin-rituel-row { flex-direction: column; }
  }

  .filters-level-2 {
    padding: 1rem 0;
    margin-bottom: 1.75rem;
    border-bottom: 1px solid rgba(196, 181, 253, 0.12);
    overflow: visible;
  }

  .filters-level-2 .filters-level-inner {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1rem;
    align-items: start;
  }
  @media (min-width: 769px) {
    .filters-level-2 .filters-level-inner {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  .filters-level-3 {
    padding: 0.75rem 0;
    margin-bottom: 1.5rem;
  }

  .filters-level-3 .filters-level-title {
    font-size: 0.9375rem;
    font-weight: 500;
    color: #6b7280;
  }

  .filters-level-3 .filters-level-inner {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
    align-items: end;
  }

  /* Filtre Mes disponibilités : +2 cm (Critères avancés /services/projects) */
  .filters-level-3 .preply-availability-group {
    min-width: calc(200px + 2cm);
    max-width: calc(350px + 8cm);
  }

  .filters-level-3-extra {
    padding: 0.75rem 0;
    margin-bottom: 0;
  }

  .filters-level-3-extra .filter-group {
    margin-bottom: 1rem;
  }

  .filters-level-3-extra .filter-group:last-child {
    margin-bottom: 0;
  }

  @media (max-width: 768px) {
    .filters-level-1 .filters-level-inner {
      flex-direction: column;
    }

    .filters-level-2 .filters-level-inner,
    .filters-level-3 .filters-level-inner {
      grid-template-columns: 1fr;
    }
  }

  /* Mode d'intervention + Type de mission sur la même ligne */
  .filter-row-mode-type {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
    align-items: flex-start;
    margin-bottom: 1.5rem;
  }

  /* Grille Filtres avancés /services/projects (Budget en Rituel + Domaine, etc.) */
  .filter-advanced-content .preply-filters-embedded {
    margin-top: 1.25rem;
  }
  .filter-advanced-content .preply-filters-embedded .preply-filters-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1rem;
    align-items: end;
  }
  .filter-advanced-content .preply-filters-embedded .preply-filters-advanced {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    align-items: end;
  }
  /* Filtre Secteur/Industrie : 3e colonne +2 cm (76px) sur /services/projects */
  [data-universe="projects"] .preply-filters-advanced {
    grid-template-columns: 1fr 1fr minmax(345px, 1fr);
  }
  @media (max-width: 768px) {
    .filter-advanced-content .preply-filters-embedded .preply-filters-row,
    .filter-advanced-content .preply-filters-embedded .preply-filters-advanced {
      grid-template-columns: 1fr;
    }
  }

  .filter-group {
    margin-bottom: 1.5rem;
  }

  .filter-label {
    display: flex;
    align-items: center;
    font-size: 0.95rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
  }

  .filter-checkboxes {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
  }

  .filter-checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    position: relative;
  }

  .filter-checkbox-label input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
  }

  .filter-checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(196, 181, 253, 0.5);
    border-radius: 6px;
    margin-right: 0.5rem;
    transition: all 0.3s ease;
    position: relative;
  }

  .filter-checkbox-label input[type="checkbox"]:checked + .filter-checkbox-custom {
    background: linear-gradient(135deg, #8B5CF6 0%, #2563EB 100%);
    border-color: #7c3aed;
  }

  .filter-checkbox-label input[type="checkbox"]:checked + .filter-checkbox-custom::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 0.75rem;
    font-weight: bold;
  }

  .filter-checkbox-text {
    font-size: 0.95rem;
    color: #374151;
  }

  .filter-select-wrapper {
    position: relative;
  }

  #cityWrapper {
    display: none;
  }

  #cityWrapper.show {
    display: block !important;
  }
  /* Wrapper Ville hero (at-home, wellnesslive, lessons) : toujours visible pour at-home et wellnesslive ; visible quand .show pour lessons (présentiel) */
  [id$="CityWrapper"].show,
  .filter-location-hero[id$="CityWrapper"].show {
    display: block !important;
  }
  /* at-home, wellnesslive, hub : filtre ville toujours affiché (désactivé tant qu'aucun pays) */
  #atHomeCityWrapper,
  #wellnessliveCityWrapper,
  #hubCityWrapper {
    display: block !important;
  }

  /* Domaine (Filtres avancés) : menu s'ouvre vers le bas pour ne pas être coupé */
  .filters-level-2 .domain-dropdown-wrapper,
  .filter-advanced-content .domain-dropdown-wrapper {
    position: relative;
  }
  .filters-level-2 .domain-dropdown-menu,
  .filter-advanced-content .domain-dropdown-menu {
    bottom: auto;
    top: calc(100% + 8px);
    margin-top: 0;
  }
  /* Domaine (Filtres avancés) : trigger + options (at-home, wellnesslive, lessons) */
  .filter-advanced-content .domain-dropdown-wrapper,
  .filters-level-2 .domain-dropdown-wrapper {
    min-width: 200px;
  }
  .filter-advanced-content .domain-dropdown-trigger,
  .filters-level-2 .domain-dropdown-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border, #E5E7EB);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: #fff;
    color: var(--preply-text, #1F2937);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .filter-advanced-content .domain-dropdown-trigger:hover,
  .filters-level-2 .domain-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
  }
  .filter-advanced-content .domain-dropdown-trigger.active,
  .filters-level-2 .domain-dropdown-trigger.active {
    border-color: var(--preply-primary, #8B5CF6);
  }
  .filter-advanced-content .domain-selected-text,
  .filters-level-2 .domain-selected-text { flex: 1; }
  .filter-advanced-content .domain-dropdown-menu,
  .filters-level-2 .domain-dropdown-menu {
    position: absolute;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid var(--preply-border, #E5E7EB);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    z-index: 1001;
    max-height: 320px;
    overflow-y: auto;
    padding: 8px;
  }
  .filter-advanced-content .domain-option,
  .filters-level-2 .domain-option {
    padding: 10px 12px;
    cursor: pointer;
    border-radius: 8px;
    font-size: 0.875rem;
    color: var(--preply-text, #1F2937);
  }
  .filter-advanced-content .domain-option:hover,
  .filters-level-2 .domain-option:hover {
    background: var(--preply-hover, #F9FAFB);
  }
  .filter-advanced-content .domain-option.selected,
  .filters-level-2 .domain-option.selected {
    background: rgba(139, 92, 246, 0.1);
    color: var(--preply-primary, #8B5CF6);
  }
  .filter-advanced-content .domain-option-label,
  .filters-level-2 .domain-option-label { display: block; font-weight: 500; }
  .filter-advanced-content .domain-option-desc,
  .filters-level-2 .domain-option-desc { display: block; font-size: 0.8125rem; color: #6b7280; margin-top: 0.25rem; }

  /* Hero dropdown custom (projects/corporate) : Titre + micro-description */
  .hero-domain-custom-wrapper,
  .filter-hero-domain-select-wrapper:has(.hero-domain-custom-wrapper) { overflow: visible; }
  [data-hero-filter="projects"] .filter-hero-domain-select-wrapper,
  [data-hero-filter="corporate"] .filter-hero-domain-select-wrapper,
  [data-hero-filter="lessons"] .filter-hero-domain-select-wrapper,
  [data-hero-filter="at-home"] .filter-hero-domain-select-wrapper,
  [data-hero-filter="wellnesslive"] .filter-hero-domain-select-wrapper { overflow: visible; }
  .hero-domain-custom-wrapper .hero-domain-trigger.active { border-color: rgba(139, 92, 246, 0.5); box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.1); }
  .hero-domain-menu .hero-domain-option { padding: 10px 16px; cursor: pointer; transition: background 0.2s ease; border: none; border-radius: 0; text-align: left; }
  .hero-domain-menu .hero-domain-option:first-child { border-radius: 12px 12px 0 0; }
  .hero-domain-menu .hero-domain-option:hover { background: var(--preply-hover, #F9FAFB); }
  .hero-domain-menu .hero-domain-option.selected { background: rgba(139, 92, 246, 0.1); color: var(--preply-primary, #8B5CF6); }
  .hero-domain-menu .hero-domain-option .domain-option-label { display: block; font-weight: 600; }
  .hero-domain-menu .hero-domain-option .domain-option-desc { display: block; font-size: 0.8125rem; color: #6b7280; margin-top: 0.25rem; line-height: 1.4; }
  .hero-domain-menu .hero-domain-option.selected .domain-option-desc { color: rgba(139, 92, 246, 0.85); }

  /* Dropdown Univers d'activité (lessons, at-home, wellnesslive) — même rendu premium */
  .sector-filter-container { min-width: 200px; }
  .sector-dropdown-wrapper { position: relative; }
  .sector-dropdown-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border, #E5E7EB);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text, #1F2937);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }
  .sector-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }
  .sector-dropdown-trigger.active {
    border-color: var(--preply-primary, #8B5CF6);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }
  .sector-selected-text { flex: 1; }
  .sector-arrow { font-size: 0.75rem; color: var(--preply-text-light, #6B7280); transition: transform 0.2s; transform: rotate(0deg); }
  .sector-dropdown-trigger.active .sector-arrow { transform: rotate(180deg); }
  .sector-dropdown-menu {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg, #fff);
    border: 1px solid var(--preply-border, #E5E7EB);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1001;
    max-height: 400px;
    overflow-y: auto;
    padding: 8px;
  }
  .sector-search-wrapper { position: relative; margin-bottom: 12px; }
  .sector-search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--preply-text-light, #6B7280); font-size: 0.875rem; pointer-events: none; }
  .sector-search-input {
    width: 100%;
    padding: 10px 12px 10px 36px;
    border: 1px solid var(--preply-border, #E5E7EB);
    border-radius: 8px;
    font-size: 0.875rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text, #1F2937);
    outline: none;
    transition: all 0.2s;
  }
  .sector-search-input:focus { border-color: var(--preply-primary, #8B5CF6); box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1); }
  .sector-list { display: flex; flex-direction: column; gap: 2px; }
  .sector-option {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.2s;
    gap: 12px;
  }
  .sector-option:hover { background-color: var(--preply-hover, #F9FAFB); }
  .sector-option.selected { background-color: rgba(139, 92, 246, 0.1); }
  .sector-name { flex: 1; font-size: 0.875rem; color: var(--preply-text, #1F2937); }
  .sector-option.selected .sector-name { color: var(--preply-primary, #8B5CF6); font-weight: 500; }
  .sector-checkbox {
    width: 18px; height: 18px;
    border: 2px solid var(--preply-border, #E5E7EB);
    border-radius: 4px;
    flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s;
  }
  .sector-option.selected .sector-checkbox { background-color: var(--preply-primary, #8B5CF6); border-color: var(--preply-primary, #8B5CF6); }
  .sector-option.selected .sector-checkbox::after { content: '✓'; color: white; font-size: 12px; font-weight: bold; }
  .sector-no-results { padding: 16px; text-align: center; color: var(--preply-text-light, #6B7280); font-size: 0.875rem; }
  .sector-all-section { margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--preply-border, #E5E7EB); }
  .sector-reset-option {
    margin-top: 12px;
    padding: 10px 12px;
    border-radius: 8px;
    background: rgba(139, 92, 246, 0.06);
    border: 1px solid rgba(139, 92, 246, 0.15);
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--preply-primary, #8B5CF6);
    cursor: pointer;
    text-align: center;
    transition: background-color 0.2s;
  }
  .sector-reset-option:hover { background: rgba(139, 92, 246, 0.1); }

  .filter-select {
    width: 100%;
    padding: 0.875rem 1.25rem;
    border: 2px solid rgba(196, 181, 253, 0.3);
    border-radius: 12px;
    font-size: 0.95rem;
    background: #ffffff;
    color: #1a202c;
    cursor: pointer;
    transition: all 0.3s ease;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%237c3aed' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    padding-right: 3rem;
  }

  .filter-select:focus {
    outline: none;
    border-color: #7c3aed;
    box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
  }

  .filter-budget-range {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .filter-input-small {
    flex: 1;
    padding: 0.875rem 1.25rem;
    border: 2px solid rgba(196, 181, 253, 0.3);
    border-radius: 12px;
    font-size: 0.95rem;
    background: #ffffff;
    transition: all 0.3s ease;
  }

  .filter-input-small:focus {
    outline: none;
    border-color: #7c3aed;
    box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
  }

  .filter-budget-separator {
    color: #6b7280;
    font-weight: 600;
  }

  /* CTA Déposer un projet */
  .submit-project-cta {
    text-align: center;
    padding: 3rem 2rem;
  }

  .submit-project-content {
    max-width: 600px;
    margin: 0 auto;
  }

  .submit-project-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 1rem;
  }

  .submit-project-text {
    font-size: 1.1rem;
    color: #6b7280;
    margin-bottom: 2rem;
    line-height: 1.6;
  }

  .submit-project-btn {
    display: inline-flex;
    align-items: center;
    padding: 1rem 2.5rem;
    background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%);
    color: #ffffff;
    text-decoration: none;
    border-radius: 16px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .submit-project-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(124, 58, 237, 0.4);
  }

  /* Responsive */
  @media (max-width: 768px) {
    .home-search-filter-section {
      margin: -40px 1rem 3rem;
      padding: 1.5rem;
      border-radius: 24px;
    }

    .filter-row-main {
      grid-template-columns: 1fr;
      gap: 1rem;
    }

    .filter-submit-btn {
      width: 100%;
      justify-content: center;
    }

    .filter-checkboxes {
      flex-direction: column;
      gap: 0.75rem;
    }

    .filter-tabs {
      flex-direction: column;
      gap: 0.5rem;
    }

    .filter-tab {
      width: 100%;
      justify-content: center;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('{{ $formId }}');
    
    // Données des villes par pays (tous les pays du select hero)
    const citiesByCountry = {
      'FR': ['Paris', 'Lyon', 'Marseille', 'Bordeaux', 'Nantes', 'Lille', 'Strasbourg', 'Rennes', 'Montpellier', 'Toulouse', 'Nice'],
      'GP': ['Pointe-à-Pitre', 'Les Abymes', 'Baie-Mahault', 'Le Gosier', 'Sainte-Anne'],
      'MQ': ['Fort-de-France', 'Le Lamentin', 'Sainte-Marie', 'Schoelcher', 'Ducos'],
      'GF': ['Cayenne', 'Kourou', 'Saint-Laurent-du-Maroni', 'Matoury', 'Remire-Montjoly'],
      'RE': ['Saint-Denis', 'Saint-Paul', 'Saint-Pierre', 'Le Tampon', 'Saint-André', 'Saint-Louis', 'Le Port'],
      'NC': ['Nouméa', 'Mont-Dore', 'Dumbéa', 'Païta', 'Le Mont-Dore'],
      'PF': ['Papeete', 'Pirae', 'Mahina', 'Punaauia', 'Arue'],
      'BE': ['Bruxelles', 'Anvers', 'Liège'],
      'CH': ['Zurich', 'Genève', 'Bâle'],
      'ES': ['Madrid', 'Barcelone', 'Valence', 'Séville', 'Ibiza'],
      'DE': ['Berlin', 'Munich', 'Hambourg'],
      'IT': ['Rome', 'Milan', 'Turin', 'Palerme', 'Toscane', 'Florence', 'Naples'],
      'PT': ['Lisbonne', 'Porto', 'Coimbra', 'Faro'],
      'NL': ['Amsterdam', 'Rotterdam', 'La Haye'],
      'GB': ['Londres', 'Manchester', 'Birmingham', 'Brighton', 'Édimbourg'],
      'CA': ['Toronto', 'Montréal', 'Vancouver'],
      'US': ['New York', 'Los Angeles', 'Chicago', 'San Francisco', 'Miami'],
      'MT': ['Valetta', 'Sliema', 'Saint Julien', 'Msida', 'Gzira', 'Ta\'Xbiex', 'Pieta'],
      'MC': ['Monte-Carlo', 'La Condamine', 'Fontvieille'],
      'LU': ['Luxembourg-Ville', 'Esch-sur-Alzette', 'Differdange'],
      'MA': ['Casablanca', 'Rabat', 'Tanger', 'Marrakech', 'Fès'],
      'TN': ['Tunis', 'Sfax', 'Sousse', 'Nabeul', 'Bizerte'],
      'SN': ['Dakar', 'Thiès', 'Saint-Louis', 'Rufisque', 'Mbour'],
      'CI': ['Abidjan', 'Yamoussoukro', 'Bouaké', 'San-Pédro'],
      'IE': ['Dublin', 'Cork', 'Galway', 'Limerick', 'Waterford'],
      'HR': ['Zagreb', 'Split', 'Dubrovnik', 'Rijeka', 'Zadar']
    };
    
    // Gestion des onglets
    const tabs = document.querySelectorAll('.filter-tab');
    const contents = document.querySelectorAll('.filter-content');

    tabs.forEach(tab => {
      tab.addEventListener('click', function() {
        const targetTab = this.getAttribute('data-tab');
        
        // Désactiver tous les onglets
        tabs.forEach(t => t.classList.remove('active'));
        contents.forEach(c => {
          c.classList.remove('active');
          c.style.display = 'none';
        });
        
        // Activer l'onglet cliqué
        this.classList.add('active');
        const targetContent = document.getElementById('content' + targetTab.charAt(0).toUpperCase() + targetTab.slice(1));
        if (targetContent) {
          targetContent.classList.add('active');
          targetContent.style.display = 'block';
        }
      });
    });

    // Toggle filtres avancés
    const toggleBtn = document.getElementById('toggleAdvancedFilters');
    const advancedFilters = document.getElementById('advancedFilters');
    const chevronIcon = document.getElementById('chevronIcon');

    if (toggleBtn && advancedFilters) {
      toggleBtn.addEventListener('click', function() {
        const isVisible = advancedFilters.style.display !== 'none';
        advancedFilters.style.display = isVisible ? 'none' : 'block';
        if (chevronIcon) {
          chevronIcon.style.transform = isVisible ? 'rotate(0deg)' : 'rotate(180deg)';
        }
      });
    }

    // Cascade Pays → Ville (at-home, wellnesslive, lessons) — attribut + secours par ID
    (function initCountryCityCascade() {
      var placeholderCity = 'Sélectionner une ville';
      var noCityLabel = 'Aucune ville disponible';
      var cascadeCountryId = '{{ $locationCountryId }}';
      var cascadeCityId = '{{ $locationCityId }}';

      function refreshCitySelectUI(citySelect) {
        if (!citySelect) return;
        citySelect.disabled = false;
        try {
          if (typeof window.jQuery !== 'undefined') {
            var $el = window.jQuery(citySelect);
            if ($el.data('select2')) $el.trigger('change.select2');
            else if ($el.next && $el.next().hasClass && $el.next().hasClass('nice-select')) $el.niceSelect('update');
          }
          citySelect.dispatchEvent(new Event('change', { bubbles: true }));
        } catch (e) {}
      }

      function bindCascade(countrySelect, citySelect, formForCascade) {
        if (!countrySelect || !citySelect || countrySelect._cityCascadeBound) return false;
        var cityWrapper = citySelect.closest('.filter-input-group');
        var modeCheckboxes = formForCascade ? formForCascade.querySelectorAll('input[name="mode[]"]') : [];

        function updateCities() {
          if (!countrySelect || !citySelect) return;
          var country = countrySelect.value;
          citySelect.innerHTML = '<option value="">' + placeholderCity + '</option>';
          citySelect.value = '';
          citySelect.disabled = true;
          var showCities = (modeCheckboxes.length === 0) || Array.prototype.some.call(modeCheckboxes, function(cb) { return cb && cb.value === 'onsite' && cb.checked; });

          if (!country) {
            if (cityWrapper) cityWrapper.classList.remove('show');
            return;
          }
          if (!showCities) {
            if (cityWrapper) cityWrapper.classList.remove('show');
            return;
          }
          if (cityWrapper) cityWrapper.classList.add('show');
          if (citiesByCountry[country] && citiesByCountry[country].length > 0) {
            var cities = citiesByCountry[country];
            for (var i = 0; i < cities.length; i++) {
              var opt = document.createElement('option');
              opt.value = cities[i];
              opt.textContent = cities[i];
              citySelect.appendChild(opt);
            }
            citySelect.disabled = false;
            var formRef = formForCascade || citySelect.form;
            var initialCity = formRef && formRef.getAttribute('data-initial-city');
            if (initialCity && cities.indexOf(initialCity) !== -1) {
              citySelect.value = initialCity;
              if (formRef) formRef.removeAttribute('data-initial-city');
            }
            refreshCitySelectUI(citySelect);
            if (typeof window.location !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === 'localhost')) {
              try { console.debug('[filters] cities loaded', cities.length); } catch (e) {}
            }
          } else {
            var emptyOpt = document.createElement('option');
            emptyOpt.value = '';
            emptyOpt.textContent = noCityLabel;
            citySelect.appendChild(emptyOpt);
          }
        }

        countrySelect._cityCascadeBound = true;
        countrySelect.addEventListener('change', updateCities);
        for (var j = 0; j < modeCheckboxes.length; j++) {
          if (modeCheckboxes[j] && !modeCheckboxes[j]._cityCascadeBound) {
            modeCheckboxes[j]._cityCascadeBound = true;
            modeCheckboxes[j].addEventListener('change', updateCities);
          }
        }
        updateCities();
        return true;
      }

      function runCascade() {
        var formForCascade = document.querySelector('form[data-has-location-duo="1"]');
        if (!formForCascade) return false;
        if (['at-home', 'wellnesslive', 'projects', 'hub'].indexOf(formForCascade.getAttribute('data-universe')) !== -1) return false;
        var heroRow = formForCascade.querySelector('.filter-row-main--has-location-duo') || formForCascade.querySelector('.filter-row-main');
        if (!heroRow) return false;
        var countrySelect = heroRow.querySelector('select[name="country"]');
        var citySelect = heroRow.querySelector('select[name="city"]');
        if (!countrySelect || !citySelect) return false;
        return bindCascade(countrySelect, citySelect, formForCascade);
      }

      function runCascadeByIds() {
        if (!cascadeCountryId || !cascadeCityId) return false;
        if (cascadeCountryId === 'atHomeFilterCountry' || cascadeCountryId === 'wellnessliveFilterCountry' || cascadeCountryId === 'projectsFilterCountry' || cascadeCountryId === 'hubFilterCountry') return false;
        var countrySelect = document.getElementById(cascadeCountryId);
        var citySelect = document.getElementById(cascadeCityId);
        if (!countrySelect || !citySelect) return false;
        var formForCascade = countrySelect.form || document.querySelector('form[data-has-location-duo="1"]');
        return bindCascade(countrySelect, citySelect, formForCascade);
      }

      function tryInit() {
        if (runCascade()) return true;
        return runCascadeByIds();
      }

      tryInit();
      setTimeout(function() { tryInit(); }, 100);
      setTimeout(function() { tryInit(); }, 300);
      setTimeout(function() { tryInit(); }, 500);
      setTimeout(function() { tryInit(); }, 800);
    })();

    // Afficher/masquer le budget selon les univers sélectionnés (ou data-universe quand lock)
    const universeCheckboxes = document.querySelectorAll('input[name="universe[]"]');
    const budgetGroup = document.getElementById('budgetGroup');
    
    function updateBudgetVisibility() {
      let show = false;
      const lockUniverse = form && form.dataset.universe;
      if (lockUniverse && (lockUniverse === 'projects' || lockUniverse === 'lessons' || lockUniverse === 'corporate')) {
        show = true;
      } else {
        const selectedUniverses = Array.from(universeCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
        show = selectedUniverses.includes('projects') || selectedUniverses.includes('lessons') || selectedUniverses.includes('corporate');
      }
      if (budgetGroup) budgetGroup.style.display = show ? 'block' : 'none';
    }
    
    if (universeCheckboxes.length > 0) {
      universeCheckboxes.forEach(cb => cb.addEventListener('change', updateBudgetVisibility));
    }
    updateBudgetVisibility();

    // Dropdown Univers d'activité (lessons, at-home, wellnesslive, projects) — même logique que Lessons
    (function initSectorDropdown() {
      var sectorTrigger = document.getElementById('sectorDropdownTrigger');
      var sectorMenu = document.getElementById('sectorDropdownMenu');
      var sectorSelectedText = document.getElementById('sectorSelectedText');
      var sectorInput = document.getElementById('sectorInput');
      var sectorSearchInput = document.getElementById('sectorSearchInput');
      var sectorPopularList = document.getElementById('sectorPopularList');
      var sectorAllList = document.getElementById('sectorAllList');
      var sectorAllSection = document.getElementById('sectorAllSection');
      var sectorNoResults = document.getElementById('sectorNoResults');
      if (!sectorTrigger || !sectorMenu || !sectorSelectedText || !sectorInput) return;
      var sectorsData = [
        { code: 'business_strategie', name: 'Business & Stratégie' },
        { code: 'tech_digital', name: 'Tech & Digital' },
        { code: 'marketing_marques_croissance', name: 'Marketing, Marques & Croissance' },
        { code: 'sante_bien_etre', name: 'Santé & Bien-être' },
        { code: 'impact_culture_societe', name: 'Impact, Culture & Société' },
        { code: 'formation_transmission', name: 'Formation & Transmission' },
      ];
      var selectedSectorCode = sectorInput.value || '';
      var searchDebounceTimer = null;
      function updateSelectedText() {
        sectorSelectedText.textContent = selectedSectorCode ? (sectorsData.find(function(s){ return s.code === selectedSectorCode; }) || {}).name || 'Tous les univers d\'activité' : 'Tous les univers d\'activité';
      }
      function createSectorOption(sector) {
        var option = document.createElement('div');
        option.className = 'sector-option';
        option.setAttribute('data-code', sector.code);
        if (selectedSectorCode === sector.code) option.classList.add('selected');
        option.innerHTML = '<span class="sector-name">' + sector.name + '</span><span class="sector-checkbox"></span>';
        option.addEventListener('click', function(e) { e.stopPropagation(); selectSector(sector.code); });
        return option;
      }
      function renderPopularSectors() {
        if (!sectorPopularList) return;
        sectorPopularList.innerHTML = '';
        sectorsData.forEach(function(s) { sectorPopularList.appendChild(createSectorOption(s)); });
      }
      function renderFilteredSectors(searchTerm) {
        if (!sectorAllList) return;
        var q = (searchTerm || '').toLowerCase().trim();
        var filtered = q === '' ? [] : sectorsData.filter(function(s){ return s.name.toLowerCase().indexOf(q) >= 0; });
        sectorAllSection.style.display = filtered.length ? 'block' : 'none';
        sectorNoResults.style.display = filtered.length ? 'none' : 'block';
        var pop = document.querySelector('.sector-popular-section');
        if (pop) pop.style.display = q ? 'none' : 'block';
        sectorAllList.innerHTML = '';
        filtered.forEach(function(s) { sectorAllList.appendChild(createSectorOption(s)); });
      }
      function selectSector(code) {
        selectedSectorCode = code;
        sectorInput.value = code;
        updateSelectedText();
        var allOpts = sectorMenu.querySelectorAll('.sector-option');
        for (var i = 0; i < allOpts.length; i++) {
          var o = allOpts[i];
          o.classList.toggle('selected', o.getAttribute('data-code') === selectedSectorCode);
        }
        sectorMenu.style.display = 'none';
        sectorTrigger.classList.remove('active');
        if (sectorSearchInput) sectorSearchInput.value = '';
        renderFilteredSectors('');
        var pop = document.querySelector('.sector-popular-section');
        if (pop) pop.style.display = 'block';
        if (typeof applyFiltersAjax === 'function') applyFiltersAjax({ sector: code });
        else if (form) form.submit();
      }
      function openDropdown() {
        sectorMenu.style.display = 'block';
        sectorTrigger.classList.add('active');
        var pop = document.querySelector('.sector-popular-section');
        if (pop) pop.style.display = 'block';
        setTimeout(function(){ if (sectorSearchInput) sectorSearchInput.focus(); }, 100);
      }
      function closeDropdown() {
        sectorMenu.style.display = 'none';
        sectorTrigger.classList.remove('active');
        if (sectorSearchInput) sectorSearchInput.value = '';
        renderFilteredSectors('');
        var pop = document.querySelector('.sector-popular-section');
        if (pop) pop.style.display = 'block';
      }
      renderPopularSectors();
      updateSelectedText();
      var allOpts = sectorMenu.querySelectorAll('.sector-option');
      for (var i = 0; i < allOpts.length; i++) {
        var o = allOpts[i];
        o.classList.toggle('selected', o.getAttribute('data-code') === selectedSectorCode);
      }
      var sectorResetOpt = document.getElementById('sectorResetOption');
      if (sectorResetOpt) {
        sectorResetOpt.addEventListener('click', function(e) { e.stopPropagation(); selectSector(''); });
        sectorResetOpt.addEventListener('keydown', function(e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); selectSector(''); } });
      }
      sectorTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        if (sectorMenu.style.display === 'none' || !sectorMenu.style.display) openDropdown(); else closeDropdown();
      });
      if (sectorSearchInput) {
        sectorSearchInput.addEventListener('input', function(e) {
          var v = e.target.value;
          if (searchDebounceTimer) clearTimeout(searchDebounceTimer);
          searchDebounceTimer = setTimeout(function(){ renderFilteredSectors(v); }, 150);
        });
      }
      document.addEventListener('click', function(e) {
        if (!sectorTrigger.contains(e.target) && !sectorMenu.contains(e.target)) closeDropdown();
      });
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sectorMenu.style.display === 'block') closeDropdown();
      });
      var urlParams = new URLSearchParams(window.location.search);
      var urlSector = urlParams.get('sector');
      if (urlSector && urlSector !== selectedSectorCode) {
        selectedSectorCode = urlSector;
        sectorInput.value = urlSector;
        updateSelectedText();
        var opts = sectorMenu.querySelectorAll('.sector-option');
        for (var j = 0; j < opts.length; j++) opts[j].classList.toggle('selected', opts[j].getAttribute('data-code') === urlSector);
      }
    })();

    // Cascade Domaine → Spécialisation (lessons, at-home, wellnesslive) — même logique que Lessons
    (function initDomainSpecialization() {
      var domainTrigger = document.getElementById('domainDropdownTrigger');
      var domainMenu = document.getElementById('domainDropdownMenu');
      var domainArrow = document.getElementById('domainArrow');
      if (!domainTrigger || !domainMenu) return;
      domainTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        var isOpen = domainMenu.style.display === 'block';
        domainMenu.style.display = isOpen ? 'none' : 'block';
        domainTrigger.classList.toggle('active', !isOpen);
        if (domainArrow) domainArrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
      });
      document.addEventListener('click', function(e) {
        if (!domainMenu.contains(e.target) && !domainTrigger.contains(e.target)) {
          domainMenu.style.display = 'none';
          domainTrigger.classList.remove('active');
          if (domainArrow) domainArrow.style.transform = 'rotate(0deg)';
        }
      });
      var allDomainsOption = document.querySelector('.domain-option[data-value=""]');
      if (allDomainsOption) {
        allDomainsOption.addEventListener('click', function(e) {
          e.stopPropagation();
          var domainInput = document.getElementById('domainInput');
          var domainSelectedText = document.getElementById('domainSelectedText');
          if (domainInput) domainInput.value = '';
          if (domainSelectedText) domainSelectedText.textContent = 'Tous les domaines';
          var d = document.getElementById('domainPremiumDesc');
          if (d) d.style.display = 'none';
          var w = document.getElementById('specializationFilterWrapper');
          var s = document.getElementById('specializationSelect');
          if (w) w.style.display = 'none';
          if (s) { s.value = ''; s.innerHTML = '<option value="">Spécialisation</option>'; }
          document.querySelectorAll('.domain-option').forEach(function(opt) { opt.classList.remove('selected'); });
          allDomainsOption.classList.add('selected');
          domainMenu.style.display = 'none';
          domainTrigger.classList.remove('active');
          if (domainArrow) domainArrow.style.transform = 'rotate(0deg)';
          if (typeof applyFiltersAjax === 'function') applyFiltersAjax({ category: '' });
          else if (form) form.submit();
        });
      }
      document.querySelectorAll('.domain-dropdown-menu .domain-option[data-value]').forEach(function(opt) {
        if (opt.getAttribute('data-value') === '') return;
        opt.addEventListener('click', function(e) {
          e.stopPropagation();
          var value = opt.getAttribute('data-value');
          var labelEl = opt.querySelector('.domain-option-label') || opt.querySelector('span');
          var text = labelEl ? labelEl.textContent.trim() : value;
          var domainInput = document.getElementById('domainInput');
          var domainSelectedText = document.getElementById('domainSelectedText');
          if (domainInput) domainInput.value = value;
          if (domainSelectedText) domainSelectedText.textContent = text;
          document.querySelectorAll('.domain-option').forEach(function(o) { o.classList.remove('selected'); });
          opt.classList.add('selected');
          domainMenu.style.display = 'none';
          domainTrigger.classList.remove('active');
          if (domainArrow) domainArrow.style.transform = 'rotate(0deg)';
          var d = document.getElementById('domainPremiumDesc');
          var txt = document.getElementById('domainPremiumDescText');
          var map = window.__domainLongDescriptions;
          if (d && txt && map && map[value]) { txt.textContent = map[value]; d.style.display = 'block'; } else if (d) d.style.display = 'none';
          var spMap = window.__domainSpecializations;
          var opts = (spMap && spMap[value]) ? spMap[value] : [];
          var w = document.getElementById('specializationFilterWrapper');
          var s = document.getElementById('specializationSelect');
          if (w && s) {
            if (opts.length) {
              w.style.display = '';
              s.innerHTML = '<option value="">Spécialisation</option>';
              opts.forEach(function(o) { var optEl = document.createElement('option'); optEl.value = o[0]; optEl.textContent = o[1]; s.appendChild(optEl); });
              s.value = '';
            } else {
              w.style.display = 'none';
              s.value = '';
              s.innerHTML = '<option value="">Spécialisation</option>';
            }
          }
          if (typeof applyFiltersAjax === 'function') applyFiltersAjax({ category: value });
          else if (form) form.submit();
        });
      });
      var currentDomain = document.getElementById('domainInput') ? document.getElementById('domainInput').value : '';
      if (currentDomain) {
        var selectedOption = document.querySelector('.domain-option[data-value="' + currentDomain + '"]');
        if (selectedOption) {
          selectedOption.classList.add('selected');
          var labelEl = selectedOption.querySelector('.domain-option-label');
          var selectedText = labelEl ? labelEl.textContent.trim() : (selectedOption.querySelector('span') ? selectedOption.querySelector('span').textContent.trim() : '');
          var domainSelectedText = document.getElementById('domainSelectedText');
          if (selectedText && domainSelectedText) domainSelectedText.textContent = selectedText;
        }
      }
      var d = document.getElementById('domainPremiumDesc');
      var map = window.__domainLongDescriptions;
      if (d && map && currentDomain && map[currentDomain]) {
        var txt = document.getElementById('domainPremiumDescText');
        if (txt) txt.textContent = map[currentDomain];
        d.style.display = 'block';
      } else if (d) d.style.display = 'none';
      var spMap = window.__domainSpecializations;
      var opts = (spMap && spMap[currentDomain]) ? spMap[currentDomain] : [];
      var w = document.getElementById('specializationFilterWrapper');
      var s = document.getElementById('specializationSelect');
      if (w && s && opts.length) {
        w.style.display = '';
        s.innerHTML = '<option value="">Spécialisation</option>';
        opts.forEach(function(o) { var optEl = document.createElement('option'); optEl.value = o[0]; optEl.textContent = o[1]; s.appendChild(optEl); });
        var init = w.getAttribute('data-initial-specialization') || '';
        s.value = (init && opts.some(function(o){ return o[0] === init; })) ? init : '';
      } else if (w) w.style.display = 'none';
      var specSel = document.getElementById('specializationSelect');
      if (specSel) {
        specSel.addEventListener('change', function() {
          if (typeof applyFiltersAjax === 'function') applyFiltersAjax({ specialization: this.value });
          else if (form) form.submit();
        });
      }
    })();

    // Mapping des mots-clés vers les univers (pour détection automatique)
    const universeKeywords = {
      'projects': [
        'marketing digital', 'marketing', 'seo', 'référencement', 'publicité', 'réseaux sociaux',
        'développement web', 'développement mobile', 'programmation', 'tech', 'e-commerce', 'api', 'backend', 'devops',
        'graphisme', 'design', 'logo', 'illustration', 'ui/ux', 'ui', 'ux',
        'vidéo', 'animation', 'montage', 'motion design',
        'rédaction', 'traduction', 'copywriting',
        'business', 'conseil stratégique', 'business plan',
        'musique', 'audio', 'mixage', 'mastering',
        'finance', 'comptabilité', 'photographie', 'photo',
        'community manager', 'services ia', 'chatbots', 'ia', 'data', 'big data'
      ],
      'lessons': [
        'anglais', 'français', 'espagnol', 'allemand', 'italien', 'portugais', 'arabe', 'russe', 'chinois', 'japonais', 'coréen',
        'ielts', 'toefl', 'toeic', 'cambridge', 'delf', 'dalf',
        'mathématiques', 'maths', 'physique', 'chimie', 'biologie', 'histoire', 'géographie',
        'soutien scolaire', 'aide aux devoirs', 'économie', 'statistiques', 'droit',
        'bureautique', 'excel', 'word', 'communication pro', 'cv', 'linkedin'
      ],
      'at-home': [
        'beauté', 'massage', 'relaxation', 'ménage', 'repassage',
        'coaching sportif', 'bien-être', 'amma assis', 'do-in'
      ],
      'wellnesslive': [
        'pilates', 'yoga', 'bodybalance', 'bodysculpt', 'bodycombat', 'bodyattack',
        'boxing', 'cross training', 'hiit', 'cardio', 'zumba',
        'stretching', 'gym soft', 'qi gong', 'tai chi'
      ],
      'corporate': [
        'bien-être en entreprise', 'entreprise', 'corporate', 'séances', 'conférences', 'ateliers'
      ],
      'homeswap': [
        'échanges de logement', 'homeswap', 'logement', 'chambre', 'appartement', 'maison'
      ]
    };

    // Fonction pour détecter l'univers à partir d'un mot-clé
    function detectUniverseFromKeyword(keyword) {
      if (!keyword || keyword.trim() === '') return null;
      
      const normalizedKeyword = keyword.toLowerCase().trim();
      let bestMatch = null;
      let bestScore = 0;
      
      for (const [universe, keywords] of Object.entries(universeKeywords)) {
        for (const mappedKeyword of keywords) {
          // Correspondance exacte
          if (normalizedKeyword === mappedKeyword.toLowerCase()) {
            return { universe: universe, confidence: 100 };
          }
          // Correspondance partielle
          if (normalizedKeyword.includes(mappedKeyword.toLowerCase()) || 
              mappedKeyword.toLowerCase().includes(normalizedKeyword)) {
            const score = 80; // Score pour correspondance partielle
            if (score > bestScore) {
              bestScore = score;
              bestMatch = universe;
            }
          }
        }
      }
      
      return bestMatch ? { universe: bestMatch, confidence: bestScore } : null;
    }

    // Mapping des univers vers leurs routes
    const universeRoutes = {
      'projects': '{{ route("services.projects") }}',
      'lessons': '{{ route("services.lessons") }}',
      'at-home': '{{ route("services.at-home") }}',
      'wellnesslive': '{{ route("services.wellnesslive") }}',
      'corporate': '{{ route("services.corporate") }}',
      'homeswap': '{{ route("services.homeswap") }}'
    };

    // Gestion de la soumission du formulaire avec redirection intelligente
    if (form) {
      form.addEventListener('submit', function(e) {
        // Hub /services : soumission GET native (universe + specialization + country + city) pour que le serveur redirige
        if (form.dataset.universe === 'hub') return;
        e.preventDefault();
        
        // Construire l'URL avec les paramètres
        const formData = new FormData(form);
        const params = new URLSearchParams();
        
        // Collecter les valeurs des checkboxes (tableaux)
        const universeValues = [];
        const modeValues = [];
        
        universeCheckboxes.forEach(cb => {
          if (cb.checked) {
            universeValues.push(cb.value);
          }
        });
        
        modeCheckboxes.forEach(cb => {
          if (cb.checked) {
            modeValues.push(cb.value);
          }
        });
        
        // Détection automatique d'univers si aucun n'est coché
        let targetUniverse = null;
        if (universeValues.length === 0) {
          const searchKeyword = formData.get('search');
          if (searchKeyword && searchKeyword.trim()) {
            const detection = detectUniverseFromKeyword(searchKeyword);
            if (detection && detection.confidence >= 80) {
              targetUniverse = detection.universe;
            }
          }
        } else if (universeValues.length === 1) {
          // Si un seul univers est coché, l'utiliser
          targetUniverse = universeValues[0];
        }
        
        // Ajouter les univers (si plusieurs sont cochés ou si détection automatique)
        if (universeValues.length > 1) {
          universeValues.forEach(val => params.append('universe[]', val));
        } else if (targetUniverse && universeValues.length === 0) {
          // Si détection automatique, on redirige directement vers l'univers
          // On n'ajoute pas le paramètre universe[] car on va sur la page spécifique
        } else if (universeValues.length === 1) {
          // Un seul univers coché, on redirige vers sa page spécifique
          targetUniverse = universeValues[0];
        }
        
        // Ajouter les modes
        if (modeValues.length > 0) {
          modeValues.forEach(val => params.append('mode[]', val));
        }
        
        // Ajouter les autres paramètres non vides (search, location, country, city, budget)
        for (const [key, value] of formData.entries()) {
          if (value && value.trim() !== '' && !key.endsWith('[]') && key !== 'universe') {
            params.append(key, value);
          }
        }
        
        // Déterminer la route de destination
        let targetUrl = '{{ route("services") }}'; // Par défaut : page hub
        
        // Si on est sur une page univers (data-lock-route), garder la même route
        if (form.dataset.lockRoute === '1') {
          targetUrl = form.getAttribute('action') || form.action;
        } else if (targetUniverse && universeRoutes[targetUniverse]) {
          // Si un univers unique est détecté ou sélectionné, rediriger vers sa page spécifique
          targetUrl = universeRoutes[targetUniverse];
        } else if (universeValues.length > 1) {
          // Plusieurs univers sélectionnés, rester sur /services
          targetUrl = '{{ route("services") }}';
        }
        
        // Construire l'URL finale
        const finalUrl = targetUrl + (params.toString() ? '?' + params.toString() : '');
        console.log('🔍 Redirection vers:', finalUrl);
        window.location.href = finalUrl;
      });
    }

    // ---------- Je pose mon besoin — Lessons : Slider Tarif du rituel / h (premium) ----------
    function initRituelPriceSlider() {
      const sliderEl = document.getElementById('rituel-price-slider');
      const minInput = document.getElementById('rituel-price-min');
      const maxInput = document.getElementById('rituel-price-max');
      
      if (!sliderEl || !minInput || !maxInput) return;
      
      // Vérifier si jQuery UI est disponible (attendre si nécessaire)
      if (typeof jQuery === 'undefined' || !jQuery.ui || !jQuery.ui.slider) {
        // Réessayer après un court délai si jQuery UI n'est pas encore chargé
        setTimeout(initRituelPriceSlider, 100);
        return;
      }
      
      const minValue = parseInt(minInput.value) || 10;
      const maxValue = parseInt(maxInput.value) || 50;
      
      const slider = jQuery('#rituel-price-slider');
      slider.slider({
        range: true,
        min: 10,
        max: 100,
        values: [Math.max(10, minValue), Math.min(100, maxValue)],
        slide: function(event, ui) {
          minInput.value = ui.values[0];
          maxInput.value = ui.values[1];
        },
        change: function(event, ui) {
          minInput.value = ui.values[0];
          maxInput.value = ui.values[1];
        }
      });
      
      // Synchroniser les inputs avec le slider
      minInput.addEventListener('change', function() {
        const val = Math.max(10, Math.min(parseInt(this.value) || 10, parseInt(maxInput.value) || 50));
        this.value = val;
        const values = slider.slider('values');
        slider.slider('values', [val, values[1]]);
      });
      
      maxInput.addEventListener('change', function() {
        const val = Math.max(parseInt(minInput.value) || 10, Math.min(100, parseInt(this.value) || 50));
        this.value = val;
        const values = slider.slider('values');
        slider.slider('values', [values[0], val]);
      });
      
      // Initialiser les valeurs depuis les inputs
      slider.slider('values', [minValue, maxValue]);
    }
    
    // Initialiser le slider au chargement du DOM
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRituelPriceSlider);
    } else {
      initRituelPriceSlider();
    }

    // ---------- Affichage progressif en 3 niveaux des paliers d'engagement (Projects uniquement) ----------
    function initProgressiveEngagement() {
      const budgetSelect = document.getElementById('budgetFilter');
      
      if (!budgetSelect) {
        setTimeout(initProgressiveEngagement, 100);
        return;
      }
      
      // Récupérer les options progressives par niveau
      const optionLevel1 = budgetSelect.querySelector('option.engagement-level-1'); // 10000-20000
      const optionLevel2 = budgetSelect.querySelector('option.engagement-level-2'); // 20000-60000
      const optionLevel3 = budgetSelect.querySelector('option.engagement-level-3'); // 60000+
      
      // Récupérer les micro-invitations
      const linkLevel1 = document.getElementById('engagementLinkLevel1');
      const linkLevel2 = document.getElementById('engagementLinkLevel2');
      const linkLevel3 = document.getElementById('engagementLinkLevel3');
      const linkReset = document.getElementById('engagementLinkReset');
      
      // Si pas d'options progressives, quitter
      if (!optionLevel1 || !optionLevel2 || !optionLevel3) {
        return;
      }
      
      // Récupérer l'état des niveaux depuis sessionStorage
      const storageKey = 'engagement-progressive-levels';
      let revealedLevels = JSON.parse(sessionStorage.getItem(storageKey) || '[]');
      
      // Vérifier si un palier progressif est sélectionné via URL
      const selectedValue = budgetSelect.value;
      const selectedOption = budgetSelect.querySelector(`option[value="${selectedValue}"]`);
      
      // Déterminer le niveau minimum à révéler si un palier est sélectionné
      if (selectedOption) {
        if (selectedOption.classList.contains('engagement-level-1')) {
          if (!revealedLevels.includes(1)) revealedLevels.push(1);
        } else if (selectedOption.classList.contains('engagement-level-2')) {
          if (!revealedLevels.includes(1)) revealedLevels.push(1);
          if (!revealedLevels.includes(2)) revealedLevels.push(2);
        } else if (selectedOption.classList.contains('engagement-level-3')) {
          if (!revealedLevels.includes(1)) revealedLevels.push(1);
          if (!revealedLevels.includes(2)) revealedLevels.push(2);
          if (!revealedLevels.includes(3)) revealedLevels.push(3);
        }
      }
      
      // Fonction pour révéler un niveau spécifique
      function revealLevel(level, forceUpdate = false) {
        // Vérifier si l'option existe déjà dans le DOM
        let existing = null;
        if (level === 1) {
          existing = budgetSelect.querySelector('option.engagement-level-1');
        } else if (level === 2) {
          existing = budgetSelect.querySelector('option.engagement-level-2');
        } else if (level === 3) {
          existing = budgetSelect.querySelector('option.engagement-level-3');
        }
        
        // Si déjà révélé et l'option existe dans le DOM, ne rien faire (sauf si forceUpdate)
        if (revealedLevels.includes(level) && existing && !forceUpdate) {
          return;
        }
        
        // Ajouter le niveau à la liste si pas déjà présent
        if (!revealedLevels.includes(level)) {
          revealedLevels.push(level);
          revealedLevels.sort((a, b) => a - b); // Trier pour maintenir l'ordre
        }
        
        // Révéler le palier correspondant en clonant à chaque fois
        if (level === 1) {
          // Insérer le palier 5 après le palier 4
          if (!existing) {
            const lastVisibleOption = budgetSelect.querySelector('option[value="5000-10000"]');
            if (lastVisibleOption) {
              const clone = optionLevel1.cloneNode(true);
              lastVisibleOption.insertAdjacentElement('afterend', clone);
            }
          }
          // Masquer la micro-invitation niveau 1, afficher niveau 2
          if (linkLevel1) linkLevel1.style.display = 'none';
          if (linkLevel2) linkLevel2.style.display = 'block';
          // Mettre à jour la visibilité du lien "Revenir à l'essentiel"
          updateResetLinkVisibility();
        } else if (level === 2) {
          // Insérer le palier 6 après le palier 5
          if (!existing) {
            const level1Option = budgetSelect.querySelector('option.engagement-level-1');
            if (level1Option) {
              const clone = optionLevel2.cloneNode(true);
              level1Option.insertAdjacentElement('afterend', clone);
            }
          }
          // Masquer la micro-invitation niveau 2, afficher niveau 3
          if (linkLevel2) linkLevel2.style.display = 'none';
          if (linkLevel3) linkLevel3.style.display = 'block';
          // Mettre à jour la visibilité du lien "Revenir à l'essentiel"
          updateResetLinkVisibility();
        } else if (level === 3) {
          // Insérer le palier 7 après le palier 6
          if (!existing) {
            const level2Option = budgetSelect.querySelector('option.engagement-level-2');
            if (level2Option) {
              const clone = optionLevel3.cloneNode(true);
              level2Option.insertAdjacentElement('afterend', clone);
            }
          }
          // Masquer la micro-invitation niveau 3 (plus rien à révéler)
          if (linkLevel3) linkLevel3.style.display = 'none';
          // Mettre à jour la visibilité du lien "Revenir à l'essentiel"
          updateResetLinkVisibility();
        }
        
        // Sauvegarder l'état
        sessionStorage.setItem(storageKey, JSON.stringify(revealedLevels));
      }
      
      // Fonction pour mettre à jour la visibilité du lien "Revenir à l'essentiel"
      function updateResetLinkVisibility() {
        // Afficher le lien si au moins un palier progressif est visible
        const hasProgressiveVisible = revealedLevels.length > 0;
        if (linkReset) {
          linkReset.style.display = hasProgressiveVisible ? 'block' : 'none';
        }
      }
      
      // Fonction pour revenir aux paliers essentiels
      function resetToEssential() {
        // Vérifier si un palier progressif est actuellement sélectionné
        const currentValue = budgetSelect.value;
        const currentOption = budgetSelect.querySelector(`option[value="${currentValue}"]`);
        const isProgressiveSelected = currentOption && currentOption.classList.contains('engagement-progressive');
        
        // Masquer tous les paliers progressifs (chercher dans le DOM, pas seulement les originaux)
        const allProgressiveOptions = budgetSelect.querySelectorAll('option.engagement-progressive');
        allProgressiveOptions.forEach(opt => {
          if (opt && opt.parentNode) {
            opt.remove();
          }
        });
        
        // Réinitialiser la sélection si un palier progressif était sélectionné
        if (isProgressiveSelected) {
          budgetSelect.value = ''; // "Tous les engagements"
          // Mettre à jour l'URL sans recharger
          const url = new URL(window.location);
          url.searchParams.delete('price_range');
          window.history.replaceState({}, '', url);
        }
        
        // Réinitialiser l'état des niveaux révélés
        revealedLevels = [];
        sessionStorage.setItem(storageKey, JSON.stringify(revealedLevels));
        
        // Masquer toutes les micro-invitations avancées
        [linkLevel1, linkLevel2, linkLevel3].forEach(link => {
          if (link) link.style.display = 'none';
        });
        
        // Masquer le lien "Revenir à l'essentiel"
        if (linkReset) linkReset.style.display = 'none';
        
        // Réafficher la première micro-invitation (niveau 1)
        if (linkLevel1) linkLevel1.style.display = 'block';
      }
      
      // Fonction pour initialiser l'affichage selon les niveaux révélés
      function initializeDisplay() {
        // Masquer toutes les options progressives par défaut
        [optionLevel1, optionLevel2, optionLevel3].forEach(opt => {
          if (opt && opt.parentNode) {
            opt.remove();
          }
        });
        
        // Masquer toutes les micro-invitations par défaut
        [linkLevel1, linkLevel2, linkLevel3].forEach(link => {
          if (link) link.style.display = 'none';
        });
        
        // Révéler les niveaux déjà débloqués (en utilisant revealLevel pour la cohérence)
        // On révèle dans l'ordre (1, puis 2, puis 3) pour que les dépendances soient respectées
        const sortedLevels = [...revealedLevels].sort((a, b) => a - b);
        sortedLevels.forEach(level => {
          revealLevel(level);
        });
        
        // Afficher la micro-invitation appropriée selon l'état final
        if (revealedLevels.length === 0) {
          // Aucun niveau révélé : afficher le lien niveau 1
          if (linkLevel1) linkLevel1.style.display = 'block';
        } else if (revealedLevels.includes(1) && !revealedLevels.includes(2)) {
          // Niveau 1 révélé mais pas niveau 2 : afficher le lien niveau 2
          if (linkLevel2) linkLevel2.style.display = 'block';
        } else if (revealedLevels.includes(2) && !revealedLevels.includes(3)) {
          // Niveau 2 révélé mais pas niveau 3 : afficher le lien niveau 3
          if (linkLevel3) linkLevel3.style.display = 'block';
        }
        // Si le niveau 3 est révélé, aucun lien n'est affiché (déjà géré dans revealLevel)
        
        // Mettre à jour la visibilité du lien "Revenir à l'essentiel"
        updateResetLinkVisibility();
      }
      
      // Gérer les clics sur les micro-invitations
      if (linkLevel1) {
        linkLevel1.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          revealLevel(1);
        });
      }
      
      if (linkLevel2) {
        linkLevel2.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          revealLevel(2);
        });
      }
      
      if (linkLevel3) {
        linkLevel3.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          revealLevel(3);
        });
      }
      
      // Gérer le clic sur "Revenir à l'essentiel"
      if (linkReset) {
        linkReset.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          resetToEssential();
        });
      }
      
      // Gérer les sélections via URL : si un palier progressif est sélectionné mais pas encore révélé
      budgetSelect.addEventListener('change', function() {
        const newValue = this.value;
        const newOption = this.querySelector(`option[value="${newValue}"]`);
        
        if (newOption) {
          if (newOption.classList.contains('engagement-level-1') && !revealedLevels.includes(1)) {
            revealLevel(1);
          } else if (newOption.classList.contains('engagement-level-2') && !revealedLevels.includes(2)) {
            revealLevel(1);
            revealLevel(2);
          } else if (newOption.classList.contains('engagement-level-3') && !revealedLevels.includes(3)) {
            revealLevel(1);
            revealLevel(2);
            revealLevel(3);
          }
        }
        
        // Mettre à jour la visibilité du lien "Revenir à l'essentiel" après changement
        updateResetLinkVisibility();
      });
      
      // Gérer le cas où un palier progressif est sélectionné via URL au chargement
      // Cette vérification se fait après initializeDisplay() pour éviter les options fantômes
      // Si un palier progressif est dans l'URL mais pas encore révélé, on le révèle automatiquement
      // (cela a déjà été fait plus haut dans le code avec revealedLevels)
      // Mais si pour une raison quelconque il n'est toujours pas révélé après initializeDisplay,
      // on réinitialise proprement
      setTimeout(() => {
        const currentSelected = budgetSelect.value;
        if (currentSelected) {
          const currentOption = budgetSelect.querySelector(`option[value="${currentSelected}"]`);
          if (currentOption && currentOption.classList.contains('engagement-progressive')) {
            // Vérifier si l'option est toujours dans le DOM (révélée)
            const isInDOM = Array.from(budgetSelect.options).some(opt => opt.value === currentSelected);
            if (!isInDOM) {
              // Option fantôme : réinitialiser vers "Tous les engagements"
              budgetSelect.value = '';
              // Mettre à jour l'URL sans recharger
              const url = new URL(window.location);
              url.searchParams.delete('price_range');
              window.history.replaceState({}, '', url);
            }
          }
        }
      }, 50);
      
      // Initialiser l'affichage
      initializeDisplay();
    }
    
    // Initialiser quand le DOM est prêt (plusieurs méthodes pour robustesse)
    function tryInitProgressiveEngagement() {
      if (document.getElementById('budgetFilter')) {
        initProgressiveEngagement();
      } else {
        // Réessayer après un court délai
        setTimeout(tryInitProgressiveEngagement, 50);
      }
    }
    
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', tryInitProgressiveEngagement);
    } else {
      // DOM déjà chargé, initialiser avec un petit délai pour être sûr
      setTimeout(tryInitProgressiveEngagement, 100);
    }

    // ---------- Je pose mon besoin — Lessons : cartes segmentées (no-op si absent) ----------
    (function initBesoinLessonsCards() {
      const seg = document.querySelector('.besoin-mission-segmented');
      if (!seg) return;
      const cards = document.querySelectorAll('.besoin-mission-card');
      const radios = document.querySelectorAll('.besoin-mission-card input[name="mission_type[]"]');
      function syncMissionCards() {
        cards.forEach(c => c.classList.remove('is-active'));
        const c = document.querySelector('.besoin-mission-card input[name="mission_type[]"]:checked');
        if (c) c.closest('.besoin-mission-card').classList.add('is-active');
      }
      radios.forEach(r => r.addEventListener('change', syncMissionCards));
      syncMissionCards();
    })();

    // ---------- Ma langue maternelle + Autres langues parlées (Lessons ET Corporate) ----------
    (function initBesoinLangues() {
      const chipsEl = document.getElementById('besoin_lang_chips');
      const addBtn = document.getElementById('besoin_add_lang_btn');
      const popover = document.getElementById('cecrl_popover');
      const hiddenInput = document.getElementById('other_languages_input');
      if (!chipsEl || !addBtn || !popover || !hiddenInput) return;

      let otherLangs = [];

      function parseOtherLangs() {
        const s = (hiddenInput.value || '').trim();
        if (!s) return [];
        return s.split(',').filter(Boolean).map(p => {
          const [code, level] = p.split(':');
          const row = document.querySelector('.cecrl-row[data-lang="' + (code||'').replace(/"/g,'\\"') + '"]');
          return { code: (code||'').trim(), label: (row && row.dataset.langLabel) || code, level: (level||'').trim() };
        }).filter(x => x.code && x.level);
      }

      function syncHidden() {
        hiddenInput.value = otherLangs.map(x => x.code + ':' + x.level).join(',');
      }

      function renderChips() {
        chipsEl.innerHTML = '';
        otherLangs.forEach(x => {
          const chip = document.createElement('span');
          chip.className = 'besoin-lang-chip';
          chip.innerHTML = '<span>' + (x.label || x.code) + ' · ' + x.level + '</span> <button type="button" class="besoin-lang-chip-remove" aria-label="Retirer">×</button>';
          chip.querySelector('.besoin-lang-chip-remove').addEventListener('click', function() {
            otherLangs = otherLangs.filter(l => l.code !== x.code);
            renderChips(); syncHidden(); updatePillsSelected();
          });
          chipsEl.appendChild(chip);
        });
      }

      function updatePillsSelected() {
        document.querySelectorAll('.cecrl-pill').forEach(p => p.classList.remove('is-selected'));
        otherLangs.forEach(x => {
          const pill = document.querySelector('.cecrl-row[data-lang="' + x.code + '"] .cecrl-pill[data-level="' + x.level + '"]');
          if (pill) pill.classList.add('is-selected');
        });
      }

      function openPopover() {
        popover.removeAttribute('hidden');
        addBtn.setAttribute('aria-expanded', 'true');
        updatePillsSelected();
      }
      function closePopover() {
        popover.setAttribute('hidden', '');
        addBtn.setAttribute('aria-expanded', 'false');
      }

      addBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const isOpen = !popover.hasAttribute('hidden');
        if (isOpen) closePopover(); else openPopover();
      });

      document.addEventListener('click', function(e) {
        if (!popover || !addBtn) return;
        if (popover.hasAttribute('hidden')) return;
        if (popover.contains(e.target) || addBtn.contains(e.target)) return;
        closePopover();
      });

      document.querySelectorAll('.cecrl-pill').forEach(p => {
        p.addEventListener('click', function() {
          const row = this.closest('.cecrl-row');
          if (!row) return;
          const code = row.dataset.lang || '';
          const label = row.dataset.langLabel || code;
          const level = this.dataset.level || '';
          const i = otherLangs.findIndex(x => x.code === code);
          if (i >= 0) otherLangs[i].level = level; else otherLangs.push({ code, label, level });
          renderChips(); syncHidden(); updatePillsSelected();
        });
      });

      otherLangs = parseOtherLangs();
      renderChips();
      syncHidden();
    })();

    // Initialiser les filtres de langue pour Homeswap (IDs avec suffixe _homeswap)
    (function initBesoinLanguesHomeswap() {
      const chipsEl = document.getElementById('besoin_lang_chips_homeswap');
      const addBtn = document.getElementById('besoin_add_lang_btn_homeswap');
      const popover = document.getElementById('cecrl_popover_homeswap');
      const hiddenInput = document.getElementById('other_languages_input_homeswap');
      if (!chipsEl || !addBtn || !popover || !hiddenInput) return;

      let otherLangs = [];

      function parseOtherLangs() {
        const s = (hiddenInput.value || '').trim();
        if (!s) return [];
        return s.split(',').filter(Boolean).map(p => {
          const [code, level] = p.split(':');
          const row = document.querySelector('#cecrl_popover_homeswap .cecrl-row[data-lang="' + (code||'').replace(/"/g,'\\"') + '"]');
          return { code: (code||'').trim(), label: (row && row.dataset.langLabel) || code, level: (level||'').trim() };
        }).filter(x => x.code && x.level);
      }

      function syncHidden() {
        hiddenInput.value = otherLangs.map(x => x.code + ':' + x.level).join(',');
      }

      function renderChips() {
        chipsEl.innerHTML = '';
        otherLangs.forEach(x => {
          const chip = document.createElement('span');
          chip.className = 'besoin-lang-chip';
          chip.innerHTML = '<span>' + (x.label || x.code) + ' · ' + x.level + '</span> <button type="button" class="besoin-lang-chip-remove" aria-label="Retirer">×</button>';
          chip.querySelector('.besoin-lang-chip-remove').addEventListener('click', function() {
            otherLangs = otherLangs.filter(l => l.code !== x.code);
            renderChips(); syncHidden(); updatePillsSelected();
          });
          chipsEl.appendChild(chip);
        });
      }

      function updatePillsSelected() {
        document.querySelectorAll('#cecrl_popover_homeswap .cecrl-pill').forEach(p => p.classList.remove('is-selected'));
        otherLangs.forEach(x => {
          const pill = document.querySelector('#cecrl_popover_homeswap .cecrl-row[data-lang="' + x.code + '"] .cecrl-pill[data-level="' + x.level + '"]');
          if (pill) pill.classList.add('is-selected');
        });
      }

      function openPopover() {
        popover.removeAttribute('hidden');
        addBtn.setAttribute('aria-expanded', 'true');
        updatePillsSelected();
      }
      function closePopover() {
        popover.setAttribute('hidden', '');
        addBtn.setAttribute('aria-expanded', 'false');
      }

      addBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const isOpen = !popover.hasAttribute('hidden');
        if (isOpen) closePopover(); else openPopover();
      });

      document.addEventListener('click', function(e) {
        if (!popover || !addBtn) return;
        if (popover.hasAttribute('hidden')) return;
        if (popover.contains(e.target) || addBtn.contains(e.target)) return;
        closePopover();
      });

      document.querySelectorAll('#cecrl_popover_homeswap .cecrl-pill').forEach(p => {
        p.addEventListener('click', function() {
          const row = this.closest('.cecrl-row');
          if (!row) return;
          const code = row.dataset.lang || '';
          const label = row.dataset.langLabel || code;
          const level = this.dataset.level || '';
          const i = otherLangs.findIndex(x => x.code === code);
          if (i >= 0) otherLangs[i].level = level; else otherLangs.push({ code, label, level });
          renderChips(); syncHidden(); updatePillsSelected();
        });
      });

      otherLangs = parseOtherLangs();
      renderChips();
      syncHidden();
    })();
  });
</script>
@endonce
