<!-- Modal Upgrade Review: Récap + choix timing -->
<div 
  x-show="currentStep === 'upgrade-review'"
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
        <?php echo e(__('Très bon choix ! Passez en revue votre nouvelle formule avec')); ?> <span x-text="tutorName"></span>
      </h2>
    </div>

    <div class="change-plan-modal-body">
      <!-- Comparaison formules -->
      <div class="change-plan-comparison">
        <div class="change-plan-comparison-item">
          <div class="change-plan-comparison-value" x-text="currentHours + 'h'"></div>
          <div class="change-plan-comparison-price" x-text="formatPrice(currentPrice)"></div>
          <div class="change-plan-comparison-period"><?php echo e(__('toutes les 4 semaines')); ?></div>
        </div>
        
        <div class="change-plan-comparison-arrow">
          <i class="fas fa-arrow-down"></i>
        </div>
        
        <div class="change-plan-comparison-item new">
          <div class="change-plan-comparison-value" x-text="selectedHours + 'h'"></div>
          <div class="change-plan-comparison-price" x-text="formatPrice(newPrice)"></div>
          <div class="change-plan-comparison-period"><?php echo e(__('toutes les 4 semaines')); ?></div>
        </div>
      </div>

      <!-- Choix timing -->
      <div class="change-plan-timing-section">
        <h3 class="change-plan-timing-title"><?php echo e(__('Quand voulez-vous appliquer ce changement ?')); ?></h3>

        <!-- Option Maintenant -->
        <label class="change-plan-timing-option" :class="{ 'selected': applyWhen === 'now' }">
          <input 
            type="radio"
            name="apply_when"
            value="now"
            x-model="applyWhen"
            class="change-plan-timing-radio"
          >
          <div class="change-plan-timing-content">
            <div class="change-plan-timing-icon">
              <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="change-plan-timing-text">
              <div class="change-plan-timing-title-option"><?php echo e(__('Maintenant')); ?></div>
              <div class="change-plan-timing-description">
                <?php echo e(__('Activez votre nouvelle formule et effectuez le paiement dès aujourd\'hui. Pensez à programmer tous les Rituels restants de votre formule actuelle avant le')); ?> 
                <strong x-text="formatDate(nextBillingDate)"></strong>.
              </div>
            </div>
          </div>
        </label>

        <!-- Option Prochaine facturation -->
        <label class="change-plan-timing-option" :class="{ 'selected': applyWhen === 'next_cycle' }">
          <input 
            type="radio"
            name="apply_when"
            value="next_cycle"
            x-model="applyWhen"
            class="change-plan-timing-radio"
          >
          <div class="change-plan-timing-content">
            <div class="change-plan-timing-icon">
              <i class="fas fa-credit-card"></i>
            </div>
            <div class="change-plan-timing-text">
              <div class="change-plan-timing-title-option">
                <?php echo e(__('À la prochaine date de facturation, le')); ?> <span x-text="formatDate(nextBillingDate)"></span>
              </div>
              <div class="change-plan-timing-description" x-show="applyWhen === 'next_cycle'">
                <span x-text="timingDescription"></span>
              </div>
            </div>
          </div>
        </label>
      </div>
    </div>

    <div class="change-plan-modal-footer">
      <button 
        type="button"
        @click="goToPayment()"
        :disabled="!applyWhen"
        class="change-plan-btn-primary"
      >
        <?php echo e(__('Continuer')); ?>

      </button>
    </div>
  </div>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription\change-plan-upgrade-review.blade.php ENDPATH**/ ?>