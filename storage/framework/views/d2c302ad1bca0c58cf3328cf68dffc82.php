<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Information')); ?></h4>
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
        <a href="#"><?php echo e(__('Information')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.basic_settings.update_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-10">
                <div class="card-title"><?php echo e(__('Update Information')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <div class="form-group">
                  <label><?php echo e(__('Website Title') . '*'); ?></label>
                  <input type="text" class="form-control" name="website_title" value="<?php echo e(!empty($data) ? $data->website_title : ''); ?>" placeholder="Enter Website Title">
                  <?php if($errors->has('website_title')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('website_title')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Email Address')); ?></label>
                  <input type="email" class="form-control" name="email_address" value="<?php echo e(!empty($data) ? $data->email_address : ''); ?>" placeholder="Enter Email Address">
                  <?php if($errors->has('email_address')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('email_address')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Contact Number')); ?></label>
                  <input type="text" class="form-control" name="contact_number" value="<?php echo e(!empty($data) ? $data->contact_number : ''); ?>" placeholder="Enter Contact Number">
                  <?php if($errors->has('contact_number')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('contact_number')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Address')); ?></label>
                  <input type="text" class="form-control" name="address" value="<?php echo e(!empty($data) ? $data->address : ''); ?>" placeholder="Enter Address">
                  <?php if($errors->has('address')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('address')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Latitude')); ?></label>
                  <input type="text" class="form-control" name="latitude" value="<?php echo e(!empty($data) ? $data->latitude : ''); ?>" placeholder="Enter Latitude">
                  <?php if($errors->has('latitude')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('latitude')); ?></p>
                  <?php endif; ?>
                  <p class="mt-2 mb-0 text-warning">
                    <?php echo e(__('The value of the latitude will be helpful to show your location in the map.')); ?>

                  </p>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Longitude')); ?></label>
                  <input type="text" class="form-control" name="longitude" value="<?php echo e(!empty($data) ? $data->longitude : ''); ?>" placeholder="Enter longitude">
                  <?php if($errors->has('longitude')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('longitude')); ?></p>
                  <?php endif; ?>
                  <p class="mt-2 mb-0 text-warning">
                    <?php echo e(__('The value of the longitude will be helpful to show your location in the map.')); ?>

                  </p>
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

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\basic-settings\information.blade.php ENDPATH**/ ?>