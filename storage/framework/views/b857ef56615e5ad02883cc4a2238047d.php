<!-- Étape 4 : Confirmez le transfert -->
<div 
  x-data="transferActiveStep4()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="goBack()"
  class="transfer-modal-overlay"
  style="display: none;"
>
  <div class="transfer-modal-backdrop" @click="goBack()"></div>
  
  <div 
    class="transfer-modal-container transfer-confirm-container"
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
        <?php echo e(__('Confirmez le transfert')); ?>

      </h2>
    </div>

    <!-- Body -->
    <div class="transfer-modal-body">
      <!-- Résumé montants -->
      <div class="transfer-confirm-summary">
        <div class="transfer-confirm-summary-item">
          <span><?php echo e(__('Solde avec')); ?> <span x-text="currentTutorName"></span> :</span>
          <strong x-text="formatPrice(creditAmount)"></strong>
        </div>
        <div class="transfer-confirm-summary-item">
          <span><span x-text="selectedQty"></span> <span x-text="selectedQty === 1 ? '<?php echo e(__('rituel')); ?>' : '<?php echo e(__('rituels')); ?>'"></span> <?php echo e(__('avec')); ?> <span x-text="selectedFreelance?.name"></span> :</span>
          <strong x-text="formatPrice(usedAmount)"></strong>
        </div>
        <div class="transfer-confirm-summary-item" x-show="remainingAmount > 0">
          <span><?php echo e(__('Solde restant avec')); ?> <span x-text="currentTutorName"></span> :</span>
          <strong x-text="formatPrice(remainingAmount)"></strong>
        </div>
      </div>

      <!-- Section "Et ensuite ?" -->
      <div class="transfer-confirm-next">
        <h3 class="transfer-confirm-next-title"><?php echo e(__('Et ensuite ?')); ?></h3>
        <ul class="transfer-confirm-next-list">
          <li>
            <span><?php echo e(__('Vous recevrez')); ?> <strong x-text="selectedQty"></strong> <span x-text="selectedQty === 1 ? '<?php echo e(__('rituel')); ?>' : '<?php echo e(__('rituels')); ?>'"></span> (<strong x-text="formatPrice(usedAmount)"></strong>) <?php echo e(__('avec')); ?> <span x-text="selectedFreelance?.name"></span>.</span>
          </li>
        </ul>
      </div>
    </div>

    <!-- Footer avec bouton CTA -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="confirmTransfer()"
        class="transfer-confirm-btn"
        :disabled="processing"
      >
        <span x-show="!processing"><?php echo e(__('Confirmer le transfert')); ?></span>
        <span x-show="processing"><?php echo e(__('Traitement...')); ?></span>
      </button>
    </div>
  </div>
</div>

<style>
  .transfer-confirm-container {
    max-width: 600px;
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

  .transfer-confirm-summary {
    background: #F9FAFB;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 24px;
  }

  .transfer-confirm-summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    font-size: 14px;
    color: #6B7280;
    border-bottom: 1px solid #E5E7EB;
  }

  .transfer-confirm-summary-item:last-child {
    border-bottom: none;
  }

  .transfer-confirm-summary-item strong {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
  }

  .transfer-confirm-next {
    background: #F9FAFB;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 24px;
  }

  .transfer-confirm-next-title {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 16px 0;
  }

  .transfer-confirm-next-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .transfer-confirm-next-list li {
    font-size: 14px;
    color: #6B7280;
    line-height: 1.6;
    padding-left: 24px;
    position: relative;
  }

  .transfer-confirm-next-list li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: #7C3AED;
    font-weight: 600;
    font-size: 18px;
  }

  .transfer-confirm-next-list li strong {
    color: #111827;
    font-weight: 600;
  }

  .transfer-confirm-btn {
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

  .transfer-confirm-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(124, 58, 237, 0.4);
  }

  .transfer-confirm-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
</style>

<script>
  function transferActiveStep4() {
    return {
      isOpen: false,
      selectedFreelance: null,
      subscriptionId: null,
      currentTutorName: '',
      currentTutorAvatar: '',
      credit: 0,
      creditAmount: 0,
      selectedQty: 0,
      usedAmount: 0,
      processing: false,

      init() {
        window.addEventListener('openTransferActiveStep4', (e) => {
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
        this.selectedQty = payload.selectedQty || 0;
        this.usedAmount = payload.usedAmount || 0;
        this.processing = false;
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
      },

      get remainingAmount() {
        return Math.max(0, this.creditAmount - this.usedAmount);
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

      async confirmTransfer() {
        if (this.processing) return;
        
        this.processing = true;
        
        try {
          const response = await fetch(`/account/subscriptions/${this.subscriptionId}/transfer/active/confirm`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            body: JSON.stringify({
              target_freelance_id: this.selectedFreelance?.id,
              selected_qty: this.selectedQty,
              used_amount: this.usedAmount
            })
          });

          const data = await response.json();

          if (data.ok) {
            // Ouvrir l'étape 5 : Succès
            this.close();
            window.dispatchEvent(new CustomEvent('openTransferActiveStep5', {
              detail: {
                subscriptionId: this.subscriptionId,
                selectedFreelance: this.selectedFreelance,
                selectedQty: this.selectedQty,
                usedAmount: this.usedAmount,
                currentTutorName: this.currentTutorName,
                currentTutorAvatar: this.currentTutorAvatar
              }
            }));
          } else {
            alert(data.message || '<?php echo e(__('Une erreur est survenue.')); ?>');
            this.processing = false;
          }
        } catch (error) {
          console.error('Erreur lors de la confirmation:', error);
          alert('<?php echo e(__('Une erreur est survenue.')); ?>');
          this.processing = false;
        }
      },

      goBack() {
        this.close();
        // Revenir à l'étape 3
        window.dispatchEvent(new CustomEvent('openTransferActiveStep3', {
          detail: {
            subscriptionId: this.subscriptionId,
            selectedFreelance: this.selectedFreelance,
            currentTutorName: this.currentTutorName,
            currentTutorAvatar: this.currentTutorAvatar,
            credit: this.credit,
            creditAmount: this.creditAmount
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
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription\transfer\active\step4-confirm.blade.php ENDPATH**/ ?>