<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Maintenance Mode')); ?></h4>
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
        <a href="#"><?php echo e(__('Maintenance Mode')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title"><?php echo e(__('Update Maintenance Mode')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="maintenanceForm" action="<?php echo e(route('admin.basic_settings.update_maintenance_mode')); ?>"
                method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label for=""><?php echo e(__('Maintenance Mode Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <?php if(!empty($data->maintenance_img)): ?>
                      <img src="<?php echo e(asset('assets/img/' . $data->maintenance_img)); ?>" alt="maintenance image"
                        class="uploaded-img">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                    <?php endif; ?>
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="img-input" name="maintenance_img">
                    </div>
                  </div>
                  <?php if($errors->has('maintenance_img')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('maintenance_img')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group mt-2">
                  <label><?php echo e(__('Maintenance Status') . '*'); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="maintenance_status" value="1" class="selectgroup-input"
                        <?php echo e(!empty($data) && $data->maintenance_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="maintenance_status" value="0" class="selectgroup-input"
                        <?php echo e(!empty($data) && $data->maintenance_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('maintenance_status')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('maintenance_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Maintenance Message') . '*'); ?></label>
                  <textarea class="form-control" name="maintenance_msg" rows="3" cols="80"><?php echo e(!empty($data) ? $data->maintenance_msg : ''); ?></textarea>
                  <?php if($errors->has('maintenance_msg')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('maintenance_msg')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Bypass Token')); ?></label>
                  <input type="text" class="form-control" name="bypass_token"
                    value="<?php echo e(!empty($data) ? $data->bypass_token : ''); ?>">
                  <p class="mt-2 mb-0 text-warning">
                    <?php echo e('*' . __('During maintenance, you can access the system by using this token.')); ?><br>
                    <span class="text-info"><?php echo e(url('/')); ?>/token-value</span><br>
                    <?php echo e('*' . __('Do not use special character in this token.')); ?>

                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="maintenanceForm" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\basic-settings\maintenance.blade.php ENDPATH**/ ?>