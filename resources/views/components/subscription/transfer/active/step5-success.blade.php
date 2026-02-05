<!-- Étape 5 : Transfert terminé -->
<div 
  x-data="transferActiveStep5()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="close()"
  class="transfer-modal-overlay"
  style="display: none;"
>
  <div class="transfer-modal-backdrop" @click="close()"></div>
  
  <div 
    class="transfer-modal-container transfer-success-container"
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
        aria-label="{{ __('Fermer') }}"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <!-- Photos : Ancien freelance → Nouveau freelance avec badge -->
      <div class="transfer-success-avatars">
        <div class="transfer-success-avatar">
          <img 
            x-bind:src="currentTutorAvatar || '{{ asset('assets/img/noimage.jpg') }}'"
            x-bind:alt="currentTutorName"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="transfer-success-avatar-initials" style="display: none;">
            <span x-text="getInitials(currentTutorName)"></span>
          </div>
        </div>
        <div class="transfer-success-arrows">
          <i class="fas fa-arrow-right"></i>
          <i class="fas fa-arrow-right"></i>
          <i class="fas fa-arrow-right"></i>
        </div>
        <div class="transfer-success-avatar transfer-success-avatar-new">
          <img 
            x-bind:src="selectedFreelance?.avatar || '{{ asset('assets/img/noimage.jpg') }}'"
            x-bind:alt="selectedFreelance?.name"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="transfer-success-avatar-initials" style="display: none;">
            <span x-text="getInitials(selectedFreelance?.name)"></span>
          </div>
          <div class="transfer-success-badge">
            +<span x-text="selectedQty"></span>
          </div>
        </div>
      </div>
      
      <h2 class="transfer-success-title">
        {{ __('Transfert terminé') }}
      </h2>
      
      <p class="transfer-success-message">
        {{ __('Et voilà ! Vous avez') }} <strong x-text="selectedQty"></strong> <span x-text="selectedQty === 1 ? '{{ __('rituel') }}' : '{{ __('rituels') }}'"></span> {{ __('avec') }} <span x-text="selectedFreelance?.name"></span>. {{ __('Programmez votre rituel dès maintenant.') }}
      </p>
    </div>

    <!-- Footer avec boutons CTA -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="scheduleRitual()"
        class="transfer-success-btn-primary"
      >
        {{ __('Programmer le rituel') }}
      </button>
      <button 
        type="button"
        @click="close()"
        class="transfer-success-btn-secondary"
      >
        {{ __('Plus tard') }}
      </button>
    </div>
  </div>
</div>

<style>
  .transfer-success-container {
    max-width: 600px;
    text-align: center;
  }

  .transfer-success-avatars {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-bottom: 24px;
  }

  .transfer-success-avatar {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    border: 3px solid white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .transfer-success-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .transfer-success-avatar-initials {
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

  .transfer-success-avatar-new {
    position: relative;
  }

  .transfer-success-badge {
    position: absolute;
    bottom: -4px;
    right: -4px;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    border: 3px solid white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  }

  .transfer-success-arrows {
    display: flex;
    gap: 4px;
    color: #EC4899;
    font-size: 20px;
  }

  .transfer-success-title {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 16px 0;
  }

  .transfer-success-message {
    font-size: 16px;
    color: #6B7280;
    line-height: 1.6;
    margin: 0;
  }

  .transfer-success-message strong {
    color: #111827;
    font-weight: 600;
  }

  .transfer-success-btn-primary {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
    margin-bottom: 12px;
  }

  .transfer-success-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(236, 72, 153, 0.4);
  }

  .transfer-success-btn-secondary {
    width: 100%;
    padding: 16px;
    background: transparent;
    color: #6B7280;
    border: none;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
  }

  .transfer-success-btn-secondary:hover {
    color: #111827;
    background: #F9FAFB;
  }
</style>

<script>
  function transferActiveStep5() {
    return {
      isOpen: false,
      selectedFreelance: null,
      subscriptionId: null,
      currentTutorName: '',
      currentTutorAvatar: '',
      selectedQty: 0,

      init() {
        window.addEventListener('openTransferActiveStep5', (e) => {
          this.open(e.detail);
        });
      },

      open(payload) {
        this.selectedFreelance = payload.selectedFreelance;
        this.subscriptionId = payload.subscriptionId;
        this.currentTutorName = payload.currentTutorName || '';
        this.currentTutorAvatar = payload.currentTutorAvatar || '';
        this.selectedQty = payload.selectedQty || 0;
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

      scheduleRitual() {
        // TODO: Rediriger vers la page de programmation des rituels
        // Pour l'instant, on ferme juste la modal
        this.close();
        // Exemple: window.location.href = `/freelancers/${this.selectedFreelance?.id}/schedule`;
      },

      close() {
        this.isOpen = false;
        document.body.style.overflow = '';
        // Recharger la page pour mettre à jour les données
        setTimeout(() => {
          window.location.reload();
        }, 300);
      }
    }
  }
</script>
