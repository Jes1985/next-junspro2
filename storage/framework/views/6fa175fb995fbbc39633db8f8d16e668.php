
<div class="modal fade" id="textModal-<?php echo e($loop->iteration); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo e($label); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <p class="mb-0"><?php echo e($information->value); ?></p>
      </div>

      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\order\show-text.blade.php ENDPATH**/ ?>