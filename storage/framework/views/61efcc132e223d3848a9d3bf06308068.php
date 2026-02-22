<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(__('Website Appearance')); ?></h4>
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
                <a href="#"><?php echo e(__('Website Appearance')); ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="<?php echo e(route('admin.basic_settings.update_appearance')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="card-title"><?php echo e(__('Update Website Appearance')); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <div class="form-group">
                                    <label><?php echo e(__('Primary Color') . '*'); ?></label>
                                    <input class="jscolor form-control" name="primary_color"
                                        value="<?php echo e(!empty($data) ? $data->primary_color : ''); ?>">
                                    <?php if($errors->has('primary_color')): ?>
                                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('primary_color')); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Secondary Color') . '*'); ?></label>
                                    <input class="jscolor form-control ltr" name="secondary_color"
                                        value="<?php echo e(!empty($data) ? $data->secondary_color : ''); ?>">
                                    <?php if($errors->has('secondary_color')): ?>
                                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('secondary_color')); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Breadcrumb Section Overlay Color') . '*'); ?></label>
                                    <input class="jscolor form-control ltr" name="breadcrumb_overlay_color"
                                        value="<?php echo e(!empty($data) ? $data->breadcrumb_overlay_color : ''); ?>">
                                    <?php if($errors->has('breadcrumb_overlay_color')): ?>
                                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('breadcrumb_overlay_color')); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(__('Breadcrumb Section Overlay Opacity') . '*'); ?></label>
                                    <input class="form-control ltr" type="number" step="0.01" name="breadcrumb_overlay_opacity" value="<?php echo e($data->breadcrumb_overlay_opacity); ?>">
                                    <?php if($errors->has('breadcrumb_overlay_opacity')): ?>
                                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('breadcrumb_overlay_opacity')); ?></p>
                                    <?php endif; ?>
                                    <p class="mt-2 mb-0 text-warning"><?php echo e(__('This will decide the transparency level of the overlay color.')); ?><br>
                                      <?php echo e(__('Value must be between 0 to 1.')); ?><br>
                                      <?php echo e(__('Transparency level will be lower with the increment of the value.')); ?>

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

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\basic-settings\appearance.blade.php ENDPATH**/ ?>