<!-- Étape 3 : Confirmez votre abonnement avec [Nom] -->
<div 
  x-data="transferReplaceStep3()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="goBack()"
  class="transfer-modal-overlay"
  style="display: none;"
>
  <div class="transfer-modal-backdrop" @click="goBack()"></div>
  
  <div 
    class="transfer-modal-container transfer-confirm-container"
    @click.stop
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0"
  >
    <!-- Header -->
    <div class="transfer-modal-header">
      <button 
        type="button"
        @click="goBack()"
        class="transfer-modal-back"
        aria-label="{{ __('Retour') }}"
      >
        <i class="fas fa-arrow-left"></i>
      </button>
      <button 
        type="button"
        @click="close()"
        class="transfer-modal-close"
        aria-label="{{ __('Fermer') }}"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <!-- Photos : Ancien freelance → Flèche → Nouveau freelance -->
      <div class="transfer-confirm-avatars">
        <div class="transfer-confirm-avatar">
          <img 
            x-bind:src="currentTutorAvatar || '{{ asset('assets/img/noimage.jpg') }}'"
            x-bind:alt="currentTutorName"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="transfer-confirm-avatar-initials" style="display: none;">
            <span x-text="getInitials(currentTutorName)"></span>
          </div>
        </div>
        <div class="transfer-confirm-arrow">
          <i class="fas fa-arrow-right"></i>
        </div>
        <div class="transfer-confirm-avatar">
          <img 
            x-bind:src="selectedFreelance?.avatar || '{{ asset('assets/img/noimage.jpg') }}'"
            x-bind:alt="selectedFreelance?.name"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="transfer-confirm-avatar-initials" style="display: none;">
            <span x-text="getInitials(selectedFreelance?.name)"></span>
          </div>
        </div>
      </div>
      
      <h2 class="transfer-modal-title">
        {{ __('Confirmez votre abonnement avec') }} <span x-text="selectedFreelance?.name"></span>.
      </h2>
    </div>

    <!-- Body avec les 4 points d'information -->
    <div class="transfer-modal-body">
      <div class="transfer-confirm-info-list">
        <!-- Point 1 : Annulation -->
        <div class="transfer-confirm-info-item">
          <div class="transfer-confirm-info-icon">
            <i class="fas fa-ban"></i>
          </div>
          <div class="transfer-confirm-info-content">
            <p>{{ __('Votre abonnement avec') }} <span x-text="currentTutorName"></span> {{ __('sera annulé et vous ne serez plus facturé.') }}</p>
            <button 
              type="button"
              @click="showThanksModal = true"
              class="transfer-thanks-btn"
            >
              {{ __('Envoyer vos remerciements') }}
            </button>
          </div>
        </div>

        <!-- Point 2 : Solde utilisé -->
        <div class="transfer-confirm-info-item">
          <div class="transfer-confirm-info-icon">
            <i class="fas fa-exchange-alt"></i>
          </div>
          <div class="transfer-confirm-info-content">
            <p>{{ __('Votre solde avec') }} <span x-text="currentTutorName"></span> (<span x-text="formatPrice(creditAmount)"></span>) {{ __('sera utilisé pour régler votre abonnement avec') }} <span x-text="selectedFreelance?.name"></span>.</p>
          </div>
        </div>

        <!-- Point 3 : Rituel commence -->
        <div class="transfer-confirm-info-item">
          <div class="transfer-confirm-info-icon">
            <i class="fas fa-play-circle"></i>
          </div>
          <div class="transfer-confirm-info-content">
            <p>{{ __('Votre abonnement de') }} <span x-text="selectedPlan?.sessions_per_week"></span> <span x-text="selectedPlan?.sessions_per_week === 1 ? 'Rituel' : 'Rituels'"></span> {{ __('/ semaine') }} (<span x-text="selectedPlan?.total_sessions"></span> {{ __('Rituels') }} / x 4 semaines) {{ __('commence aujourd\'hui.') }}</p>
          </div>
        </div>

        <!-- Point 4 : Crédit restant -->
        <div class="transfer-confirm-info-item" x-show="remainingCredit > 0">
          <div class="transfer-confirm-info-icon">
            <i class="fas fa-wallet"></i>
          </div>
          <div class="transfer-confirm-info-content">
            <p>{{ __('La somme de') }} <span x-text="formatPrice(remainingCredit)"></span> {{ __('qu\'il vous reste sera ajoutée à vos crédits Junspro. Elle apparaîtra lors de votre prochain paiement.') }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer avec bouton de paiement -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="proceedToPayment()"
        class="transfer-payment-btn"
        :disabled="processing"
      >
        <span x-show="!processing">{{ __('Passer au paiement') }}</span>
        <span x-show="processing">{{ __('Traitement...') }}</span>
      </button>
    </div>
  </div>

  <!-- Modal "Envoyer vos remerciements" -->
  <div 
    x-show="showThanksModal"
    class="transfer-modal-overlay"
    style="z-index: 10001;"
  >
    <div class="transfer-modal-backdrop" @click="showThanksModal = false"></div>
    <div 
      class="transfer-modal-container"
      style="max-width: 500px;"
      @click.stop
    >
      <div class="transfer-modal-header">
        <button 
          type="button"
          @click="showThanksModal = false"
          class="transfer-modal-close"
        >
          <i class="fas fa-times"></i>
        </button>
        <h2 class="transfer-modal-title">{{ __('Envoyer vos remerciements') }}</h2>
      </div>
      <div class="transfer-modal-body">
        <textarea 
          x-model="thanksMessage"
          class="transfer-thanks-textarea"
          placeholder="{{ __('Votre message de remerciement...') }}"
          rows="5"
        ></textarea>
        <button 
          type="button"
          @click="sendThanks()"
          class="transfer-thanks-send-btn"
          :disabled="sendingThanks"
        >
          <span x-show="!sendingThanks">{{ __('Envoyer') }}</span>
          <span x-show="sendingThanks">{{ __('Envoi...') }}</span>
        </button>
      </div>
    </div>
  </div>
</div>

<style>
  .transfer-confirm-container {
    max-width: 600px;
  }

  .transfer-confirm-avatars {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-bottom: 20px;
  }

  .transfer-confirm-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    border: 3px solid white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .transfer-confirm-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .transfer-confirm-avatar-initials {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 600;
  }

  .transfer-confirm-arrow {
    color: #6B7280;
    font-size: 24px;
  }

  .transfer-confirm-info-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .transfer-confirm-info-item {
    display: flex;
    gap: 16px;
    align-items: flex-start;
  }

  .transfer-confirm-info-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #F3F4F6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6B7280;
    font-size: 18px;
    flex-shrink: 0;
  }

  .transfer-confirm-info-content {
    flex: 1;
  }

  .transfer-confirm-info-content p {
    font-size: 14px;
    color: #6B7280;
    line-height: 1.6;
    margin: 0 0 8px 0;
  }

  .transfer-thanks-btn {
    padding: 8px 16px;
    background: #F3F4F6;
    border: 1px solid #E5E7EB;
    border-radius: 8px;
    color: #6B7280;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
  }

  .transfer-thanks-btn:hover {
    background: #E5E7EB;
    color: #111827;
  }

  .transfer-modal-footer {
    padding: 20px 24px;
    border-top: 1px solid #E5E7EB;
  }

  .transfer-payment-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .transfer-payment-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(124, 58, 237, 0.4);
  }

  .transfer-payment-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }

  .transfer-thanks-textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #E5E7EB;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
    margin-bottom: 16px;
  }

  .transfer-thanks-textarea:focus {
    outline: none;
    border-color: #7C3AED;
    box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
  }

  .transfer-thanks-send-btn {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
  }

  .transfer-thanks-send-btn:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .transfer-thanks-send-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
