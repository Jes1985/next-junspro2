<?php $__env->startSection('title', 'Paiement Annulé - Junspro'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-warning">
                <div class="card-header bg-warning text-dark text-center">
                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                    <h3 class="mb-0">Paiement Annulé</h3>
                </div>
                <div class="card-body p-4 text-center">
                    <p class="lead">Votre paiement a été annulé.</p>
                    <p>Vous pouvez réessayer à tout moment.</p>
                    
                    <div class="mt-4">
                        <a href="<?php echo e(route('mission.form')); ?>" class="btn btn-primary me-2">
                            <i class="fas fa-redo me-2"></i>Réessayer
                        </a>
                        <a href="<?php echo e(route('index')); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-home me-2"></i>Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\mission-cancel.blade.php ENDPATH**/ ?>