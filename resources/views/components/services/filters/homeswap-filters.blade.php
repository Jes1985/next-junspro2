{{-- Composant filtres HomeSwap - Structure en 3 blocs premium --}}
@props([
    'formId' => 'preplyFiltersForm',
    'formAction' => route('services.homeswap'),
])

<form action="{{ $formAction }}" method="GET" id="{{ $formId }}" class="homeswap-filters-form" data-selected-city="{{ request('city') }}">
  {{-- Barre de recherche principale : une ligne (design Projets / capture 2) --}}
  <div class="filter-row-main homeswap-filter-row-main">
    <div class="filter-input-group" id="homeswapCountryGroup">
      <i class="fas fa-map-marker-alt filter-input-icon"></i>
      <select name="country" id="homeswapFilterCountry" class="filter-input filter-select-homeswap">
        <option value="">{{ __('Sélectionner un pays') }}</option>
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
    <div class="filter-input-group" id="homeswapCityWrapper">
      <i class="fas fa-map-marker-alt filter-input-icon"></i>
      <select name="city" id="homeswapFilterCity" class="filter-input filter-select-homeswap homeswap-filter-select">
        <option value="">{{ __('Sélectionner une ville ou zone') }}</option>
      </select>
    </div>
    @php
      $datesDisplayValue = '';
      if (request('start_date') && request('end_date')) {
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

  <input type="hidden" name="start_date" id="homeswapStartDate" value="{{ request('start_date') }}">
  <input type="hidden" name="end_date" id="homeswapEndDate" value="{{ request('end_date') }}">

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
    {{-- Options dates (texte libre + flexibles / fixes) --}}
    <div class="homeswap-filter-group homeswap-date-options-group">
      <input 
        type="text" 
        name="date_text" 
        id="homeswapDateText"
        value="{{ request('date_text') }}"
        placeholder="Dates (texte libre) – ex : Juillet 2026, flexible"
        class="homeswap-filter-input homeswap-date-text-input"
      >
      <div class="homeswap-date-options">
        <label class="homeswap-checkbox-label">
          <input type="checkbox" name="date_flexible" value="1" {{ request('date_flexible') ? 'checked' : '' }} class="homeswap-checkbox-input">
          <span class="homeswap-checkbox-custom"></span>
          <span class="homeswap-checkbox-text">Dates flexibles</span>
        </label>
        <label class="homeswap-checkbox-label">
          <input type="checkbox" name="date_fixed" value="1" {{ request('date_fixed') ? 'checked' : '' }} class="homeswap-checkbox-input">
          <span class="homeswap-checkbox-custom"></span>
          <span class="homeswap-checkbox-text">Dates fixes</span>
        </label>
      </div>
    </div>

    {{-- BLOC 1 : Je pose mon besoin (Objectif, Type d'échange) --}}
    <div class="homeswap-filters-block homeswap-filters-block-1">
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
            <span class="homeswap-checkbox-text">Vacances</span>
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
            <span class="homeswap-checkbox-text">Travail à distance</span>
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
            <span class="homeswap-checkbox-text">Échange linguistique</span>
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
            <span class="homeswap-checkbox-text">Famille</span>
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
            <span class="homeswap-checkbox-text">Études</span>
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
            <span class="homeswap-checkbox-text">Repos / Pause Souffle</span>
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
            <span class="homeswap-checkbox-text">Autre</span>
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
            <span class="homeswap-checkbox-text">Échange simultané</span>
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
            <span class="homeswap-checkbox-text">Échange non simultané</span>
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
            <span class="homeswap-checkbox-text">Échange à points</span>
          </label>
        </div>
      </div>

    </div>
  </div>

  {{-- ============================================
      BLOC 2 : AFFINER LA RECHERCHE
      ============================================ --}}
  <div class="homeswap-filters-block homeswap-filters-block-2">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-sliders-h me-2"></i>
      Affiner la recherche
    </h3>
    <div class="homeswap-filters-block-content">
      
      {{-- Type de logement --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-home me-2"></i>
          Type de logement
        </label>
        <select name="accommodation_type" id="homeswapAccommodationType" class="homeswap-filter-select">
          <option value="">Tous les types</option>
          <option value="chambre" {{ request('accommodation_type') == 'chambre' ? 'selected' : '' }}>Chambre</option>
          <option value="studio" {{ request('accommodation_type') == 'studio' ? 'selected' : '' }}>Studio</option>
          <option value="appartement" {{ request('accommodation_type') == 'appartement' ? 'selected' : '' }}>Appartement</option>
          <option value="maison" {{ request('accommodation_type') == 'maison' ? 'selected' : '' }}>Maison</option>
          <option value="penthouse" {{ request('accommodation_type') == 'penthouse' ? 'selected' : '' }}>Penthouse</option>
          <option value="autre" {{ request('accommodation_type') == 'autre' ? 'selected' : '' }}>Autre</option>
        </select>
      </div>

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
      BLOC 3 : CRITÈRES AVANCÉS
      ============================================ --}}
  <div class="homeswap-filters-block homeswap-filters-block-3">
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
            <span class="homeswap-checkbox-text">WiFi</span>
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
            <span class="homeswap-checkbox-text">Bureau</span>
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
            <span class="homeswap-checkbox-text">Cuisine équipée</span>
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
            <span class="homeswap-checkbox-text">Lave-linge</span>
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
            <span class="homeswap-checkbox-text">Lave-vaisselle</span>
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
            <span class="homeswap-checkbox-text">Sèche-linge</span>
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
            <span class="homeswap-checkbox-text">Climatisation</span>
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
            <span class="homeswap-checkbox-text">Chauffage</span>
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
            <span class="homeswap-checkbox-text">Lit bébé</span>
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
            <span class="homeswap-checkbox-text">Télévision</span>
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
            <span class="homeswap-checkbox-text">Parking</span>
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
            <span class="homeswap-checkbox-text">Ascenseur</span>
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
            <span class="homeswap-checkbox-text">Balcon</span>
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
            <span class="homeswap-checkbox-text">Terrasse</span>
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
            <span class="homeswap-checkbox-text">Cour</span>
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
            <span class="homeswap-checkbox-text">Jardin</span>
          </label>
        </div>
      </div>

      {{-- Règles & préférences --}}
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-shield-alt me-2"></i>
          Règles & préférences
        </label>
        <div class="homeswap-checkboxes-grid">
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="rules[]" 
              value="non-fumeurs" 
              {{ in_array('non-fumeurs', (array) request('rules', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Non-fumeurs</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="rules[]" 
              value="animaux-non-acceptes" 
              {{ in_array('animaux-non-acceptes', (array) request('rules', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Animaux non acceptés</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="rules[]" 
              value="enfants-acceptes" 
              {{ in_array('enfants-acceptes', (array) request('rules', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Enfants acceptés</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="rules[]" 
              value="calme" 
              {{ in_array('calme', (array) request('rules', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Logement calme</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="rules[]" 
              value="teletravail" 
              {{ in_array('teletravail', (array) request('rules', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Adapté au télétravail</span>
          </label>
          <label class="homeswap-checkbox-label">
            <input 
              type="checkbox" 
              name="rules[]" 
              value="voisinage" 
              {{ in_array('voisinage', (array) request('rules', [])) ? 'checked' : '' }}
              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Respect du voisinage requis</span>
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

</form>
