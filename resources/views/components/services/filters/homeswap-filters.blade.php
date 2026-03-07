{{-- Composant filtres HomeSwap - Structure en 3 blocs premium --}}
@props([
    'formId'       => 'preplyFiltersForm',
    'formAction'   => route('services.homeswap'),
    'openAdvanced' => false,   {{-- true = ouvre le panneau Filtres avancés dès le chargement (ex: step2 onboarding) --}}
])

<form action="{{ $formAction }}" method="GET" id="{{ $formId }}" {{ $attributes->merge(['class' => 'homeswap-filters-form']) }} data-selected-city="{{ request('city') }}">
  {{-- Barre de recherche principale : une ligne (design Projets / capture 2) --}}
  <div class="filter-row-main homeswap-filter-row-main">
    <div class="filter-input-group" id="homeswapCountryGroup">
      <i class="fas fa-map-marker-alt filter-input-icon"></i>
      <select name="country" id="homeswapFilterCountry" class="filter-input filter-select-homeswap">
        <option value="">{{ __('Pays') }}</option>
        <option value="FR" {{ request('country') == 'FR' ? 'selected' : '' }}>{{ __('France') }}</option>
        <option value="GP" {{ request('country') == 'GP' ? 'selected' : '' }}>{{ __('Guadeloupe') }}</option>
        <option value="MQ" {{ request('country') == 'MQ' ? 'selected' : '' }}>{{ __('Martinique') }}</option>
        <option value="RE" {{ request('country') == 'RE' ? 'selected' : '' }}>{{ __('La Réunion') }}</option>
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
        <option value="BR" {{ request('country') == 'BR' ? 'selected' : '' }}>{{ __('Brésil') }}</option>
        <option value="JP" {{ request('country') == 'JP' ? 'selected' : '' }}>{{ __('Japon') }}</option>
        <option value="AE" {{ request('country') == 'AE' ? 'selected' : '' }}>{{ __('Émirats Arabes Unis') }}</option>
        <option value="QA" {{ request('country') == 'QA' ? 'selected' : '' }}>{{ __('Qatar') }}</option>
        <option value="SA" {{ request('country') == 'SA' ? 'selected' : '' }}>{{ __('Arabie Saoudite') }}</option>
        <option value="SG" {{ request('country') == 'SG' ? 'selected' : '' }}>{{ __('Singapour') }}</option>
        <option value="AU" {{ request('country') == 'AU' ? 'selected' : '' }}>{{ __('Australie') }}</option>
        <option value="MX" {{ request('country') == 'MX' ? 'selected' : '' }}>{{ __('Mexique') }}</option>
        <option value="CN" {{ request('country') == 'CN' ? 'selected' : '' }}>{{ __('Chine') }}</option>
        <option value="KR" {{ request('country') == 'KR' ? 'selected' : '' }}>{{ __('Corée du Sud') }}</option>
        <option value="IN" {{ request('country') == 'IN' ? 'selected' : '' }}>{{ __('Inde') }}</option>
        <option value="GR" {{ request('country') == 'GR' ? 'selected' : '' }}>{{ __('Grèce') }}</option>
        <option value="TH" {{ request('country') == 'TH' ? 'selected' : '' }}>{{ __('Thaïlande') }}</option>
        <option value="MU" {{ request('country') == 'MU' ? 'selected' : '' }}>{{ __('Île Maurice') }}</option>
        <option value="SC" {{ request('country') == 'SC' ? 'selected' : '' }}>{{ __('Seychelles') }}</option>
        <option value="SE" {{ request('country') == 'SE' ? 'selected' : '' }}>{{ __('Suède') }}</option>
        <option value="DK" {{ request('country') == 'DK' ? 'selected' : '' }}>{{ __('Danemark') }}</option>
        <option value="NO" {{ request('country') == 'NO' ? 'selected' : '' }}>{{ __('Norvège') }}</option>
        <option value="AT" {{ request('country') == 'AT' ? 'selected' : '' }}>{{ __('Autriche') }}</option>
        <option value="CY" {{ request('country') == 'CY' ? 'selected' : '' }}>{{ __('Chypre') }}</option>
        <option value="ID" {{ request('country') == 'ID' ? 'selected' : '' }}>{{ __('Indonésie') }}</option>
        <option value="MY" {{ request('country') == 'MY' ? 'selected' : '' }}>{{ __('Malaisie') }}</option>
        <option value="PH" {{ request('country') == 'PH' ? 'selected' : '' }}>{{ __('Philippines') }}</option>
      </select>
    </div>
    <div class="filter-input-group" id="homeswapCityWrapper">
      <i class="fas fa-map-marker-alt filter-input-icon"></i>
      <select name="city" id="homeswapFilterCity" class="filter-input filter-select-homeswap homeswap-filter-select">
        <option value="">{{ __('Ville') }}</option>
        @if(request('city'))
          {{-- Option pré-rendue serveur : garantit la valeur même si JS charge tard --}}
          <option value="{{ request('city') }}" selected="selected">{{ request('city') }}</option>
        @endif
      </select>
    </div>
    @php
      $datesDisplayValue = '';
      // Priorité 1 : availability_periods (multi-périodes)
      $nxMP = json_decode(request('availability_periods', '[]'), true) ?: [];
      $nxMP = array_values(array_filter((array)$nxMP, fn($p) => !empty($p['start'] ?? '') && !empty($p['end'] ?? '')));
      if (count($nxMP) > 1) {
          $datesDisplayValue = count($nxMP) . ' période' . (count($nxMP) > 1 ? 's' : '');
      } elseif (count($nxMP) === 1) {
          try {
              $d1 = \Carbon\Carbon::parse($nxMP[0]['start'])->format('d/m');
              $d2 = \Carbon\Carbon::parse($nxMP[0]['end'])->format('d/m/Y');
              $datesDisplayValue = "{$d1} → {$d2}";
          } catch (\Exception $e) {}
      } elseif (request('start_date') && request('end_date')) {
          // Priorité 2 : start_date / end_date (compat. ancien système)
          try {
              $d1 = \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y');
              $d2 = \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y');
              $datesDisplayValue = "Du {$d1} / Au {$d2}";
          } catch (\Exception $e) {}
      }
    @endphp
    <div class="filter-input-group homeswap-date-picker-wrapper">
      <i class="fas fa-calendar-alt filter-input-icon"></i>
      <input 
        type="text" 
        id="homeswapDatesDisplay"
        readonly
        placeholder="Du … / Au …"
        value="{{ $datesDisplayValue }}"
        class="filter-input homeswap-date-display"
        autocomplete="off"
      >
      <i class="fas fa-calendar-alt homeswap-date-icon-right" id="homeswapDateIcon" aria-hidden="true"></i>
    </div>
    <button type="submit" class="filter-submit-btn">
      <i class="fas fa-search me-2"></i>
      {{ __('Rechercher') }}
    </button>
  </div>

  {{-- Ligne 2 : Domaine NEXUS + Spécialisation (même structure que En Ligne / Présentiel / Hybride) --}}
  <div class="filter-row-main homeswap-domain-spec-row" style="margin-top:16px;gap:24px">
    <div class="filter-input-group filter-domain-nexus">
      <span class="mode-intervention-label">Domaine</span>
      <div class="mode-intervention-segmented" role="group" id="nexusDomainSegmented" aria-label="Domaine">
        <label class="mode-intervention-pill {{ request('nexus_domain', 'logement') === 'logement' ? 'is-active' : '' }}" data-domain="logement">
          <input type="radio" name="nexus_domain" value="logement" {{ request('nexus_domain', 'logement') === 'logement' ? 'checked' : '' }} class="sr-only nexus-domain-radio">
          <span class="mode-intervention-pill-icon">🏠</span>
          <span class="mode-intervention-pill-text">Logement</span>
        </label>
        <label class="mode-intervention-pill {{ request('nexus_domain') === 'infrastructure-pro' ? 'is-active' : '' }}" data-domain="infrastructure-pro">
          <input type="radio" name="nexus_domain" value="infrastructure-pro" {{ request('nexus_domain') === 'infrastructure-pro' ? 'checked' : '' }} class="sr-only nexus-domain-radio">
          <span class="mode-intervention-pill-icon">🏢</span>
          <span class="mode-intervention-pill-text">Infrastructure Pro</span>
        </label>
        <label class="mode-intervention-pill {{ request('nexus_domain') === 'enseignement' ? 'is-active' : '' }}" data-domain="enseignement">
          <input type="radio" name="nexus_domain" value="enseignement" {{ request('nexus_domain') === 'enseignement' ? 'checked' : '' }} class="sr-only nexus-domain-radio">
          <span class="mode-intervention-pill-icon">🎓</span>
          <span class="mode-intervention-pill-text">Enseignement</span>
        </label>
      </div>
    </div>

    {{-- Spécialisation visible (change dynamiquement selon le domaine sélectionné) --}}
    <div class="filter-input-group filter-specialization-nexus">
      <i class="fas fa-th-large filter-input-icon"></i>

      {{-- Logement --}}
      <select name="specialization" id="nexusSpecLogement" class="filter-input filter-select-homeswap nexus-spec-select" data-domain="logement" {{ request('nexus_domain', 'logement') !== 'logement' ? 'disabled' : '' }}{{ request('nexus_domain', 'logement') !== 'logement' ? ' style="display:none"' : '' }}>
        <option value="">Spécialisation — Logement</option>
        <option value="chambre" {{ request('specialization') == 'chambre' ? 'selected' : '' }}>Chambre</option>
        <option value="studio" {{ request('specialization') == 'studio' ? 'selected' : '' }}>Studio</option>
        <option value="appartement" {{ request('specialization') == 'appartement' ? 'selected' : '' }}>Appartement</option>
        <option value="maison" {{ request('specialization') == 'maison' ? 'selected' : '' }}>Maison</option>
        <option value="penthouse" {{ request('specialization') == 'penthouse' ? 'selected' : '' }}>Penthouse</option>
        <option value="villa" {{ request('specialization') == 'villa' ? 'selected' : '' }}>Villa</option>
        <option value="chalet" {{ request('specialization') == 'chalet' ? 'selected' : '' }}>Chalet</option>
        <option value="bungalow" {{ request('specialization') == 'bungalow' ? 'selected' : '' }}>Bungalow</option>
        <option value="tiny-house" {{ request('specialization') == 'tiny-house' ? 'selected' : '' }}>Tiny House / Cabane</option>
        <option value="bateau" {{ request('specialization') == 'bateau' ? 'selected' : '' }}>Bateau</option>
        <option value="autre" {{ request('specialization') == 'autre' ? 'selected' : '' }}>Autre</option>
      </select>

      {{-- Infrastructure Professionnelle --}}
      <select name="specialization" id="nexusSpecPro" class="filter-input filter-select-homeswap nexus-spec-select" data-domain="infrastructure-pro" {{ request('nexus_domain') !== 'infrastructure-pro' ? 'disabled' : '' }} style="{{ request('nexus_domain') !== 'infrastructure-pro' ? 'display:none' : '' }}">
        <option value="">Spécialisation — Infrastructure Pro</option>
        <option value="bureau" {{ request('specialization') == 'bureau' ? 'selected' : '' }}>Bureau</option>
        <option value="salle-reunion" {{ request('specialization') == 'salle-reunion' ? 'selected' : '' }}>Salle de réunion</option>
        <option value="salle-evenement" {{ request('specialization') == 'salle-evenement' ? 'selected' : '' }}>Salle d'événement</option>
        <option value="salle-reception" {{ request('specialization') == 'salle-reception' ? 'selected' : '' }}>Salle de réception</option>
        <option value="atelier-fablab" {{ request('specialization') == 'atelier-fablab' ? 'selected' : '' }}>Atelier / Fablab</option>
        <option value="studio-photo-video" {{ request('specialization') == 'studio-photo-video' ? 'selected' : '' }}>Studio photo / vidéo</option>
        <option value="coworking" {{ request('specialization') == 'coworking' ? 'selected' : '' }}>Espace coworking</option>
        <option value="scene-auditorium" {{ request('specialization') == 'scene-auditorium' ? 'selected' : '' }}>Scène / Auditorium</option>
      </select>

      {{-- Infrastructure d'Enseignement --}}
      <select name="specialization" id="nexusSpecEnseignement" class="filter-input filter-select-homeswap nexus-spec-select" data-domain="enseignement" {{ request('nexus_domain') !== 'enseignement' ? 'disabled' : '' }} style="{{ request('nexus_domain') !== 'enseignement' ? 'display:none' : '' }}">
        <option value="">Spécialisation — Enseignement</option>
        <option value="college" {{ request('specialization') == 'college' ? 'selected' : '' }}>Collège</option>
        <option value="lycee" {{ request('specialization') == 'lycee' ? 'selected' : '' }}>Lycée</option>
        <option value="universite" {{ request('specialization') == 'universite' ? 'selected' : '' }}>Université</option>
        <option value="institut-superieur" {{ request('specialization') == 'institut-superieur' ? 'selected' : '' }}>Institut Supérieur</option>
        <option value="grande-ecole" {{ request('specialization') == 'grande-ecole' ? 'selected' : '' }}>Grande École</option>
        <option value="ecole-langues" {{ request('specialization') == 'ecole-langues' ? 'selected' : '' }}>École de langues</option>
        <option value="centre-formation" {{ request('specialization') == 'centre-formation' ? 'selected' : '' }}>Centre de formation</option>
        <option value="campus-international" {{ request('specialization') == 'campus-international' ? 'selected' : '' }}>Campus international</option>
      </select>
    </div>
  </div>

  {{-- Type de Résidence — visible uniquement si Domaine = Logement --}}
  <div id="nexusResidenceBlock" class="filter-group filter-group--full" style="margin-top:10px;overflow:hidden;transition:max-height .35s cubic-bezier(.4,0,.2,1),opacity .3s ease;">
    <div style="font-size:.74rem;font-weight:700;letter-spacing:.05em;color:#6b7280;text-transform:uppercase;margin-bottom:8px;">Type de Résidence</div>
    <div class="hw-freq-grid">
      <label class="hw-freq-card">
        <input type="radio" name="residence_type" value="principale" class="hw-freq-input" {{ request('residence_type', 'principale') === 'principale' ? 'checked' : '' }}>
        <span class="hw-freq-icon">🏠</span>
        <span class="hw-freq-text"><span class="hw-freq-label">Principale</span></span>
      </label>
      <label class="hw-freq-card">
        <input type="radio" name="residence_type" value="secondaire" class="hw-freq-input" {{ request('residence_type') === 'secondaire' ? 'checked' : '' }}>
        <span class="hw-freq-icon">🏡</span>
        <span class="hw-freq-text"><span class="hw-freq-label">Secondaire</span></span>
      </label>
    </div>
  </div>

  {{-- Ligne 1b : Ma langue maternelle + Autres langues parlées --}}
  @php
    $hs_languages = ['fr' => 'Français', 'en' => 'Anglais', 'es' => 'Espagnol', 'de' => 'Allemand', 'it' => 'Italien', 'pt' => 'Portugais', 'nl' => 'Néerlandais', 'ru' => 'Russe', 'zh' => 'Chinois', 'ar' => 'Arabe', 'ja' => 'Japonais', 'pl' => 'Polonais', 'el' => 'Grec', 'tr' => 'Turc', 'sv' => 'Suédois', 'ko' => 'Coréen', 'hi' => 'Hindi'];
    $hs_cecrl = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
  @endphp
  <div class="filter-group besoin-langues filter-group--full homeswap-langues-row" style="margin-top:22px">
    <div style="font-size:.74rem;font-weight:700;letter-spacing:.05em;color:#6b7280;text-transform:uppercase;margin-bottom:8px;">Ma langue maternelle</div>
    <div class="besoin-langues-row">
      <div class="besoin-mother-tongue-wrap">
        <select name="mother_tongue" id="besoin_mother_tongue_homeswap" class="filter-select">
          <option value="">{{ __('Langue maternelle') }}</option>
          @foreach($hs_languages as $code => $label)
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
              @foreach($hs_languages as $code => $label)
              <div class="cecrl-row" data-lang="{{ $code }}" data-lang-label="{{ $label }}">
                <span class="cecrl-lang">{{ $label }}</span>
                <div class="cecrl-pills">
                  @foreach($hs_cecrl as $l)
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

  {{-- Contact préféré --}}
  <div class="filter-group filter-group--full" style="margin-top:22px">
    <div style="font-size:.74rem;font-weight:700;letter-spacing:.05em;color:#6b7280;text-transform:uppercase;margin-bottom:8px;">Contact préféré</div>
    <div class="hw-freq-grid">
      <label class="hw-freq-card">
        <input type="radio" name="contact_preference" value="message" class="hw-freq-input" {{ request('contact_preference', 'message') === 'message' ? 'checked' : '' }}>
        <span class="hw-freq-icon">💬</span>
        <span class="hw-freq-text"><span class="hw-freq-label">Message</span></span>
      </label>
      <label class="hw-freq-card">
        <input type="radio" name="contact_preference" value="visio" class="hw-freq-input" {{ request('contact_preference') === 'visio' ? 'checked' : '' }}>
        <span class="hw-freq-icon">📹</span>
        <span class="hw-freq-text"><span class="hw-freq-label">Visio</span></span>
      </label>
    </div>
  </div>

  {{-- JS : synchronisation domain pills ↔ spécialisation --}}
  <script>
  (function() {
    document.addEventListener('DOMContentLoaded', function() {
      var activeDomain = '{{ request('nexus_domain', 'logement') }}';
      var pillLabels = document.querySelectorAll('#nexusDomainSegmented .mode-intervention-pill');
      var radios = document.querySelectorAll('#nexusDomainSegmented .nexus-domain-radio');
      var specs = document.querySelectorAll('.nexus-spec-select');
      var residenceBlock = document.getElementById('nexusResidenceBlock');
      // Initialiser max-height pour que la transition CSS fonctionne dès le premier appel
      if (residenceBlock) { residenceBlock.style.maxHeight = residenceBlock.scrollHeight + 'px'; residenceBlock.style.opacity = '1'; }
      function showResidence(show) {
        if (!residenceBlock) return;
        if (show) {
          residenceBlock.style.maxHeight = residenceBlock.scrollHeight + 'px';
          residenceBlock.style.opacity = '1';
          residenceBlock.style.pointerEvents = '';
        } else {
          residenceBlock.style.maxHeight = '0';
          residenceBlock.style.opacity = '0';
          residenceBlock.style.pointerEvents = 'none';
        }
      }
      function applyDomain(domain) {
        activeDomain = domain;
        pillLabels.forEach(function(l) { l.classList.toggle('is-active', l.getAttribute('data-domain') === domain); });
        specs.forEach(function(s) {
          var isActive = s.getAttribute('data-domain') === domain;
          s.style.display = isActive ? '' : 'none';
          s.disabled = !isActive;
        });
        // Commuter les blocs du panneau avancé selon le domaine
        document.querySelectorAll('[data-domain-block]').forEach(function(block) {
          block.style.display = block.getAttribute('data-domain-block') === domain ? '' : 'none';
        });
        // Afficher/masquer Type de Résidence selon le domaine
        showResidence(domain === 'logement');
        var r = document.querySelector('#nexusDomainSegmented input[value="' + domain + '"]');
        if (r) r.checked = true;
        // Synchroniser le "Type de bien" (property_type) avec le domaine actif
        var domainToPt = { 'logement': 'logement', 'infrastructure-pro': 'bureau', 'enseignement': 'pedagogique' };
        var ptTarget = document.getElementById('pt_' + (domainToPt[domain] || ''));
        if (ptTarget) ptTarget.checked = true;
      }
      applyDomain(activeDomain);
      pillLabels.forEach(function(label) {
        label.addEventListener('click', function() {
          applyDomain(label.getAttribute('data-domain'));
        });
      });
      // Synchronisation inverse : clic sur "Type de bien" → met à jour le domaine
      var ptToDomain = { 'logement': 'logement', 'bureau': 'infrastructure-pro', 'pedagogique': 'enseignement' };
      document.querySelectorAll('.nx-radio-input[name="property_type"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
          var mapped = ptToDomain[this.value];
          if (mapped) {
            applyDomain(mapped);
          } else {
            // wellness, evenement, autre : masquer résidence sans changer le domaine actif
            showResidence(false);
          }
        });
      });
    });
  })();
  </script>

  <input type="hidden" name="start_date" id="homeswapStartDate" value="{{ request('start_date') }}">
  <input type="hidden" name="end_date" id="homeswapEndDate" value="{{ request('end_date') }}">
  <input type="hidden" name="availability_periods" id="nxPeriodsData" value="{{ request('availability_periods', '[]') }}">

  {{-- Filtres avancés (style Projets) --}}
  <div class="filter-advanced-toggle">
    <button type="button" class="filter-advanced-btn" id="homeswapToggleAdvancedFilters" aria-expanded="false" aria-controls="homeswapAdvancedFiltersPanel">
      <i class="fas fa-sliders-h me-2" aria-hidden="true"></i>
      {{ __('Filtres avancés') }}
      <i class="fas fa-chevron-down ms-2" id="homeswapAdvancedChevron" aria-hidden="true"></i>
    </button>
  </div>

  {{-- Panneau Filtres avancés (fermé par défaut, état géré par JS via .is-open) --}}
  <div class="homeswap-filters-advanced-panel" id="homeswapAdvancedFiltersPanel" role="region" aria-label="Filtres avancés" aria-hidden="true" data-advanced-open="false">
    {{-- Mes disponibilités --}}
    <h3 class="homeswap-filters-block-title" style="margin-bottom:14px;">
      <i class="fas fa-calendar-alt me-2"></i>
      Mes disponibilités
    </h3>

    {{-- ── Périodes de disponibilité (multi-calendrier) ───────────────────────── --}}
    @php
      $nxPeriods = json_decode(request('availability_periods', '[]'), true) ?: [];
      $nxPeriods = array_values(array_filter((array)$nxPeriods,
          fn($p) => !empty($p['start'] ?? '') && !empty($p['end'] ?? '')));
    @endphp
    <div class="homeswap-filter-group hw-multiperiod-group">
      <div class="hw-multiperiod-header">
        <span class="hw-multiperiod-label">
          <i class="fas fa-calendar-alt me-2" style="color:#EC4899"></i>Périodes de disponibilité
        </span>
        <button type="button" id="nxAddPeriodBtn" class="hw-add-period-btn">
          <i class="fas fa-plus me-1"></i>Ajouter une période
        </button>
      </div>

      {{-- Calendrier inline — masqué par défaut, apparaît sur clic Ajouter --}}
      <div id="nxPeriodPickerWrap" style="display:none;margin:12px 0 8px">
        {{-- Input invisible : flatpickr s'accroche dessus et injecte le calendrier juste après --}}
        <input type="text" id="nxPeriodPickerInput"
          style="position:absolute;opacity:0;width:0;height:0;pointer-events:none;overflow:hidden"
          readonly aria-hidden="true">
        {{-- Le calendrier inline sera injecté ici par JS via appendTo --}}
        <div id="nxInlineCalendarTarget" style="display:flex;justify-content:center;"></div>
        <p style="font-size:.72rem;color:#9ca3af;margin:6px 0 0;text-align:center;">
          Sélectionnez le début puis la fin de la période
        </p>
      </div>

      {{-- Chips des périodes sauvegardées --}}
      <div id="nxPeriodsChips" class="hw-periods-chips">
        @foreach($nxPeriods as $nxP)
          @php
            try {
              $nxChipLabel = \Carbon\Carbon::parse($nxP['start'])->locale('fr')->translatedFormat('d M')
                            . ' → '
                            . \Carbon\Carbon::parse($nxP['end'])->locale('fr')->translatedFormat('d M Y');
            } catch (\Exception $e) {
              $nxChipLabel = ($nxP['start'] ?? '') . ' → ' . ($nxP['end'] ?? '');
            }
          @endphp
          <div class="hw-period-chip">
            <span class="hw-period-chip-icon">📅</span>
            <span class="hw-period-chip-text">{{ $nxChipLabel }}</span>
            <button type="button" class="hw-period-chip-remove" aria-label="Supprimer cette période">×</button>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Flexibilité sur les dates --}}
    <div class="homeswap-filter-group homeswap-date-options-group">
      <input
        type="text"
        name="date_text"
        id="homeswapDateText"
        value="{{ request('date_text') }}"
        placeholder="Texte libre – ex : Juillet 2026, flexible"
        class="homeswap-filter-input homeswap-date-text-input"
        style="margin-bottom:12px"
      >
      <div class="homeswap-filter-label" style="font-size:.74rem;font-weight:700;letter-spacing:.05em;color:#6b7280;text-transform:uppercase;margin:0 0 8px;">Flexibilité sur les dates</div>
      <div class="hw-freq-grid" style="margin-top:0">
        <label class="hw-freq-card">
          <input type="checkbox" name="flexibility[]" value="flexible" class="hw-freq-input" {{ in_array('flexible', (array) request('flexibility', [])) ? 'checked' : '' }}>
          <span class="hw-freq-icon">😌</span>
          <span class="hw-freq-text"><span class="hw-freq-label">Flexible</span><span class="hw-freq-sub">Ouvert à tout</span></span>
        </label>
        <label class="hw-freq-card">
          <input type="checkbox" name="flexibility[]" value="peu_flexible" class="hw-freq-input" {{ in_array('peu_flexible', (array) request('flexibility', [])) ? 'checked' : '' }}>
          <span class="hw-freq-icon">🤔</span>
          <span class="hw-freq-text"><span class="hw-freq-label">Peu flexible</span><span class="hw-freq-sub">±quelques jours</span></span>
        </label>
        <label class="hw-freq-card">
          <input type="checkbox" name="flexibility[]" value="pas_flexible" class="hw-freq-input" {{ in_array('pas_flexible', (array) request('flexibility', [])) ? 'checked' : '' }}>
          <span class="hw-freq-icon">📌</span>
          <span class="hw-freq-text"><span class="hw-freq-label">Dates fixes</span><span class="hw-freq-sub">Périodes précises</span></span>
        </label>
      </div>
    </div>

    {{-- Durée souhaitée de l'échange --}}
    <div class="homeswap-filter-group" data-domain-block="logement" style="{{ request('nexus_domain', 'logement') !== 'logement' ? 'display:none' : '' }}">
      <div style="font-size:.74rem;font-weight:700;letter-spacing:.05em;color:#6b7280;text-transform:uppercase;margin:12px 0 8px;">Durée souhaitée de l'échange</div>
      <div class="hw-freq-grid">
        <label class="hw-freq-card">
          <input type="checkbox" name="stay_duration[]" value="court" class="hw-freq-input" {{ in_array('court', (array) request('stay_duration', [])) ? 'checked' : '' }}>
          <span class="hw-freq-icon">⚡</span>
          <span class="hw-freq-text"><span class="hw-freq-label">Court séjour</span><span class="hw-freq-sub">&lt; 7 jours</span></span>
        </label>
        <label class="hw-freq-card">
          <input type="checkbox" name="stay_duration[]" value="moyen" class="hw-freq-input" {{ in_array('moyen', (array) request('stay_duration', [])) ? 'checked' : '' }}>
          <span class="hw-freq-icon">🌙</span>
          <span class="hw-freq-text"><span class="hw-freq-label">Moyen séjour</span><span class="hw-freq-sub">1 – 4 semaines</span></span>
        </label>
        <label class="hw-freq-card">
          <input type="checkbox" name="stay_duration[]" value="long" class="hw-freq-input" {{ in_array('long', (array) request('stay_duration', [])) ? 'checked' : '' }}>
          <span class="hw-freq-icon">🏡</span>
          <span class="hw-freq-text"><span class="hw-freq-label">Long séjour</span><span class="hw-freq-sub">&gt; 1 mois</span></span>
        </label>
        <label class="hw-freq-card">
          <input type="checkbox" name="stay_duration[]" value="flexible" class="hw-freq-input" {{ in_array('flexible', (array) request('stay_duration', [])) ? 'checked' : '' }}>
          <span class="hw-freq-icon">🤸</span>
          <span class="hw-freq-text"><span class="hw-freq-label">Flexible</span><span class="hw-freq-sub">Peu importe</span></span>
        </label>
      </div>
    </div>

    {{-- Fréquence souhaitée --}}
    <div class="homeswap-filter-group" data-domain-block="logement" style="{{ request('nexus_domain', 'logement') !== 'logement' ? 'display:none' : '' }}">
      <div style="font-size:.74rem;font-weight:700;letter-spacing:.05em;color:#6b7280;text-transform:uppercase;margin:12px 0 8px;">Fréquence souhaitée</div>
      <div class="hw-freq-grid">
        <label class="hw-freq-card">
          <input type="checkbox" name="frequency[]" value="ponctuel" class="hw-freq-input" {{ in_array('ponctuel', (array) request('frequency', [])) ? 'checked' : '' }}>
          <span class="hw-freq-icon">🎯</span>
          <span class="hw-freq-text"><span class="hw-freq-label">Ponctuel</span><span class="hw-freq-sub">Une seule fois</span></span>
        </label>
        <label class="hw-freq-card">
          <input type="checkbox" name="frequency[]" value="regulier" class="hw-freq-input" {{ in_array('regulier', (array) request('frequency', [])) ? 'checked' : '' }}>
          <span class="hw-freq-icon">🔄</span>
          <span class="hw-freq-text"><span class="hw-freq-label">Régulier</span><span class="hw-freq-sub">Plusieurs fois/an</span></span>
        </label>
        <label class="hw-freq-card">
          <input type="checkbox" name="frequency[]" value="permanent" class="hw-freq-input" {{ in_array('permanent', (array) request('frequency', [])) ? 'checked' : '' }}>
          <span class="hw-freq-icon">∞</span>
          <span class="hw-freq-text"><span class="hw-freq-label">Permanent</span><span class="hw-freq-sub">En continu</span></span>
        </label>
      </div>
    </div>

    {{-- Délai minimum de réservation --}}
    <div class="homeswap-filter-group hw-delay-group" data-domain-block="logement" style="{{ request('nexus_domain', 'logement') !== 'logement' ? 'display:none' : '' }}">
      <div style="font-size:.74rem;font-weight:700;letter-spacing:.05em;color:#6b7280;text-transform:uppercase;margin:12px 0 8px;">Délai minimum de réservation <span style="font-weight:400;text-transform:none;letter-spacing:0;">· prévenez-moi au moins <strong id="hwDelayVal">{{ request('min_delay', 7) }}</strong> jours avant</span></div>
      <input type="hidden" name="min_delay" id="hwDelayHidden" value="{{ request('min_delay', 7) }}">
      <div class="hw-delay-slider-wrap">
        <input type="range" id="hwDelayRange" min="0" max="90" step="1" value="{{ request('min_delay', 7) }}" class="hw-delay-range">
        <span class="hw-delay-badge" id="hwDelayBadge">{{ request('min_delay', 7) }} j</span>
      </div>
    </div>

    {{-- BLOC 1 : Je pose mon besoin — LOGEMENT --}}
  <div class="homeswap-filters-block homeswap-filters-block-1" data-domain-block="logement" style="{{ request('nexus_domain', 'logement') !== 'logement' ? 'display:none' : '' }}">
      <h3 class="homeswap-filters-block-title">
        <i class="fas fa-lightbulb me-2"></i>
        Je pose mon besoin
      </h3>
      <div class="homeswap-filters-block-content">
      {{-- Objectif du séjour --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-bullseye me-2"></i>
          Objectif du séjour
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="trip_purpose[]" 
              value="vacances" 
              {{ in_array('vacances', (array) request('trip_purpose', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🏖️ Vacances</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="trip_purpose[]" 
              value="travail-distance" 
              {{ in_array('travail-distance', (array) request('trip_purpose', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">💻 Travail à distance</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="trip_purpose[]" 
              value="echange-linguistique" 
              {{ in_array('echange-linguistique', (array) request('trip_purpose', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🗣️ Échange linguistique</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="trip_purpose[]" 
              value="famille" 
              {{ in_array('famille', (array) request('trip_purpose', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">👨‍👩‍👧 Famille</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="trip_purpose[]" 
              value="etudes" 
              {{ in_array('etudes', (array) request('trip_purpose', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">📚 Études</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="trip_purpose[]" 
              value="repos-pause-souffle" 
              {{ in_array('repos-pause-souffle', (array) request('trip_purpose', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">😌 Repos / Pause Souffle</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="trip_purpose[]" 
              value="autre" 
              id="homeswapTripPurposeAutre"
              {{ in_array('autre', (array) request('trip_purpose', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">💡 Autre</span>
          </label>
        </div>
        <input 
          type="text" 
          name="trip_purpose_other" 
          id="homeswapTripPurposeOther"
          value="{{ request('trip_purpose_other') }}"
          placeholder="Précisez votre objectif"
          class="homeswap-filter-input homeswap-conditional-input"
          style="display: {{ in_array('autre', (array) request('trip_purpose', [])) ? 'block' : 'none' }}; margin-top: 8px;"
        >
      </div>

      {{-- Type d'échange --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-exchange-alt me-2"></i>
          Type d'échange
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="exchange_type[]" 
              value="simultane" 
              {{ in_array('simultane', (array) request('exchange_type', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🔄 Échange simultané</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="exchange_type[]" 
              value="non-simultane" 
              {{ in_array('non-simultane', (array) request('exchange_type', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">⏳ Échange non simultané</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="exchange_type[]" 
              value="points" 
              {{ in_array('points', (array) request('exchange_type', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🎯 Échange à points</span>
          </label>
        </div>
      </div>

    </div>
  </div>

  {{-- ============================================
      BLOC 2 : AFFINER LA RECHERCHE — LOGEMENT
      ============================================ --}}
  <div class="homeswap-filters-block homeswap-filters-block-2" data-domain-block="logement" style="{{ request('nexus_domain', 'logement') !== 'logement' ? 'display:none' : '' }}">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-sliders-h me-2"></i>
      Affiner la recherche
    </h3>
    <div class="homeswap-filters-block-content">
      
      {{-- Caractéristiques du logement --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-door-open me-2"></i>
          Caractéristiques du logement
        </label>
        <div class="homeswap-characteristics-grid">
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Nombre de chambres</label>
            <select name="bedrooms" class="homeswap-filter-select">
              <option value="">Toutes</option>
              <option value="1" {{ request('bedrooms') == '1' ? 'selected' : '' }}>1</option>
              <option value="2" {{ request('bedrooms') == '2' ? 'selected' : '' }}>2</option>
              <option value="3" {{ request('bedrooms') == '3' ? 'selected' : '' }}>3</option>
              <option value="4" {{ request('bedrooms') == '4' ? 'selected' : '' }}>4+</option>
            </select>
          </div>
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Nombre de salles de bain</label>
            <select name="bathrooms" class="homeswap-filter-select">
              <option value="">Toutes</option>
              <option value="1" {{ request('bathrooms') == '1' ? 'selected' : '' }}>1</option>
              <option value="2" {{ request('bathrooms') == '2' ? 'selected' : '' }}>2</option>
              <option value="3" {{ request('bathrooms') == '3' ? 'selected' : '' }}>3+</option>
            </select>
          </div>
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Nombre d'adultes</label>
            <select name="adults" class="homeswap-filter-select">
              <option value="">Tous</option>
              <option value="1" {{ request('adults') == '1' ? 'selected' : '' }}>1</option>
              <option value="2" {{ request('adults') == '2' ? 'selected' : '' }}>2</option>
              <option value="3" {{ request('adults') == '3' ? 'selected' : '' }}>3+</option>
            </select>
          </div>
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Nombre d'enfants</label>
            <select name="children" class="homeswap-filter-select">
              <option value="">Tous</option>
              <option value="0" {{ request('children') == '0' ? 'selected' : '' }}>0</option>
              <option value="1" {{ request('children') == '1' ? 'selected' : '' }}>1</option>
              <option value="2" {{ request('children') == '2' ? 'selected' : '' }}>2+</option>
            </select>
          </div>
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Capacité d'accueil totale</label>
            <select name="capacity" class="homeswap-filter-select">
              <option value="">Toutes</option>
              <option value="1-2" {{ request('capacity') == '1-2' ? 'selected' : '' }}>1-2</option>
              <option value="3-4" {{ request('capacity') == '3-4' ? 'selected' : '' }}>3-4</option>
              <option value="5-6" {{ request('capacity') == '5-6' ? 'selected' : '' }}>5-6</option>
              <option value="7+" {{ request('capacity') == '7+' ? 'selected' : '' }}>7+</option>
            </select>
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- ============================================
      BLOC 3 : CRITÈRES AVANCÉS — LOGEMENT
      ============================================ --}}
  <div class="homeswap-filters-block homeswap-filters-block-3" data-domain-block="logement" style="{{ request('nexus_domain', 'logement') !== 'logement' ? 'display:none' : '' }}">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-cog me-2"></i>
      Critères avancés
    </h3>
    <div class="homeswap-filters-block-content">
      
      {{-- Équipements & confort --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-couch me-2"></i>
          Équipements & confort
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="wifi" 
              {{ in_array('wifi', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">📶 WiFi</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="bureau" 
              {{ in_array('bureau', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🖥️ Bureau</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="cuisine-equipee" 
              {{ in_array('cuisine-equipee', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🍳 Cuisine équipée</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="lave-linge" 
              {{ in_array('lave-linge', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🫧 Lave-linge</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="lave-vaisselle" 
              {{ in_array('lave-vaisselle', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🍽️ Lave-vaisselle</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="seche-linge" 
              {{ in_array('seche-linge', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">💨 Sèche-linge</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="climatisation" 
              {{ in_array('climatisation', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">❄️ Climatisation</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="chauffage" 
              {{ in_array('chauffage', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🔥 Chauffage</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="lit-bebe" 
              {{ in_array('lit-bebe', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">👶 Lit bébé</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="television" 
              {{ in_array('television', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">📺 TV / Home cinéma</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="parking" 
              {{ in_array('parking', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🅿️ Parking</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="ascenseur" 
              {{ in_array('ascenseur', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🛗 Ascenseur</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="securite-badge" 
              {{ in_array('securite-badge', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🔐 Sécurité / Badge</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="equipment[]" 
              value="accessibilite-pmr" 
              {{ in_array('accessibilite-pmr', (array) request('equipment', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">♿ Accessibilité PMR</span>
          </label>
        </div>
      </div>

      {{-- Espaces extérieurs --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-tree me-2"></i>
          Espaces extérieurs
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="outdoor[]" 
              value="balcon" 
              {{ in_array('balcon', (array) request('outdoor', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🌿 Balcon</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="outdoor[]" 
              value="terrasse" 
              {{ in_array('terrasse', (array) request('outdoor', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">☀️ Terrasse</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="outdoor[]" 
              value="cour" 
              {{ in_array('cour', (array) request('outdoor', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🏡 Cour</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="outdoor[]" 
              value="jardin" 
              {{ in_array('jardin', (array) request('outdoor', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🌻 Jardin</span>
          </label>
        </div>
      </div>

      {{-- Règles & préférences --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-shield-alt me-2"></i>
          Règles & préférences
        </label>
        @php
          $hwRules = [
            'non-fumeurs'          => '🚬 Non-fumeur',
            'pas-de-fetes'         => '🎉 Pas de fêtes',
            'animaux-non-acceptes' => '🐾 Animaux non acceptés',
            'calme'                => '😌 Logement calme',
            'teletravail'          => '🖥️ Télétravail',
            'voisinage'            => '🤝 Respect du voisinage',
            'enfants-acceptes'     => '👨‍👩‍👧 Enfants acceptés',
            'eco-responsable'      => '♻️ Éco-responsable',
          ];
        @endphp
        <div class="hw-rule-grid">
          @foreach($hwRules as $slugR => $labelR)
            <input type="checkbox" name="rules[]" value="{{ $slugR }}" id="hwrule_{{ $slugR }}" class="hw-rule-input" {{ in_array($slugR, (array) request('rules', [])) ? 'checked' : '' }}>
            <label for="hwrule_{{ $slugR }}" class="hw-rule-label">{{ $labelR }}</label>
          @endforeach
        </div>
      </div>

    </div>
  </div>

  {{-- ============================================
      BLOCS INFRASTRUCTURE PRO
      ============================================ --}}

  {{-- BLOC 1 INFRA PRO : Je pose mon besoin --}}
  <div class="homeswap-filters-block homeswap-filters-block-1" data-domain-block="infrastructure-pro" style="{{ request('nexus_domain') !== 'infrastructure-pro' ? 'display:none' : '' }}">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-lightbulb me-2"></i>
      Je pose mon besoin
    </h3>
    <div class="homeswap-filters-block-content">

      {{-- Objectif d'usage --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-bullseye me-2"></i>
          Objectif d'usage
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_purpose[]" value="reunion-conference" {{ in_array('reunion-conference', (array) request('infra_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Réunion / Conférence</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_purpose[]" value="evenement-entreprise" {{ in_array('evenement-entreprise', (array) request('infra_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Événement d'entreprise</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_purpose[]" value="coworking" {{ in_array('coworking', (array) request('infra_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Coworking</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_purpose[]" value="formation" {{ in_array('formation', (array) request('infra_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Formation / Atelier</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_purpose[]" value="tournage-production" {{ in_array('tournage-production', (array) request('infra_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Tournage / Production</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_purpose[]" value="showroom-exposition" {{ in_array('showroom-exposition', (array) request('infra_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Showroom / Exposition</span>
          </label>
        </div>
      </div>

      {{-- Durée de réservation --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-clock me-2"></i>
          Durée de réservation
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_duration[]" value="heure" {{ in_array('heure', (array) request('infra_duration', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">À l'heure</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_duration[]" value="demi-journee" {{ in_array('demi-journee', (array) request('infra_duration', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Demi-journée</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_duration[]" value="journee" {{ in_array('journee', (array) request('infra_duration', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Journée</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_duration[]" value="semaine" {{ in_array('semaine', (array) request('infra_duration', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Semaine</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_duration[]" value="mensuel" {{ in_array('mensuel', (array) request('infra_duration', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Mensuel</span>
          </label>
        </div>
      </div>

    </div>
  </div>

  {{-- BLOC 2 INFRA PRO : Affiner la recherche --}}
  <div class="homeswap-filters-block homeswap-filters-block-2" data-domain-block="infrastructure-pro" style="{{ request('nexus_domain') !== 'infrastructure-pro' ? 'display:none' : '' }}">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-sliders-h me-2"></i>
      Affiner la recherche
    </h3>
    <div class="homeswap-filters-block-content">

      {{-- Capacité d'accueil + Surface --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-users me-2"></i>
          Capacité d'accueil
        </label>
        <div class="homeswap-characteristics-grid">
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Nombre de personnes</label>
            <select name="infra_capacity" class="homeswap-filter-select">
              <option value="">Toutes</option>
              <option value="1-10" {{ request('infra_capacity') == '1-10' ? 'selected' : '' }}>1 – 10 personnes</option>
              <option value="10-30" {{ request('infra_capacity') == '10-30' ? 'selected' : '' }}>10 – 30 personnes</option>
              <option value="30-100" {{ request('infra_capacity') == '30-100' ? 'selected' : '' }}>30 – 100 personnes</option>
              <option value="100-300" {{ request('infra_capacity') == '100-300' ? 'selected' : '' }}>100 – 300 personnes</option>
              <option value="300+" {{ request('infra_capacity') == '300+' ? 'selected' : '' }}>300+ personnes</option>
            </select>
          </div>
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Surface disponible</label>
            <select name="infra_surface" class="homeswap-filter-select">
              <option value="">Toutes</option>
              <option value="0-50" {{ request('infra_surface') == '0-50' ? 'selected' : '' }}>Moins de 50 m²</option>
              <option value="50-150" {{ request('infra_surface') == '50-150' ? 'selected' : '' }}>50 – 150 m²</option>
              <option value="150-500" {{ request('infra_surface') == '150-500' ? 'selected' : '' }}>150 – 500 m²</option>
              <option value="500-2000" {{ request('infra_surface') == '500-2000' ? 'selected' : '' }}>500 – 2 000 m²</option>
              <option value="2000+" {{ request('infra_surface') == '2000+' ? 'selected' : '' }}>2 000 m² et +</option>
            </select>
          </div>
        </div>
      </div>

      {{-- Accessibilité --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-wheelchair me-2"></i>
          Accessibilité
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_access[]" value="pmr" {{ in_array('pmr', (array) request('infra_access', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Accès PMR</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_access[]" value="ascenseur" {{ in_array('ascenseur', (array) request('infra_access', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">🛗 Ascenseur</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_access[]" value="parking" {{ in_array('parking', (array) request('infra_access', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Parking dédié</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_access[]" value="transports" {{ in_array('transports', (array) request('infra_access', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Transports en commun proches</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_access[]" value="securite" {{ in_array('securite', (array) request('infra_access', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Sécurité / Badges</span>
          </label>
        </div>
      </div>

    </div>
  </div>

  {{-- BLOC 3 INFRA PRO : Critères avancés --}}
  <div class="homeswap-filters-block homeswap-filters-block-3" data-domain-block="infrastructure-pro" style="{{ request('nexus_domain') !== 'infrastructure-pro' ? 'display:none' : '' }}">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-cog me-2"></i>
      Critères avancés
    </h3>
    <div class="homeswap-filters-block-content">

      {{-- Équipements technologiques --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-laptop me-2"></i>
          Équipements technologiques
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_tech[]" value="videoprojecteur" {{ in_array('videoprojecteur', (array) request('infra_tech', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Vidéoprojecteur / Écran</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_tech[]" value="fibre" {{ in_array('fibre', (array) request('infra_tech', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Fibre haut débit</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_tech[]" value="sonorisation" {{ in_array('sonorisation', (array) request('infra_tech', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Sonorisation</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_tech[]" value="systeme-conference" {{ in_array('systeme-conference', (array) request('infra_tech', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Système de conférence</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_tech[]" value="cameras" {{ in_array('cameras', (array) request('infra_tech', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Caméras / Enregistrement</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_tech[]" value="ecran-interactif" {{ in_array('ecran-interactif', (array) request('infra_tech', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Écran interactif</span>
          </label>
        </div>
      </div>

      {{-- Services inclus --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-concierge-bell me-2"></i>
          Services inclus
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_services[]" value="accueil" {{ in_array('accueil', (array) request('infra_services', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Accueil / Réception</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_services[]" value="traiteur" {{ in_array('traiteur', (array) request('infra_services', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Service traiteur</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_services[]" value="mobilier-modulable" {{ in_array('mobilier-modulable', (array) request('infra_services', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Mobilier modulable</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_services[]" value="cuisine-pro" {{ in_array('cuisine-pro', (array) request('infra_services', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Cuisine professionnelle</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="infra_services[]" value="espaces-detente" {{ in_array('espaces-detente', (array) request('infra_services', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Espaces détente</span>
          </label>
        </div>
      </div>

    </div>
  </div>

  {{-- ============================================
      BLOCS ENSEIGNEMENT
      ============================================ --}}

  {{-- BLOC 1 ENSEIGNEMENT : Je pose mon besoin --}}
  <div class="homeswap-filters-block homeswap-filters-block-1" data-domain-block="enseignement" style="{{ request('nexus_domain') !== 'enseignement' ? 'display:none' : '' }}">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-lightbulb me-2"></i>
      Je pose mon besoin
    </h3>
    <div class="homeswap-filters-block-content">

      {{-- Objectif de la démarche --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-bullseye me-2"></i>
          Objectif de la démarche
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_purpose[]" value="stage" {{ in_array('stage', (array) request('ens_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Stage</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_purpose[]" value="partenariat-academique" {{ in_array('partenariat-academique', (array) request('ens_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Partenariat académique</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_purpose[]" value="echange-etudiants" {{ in_array('echange-etudiants', (array) request('ens_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Échange d'étudiants</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_purpose[]" value="residence" {{ in_array('residence', (array) request('ens_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Résidence</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_purpose[]" value="co-formation" {{ in_array('co-formation', (array) request('ens_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Co-formation</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_purpose[]" value="recherche" {{ in_array('recherche', (array) request('ens_purpose', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Recherche</span>
          </label>
        </div>
      </div>

      {{-- Niveau d'enseignement --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-graduation-cap me-2"></i>
          Niveau d'enseignement
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_level[]" value="college" {{ in_array('college', (array) request('ens_level', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Collège</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_level[]" value="lycee" {{ in_array('lycee', (array) request('ens_level', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Lycée</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_level[]" value="bts-iut" {{ in_array('bts-iut', (array) request('ens_level', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">BTS / IUT</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_level[]" value="licence" {{ in_array('licence', (array) request('ens_level', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Licence</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_level[]" value="master" {{ in_array('master', (array) request('ens_level', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Master</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_level[]" value="doctorat" {{ in_array('doctorat', (array) request('ens_level', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Doctorat</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_level[]" value="formation-pro" {{ in_array('formation-pro', (array) request('ens_level', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Formation professionnelle</span>
          </label>
        </div>
      </div>

    </div>
  </div>

  {{-- BLOC 2 ENSEIGNEMENT : Affiner la recherche --}}
  <div class="homeswap-filters-block homeswap-filters-block-2" data-domain-block="enseignement" style="{{ request('nexus_domain') !== 'enseignement' ? 'display:none' : '' }}">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-sliders-h me-2"></i>
      Affiner la recherche
    </h3>
    <div class="homeswap-filters-block-content">

      {{-- Caractéristiques de l'établissement --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-school me-2"></i>
          Caractéristiques de l'établissement
        </label>
        <div class="homeswap-characteristics-grid">
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Capacité étudiants</label>
            <select name="ens_capacity" class="homeswap-filter-select">
              <option value="">Toutes</option>
              <option value="0-500" {{ request('ens_capacity') == '0-500' ? 'selected' : '' }}>Moins de 500</option>
              <option value="500-2000" {{ request('ens_capacity') == '500-2000' ? 'selected' : '' }}>500 – 2 000</option>
              <option value="2000-10000" {{ request('ens_capacity') == '2000-10000' ? 'selected' : '' }}>2 000 – 10 000</option>
              <option value="10000+" {{ request('ens_capacity') == '10000+' ? 'selected' : '' }}>10 000+</option>
            </select>
          </div>
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Type de structure</label>
            <select name="ens_type" class="homeswap-filter-select">
              <option value="">Tous</option>
              <option value="publique" {{ request('ens_type') == 'publique' ? 'selected' : '' }}>Publique</option>
              <option value="privee" {{ request('ens_type') == 'privee' ? 'selected' : '' }}>Privée</option>
              <option value="associative" {{ request('ens_type') == 'associative' ? 'selected' : '' }}>Associative</option>
              <option value="internationale" {{ request('ens_type') == 'internationale' ? 'selected' : '' }}>Internationale</option>
            </select>
          </div>
        </div>
      </div>

      {{-- Options spécifiques --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-star me-2"></i>
          Options spécifiques
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_options[]" value="internat" {{ in_array('internat', (array) request('ens_options', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Internat disponible</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_options[]" value="campus-international" {{ in_array('campus-international', (array) request('ens_options', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Campus international</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_options[]" value="accreditation" {{ in_array('accreditation', (array) request('ens_options', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Accréditation reconnue</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_options[]" value="bourses" {{ in_array('bourses', (array) request('ens_options', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Bourses / Aides disponibles</span>
          </label>
        </div>
      </div>

    </div>
  </div>

  {{-- BLOC 3 ENSEIGNEMENT : Critères avancés --}}
  <div class="homeswap-filters-block homeswap-filters-block-3" data-domain-block="enseignement" style="{{ request('nexus_domain') !== 'enseignement' ? 'display:none' : '' }}">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-cog me-2"></i>
      Critères avancés
    </h3>
    <div class="homeswap-filters-block-content">

      {{-- Équipements du campus --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-building me-2"></i>
          Équipements du campus
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_equipment[]" value="labo-sciences" {{ in_array('labo-sciences', (array) request('ens_equipment', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Laboratoire sciences</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_equipment[]" value="salle-info" {{ in_array('salle-info', (array) request('ens_equipment', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Salle informatique</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_equipment[]" value="bibliotheque" {{ in_array('bibliotheque', (array) request('ens_equipment', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Bibliothèque / CDI</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_equipment[]" value="gymnase" {{ in_array('gymnase', (array) request('ens_equipment', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Gymnase / Sport</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_equipment[]" value="amphitheatre" {{ in_array('amphitheatre', (array) request('ens_equipment', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Amphithéâtre</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_equipment[]" value="cantine" {{ in_array('cantine', (array) request('ens_equipment', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Cantine / Restaurant</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_equipment[]" value="fablab" {{ in_array('fablab', (array) request('ens_equipment', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">FabLab / Atelier</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input type="checkbox" name="ens_equipment[]" value="logements-etudiants" {{ in_array('logements-etudiants', (array) request('ens_equipment', [])) ? 'checked' : '' }} class="homeswap-checkbox-input">
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Logements étudiants</span>
          </label>
        </div>
      </div>

    </div>
  </div>

  {{-- Bouton Réinitialiser (ne modifie pas l'état ouvert/fermé du panneau) --}}
  <div class="homeswap-filters-actions">
    <button type="button" class="homeswap-reset-btn" id="homeswapResetFilters">
      <i class="fas fa-redo me-2"></i>
      Réinitialiser les filtres
    </button>
  </div>

  </div>{{-- fin .homeswap-filters-advanced-panel --}}

  {{-- JS : initialisation chips langue maternelle Homeswap (CECRL) --}}
  <script>
  (function initBesoinLanguesHomeswap() {
    document.addEventListener('DOMContentLoaded', function() {
      var chipsEl   = document.getElementById('besoin_lang_chips_homeswap');
      var addBtn    = document.getElementById('besoin_add_lang_btn_homeswap');
      var popover   = document.getElementById('cecrl_popover_homeswap');
      var hiddenInput = document.getElementById('other_languages_input_homeswap');
      if (!chipsEl || !addBtn || !popover || !hiddenInput) return;

      var langs = [];
      // Lire la valeur initiale depuis le champ caché
      try {
        var init = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];
        if (Array.isArray(init)) langs = init;
      } catch(e) {}

      function renderChips() {
        chipsEl.innerHTML = '';
        langs.forEach(function(item, i) {
          var chip = document.createElement('span');
          chip.className = 'besoin-lang-chip';
          chip.innerHTML = item.label + (item.level ? ' <em>' + item.level + '</em>' : '') + '<button type="button" class="besoin-lang-chip-remove" aria-label="Supprimer" data-index="' + i + '">&times;</button>';
          chipsEl.appendChild(chip);
        });
        hiddenInput.value = langs.length ? JSON.stringify(langs) : '';
        hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
      }

      function closePop() {
        popover.hidden = true;
        addBtn.setAttribute('aria-expanded', 'false');
      }

      addBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        var open = !popover.hidden;
        popover.hidden = open;
        addBtn.setAttribute('aria-expanded', String(!open));
        // Réinitialiser sélection
        document.querySelectorAll('#cecrl_popover_homeswap .cecrl-pill').forEach(function(p) { p.classList.remove('is-selected'); });
      });

      document.addEventListener('click', function(e) {
        if (!popover.contains(e.target) && e.target !== addBtn) closePop();
      });

      document.querySelectorAll('#cecrl_popover_homeswap .cecrl-pill').forEach(function(pill) {
        pill.addEventListener('click', function(e) {
          e.stopPropagation();
          var row   = pill.closest('.cecrl-row');
          var code  = row.getAttribute('data-lang');
          var lbl   = row.getAttribute('data-lang-label');
          var level = pill.getAttribute('data-level');
          // Supprimer si déjà présent
          langs = langs.filter(function(x) { return x.code !== code; });
          langs.push({ code: code, label: lbl, level: level });
          // Marquer la pill sélectionnée
          document.querySelectorAll('#cecrl_popover_homeswap .cecrl-row[data-lang="' + code + '"] .cecrl-pill').forEach(function(p) { p.classList.remove('is-selected'); });
          pill.classList.add('is-selected');
          renderChips();
          closePop();
        });
      });

      chipsEl.addEventListener('click', function(e) {
        var btn = e.target.closest('.besoin-lang-chip-remove');
        if (!btn) return;
        var idx = parseInt(btn.getAttribute('data-index'), 10);
        langs.splice(idx, 1);
        renderChips();
      });

      renderChips();
    });
  })();

  // ─── Délai minimum de réservation — slider live update ───
  (function() {
    var range = document.getElementById('hwDelayRange');
    var badge = document.getElementById('hwDelayBadge');
    var val   = document.getElementById('hwDelayVal');
    var hid   = document.getElementById('hwDelayHidden');
    if (!range) return;
    function updateUI() {
      var v = range.value;
      var pct = ((v - range.min) / (range.max - range.min) * 100).toFixed(2) + '%';
      range.style.setProperty('--pct', pct);
      if (badge) badge.textContent = v + ' j';
      if (val)   val.textContent   = v;
      if (hid)   hid.value = v;
    }
    updateUI();
    // input = mise à jour visuelle immédiate pendant le glissement
    range.addEventListener('input', updateUI);
    // change = déclenche l'autosave uniquement quand l'utilisateur relâche
    range.addEventListener('change', function () {
      if (hid) hid.dispatchEvent(new Event('change', { bubbles: true }));
    });
  })();
  </script>

  {{-- ─── Règles pill style (Critères avancés) ─── --}}
  <style>
    /* ─── Multi-périodes de disponibilité ─── */
    .hw-multiperiod-group { margin-bottom: 20px; }
    .hw-multiperiod-header {
      display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;
    }
    .hw-multiperiod-label {
      font-size: .74rem; font-weight: 700; letter-spacing: .05em;
      color: #6b7280; text-transform: uppercase;
    }
    .hw-add-period-btn {
      display: inline-flex; align-items: center; gap: 5px;
      background: linear-gradient(135deg, #EC4899, #db2777);
      color: #fff; border: none; border-radius: 20px;
      padding: 7px 15px; font-size: .8rem; font-weight: 700;
      cursor: pointer; transition: opacity .15s ease; white-space: nowrap;
    }
    .hw-add-period-btn:hover { opacity: .88; }
    .hw-periods-chips { display: flex; flex-wrap: wrap; gap: 8px; min-height: 4px; }
    .hw-period-chip {
      display: inline-flex; align-items: center; gap: 7px;
      background: linear-gradient(135deg, #fdf2f8, #fff);
      border: 1.5px solid #f9a8d4; border-radius: 20px;
      padding: 7px 10px 7px 12px; font-size: .84rem; font-weight: 600; color: #9d174d;
      animation: hwChipIn .2s ease;
    }
    @keyframes hwChipIn {
      from { opacity: 0; transform: translateY(-4px) scale(.95); }
      to   { opacity: 1; transform: none; }
    }
    .hw-period-chip-icon { font-size: .95rem; }
    .hw-period-chip-text { color: #831843; }
    .hw-period-chip-remove {
      display: inline-flex; align-items: center; justify-content: center;
      width: 20px; height: 20px; border-radius: 50%;
      background: rgba(236,72,153,.12); border: none; cursor: pointer;
      color: #EC4899; font-size: .9rem; font-weight: 700; line-height: 1;
      transition: background .15s ease, color .15s ease; flex-shrink: 0;
    }
    .hw-period-chip-remove:hover { background: #EC4899; color: #fff; }
    /* Input caché — le calendrier flatpickr inline est injecté dans #nxInlineCalendarTarget */
    .hw-period-picker-hidden { position: absolute; opacity: 0; width: 0; height: 0; overflow: hidden; pointer-events: none; }
    /* Calendrier inline dans le picker : scopé sur le container target */
    #nxInlineCalendarTarget .flatpickr-calendar {
      box-shadow: 0 4px 24px rgba(0,0,0,.1) !important;
      border-radius: 14px !important; border: 1.5px solid #f9a8d4 !important;
    }
    #nxInlineCalendarTarget .flatpickr-day.selected,
    #nxInlineCalendarTarget .flatpickr-day.startRange,
    #nxInlineCalendarTarget .flatpickr-day.endRange { background: #EC4899 !important; border-color: #EC4899 !important; }
    #nxInlineCalendarTarget .flatpickr-day.inRange   { background: rgba(236,72,153,.18) !important; box-shadow: none !important; }
    /* ─── Fréquence souhaitée ─── */
    .hw-freq-grid { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 4px; }
    .hw-freq-card {
      display: flex; flex-direction: row; align-items: center; gap: 8px;
      padding: 10px 16px; border: 1.5px solid #e5e7eb; background: #fff;
      border-radius: 12px; cursor: pointer; transition: all .18s ease;
      user-select: none;
    }
    .hw-freq-card:hover { border-color: rgba(236,72,153,.45); background: rgba(236,72,153,.03); }
    .hw-freq-input { display: none; }
    .hw-freq-card:has(.hw-freq-input:checked) {
      border-color: #EC4899; background: rgba(236,72,153,.06);
      box-shadow: 0 2px 10px rgba(236,72,153,.15);
    }
    .hw-freq-icon { font-size: 1.2rem; line-height: 1; flex-shrink: 0; }
    .hw-freq-text { display: flex; flex-direction: column; gap: 1px; }
    .hw-freq-label { font-weight: 700; font-size: .88rem; color: #111827; line-height: 1.2; }
    .hw-freq-card:has(.hw-freq-input:checked) .hw-freq-label { color: #EC4899; }
    .hw-freq-sub { font-size: .74rem; color: #9ca3af; line-height: 1.2; }
    .hw-freq-card:has(.hw-freq-input:checked) .hw-freq-sub { color: rgba(236,72,153,.7); }

    /* ─── Délai minimum de réservation ─── */
    .hw-delay-group { margin-top: 20px; margin-bottom: 28px; }
    .hw-delay-header { font-size: .74rem; font-weight: 700; letter-spacing: .04em; color: #6b7280; margin-bottom: 10px; }
    .hw-delay-title { color: #374151; text-transform: uppercase; }
    .hw-delay-desc { font-weight: 400; font-size: .82rem; text-transform: none; letter-spacing: 0; }
    .hw-delay-slider-wrap { display: flex; align-items: center; gap: 12px; }
    .hw-delay-range {
      flex: 1; -webkit-appearance: none; appearance: none; height: 4px; border-radius: 4px;
      background: linear-gradient(to right, #7c3aed 0%, #7c3aed var(--pct, 7.78%), #e5e7eb var(--pct, 7.78%), #e5e7eb 100%);
      outline: none; cursor: pointer;
    }
    .hw-delay-range::-webkit-slider-thumb {
      -webkit-appearance: none; width: 18px; height: 18px; border-radius: 50%;
      background: #7c3aed; cursor: pointer; box-shadow: 0 1px 6px rgba(124,58,237,.35);
      transition: transform .15s ease;
    }
    .hw-delay-range::-webkit-slider-thumb:hover { transform: scale(1.15); }
    .hw-delay-range::-moz-range-thumb {
      width: 18px; height: 18px; border: none; border-radius: 50%;
      background: #7c3aed; cursor: pointer; box-shadow: 0 1px 6px rgba(124,58,237,.35);
    }
    .hw-delay-badge { font-size: .82rem; font-weight: 700; color: #7c3aed; min-width: 38px; text-align: right; white-space: nowrap; }

    /* ─ Pill rose — toutes les cases à cocher du panneau filtre ─ */
    .homeswap-checkboxes-grid { display: flex; flex-wrap: wrap; gap: 8px; }
    .homeswap-checkbox-label {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 6px 13px;
      border: 1.5px solid #f3e8f0;
      background: #fdf9fc;
      color: #374151;
      border-radius: 10px;
      font-size: .84rem;
      cursor: pointer;
      transition: all .18s ease;
      white-space: nowrap;
      user-select: none;
    }
    .homeswap-checkbox-label:hover {
      border-color: rgba(236,72,153,.45);
      background: rgba(236,72,153,.05);
      color: #EC4899;
    }
    .homeswap-checkbox-input { position: absolute; opacity: 0; pointer-events: none; width: 0; height: 0; }
    .homeswap-checkbox-custom { display: none !important; }
    .homeswap-checkbox-input:checked + .homeswap-checkbox-custom + .homeswap-checkbox-text,
    .homeswap-checkbox-input:checked ~ .homeswap-checkbox-text { color: #EC4899; }
    .homeswap-checkbox-input:checked + * + .homeswap-checkbox-text { color: #EC4899; }
    .homeswap-checkbox-label:has(.homeswap-checkbox-input:checked) {
      border-color: #EC4899;
      background: rgba(236,72,153,.09);
      color: #EC4899;
      font-weight: 700;
      box-shadow: 0 2px 8px rgba(236,72,153,.18);
    }
    /* Dates flexibles / fixes dans le panneau date */
    .homeswap-date-options-group .homeswap-checkbox-label { white-space: nowrap; }
    /* Pills rules (déjà en place) */
    .hw-rule-grid { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 2px; }
    .hw-rule-input { display: none; }
    .hw-rule-label { display: inline-flex; align-items: center; gap: 5px; padding: 6px 13px; border: 1.5px solid #f3e8f0; background: #fdf9fc; color: #374151; border-radius: 10px; font-size: .84rem; cursor: pointer; transition: all .18s ease; white-space: nowrap; }
    .hw-rule-label:hover { border-color: rgba(236,72,153,.45); background: rgba(236,72,153,.05); color: #EC4899; }
    .hw-rule-input:checked + .hw-rule-label { border-color: #EC4899; background: rgba(236,72,153,.09); color: #EC4899; font-weight: 700; box-shadow: 0 2px 8px rgba(236,72,153,.18); }
  </style>

  {{-- ─── JS : système multi-périodes de disponibilité ─── --}}
  @if($openAdvanced)
  <script>
  (function () {
    function openAdvancedPanel() {
      var panel     = document.getElementById('homeswapAdvancedFiltersPanel');
      var toggleBtn = document.getElementById('homeswapToggleAdvancedFilters');
      if (!panel) return;
      panel.classList.add('is-open');
      panel.setAttribute('aria-hidden', 'false');
      panel.setAttribute('data-advanced-open', 'true');
      if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'true');
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', openAdvancedPanel);
    else openAdvancedPanel();
  })();
  </script>
  @endif

  <script>
  (function () {
    'use strict';

    function initNxMultiPeriod() {
      var addBtn      = document.getElementById('nxAddPeriodBtn');
      var pickerWrap  = document.getElementById('nxPeriodPickerWrap');
      var chipsEl     = document.getElementById('nxPeriodsChips');
      var periodsEl   = document.getElementById('nxPeriodsData');
      var startEl     = document.getElementById('homeswapStartDate');
      var endEl       = document.getElementById('homeswapEndDate');
      var datesDisp   = document.getElementById('homeswapDatesDisplay');

      if (!addBtn || !chipsEl || !periodsEl) return;

      // ── Init : liste depuis l'input caché (server-rendered) ──────────────
      var periods = [];
      try {
        var tmp = JSON.parse(periodsEl.value || '[]');
        if (Array.isArray(tmp)) periods = tmp;
      } catch (e) { periods = []; }

      // ── Migration automatique : start_date/end_date → première période ────
      // Si aucune période sauvegardée mais que start_date ET end_date existent,
      // on les convertit en première période sans déclencher d'autosave.
      if (periods.length === 0 && startEl && endEl && startEl.value && endEl.value) {
        periods.push({ start: startEl.value, end: endEl.value });
        periodsEl.value = JSON.stringify(periods);
        // (pas de commit() ici pour ne pas alterner les valeurs inutilement)
      }

      // ── Helpers ──────────────────────────────────────────────────
      function fmtLong(iso) {
        try { return new Date(iso + 'T12:00:00').toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' }); }
        catch (e) { return iso; }
      }
      function fmtShort(iso) {
        try { return new Date(iso + 'T12:00:00').toLocaleDateString('fr-FR', { day: 'numeric', month: 'short' }); }
        catch (e) { return iso; }
      }

      // ── Met à jour l'affichage du champ principal (sans autosave) ──────────
      function updateDisplay() {
        if (!datesDisp) return;
        if      (periods.length > 1)  datesDisp.value = periods.length + ' périodes de disponibilité';
        else if (periods.length === 1) datesDisp.value = 'Du ' + fmtShort(periods[0].start) + ' / Au ' + fmtLong(periods[0].end);
        else                           datesDisp.value = '';
      }

      // ── Synchronise l'input caché + start_date/end_date + barre principale ──
      function commit() {
        periodsEl.value = JSON.stringify(periods);
        if (periods.length > 0) {
          if (startEl) startEl.value = periods[0].start;
          if (endEl)   endEl.value   = periods[0].end;
          // Au premier ajout de période, prendre le contrôle du champ principal
          if (window.homeswapFlatpickrInstance) {
            try { window.homeswapFlatpickrInstance.destroy(); } catch(e) {}
            window.homeswapFlatpickrInstance = null;
          }
          if (datesDisp) {
            datesDisp.readOnly = true;
            datesDisp.style.cursor = 'pointer';
          }
        } else {
          if (startEl) startEl.value = '';
          if (endEl)   endEl.value   = '';
        }
        updateDisplay();
        // Déclenche l'autosave
        periodsEl.dispatchEvent(new Event('change', { bubbles: true }));
      }

      // ── Création d'un chip DOM ──────────────────────────────────
      function makeChip(period, idx) {
        var chip = document.createElement('div');
        chip.className = 'hw-period-chip';
        chip.innerHTML =
          '<span class="hw-period-chip-icon">📅</span>' +
          '<span class="hw-period-chip-text">' + fmtShort(period.start) + ' → ' + fmtLong(period.end) + '</span>' +
          '<button type="button" class="hw-period-chip-remove" aria-label="Supprimer">×</button>';
        chip.querySelector('.hw-period-chip-remove').addEventListener('click', function () {
          periods.splice(idx, 1);
          rebuildChips();
          commit();
        });
        return chip;
      }

      function rebuildChips() {
        chipsEl.innerHTML = '';
        periods.forEach(function (p, i) { chipsEl.appendChild(makeChip(p, i)); });
      }

      // ── Flatpickr : initialisation LAZY (uniquement quand le container est visible) ──
      var fp = null;

      function initFlatpickr() {
        if (fp) return; // déjà initialisé
        if (typeof window.flatpickr === 'undefined') {
          console.warn('NX: flatpickr non disponible');
          return;
        }
        // Crée un input temporaire DANS le wrapper (visible à ce stade)
        var inp = document.createElement('input');
        inp.type = 'text';
        inp.readOnly = true;
        inp.placeholder = 'Sélectionnez vos dates…';
        inp.style.cssText = 'width:100%;border:1.5px solid #f9a8d4;border-radius:10px;padding:10px 14px;font-size:.88rem;color:#374151;background:#fff;cursor:pointer;box-sizing:border-box;margin-bottom:8px';
        pickerWrap.insertBefore(inp, pickerWrap.firstChild);

        var locale = (window.flatpickr.l10ns && window.flatpickr.l10ns.fr)
          ? window.flatpickr.l10ns.fr : 'fr';

        fp = window.flatpickr(inp, {
          mode:              'range',
          dateFormat:        'Y-m-d',
          locale:            locale,
          inline:            true,
          monthSelectorType: 'static',
          minDate:           'today',
          onChange: function (sel) {
            if (sel.length !== 2) return;
            periods.push({
              start: sel[0].toISOString().split('T')[0],
              end:   sel[1].toISOString().split('T')[0]
            });
            rebuildChips();
            commit();
            // Ferme + réinitialise
            pickerWrap.style.display = 'none';
            addBtn.innerHTML = '<i class="fas fa-plus me-1"></i>Ajouter une période';
            fp.clear();
          }
        });
      }

      // ── Bouton + Ajouter ───────────────────────────────────────────
      addBtn.addEventListener('click', function () {
        var isOpen = pickerWrap.style.display !== 'none';
        if (isOpen) {
          pickerWrap.style.display = 'none';
          addBtn.innerHTML = '<i class="fas fa-plus me-1"></i>Ajouter une période';
          if (fp) fp.clear();
        } else {
          pickerWrap.style.display = 'block';
          addBtn.innerHTML = '<i class="fas fa-times me-1"></i>Annuler';
          // Init LAZY : flatpickr ne peut s'initialiser que dans un container visible
          initFlatpickr();
        }
      });

      // ── Hydrate les chips + contrôle champ principal ──────────────────────
      // Toujours actif (même si periods vient de la migration start/end ci-dessus)
      if (periods.length > 0) rebuildChips();
      updateDisplay();

      // Le champ "Du/Au" est géré exclusivement par le multi-période ici.
      // Un clic dessus ouvre le panneau avancé et scrolle vers le bouton Ajouter.
      if (datesDisp) {
        datesDisp.readOnly = true;
        datesDisp.style.cursor = 'pointer';
        datesDisp.addEventListener('click', function () {
          var panel     = document.getElementById('homeswapAdvancedFiltersPanel');
          var toggleBtn = document.getElementById('homeswapToggleAdvancedFilters');
          if (panel && !panel.classList.contains('is-open')) {
            panel.classList.add('is-open');
            panel.setAttribute('aria-hidden', 'false');
            panel.setAttribute('data-advanced-open', 'true');
            if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'true');
          }
          setTimeout(function () {
            addBtn.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }, 150);
        });
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initNxMultiPeriod);
    } else {
      initNxMultiPeriod();
    }
  })();
  </script>

</form>
