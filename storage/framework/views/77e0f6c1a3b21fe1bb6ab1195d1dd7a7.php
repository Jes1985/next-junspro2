<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Add Language')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxForm" action="<?php echo e(route('admin.language_management.store')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="form-group">
            <label for=""><?php echo e(__('Name') . '*'); ?></label>
            <input type="text" class="form-control" name="name" placeholder="Enter Language Name">
            <p id="err_name" class="mt-2 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Code') . '*'); ?></label>
            <input type="text" class="form-control" name="code" placeholder="Enter Language Code">
            <p id="err_code" class="mt-2 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Direction') . '*'); ?></label>
            <select name="direction" class="form-control">
              <option selected disabled><?php echo e(__('Select a Direction')); ?></option>
              <option value="0"><?php echo e(__('LTR (Left To Right)')); ?></option>
              <option value="1"><?php echo e(__('RTL (Right To Left)')); ?></option>
            </select>
            <p id="err_direction" class="mt-2 mb-0 text-danger em"></p>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
          <?php echo e(__('Close')); ?>

        </button>
        <button id="submitBtn" type="button" class="btn btn-primary btn-sm">
          <?php echo e(__('Submit')); ?>

        </button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\language\create.blade.php ENDPATH**/ ?>