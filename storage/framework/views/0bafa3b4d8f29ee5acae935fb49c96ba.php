<?php $__env->startSection('title', 'Mission Soumise - Junspro'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm" style="border-top: 4px solid #4F46E5;">
                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);">
                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                    <h3 class="mb-0">Mission Soumise avec Succès !</h3>
                </div>
                <div class="card-body p-4 text-center">
                    <p class="lead">Merci <?php echo e($mission->client_nom); ?> !</p>
                    <p>Votre mission a été enregistrée avec succès.</p>
                    
                    <div class="alert alert-info mt-4">
                        <h5>Détails de votre mission :</h5>
                        <ul class="list-unstyled text-start">
                            <li><strong>ID Mission :</strong> #<?php echo e($mission->id_mission); ?></li>
                            <li><strong>Statut :</strong> <?php echo e(ucfirst(str_replace('_', ' ', $mission->statut))); ?></li>
                            <?php if($mission->offre !== 'Aucune'): ?>
                                <li><strong>Offre :</strong> <?php echo e(ucfirst(str_replace('_', ' ', $mission->offre))); ?></li>
                            <?php endif; ?>
                            <?php if($mission->bonus !== 'Aucun'): ?>
                                <li><strong>Bonus :</strong> 
                                    <?php
                                        $bonusLabels = [
                                            'Vitalite' => 'Vitalité',
                                            'Serenite' => 'Sérénité',
                                            'Equilibre' => 'Équilibre',
                                        ];
                                        echo $bonusLabels[$mission->bonus] ?? $mission->bonus;
                                    ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <?php if($mission->statut === 'Paiement_valide' && $mission->calendly_link): ?>
                        <div class="alert alert-warning mt-3">
                            <h6><i class="fas fa-calendar me-2"></i>Prochaine étape :</h6>
                            <p>Veuillez réserver votre créneau via le lien Calendly ci-dessous.</p>
                            <a href="<?php echo e($mission->calendly_link); ?>" target="_blank" class="btn btn-primary">
                                <i class="fas fa-calendar-check me-2"></i>Réserver un créneau
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="mt-4">
                        <a href="<?php echo e(route('index')); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i>Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\mission-success.blade.php ENDPATH**/ ?>