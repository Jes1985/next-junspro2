<!-- Modal Downgrade Confirm: Confirmation -->
<div 
  x-show="currentStep === 'downgrade-confirm'"
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
      
      <div class="change-plan-review-avatar-wrapper">
        <img 
          x-bind:src="avatarUrl || '{{ asset('assets/img/noimage.jpg') }}'"
          x-bind:alt="tutorName"
          class="change-plan-review-avatar"
          onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
        >
        <div class="change-plan-review-avatar-initials" style="display: none;">
          <span x-text="getInitials(tutorName)"></span>
        </div>
      </div>
      
      <h2 class="change-plan-modal-title">
        {{ __('Confirmez vos changements') }}
      </h2>
    </div>

    <div class="change-plan-modal-body">
      <!-- Bloc de succès -->
      <div 
        x-show="downgradeSuccess"
        x-cloak
        class="change-plan-success-block"
      >
        <div class="change-plan-success-icon">
          <i class="fas fa-check-circle"></i>
        </div>
        <div class="change-plan-success-content">
          <div class="change-plan-success-title">{{ __('C\'est fait !') }}</div>
          <div class="change-plan-success-message">
            {{ __('Application le') }} <strong x-text="formatDate(nextBillingDate)"></strong>.
          </div>
        </div>
      </div>

      <!-- Contenu normal (masqué en cas de succès) -->
      <div x-show="!downgradeSuccess">
        <!-- Comparaison formules -->
        <div class="change-plan-comparison">
          <div class="change-plan-comparison-item">
            <div class="change-plan-comparison-value" x-text="currentHours + 'h'"></div>
            <div class="change-plan-comparison-price" x-text="formatPrice(currentPrice)"></div>
            <div class="change-plan-comparison-period">{{ __('toutes les 4 semaines') }}</div>
          </div>
          
          <div class="change-plan-comparison-arrow">
            <i class="fas fa-arrow-down"></i>
          </div>
          
          <div class="change-plan-comparison-item new">
            <div class="change-plan-comparison-value" x-text="selectedDowngradeOption?.hours + 'h'"></div>
            <div class="change-plan-comparison-price" x-text="formatPrice(selectedDowngradeOption?.price)"></div>
            <div class="change-plan-comparison-period">{{ __('toutes les 4 semaines') }}</div>
          </div>
        </div>

        <!-- Info heures restantes -->
        <div class="change-plan-hours-info">
          <i class="fas fa-wallet"></i>
          <div>
            <strong>{{ __('Vous conserverez vos Rituels restants.') }}</strong>
            <span>{{ __('Programmez-les avant le') }} <strong x-text="formatDate(nextBillingDate)"></strong>.</span>
          </div>
        </div>
      </div>

      <!-- Message d'erreur inline -->
      <div 
        x-show="downgradeError"
        x-cloak
        class="change-plan-error-message"
      >
        <i class="fas fa-exclamation-circle"></i>
        <span x-text="downgradeError"></span>
      </div>
    </div>

    <div class="change-plan-modal-footer">
      <!-- Bouton de succès -->
      <button 
        x-show="downgradeSuccess"
        x-cloak
        type="button"
        @click="closeAndRefresh()"
        class="change-plan-btn-primary"
      >
        {{ __('Fermer') }}
      </button>

      <!-- Bouton de confirmation normal -->
      <button 
        x-show="!downgradeSuccess"
        type="button"
        @click="submitDowngrade()"
        :disabled="loading"
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

