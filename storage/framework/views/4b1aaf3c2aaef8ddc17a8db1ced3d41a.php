<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Add Service Subcategory')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="ajaxForm" class="modal-form create"
                    action="<?php echo e(route('admin.service_management.store_subcategory')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for=""><?php echo e(__('Language') . '*'); ?></label>
                        <select name="language_id" class="form-control">
                            <option selected disabled><?php echo e(__('Select a Language')); ?></option>
                            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lang->id); ?>"><?php echo e($lang->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <p id="err_language_id" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('Category') . '*'); ?></label>
                        <select name="service_category_id" class="form-control">
                            <option selected disabled><?php echo e(__('Select a Category')); ?></option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" class="service-category"><?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <p id="err_service_category_id" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('Subcategory Name') . '*'); ?></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Subcategory Name">
                        <p id="err_name" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('Subcategory Status') . '*'); ?></label>
                        <select name="status" class="form-control">
                            <option selected disabled><?php echo e(__('Select a Status')); ?></option>
                            <option value="1"><?php echo e(__('Active')); ?></option>
                            <option value="0"><?php echo e(__('Deactive')); ?></option>
                        </select>
                        <p id="err_status" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('Subcategory Serial Number') . '*'); ?></label>
                        <input type="number" class="form-control ltr" name="serial_number"
                            placeholder="Enter Subcategory Serial Number">
                        <p id="err_serial_number" class="mt-2 mb-0 text-danger em"></p>
                        <p class="text-warning mt-2 mb-0">
                            <small><?php echo e(__('The higher the serial number is, the later the subcategory will be shown.')); ?></small>
                        </p>
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
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\subcategory\create.blade.php ENDPATH**/ ?>