<div class="col-lg-3">
  <div class="user-sidebar radius-md mb-40">
    <ul class="links list-unstyled">
      <li>
        <a href="<?php echo e(route('user.dashboard')); ?>" class="<?php echo e(request()->routeIs('user.dashboard') ? 'active' : ''); ?>">
          <?php echo e(__('Dashboard')); ?>

        </a>
      </li>
      <?php if($basicInfo->is_service): ?>
        <li>
          <a href="<?php echo e(route('user.service_orders')); ?>"
            class="<?php echo e(request()->routeIs('user.service_orders') || request()->routeIs('user.service_order.details') ? 'active' : ''); ?>">
            <?php echo e(__('Service Orders')); ?>

          </a>
        </li>

        <li>
          <a href="<?php echo e(route('user.service_wishlist')); ?>"
            class="<?php echo e(request()->routeIs('user.service_wishlist') ? 'active' : ''); ?>">
            <?php echo e(__('Service Wishlist')); ?>

          </a>
        </li>
      <?php endif; ?>
      <?php if($basicInfo->support_ticket_status == 1): ?>
        <li>
          <a href="<?php echo e(route('user.support_tickets')); ?>"
            class="<?php if(request()->routeIs('user.support_tickets')): ?> active
            <?php elseif(request()->routeIs('user.support_tickets.create')): ?> active
            <?php elseif(request()->routeIs('user.support_ticket.conversation')): ?> active <?php endif; ?>">
            <?php echo e(__('Support Tickets')); ?>

          </a>
        </li>
      <?php endif; ?>
      <li>
        <a href="<?php echo e(route('user.followings')); ?>" class="<?php echo e(request()->routeIs('user.followings') ? 'active' : ''); ?>">
          <?php echo e(__('Following')); ?>

        </a>
      </li>


      <li>
        <a href="<?php echo e(route('user.edit_profile')); ?>"
          class="<?php echo e(request()->routeIs('user.edit_profile') ? 'active' : ''); ?>">
          <?php echo e(__('Edit Profile')); ?>

        </a>
      </li>

      <?php $authUser = Auth::guard('web')->user(); ?>

      <?php if(!is_null($authUser->password)): ?>
        <li>
          <a href="<?php echo e(route('user.change_password')); ?>"
            class="<?php echo e(request()->routeIs('user.change_password') ? 'active' : ''); ?>">
            <?php echo e(__('Change Password')); ?>

          </a>
        </li>
      <?php endif; ?>
      <li>
        <a href="<?php echo e(route('user.logout')); ?>">
          <?php echo e(__('Logout')); ?>

        </a>
      </li>
    </ul>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\side-navbar.blade.php ENDPATH**/ ?>