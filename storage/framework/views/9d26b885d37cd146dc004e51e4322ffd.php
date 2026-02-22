<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Form Builder')); ?></h4>
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
        <a href="#"><?php echo e(__('Withdrawals Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('admin.withdraw.payment_method')); ?>"><?php echo e(__('Payment Methods')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Form Builder')); ?></a>
      </li>
    </ul>
    <a href="<?php echo e(route('admin.withdraw.payment_method')); ?>" class="btn-md btn btn-primary ml-auto"><?php echo e(__('Back')); ?></a>
  </div>

  <div class="row" id="app">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-8">
              <div class="card-title"><?php echo e(__('Input Fields')); ?></div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <p class="text-warning mb-0">** <?php echo e(__('Do not create')); ?> <strong
              class="text-danger"><?php echo e(__('Withdraw Amount & Additional Reference')); ?></strong>
            <?php echo e(__('input field, it will be in the Table Reservation form by default.')); ?></p>
          <p class="text-warning">** <?php echo e(__('Drag & Drop the input fields to change the order number')); ?></p>

          <form class="ui-state-default ui-state-disabled">
            <div class="form-group">
              <label for=""><?php echo e(__('Withdraw Amount')); ?> **</label>
              <div class="row">
                <div class="col-md-10">
                  <input class="form-control" type="text" name="" value="" placeholder="Withdraw Amount">
                </div>
              </div>
            </div>
          </form>
          <form class="ui-state-default ui-state-disabled">
            <div class="form-group">
              <label for=""><?php echo e(__('Additional Reference(Optional)')); ?> </label>
              <div class="row">
                <div class="col-md-10">
                  <input class="form-control" type="text" name="" value=""
                    placeholder="Additional Reference">
                </div>
              </div>
            </div>
          </form>
          <?php if(count($inputs) > 0): ?>
            <div id="sortable">
              <?php if ($__env->exists('backend.withdraw.form.created-inputs')) echo $__env->make('backend.withdraw.form.created-inputs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <?php if ($__env->exists('backend.withdraw.form.create-input')) echo $__env->make('backend.withdraw.form.create-input', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script src="<?php echo e(asset('assets/js/vue.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/axios.js')); ?>"></script>
  <script>
    var order_url = "<?php echo e(route('admin.withdraw_payment_method.order_update')); ?>";
  </script>
  <script src="<?php echo e(asset('assets/js/form-builder.js')); ?>"></script>

  <script>
    var app = new Vue({
      el: '#app',
      data: {
        type: 1,
        counter: 0,
        placeholdershow: true
      },
      methods: {
        typeChange() {
          if (this.type == 3) {
            this.placeholdershow = false;
          } else {
            this.placeholdershow = true;
          }
          if (this.type == 2 || this.type == 3) {
            this.counter = 1;
          } else {
            this.counter = 0;
          }
        },
        addOption() {
          $("#optionarea").addClass('d-block');
          this.counter++;
        },
        removeOption(n) {
          $("#counterrow" + n).remove();
          if ($(".counterrow").length == 0) {
            this.counter = 0;
          }
        }
      }
    })
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\withdraw\form\index.blade.php ENDPATH**/ ?>