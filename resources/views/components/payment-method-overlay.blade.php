{{-- Composant overlay pour le dropdown Mode de paiement --}}
<div class="jsp-payment-overlay-trigger-wrapper" id="jsp-payment-overlay-trigger-wrapper">
  <h3 class="jsp-renew-modal-payment-title">{{ __('Mode de paiement') }}</h3>
  <button type="button" class="jsp-payment-overlay-trigger" id="jsp-payment-overlay-trigger" aria-expanded="false" aria-haspopup="true">
    <div class="jsp-payment-overlay-trigger-content" id="jsp-payment-overlay-trigger-content">
      <i class="fas fa-credit-card"></i>
      <span>{{ __('Ajouter un mode de paiement') }}</span>
    </div>
    <i class="fas fa-chevron-down jsp-payment-overlay-chevron"></i>
  </button>
</div>

{{-- Overlay qui sera rendu dans body via JS --}}
<div class="jsp-payment-overlay-menu" id="jsp-payment-overlay-menu" role="menu" style="display: none;">
  <button type="button" class="jsp-payment-overlay-item jsp-payment-overlay-item-active" role="menuitem" data-payment-type="current">
    <i class="fas fa-credit-card"></i>
    <span id="jsp-payment-overlay-current-label">{{ __('Carte actuelle') }}</span>
  </button>
  <button type="button" class="jsp-payment-overlay-item" role="menuitem" data-payment-type="new-card">
    <i class="fas fa-plus-circle"></i>
    <span>{{ __('Nouvelle carte bancaire') }}</span>
  </button>
  <button type="button" class="jsp-payment-overlay-item" role="menuitem" data-payment-type="paypal">
    <i class="fab fa-paypal"></i>
    <span>{{ __('PayPal') }}</span>
  </button>
  <button type="button" class="jsp-payment-overlay-item" role="menuitem" data-payment-type="apple-pay">
    <i class="fab fa-cc-apple-pay"></i>
    <span>{{ __('Apple Pay') }}</span>
  </button>
  <button type="button" class="jsp-payment-overlay-item" role="menuitem" data-payment-type="google-pay">
    <i class="fab fa-google-pay"></i>
    <span>{{ __('Google Pay') }}</span>
  </button>
</div>

{{-- Styles et scripts --}}
<link rel="stylesheet" href="{{ asset('css/payment-method-overlay.css') }}">
<script defer src="{{ asset('js/payment-method-overlay.js') }}"></script>





















