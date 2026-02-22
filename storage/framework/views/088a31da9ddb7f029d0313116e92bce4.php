<div class="modal fade" id="textAreaModal-<?php echo e($key); ?>" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo e($label); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <p class="text-center"><?php echo e($information->value); ?></p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-primary radius-sm" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\textarea-data.blade.php ENDPATH**/ ?>