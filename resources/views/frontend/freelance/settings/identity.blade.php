@extends('frontend.freelance.layouts.app')

@section('content')
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <div style="margin-bottom: 2rem;">
      <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;">Identité professionnelle</h1>
      <p style="color: #6b7280; font-size: 1rem;">Nom public, localisation, langue, activité.</p>
    </div>

    @if(session('success'))
      <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        {{ session('error') }}
      </div>
    @endif

    <div style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
      <form id="identitySettingsForm" method="POST" action="{{ route('user.update_profile') }}">
        @csrf

        <div style="margin-bottom: 2rem;">
          <label for="first_name" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            Prénom
          </label>
          <input 
            type="text" 
            id="first_name" 
            name="first_name" 
            value="{{ old('first_name', $user->first_name ?? '') }}"
            placeholder="Votre prénom"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="@error('first_name') border-red-500 @enderror"
            required
          >
          @error('first_name')
            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
          @enderror
        </div>

        <div style="margin-bottom: 0;">
          <label for="last_name" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            Nom
          </label>
          <input 
            type="text" 
            id="last_name" 
            name="last_name" 
            value="{{ old('last_name', $user->last_name ?? '') }}"
            placeholder="Votre nom"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="@error('last_name') border-red-500 @enderror"
            required
          >
          @error('last_name')
            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
          @enderror
        </div>

        {{-- ── Bloc langues (même design que lessons /services) ── --}}
        @php
          $__besoin_languages = ['fr' => 'Français', 'en' => 'Anglais', 'es' => 'Espagnol', 'de' => 'Allemand', 'it' => 'Italien', 'pt' => 'Portugais', 'nl' => 'Néerlandais', 'ru' => 'Russe', 'zh' => 'Chinois', 'ar' => 'Arabe', 'ja' => 'Japonais', 'pl' => 'Polonais', 'el' => 'Grec', 'tr' => 'Turc', 'sv' => 'Suédois', 'ko' => 'Coréen', 'hi' => 'Hindi'];
          $__cecrl_levels = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
          $__savedNative  = old('native_language',  $freelancerProfile?->native_language  ?? '');
          $__savedOthers  = old('other_languages',  $freelancerProfile?->spoken_languages ?? '');
        @endphp
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e7eb;">
          <div class="filter-group besoin-langues filter-group--full">
            <label class="filter-label"><i class="fas fa-language me-2"></i>Ma langue maternelle</label>
            <div class="besoin-langues-row">
              <div class="besoin-mother-tongue-wrap">
                <select name="native_language" id="identity_mother_tongue" class="filter-select">
                  <option value="">{{ __('Langue maternelle') }}</option>
                  @foreach($__besoin_languages as $__code => $__label)
                    <option value="{{ $__code }}" {{ $__savedNative === $__code ? 'selected' : '' }}>{{ $__label }}</option>
                  @endforeach
                </select>
              </div>
              <div class="besoin-other-langs-wrap" id="identity_other_langs_wrap">
                <span class="besoin-other-langs-label">Autres langues parlées</span>
                <div class="besoin-lang-chips" id="identity_lang_chips"></div>
                <button type="button" class="besoin-add-lang-btn" id="identity_add_lang_btn" aria-haspopup="true" aria-expanded="false">+ Ajouter</button>
                <input type="hidden" name="other_languages" id="identity_other_languages_input" value="{{ $__savedOthers }}">
                <div class="cecrl-popover" id="identity_cecrl_popover" role="dialog" aria-label="Niveaux CECRL" hidden>
                  <div class="cecrl-popover-inner">
                    <div class="cecrl-table">
                      <div class="cecrl-table-head">
                        <span class="cecrl-th-lang">Langue</span>
                        <span class="cecrl-th-level">Niveau</span>
                      </div>
                      @foreach($__besoin_languages as $__code => $__label)
                      <div class="cecrl-row" data-lang="{{ $__code }}" data-lang-label="{{ $__label }}">
                        <span class="cecrl-lang">{{ $__label }}</span>
                        <div class="cecrl-pills">
                          @foreach($__cecrl_levels as $__l)
                          <button type="button" class="cecrl-pill" data-level="{{ $__l }}" title="{{ $__l }}">{{ $__l }}</button>
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
        </div>

        {{-- Script inline langues identité – placé ici pour que les éléments soient déjà dans le DOM --}}
        <script>
        (function() {
          var chipsEl    = document.getElementById('identity_lang_chips');
          var addBtn     = document.getElementById('identity_add_lang_btn');
          var popover    = document.getElementById('identity_cecrl_popover');
          var hiddenInput = document.getElementById('identity_other_languages_input');
          if (!chipsEl || !addBtn || !popover || !hiddenInput) return;

          var otherLangs = [];

          function parseOtherLangs() {
            var s = (hiddenInput.value || '').trim();
            if (!s) return [];
            return s.split(',').filter(Boolean).map(function(p) {
              var parts = p.split(':');
              var code  = (parts[0] || '').trim();
              var level = (parts[1] || '').trim();
              var row   = popover.querySelector('.cecrl-row[data-lang="' + code.replace(/"/g, '\\"') + '"]');
              return { code: code, label: (row && row.dataset.langLabel) || code, level: level };
            }).filter(function(x) { return x.code && x.level; });
          }

          function syncHidden() {
            hiddenInput.value = otherLangs.map(function(x) { return x.code + ':' + x.level; }).join(',');
          }

          function renderChips() {
            chipsEl.innerHTML = '';
            otherLangs.forEach(function(x) {
              var chip = document.createElement('span');
              chip.className = 'besoin-lang-chip';
              chip.innerHTML = '<span>' + (x.label || x.code) + ' \u00b7 ' + x.level + '</span> <button type="button" class="besoin-lang-chip-remove" aria-label="Retirer">\u00d7</button>';
              chip.querySelector('.besoin-lang-chip-remove').addEventListener('click', function() {
                otherLangs = otherLangs.filter(function(l) { return l.code !== x.code; });
                renderChips(); syncHidden(); updatePillsSelected();
              });
              chipsEl.appendChild(chip);
            });
          }

          function updatePillsSelected() {
            popover.querySelectorAll('.cecrl-pill').forEach(function(p) { p.classList.remove('is-selected'); });
            otherLangs.forEach(function(x) {
              var pill = popover.querySelector('.cecrl-row[data-lang="' + x.code + '"] .cecrl-pill[data-level="' + x.level + '"]');
              if (pill) pill.classList.add('is-selected');
            });
          }

          function openPopover() {
            popover.removeAttribute('hidden');
            popover.style.display = 'block';
            addBtn.setAttribute('aria-expanded', 'true');
            updatePillsSelected();
          }

          function closePopover() {
            popover.style.display = 'none';
            popover.setAttribute('hidden', '');
            addBtn.setAttribute('aria-expanded', 'false');
          }

          addBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (!popover.hasAttribute('hidden')) closePopover(); else openPopover();
          });

          document.addEventListener('click', function(e) {
            if (popover.hasAttribute('hidden')) return;
            if (popover.contains(e.target) || addBtn.contains(e.target)) return;
            closePopover();
          });

          popover.querySelectorAll('.cecrl-pill').forEach(function(p) {
            p.addEventListener('click', function(e) {
              e.stopPropagation();
              var row   = this.closest('.cecrl-row');
              if (!row) return;
              var code  = row.dataset.lang  || '';
              var label = row.dataset.langLabel || code;
              var level = this.dataset.level || '';
              var idx = otherLangs.findIndex(function(x) { return x.code === code; });
              if (idx >= 0) otherLangs[idx].level = level; else otherLangs.push({ code: code, label: label, level: level });
              renderChips(); syncHidden(); updatePillsSelected();
            });
          });

          otherLangs = parseOtherLangs();
          renderChips();
          syncHidden();
        })();
        </script>

        <input type="hidden" name="_redirect" value="{{ route('freelance.dashboard', ['tab' => 'settings']) }}">

        {{-- Calcul des valeurs actuelles du profil freelance --}}
        @php
          $currentUniverse = ($freelancerProfile?->universes ?? [])[0] ?? '';
          $currentDomain   = ($freelancerProfile?->domains ?? [])[0] ?? '';
          $canOnline  = $freelancerProfile?->can_online ?? true;
          $canOnsite  = $freelancerProfile?->can_onsite ?? false;
          $currentMode = (!$canOnline && $canOnsite) ? 'onsite' : 'online';
          // Pays & Ville : lus depuis freelancer_profiles (onsite_country / onsite_city)
          // car users.country_code n'existe pas et users.city n'est pas la source fiable
          $currentCountry = $freelancerProfile?->onsite_country ?? 'FR';
          $currentCity    = $freelancerProfile?->onsite_city    ?? '';
        @endphp

        {{-- Inputs cachés synchronisés avec le tableau de filtres --}}
        <input type="hidden" id="hidden_city"             name="city"             value="{{ old('city',             $currentCity) }}">
        <input type="hidden" id="hidden_country_code"    name="country_code"    value="{{ old('country_code',    $currentCountry) }}">
        <input type="hidden" id="hidden_profile_universe" name="profile_universe" value="{{ old('profile_universe', $currentUniverse) }}">
        <input type="hidden" id="hidden_profile_domain"   name="profile_domain"   value="{{ old('profile_domain',   $currentDomain) }}">
        <input type="hidden" id="hidden_profile_mode"     name="profile_mode"     value="{{ old('profile_mode',     $currentMode) }}">

      </form>
    </div>

    <!-- Séparateur -->
    <div style="margin: 2rem 0; border-top: 1px solid #e5e7eb;"></div>

    {{-- Tableau de Filtres - HORS du formulaire POST, exactement comme sur la page d'accueil --}}
    {{-- Les props initial* permettent la présélection SERVEUR-SIDE (comme prénom/nom) sans dépendre du JS --}}
    <div class="container" style="position:relative;z-index:10;">
      <x-home.search-filter
        formId="settingsSearchFilter"
        :formAction="route('services')"
        universe="hub"
        :hubUniverses="$hubUniverses ?? []"
        :hubUniverseDomains="$hubUniverseDomains ?? []"
        :initialUniverse="old('profile_universe', $currentUniverse ?? '')"
        :initialDomain="old('profile_domain',   $currentDomain ?? '')"
        :initialMode="old('profile_mode',       $currentMode ?? 'online')"
        keywordPlaceholder="Essayez « Pilates », « Marketing Digital », « Anglais »..."
        locationPlaceholder="Lieu de la mission (ex: Paris, Lyon...)"
      />
    </div>

    <!-- Boutons Enregistrer/Annuler sous le tableau de filtres -->
    <div style="display: flex; gap: 1rem; align-items: center; margin-top: 2rem;">
      <button 
        type="submit"
        form="identitySettingsForm"
        style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); color: white; padding: 0.75rem 2rem; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;"
        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(79, 70, 229, 0.3)';"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
      >
        Enregistrer
      </button>
      <a 
        href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" 
        style="color: #6b7280; text-decoration: none; font-weight: 500; padding: 0.75rem 1.5rem; border-radius: 8px; transition: background-color 0.2s;"
        onmouseover="this.style.backgroundColor='#f3f4f6';"
        onmouseout="this.style.backgroundColor='transparent';"
      >
        Annuler
      </a>
    </div>

  </div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {

  // --- Masquer le bouton Rechercher dans le tableau des filtres ---
  var submitBtn = document.querySelector('#settingsSearchFilter .filter-submit-btn');
  if (submitBtn) submitBtn.style.display = 'none';

  // --- Renommer l'onglet "Rechercher un Rituel" → "Qui suis-je ?" ---
  var tabSearch = document.getElementById('tabSearch');
  if (tabSearch) {
    tabSearch.childNodes.forEach(function(node) {
      if (node.nodeType === Node.TEXT_NODE && node.textContent.trim() !== '') {
        node.textContent = ' Qui suis-je ?';
      }
    });
  }

  // --- Références aux éléments du filtre hub ---
  var countrySelect  = document.getElementById('hubFilterCountry');
  var citySelect     = document.getElementById('hubFilterCity');
  var universSelect  = document.getElementById('hubHeroUniversSelect');
  var domainSelect   = document.getElementById('hubHeroSpecializationSelect');
  var modeRadios     = document.querySelectorAll('#settingsSearchFilter .mode-intervention-radio');
  var modePills      = document.querySelectorAll('#settingsSearchFilter .mode-intervention-pill');

  // --- Références aux inputs cachés ---
  var hiddenCity      = document.getElementById('hidden_city');
  var hiddenCountry   = document.getElementById('hidden_country_code');
  var hiddenUniverse  = document.getElementById('hidden_profile_universe');
  var hiddenDomain    = document.getElementById('hidden_profile_domain');
  var hiddenMode      = document.getElementById('hidden_profile_mode');

  // ============================================================
  // PRÉ-REMPLISSAGE DU FILTRE depuis les valeurs actuelles du profil
  // Délai 350ms pour laisser les scripts cascade du composant s'initialiser
  // ============================================================
  var savedUniverseVal = hiddenUniverse ? hiddenUniverse.value : '';
  var savedDomainVal   = hiddenDomain   ? hiddenDomain.value   : '';
  var savedCountryVal  = hiddenCountry  ? hiddenCountry.value  : '';
  var savedCityVal     = hiddenCity     ? hiddenCity.value     : '';

  setTimeout(function () {

    // ── 1. MODE D'INTERVENTION ──────────────────────────────────
    // On dispatche le change pour que updateLocationFields() active/désactive
    // country & city correctement (sinon le composant reste sur son état par défaut)
    var savedMode = hiddenMode ? hiddenMode.value : 'online';
    modeRadios.forEach(function (radio) {
      radio.checked = (radio.value === savedMode);
      if (radio.value === savedMode) {
        radio.dispatchEvent(new Event('change', { bubbles: true }));
      }
    });

    // ── 2. PAYS & VILLE (uniquement si mode "En présentiel") ─────
    // La cascade pays→ville du hub (updateCities) est synchrone et statique.
    // On ne tente pas de remplir pays/ville si mode=online (ils sont désactivés).
    if (savedMode === 'onsite' && countrySelect && savedCountryVal) {
      countrySelect.value = savedCountryVal;
      countrySelect.dispatchEvent(new Event('change', { bubbles: true }));
      // Ville : attend que updateCities() ait peuplé les options (synchrone mais
      // on veut être sûrs que le disabled a été retiré avant de fixer la valeur)
      if (citySelect && savedCityVal) {
        var cityAttempts = 0;
        var cityInterval = setInterval(function () {
          cityAttempts++;
          if (citySelect.querySelector('option[value="' + savedCityVal + '"]')) {
            citySelect.value = savedCityVal;
            if (hiddenCity) hiddenCity.value = savedCityVal;
            clearInterval(cityInterval);
          }
          if (cityAttempts > 20) clearInterval(cityInterval);
        }, 150);
      }
    }

    // ── 3. UNIVERS → DOMAINE ─────────────────────────────────────
    // Astuce : on positionne data-initial-specialization sur le wrapper AVANT
    // de dispatcher change, ainsi updateSpec() du hub le lit et auto-sélectionne.
    if (universSelect && savedUniverseVal) {
      var specWrapper = document.getElementById('hubHeroSpecializationWrapper');
      if (specWrapper && savedDomainVal) {
        specWrapper.setAttribute('data-initial-specialization', savedDomainVal);
      }
      universSelect.value = savedUniverseVal;
      universSelect.dispatchEvent(new Event('change', { bubbles: true }));
      // La sync-listener ci-dessous a remis hiddenDomain à '' ;
      // la cascade hub a mis domainSelect.value = savedDomainVal.
      // On re-synchronise immédiatement :
      if (hiddenDomain && domainSelect) {
        hiddenDomain.value = domainSelect.value;
      }
    }

  }, 350);

  // ============================================================
  // SYNCHRONISATION : filtre → inputs cachés (en temps réel)
  // ============================================================

  if (countrySelect) {
    countrySelect.addEventListener('change', function () {
      if (hiddenCountry) hiddenCountry.value = this.value;
    });
  }
  if (citySelect) {
    citySelect.addEventListener('change', function () {
      if (hiddenCity) hiddenCity.value = this.value;
    });
  }
  if (universSelect) {
    universSelect.addEventListener('change', function () {
      if (hiddenUniverse) hiddenUniverse.value = this.value;
      // Réinitialiser le domaine quand l'univers change
      if (hiddenDomain) hiddenDomain.value = '';
    });
  }
  if (domainSelect) {
    domainSelect.addEventListener('change', function () {
      if (hiddenDomain) hiddenDomain.value = this.value;
    });
  }
  modeRadios.forEach(function(radio) {
    radio.addEventListener('change', function () {
      if (hiddenMode) hiddenMode.value = this.value;
    });
  });

  // ============================================================
  // SÉCURITÉ : synchronisation finale juste avant soumission
  // ============================================================
  var form = document.getElementById('identitySettingsForm');
  if (form) {
    form.addEventListener('submit', function () {
      if (countrySelect  && hiddenCountry)  hiddenCountry.value  = countrySelect.value;
      if (citySelect     && hiddenCity)     hiddenCity.value     = citySelect.value;
      if (universSelect  && hiddenUniverse) hiddenUniverse.value = universSelect.value;
      if (domainSelect   && hiddenDomain)   hiddenDomain.value   = domainSelect.value;
      // Mode : lire le radio coché
      modeRadios.forEach(function(r) {
        if (r.checked && hiddenMode) hiddenMode.value = r.value;
      });
    });
  }

});
</script>
@endsection

