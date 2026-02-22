<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Send Email')); ?></h4>
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
        <a href="#"><?php echo e(__('Subscribers')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Send Email')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.user_management.subscribers.send_email')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="card-title d-inline-block"><?php echo e(__('Send Email')); ?></div>
            <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('admin.user_management.subscribers')); ?>">
              <span class="btn-label">
                <i class="fas fa-backward mdb_12"></i>
              </span>
              <?php echo e(__('Back')); ?>

            </a>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-8 offset-lg-2">
                <div class="form-group">
                  <label for=""><?php echo e(__('Subject') . '*'); ?></label>
                  <input type="text" class="form-control" name="subject" placeholder="Enter Mail Subject">
                  <?php if($errors->has('subject')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('subject')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label for=""><?php echo e(__('Message') . '*'); ?></label>
                  <textarea class="summernote" name="message" data-height="300" placeholder="Write Your Mail"></textarea>
                  <?php if($errors->has('message')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('message')); ?></p>
                  <?php endif; ?>
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

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\subscriber\write-email.blade.php ENDPATH**/ ?>