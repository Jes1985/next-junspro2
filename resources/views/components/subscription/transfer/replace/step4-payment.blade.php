<!-- Étape 4 : Paiement -->
<div 
  x-data="transferReplaceStep4()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="goBack()"
  class="transfer-modal-overlay"
  style="display: none;"
>
  <div class="transfer-modal-backdrop" @click="goBack()"></div>
  
  <div 
    class="transfer-modal-container transfer-payment-container"
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
      
      <!-- Photo et caractéristiques du freelance -->
      <div class="transfer-payment-freelance-info">
        <div class="transfer-payment-avatar">
          <img 
            x-bind:src="selectedFreelance?.avatar || '{{ asset('assets/img/noimage.jpg') }}'"
            x-bind:alt="selectedFreelance?.name"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="transfer-payment-avatar-initials" style="display: none;">
            <span x-text="getInitials(selectedFreelance?.name)"></span>
          </div>
        </div>
        <div class="transfer-payment-freelance-details">
          <h3 x-text="selectedFreelance?.name"></h3>
          <p x-text="selectedFreelance?.specialization || 'Freelance'"></p>
        </div>
      </div>
    </div>

    <!-- Body -->
    <div class="transfer-modal-body transfer-payment-body">
      <!-- Détails de la facture -->
      <div class="transfer-payment-invoice">
        <h4>{{ __('Détails de la facture') }}</h4>
        <div class="transfer-payment-invoice-item">
          <span>{{ __('Formule') }}</span>
          <span><span x-text="selectedPlan?.sessions_per_week"></span> {{ __('rituels par semaine') }}</span>
        </div>
        <div class="transfer-payment-invoice-item">
          <span>{{ __('Total') }}</span>
          <span><span x-text="selectedPlan?.total_sessions"></span> {{ __('rituels') }}</span>
        </div>
        <div class="transfer-payment-invoice-item">
          <span>{{ __('Prix') }}</span>
          <span x-text="formatPrice(selectedPlan?.price)"></span>
        </div>
        <div class="transfer-payment-invoice-item" x-show="creditAmount > 0">
          <span>{{ __('Solde utilisé') }}</span>
          <span class="transfer-payment-discount">-<span x-text="formatPrice(Math.min(creditAmount, selectedPlan?.price))"></span></span>
        </div>
        <div class="transfer-payment-invoice-total">
          <span>{{ __('Total à payer') }}</span>
          <span x-text="formatPrice(Math.max(0, selectedPlan?.price - Math.min(creditAmount, selectedPlan?.price)))"></span>
        </div>
      </div>

      <!-- Informations importantes -->
      <div class="transfer-payment-info">
        <p>{{ __('Vous pouvez changer gratuitement de freelance ou annuler votre abonnement à tout moment') }}</p>
        <p>{{ __('Renouvellement automatique toutes les 4 semaines') }}</p>
        <p x-show="amountToPay > 0">{{ __('Nous prélèverons') }} <span x-text="formatPrice(amountToPay)"></span> {{ __('sur le mode de paiement enregistré pour ajouter') }} <span x-text="selectedPlan?.total_sessions"></span> {{ __('rituels toutes les 4 semaines, à moins que vous n\'annuliez votre abonnement') }}</p>
      </div>

      <!-- Mode de paiement -->
      <div class="transfer-payment-methods">
        <h4>{{ __('Mode de paiement') }}</h4>
        
        <!-- Crédit Junspro -->
        <button 
          type="button"
          @click="selectPaymentMethod('junspro_credit')"
          class="transfer-payment-method-card"
          :class="{ 'transfer-payment-method-selected': selectedPaymentMethod === 'junspro_credit' }"
        >
          <div class="transfer-payment-method-icon">
            <i class="fas fa-wallet"></i>
          </div>
          <div class="transfer-payment-method-content">
            <div class="transfer-payment-method-title">{{ __('Crédit Junspro') }}</div>
            <div class="transfer-payment-method-details" x-show="junsproCredit > 0">
              <span x-text="formatPrice(junsproCredit)"></span> {{ __('disponible') }}
            </div>
          </div>
          <div class="transfer-payment-method-check" x-show="selectedPaymentMethod === 'junspro_credit'">
            <i class="fas fa-check-circle"></i>
          </div>
        </button>

        <!-- Carte enregistrée -->
        <button 
          type="button"
          @click="selectPaymentMethod('saved_card')"
          class="transfer-payment-method-card"
          :class="{ 'transfer-payment-method-selected': selectedPaymentMethod === 'saved_card' }"
          x-show="hasSavedCard"
        >
          <div class="transfer-payment-method-icon">
            <i class="fas fa-credit-card"></i>
          </div>
          <div class="transfer-payment-method-content">
            <div class="transfer-payment-method-title">{{ __('Carte enregistrée') }}</div>
            <div class="transfer-payment-method-details">
              <span x-text="savedCardInfo"></span>
            </div>
          </div>
          <div class="transfer-payment-method-check" x-show="selectedPaymentMethod === 'saved_card'">
            <i class="fas fa-check-circle"></i>
          </div>
        </button>

        <!-- Autres modes de paiement -->
        <div class="transfer-payment-other-methods">
          <button 
            type="button"
            @click="showOtherMethods = !showOtherMethods"
            class="transfer-payment-other-toggle"
          >
            <div class="transfer-payment-method-icon">
              <i class="fas fa-plus"></i>
            </div>
            <div class="transfer-payment-method-content">
              <div class="transfer-payment-method-title">{{ __('Autre mode de paiement') }}</div>
            </div>
            <div class="transfer-payment-method-arrow">
              <i class="fas fa-chevron-down" :class="{ 'transfer-rotate-180': showOtherMethods }"></i>
            </div>
          </button>

          <!-- Options autres modes de paiement -->
          <div x-show="showOtherMethods" class="transfer-payment-other-options">
            <button 
              type="button"
              @click="selectPaymentMethod('new_card')"
              class="transfer-payment-other-option"
              :class="{ 'transfer-payment-method-selected': selectedPaymentMethod === 'new_card' }"
            >
              <i class="fas fa-credit-card"></i>
              <span>{{ __('Nouvelle carte bancaire') }}</span>
              <div class="transfer-payment-method-check" x-show="selectedPaymentMethod === 'new_card'">
                <i class="fas fa-check-circle"></i>
              </div>
            </button>
            <button 
              type="button"
              @click="selectPaymentMethod('paypal')"
              class="transfer-payment-other-option"
              :class="{ 'transfer-payment-method-selected': selectedPaymentMethod === 'paypal' }"
            >
              <i class="fab fa-paypal"></i>
              <span>PayPal</span>
              <div class="transfer-payment-method-check" x-show="selectedPaymentMethod === 'paypal'">
                <i class="fas fa-check-circle"></i>
              </div>
            </button>
          </div>
        </div>

        <!-- Formulaire nouvelle carte -->
        <div x-show="selectedPaymentMethod === 'new_card' && showOtherMethods" class="transfer-payment-card-form">
          <div class="transfer-payment-form-group">
            <label>{{ __('Numéro de carte') }}</label>
            <input 
              type="text"
              x-model="cardNumber"
              placeholder="1234 5678 9012 3456"
              maxlength="19"
              class="transfer-payment-input"
            >
          </div>
          <div class="transfer-payment-form-row">
            <div class="transfer-payment-form-group">
              <label>{{ __('Date d\'expiration') }}</label>
              <input 
                type="text"
                x-model="cardExpiry"
                placeholder="MM/AA"
                maxlength="5"
                class="transfer-payment-input"
              >
            </div>
            <div class="transfer-payment-form-group">
              <label>{{ __('CVV') }}</label>
              <input 
                type="text"
                x-model="cardCvv"
                placeholder="123"
                maxlength="4"
                class="transfer-payment-input"
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer avec bouton de validation -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="processPayment()"
        class="transfer-payment-btn"
        :disabled="processing || !canProcessPayment"
      >
        <span x-show="!processing">{{ __('Valider le paiement') }}</span>
        <span x-show="processing">{{ __('Traitement...') }}</span>
      </button>
    </div>
  </div>
