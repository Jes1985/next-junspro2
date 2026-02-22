<!-- Étape 3 : Combien de rituels souhaitez-vous suivre avec [Nom] ? -->
<div 
  x-data="transferActiveStep3()"
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
      
      <!-- Photos : Ancien freelance → Nouveau freelance -->
      <div class="transfer-confirm-avatars">
        <div class="transfer-confirm-avatar">
          <img 
            x-bind:src="currentTutorAvatar || '<?php echo e(asset('assets/img/noimage.jpg')); ?>'"
            x-bind:alt="currentTutorName"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="transfer-confirm-avatar-initials" style="display: none;">
            <span x-text="getInitials(currentTutorName)"></span>
          </div>
        </div>
        <div class="transfer-confirm-arrow">
          <i class="fas fa-arrow-right"></i>
        </div>
        <div class="transfer-confirm-avatar">
          <img 
            x-bind:src="selectedFreelance?.avatar || '<?php echo e(asset('assets/img/noimage.jpg')); ?>'"
            x-bind:alt="selectedFreelance?.name"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="transfer-confirm-avatar-initials" style="display: none;">
            <span x-text="getInitials(selectedFreelance?.name)"></span>
          </div>
        </div>
      </div>
      
      <h2 class="transfer-modal-title">
        <?php echo e(__('Combien de rituels souhaitez-vous suivre avec')); ?> <span x-text="selectedFreelance?.name"></span> ?
      </h2>
    </div>

    <!-- Body -->
    <div class="transfer-modal-body">
      <!-- Sélecteur quantité -->
      <div class="transfer-qty-selector">
        <button 
          type="button"
          @click="decrementQty()"
          class="transfer-qty-btn"
          :disabled="selectedQty <= 1"
        >
          <i class="fas fa-minus"></i>
        </button>
        
        <div class="transfer-qty-display">
          <div class="transfer-qty-value">
            <span x-text="selectedQty"></span> <span x-text="selectedQty === 1 ? '<?php echo e(__('rituel')); ?>' : '<?php echo e(__('rituels')); ?>'"></span>
          </div>
          <div class="transfer-qty-price">
            <span x-text="formatPrice(pricePerRituel)"></span> <?php echo e(__('par rituel')); ?>

          </div>
        </div>
        
        <button 
          type="button"
          @click="incrementQty()"
          class="transfer-qty-btn"
          :disabled="selectedQty >= maxQty"
        >
          <i class="fas fa-plus"></i>
        </button>
      </div>

      <!-- Bloc Solde -->
      <div class="transfer-balance-block">
        <div class="transfer-balance-header">
          <span><?php echo e(__('Solde :')); ?> <strong x-text="formatPrice(creditAmount)"></strong></span>
          <span x-text="formatPrice(usedAmount)"></span> <?php echo e(__('utilisé(s)')); ?>

        </div>
        
        <!-- Barre de progression -->
        <div class="transfer-balance-progress">
          <div 
            class="transfer-balance-progress-bar"
            :style="`width: ${progressPercentage}%`"
          ></div>
        </div>
        
        <a 
          href="#"
          @click.prevent="showDetailsModal = true"
          class="transfer-balance-link"
        >
          <?php echo e(__('Voir les détails')); ?>

        </a>
      </div>

      <!-- Modal détails -->
      <div 
        x-show="showDetailsModal"
        class="transfer-details-overlay"
        @click="showDetailsModal = false"
      >
        <div 
          class="transfer-details-modal"
          @click.stop
        >
          <div class="transfer-details-header">
            <h3><?php echo e(__('Détails du solde')); ?></h3>
            <button 
              type="button"
              @click="showDetailsModal = false"
              class="transfer-details-close"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="transfer-details-body">
            <div class="transfer-details-item">
              <span><?php echo e(__('Nombre de rituels :')); ?></span>
              <strong x-text="selectedQty"></strong>
            </div>
            <div class="transfer-details-item">
              <span><?php echo e(__('Prix / rituel :')); ?></span>
              <strong x-text="formatPrice(pricePerRituel)"></strong>
            </div>
            <div class="transfer-details-item">
              <span><?php echo e(__('Utilisé :')); ?></span>
              <strong x-text="formatPrice(usedAmount)"></strong>
            </div>
            <div class="transfer-details-item">
              <span><?php echo e(__('Restant :')); ?></span>
              <strong x-text="formatPrice(remainingAmount)"></strong>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer avec bouton CTA -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="continueToConfirm()"
        class="transfer-ritual-continue-btn"
        :disabled="selectedQty < 1"
      >
        <?php echo e(__('Continuer')); ?> <i class="fas fa-arrow-right"></i>
      </button>
    </div>
  </div>
</div>

<style>
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

  .transfer-confirm-avatars {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-bottom: 20px;
  }

  .transfer-confirm-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    border: 3px solid white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .transfer-confirm-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .transfer-confirm-avatar-initials {
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

  .transfer-confirm-arrow {
    color: #6B7280;
    font-size: 24px;
  }

  .transfer-ritual-continue-btn {
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
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .transfer-ritual-continue-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(124, 58, 237, 0.4);
  }

  .transfer-ritual-continue-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
</style>

<script>
  function transferActiveStep3() {
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
      maxQty: 0,
      showDetailsModal: false,

      init() {
        window.addEventListener('openTransferActiveStep3', (e) => {
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
        this.pricePerRituel = this.selectedFreelance?.price_per_ritual || 0;
        this.maxQty = Math.min(this.credit, this.creditAmount / this.pricePerRituel) || this.credit;
        this.selectedQty = 1;
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

      decrementQty() {
        if (this.selectedQty > 1) {
          this.selectedQty--;
        }
      },

      incrementQty() {
        if (this.selectedQty < this.maxQty) {
          this.selectedQty++;
        }
      },

      continueToConfirm() {
        if (this.selectedQty < 1) return;
        
        this.close();
        // Ouvrir l'étape 4 : Confirmation transfert
        window.dispatchEvent(new CustomEvent('openTransferActiveStep4', {
          detail: {
            subscriptionId: this.subscriptionId,
            selectedFreelance: this.selectedFreelance,
            selectedQty: this.selectedQty,
            currentTutorName: this.currentTutorName,
            currentTutorAvatar: this.currentTutorAvatar,
            credit: this.credit,
            creditAmount: this.creditAmount,
            pricePerRituel: this.pricePerRituel,
            usedAmount: this.usedAmount
          }
        }));
      },

      goBack() {
        this.close();
        // Revenir à l'étape 2
        window.dispatchEvent(new CustomEvent('openTransferActiveStep2', {
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
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription\transfer\active\step3-pick-qty.blade.php ENDPATH**/ ?>