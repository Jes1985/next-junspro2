<!-- Étape 3 : Pour transférer des rituels, abonnez-vous à [Nom] -->
<div 
  x-data="transferAddStep3()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="goBack()"
  class="transfer-modal-overlay"
  style="display: none;"
>
  <div class="transfer-modal-backdrop" @click="goBack()"></div>
  
  <div 
    class="transfer-modal-container"
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
        aria-label="<?php echo e(__('Retour')); ?>"
      >
        <i class="fas fa-arrow-left"></i>
      </button>
      <button 
        type="button"
        @click="close()"
        class="transfer-modal-close"
        aria-label="<?php echo e(__('Fermer')); ?>"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <h2 class="transfer-modal-title">
        <?php echo e(__('Pour transférer des rituels, abonnez-vous à')); ?> <span x-text="selectedFreelance?.name"></span>
      </h2>
      
      <!-- Texte rassurant -->
      <p class="transfer-subtitle-reassurance">
        <?php echo e(__('Votre premier paiement interviendra dans 4 semaines. Vous pouvez résilier à tout moment.')); ?>

      </p>
    </div>

    <!-- Body -->
    <div class="transfer-modal-body">
      <!-- Cartes de plans -->
      <div class="transfer-plan-cards">
        <!-- Plan 1 rituel par semaine -->
        <button 
          type="button"
          @click="selectPlan(1)"
          class="transfer-plan-card"
          :class="{ 'transfer-plan-card-selected': selectedPlanValue === 1 }"
        >
          <div class="transfer-plan-title">1 <?php echo e(__('Rituel')); ?> <?php echo e(__('par semaine')); ?></div>
          <div class="transfer-plan-details">
            <span x-text="1 * 4"></span> <?php echo e(__('Rituels')); ?> · <span x-text="formatPrice(pricePerRituel * 4)"></span> <?php echo e(__('toutes les 4 semaines')); ?>

          </div>
        </button>

        <!-- Plan 2 rituels par semaine -->
        <button 
          type="button"
          @click="selectPlan(2)"
          class="transfer-plan-card"
          :class="{ 'transfer-plan-card-selected': selectedPlanValue === 2 }"
        >
          <div class="transfer-plan-title">2 <?php echo e(__('Rituels')); ?> <?php echo e(__('par semaine')); ?></div>
          <div class="transfer-plan-details">
            <span x-text="2 * 4"></span> <?php echo e(__('Rituels')); ?> · <span x-text="formatPrice(pricePerRituel * 8)"></span> <?php echo e(__('toutes les 4 semaines')); ?>

          </div>
        </button>

        <!-- Plan 3 rituels par semaine (Populaire) -->
        <button 
          type="button"
          @click="selectPlan(3)"
          class="transfer-plan-card transfer-plan-popular"
          :class="{ 'transfer-plan-card-selected': selectedPlanValue === 3 }"
        >
          <div class="transfer-plan-badge"><?php echo e(__('Populaire')); ?></div>
          <div class="transfer-plan-title">3 <?php echo e(__('Rituels')); ?> <?php echo e(__('par semaine')); ?></div>
          <div class="transfer-plan-details">
            <span x-text="3 * 4"></span> <?php echo e(__('Rituels')); ?> · <span x-text="formatPrice(pricePerRituel * 12)"></span> <?php echo e(__('toutes les 4 semaines')); ?>

          </div>
        </button>
      </div>

      <!-- Lien Voir plus d'options -->
      <button 
        type="button"
        @click="showExtendedPlans = !showExtendedPlans"
        class="transfer-more-options-btn"
      >
        <?php echo e(__('Voir plus d\'options')); ?>

        <i class="fas" :class="showExtendedPlans ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
      </button>

      <!-- Plans étendus (si showExtendedPlans) -->
      <div x-show="showExtendedPlans" class="transfer-plan-cards-extended">
        <button 
          type="button"
          @click="selectPlan(4)"
          class="transfer-plan-card"
          :class="{ 'transfer-plan-card-selected': selectedPlanValue === 4 }"
        >
          <div class="transfer-plan-title">4 <?php echo e(__('Rituels')); ?> <?php echo e(__('par semaine')); ?></div>
          <div class="transfer-plan-details">
            <span x-text="4 * 4"></span> <?php echo e(__('Rituels')); ?> · <span x-text="formatPrice(pricePerRituel * 16)"></span> <?php echo e(__('toutes les 4 semaines')); ?>

          </div>
        </button>

        <button 
          type="button"
          @click="selectPlan(6)"
          class="transfer-plan-card"
          :class="{ 'transfer-plan-card-selected': selectedPlanValue === 6 }"
        >
          <div class="transfer-plan-title">6 <?php echo e(__('Rituels')); ?> <?php echo e(__('par semaine')); ?></div>
          <div class="transfer-plan-details">
            <span x-text="6 * 4"></span> <?php echo e(__('Rituels')); ?> · <span x-text="formatPrice(pricePerRituel * 24)"></span> <?php echo e(__('toutes les 4 semaines')); ?>

          </div>
        </button>

        <button 
          type="button"
          @click="selectPlan(8)"
          class="transfer-plan-card"
          :class="{ 'transfer-plan-card-selected': selectedPlanValue === 8 }"
        >
          <div class="transfer-plan-title">8 <?php echo e(__('Rituels')); ?> <?php echo e(__('par semaine')); ?></div>
          <div class="transfer-plan-details">
            <span x-text="8 * 4"></span> <?php echo e(__('Rituels')); ?> · <span x-text="formatPrice(pricePerRituel * 32)"></span> <?php echo e(__('toutes les 4 semaines')); ?>

          </div>
        </button>

        <button 
          type="button"
          @click="selectPlan(10)"
          class="transfer-plan-card"
          :class="{ 'transfer-plan-card-selected': selectedPlanValue === 10 }"
        >
          <div class="transfer-plan-title">10 <?php echo e(__('Rituels')); ?> <?php echo e(__('par semaine')); ?></div>
          <div class="transfer-plan-details">
            <span x-text="10 * 4"></span> <?php echo e(__('Rituels')); ?> · <span x-text="formatPrice(pricePerRituel * 40)"></span> <?php echo e(__('toutes les 4 semaines')); ?>

          </div>
        </button>
      </div>

      <!-- Note sur les prix -->
      <p class="transfer-price-disclaimer">
        <?php echo e(__('Les prix indiqués correspondent à nos Rituels standard de 50 minutes')); ?>

      </p>
    </div>

    <!-- Footer avec bouton CTA -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="continueToRitual()"
        class="transfer-ritual-continue-btn"
        :disabled="!selectedPlanValue"
      >
        <?php echo e(__('Continuer')); ?> <i class="fas fa-arrow-right"></i>
      </button>
    </div>
  </div>
