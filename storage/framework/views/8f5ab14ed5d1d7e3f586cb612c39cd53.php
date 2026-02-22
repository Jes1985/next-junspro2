<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Popular Tags')); ?></h4>
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
        <a href="#"><?php echo e(__('Service Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Popular Tags')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Popular Tags')); ?></div>
            </div>

            <div class="col-lg-3">
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">

            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" action="<?php echo e(route('admin.service_management.popular_tags.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                  <label for=""><?php echo e(__('Language **')); ?></label>
                  <?php if(!empty($langs)): ?>
                    <select name="language_id" class="form-control"
                      onchange="window.location='<?php echo e(url()->current() . '?language='); ?>'+this.value">
                      <option value="" selected disabled><?php echo e(__('Select a Language')); ?></option>
                      <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lang->code); ?>"
                          <?php echo e($lang->code == request()->input('language') ? 'selected' : ''); ?>>
                          <?php echo e($lang->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  <?php endif; ?>
                  <p id="err_language_id" class="mb-0 text-danger em"></p>
                </div>

                <div class="form-group">
                  <label for=""><?php echo e(__('Popular Tags **')); ?></label>
                  <input type="text" class="form-control" name="popular_tags" value="<?php echo e($data->popular_tags); ?>"
                    data-role="tagsinput" placeholder="Popular Tags">
                  <p id="err_popular_tags" class="mb-0 text-danger em"></p>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success"><?php echo e(__('Update')); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\service\popular-tags.blade.php ENDPATH**/ ?>