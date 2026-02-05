<div 
  class="referral-company-modal-overlay"
  x-data="companyRecommendModal()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="close()"
  @open-company-recommend-modal.window="open()"
  style="display: none;"
>
  {{-- Backdrop --}}
  <div 
    class="referral-modal-backdrop"
    @click="close()"
  ></div>

  {{-- Modal --}}
  <div 
    class="referral-modal-container"
    @click.stop
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    role="dialog"
    aria-modal="true"
    aria-labelledby="company-modal-title"
  >
    {{-- Header --}}
    <div class="referral-modal-header">
      <h2 id="company-modal-title" class="referral-modal-title">
        {{ __('Recommander mon entreprise') }}
      </h2>
      <button 
        type="button"
        @click="close()"
        class="referral-modal-close"
        aria-label="{{ __('Fermer') }}"
      >
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    {{-- Body --}}
    <div class="referral-modal-body">
      <form @submit.prevent="submit()" class="referral-company-form">
        <div class="referral-form-group">
          <label for="company_name" class="referral-form-label">
            {{ __('Nom de l\'entreprise') }} <span class="required">*</span>
          </label>
          <input 
            type="text"
            id="company_name"
            x-model="form.company_name"
            class="referral-form-input"
            required
            placeholder="{{ __('Ex: Acme Corp') }}"
          />
        </div>

        <div class="referral-form-group">
          <label for="company_email" class="referral-form-label">
            {{ __('Email professionnel') }} <span class="required">*</span>
          </label>
          <input 
            type="email"
            id="company_email"
            x-model="form.company_email"
            class="referral-form-input"
            required
            placeholder="{{ __('contact@entreprise.com') }}"
          />
        </div>

        <div class="referral-form-group">
          <label for="message" class="referral-form-label">
            {{ __('Message (optionnel)') }}
          </label>
          <textarea 
            id="message"
            x-model="form.message"
            class="referral-form-textarea"
            rows="4"
            placeholder="{{ __('Décrivez comment Junspro pourrait bénéficier à votre entreprise...') }}"
          ></textarea>
        </div>

        <div class="referral-form-actions">
          <button 
            type="button"
            @click="close()"
            class="referral-btn-secondary"
          >
            {{ __('Annuler') }}
          </button>
          <button 
            type="submit"
            class="referral-btn-primary"
            :disabled="loading"
          >
            <span x-show="!loading">{{ __('Envoyer') }}</span>
            <span x-show="loading">{{ __('Envoi...') }}</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

