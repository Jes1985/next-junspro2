<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Add Testimonial')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxForm" class="modal-form create" action="<?php echo e(route('admin.home_page.store_testimonial', ['language' => request()->input('language')])); ?>" method="post" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="form-group">
            <label for=""><?php echo e(__('Language') . '*'); ?></label>
            <select name="language_id" class="form-control">
              <option selected disabled><?php echo e(__('Select a Language')); ?></option>
              <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($lang->id); ?>"><?php echo e($lang->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p id="err_language_id" class="mt-2 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Client Image') . '*'); ?></label>
            <br>
            <div class="thumb-preview">
              <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
            </div>

            <div class="mt-3">
              <div role="button" class="btn btn-primary btn-sm upload-btn">
                <?php echo e(__('Choose Image')); ?>

                <input type="file" class="img-input" name="image">
              </div>
            </div>
            <p id="err_image" class="mt-2 mb-0 text-danger em"></p>
          </div>

          <div class="row no-gutters">
            <div class="col-md-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Name') . '*'); ?></label>
                <input type="text" class="form-control" name="name" placeholder="Enter Client Name">
                <p id="err_name" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for=""><?php echo e(__('Occupation') . '*'); ?></label>
                <input type="text" class="form-control" name="occupation" placeholder="Enter Client Occupation">
                <p id="err_occupation" class="mt-2 mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Comment') . '*'); ?></label>
            <textarea class="form-control" name="comment" placeholder="Enter Client Comment" rows="4"></textarea>
            <p id="err_comment" class="mt-2 mb-0 text-danger em"></p>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
          <?php echo e(__('Close')); ?>

        </button>
        <button id="submitBtn" type="button" class="btn btn-primary btn-sm">
          <?php echo e(__('Save')); ?>

        </button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\home-page\testimonial-section\create.blade.php ENDPATH**/ ?>