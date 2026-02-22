@php
  $tripPurposes = [
    ['vacances', 'Vacances'],
    ['travail-distance', 'Travail à distance'],
    ['echange-linguistique', 'Échange linguistique'],
    ['famille', 'Famille'],
    ['etudes', 'Études'],
    ['repos-pause-souffle', 'Repos / Pause Souffle'],
    ['autre', 'Autre'],
  ];
  $exchangeTypes = [
    ['simultane', 'Échange simultané'],
    ['non-simultane', 'Échange non simultané'],
    ['points', 'Échange à points'],
  ];
  $accommodationTypes = [
    ['chambre', 'Chambre'],
    ['studio', 'Studio'],
    ['appartement', 'Appartement'],
    ['maison', 'Maison'],
    ['penthouse', 'Penthouse'],
    ['autre', 'Autre'],
  ];
  $equipmentList = [
    ['wifi', 'WiFi'], ['bureau', 'Bureau'], ['cuisine-equipee', 'Cuisine équipée'], ['lave-linge', 'Lave-linge'],
    ['lave-vaisselle', 'Lave-vaisselle'], ['seche-linge', 'Sèche-linge'], ['climatisation', 'Climatisation'], ['chauffage', 'Chauffage'],
    ['lit-bebe', 'Lit bébé'], ['television', 'Télévision'], ['parking', 'Parking'], ['ascenseur', 'Ascenseur'],
  ];
  $exteriorList = [
    ['balcon', 'Balcon'], ['terrasse', 'Terrasse'], ['cour', 'Cour'], ['jardin', 'Jardin'],
  ];
  $rulesList = [
    ['non-fumeurs', 'Non-fumeurs'], ['animaux-non-acceptes', 'Animaux non acceptés'], ['enfants-acceptes', 'Enfants acceptés'],
    ['logement-calme', 'Logement calme'], ['teletravail', 'Adapté au télétravail'], ['respect-voisinage', 'Respect du voisinage requis'],
  ];
  $selectedTrip = (array)($m['trip_purpose'] ?? []);
  $selectedExchange = (array)($m['exchange_type'] ?? []);
  $selectedEquipment = (array)($m['equipment'] ?? []);
  $selectedExterior = (array)($m['exterior'] ?? []);
  $selectedRules = (array)($m['rules'] ?? []);
  $selectedAccommodation = (string)($m['accommodation_type'] ?? '');
  $selectedBedrooms = (string)($m['bedrooms'] ?? '');
  $selectedBathrooms = (string)($m['bathrooms'] ?? '');
  $selectedAdults = (string)($m['adults'] ?? '');
  $selectedChildren = (string)($m['children'] ?? '');
  $selectedCapacity = (string)($m['capacity'] ?? '');
  $dateText = (string)($m['date_text'] ?? '');
  $dateFlexible = !empty($m['date_flexible'] ?? false);
  $dateFixed = !empty($m['date_fixed'] ?? false);
  $tripOther = (string)($m['trip_purpose_other'] ?? '');
@endphp

