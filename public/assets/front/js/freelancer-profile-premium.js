/**
 * Freelancer Profile Premium - JavaScript
 * Gestion de l'agenda, accordéons, tabs, etc.
 */

(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', function() {
    initAgenda();
    initAboutToggle();
    initSpecializations();
    initCVTabs();
    initVideoModal();
    initShareProfile();
    initSaveFreelancer();
  });

  // ============================================
  // AGENDA & DISPONIBILITÉS
  // ============================================
  function initAgenda() {
    const prevBtn = document.getElementById('agenda-prev-week');
    const nextBtn = document.getElementById('agenda-next-week');
    const weekDisplay = document.getElementById('agenda-week-display');
    const timezoneSelect = document.getElementById('agenda-timezone');
    const slotBtns = document.querySelectorAll('.agenda-slot-btn');

    let currentWeek = 0; // Semaine actuelle (0 = cette semaine)

    // Fonction pour mettre à jour l'affichage de la semaine
    function updateWeekDisplay() {
      const today = new Date();
      const startOfWeek = new Date(today);
      startOfWeek.setDate(today.getDate() - today.getDay() + 3 + (currentWeek * 7));
      const endOfWeek = new Date(startOfWeek);
      endOfWeek.setDate(startOfWeek.getDate() + 6);

      const options = { day: 'numeric', month: 'short' };
      const startStr = startOfWeek.toLocaleDateString('fr-FR', options);
      const endStr = endOfWeek.toLocaleDateString('fr-FR', options);
      
      if (weekDisplay) {
        weekDisplay.textContent = `${startStr} – ${endStr} ${endOfWeek.getFullYear()}`;
      }
    }

    // Navigation semaine précédente
    if (prevBtn) {
      prevBtn.addEventListener('click', function() {
        currentWeek--;
        updateWeekDisplay();
      });
    }

    // Navigation semaine suivante
    if (nextBtn) {
      nextBtn.addEventListener('click', function() {
        currentWeek++;
        updateWeekDisplay();
      });
    }

    // Changement de fuseau horaire
    if (timezoneSelect) {
      timezoneSelect.addEventListener('change', function() {
        // Logique pour mettre à jour les heures selon le fuseau
        console.log('Fuseau horaire changé:', this.value);
      });
    }

    // Sélection d'un créneau
    slotBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        // Désélectionner les autres
        slotBtns.forEach(b => b.classList.remove('selected'));
        // Sélectionner celui-ci
        this.classList.add('selected');
        
        // Ouvrir le flux de réservation
        const day = this.dataset.day;
        const hour = this.dataset.hour;
        openBookingFlow(day, hour);
      });
    });

    // Initialiser l'affichage
    updateWeekDisplay();
  }

  function openBookingFlow(day, hour) {
    // Rediriger vers le formulaire de contact avec les paramètres
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
      contactForm.scrollIntoView({ behavior: 'smooth' });
      // Pré-remplir avec le créneau sélectionné
      const messageField = contactForm.querySelector('textarea[name="message"]');
      if (messageField) {
        messageField.value = `Créneau sélectionné : Jour ${day}, ${hour}h\n\n`;
      }
    } else {
      // Fallback : rediriger vers la page de contact
      window.location.href = '#contact-form';
    }
  }

  // ============================================
  // À PROPOS - TOGGLE VOIR PLUS/MOINS
  // ============================================
  function initAboutToggle() {
    const aboutText = document.getElementById('about-text');
    const aboutToggle = document.getElementById('about-toggle');

    if (!aboutText || !aboutToggle) return;

    // Vérifier si le texte est long
    if (aboutText.scrollHeight > 300) {
      aboutText.classList.add('collapsed');
      aboutToggle.style.display = 'block';
    } else {
      aboutToggle.style.display = 'none';
    }

    aboutToggle.addEventListener('click', function() {
      if (aboutText.classList.contains('collapsed')) {
        aboutText.classList.remove('collapsed');
        this.textContent = 'Voir moins';
      } else {
        aboutText.classList.add('collapsed');
        this.textContent = 'Voir plus';
      }
    });
  }

  // ============================================
  // SPÉCIALISATIONS - ACCORDÉONS
  // ============================================
  function initSpecializations() {
    const specializationToggles = document.querySelectorAll('.specialization-toggle');

    specializationToggles.forEach(toggle => {
      toggle.addEventListener('click', function() {
        const item = this.closest('.specialization-item');
        const isActive = item.classList.contains('active');

        // Fermer tous les autres
        document.querySelectorAll('.specialization-item').forEach(i => {
          i.classList.remove('active');
        });

        // Ouvrir/fermer celui-ci
        if (!isActive) {
          item.classList.add('active');
        }
      });
    });
  }

  // ============================================
  // CV TABS
  // ============================================
  function initCVTabs() {
    const tabBtns = document.querySelectorAll('.cv-tab-btn');
    const tabPanes = document.querySelectorAll('.cv-tab-pane');

    tabBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const targetTab = this.dataset.tab;

        // Mettre à jour les boutons
        tabBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        // Mettre à jour les panneaux
        tabPanes.forEach(pane => {
          pane.classList.remove('active');
          if (pane.id === `cv-${targetTab}`) {
            pane.classList.add('active');
          }
        });
      });
    });
  }

  // ============================================
  // VIDÉO MODAL
  // ============================================
  function initVideoModal() {
    const playBtns = document.querySelectorAll('.freelancer-profile-play-btn');

    playBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const videoUrl = this.dataset.videoUrl;
        if (videoUrl) {
          // Ouvrir la vidéo en modal ou dans un nouvel onglet
          if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
            // Convertir en URL embed si nécessaire
            let embedUrl = videoUrl;
            if (videoUrl.includes('youtu.be')) {
              const videoId = videoUrl.split('/').pop().split('?')[0];
              embedUrl = `https://www.youtube.com/embed/${videoId}`;
            } else if (videoUrl.includes('watch?v=')) {
              const videoId = videoUrl.split('v=')[1].split('&')[0];
              embedUrl = `https://www.youtube.com/embed/${videoId}`;
            }
            openVideoModal(embedUrl);
          } else {
            // Autre type de vidéo
            window.open(videoUrl, '_blank');
          }
        }
      });
    });
  }

  function openVideoModal(videoUrl) {
    // Créer une modal simple
    const modal = document.createElement('div');
    modal.className = 'video-modal-overlay';
    modal.innerHTML = `
      <div class="video-modal-content">
        <button class="video-modal-close">&times;</button>
        <iframe src="${videoUrl}" frameborder="0" allowfullscreen></iframe>
      </div>
    `;

    // Styles inline pour la modal
    modal.style.cssText = `
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.9);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10000;
    `;

    const content = modal.querySelector('.video-modal-content');
    content.style.cssText = `
      position: relative;
      width: 90%;
      max-width: 900px;
      aspect-ratio: 16/9;
    `;

    const iframe = modal.querySelector('iframe');
    iframe.style.cssText = `
      width: 100%;
      height: 100%;
      border-radius: 12px;
    `;

    const closeBtn = modal.querySelector('.video-modal-close');
    closeBtn.style.cssText = `
      position: absolute;
      top: -40px;
      right: 0;
      background: none;
      border: none;
      color: white;
      font-size: 32px;
      cursor: pointer;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
    `;

    closeBtn.addEventListener('click', () => {
      document.body.removeChild(modal);
      document.body.style.overflow = '';
    });

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        document.body.removeChild(modal);
        document.body.style.overflow = '';
      }
    });

    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';
  }

  // ============================================
  // PARTAGER LE PROFIL
  // ============================================
  function initShareProfile() {
    const shareBtn = document.getElementById('share-profile-btn');
    if (!shareBtn) return;

    shareBtn.addEventListener('click', function() {
      if (navigator.share) {
        // API Web Share
        navigator.share({
          title: document.title,
          url: window.location.href
        }).catch(err => console.log('Erreur partage:', err));
      } else {
        // Fallback : copier le lien
        navigator.clipboard.writeText(window.location.href).then(() => {
          alert('Lien copié dans le presse-papiers !');
        }).catch(err => {
          // Fallback manuel
          const input = document.createElement('input');
          input.value = window.location.href;
          document.body.appendChild(input);
          input.select();
          document.execCommand('copy');
          document.body.removeChild(input);
          alert('Lien copié dans le presse-papiers !');
        });
      }
    });
  }

  // ============================================
  // SAUVEGARDER LE FREELANCE
  // ============================================
  function initSaveFreelancer() {
    const saveBtn = document.getElementById('save-freelancer-btn');
    if (!saveBtn) return;

    saveBtn.addEventListener('click', function() {
      // Vérifier si l'utilisateur est connecté (vérifier la présence d'un token CSRF)
      const csrfToken = document.querySelector('meta[name="csrf-token"]');
      if (!csrfToken) {
        // Rediriger vers la connexion
        window.location.href = '/login';
        return;
      }

      // Récupérer l'ID du seller depuis l'URL ou un data attribute
      const sellerId = document.querySelector('[data-seller-id]')?.dataset.sellerId;
      if (!sellerId) return;

      // Appel AJAX pour sauvegarder (follow)
      const followUrl = `/follow-seller/?user_id=${window.userId || ''}&type=user&following_id=${sellerId}`;
      
      fetch(followUrl, {
        method: 'GET',
        headers: {
          'X-CSRF-TOKEN': csrfToken.content
        }
      }).then(response => {
        if (response.ok || response.redirected) {
          this.textContent = 'Sauvegardé';
          this.style.background = 'var(--junspro-primary)';
          this.style.color = 'white';
        }
      }).catch(err => {
        console.error('Erreur sauvegarde:', err);
      });
    });
  }

})();

