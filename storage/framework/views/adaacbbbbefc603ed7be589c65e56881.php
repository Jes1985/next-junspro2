<?php
  use App\Models\Language;
  $selLang = Language::where('code', request()->input('language'))->first();
?>
<?php if(!empty($selLang) && $selLang->rtl == 1): ?>
  <?php $__env->startSection('styles'); ?>
    <style>
      form:not(.modal-form) input,
      form:not(.modal-form) textarea,
      form:not(.modal-form) select,
      select[name='language'] {
        direction: rtl;
      }

      form:not(.modal-form) .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
      }
    </style>
  <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Packages')); ?></h4>
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
        <a href="#"><?php echo e(__('Packages')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Package Page')); ?></div>
            </div>
            <div class="col-lg-4 offset-lg-4 mt-2 mt-lg-0">
              <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal"
                data-target="#createModal"><i class="fas fa-plus"></i>
                <?php echo e(__('Add Package')); ?></a>
              <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete"
                data-href="<?php echo e(route('admin.package.bulk.delete')); ?>"><i class="flaticon-interface-5"></i>
                <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($packages) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO PACKAGE FOUND YET')); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Title')); ?></th>
                        <th scope="col"><?php echo e(__('Cost')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($package->id); ?>">
                          </td>
                          <td>
                            <strong><?php echo e(strlen($package->title) > 30 ? mb_substr($package->title, 0, 30, 'UTF-8') . '...' : $package->title); ?></strong>
                            <?php if($package->term == 'monthly'): ?>
                              <small class="badge badge-primary"><?php echo e(__('Monthly')); ?></small>
                            <?php elseif($package->term == 'yearly'): ?>
                              <small class="badge badge-info"><?php echo e(__('Yearly')); ?></small>
                            <?php elseif($package->term == 'lifetime'): ?>
                              <small class="badge badge-secondary"><?php echo e(__('Lifetime')); ?></small>
                            <?php endif; ?>


                          </td>
                          <td>
                            <?php if($package->price == 0): ?>
                              <?php echo e(__('Free')); ?>

                            <?php else: ?>
                              <?php echo e(format_price($package->price)); ?>

                            <?php endif; ?>

                          </td>
                          <td>
                            <?php if($package->status == 1): ?>
                              <h2 class="d-inline-block">
                                <span class="badge badge-success"><?php echo e(__('Active')); ?></span>
                              </h2>
                            <?php else: ?>
                              <h2 class="d-inline-block">
                                <span class="badge badge-danger"><?php echo e(__('Deactive')); ?></span>
                              </h2>
                            <?php endif; ?>
                          </td>
                          <td>
                            <a class="btn btn-secondary btn-sm mt-1"
                              href="<?php echo e(route('admin.package.edit', $package->id) . '?language=' . request()->input('language')); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                            </a>
                            <form class="packageDeleteForm d-inline-block" action="<?php echo e(route('admin.package.delete')); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="package_id" value="<?php echo e($package->id); ?>">
                              <button type="submit" class="btn btn-danger btn-sm  mt-1 packageDeleteBtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Create Blog Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Add Package')); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="ajaxForm" enctype="multipart/form-data" class="modal-form"
            action="<?php echo e(route('admin.package.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title"><?php echo e(__('Package title')); ?>*</label>
                  <input id="title" type="text" class="form-control" name="title"
                    placeholder="<?php echo e(__('Enter Package title')); ?>" value="">
                  <p id="err_title" class="mb-0 text-danger em"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="price"><?php echo e(__('Price')); ?> (<?php echo e($settings->base_currency_text); ?>)*</label>
                  <input id="price" type="number" class="form-control" name="price"
                    placeholder="<?php echo e(__('Enter Package price')); ?>" value="">
                  <p class="text-warning">
                    <small><?php echo e(__('If price is 0 , than it will appear as free')); ?></small>
                  </p>
                  <p id="err_price" class="mb-0 text-danger em"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="term"><?php echo e(__('Package term')); ?>*</label>
                  <select id="term" name="term" class="form-control" required>
                    <option value="" selected disabled><?php echo e(__('Choose a Package term')); ?></option>
                    <option value="weekly"><?php echo e(__('weekly')); ?></option>
                    <option value="monthly"><?php echo e(__('monthly')); ?></option>
                    <option value="yearly"><?php echo e(__('yearly')); ?></option>
                    <option value="linking"><?php echo e(__('linking')); ?></option>
                    <option value="project"><?php echo e(__('project')); ?></option>
                  </select>
                  <p id="err_term" class="mb-0 text-danger em"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label"><?php echo e(__('Number of services')); ?> *</label>
                  <input type="number" class="form-control" name="number_of_service_add"
                    placeholder="<?php echo e(__('Enter number of services')); ?>">
                  <p id="err_number_of_service_add" class="mb-0 text-danger em"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label"><?php echo e(__('Number of featured services')); ?> *</label>
                  <input type="number" name="number_of_service_featured" class="form-control"
                    placeholder="<?php echo e(__('Enter number of featured services')); ?>">
                  <p id="err_number_of_service_featured" class="mb-0 text-danger em"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label"><?php echo e(__('Number of forms')); ?> *</label>
                  <input type="number" name="number_of_form_add" class="form-control"
                    placeholder="<?php echo e(__('Enter number of forms')); ?>">
                  <p id="err_number_of_form_add" class="mb-0 text-danger em"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label"><?php echo e(__('Number of service orders')); ?> *</label>
                  <input type="number" name="number_of_service_order" class="form-control"
                    placeholder="<?php echo e(__('Enter number of service orders')); ?>">
                  <p id="err_number_of_service_order" class="mb-0 text-danger em"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="status"><?php echo e(__('Live Chat')); ?>*</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="live_chat_status" value="1" class="selectgroup-input"
                        checked="">
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="live_chat_status" value="0" class="selectgroup-input">
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
                      <input type="radio" name="qr_builder_status" value="1"
                        class="selectgroup-input qr_builder_status" checked="">
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="qr_builder_status" value="0"
                        class="selectgroup-input qr_builder_status">
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                  <p id="err_qr_builder_status" class="mb-0 text-danger em"></p>
                </div>
              </div>

              <div class="col-md-6" id="qr_code_save_limit">
                <div class="form-group">
                  <label for="status"><?php echo e(__('QR Code Save Limit')); ?>*</label>
                  <input type="number" name="qr_code_save_limit" class="form-control">
                  <p id="err_qr_code_save_limit" class="mb-0 text-danger em"></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="status"><?php echo e(__('Recommended')); ?>*</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="recommended" value="1" class="selectgroup-input"
                        checked="">
                      <span class="selectgroup-button"><?php echo e(__('Yes')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="recommended" value="0" class="selectgroup-input recommended">
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
                    <option value="1"><?php echo e(__('Active')); ?></option>
                    <option value="0"><?php echo e(__('Deactive')); ?></option>
                  </select>
                  <p id="err_status" class="mb-0 text-danger em"></p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label><?php echo e(__('Custom Feature')); ?></label>
                  <textarea name="custom_features" class="form-control"></textarea>
                  <p id="err_custom_features" class="mb-0 text-danger em"></p>
                  <p class="text-warning"><?php echo e(__('Each new line will be shown as a new feature in the pricing plan')); ?>

                  </p>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
          <button id="submitBtn" type="button" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script src="<?php echo e(asset('assets/js/packages.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\packages\index.blade.php ENDPATH**/ ?>