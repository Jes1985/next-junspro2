

<?php $__env->startSection('content'); ?>
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <div style="margin-bottom: 2rem;">
      <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;">Identité professionnelle</h1>
      <p style="color: #6b7280; font-size: 1rem;">Nom public, localisation, langue, activité.</p>
    </div>

    <?php if(session('success')): ?>
      <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
      <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        <?php echo e(session('error')); ?>

      </div>
    <?php endif; ?>

    <div style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
      <form id="identitySettingsForm" method="POST" action="<?php echo e(route('user.update_profile')); ?>">
        <?php echo csrf_field(); ?>

        <div style="margin-bottom: 2rem;">
          <label for="first_name" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            Prénom
          </label>
          <input 
            type="text" 
            id="first_name" 
            name="first_name" 
            value="<?php echo e(old('first_name', $user->first_name ?? '')); ?>"
            placeholder="Votre prénom"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="<?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            required
          >
          <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div style="margin-bottom: 0;">
          <label for="last_name" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            Nom
          </label>
          <input 
            type="text" 
            id="last_name" 
            name="last_name" 
            value="<?php echo e(old('last_name', $user->last_name ?? '')); ?>"
            placeholder="Votre nom"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="<?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            required
          >
          <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <?php
          $__besoin_languages = ['fr' => 'Français', 'en' => 'Anglais', 'es' => 'Espagnol', 'de' => 'Allemand', 'it' => 'Italien', 'pt' => 'Portugais', 'nl' => 'Néerlandais', 'ru' => 'Russe', 'zh' => 'Chinois', 'ar' => 'Arabe', 'ja' => 'Japonais', 'pl' => 'Polonais', 'el' => 'Grec', 'tr' => 'Turc', 'sv' => 'Suédois', 'ko' => 'Coréen', 'hi' => 'Hindi'];
          $__cecrl_levels = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
          $__savedNative  = old('native_language',  $freelancerProfile?->native_language  ?? '');
          $__savedOthers  = old('other_languages',  $freelancerProfile?->spoken_languages ?? '');
        ?>
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e7eb;">
          <div class="filter-group besoin-langues filter-group--full">
            <label class="filter-label"><i class="fas fa-language me-2"></i>Ma langue maternelle</label>
            <div class="besoin-langues-row">
              <div class="besoin-mother-tongue-wrap">
                <select name="native_language" id="identity_mother_tongue" class="filter-select">
                  <option value=""><?php echo e(__('Langue maternelle')); ?></option>
                  <?php $__currentLoopData = $__besoin_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__code => $__label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($__code); ?>" <?php echo e($__savedNative === $__code ? 'selected' : ''); ?>><?php echo e($__label); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="besoin-other-langs-wrap" id="identity_other_langs_wrap">
                <span class="besoin-other-langs-label">Autres langues parlées</span>
                <div class="besoin-lang-chips" id="identity_lang_chips"></div>
                <button type="button" class="besoin-add-lang-btn" id="identity_add_lang_btn" aria-haspopup="true" aria-expanded="false">+ Ajouter</button>
                <input type="hidden" name="other_languages" id="identity_other_languages_input" value="<?php echo e($__savedOthers); ?>">
                <div class="cecrl-popover" id="identity_cecrl_popover" role="dialog" aria-label="Niveaux CECRL" hidden>
                  <div class="cecrl-popover-inner">
                    <div class="cecrl-table">
                      <div class="cecrl-table-head">
                        <span class="cecrl-th-lang">Langue</span>
                        <span class="cecrl-th-level">Niveau</span>
                      </div>
                      <?php $__currentLoopData = $__besoin_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__code => $__label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="cecrl-row" data-lang="<?php echo e($__code); ?>" data-lang-label="<?php echo e($__label); ?>">
                        <span class="cecrl-lang"><?php echo e($__label); ?></span>
                        <div class="cecrl-pills">
                          <?php $__currentLoopData = $__cecrl_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <button type="button" class="cecrl-pill" data-level="<?php echo e($__l); ?>" title="<?php echo e($__l); ?>"><?php echo e($__l); ?></button>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        
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

        <input type="hidden" name="_redirect" value="<?php echo e(route('freelance.dashboard', ['tab' => 'settings'])); ?>">

        
        <?php
          $currentUniverse = ($freelancerProfile?->universes ?? [])[0] ?? '';
          $currentDomain   = ($freelancerProfile?->domains ?? [])[0] ?? '';
          $canOnline  = $freelancerProfile?->can_online ?? true;
          $canOnsite  = $freelancerProfile?->can_onsite ?? false;
          $currentMode = (!$canOnline && $canOnsite) ? 'onsite' : 'online';
          // Pays & Ville : lus depuis freelancer_profiles (onsite_country / onsite_city)
          // car users.country_code n'existe pas et users.city n'est pas la source fiable
          $currentCountry = $freelancerProfile?->onsite_country ?? 'FR';
          $currentCity    = $freelancerProfile?->onsite_city    ?? '';
        ?>

        
        <input type="hidden" id="hidden_city"             name="city"             value="<?php echo e(old('city',             $currentCity)); ?>">
        <input type="hidden" id="hidden_country_code"    name="country_code"    value="<?php echo e(old('country_code',    $currentCountry)); ?>">
        <input type="hidden" id="hidden_profile_universe" name="profile_universe" value="<?php echo e(old('profile_universe', $currentUniverse)); ?>">
        <input type="hidden" id="hidden_profile_domain"   name="profile_domain"   value="<?php echo e(old('profile_domain',   $currentDomain)); ?>">
        <input type="hidden" id="hidden_profile_mode"     name="profile_mode"     value="<?php echo e(old('profile_mode',     $currentMode)); ?>">

      </form>
    </div>

    <!-- Séparateur -->
    <div style="margin: 2rem 0; border-top: 1px solid #e5e7eb;"></div>

    
    
    <div class="container" style="position:relative;z-index:10;">
      <?php if (isset($component)) { $__componentOriginal333d31bf0e5e278075e343199de86113 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal333d31bf0e5e278075e343199de86113 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.search-filter','data' => ['formId' => 'settingsSearchFilter','formAction' => route('services'),'universe' => 'hub','hubUniverses' => $hubUniverses ?? [],'hubUniverseDomains' => $hubUniverseDomains ?? [],'initialUniverse' => old('profile_universe', $currentUniverse ?? ''),'initialDomain' => old('profile_domain',   $currentDomain ?? ''),'initialMode' => old('profile_mode',       $currentMode ?? 'online'),'keywordPlaceholder' => 'Essayez « Pilates », « Marketing Digital », « Anglais »...','locationPlaceholder' => 'Lieu de la mission (ex: Paris, Lyon...)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.search-filter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['formId' => 'settingsSearchFilter','formAction' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('services')),'universe' => 'hub','hubUniverses' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hubUniverses ?? []),'hubUniverseDomains' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hubUniverseDomains ?? []),'initialUniverse' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('profile_universe', $currentUniverse ?? '')),'initialDomain' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('profile_domain',   $currentDomain ?? '')),'initialMode' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('profile_mode',       $currentMode ?? 'online')),'keywordPlaceholder' => 'Essayez « Pilates », « Marketing Digital », « Anglais »...','locationPlaceholder' => 'Lieu de la mission (ex: Paris, Lyon...)']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal333d31bf0e5e278075e343199de86113)): ?>
<?php $attributes = $__attributesOriginal333d31bf0e5e278075e343199de86113; ?>
<?php unset($__attributesOriginal333d31bf0e5e278075e343199de86113); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal333d31bf0e5e278075e343199de86113)): ?>
<?php $component = $__componentOriginal333d31bf0e5e278075e343199de86113; ?>
<?php unset($__componentOriginal333d31bf0e5e278075e343199de86113); ?>
<?php endif; ?>
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
        href="<?php echo e(route('freelance.dashboard', ['tab' => 'settings'])); ?>" 
        style="color: #6b7280; text-decoration: none; font-weight: 500; padding: 0.75rem 1.5rem; border-radius: 8px; transition: background-color 0.2s;"
        onmouseover="this.style.backgroundColor='#f3f4f6';"
        onmouseout="this.style.backgroundColor='transparent';"
      >
        Annuler
      </a>
    </div>

  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.freelance.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\settings\identity.blade.php ENDPATH**/ ?>