

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Mes Abonnements')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Mes Abonnements')])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Mes Abonnements')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div class="user-profile-details mb-30">
            <div class="title mb-30">
              <h4><?php echo e(__('Mes Abonnements Junspro')); ?></h4>
            </div>

            <?php if($subscriptions->count() > 0): ?>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th><?php echo e(__('Client')); ?></th>
                      <th><?php echo e(__('Heures/semaine')); ?></th>
                      <th><?php echo e(__('Statut')); ?></th>
                      <th><?php echo e(__('Actions')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td>
                          <strong><?php echo e($subscription->client->user->name ?? 'N/A'); ?></strong>
                        </td>
                        <td><?php echo e($subscription->hours_per_week); ?>h</td>
                        <td>
                          <span class="badge <?php echo e($subscription->status === 'active' ? 'badge-junspro' : ($subscription->status === 'paused' ? 'badge-warning' : 'badge-secondary')); ?>">
                            <?php echo e(ucfirst($subscription->status)); ?>

                          </span>
                        </td>
                        <td>
                          <a href="<?php echo e(route('freelancer.subscriptions.show', $subscription->id)); ?>" class="btn btn-sm btn-primary">
                            <?php echo e(__('Voir les sessions')); ?>

                          </a>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>

              <div class="mt-30">
                <?php echo e($subscriptions->links()); ?>

              </div>
            <?php else: ?>
              <div class="alert alert-info">
                <?php echo e(__('Vous n\'avez aucun abonnement actif.')); ?>

              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelancer\subscriptions\index.blade.php ENDPATH**/ ?>