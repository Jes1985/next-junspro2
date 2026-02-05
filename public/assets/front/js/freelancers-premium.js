/**
 * Freelancers Premium - JavaScript
 * Gestion des filtres, quick view, mobile drawer
 */

(function() {
  'use strict';

  // ============================================
  // INITIALISATION
  // ============================================
  document.addEventListener('DOMContentLoaded', function() {
    initFilters();
    initQuickView();
    initMobileDrawer();
    initPriceSliders();
    initToggleButtons();
  });

  // ============================================
  // FILTRES
  // ============================================
  function initFilters() {
    const filterForm = document.getElementById('freelancers-filter-form');
    if (!filterForm) return;

    // Auto-submit sur changement de filtre
    const filterInputs = filterForm.querySelectorAll('input[type="checkbox"], input[type="radio"], input[type="text"], input[type="number"]');
    filterInputs.forEach(input => {
      input.addEventListener('change', function() {
        // Délai pour éviter trop de requêtes
        clearTimeout(window.filterTimeout);
        window.filterTimeout = setTimeout(() => {
          filterForm.submit();
        }, 500);
      });
    });

    // Bouton Réinitialiser
    const resetBtn = document.getElementById('reset-filters');
    if (resetBtn) {
      resetBtn.addEventListener('click', function() {
        filterForm.reset();
        // Réinitialiser les sliders
        if (window.hourlySlider) {
          window.hourlySlider.set([10, 299]);
        }
        filterForm.submit();
      });
    }
  }

  // ============================================
  // TOGGLE TARIF HORAIRE / BUDGET PROJET
  // ============================================
  function initToggleButtons() {
    const toggleBtns = document.querySelectorAll('.filter-toggle-btn');
    const hourlyFilter = document.getElementById('hourly-price-filter');
    const projectFilter = document.getElementById('project-price-filter');

    toggleBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const mode = this.dataset.mode;
        
        // Mettre à jour les boutons
        toggleBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        // Afficher/masquer les filtres
        if (mode === 'hourly') {
          hourlyFilter.style.display = 'block';
          projectFilter.style.display = 'none';
        } else {
          hourlyFilter.style.display = 'none';
          projectFilter.style.display = 'block';
        }
      });
    });
  }

  // ============================================
  // SLIDERS PRIX
  // ============================================
  function initPriceSliders() {
    // Vérifier si jQuery UI est disponible
    if (typeof jQuery === 'undefined' || !jQuery.ui || !jQuery.ui.slider) {
      console.warn('jQuery UI Slider non disponible');
      return;
    }

    const hourlyMin = document.getElementById('hourly-min');
    const hourlyMax = document.getElementById('hourly-max');
    
    if (hourlyMin && hourlyMax) {
      const slider = jQuery('#hourly-rate-slider');
      if (slider.length) {
        const minValue = parseInt(hourlyMin.value) || 10;
        const maxValue = parseInt(hourlyMax.value) || 299;

        slider.slider({
          range: true,
          min: 0,
          max: 500,
          values: [minValue, maxValue],
          slide: function(event, ui) {
            hourlyMin.value = ui.values[0];
            hourlyMax.value = ui.values[1];
          },
          change: function(event, ui) {
            // Auto-submit après changement
            clearTimeout(window.sliderTimeout);
            window.sliderTimeout = setTimeout(() => {
              const form = document.getElementById('freelancers-filter-form');
              if (form) form.submit();
            }, 800);
          }
        });

        // Synchroniser les inputs avec le slider
        hourlyMin.addEventListener('change', function() {
          const values = slider.slider('values');
          slider.slider('values', [parseInt(this.value) || 0, values[1]]);
        });

        hourlyMax.addEventListener('change', function() {
          const values = slider.slider('values');
          slider.slider('values', [values[0], parseInt(this.value) || 500]);
        });

        window.hourlySlider = slider;
      }
    }
  }

  // ============================================
  // QUICK VIEW (Carte au survol)
  // ============================================
  function initQuickView() {
    const cardWrappers = document.querySelectorAll('.freelancer-card-wrapper');
    
    cardWrappers.forEach(wrapper => {
      const card = wrapper.querySelector('.freelancer-card-premium');
      const quickView = wrapper.querySelector('.freelancer-quick-view');
      
      if (!card || !quickView) return;

      // Gérer le survol
      let hoverTimeout;
      
      function showQuickView() {
        clearTimeout(hoverTimeout);
        quickView.style.opacity = '1';
        quickView.style.visibility = 'visible';
        quickView.style.transform = 'translateY(0)';
        quickView.style.pointerEvents = 'all';
      }

      function hideQuickView() {
        hoverTimeout = setTimeout(() => {
          quickView.style.opacity = '0';
          quickView.style.visibility = 'hidden';
          quickView.style.transform = 'translateY(8px)';
          quickView.style.pointerEvents = 'none';
        }, 200);
      }

      card.addEventListener('mouseenter', showQuickView);
      card.addEventListener('mouseleave', hideQuickView);
      quickView.addEventListener('mouseenter', showQuickView);
      quickView.addEventListener('mouseleave', hideQuickView);

      // Bouton play vidéo
      const playBtn = quickView.querySelector('.quick-view-play-btn');
      if (playBtn) {
        playBtn.addEventListener('click', function(e) {
          e.preventDefault();
          const videoUrl = this.dataset.videoUrl;
          if (videoUrl) {
            // Ouvrir la vidéo en modal ou rediriger
            window.open(videoUrl, '_blank');
          }
        });
      }
    });

    // Ajuster la position de la quick view si elle dépasse
    adjustQuickViewPosition();
    window.addEventListener('resize', adjustQuickViewPosition);
  }

  function adjustQuickViewPosition() {
    const quickViews = document.querySelectorAll('.freelancer-quick-view');
    quickViews.forEach(qv => {
      const rect = qv.getBoundingClientRect();
      const windowWidth = window.innerWidth;
      
      // Si la quick view dépasse à droite, la mettre à gauche
      if (rect.right > windowWidth - 20) {
        qv.style.left = 'auto';
        qv.style.right = 'calc(100% + 24px)';
      } else {
        qv.style.left = 'calc(100% + 24px)';
        qv.style.right = 'auto';
      }
    });
  }

  // ============================================
  // MOBILE DRAWER
  // ============================================
  function initMobileDrawer() {
    const mobileBtn = document.getElementById('filter-mobile-btn');
    const sidebar = document.getElementById('freelancers-sidebar');
    const closeBtn = sidebar?.querySelector('.sidebar-close-btn');

    if (!mobileBtn || !sidebar) return;

    // Ouvrir le drawer
    mobileBtn.addEventListener('click', function() {
      sidebar.classList.add('open');
      document.body.style.overflow = 'hidden';
    });

    // Fermer le drawer
    if (closeBtn) {
      closeBtn.addEventListener('click', function() {
        sidebar.classList.remove('open');
        document.body.style.overflow = '';
      });
    }

    // Fermer en cliquant en dehors
    sidebar.addEventListener('click', function(e) {
      if (e.target === sidebar) {
        sidebar.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  }

  // ============================================
  // AUTRES FONCTIONNALITÉS
  // ============================================
  
  // Auto-complétion pays (basique)
  const countryInput = document.getElementById('country-autocomplete');
  if (countryInput) {
    const countries = ['FR', 'BE', 'CH', 'CA', 'GB', 'US', 'DE', 'ES', 'IT', 'PT', 'NL'];
    
    countryInput.addEventListener('input', function() {
      const value = this.value.toUpperCase();
      // Logique d'autocomplétion simple (peut être améliorée avec une librairie)
    });
  }

  // Skeleton loader pendant le chargement
  function showSkeletonLoader() {
    const list = document.getElementById('freelancers-list');
    if (list) {
      list.style.opacity = '0.5';
      list.style.pointerEvents = 'none';
    }
  }

  function hideSkeletonLoader() {
    const list = document.getElementById('freelancers-list');
    if (list) {
      list.style.opacity = '1';
      list.style.pointerEvents = 'all';
    }
  }

  // Intercepter les soumissions de formulaire pour afficher le loader
  const filterForm = document.getElementById('freelancers-filter-form');
  if (filterForm) {
    filterForm.addEventListener('submit', function() {
      showSkeletonLoader();
      // Le loader sera caché au rechargement de la page
    });
  }

})();




