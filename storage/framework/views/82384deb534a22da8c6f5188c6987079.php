<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Annuler mon abonnement')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Annuler mon abonnement')])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Annuler mon abonnement')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div class="user-profile-details mb-30">
            <!-- Étape 1 : Alternatives proposées -->
            <div class="card mb-4" id="step1">
              <div class="card-body">
                <h4 class="card-title mb-4">
                  <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                  <?php echo e(__('Votre projet est important. Voyons si on peut adapter votre abonnement.')); ?>

                </h4>
                <p class="text-muted mb-4">
                  <?php echo e(__('Avant d\'annuler, nous vous proposons plusieurs alternatives :')); ?>

                </p>

                <form method="POST" action="<?php echo e(route('client.subscriptions.cancel.submit', $subscription->id)); ?>">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="action" value="alternative">

                  <div class="row g-3">
                    <div class="col-md-6">
                      <button type="submit" name="alternative" value="pause" class="btn btn-outline-warning w-100 p-4 h-100">
                        <i class="fas fa-pause fa-2x mb-2"></i>
                        <div class="fw-bold"><?php echo e(__('Mettre en pause')); ?></div>
                        <small class="text-muted"><?php echo e(__('Gel temporaire de votre abonnement')); ?></small>
                      </button>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" name="alternative" value="change_freelancer" class="btn btn-outline-info w-100 p-4 h-100">
                        <i class="fas fa-exchange-alt fa-2x mb-2"></i>
                        <div class="fw-bold"><?php echo e(__('Changer de freelance')); ?></div>
                        <small class="text-muted"><?php echo e(__('Transférer vers un autre freelance')); ?></small>
                      </button>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" name="alternative" value="modify_formula" class="btn btn-outline-primary w-100 p-4 h-100">
                        <i class="fas fa-edit fa-2x mb-2"></i>
                        <div class="fw-bold"><?php echo e(__('Modifier la formule')); ?></div>
                        <small class="text-muted"><?php echo e(__('Ajuster les heures par semaine')); ?></small>
                      </button>
                    </div>
                    <div class="col-md-6">
                      <button type="button" onclick="showStep2()" class="btn btn-outline-danger w-100 p-4 h-100">
                        <i class="fas fa-times-circle fa-2x mb-2"></i>
                        <div class="fw-bold"><?php echo e(__('Continuer l\'annulation')); ?></div>
                        <small class="text-muted"><?php echo e(__('Procéder à l\'annulation définitive')); ?></small>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- Étape 2 : Choix de la raison -->
            <div class="card mb-4" id="step2" style="display: none;">
              <div class="card-body">
                <h4 class="card-title mb-4"><?php echo e(__('Pourquoi souhaitez-vous annuler ?')); ?></h4>
                <p class="text-muted mb-4"><?php echo e(__('Votre avis nous aide à améliorer notre service.')); ?></p>

                <form method="POST" action="<?php echo e(route('client.subscriptions.cancel.submit', $subscription->id)); ?>">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="action" value="confirm_cancel">

                  <div class="mb-3">
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_price" value="trop_cher" required>
                      <label class="form-check-label" for="reason_price">
                        <?php echo e(__('Trop cher')); ?>

                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_hours" value="trop_heures_non_utilisees">
                      <label class="form-check-label" for="reason_hours">
                        <?php echo e(__('Trop d\'heures non utilisées')); ?>

                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_freelancer" value="probleme_freelance">
                      <label class="form-check-label" for="reason_freelancer">
                        <?php echo e(__('Problème avec le freelance')); ?>

                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_quality" value="qualite_insuffisante">
                      <label class="form-check-label" for="reason_quality">
                        <?php echo e(__('Qualité insuffisante')); ?>

                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_project" value="projet_termine">
                      <label class="form-check-label" for="reason_project">
                        <?php echo e(__('Projet terminé')); ?>

                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_other" value="autre">
                      <label class="form-check-label" for="reason_other">
                        <?php echo e(__('Autre')); ?>

                      </label>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="reason_details" class="form-label"><?php echo e(__('Détails (optionnel)')); ?></label>
                    <textarea name="reason_details" id="reason_details" class="form-control" rows="3" placeholder="<?php echo e(__('Précisez votre raison si vous le souhaitez...')); ?>"></textarea>
                  </div>

                  <div class="d-flex gap-2">
                    <button type="button" onclick="showStep1()" class="btn btn-secondary">
                      <i class="fas fa-arrow-left me-1"></i><?php echo e(__('Retour')); ?>

                    </button>
                    <button type="submit" class="btn btn-danger">
                      <?php echo e(__('Continuer')); ?><i class="fas fa-arrow-right ms-1"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <!-- Étape 3 : Confirmation -->
            <div class="card mb-4" id="step3" style="display: none;">
              <div class="card-body">
                <h4 class="card-title mb-4 text-danger">
                  <i class="fas fa-exclamation-circle me-2"></i>
                  <?php echo e(__('Confirmation d\'annulation')); ?>

                </h4>
                <div class="alert alert-warning">
                  <strong><?php echo e(__('Attention')); ?> :</strong>
                  <?php echo e(__('Votre abonnement sera arrêté. Plus aucun débit ni nouvelle livraison programmée.')); ?>

                </div>
                <p class="mb-4">
                  <strong><?php echo e(__('Abonnement avec')); ?> :</strong> <?php echo e($subscription->freelancer->user->name ?? 'N/A'); ?><br>
                  <strong><?php echo e(__('Heures/semaine')); ?> :</strong> <?php echo e($subscription->hours_per_week); ?>h<br>
                  <strong><?php echo e(__('Prix 4 semaines')); ?> :</strong> <?php echo e(number_format($subscription->final_price, 2, ',', ' ')); ?> €
                </p>
              </div>
            </div>

            <!-- Étape 4 : Dernière offre -->
            <div class="card mb-4" id="step4" style="display: none;">
              <div class="card-body text-center">
                <h4 class="card-title mb-4"><?php echo e(__('Dernière offre avant de partir')); ?></h4>
                <p class="text-muted mb-4"><?php echo e(__('Nous pouvons vous aider à trouver une solution adaptée :')); ?></p>

                <form method="POST" action="<?php echo e(route('client.subscriptions.cancel.submit', $subscription->id)); ?>">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="action" value="final_offer">
                  <input type="hidden" name="reason" id="final_reason" value="">

                  <div class="row g-3 mb-4">
                    <div class="col-md-4">
                      <button type="submit" name="final_action" value="find_freelancer" class="btn btn-primary w-100 p-3">
                        <i class="fas fa-search me-2"></i><?php echo e(__('Trouver un autre freelance')); ?>

                      </button>
                    </div>
                    <div class="col-md-4">
                      <button type="submit" name="final_action" value="keep" class="btn btn-success w-100 p-3">
                        <i class="fas fa-check me-2"></i><?php echo e(__('Garder mon abonnement')); ?>

                      </button>
                    </div>
                    <div class="col-md-4">
                      <button type="submit" name="final_action" value="cancel" class="btn btn-danger w-100 p-3">
                        <i class="fas fa-times me-2"></i><?php echo e(__('Pas maintenant')); ?>

                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php $__env->startSection('script'); ?>
    <script>
      function showStep1() {
        document.getElementById('step1').style.display = 'block';
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step4').style.display = 'none';
      }

      function showStep2() {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step4').style.display = 'none';
      }

      function showStep3() {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
        document.getElementById('step4').style.display = 'none';
      }

      function showStep4(reason) {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step4').style.display = 'block';
        document.getElementById('final_reason').value = reason;
      }

      // Gérer la soumission du formulaire de l'étape 2
      document.querySelector('form[action*="confirm_cancel"]')?.addEventListener('submit', function(e) {
        const reason = document.querySelector('input[name="reason"]:checked')?.value;
        if (reason) {
          e.preventDefault();
          showStep4(reason);
        }
      });
    </script>
  <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\subscriptions\cancel.blade.php ENDPATH**/ ?>