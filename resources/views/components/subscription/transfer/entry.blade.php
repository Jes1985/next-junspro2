<!-- Modal Entry: Que souhaitez-vous faire ? -->
<div 
  x-data="transferEntryModal()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="close()"
  class="transfer-entry-modal-overlay"
  style="display: none;"
>
  <div class="transfer-entry-modal-backdrop" @click="close()"></div>
  
  <div 
    class="transfer-entry-modal-container"
    @click.stop
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
  >
    <!-- Header -->
    <div class="transfer-entry-modal-header">
      <button 
        type="button"
        @click="close()"
        class="transfer-entry-modal-close"
        aria-label="{{ __('Fermer') }}"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <h2 class="transfer-entry-modal-title">
        {{ __('Que souhaitez-vous faire ?') }}
      </h2>
      
      <!-- Solde avec le freelance -->
      <div class="transfer-entry-balance" x-show="balanceText">
        <span x-text="balanceText"></span>
      </div>
    </div>

    <!-- Body avec les 4 choix -->
    <div class="transfer-entry-modal-body">
      
      <!-- Option 1: Remplacer le freelance -->
      <button 
        type="button"
        @click="handleOption('replace')"
        class="transfer-entry-option-card"
      >
        <!-- Détail visuel capture 3 : Avatar actuel → Flèche → ? -->
        <div class="transfer-entry-visual-detail" x-show="tutorAvatar">
          <img 
            x-bind:src="tutorAvatar" 
            x-bind:alt="tutorName"
            class="transfer-entry-avatar-small"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="transfer-entry-avatar-initials" style="display: none;">
            <span x-text="getInitials(tutorName)"></span>
          </div>
          <i class="fas fa-arrow-right transfer-entry-arrow-icon"></i>
          <div class="transfer-entry-question-mark">
            <i class="fas fa-question"></i>
          </div>
        </div>
        
        <div class="transfer-entry-option-icon">
          <i class="fas fa-exchange-alt"></i>
        </div>
        <div class="transfer-entry-option-content">
          <div class="transfer-entry-option-title">
            {{ __('Remplacer') }} <span x-text="tutorName"></span> {{ __('par un autre freelance') }}
          </div>
          <div class="transfer-entry-option-description">
            {{ __('Annulez votre abonnement avec') }} <span x-text="tutorName"></span> 
            {{ __('et utilisez votre solde restant pour régler votre abonnement avec un nouveau freelance.') }}
          </div>
        </div>
        <div class="transfer-entry-option-arrow">
          <i class="fas fa-chevron-right"></i>
        </div>
      </button>

      <!-- Option 2: Ajouter un autre freelance -->
      <button 
        type="button"
        @click="handleOption('add')"
        class="transfer-entry-option-card"
      >
        <div class="transfer-entry-option-icon">
          <i class="fas fa-user-plus"></i>
        </div>
        <div class="transfer-entry-option-content">
          <div class="transfer-entry-option-title">
            {{ __('Ajouter un autre freelance') }}
          </div>
          <div class="transfer-entry-option-description">
            {{ __('Gardez votre abonnement avec') }} <span x-text="tutorName"></span> 
            {{ __('et utilisez votre solde pour en souscrire un nouveau avec un autre freelance.') }}
          </div>
        </div>
        <div class="transfer-entry-option-arrow">
          <i class="fas fa-chevron-right"></i>
        </div>
      </button>

      <!-- Option 3: Transférer des rituels à un autre freelance actif -->
      <button 
        type="button"
        @click="handleOption('transfer_active')"
        class="transfer-entry-option-card"
      >
        <div class="transfer-entry-option-icon">
          <i class="fas fa-share-alt"></i>
        </div>
        <div class="transfer-entry-option-content">
          <div class="transfer-entry-option-title">
            {{ __('Transférer des rituels à un autre freelance actif') }}
          </div>
          <div class="transfer-entry-option-description">
            {{ __('Transférer des rituels à un autre freelance actif') }}
          </div>
        </div>
        <div class="transfer-entry-option-arrow">
          <i class="fas fa-chevron-right"></i>
        </div>
      </button>

      <!-- Option 4: Trouvez un nouveau freelance -->
      <a 
        href="{{ route('services') }}"
        class="transfer-entry-option-card transfer-entry-option-link"
      >
        <div class="transfer-entry-option-icon">
          <i class="fas fa-search"></i>
        </div>
        <div class="transfer-entry-option-content">
          <div class="transfer-entry-option-title">
            {{ __('Trouvez un nouveau freelance') }}
          </div>
          <div class="transfer-entry-option-description">
            {{ __('Trouvez un nouveau freelance') }}
          </div>
        </div>
        <div class="transfer-entry-option-arrow">
          <i class="fas fa-chevron-right"></i>
        </div>
      </a>
      
    </div>
  </div>
</div>

