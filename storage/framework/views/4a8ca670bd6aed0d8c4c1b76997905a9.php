<div class="modal fade" id="<?php echo e('emailModal-' . $order->id); ?>" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <form id="#ajaxForm<?php echo e($order->id); ?>" class="modal-form"
        action="<?php echo e(route('admin.service_order.sendmail', ['id' => $order->id])); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="modal-header">
          <h5 class="modal-title" id="emailModalLabel"><?php echo e(__('Send Mail')); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label><?php echo e(__('Subject') . '*'); ?></label>
            <input type="text" class="form-control" name="subject" required>
            <p id="err_subject" class="mt-2 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label><?php echo e(__('Message')); ?></label>
            <textarea class="form-control summernote" name="message" data-height="300"></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="#submitBtn<?php echo e($order->id); ?>">
            <?php echo e(__('Send')); ?>

          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\order\send-mail.blade.php ENDPATH**/ ?>