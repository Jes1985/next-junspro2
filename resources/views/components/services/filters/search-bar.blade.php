@props(['formId' => 'preplyFiltersForm', 'placeholder' => 'Rechercher un service...'])

<div class="preply-filter-advanced preply-search-input">
  <div class="search-box-modern">
    <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="{{ $placeholder }}" class="form-control flex-grow-1 border-0" autocomplete="off">
    <button type="button" id="searchButton" class="btn-search">
      <i class="fas fa-search"></i>
    </button>
  </div>
</div>

@once
@push('scripts')
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
@endpush
@endonce
