<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <?php echo $__env->make('components.client-upcoming-actions-menu-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --card-shadow-hover: 0 8px 30px rgba(30, 64, 175, 0.15);
    }

    /* Layout principal (style Preply - fond blanc) */
    .client-dashboard-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
      padding-top: 3rem;
      background: #ffffff;
      min-height: calc(100vh - 200px);
      color: #1f2937;
    }

    /* Hero bandeau d'accueil (style Preply) */
    .dashboard-hero {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      border-radius: 24px;
      padding: 2.5rem;
      margin-bottom: 2rem;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 2rem;
      flex-wrap: wrap;
    }

    .dashboard-hero-content {
      flex: 1;
      min-width: 300px;
    }

    .dashboard-hero-title {
      font-size: 2.25rem;
      font-weight: 700;
      margin-bottom: 0.75rem;
      color: white;
      line-height: 1.2;
    }

    .dashboard-hero-subtitle {
      font-size: 1.25rem;
      opacity: 0.95;
      margin-bottom: 0;
      font-weight: 400;
    }

    .dashboard-hero-actions {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      align-items: center;
    }

    .btn-hero-primary {
      background: white;
      color: var(--junspro-purple);
      border: none;
      padding: 0.875rem 1.75rem;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-hero-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
      color: var(--junspro-purple);
      text-decoration: none;
    }

    .btn-hero-secondary {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: 2px solid rgba(255, 255, 255, 0.4);
      padding: 0.875rem 1.75rem;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-hero-secondary:hover {
      background: rgba(255, 255, 255, 0.3);
      border-color: rgba(255, 255, 255, 0.6);
      color: white;
      text-decoration: none;
    }

    /* Carte Prochain Rituel (grande carte style Preply) */
    .next-ritual-card {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
      transition: all 0.3s ease;
    }

    .next-ritual-card:hover {
      box-shadow: var(--card-shadow-hover);
      transform: translateY(-2px);
    }

    .next-ritual-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 2rem;
      flex-wrap: wrap;
      gap: 1.5rem;
    }

    .next-ritual-info {
      flex: 1;
      min-width: 250px;
    }

    .next-ritual-badge {
      display: inline-block;
      padding: 0.5rem 1rem;
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
      color: var(--junspro-purple);
      border-radius: 12px;
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }

    .next-ritual-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 0.5rem;
    }

    .next-ritual-subtitle {
      font-size: 1rem;
      color: #6b7280;
      margin-bottom: 1.5rem;
    }

    .next-ritual-freelancer {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .next-ritual-avatar {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #f3f4f6;
      background: var(--junspro-gradient);
    }

    .next-ritual-freelancer-info h4 {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1f2937;
      margin: 0 0 0.25rem 0;
    }

    .next-ritual-freelancer-info p {
      margin: 0;
      color: #6b7280;
      font-size: 0.95rem;
    }

    .next-ritual-details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
      margin-bottom: 1.5rem;
      padding: 1.5rem;
      background: #f9fafb;
      border-radius: 16px;
    }

    .next-ritual-detail-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .next-ritual-detail-item i {
      font-size: 1.25rem;
      color: var(--junspro-purple);
    }

    .next-ritual-detail-item span {
      font-size: 0.95rem;
      color: #374151;
      font-weight: 500;
    }

    .next-ritual-action {
      display: flex;
      justify-content: flex-end;
    }

    .btn-ritual-join {
      background: var(--junspro-gradient);
      color: white;
      border: none;
      padding: 0.875rem 2rem;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-ritual-join:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
      color: white;
      text-decoration: none;
    }

    .btn-ritual-join:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
    }

    /* Section Prochainement (Timeline style Preply) */
    .upcoming-section {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    .section-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1f2937;
      margin: 0;
    }

    .section-link {
      font-size: 0.95rem;
      color: var(--junspro-purple);
      text-decoration: none;
      font-weight: 600;
      transition: all 0.2s ease;
    }

    .section-link:hover {
      text-decoration: underline;
      color: var(--junspro-blue);
    }

    .timeline-list {
      position: relative;
      padding-left: 0;
      list-style: none;
    }

    .timeline-item {
      position: relative;
      padding-left: 3rem;
      padding-bottom: 1.5rem;
      border-left: 2px solid #e5e7eb;
      margin-left: 1rem;
    }

    .timeline-item:last-child {
      border-left: none;
      padding-bottom: 0;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: -8px;
      top: 0.5rem;
      width: 14px;
      height: 14px;
      border-radius: 50%;
      background: var(--junspro-purple);
      border: 3px solid white;
      box-shadow: 0 0 0 2px var(--junspro-purple);
    }

    .timeline-card {
      background: white;
      border-radius: 12px;
      padding: 1rem 1.25rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      transition: all 0.2s ease;
      border: 1px solid #e5e7eb;
    }

    .timeline-card:hover {
      background: #f9fafb;
      border-color: #d1d5db;
    }

    .timeline-content {
      flex: 1;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .timeline-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      background: var(--junspro-gradient);
      border: 2px solid #e5e7eb;
      flex-shrink: 0;
    }

    .timeline-info {
      flex: 1;
    }

    .timeline-date {
      font-size: 0.875rem;
      color: #1f2937;
      font-weight: 500;
      margin-bottom: 0.25rem;
    }

    .timeline-time {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 0.25rem;
    }

    .timeline-project {
      font-size: 0.95rem;
      font-weight: 500;
      color: #1f2937;
      margin-bottom: 0;
    }

    .timeline-freelancer {
      font-size: 0.875rem;
      color: #6b7280;
    }


    /* Section Résumés de Rituels (IA) */
    .ai-reports-section {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
    }

    .ai-reports-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .ai-report-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.25rem;
      border-radius: 12px;
      transition: all 0.2s ease;
      cursor: pointer;
      margin-bottom: 0.5rem;
    }

    .ai-report-item:hover {
      background: #f9fafb;
    }

    .ai-report-content {
      flex: 1;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .ai-report-info {
      flex: 1;
    }

    .ai-report-title {
      font-size: 1rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 0.25rem;
    }

    .ai-report-meta {
      font-size: 0.875rem;
      color: #6b7280;
    }

    .ai-report-badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
      color: var(--junspro-purple);
      border-radius: 8px;
      font-size: 0.75rem;
      font-weight: 600;
      margin-left: 0.5rem;
    }

    .ai-report-arrow {
      color: #9ca3af;
      font-size: 1.25rem;
    }

    /* Section Continuez à avancer (Onglets style Preply) */
    .continue-section {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
    }

    .tabs-container {
      margin-bottom: 2rem;
    }

    .tabs-list {
      display: flex;
      gap: 0.5rem;
      border-bottom: 2px solid #e5e7eb;
      margin-bottom: 2rem;
      overflow-x: auto;
    }

    .tab-button {
      padding: 0.875rem 1.5rem;
      background: none;
      border: none;
      color: #6b7280;
      font-weight: 500;
      font-size: 0.95rem;
      cursor: pointer;
      border-bottom: 3px solid transparent;
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .tab-button:hover {
      color: var(--junspro-purple);
      background: rgba(124, 58, 237, 0.05);
    }

    .tab-button.active {
      color: var(--junspro-purple);
      border-bottom-color: var(--junspro-purple);
      font-weight: 600;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    .tips-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .tip-card {
      background: #f9fafb;
      border-radius: 16px;
      padding: 1.5rem;
      border: 1px solid #e5e7eb;
      transition: all 0.3s ease;
    }

    .tip-card:hover {
      background: white;
      box-shadow: var(--card-shadow);
      transform: translateY(-2px);
    }

    .tip-card-title {
      font-size: 1rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 0.5rem;
    }

    .tip-card-text {
      font-size: 0.9rem;
      color: #6b7280;
      line-height: 1.6;
      margin-bottom: 0;
    }

    /* Section Abonnements (style Preply exact) */
    .subscriptions-section {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
    }

    .subscriptions-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 1.5rem;
    }

    .subscription-card {
      background: #f9fafb;
      border-radius: 20px;
      padding: 2rem;
      border: 1px solid #e5e7eb;
      transition: all 0.3s ease;
    }

    .subscription-card:hover {
      box-shadow: var(--card-shadow-hover);
      transform: translateY(-2px);
      border-color: var(--junspro-purple);
    }

    .subscription-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .subscription-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      background: var(--junspro-gradient);
      border: 2px solid #e5e7eb;
    }

    .subscription-header-info {
      flex: 1;
    }

    .subscription-freelancer {
      font-size: 1.1rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 0.25rem;
    }

    .subscription-project {
      font-size: 0.9rem;
      color: #6b7280;
    }

    .subscription-stats {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-bottom: 1.5rem;
      padding: 1rem;
      background: white;
      border-radius: 12px;
    }

    .subscription-stat {
      text-align: center;
    }

    .subscription-stat-label {
      font-size: 0.85rem;
      color: #6b7280;
      margin-bottom: 0.25rem;
    }

    .subscription-stat-value {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--junspro-purple);
    }

    .subscription-status {
      display: inline-block;
      padding: 0.5rem 1rem;
      border-radius: 12px;
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 1.5rem;
    }

    .subscription-status.active {
      background: rgba(16, 185, 129, 0.1);
      color: #10b981;
    }

    .subscription-status.paused {
      background: rgba(245, 158, 11, 0.1);
      color: #f59e0b;
    }

    .subscription-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
    }

    .subscription-action-btn {
      flex: 1;
      min-width: 120px;
      padding: 0.75rem 1rem;
      border-radius: 10px;
      font-weight: 600;
      font-size: 0.9rem;
      text-align: center;
      text-decoration: none;
      transition: all 0.2s ease;
      border: none;
      cursor: pointer;
    }

    .subscription-action-btn-primary {
      background: var(--junspro-gradient);
      color: white;
    }

    .subscription-action-btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.4);
      color: white;
      text-decoration: none;
    }

    .subscription-action-btn-secondary {
      background: #e5e7eb;
      color: #1f2937;
    }

    .subscription-action-btn-secondary:hover {
      background: #d1d5db;
      color: #1f2937;
      text-decoration: none;
    }

    /* États vides */
    .empty-state {
      text-align: center;
      padding: 3rem 2rem;
    }

    .empty-state-icon {
      font-size: 4rem;
      color: #d1d5db;
      margin-bottom: 1rem;
    }

    .empty-state-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 0.75rem;
    }

    .empty-state-text {
      font-size: 0.95rem;
      color: #6b7280;
      margin-bottom: 2rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .client-dashboard-container {
        padding: 1rem;
      }

      .dashboard-hero {
        flex-direction: column;
        padding: 2rem 1.5rem;
      }

      .dashboard-hero-title {
        font-size: 1.5rem;
      }

      .dashboard-hero-actions {
        width: 100%;
        flex-direction: column;
      }

      .btn-hero-primary,
      .btn-hero-secondary {
        width: 100%;
        justify-content: center;
      }

      .next-ritual-card {
        padding: 1.5rem;
      }

      .next-ritual-details {
        grid-template-columns: 1fr;
      }

      .timeline-item {
        padding-left: 2rem;
      }

      .subscriptions-grid,
      .tips-grid,
      .rewards-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Section Récompenses (style Preply) */
    .rewards-section {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
    }

    .rewards-header {
      margin-bottom: 1.5rem;
    }

    .rewards-count {
      font-size: 0.95rem;
      color: #6b7280;
      font-weight: 500;
    }

    .rewards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .reward-card {
      position: relative;
      background: #f9fafb;
      border-radius: 16px;
      padding: 1.5rem 1rem;
      text-align: center;
      transition: all 0.2s ease;
      border: 2px solid transparent;
      cursor: pointer;
    }

    .reward-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .reward-card.reward-unlocked {
      background: white;
      border-color: #e5e7eb;
    }

    .reward-card.reward-locked {
      opacity: 0.6;
      position: relative;
    }

    .reward-badge-new {
      position: absolute;
      top: 0.5rem;
      right: 0.5rem;
      background: #ec4899;
      color: white;
      font-size: 0.7rem;
      font-weight: 600;
      padding: 0.25rem 0.5rem;
      border-radius: 8px;
    }

    .reward-icon {
      width: 56px;
      height: 56px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 0.75rem;
      font-size: 1.5rem;
    }

    .reward-title {
      font-size: 0.875rem;
      font-weight: 500;
      color: #1f2937;
      margin-top: 0.5rem;
    }

    .reward-lock {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(255, 255, 255, 0.9);
      border-radius: 50%;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #9ca3af;
      font-size: 0.875rem;
    }

    .rewards-empty {
      text-align: center;
      padding: 2rem 1rem;
      color: #6b7280;
      font-size: 0.95rem;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="client-dashboard-container">
    <!-- Navigation principale (onglets) -->
    <?php echo $__env->make('frontend.client.partials.dashboard-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php
      $user = Auth::guard('web')->user();
      $firstName = $user->first_name ?? $user->username ?? 'Client';
      $nextRitual = $nextSession ?? null;
      
      // Données mock pour les résumés IA (si pas de données réelles)
      $aiReports = $lastReports->take(3)->map(function($report) {
        return [
          'id' => $report->id,
          'title' => 'Résumé de Rituel',
          'date' => \Carbon\Carbon::parse($report->end_at)->format('d/m/Y à H:i'),
          'project' => 'Projet #' . $report->subscription_id,
          'freelancer' => $report->subscription->freelancer->user->name ?? 'Freelance',
        ];
      });
      
      // Si pas de rapports, créer des placeholders
      if ($aiReports->isEmpty()) {
        $aiReports = collect([
          ['id' => 1, 'title' => 'Résumé de Rituel', 'date' => 'Aucun résumé disponible', 'project' => '', 'freelancer' => ''],
        ]);
      }
    ?>

    <!-- 1) Hero (style Preply exact) -->
    <div class="dashboard-hero">
      <div class="dashboard-hero-content">
        <h1 class="dashboard-hero-title">Bonjour <?php echo e($firstName); ?> !</h1>
        <?php if($nextRitual): ?>
          <p class="dashboard-hero-subtitle">Votre Rituel va bientôt commencer</p>
        <?php else: ?>
          <p class="dashboard-hero-subtitle">Aucun Rituel prévu pour le moment.</p>
        <?php endif; ?>
      </div>
      <?php if(isset($referralStats)): ?>
        <?php echo $__env->make('components.referral.referral-cta', [
          'variant' => 'card',
          'stats' => $referralStats
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php endif; ?>
      <div class="dashboard-hero-actions">
        <?php if($nextRitual): ?>
          <a href="<?php echo e(route('client.subscriptions.show', $nextRitual->subscription_id)); ?>" class="btn-hero-primary">
            <i class="far fa-calendar"></i>
            Voir le rituel
          </a>
        <?php else: ?>
          <a href="<?php echo e(route('explore')); ?>" class="btn-hero-primary">
            <i class="fas fa-search"></i>
            Trouver un freelance
          </a>
        <?php endif; ?>
      </div>
    </div>

    
    <div style="margin: 1.5rem 0;">
      <?php echo $__env->make('frontend.components.pause-souffle.inline-premium', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- 2) Section "Prochainement" (Timeline style Preply) -->
    <div class="upcoming-section">
      <div class="section-header">
        <h2 class="section-title">Prochainement</h2>
    <?php if($upcomingSessions->count() > 0): ?>
          <a href="<?php echo e(route('client.subscriptions.index')); ?>" class="section-link">Voir tout</a>
        <?php endif; ?>
        </div>
        
      <?php
        // Combiner nextRitual et upcomingSessions pour afficher tous les rituels à venir
        $allUpcomingSessions = collect();
        if ($nextRitual) {
          $allUpcomingSessions->push($nextRitual);
        }
        $allUpcomingSessions = $allUpcomingSessions->merge($upcomingSessions)->take(5);
      ?>
      
      <?php if($allUpcomingSessions->count() > 0): ?>
        <ul class="timeline-list">
          <?php $__currentLoopData = $allUpcomingSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $sessionDate = \Carbon\Carbon::parse($session->start_at);
              $now = \Carbon\Carbon::now();
              $diffDays = $now->diffInDays($sessionDate, false);
              
              if ($diffDays == 0) {
                $dateLabel = 'Aujourd\'hui';
              } elseif ($diffDays == 1) {
                $dateLabel = 'Demain';
              } elseif ($diffDays == -1) {
                $dateLabel = 'Hier';
              } else {
                $dateLabel = $sessionDate->format('d M');
              }
              
              $dayName = $sessionDate->format('l');
              $timeRange = $sessionDate->format('H:i') . ' – ' . \Carbon\Carbon::parse($session->end_at)->format('H:i');
            ?>
            <li class="timeline-item">
              <div class="timeline-card">
                <div class="timeline-content">
                  <?php if($session->subscription->freelancer->user->image): ?>
                    <img src="<?php echo e(asset('assets/img/users/' . $session->subscription->freelancer->user->image)); ?>" 
                         alt="<?php echo e($session->subscription->freelancer->user->name); ?>" 
                         class="timeline-avatar"
                         onerror="this.src='<?php echo e(asset('assets/img/blank-user.jpg')); ?>'">
                  <?php else: ?>
                    <div class="timeline-avatar" style="display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 1.1rem;">
                      <?php echo e(strtoupper(substr($session->subscription->freelancer->user->name, 0, 1))); ?>

                    </div>
                  <?php endif; ?>
                  <div class="timeline-info">
                    <div class="timeline-date"><?php echo e($dateLabel); ?></div>
                    <div class="timeline-time"><?php echo e($dayName); ?>, <?php echo e($timeRange); ?></div>
                    <div class="timeline-project"><?php echo e($session->subscription->freelancer->user->name); ?></div>
                  </div>
                </div>
                <?php echo $__env->make('components.client-upcoming-actions-menu', [
                  'sessionId' => $session->id,
                  'subscriptionId' => $session->subscription_id,
                  'freelancerId' => $session->subscription->freelancer->id,
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
              </div>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php if($upcomingSessions->count() > 4 || ($nextRitual && $upcomingSessions->count() > 3)): ?>
          <div style="text-align: center; margin-top: 1.5rem;">
            <a href="<?php echo e(route('client.subscriptions.index')); ?>" class="section-link">Voir plus</a>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <div class="empty-state">
          <div class="empty-state-icon"><i class="far fa-calendar"></i></div>
          <h3 class="empty-state-title">Aucune session planifiée</h3>
          <p class="empty-state-text">Planifiez de nouvelles sessions pour continuer à avancer sur vos projets.</p>
          <a href="<?php echo e(route('explore')); ?>" class="btn-hero-primary">Planifier une session</a>
        </div>
    <?php endif; ?>
      </div>

    <!-- 3) Section "Résumés de Rituels (IA)" -->
    <div class="ai-reports-section">
      <div class="section-header">
        <h2 class="section-title">Résumés de Rituels <span class="ai-report-badge">IA beta</span></h2>
        <?php if($lastReports->count() > 0): ?>
          <a href="<?php echo e(route('client.subscriptions.index')); ?>" class="section-link">Voir tout</a>
        <?php endif; ?>
      </div>

      <?php if($lastReports->count() > 0): ?>
        <ul class="ai-reports-list">
          <?php $__currentLoopData = $lastReports->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="ai-report-item" onclick="window.location.href='<?php echo e(route('client.subscriptions.show', $report->subscription_id)); ?>'">
              <div class="ai-report-content">
                <div class="ai-report-info">
                  <div class="ai-report-title"><?php echo e(Str::limit($report->report_text ?? 'Résumé de Rituel', 50)); ?></div>
                  <div class="ai-report-meta">
                    <?php echo e(\Carbon\Carbon::parse($report->end_at)->format('d/m/Y à H:i')); ?> · Projet #<?php echo e($report->subscription_id); ?>

                    <span class="ai-report-badge">IA</span>
              </div>
              </div>
            </div>
              <i class="fas fa-chevron-right ai-report-arrow"></i>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php else: ?>
        <div class="empty-state">
          <div class="empty-state-icon"><i class="fas fa-robot"></i></div>
          <h3 class="empty-state-title">Activez les résumés IA</h3>
          <p class="empty-state-text">Les résumés automatiques de vos Rituels apparaîtront ici une fois activés.</p>
          <a href="<?php echo e(route('client.subscriptions.index')); ?>" class="btn-hero-primary">Activer les résumés</a>
        </div>
      <?php endif; ?>
    </div>

    <!-- 4) Section "Continuez à avancer" (Onglets style Preply) -->
    <div class="continue-section">
      <div class="section-header">
        <h2 class="section-title">Continuez à avancer</h2>
        <a href="#" class="section-link">Voir plus</a>
      </div>

      <div class="tabs-container">
        <div class="tabs-list">
          <button class="tab-button active" data-tab="organization">Organisation</button>
          <button class="tab-button" data-tab="skills">Compétences</button>
          <button class="tab-button" data-tab="business">Business</button>
        </div>

        <div class="tab-content active" id="tab-organization">
          <div class="tips-grid">
            <div class="tip-card">
              <h3 class="tip-card-title">Optimisez votre briefing</h3>
              <p class="tip-card-text">Un briefing clair permet à votre freelance de mieux comprendre vos besoins et d'être plus efficace.</p>
            </div>
            <div class="tip-card">
              <h3 class="tip-card-title">Planifiez vos sessions</h3>
              <p class="tip-card-text">Organisez vos Rituels à l'avance pour maintenir un rythme régulier et progresser efficacement.</p>
            </div>
          </div>
        </div>

        <div class="tab-content" id="tab-skills">
          <div class="tips-grid">
            <div class="tip-card">
              <h3 class="tip-card-title">Développez vos compétences</h3>
              <p class="tip-card-text">Chaque Rituel est une opportunité d'apprendre et de progresser sur votre projet.</p>
            </div>
            <div class="tip-card">
              <h3 class="tip-card-title">Utilisez les rapports</h3>
              <p class="tip-card-text">Les rapports de vos freelances vous aident à suivre l'avancement et à identifier les points d'amélioration.</p>
            </div>
          </div>
        </div>

        <div class="tab-content" id="tab-business">
          <div class="tips-grid">
            <div class="tip-card">
              <h3 class="tip-card-title">Gérez vos abonnements</h3>
              <p class="tip-card-text">Suivez vos Rituels restants et ajustez vos abonnements selon vos besoins réels.</p>
            </div>
            <div class="tip-card">
              <h3 class="tip-card-title">Optimisez vos coûts</h3>
              <p class="tip-card-text">Choisissez le bon nombre d'heures par semaine pour équilibrer qualité et budget.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 5) Section "Abonnements" (style Preply exact) -->
    <div class="subscriptions-section">
      <div class="section-header">
        <h2 class="section-title">Abonnements</h2>
        <a href="<?php echo e(route('client.subscriptions.index')); ?>" class="section-link">Gérer</a>
      </div>

      <?php if($subscriptions->count() > 0): ?>
        <div class="subscriptions-grid">
          <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="subscription-card">
              <div class="subscription-header">
                <?php if($subscription->freelancer->user->image): ?>
                  <img src="<?php echo e(asset('assets/img/users/' . $subscription->freelancer->user->image)); ?>" 
                       alt="<?php echo e($subscription->freelancer->user->name); ?>" 
                       class="subscription-avatar"
                       onerror="this.src='<?php echo e(asset('assets/img/blank-user.jpg')); ?>'">
                <?php else: ?>
                  <div class="subscription-avatar" style="display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 1.25rem;">
                    <?php echo e(strtoupper(substr($subscription->freelancer->user->name, 0, 1))); ?>

                  </div>
                <?php endif; ?>
                <div class="subscription-header-info">
                  <div class="subscription-freelancer"><?php echo e($subscription->freelancer->user->name); ?></div>
                  <div class="subscription-project">Abonnement hebdomadaire – <?php echo e($subscription->hours_per_week); ?>h/semaine</div>
                </div>
              </div>

              <div class="subscription-stats">
                <div class="subscription-stat">
                  <div class="subscription-stat-label">Heures restantes</div>
                  <div class="subscription-stat-value"><?php echo e(number_format($subscription->calculated_hours_remaining ?? $subscription->hours_remaining ?? 0, 1)); ?>h</div>
                </div>
                <?php if($subscription->next_billing_at): ?>
                  <div class="subscription-stat">
                    <div class="subscription-stat-label">Prochaine échéance</div>
                    <div class="subscription-stat-value" style="font-size: 1rem;"><?php echo e(\Carbon\Carbon::parse($subscription->next_billing_at)->format('d/m')); ?></div>
                  </div>
                <?php endif; ?>
              </div>

              <span class="subscription-status <?php echo e($subscription->status); ?>">
                <?php if($subscription->status == 'active'): ?>
                  Actif
                <?php elseif($subscription->status == 'paused'): ?>
                  En pause
                <?php else: ?>
                  <?php echo e(ucfirst($subscription->status)); ?>

                <?php endif; ?>
              </span>

              <div class="subscription-actions">
                <a href="<?php echo e(route('client.subscriptions.show', $subscription->id)); ?>" class="subscription-action-btn subscription-action-btn-primary">Voir les sessions</a>
                <?php if($subscription->status == 'active'): ?>
                  <form action="<?php echo e(route('client.subscriptions.pause', $subscription->id)); ?>" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="subscription-action-btn subscription-action-btn-secondary" onclick="return confirm('<?php echo e(__('Êtes-vous sûr de vouloir mettre cet abonnement en pause ?')); ?>')">
                      Mettre en pause
                    </button>
                  </form>
                <?php elseif($subscription->status == 'paused'): ?>
                  <form action="<?php echo e(route('client.subscriptions.resume', $subscription->id)); ?>" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="subscription-action-btn subscription-action-btn-primary">
                      Reprendre
                    </button>
                  </form>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php else: ?>
        <div class="empty-state">
          <div class="empty-state-icon"><i class="far fa-calendar-check"></i></div>
          <h3 class="empty-state-title">Vous n'avez pas encore d'abonnement actif</h3>
          <p class="empty-state-text">Découvrez nos offres pour démarrer un projet avec un freelance Junspro.</p>
          <a href="<?php echo e(route('explore')); ?>" class="btn-hero-primary">Découvrir les offres</a>
        </div>
      <?php endif; ?>
      </div>

    <!-- 6) Section "Récompenses" (style Preply) -->
    <div class="rewards-section">
      <div class="section-header">
        <h2 class="section-title">Récompenses</h2>
        <a href="#" class="section-link" onclick="showToast('Bientôt disponible'); return false;">Voir plus</a>
      </div>

      <?php
        // Badges de progression Junspro
        $rewards = [
          ['id' => 1, 'icon' => 'fas fa-star', 'title' => 'Premier Rituel', 'unlocked' => $subscriptions->count() > 0, 'color' => '#fbbf24'],
          ['id' => 2, 'icon' => 'fas fa-user-check', 'title' => 'Profil complété', 'unlocked' => true, 'color' => '#3b82f6'],
          ['id' => 3, 'icon' => 'fas fa-paper-plane', 'title' => 'Brief envoyé', 'unlocked' => false, 'color' => '#8b5cf6'],
          ['id' => 4, 'icon' => 'fas fa-calendar-check', 'title' => 'Régularité', 'unlocked' => false, 'color' => '#10b981'],
          ['id' => 5, 'icon' => 'fas fa-trophy', 'title' => 'Projet terminé', 'unlocked' => false, 'color' => '#f59e0b'],
          ['id' => 6, 'icon' => 'fas fa-fire', 'title' => 'Série de 5', 'unlocked' => false, 'color' => '#ef4444'],
        ];
        $unlockedCount = collect($rewards)->where('unlocked', true)->count();
      ?>

      <div class="rewards-header">
        <span class="rewards-count"><?php echo e($unlockedCount); ?>/<?php echo e(count($rewards)); ?></span>
      </div>

      <div class="rewards-grid">
        <?php $__currentLoopData = $rewards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="reward-card <?php echo e($reward['unlocked'] ? 'reward-unlocked' : 'reward-locked'); ?>">
            <?php if($reward['unlocked']): ?>
              <span class="reward-badge-new">Nouveau</span>
            <?php endif; ?>
            <div class="reward-icon" style="background: <?php echo e($reward['color']); ?>20; color: <?php echo e($reward['color']); ?>;">
              <i class="<?php echo e($reward['icon']); ?>"></i>
            </div>
            <div class="reward-title"><?php echo e($reward['title']); ?></div>
            <?php if(!$reward['unlocked']): ?>
              <div class="reward-lock">
                <i class="fas fa-lock"></i>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <?php if($unlockedCount == 0): ?>
        <div class="rewards-empty">
          <p>Débloquez vos récompenses en complétant votre profil et réservant vos premiers rituels.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php echo $__env->make('components.client-upcoming-actions-menu-scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <script>
    // Fonction globale pour afficher un toast
    function showToast(message) {
      const existingToast = document.querySelector('.client-upcoming-actions-toast');
      if (existingToast) {
        existingToast.remove();
      }

      const toast = document.createElement('div');
      toast.className = 'client-upcoming-actions-toast';
      toast.textContent = message;
      document.body.appendChild(toast);

      setTimeout(() => {
        toast.classList.add('show');
      }, 10);

      setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
          if (toast.parentNode) {
            toast.parentNode.removeChild(toast);
          }
        }, 300);
      }, 3000);
    }

    // Gestion des onglets "Continuez à avancer"
    document.addEventListener('DOMContentLoaded', function() {
      const tabButtons = document.querySelectorAll('.tab-button');
      const tabContents = document.querySelectorAll('.tab-content');

      tabButtons.forEach(button => {
        button.addEventListener('click', function() {
          const targetTab = this.getAttribute('data-tab');

          // Désactiver tous les onglets
          tabButtons.forEach(btn => btn.classList.remove('active'));
          tabContents.forEach(content => content.classList.remove('active'));

          // Activer l'onglet cliqué
          this.classList.add('active');
          document.getElementById('tab-' + targetTab).classList.add('active');
        });
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\dashboard\index.blade.php ENDPATH**/ ?>