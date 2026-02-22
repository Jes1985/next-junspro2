<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Settings')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('User Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Push Notification')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Settings')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <div class="card-title"><?php echo e(__('Update Settings')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="settingsForm" action="<?php echo e(route('admin.user_management.push_notification.update_settings')); ?>"
                method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label for=""><?php echo e(__('Push Notification Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <?php if(!is_null($data->notification_image)): ?>
                      <img src="<?php echo e(asset('assets/img/' . $data->notification_image)); ?>" alt="image"
                        class="uploaded-img">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                    <?php endif; ?>
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="img-input" name="notification_image">
                    </div>
                  </div>
                  <?php $__errorArgs = ['notification_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <?php if(env('VAPID_PUBLIC_KEY') == null && env('VAPID_PRIVATE_KEY') == null): ?>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for=""><?php echo e(__('VAPID Public Key') . '*'); ?></label>
                        <input type="text" class="form-control" name="vapid_public_key"
                          placeholder="Enter VAPID Public Key">
                        <?php $__errorArgs = ['vapid_public_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      </div>

                      <div class="form-group">
                        <label for=""><?php echo e(__('VAPID Private Key') . '*'); ?></label>
                        <input type="text" class="form-control" name="vapid_private_key"
                          placeholder="Enter VAPID Private Key">
                        <?php $__errorArgs = ['vapid_private_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      </div>

                      <p class="ml-3 mb-0 text-light">
                        <a href="https://www.attheminute.com/vapid-key-generator/" target="_blank"
                          class="text-decoration-none">
                          <?php echo e(__('Click Here')); ?>

                        </a> <?php echo e(__('to generate the VAPID Public Key & the VAPID Private Key') . '.'); ?>

                      </p>
                    </div>
                  </div>
                <?php endif; ?>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="settingsForm" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\push-notification\settings.blade.php ENDPATH**/ ?>