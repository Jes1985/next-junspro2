<!-- Étape 1 : Modal de prévention -->
<div 
  x-data="subscriptionCancelStep1()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="close()"
  class="transfer-modal-overlay"
  style="display: none;"
>
  <div class="transfer-modal-backdrop" @click="close()"></div>
  
  <div 
    class="transfer-modal-container cancel-prevention-container"
    @click.stop
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
  >
    <!-- Header -->
    <div class="transfer-modal-header">
      <button 
        type="button"
        @click="close()"
        class="transfer-modal-close"
        aria-label="<?php echo e(__('Fermer')); ?>"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <!-- Photos des freelances -->
      <div class="cancel-prevention-avatars">
        <div class="cancel-prevention-avatar">
          <img 
            x-bind:src="tutorAvatar || '<?php echo e(asset('assets/img/noimage.jpg')); ?>'"
            x-bind:alt="tutorName"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="cancel-prevention-avatar-initials" style="display: none;">
            <span x-text="getInitials(tutorName)"></span>
          </div>
        </div>
        <div class="cancel-prevention-avatar">
          <img 
            src="<?php echo e(asset('assets/img/noimage.jpg')); ?>"
            alt="Alternative"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="cancel-prevention-avatar-initials" style="display: none;">
            <span>?</span>
          </div>
        </div>
      </div>
      
      <h2 class="cancel-prevention-title">
        <?php echo e(__('On sait que la vie peut vous mettre des bâtons dans les roues.')); ?>

      </h2>
      
      <p class="cancel-prevention-message">
        <?php echo e(__('Mais en abandonnant maintenant, vous pourriez perdre tout le fruit de vos efforts. Essayez plutôt de faire une pause pouvant aller jusqu\'à 20 jours.')); ?>

      </p>
    </div>

    <!-- Body avec boutons d'action -->
    <div class="transfer-modal-body">
      <div class="cancel-prevention-actions">
        <!-- Bouton Mettre en pause -->
        <button 
          type="button"
          @click="pauseSubscription()"
          class="cancel-prevention-btn-primary"
        >
          <?php echo e(__('Mettre l\'abonnement en pause')); ?>

        </button>
        
        <!-- Bouton Changer de formule -->
        <button 
          type="button"
          @click="changePlan()"
          class="cancel-prevention-btn-secondary"
        >
          <?php echo e(__('Changer de formule')); ?>

        </button>
        
        <!-- Lien Procéder à l'annulation -->
        <a 
          href="#"
          @click.prevent="proceedToCancel()"
          class="cancel-prevention-link"
        >
          <?php echo e(__('Procéder à l\'annulation')); ?>

        </a>
      </div>
    </div>
  </div>
</div>

<style>
  .cancel-prevention-container {
    max-width: 600px;
    text-align: center;
    background: linear-gradient(135deg, #F3E8FF 0%, #E9D5FF 50%, #DDD6FE 100%);
  }

  .cancel-prevention-avatars {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: -8px;
    margin-bottom: 24px;
    position: relative;
  }

  .cancel-prevention-avatar {
    width: 64px;
    height: 64px;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    border: 3px solid white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .cancel-prevention-avatar:first-child {
    z-index: 2;
    margin-right: -12px;
  }

  .cancel-prevention-avatar:last-child {
    z-index: 1;
  }

  .cancel-prevention-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .cancel-prevention-avatar-initials {
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

  .cancel-prevention-title {
    font-size: 24px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 16px 0;
    line-height: 1.3;
  }

  .cancel-prevention-message {
    font-size: 16px;
    color: #6B7280;
    line-height: 1.6;
    margin: 0 0 32px 0;
  }

  .cancel-prevention-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .cancel-prevention-btn-primary {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    border: 2px solid white;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .cancel-prevention-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(124, 58, 237, 0.4);
  }

  .cancel-prevention-btn-secondary {
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
  }

  .cancel-prevention-btn-secondary:hover {
    background: #F9FAFB;
    transform: translateY(-2px);
  }

  .cancel-prevention-link {
    display: block;
    text-align: center;
    color: #111827;
    font-size: 14px;
    font-weight: 500;
    text-decoration: underline;
    padding: 12px;
    transition: color 0.2s;
  }

  .cancel-prevention-link:hover {
    color: #6B7280;
  }
</style>

<script>
  function subscriptionCancelStep1() {
    return {
      isOpen: false,
      subscriptionId: null,
      tutorName: '',
      tutorAvatar: '',

      init() {
        window.addEventListener('openSubscriptionCancelStep1', (e) => {
          this.open(e.detail);
        });
      },

      open(payload) {
        this.subscriptionId = payload.subscriptionId;
        this.tutorName = payload.tutorName || '';
        this.tutorAvatar = payload.tutorAvatar || '';
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

      pauseSubscription() {
        // TODO: Implémenter la mise en pause
        this.close();
        // Exemple: window.location.href = `/user/settings/subscription/${this.subscriptionId}/pause`;
      },

      changePlan() {
        // TODO: Ouvrir le flow de changement de formule
        this.close();
        // Exemple: window.dispatchEvent(new CustomEvent('openChangePlanFlow', { detail: { subscriptionId: this.subscriptionId } }));
      },

      proceedToCancel() {
        this.close();
        // Ouvrir l'étape 2 : Sélection de la raison
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
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription\cancel\step1-prevention.blade.php ENDPATH**/ ?>