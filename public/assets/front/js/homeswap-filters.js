/**
 * Filtres HomeSwap : bouton Filtres avancés + calendrier + réinit
 * Chargé uniquement sur /services/homeswap, après Flatpickr.
 * 
 * V1+V2 : Assistant adaptatif discret (ultra-premium)
 * 
 * Mapping interne ville → objectifs (liste fermée) :
 * - cityBadges : mapping ville → badges (Workation, Famille, Langue, Business, Repos ; max 2 affichés)
 * - citySeoText : wording SEO doux pour meta descriptions et structured data
 * 
 * Système de statistiques internes (invisibles) :
 * - cityStats : statistiques par ville (clics, recherches, sélections) stockées en localStorage
 * - incrementCityStat() : incrémente une statistique pour une ville
 * - getCityPopularityScore() : calcule le score de popularité d'une ville
 * 
 * Badge "Ville très demandée en ce moment" (dynamique, basé sur seuil) :
 * - Phase lancement : liste initiale manuelle (highDemandCitiesLaunch)
 * - Phase avec stats : getVeryPopularCities() calcule dynamiquement (top 20% ou seuil minimum)
 * - Score = clics × 1 + recherches × 2 + sélections × 3
 * - Texte exact affiché : "Ville très demandée en ce moment"
 * 
 * Ordre ajusté selon profil utilisateur (V2) :
 * - getCityOrderForUser() : structure préparée pour ajustement futur selon profil
 * - Pour l'instant, retourne l'ordre par défaut
 * 
 * UX Ultra-Premium :
 * - Select : nom de ville uniquement (aucun badge visible)
 * - Post-sélection : icônes monochromes apparaissent à droite du champ
 * - Tooltip : informations révélées uniquement au survol
 * - Aucune info visible sans survol
 */
