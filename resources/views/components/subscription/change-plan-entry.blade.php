<!-- Modal Entry: Que souhaitez-vous faire ? -->
<div 
  x-show="currentStep === 'entry'"
  x-cloak
  class="change-plan-modal-overlay"
  @keydown.escape.window="close()"
>
  <div class="change-plan-modal-backdrop" @click="close()"></div>
  
  <div 
    class="change-plan-modal-container"
    @click.stop
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
  >
    <div class="change-plan-modal-header">
      <button 
        type="button"
        @click="close()"
        class="change-plan-modal-close"
        aria-label="{{ __('Fermer') }}"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <h2 class="change-plan-modal-title">
        {{ __('Que souhaitez-vous faire ?') }}
      </h2>
    </div>

    <div class="change-plan-modal-body">
      <!-- Option Upgrade -->
      <button 
        type="button"
        @click="selectDirection('upgrade')"
        class="change-plan-option-btn"
      >
        <div class="change-plan-option-icon upgrade">
          <i class="fas fa-arrow-up"></i>
        </div>
        <div class="change-plan-option-content">
          <div class="change-plan-option-title">{{ __('Passer à la formule supérieure') }}</div>
        </div>
        <div class="change-plan-option-arrow">
          <i class="fas fa-chevron-right"></i>
        </div>
      </button>

      <!-- Option Downgrade -->
      <button 
        type="button"
        @click="selectDirection('downgrade')"
        class="change-plan-option-btn"
      >
        <div class="change-plan-option-icon downgrade">
          <i class="fas fa-arrow-down"></i>
        </div>
        <div class="change-plan-option-content">
          <div class="change-plan-option-title">{{ __('Passer à la formule inférieure') }}</div>
        </div>
        <div class="change-plan-option-arrow">
          <i class="fas fa-chevron-right"></i>
        </div>
      </button>
    </div>
  </div>
</div>

