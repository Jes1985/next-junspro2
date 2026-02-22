<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Edit Advertisement')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxEditForm" class="modal-form" action="<?php echo e(route('admin.advertise.update_advertisement')); ?>" method="post" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <input type="hidden" id="in_id" name="id">

          <div class="form-group">
            <label for=""><?php echo e(__('Advertisement Type') . '*'); ?></label>
            <select name="ad_type" class="form-control edit-ad-type" id="in_ad_type">
              <option disabled><?php echo e(__('Select a Type')); ?></option>
              <option value="banner"><?php echo e(__('Banner')); ?></option>
              <option value="adsense"><?php echo e(__('Google AdSense')); ?></option>
            </select>
            <p id="editErr_ad_type" class="mt-2 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Advertisement Resolution') . '*'); ?></label>
            <select name="resolution_type" class="form-control" id="in_resolution_type">
              <option disabled><?php echo e(__('Select a Resolution')); ?></option>
              <option value="1">300 x 250</option>
              <option value="4">370 x 250</option>
              <option value="5">370 x 600</option>
              <option value="2">300 x 600</option>
              <option value="3">728 x 90</option>
            </select>
            <p id="editErr_resolution_type" class="mt-2 mb-0 text-danger em"></p>
          </div>

          <div class="form-group d-none" id="edit-image-input">
            <label for=""><?php echo e(__('Image') . '*'); ?></label>
            <br>
            <div class="thumb-preview">
              <img src="" alt="advertisement image" class="in_image uploaded-img">
            </div>

            <div class="mt-3">
              <div role="button" class="btn btn-primary btn-sm upload-btn">
                <?php echo e(__('Choose Image')); ?>

                <input type="file" class="img-input" name="image">
              </div>
            </div>
            <p class="mt-2 mb-0 text-danger em" id="editErr_image"></p>
          </div>

          <div class="form-group d-none" id="edit-url-input">
            <label for=""><?php echo e(__('Redirect URL') . '*'); ?></label>
            <input type="url" class="form-control" name="url" placeholder="Enter Redirect URL" id="in_url">
            <p id="editErr_url" class="mt-2 mb-0 text-danger em"></p>
          </div>

          <div class="form-group d-none" id="edit-slot-input">
            <label for=""><?php echo e(__('Ad Slot') . '*'); ?></label>
            <input type="text" class="form-control" name="slot" placeholder="Enter Ad Slot" id="in_slot">
            <p id="editErr_slot" class="mt-2 mb-0 text-danger em"></p>
            <p class="mt-2 mb-0">
              <a href="https://prnt.sc/1uwa420" target="_blank" class="redirect-link"><?php echo e(__('Click Here')); ?></a> <?php echo e(__('to see where you can find the ad slot') . '.'); ?>

            </p>
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
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\advertisement\edit.blade.php ENDPATH**/ ?>