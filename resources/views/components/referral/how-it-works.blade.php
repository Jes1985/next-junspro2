<section class="referral-how-it-works-section">
  <div class="referral-how-it-works-container">
    <h2 class="referral-section-title">{{ __('Comment ça marche') }}</h2>

    <div class="referral-steps-grid">
      <div class="referral-step-card step-1">
        <div class="referral-step-icon">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            <line x1="9" y1="9" x2="15" y2="9"></line>
            <line x1="9" y1="13" x2="15" y2="13"></line>
          </svg>
        </div>
        <h3 class="referral-step-title">{{ __('Partagez votre lien de parrainage') }}</h3>
        <p class="referral-step-text">
          {{ __('Envoyez votre lien unique à vos proches. Ils s\'inscrivent et réservent via Junspro.') }}
        </p>
      </div>

      <div class="referral-step-card step-2">
        <div class="referral-step-icon">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
          </svg>
        </div>
        <h3 class="referral-step-title">{{ __('Ils profitent de :benefit_label', ['benefit_label' => $config['benefit_label']]) }}</h3>
        <p class="referral-step-text">
          {{ __('L\'avantage s\'applique sur leur première réservation éligible, selon les conditions du programme.') }}
        </p>
      </div>

      <div class="referral-step-card step-3">
        <div class="referral-step-icon">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
          </svg>
        </div>
        <h3 class="referral-step-title">{{ __('Vous recevez :amount€', ['amount' => $config['reward_amount']]) }}</h3>
        <p class="referral-step-text">
          {{ __('Votre crédit est ajouté après confirmation de la première prestation (payée + non annulée).') }}
        </p>
      </div>
    </div>

    <div class="referral-conditions-link">
      <a href="{{ route('referral.conditions') }}" class="referral-link">
        {{ __('Voir les conditions du programme') }}
      </a>
    </div>
  </div>
</section>

