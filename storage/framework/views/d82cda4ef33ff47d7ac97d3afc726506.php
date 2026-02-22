<!-- Étape 4 : Et si vous essayiez les rituels d'un autre freelance ? -->
<div 
  x-data="subscriptionCancelStep4()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="close()"
  class="transfer-modal-overlay"
  style="display: none;"
>
  <div class="transfer-modal-backdrop" @click="close()"></div>
  
  <div 
    class="transfer-modal-container cancel-alternative-container"
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
      
      <h2 class="cancel-alternative-title">
        <?php echo e(__('Et si vous essayiez les rituels d\'un autre freelance ?')); ?>

      </h2>
      
      <p class="cancel-alternative-subtitle">
        <?php echo e(__('Dites-nous quels sont vos besoins et nous trouverons le freelance qu\'il vous faut.')); ?>

      </p>
    </div>

    <!-- Body avec profils suggérés -->
    <div class="transfer-modal-body">
      <div class="cancel-alternative-profiles">
        <!-- Profil 1 -->
        <div class="cancel-alternative-profile-card">
          <div class="cancel-alternative-profile-avatar">
            <img 
              src="<?php echo e(asset('assets/img/noimage.jpg')); ?>"
              alt="Freelance 1"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
            >
            <div class="cancel-alternative-profile-avatar-initials" style="display: none;">
              <span>AF</span>
            </div>
          </div>
          <div class="cancel-alternative-profile-name">Alejandra F.</div>
          <div class="cancel-alternative-profile-rating">
            <i class="fas fa-star"></i> 5
          </div>
        </div>

        <!-- Profil 2 -->
        <div class="cancel-alternative-profile-card">
          <div class="cancel-alternative-profile-avatar">
            <img 
              src="<?php echo e(asset('assets/img/noimage.jpg')); ?>"
              alt="Freelance 2"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
            >
            <div class="cancel-alternative-profile-avatar-initials" style="display: none;">
              <span>PD</span>
            </div>
          </div>
          <div class="cancel-alternative-profile-name">Peter D.</div>
          <div class="cancel-alternative-profile-rating">
            <i class="fas fa-star"></i> 4.9
          </div>
        </div>

        <!-- Profil 3 -->
        <div class="cancel-alternative-profile-card">
          <div class="cancel-alternative-profile-avatar">
            <img 
              src="<?php echo e(asset('assets/img/noimage.jpg')); ?>"
              alt="Freelance 3"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
            >
            <div class="cancel-alternative-profile-avatar-initials" style="display: none;">
              <span>SM</span>
            </div>
          </div>
          <div class="cancel-alternative-profile-name">Sarah M.</div>
          <div class="cancel-alternative-profile-rating">
            <i class="fas fa-star"></i> 4.8
          </div>
        </div>
      </div>
    </div>

    <!-- Footer avec boutons -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="findNewFreelance()"
        class="cancel-alternative-btn-primary"
      >
        <?php echo e(__('Trouver un nouveau freelance')); ?>

      </button>
      
      <button 
        type="button"
        @click="dontCancel()"
        class="cancel-alternative-btn-secondary"
      >
        <?php echo e(__('Ne plus annuler')); ?>

      </button>
      
      <a 
        href="#"
        @click.prevent="close()"
        class="cancel-alternative-link"
      >
        <?php echo e(__('Pas maintenant')); ?>

      </a>
    </div>
  </div>
</div>

<style>
  .cancel-alternative-container {
    max-width: 700px;
    text-align: center;
  }

  .cancel-alternative-title {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 16px 0;
    line-height: 1.3;
  }

  .cancel-alternative-subtitle {
    font-size: 16px;
    color: #6B7280;
    line-height: 1.6;
    margin: 0 0 32px 0;
  }

  .cancel-alternative-profiles {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 16px;
    margin-bottom: 32px;
    flex-wrap: wrap;
  }

  .cancel-alternative-profile-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: 16px;
    background: white;
    border: 2px solid #E5E7EB;
    border-radius: 16px;
    transition: all 0.3s;
    transform: rotate(-2deg);
    position: relative;
  }

  .cancel-alternative-profile-card:nth-child(2) {
    transform: rotate(0deg);
    z-index: 2;
    border-color: #7C3AED;
    box-shadow: 0 8px 24px rgba(124, 58, 237, 0.2);
  }

  .cancel-alternative-profile-card:nth-child(3) {
    transform: rotate(2deg);
  }

  .cancel-alternative-profile-card:hover {
    transform: rotate(0deg) scale(1.05);
    border-color: #7C3AED;
    box-shadow: 0 8px 24px rgba(124, 58, 237, 0.2);
    z-index: 3;
  }

  .cancel-alternative-profile-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .cancel-alternative-profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .cancel-alternative-profile-avatar-initials {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    font-weight: 600;
  }

  .cancel-alternative-profile-name {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
  }

  .cancel-alternative-profile-rating {
    font-size: 14px;
    color: #F59E0B;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .cancel-alternative-btn-primary {
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
    margin-bottom: 12px;
  }

  .cancel-alternative-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(124, 58, 237, 0.4);
  }

  .cancel-alternative-btn-secondary {
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

  .cancel-alternative-btn-secondary:hover {
    background: #F9FAFB;
    transform: translateY(-2px);
  }

  .cancel-alternative-link {
    display: block;
    text-align: center;
    color: #111827;
    font-size: 14px;
    font-weight: 500;
    text-decoration: underline;
    padding: 12px;
    transition: color 0.2s;
  }

  .cancel-alternative-link:hover {
    color: #6B7280;
  }
</style>

<script>
  function subscriptionCancelStep4() {
    return {
      isOpen: false,
      subscriptionId: null,
      tutorName: '',
      tutorAvatar: '',

      init() {
        window.addEventListener('openSubscriptionCancelStep4', (e) => {
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

      findNewFreelance() {
        // Rediriger vers la page de recherche de freelances
        window.location.href = '<?php echo e(route('services')); ?>';
      },

      dontCancel() {
        // Recharger la page pour annuler l'annulation
        window.location.reload();
      },

      close() {
        this.isOpen = false;
        document.body.style.overflow = '';
        // Recharger la page après fermeture
        setTimeout(() => {
          window.location.reload();
        }, 300);
      }
    }
  }
</script>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription\cancel\step4-alternative.blade.php ENDPATH**/ ?>