</div>

<style>
  .transfer-payment-container {
    max-width: 600px;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
  }

  .transfer-payment-freelance-info {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
  }

  .transfer-payment-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    border: 3px solid white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .transfer-payment-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .transfer-payment-avatar-initials {
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

  .transfer-payment-freelance-details h3 {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 4px 0;
  }

  .transfer-payment-freelance-details p {
    font-size: 14px;
    color: #6B7280;
    margin: 0;
  }

  .transfer-payment-body {
    flex: 1;
    overflow-y: auto;
  }

  .transfer-payment-invoice {
    background: #F9FAFB;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 24px;
  }

  .transfer-payment-invoice h4 {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 16px 0;
  }

  .transfer-payment-invoice-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 14px;
    color: #6B7280;
  }

  .transfer-payment-discount {
    color: #10B981;
    font-weight: 600;
  }

  .transfer-payment-invoice-total {
    display: flex;
    justify-content: space-between;
    padding: 12px 0 0 0;
    margin-top: 12px;
    border-top: 2px solid #E5E7EB;
    font-size: 16px;
    font-weight: 600;
    color: #111827;
  }

  .transfer-payment-info {
    background: #FEF3C7;
    border: 1px solid #FCD34D;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 24px;
  }

  .transfer-payment-info p {
    font-size: 13px;
    color: #92400E;
    line-height: 1.6;
    margin: 0 0 8px 0;
  }

  .transfer-payment-info p:last-child {
    margin-bottom: 0;
  }

  .transfer-payment-methods h4 {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 16px 0;
  }

  .transfer-payment-method-card {
    display: flex;
    align-items: center;
    gap: 16px;
    width: 100%;
    padding: 16px;
    background: #F9FAFB;
    border: 2px solid #E5E7EB;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: left;
    margin-bottom: 12px;
  }

  .transfer-payment-method-card:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
  }

  .transfer-payment-method-selected {
    border-color: #7C3AED;
    background: #F3E8FF;
  }

  .transfer-payment-method-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    flex-shrink: 0;
  }

  .transfer-payment-method-content {
    flex: 1;
    min-width: 0;
  }

  .transfer-payment-method-title {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 4px;
  }

  .transfer-payment-method-details {
    font-size: 14px;
    color: #6B7280;
  }

  .transfer-payment-method-check {
    color: #7C3AED;
    font-size: 20px;
    flex-shrink: 0;
  }

  .transfer-payment-other-toggle {
    display: flex;
    align-items: center;
    gap: 16px;
    width: 100%;
    padding: 16px;
    background: #F9FAFB;
    border: 2px solid #E5E7EB;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: left;
    margin-bottom: 12px;
  }

  .transfer-payment-other-toggle:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
  }

  .transfer-payment-method-arrow {
    color: #9CA3AF;
    font-size: 18px;
    flex-shrink: 0;
    transition: transform 0.2s;
  }

  .transfer-rotate-180 {
    transform: rotate(180deg);
  }

  .transfer-payment-other-options {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 12px;
  }

  .transfer-payment-other-option {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    padding: 12px 16px;
    background: #F9FAFB;
    border: 2px solid #E5E7EB;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: left;
  }

  .transfer-payment-other-option:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
  }

  .transfer-payment-other-option.transfer-payment-method-selected {
    border-color: #7C3AED;
    background: #F3E8FF;
  }

  .transfer-payment-other-option i {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6B7280;
    font-size: 18px;
  }

  .transfer-payment-other-option span {
    flex: 1;
    font-size: 14px;
    font-weight: 500;
    color: #111827;
  }

  .transfer-payment-card-form {
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 12px;
  }

  .transfer-payment-form-group {
    margin-bottom: 16px;
  }

  .transfer-payment-form-group label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: #111827;
    margin-bottom: 8px;
  }

  .transfer-payment-input {
    width: 100%;
    padding: 12px;
    border: 1px solid #E5E7EB;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.2s;
  }

  .transfer-payment-input:focus {
    outline: none;
    border-color: #7C3AED;
    box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
  }

  .transfer-payment-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }
