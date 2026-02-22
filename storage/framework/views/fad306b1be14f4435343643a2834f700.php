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
  <label class="preply-filter-label">Langue maternelle</label>
  <div class="native-only-wrapper">
    <div class="native-only-trigger" id="nativeOnlyTrigger">
      <span class="native-only-text" id="nativeOnlyText">Langue maternelle</span>
      <i class="fas fa-chevron-down native-only-arrow" id="nativeOnlyArrow"></i>
    </div>
    <div class="native-only-popover" id="nativeOnlyPopover" style="display: none;">
      <div class="native-only-header">
        <span class="native-only-title">Freelances natifs uniquement</span>
        <label class="native-only-toggle-wrapper">
          <input type="checkbox" id="nativeOnlyToggle" class="native-only-toggle-input" <?php echo e(request('native_only') == '1' ? 'checked' : ''); ?>>
          <span class="native-only-toggle-slider"></span>
        </label>
      </div>
      <p class="native-only-description">Nous ne montrerons que les freelances qui enseignent dans leur langue maternelle</p>
    </div>
  </div>
</div>

<?php if (! $__env->hasRenderedOnce('c5253b70-e448-43d3-8ca5-18d6380d2ad6')): $__env->markAsRenderedOnce('c5253b70-e448-43d3-8ca5-18d6380d2ad6'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
  // Popover Premium "Langue maternelle" - Initialisation unique globale
  if (!window.__nativeLanguageFilterInit) {
    window.__nativeLanguageFilterInit = true;
    
    (function initNativeOnlyPopover() {
      function initDropdown() {
        const nativeOnlyTrigger = document.getElementById('nativeOnlyTrigger');
        const nativeOnlyPopover = document.getElementById('nativeOnlyPopover');
        const nativeOnlyToggle = document.getElementById('nativeOnlyToggle');
        const nativeOnlyText = document.getElementById('nativeOnlyText');

        if (!nativeOnlyTrigger || !nativeOnlyPopover || !nativeOnlyToggle) {
          return;
        }

        // Mettre à jour le texte du bouton selon l'état
        function updateButtonText() {
          if (nativeOnlyToggle.checked) {
            nativeOnlyText.textContent = 'Natifs uniquement';
          } else {
            nativeOnlyText.textContent = 'Langue maternelle';
          }
        }

        // Ouvrir le popover
        function openPopover() {
          nativeOnlyPopover.style.display = 'block';
          nativeOnlyTrigger.classList.add('active');
        }

        // Fermer le popover
        function closePopover() {
          nativeOnlyPopover.style.display = 'none';
          nativeOnlyTrigger.classList.remove('active');
        }

        // Toggle popover
        nativeOnlyTrigger.addEventListener('click', function(e) {
          e.stopPropagation();
          if (nativeOnlyPopover.style.display === 'none' || !nativeOnlyPopover.style.display) {
            openPopover();
          } else {
            closePopover();
          }
        });

        // Gérer le toggle switch
        nativeOnlyToggle.addEventListener('change', function(e) {
          e.stopPropagation();
          const isChecked = this.checked;
          
          // Mettre à jour le texte du bouton
          updateButtonText();
          
          // Appliquer le filtre via AJAX si la fonction existe, sinon soumettre le formulaire
          if (typeof applyFiltersAjax === 'function') {
            applyFiltersAjax({
              native_only: isChecked ? '1' : ''
            });
          } else {
            const form = document.getElementById('preplyFiltersForm');
            if (form) {
              form.submit();
            }
          }
        });

        // Fermeture au click outside
        document.addEventListener('click', function(e) {
          if (!nativeOnlyTrigger.contains(e.target) && !nativeOnlyPopover.contains(e.target)) {
            closePopover();
          }
        });

        // Fermeture avec ESC
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape' && nativeOnlyPopover.style.display === 'block') {
            closePopover();
          }
        });

        // Restaurer l'état au chargement
        const urlParams = new URLSearchParams(window.location.search);
        const urlNativeOnly = urlParams.get('native_only');
        if (urlNativeOnly === '1') {
          nativeOnlyToggle.checked = true;
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
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\filters\native-language-filter.blade.php ENDPATH**/ ?>