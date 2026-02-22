<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Détails de l\'abonnement')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Détails de l\'abonnement')])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Détails de l\'abonnement')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div class="user-profile-details mb-30">
            <div class="title mb-30">
              <h4><?php echo e(__('Abonnement avec')); ?> <?php echo e($subscription->freelancer->user->name ?? 'N/A'); ?></h4>
            </div>

            <div class="card mb-30">
              <div class="card-body">
                <h5><?php echo e(__('Informations de l\'abonnement')); ?></h5>
                <ul class="list-unstyled">
                  <li><strong><?php echo e(__('Heures par semaine')); ?>:</strong> <?php echo e($subscription->hours_per_week); ?>h</li>
                  <li><strong><?php echo e(__('Prix de base (4 semaines')); ?>:</strong> <?php echo e(number_format($subscription->price_base, 2, ',', ' ')); ?> €</li>
                  <li><strong><?php echo e(__('Heures restantes')); ?>:</strong> <?php echo e($subscription->hours_remaining); ?>h</li>
                  <li><strong><?php echo e(__('Statut')); ?>:</strong> 
                    <span class="badge <?php echo e($subscription->status === 'active' ? 'badge-junspro' : ($subscription->status === 'paused' ? 'badge-warning' : 'badge-secondary')); ?>">
                      <?php echo e(ucfirst($subscription->status)); ?>

                    </span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="title mb-30">
              <h5><?php echo e(__('Livraisons (Sessions de travail)')); ?></h5>
            </div>

            <?php if($workSessions->count() > 0): ?>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th><?php echo e(__('Date')); ?></th>
                      <th><?php echo e(__('Heures')); ?></th>
                      <th><?php echo e(__('Résumé')); ?></th>
                      <th><?php echo e(__('Statut')); ?></th>
                      <th><?php echo e(__('Rectifications')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $workSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($session->start_at ? $session->start_at->format('d/m/Y') : 'N/A'); ?></td>
                        <td><?php echo e($session->duration_minutes ? number_format($session->duration_minutes / 60, 1) : 'N/A'); ?>h</td>
                        <td><?php echo e(Str::limit($session->report_text ?? 'N/A', 50)); ?></td>
                        <td>
                          <span class="badge <?php echo e($session->status === 'validated' ? 'badge-junspro' : ($session->status === 'delivered' ? 'badge-info' : ($session->status === 'rectification_requested' ? 'badge-warning' : 'badge-secondary'))); ?>">
                            <?php echo e(ucfirst($session->status)); ?>

                          </span>
                        </td>
                        <td>
                          <?php echo e($session->rectification_count ?? 0); ?>/<?php echo e($subscription->max_rectifications_per_delivery ?? 2); ?>

                          <?php if($session->status === 'delivered' && ($session->rectification_count ?? 0) < ($subscription->max_rectifications_per_delivery ?? 2)): ?>
                            <br>
                            <button type="button" class="btn btn-sm btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#rectificationModal<?php echo e($session->id); ?>">
                              <i class="fas fa-edit me-1"></i><?php echo e(__('Demander rectification')); ?>

                            </button>
                          <?php endif; ?>
                        </td>
                      </tr>
                      
                      <!-- Modal rectification -->
                      <div class="modal fade" id="rectificationModal<?php echo e($session->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title"><?php echo e(__('Demander une rectification')); ?></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="<?php echo e(route('client.work-session.rectify', $session->id)); ?>" method="POST">
                              <?php echo csrf_field(); ?>
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label class="form-label"><?php echo e(__('Raison de la rectification')); ?> *</label>
                                  <textarea name="reason" class="form-control" rows="4" required placeholder="<?php echo e(__('Expliquez ce qui doit être modifié...')); ?>"></textarea>
                                </div>
                                <div class="alert alert-info">
                                  <small>
                                    <?php echo e(__('Rectifications restantes')); ?> : <?php echo e(($subscription->max_rectifications_per_delivery ?? 2) - ($session->rectification_count ?? 0)); ?>

                                  </small>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Annuler')); ?></button>
                                <button type="submit" class="btn btn-warning"><?php echo e(__('Demander la rectification')); ?></button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>

              <div class="mt-30">
                <?php echo e($workSessions->links()); ?>

              </div>
            <?php else: ?>
              <div class="alert alert-info">
                <?php echo e(__('Aucune livraison pour le moment.')); ?>

              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\subscriptions\show.blade.php ENDPATH**/ ?>