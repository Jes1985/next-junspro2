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
        <a href="#"><?php echo e(__('Sellers Management')); ?></a>
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
    <div class="col-md-12 mx-auto">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title"><?php echo e(__('Settings')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 mx-auto">
              <form id="ajaxEditForm" action="<?php echo e(route('admin.seller_management.setting.update')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <div class="custom-control custom-checkbox seller_admin_approvalbtn">
                        <input type="checkbox" <?php echo e($setting->seller_admin_approval == 1 ? 'checked' : ''); ?>

                          name="seller_admin_approval" class="custom-control-input" id="seller_admin_approval">
                        <label class="custom-control-label"
                          for="seller_admin_approval"><?php echo e(__('Needs Admin Approval')); ?></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" <?php echo e($setting->seller_email_verification == 1 ? 'checked' : ''); ?>

                          name="seller_email_verification" class="custom-control-input" id="customCheck2">
                        <label class="custom-control-label" for="customCheck2"><?php echo e(__('Email Verificaiton')); ?></label>
                      </div>
                    </div>
                  </div>
                  <div
                    class="col-lg-12 <?php echo e($setting->seller_admin_approval == 0 ? 'd-none' : ''); ?> admin_approval_notice">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Admin Approval Notice')); ?></label>
                      <textarea id="" rows="4" name="admin_approval_notice" class="form-control"><?php echo e($setting->admin_approval_notice); ?></textarea>
                      <p class="text-warning"><?php echo e(__('This text will be visible in seller Dashboard')); ?></p>
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
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\seller\settings.blade.php ENDPATH**/ ?>