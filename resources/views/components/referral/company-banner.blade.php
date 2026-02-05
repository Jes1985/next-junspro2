<section class="referral-company-banner">
  <div class="referral-company-banner-container">
    <div class="referral-company-banner-content">
      <h2 class="referral-company-banner-title">
        {{ __('Recommandez Junspro à votre entreprise et obtenez des avantages') }}
      </h2>
      <p class="referral-company-banner-text">
        {{ __('Si votre entreprise rejoint Junspro, elle peut financer des prestations structurées (coaching, tutorat, accompagnement) — avec un cadre anti-procrastination et un suivi clair.') }}
      </p>
      <button 
        type="button"
        class="referral-btn-secondary"
        onclick="window.dispatchEvent(new CustomEvent('openCompanyRecommendModal'))"
      >
        {{ __('Recommander mon entreprise') }}
      </button>
      <p class="referral-company-banner-micro">
        {{ __('Réponse sous 48h ouvrées.') }}
      </p>
    </div>
    <div class="referral-company-banner-visual">
      {{-- Illustration abstraite --}}
      <div class="referral-company-visual-gradient"></div>
    </div>
  </div>
</section>

