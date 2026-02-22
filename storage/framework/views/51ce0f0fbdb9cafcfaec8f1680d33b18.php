<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Add Admin')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxForm" class="modal-form" action="<?php echo e(route('admin.admin_management.store_admin')); ?>" method="POST" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="form-group">
            <label for=""><?php echo e(__('Image') . '*'); ?></label>
            <br>
            <div class="thumb-preview">
              <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
            </div>

            <div class="mt-3">
              <div role="button" class="btn btn-primary btn-sm upload-btn">
                <?php echo e(__('Choose Image')); ?>

                <input type="file" class="img-input" name="image">
              </div>
            </div>
            <p class="mt-2 mb-0 text-danger" id="err_image"></p>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for=""><?php echo e(__('Role') . '*'); ?></label>
                <select name="role_id" class="form-control">
                  <option selected disabled><?php echo e(__('Select a Role')); ?></option>
                  <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <p id="err_role_id" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="row no-gutters">
            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Username') . '*'); ?></label>
                <input type="text" class="form-control" name="username" placeholder="Enter Username">
                <p id="err_username" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Email') . '*'); ?></label>
                <input type="email" class="form-control" name="email" placeholder="Enter Email">
                <p id="err_email" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="row no-gutters">
            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('First Name') . '*'); ?></label>
                <input type="text" class="form-control" name="first_name" placeholder="Enter First Name">
                <p id="err_first_name" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Last Name') . '*'); ?></label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name">
                <p id="err_last_name" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="row no-gutters">
            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Password') . '*'); ?></label>
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
                <p id="err_password" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Confirm Password') . '*'); ?></label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Re-Enter Password">
                <p id="err_password_confirmation" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
          <?php echo e(__('Close')); ?>

        </button>
        <button id="submitBtn" type="button" class="btn btn-primary btn-sm">
          <?php echo e(__('Save')); ?>

        </button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\administrator\site-admin\create.blade.php ENDPATH**/ ?>