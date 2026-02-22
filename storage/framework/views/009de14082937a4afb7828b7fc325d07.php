<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Update Language')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="ajaxEditForm" action="<?php echo e(route('admin.language_management.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="in_id" name="id">

                    <div class="form-group">
                        <label for=""><?php echo e(__('Name') . '*'); ?></label>
                        <input id="in_name" type="text" class="form-control" name="name"
                            placeholder="Enter Language Name">
                        <p id="editErr_name" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('Code') . '*'); ?></label>
                        <input id="in_code" type="text" class="form-control"  name="code"
                            placeholder="Enter Language Code" readonly>
                        <p id="editErr_code" class="mt-2 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('Direction') . '*'); ?></label>
                        <select id="in_direction" name="direction" class="form-control">
                            <option disabled><?php echo e(__('Select a Direction')); ?></option>
                            <option value="0"><?php echo e(__('LTR (Left To Right)')); ?></option>
                            <option value="1"><?php echo e(__('RTL (Right To Left)')); ?></option>
                        </select>
                        <p id="editErr_direction" class="mt-2 mb-0 text-danger em"></p>
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
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\language\edit.blade.php ENDPATH**/ ?>