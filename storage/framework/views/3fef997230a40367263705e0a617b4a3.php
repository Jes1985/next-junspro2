<?php $__env->startSection('content'); ?>
  <div class="mt-2 mb-4">
    <h2 class="pb-2"><?php echo e(__('Welcome back,')); ?> <?php echo e($authAdmin->first_name . ' ' . $authAdmin->last_name . '!'); ?></h2>
  </div>

  
  <?php
    if (!is_null($roleInfo)) {
        $rolePermissions = json_decode($roleInfo->permissions);
    }
  ?>

  <div class="row dashboard-items">
    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Subscription Log', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.monthly_earning')); ?>">
          <div class="card card-stats card-info card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fas fa-sack-dollar"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Lifetime Earnings')); ?></p>
                    <h4 class="card-title"><?php echo e(symbolPrice($settings->life_time_earning)); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>
    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Subscription Log', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.monthly_profit')); ?>">
          <div class="card card-stats card-dark card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fas fa-usd-square"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Total Profit')); ?></p>
                    <h4 class="card-title"><?php echo e(symbolPrice($settings->total_profit)); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>
    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Subscription Log', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.transcation')); ?>">
          <div class="card card-stats card-warning card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-exchange-alt"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Total Transcation')); ?></p>
                    <h4 class="card-title"><?php echo e($total_transaction); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Subscription Log', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.payment-log.index')); ?>">
          <div class="card card-stats card-secondary card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-exchange-alt"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Subscription Log')); ?></p>
                    <h4 class="card-title"><?php echo e($memberships); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Service Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.service_management.services', ['language' => $defaultLang->code])); ?>">
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
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Service Orders', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.service_orders')); ?>">
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
    <?php endif; ?>
    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Support Tickets', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.support_tickets')); ?>">
          <div class="card card-stats card-info card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-ticket-alt"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Support Tickets')); ?></p>
                    <h4 class="card-title"><?php echo e($support_tickets); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Blog Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.blog_management.posts', ['language' => $defaultLang->code])); ?>">
          <div class="card card-stats card-dark card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-blog"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Posts')); ?></p>
                    <h4 class="card-title"><?php echo e($posts); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Sellers Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.seller_management.registered_seller')); ?>">
          <div class="card card-stats card-warning card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-users"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Sellers')); ?></p>
                    <h4 class="card-title"><?php echo e($sellers); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>
    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('User Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.user_management.registered_users')); ?>">
          <div class="card card-stats card-orchid card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="la flaticon-users"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Users')); ?></p>
                    <h4 class="card-title"><?php echo e($users); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('User Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-3">
        <a href="<?php echo e(route('admin.user_management.subscribers')); ?>">
          <div class="card card-stats card-secondary card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-bell"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Subscribers')); ?></p>
                    <h4 class="card-title"><?php echo e($subscribers); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>


  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Monthly Subscriptions')); ?> (<?php echo e(date('Y')); ?>)</div>
        </div>

        <div class="card-body">
          <div class="chart-container">
            <canvas id="monthlySubscriptionChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Monthly Service Orders')); ?> (<?php echo e(date('Y')); ?>)</div>
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
    const subscriptionArr = <?php echo json_encode($subscriptionArr); ?>;
  </script>

  <script type="text/javascript" src="<?php echo e(asset('assets/js/my-chart.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\admin\dashboard.blade.php ENDPATH**/ ?>