<script>
  (function() {
    'use strict';

    class ClientUpcomingActionsMenu {
      constructor() {
        this.activeMenu = null;
        this.init();
      }

      init() {
        // Attacher les événements aux boutons triggers
        document.querySelectorAll('[data-action-trigger]').forEach(trigger => {
          trigger.addEventListener('click', (e) => this.handleTriggerClick(e));
        });

        // Fermer au clic sur overlay
        document.querySelectorAll('[data-action-overlay]').forEach(overlay => {
          overlay.addEventListener('click', () => this.closeMenu());
        });

        // Fermer avec ESC
        document.addEventListener('keydown', (e) => {
          if (e.key === 'Escape' && this.activeMenu) {
            this.closeMenu();
          }
        });

        // Gérer les actions du menu
        document.querySelectorAll('[data-action]').forEach(action => {
          action.addEventListener('click', (e) => this.handleActionClick(e));
        });

        // Fermer au scroll de la page
        window.addEventListener('scroll', () => {
          if (this.activeMenu) {
            this.closeMenu();
          }
        }, { passive: true });
      }

      handleTriggerClick(e) {
        e.stopPropagation();
        const trigger = e.currentTarget;
        const wrapper = trigger.closest('.client-upcoming-item-actions-wrapper');
        if (!wrapper) return;

        const menu = wrapper.querySelector('[data-action-menu]');
        const overlay = wrapper.querySelector('[data-action-overlay]');

        if (!menu) return;

        // Si le menu est déjà ouvert, le fermer
        if (this.activeMenu === menu) {
          this.closeMenu();
          return;
        }

        // Fermer le menu précédent s'il existe
        if (this.activeMenu) {
          this.closeMenu();
        }

        // Ouvrir le nouveau menu
        this.openMenu(menu, overlay, trigger);
      }

      openMenu(menu, overlay, trigger) {
        // Calculer la position pour éviter le débordement
        const triggerRect = trigger.getBoundingClientRect();
        const viewportWidth = window.innerWidth;
        const menuWidth = 220; // min-width du menu
        const padding = 20; // padding depuis le bord de l'écran

        // Si le menu dépasse à droite, le positionner à gauche
        if (triggerRect.right + menuWidth > viewportWidth - padding) {
          menu.classList.add('position-left');
        } else {
          menu.classList.remove('position-left');
        }

        // Activer le menu et l'overlay
        menu.classList.add('active');
        if (overlay) overlay.classList.add('active');
        trigger.setAttribute('aria-expanded', 'true');

        this.activeMenu = menu;
        this.activeTrigger = trigger;
        this.activeOverlay = overlay;
      }

      closeMenu() {
        if (!this.activeMenu) return;

        this.activeMenu.classList.remove('active');
        if (this.activeOverlay) {
          this.activeOverlay.classList.remove('active');
        }
        if (this.activeTrigger) {
          this.activeTrigger.setAttribute('aria-expanded', 'false');
        }

        this.activeMenu = null;
        this.activeTrigger = null;
        this.activeOverlay = null;
      }

      handleActionClick(e) {
        const action = e.currentTarget;
        const actionType = action.getAttribute('data-action');

        switch (actionType) {
          case 'contact':
            // Lien direct, pas besoin de traitement
            this.closeMenu();
            break;

          case 'share':
            e.preventDefault();
            this.handleShare(action);
            break;

          case 'view-freelancer':
            // Lien direct, pas besoin de traitement
            this.closeMenu();
            break;

          case 'reschedule':
            e.preventDefault();
            this.handleReschedule(action);
            break;

          case 'cancel':
            e.preventDefault();
            this.handleCancel(action);
            break;

          default:
            this.closeMenu();
        }
      }

      handleShare(action) {
        const projectUrl = action.getAttribute('data-project-url');
        if (!projectUrl) {
          console.error('URL du projet non trouvée');
          return;
        }

        // Copier l'URL dans le presse-papiers
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(projectUrl).then(() => {
            this.showToast('Lien copié');
            this.closeMenu();
          }).catch(err => {
            console.error('Erreur lors de la copie:', err);
            this.showToast('Erreur lors de la copie', true);
          });
        } else {
          // Fallback pour les navigateurs plus anciens
          const textArea = document.createElement('textarea');
          textArea.value = projectUrl;
          textArea.style.position = 'fixed';
          textArea.style.opacity = '0';
          document.body.appendChild(textArea);
          textArea.select();
          try {
            document.execCommand('copy');
            this.showToast('Lien copié');
            this.closeMenu();
          } catch (err) {
            console.error('Erreur lors de la copie:', err);
            this.showToast('Erreur lors de la copie', true);
          }
          document.body.removeChild(textArea);
        }
      }

      handleReschedule(action) {
        const sessionId = action.getAttribute('data-session-id');
        if (!sessionId) {
          console.error('ID de session non trouvé');
          return;
        }

        // TODO: Implémenter l'ouverture du modal de reprogrammation
        this.showToast('Bientôt disponible');
        this.closeMenu();
      }

      handleCancel(action) {
        const sessionId = action.getAttribute('data-session-id');
        if (!sessionId) {
          console.error('ID de session non trouvé');
          return;
        }

        // Modal de confirmation
        const confirmed = confirm(
          'Êtes-vous sûr de vouloir annuler cette session ?\n\n' +
          'Cette action est irréversible.'
        );

        if (confirmed) {
          // TODO: Implémenter l'annulation via API
          this.showToast('Bientôt disponible');
        }

        this.closeMenu();
      }

      showToast(message, isError = false) {
        // Supprimer le toast existant s'il y en a un
        const existingToast = document.querySelector('.client-upcoming-actions-toast');
        if (existingToast) {
          existingToast.remove();
        }

        // Créer le nouveau toast
        const toast = document.createElement('div');
        toast.className = 'client-upcoming-actions-toast';
        if (isError) {
          toast.style.background = '#dc2626';
        }
        toast.textContent = message + (message === 'Lien copié' ? ' ✅' : '');

        document.body.appendChild(toast);

        // Afficher le toast
        setTimeout(() => {
          toast.classList.add('show');
        }, 10);

        // Masquer et supprimer le toast après 3 secondes
        setTimeout(() => {
          toast.classList.remove('show');
          setTimeout(() => {
            if (toast.parentNode) {
              toast.parentNode.removeChild(toast);
            }
          }, 300);
        }, 3000);
      }
    }

    // Initialiser quand le DOM est prêt
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => {
        new ClientUpcomingActionsMenu();
      });
    } else {
      new ClientUpcomingActionsMenu();
    }
  })();
</script>