</div>

<style>
  .transfer-subtitle-reassurance {
    font-size: 14px;
    color: #6B7280;
    text-align: center;
    margin: 12px 0 24px 0;
    line-height: 1.6;
  }

  .transfer-plan-cards {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 16px;
  }

  .transfer-plan-card {
    position: relative;
    width: 100%;
    padding: 20px;
    background: #F9FAFB;
    border: 2px solid #E5E7EB;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: left;
  }

  .transfer-plan-card:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .transfer-plan-card-selected {
    border-color: #7C3AED;
    background: #F3E8FF;
  }

  .transfer-plan-popular {
    border-color: #10B981;
  }

  .transfer-plan-popular.transfer-plan-card-selected {
    background: #ECFDF5;
    border-color: #7C3AED;
  }

  .transfer-plan-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 4px 12px;
    background: #10B981;
    color: white;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
  }

  .transfer-plan-title {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 8px;
  }

  .transfer-plan-details {
    font-size: 14px;
    color: #6B7280;
    line-height: 1.5;
  }

  .transfer-more-options-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px;
    background: transparent;
    border: none;
    color: #7C3AED;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: 16px;
  }

  .transfer-more-options-btn:hover {
    color: #6D28D9;
    text-decoration: underline;
  }

  .transfer-plan-cards-extended {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 16px;
  }

  .transfer-price-disclaimer {
    font-size: 12px;
    color: #6B7280;
    text-align: center;
    line-height: 1.5;
    margin: 16px 0 0 0;
  }

  .transfer-qty-selector {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 32px;
    padding: 40px 20px;
    margin-bottom: 24px;
  }

  .transfer-qty-btn {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: #F9FAFB;
    border: 2px solid #E5E7EB;
    color: #6B7280;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .transfer-qty-btn:hover:not(:disabled) {
    background: #F3F4F6;
    border-color: #D1D5DB;
    color: #111827;
  }

  .transfer-qty-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .transfer-qty-display {
    text-align: center;
    min-width: 200px;
  }

  .transfer-qty-value {
    font-size: 48px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 8px;
    line-height: 1;
  }

  .transfer-qty-price {
    font-size: 16px;
    color: #6B7280;
  }

  .transfer-balance-block {
    background: #F9FAFB;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 24px;
  }

  .transfer-balance-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 14px;
    color: #6B7280;
  }

  .transfer-balance-header strong {
    color: #111827;
    font-weight: 600;
  }

  .transfer-balance-progress {
    width: 100%;
    height: 8px;
    background: #E5E7EB;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 12px;
  }

  .transfer-balance-progress-bar {
    height: 100%;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    transition: width 0.3s ease-out;
    border-radius: 4px;
  }

  .transfer-balance-link {
    font-size: 14px;
    color: #7C3AED;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
  }

  .transfer-balance-link:hover {
    color: #6D28D9;
    text-decoration: underline;
  }

  .transfer-details-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 10001;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .transfer-details-modal {
    background: white;
    border-radius: 16px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  }

  .transfer-details-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid #E5E7EB;
  }

  .transfer-details-header h3 {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin: 0;
  }

  .transfer-details-close {
    width: 32px;
    height: 32px;
    border: none;
    background: transparent;
    color: #6B7280;
    cursor: pointer;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }

  .transfer-details-close:hover {
    background: #F3F4F6;
    color: #111827;
  }

  .transfer-details-body {
    padding: 20px 24px;
  }

  .transfer-details-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    font-size: 14px;
    color: #6B7280;
    border-bottom: 1px solid #F3F4F6;
  }

  .transfer-details-item:last-child {
    border-bottom: none;
  }

  .transfer-details-item strong {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
  }
