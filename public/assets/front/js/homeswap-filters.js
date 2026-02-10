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
 * - Post-sélection : icônes monochromes + bouton "i" apparaissent à droite du champ
 * - Popover : informations révélées uniquement au clic sur "i"
 * - Aucune info visible sans action volontaire
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
        
        // Afficher l'assistant post-sélection si une ville est sélectionnée
        setTimeout(function() {
          updateCityAssistant();
        }, 50);
      }
    }

    // Icônes SVG premium par objectif (monochrome, ligne fine)
    var objectiveIcons = {
      'Business': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.5 4.5V11.5H10.5V4.5M3.5 4.5H10.5M3.5 4.5V2.5C3.5 2.22386 3.72386 2 4 2H10C10.2761 2 10.5 2.22386 10.5 2.5V4.5M5.5 7H8.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      'Workation': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 3.5C2.5 3.22386 2.72386 3 3 3H11C11.2761 3 11.5 3.22386 11.5 3.5V10.5C11.5 10.7761 11.2761 11 11 11H3C2.72386 11 2.5 10.7761 2.5 10.5V3.5Z" stroke="currentColor" stroke-width="1.25"/><path d="M5.5 7L6.5 8L8.5 6" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      'Famille': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 2.5L3.5 5.5V11.5H5.5V7.5H8.5V11.5H10.5V5.5L7 2.5Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      'Langue': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="1.25"/><path d="M2 7H12M7 2C7.5 3.5 7.5 4.5 7 7C6.5 9.5 6.5 10.5 7 12" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>',
      'Repos': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.5 7C3.5 5.067 5.067 3.5 7 3.5C8.933 3.5 10.5 5.067 10.5 7C10.5 8.933 8.933 10.5 7 10.5C5.067 10.5 3.5 8.933 3.5 7Z" stroke="currentColor" stroke-width="1.25"/><path d="M5 7L6.5 8.5L9 6" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      'Culture': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 2V12M2 7H12" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/><circle cx="7" cy="7" r="4" stroke="currentColor" stroke-width="1.25"/></svg>'
    };

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
      
      // Ne rien afficher si aucune info disponible (objectifs affichés ou ville très demandée)
      var displayBadgesForAssistant = getDisplayBadges(badges);
      if (displayBadgesForAssistant.length === 0 && !isVeryPopular) {
        return;
      }
      
      // Créer le wrapper assistant
      var assistant = document.createElement('div');
      assistant.className = 'homeswap-city-assistant';
      assistant.setAttribute('role', 'group');
      assistant.setAttribute('aria-label', 'Informations sur ' + cityName);
      
      // Icônes objectifs (liste fermée, max 2)
      var displayBadges = getDisplayBadges(badges);
      if (displayBadges.length > 0) {
        var iconsContainer = document.createElement('div');
        iconsContainer.className = 'homeswap-city-icons';
        for (var i = 0; i < displayBadges.length; i++) {
          var iconWrapper = document.createElement('span');
          iconWrapper.className = 'homeswap-city-icon';
          iconWrapper.setAttribute('aria-label', displayBadges[i]);
          iconWrapper.innerHTML = objectiveIcons[displayBadges[i]] || '';
          iconsContainer.appendChild(iconWrapper);
        }
        assistant.appendChild(iconsContainer);
      }

      // Icône "Ville très demandée en ce moment"
      if (isVeryPopular) {
        var popularIcon = document.createElement('span');
        popularIcon.className = 'homeswap-city-icon homeswap-city-icon-popular';
        popularIcon.setAttribute('aria-label', 'Ville très demandée en ce moment');
        popularIcon.innerHTML = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="6" cy="6" r="4.5" stroke="currentColor" stroke-width="1.25"/><circle cx="6" cy="6" r="1.5" fill="currentColor"/></svg>';
        assistant.appendChild(popularIcon);
      }
      
      // Bouton info (micro "i")
      if (displayBadgesForAssistant.length > 0 || isVeryPopular || seoText) {
        var infoBtn = document.createElement('button');
        infoBtn.type = 'button';
        infoBtn.className = 'homeswap-city-info-btn';
        infoBtn.setAttribute('aria-label', 'Informations sur ' + cityName);
        infoBtn.setAttribute('aria-expanded', 'false');
        infoBtn.innerHTML = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.25"/><path d="M6 4V4.5M6 7.5V8" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>';
        infoBtn.addEventListener('click', function(e) {
          e.stopPropagation();
          toggleCityPopover(cityName, displayBadgesForAssistant, isVeryPopular, seoText, infoBtn);
        });
        assistant.appendChild(infoBtn);
      }
      
      cityWrapper.appendChild(assistant);
      
      // Ajuster le padding du select pour laisser de la place aux icônes
      if (citySelect.parentElement) {
        citySelect.style.paddingRight = '4.5rem';
      }
    }

    // Fonction pour afficher/masquer le popover
    function toggleCityPopover(cityName, badges, isVeryPopular, seoText, triggerBtn) {
      var existingPopover = document.querySelector('.homeswap-city-popover');
      if (existingPopover && existingPopover.dataset.city === cityName) {
        existingPopover.remove();
        triggerBtn.setAttribute('aria-expanded', 'false');
        return;
      }
      
      // Supprimer les autres popovers
      var allPopovers = document.querySelectorAll('.homeswap-city-popover');
      allPopovers.forEach(function(p) { p.remove(); });
      document.querySelectorAll('.homeswap-city-info-btn').forEach(function(btn) {
        btn.setAttribute('aria-expanded', 'false');
      });
      
      // Créer le popover
      var popover = document.createElement('div');
      popover.className = 'homeswap-city-popover';
      popover.setAttribute('role', 'dialog');
      popover.setAttribute('aria-label', 'Informations sur ' + cityName);
      popover.dataset.city = cityName;
      
      var popoverContent = document.createElement('div');
      popoverContent.className = 'homeswap-city-popover-content';
      popoverContent.setAttribute('aria-label', 'Information ville');

      // Souvent choisie pour : [Objectif 1] • [Objectif 2] (max 2, liste fermée)
      var displayBadgesPopover = badges && badges.length > 0 ? getDisplayBadges(badges) : [];
      if (displayBadgesPopover.length > 0) {
        var lineObjectives = document.createElement('p');
        lineObjectives.className = 'homeswap-city-popover-text';
        lineObjectives.textContent = 'Souvent choisie pour : ' + displayBadgesPopover.join(' • ');
        popoverContent.appendChild(lineObjectives);
      }

      // Ville très demandée en ce moment (ligne séparée, optionnelle)
      if (isVeryPopular) {
        var linePopular = document.createElement('p');
        linePopular.className = 'homeswap-city-popover-text homeswap-city-popover-badge';
        linePopular.textContent = 'Ville très demandée en ce moment';
        popoverContent.appendChild(linePopular);
      }

      popover.appendChild(popoverContent);
      document.body.appendChild(popover);
      
      // Positionner le popover (centré sous le bouton, avec gestion des bords)
      var rect = triggerBtn.getBoundingClientRect();
      var popoverWidth = popover.offsetWidth || 280;
      var popoverHeight = popover.offsetHeight || 120;
      var leftPos = rect.left + rect.width / 2 - popoverWidth / 2;
      var topPos = rect.bottom + 8;
      
      // Ajuster si le popover sort de l'écran
      if (leftPos < 8) leftPos = 8;
      if (leftPos + popoverWidth > window.innerWidth - 8) {
        leftPos = window.innerWidth - popoverWidth - 8;
      }
      if (topPos + popoverHeight > window.innerHeight - 8) {
        topPos = rect.top - popoverHeight - 8;
      }
      
      popover.style.left = leftPos + 'px';
      popover.style.top = topPos + 'px';
      
      triggerBtn.setAttribute('aria-expanded', 'true');
      
      // Fermer au clic extérieur
      setTimeout(function() {
        document.addEventListener('click', function closePopover(e) {
          if (!popover.contains(e.target) && e.target !== triggerBtn) {
            popover.remove();
            triggerBtn.setAttribute('aria-expanded', 'false');
            document.removeEventListener('click', closePopover);
          }
        });
      }, 10);
    }


    if (countrySelect && citySelect) {
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
        // Afficher l'assistant post-sélection
        updateCityAssistant();
      });
      
      countrySelect.addEventListener('change', function() {
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

    if (countrySelect && citySelect) {
      countrySelect.addEventListener('change', updateHomeswapCities);
      updateHomeswapCities();
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