(function() {
  'use strict';

  function runHomeswapFiltersInit() {
    // Onglets Rechercher un Rituel / Déposer un projet (comme page Projet)
    var tabSearch = document.getElementById('homeswapTabSearch');
    var tabSubmit = document.getElementById('homeswapTabSubmit');
    var contentSearch = document.getElementById('homeswapContentSearch');
    var contentSubmit = document.getElementById('homeswapContentSubmit');
    if (tabSearch && tabSubmit && contentSearch && contentSubmit) {
      function showSearch() {
        tabSearch.classList.add('active');
        tabSubmit.classList.remove('active');
        contentSearch.classList.add('active');
        contentSearch.style.display = 'block';
        contentSubmit.classList.remove('active');
        contentSubmit.style.display = 'none';
      }
      function showSubmit() {
        tabSubmit.classList.add('active');
        tabSearch.classList.remove('active');
        contentSubmit.classList.add('active');
        contentSubmit.style.display = 'block';
        contentSearch.classList.remove('active');
        contentSearch.style.display = 'none';
      }
      tabSearch.addEventListener('click', showSearch);
      tabSubmit.addEventListener('click', showSubmit);
    }

    // Filtres avancés : ouverture/fermeture (délégation)
    document.addEventListener('click', function homeswapAdvancedToggleHandler(e) {
      if (!e.target.closest || !e.target.closest('#homeswapToggleAdvancedFilters')) return;
      e.preventDefault();
      e.stopPropagation();
      var panel = document.getElementById('homeswapAdvancedFiltersPanel');
      var btn = document.getElementById('homeswapToggleAdvancedFilters');
      if (!panel || !btn) return;
      var isOpen = panel.classList.contains('is-open');
      panel.classList.toggle('is-open', !isOpen);
      panel.setAttribute('aria-hidden', isOpen ? 'true' : 'false');
      panel.setAttribute('data-advanced-open', isOpen ? 'false' : 'true');
      btn.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
    });

    // Calendrier Dates du séjour (Flatpickr)
    var datesDisplay = document.getElementById('homeswapDatesDisplay');
    var startInput = document.getElementById('homeswapStartDate');
    var endInput = document.getElementById('homeswapEndDate');
    var dateIcon = document.getElementById('homeswapDateIcon');
    if (datesDisplay && startInput && endInput && typeof window.flatpickr !== 'undefined') {
      try {
        var fp = window.flatpickr(datesDisplay, {
          mode: 'range',
          dateFormat: 'd/m/Y',
          locale: 'fr',
          allowInput: false,
          onChange: function(selectedDates, dateStr, instance) {
            if (selectedDates.length === 2) {
              var start = selectedDates[0];
              var end = selectedDates[1];
              if (end < start) { instance.setDate([start, start]); return; }
              startInput.value = start.toISOString().split('T')[0];
              endInput.value = end.toISOString().split('T')[0];
              datesDisplay.value = 'Du ' + start.toLocaleDateString('fr-FR') + ' / Au ' + end.toLocaleDateString('fr-FR');
            } else if (selectedDates.length === 1) {
              startInput.value = selectedDates[0].toISOString().split('T')[0];
              endInput.value = '';
              datesDisplay.value = 'Du ' + selectedDates[0].toLocaleDateString('fr-FR') + ' / Au …';
            }
          }
        });
        if (dateIcon && fp) {
          dateIcon.style.cursor = 'pointer';
          dateIcon.addEventListener('click', function() { fp.open(); });
        }
        window.homeswapFlatpickrInstance = fp;
      } catch (err) { console.warn('Flatpickr homeswap:', err); }
    }

    var form = document.getElementById('preplyFiltersForm');
    if (!form) return;

    // Mapping ville → badges objectifs (micro-badges discrets)
    var cityBadges = {
      // FRANCE
      'Paris': ['Business', 'Langue'],
      'Lyon': ['Business', 'Famille'],
      'Marseille': ['Famille', 'Langue'],
      'Bordeaux': ['Workation', 'Repos'],
      'Nantes': ['Business', 'Famille'],
      'Lille': ['Business', 'Famille'],
      'Strasbourg': ['Business', 'Langue'],
      'Rennes': ['Business', 'Famille'],
      'Montpellier': ['Workation', 'Famille'],
      'Toulouse': ['Business', 'Famille'],
      'Nice': ['Repos', 'Famille'],
      // ESPAGNE
      'Barcelone': ['Workation', 'Famille'],
      'Madrid': ['Business', 'Langue'],
      'Palma de Majorque': ['Repos', 'Famille'],
      'Valence': ['Famille', 'Repos'],
      'Séville': ['Famille', 'Culture'],
      'Ibiza': ['Repos'],
      'Tenerife': ['Workation', 'Famille'],
      // PORTUGAL
      'Lisbonne': ['Workation', 'Business'],
      'Porto': ['Repos', 'Langue'],
      'Faro': ['Repos', 'Famille'],
      'Coimbra': ['Langue', 'Culture'],
      // ROYAUME-UNI
      'Londres': ['Business', 'Langue'],
      'Brighton': ['Langue', 'Famille'],
      'Manchester': ['Business', 'Langue'],
      'Birmingham': ['Business', 'Famille'],
      'Édimbourg': ['Culture', 'Langue'],
      // IRLANDE
      'Dublin': ['Langue', 'Business'],
      // CANADA
      'Montréal': ['Langue', 'Famille'],
      'Toronto': ['Business', 'Langue'],
      'Vancouver': ['Workation', 'Repos'],
      // ÉTATS-UNIS
      'New York': ['Business'],
      'San Francisco': ['Business', 'Workation'],
      'Miami': ['Repos', 'Business'],
      'Los Angeles': ['Business', 'Repos'],
      'Chicago': ['Business', 'Famille'],
      // ITALIE
      'Rome': ['Famille', 'Culture'],
      'Florence': ['Repos', 'Culture'],
      'Milan': ['Business'],
      'Turin': ['Business', 'Famille'],
      'Palerme': ['Repos', 'Famille'],
      'Toscane': ['Repos', 'Culture'],
      'Naples': ['Famille', 'Culture'],
      // PAYS-BAS
      'Amsterdam': ['Business', 'Langue'],
      'Rotterdam': ['Business', 'Famille'],
      'La Haye': ['Business', 'Famille'],
      // ALLEMAGNE
      'Berlin': ['Business', 'Langue'],
      'Munich': ['Business', 'Famille'],
      'Hambourg': ['Business', 'Langue'],
      // SUISSE
      'Zurich': ['Business', 'Langue'],
      'Genève': ['Business', 'Langue'],
      'Bâle': ['Business', 'Famille'],
      // BELGIQUE
      'Bruxelles': ['Business', 'Langue'],
      'Anvers': ['Business', 'Famille'],
      'Liège': ['Famille', 'Langue'],
      // MALTE
      'Valetta': ['Repos', 'Culture'],
      'Sliema': ['Repos', 'Famille'],
      'Saint Julien': ['Repos', 'Famille'],
      // MONACO
      'Monte-Carlo': ['Repos', 'Business'],
      'La Condamine': ['Repos', 'Famille'],
      'Fontvieille': ['Repos', 'Famille'],
      // LUXEMBOURG
      'Luxembourg-Ville': ['Business', 'Langue'],
      'Kirchberg': ['Business'],
      'Esch-sur-Alzette': ['Famille', 'Business'],
      // MAROC
      'Casablanca': ['Business', 'Langue'],
      'Rabat': ['Business', 'Famille'],
      'Tanger': ['Repos', 'Langue'],
      // TUNISIE
      'Tunis': ['Business', 'Langue'],
      'Sfax': ['Business', 'Famille'],
      'Sousse': ['Repos', 'Famille'],
      // SÉNÉGAL
      'Dakar': ['Business', 'Langue'],
      'Diamniadio': ['Business'],
      'Thiès': ['Famille', 'Repos'],
      // CÔTE D'IVOIRE
      'Abidjan': ['Business', 'Langue'],
      'Yamoussoukro': ['Famille', 'Repos'],
      'San Pedro': ['Repos', 'Famille'],
      // CROATIE
      'Split': ['Repos', 'Famille'],
      'Dubrovnik': ['Repos', 'Culture'],
      // DOM
      'La Réunion': ['Repos', 'Famille'],
      'Guadeloupe': ['Repos', 'Famille'],
      'Martinique': ['Repos', 'Famille'],
      'Pointe-à-Pitre': ['Repos', 'Famille'],
      'Basse-Terre': ['Repos', 'Famille'],
      'Saint-François': ['Repos', 'Famille'],
      'Fort-de-France': ['Repos', 'Famille'],
      'Le Lamentin': ['Repos', 'Famille'],
      'Sainte-Anne': ['Repos', 'Famille'],
      'Cayenne': ['Repos', 'Famille'],
      'Kourou': ['Repos', 'Famille'],
      'Saint-Laurent-du-Maroni': ['Repos', 'Famille'],
      'Saint-Denis': ['Repos', 'Famille'],
      'Saint-Pierre': ['Repos', 'Famille'],
      'Saint-Gilles-les-Bains': ['Repos', 'Famille'],
      'Nouméa': ['Repos', 'Famille'],
      'Dumbéa': ['Repos', 'Famille'],
      'Mont-Dore': ['Repos', 'Famille'],
      'Papeete': ['Repos', 'Famille'],
      'Faa\'a': ['Repos', 'Famille'],
      'Moorea': ['Repos', 'Famille']
    };

    // Liste fermée des objectifs affichés (max 2 par ville, aucun emoji)
    var allowedObjectives = ['Workation', 'Famille', 'Langue', 'Business', 'Repos'];

    function getDisplayBadges(badges) {
      if (!badges || !Array.isArray(badges)) return [];
      return badges.filter(function(b) { return allowedObjectives.indexOf(b) !== -1; }).slice(0, 2);
    }

    // Wording SEO doux (non visible dans UI, pour meta/structured data)
    var citySeoText = {
      'Paris': 'Ville clé pour les échanges de logement à vocation professionnelle, culturelle et linguistique.',
      'Barcelone': 'Destination idéale pour le télétravail, les séjours familiaux et les échanges de logement longue durée.',
      'Lisbonne': 'Ville prisée pour la workation, les projets internationaux et les échanges culturels.',
      'Palma de Majorque': 'Cadre privilégié pour les échanges de logement orientés repos, famille et qualité de vie.',
      'Montréal': 'Ville bilingue idéale pour les échanges linguistiques, familiaux et professionnels.',
      'Londres': 'Métropole internationale propice aux échanges professionnels et linguistiques.',
      'New York': 'Ville emblématique pour les échanges de logement à dimension professionnelle et culturelle.',
      'Rome': 'Destination culturelle et familiale pour les échanges de logement longue durée.',
      'Bordeaux': 'Ville appréciée pour le télétravail et les séjours reposants en échange de logement.'
    };

    // Statistiques internes par ville (invisibles, pour calculs dynamiques)
    var cityStats = (function() {
      var stored = localStorage.getItem('homeswap_city_stats');
      if (stored) {
        try {
          return JSON.parse(stored);
        } catch (e) {
          return {};
        }
      }
      return {};
    })();

    // Fonction pour sauvegarder les statistiques
    function saveCityStats() {
      try {
        localStorage.setItem('homeswap_city_stats', JSON.stringify(cityStats));
      } catch (e) {
        console.warn('Impossible de sauvegarder les stats villes:', e);
      }
    }

    // Fonction pour incrémenter une statistique ville
    function incrementCityStat(cityName, statType) {
      if (!cityName) return;
      if (!cityStats[cityName]) {
        cityStats[cityName] = { clicks: 0, searches: 0, selections: 0 };
      }
      if (cityStats[cityName][statType] !== undefined) {
        cityStats[cityName][statType]++;
        saveCityStats();
      }
    }

    // Fonction pour calculer le score de popularité d'une ville
    function getCityPopularityScore(cityName) {
      if (!cityStats[cityName]) return 0;
      var stats = cityStats[cityName];
      // Score = clics × 1 + recherches × 2 + sélections × 3
      return (stats.clicks || 0) * 1 + (stats.searches || 0) * 2 + (stats.selections || 0) * 3;
    }

    // Liste initiale des villes très demandées (phase lancement, sans stats)
    var highDemandCitiesLaunch = [
      'Paris',
      'Lyon',
      'Barcelone',
      'Lisbonne',
      'Palma de Majorque',
      'Montréal',
      'Guadeloupe',
      'Martinique',
      'La Réunion'
    ];

    // Fonction pour déterminer les villes très demandées (top 20% ou seuil minimum)
    function getVeryPopularCities(allCities) {
      if (!allCities || allCities.length === 0) return [];
      
      // Phase lancement : utiliser la liste initiale si peu de stats
      var hasStats = false;
      for (var k = 0; k < allCities.length; k++) {
        if (getCityPopularityScore(allCities[k]) > 0) {
          hasStats = true;
          break;
        }
      }
      
      if (!hasStats) {
        // Retourner l'intersection entre la liste initiale et les villes disponibles
        return allCities.filter(function(city) {
          return highDemandCitiesLaunch.indexOf(city) !== -1;
        });
      }
      
      // Phase avec stats : calcul dynamique
      var cityScores = [];
      for (var i = 0; i < allCities.length; i++) {
        var cityName = allCities[i];
        var score = getCityPopularityScore(cityName);
        cityScores.push({ name: cityName, score: score });
      }
      
      // Trier par score décroissant
      cityScores.sort(function(a, b) {
        return b.score - a.score;
      });
      
      // Calculer le seuil (top 20% ou minimum 3 villes si peu de données)
      var thresholdIndex = Math.max(3, Math.floor(cityScores.length * 0.2));
      var thresholdScore = cityScores.length > thresholdIndex ? cityScores[thresholdIndex].score : 0;
      
      // Si le seuil est trop bas (moins de 5 interactions), utiliser un seuil minimum
      var minThreshold = 5;
      if (thresholdScore < minThreshold && cityScores[0].score >= minThreshold) {
        thresholdScore = minThreshold;
      }
      
      // Retourner les villes au-dessus du seuil
      var veryPopular = [];
      for (var j = 0; j < cityScores.length; j++) {
        if (cityScores[j].score >= thresholdScore && cityScores[j].score > 0) {
          veryPopular.push(cityScores[j].name);
        }
      }
      
      return veryPopular;
    }

    // Ordre ajusté selon profil utilisateur (V2 - structure préparée)
    function getCityOrderForUser(cities, userProfile) {
      // V2 : Pour l'instant, retourner l'ordre par défaut
      // Structure préparée pour ajustement futur selon :
      // - Historique de recherche utilisateur
      // - Préférences géographiques
      // - Objectifs fréquents
      return cities;
    }

    // Lieu : Pays + Ville — remplir les villes selon le pays sélectionné
    var citiesByCountry = {
      'FR': ['Paris', 'Lyon', 'Marseille', 'Bordeaux', 'Nantes', 'Lille', 'Strasbourg', 'Rennes', 'Montpellier', 'Toulouse', 'Nice'],
      'BE': ['Bruxelles', 'Anvers', 'Liège'],
      'CH': ['Zurich', 'Genève', 'Bâle'],
      'ES': ['Barcelone', 'Palma de Majorque', 'Valence', 'Séville', 'Madrid', 'Ibiza', 'Tenerife'],
      'DE': ['Berlin', 'Munich', 'Hambourg'],
      'IT': ['Rome', 'Milan', 'Turin', 'Palerme', 'Toscane', 'Florence', 'Naples'],
      'PT': ['Lisbonne', 'Porto', 'Faro', 'Coimbra'],
      'NL': ['Amsterdam', 'Rotterdam', 'La Haye'],
      'GB': ['Londres', 'Manchester', 'Birmingham', 'Brighton', 'Édimbourg'],
      'CA': ['Montréal', 'Toronto', 'Vancouver'],
      'US': ['New York', 'Los Angeles', 'Chicago', 'San Francisco', 'Miami'],
      'MT': ['Valetta', 'Sliema', 'Saint Julien', 'Msida', 'Gzira', 'Ta\'Xbiex', 'Pieta'],
      'MC': ['Monte-Carlo', 'La Condamine', 'Fontvieille'],
      'LU': ['Luxembourg-Ville', 'Kirchberg', 'Esch-sur-Alzette'],
      'MA': ['Casablanca', 'Rabat', 'Tanger'],
      'TN': ['Tunis', 'Sfax', 'Sousse'],
      'SN': ['Dakar', 'Diamniadio', 'Thiès'],
      'CI': ['Abidjan', 'Yamoussoukro', 'San Pedro'],
      'IE': ['Dublin'],
      'HR': ['Split', 'Dubrovnik'],
      'GP': ['Pointe-à-Pitre', 'Basse-Terre', 'Saint-François'],
      'MQ': ['Fort-de-France', 'Le Lamentin', 'Sainte-Anne'],
      'GF': ['Cayenne', 'Kourou', 'Saint-Laurent-du-Maroni'],
      'RE': ['Saint-Denis', 'Saint-Pierre', 'Saint-Gilles-les-Bains'],
      'NC': ['Nouméa', 'Dumbéa', 'Mont-Dore'],
      'PF': ['Papeete', 'Faa\'a', 'Moorea']
    };
    var countrySelect = document.getElementById('homeswapFilterCountry');
    var citySelect = document.getElementById('homeswapFilterCity');
    var cityWrapper = document.getElementById('homeswapCityWrapper');
    var countryDropdown = document.getElementById('homeswapCountryDropdown');
    var countryTrigger = document.getElementById('homeswapCountryTrigger');
    var countryListbox = document.getElementById('homeswapCountryListbox');
    var countryListboxScroll = document.getElementById('homeswapCountryListboxScroll');
    var countryHiddenInput = document.getElementById('homeswapCountryInput');
    var countryIsOpen = false;
    var countryOptionEls = [];
    var countryActiveIndex = -1;
    var cityDropdown = document.getElementById('homeswapCityDropdown');
    var cityTrigger = document.getElementById('homeswapCityTrigger');
    var cityListbox = document.getElementById('homeswapCityListbox');
    var cityListboxScroll = document.getElementById('homeswapCityListboxScroll');
    var cityHiddenInput = document.getElementById('homeswapCityInput');
    var cityIsOpen = false;
    var cityOptionEls = [];
    var cityActiveIndex = -1;

    function syncCountryHiddenInput() {
      if (countryHiddenInput && countrySelect) {
        countryHiddenInput.value = countrySelect.value || '';
      }
    }

    function syncCountryTriggerText() {
      if (!countryTrigger || !countrySelect) return;
      var opt = countrySelect.options[countrySelect.selectedIndex];
      var label = opt && opt.textContent ? opt.textContent : 'Sélectionner un pays';
      var textEl = countryTrigger.querySelector('.homeswap-filter-trigger-text');
      if (textEl) textEl.textContent = label;
    }

    function renderCountryListbox() {
      if (!countryListbox || !countrySelect) return;
      var container = countryListboxScroll || countryListbox;
      container.innerHTML = '';
      countryOptionEls = [];
      for (var i = 0; i < countrySelect.options.length; i++) {
        var opt = countrySelect.options[i];
        var optionEl = document.createElement('div');
        optionEl.className = 'homeswap-filter-option';
        optionEl.setAttribute('role', 'option');
        optionEl.setAttribute('data-value', opt.value);
        optionEl.id = 'homeswapCountryOption-' + i;
        optionEl.setAttribute('aria-selected', opt.value === countrySelect.value ? 'true' : 'false');

        var textSpan = document.createElement('span');
        textSpan.className = 'homeswap-filter-option-text';
        textSpan.textContent = opt.textContent;
        optionEl.appendChild(textSpan);

        optionEl.addEventListener('click', function(e) {
          e.stopPropagation();
          selectCountryValue(this.getAttribute('data-value'));
        });
        optionEl.addEventListener('mouseenter', (function(index) {
          return function() { setActiveCountryIndex(index); };
        })(i));

        container.appendChild(optionEl);
        countryOptionEls.push(optionEl);
      }
    }

    function setActiveCountryIndex(nextIndex) {
      if (!countryOptionEls.length) return;
      if (nextIndex < 0) nextIndex = 0;
      if (nextIndex >= countryOptionEls.length) nextIndex = countryOptionEls.length - 1;
      countryActiveIndex = nextIndex;
      countryOptionEls.forEach(function(opt, idx) {
        opt.classList.toggle('is-active', idx === countryActiveIndex);
      });
      var activeEl = countryOptionEls[countryActiveIndex];
      if (activeEl && countryTrigger) {
        countryTrigger.setAttribute('aria-activedescendant', activeEl.id);
        activeEl.scrollIntoView({ block: 'nearest' });
      }
    }

    function openCountryListbox() {
      if (!countryListbox || !countryTrigger) return;
      if (countryIsOpen) return;
      countryIsOpen = true;
      countryListbox.classList.add('is-open');
      countryTrigger.setAttribute('aria-expanded', 'true');
      if (countrySelect) {
        var idx = Math.max(0, countrySelect.selectedIndex);
        setActiveCountryIndex(idx);
      }
    }

    function closeCountryListbox() {
      if (!countryListbox || !countryTrigger) return;
      if (!countryIsOpen) return;
      countryIsOpen = false;
      countryListbox.classList.remove('is-open');
      countryTrigger.setAttribute('aria-expanded', 'false');
      countryTrigger.removeAttribute('aria-activedescendant');
    }

    function toggleCountryListbox() {
      if (countryIsOpen) closeCountryListbox();
      else openCountryListbox();
    }

    function selectCountryValue(value) {
      if (!countrySelect) return;
      countrySelect.value = value;
      syncCountryHiddenInput();
      syncCountryTriggerText();
      renderCountryListbox();
      countrySelect.dispatchEvent(new Event('change', { bubbles: true }));
      closeCountryListbox();
    }

    function updateHomeswapCities() {
      if (!countrySelect || !citySelect) return;
      var country = countrySelect.value;
      citySelect.innerHTML = '<option value="">Sélectionner une ville ou zone</option>';
      if (country && citiesByCountry[country]) {
        var cities = citiesByCountry[country].slice();
        
        // V2 : Ordre ajusté selon profil utilisateur (pour l'instant = ordre par défaut)
        var userProfile = null; // À implémenter V2
        cities = getCityOrderForUser(cities, userProfile);
        
        // Calculer dynamiquement les villes très demandées pour ce pays
        var veryPopularForCountry = getVeryPopularCities(cities);
        
        for (var i = 0; i < cities.length; i++) {
          var cityName = cities[i];
          var opt = document.createElement('option');
          opt.value = cityName;
          
          // V1+V2 : Nom uniquement dans le select (aucun badge visible)
          opt.textContent = cityName;
          
          // Mapping interne (invisible, utilisé pour l'assistant post-sélection)
          var badges = cityBadges[cityName];
          var seoText = citySeoText[cityName];
          var isVeryPopular = veryPopularForCountry.indexOf(cityName) !== -1;
          
          // Statistiques internes (invisibles)
          var stats = cityStats[cityName] || { clicks: 0, searches: 0, selections: 0 };
          opt.setAttribute('data-stats-clicks', stats.clicks || 0);
          opt.setAttribute('data-stats-searches', stats.searches || 0);
          opt.setAttribute('data-stats-selections', stats.selections || 0);
          opt.setAttribute('data-popularity-score', getCityPopularityScore(cityName));
          
          // Attributs data pour l'assistant post-sélection (invisibles dans le select)
          if (badges && badges.length > 0) {
            opt.setAttribute('data-badges', JSON.stringify(badges));
          }
          if (seoText) {
            opt.setAttribute('data-seo-text', seoText);
          }
          if (isVeryPopular) {
            opt.setAttribute('data-very-popular', 'true');
          }
          
          citySelect.appendChild(opt);
        }
        
        var selectedCity = form.getAttribute('data-selected-city');
        if (selectedCity && cities.indexOf(selectedCity) !== -1) {
          citySelect.value = selectedCity;
          form.removeAttribute('data-selected-city');
        }

        syncCityTriggerText();
        syncCityHiddenInput();
        renderCityListbox();
        
        // Afficher l'assistant post-sélection si une ville est sélectionnée
        setTimeout(function() {
          updateCityAssistant();
        }, 50);
      }

      syncCityTriggerText();
      syncCityHiddenInput();
      renderCityListbox();
    }

    function syncCityHiddenInput() {
      if (cityHiddenInput && citySelect) {
        cityHiddenInput.value = citySelect.value || '';
      }
    }

    function syncCityTriggerText() {
      if (!cityTrigger || !citySelect) return;
      var opt = citySelect.options[citySelect.selectedIndex];
      var label = opt && opt.textContent ? opt.textContent : 'Sélectionner une ville ou zone';
      var textEl = cityTrigger.querySelector('.homeswap-city-trigger-text');
      if (textEl) textEl.textContent = label;
    }

    function setActiveCityIndex(nextIndex) {
      if (!cityOptionEls.length) return;
      if (nextIndex < 0) nextIndex = 0;
      if (nextIndex >= cityOptionEls.length) nextIndex = cityOptionEls.length - 1;
      cityActiveIndex = nextIndex;
      cityOptionEls.forEach(function(opt, idx) {
        opt.classList.toggle('is-active', idx === cityActiveIndex);
      });
      var activeEl = cityOptionEls[cityActiveIndex];
      if (activeEl && cityTrigger) {
        cityTrigger.setAttribute('aria-activedescendant', activeEl.id);
        activeEl.scrollIntoView({ block: 'nearest' });
      }
    }

    function openCityListbox() {
      if (!cityListbox || !cityTrigger) return;
      if (cityIsOpen) return;
      cityIsOpen = true;
      cityListbox.classList.add('is-open');
      cityTrigger.setAttribute('aria-expanded', 'true');
      if (citySelect) {
        var idx = Math.max(0, citySelect.selectedIndex);
        setActiveCityIndex(idx);
      }
    }

    function closeCityListbox() {
      if (!cityListbox || !cityTrigger) return;
      if (!cityIsOpen) return;
      cityIsOpen = false;
      cityListbox.classList.remove('is-open');
      cityTrigger.setAttribute('aria-expanded', 'false');
      cityTrigger.removeAttribute('aria-activedescendant');
    }

    function toggleCityListbox() {
      if (cityIsOpen) closeCityListbox();
      else openCityListbox();
    }

    function selectCityValue(value) {
      if (!citySelect) return;
      citySelect.value = value;
      syncCityHiddenInput();
      syncCityTriggerText();
      renderCityListbox();
      updateCityAssistant();
      citySelect.dispatchEvent(new Event('change', { bubbles: true }));
      closeCityListbox();
    }

    // Icônes SVG pour l'assistant (monochrome, ligne fine)
    var assistantIcons = {
      active: '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="5.5" stroke="currentColor" stroke-width="1.25"/><path d="M4.5 7.2L6.2 8.8L9.5 5.4" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      fiche: '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 2.5H8.5L10.5 4.5V11.5H4V2.5Z" stroke="currentColor" stroke-width="1.25" stroke-linejoin="round"/><path d="M8.5 2.5V4.5H10.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>',
      international: '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="1.25"/><path d="M2 7H12M7 2C8 3.5 8 4.5 7 7C6 9.5 6 10.5 7 12" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>',
      info: '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="5.5" stroke="currentColor" stroke-width="1.25"/><path d="M7 4.2V4.6M7 6.6V9.2" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>'
    };

    function buildTooltipText(sections) {
      if (!sections || sections.length === 0) return '';
      var lines = [];
      for (var i = 0; i < sections.length; i++) {
        var section = sections[i];
        if (!section) continue;
        if (section.title && section.text) {
          lines.push(section.title + '\n' + section.text);
        } else if (section.title) {
          lines.push(section.title);
        } else if (section.text) {
          lines.push(section.text);
        }
      }
      return lines.join('\n');
    }

    function createTooltipIcon(iconItem, tabindexValue) {
      var iconWrapper = document.createElement('span');
      iconWrapper.className = 'homeswap-city-icon homeswap-icon-tip';
      iconWrapper.setAttribute('aria-label', iconItem.ariaLabel);
      iconWrapper.setAttribute('tabindex', tabindexValue);
      var tooltipText = buildTooltipText(iconItem.tooltip);
      if (!tooltipText) tooltipText = iconItem.ariaLabel || '';
      if (tooltipText) iconWrapper.setAttribute('data-tooltip', tooltipText);
      iconWrapper.innerHTML = assistantIcons[iconItem.key] || '';
      iconWrapper.addEventListener('mousedown', function(e) { e.stopPropagation(); });
      iconWrapper.addEventListener('click', function(e) { e.stopPropagation(); });
      return iconWrapper;
    }

    function getCityIconConfigs(meta) {
      var icons = [];
      icons.push({
        key: 'active',
        ariaLabel: 'Ville active sur Junspro',
        tooltip: [
          { title: 'Ville active sur Junspro', text: 'Des échanges sont déjà possibles dans cette ville.' }
        ]
      });
      if (meta.hasDetails) {
        icons.push({
          key: 'fiche',
          ariaLabel: 'Informations détaillées disponibles',
          tooltip: [
            { text: 'Informations détaillées disponibles pour cette destination.' }
          ]
        });
      }
      if (meta.isInternational) {
        icons.push({
          key: 'international',
          ariaLabel: 'Ville internationale',
          tooltip: [
            { title: 'Ville internationale', text: 'Ville fréquemment choisie pour des échanges internationaux.' }
          ]
        });
      }
      if (meta.showInfo) {
        var infoSections = [];
        infoSections.push({
          title: 'Pourquoi cette ville ?',
          text: meta.objectives.length > 0 ? 'Souvent choisie pour : ' + meta.objectives.join(' · ') : null
        });
        if (meta.isVeryPopular) {
          infoSections.push({
            text: 'Statut : Ville très demandée sur Junspro',
            isBadge: true
          });
        }
        icons.push({
          key: 'info',
          ariaLabel: 'Pourquoi cette ville ?',
          tooltip: infoSections
        });
      }
      return icons;
    }

    function renderCityListbox() {
      if (!cityListbox || !citySelect) return;
      var container = cityListboxScroll || cityListbox;
      container.innerHTML = '';
      cityOptionEls = [];
      for (var i = 0; i < citySelect.options.length; i++) {
        var opt = citySelect.options[i];
        var optionEl = document.createElement('div');
        optionEl.className = 'homeswap-city-option';
        optionEl.setAttribute('role', 'option');
        optionEl.setAttribute('data-value', opt.value);
        optionEl.id = 'homeswapCityOption-' + i;
        optionEl.setAttribute('aria-selected', opt.value === citySelect.value ? 'true' : 'false');

        var textSpan = document.createElement('span');
        textSpan.className = 'homeswap-city-option-text';
        textSpan.textContent = opt.textContent;
        optionEl.appendChild(textSpan);

        if (opt.value) {
          var badges = [];
          var badgesJson = opt.getAttribute('data-badges');
          if (badgesJson) {
            try { badges = JSON.parse(badgesJson); } catch (e) { badges = []; }
          }
          var objectives = getDisplayBadges(badges);
          var meta = {
            objectives: objectives,
            hasDetails: !!opt.getAttribute('data-seo-text'),
            isInternational: countrySelect && countrySelect.value && countrySelect.value !== 'FR',
            isVeryPopular: opt.getAttribute('data-very-popular') === 'true',
            showInfo: objectives.length > 0 || opt.getAttribute('data-very-popular') === 'true'
          };
          var icons = getCityIconConfigs(meta);
          if (icons.length) {
            var iconsContainer = document.createElement('div');
            iconsContainer.className = 'homeswap-city-icons';
            for (var j = 0; j < icons.length; j++) {
              var iconItem = icons[j];
              iconsContainer.appendChild(createTooltipIcon(iconItem, '-1'));
            }
            optionEl.appendChild(iconsContainer);
          }
        }

        optionEl.addEventListener('click', function(e) {
          e.stopPropagation();
          selectCityValue(this.getAttribute('data-value'));
        });
        optionEl.addEventListener('mouseenter', (function(index) {
          return function() { setActiveCityIndex(index); };
        })(i));

        container.appendChild(optionEl);
        cityOptionEls.push(optionEl);
      }
    }

    // Fonction pour mettre à jour l'assistant post-sélection (icônes + popover)
    function updateCityAssistant() {
      if (!citySelect || !cityWrapper) return;
      var selectedOption = citySelect.options[citySelect.selectedIndex];
      
      // Supprimer l'assistant existant
      var existingAssistant = cityWrapper.querySelector('.homeswap-city-assistant');
      if (existingAssistant) existingAssistant.remove();
      
      // Réinitialiser le padding du select
      if (citySelect) {
        citySelect.style.paddingRight = '';
      }
      
      if (!selectedOption || !selectedOption.value) {
        return;
      }
      
      var cityName = selectedOption.value;
      var badgesJson = selectedOption.getAttribute('data-badges');
      var isVeryPopular = selectedOption.getAttribute('data-very-popular') === 'true';
      var seoText = selectedOption.getAttribute('data-seo-text');
      
      var badges = [];
      if (badgesJson) {
        try {
          badges = JSON.parse(badgesJson);
        } catch (e) {
          badges = [];
        }
      }
      
      var objectives = getDisplayBadges(badges);
      var hasDetails = !!seoText;
      var isInternational = countrySelect && countrySelect.value && countrySelect.value !== 'FR';
      var showInfo = objectives.length > 0 || isVeryPopular;
      
      var assistant = document.createElement('div');
      assistant.className = 'homeswap-city-assistant';
      assistant.setAttribute('role', 'group');
      assistant.setAttribute('aria-label', 'Informations sur ' + cityName);
      var iconsContainer = document.createElement('div');
      iconsContainer.className = 'homeswap-city-icons';

      var icons = getCityIconConfigs({
        objectives: objectives,
        hasDetails: hasDetails,
        isInternational: isInternational,
        isVeryPopular: isVeryPopular,
        showInfo: showInfo
      });

      if (icons.length === 0) {
        return;
      }

      for (var i = 0; i < icons.length; i++) {
        var iconItem = icons[i];
        iconsContainer.appendChild(createTooltipIcon(iconItem, '0'));
      }

      assistant.appendChild(iconsContainer);
      
      cityWrapper.appendChild(assistant);
      
      // Ajuster le padding du select pour laisser de la place aux icônes
      if (citySelect.parentElement) {
        citySelect.style.paddingRight = '4.5rem';
      }
    }

    if (cityTrigger && cityListbox) {
      cityTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleCityListbox();
      });
      cityTrigger.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowDown') {
          e.preventDefault();
          if (!cityIsOpen) openCityListbox();
          else setActiveCityIndex(cityActiveIndex + 1);
        } else if (e.key === 'ArrowUp') {
          e.preventDefault();
          if (!cityIsOpen) openCityListbox();
          else setActiveCityIndex(cityActiveIndex - 1);
        } else if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          if (!cityIsOpen) {
            openCityListbox();
          } else if (cityOptionEls[cityActiveIndex]) {
            selectCityValue(cityOptionEls[cityActiveIndex].getAttribute('data-value'));
          }
        } else if (e.key === 'Escape') {
          closeCityListbox();
        }
      });

      document.addEventListener('click', function(e) {
        if (!cityDropdown) return;
        if (!cityDropdown.contains(e.target)) {
          closeCityListbox();
        }
      });
    }

    if (countryTrigger && countryListbox) {
      countryTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleCountryListbox();
      });
      countryTrigger.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowDown') {
          e.preventDefault();
          if (!countryIsOpen) openCountryListbox();
          else setActiveCountryIndex(countryActiveIndex + 1);
        } else if (e.key === 'ArrowUp') {
          e.preventDefault();
          if (!countryIsOpen) openCountryListbox();
          else setActiveCountryIndex(countryActiveIndex - 1);
        } else if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          if (!countryIsOpen) {
            openCountryListbox();
          } else if (countryOptionEls[countryActiveIndex]) {
            selectCountryValue(countryOptionEls[countryActiveIndex].getAttribute('data-value'));
          }
        } else if (e.key === 'Escape') {
          closeCountryListbox();
        }
      });

      document.addEventListener('click', function(e) {
        if (!countryDropdown) return;
        if (!countryDropdown.contains(e.target)) {
          closeCountryListbox();
        }
      });
    }


    if (countrySelect && citySelect) {
      syncCountryHiddenInput();
      syncCountryTriggerText();
      renderCountryListbox();

      // Tracker les clics sur le select ville (statistiques internes)
      citySelect.addEventListener('focus', function() {
        var currentCity = citySelect.value;
        if (currentCity) {
          incrementCityStat(currentCity, 'clicks');
        }
      });
      
      // Tracker les sélections de ville (statistiques internes)
      citySelect.addEventListener('change', function() {
        var selectedCity = citySelect.value;
        if (selectedCity) {
          incrementCityStat(selectedCity, 'selections');
        }
        syncCityHiddenInput();
        syncCityTriggerText();
        renderCityListbox();
        // Afficher l'assistant post-sélection
        updateCityAssistant();
      });
      
      countrySelect.addEventListener('change', function() {
        syncCountryHiddenInput();
        syncCountryTriggerText();
        renderCountryListbox();
        updateHomeswapCities();
      });
      
      // Initialisation : charger les villes et afficher l'assistant si ville déjà sélectionnée
      updateHomeswapCities();
      
      // Afficher l'assistant au chargement si une ville est déjà sélectionnée (via request)
      setTimeout(function() {
        if (citySelect.value) {
          updateCityAssistant();
        }
      }, 100);
    }
    
    // Tracker les recherches avec ville sélectionnée (statistiques internes)
    if (form) {
      form.addEventListener('submit', function() {
        var selectedCity = citySelect ? citySelect.value : null;
        if (selectedCity) {
          incrementCityStat(selectedCity, 'searches');
        }
      });
    }

    var tripPurposeAutre = document.getElementById('homeswapTripPurposeAutre');
    var tripPurposeOther = document.getElementById('homeswapTripPurposeOther');
    if (tripPurposeAutre && tripPurposeOther) {
      function toggleTripPurposeOther() {
        tripPurposeOther.style.display = tripPurposeAutre.checked ? 'block' : 'none';
        if (!tripPurposeAutre.checked) {
          tripPurposeOther.value = '';
        }
      }
      tripPurposeAutre.addEventListener('change', toggleTripPurposeOther);
      toggleTripPurposeOther();
    }

    var resetBtn = document.getElementById('homeswapResetFilters');
    if (resetBtn) {
      resetBtn.addEventListener('click', function() {
        form.reset();
        form.querySelectorAll('.homeswap-checkbox-input').forEach(function(cb) {
          cb.checked = false;
        });
        form.querySelectorAll('.homeswap-filter-select').forEach(function(select) {
          select.selectedIndex = 0;
        });
        var datesDisplayEl = document.getElementById('homeswapDatesDisplay');
        var startEl = document.getElementById('homeswapStartDate');
        var endEl = document.getElementById('homeswapEndDate');
        if (datesDisplayEl) datesDisplayEl.value = '';
        if (startEl) startEl.value = '';
        if (endEl) endEl.value = '';
        if (typeof window.homeswapFlatpickrInstance !== 'undefined' && window.homeswapFlatpickrInstance) {
          window.homeswapFlatpickrInstance.clear();
        }
        if (tripPurposeOther) {
          tripPurposeOther.style.display = 'none';
        }
        if (typeof updateHomeswapCities === 'function') {
          updateHomeswapCities();
        }
        syncCountryHiddenInput();
        syncCountryTriggerText();
        renderCountryListbox();
        syncCityHiddenInput();
        syncCityTriggerText();
        renderCityListbox();
        updateCityAssistant();
        if (typeof window.applyFiltersAjax === 'function') {
          window.applyFiltersAjax({});
        } else {
          form.submit();
        }
      });
    }

    var filterInputs = form.querySelectorAll('.homeswap-filter-input, .homeswap-filter-select, .homeswap-checkbox-input');
    filterInputs.forEach(function(input) {
      input.addEventListener('change', function() {
        if (input.type === 'checkbox') return;
        if (typeof window.applyFiltersAjax === 'function') {
          window.applyFiltersAjax({});
        }
      });
    });

    var checkboxTimeout;
    form.querySelectorAll('.homeswap-checkbox-input').forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        clearTimeout(checkboxTimeout);
        checkboxTimeout = setTimeout(function() {
          if (typeof window.applyFiltersAjax === 'function') {
            window.applyFiltersAjax({});
          }
        }, 500);
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', runHomeswapFiltersInit);
  } else {
    runHomeswapFiltersInit();
  }
})();
