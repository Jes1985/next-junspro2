@php
  $variant = $variant ?? 'card';
  $stats = $stats ?? null;
  $referralCode = $referralCode ?? null;
  
  if (!$referralCode && Auth::guard('web')->check()) {
    $user = Auth::guard('web')->user();
    $referralService = app(\App\Services\Junspro\ReferralService::class);
    $referralCode = $referralService->getOrCreateReferralCode($user);
  }
  
  if (!$stats && Auth::guard('web')->check()) {
    $user = Auth::guard('web')->user();
    $referralService = app(\App\Services\Junspro\ReferralService::class);
    $stats = $referralService->getReferralStats($user);
  }
  
  $referralLink = $referralCode ? route('referral.track', ['code' => $referralCode]) : route('referral.index');
@endphp

@if($variant === 'card')
  {{-- Variant Card: Dashboard, Confirmation réservation --}}
  <div class="referral-cta-card">
    <div class="referral-cta-card-content">
      <h3 class="referral-cta-card-title">{{ __('Invitez un proche, recevez 10€') }}</h3>
      <p class="referral-cta-card-text">
        {{ __('Ils profitent de 10€ offerts sur les frais de site sur leur première réservation éligible. Vous recevez 10€ de crédit Junspro après leur première prestation confirmée.') }}
      </p>
      @if($stats)
        <div class="referral-cta-card-stats">
          <span>{{ number_format($stats['earned_total'], 2, ',', ' ') }}€ obtenus</span>
          <span>•</span>
          <span>{{ $stats['pending_count'] }} en attente</span>
        </div>
      @endif
    </div>
    <div class="referral-cta-card-actions">
      @if(request()->routeIs('referral.index'))
        <button 
          type="button"
          class="referral-cta-btn"
          onclick="window.dispatchEvent(new CustomEvent('openInviteModal'))"
        >
          {{ __('Inviter') }}
        </button>
      @else
        <a href="{{ route('referral.index', ['openInvite' => 1]) }}" class="referral-cta-btn">
          {{ __('Inviter') }}
        </a>
      @endif
    </div>
  </div>

@elseif($variant === 'inline')
  {{-- Variant Inline: Checkout (discret) --}}
  <div class="referral-cta-inline">
    <div class="referral-cta-inline-content">
      <strong class="referral-cta-inline-title">{{ __('Parrainage') }}</strong>
      <span class="referral-cta-inline-text">
        {{ __('Invitez un proche : 10€ offerts pour lui, 10€ de crédit pour vous après sa première prestation confirmée.') }}
      </span>
    </div>
    @if(request()->routeIs('referral.index'))
      <button 
        type="button"
        class="referral-cta-inline-btn"
        onclick="window.dispatchEvent(new CustomEvent('openInviteModal'))"
      >
        {{ __('Inviter') }}
      </button>
    @else
      <a href="{{ route('referral.index', ['openInvite' => 1]) }}" class="referral-cta-inline-btn">
        {{ __('Inviter') }}
      </a>
    @endif
  </div>

@elseif($variant === 'compact')
  {{-- Variant Compact: Footer, petites zones --}}
  <div class="referral-cta-compact">
    <a href="{{ route('referral.index') }}" class="referral-cta-compact-link">
      {{ __('Parrainage') }}
    </a>
  </div>

@elseif($variant === 'confirmation')
  {{-- Variant Confirmation: Page de confirmation réservation --}}
  <div class="referral-cta-confirmation">
    <h3 class="referral-cta-confirmation-title">{{ __('Invitez un proche et gagnez 10€') }}</h3>
    <p class="referral-cta-confirmation-text">
      {{ __('Junspro, c\'est un cadre d\'exécution premium : sessions structurées, suivi, sécurité et discipline.') }}
    </p>
    <div class="referral-cta-confirmation-actions">
      @if($referralCode)
        <button 
          type="button"
          class="referral-cta-btn-secondary"
          onclick="copyReferralLink('{{ $referralLink }}')"
        >
          {{ __('Copier mon lien') }}
        </button>
      @endif
      @if(request()->routeIs('referral.index'))
        <button 
          type="button"
          class="referral-cta-btn-primary"
          onclick="window.dispatchEvent(new CustomEvent('openInviteModal'))"
        >
          {{ __('Inviter') }}
        </button>
      @else
        <a href="{{ route('referral.index', ['openInvite' => 1]) }}" class="referral-cta-btn-primary">
          {{ __('Inviter') }}
        </a>
      @endif
    </div>
  </div>
@endif

