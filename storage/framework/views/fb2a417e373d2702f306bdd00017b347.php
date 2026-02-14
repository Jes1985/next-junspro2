<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Reset Password')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Reset Password')])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Reset Password')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Reset Password Part Start ======-->
  <div class="user-area-section ptb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="user-form">
            <form action="<?php echo e(route('user.reset_password_submit')); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <div class="form-group mb-4">
                <label><?php echo e(__('New Password') . '*'); ?></label>
                <input type="password" class="form-control" name="new_password">
                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <p class="text-danger mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="form-group mb-4">
                <label><?php echo e(__('Confirm New Password') . '*'); ?></label>
                <input type="password" class="form-control" name="new_password_confirmation">
                <?php $__errorArgs = ['new_password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <p class="text-danger mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary radius-sm"><?php echo e(__('Submit')); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--====== Reset Password Part End ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views/frontend/reset-password.blade.php ENDPATH**/ ?>