<!-- Étape 2 : Pourquoi souhaitez-vous annuler ? -->
<div 
  x-data="subscriptionCancelStep2()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="goBack()"
  class="transfer-modal-overlay"
  style="display: none;"
>
  <div class="transfer-modal-backdrop" @click="goBack()"></div>
  
  <div 
    class="transfer-modal-container cancel-reason-container"
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
        {{ __('Pourquoi souhaitez-vous annuler ?') }}
      </h2>
      
      <p class="cancel-reason-subtitle">
        {{ __('Votre réponse nous aidera à améliorer Junspro.') }}
      </p>
    </div>

    <!-- Body avec options radio -->
    <div class="transfer-modal-body">
      <div class="cancel-reason-options">
        <!-- Option 1: C'est trop cher -->
        <label 
          class="cancel-reason-option"
          :class="{ 'cancel-reason-option-selected': selectedReason === 'too_expensive' }"
        >
          <div class="cancel-reason-option-content">
            <div class="cancel-reason-option-icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <span class="cancel-reason-option-text">{{ __('C\'est trop cher') }}</span>
          </div>
          <input 
            type="radio" 
            name="cancel_reason" 
            value="too_expensive"
            x-model="selectedReason"
            class="cancel-reason-radio"
          >
        </label>

        <!-- Option 2: Trop de rituels non utilisés -->
        <label 
          class="cancel-reason-option"
          :class="{ 'cancel-reason-option-selected': selectedReason === 'too_many_unused' }"
        >
          <div class="cancel-reason-option-content">
            <div class="cancel-reason-option-icon">
              <i class="fas fa-calendar-times"></i>
            </div>
            <span class="cancel-reason-option-text">{{ __('Il y a trop de rituels que je n\'ai pas utilisés') }}</span>
          </div>
          <input 
            type="radio" 
            name="cancel_reason" 
            value="too_many_unused"
            x-model="selectedReason"
            class="cancel-reason-radio"
          >
        </label>

        <!-- Option 3: Objectifs atteints -->
        <label 
          class="cancel-reason-option"
          :class="{ 'cancel-reason-option-selected': selectedReason === 'goals_reached' }"
        >
          <div class="cancel-reason-option-content">
            <div class="cancel-reason-option-icon">
              <i class="fas fa-star"></i>
            </div>
            <span class="cancel-reason-option-text">{{ __('J\'ai atteint mes objectifs') }}</span>
          </div>
          <input 
            type="radio" 
            name="cancel_reason" 
            value="goals_reached"
            x-model="selectedReason"
            class="cancel-reason-radio"
          >
        </label>

        <!-- Option 4: Changer de freelance -->
        <label 
          class="cancel-reason-option"
          :class="{ 'cancel-reason-option-selected': selectedReason === 'change_freelance' }"
        >
          <div class="cancel-reason-option-content">
            <div class="cancel-reason-option-icon">
              <i class="fas fa-user-friends"></i>
            </div>
            <span class="cancel-reason-option-text">{{ __('Je voudrais changer de freelance') }}</span>
          </div>
          <input 
            type="radio" 
            name="cancel_reason" 
            value="change_freelance"
            x-model="selectedReason"
            class="cancel-reason-radio"
          >
        </label>

        <!-- Option 5: Autre -->
        <label 
          class="cancel-reason-option"
          :class="{ 'cancel-reason-option-selected': selectedReason === 'other' }"
        >
          <div class="cancel-reason-option-content">
            <div class="cancel-reason-option-icon">
              <i class="fas fa-ellipsis-h"></i>
            </div>
            <span class="cancel-reason-option-text">{{ __('Autre') }}</span>
          </div>
          <input 
            type="radio" 
            name="cancel_reason" 
            value="other"
            x-model="selectedReason"
            class="cancel-reason-radio"
          >
        </label>
      </div>

      <!-- Champ texte si "Autre" sélectionné -->
      <div x-show="selectedReason === 'other'" class="cancel-reason-other-field">
        <textarea 
          x-model="otherReason"
          :placeholder="'{{ __('Pourquoi voulez-vous arrêter vos rituels avec') }} ' + tutorName + ' ?'"
          class="cancel-reason-textarea"
          rows="4"
        ></textarea>
      </div>
    </div>

    <!-- Footer avec boutons -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="keepSubscription()"
        class="cancel-reason-btn-primary"
      >
        {{ __('Conserver l\'abonnement') }}
      </button>
      
      <button 
        type="button"
        @click="continueToConfirm()"
        class="cancel-reason-btn-secondary"
        :disabled="!selectedReason"
      >
        {{ __('Continuer et annuler l\'abonnement') }}
      </button>
    </div>
  </div>
