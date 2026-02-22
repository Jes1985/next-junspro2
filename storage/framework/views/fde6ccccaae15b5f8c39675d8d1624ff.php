<?php $title = __('Create Ticket'); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Support Tickets Section ======-->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div class="user-profile-details mb-40">
            <div class="account-info">
              <div class="title">
                <h4><?php echo e(__('Create New Ticket')); ?></h4>

                <a href="<?php echo e(route('user.support_tickets')); ?>" class="btn btn-md btn-primary radius-sm icon-start">
                  <i
                    class="<?php echo e($currentLanguageInfo->direction == 0 ? 'fas fa-chevron-left' : 'fas fa-chevron-right'); ?>"></i> <?php echo e(__('Back')); ?>

                </a>
              </div>

              <div class="edit-info-area support-ticket-area">
                <form action="<?php echo e(route('user.support_tickets.store')); ?>" method="POST" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <input type="text" class="form-control" placeholder="<?php echo e(__('Enter Subject')); ?>"
                        name="subject" value="<?php echo e(old('subject') ?? ''); ?>">
                      <?php $__errorArgs = ['subject'];
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

                    <div class="col-lg-12 mb-4">
                      <textarea class="form-control summernote" placeholder="<?php echo e(__('Enter Message')); ?>" name="message" data-height="220"><?php echo e(old('message') ?? ''); ?></textarea>
                      <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-danger mt-2"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-lg-12 mb-3">
                      <div class="form-group mb-1">
                        <label for="formFile" class="form-label"><?php echo e(__('Choose File')); ?></label>
                        <input type="file" class="form-control size-md w-100" id="formFile" name="attachment"
                          data-url="<?php echo e(route('user.support_tickets.store_temp_file')); ?>">
                      </div>
                      <div class="progress mt-3 mb-1 d-none">
                        <div class="progress-bar mdf_w34322" role="progressbar"></div>
                      </div>
                      <small id="attachment-info"><?php echo e('*' . __('Upload only .zip file') . '. ' . __('Max file size is 20 MB') . '.'); ?></small>
                      <?php $__errorArgs = ['attachment'];
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

                    <div class="col-lg-12">
                      <div class="form-button">
                        <button class="btn btn-md btn-primary radius-sm"><?php echo e(__('Submit')); ?></button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Support Tickets Section ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\create-ticket.blade.php ENDPATH**/ ?>