@props(['formId' => 'preplyFiltersForm'])

<div class="preply-filter-advanced">
  <label class="preply-filter-label">Le freelance parle</label>
  <div class="language-dropdown-wrapper">
    <div class="language-dropdown-trigger" id="languageDropdownTrigger">
      <span class="language-selected-text" id="languageSelectedText">
        @if(request('teacher_speaks'))
          @php
            $languageNames = [
              'fr' => 'Français',
              'ar' => 'Arabe',
              'es' => 'Espagnol',
              'ru' => 'Russe',
              'en' => 'Anglais',
              'de' => 'Allemand',
              'it' => 'Italien',
              'pt' => 'Portugais',
              'zh' => 'Chinois',
              'ja' => 'Japonais',
              'ko' => 'Coréen',
            ];
            $selectedLangs = is_array(request('teacher_speaks')) ? request('teacher_speaks') : [request('teacher_speaks')];
            $selectedLangs = array_filter($selectedLangs);
            if (count($selectedLangs) > 0) {
              $firstLang = $languageNames[$selectedLangs[0]] ?? $selectedLangs[0];
              if (count($selectedLangs) == 1) {
                echo $firstLang;
              } else {
                echo $firstLang . ' +' . (count($selectedLangs) - 1);
              }
            } else {
              echo 'Toutes les langues';
            }
          @endphp
        @else
          Toutes les langues
        @endif
      </span>
      <input type="hidden" name="teacher_speaks[]" id="teacherSpeaksInput" value="{{ is_array(request('teacher_speaks')) ? implode(',', request('teacher_speaks')) : (request('teacher_speaks') ?? '') }}">
      <i class="fas fa-chevron-down language-arrow" id="languageArrow"></i>
    </div>
    <div class="language-dropdown-menu" id="languageDropdownMenu" style="display: none;">
      <div class="language-search-wrapper">
        <i class="fas fa-search language-search-icon"></i>
        <input type="text" class="language-search-input" id="languageSearchInput" placeholder="Tapez votre recherche…" autocomplete="off">
      </div>
      <div class="language-popular-section">
        <div class="language-popular-header">Populaires</div>
        <div class="language-list" id="languagePopularList">
          <!-- Rempli dynamiquement par JS -->
        </div>
      </div>
      <div class="language-all-section" id="languageAllSection" style="display: none;">
        <div class="language-list" id="languageAllList">
          <!-- Rempli dynamiquement par JS -->
        </div>
      </div>
      <div class="language-no-results" id="languageNoResults" style="display: none;">
        Aucun résultat
      </div>
      <div class="language-reset-option">
        <div class="language-option" data-code="" id="languageResetOption">
          <span class="language-name">Toutes les langues</span>
          <span class="language-checkbox"></span>
        </div>
      </div>
    </div>
  </div>
</div>

