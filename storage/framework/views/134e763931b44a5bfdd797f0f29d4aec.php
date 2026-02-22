<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Admin Profile')); ?></h4>
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
        <a href="#"><?php echo e(__('Profile Settings')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title"><?php echo e(__('Update Profile')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="editProfileForm" action="<?php echo e(route('admin.update_profile')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label for=""><?php echo e(__('Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <?php if(!empty($adminInfo->image)): ?>
                      <img src="<?php echo e(asset('assets/img/admins/' . $adminInfo->image)); ?>" alt="image" class="uploaded-img">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                    <?php endif; ?>
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="img-input" name="image">
                    </div>
                  </div>
                  <?php if($errors->has('image')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('image')); ?></p>
                  <?php endif; ?>
                  <p class="text-warning mt-2 mb-0"><?php echo e(__('Upload squre size image for best quality.')); ?></p>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Username') . '*'); ?></label>
                  <input type="text" class="form-control" name="username" value="<?php echo e($adminInfo->username); ?>">
                  <?php if($errors->has('username')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('username')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Email') . '*'); ?></label>
                  <input type="email" class="form-control" name="email" value="<?php echo e($adminInfo->email); ?>">
                  <?php if($errors->has('email')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('email')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('First Name') . '*'); ?></label>
                  <input type="text" class="form-control" name="first_name" value="<?php echo e($adminInfo->first_name); ?>">
                  <?php if($errors->has('first_name')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('first_name')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Last Name') . '*'); ?></label>
                  <input type="text" class="form-control" name="last_name" value="<?php echo e($adminInfo->last_name); ?>">
                  <?php if($errors->has('last_name')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('last_name')); ?></p>
                  <?php endif; ?>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="editProfileForm" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\admin\edit-profile.blade.php ENDPATH**/ ?>