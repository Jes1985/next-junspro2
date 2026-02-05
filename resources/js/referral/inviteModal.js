/**
 * Invite Modal - Alpine.js Component
 * Gère l'ouverture/fermeture et la logique de la modal d'invitation
 */
function inviteModal() {
  return {
    isOpen: false,
    linkCopied: false,
    referralLink: '',

    init() {
      // Écouter les événements d'ouverture depuis l'extérieur
      window.addEventListener('openInviteModal', () => {
        this.open();
      });

      // Récupérer le lien depuis l'input
      const linkInput = document.getElementById('referral-link-input');
      if (linkInput) {
        this.referralLink = linkInput.value;
      }
    },

    open() {
      this.isOpen = true;
      // Lock body scroll
      document.body.style.overflow = 'hidden';
      // Focus trap
      this.trapFocus();
    },

    close() {
      this.isOpen = false;
      // Unlock body scroll
      document.body.style.overflow = '';
      this.linkCopied = false;
    },

    copyLink() {
      const linkInput = document.getElementById('referral-link-input');
      if (linkInput) {
        linkInput.select();
        linkInput.setSelectionRange(0, 99999); // Pour mobile
        
        try {
          navigator.clipboard.writeText(linkInput.value).then(() => {
            this.linkCopied = true;
            setTimeout(() => {
              this.linkCopied = false;
            }, 3000);
          });
        } catch (err) {
          // Fallback pour navigateurs plus anciens
          document.execCommand('copy');
          this.linkCopied = true;
          setTimeout(() => {
            this.linkCopied = false;
          }, 3000);
        }
      }
    },

    trapFocus() {
      // Focus trap simple - focus sur le premier élément focusable
      const modal = document.querySelector('.referral-modal-container');
      if (modal) {
        const firstFocusable = modal.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (firstFocusable) {
          setTimeout(() => firstFocusable.focus(), 100);
        }
      }
    }
  };
}