@once
@push('scripts')
<script>
  // Dropdown Premium "Je parle" - Initialisation unique globale
  if (!window.__teacherSpeaksInit) {
    window.__teacherSpeaksInit = true;
    
    (function initLanguageDropdown() {
      // Liste des langues avec codes
      const languagesData = [
        // Populaires (dans l'ordre spécifié)
        { code: 'fr', name: 'Français', popular: true },
        { code: 'ar', name: 'Arabe', popular: true },
        { code: 'es', name: 'Espagnol', popular: true },
        { code: 'en', name: 'Anglais', popular: true },
        // Autres langues
        { code: 'ru', name: 'Russe', popular: false },
        { code: 'de', name: 'Allemand', popular: false },
        { code: 'it', name: 'Italien', popular: false },
        { code: 'pt', name: 'Portugais', popular: false },
        { code: 'zh', name: 'Chinois', popular: false },
        { code: 'ja', name: 'Japonais', popular: false },
        { code: 'ko', name: 'Coréen', popular: false },
        { code: 'nl', name: 'Néerlandais', popular: false },
        { code: 'pl', name: 'Polonais', popular: false },
        { code: 'sv', name: 'Suédois', popular: false },
        { code: 'da', name: 'Danois', popular: false },
        { code: 'no', name: 'Norvégien', popular: false },
        { code: 'fi', name: 'Finnois', popular: false },
        { code: 'cs', name: 'Tchèque', popular: false },
        { code: 'hu', name: 'Hongrois', popular: false },
        { code: 'ro', name: 'Roumain', popular: false },
        { code: 'el', name: 'Grec', popular: false },
        { code: 'tr', name: 'Turc', popular: false },
        { code: 'he', name: 'Hébreu', popular: false },
        { code: 'th', name: 'Thaï', popular: false },
        { code: 'vi', name: 'Vietnamien', popular: false },
        { code: 'id', name: 'Indonésien', popular: false },
        { code: 'hi', name: 'Hindi', popular: false },
      ];

      function initDropdown() {
        const languageTrigger = document.getElementById('languageDropdownTrigger');
        const languageMenu = document.getElementById('languageDropdownMenu');
        const languageSelectedText = document.getElementById('languageSelectedText');
        const teacherSpeaksInput = document.getElementById('teacherSpeaksInput');
        const languageSearchInput = document.getElementById('languageSearchInput');
        const languagePopularList = document.getElementById('languagePopularList');
        const languageAllList = document.getElementById('languageAllList');
        const languageAllSection = document.getElementById('languageAllSection');
        const languageNoResults = document.getElementById('languageNoResults');
        const languageResetOption = document.getElementById('languageResetOption');

        if (!languageTrigger || !languageMenu || !languageSelectedText || !teacherSpeaksInput) {
          return;
        }

        // Gérer plusieurs sélections : tableau de codes de langues
        let selectedLanguageCodes = [];
        let searchDebounceTimer = null;

        // Initialiser depuis l'URL ou l'input
        const initialValue = teacherSpeaksInput.value || '';
        if (initialValue) {
          selectedLanguageCodes = initialValue.split(',').filter(c => c.trim() !== '');
        }

        // Mettre à jour le texte affiché
        function updateSelectedText() {
          if (selectedLanguageCodes.length === 0) {
            languageSelectedText.textContent = 'Toutes les langues';
          } else if (selectedLanguageCodes.length === 1) {
            const language = languagesData.find(l => l.code === selectedLanguageCodes[0]);
            languageSelectedText.textContent = language ? language.name : 'Toutes les langues';
          } else {
            const firstLanguage = languagesData.find(l => l.code === selectedLanguageCodes[0]);
            const firstName = firstLanguage ? firstLanguage.name : selectedLanguageCodes[0];
            languageSelectedText.textContent = firstName + ' +' + (selectedLanguageCodes.length - 1);
          }
        }

        // Créer un élément de langue
        function createLanguageOption(language) {
          const option = document.createElement('div');
          option.className = 'language-option';
          option.setAttribute('data-code', language.code);
          if (selectedLanguageCodes.includes(language.code)) {
            option.classList.add('selected');
          }

          option.innerHTML = `
            <span class="language-name">${language.name}</span>
            <span class="language-checkbox"></span>
          `;

          option.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleLanguage(language.code);
          });

          return option;
        }

        // Rendre la liste des langues populaires
        function renderPopularLanguages() {
          if (!languagePopularList) return;
          languagePopularList.innerHTML = '';
          const popularLanguages = languagesData.filter(l => l.popular);
          popularLanguages.forEach(language => {
            languagePopularList.appendChild(createLanguageOption(language));
          });
        }

        // Rendre la liste complète filtrée
        function renderFilteredLanguages(searchTerm = '') {
          if (!languageAllList) return;

          const normalizedSearch = searchTerm.toLowerCase().trim();
          let filteredLanguages = [];

          if (normalizedSearch === '') {
            filteredLanguages = languagesData.filter(l => !l.popular);
            languageAllSection.style.display = filteredLanguages.length > 0 ? 'block' : 'none';
            languageNoResults.style.display = 'none';
          } else {
            filteredLanguages = languagesData.filter(language => 
              language.name.toLowerCase().includes(normalizedSearch)
            );
            languageAllSection.style.display = filteredLanguages.length > 0 ? 'block' : 'none';
            languageNoResults.style.display = filteredLanguages.length === 0 ? 'block' : 'none';
            const popularSection = document.querySelector('.language-popular-section');
            if (popularSection) {
              popularSection.style.display = 'none';
            }
          }

          languageAllList.innerHTML = '';
          filteredLanguages.forEach(language => {
            languageAllList.appendChild(createLanguageOption(language));
          });
        }

        // Toggle une langue (ajouter ou retirer)
        function toggleLanguage(code) {
          const index = selectedLanguageCodes.indexOf(code);
          if (index > -1) {
            // Retirer la langue
            selectedLanguageCodes.splice(index, 1);
          } else {
            // Ajouter la langue
            selectedLanguageCodes.push(code);
          }
          
          // Mettre à jour l'input hidden avec les valeurs séparées par des virgules
          teacherSpeaksInput.value = selectedLanguageCodes.join(',');
          
          // Re-rendre les listes pour mettre à jour visuellement les checkboxes
          const currentSearchTerm = languageSearchInput ? languageSearchInput.value : '';
          renderPopularLanguages();
          renderFilteredLanguages(currentSearchTerm);
          
          updateSelectedText();
          updateSelectedState();
          
          // Ne pas fermer le dropdown pour permettre plusieurs sélections
          // Appliquer le filtre via AJAX si la fonction existe, sinon soumettre le formulaire
          if (typeof applyFiltersAjax === 'function') {
            applyFiltersAjax({
              teacher_speaks: selectedLanguageCodes.length > 0 ? selectedLanguageCodes : ''
            });
          } else {
            const form = document.getElementById('preplyFiltersForm');
            if (form) {
              form.submit();
            }
          }
        }

        // Mettre à jour l'état visuel de sélection
        function updateSelectedState() {
          const allOptions = languageMenu.querySelectorAll('.language-option');
          allOptions.forEach(opt => {
            const code = opt.getAttribute('data-code');
            if (selectedLanguageCodes.includes(code)) {
              opt.classList.add('selected');
            } else {
              opt.classList.remove('selected');
            }
          });
        }

        // Ouvrir le dropdown
        function openDropdown() {
          languageMenu.style.display = 'block';
          languageTrigger.classList.add('active');
          if (!languageSearchInput.value.trim()) {
            const popularSection = document.querySelector('.language-popular-section');
            if (popularSection) {
              popularSection.style.display = 'block';
            }
          }
          setTimeout(() => {
            if (languageSearchInput) {
              languageSearchInput.focus();
            }
          }, 100);
        }

        // Fermer le dropdown
        function closeDropdown() {
          languageMenu.style.display = 'none';
          languageTrigger.classList.remove('active');
          if (languageSearchInput) {
            languageSearchInput.value = '';
          }
          const popularSection = document.querySelector('.language-popular-section');
          if (popularSection) {
            popularSection.style.display = 'block';
          }
          languageAllSection.style.display = 'none';
          languageNoResults.style.display = 'none';
        }

        // Toggle dropdown
        languageTrigger.addEventListener('click', function(e) {
          e.stopPropagation();
          if (languageMenu.style.display === 'none' || !languageMenu.style.display) {
            openDropdown();
          } else {
            closeDropdown();
          }
        });

        // Recherche avec debounce
        if (languageSearchInput) {
          languageSearchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value;
            
            if (searchDebounceTimer) {
              clearTimeout(searchDebounceTimer);
            }

            searchDebounceTimer = setTimeout(() => {
              if (searchTerm.trim() === '') {
                const popularSection = document.querySelector('.language-popular-section');
                if (popularSection) {
                  popularSection.style.display = 'block';
                }
                renderFilteredLanguages('');
              } else {
                const popularSection = document.querySelector('.language-popular-section');
                if (popularSection) {
                  popularSection.style.display = 'none';
                }
                renderFilteredLanguages(searchTerm);
              }
            }, 200);
          });
        }

        // Option "Toutes les langues" (reset)
        if (languageResetOption) {
          if (selectedLanguageCodes.length === 0) {
            languageResetOption.classList.add('selected');
          }
          languageResetOption.addEventListener('click', function(e) {
            e.stopPropagation();
            selectedLanguageCodes = [];
            teacherSpeaksInput.value = '';
            updateSelectedText();
            updateSelectedState();
            
            // Appliquer le filtre via AJAX si la fonction existe, sinon soumettre le formulaire
            if (typeof applyFiltersAjax === 'function') {
              applyFiltersAjax({
                teacher_speaks: ''
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
          if (!languageTrigger.contains(e.target) && !languageMenu.contains(e.target)) {
            closeDropdown();
          }
        });

        // Fermeture avec ESC
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape' && languageMenu.style.display === 'block') {
            closeDropdown();
          }
        });

        // Initialiser
        updateSelectedText();
        renderPopularLanguages();
        renderFilteredLanguages('');

        // Restaurer la sélection au chargement
        const urlParams = new URLSearchParams(window.location.search);
        const urlLanguages = urlParams.getAll('teacher_speaks[]');
        if (urlLanguages.length > 0) {
          selectedLanguageCodes = urlLanguages.filter(l => l && l !== 'other');
          teacherSpeaksInput.value = selectedLanguageCodes.join(',');
          updateSelectedText();
          updateSelectedState();
        } else {
          // Essayer aussi avec teacher_speaks (sans [])
          const urlLanguage = urlParams.get('teacher_speaks');
          if (urlLanguage && urlLanguage !== 'other') {
            selectedLanguageCodes = [urlLanguage];
            teacherSpeaksInput.value = urlLanguage;
            updateSelectedText();
            updateSelectedState();
          }
        }
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
