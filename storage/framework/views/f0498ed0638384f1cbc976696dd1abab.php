<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Edit Customer')); ?></h4>
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
        <a href="#"><?php echo e(__('Customers Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('admin.user_management.registered_users')); ?>"><?php echo e(__('Registered Customers')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Customer')); ?></a>
      </li>
    </ul>
    <a href="<?php echo e(route('admin.user_management.registered_users')); ?>"
      class="btn btn-primary ml-auto"><?php echo e(__('Back')); ?></a>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title"><?php echo e(__('Edit Customer')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <form id="ajaxEditForm" action="<?php echo e(route('admin.user_management.user.update', ['id' => $user->id])); ?>"
                method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <h2><?php echo e(__('Details')); ?></h2>
                <hr>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Photo')); ?></label>
                      <br>
                      <div class="thumb-preview">
                        <?php if(!empty($user->image)): ?>
                          <img src="<?php echo e(asset('assets/img/users/' . $user->image)); ?>" alt="..." class="uploaded-img">
                        <?php else: ?>
                          <img src="<?php echo e(asset('assets/img/profile.jpg')); ?>" alt="..." class="uploaded-img">
                        <?php endif; ?>
                      </div>

                      <div class="mt-3">
                        <div role="button" class="btn btn-primary btn-sm upload-btn">
                          <?php echo e(__('Choose Photo')); ?>

                          <input type="file" class="img-input" name="image">
                        </div>
                        <p id="editErr_image" class="mt-1 mb-0 text-danger em"></p>
                        <p class="mt-2 mb-0 text-warning"><?php echo e(__('Image Size 80x80')); ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('First Name*')); ?></label>
                      <input type="text" value="<?php echo e($user->first_name); ?>" class="form-control" name="first_name">
                      <p id="editErr_first_name" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Last Name*')); ?></label>
                      <input type="text" value="<?php echo e($user->last_name); ?>" class="form-control" name="last_name">
                      <p id="editErr_last_name" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Username*')); ?></label>
                      <input type="text" value="<?php echo e($user->username); ?>" class="form-control" name="username">
                      <p id="editErr_username" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Email*')); ?></label>
                      <input type="text" value="<?php echo e($user->email_address); ?>" class="form-control" name="email_address">
                      <p id="editErr_email_address" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Phone *')); ?></label>
                      <input type="tel" value="<?php echo e($user->phone_number); ?>" class="form-control" name="phone_number">
                      <p id="editErr_phone_number" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('City *')); ?></label>
                      <input type="text" value="<?php echo e($user->city); ?>" class="form-control" name="city">
                      <p id="editErr_city" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('State')); ?></label>
                      <input type="text" value="<?php echo e($user->state); ?>" class="form-control" name="state">
                      <p id="editErr_state" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Country *')); ?></label>
                      <input type="text" value="<?php echo e($user->country); ?>" class="form-control" name="country">
                      <p id="editErr_country" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Address *')); ?></label>
                      <input type="text" value="<?php echo e($user->address); ?>" class="form-control" name="address">
                      <p id="editErr_address" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="updateBtn" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\user\edit.blade.php ENDPATH**/ ?>