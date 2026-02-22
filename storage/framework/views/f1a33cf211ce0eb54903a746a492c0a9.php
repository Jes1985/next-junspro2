<?php $__env->startSection('title', 'Gestion des Missions'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-tasks me-2"></i>Gestion des Missions</h2>
                <div class="alert alert-info mb-0">
                    <small>
                        <i class="fas fa-info-circle me-1"></i>
                        <strong>Rappel :</strong> 20% de frais de protection Junspro sont appliqués sur chaque facture client. 
                        Ils couvrent l'assistance, la sécurité, les outils techniques et la modération.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.missions.index')); ?>" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="">Tous</option>
                        <option value="En_attente" <?php echo e(request('statut') === 'En_attente' ? 'selected' : ''); ?>>En attente</option>
                        <option value="Paiement_valide" <?php echo e(request('statut') === 'Paiement_valide' ? 'selected' : ''); ?>>Paiement validé</option>
                        <option value="RDV_planifie" <?php echo e(request('statut') === 'RDV_planifie' ? 'selected' : ''); ?>>RDV planifié</option>
                        <option value="Termine" <?php echo e(request('statut') === 'Termine' ? 'selected' : ''); ?>>Terminé</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Offre</label>
                    <select name="offre" class="form-select">
                        <option value="">Toutes</option>
                        <option value="Accompagnement" <?php echo e(request('offre') === 'Accompagnement' ? 'selected' : ''); ?>>Accompagnement</option>
                        <option value="Mise_en_relation" <?php echo e(request('offre') === 'Mise_en_relation' ? 'selected' : ''); ?>>Mise en relation</option>
                        <option value="Aucune" <?php echo e(request('offre') === 'Aucune' ? 'selected' : ''); ?>>Aucune</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Recherche</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Nom, email, ID mission..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i>Filtrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau des missions -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Email</th>
                            <th>Budget</th>
                            <th>Offre</th>
                            <th>Bonus</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $missions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>#<?php echo e($mission->id_mission); ?></td>
                            <td><?php echo e($mission->client_nom); ?></td>
                            <td><?php echo e($mission->client_email); ?></td>
                            <td><?php echo e(number_format($mission->budget, 2, ',', ' ')); ?> €</td>
                            <td>
                                <span class="badge bg-info">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $mission->offre))); ?>

                                </span>
                            </td>
                            <td>
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
                            </td>
                            <td>
                                <?php
                                    $statutColors = [
                                        'En_attente' => 'warning',
                                        'Paiement_valide' => 'info',
                                        'RDV_planifie' => 'primary',
                                        'Termine' => 'success',
                                    ];
                                ?>
                                <span class="badge bg-<?php echo e($statutColors[$mission->statut] ?? 'secondary'); ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $mission->statut))); ?>

                                </span>
                            </td>
                            <td><?php echo e($mission->date_soumission->format('d/m/Y H:i')); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.missions.show', $mission->id_mission)); ?>" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center">Aucune mission trouvée</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($missions->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\missions\index.blade.php ENDPATH**/ ?>