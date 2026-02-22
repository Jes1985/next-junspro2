<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Send Notification')); ?></h4>
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
        <a href="#"><?php echo e(__('Send Notification')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.user_management.push_notification.send')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="card-title d-inline-block"><?php echo e(__('Send Notification')); ?></div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-8 offset-lg-2">
                <div class="form-group">
                  <label for=""><?php echo e(__('Title') . '*'); ?></label>
                  <input type="text" class="form-control" name="title" placeholder="Enter Push Notification Title">
                  <?php if($errors->has('title')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('title')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label for=""><?php echo e(__('Message')); ?></label>
                  <textarea name="message" class="form-control" rows="5" placeholder="Write Notification Message"></textarea>
                </div>

                <div class="form-group">
                  <label for=""><?php echo e(__('Button Name') . '*'); ?></label>
                  <input type="text" class="form-control" name="button_name" placeholder="Enter Button Name">
                  <?php if($errors->has('button_name')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('button_name')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label for=""><?php echo e(__('Button URL') . '*'); ?></label>
                  <input type="url" class="form-control" name="button_url" placeholder="Enter Button URL">
                  <?php if($errors->has('button_url')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('button_url')); ?></p>
                  <?php endif; ?>

                  <p class="mt-2 mb-0 text-warning">
                    <?php echo e(__('Only those people will receive this notification, who has allowed it.')); ?><br>
                    <?php echo e(__('Push notification won\'t work for \'http\' protocol, it needs \'https\' protocol.')); ?>

                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Send')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\push-notification\write-notification.blade.php ENDPATH**/ ?>