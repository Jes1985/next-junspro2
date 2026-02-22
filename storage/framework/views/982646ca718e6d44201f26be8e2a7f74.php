<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['formId' => 'preplyFiltersForm']));

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

foreach (array_filter((['formId' => 'preplyFiltersForm']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="preply-filter-advanced">
  <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-users me-2"></i>Profils d'experts</label>
  <div class="category-filter-wrapper">
    <div class="category-filter-trigger" id="categoryFilterTrigger">
      <span class="category-filter-text" id="categoryFilterText">Profils d'experts</span>
      <i class="fas fa-chevron-down category-filter-arrow" id="categoryFilterArrow"></i>
    </div>
    <div class="category-filter-panel" id="categoryFilterPanel" style="display: none;">
      <div class="category-filter-card">
        <div class="category-filter-card-icon super-icon">
          <i class="fas fa-star"></i>
        </div>
        <div class="category-filter-card-content">
          <div class="category-filter-card-header">
            <span class="category-filter-card-title">Super freelances uniquement</span>
            <label class="category-filter-toggle-wrapper">
              <input type="checkbox" id="superOnlyToggle" class="category-filter-toggle-input" <?php echo e(request('super_only') == '1' ? 'checked' : ''); ?>>
              <span class="category-filter-toggle-slider"></span>
            </label>
          </div>
          <p class="category-filter-card-description">Note ≥ 4,5/5 et au moins 3 avis vérifiés.</p>
        </div>
      </div>
      <div class="category-filter-separator"></div>
      <div class="category-filter-card">
        <div class="category-filter-card-icon qualified-icon">
          <i class="fas fa-check-square"></i>
        </div>
        <div class="category-filter-card-content">
          <div class="category-filter-card-header">
            <span class="category-filter-card-title">Freelances qualifiés uniquement</span>
            <label class="category-filter-toggle-wrapper">
              <input type="checkbox" id="qualifiedOnlyToggle" class="category-filter-toggle-input" <?php echo e(request('qualified_only') == '1' ? 'checked' : ''); ?>>
              <span class="category-filter-toggle-slider"></span>
            </label>
          </div>
          <p class="category-filter-card-description">Diplômes, certifications ou attestations vérifiés.</p>
        </div>
      </div>
      <div class="category-filter-separator"></div>
      <div class="category-filter-card">
        <div class="category-filter-card-icon new-icon">
          <i class="fas fa-seedling"></i>
        </div>
        <div class="category-filter-card-content">
          <div class="category-filter-card-header">
            <span class="category-filter-card-title">Nouveau Talent</span>
            <label class="category-filter-toggle-wrapper">
              <input type="checkbox" id="newOnlyToggle" class="category-filter-toggle-input" <?php echo e(request('new_only') == '1' ? 'checked' : ''); ?>>
              <span class="category-filter-toggle-slider"></span>
            </label>
          </div>
          <p class="category-filter-card-description">Inscrits depuis moins d'1 mois ou encore peu notés (&lt; 3 avis) — profils vérifiés.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if (! $__env->hasRenderedOnce('82b6ec3e-0e5d-4625-ac29-a66cd4d10d9f')): $__env->markAsRenderedOnce('82b6ec3e-0e5d-4625-ac29-a66cd4d10d9f'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
  // Panel Premium "Profils d'experts" - Initialisation unique globale
  if (!window.__categoryFilterInit) {
    window.__categoryFilterInit = true;
    
    (function initCategoryFilterPanel() {
      function initDropdown() {
        const categoryFilterTrigger = document.getElementById('categoryFilterTrigger');
        const categoryFilterPanel = document.getElementById('categoryFilterPanel');
        const categoryFilterText = document.getElementById('categoryFilterText');
        const superOnlyToggle = document.getElementById('superOnlyToggle');
        const qualifiedOnlyToggle = document.getElementById('qualifiedOnlyToggle');
        const newOnlyToggle = document.getElementById('newOnlyToggle');

        if (!categoryFilterTrigger || !categoryFilterPanel || !superOnlyToggle || !qualifiedOnlyToggle) {
          return;
        }

        // Mettre à jour le texte du bouton selon les sélections
        function updateButtonText() {
          const superChecked = superOnlyToggle.checked;
          const qualifiedChecked = qualifiedOnlyToggle.checked;
          const newChecked = newOnlyToggle ? newOnlyToggle.checked : false;
          
          if (superChecked && qualifiedChecked && newChecked) {
            categoryFilterText.textContent = 'Super + Qualifiés + Nouveaux';
          } else if (superChecked && qualifiedChecked) {
            categoryFilterText.textContent = 'Super freelances + Qualifiés';
          } else if (superChecked && newChecked) {
            categoryFilterText.textContent = 'Super + Nouveaux';
          } else if (qualifiedChecked && newChecked) {
            categoryFilterText.textContent = 'Qualifiés + Nouveaux';
          } else if (superChecked) {
            categoryFilterText.textContent = 'Super freelances';
          } else if (qualifiedChecked) {
            categoryFilterText.textContent = 'Qualifiés';
          } else if (newChecked) {
            categoryFilterText.textContent = 'Nouveaux talents';
          } else {
            categoryFilterText.textContent = 'Profils d\'experts';
          }
        }

        // Ouvrir le panel
        function openPanel() {
          categoryFilterPanel.style.display = 'block';
          categoryFilterTrigger.classList.add('active');
        }

        // Fermer le panel
        function closePanel() {
          categoryFilterPanel.style.display = 'none';
          categoryFilterTrigger.classList.remove('active');
        }

        // Toggle panel
        categoryFilterTrigger.addEventListener('click', function(e) {
          e.stopPropagation();
          if (categoryFilterPanel.style.display === 'none' || !categoryFilterPanel.style.display) {
            openPanel();
          } else {
            closePanel();
          }
        });

        // Gérer le toggle "Super freelances uniquement"
        superOnlyToggle.addEventListener('change', function(e) {
          e.stopPropagation();
          e.preventDefault();
          const isChecked = this.checked;
          
          const currentQualifiedOnly = qualifiedOnlyToggle.checked ? '1' : '';
          const currentNewOnly = newOnlyToggle ? (newOnlyToggle.checked ? '1' : '') : '';
          
          updateButtonText();
          
          if (typeof applyFiltersAjax === 'function') {
            applyFiltersAjax({
              super_only: isChecked ? '1' : '',
              qualified_only: currentQualifiedOnly,
              new_only: currentNewOnly
            });
          } else {
            const form = document.getElementById('preplyFiltersForm');
            if (form) {
              form.submit();
            }
          }
        });

        // Gérer le toggle "Freelances qualifiés uniquement"
        qualifiedOnlyToggle.addEventListener('change', function(e) {
          e.stopPropagation();
          e.preventDefault();
          const isChecked = this.checked;
          
          const currentSuperOnly = superOnlyToggle.checked ? '1' : '';
          const currentNewOnly = newOnlyToggle ? (newOnlyToggle.checked ? '1' : '') : '';
          
          updateButtonText();
          
          if (typeof applyFiltersAjax === 'function') {
            applyFiltersAjax({
              super_only: currentSuperOnly,
              qualified_only: isChecked ? '1' : '',
              new_only: currentNewOnly
            });
          } else {
            const form = document.getElementById('preplyFiltersForm');
            if (form) {
              form.submit();
            }
          }
        });

        // Gérer le toggle "Nouveau Talent"
        if (newOnlyToggle) {
          newOnlyToggle.addEventListener('change', function(e) {
            e.stopPropagation();
            e.preventDefault();
            const isChecked = this.checked;
            
            const currentSuperOnly = superOnlyToggle.checked ? '1' : '';
            const currentQualifiedOnly = qualifiedOnlyToggle.checked ? '1' : '';
            
            updateButtonText();
            
            if (typeof applyFiltersAjax === 'function') {
              applyFiltersAjax({
                super_only: currentSuperOnly,
                qualified_only: currentQualifiedOnly,
                new_only: isChecked ? '1' : ''
              });
            } else {
              const form = document.getElementById('preplyFiltersForm');
              if (form) {
                form.submit();
              }
            }
          });
        }

        // Fermeture au click outside
        document.addEventListener('click', function(e) {
          if (!categoryFilterTrigger.contains(e.target) && !categoryFilterPanel.contains(e.target)) {
            closePanel();
          }
        });

        // Fermeture avec ESC
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape' && categoryFilterPanel.style.display === 'block') {
            closePanel();
          }
        });

        // Restaurer l'état au chargement
        const urlParams = new URLSearchParams(window.location.search);
        const urlSuperOnly = urlParams.get('super_only');
        const urlQualifiedOnly = urlParams.get('qualified_only');
        const urlNewOnly = urlParams.get('new_only');
        if (urlSuperOnly === '1') {
          superOnlyToggle.checked = true;
        }
        if (urlQualifiedOnly === '1') {
          qualifiedOnlyToggle.checked = true;
        }
        if (newOnlyToggle && urlNewOnly === '1') {
          newOnlyToggle.checked = true;
        }
        
        // Mettre à jour le texte du bouton au chargement
        updateButtonText();
      }

      // Initialiser quand le DOM est prêt
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDropdown);
      } else {
        initDropdown();
      }
    })();
  }
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\filters\category-filter.blade.php ENDPATH**/ ?>