</div>

<style>
  .cancel-reason-container {
    max-width: 600px;
  }

  .cancel-reason-subtitle {
    font-size: 14px;
    color: #6B7280;
    margin: 8px 0 24px 0;
    text-align: center;
  }

  .cancel-reason-options {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 24px;
  }

  .cancel-reason-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px;
    background: white;
    border: 2px solid #E5E7EB;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
  }

  .cancel-reason-option:hover {
    border-color: #D1D5DB;
    background: #F9FAFB;
  }

  .cancel-reason-option-selected {
    border-color: #7C3AED;
    background: #F3E8FF;
  }

  .cancel-reason-option-content {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
  }

  .cancel-reason-option-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #F9FAFB;
    border-radius: 8px;
    color: #6B7280;
    font-size: 18px;
  }

  .cancel-reason-option-selected .cancel-reason-option-icon {
    background: #7C3AED;
    color: white;
  }

  .cancel-reason-option-text {
    font-size: 14px;
    font-weight: 500;
    color: #111827;
  }

  .cancel-reason-radio {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: #7C3AED;
  }

  .cancel-reason-other-field {
    margin-top: 16px;
  }

  .cancel-reason-textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid #E5E7EB;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    color: #111827;
    resize: vertical;
    transition: border-color 0.2s;
  }

  .cancel-reason-textarea:focus {
    outline: none;
    border-color: #7C3AED;
  }

  .cancel-reason-btn-primary {
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

  .cancel-reason-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(124, 58, 237, 0.4);
  }

  .cancel-reason-btn-secondary {
    width: 100%;
    padding: 16px;
    background: #F9FAFB;
    color: #6B7280;
    border: 2px solid #E5E7EB;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
  }

  .cancel-reason-btn-secondary:hover:not(:disabled) {
    background: #F3F4F6;
    border-color: #D1D5DB;
    color: #111827;
  }

  .cancel-reason-btn-secondary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }
</style>

<script>
  function subscriptionCancelStep2() {
    return {
      isOpen: false,
      subscriptionId: null,
      tutorName: '',
      tutorAvatar: '',
      selectedReason: null,
      otherReason: '',

      init() {
        window.addEventListener('openSubscriptionCancelStep2', (e) => {
          this.open(e.detail);
        });
      },

      open(payload) {
        this.subscriptionId = payload.subscriptionId;
        this.tutorName = payload.tutorName || '';
        this.tutorAvatar = payload.tutorAvatar || '';
        this.selectedReason = null;
        this.otherReason = '';
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
      },

      keepSubscription() {
        this.close();
      },

      continueToConfirm() {
        if (!this.selectedReason) return;
        
        this.close();
        // Ouvrir l'étape 3 : Confirmation finale
        window.dispatchEvent(new CustomEvent('openSubscriptionCancelStep3', {
          detail: {
            subscriptionId: this.subscriptionId,
            tutorName: this.tutorName,
            tutorAvatar: this.tutorAvatar,
            reason: this.selectedReason,
            otherReason: this.otherReason
          }
        }));
      },

      goBack() {
        this.close();
        // Revenir à l'étape 1
        window.dispatchEvent(new CustomEvent('openSubscriptionCancelStep1', {
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