<div data-onboarding-universe="homeswap" class="homeswap-panel">
  <div class="homeswap-dropdown" data-homeswap-dropdown>
    <button type="button" class="homeswap-dropdown-toggle" data-homeswap-toggle aria-expanded="false">
      <span>Filtres HomeSwap</span>
      <span class="homeswap-dropdown-summary" data-homeswap-summary>Choix multiples (fermé)</span>
      <i class="fas fa-chevron-down" aria-hidden="true"></i>
    </button>
    <div class="homeswap-dropdown-panel" data-homeswap-panel aria-hidden="true">
      <div class="homeswap-section">
        <label class="homeswap-label">Dates (texte libre)</label>
        <input type="text" name="date_text" class="homeswap-input" placeholder="Dates (texte libre) – ex : Juillet 2026, flexible" value="{{ $dateText }}">
        <div class="homeswap-checkbox-row">
          <label class="homeswap-checkbox">
            <input type="checkbox" name="date_flexible" value="1" {{ $dateFlexible ? 'checked' : '' }}>
            <span>Dates flexibles</span>
          </label>
          <label class="homeswap-checkbox">
            <input type="checkbox" name="date_fixed" value="1" {{ $dateFixed ? 'checked' : '' }}>
            <span>Dates fixes</span>
          </label>
        </div>
      </div>

      <div class="homeswap-section">
        <label class="homeswap-section-title"><i class="fas fa-lightbulb me-2"></i>Je pose mon besoin</label>
        <div class="homeswap-grid">
          <div>
            <div class="homeswap-subtitle">Objectif du séjour</div>
            <div class="homeswap-checkbox-grid">
              @foreach($tripPurposes as [$value, $label])
                <label class="homeswap-checkbox">
                  <input type="checkbox" name="trip_purpose[]" value="{{ $value }}" {{ in_array($value, $selectedTrip, true) ? 'checked' : '' }} @if($value === 'autre') data-trip-purpose-autre @endif>
                  <span>{{ $label }}</span>
                </label>
              @endforeach
            </div>
            <input type="text" name="trip_purpose_other" data-trip-purpose-other class="homeswap-input" placeholder="Précisez votre objectif" value="{{ $tripOther }}" style="display: {{ in_array('autre', $selectedTrip, true) ? 'block' : 'none' }}; margin-top: 8px;">
          </div>
          <div>
            <div class="homeswap-subtitle">Type d'échange</div>
            <div class="homeswap-checkbox-grid">
              @foreach($exchangeTypes as [$value, $label])
                <label class="homeswap-checkbox">
                  <input type="checkbox" name="exchange_type[]" value="{{ $value }}" {{ in_array($value, $selectedExchange, true) ? 'checked' : '' }}>
                  <span>{{ $label }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="homeswap-section">
        <label class="homeswap-section-title"><i class="fas fa-sliders-h me-2"></i>Affiner la recherche</label>
        <div class="homeswap-grid">
          <div>
            <div class="homeswap-subtitle">Type de logement</div>
            <select name="accommodation_type" class="homeswap-select">
              <option value="">Tous les types</option>
              @foreach($accommodationTypes as [$value, $label])
                <option value="{{ $value }}" {{ $selectedAccommodation === $value ? 'selected' : '' }}>{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <div class="homeswap-subtitle">Nombre de chambres</div>
            <select name="bedrooms" class="homeswap-select">
              <option value="">Toutes</option>
              <option value="1" {{ $selectedBedrooms === '1' ? 'selected' : '' }}>1</option>
              <option value="2" {{ $selectedBedrooms === '2' ? 'selected' : '' }}>2</option>
              <option value="3" {{ $selectedBedrooms === '3' ? 'selected' : '' }}>3</option>
              <option value="4" {{ $selectedBedrooms === '4' ? 'selected' : '' }}>4+</option>
            </select>
          </div>
          <div>
            <div class="homeswap-subtitle">Salles de bain</div>
            <select name="bathrooms" class="homeswap-select">
              <option value="">Toutes</option>
              <option value="1" {{ $selectedBathrooms === '1' ? 'selected' : '' }}>1</option>
              <option value="2" {{ $selectedBathrooms === '2' ? 'selected' : '' }}>2</option>
              <option value="3" {{ $selectedBathrooms === '3' ? 'selected' : '' }}>3+</option>
            </select>
          </div>
          <div>
            <div class="homeswap-subtitle">Nombre d'adultes</div>
            <select name="adults" class="homeswap-select">
              <option value="">Tous</option>
              <option value="1" {{ $selectedAdults === '1' ? 'selected' : '' }}>1</option>
              <option value="2" {{ $selectedAdults === '2' ? 'selected' : '' }}>2</option>
              <option value="3" {{ $selectedAdults === '3' ? 'selected' : '' }}>3+</option>
            </select>
          </div>
          <div>
            <div class="homeswap-subtitle">Nombre d'enfants</div>
            <select name="children" class="homeswap-select">
              <option value="">Tous</option>
              <option value="0" {{ $selectedChildren === '0' ? 'selected' : '' }}>0</option>
              <option value="1" {{ $selectedChildren === '1' ? 'selected' : '' }}>1</option>
              <option value="2" {{ $selectedChildren === '2' ? 'selected' : '' }}>2+</option>
            </select>
          </div>
          <div>
            <div class="homeswap-subtitle">Capacité totale</div>
            <select name="capacity" class="homeswap-select">
              <option value="">Toutes</option>
              <option value="1-2" {{ $selectedCapacity === '1-2' ? 'selected' : '' }}>1-2</option>
              <option value="3-4" {{ $selectedCapacity === '3-4' ? 'selected' : '' }}>3-4</option>
              <option value="5-6" {{ $selectedCapacity === '5-6' ? 'selected' : '' }}>5-6</option>
              <option value="7+" {{ $selectedCapacity === '7+' ? 'selected' : '' }}>7+</option>
            </select>
          </div>
        </div>
      </div>

      <div class="homeswap-section">
        <label class="homeswap-section-title"><i class="fas fa-cog me-2"></i>Critères avancés</label>
        <div class="homeswap-grid">
          <div>
            <div class="homeswap-subtitle">Équipements & confort</div>
            <div class="homeswap-checkbox-grid">
              @foreach($equipmentList as [$value, $label])
                <label class="homeswap-checkbox">
                  <input type="checkbox" name="equipment[]" value="{{ $value }}" {{ in_array($value, $selectedEquipment, true) ? 'checked' : '' }}>
                  <span>{{ $label }}</span>
                </label>
              @endforeach
            </div>
          </div>
          <div>
            <div class="homeswap-subtitle">Espaces extérieurs</div>
            <div class="homeswap-checkbox-grid">
              @foreach($exteriorList as [$value, $label])
                <label class="homeswap-checkbox">
                  <input type="checkbox" name="exterior[]" value="{{ $value }}" {{ in_array($value, $selectedExterior, true) ? 'checked' : '' }}>
                  <span>{{ $label }}</span>
                </label>
              @endforeach
            </div>
          </div>
          <div>
            <div class="homeswap-subtitle">Règles & préférences</div>
            <div class="homeswap-checkbox-grid">
              @foreach($rulesList as [$value, $label])
                <label class="homeswap-checkbox">
                  <input type="checkbox" name="rules[]" value="{{ $value }}" {{ in_array($value, $selectedRules, true) ? 'checked' : '' }}>
                  <span>{{ $label }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<style>
  .homeswap-panel { padding: 12px 0; }
  .homeswap-dropdown { position: relative; }
  .homeswap-dropdown-toggle { width: 100%; display: flex; justify-content: space-between; align-items: center; gap: 8px; padding: 12px 14px; border: 1px solid #E5E7EB; border-radius: 10px; background: #FFF; color: #111827; font-weight: 600; cursor: pointer; }
  .homeswap-dropdown-toggle i { color: #6B7280; }
  .homeswap-dropdown-summary { font-weight: 400; color: #6B7280; font-size: 13px; }
  .homeswap-dropdown-panel { margin-top: 10px; padding: 16px; border: 1px solid #E5E7EB; border-radius: 12px; background: #F9FAFB; display: none; }
  .homeswap-dropdown.is-open .homeswap-dropdown-panel { display: block; }
  .homeswap-section { margin-bottom: 14px; }
  .homeswap-label { display: block; font-weight: 600; margin-bottom: 6px; color: #111827; }
  .homeswap-section-title { display: inline-flex; align-items: center; gap: 6px; font-weight: 700; color: #111827; margin-bottom: 8px; }
  .homeswap-subtitle { font-weight: 600; color: #374151; margin-bottom: 6px; }
  .homeswap-input { width: 100%; border: 1px solid #E5E7EB; border-radius: 8px; padding: 10px; font-size: 14px; }
  .homeswap-select { width: 100%; border: 1px solid #E5E7EB; border-radius: 8px; padding: 9px 10px; font-size: 14px; background: #FFF; }
  .homeswap-checkbox-row { display: flex; gap: 14px; flex-wrap: wrap; margin-top: 8px; }
  .homeswap-checkbox-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 8px 12px; }
  .homeswap-checkbox { display: inline-flex; align-items: center; gap: 8px; font-size: 14px; color: #374151; }
  .homeswap-checkbox input { width: 16px; height: 16px; }
  .homeswap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 14px; align-items: start; }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const root = document.querySelector('[data-onboarding-universe="homeswap"]');
    if (!root) return;
    const dropdown = root.querySelector('[data-homeswap-dropdown]');
    const toggle = root.querySelector('[data-homeswap-toggle]');
    const panel = root.querySelector('[data-homeswap-panel]');
    const summary = root.querySelector('[data-homeswap-summary]');
    const autre = root.querySelector('[data-trip-purpose-autre]');
    const autreInput = root.querySelector('[data-trip-purpose-other]');

    function updateSummary() {
      if (!summary) return;
      const checked = root.querySelectorAll('input[type="checkbox"]:checked').length;
      const filledSelects = Array.from(root.querySelectorAll('select')).filter(sel => sel.value).length;
      const filledText = Array.from(root.querySelectorAll('input[type="text"]')).filter(inp => (inp.value || '').trim() !== '').length;
      const total = checked + filledSelects + filledText;
      summary.textContent = total ? `${total} critère(s) sélectionné(s)` : 'Choix multiples (aucun)';
    }

    if (toggle && dropdown) {
      toggle.addEventListener('click', function() {
        const isOpen = dropdown.classList.toggle('is-open');
        if (panel) panel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
        toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      });
      document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target)) {
          dropdown.classList.remove('is-open');
          if (panel) panel.setAttribute('aria-hidden', 'true');
          if (toggle) toggle.setAttribute('aria-expanded', 'false');
        }
      });
    }

    if (autre && autreInput) {
      function syncAutre() {
        const active = autre.checked;
        autreInput.style.display = active ? 'block' : 'none';
        if (!active) autreInput.value = '';
      }
      autre.addEventListener('change', function() { syncAutre(); updateSummary(); });
      syncAutre();
    }

    root.querySelectorAll('input, select').forEach(function(el) {
      el.addEventListener('change', updateSummary);
      if (el.type === 'text') {
        el.addEventListener('input', updateSummary);
      }
    });

    updateSummary();
  });
</script>
