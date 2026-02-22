<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --card-shadow-hover: 0 8px 30px rgba(30, 64, 175, 0.15);
    }

    .client-dashboard-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
      padding-top: 3rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      min-height: calc(100vh - 200px);
    }

    /* Header */
    .projects-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 2rem;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .projects-header-title h1 {
      font-size: 2rem;
      font-weight: 700;
      color: #1f2937;
      margin: 0 0 0.5rem 0;
    }

    .projects-header-title p {
      color: #6b7280;
      font-size: 1rem;
      margin: 0;
    }

    .projects-header-actions {
      display: flex;
      gap: 1rem;
    }

    .btn-junspro-primary {
      background: linear-gradient(135deg, #7C3AED 0%, #1e40af 100%);
      color: white;
      padding: 0.75rem 1.5rem;
      border-radius: 12px;
      border: none;
      font-weight: 500;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.2s ease;
      box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
    }

    .btn-junspro-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
      color: white;
    }

    .btn-junspro-secondary {
      background: white;
      color: #7C3AED;
      padding: 0.75rem 1.5rem;
      border-radius: 12px;
      border: 2px solid #7C3AED;
      font-weight: 500;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      transition: all 0.2s ease;
    }

    .btn-junspro-secondary:hover {
      background: #f3f4f6;
      color: #7C3AED;
    }

    /* Bandeau synthèse */
    .stats-overview {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 3rem;
    }

    .stat-card {
      background: white;
      border-radius: 16px;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .stat-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--card-shadow-hover);
    }

    .stat-card-title {
      font-size: 0.875rem;
      color: #6b7280;
      font-weight: 500;
      margin-bottom: 0.5rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .stat-card-value {
      font-size: 2rem;
      font-weight: 700;
      color: var(--junspro-purple);
      margin-bottom: 0.25rem;
    }

    .stat-card-subtitle {
      font-size: 0.875rem;
      color: #9ca3af;
    }

    /* Section projets actifs */
    .section-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 0.5rem;
    }

    .section-subtitle {
      color: #6b7280;
      margin-bottom: 2rem;
    }

    .projects-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 1.5rem;
      margin-bottom: 3rem;
    }

    @media (max-width: 768px) {
      .projects-grid {
        grid-template-columns: 1fr;
      }
    }

    .project-card {
      background: white;
      border-radius: 16px;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      transition: all 0.2s ease;
    }

    .project-card:hover {
      box-shadow: var(--card-shadow-hover);
    }

    .project-card-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #e5e7eb;
    }

    .project-freelancer-avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: var(--junspro-gradient);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 600;
      font-size: 1.125rem;
    }

    .project-freelancer-info h3 {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1f2937;
      margin: 0 0 0.25rem 0;
    }

    .project-category {
      display: inline-block;
      background: #f3f4f6;
      color: #6b7280;
      padding: 0.25rem 0.75rem;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 500;
    }

    .project-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 1rem;
    }

    .project-hours-block {
      background: #f9fafb;
      border-radius: 12px;
      padding: 1rem;
      margin-bottom: 1rem;
    }

    .project-hours-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.5rem;
      font-size: 0.875rem;
    }

    .project-hours-row:last-child {
      margin-bottom: 0;
    }

    .project-hours-label {
      color: #6b7280;
    }

    .project-hours-value {
      font-weight: 600;
      color: #1f2937;
    }

    .project-progress-bar {
      width: 100%;
      height: 8px;
      background: #e5e7eb;
      border-radius: 4px;
      overflow: hidden;
      margin-top: 0.75rem;
    }

    .project-progress-fill {
      height: 100%;
      background: var(--junspro-gradient);
      transition: width 0.3s ease;
    }

    .project-sessions-block {
      margin-bottom: 1rem;
      padding: 1rem;
      background: #f9fafb;
      border-radius: 12px;
    }

    .project-sessions-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.5rem;
      font-size: 0.875rem;
    }

    .project-sessions-row:last-child {
      margin-bottom: 0;
    }

    .project-actions {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
      margin-top: 1.5rem;
    }

    .btn-project-action {
      flex: 1;
      min-width: 120px;
      padding: 0.625rem 1rem;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
      background: white;
      color: #6b7280;
      font-weight: 500;
      text-decoration: none;
      text-align: center;
      transition: all 0.2s ease;
      font-size: 0.875rem;
    }

    .btn-project-action:hover {
      background: #f3f4f6;
      border-color: var(--junspro-purple);
      color: var(--junspro-purple);
    }

    .btn-project-action-primary {
      background: var(--junspro-gradient);
      color: white;
      border: none;
    }

    .btn-project-action-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
      color: white;
    }

    /* Discipline badge */
    .discipline-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.375rem 0.75rem;
      border-radius: 8px;
      font-size: 0.75rem;
      font-weight: 500;
      margin-top: 0.5rem;
    }

    .discipline-badge.good {
      background: #d1fae5;
      color: #065f46;
    }

    .discipline-badge.warning {
      background: #fef3c7;
      color: #92400e;
    }

    /* Empty state */
    .empty-state {
      text-align: center;
      padding: 4rem 2rem;
      background: white;
      border-radius: 16px;
      box-shadow: var(--card-shadow);
    }

    .empty-state-icon {
      font-size: 4rem;
      color: #d1d5db;
      margin-bottom: 1rem;
    }

    .empty-state h3 {
      font-size: 1.5rem;
      color: #1f2937;
      margin-bottom: 0.5rem;
    }

    .empty-state p {
      color: #6b7280;
      margin-bottom: 2rem;
    }

    /* Projets terminés */
    .archived-projects {
      margin-top: 4rem;
    }

    .archived-project-item {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 1rem;
      box-shadow: var(--card-shadow);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .archived-project-info h4 {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1f2937;
      margin: 0 0 0.5rem 0;
    }

    .archived-project-meta {
      display: flex;
      gap: 1.5rem;
      color: #6b7280;
      font-size: 0.875rem;
    }

    /* Résumé consommation */
    .consumption-summary {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 3rem;
    }

    .consumption-placeholder {
      text-align: center;
      padding: 3rem;
      color: #9ca3af;
      font-style: italic;
    }

    /* Lien blog */
    .blog-link-section {
      text-align: center;
      padding: 2rem;
      margin-top: 3rem;
      border-top: 1px solid #e5e7eb;
    }

    .blog-link-section h3 {
      font-size: 1.125rem;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    .blog-link-section a {
      color: var(--junspro-purple);
      text-decoration: none;
      font-weight: 500;
    }

    .blog-link-section a:hover {
      text-decoration: underline;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="client-dashboard-container">
    <?php echo $__env->make('frontend.client.partials.dashboard-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <!-- Header -->
    <div class="projects-header">
      <div class="projects-header-title">
        <h1><?php echo e(__('Mes projets & heures')); ?></h1>
        <p><?php echo e(__('Suivez vos projets, vos heures consommées et vos prochaines sessions avec vos freelances.')); ?></p>
      </div>
      <div class="projects-header-actions">
        <a href="<?php echo e(route('explore')); ?>" class="btn-junspro-primary">
          <i class="fas fa-search"></i>
          <?php echo e(__('Trouver un freelance')); ?>

        </a>
      </div>
    </div>

    <!-- Bandeau synthèse -->
    <div class="stats-overview">
      <div class="stat-card" onclick="document.getElementById('active-projects').scrollIntoView({behavior: 'smooth'})">
        <div class="stat-card-title"><?php echo e(__('Projets en cours')); ?></div>
        <div class="stat-card-value"><?php echo e($stats['active_projects_count']); ?></div>
        <div class="stat-card-subtitle"><?php echo e(__('projets actifs')); ?></div>
      </div>
      
      <div class="stat-card">
        <div class="stat-card-title"><?php echo e(__('Heures restantes cette semaine')); ?></div>
        <div class="stat-card-value"><?php echo e(number_format($stats['total_hours_remaining_this_week'], 1)); ?>h</div>
        <div class="stat-card-subtitle"><?php echo e(__('disponibles sur vos abonnements')); ?></div>
            </div>

      <div class="stat-card">
        <div class="stat-card-title"><?php echo e(__('Prochaine session planifiée')); ?></div>
        <?php if($stats['next_session']): ?>
          <?php
            $nextSession = $stats['next_session']['session'];
            $freelancer = $stats['next_session']['freelancer'];
            $sessionDate = \Carbon\Carbon::parse($nextSession->start_at);
          ?>
          <div class="stat-card-value" style="font-size: 1.25rem;">
            <?php if($sessionDate->isToday()): ?>
              <?php echo e(__('Aujourd\'hui')); ?>, <?php echo e($sessionDate->format('H:i')); ?>

            <?php elseif($sessionDate->isTomorrow()): ?>
              <?php echo e(__('Demain')); ?>, <?php echo e($sessionDate->format('H:i')); ?>

            <?php else: ?>
              <?php echo e($sessionDate->format('d/m')); ?>, <?php echo e($sessionDate->format('H:i')); ?>

                            <?php endif; ?>
          </div>
          <div class="stat-card-subtitle"><?php echo e(__('avec')); ?> <?php echo e($freelancer->name ?? 'N/A'); ?></div>
        <?php else: ?>
          <div class="stat-card-value" style="font-size: 1.25rem;">—</div>
          <div class="stat-card-subtitle"><?php echo e(__('Aucune session planifiée')); ?></div>
                            <?php endif; ?>
      </div>
    </div>

    <!-- Section Projets actifs -->
    <section id="active-projects">
      <h2 class="section-title"><?php echo e(__('Projets actifs')); ?></h2>
      <p class="section-subtitle"><?php echo e(__('Vos collaborations en cours avec les freelances Junspro.')); ?></p>

      <?php if($activeSubscriptions->count() > 0): ?>
        <div class="projects-grid">
          <?php $__currentLoopData = $activeSubscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $freelancer = $subscription->freelancer->user ?? null;
              $freelancerName = $freelancer->name ?? 'N/A';
              $freelancerInitials = strtoupper(substr($freelancerName, 0, 1));
              
              // Calculer le rythme de travail (discipline)
              $lastSession = $subscription->last_report;
              $daysSinceLastSession = $lastSession ? now()->diffInDays($lastSession->end_at) : null;
              $isRegular = $daysSinceLastSession !== null && $daysSinceLastSession <= 7;
              
              // Reprogrammations restantes (placeholder - à implémenter)
              $remainingRebooks = 2; // À récupérer depuis le modèle
            ?>
            
            <div class="project-card">
              <div class="project-card-header">
                <div class="project-freelancer-avatar">
                  <?php echo e($freelancerInitials); ?>

                </div>
                <div class="project-freelancer-info">
                  <h3><?php echo e($freelancerName); ?></h3>
                  <span class="project-category"><?php echo e(__('Abonnement')); ?> <?php echo e($subscription->hours_per_week); ?>h/semaine</span>
                </div>
              </div>

              <div class="project-title">
                <?php echo e(__('Projet')); ?> #<?php echo e($subscription->id); ?>

              </div>

              <!-- Bloc Heures -->
              <div class="project-hours-block">
                <div class="project-hours-row">
                  <span class="project-hours-label"><?php echo e(__('Tarif')); ?></span>
                  <span class="project-hours-value"><?php echo e(number_format($subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0, 0)); ?> € / h</span>
                </div>
                <div class="project-hours-row">
                  <span class="project-hours-label"><?php echo e(__('Heures incluses')); ?></span>
                  <span class="project-hours-value"><?php echo e(number_format($subscription->calculated_total_hours, 1)); ?> h</span>
                </div>
                <div class="project-hours-row">
                  <span class="project-hours-label"><?php echo e(__('Heures consommées')); ?></span>
                  <span class="project-hours-value"><?php echo e(number_format($subscription->calculated_used_hours, 1)); ?> h</span>
                </div>
                <div class="project-hours-row">
                  <span class="project-hours-label"><?php echo e(__('Heures restantes')); ?></span>
                  <span class="project-hours-value" style="color: var(--junspro-purple);"><?php echo e(number_format($subscription->calculated_hours_remaining, 1)); ?> h</span>
                </div>
                <div class="project-progress-bar">
                  <div class="project-progress-fill" style="width: <?php echo e($subscription->calculated_progress_percent); ?>%"></div>
                          </div>
              </div>

              <!-- Bloc Sessions -->
              <div class="project-sessions-block">
                <?php if($subscription->next_session): ?>
                  <div class="project-sessions-row">
                    <span class="project-hours-label"><?php echo e(__('Prochaine session')); ?></span>
                    <span class="project-hours-value">
                      <?php echo e(\Carbon\Carbon::parse($subscription->next_session->start_at)->format('d/m, H:i')); ?>

                    </span>
                  </div>
                <?php endif; ?>
                <?php if($subscription->last_report): ?>
                  <div class="project-sessions-row">
                    <span class="project-hours-label"><?php echo e(__('Dernier rapport')); ?></span>
                    <span class="project-hours-value">
                      <?php echo e(\Carbon\Carbon::parse($subscription->last_report->end_at)->format('d M, H:i')); ?>

                    </span>
                  </div>
                <?php endif; ?>
                <div class="project-sessions-row">
                  <span class="project-hours-label"><?php echo e(__('Reprogrammations restantes (freelance)')); ?></span>
                  <span class="project-hours-value"><?php echo e($remainingRebooks); ?> / 2</span>
                </div>
              </div>

              <!-- Badge discipline -->
              <?php if($daysSinceLastSession !== null): ?>
                <div class="discipline-badge <?php echo e($isRegular ? 'good' : 'warning'); ?>">
                  <i class="fas <?php echo e($isRegular ? 'fa-check-circle' : 'fa-exclamation-circle'); ?>"></i>
                  <?php echo e($isRegular ? __('Rythme de travail régulier') : __('Sessions espacées – risque de retard')); ?>

                </div>
              <?php endif; ?>

              <!-- Actions -->
              <div class="project-actions">
                <a href="<?php echo e(route('client.subscriptions.show', $subscription->id)); ?>" class="btn-project-action">
                  <i class="fas fa-eye"></i> <?php echo e(__('Voir le détail')); ?>

                </a>
                <a href="<?php echo e(route('explore')); ?>" class="btn-project-action btn-project-action-primary">
                  <i class="fas fa-plus"></i> <?php echo e(__('Ajouter des heures')); ?>

                </a>
                <a href="<?php echo e(route('user.messages.index', ['conversation' => $subscription->id])); ?>" class="btn-project-action">
                  <i class="fas fa-calendar"></i> <?php echo e(__('Calendrier')); ?>

                </a>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            <?php else: ?>
        <div class="empty-state">
          <div class="empty-state-icon">
            <i class="far fa-folder-open"></i>
          </div>
          <h3><?php echo e(__("Vous n'avez pas encore de projet en cours")); ?></h3>
          <p><?php echo e(__('Trouvez un freelance pour lancer votre première collaboration.')); ?></p>
          <a href="<?php echo e(route('explore')); ?>" class="btn-junspro-primary">
            <i class="fas fa-search"></i>
            <?php echo e(__('Trouver un freelance')); ?>

          </a>
              </div>
            <?php endif; ?>
    </section>

    <!-- Section Résumé consommation -->
    <section class="consumption-summary">
      <h2 class="section-title"><?php echo e(__("Votre consommation d'heures")); ?></h2>
      <div class="consumption-placeholder">
        <p><?php echo e(__('Graphiques de consommation prochainement disponibles')); ?></p>
        <div style="margin-top: 1rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
          <div>
            <div class="stat-card-value" style="font-size: 1.5rem;"><?php echo e(number_format($stats['hours_consumed_this_month'], 1)); ?>h</div>
            <div class="stat-card-title"><?php echo e(__('Heures consommées ce mois-ci')); ?></div>
          </div>
          <div>
            <div class="stat-card-value" style="font-size: 1.5rem;"><?php echo e($stats['hours_planned_next_7_days']); ?></div>
            <div class="stat-card-title"><?php echo e(__('Sessions prévues sur les 7 prochains jours')); ?></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section Projets terminés -->
    <?php if($archivedSubscriptions->count() > 0): ?>
      <section class="archived-projects">
        <h2 class="section-title"><?php echo e(__('Projets terminés & archivés')); ?></h2>
        <p class="section-subtitle"><?php echo e(__('Vos projets précédents avec leurs freelances.')); ?></p>

        <?php $__currentLoopData = $archivedSubscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $freelancer = $subscription->freelancer->user ?? null;
            $freelancerName = $freelancer->name ?? 'N/A';
            $startDate = $subscription->starts_at ? \Carbon\Carbon::parse($subscription->starts_at) : null;
            $endDate = $subscription->ends_at ? \Carbon\Carbon::parse($subscription->ends_at) : $subscription->updated_at;
            $duration = $startDate ? $startDate->diffForHumans($endDate, true) : null;
          ?>
          
          <div class="archived-project-item">
            <div class="archived-project-info">
              <h4><?php echo e(__('Projet')); ?> #<?php echo e($subscription->id); ?></h4>
              <div class="archived-project-meta">
                <span><i class="fas fa-user"></i> <?php echo e($freelancerName); ?></span>
                <span><i class="fas fa-clock"></i> <?php echo e(number_format($subscription->total_hours_worked, 1)); ?> h</span>
                <?php if($duration): ?>
                  <span><i class="fas fa-calendar"></i> <?php echo e($duration); ?></span>
                <?php endif; ?>
                <span class="badge badge-secondary"><?php echo e(ucfirst($subscription->status)); ?></span>
              </div>
            </div>
            <div style="display: flex; gap: 0.75rem;">
              <a href="<?php echo e(route('client.subscriptions.show', $subscription->id)); ?>" class="btn-project-action">
                <?php echo e(__('Voir le détail')); ?>

              </a>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </section>
    <?php endif; ?>

    <!-- Lien blog -->
    <div class="blog-link-section">
      <h3><?php echo e(__('Envie de mieux piloter vos projets ?')); ?></h3>
      <a href="<?php echo e(route('blog')); ?>"><?php echo e(__('Lire les conseils Junspro sur le blog')); ?></a>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\subscriptions\index.blade.php ENDPATH**/ ?>