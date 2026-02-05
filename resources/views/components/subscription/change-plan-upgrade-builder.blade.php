<!-- Modal Upgrade Builder: Stepper Rituels -->
<div 
  x-show="currentStep === 'upgrade-builder'"
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
        {{ __('Créez la formule qui vous convient le mieux') }}
      </h2>
    </div>

    <div class="change-plan-modal-body">
      <!-- Formule actuelle -->
      <div class="change-plan-current-info">
        <span>{{ __('Formule actuelle') }} :</span>
        <strong x-text="currentHours + 'h • ' + formatPrice(currentPrice)"></strong>
        <span>{{ __('toutes les 4 semaines') }}</span>
      </div>

      <!-- Stepper Rituels -->
      <div class="change-plan-stepper">
        <button 
          type="button"
          @click="decreaseHours()"
          :disabled="selectedHours <= minHours"
          class="change-plan-stepper-btn"
        >
          <i class="fas fa-minus"></i>
        </button>
        
        <div class="change-plan-stepper-value">
          <span x-text="selectedHours"></span>
          <span class="change-plan-stepper-label">{{ __('h') }}</span>
        </div>
        
        <button 
          type="button"
          @click="increaseHours()"
          :disabled="selectedHours >= 24"
          class="change-plan-stepper-btn"
        >
          <i class="fas fa-plus"></i>
        </button>
      </div>

      <!-- Nouveau prix -->
      <div class="change-plan-new-price">
        <div class="change-plan-new-price-label">{{ __('Nouveau prix') }} :</div>
        <div class="change-plan-new-price-value" x-text="formatPrice(newPrice)"></div>
        <div class="change-plan-new-price-period">{{ __('toutes les 4 semaines') }}</div>
      </div>

      <!-- Disclaimer -->
      <div class="change-plan-disclaimer">
        {{ __('Les prix indiqués correspondent à nos Rituels standard de 50 minutes') }}
      </div>
    </div>

    <div class="change-plan-modal-footer">
      <button 
        type="button"
        @click="goToReview()"
        :disabled="selectedHours === currentHours"
        class="change-plan-btn-primary"
      >
        {{ __('Continuer') }}
      </button>
    </div>
  </div>
</div>

