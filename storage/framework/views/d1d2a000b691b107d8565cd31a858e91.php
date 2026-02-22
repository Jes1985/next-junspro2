
<div class="jsp-renew-modal-overlay" id="jsp-renew-modal-overlay" aria-hidden="true" style="display: none;">
  <div class="jsp-renew-modal-container" role="dialog" aria-modal="true" aria-labelledby="jsp-renew-modal-title">
    <div class="jsp-renew-modal-content">
      
      <div class="jsp-renew-modal-header">
        <div class="jsp-renew-modal-avatar-container">
          <img id="jsp-renew-modal-avatar" src="" alt="" class="jsp-renew-modal-avatar" style="display: none;">
          <div id="jsp-renew-modal-avatar-initials" class="jsp-renew-modal-avatar-initials"></div>
        </div>
        <button type="button" class="jsp-renew-modal-close" aria-label="<?php echo e(__('Fermer')); ?>" onclick="closeRenewModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>

      
      <h2 id="jsp-renew-modal-title" class="jsp-renew-modal-title"><?php echo e(__('Renouvelez votre abonnement')); ?></h2>

      
      <div class="jsp-renew-modal-summary">
        <div class="jsp-renew-modal-summary-main">
          <span id="jsp-renew-modal-hours">-</span> h • <span id="jsp-renew-modal-price">-</span> €
        </div>
        <div class="jsp-renew-modal-summary-period" id="jsp-renew-modal-period">toutes les 4 semaines</div>
      </div>

      
      <div class="jsp-renew-modal-pricing">
        <div class="jsp-renew-modal-pricing-row">
          <span id="jsp-renew-modal-pricing-detail">-</span>
          <span id="jsp-renew-modal-subtotal">-</span>
        </div>
        <div class="jsp-renew-modal-pricing-row">
          <span>
            <?php echo e(__('Taxes et frais')); ?>

            <i class="fas fa-info-circle jsp-renew-modal-info-icon" title="<?php echo e(__('TVA française 13%')); ?>"></i>
          </span>
          <span id="jsp-renew-modal-tax">-</span>
        </div>
        <div class="jsp-renew-modal-pricing-separator"></div>
        <div class="jsp-renew-modal-pricing-row jsp-renew-modal-pricing-total">
          <span><?php echo e(__('Total')); ?></span>
          <span id="jsp-renew-modal-total">-</span>
        </div>
      </div>

      
      <div class="jsp-renew-modal-info">
        <p id="jsp-renew-modal-renewal-text">-</p>
      </div>

      
      <?php echo $__env->make('components.payment-method-overlay', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
  </div>
</div>

<style>
  /* Styles scoped au modal uniquement */
  .jsp-renew-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
  }

  .jsp-renew-modal-overlay[aria-hidden="true"] {
    display: none;
  }

  .jsp-renew-modal-overlay[aria-hidden="false"] {
    display: flex;
  }

  .jsp-renew-modal-container {
    background: white;
    border-radius: 16px;
    max-width: 520px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    scrollbar-gutter: stable;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    position: relative;
  }

  @media (min-width: 768px) {
    .jsp-renew-modal-container {
      overflow-y: hidden;
    }
    
    .jsp-renew-modal-content {
      max-height: calc(90vh - 2rem);
      overflow-y: auto;
      scrollbar-gutter: stable;
    }
  }

  .jsp-renew-modal-content {
    padding: 2rem;
  }

  .jsp-renew-modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1.5rem;
  }

  .jsp-renew-modal-avatar-container {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .jsp-renew-modal-avatar {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    object-fit: cover;
  }

  .jsp-renew-modal-avatar-initials {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.25rem;
  }

  .jsp-renew-modal-close {
    background: none;
    border: none;
    color: #6b7280;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0.5rem;
    line-height: 1;
    transition: color 0.2s ease;
  }

  .jsp-renew-modal-close:hover {
    color: #1a202c;
  }

  .jsp-renew-modal-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 1.5rem;
  }

  .jsp-renew-modal-summary {
    background: #f9fafb;
    border-radius: 12px;
    padding: 1.25rem;
    margin-bottom: 1.5rem;
  }

  .jsp-renew-modal-summary-main {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 0.5rem;
  }

  .jsp-renew-modal-summary-period {
    font-size: 0.9rem;
    color: #6b7280;
  }

  .jsp-renew-modal-pricing {
    margin-bottom: 1.5rem;
  }

  .jsp-renew-modal-pricing-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    font-size: 0.95rem;
    color: #374151;
  }

  .jsp-renew-modal-info-icon {
    color: #9ca3af;
    font-size: 0.875rem;
    margin-left: 0.5rem;
    cursor: help;
  }

  .jsp-renew-modal-pricing-separator {
    height: 1px;
    background: #e5e7eb;
    margin: 0.5rem 0;
  }

  .jsp-renew-modal-pricing-total {
    font-weight: 700;
    font-size: 1.1rem;
    color: #1a202c;
    padding-top: 0.5rem;
  }

  .jsp-renew-modal-info {
    background: #f9fafb;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
  }

  .jsp-renew-modal-info p {
    font-size: 0.9rem;
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
  }

  .jsp-renew-modal-payment {
    margin-bottom: 1.5rem;
  }

  .jsp-renew-modal-payment-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 0.75rem;
  }

  /* Dropdown Mode de paiement style Preply */
  .jsp-renew-modal-payment-dropdown-wrapper {
    position: relative;
  }

  .jsp-renew-modal-payment-dropdown-trigger {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.875rem 1rem;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: left;
  }

  .jsp-renew-modal-payment-dropdown-trigger:hover {
    border-color: #d1d5db;
  }

  .jsp-renew-modal-payment-dropdown-trigger[aria-expanded="true"] {
    border-color: var(--junspro-purple, #7C3AED);
  }

  .jsp-renew-modal-payment-dropdown-selected {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
    color: #1a202c;
    font-size: 0.95rem;
    font-weight: 500;
  }

  .jsp-renew-modal-payment-dropdown-selected i {
    font-size: 1.5rem;
    color: #6b7280;
  }

  .jsp-renew-modal-payment-dropdown-selected .fa-cc-visa {
    color: #1434CB;
  }

  .jsp-renew-modal-payment-dropdown-selected .fa-cc-mastercard {
    color: #EB001B;
  }

  .jsp-renew-modal-payment-dropdown-selected .fa-cc-amex {
    color: #006FCF;
  }

  .jsp-renew-modal-payment-dropdown-selected .fa-cc-discover {
    color: #FF6000;
  }

  .jsp-renew-modal-payment-dropdown-chevron {
    color: #9ca3af;
    font-size: 0.875rem;
    transition: transform 0.2s ease;
  }

  .jsp-renew-modal-payment-dropdown-trigger[aria-expanded="true"] .jsp-renew-modal-payment-dropdown-chevron {
    transform: rotate(180deg);
  }

  .jsp-renew-modal-payment-dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    margin-top: 0.5rem;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    display: none;
    overflow: hidden;
  }

  .jsp-renew-modal-payment-dropdown-menu.show {
    display: block;
  }

  .jsp-renew-modal-payment-dropdown-item {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1rem;
    background: white;
    border: none;
    color: #374151;
    font-size: 0.95rem;
    text-align: left;
    cursor: pointer;
    transition: background 0.2s ease;
  }

  .jsp-renew-modal-payment-dropdown-item:hover {
    background: #f9fafb;
  }

  .jsp-renew-modal-payment-dropdown-item-active {
    background: #f3f4f6;
    color: var(--junspro-purple, #7C3AED);
    font-weight: 500;
  }

  .jsp-renew-modal-payment-dropdown-item i {
    font-size: 1.25rem;
    color: #6b7280;
    width: 24px;
    text-align: center;
  }

  .jsp-renew-modal-payment-dropdown-item-active i {
    color: var(--junspro-purple, #7C3AED);
  }

  .jsp-renew-modal-payment-dropdown-item .fa-cc-visa {
    color: #1434CB;
  }

  .jsp-renew-modal-payment-dropdown-item .fa-cc-mastercard {
    color: #EB001B;
  }

  .jsp-renew-modal-payment-dropdown-item .fa-cc-amex {
    color: #006FCF;
  }

  .jsp-renew-modal-payment-dropdown-item .fa-cc-discover {
    color: #FF6000;
  }

  .jsp-renew-modal-payment-dropdown-item .fab.fa-paypal {
    color: #003087;
  }

  .jsp-renew-modal-payment-dropdown-item .fab.fa-cc-apple-pay {
    color: #000;
  }

  .jsp-renew-modal-payment-dropdown-item .fab.fa-google-pay {
    color: #4285F4;
  }

  @media (max-width: 640px) {
    .jsp-renew-modal-content {
      padding: 1.5rem;
    }

    .jsp-renew-modal-payment-dropdown-menu {
      max-height: 300px;
      overflow-y: auto;
    }
  }
</style>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription-renew-modal.blade.php ENDPATH**/ ?>