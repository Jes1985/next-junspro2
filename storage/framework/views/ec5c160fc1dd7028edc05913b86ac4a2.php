
<div class="modal fade" id="receiptModal-<?php echo e($order->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Payment Receipt')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <img src="<?php echo e(asset('assets/img/attachments/service/' . $order->receipt)); ?>" alt="receipt" width="100%">
      </div>

      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\order\show-receipt.blade.php ENDPATH**/ ?>