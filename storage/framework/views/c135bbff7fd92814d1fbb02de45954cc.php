<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Add Popup')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Announcement Popups')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Add Popup')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">
            <?php echo e(__('Add Popup') . ' (' . __('Type') . ' - ' . $popupType . ')'); ?>

          </div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('admin.announcement_popups.select_popup_type')); ?>">
            <span class="btn-label">
              <i class="fas fa-backward  mdb_12"></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="ajaxForm" class="create" action="<?php echo e(route('admin.announcement_popups.store_popup')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="type" value="<?php echo e($popupType); ?>">

                <div class="form-group">
                  <label for=""><?php echo e(__('Image') . '*'); ?></label>
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

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label><?php echo e(__('Language') . '*'); ?></label>
                      <select name="language_id" class="form-control">
                        <option selected disabled><?php echo e(__('Select a Language')); ?></option>
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($language->id); ?>"><?php echo e($language->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <p id="err_language_id" class="mt-2 mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label><?php echo e(__('Name') . '*'); ?></label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Popup Name">
                      <p id="err_name" class="mt-2 mb-0 text-danger em"></p>
                      <p class="text-warning mt-2 mb-0">
                        <small><?php echo e(__('This name will not appear in UI. Rather then, it will help the admin to identify the popup.')); ?></small>
                      </p>
                    </div>
                  </div>
                </div>

                <?php if($popupType == 2 || $popupType == 3 || $popupType == 7): ?>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label><?php echo e(__('Background Color Code') . '*'); ?></label>
                        <input class="jscolor form-control ltr" name="background_color">
                        <p id="err_background_color" class="mt-2 mb-0 text-danger em"></p>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if($popupType == 2 || $popupType == 3): ?>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label><?php echo e(__('Background Color Opacity') . '*'); ?></label>
                        <input type="number" class="form-control ltr" step="0.01" name="background_color_opacity">
                        <p id="err_background_color_opacity" class="mt-2 mb-0 text-danger em"></p>
                        <p class="mt-2 mb-0 text-warning">
                          <?php echo e(__('This will decide the transparency level of the color.')); ?><br>
                          <?php echo e(__('Value must be between 0 to 1.')); ?><br>
                          <?php echo e(__('Transparency level will be lower with the increment of the value.')); ?>

                        </p>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if($popupType == 2 || $popupType == 3 || $popupType == 4 || $popupType == 5 || $popupType == 6 || $popupType == 7): ?>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label><?php echo e(__('Title') . '*'); ?></label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Popup Title">
                        <p id="err_title" class="mt-2 mb-0 text-danger em"></p>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label><?php echo e(__('Text') . '*'); ?></label>
                        <textarea class="form-control" name="text" placeholder="Enter Popup Text" rows="5"></textarea>
                        <p id="err_text" class="mt-2 mb-0 text-danger em"></p>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label><?php echo e(__('Button Text') . '*'); ?></label>
                        <input type="text" class="form-control" name="button_text" placeholder="Enter Button Text">
                        <p id="err_button_text" class="mt-2 mb-0 text-danger em"></p>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label><?php echo e(__('Button Color Code') . '*'); ?></label>
                        <input class="jscolor form-control ltr" name="button_color">
                        <p id="err_button_color" class="mt-2 mb-0 text-danger em"></p>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if($popupType == 2 || $popupType == 4 || $popupType == 6 || $popupType == 7): ?>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label><?php echo e(__('Button URL') . '*'); ?></label>
                        <input type="url" class="form-control ltr" name="button_url" placeholder="Enter Button URL">
                        <p id="err_button_url" class="mt-2 mb-0 text-danger em"></p>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if($popupType == 6 || $popupType == 7): ?>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label><?php echo e(__('End Date') . '*'); ?></label>
                        <input type="text" class="form-control datepicker ltr" name="end_date" placeholder="Enter End Date" readonly autocomplete="off">
                        <p id="err_end_date" class="mt-2 mb-0 text-danger em"></p>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label><?php echo e(__('End Time') . '*'); ?></label>
                        <input type="text" class="form-control timepicker ltr" name="end_time" placeholder="Enter End Time" readonly autocomplete="off">
                        <p id="err_end_time" class="mt-2 mb-0 text-danger em"></p>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label><?php echo e(__('Delay') . ' (' . __('milliseconds') . ')*'); ?></label>
                      <input type="number" class="form-control ltr" name="delay" placeholder="Enter Popup Delay">
                      <p id="err_delay" class="mt-2 mb-0 text-danger em"></p>
                      <p class="text-warning mt-2 mb-0">
                        <small><?php echo e(__('Popup will appear in UI after this delay time.')); ?></small>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label><?php echo e(__('Serial Number') . '*'); ?></label>
                      <input type="number" class="form-control ltr" name="serial_number" placeholder="Enter Serial Number">
                      <p id="err_serial_number" class="mt-2 mb-0 text-danger em"></p>
                      <p class="mt-2 mb-0 text-warning">
                        <?php echo e(__('If there are multiple active popups, then popups will be shown in UI according to serial number.')); ?><br>
                        <?php echo e(__('The higher the serial number is, the later the Popup will be shown.')); ?>

                      </p>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-success" id="submitBtn">
                <?php echo e(__('Save')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\popup\create.blade.php ENDPATH**/ ?>