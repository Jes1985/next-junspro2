
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'formId' => 'preplyFiltersForm',
    'formAction' => route('services.homeswap'),
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'formId' => 'preplyFiltersForm',
    'formAction' => route('services.homeswap'),
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<form action="<?php echo e($formAction); ?>" method="GET" id="<?php echo e($formId); ?>" class="homeswap-filters-form" data-selected-city="<?php echo e(request('city')); ?>">
  
  <div class="filter-row-main homeswap-filter-row-main">
    <div class="filter-input-group" id="homeswapCountryGroup">
      <i class="fas fa-map-marker-alt filter-input-icon"></i>
      <select name="country" id="homeswapFilterCountry" class="filter-input filter-select-homeswap">
        <option value=""><?php echo e(__('Sélectionner un pays')); ?></option>
        <option value="FR" <?php echo e(request('country') == 'FR' ? 'selected' : ''); ?>><?php echo e(__('France')); ?></option>
        <option value="GP" <?php echo e(request('country') == 'GP' ? 'selected' : ''); ?>><?php echo e(__('Guadeloupe')); ?></option>
        <option value="MQ" <?php echo e(request('country') == 'MQ' ? 'selected' : ''); ?>><?php echo e(__('Martinique')); ?></option>
        <option value="GF" <?php echo e(request('country') == 'GF' ? 'selected' : ''); ?>><?php echo e(__('Guyane')); ?></option>
        <option value="RE" <?php echo e(request('country') == 'RE' ? 'selected' : ''); ?>><?php echo e(__('La Réunion')); ?></option>
        <option value="NC" <?php echo e(request('country') == 'NC' ? 'selected' : ''); ?>><?php echo e(__('Nouvelle-Calédonie')); ?></option>
        <option value="PF" <?php echo e(request('country') == 'PF' ? 'selected' : ''); ?>><?php echo e(__('Polynésie française')); ?></option>
        <option value="BE" <?php echo e(request('country') == 'BE' ? 'selected' : ''); ?>><?php echo e(__('Belgique')); ?></option>
        <option value="CH" <?php echo e(request('country') == 'CH' ? 'selected' : ''); ?>><?php echo e(__('Suisse')); ?></option>
        <option value="ES" <?php echo e(request('country') == 'ES' ? 'selected' : ''); ?>><?php echo e(__('Espagne')); ?></option>
        <option value="DE" <?php echo e(request('country') == 'DE' ? 'selected' : ''); ?>><?php echo e(__('Allemagne')); ?></option>
        <option value="IT" <?php echo e(request('country') == 'IT' ? 'selected' : ''); ?>><?php echo e(__('Italie')); ?></option>
        <option value="PT" <?php echo e(request('country') == 'PT' ? 'selected' : ''); ?>><?php echo e(__('Portugal')); ?></option>
        <option value="NL" <?php echo e(request('country') == 'NL' ? 'selected' : ''); ?>><?php echo e(__('Pays-Bas')); ?></option>
        <option value="GB" <?php echo e(request('country') == 'GB' ? 'selected' : ''); ?>><?php echo e(__('Royaume-Uni')); ?></option>
        <option value="CA" <?php echo e(request('country') == 'CA' ? 'selected' : ''); ?>><?php echo e(__('Canada')); ?></option>
        <option value="US" <?php echo e(request('country') == 'US' ? 'selected' : ''); ?>><?php echo e(__('États-Unis')); ?></option>
        <option value="MT" <?php echo e(request('country') == 'MT' ? 'selected' : ''); ?>><?php echo e(__('Malte')); ?></option>
        <option value="MC" <?php echo e(request('country') == 'MC' ? 'selected' : ''); ?>><?php echo e(__('Monaco')); ?></option>
        <option value="LU" <?php echo e(request('country') == 'LU' ? 'selected' : ''); ?>><?php echo e(__('Luxembourg')); ?></option>
        <option value="MA" <?php echo e(request('country') == 'MA' ? 'selected' : ''); ?>><?php echo e(__('Maroc')); ?></option>
        <option value="TN" <?php echo e(request('country') == 'TN' ? 'selected' : ''); ?>><?php echo e(__('Tunisie')); ?></option>
        <option value="SN" <?php echo e(request('country') == 'SN' ? 'selected' : ''); ?>><?php echo e(__('Sénégal')); ?></option>
        <option value="CI" <?php echo e(request('country') == 'CI' ? 'selected' : ''); ?>><?php echo e(__('Côte d\'Ivoire')); ?></option>
        <option value="IE" <?php echo e(request('country') == 'IE' ? 'selected' : ''); ?>><?php echo e(__('Irlande')); ?></option>
        <option value="HR" <?php echo e(request('country') == 'HR' ? 'selected' : ''); ?>><?php echo e(__('Croatie')); ?></option>
      </select>
    </div>
    <div class="filter-input-group" id="homeswapCityWrapper">
      <i class="fas fa-map-marker-alt filter-input-icon"></i>
      <select name="city" id="homeswapFilterCity" class="filter-input filter-select-homeswap homeswap-filter-select">
        <option value=""><?php echo e(__('Sélectionner une ville ou zone')); ?></option>
      </select>
    </div>
    <?php
      $datesDisplayValue = '';
      if (request('start_date') && request('end_date')) {
        try {
          $d1 = \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y');
          $d2 = \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y');
          $datesDisplayValue = "Du {$d1} / Au {$d2}";
        } catch (\Exception $e) {}
      }
    ?>
    <div class="filter-input-group homeswap-date-picker-wrapper">
      <i class="fas fa-calendar-alt filter-input-icon"></i>
      <input 
        type="text" 
        id="homeswapDatesDisplay"
        readonly
        placeholder="Du … / Au …"
        value="<?php echo e($datesDisplayValue); ?>"
        class="filter-input homeswap-date-display"
        autocomplete="off"
      >
      <i class="fas fa-calendar-alt homeswap-date-icon-right" id="homeswapDateIcon" aria-hidden="true"></i>
    </div>
    <button type="submit" class="filter-submit-btn">
      <i class="fas fa-search me-2"></i>
      <?php echo e(__('Rechercher')); ?>

    </button>
  </div>

  <input type="hidden" name="start_date" id="homeswapStartDate" value="<?php echo e(request('start_date')); ?>">
  <input type="hidden" name="end_date" id="homeswapEndDate" value="<?php echo e(request('end_date')); ?>">

  
  <div class="filter-advanced-toggle">
    <button type="button" class="filter-advanced-btn" id="homeswapToggleAdvancedFilters" aria-expanded="false" aria-controls="homeswapAdvancedFiltersPanel">
      <i class="fas fa-sliders-h me-2" aria-hidden="true"></i>
      <?php echo e(__('Filtres avancés')); ?>

      <i class="fas fa-chevron-down ms-2" id="homeswapAdvancedChevron" aria-hidden="true"></i>
    </button>
  </div>

  
  <div class="homeswap-filters-advanced-panel" id="homeswapAdvancedFiltersPanel" role="region" aria-label="Filtres avancés" aria-hidden="true" data-advanced-open="false">
    
    <div class="homeswap-filter-group homeswap-date-options-group">
      <input 
        type="text" 
        name="date_text" 
        id="homeswapDateText"
        value="<?php echo e(request('date_text')); ?>"
        placeholder="Dates (texte libre) – ex : Juillet 2026, flexible"
        class="homeswap-filter-input homeswap-date-text-input"
      >
      <div class="homeswap-date-options">
        <label class="homeswap-checkbox-label">
          <input type="checkbox" name="date_flexible" value="1" <?php echo e(request('date_flexible') ? 'checked' : ''); ?> class="homeswap-checkbox-input">
          <span class="homeswap-checkbox-custom"></span>
          <span class="homeswap-checkbox-text">Dates flexibles</span>
        </label>
        <label class="homeswap-checkbox-label">
          <input type="checkbox" name="date_fixed" value="1" <?php echo e(request('date_fixed') ? 'checked' : ''); ?> class="homeswap-checkbox-input">
          <span class="homeswap-checkbox-custom"></span>
          <span class="homeswap-checkbox-text">Dates fixes</span>
        </label>
      </div>
    </div>

    
    <div class="homeswap-filters-block homeswap-filters-block-1">
      <h3 class="homeswap-filters-block-title">
        <i class="fas fa-lightbulb me-2"></i>
        Je pose mon besoin
      </h3>
      <div class="homeswap-filters-block-content">
      
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
              <?php echo e(in_array('vacances', (array) request('trip_purpose', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('travail-distance', (array) request('trip_purpose', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('echange-linguistique', (array) request('trip_purpose', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('famille', (array) request('trip_purpose', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('etudes', (array) request('trip_purpose', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('repos-pause-souffle', (array) request('trip_purpose', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('autre', (array) request('trip_purpose', [])) ? 'checked' : ''); ?>

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
          value="<?php echo e(request('trip_purpose_other')); ?>"
          placeholder="Précisez votre objectif"
          class="homeswap-filter-input homeswap-conditional-input"
          style="display: <?php echo e(in_array('autre', (array) request('trip_purpose', [])) ? 'block' : 'none'); ?>; margin-top: 8px;"
        >
      </div>

      
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
              <?php echo e(in_array('simultane', (array) request('exchange_type', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('non-simultane', (array) request('exchange_type', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('points', (array) request('exchange_type', [])) ? 'checked' : ''); ?>

              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Échange à points</span>
          </label>
        </div>
      </div>

    </div>
  </div>

  
  <div class="homeswap-filters-block homeswap-filters-block-2">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-sliders-h me-2"></i>
      Affiner la recherche
    </h3>
    <div class="homeswap-filters-block-content">
      
      
      <div class="homeswap-filter-group">
        <label class="homeswap-filter-label">
          <i class="fas fa-home me-2"></i>
          Type de logement
        </label>
        <select name="accommodation_type" id="homeswapAccommodationType" class="homeswap-filter-select">
          <option value="">Tous les types</option>
          <option value="chambre" <?php echo e(request('accommodation_type') == 'chambre' ? 'selected' : ''); ?>>Chambre</option>
          <option value="studio" <?php echo e(request('accommodation_type') == 'studio' ? 'selected' : ''); ?>>Studio</option>
          <option value="appartement" <?php echo e(request('accommodation_type') == 'appartement' ? 'selected' : ''); ?>>Appartement</option>
          <option value="maison" <?php echo e(request('accommodation_type') == 'maison' ? 'selected' : ''); ?>>Maison</option>
          <option value="penthouse" <?php echo e(request('accommodation_type') == 'penthouse' ? 'selected' : ''); ?>>Penthouse</option>
          <option value="autre" <?php echo e(request('accommodation_type') == 'autre' ? 'selected' : ''); ?>>Autre</option>
        </select>
      </div>

      
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
              <option value="1" <?php echo e(request('bedrooms') == '1' ? 'selected' : ''); ?>>1</option>
              <option value="2" <?php echo e(request('bedrooms') == '2' ? 'selected' : ''); ?>>2</option>
              <option value="3" <?php echo e(request('bedrooms') == '3' ? 'selected' : ''); ?>>3</option>
              <option value="4" <?php echo e(request('bedrooms') == '4' ? 'selected' : ''); ?>>4+</option>
            </select>
          </div>
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Nombre de salles de bain</label>
            <select name="bathrooms" class="homeswap-filter-select">
              <option value="">Toutes</option>
              <option value="1" <?php echo e(request('bathrooms') == '1' ? 'selected' : ''); ?>>1</option>
              <option value="2" <?php echo e(request('bathrooms') == '2' ? 'selected' : ''); ?>>2</option>
              <option value="3" <?php echo e(request('bathrooms') == '3' ? 'selected' : ''); ?>>3+</option>
            </select>
          </div>
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Nombre d'adultes</label>
            <select name="adults" class="homeswap-filter-select">
              <option value="">Tous</option>
              <option value="1" <?php echo e(request('adults') == '1' ? 'selected' : ''); ?>>1</option>
              <option value="2" <?php echo e(request('adults') == '2' ? 'selected' : ''); ?>>2</option>
              <option value="3" <?php echo e(request('adults') == '3' ? 'selected' : ''); ?>>3+</option>
            </select>
          </div>
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Nombre d'enfants</label>
            <select name="children" class="homeswap-filter-select">
              <option value="">Tous</option>
              <option value="0" <?php echo e(request('children') == '0' ? 'selected' : ''); ?>>0</option>
              <option value="1" <?php echo e(request('children') == '1' ? 'selected' : ''); ?>>1</option>
              <option value="2" <?php echo e(request('children') == '2' ? 'selected' : ''); ?>>2+</option>
            </select>
          </div>
          <div class="homeswap-characteristic-item">
            <label class="homeswap-characteristic-label">Capacité d'accueil totale</label>
            <select name="capacity" class="homeswap-filter-select">
              <option value="">Toutes</option>
              <option value="1-2" <?php echo e(request('capacity') == '1-2' ? 'selected' : ''); ?>>1-2</option>
              <option value="3-4" <?php echo e(request('capacity') == '3-4' ? 'selected' : ''); ?>>3-4</option>
              <option value="5-6" <?php echo e(request('capacity') == '5-6' ? 'selected' : ''); ?>>5-6</option>
              <option value="7+" <?php echo e(request('capacity') == '7+' ? 'selected' : ''); ?>>7+</option>
            </select>
          </div>
        </div>
      </div>

    </div>
  </div>

  
  <div class="homeswap-filters-block homeswap-filters-block-3">
    <h3 class="homeswap-filters-block-title">
      <i class="fas fa-cog me-2"></i>
      Critères avancés
    </h3>
    <div class="homeswap-filters-block-content">
      
      
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
              <?php echo e(in_array('wifi', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('bureau', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('cuisine-equipee', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('lave-linge', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('lave-vaisselle', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('seche-linge', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('climatisation', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('chauffage', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('lit-bebe', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('television', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('parking', (array) request('equipment', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('ascenseur', (array) request('equipment', [])) ? 'checked' : ''); ?>

              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Ascenseur</span>
          </label>
        </div>
      </div>

      
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
              <?php echo e(in_array('balcon', (array) request('outdoor', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('terrasse', (array) request('outdoor', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('cour', (array) request('outdoor', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('jardin', (array) request('outdoor', [])) ? 'checked' : ''); ?>

              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Jardin</span>
          </label>
        </div>
      </div>

      
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
              <?php echo e(in_array('non-fumeurs', (array) request('rules', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('animaux-non-acceptes', (array) request('rules', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('enfants-acceptes', (array) request('rules', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('calme', (array) request('rules', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('teletravail', (array) request('rules', [])) ? 'checked' : ''); ?>

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
              <?php echo e(in_array('voisinage', (array) request('rules', [])) ? 'checked' : ''); ?>

              class="homeswap-checkbox-input"
            >
            <span class="homeswap-checkbox-custom"></span>
            <span class="homeswap-checkbox-text">Respect du voisinage requis</span>
          </label>
        </div>
      </div>

    </div>
  </div>

  
  <div class="homeswap-filters-actions">
    <button type="button" class="homeswap-reset-btn" id="homeswapResetFilters">
      <i class="fas fa-redo me-2"></i>
      Réinitialiser les filtres
    </button>
  </div>

  </div>

</form>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\filters\homeswap-filters.blade.php ENDPATH**/ ?>