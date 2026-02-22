<?php
  $referralLink = route('referral.track', ['code' => $referralCode]);
?>

<div 
  class="referral-invite-modal-overlay"
  x-data="inviteModal()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="close()"
  @open-invite-modal.window="open()"
  style="display: none;"
>
  
  <div 
    class="referral-modal-backdrop"
    @click="close()"
  ></div>

  
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
    aria-labelledby="invite-modal-title"
  >
    
    <div class="referral-modal-header">
      <h2 id="invite-modal-title" class="referral-modal-title">
        <?php echo e(__('Invitez vos proches')); ?>

      </h2>
      <button 
        type="button"
        @click="close()"
        class="referral-modal-close"
        aria-label="<?php echo e(__('Fermer')); ?>"
      >
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    
    <div class="referral-modal-body">
      <p class="referral-modal-subtitle">
        <?php echo e(__('Ils bénéficient de :benefit_label sur leur première réservation éligible, et vous recevez :amount€ après confirmation de leur première prestation.', [
          'benefit_label' => $config['benefit_label'],
          'amount' => $config['reward_amount']
        ])); ?>

      </p>

      
      <div class="referral-link-block">
        <label class="referral-link-label"><?php echo e(__('Votre lien de parrainage')); ?></label>
        <div class="referral-link-input-group">
          <input 
            type="text" 
            readonly
            value="<?php echo e($referralLink); ?>"
            class="referral-link-input"
            id="referral-link-input"
          />
          <button 
            type="button"
            class="referral-link-copy-btn"
            @click="copyLink()"
          >
            <?php echo e(__('Copier')); ?>

          </button>
        </div>
        <div 
          x-show="linkCopied"
          x-transition
          class="referral-link-copied"
        >
          <?php echo e(__('Lien copié ✅')); ?>

        </div>
      </div>

      
      <div class="referral-share-buttons">
        <a 
          href="https://wa.me/?text=<?php echo e(urlencode('Rejoins Junspro avec mon lien de parrainage : ' . $referralLink)); ?>"
          target="_blank"
          class="referral-share-btn whatsapp"
        >
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
          </svg>
          WhatsApp
        </a>
        <a 
          href="mailto:?subject=<?php echo e(urlencode('Rejoins Junspro')); ?>&body=<?php echo e(urlencode('Rejoins Junspro avec mon lien de parrainage : ' . $referralLink)); ?>"
          class="referral-share-btn email"
        >
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          Email
        </a>
      </div>

      
      <p class="referral-modal-disclaimer">
        <?php echo e(__('Le programme est soumis à des règles anti-abus.')); ?>

        <a href="<?php echo e(route('referral.conditions')); ?>" class="referral-link"><?php echo e(__('Voir les conditions.')); ?></a>
      </p>
    </div>
  </div>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\referral\invite-modal.blade.php ENDPATH**/ ?>