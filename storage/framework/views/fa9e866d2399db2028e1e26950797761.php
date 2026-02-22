<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Email Settings')); ?></h4>
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
        <a href="#"><?php echo e(__('Basic Settings')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Email Settings')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Mail From Admin')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.basic_settings.update_mail_from_admin')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Mail From Admin')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body py-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <div class="alert alert-warning text-center" role="alert">
                  <strong class="text-dark"><?php echo e(__('This mail address will be used to send all mails from this website.')); ?></strong>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('SMTP Status') . '*'); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="smtp_status" value="1" class="selectgroup-input" <?php echo e((!empty($data) && $data->smtp_status == 1) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="smtp_status" value="0" class="selectgroup-input" <?php echo e((!empty($data) && $data->smtp_status == 0) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('smtp_status')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('smtp_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('SMTP Host') . '*'); ?></label>
                  <input type="text" class="form-control" name="smtp_host" value="<?php echo e(!empty($data) ? $data->smtp_host : ''); ?>">
                  <?php if($errors->has('smtp_host')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('smtp_host')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('SMTP Port') . '*'); ?></label>
                  <input class="form-control" name="smtp_port" value="<?php echo e(!empty($data) ? $data->smtp_port : ''); ?>">
                  <?php if($errors->has('smtp_port')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('smtp_port')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Encryption') . '*'); ?></label>
                  <input type="text" class="form-control" name="encryption" value="<?php echo e(!empty($data) ? $data->encryption : ''); ?>">
                  <?php if($errors->has('encryption')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('encryption')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('SMTP Username') . '*'); ?></label>
                  <input type="text" class="form-control" name="smtp_username" value="<?php echo e(!empty($data) ? $data->smtp_username : ''); ?>">
                  <?php if($errors->has('smtp_username')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('smtp_username')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('SMTP Password') . '*'); ?></label>
                  <input type="password" class="form-control" name="smtp_password" value="<?php echo e(!empty($data) ? $data->smtp_password : ''); ?>">
                  <?php if($errors->has('smtp_password')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('smtp_password')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('From Email') . '*'); ?></label>
                  <input type="email" class="form-control" name="from_mail" value="<?php echo e(!empty($data) ? $data->from_mail : ''); ?>">
                  <?php if($errors->has('from_mail')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('from_mail')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('From Name') . '*'); ?></label>
                  <input type="text" class="form-control" name="from_name" value="<?php echo e(!empty($data) ? $data->from_name : ''); ?>">
                  <?php if($errors->has('from_name')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('from_name')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\basic-settings\email\mail-from-admin.blade.php ENDPATH**/ ?>