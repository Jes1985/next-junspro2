/**
 * Change Plan Flow - Alpine.js State Machine
 * Gère le flow complet de changement de formule (upgrade/downgrade)
 */
function changePlanFlow() {
  return {
    isOpen: false,
    loading: false,
    currentStep: 'entry', // entry, upgrade-builder, upgrade-review, payment, downgrade-picker, downgrade-confirm
    
    // Données subscription
    subscriptionId: null,
    tutorName: '',
    avatarUrl: '',
    currentHours: 0,
    currentPrice: 0,
    unitPrice: 0,
    nextBillingDate: null,
    
    // Upgrade
    selectedHours: 0,
    minHours: 0,
    applyWhen: 'now', // now | next_cycle
    timingDescription: '',
    
    // Downgrade
    downgradeOptions: [],
    selectedDowngradeOption: null,
    downgradeSuccess: false,
    downgradeError: null,
    
    // Payment
    hasSavedCard: false,
    savedCardInfo: '',
    showCardForm: false,
    
    // URLs
    contextUrl: '',
    submitUrl: '',
    csrf: '',

    init() {
      // Écouter les événements d'ouverture depuis l'extérieur
      window.addEventListener('openChangePlanFlow', (e) => {
        this.open(e.detail);
      });
    },

    async open(payload) {
      this.subscriptionId = payload.subscriptionId;
      this.tutorName = payload.tutorName || 'Freelance';
      this.avatarUrl = payload.avatarUrl || '';
      this.currentHours = payload.currentHours || 0;
      this.currentPrice = parseFloat(payload.currentPrice) || 0;
      this.unitPrice = parseFloat(payload.unitPrice) || 0;
      this.nextBillingDate = payload.nextBillingDate || null;
      this.contextUrl = payload.contextUrl || '';
      this.submitUrl = payload.submitUrl || '';
      this.csrf = payload.csrf || '';
      
      this.isOpen = true;
      this.currentStep = 'entry';
      this.selectedHours = this.currentHours;
      // Calculer minHours comme la prochaine valeur autorisée supérieure
      const allowed = [1, 2, 4, 8, 12, 16, 20, 24];
      const nextAllowed = allowed.find(h => h > this.currentHours) || 24;
      this.minHours = nextAllowed;
      this.applyWhen = 'now';
      this.selectedDowngradeOption = null;
      this.showCardForm = false;
      this.downgradeSuccess = false;
      this.downgradeError = null;
      
      // Lock body scroll
      document.body.classList.add('change-plan-modal-open');
      
      // Charger le contexte
      await this.loadContext();
    },

    close() {
      this.isOpen = false;
      this.loading = false;
      this.currentStep = 'entry';
      this.downgradeSuccess = false;
      this.downgradeError = null;
      
      // Unlock body scroll
      document.body.classList.remove('change-plan-modal-open');
    },

    closeAndRefresh() {
      this.close();
      // Recharger la page après un court délai pour permettre la fermeture de la modal
      setTimeout(() => {
        window.location.reload();
      }, 300);
    },

    goBack() {
      const steps = ['entry', 'upgrade-builder', 'upgrade-review', 'payment', 'downgrade-picker', 'downgrade-confirm'];
      const currentIndex = steps.indexOf(this.currentStep);
      if (currentIndex > 0) {
        this.currentStep = steps[currentIndex - 1];
      } else {
        this.close();
      }
    },

    async loadContext() {
      if (!this.contextUrl) return;
      
      try {
        const response = await fetch(this.contextUrl, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        const data = await response.json();
        if (data.ok) {
          // Charger les options de downgrade
          this.downgradeOptions = data.downgrade_options || [];
          
          // Charger les infos de paiement
          this.hasSavedCard = data.has_saved_card || false;
          this.savedCardInfo = data.saved_card_info || '';
          
          // Calculer la description du timing
          this.updateTimingDescription();
        }
      } catch (error) {
        console.error('Erreur lors du chargement du contexte:', error);
      }
    },

    selectDirection(direction) {
      if (direction === 'upgrade') {
        this.currentStep = 'upgrade-builder';
        // Trouver la prochaine valeur autorisée supérieure à currentHours
        const allowed = [1, 2, 4, 8, 12, 16, 20, 24];
        const nextAllowed = allowed.find(h => h > this.currentHours) || 24;
        this.selectedHours = Math.min(nextAllowed, 24);
        this.minHours = nextAllowed;
      } else if (direction === 'downgrade') {
        this.currentStep = 'downgrade-picker';
      }
    },

    increaseHours() {
      if (this.selectedHours < 24) {
        // Trouver la prochaine valeur autorisée
        const allowed = [1, 2, 4, 8, 12, 16, 20, 24];
        const currentIndex = allowed.indexOf(this.selectedHours);
        if (currentIndex < allowed.length - 1) {
          this.selectedHours = allowed[currentIndex + 1];
        } else {
          this.selectedHours = 24;
        }
      }
    },

    decreaseHours() {
      // Trouver la valeur autorisée précédente
      const allowed = [1, 2, 4, 8, 12, 16, 20, 24];
      const currentIndex = allowed.indexOf(this.selectedHours);
      if (currentIndex > 0 && allowed[currentIndex - 1] >= this.minHours) {
        this.selectedHours = allowed[currentIndex - 1];
      }
    },

    get newPrice() {
      return this.selectedHours * this.unitPrice * 4; // 4 semaines
    },

    goToReview() {
      if (this.selectedHours > this.currentHours) {
        this.currentStep = 'upgrade-review';
        this.updateTimingDescription();
      }
    },

    updateTimingDescription() {
      if (this.applyWhen === 'next_cycle') {
        const priceDiff = this.newPrice - this.currentPrice;
        this.timingDescription = `Le coût total est de ${this.formatPrice(this.newPrice)}, dont ${this.formatPrice(Math.max(0, priceDiff))} de différence. Nous renouvellerons automatiquement votre formule en sélectionnant votre mode de paiement.`;
      }
    },

    goToPayment() {
      if (this.applyWhen) {
        this.currentStep = 'payment';
      }
    },

    selectDowngradeOption(option) {
      this.selectedDowngradeOption = option;
    },

    goToDowngradeConfirm() {
      if (this.selectedDowngradeOption) {
        this.currentStep = 'downgrade-confirm';
      }
    },

    async submitChange() {
      if (this.loading) return;

      this.loading = true;

      try {
        const formData = new FormData();
        formData.append('new_hours_per_week', this.selectedHours);
        formData.append('apply_when', this.applyWhen);
        formData.append('_token', this.csrf);

        const response = await fetch(this.submitUrl, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        const data = await response.json();

        if (!response.ok) {
          throw new Error(data.message || 'Une erreur est survenue');
        }

        if (data.ok) {
          // Redirection si fournie, sinon recharger la page
          if (data.redirect_url) {
            window.location.href = data.redirect_url;
          } else {
            window.location.reload();
          }
        }
      } catch (error) {
        console.error('Erreur lors de la soumission:', error);
        alert(error.message || 'Une erreur est survenue lors du changement de formule.');
        this.loading = false;
      }
    },

    async submitDowngrade() {
      if (this.loading || !this.selectedDowngradeOption) return;

      this.loading = true;
      this.downgradeError = null;
      this.downgradeSuccess = false;

      try {
        const formData = new FormData();
        formData.append('target_hours', this.selectedDowngradeOption.hours);
        formData.append('apply_when', 'next_cycle'); // Downgrade toujours au prochain cycle
        formData.append('_token', this.csrf);

        const response = await fetch(this.submitUrl, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        const data = await response.json();

        if (!response.ok) {
          throw new Error(data.message || 'Une erreur est survenue');
        }

        if (data.ok) {
          // Afficher le bloc de succès dans la modal
          this.downgradeSuccess = true;
          this.loading = false;
        }
      } catch (error) {
        console.error('Erreur lors de la soumission:', error);
        this.downgradeError = error.message || 'Une erreur est survenue lors du changement de formule.';
        this.loading = false;
      }
    },

    formatPrice(amount) {
      return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 2
      }).format(amount);
    },

    formatDate(dateString) {
      if (!dateString) return '';
      try {
        const date = new Date(dateString);
        const months = ['janv.', 'févr.', 'mars', 'avr.', 'mai', 'juin', 'juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.'];
        const day = String(date.getDate()).padStart(2, '0');
        const month = months[date.getMonth()];
        const year = date.getFullYear();
        return `${day} ${month} ${year}`;
      } catch (e) {
        return dateString;
      }
    },

    getInitials(name) {
      if (!name) return '?';
      const parts = name.trim().split(' ');
      if (parts.length >= 2) {
        return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
      }
      return name.substring(0, 2).toUpperCase();
    }
  };
}

// Exposer la fonction globale pour ouvrir le flow
window.openChangePlanFlow = function(payload) {
  window.dispatchEvent(new CustomEvent('openChangePlanFlow', { detail: payload }));
};

