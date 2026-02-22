<?php $__env->startSection('content'); ?>
  <div class="mt-2 mb-4">
    <h2 class="pb-2"><?php echo e(__('Welcome back,')); ?> <?php echo e(Auth::guard('seller')->user()->username . '!'); ?></h2>
  </div>

  <?php
    $data = sellerPermission(Auth::guard('seller')->user()->id, 'form', $defaultLang->id);
    $data2 = sellerPermission(Auth::guard('seller')->user()->id, 'service');
    $data3 = sellerPermission(Auth::guard('seller')->user()->id, 'service-order');
    $data4 = sellerPermission(Auth::guard('seller')->user()->id, 'service-featured');
  ?>
  <?php if(
      $data['status'] == 'false' ||
          $data2['status'] == 'false' ||
          $data3['status'] == 'false' ||
          $data4['status'] == 'false'): ?>
    <div class="alert alert-warning alert-block">
      <?php if($data['status'] == 'false'): ?>
        <strong
          class="text-dark"><?php echo e(__('Currently, you have added ' . $data['total_form_added'] . ' forms. ' . 'Your current package supports ' . $data['package_support'] . ' forms. Please delete ' . $data['total_form_added'] - $data['package_support'] . ' forms to enable form management.')); ?></strong>
        <br>
      <?php endif; ?>

      <?php if($data2['status'] == 'false'): ?>
        <strong
          class="text-dark"><?php echo e(__('Currently, you have added ' . $data2['total_service_added'] . ' services. ' . 'Your current package supports ' . $data2['package_support'] . ' services. Please delete ' . $data2['total_service_added'] - $data2['package_support'] . ' services to enable service management.')); ?></strong>
        <br>
      <?php endif; ?>
      <?php if($data3['status'] == 'false'): ?>
        <strong
          class="text-dark"><?php echo e(__('Currently, you have received ' . $data3['total_service_ordered'] . ' Orders. ' . 'Your current package supports ' . $data3['package_support'] . ' services orders. if you want to receive more orders from your customers, then please upgrade the package')); ?>

          <a href="<?php echo e(route('seller.plan.extend.index')); ?>"><?php echo e(__('from here')); ?></a></strong>
        <br>
      <?php endif; ?>
      <?php if($data4['status'] == 'false'): ?>
        <strong
          class="text-dark"><?php echo e(__('Currently, You have featured ' . $data4['total_service_featured'] . ' services. ' . 'Your current package supports ' . $data4['package_support'] . ' services to make featured. Please unfeatured ' . $data4['total_service_featured'] - $data4['package_support'] . ' services to enable service management')); ?></strong>
        <br>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if(Auth::guard('seller')->user()->status == 0 && $admin_setting->seller_admin_approval == 1): ?>
    <div class="mt-2 mb-4">
      <div class="alert alert-danger text-dark">
        <?php echo e($admin_setting->admin_approval_notice != null ? $admin_setting->admin_approval_notice : 'Your account is deactive!'); ?>

      </div>
    </div>
  <?php endif; ?>

  <?php
    $seller = Auth::guard('seller')->user();
    $package = \App\Http\Helpers\SellerPermissionHelper::currentPackagePermission($seller->id);
  ?>

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

  
  <div class="row dashboard-items">
    <div class="col-sm-6 col-md-4">
      <a href="<?php echo e(route('seller.monthly_income')); ?>">
        <div class="card card-stats card-secondary card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fal fa-dollar-sign"></i>
                </div>
              </div>

              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category"><?php echo e(__('My Balance')); ?></p>
                  <h4 class="card-title">
                    <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                    <?php echo e(Auth::guard('seller')->user()->amount); ?>

                    <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-sm-6 col-md-4">
      <a href="<?php echo e(route('seller.transcation')); ?>">
        <div class="card card-stats card-warning card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fas fa-exchange"></i>
                </div>
              </div>

              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category"><?php echo e(__('Transaction')); ?></p>
                  <h4 class="card-title">
                    <?php echo e($transcations); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-sm-6 col-md-4">
      <a href="<?php echo e(route('seller.service_management.services', ['language' => $defaultLang->code])); ?>">
        <div class="card card-stats card-success card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fal fa-headset"></i>
                </div>
              </div>

              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category"><?php echo e(__('Services')); ?></p>
                  <h4 class="card-title"><?php echo e($services); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-sm-6 col-md-4">
      <a href="<?php echo e(route('seller.service_orders')); ?>">
        <div class="card card-stats card-danger card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="far fa-cubes"></i>
                </div>
              </div>

              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category"><?php echo e(__('Service Orders')); ?></p>
                  <h4 class="card-title"><?php echo e($serviceOrders); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <?php if($current_package != '[]'): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('seller.subscription_log')); ?>">
          <div class="card card-stats card-info card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-lightbulb-dollar"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Subscription Log')); ?></p>
                    <h4 class="card-title"><?php echo e($payment_logs); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <div class="col-sm-6 col-md-4">
      <a href="<?php echo e(route('seller.support_tickets')); ?>">
        <div class="card card-stats card-dark card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fal fa-headset"></i>
                </div>
              </div>

              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category"><?php echo e(__('Support Tickets')); ?></p>
                  <h4 class="card-title"><?php echo e($support_tickets_count); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Month Wise Total Incomes')); ?> (<?php echo e(date('Y')); ?>)</div>
        </div>

        <div class="card-body">
          <div class="chart-container">
            <canvas id="serviceIncomeChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Number of Service Orders')); ?> (<?php echo e(date('Y')); ?>)</div>
        </div>

        <div class="card-body">
          <div class="chart-container">
            <canvas id="serviceOrderChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  
  <script type="text/javascript" src="<?php echo e(asset('assets/js/chart.min.js')); ?>"></script>

  <script>
    const monthArr = <?php echo json_encode($months); ?>;
    const serviceOrderArr = <?php echo json_encode($totalServiceOrders); ?>;
    const serviceIncomeArr = <?php echo json_encode($totalServiceIncomes); ?>;
  </script>

  <script type="text/javascript" src="<?php echo e(asset('assets/js/my-chart.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\index.blade.php ENDPATH**/ ?>