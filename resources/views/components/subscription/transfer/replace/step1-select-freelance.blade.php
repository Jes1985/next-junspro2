<!-- Étape 1 : Avec qui voulez-vous continuer ? -->
<div 
  x-data="transferReplaceStep1()"
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
        aria-label="{{ __('Retour') }}"
      >
        <i class="fas fa-arrow-left"></i>
      </button>
      <button 
        type="button"
        @click="close()"
        class="transfer-modal-close"
        aria-label="{{ __('Fermer') }}"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <h2 class="transfer-modal-title">
        {{ __('Avec qui voulez-vous continuer ?') }}
      </h2>
      
      <div class="transfer-select-subtitle">
        {{ __('Pas encore abonné(e)') }}
      </div>
    </div>

    <!-- Body -->
    <div class="transfer-modal-body" style="max-height: calc(90vh - 200px); overflow-y: auto;">
      <!-- Loading -->
      <div x-show="loading" class="transfer-loading">
        <i class="fas fa-spinner fa-spin"></i>
        <p>{{ __('Chargement des freelances...') }}</p>
      </div>

      <!-- Liste des freelances -->
      <div x-show="!loading && candidates.length > 0" class="transfer-freelancers-list">
        <template x-for="freelance in candidates" :key="freelance.id">
          <button 
            type="button"
            @click="selectFreelance(freelance)"
            class="transfer-freelance-card"
          >
            <div class="transfer-freelance-avatar">
              <img 
                x-bind:src="freelance.avatar || '{{ asset('assets/img/noimage.jpg') }}'"
                x-bind:alt="freelance.name"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
              >
              <div class="transfer-freelance-avatar-initials" style="display: none;">
                <span x-text="getInitials(freelance.name)"></span>
              </div>
            </div>
            <div class="transfer-freelance-info">
              <div class="transfer-freelance-name" x-text="freelance.name"></div>
              <div class="transfer-freelance-details">
                <span x-show="freelance.trial_done">{{ __('Cours d\'essai effectué') }} • </span>
                <span x-text="formatPrice(freelance.price_per_session)"></span> {{ __('par cours') }}
              </div>
            </div>
            <div class="transfer-freelance-arrow">
              <i class="fas fa-chevron-right"></i>
            </div>
          </button>
        </template>
      </div>

      <!-- Aucun freelance disponible -->
      <div x-show="!loading && candidates.length === 0" class="transfer-empty-state">
        <div class="transfer-empty-icon">
          <i class="fas fa-user-slash"></i>
        </div>
        <p class="transfer-empty-text">{{ __('Aucun freelance disponible') }}</p>
      </div>
    </div>
  </div>
</div>

<style>
  .transfer-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .transfer-modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
  }

  .transfer-modal-container {
    position: relative;
    background: white;
    border-radius: 16px;
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    z-index: 1;
    display: flex;
    flex-direction: column;
  }

  .transfer-modal-header {
    padding: 24px 24px 16px 24px;
    border-bottom: 1px solid #E5E7EB;
    position: relative;
  }

  .transfer-modal-back,
  .transfer-modal-close {
    position: absolute;
    top: 20px;
    width: 32px;
    height: 32px;
    border: none;
    background: transparent;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6B7280;
    border-radius: 8px;
    transition: all 0.2s;
  }

  .transfer-modal-back {
    left: 20px;
  }

  .transfer-modal-close {
    right: 20px;
  }

  .transfer-modal-back:hover,
  .transfer-modal-close:hover {
    background: #F3F4F6;
    color: #111827;
  }

  .transfer-modal-title {
    font-size: 24px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 8px 0;
    padding: 0 60px;
    text-align: center;
  }

  .transfer-select-subtitle {
    font-size: 14px;
    color: #6B7280;
    text-align: center;
    margin-top: 8px;
  }

  .transfer-modal-body {
    padding: 16px 24px 24px 24px;
    flex: 1;
    overflow-y: auto;
  }

  .transfer-loading {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
    color: #6B7280;
  }

  .transfer-loading i {
    font-size: 32px;
    margin-bottom: 16px;
    color: #7C3AED;
  }

  .transfer-freelancers-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .transfer-freelance-card {
    display: flex;
    align-items: center;
    gap: 16px;
    width: 100%;
    padding: 16px;
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: left;
  }

  .transfer-freelance-card:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .transfer-freelance-avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    position: relative;
  }

  .transfer-freelance-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .transfer-freelance-avatar-initials {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 600;
  }

  .transfer-freelance-info {
    flex: 1;
    min-width: 0;
  }

  .transfer-freelance-name {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 4px;
  }

  .transfer-freelance-details {
    font-size: 14px;
    color: #6B7280;
  }

  .transfer-freelance-arrow {
    color: #9CA3AF;
    font-size: 18px;
    flex-shrink: 0;
  }

  .transfer-empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
  }

  .transfer-empty-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #F3F4F6;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
  }

  .transfer-empty-icon i {
    font-size: 40px;
    color: #9CA3AF;
  }

  .transfer-empty-text {
    font-size: 16px;
    color: #6B7280;
    text-align: center;
  }
