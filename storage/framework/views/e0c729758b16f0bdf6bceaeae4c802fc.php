<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
                <a href="#"><?php echo e(__('Language Management')); ?></a>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block"><?php echo e(__('Settings')); ?></div>
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
                            <form id="ajaxForm" action="<?php echo e(route('admin.language_management.settings.update')); ?>"
                                method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label><?php echo e(__('Language Dropdown Status') . '*'); ?></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_language" value="1"
                                                class="selectgroup-input"
                                                <?php echo e($language_settings->is_language == 1 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_language" value="0"
                                                class="selectgroup-input"
                                                <?php echo e($language_settings->is_language == 0 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                                        </label>
                                    </div>
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

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\language\settings.blade.php ENDPATH**/ ?>