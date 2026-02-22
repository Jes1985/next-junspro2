<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Make a Withdrawal Request')); ?></h4>
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
        <a href="#"><?php echo e(__('Make a Withdrawal Request!')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-8">
              <div class="card-title"><?php echo e(__('Make a Withdrawal Request')); ?></div>
            </div>
            <div class="col-lg-4">
              <div class="card-title float-right"><?php echo e(__('Your Balance')); ?> :
                <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                <?php echo e(Auth::guard('seller')->user()->amount); ?>

                <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" action="<?php echo e(route('seller.withdraw.send-request')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <?php if($errors->any()): ?>
                  <div class="alert alert-danger">
                    <p><strong><?php echo e(__('Opps Something went wrong')); ?></strong></p>
                    <ul>
                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>
                <?php endif; ?>
                <div class="form-group">
                  <label for=""><?php echo e(__('Withdraw Method') . '*'); ?></label>
                  <select name="withdraw_method" id="withdraw_method" class="form-control" required>
                    <option selected value=""><?php echo e(__('Select Withdraw Method')); ?></option>
                    <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <p id="err_withdraw_method" class="mt-2 mb-0 text-danger em"></p>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Withdraw  Amount') . '*'); ?></label>
                  <input type="number" class="form-control" id="withdraw_amount" name="withdraw_amount"
                    placeholder="Enter Withdraw Amount" min="" required>
                  <p id="err_withdraw_amount" class="mt-2 mb-0 text-danger em"></p>

                  <?php if(Session::has('error')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e(Session::get('error')); ?></p>
                  <?php endif; ?>
                  <p class="mt-2 mb-0 text-warning">
                    <?php echo e(__('You will receive') . ' : '); ?>

                    <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?><span
                      id="receive_amount">0</span>
                    <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>,

                    <?php echo e(__('Total Charge') . ' : '); ?>

                    <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?><span
                      id="total_charge">0</span>
                    <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>,

                    <?php echo e(__('Your Balance will be') . ' : '); ?>

                    <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?><span
                      id="your_balance">0</span><?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>

                  </p>
                </div>
                <div id="appned_input">
                  <div class="all-inputs"></div>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Additional Reference (Optional)')); ?></label>
                  <input type="text" class="form-control" name="additional_reference"
                    placeholder="Enter Additional Reference">
                  <?php if($errors->has('additional_reference')): ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('additional_reference')); ?></p>
                  <?php endif; ?>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="submitBtn" class="btn btn-success">
                <?php echo e(__('Send Request')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
  <script src="<?php echo e(asset('assets/js/seller-withdraw.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\withdraw\create.blade.php ENDPATH**/ ?>