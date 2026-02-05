@props(['formId' => 'preplyFiltersForm'])

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
          <input type="checkbox" id="nativeOnlyToggle" class="native-only-toggle-input" {{ request('native_only') == '1' ? 'checked' : '' }}>
          <span class="native-only-toggle-slider"></span>
        </label>
      </div>
      <p class="native-only-description">Nous ne montrerons que les freelances qui enseignent dans leur langue maternelle</p>
    </div>
  </div>
</div>

@once
@push('scripts')
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
@endpush
@endonce
