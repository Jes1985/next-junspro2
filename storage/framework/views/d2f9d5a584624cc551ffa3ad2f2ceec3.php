<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Edit Payment Method')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">


        <form id="ajaxEditForm" class="modal-form create" action="<?php echo e(route('admin.withdraw_payment_method.update')); ?>"
          method="post" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <input type="hidden" id="in_id" name="id">
          <div class="form-group">
            <label for=""><?php echo e(__('Name') . '*'); ?></label>
            <input type="text" id="in_name" class="form-control" name="name" placeholder="Enter Method Name">
            <p id="editErr_name" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Minimum Limit') . '*'); ?></label>
            <input type="number" id="in_min_limit" class="form-control" name="min_limit"
              placeholder="Enter Withdraw Minimum Limit">
            <p id="editErr_min_limit" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Maximum Limit') . '*'); ?></label>
            <input type="number" id="in_max_limit" class="form-control" name="max_limit"
              placeholder="Enter Withdraw Maximum Limit">
            <p id="editErr_max_limit" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Fixed Charge')); ?></label>
            <input type="number" class="form-control" value="0.00" id="in_fixed_charge" name="fixed_charge"
              placeholder="Enter Fixed Charge">
            <p id="editErr_fixed_charge" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Percentage Charge')); ?></label>
            <input type="number" class="form-control"value="0.00" id="in_percentage_charge" name="percentage_charge"
              placeholder="Enter Percentage Charge">
            <p id="editErr_percentage_charge" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Status') . '*'); ?></label>
            <select id="in_status" name="status" class="form-control">
              <option selected disabled><?php echo e(__('Select a Status')); ?></option>
              <option value="1"><?php echo e(__('Active')); ?></option>
              <option value="0"><?php echo e(__('Deactive')); ?></option>
            </select>
            <p id="editErr_status" class="mt-1 mb-0 text-danger em"></p>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
          <?php echo e(__('Close')); ?>

        </button>
        <button id="updateBtn" type="button" class="btn btn-sm btn-primary">
          <?php echo e(__('Update')); ?>

        </button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\withdraw\edit.blade.php ENDPATH**/ ?>