</style>

<script>
  function transferReplaceStep3() {
    return {
      isOpen: false,
      selectedFreelance: null,
      selectedPlan: null,
      subscriptionId: null,
      currentTutorName: '',
      currentTutorAvatar: '',
      credit: 0,
      creditAmount: 0,
      remainingCredit: 0,
      showThanksModal: false,
      thanksMessage: 'Merci pour tout votre travail et votre accompagnement. J\'ai beaucoup apprécié notre collaboration.',
      sendingThanks: false,
      processing: false,

      init() {
        window.addEventListener('openTransferReplaceStep3', (e) => {
          this.open(e.detail);
        });
      },

      open(payload) {
        this.selectedFreelance = payload.selectedFreelance;
        this.selectedPlan = payload.selectedPlan;
        this.subscriptionId = payload.subscriptionId;
        this.currentTutorName = payload.currentTutorName || '';
        this.currentTutorAvatar = payload.currentTutorAvatar || '';
        this.credit = payload.credit || 0;
        this.creditAmount = payload.creditAmount || 0;
        
        // Calculer le crédit restant
        const planPrice = this.selectedPlan?.price || 0;
        this.remainingCredit = Math.max(0, this.creditAmount - planPrice);
        
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
      },

      getInitials(name) {
        if (!name) return '?';
        const parts = name.trim().split(' ');
        if (parts.length >= 2) {
          return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
        }
        return name.substring(0, 2).toUpperCase();
      },

      formatPrice(price) {
        return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price);
      },

      async sendThanks() {
        if (!this.thanksMessage.trim()) return;
        
        this.sendingThanks = true;
        try {
          // TODO: Envoyer le message de remerciement au freelance
          // await fetch(`/account/subscriptions/${this.subscriptionId}/transfer/replace/thanks`, {
          //   method: 'POST',
          //   headers: {
          //     'Content-Type': 'application/json',
          //     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          //   },
          //   body: JSON.stringify({ message: this.thanksMessage })
          // });
          
          // Simuler l'envoi
          await new Promise(resolve => setTimeout(resolve, 500));
          
          this.showThanksModal = false;
          alert('Vos remerciements ont été envoyés.');
        } catch (error) {
          console.error('Erreur lors de l\'envoi des remerciements:', error);
          alert('Une erreur est survenue. Veuillez réessayer.');
        } finally {
          this.sendingThanks = false;
        }
      },

      async proceedToPayment() {
        this.processing = true;
        this.close();
        
        // Ouvrir l'étape 4 : Paiement
        window.dispatchEvent(new CustomEvent('openTransferReplaceStep4', {
          detail: {
            subscriptionId: this.subscriptionId,
            selectedFreelance: this.selectedFreelance,
            selectedPlan: this.selectedPlan,
            currentTutorName: this.currentTutorName,
            currentTutorAvatar: this.currentTutorAvatar,
            credit: this.credit,
            creditAmount: this.creditAmount,
            remainingCredit: this.remainingCredit
          }
        }));
      },

      goBack() {
        this.close();
        // Revenir à l'étape 2
        window.dispatchEvent(new CustomEvent('openTransferReplaceStep2', {
          detail: {
            subscriptionId: this.subscriptionId,
            selectedFreelance: this.selectedFreelance,
            currentTutorName: this.currentTutorName,
            currentTutorAvatar: this.currentTutorAvatar,
            credit: this.credit,
            creditAmount: this.creditAmount
          }
        }));
      },

      close() {
        this.isOpen = false;
        this.showThanksModal = false;
        document.body.style.overflow = '';
      }
    }
  }
</script>
