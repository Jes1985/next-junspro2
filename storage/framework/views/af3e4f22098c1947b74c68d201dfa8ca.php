<!-- Modal Downgrade Picker: Choix formule inférieure -->
<div 
  x-show="currentStep === 'downgrade-picker'"
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
        aria-label="<?php echo e(__('Retour')); ?>"
      >
        <i class="fas fa-arrow-left"></i>
      </button>
      <button 
        type="button"
        @click="close()"
        class="change-plan-modal-close"
        aria-label="<?php echo e(__('Fermer')); ?>"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <div class="change-plan-review-avatar-wrapper">
        <img 
          x-bind:src="avatarUrl || '<?php echo e(asset('assets/img/noimage.jpg')); ?>'"
          x-bind:alt="tutorName"
          class="change-plan-review-avatar"
          onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
        >
        <div class="change-plan-review-avatar-initials" style="display: none;">
          <span x-text="getInitials(tutorName)"></span>
        </div>
      </div>
      
      <h2 class="change-plan-modal-title">
        <?php echo e(__('Changez votre formule avec')); ?> <span x-text="tutorName"></span>
      </h2>
    </div>

    <div class="change-plan-modal-body">
      <!-- Formule actuelle -->
      <div class="change-plan-option-card current">
        <div class="change-plan-option-card-badge"><?php echo e(__('Formule actuelle')); ?></div>
        <div class="change-plan-option-card-content">
          <div class="change-plan-option-card-value" x-text="currentHours + 'h'"></div>
          <div class="change-plan-option-card-price" x-text="formatPrice(currentPrice)"></div>
          <div class="change-plan-option-card-period"><?php echo e(__('toutes les 4 semaines')); ?></div>
        </div>
      </div>

      <!-- Options disponibles (X-1 et X-2) -->
      <div class="change-plan-options-list">
        <button 
          type="button"
          @click="selectDowngradeOption(downgradeOptions[0])"
          class="change-plan-option-card"
          :class="{ 'selected': selectedDowngradeOption?.hours === downgradeOptions[0]?.hours }"
          x-show="downgradeOptions.length > 0"
        >
          <div class="change-plan-option-card-content">
            <div class="change-plan-option-card-value" x-text="downgradeOptions[0]?.hours + 'h'"></div>
            <div class="change-plan-option-card-price" x-text="formatPrice(downgradeOptions[0]?.price)"></div>
            <div class="change-plan-option-card-period"><?php echo e(__('toutes les 4 semaines')); ?></div>
          </div>
        </button>

        <button 
          type="button"
          @click="selectDowngradeOption(downgradeOptions[1])"
          class="change-plan-option-card"
          :class="{ 'selected': selectedDowngradeOption?.hours === downgradeOptions[1]?.hours }"
          x-show="downgradeOptions.length > 1"
        >
          <div class="change-plan-option-card-content">
            <div class="change-plan-option-card-value" x-text="downgradeOptions[1]?.hours + 'h'"></div>
            <div class="change-plan-option-card-price" x-text="formatPrice(downgradeOptions[1]?.price)"></div>
            <div class="change-plan-option-card-period"><?php echo e(__('toutes les 4 semaines')); ?></div>
          </div>
        </button>
      </div>

      <!-- Bonus business Preply -->
      <div class="change-plan-downgrade-note">
        <i class="fas fa-info-circle"></i>
        <span><?php echo e(__('Vous pourrez repasser à une formule supérieure à tout moment.')); ?></span>
      </div>
    </div>

    <div class="change-plan-modal-footer">
      <button 
        type="button"
        @click="goToDowngradeConfirm()"
        :disabled="!selectedDowngradeOption"
        class="change-plan-btn-primary"
      >
        <?php echo e(__('Continuer')); ?>

      </button>
    </div>
  </div>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription\change-plan-downgrade-picker.blade.php ENDPATH**/ ?>