<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['formId' => 'preplyFiltersForm', 'placeholder' => 'Rechercher un service...']));

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

foreach (array_filter((['formId' => 'preplyFiltersForm', 'placeholder' => 'Rechercher un service...']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="preply-filter-advanced preply-search-input">
  <div class="search-box-modern">
    <input type="text" name="search" id="searchInput" value="<?php echo e(request('search')); ?>" placeholder="<?php echo e($placeholder); ?>" class="form-control flex-grow-1 border-0" autocomplete="off">
    <button type="button" id="searchButton" class="btn-search">
      <i class="fas fa-search"></i>
    </button>
  </div>
</div>

<?php if (! $__env->hasRenderedOnce('1fa792f5-4aef-43a5-8e5c-b8d38425a7b3')): $__env->markAsRenderedOnce('1fa792f5-4aef-43a5-8e5c-b8d38425a7b3'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
  // Barre de recherche premium - Initialisation unique globale
  if (!window.__searchBarInit) {
    window.__searchBarInit = true;
    
    (function initSearchBar() {
      function initSearch() {
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const form = document.getElementById('preplyFiltersForm');

        if (!searchInput || !searchButton || !form) {
          return;
        }

        let searchDebounceTimer = null;
        const DEBOUNCE_DELAY = 450;

        // Fonction AJAX simplifiée si elle n'existe pas
        function ensureAjaxFunction() {
          if (typeof applyFiltersAjax === 'function') {
            return applyFiltersAjax;
          }
          
          // Créer une fonction AJAX simplifiée
          return function(params) {
            const resultsSection = document.getElementById('results');
            const resultsContainer = document.getElementById('resultsContainer');
            
            if (!resultsSection || !resultsContainer) {
              // Fallback : soumettre le formulaire
              form.submit();
              return;
            }
            
            // Ajouter loading state (loader uniquement dans la zone résultats)
            resultsSection.classList.add('is-loading');
            resultsContainer.style.opacity = '0.5';
            resultsContainer.style.pointerEvents = 'none';
            
            // Construire la query string
            const formData = new FormData(form);
            const searchParams = new URLSearchParams();
            
            // Ajouter tous les paramètres du formulaire
            for (const [key, value] of formData.entries()) {
              if (value) {
                searchParams.append(key, value);
              }
            }
            
            // Ajouter les paramètres spécifiques si fournis
            if (params) {
              Object.keys(params).forEach(key => {
                const value = params[key];
                searchParams.delete(key);
                if (value !== null && value !== undefined && value !== '') {
                  searchParams.set(key, value);
                }
              });
            }
            
            const queryString = searchParams.toString();
            const url = form.action + (queryString ? '?' + queryString : '');
            
            // Mettre à jour l'URL sans rechargement
            window.history.replaceState({}, '', url);
            
            // Fetch AJAX
            fetch(url, {
              method: 'GET',
              headers: {
                'Accept': 'text/html',
                'X-Requested-With': 'XMLHttpRequest'
              }
            })
            .then(response => {
              if (!response.ok) {
                throw new Error('Network response was not ok');
              }
              return response.text();
            })
            .then(html => {
              // Parser la réponse HTML
              const parser = new DOMParser();
              const doc = parser.parseFromString(html, 'text/html');
              
              // Extraire uniquement la section résultats
              const newResultsSection = doc.querySelector('.preply-results-section');
              
              if (newResultsSection) {
                // Remplacer uniquement le contenu de la section résultats
                resultsSection.innerHTML = newResultsSection.innerHTML;
              }
              
              // Retirer loading state
              resultsSection.classList.remove('is-loading');
              if (resultsContainer) {
                resultsContainer.style.opacity = '1';
                resultsContainer.style.pointerEvents = 'auto';
              }
            })
            .catch(error => {
              console.error('Error applying search:', error);
              
              // Retirer loading state
              resultsSection.classList.remove('is-loading');
              if (resultsContainer) {
                resultsContainer.style.opacity = '1';
                resultsContainer.style.pointerEvents = 'auto';
              }
              
              // Fallback : soumettre le formulaire en cas d'erreur
              form.submit();
            });
          };
        }

        const applyFiltersAjax = ensureAjaxFunction();

        // Fonction pour appliquer la recherche
        function applySearch() {
          const searchValue = searchInput.value.trim();
          applyFiltersAjax({
            search: searchValue
          });
        }

        // Gérer la saisie avec debounce
        searchInput.addEventListener('input', function(e) {
          if (searchDebounceTimer) {
            clearTimeout(searchDebounceTimer);
          }

          searchDebounceTimer = setTimeout(() => {
            applySearch();
          }, DEBOUNCE_DELAY);
        });

        // Gérer la touche Entrée
        searchInput.addEventListener('keydown', function(e) {
          if (e.key === 'Enter') {
            e.preventDefault();
            e.stopPropagation();
            
            // Annuler le debounce en cours
            if (searchDebounceTimer) {
              clearTimeout(searchDebounceTimer);
            }
            
            // Appliquer immédiatement
            applySearch();
          }
        });

        // Gérer le clic sur le bouton loupe
        searchButton.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          // Annuler le debounce en cours
          if (searchDebounceTimer) {
            clearTimeout(searchDebounceTimer);
          }
          
          // Appliquer immédiatement
          applySearch();
        });

        // Empêcher le submit du formulaire si déclenché par la recherche
        // Note: Le bouton est maintenant type="button" donc ne déclenchera pas le submit
      }

      // Initialiser quand le DOM est prêt
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSearch);
      } else {
        initSearch();
      }
    })();
  }
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\filters\search-bar.blade.php ENDPATH**/ ?>