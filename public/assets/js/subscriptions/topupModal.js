/**
 * Topup Modal - Alpine.js Component
 * Gère l'ouverture/fermeture et la logique de la modal d'ajout d'heures supplémentaires
 */
function topupModal() {
  return {
    isOpen: false,
    loading: false,
    loadingQuota: false,
    qty: 1,
    upgrade: false,
    subscriptionId: null,
    tutorName: '',
    avatarUrl: '',
    unitPrice: 0,
    scheduleUntil: '',
    postUrl: '',
    quotaUrl: '',
    csrf: '',
    upgradeDetails: '',
    ritualSignature: '',
    quota: {
      max: 12,
      used: 0,
      remaining: 12,
      window_end: null,
      next_available_at: null
    },

    init() {
      // Écouter les événements d'ouverture depuis l'extérieur
      window.addEventListener('openTopUpModal', (e) => {
        this.open(e.detail);
      });
    },

    async open(payload) {
      this.subscriptionId = payload.subscriptionId;
      this.tutorName = payload.tutorName || 'Freelance';
      this.avatarUrl = payload.avatarUrl || '';
      this.unitPrice = parseFloat(payload.unitPrice) || 0;
      this.scheduleUntil = payload.scheduleUntil || '';
      this.postUrl = payload.postUrl || '';
      this.quotaUrl = payload.quotaUrl || '';
      this.csrf = payload.csrf || '';
      this.upgradeDetails = payload.upgradeDetails || '';
      this.ritualSignature = payload.ritualSignature || '';
      this.qty = 1;
      this.upgrade = false;
      this.isOpen = true;
      
      // Lock body scroll
      document.body.classList.add('topup-modal-open');

      // Charger le quota
      await this.fetchQuota();
    },

    close() {
      this.isOpen = false;
      this.loading = false;
      
      // Unlock body scroll
      document.body.classList.remove('topup-modal-open');
    },

    async fetchQuota() {
      if (!this.quotaUrl) return;

      this.loadingQuota = true;
      try {
        const response = await fetch(this.quotaUrl, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        const data = await response.json();
        if (data.ok) {
          this.quota = {
            max: data.max || 12,
            used: data.used || 0,
            remaining: data.remaining || 0,
            window_end: data.window_end,
            next_available_at: data.next_available_at
          };
          if (data.ritual_signature) {
            this.ritualSignature = data.ritual_signature;
          }
          // Ajuster qty si nécessaire
          if (this.qty > this.quota.remaining) {
            this.qty = Math.max(1, this.quota.remaining);
          }
        }
      } catch (error) {
        console.error('Erreur lors du chargement du quota:', error);
      } finally {
        this.loadingQuota = false;
      }
    },

    increaseQty() {
      if (this.qty < this.quota.remaining) {
        this.qty += 1;
      }
    },

    decreaseQty() {
      if (this.qty > 1) {
        this.qty -= 1;
      }
    },

    get maxQty() {
      return this.quota.remaining;
    },

    get isQuotaReached() {
      return this.quota.remaining === 0;
    },

    get total() {
      return this.qty * this.unitPrice;
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
        // Formater en français : "04 janv. 2026"
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
    },

    onUpgradeChange() {
      // Logique supplémentaire si nécessaire lors du changement du toggle
    },

    async submit() {
      if (this.loading) return;

      this.loading = true;

      try {
        const formData = new FormData();
        formData.append('qty', this.qty);
        formData.append('upgrade', this.upgrade ? '1' : '0');
        formData.append('_token', this.csrf);

        const response = await fetch(this.postUrl, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        const data = await response.json();

        if (!response.ok) {
          // Gérer les erreurs de quota
          if (response.status === 422 && data.remaining !== undefined) {
            this.quota.remaining = data.remaining;
            this.quota.next_available_at = data.next_available_at;
            if (this.qty > this.quota.remaining) {
              this.qty = Math.max(1, this.quota.remaining);
            }
          }
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
        alert(error.message || 'Une erreur est survenue lors de l\'ajout des heures.');
        this.loading = false;
      }
    }
  };
}

// Exposer la fonction globale pour ouvrir la modal
window.openTopUpModal = function(payload) {
  window.dispatchEvent(new CustomEvent('openTopUpModal', { detail: payload }));
};

