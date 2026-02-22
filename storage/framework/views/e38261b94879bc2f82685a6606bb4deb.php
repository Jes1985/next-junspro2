<section id="referrals-section" class="referral-referrals-section">
  <div class="referral-referrals-container">
    <h2 class="referral-section-title"><?php echo e(__('Vos parrainages')); ?></h2>
    <p class="referral-section-subtitle">
      <?php echo e(__('Suivez vos invitations, vos crédits en attente et ceux déjà obtenus.')); ?>

    </p>

    <div class="referral-stats-card">
      <div class="referral-stat-item">
        <div class="referral-stat-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
        </div>
        <div class="referral-stat-content">
          <div class="referral-stat-label"><?php echo e(__('En attente')); ?></div>
          <div class="referral-stat-value"><?php echo e(number_format($stats['pending_total'], 2, ',', ' ')); ?>€</div>
        </div>
      </div>
      <div class="referral-stat-item">
        <div class="referral-stat-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <div class="referral-stat-content">
          <div class="referral-stat-label"><?php echo e(__('Crédit obtenu')); ?></div>
          <div class="referral-stat-value"><?php echo e(number_format($stats['earned_total'], 2, ',', ' ')); ?>€</div>
        </div>
      </div>
    </div>

    <div class="referral-tabs-wrapper">
      <div class="referral-tabs">
        <button 
          class="referral-tab <?php echo e($status === 'all' || $status === 'pending' ? 'active' : ''); ?>"
          onclick="window.location.href='<?php echo e(route('referral.index', ['status' => 'pending'])); ?>'"
        >
          <?php echo e(__('En cours')); ?>

        </button>
        <button 
          class="referral-tab <?php echo e($status === 'completed' ? 'active' : ''); ?>"
          onclick="window.location.href='<?php echo e(route('referral.index', ['status' => 'completed'])); ?>'"
        >
          <?php echo e(__('Complété')); ?>

        </button>
      </div>

      <div class="referral-tab-content">
        <?php if($referrals->count() > 0): ?>
          <div class="referral-list">
            <?php $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="referral-item">
                <div class="referral-item-info">
                  <div class="referral-item-name">
                    <?php if($referral->referred->first_name): ?>
                      <?php echo e($referral->referred->first_name); ?>

                    <?php else: ?>
                      <?php echo e(substr($referral->referred->email_address ?? $referral->referred->email, 0, 1)); ?>***{{ substr(strrchr($referral->referred->email_address ?? $referral->referred->email, '@'), 1) }}
                    <?php endif; ?>
                  </div>
                  <div class="referral-item-date">
                    <?php echo e($referral->created_at->format('d/m/Y')); ?>

                  </div>
                </div>
                <div class="referral-item-status">
                  <?php if($referral->status === 'pending'): ?>
                    <span class="referral-status-badge pending"><?php echo e(__('En attente')); ?></span>
                  <?php elseif($referral->status === 'completed'): ?>
                    <span class="referral-status-badge completed"><?php echo e(__('Complété')); ?></span>
                  <?php endif; ?>
                </div>
                <div class="referral-item-reward">
                  <?php if($referral->status === 'completed'): ?>
                    <strong><?php echo e(number_format($referral->reward_amount, 2, ',', ' ')); ?>€</strong>
                  <?php else: ?>
                    <span class="referral-reward-pending"><?php echo e(__('En attente')); ?></span>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <?php if($referrals->hasMorePages()): ?>
            <div class="referral-pagination">
              <a href="<?php echo e($referrals->nextPageUrl()); ?>" class="referral-btn-secondary">
                <?php echo e(__('Voir plus')); ?>

              </a>
            </div>
          <?php endif; ?>
        <?php else: ?>
          <div class="referral-empty-state">
            <div class="referral-empty-icon">
              <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 8v4"></path>
                <path d="M12 16h.01"></path>
              </svg>
            </div>
            <h3 class="referral-empty-title"><?php echo e(__('Aucun parrainage pour le moment')); ?></h3>
            <p class="referral-empty-text">
              <?php echo e(__('Partagez votre lien : vos parrainages apparaîtront ici dès que vos proches s\'inscrivent et réservent.')); ?>

            </p>
            <button 
              type="button"
              class="referral-btn-primary"
              onclick="window.dispatchEvent(new CustomEvent('openInviteModal'))"
            >
              <?php echo e(__('Inviter des amis')); ?>

            </button>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\referral\referrals-card-tabs.blade.php ENDPATH**/ ?>