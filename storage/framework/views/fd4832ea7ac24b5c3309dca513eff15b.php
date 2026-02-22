<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Edit Service Subcategory')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="ajaxEditForm" class="modal-form"
                    action="<?php echo e(route('admin.service_management.update_subcategory')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="in_id" name="id">

                    <div class="form-group">
                        <label for=""><?php echo e(__('Category') . '*'); ?></label>
                        <select name="service_category_id" class="form-control" id="in_service_category_id">
                            <option disabled><?php echo e(__('Select a Category')); ?></option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <p id="editErr_service_category_id" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('Subcategory Name') . '*'); ?></label>
                        <input type="text" id="in_name" class="form-control" name="name"
                            placeholder="Enter Subcategory Name">
                        <p id="editErr_name" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('Subcategory Status') . '*'); ?></label>
                        <select name="status" id="in_status" class="form-control">
                            <option disabled><?php echo e(__('Select a Status')); ?></option>
                            <option value="1"><?php echo e(__('Active')); ?></option>
                            <option value="0"><?php echo e(__('Deactive')); ?></option>
                        </select>
                        <p id="editErr_status" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('Subcategory Serial Number') . '*'); ?></label>
                        <input type="number" id="in_serial_number" class="form-control ltr" name="serial_number"
                            placeholder="Enter Subcategory Serial Number">
                        <p id="editErr_serial_number" class="mt-2 mb-0 text-danger em"></p>
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
                <button id="updateBtn" type="button" class="btn btn-primary btn-sm">
                    <?php echo e(__('Update')); ?>

                </button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\subcategory\edit.blade.php ENDPATH**/ ?>