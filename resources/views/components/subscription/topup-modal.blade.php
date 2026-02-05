<div 
  x-data="topupModal()" 
  x-show="isOpen" 
  x-cloak
  @keydown.escape.window="close()"
  class="topup-modal-overlay"
  style="display: none;"
>
  <!-- Backdrop -->
  <div 
    class="topup-modal-backdrop"
    @click="close()"
  ></div>

  <!-- Modal -->
  <div 
    class="topup-modal-container"
    @click.stop
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
  >
    <!-- Header -->
    <div class="topup-modal-header">
      <button 
        type="button"
        @click="close()"
        class="topup-modal-close"
        aria-label="{{ __('Fermer') }}"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <div class="topup-modal-avatar-wrapper">
        <img 
          x-bind:src="avatarUrl || '{{ asset('assets/img/noimage.jpg') }}'"
          x-bind:alt="tutorName"
          class="topup-modal-avatar"
          onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
        >
        <div class="topup-modal-avatar-initials" style="display: none;">
          <span x-text="getInitials(tutorName)"></span>
        </div>
      </div>
      
      <h2 class="topup-modal-title">
        {{ __('Suivez des Rituels supplémentaires avec') }} <span x-text="tutorName"></span>
      </h2>
    </div>

    <!-- Body -->
    <div class="topup-modal-body">
      <!-- Micro-phrase signature Rituel -->
      <p class="topup-ritual-signature" x-show="ritualSignature" style="font-size: 0.75rem; color: #6b7280; margin: 0 0 0.75rem 0;" x-text="ritualSignature"></p>
      <!-- Affichage quota (en Rituels) -->
      <div class="topup-quota-info" x-show="!loadingQuota">
        <span x-show="!isQuotaReached">
          <i class="fas fa-info-circle"></i>
          <span>
            {{ __('Il vous reste') }} <strong x-text="quota.remaining"></strong> {{ __('Rituels') }} {{ __('sur') }} <strong x-text="quota.max"></strong> {{ __('Rituels') }}
            <span x-show="quota.window_end">
              ({{ __('jusqu\'au') }} <span x-text="formatDate(quota.window_end)"></span>)
            </span>
          </span>
        </span>
        <span x-show="isQuotaReached" class="topup-quota-warning">
          <i class="fas fa-exclamation-triangle"></i>
          <span>
            {{ __('Quota atteint, réessayez le') }} <strong x-text="formatDate(quota.next_available_at)"></strong>
          </span>
        </span>
      </div>

      <!-- Stepper quantité (Rituels) -->
      <div class="topup-stepper" :class="{ 'topup-stepper-disabled': isQuotaReached }">
        <button 
          type="button"
          @click="decreaseQty()"
          :disabled="qty <= 1 || isQuotaReached"
          class="topup-stepper-btn"
        >
          <i class="fas fa-minus"></i>
        </button>
        
        <div class="topup-stepper-value">
          <span x-text="qty"></span> <span class="topup-stepper-unit">{{ __('Rituels') }}</span>
        </div>
        
        <button 
          type="button"
          @click="increaseQty()"
          :disabled="qty >= maxQty || isQuotaReached"
          class="topup-stepper-btn"
        >
          <i class="fas fa-plus"></i>
        </button>
      </div>

      <!-- Total -->
      <div class="topup-total">
        <strong>{{ __('Total') }} :</strong>
        <span class="topup-total-amount" x-text="formatPrice(total)"></span>
      </div>

      <!-- Bandeau info -->
      <div class="topup-info-banner" x-show="scheduleUntil && !isQuotaReached">
        <i class="fas fa-gift"></i>
        <span>
          {{ __('Bonne nouvelle ! Vous pouvez programmer ces Rituels jusqu\'au') }} 
          <strong x-text="scheduleUntil"></strong>.
        </span>
      </div>

      <!-- Message quota atteint avec upsell (message premium cycle) -->
      <div class="topup-quota-reached-banner" x-show="isQuotaReached">
        <i class="fas fa-info-circle"></i>
        <div>
          <strong>{{ __('Ce cycle atteint la limite de votre formule. Pour continuer, sélectionnez la formule supérieure.') }}</strong>
        </div>
      </div>

      <!-- Toggle upgrade -->
      <div class="topup-upgrade-section" x-show="upgradeDetails">
        <div class="topup-upgrade-header">
          <h3>{{ __('Passer aussi à la formule supérieure') }}</h3>
          <label class="topup-toggle">
            <input 
              type="checkbox"
              x-model="upgrade"
              @change="onUpgradeChange()"
            >
            <span class="topup-toggle-slider"></span>
          </label>
        </div>

        <!-- Détails upgrade (visible si toggle ON) -->
        <div class="topup-upgrade-details" x-show="upgrade && upgradeDetails" x-cloak>
          <ul>
            <li x-text="upgradeDetails"></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="topup-modal-footer">
      <button 
        type="button"
        @click="close()"
        class="topup-btn-secondary"
      >
        {{ __('Annuler') }}
      </button>
      <button 
        type="button"
        @click="submit()"
        :disabled="loading || isQuotaReached"
        class="topup-btn-primary"
      >
        <span x-show="!loading && !isQuotaReached">{{ __('Confirmer') }}</span>
        <span x-show="loading" class="topup-loading">
          <i class="fas fa-spinner fa-spin"></i> {{ __('Traitement...') }}
        </span>
        <span x-show="isQuotaReached && !loading">{{ __('Quota atteint') }}</span>
      </button>
    </div>
  </div>
</div>


