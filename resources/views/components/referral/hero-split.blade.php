@php
  $referralLink = route('referral.track', ['code' => $referralCode]);
  // Chemin de l'image hero
  $heroImagePath = '/images/parrainage-hero.png';
  $heroImagePlaceholder = asset('assets/img/parrainage-hero-placeholder.svg');
  // Vérifier si l'image existe
  $heroImageExists = file_exists(public_path('images/parrainage-hero.png'));
@endphp

<section class="ref-hero">
  <div class="ref-hero__container">
    {{-- Bloc gauche : Contenu texte avec gradient --}}
    <div class="ref-hero__left">
      <div class="ref-hero__content">
        <div class="ref-hero__badge">{{ __('Faites passer le mot.') }}</div>
        <h1 class="ref-hero__title">
          {{ __('Invitez un proche à rejoindre l\'écosystème Junspro, recevez :amount€', ['amount' => $config['reward_amount']]) }}
        </h1>
        <p class="ref-hero__text">
          {{ __('Chez Junspro, on ne réserve pas "juste une prestation". On met en place un cadre d\'exécution : discipline, suivi, sécurité — pour des projets qui avancent vraiment.') }}
          <br><br>
          {{ __('Invitez vos proches : ils bénéficient de :benefit_label sur leur première réservation éligible, et vous recevez :amount€ en crédit Junspro dès que la première prestation est confirmée.', [
            'benefit_label' => $config['benefit_label'],
            'amount' => $config['reward_amount']
          ]) }}
        </p>
        <div class="ref-hero__actions">
          <button 
            type="button"
            class="ref-hero__cta"
            onclick="window.dispatchEvent(new CustomEvent('openInviteModal'))"
          >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
            {{ __('Inviter des amis') }}
          </button>
        </div>
        <p class="ref-hero__micro">
          {{ __('Offre valable dès :amount€ de prestation. Récompense versée après prestation payée et non annulée.', ['amount' => $config['min_eligible_amount']]) }}
        </p>
      </div>
    </div>
    
    {{-- Bloc droit : Photo premium --}}
    <div class="ref-hero__right">
      <img 
        src="{{ $heroImageExists ? $heroImagePath : $heroImagePlaceholder }}" 
        alt="{{ __('Deux personnes en séance de coaching / collaboration, ambiance chaleureuse.') }}"
        class="ref-hero__image"
        loading="lazy"
        decoding="async"
      />
      <div class="ref-hero__overlay"></div>
    </div>
  </div>
</section>