</style>

<script>
  function transferAddStep3() {
    return {
      isOpen: false,
      selectedFreelance: null,
      subscriptionId: null,
      currentTutorName: '',
      currentTutorAvatar: '',
      credit: 0,
      creditAmount: 0,
      pricePerRituel: 0,
      selectedQty: 1,
      selectedPlanValue: null,
      showExtendedPlans: false,
      showDetailsModal: false,

      init() {
        window.addEventListener('openTransferAddStep3', (e) => {
          this.open(e.detail);
        });
      },

      open(payload) {
        this.selectedFreelance = payload.selectedFreelance;
        this.subscriptionId = payload.subscriptionId;
        this.currentTutorName = payload.currentTutorName || '';
        this.currentTutorAvatar = payload.currentTutorAvatar || '';
        this.credit = payload.credit || 0;
        this.creditAmount = payload.creditAmount || 0;
        this.pricePerRituel = this.selectedFreelance?.price_per_session || 0;
        this.selectedQty = 1;
        this.selectedPlanValue = null;
        this.showExtendedPlans = false;
        this.showDetailsModal = false;
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

      get usedAmount() {
        return this.selectedQty * this.pricePerRituel;
      },

      get remainingAmount() {
        return Math.max(0, this.creditAmount - this.usedAmount);
      },

      get progressPercentage() {
        if (this.creditAmount === 0) return 0;
        return Math.min(100, (this.usedAmount / this.creditAmount) * 100);
      },


      selectPlan(value) {
        this.selectedPlanValue = value;
        // Calculer selectedQty basé sur le plan (pour la compatibilité avec l'étape 4)
        this.selectedQty = value * 4; // Total de rituels pour 4 semaines
      },

      continueToRitual() {
        if (!this.selectedPlanValue) return;
        
        // Calculer selectedQty et usedAmount basés sur le plan sélectionné
        const totalRituels = this.selectedPlanValue * 4;
        const totalPrice = this.pricePerRituel * totalRituels;
        
        this.close();
        // Ouvrir l'étape 4 : Choix du Rituel via SLIDER
        window.dispatchEvent(new CustomEvent('openTransferAddStep4', {
          detail: {
            subscriptionId: this.subscriptionId,
            selectedFreelance: this.selectedFreelance,
            selectedQty: totalRituels,
            currentTutorName: this.currentTutorName,
            currentTutorAvatar: this.currentTutorAvatar,
            credit: this.credit,
            creditAmount: this.creditAmount,
            pricePerRituel: this.pricePerRituel,
            usedAmount: Math.min(totalPrice, this.creditAmount)
          }
        }));
      },

      goBack() {
        this.close();
        // Revenir à l'étape 2
        window.dispatchEvent(new CustomEvent('openTransferAddStep2', {
          detail: {
            subscriptionId: this.subscriptionId,
            currentTutorName: this.currentTutorName,
            currentTutorAvatar: this.currentTutorAvatar,
            credit: this.credit,
            creditAmount: this.creditAmount
          }
        }));
      },

      close() {
        this.isOpen = false;
        this.showDetailsModal = false;
        document.body.style.overflow = '';
      }
    }
  }
</script>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription\transfer\add\step3-pick-qty.blade.php ENDPATH**/ ?>