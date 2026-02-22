<?php if ($__env->exists('seller.partials.rtl-style')) echo $__env->make('seller.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Edit Input Field')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('seller.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Service Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a
          href="<?php echo e(route('seller.service_management.forms', ['language' => $defaultLang->code])); ?>"><?php echo e(__('Forms')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Input Field')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row" id="app">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-10">
              <div class="card-title"><?php echo e(__('Edit Input Field')); ?></div>
            </div>

            <div class="col-lg-2">
              <a href="<?php echo e(route('seller.service_management.form.input', ['id' => request()->route('form_id'), 'language' => request()->input('language')])); ?>"
                class="btn btn-info btn-sm float-right">
                <span class="btn-label">
                  <i class="fas fa-backward mdb_12"></i>
                </span>
                <?php echo e(__('Back')); ?>

              </a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <form id="ajaxEditForm"
                action="<?php echo e(route('seller.service_management.form.update_input', ['id' => $inputField->id])); ?>"
                method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="form_id" value="<?php echo e(request()->route('form_id')); ?>">

                <input type="hidden" name="type" value="<?php echo e($inputField->type); ?>">

                <div class="form-group">
                  <label><?php echo e(__('Required Status') . '*'); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="is_required" value="1" class="selectgroup-input"
                        <?php if($inputField->is_required == 1): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Yes')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="is_required" value="0" class="selectgroup-input"
                        <?php if($inputField->is_required == 0): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('No')); ?></span>
                    </label>
                  </div>
                  <p class="mt-1 mb-0 text-danger em" id="editErr_is_required"></p>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Label') . '*'); ?></label>
                  <input type="text" class="form-control" name="label" placeholder="Enter Input Label"
                    value="<?php echo e($inputField->label); ?>">
                  <p class="mt-2 mb-0 text-danger em" id="editErr_label"></p>
                </div>

                <?php if($inputField->type != 4 && $inputField->type != 8): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Placeholder') . '*'); ?></label>
                    <input type="text" class="form-control" name="placeholder" placeholder="Enter Input Placeholder"
                      value="<?php echo e($inputField->placeholder); ?>">
                    <p class="mt-2 mb-0 text-danger em" id="editErr_placeholder"></p>
                  </div>
                <?php endif; ?>

                <?php if($inputField->type == 3 || $inputField->type == 4): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Options') . '*'); ?></label><br>
                    <button class="btn btn-sm btn-success" type="button" v-on:click="addOpt()">
                      <?php echo e(__('Add Option')); ?>

                    </button>
                    <p class="mt-2 mb-0 text-danger em" id="editErr_options"></p>
                  </div>

                  <div class="row no-gutters" v-for="(option, index) in optionsArray" v-bind:key="index">
                    <div class="col-lg-10">
                      <div class="form-group">
                        <input type="text" class="form-control" name="options[]" placeholder="Enter Option"
                          v-bind:value="option">
                      </div>
                    </div>

                    <div class="col-lg-2">
                      <button type="button" class="btn btn-danger btn-sm mt-3" v-on:click="rmvOpt(index)">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if($inputField->type == 8): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Maximum Size of Uploaded File') . '*'); ?></label>
                    <div class="input-group">
                      <input type="number" step="0.01" class="form-control ltr" name="file_size"
                        placeholder="Enter File Size" value="<?php echo e($inputField->file_size); ?>">
                      <div class="input-group-append">
                        <span class="input-group-text"><?php echo e(__('MB')); ?></span>
                      </div>
                    </div>
                    <p class="mt-2 mb-0 text-danger em" id="editErr_file_size"></p>
                  </div>
                <?php endif; ?>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button id="updateBtn" type="button" class="btn btn-primary">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script type="text/javascript">
    let optArr = <?php echo json_encode($options); ?>;
  </script>

  
  <script type="text/javascript" src="<?php echo e(asset('assets/js/vue-js.min.js')); ?>"></script>

  <script type="text/javascript" src="<?php echo e(asset('assets/js/form-input.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\form-input\edit.blade.php ENDPATH**/ ?>