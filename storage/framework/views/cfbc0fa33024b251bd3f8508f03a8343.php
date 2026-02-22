<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Footer Content')); ?></h4>
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
        <a href="#"><?php echo e(__('Footer')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Footer Content')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-10">
              <div class="card-title"><?php echo e(__('Update Footer Content')); ?></div>
            </div>

            <div class="col-lg-2">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" action="<?php echo e(route('admin.footer.update_content', ['language' => request()->input('language')])); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label><?php echo e(__('Footer Background Color') . '*'); ?></label>
                  <input class="jscolor form-control ltr" name="footer_background_color" value="<?php echo e(!is_null($data) ? $data->footer_background_color : ''); ?>">
                  <p id="err_footer_background_color" class="em text-danger mt-2 mb-0"></p>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('About Company') . '*'); ?></label>
                  <textarea class="form-control" name="about_company" rows="5" cols="80"><?php echo e(!is_null($data) ? $data->about_company : ''); ?></textarea>
                  <p id="err_about_company" class="em text-danger mt-2 mb-0"></p>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Copyright Text') . '*'); ?></label>
                  <textarea class="form-control" name="copyright_text" rows="3"><?php echo e(!is_null($data) ? $data->copyright_text : ''); ?></textarea>
                  <p id="err_copyright_text" class="em text-danger mt-2 mb-0"></p>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="submitBtn" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\footer\content.blade.php ENDPATH**/ ?>