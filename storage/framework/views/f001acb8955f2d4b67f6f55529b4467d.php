<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Edit Testimonial')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxEditForm" class="modal-form" action="<?php echo e(route('admin.home_page.update_testimonial')); ?>" method="post" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="id" id="in_id">

          <div class="form-group">
            <label for=""><?php echo e(__('Client Image') . '*'); ?></label>
            <br>
            <div class="thumb-preview">
              <img src="" alt="..." class="uploaded-img in_image">
            </div>

            <div class="mt-3">
              <div role="button" class="btn btn-primary btn-sm upload-btn">
                <?php echo e(__('Choose Image')); ?>

                <input type="file" class="img-input" name="image">
              </div>
            </div>
            <p id="editErr_image" class="mt-2 mb-0 text-danger em"></p>
          </div>

          <div class="row no-gutters">
            <div class="col-md-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Name') . '*'); ?></label>
                <input type="text" class="form-control" name="name" placeholder="Enter Client Name" id="in_name">
                <p id="editErr_name" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Occupation') . '*'); ?></label>
                <input type="text" class="form-control" name="occupation" placeholder="Enter Client Occupation" id="in_occupation">
                <p id="editErr_occupation" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Comment') . '*'); ?></label>
            <textarea class="form-control" name="comment" placeholder="Enter Client Comment" rows="4" id="in_comment"></textarea>
            <p id="editErr_comment" class="mt-2 mb-0 text-danger em"></p>
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
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\home-page\testimonial-section\edit.blade.php ENDPATH**/ ?>