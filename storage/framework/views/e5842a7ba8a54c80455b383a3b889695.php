

<?php $__env->startSection('pageHeading', __('Conditions du parrainage')); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/referral-premium.css')); ?>?v=<?php echo e(time()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="referral-conditions-container">
    <div class="referral-conditions-content">
      <h1 class="referral-conditions-title"><?php echo e(__('Conditions du programme de parrainage')); ?></h1>
      
      <div class="referral-conditions-section">
        <h2><?php echo e(__('Éligibilité')); ?></h2>
        <p><?php echo e(__('Pour bénéficier du programme de parrainage :')); ?></p>
        <ul>
          <li><?php echo e(__('Le filleul doit effectuer sa première réservation éligible d\'un montant minimum de :amount€', ['amount' => $config['min_eligible_amount']])); ?></li>
          <li><?php echo e(__('La première prestation doit être confirmée (payée et non annulée/non remboursée)')); ?></li>
          <li><?php echo e(__('Un utilisateur ne peut être parrainé qu\'une seule fois')); ?></li>
          <li><?php echo e(__('L\'auto-parrainage est strictement interdit')); ?></li>
        </ul>
      </div>

      <div class="referral-conditions-section">
        <h2><?php echo e(__('Récompenses')); ?></h2>
        <p><strong><?php echo e(__('Pour le parrain :')); ?></strong></p>
        <ul>
          <li><?php echo e(__('Vous recevez :amount€ de crédit Junspro après confirmation de la première prestation de votre filleul', ['amount' => $config['reward_amount']])); ?></li>
          <li><?php echo e(__('Le crédit est ajouté à votre solde et appliqué automatiquement lors du paiement de vos prochains cours')); ?></li>
          <li><?php echo e(__('Le délai d\'attribution peut prendre jusqu\'à :hours heures pour vérification', ['hours' => $config['cooldown_hours']])); ?></li>
        </ul>
        
        <p><strong><?php echo e(__('Pour le filleul :')); ?></strong></p>
        <ul>
          <li><?php echo e(__('Vous bénéficiez de :benefit_label sur votre première réservation éligible', ['benefit_label' => $config['benefit_label']])); ?></li>
          <li><?php echo e(__('L\'avantage s\'applique automatiquement au checkout pour les réservations d\'au moins :amount€', ['amount' => $config['min_eligible_amount']])); ?></li>
        </ul>
      </div>

      <div class="referral-conditions-section">
        <h2><?php echo e(__('Anti-abus')); ?></h2>
        <ul>
          <li><?php echo e(__('Un filleul ne peut avoir qu\'un seul parrain')); ?></li>
          <li><?php echo e(__('L\'auto-parrainage est strictement interdit et entraînera l\'annulation du parrainage')); ?></li>
          <li><?php echo e(__('Si la première réservation est annulée ou remboursée, la récompense ne peut pas être accordée')); ?></li>
          <li><?php echo e(__('La récompense sera déclenchée dès qu\'une première prestation éligible est confirmée')); ?></li>
        </ul>
      </div>

      <div class="referral-conditions-section">
        <h2><?php echo e(__('Plafond mensuel')); ?></h2>
        <p><?php echo e(__('Le montant total des récompenses est plafonné à :amount€ par mois et par parrain.', ['amount' => $config['monthly_cap']])); ?></p>
        <p><?php echo e(__('Si le plafond est atteint, les nouvelles récompenses seront reportées au mois suivant.')); ?></p>
      </div>

      <div class="referral-conditions-section">
        <h2><?php echo e(__('Support')); ?></h2>
        <p><?php echo e(__('Pour toute question concernant le programme de parrainage, contactez notre support avec l\'email du proche invité ou une capture d\'écran.')); ?></p>
        <p><a href="<?php echo e(route('contact')); ?>" class="referral-link"><?php echo e(__('Contacter le support')); ?></a></p>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\referral\conditions.blade.php ENDPATH**/ ?>