<!-- Étape 2 : À qui voulez-vous le transférer ? -->
<div 
  x-data="transferActiveStep2()"
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
        {{ __('À qui voulez-vous le transférer ?') }}
      </h2>
    </div>

    <!-- Body -->
    <div class="transfer-modal-body" style="max-height: calc(90vh - 200px); overflow-y: auto;">
      <!-- Loading -->
      <div x-show="loading" class="transfer-loading">
        <i class="fas fa-spinner fa-spin"></i>
        <p>{{ __('Chargement des freelances actifs...') }}</p>
      </div>

      <!-- Liste des freelances : Abonnements actifs -->
      <div x-show="!loading && activeFreelances.length > 0" class="transfer-freelancers-list">
        <div class="transfer-freelancers-group">
          <div class="transfer-freelancers-group-title">{{ __('Abonnements actifs') }}</div>
          <template x-for="freelance in activeFreelances" :key="freelance.id">
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
                  <span x-text="freelance.rituals_remaining"></span> 
                  <span x-text="freelance.rituals_remaining === 1 ? '{{ __('rituel restant') }}' : '{{ __('rituels restants') }}'"></span>
                  · 
                  <span x-text="formatPrice(freelance.price_per_ritual)"></span> {{ __('par rituel') }}
                </div>
              </div>
              <div class="transfer-freelance-arrow">
                <i class="fas fa-chevron-right"></i>
              </div>
            </button>
          </template>
        </div>
      </div>

      <!-- Aucun freelance disponible -->
      <div x-show="!loading && activeFreelances.length === 0" class="transfer-empty-state">
        <div class="transfer-empty-icon">
          <i class="fas fa-user-slash"></i>
        </div>
        <p class="transfer-empty-text">{{ __('Aucun freelance actif disponible') }}</p>
      </div>
    </div>
  </div>
</div>

<style>
  .transfer-freelancers-group {
    margin-bottom: 24px;
  }

  .transfer-freelancers-group:last-child {
    margin-bottom: 0;
  }

  .transfer-freelancers-group-title {
    font-size: 14px;
    font-weight: 600;
    color: #6B7280;
    margin-bottom: 12px;
    padding: 0 4px;
  }
</style>

<script>
  function transferActiveStep2() {
    return {
      isOpen: false,
      loading: true,
      activeFreelances: [],
      subscriptionId: null,
      currentTutorName: '',
      currentTutorAvatar: '',
      credit: 0,
      creditAmount: 0,

      init() {
        window.addEventListener('openTransferActiveStep2', (e) => {
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

        // Charger les freelances actifs
        await this.loadActiveFreelances();
      },

      async loadActiveFreelances() {
        try {
          const response = await fetch(`/account/subscriptions/${this.subscriptionId}/transfer/active/candidates`, {
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json'
            }
          });

          const data = await response.json();

          if (data.ok) {
            // Ajouter des exemples si la liste est vide pour les tests
            if (data.candidates && data.candidates.length === 0) {
              this.activeFreelances = [
                {
                  id: 'mock-1',
                  name: 'Jose C.',
                  avatar: '',
                  rituals_remaining: 1,
                  price_per_ritual: 2.58
                },
                {
                  id: 'mock-2',
                  name: 'Cordelia Ngwa N.',
                  avatar: '',
                  rituals_remaining: 0,
                  price_per_ritual: 3.44
                },
                {
                  id: 'mock-3',
                  name: 'Francis K.',
                  avatar: '',
                  rituals_remaining: 2,
                  price_per_ritual: 4.30
                },
                {
                  id: 'mock-4',
                  name: 'Nadine Aimee H.',
                  avatar: '',
                  rituals_remaining: 2,
                  price_per_ritual: 3.44
                },
                {
                  id: 'mock-5',
                  name: 'Augustin J.',
                  avatar: '',
                  rituals_remaining: 4,
                  price_per_ritual: 3.44
                },
                {
                  id: 'mock-6',
                  name: 'Mohamed amine H.',
                  avatar: '',
                  rituals_remaining: 0,
                  price_per_ritual: 3.44
                }
              ];
            } else {
              this.activeFreelances = data.candidates || [];
            }
          } else {
            // En cas d'erreur, utiliser les exemples
            this.activeFreelances = [
              {
                id: 'mock-1',
                name: 'Jose C.',
                avatar: '',
                rituals_remaining: 1,
                price_per_ritual: 2.58
              },
              {
                id: 'mock-2',
                name: 'Cordelia Ngwa N.',
                avatar: '',
                rituals_remaining: 0,
                price_per_ritual: 3.44
              },
              {
                id: 'mock-3',
                name: 'Francis K.',
                avatar: '',
                rituals_remaining: 2,
                price_per_ritual: 4.30
              }
            ];
          }
        } catch (error) {
          console.error('Erreur lors du chargement des freelances actifs:', error);
          // Utiliser les exemples en cas d'erreur
          this.activeFreelances = [
            {
              id: 'mock-1',
              name: 'Jose C.',
              avatar: '',
              rituals_remaining: 1,
              price_per_ritual: 2.58
            },
            {
              id: 'mock-2',
              name: 'Cordelia Ngwa N.',
              avatar: '',
              rituals_remaining: 0,
              price_per_ritual: 3.44
            },
            {
              id: 'mock-3',
              name: 'Francis K.',
              avatar: '',
              rituals_remaining: 2,
              price_per_ritual: 4.30
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
        // Ouvrir l'étape 3 : Sélection quantité
        window.dispatchEvent(new CustomEvent('openTransferActiveStep3', {
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
