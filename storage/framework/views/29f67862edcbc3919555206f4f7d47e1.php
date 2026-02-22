  
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Add Keyword')); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form id="ajaxForm2" action="<?php echo e(route('admin.language_management.add_keyword')); ?>"
            method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <label for=""><?php echo e(__('Keyword*')); ?></label>
              <input type="text" class="form-control" name="keyword" placeholder="Enter Keyword">
              <p id="err_keyword" class="mt-1 mb-0 text-danger em"></p>
            </div>
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            <?php echo e(__('Close')); ?>

          </button>
          <button id="submitBtn2" type="button" class="btn btn-primary btn-sm">
            <?php echo e(__('Submit')); ?>

          </button>
        </div>
      </div>
    </div>
  </div>

    
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\language\add-language-keyword.blade.php ENDPATH**/ ?>