<?php $title = __('Support Tickets'); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Support Tickets Section ======-->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="user-profile-details mb-40">
                <div class="account-info">
                  <div class="title">
                    <h4><?php echo e(__('Ticket List')); ?></h4>

                    <a href="<?php echo e(route('user.support_tickets.create')); ?>" class="btn btn-md btn-primary rounded-1"><?php echo e(__('New Ticket')); ?></a>
                  </div>

                  <div class="main-info">
                    <?php if(count($tickets) == 0): ?>
                      <div class="row text-center mt-2">
                        <div class="col">
                          <h4><?php echo e(__('No Ticket Found') . '!'); ?></h4>
                        </div>
                      </div>
                    <?php else: ?>
                      <div class="main-table">
                        <div class="table-responsive">
                          <table id="user-datatable" class="table table-striped w-100">
                            <thead>
                              <tr>
                                <th><?php echo e(__('Ticket ID')); ?></th>
                                <th><?php echo e(__('Subject')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td class="<?php echo e($currentLanguageInfo->direction == 1 ? 'pe-3' : 'ps-3'); ?>">
                                    <?php echo e('#' . $ticket->id); ?>

                                  </td>
                                  <td class="<?php echo e($currentLanguageInfo->direction == 1 ? 'pe-3' : 'ps-3'); ?>">
                                    <?php echo e(strlen($ticket->subject) > 60 ? mb_substr($ticket->subject, 0, 60, 'UTF-8') . '...' : $ticket->subject); ?>

                                  </td>
                                  <td>
                                    <?php if($ticket->status == 'pending'): ?>
                                      <span class="pending <?php echo e($currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2'); ?>"><?php echo e(__('Pending')); ?></span>
                                    <?php elseif($ticket->status == 'open'): ?>
                                      <span class="open <?php echo e($currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2'); ?>"><?php echo e(__('Open')); ?></span>
                                    <?php else: ?>
                                      <span class="closed <?php echo e($currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2'); ?>"><?php echo e(__('Closed')); ?></span>
                                    <?php endif; ?>
                                  </td>
                                  <td class="<?php echo e($currentLanguageInfo->direction == 1 ? 'pe-3' : 'ps-3'); ?>">
                                    <a href="<?php echo e(route('user.support_ticket.conversation', ['id' => $ticket->id])); ?>" class="btn btn-sm btn-primary rounded-1">
                                      <?php echo e(__('Conversation')); ?>

                                    </a>
                                  </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Support Tickets Section ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\support-tickets.blade.php ENDPATH**/ ?>