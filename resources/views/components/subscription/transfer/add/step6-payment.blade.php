<!-- Étape 6 : Paiement -->
<div 
  x-data="transferAddStep6()"
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
        <div class="transfer-payment-invoice-item" x-show="usedAmount > 0">
          <span>{{ __('Solde utilisé') }}</span>
          <span class="transfer-payment-discount">-<span x-text="formatPrice(usedAmount)"></span></span>
        </div>
        <div class="transfer-payment-invoice-total">
          <span>{{ __('Total à payer') }}</span>
          <span x-text="formatPrice(amountToPay)"></span>
        </div>
      </div>

      <!-- Informations importantes -->
      <div class="transfer-payment-info">
        <p>{{ __('Vous pouvez changer gratuitement de freelance ou annuler votre abonnement à tout moment') }}</p>
        <p>{{ __('Renouvellement automatique toutes les 4 semaines') }}</p>
      </div>

      <!-- Mode de paiement -->
      <div class="transfer-payment-methods" x-show="amountToPay > 0">
        <h4>{{ __('Mode de paiement') }}</h4>
        
        <!-- Carte enregistrée -->
        <div x-show="hasSavedCard" class="transfer-payment-method-card">
          <div class="transfer-payment-method-icon">
            <i class="fas fa-credit-card"></i>
          </div>
          <div class="transfer-payment-method-info">
            <div class="transfer-payment-method-name">Visa **** 0936</div>
            <div class="transfer-payment-method-details">Carte enregistrée</div>
          </div>
          <button 
            type="button"
            class="transfer-payment-method-edit"
            @click="showCardForm = !showCardForm"
          >
            {{ __('Modifier') }}
          </button>
        </div>

        <!-- Autres modes de paiement -->
        <div class="transfer-payment-method-card">
          <div class="transfer-payment-method-icon">
            <i class="fas fa-plus-circle"></i>
          </div>
          <div class="transfer-payment-method-info">
            <div class="transfer-payment-method-name">{{ __('Autres modes de paiement') }}</div>
            <div class="transfer-payment-method-details">{{ __('Carte bancaire ou PayPal') }}</div>
          </div>
        </div>

        <!-- Formulaire carte (si montant > 0) -->
        <div x-show="showCardForm && amountToPay > 0" class="transfer-payment-card-form">
          <div class="transfer-payment-form-group">
            <label>{{ __('Numéro de carte') }}</label>
            <input type="text" x-model="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
          </div>
          <div class="transfer-payment-form-row">
            <div class="transfer-payment-form-group">
              <label>{{ __('Date d\'expiration') }}</label>
              <input type="text" x-model="cardExpiry" placeholder="MM/AA" maxlength="5">
            </div>
            <div class="transfer-payment-form-group">
              <label>{{ __('CVV') }}</label>
              <input type="text" x-model="cardCvv" placeholder="123" maxlength="3">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer avec bouton de paiement -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="processPayment()"
        class="transfer-payment-btn"
        :disabled="processing || (amountToPay > 0 && !hasPaymentMethod)"
      >
        <span x-show="!processing">
          <span x-show="amountToPay === 0">{{ __('Confirmer') }}</span>
          <span x-show="amountToPay > 0">{{ __('Payer') }} <span x-text="formatPrice(amountToPay)"></span></span>
        </span>
        <span x-show="processing">{{ __('Traitement...') }}</span>
      </button>
    </div>
  </div>
</div>

