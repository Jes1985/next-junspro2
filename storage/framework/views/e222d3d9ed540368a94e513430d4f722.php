<?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="modal fade" id="withdrawModal<?php echo e($item->id); ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Withdraw Information')); ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="text-left">
            <p><strong><?php echo e(__('Payable Amount') . ' : '); ?>

                <?php echo e($currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : ''); ?>

                <?php echo e(round($item->payable_amount, 2)); ?>

                <?php echo e($currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : ''); ?></strong>
            </p>
          </div>
          <?php
            $d_feilds = json_decode($item->feilds, true);
          ?>
          <?php $__currentLoopData = $d_feilds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $d_feild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="text-left">
              <p><strong><?php echo e(str_replace('_', ' ', $key)); ?> : <?php echo e($d_feild); ?></strong></p>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <div class="text-left">
            <p><strong><?php echo e(__('Additional Reference ') . ' : '); ?>

                <?php echo e($item->additional_reference); ?></strong>
            </p>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            <?php echo e(__('Close')); ?>

          </button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\withdraw\history\view.blade.php ENDPATH**/ ?>