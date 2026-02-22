<?php $__env->startSection('title', 'Détails Mission #' . $mission->id_mission); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-eye me-2"></i>Mission #<?php echo e($mission->id_mission); ?></h2>
                <a href="<?php echo e(route('admin.missions.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Retour
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Informations Client -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Informations Client</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nom :</strong> <?php echo e($mission->client_nom); ?></p>
                            <p><strong>Email :</strong> <?php echo e($mission->client_email); ?></p>
                            <p><strong>Téléphone :</strong> <?php echo e($mission->client_telephone ?? 'Non renseigné'); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Date de soumission :</strong> <?php echo e($mission->date_soumission->format('d/m/Y à H:i')); ?></p>
                            <p><strong>Statut :</strong> 
                                <span class="badge bg-<?php echo e($mission->statut === 'Termine' ? 'success' : 'warning'); ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $mission->statut))); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Mission -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Description de la Mission</h5>
                </div>
                <div class="card-body">
                    <p><?php echo e($mission->description_mission); ?></p>
                    <p><strong>Budget :</strong> <?php echo e(number_format($mission->budget, 2, ',', ' ')); ?> €</p>
                </div>
            </div>

            <!-- Fichier joint -->
            <?php if($mission->fichier_joint): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-paperclip me-2"></i>Fichier Joint</h5>
                </div>
                <div class="card-body">
                    <a href="<?php echo e(Storage::url($mission->fichier_joint)); ?>" target="_blank" class="btn btn-outline-primary">
                        <i class="fas fa-download me-1"></i>Télécharger le fichier
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <!-- Options et Bonus -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-gift me-2"></i>Options & Bonus</h5>
                </div>
                <div class="card-body">
                    <p><strong>Offre choisie :</strong></p>
                    <span class="badge bg-primary mb-2">
                        <?php echo e(ucfirst(str_replace('_', ' ', $mission->offre))); ?>

                    </span>
                    
                    <p class="mt-3"><strong>Bonus bien-être :</strong></p>
                    <?php if($mission->bonus !== 'Aucun'): ?>
                        <?php
                            $bonusLabels = [
                                'Vitalite' => 'Vitalité',
                                'Serenite' => 'Sérénité',
                                'Equilibre' => 'Équilibre',
                            ];
                        ?>
                        <span class="badge bg-success">
                            <?php echo e($bonusLabels[$mission->bonus] ?? $mission->bonus); ?>

                        </span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Aucun</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Liens et RDV -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-link me-2"></i>Liens & Rendez-vous</h5>
                </div>
                <div class="card-body">
                    <?php if($mission->calendly_link): ?>
                        <p><strong>Lien Calendly :</strong></p>
                        <a href="<?php echo e($mission->calendly_link); ?>" target="_blank" class="btn btn-sm btn-outline-primary mb-2">
                            <i class="fas fa-calendar me-1"></i>Voir Calendly
                        </a>
                    <?php endif; ?>

                    <?php if($mission->zoom_link): ?>
                        <p class="mt-3"><strong>Lien Zoom :</strong></p>
                        <a href="<?php echo e($mission->zoom_link); ?>" target="_blank" class="btn btn-sm btn-outline-primary mb-2">
                            <i class="fas fa-video me-1"></i>Rejoindre Zoom
                        </a>
                        <?php if($mission->zoom_meeting_id): ?>
                            <p><small>ID Réunion : <?php echo e($mission->zoom_meeting_id); ?></small></p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if($mission->date_rdv): ?>
                        <p class="mt-3"><strong>Date du RDV :</strong></p>
                        <p><?php echo e($mission->date_rdv->format('d/m/Y à H:i')); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Paiement -->
            <?php if($mission->stripe_payment_id): ?>
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Paiement</h5>
                </div>
                <div class="card-body">
                    <p><strong>ID Paiement Stripe :</strong></p>
                    <p><small><?php echo e($mission->stripe_payment_id); ?></small></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Freelances proposés -->
            <?php if($mission->freelance_propose): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Freelances Proposés</h5>
                </div>
                <div class="card-body">
                    <?php if(is_array($mission->freelance_propose)): ?>
                        <ul>
                            <?php $__currentLoopData = $mission->freelance_propose; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $freelance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e(is_array($freelance) ? ($freelance['name'] ?? 'N/A') : $freelance); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p><?php echo e($mission->freelance_propose); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Mettre à jour le statut -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Mettre à jour</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('admin.missions.update-status', $mission->id_mission)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-select">
                                <option value="En_attente" <?php echo e($mission->statut === 'En_attente' ? 'selected' : ''); ?>>En attente</option>
                                <option value="Paiement_valide" <?php echo e($mission->statut === 'Paiement_valide' ? 'selected' : ''); ?>>Paiement validé</option>
                                <option value="RDV_planifie" <?php echo e($mission->statut === 'RDV_planifie' ? 'selected' : ''); ?>>RDV planifié</option>
                                <option value="Termine" <?php echo e($mission->statut === 'Termine' ? 'selected' : ''); ?>>Terminé</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-1"></i>Mettre à jour
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\missions\show.blade.php ENDPATH**/ ?>