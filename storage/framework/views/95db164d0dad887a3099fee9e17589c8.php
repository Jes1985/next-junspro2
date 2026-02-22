<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Edit Service Category')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="ajaxEditForm" class="modal-form"
                    action="<?php echo e(route('admin.service_management.update_category')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="in_id" name="id">

                    <div class="form-group">
                        <label for=""><?php echo e(__('Image') . '*'); ?></label>
                        <br>
                        <div class="thumb-preview">
                            <img src="" alt="..." class="uploaded-img in_image">
                        </div>

                        <div class="mt-3">
                            <div role="button" class="btn btn-primary btn-sm upload-btn">
                                <?php echo e(__('Choose Image')); ?>

                                <input type="file" class="img-input" name="image">
                            </div>
                        </div>
                        <p id="editErr_image" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('Category Name') . '*'); ?></label>
                        <input type="text" id="in_name" class="form-control" name="name"
                            placeholder="Enter Name">
                        <p id="editErr_name" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><?php echo e(__('Category Status') . '*'); ?></label>
                                <select name="status" id="in_status" class="form-control">
                                    <option disabled><?php echo e(__('Select a Status')); ?></option>
                                    <option value="1"><?php echo e(__('Active')); ?></option>
                                    <option value="0"><?php echo e(__('Deactive')); ?></option>
                                </select>
                                <p id="editErr_status" class="mt-2 mb-0 text-danger em"></p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><?php echo e(__('Category Serial Number') . '*'); ?></label>
                                <input type="number" id="in_serial_number" class="form-control ltr"
                                    name="serial_number" placeholder="Enter Serial Number">
                                <p id="editErr_serial_number" class="mt-2 mb-0 text-danger em"></p>
                            </div>
                        </div>

                        <p class="text-warning ml-2 mb-1">
                            <small><?php echo e('*' . __('The higher the serial number is, the later the category will be shown.')); ?></small>
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
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\category\edit.blade.php ENDPATH**/ ?>