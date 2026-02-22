<?php
  Config::set('app.timezone', App\Models\BasicSettings\Basic::first()->timezone);
?>
<?php $__env->startSection('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/buy_plan.css')); ?>">
<?php $__env->stopSection(); ?>

<?php
  $seller = Auth::guard('seller')->user();
  $package = \App\Http\Helpers\SellerPermissionHelper::currentPackagePermission($seller->id);
?>
<?php $__env->startSection('content'); ?>
  <?php if(is_null($package)): ?>
    <?php
      $pendingMemb = \App\Models\Membership::query()
          ->where([['seller_id', '=', $seller->id], ['status', 0]])
          ->whereYear('start_date', '<>', '9999')
          ->orderBy('id', 'DESC')
          ->first();
      $pendingPackage = isset($pendingMemb) ? \App\Models\Package::query()->findOrFail($pendingMemb->package_id) : null;
    ?>

    <?php if($pendingPackage): ?>
      <div class="alert alert-warning text-dark">
        <?php echo e(__('You have requested a package which needs an action (Approval / Rejection) by Admin. You will be notified via mail once an action is taken.')); ?>

      </div>
      <div class="alert alert-warning text-dark">
        <strong><?php echo e(__('Pending Package') . ':'); ?> </strong> <?php echo e($pendingPackage->title); ?>

        <span class="badge badge-secondary"><?php echo e($pendingPackage->term); ?></span>
        <span class="badge badge-warning"><?php echo e(__('Decision Pending')); ?></span>
      </div>
    <?php else: ?>
      <div class="alert alert-warning text-dark">
        <?php echo e(__('Your membership is expired. Please purchase a new package / extend the current package.')); ?>

      </div>
    <?php endif; ?>
  <?php else: ?>
    <div class="row justify-content-center align-items-center mb-1">
      <div class="col-12">
        <div class="alert border-left border-primary text-dark">
          <?php if($package_count >= 2 && $next_membership): ?>
            <?php if($next_membership->status == 0): ?>
              <strong
                class="text-danger"><?php echo e(__('You have requested a package which needs an action (Approval / Rejection) by Admin. You will be notified via mail once an action is taken.')); ?></strong><br>
            <?php elseif($next_membership->status == 1): ?>
              <strong
                class="text-danger"><?php echo e(__('You have another package to activate after the current package expires. You cannot purchase / extend any package, until the next package is activated')); ?></strong><br>
            <?php endif; ?>
          <?php endif; ?>

          <strong><?php echo e(__('Current Package') . ':'); ?> </strong> <?php echo e($current_package->title); ?>

          <span class="badge badge-secondary"><?php echo e($current_package->term); ?></span>
          <?php if($current_membership->is_trial == 1): ?>
            (<?php echo e(__('Expire Date') . ':'); ?>

            <?php echo e(Carbon\Carbon::parse($current_membership->expire_date)->format('M-d-Y')); ?>)
            <span class="badge badge-primary"><?php echo e(__('Trial')); ?></span>
          <?php else: ?>
            (<?php echo e(__('Expire Date') . ':'); ?>

            <?php echo e($current_package->term === 'lifetime' ? 'Lifetime' : Carbon\Carbon::parse($current_membership->expire_date)->format('M-d-Y')); ?>)
          <?php endif; ?>

          <?php if($package_count >= 2 && $next_package): ?>
            <div>
              <strong><?php echo e(__('Next Package To Activate') . ':'); ?> </strong> <?php echo e($next_package->title); ?> <span
                class="badge badge-secondary"><?php echo e($next_package->term); ?></span>
              <?php if($current_package->term != 'lifetime' && $current_membership->is_trial != 1): ?>
                (
                <?php echo e(__('Activation Date') . ':'); ?>

                <?php echo e(Carbon\Carbon::parse($next_membership->start_date)->format('M-d-Y')); ?>,
                <?php echo e(__('Expire Date') . ':'); ?>

                <?php echo e($next_package->term === 'lifetime' ? 'Lifetime' : Carbon\Carbon::parse($next_membership->expire_date)->format('M-d-Y')); ?>)
              <?php endif; ?>
              <?php if($next_membership->status == 0): ?>
                <span class="badge badge-warning"><?php echo e(__('Decision Pending')); ?></span>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row mb-5 justify-content-center">
    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-3 pr-md-0 mb-5">
        <div class="card-pricing2 <?php if(isset($current_package->id) && $current_package->id === $package->id): ?> card-success <?php else: ?> card-primary <?php endif; ?>">
          <div class="pricing-header">
            <h3 class="fw-bold d-inline-block">
              <?php echo e($package->title); ?>

            </h3>
            <?php if(isset($current_package->id) && $current_package->id === $package->id): ?>
              <h3 class="badge badge-danger d-inline-block float-right ml-2"><?php echo e(__('Current')); ?></h3>
            <?php endif; ?>
            <?php if($package_count >= 2): ?>
              <?php if($next_package): ?>
                <?php if($next_package->id == $package->id): ?>
                  <h3 class="badge badge-warning d-inline-block float-right ml-2"><?php echo e(__('Next')); ?></h3>
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
            <span class="sub-title"></span>
          </div>
          <div class="price-value">
            <div class="value">
              <span class="amount"><?php echo e($package->price == 0 ? 'Free' : format_price($package->price)); ?></span>
              <span class="month">/<?php echo e($package->term); ?></span>
            </div>
          </div>

          <ul class="pricing-content">
            <li><?php echo e(__('Services') . ' :'); ?> <?php echo e($package->number_of_service_add); ?></li>
            <li><?php echo e(__('Featured Services') . ' : '); ?> <?php echo e($package->number_of_service_featured); ?></li>
            <li><?php echo e(__('Custom Form') . ' : '); ?> <?php echo e($package->number_of_form_add); ?></li>
            <li><?php echo e(__('Service Orders') . ' : '); ?> <?php echo e($package->number_of_service_order); ?></li>
            <li class="<?php echo e($package->live_chat_status == 0 ? 'disable' : ''); ?>"><?php echo e(__('Live Chat')); ?></li>
            <li class="<?php echo e($package->qr_builder_status == 0 ? 'disable' : ''); ?>"><?php echo e(__('QR Builder')); ?></li>
            <?php if(!is_null($package->custom_features)): ?>
              <?php
                $features = explode("\n", $package->custom_features);
              ?>
              <?php if(count($features) > 0): ?>
                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($value); ?> </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            <?php endif; ?>

          </ul>

          <?php
            $hasPendingMemb = \App\Http\Helpers\SellerPermissionHelper::hasPendingMembership(Auth::id());
          ?>
          <?php if($package_count < 2 && !$hasPendingMemb): ?>
            <div class="px-4">
              <?php if(isset($current_package->id) && $current_package->id === $package->id): ?>
                <?php if($package->term != 'lifetime' || $current_membership->is_trial == 1): ?>
                  <a href="<?php echo e(route('seller.plan.extend.checkout', $package->id)); ?>"
                    class="btn btn-success btn-lg w-75 fw-bold mb-3"><?php echo e(__('Extend')); ?></a>
                <?php endif; ?>
              <?php else: ?>
                <a href="<?php echo e(route('seller.plan.extend.checkout', $package->id)); ?>"
                  class="btn btn-primary btn-block btn-lg fw-bold mb-3"><?php echo e(__('Buy Now')); ?></a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\buy_plan\index.blade.php ENDPATH**/ ?>