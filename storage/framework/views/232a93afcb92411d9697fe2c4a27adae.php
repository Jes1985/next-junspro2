<div class="modal fade" id="<?php echo e('assignModal-' . $ticket->id); ?>" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignModalLabel"><?php echo e(__('Assign Admin')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxForm" class="modal-form" action="<?php echo e(route('admin.support_ticket.assign_admin', ['id' => $ticket->id])); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="form-group">
            <label><?php echo e(__('Admin') . '*'); ?></label>
            <select name="admin_id" class="form-control">
              <option disabled><?php echo e(__('Select an Admin')); ?></option>

              <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($admin->id); ?>" <?php echo e($admin->id == $ticket->admin_id ? 'selected' : ''); ?>>
                  <?php echo e($admin->first_name . ' ' . $admin->last_name . ' (username - ' . $admin->username . ')'); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p id="err_admin_id" class="mt-2 mb-0 text-danger em"></p>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" id="submitBtn">
          <?php echo e(__('Assign')); ?>

        </button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\support-ticket\assign-admin.blade.php ENDPATH**/ ?>