<style>
  /* Modal Entry - Couleur de fond Junspro */
  .transfer-entry-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .transfer-entry-modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
  }

  .transfer-entry-modal-container {
    position: relative;
    background: white;
    border-radius: 16px;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    z-index: 1;
  }

  .transfer-entry-modal-header {
    padding: 24px 24px 16px 24px;
    border-bottom: 1px solid #E5E7EB;
    position: relative;
  }

  .transfer-entry-modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
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

  .transfer-entry-modal-close:hover {
    background: #F3F4F6;
    color: #111827;
  }

  .transfer-entry-modal-title {
    font-size: 24px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 12px 0;
    padding-right: 40px;
  }

  .transfer-entry-balance {
    font-size: 14px;
    color: #6B7280;
    margin-top: 8px;
  }

  .transfer-entry-modal-body {
    padding: 16px 24px 24px 24px;
  }

  .transfer-entry-option-card {
    display: flex;
    align-items: center;
    gap: 16px;
    width: 100%;
    padding: 20px;
    margin-bottom: 12px;
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: left;
    text-decoration: none;
    color: inherit;
  }

  .transfer-entry-option-card:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .transfer-entry-option-link {
    display: flex;
  }

  .transfer-entry-option-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    border-radius: 12px;
    color: white;
    font-size: 20px;
    flex-shrink: 0;
  }

  .transfer-entry-option-content {
    flex: 1;
    min-width: 0;
  }

  .transfer-entry-option-title {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 6px;
  }

  .transfer-entry-option-description {
    font-size: 14px;
    color: #6B7280;
    line-height: 1.5;
  }

  .transfer-entry-option-arrow {
    color: #9CA3AF;
    font-size: 18px;
    flex-shrink: 0;
  }

  /* Détail visuel capture 3 : Avatar → Flèche → ? */
  .transfer-entry-visual-detail {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
    padding: 8px;
    background: #F9FAFB;
    border-radius: 8px;
    width: 100%;
  }

  .transfer-entry-avatar-small {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .transfer-entry-avatar-initials {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
    border: 2px solid white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .transfer-entry-arrow-icon {
    color: #6B7280;
    font-size: 14px;
  }

  .transfer-entry-question-mark {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 600;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  @media (max-width: 640px) {
    .transfer-entry-modal-container {
      width: 95%;
      max-height: 95vh;
    }

    .transfer-entry-modal-title {
      font-size: 20px;
    }

    .transfer-entry-option-card {
      padding: 16px;
    }

    .transfer-entry-option-icon {
      width: 40px;
      height: 40px;
      font-size: 18px;
    }
  }
</style>

<script>
  function transferEntryModal() {
    return {
      isOpen: false,
      tutorName: '',
      tutorAvatar: '',
      subscriptionId: null,
      credit: 0,
      creditAmount: 0,
      balanceText: '',

      init() {
        // Écouter les événements d'ouverture
        window.addEventListener('openTransferEntryModal', (e) => {
          this.open(e.detail);
        });
      },

      open(payload) {
        this.tutorName = payload.tutorName || '';
        this.tutorAvatar = payload.avatarUrl || '';
        this.subscriptionId = payload.subscriptionId || null;
        this.credit = payload.credit || 0;
        this.creditAmount = payload.creditAmount || 0;
        
        // Formater le texte du solde
        if (this.credit > 0 || this.creditAmount > 0) {
          const sessionsText = this.credit === 1 ? 'Rituel' : 'Rituels';
          const amountText = this.creditAmount > 0 
            ? new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(this.creditAmount)
            : '0,00 €';
          this.balanceText = `Votre solde avec ${this.tutorName} : ${this.credit} ${sessionsText} • ${amountText}`;
        } else {
          this.balanceText = '';
        }
        
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
      },

      close() {
        this.isOpen = false;
        document.body.style.overflow = '';
      },

      getInitials(name) {
        if (!name) return '?';
        const parts = name.trim().split(' ');
        if (parts.length >= 2) {
          return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
        }
        return name.substring(0, 2).toUpperCase();
      },

      handleOption(option) {
        if (option === 'replace') {
          // Ouvrir l'étape 1 : Sélection du freelance
          this.close();
          window.dispatchEvent(new CustomEvent('openTransferReplaceStep1', {
            detail: {
              subscriptionId: this.subscriptionId,
              currentTutorName: this.tutorName,
              currentTutorAvatar: this.tutorAvatar,
              credit: this.credit,
              creditAmount: this.creditAmount
            }
          }));
        } else if (option === 'add') {
          // Ouvrir l'étape 2 : Liste de freelances pour ajouter
          this.close();
          window.dispatchEvent(new CustomEvent('openTransferAddStep2', {
            detail: {
              subscriptionId: this.subscriptionId,
              currentTutorName: this.tutorName,
              currentTutorAvatar: this.tutorAvatar,
              credit: this.credit,
              creditAmount: this.creditAmount
            }
          }));
        } else if (option === 'transfer_active') {
          // Ouvrir l'étape 2 : Liste de freelances actifs pour transférer
          this.close();
          window.dispatchEvent(new CustomEvent('openTransferActiveStep2', {
            detail: {
              subscriptionId: this.subscriptionId,
              currentTutorName: this.tutorName,
              currentTutorAvatar: this.tutorAvatar,
              credit: this.credit,
              creditAmount: this.creditAmount
            }
          }));
        } else {
          // TODO: Implémenter les autres flows
          console.log('Option sélectionnée:', option);
          this.close();
        }
      }
    }
  }
</script>
