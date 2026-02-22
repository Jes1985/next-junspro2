<?php
  use App\Models\Language;
  $selLang = Language::where('code', request()->input('language'))->first();
?>
<?php if(!empty($selLang->language) && $selLang->language->rtl == 1): ?>
  <?php $__env->startSection('styles'); ?>
    <style>
      form input,
      form textarea,
      form select {
        direction: rtl;
      }

      form .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
      }
    </style>
  <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Edit package')); ?></h4>
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
        <a href="#"><?php echo e(__('Packages Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('admin.package.index', ['language' => $defaultLang->code])); ?>"><?php echo e(__('Packages')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Edit package')); ?></div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('admin.package.index')); ?>">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <form id="ajaxForm" class="" action="<?php echo e(route('admin.package.update')); ?>" method="post"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="package_id" value="<?php echo e($package->id); ?>">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="title"><?php echo e(__('Package title')); ?>*</label>
                      <input id="title" type="text" class="form-control" name="title"
                        value="<?php echo e($package->title); ?>" placeholder="<?php echo e(__('Enter name')); ?>">
                      <p id="err_title" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="price"><?php echo e(__('Price')); ?> (<?php echo e($settings->base_currency_text); ?>)*</label>
                      <input id="price" type="number" class="form-control" name="price"
                        placeholder="<?php echo e(__('Enter Package price')); ?>" value="<?php echo e($package->price); ?>">
                      <p class="text-warning">
                        <small><?php echo e(__('If price is 0 , than it will appear as free')); ?></small>
                      </p>
                      <p id="err_price" class="mb-0 text-danger em"></p>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="plan_term"><?php echo e(__('Package term')); ?>*</label>
                      <select id="plan_term" name="term" class="form-control">
                        <option value="" selected disabled><?php echo e(__('Select a Term')); ?></option>
                        <option value="weekly" <?php echo e($package->term == 'weekly' ? 'selected' : ''); ?>>
                          <?php echo e(__('Weekly')); ?>

                        </option>
                        <option value="monthly" <?php echo e($package->term == 'monthly' ? 'selected' : ''); ?>>
                          <?php echo e(__('Monthly')); ?>

                        </option>
                        <option value="yearly" <?php echo e($package->term == 'yearly' ? 'selected' : ''); ?>>
                          <?php echo e(__('Yearly')); ?>

                        </option>
                        <option value="linking" <?php echo e($package->term == 'linking' ? 'selected' : ''); ?>>
                          <?php echo e(__('Linking')); ?>

                        </option>
                        <option value="project" <?php echo e($package->term == 'project' ? 'selected' : ''); ?>>
                          <?php echo e(__('Project')); ?>

                        </option>
                        <option value="lifetime" <?php echo e($package->term == 'lifetime' ? 'selected' : ''); ?>>
                          <?php echo e(__('Lifetime')); ?>

                        </option>
                      </select>
                      <p id="err_term" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label"><?php echo e(__('Number of services add')); ?> *</label>
                      <input type="number" class="form-control" name="number_of_service_add"
                        placeholder="<?php echo e(__('Enter number of services add')); ?>"
                        value="<?php echo e($package->number_of_service_add); ?>">
                      <p id="err_number_of_service_add" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label"><?php echo e(__('Number of featured services')); ?> *</label>
                      <input type="number" name="number_of_service_featured" class="form-control"
                        placeholder="<?php echo e(__('number of featured services')); ?>"
                        value="<?php echo e($package->number_of_service_featured); ?>">
                      <p id="err_number_of_service_featured" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label"><?php echo e(__('Number of forms')); ?> *</label>
                      <input type="number" name="number_of_form_add" class="form-control"
                        placeholder="<?php echo e(__('Enter number of forms')); ?>" value="<?php echo e($package->number_of_form_add); ?>">
                      <p id="err_number_of_form_add" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label"><?php echo e(__('Number of service orders')); ?> *</label>
                      <input type="number" name="number_of_service_order" class="form-control"
                        placeholder="<?php echo e(__('Enter number of service orders')); ?>"
                        value="<?php echo e($package->number_of_service_order); ?>">
                      <p id="err_number_of_service_order" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="status"><?php echo e(__('Live Chat')); ?>*</label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="live_chat_status" value="1" class="selectgroup-input"
                            <?php echo e($package->live_chat_status == 1 ? 'checked' : ''); ?>>
                          <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="live_chat_status"
                            <?php echo e($package->live_chat_status == 0 ? 'checked' : ''); ?> value="0"
                            class="selectgroup-input">
                          <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                        </label>
                      </div>
                      <p id="err_live_chat_status" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="status"><?php echo e(__('QR Builder')); ?>*</label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="qr_builder_status" value="1" class="selectgroup-input"
                            <?php echo e($package->qr_builder_status == 1 ? 'checked' : ''); ?>>
                          <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="qr_builder_status" value="0" class="selectgroup-input"
                            <?php echo e($package->qr_builder_status == 0 ? 'checked' : ''); ?>>
                          <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                        </label>
                      </div>
                      <p id="err_qr_builder_status" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-md-6 <?php echo e($package->qr_builder_status == 0 ? 'd-none' : ''); ?>" id="qr_code_save_limit">
                    <div class="form-group">
                      <label for=""><?php echo e(__('QR Code Save Limit')); ?>*</label>
                      <input type="number" name="qr_code_save_limit" value="<?php echo e($package->qr_code_save_limit); ?>"
                        class="form-control">
                      <p id="err_qr_code_save_limit" class="mb-0 text-danger em"></p>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="status"><?php echo e(__('Recommended')); ?>*</label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="recommended" value="1" class="selectgroup-input"
                            <?php echo e($package->recommended == 1 ? 'checked' : ''); ?>>
                          <span class="selectgroup-button"><?php echo e(__('Yes')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="recommended" value="0" class="selectgroup-input"
                            <?php echo e($package->recommended == 0 ? 'checked' : ''); ?>>
                          <span class="selectgroup-button"><?php echo e(__('No')); ?></span>
                        </label>
                      </div>
                      <p id="err_recommended" class="mb-0 text-danger em"></p>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="status"><?php echo e(__('Status')); ?>*</label>
                      <select id="status" class="form-control ltr" name="status">
                        <option value="" selected disabled><?php echo e(__('Select a status')); ?></option>
                        <option value="1" <?php echo e($package->status == '1' ? 'selected' : ''); ?>>
                          <?php echo e(__('Active')); ?></option>
                        <option value="0" <?php echo e($package->status == '0' ? 'selected' : ''); ?>>
                          <?php echo e(__('Deactive')); ?></option>
                      </select>
                      <p id="err_status" class="mb-0 text-danger em"></p>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label><?php echo e(__('Custom Feature')); ?></label>
                      <textarea name="custom_features" rows="4" class="form-control"><?php echo e($package->custom_features); ?></textarea>
                      <p class="text-warning">
                        <?php echo e(__('each new line will be shown as a new feature in the pricing plan')); ?></p>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success"><?php echo e(__('Update')); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script src="<?php echo e(asset('assets/js/packages.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/edit-package.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\packages\edit.blade.php ENDPATH**/ ?>