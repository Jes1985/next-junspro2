<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Customer Details')); ?></h4>
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
        <a href="#"><?php echo e(__('Customer Details')); ?></a>
      </li>
    </ul>
    <a href="<?php echo e(route('admin.user_management.registered_users')); ?>" class="btn btn-primary ml-auto"><?php echo e(__('Back')); ?></a>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-header">
              <div class="h4 card-title"><?php echo e(__('Profile Picture')); ?></div>
            </div>

            <div class="card-body text-center py-4">
              <img
                src="<?php echo e(empty($userInfo->image) ? asset('assets/img/profile.jpg') : asset('assets/img/users/' . $userInfo->image)); ?>"
                alt="image" width="150">
            </div>
          </div>
        </div>

        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              <div class="card-title"><?php echo e(__('Customer Information')); ?></div>
            </div>

            <div class="card-body">
              <div class="user-information">
                <div class="row mb-2">
                  <div class="col-lg-2">
                    <strong><?php echo e(__('Name') . ' :'); ?></strong>
                  </div>

                  <div class="col-lg-10">
                    <?php echo e($userInfo->first_name . ' ' . $userInfo->last_name); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-2">
                    <strong><?php echo e(__('Username') . ' :'); ?></strong>
                  </div>

                  <div class="col-lg-10">
                    <?php echo e($userInfo->username); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-2">
                    <strong><?php echo e(__('Email') . ' :'); ?></strong>
                  </div>

                  <div class="col-lg-10">
                    <?php echo e($userInfo->email_address); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-2">
                    <strong><?php echo e(__('Phone') . ' :'); ?></strong>
                  </div>

                  <div class="col-lg-10">
                    <?php echo e($userInfo->phone_number); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-2">
                    <strong><?php echo e(__('Address') . ' :'); ?></strong>
                  </div>

                  <div class="col-lg-10">
                    <?php echo e($userInfo->address); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-2">
                    <strong><?php echo e(__('City') . ' :'); ?></strong>
                  </div>

                  <div class="col-lg-10">
                    <?php echo e($userInfo->city); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-2">
                    <strong><?php echo e(__('State') . ' :'); ?></strong>
                  </div>

                  <div class="col-lg-10">
                    <?php echo e($userInfo->state); ?>

                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-2">
                    <strong><?php echo e(__('Country') . ' :'); ?></strong>
                  </div>

                  <div class="col-lg-10">
                    <?php echo e($userInfo->country); ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\user\details.blade.php ENDPATH**/ ?>