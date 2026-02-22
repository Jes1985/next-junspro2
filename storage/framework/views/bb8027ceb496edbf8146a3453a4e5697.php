<!-- Étape 3 : Voulez-vous vraiment arrêter ? -->
<div 
  x-data="subscriptionCancelStep3()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="goBack()"
  class="transfer-modal-overlay"
  style="display: none;"
>
  <div class="transfer-modal-backdrop" @click="goBack()"></div>
  
  <div 
    class="transfer-modal-container cancel-confirm-container"
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
        <?php echo e(__('Voulez-vous vraiment arrêter d\'apprendre avec')); ?> <span x-text="tutorName"></span> ?
      </h2>
      
      <p class="cancel-confirm-message">
        <?php echo e(__('Nous n\'ajouterons plus de rituels et nous ne débiterons plus votre carte pour cet abonnement.')); ?>

      </p>
    </div>

    <!-- Footer avec boutons -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="keepSubscription()"
        class="cancel-confirm-btn-secondary"
      >
        <?php echo e(__('Conserver l\'abonnement')); ?>

      </button>
      
      <button 
        type="button"
        @click="confirmCancel()"
        class="cancel-confirm-btn-danger"
      >
        <?php echo e(__('Annuler l\'abonnement')); ?>

      </button>
    </div>
  </div>
</div>

<style>
  .cancel-confirm-container {
    max-width: 600px;
    text-align: center;
  }

  .cancel-confirm-message {
    font-size: 16px;
    color: #6B7280;
    line-height: 1.6;
    margin: 16px 0 32px 0;
  }

  .cancel-confirm-btn-secondary {
    width: 100%;
    padding: 16px;
    background: white;
    color: #111827;
    border: 2px solid #111827;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: 12px;
  }

  .cancel-confirm-btn-secondary:hover {
    background: #F9FAFB;
    transform: translateY(-2px);
  }

  .cancel-confirm-btn-danger {
    width: 100%;
    padding: 16px;
    background: #DC2626;
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
  }

  .cancel-confirm-btn-danger:hover {
    background: #B91C1C;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4);
  }
</style>

<script>
  function subscriptionCancelStep3() {
    return {
      isOpen: false,
      subscriptionId: null,
      tutorName: '',
      tutorAvatar: '',
      reason: null,
      otherReason: '',

      init() {
        window.addEventListener('openSubscriptionCancelStep3', (e) => {
          this.open(e.detail);
        });
      },

      open(payload) {
        this.subscriptionId = payload.subscriptionId;
        this.tutorName = payload.tutorName || '';
        this.tutorAvatar = payload.tutorAvatar || '';
        this.reason = payload.reason || null;
        this.otherReason = payload.otherReason || '';
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
      },

      keepSubscription() {
        this.close();
      },

      async confirmCancel() {
        try {
          const response = await fetch(`/user/settings/subscription/${this.subscriptionId}/cancel`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            body: JSON.stringify({
              reason: this.reason,
              other_reason: this.otherReason
            })
          });

          const data = await response.json();

          if (data.ok || response.ok) {
            // Si la raison est "change_freelance", ouvrir l'étape 4 (alternative)
            if (this.reason === 'change_freelance') {
              this.close();
              window.dispatchEvent(new CustomEvent('openSubscriptionCancelStep4', {
                detail: {
                  subscriptionId: this.subscriptionId,
                  tutorName: this.tutorName,
                  tutorAvatar: this.tutorAvatar
                }
              }));
            } else {
              // Sinon, recharger la page
              window.location.reload();
            }
          } else {
            alert(data.message || '<?php echo e(__('Une erreur est survenue.')); ?>');
          }
        } catch (error) {
          console.error('Erreur lors de l\'annulation:', error);
          // En cas d'erreur, ouvrir quand même l'étape 4 si raison = change_freelance
          if (this.reason === 'change_freelance') {
            this.close();
            window.dispatchEvent(new CustomEvent('openSubscriptionCancelStep4', {
              detail: {
                subscriptionId: this.subscriptionId,
                tutorName: this.tutorName,
                tutorAvatar: this.tutorAvatar
              }
            }));
          } else {
            alert('<?php echo e(__('Une erreur est survenue.')); ?>');
          }
        }
      },

      goBack() {
        this.close();
        // Revenir à l'étape 2
        window.dispatchEvent(new CustomEvent('openSubscriptionCancelStep2', {
          detail: {
            subscriptionId: this.subscriptionId,
            tutorName: this.tutorName,
            tutorAvatar: this.tutorAvatar
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
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription\cancel\step3-confirm.blade.php ENDPATH**/ ?>