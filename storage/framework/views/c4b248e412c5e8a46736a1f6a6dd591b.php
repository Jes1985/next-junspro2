<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->login_page_title); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_keyword_customer_login); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_description_customer_login); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php
  $title = $pageHeading->login_page_title ?? __('No Page Title Found');
?>
<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Login Area Section ======-->
  <div class="user-area-section ptb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <?php if($bs->facebook_login_status == 1 || $bs->google_login_status == 1): ?>
            <div class="mb-5">
              <div class="btn-group btn-group-toggle d-flex">
                <?php if($bs->facebook_login_status == 1): ?>
                  <a class="btn py-2 facebook-login-btn" href="<?php echo e(route('user.login.facebook')); ?>">
                    <i
                      class="fab fa-facebook-f <?php echo e($currentLanguageInfo->direction == 0 ? 'me-2' : 'ms-2'); ?>"></i><?php echo e(__('Login via Facebook')); ?>

                  </a>
                <?php endif; ?>

                <?php if($bs->google_login_status == 1): ?>
                  <a class="btn py-2 google-login-btn" href="<?php echo e(route('user.login.google')); ?>">
                    <i
                      class="fab fa-google <?php echo e($currentLanguageInfo->direction == 0 ? 'me-2' : 'ms-2'); ?>"></i><?php echo e(__('Login via Google')); ?>

                  </a>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>

          <div class="user-form">
            <form action="<?php echo e(route('user.login_submit')); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <div class="form-group mb-4">
                <label><?php echo e(__('Username') . '*'); ?></label>
                <input type="text" class="form-control" name="username" >
                <?php $__errorArgs = ['username'];
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
                <label><?php echo e(__('Password') . '*'); ?></label>
                <input type="password" class="form-control" name="password" >
                <?php $__errorArgs = ['password'];
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

              <?php if($bs->google_recaptcha_status == 1): ?>
                <div class="form-group my-4">
                  <?php echo NoCaptcha::renderJs(); ?>

                  <?php echo NoCaptcha::display(); ?>


                  <?php $__errorArgs = ['g-recaptcha-response'];
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
              <?php endif; ?>

              <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary radius-sm"><?php echo e(__('Login')); ?></button>
              </div>



              <div class="justify-content-between d-flex mt-3">
                <p><?php echo e(__("Don't have an account") . '?'); ?> <a
                    href="<?php echo e(route('user.signup')); ?>"><?php echo e(__('Signup Now')); ?></a></p>

                <a href="<?php echo e(route('user.forget_password')); ?>"><?php echo e(__('Lost your password?')); ?></a></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--====== End Login Area Section ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\login.blade.php ENDPATH**/ ?>