/**
 * Company Recommend Modal - Alpine.js Component
 * Gère l'ouverture/fermeture et la soumission du formulaire de recommandation entreprise
 */
function companyRecommendModal() {
  return {
    isOpen: false,
    loading: false,
    form: {
      company_name: '',
      company_email: '',
      message: ''
    },

    init() {
      // Écouter les événements d'ouverture depuis l'extérieur
      window.addEventListener('openCompanyRecommendModal', () => {
        this.open();
      });
    },

    open() {
      this.isOpen = true;
      // Lock body scroll
      document.body.style.overflow = 'hidden';
      // Reset form
      this.form = {
        company_name: '',
        company_email: '',
        message: ''
      };
      // Focus trap
      this.trapFocus();
    },

    close() {
      this.isOpen = false;
      // Unlock body scroll
      document.body.style.overflow = '';
      this.loading = false;
    },

    async submit() {
      this.loading = true;

      try {
        const response = await fetch('/api/referral/recommend-company', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify(this.form)
        });

        const data = await response.json();

        if (data.ok) {
          // Afficher un toast de succès (vous pouvez utiliser votre système de toast)
          this.showToast(data.message || 'Votre recommandation a été envoyée avec succès.');
          this.close();
        } else {
          this.showToast(data.message || 'Une erreur est survenue. Veuillez réessayer.');
        }
      } catch (error) {
        console.error('Erreur lors de l\'envoi:', error);
        this.showToast('Une erreur est survenue. Veuillez réessayer.');
      } finally {
        this.loading = false;
      }
    },

    showToast(message) {
      // Créer un toast simple (vous pouvez utiliser votre système de toast existant)
      const toast = document.createElement('div');
      toast.className = 'referral-toast';
      toast.textContent = message;
      toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #10b981;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 10000;
        animation: slideIn 0.3s ease-out;
      `;
      document.body.appendChild(toast);

      setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(() => toast.remove(), 300);
      }, 3000);
    },

    trapFocus() {
      // Focus trap simple
      const modal = document.querySelector('.referral-modal-container');
      if (modal) {
        const firstFocusable = modal.querySelector('input, textarea, button');
        if (firstFocusable) {
          setTimeout(() => firstFocusable.focus(), 100);
        }
      }
    }
  };
}