</style>

<script>
  function transferReplaceStep1() {
    return {
      isOpen: false,
      loading: true,
      candidates: [],
      subscriptionId: null,
      currentTutorName: '',
      currentTutorAvatar: '',
      credit: 0,
      creditAmount: 0,

      init() {
        window.addEventListener('openTransferReplaceStep1', (e) => {
          this.open(e.detail);
        });
      },

      async open(payload) {
        this.subscriptionId = payload.subscriptionId;
        this.currentTutorName = payload.currentTutorName || '';
        this.currentTutorAvatar = payload.currentTutorAvatar || '';
        this.credit = payload.credit || 0;
        this.creditAmount = payload.creditAmount || 0;
        this.isOpen = true;
        this.loading = true;
        document.body.style.overflow = 'hidden';

        // Charger les candidats freelances
        await this.loadCandidates();
      },

      async loadCandidates() {
        try {
          const response = await fetch(`/account/subscriptions/${this.subscriptionId}/transfer/replace/candidates`, {
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json'
            }
          });

          const data = await response.json();

          if (data.ok) {
            // Ajouter 3 freelances en exemple pour les tests si la liste est vide
            if (data.candidates && data.candidates.length === 0) {
              this.candidates = [
                {
                  id: 'mock-1',
                  name: 'Francis K.',
                  avatar: '',
                  price_per_session: 4.30,
                  trial_done: true
                },
                {
                  id: 'mock-2',
                  name: 'Jose C.',
                  avatar: '',
                  price_per_session: 2.58,
                  trial_done: true
                },
                {
                  id: 'mock-3',
                  name: 'Faycal M.',
                  avatar: '',
                  price_per_session: 21.50,
                  trial_done: false
                }
              ];
            } else {
              this.candidates = data.candidates || [];
            }
          } else {
            // En cas d'erreur, utiliser les exemples
            this.candidates = [
              {
                id: 'mock-1',
                name: 'Francis K.',
                avatar: '',
                price_per_session: 4.30,
                trial_done: true
              },
              {
                id: 'mock-2',
                name: 'Jose C.',
                avatar: '',
                price_per_session: 2.58,
                trial_done: true
              },
              {
                id: 'mock-3',
                name: 'Faycal M.',
                avatar: '',
                price_per_session: 21.50,
                trial_done: false
              }
            ];
          }
        } catch (error) {
          console.error('Erreur lors du chargement des candidats:', error);
          // Utiliser les exemples en cas d'erreur
          this.candidates = [
            {
              id: 'mock-1',
              name: 'Francis K.',
              avatar: '',
              price_per_session: 4.30,
              trial_done: true
            },
            {
              id: 'mock-2',
              name: 'Jose C.',
              avatar: '',
              price_per_session: 2.58,
              trial_done: true
            },
            {
              id: 'mock-3',
              name: 'Faycal M.',
              avatar: '',
              price_per_session: 21.50,
              trial_done: false
            }
          ];
        } finally {
          this.loading = false;
        }
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

      selectFreelance(freelance) {
        this.close();
        // Ouvrir l'étape 2 : Choisir la formule
        window.dispatchEvent(new CustomEvent('openTransferReplaceStep2', {
          detail: {
            subscriptionId: this.subscriptionId,
            selectedFreelance: freelance,
            currentTutorName: this.currentTutorName,
            currentTutorAvatar: this.currentTutorAvatar,
            credit: this.credit,
            creditAmount: this.creditAmount
          }
        }));
      },

      goBack() {
        this.close();
        // Revenir à la modal d'entrée
        window.dispatchEvent(new CustomEvent('openTransferEntryModal', {
          detail: {
            subscriptionId: this.subscriptionId,
            tutorName: this.currentTutorName,
            avatarUrl: this.currentTutorAvatar,
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
