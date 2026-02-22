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
              <h4><?php echo e(__('Abonnement avec')); ?> <?php echo e($subscription->client->user->name ?? 'N/A'); ?></h4>
            </div>

            <!-- Formulaire d'enregistrement de session -->
            <?php if($subscription->status === 'active'): ?>
              <div class="card mb-30">
                <div class="card-body">
                  <h5 class="mb-20"><?php echo e(__('Enregistrer une session de travail (50 min travail + 10 min rapport)')); ?></h5>
                  
                  <form action="<?php echo e(route('freelancer.subscriptions.work-session', $subscription->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="row">
                      <div class="col-md-6 mb-15">
                        <label><?php echo e(__('Date')); ?> *</label>
                        <input type="date" name="work_date" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                      </div>
                      <div class="col-md-3 mb-15">
                        <label><?php echo e(__('Heure début')); ?></label>
                        <input type="time" name="start_time" class="form-control">
                      </div>
                      <div class="col-md-3 mb-15">
                        <label><?php echo e(__('Heure fin')); ?></label>
                        <input type="time" name="end_time" class="form-control">
                      </div>
                    </div>

                    <div class="mb-15">
                      <label><?php echo e(__('Heures passées')); ?> * (ex: 1.0 pour 1h = 50 min travail + 10 min rapport)</label>
                      <input type="number" name="hours_spent" class="form-control" step="0.5" min="0.5" max="8" value="1.0" required>
                      <small class="text-muted"><?php echo e(__('1h = 50 min de travail + 10 min de rapport détaillé')); ?></small>
                    </div>

                    <div class="mb-15">
                      <label><?php echo e(__('Résumé du travail effectué (rapport)')); ?> * (min 20 caractères)</label>
                      <textarea name="work_summary" class="form-control" rows="5" minlength="20" required placeholder="<?php echo e(__('Décrivez le travail effectué pendant cette session (50 min) et le rapport (10 min)...')); ?>"></textarea>
                    </div>

                    <div class="mb-15">
                      <label><?php echo e(__('Pièces jointes (optionnel)')); ?></label>
                      <input type="file" name="attachments[]" class="form-control" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                      <small class="text-muted"><?php echo e(__('Formats acceptés : PDF, DOC, DOCX, JPG, PNG')); ?></small>
                    </div>

                    <button type="submit" class="btn btn-primary"><?php echo e(__('Enregistrer la session')); ?></button>
                  </form>
                </div>
              </div>
            <?php endif; ?>

            <!-- Liste des sessions -->
            <div class="title mb-30">
              <h5><?php echo e(__('Sessions de travail enregistrées')); ?></h5>
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
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $workSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($session->work_date ? \Carbon\Carbon::parse($session->work_date)->format('d/m/Y') : 'N/A'); ?></td>
                        <td><?php echo e($session->hours_spent ?? $session->duration_minutes / 60); ?>h</td>
                        <td><?php echo e(Str::limit($session->work_summary ?? $session->report_text ?? 'N/A', 50)); ?></td>
                        <td>
                          <span class="badge <?php echo e($session->status === 'validated' ? 'badge-junspro' : ($session->status === 'delivered' ? 'badge-info' : 'badge-warning')); ?>">
                            <?php echo e(ucfirst($session->status)); ?>

                          </span>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>

              <div class="mt-30">
                <?php echo e($workSessions->links()); ?>

              </div>
            <?php else: ?>
              <div class="alert alert-info">
                <?php echo e(__('Aucune session enregistrée pour le moment.')); ?>

              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelancer\subscriptions\show.blade.php ENDPATH**/ ?>