<style>
  /* Styles pour ReferralCTA - scoped avec préfixe */
  .referral-cta-card {
    background: var(--referral-white, #ffffff);
    border-radius: var(--referral-radius-lg, 24px);
    padding: var(--referral-spacing-lg, 24px);
    box-shadow: var(--referral-shadow-soft, 0 4px 20px rgba(0, 0, 0, 0.08));
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: var(--referral-spacing-md, 24px);
    margin-bottom: var(--referral-spacing-md, 24px);
  }

  .referral-cta-card-content {
    flex: 1;
  }

  .referral-cta-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--referral-gray-900, #111827);
  }

  .referral-cta-card-text {
    color: var(--referral-gray-600, #4b5563);
    margin-bottom: 0.75rem;
    line-height: 1.6;
  }

  .referral-cta-card-stats {
    font-size: 0.875rem;
    color: var(--referral-gray-600, #4b5563);
    display: flex;
    gap: 0.5rem;
  }

  .referral-cta-btn {
    padding: 0.75rem 1.5rem;
    background: var(--referral-black, #000000);
    color: var(--referral-white, #ffffff);
    border: none;
    border-radius: var(--referral-radius-md, 18px);
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.2s ease;
  }

  .referral-cta-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .referral-cta-inline {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--referral-spacing-sm, 16px);
    background: var(--referral-gray-50, #f9fafb);
    border-radius: var(--referral-radius-md, 18px);
    margin-bottom: var(--referral-spacing-sm, 16px);
  }

  .referral-cta-inline-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
  }

  .referral-cta-inline-title {
    font-size: 0.875rem;
    color: var(--referral-gray-900, #111827);
  }

  .referral-cta-inline-text {
    font-size: 0.75rem;
    color: var(--referral-gray-600, #4b5563);
  }

  .referral-cta-inline-btn {
    padding: 0.5rem 1rem;
    background: var(--referral-black, #000000);
    color: var(--referral-white, #ffffff);
    border: none;
    border-radius: var(--referral-radius-md, 18px);
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    white-space: nowrap;
  }

  .referral-cta-compact {
    margin: 0.5rem 0;
  }

  .referral-cta-compact-link {
    color: var(--referral-gray-600, #4b5563);
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.2s ease;
  }

  .referral-cta-compact-link:hover {
    color: var(--referral-blue-royal, #1e40af);
  }

  .referral-cta-confirmation {
    background: var(--referral-white, #ffffff);
    border-radius: var(--referral-radius-lg, 24px);
    padding: var(--referral-spacing-lg, 24px);
    box-shadow: var(--referral-shadow-soft, 0 4px 20px rgba(0, 0, 0, 0.08));
    text-align: center;
    margin-bottom: var(--referral-spacing-md, 24px);
  }

  .referral-cta-confirmation-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: var(--referral-gray-900, #111827);
  }

  .referral-cta-confirmation-text {
    color: var(--referral-gray-600, #4b5563);
    margin-bottom: var(--referral-spacing-lg, 24px);
    line-height: 1.6;
  }

  .referral-cta-confirmation-actions {
    display: flex;
    gap: var(--referral-spacing-md, 16px);
    justify-content: center;
    flex-wrap: wrap;
  }

  .referral-cta-btn-primary,
  .referral-cta-btn-secondary {
    padding: 0.875rem 1.75rem;
    border-radius: var(--referral-radius-md, 18px);
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.2s ease;
    border: none;
  }

  .referral-cta-btn-primary {
    background: var(--referral-black, #000000);
    color: var(--referral-white, #ffffff);
  }

  .referral-cta-btn-secondary {
    background: var(--referral-gray-200, #e5e7eb);
    color: var(--referral-gray-900, #111827);
  }

  .referral-cta-btn-primary:hover,
  .referral-cta-btn-secondary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  @media (max-width: 768px) {
    .referral-cta-card {
      flex-direction: column;
      align-items: flex-start;
    }

    .referral-cta-inline {
      flex-direction: column;
      align-items: flex-start;
      gap: var(--referral-spacing-sm, 16px);
    }

    .referral-cta-confirmation-actions {
      flex-direction: column;
    }
  }
</style>

<script>
  function copyReferralLink(link) {
    navigator.clipboard.writeText(link).then(() => {
      alert('Lien copié !');
    }).catch(() => {
      // Fallback
      const input = document.createElement('input');
      input.value = link;
      document.body.appendChild(input);
      input.select();
      document.execCommand('copy');
      document.body.removeChild(input);
      alert('Lien copié !');
    });
  }
</script>

