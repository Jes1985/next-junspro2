

<?php $__env->startSection('pageHeading', __('Parrainage')); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/referral-premium.css')); ?>?v=<?php echo e(time()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="referral-page-container">
    
    <?php echo $__env->make('components.referral.hero-split', [
      'config' => $config,
      'referralCode' => $referralCode,
      'openInvite' => $openInvite ?? false
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.referral.referrals-card-tabs', [
      'stats' => $stats,
      'referrals' => $referrals,
      'status' => $status
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.referral.how-it-works', ['config' => $config], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.referral.premium-why-junspro', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.referral.faq-accordion', ['config' => $config], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.referral.company-banner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.referral.sticky-invite-bar', [
      'referralCode' => $referralCode
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>

  
  <?php echo $__env->make('components.referral.invite-modal', [
    'referralCode' => $referralCode,
    'config' => $config
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php echo $__env->make('components.referral.company-recommend-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="<?php echo e(asset('assets/js/referral/inviteModal.js')); ?>?v=<?php echo e(time()); ?>"></script>
  <script src="<?php echo e(asset('assets/js/referral/companyRecommendModal.js')); ?>?v=<?php echo e(time()); ?>"></script>
  <script src="<?php echo e(asset('assets/js/referral/stickyBar.js')); ?>?v=<?php echo e(time()); ?>"></script>
  
  <?php if($openInvite ?? false): ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
          window.dispatchEvent(new CustomEvent('openInviteModal'));
        }, 300);
      });
    </script>
  <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\referral\index.blade.php ENDPATH**/ ?>