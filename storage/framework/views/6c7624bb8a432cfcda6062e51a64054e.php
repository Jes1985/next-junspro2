<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Payment Success')); ?></h4>
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
        <a href="#"><?php echo e(__('Payment Success')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-5">
              <div class="card-title d-inline-block">
                <?php echo e(__('Payment Success')); ?>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 mx-auto">
            <div class="card p-4 text-center">
              <div class="mb-3">
                <i class="fas fa-check color-white p-3 rounded-circle bg-success text-white"></i>
              </div>
              <h1><?php echo e(__('Success')); ?></h1>
              <?php if(request()->filled('type') && request()->input('type') == 'free'): ?>
                <p><?php echo e(__('Your Package purchase successfully completed.')); ?></p>
              <?php else: ?>
                <p><?php echo e(__('Your Payment successfully completed.')); ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer"></div>
    </div>
  </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\success.blade.php ENDPATH**/ ?>