</style>

<script>
  function transferReplaceStep4() {
    return {
      isOpen: false,
      selectedFreelance: null,
      selectedPlan: null,
      subscriptionId: null,
      currentTutorName: '',
      creditAmount: 0,
      amountToPay: 0,
      selectedPaymentMethod: null,
      hasSavedCard: false,
      savedCardInfo: 'Carte Visa •••• 4242',
      junsproCredit: 0,
      showOtherMethods: false,
      cardNumber: '',
      cardExpiry: '',
      cardCvv: '',
      processing: false,

      init() {
        window.addEventListener('openTransferReplaceStep4', (e) => {
          this.open(e.detail);
        });
      },

      open(payload) {
        this.selectedFreelance = payload.selectedFreelance;
        this.selectedPlan = payload.selectedPlan;
        this.subscriptionId = payload.subscriptionId;
        this.currentTutorName = payload.currentTutorName || '';
        this.creditAmount = payload.creditAmount || 0;
        this.remainingCredit = payload.remainingCredit || 0;
        
        // Calculer le montant à payer
        const planPrice = this.selectedPlan?.price || 0;
        const creditUsed = Math.min(this.creditAmount, planPrice);
        this.amountToPay = Math.max(0, planPrice - creditUsed);
        
        // Vérifier si une carte est enregistrée (TODO: récupérer depuis Stripe)
        this.hasSavedCard = true; // Pour les tests
        
        // Sélectionner par défaut le crédit Junspro si disponible et suffisant
        if (this.amountToPay === 0) {
          this.selectedPaymentMethod = 'junspro_credit';
        } else if (this.hasSavedCard) {
          this.selectedPaymentMethod = 'saved_card';
        }
        
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

      selectPaymentMethod(method) {
        this.selectedPaymentMethod = method;
        if (method === 'new_card') {
          this.showOtherMethods = true;
        }
      },

      get canProcessPayment() {
        if (this.amountToPay === 0) {
          return this.selectedPaymentMethod === 'junspro_credit';
        }
        
        if (this.selectedPaymentMethod === 'new_card') {
          return this.cardNumber.length >= 16 && 
                 this.cardExpiry.length === 5 && 
                 this.cardCvv.length >= 3;
        }
        
        return this.selectedPaymentMethod !== null;
      },

      async processPayment() {
        if (!this.canProcessPayment || this.processing) return;
        
        this.processing = true;
        
        try {
          // TODO: Intégrer Stripe pour le paiement
          // Si nouvelle carte, créer un payment method Stripe
          // Si carte enregistrée, utiliser le payment method existant
          // Si crédit Junspro, déduire du crédit
          
          // Simuler le paiement
          await new Promise(resolve => setTimeout(resolve, 1500));
          
          // Rediriger vers la page de succès ou fermer la modal
          alert('Paiement effectué avec succès !');
          this.close();
          // Recharger la page pour voir les changements
          window.location.reload();
        } catch (error) {
          console.error('Erreur lors du paiement:', error);
          alert('Une erreur est survenue lors du paiement. Veuillez réessayer.');
        } finally {
          this.processing = false;
        }
      },

      goBack() {
        this.close();
        // Revenir à l'étape 3
        window.dispatchEvent(new CustomEvent('openTransferReplaceStep3', {
          detail: {
            subscriptionId: this.subscriptionId,
            selectedFreelance: this.selectedFreelance,
            selectedPlan: this.selectedPlan,
            currentTutorName: this.currentTutorName,
            currentTutorAvatar: '',
            credit: 0,
            creditAmount: this.creditAmount
          }
        }));
      },

      close() {
        this.isOpen = false;
        document.body.style.overflow = '';
      }
    }
  }
</script>
