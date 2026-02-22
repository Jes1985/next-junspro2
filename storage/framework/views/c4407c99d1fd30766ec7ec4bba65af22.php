<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->signup_page_title); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_keyword_customer_signup); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_description_customer_signup); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php
  $title = $pageHeading->signup_page_title ?? __('No Page Title Found');
?>
<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Signup Area Section ======-->
  <div class="user-area-section ptb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="user-form">
            <form action="<?php echo e(route('user.signup_submit')); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <div class="form-group mb-4">
                <label><?php echo e(__('Username') . '*'); ?></label>
                <input type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>">
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
                <label><?php echo e(__('Email Address') . '*'); ?></label>
                <input type="email" class="form-control" name="email_address" value="<?php echo e(old('email_address')); ?>">
                <?php $__errorArgs = ['email_address'];
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
                <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>">
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

              <div class="form-group mb-4">
                <label><?php echo e(__('Confirm Password') . '*'); ?></label>
                <input type="password" class="form-control" name="password_confirmation"
                  value="<?php echo e(old('password_confirmation')); ?>">
                <?php $__errorArgs = ['password_confirmation'];
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

              <?php if($recaptchaStatus == 1): ?>
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
                <button type="submit" class="btn btn-lg btn-primary radius-sm"><?php echo e(__('Signup')); ?></button>
              </div>
              <p class="mt-3"><?php echo e(__('Already have an account') . '?'); ?> <a
                  href="<?php echo e(route('user.login')); ?>"><?php echo e(__('Login Now')); ?></a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--====== End Signup Area Section ======-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
  (function() {
    'use strict';
    
    const storageKey = 'signup_form_data';
    const form = document.querySelector('form[action="<?php echo e(route('user.signup_submit')); ?>"]');
    
    if (!form) return;
    
    // Restaurer les valeurs sauvegardées
    const savedData = localStorage.getItem(storageKey);
    if (savedData) {
      try {
        const data = JSON.parse(savedData);
        const usernameInput = form.querySelector('[name="username"]');
        const emailInput = form.querySelector('[name="email_address"]');
        
        if (usernameInput && data.username && !usernameInput.value) {
          usernameInput.value = data.username;
        }
        if (emailInput && data.email_address && !emailInput.value) {
          emailInput.value = data.email_address;
        }
      } catch (e) {
        console.error('Erreur lors de la restauration des données:', e);
      }
    }
    
    // Sauvegarder les valeurs lors de la saisie
    const inputsToSave = ['username', 'email_address'];
    inputsToSave.forEach(fieldName => {
      const input = form.querySelector(`[name="${fieldName}"]`);
      if (input) {
        input.addEventListener('input', function() {
          const currentData = JSON.parse(localStorage.getItem(storageKey) || '{}');
          currentData[fieldName] = this.value;
          localStorage.setItem(storageKey, JSON.stringify(currentData));
        });
        
        input.addEventListener('blur', function() {
          const currentData = JSON.parse(localStorage.getItem(storageKey) || '{}');
          currentData[fieldName] = this.value;
          localStorage.setItem(storageKey, JSON.stringify(currentData));
        });
      }
    });
    
    // Nettoyer localStorage après soumission réussie
    form.addEventListener('submit', function() {
      // Le localStorage sera nettoyé côté serveur si succès
      // Sinon les valeurs restent pour restauration en cas d'erreur
    });
    
    // Nettoyer localStorage si on arrive sur une page de succès (onboarding step1)
    if (window.location.pathname.includes('/freelance/onboarding/step-1')) {
      localStorage.removeItem(storageKey);
    }
  })();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\signup.blade.php ENDPATH**/ ?>