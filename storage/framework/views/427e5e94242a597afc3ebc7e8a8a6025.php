<?php $title = __('Dashboard'); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Dashboard Section ======-->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="user-profile-details mb-30">
                <div class="account-info">
                  <div class="title">
                    <h4><?php echo e(__('Account Information')); ?></h4>
                  </div>

                  <div class="main-info">
                    <ul class="list list-unstyled">

                      <?php if($authUser->first_name != null && $authUser->last_name != null): ?>
                      <li>
                        <span><?php echo e(__('Name') . ':'); ?></span>
                        <span><?php echo e($authUser->first_name . ' ' . $authUser->last_name); ?></span>
                      </li>
                      <?php endif; ?>

                      <?php if($authUser->username != null): ?>
                      <li>
                        <span><?php echo e(__('Username') . ':'); ?></span>
                        <span><?php echo e($authUser->username); ?></span>
                      </li>
                      <?php endif; ?>

                      <li>
                        <span><?php echo e(__('Email Address') . ':'); ?></span>
                        <span><?php echo e($authUser->email_address); ?></span>
                      </li>

                      <?php if($authUser->phone_number != null): ?>
                      <li>
                        <span><?php echo e(__('Phone') . ':'); ?></span>
                        <span><?php echo e($authUser->phone_number); ?></span>
                      </li>
                      <?php endif; ?>

                      <?php if($authUser->address != null): ?>
                      <li>
                        <span><?php echo e(__('Address') . ':'); ?></span>
                        <span><?php echo e($authUser->address); ?></span>
                      </li>
                      <?php endif; ?>

                      <?php if($authUser->city != null): ?>
                      <li>
                        <span><?php echo e(__('City') . ':'); ?></span>
                        <span><?php echo e($authUser->city); ?></span>
                      </li>
                      <?php endif; ?>

                      <?php if($authUser->state != null): ?>
                      <li>
                        <span><?php echo e(__('State') . ':'); ?></span>
                        <span><?php echo e($authUser->state); ?></span>
                      </li>
                      <?php endif; ?>

                      <?php if($authUser->country != null): ?>
                      <li>
                        <span><?php echo e(__('Country') . ':'); ?></span>
                        <span><?php echo e($authUser->country); ?></span>
                      </li>
                      <?php endif; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row pb-10">
            <?php if($basicInfo->is_service): ?>
              <div class="col-md-4">
                <div class="mb-30">
                  <a href="<?php echo e(route('user.service_orders')); ?>" class="d-block">
                    <div class="card card-box radius-md box-1">
                      <div class="card-info">
                        <h5><?php echo e(__('Service Orders')); ?></h5>
                        <p><?php echo e($numOfServiceOrders); ?></p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-30">
                  <a href="<?php echo e(route('user.service_wishlist')); ?>" class="d-block">
                    <div class="card card-box radius-md box-2">
                      <div class="card-info">
                        <h5><?php echo e(__('Wishlisted Services')); ?></h5>
                        <p><?php echo e($numOfWishlistedServices); ?></p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            <?php endif; ?>
            <?php if($basicInfo->support_ticket_status == 1): ?>
              <div class="col-md-4">
                <div class="mb-30">
                  <a href="<?php echo e(route('user.support_tickets')); ?>" class="d-block">
                    <div class="card card-box radius-md box-5">
                      <div class="card-info">
                        <h5><?php echo e(__('Support Tickets')); ?></h5>
                        <p><?php echo e($numOfsupportTicket); ?></p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Dashboard Section ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\dashboard.blade.php ENDPATH**/ ?>