<style>
  .transfer-payment-container {
    max-width: 600px;
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
    position: relative;
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
    padding: 24px;
  }

  .transfer-payment-invoice {
    background: #F9FAFB;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 24px;
  }

  .transfer-payment-invoice h4 {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 16px 0;
  }

  .transfer-payment-invoice-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    font-size: 14px;
    color: #6B7280;
    border-bottom: 1px solid #E5E7EB;
  }

  .transfer-payment-invoice-item:last-child {
    border-bottom: none;
  }

  .transfer-payment-discount {
    color: #10B981;
    font-weight: 600;
  }

  .transfer-payment-invoice-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0 0 0;
    margin-top: 16px;
    border-top: 2px solid #E5E7EB;
    font-size: 18px;
    font-weight: 600;
    color: #111827;
  }

  .transfer-payment-info {
    background: #F9FAFB;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 24px;
  }

  .transfer-payment-info p {
    font-size: 13px;
    color: #6B7280;
    line-height: 1.6;
    margin: 0 0 8px 0;
  }

  .transfer-payment-info p:last-child {
    margin-bottom: 0;
  }

  .transfer-payment-methods {
    margin-bottom: 24px;
  }

  .transfer-payment-methods h4 {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 16px 0;
  }

  .transfer-payment-method-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #F9FAFB;
    border: 2px solid #E5E7EB;
    border-radius: 12px;
    margin-bottom: 12px;
    cursor: pointer;
    transition: all 0.2s;
  }

  .transfer-payment-method-card:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
  }

  .transfer-payment-method-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #F3F4F6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6B7280;
    font-size: 20px;
  }

  .transfer-payment-method-info {
    flex: 1;
  }

  .transfer-payment-method-name {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 4px;
  }

  .transfer-payment-method-details {
    font-size: 14px;
    color: #6B7280;
  }

  .transfer-payment-method-edit {
    padding: 8px 16px;
    background: #7C3AED;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
  }

  .transfer-payment-method-edit:hover {
    background: #6D28D9;
  }

  .transfer-payment-card-form {
    background: #F9FAFB;
    border-radius: 12px;
    padding: 20px;
    margin-top: 12px;
  }

  .transfer-payment-form-group {
    margin-bottom: 16px;
  }

  .transfer-payment-form-group:last-child {
    margin-bottom: 0;
  }

  .transfer-payment-form-group label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: #111827;
    margin-bottom: 8px;
  }

  .transfer-payment-form-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #E5E7EB;
    border-radius: 8px;
    font-size: 14px;
    color: #111827;
    transition: border-color 0.2s;
  }

  .transfer-payment-form-group input:focus {
    outline: none;
    border-color: #7C3AED;
  }

  .transfer-payment-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
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
</style>

<script>
  function transferAddStep6() {
    return {
      isOpen: false,
      selectedFreelance: null,
      subscriptionId: null,
      selectedPlan: null,
      selectedQty: 0,
      usedAmount: 0,
      paymentData: null,
      processing: false,
      hasSavedCard: false,
      showCardForm: false,
      cardNumber: '',
      cardExpiry: '',
      cardCvv: '',

      init() {
        window.addEventListener('openTransferAddStep6', (e) => {
          this.open(e.detail);
        });
      },

      open(payload) {
        this.selectedFreelance = payload.selectedFreelance;
        this.subscriptionId = payload.subscriptionId;
        this.selectedPlan = payload.selectedPlan || null;
        this.selectedQty = payload.selectedQty || 0;
        this.usedAmount = payload.usedAmount || 0;
        this.paymentData = payload.paymentData || null;
        this.processing = false;
        this.showCardForm = false;
        this.hasSavedCard = this.paymentData?.has_saved_card || false;
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
      },

      get amountToPay() {
        if (!this.selectedPlan) return 0;
        return Math.max(0, this.selectedPlan.price - this.usedAmount);
      },

      get hasPaymentMethod() {
        if (this.amountToPay === 0) return true;
        if (this.hasSavedCard && !this.showCardForm) return true;
        if (this.showCardForm && this.cardNumber && this.cardExpiry && this.cardCvv) return true;
        return false;
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

      async processPayment() {
        if (this.processing) return;
        
        this.processing = true;
        
        try {
          const response = await fetch(`/account/subscriptions/${this.subscriptionId}/transfer/add/payment`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            body: JSON.stringify({
              payment_method: this.hasSavedCard && !this.showCardForm ? 'saved_card' : 'new_card',
              card_number: this.cardNumber,
              card_expiry: this.cardExpiry,
              card_cvv: this.cardCvv
            })
          });

          const data = await response.json();

          if (data.ok) {
            // Succès, recharger la page
            window.location.reload();
          } else {
            alert(data.message || '{{ __('Une erreur est survenue lors du paiement.') }}');
            this.processing = false;
          }
        } catch (error) {
          console.error('Erreur lors du paiement:', error);
          alert('{{ __('Une erreur est survenue lors du paiement.') }}');
          this.processing = false;
        }
      },

      goBack() {
        this.close();
        // Revenir à l'étape 5
        window.dispatchEvent(new CustomEvent('openTransferAddStep5', {
          detail: {
            subscriptionId: this.subscriptionId,
            selectedFreelance: this.selectedFreelance,
            selectedPlan: this.selectedPlan,
            selectedQty: this.selectedQty,
            usedAmount: this.usedAmount,
            currentTutorName: this.currentTutorName || '',
            currentTutorAvatar: this.currentTutorAvatar || '',
            credit: this.credit || 0,
            creditAmount: this.creditAmount || 0
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
