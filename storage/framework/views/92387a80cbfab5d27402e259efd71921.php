
<div class="jsp-payment-overlay-trigger-wrapper" id="jsp-payment-overlay-trigger-wrapper">
  <h3 class="jsp-renew-modal-payment-title"><?php echo e(__('Mode de paiement')); ?></h3>
  <button type="button" class="jsp-payment-overlay-trigger" id="jsp-payment-overlay-trigger" aria-expanded="false" aria-haspopup="true">
    <div class="jsp-payment-overlay-trigger-content" id="jsp-payment-overlay-trigger-content">
      <i class="fas fa-credit-card"></i>
      <span><?php echo e(__('Ajouter un mode de paiement')); ?></span>
    </div>
    <i class="fas fa-chevron-down jsp-payment-overlay-chevron"></i>
  </button>
</div>


<div class="jsp-payment-overlay-menu" id="jsp-payment-overlay-menu" role="menu" style="display: none;">
  <button type="button" class="jsp-payment-overlay-item jsp-payment-overlay-item-active" role="menuitem" data-payment-type="current">
    <i class="fas fa-credit-card"></i>
    <span id="jsp-payment-overlay-current-label"><?php echo e(__('Carte actuelle')); ?></span>
  </button>
  <button type="button" class="jsp-payment-overlay-item" role="menuitem" data-payment-type="new-card">
    <i class="fas fa-plus-circle"></i>
    <span><?php echo e(__('Nouvelle carte bancaire')); ?></span>
  </button>
  <button type="button" class="jsp-payment-overlay-item" role="menuitem" data-payment-type="paypal">
    <i class="fab fa-paypal"></i>
    <span><?php echo e(__('PayPal')); ?></span>
  </button>
  <button type="button" class="jsp-payment-overlay-item" role="menuitem" data-payment-type="apple-pay">
    <i class="fab fa-cc-apple-pay"></i>
    <span><?php echo e(__('Apple Pay')); ?></span>
  </button>
  <button type="button" class="jsp-payment-overlay-item" role="menuitem" data-payment-type="google-pay">
    <i class="fab fa-google-pay"></i>
    <span><?php echo e(__('Google Pay')); ?></span>
  </button>
</div>


<link rel="stylesheet" href="<?php echo e(asset('css/payment-method-overlay.css')); ?>">
<script defer src="<?php echo e(asset('js/payment-method-overlay.js')); ?>"></script>





















<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\payment-method-overlay.blade.php ENDPATH**/ ?>