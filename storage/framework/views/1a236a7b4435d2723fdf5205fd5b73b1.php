

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Confirmer l\'annulation')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb ?? [], 'title' => __('Confirmer l\'annulation')])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb ?? [], 'title' => __('Confirmer l\'annulation')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div class="user-profile-details mb-30">
            <div class="title mb-30">
              <h4><?php echo e(__('Confirmer l\'annulation de votre abonnement')); ?></h4>
            </div>

            <!-- Étape 2 : Confirmation avec raison -->
            <div class="card mb-30">
              <div class="card-body">
                <h5 class="mb-20"><?php echo e(__('Votre abonnement sera arrêté. Plus aucun débit ni nouvelle livraison programmée.')); ?></h5>
                
                <p class="text-muted mb-20">
                  <strong><?php echo e(__('Raison')); ?>:</strong> <?php echo e($reason ?? 'Non spécifiée'); ?>

                </p>

                <!-- Étape 3 : Dernière offre -->
                <form action="<?php echo e(route('client.subscriptions.cancel.submit', $subscription->id)); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="action" value="final_cancel">
                  <input type="hidden" name="reason" value="<?php echo e($reason ?? ''); ?>">
                  
                  <div class="mb-20">
                    <a href="<?php echo e(route('explore')); ?>" class="btn btn-lg btn-primary w-100 mb-10">
                      <?php echo e(__('Trouver un autre freelance')); ?>

                    </a>
                  </div>

                  <div class="mb-20">
                    <a href="<?php echo e(route('client.subscriptions.index')); ?>" class="btn btn-lg w-100 mb-10" style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); border: none; color: #ffffff;">
                      <?php echo e(__('Garder mon abonnement')); ?>

                    </a>
                  </div>

                  <hr>

                  <div class="mb-20">
                    <button type="submit" class="btn btn-lg btn-danger w-100 mb-10">
                      <?php echo e(__('Annuler définitivement mon abonnement')); ?>

                    </button>
                    <p class="text-muted small text-center"><?php echo e(__('Cette action est irréversible.')); ?></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\subscriptions\cancel-confirm.blade.php ENDPATH**/ ?>