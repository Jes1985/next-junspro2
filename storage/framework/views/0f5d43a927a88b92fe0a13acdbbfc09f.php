<?php $__env->startSection('pageHeading'); ?>
  <?php if($payVia == 'online'): ?>
    <?php echo e(__('Payment Success')); ?>

  <?php else: ?>
    <?php echo e(__('Success')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Success')])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Success')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!-- Start Purchase Success Section -->
  <div class="purchase-message ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="purchase-success">
            <div class="icon" style="color: #4F46E5;"><i class="far fa-check-circle"></i></div>
            <h2><?php echo e(__('Success') . '!'); ?></h2>
            <?php if($payVia == 'online'): ?>
              <p><?php echo e(__('Your order has been placed successfully') . '.'); ?></p>
              <p><?php echo e(__('We have sent you a mail with an invoice') . '.'); ?></p>
            <?php elseif($payVia == 'offline'): ?>
              <p><?php echo e(__('Your transaction request was received and sent for review') . '.'); ?></p>
              <p><?php echo e(__('We answer every request as quickly as we can, usually within 24–48 hours') . '.'); ?></p>
            <?php else: ?>
              <p><?php echo e(__('Thank you for writing to us') . '.'); ?></p>
              <p><?php echo e(__('We have received your order and, will get back to you as soon as possible') . '.'); ?></p>
            <?php endif; ?>

            <p class="mt-4"><?php echo e(__('Thank you') . '.'); ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Purchase Success Section -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\payment\success.blade.php ENDPATH**/ ?>