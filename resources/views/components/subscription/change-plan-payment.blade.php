<!-- Modal Payment: Paiement ou confirmation -->
<div 
  x-show="currentStep === 'payment'"
  x-cloak
  class="change-plan-modal-overlay"
  @keydown.escape.window="goBack()"
>
  <div class="change-plan-modal-backdrop" @click="goBack()"></div>
  
  <div 
    class="change-plan-modal-container"
    @click.stop
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0"
  >
    <div class="change-plan-modal-header">
      <button 
        type="button"
        @click="goBack()"
        class="change-plan-modal-back"
        aria-label="{{ __('Retour') }}"
      >
        <i class="fas fa-arrow-left"></i>
      </button>
      <button 
        type="button"
        @click="close()"
        class="change-plan-modal-close"
        aria-label="{{ __('Fermer') }}"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <h2 class="change-plan-modal-title">
        {{ __('Confirmez vos changements') }}
      </h2>
    </div>

    <div class="change-plan-modal-body">
      <!-- Récap -->
      <div class="change-plan-payment-recap">
        <div class="change-plan-payment-recap-item">
          <span>{{ __('Nouvelle formule') }} :</span>
          <strong x-text="selectedHours + 'h • ' + formatPrice(newPrice)"></strong>
        </div>
        <div class="change-plan-payment-recap-item" x-show="applyWhen === 'now'">
          <span>{{ __('Application') }} :</span>
          <strong>{{ __('Maintenant') }}</strong>
        </div>
        <div class="change-plan-payment-recap-item" x-show="applyWhen === 'next_cycle'">
          <span>{{ __('Application') }} :</span>
          <strong x-text="'À partir du ' + formatDate(nextBillingDate)"></strong>
        </div>
      </div>

      <!-- Carte enregistrée -->
      <div class="change-plan-payment-method" x-show="hasSavedCard">
        <div class="change-plan-payment-method-info">
          <i class="fas fa-credit-card"></i>
          <span x-text="savedCardInfo"></span>
        </div>
        <button 
          type="button"
          @click="showCardForm = true"
          class="change-plan-payment-change-btn"
        >
          {{ __('Changer') }}
        </button>
      </div>

      <!-- Formulaire carte (si pas de carte ou changement) -->
      <div class="change-plan-payment-form" x-show="!hasSavedCard || showCardForm">
        <div class="change-plan-payment-form-title">{{ __('Informations de paiement') }}</div>
        <!-- TODO: Intégrer Stripe Elements ou formulaire de paiement -->
        <div class="change-plan-payment-form-placeholder">
          {{ __('Formulaire de paiement Stripe à intégrer') }}
        </div>
      </div>
    </div>

    <div class="change-plan-modal-footer">
      <button 
        type="button"
        @click="submitChange()"
        :disabled="loading || (!hasSavedCard && !showCardForm)"
        class="change-plan-btn-primary"
      >
        <span x-show="!loading">{{ __('Confirmer') }}</span>
        <span x-show="loading" class="change-plan-loading">
          <i class="fas fa-spinner fa-spin"></i> {{ __('Traitement...') }}
        </span>
      </button>
    </div>
  </div>
</div>

