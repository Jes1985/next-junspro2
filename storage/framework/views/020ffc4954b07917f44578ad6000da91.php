<?php $__env->startSection('pageHeading'); ?>
  Votre cycle Pause Souffle est activé | <?php echo e($websiteInfo->website_title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  Votre cycle Pause Souffle (4 semaines) est activé. Total : <?php echo e($subscription ? ($subscription->hours_total_month ?? 0) : 0); ?> rituels sur le cycle.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
  .pause-souffle-cycle-confirmation-page {
    min-height: 70vh;
    padding: 4rem 1rem;
    background: #FFFFFF;
  }

  .pause-souffle-cycle-confirmation-container {
    max-width: 800px;
    margin: 0 auto;
  }

  .pause-souffle-cycle-confirmation-header {
    text-align: center;
    margin-bottom: 3rem;
  }

  .pause-souffle-cycle-confirmation-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 1rem;
  }

  .pause-souffle-cycle-confirmation-header p {
    font-size: 1.125rem;
    color: #6B7280;
    line-height: 1.6;
  }

  .pause-souffle-cycle-confirmation-content {
    background: #F9FAFB;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
  }

  .pause-souffle-cycle-confirmation-plan {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem;
    background: #FFFFFF;
    border-radius: 12px;
    margin-bottom: 1.5rem;
  }

  .pause-souffle-cycle-confirmation-plan-info h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 0.5rem;
  }

  .pause-souffle-cycle-confirmation-plan-info p {
    font-size: 0.875rem;
    color: #6B7280;
  }

  .pause-souffle-cycle-confirmation-status {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    background: #D1FAE5;
    color: #065F46;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
  }

  .pause-souffle-cycle-confirmation-status.active::before {
    content: '✓';
    display: inline-block;
    margin-right: 0.5rem;
    font-size: 1rem;
  }

  .pause-souffle-cycle-confirmation-next {
    background: #FFFFFF;
    border-radius: 16px;
    padding: 2rem;
    border: 2px solid #E5E7EB;
  }

  .pause-souffle-cycle-confirmation-next h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 1rem;
  }

  .pause-souffle-cycle-confirmation-next p {
    font-size: 1rem;
    color: #6B7280;
    margin-bottom: 2rem;
    line-height: 1.6;
  }

  .pause-souffle-cycle-confirmation-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
  }

  .pause-souffle-cycle-confirmation-btn {
    display: block;
    padding: 1rem 2rem;
    background: #6366F1;
    color: #FFFFFF;
    text-align: center;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
  }

  .pause-souffle-cycle-confirmation-btn:hover {
    background: #4F46E5;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
  }

  .pause-souffle-cycle-confirmation-btn-secondary {
    background: #FFFFFF;
    color: #6366F1;
    border: 2px solid #6366F1;
  }

  .pause-souffle-cycle-confirmation-btn-secondary:hover {
    background: #F9FAFB;
  }

  .pause-souffle-pending-message {
    text-align: center;
    padding: 2rem;
    background: #FEF3C7;
    border-radius: 12px;
    color: #92400E;
  }

  @media (max-width: 768px) {
    .pause-souffle-cycle-confirmation-header h1 {
      font-size: 2rem;
    }

    .pause-souffle-cycle-confirmation-plan {
      flex-direction: column;
      align-items: flex-start;
      gap: 1rem;
    }

    .pause-souffle-cycle-confirmation-actions {
      grid-template-columns: 1fr;
    }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="pause-souffle-cycle-confirmation-page">
  <div class="pause-souffle-cycle-confirmation-container">
    <?php if($pending ?? false): ?>
      <div class="pause-souffle-pending-message">
        <p>Votre paiement est en cours de traitement. Vous recevrez une confirmation sous peu.</p>
        <p style="margin-top: 1rem; font-size: 0.875rem;">Si la page ne se met pas à jour automatiquement, <a href="<?php echo e(route('pause-souffle.cycle-confirmation', ['intake_id' => $intake->id])); ?>" style="color: #92400E; text-decoration: underline;">actualisez la page</a>.</p>
      </div>
    <?php else: ?>
      <div class="pause-souffle-cycle-confirmation-header">
        <h1>Votre cycle Pause Souffle (4 semaines) est activé</h1>
        <p>Total : <strong><?php echo e($subscription ? ($subscription->hours_total_month ?? 0) : 0); ?> rituels</strong> sur le cycle.</p>
      </div>

      <?php if($subscription): ?>
        <div class="pause-souffle-cycle-confirmation-content">
          <div class="pause-souffle-cycle-confirmation-plan">
            <div class="pause-souffle-cycle-confirmation-plan-info">
              <h3>Cycle activé</h3>
              <p><?php echo e($subscription->hours_total_month ?? 0); ?> rituels / 4 semaines</p>
            </div>
            <div class="pause-souffle-cycle-confirmation-status active">
              Actif
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="pause-souffle-cycle-confirmation-next">
        <h2>Choisir votre accompagnant</h2>
        <p>
          Vous pouvez maintenant choisir parmi nos accompagnants certifiés Pause Souffle.
          Nous vous recommandons de sélectionner un profil qui correspond à votre situation et vos préférences.
        </p>

        <div class="pause-souffle-cycle-confirmation-actions">
          <a href="<?php echo e(route('services.corporate')); ?>?domain=pause-souffle" class="pause-souffle-cycle-confirmation-btn">
            Choisir un accompagnant
          </a>
          <a href="<?php echo e(route('services.corporate')); ?>?domain=pause-souffle&recommended=1" class="pause-souffle-cycle-confirmation-btn pause-souffle-cycle-confirmation-btn-secondary">
            Voir 3 profils recommandés
          </a>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\presence\pause-souffle-cycle-confirmation.blade.php ENDPATH**/ ?>