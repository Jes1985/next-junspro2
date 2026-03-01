@extends('frontend.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/topup-modal.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/change-plan-modal.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/luxury-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard-luxury-revamp.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #7c3aed 0%, #1e40af 100%);
      --junspro-gradient-alt: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --shadow-sm: 0 2px 8px rgba(124, 58, 237, 0.12);
      --shadow-md: 0 8px 24px rgba(124, 58, 237, 0.15);
      --shadow-lg: 0 16px 48px rgba(124, 58, 237, 0.20);
      --shadow-xl: 0 24px 64px rgba(124, 58, 237, 0.25);
      --card-shadow: var(--shadow-md);
      --card-shadow-hover: var(--shadow-lg);
    }

    .client-dashboard-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 3rem 2rem;
      padding-top: 4rem;
      background: linear-gradient(135deg, #fafafa 0%, #f5f3ff 100%);
      min-height: calc(100vh - 200px);
    }

    /* Header */
    .projects-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 3rem;
      flex-wrap: wrap;
      gap: 1.5rem;
    }

    .projects-header-title h1 {
      font-size: 2.5rem;
      font-weight: 800;
      color: #1a202c;
      margin: 0 0 0.75rem 0;
      letter-spacing: -0.01em;
    }

    .projects-header-title p {
      color: #6b7280;
      font-size: 1.05rem;
      margin: 0;
      font-weight: 400;
    }

    .projects-header-actions {
      display: flex;
      gap: 1rem;
    }

    .btn-junspro-primary {
      background: var(--junspro-gradient);
      color: white;
      padding: 1rem 2rem;
      border-radius: 14px;
      border: none;
      font-weight: 700;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
      transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
      box-shadow: 0 8px 24px rgba(124, 58, 237, 0.3);
    }

    .btn-junspro-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 36px rgba(124, 58, 237, 0.4);
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
      grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
      gap: 2rem;
      margin-bottom: 4rem;
    }

    .stat-card {
      background: white;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
      cursor: pointer;
      transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
      border: 1px solid rgba(124, 58, 237, 0.08);
      position: relative;
      overflow: hidden;
    }

    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.2), transparent);
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--card-shadow-hover);
      border-color: rgba(124, 58, 237, 0.15);
    }

    .stat-card-title {
      font-size: 0.95rem;
      color: #6b7280;
      font-weight: 700;
      margin-bottom: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    .stat-card-value {
      font-size: 2.35rem;
      font-weight: 900;
      color: var(--junspro-purple);
      margin-bottom: 0.5rem;
      letter-spacing: -0.02em;
    }

    .stat-card-subtitle {
      font-size: 0.95rem;
      color: #9ca3af;
      font-weight: 400;
    }

    /* Section projets actifs */
    .section-title {
      font-size: 1.85rem;
      font-weight: 800;
      color: #1a202c;
      margin-bottom: 0.75rem;
      letter-spacing: -0.01em;
    }

    .section-subtitle {
      color: #6b7280;
      margin-bottom: 2.5rem;
      font-size: 1.05rem;
      font-weight: 400;
    }

    .projects-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
      gap: 2rem;
      margin-bottom: 4rem;
    }

    @media (max-width: 768px) {
      .projects-grid {
        grid-template-columns: 1fr;
      }
    }

    .project-card {
      background: white;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
      transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
      border: 1px solid rgba(124, 58, 237, 0.08);
      position: relative;
      overflow: hidden;
    }

    .project-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.2), transparent);
    }

    .project-card:hover {
      box-shadow: var(--card-shadow-hover);
      transform: translateY(-6px);
      border-color: rgba(124, 58, 237, 0.15);
    }

    .project-card-header {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      margin-bottom: 1.75rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid rgba(124, 58, 237, 0.08);
    }

    .project-freelancer-avatar {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: var(--junspro-gradient);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 1.25rem;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.2);
    }

    .project-freelancer-info h3 {
      font-size: 1.2rem;
      font-weight: 700;
      color: #1a202c;
      margin: 0 0 0.35rem 0;
      letter-spacing: -0.005em;
    }

    .project-category {
      display: inline-block;
      background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
      color: #6b7280;
      padding: 0.35rem 0.9rem;
      border-radius: 10px;
      font-size: 0.85rem;
      font-weight: 600;
      border: 1px solid rgba(124, 58, 237, 0.12);
    }

    .project-title {
      font-size: 1.35rem;
      font-weight: 800;
      color: #1a202c;
      margin-bottom: 1.5rem;
      letter-spacing: -0.01em;
    }

    .project-hours-block {
      background: linear-gradient(135deg, #f5f3ff 0%, #fafafa 100%);
      border-radius: 14px;
      padding: 1.25rem;
      margin-bottom: 1.5rem;
      border: 1.5px solid rgba(124, 58, 237, 0.1);
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
      height: 10px;
      background: rgba(124, 58, 237, 0.1);
      border-radius: 6px;
      overflow: hidden;
      margin-top: 1rem;
    }

    .project-progress-fill {
      height: 100%;
      background: var(--junspro-gradient);
      transition: width 0.4s cubic-bezier(0.23, 1, 0.320, 1);
      border-radius: 6px;
      box-shadow: 0 0 12px rgba(124, 58, 237, 0.4);
    }

    .project-sessions-block {
      margin-bottom: 1.5rem;
      padding: 1.25rem;
      background: linear-gradient(135deg, #f5f3ff 0%, #fafafa 100%);
      border-radius: 14px;
      border: 1.5px solid rgba(124, 58, 237, 0.1);
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
      gap: 1rem;
      flex-wrap: wrap;
      margin-top: 1.75rem;
    }

    .btn-project-action {
      flex: 1;
      min-width: 130px;
      padding: 0.75rem 1.25rem;
      border-radius: 10px;
      border: 2px solid rgba(124, 58, 237, 0.2);
      background: white;
      color: #6b7280;
      font-weight: 600;
      text-decoration: none;
      text-align: center;
      transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
      font-size: 0.9rem;
    }

    .btn-project-action:hover {
      background: linear-gradient(135deg, #f5f3ff 0%, #fafafa 100%);
      border-color: var(--junspro-purple);
      color: var(--junspro-purple);
    }

    .btn-project-action-primary {
      background: var(--junspro-gradient);
      color: white;
      border: none;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .btn-project-action-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(124, 58, 237, 0.4);
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

    /* === Hero banner === */
    .page-hero-banner {
      background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 60%, #a855f7 100%);
      border-radius: 40px;
      padding: 3rem 4rem;
      margin-bottom: 2rem;
      color: white;
      position: relative;
      overflow: hidden;
      box-shadow: 0 32px 80px rgba(124, 58, 237, 0.3), inset 0 1px 1px rgba(255,255,255,0.2);
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 2rem;
    }
    .page-hero-banner::before {
      content: '';
      position: absolute;
      top: -40%; left: -5%;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }
    .page-hero-banner::after {
      content: '';
      position: absolute;
      bottom: -20%; right: -10%;
      width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }
    .page-hero-title {
      font-size: 2.5rem;
      font-weight: 900;
      margin-bottom: 0.5rem;
      color: white;
      line-height: 1.1;
      letter-spacing: -0.03em;
      position: relative;
      z-index: 2;
    }
    .page-hero-subtitle {
      font-size: 1.1rem;
      opacity: 0.9;
      margin-bottom: 0;
      font-weight: 300;
      color: white;
      position: relative;
      z-index: 2;
    }
    .hero-text-content { flex: 1; position: relative; z-index: 2; }
    .hero-search-btn {
      background: white;
      color: #7c3aed;
      border-radius: 50px;
      padding: 0.85rem 1.8rem;
      font-weight: 600;
      font-size: 0.95rem;
      text-decoration: none !important;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      white-space: nowrap;
      position: relative;
      z-index: 2;
      flex-shrink: 0;
      transition: background 0.2s, color 0.2s;
    }
    .hero-search-btn:hover {
      background: #f5f3ff;
      color: #6d28d9;
      text-decoration: none !important;
    }
  </style>
@endsection

@section('content')
  <div class="client-dashboard-container">
    @include('frontend.client.partials.dashboard-nav')
    @php $heroFirstName = Auth::guard('web')->user() ? explode(' ', trim(Auth::guard('web')->user()->name))[0] : 'vous'; @endphp
    <div class="page-hero-banner">
      <div class="hero-text-content">
        <h1 class="page-hero-title">Bonjour {{ $heroFirstName }} !</h1>
        <p class="page-hero-subtitle">Bienvenue dans votre espace</p>
      </div>
      <a href="/services" class="hero-search-btn">
        <i class="fas fa-search"></i> Trouver un freelance
      </a>
    </div>
    
    <!-- Header -->
    <div class="projects-header">
      <div class="projects-header-title">
        <h1>{{ __('Mes Rituels & heures') }}</h1>
        <p>{{ __('Suivez vos Rituels, vos heures consommées et vos prochains Rituels avec vos freelances.') }}</p>
      </div>
      <div class="projects-header-actions">
        <a href="{{ route('explore') }}" class="btn-junspro-primary">
          <i class="fas fa-search"></i>
          {{ __('Trouver un freelance') }}
        </a>
      </div>
    </div>

    <!-- Bandeau synthèse -->
    <div class="stats-overview">
      <div class="stat-card" onclick="document.getElementById('active-projects').scrollIntoView({behavior: 'smooth'})">
        <div class="stat-card-title">{{ __('Rituels en cours') }}</div>
        <div class="stat-card-value">{{ $stats['active_projects_count'] }}</div>
        <div class="stat-card-subtitle">{{ __('Rituels actifs') }}</div>
      </div>
      
      <div class="stat-card">
        <div class="stat-card-title">{{ __('Heures restantes cette semaine') }}</div>
        <div class="stat-card-value">{{ number_format($stats['total_hours_remaining_this_week'], 1) }}h</div>
        <div class="stat-card-subtitle">{{ __('disponibles sur vos abonnements') }}</div>
            </div>

      <div class="stat-card">
        <div class="stat-card-title">{{ __('Prochain Rituel planifié') }}</div>
        @if($stats['next_session'])
          @php
            $nextSession = $stats['next_session']['session'];
            $freelancer = $stats['next_session']['freelancer'];
            $sessionDate = \Carbon\Carbon::parse($nextSession->start_at);
          @endphp
          <div class="stat-card-value" style="font-size: 1.25rem;">
            @if($sessionDate->isToday())
              {{ __('Aujourd\'hui') }}, {{ $sessionDate->format('H:i') }}
            @elseif($sessionDate->isTomorrow())
              {{ __('Demain') }}, {{ $sessionDate->format('H:i') }}
            @else
              {{ $sessionDate->format('d/m') }}, {{ $sessionDate->format('H:i') }}
                            @endif
          </div>
          <div class="stat-card-subtitle">{{ __('avec') }} {{ $freelancer->name ?? 'N/A' }}</div>
        @else
          <div class="stat-card-value" style="font-size: 1.25rem;">—</div>
          <div class="stat-card-subtitle">{{ __('Aucun Rituel planifié') }}</div>
                            @endif
      </div>
    </div>

    <!-- Section Projets actifs -->
    <section id="active-projects">
      <h2 class="section-title">{{ __('Rituels actifs') }}</h2>
      <p class="section-subtitle">{{ __('Vos collaborations en cours avec les freelances Junspro.') }}</p>

      @if($activeSubscriptions->count() > 0)
        <div class="projects-grid">
          @foreach($activeSubscriptions as $subscription)
            @php
              $freelancer = $subscription->freelancer->user ?? null;
              $freelancerName = $freelancer->name ?? 'N/A';
              $freelancerInitials = strtoupper(substr($freelancerName, 0, 1));
              
              // Calculer le rythme de travail (discipline)
              $lastSession = $subscription->last_report;
              $daysSinceLastSession = $lastSession ? now()->diffInDays($lastSession->end_at) : null;
              $isRegular = $daysSinceLastSession !== null && $daysSinceLastSession <= 7;
              
              // Reprogrammations restantes (placeholder - à implémenter)
              $remainingRebooks = 2; // À récupérer depuis le modèle
            @endphp
            
            <div class="project-card">
              <div class="project-card-header">
                <div class="project-freelancer-avatar">
                  {{ $freelancerInitials }}
                </div>
                <div class="project-freelancer-info">
                  <h3>{{ $freelancerName }}</h3>
                  <span class="project-category">{{ __('Abonnement') }} {{ $subscription->hours_per_week }}h/semaine</span>
                </div>
              </div>

              <div class="project-title">
                {{ __('Rituel') }} #{{ $subscription->id }}
              </div>

              <!-- Bloc Heures -->
              <div class="project-hours-block">
                <div class="project-hours-row">
                  <span class="project-hours-label">{{ __('Tarif') }}</span>
                  <span class="project-hours-value">{{ number_format($subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0, 0) }} € / h</span>
                </div>
                <div class="project-hours-row">
                  <span class="project-hours-label">{{ __('Heures incluses') }}</span>
                  <span class="project-hours-value">{{ number_format($subscription->calculated_total_hours, 1) }} h</span>
                </div>
                <div class="project-hours-row">
                  <span class="project-hours-label">{{ __('Heures consommées') }}</span>
                  <span class="project-hours-value">{{ number_format($subscription->calculated_used_hours, 1) }} h</span>
                </div>
                <div class="project-hours-row">
                  <span class="project-hours-label">{{ __('Heures restantes') }}</span>
                  <span class="project-hours-value" style="color: var(--junspro-purple);">{{ number_format($subscription->calculated_hours_remaining, 1) }} h</span>
                </div>
                <div class="project-progress-bar">
                  <div class="project-progress-fill" style="width: {{ $subscription->calculated_progress_percent }}%"></div>
                          </div>
              </div>

              <!-- Bloc Sessions -->
              <div class="project-sessions-block">
                @if($subscription->next_session)
                  <div class="project-sessions-row">
                    <span class="project-hours-label">{{ __('Prochain Rituel') }}</span>
                    <span class="project-hours-value">
                      {{ \Carbon\Carbon::parse($subscription->next_session->start_at)->format('d/m, H:i') }}
                    </span>
                  </div>
                @endif
                @if($subscription->last_report)
                  <div class="project-sessions-row">
                    <span class="project-hours-label">{{ __('Dernier rapport') }}</span>
                    <span class="project-hours-value">
                      {{ \Carbon\Carbon::parse($subscription->last_report->end_at)->format('d M, H:i') }}
                    </span>
                  </div>
                @endif
                <div class="project-sessions-row">
                  <span class="project-hours-label">{{ __('Reprogrammations restantes (freelance)') }}</span>
                  <span class="project-hours-value">{{ $remainingRebooks }} / 2</span>
                </div>
              </div>

              <!-- Badge discipline -->
              @if($daysSinceLastSession !== null)
                <div class="discipline-badge {{ $isRegular ? 'good' : 'warning' }}">
                  <i class="fas {{ $isRegular ? 'fa-check-circle' : 'fa-exclamation-circle' }}"></i>
                  {{ $isRegular ? __('Rythme de travail régulier') : __('Rituels espacés – risque de retard') }}
                </div>
              @endif

              <!-- Actions -->
              <div class="project-actions">
                <a href="{{ route('client.subscriptions.show', $subscription->id) }}" class="btn-project-action">
                  <i class="fas fa-eye"></i> {{ __('Voir le détail') }}
                </a>
                <a href="{{ route('explore') }}" class="btn-project-action btn-project-action-primary">
                  <i class="fas fa-plus"></i> {{ __('Ajouter des heures') }}
                </a>
                <a href="{{ route('user.messages.index', ['conversation' => $subscription->id]) }}" class="btn-project-action">
                  <i class="fas fa-comments"></i> {{ __('Messages') }}
                </a>
              </div>
            </div>
          @endforeach
              </div>
            @else
        <div class="empty-state">
          <div class="empty-state-icon">
            <i class="far fa-folder-open"></i>
          </div>
          <h3>{{ __("Vous n'avez pas encore de Rituel en cours") }}</h3>
          <p>{{ __('Trouvez un freelance pour lancer votre première collaboration.') }}</p>
          <a href="{{ route('explore') }}" class="btn-junspro-primary">
            <i class="fas fa-search"></i>
            {{ __('Trouver un freelance') }}
          </a>
              </div>
            @endif
    </section>

    <!-- Section Résumé consommation -->
    <section class="consumption-summary">
      <h2 class="section-title">{{ __("Votre consommation d'heures") }}</h2>
      <div class="consumption-placeholder">
        <p>{{ __('Graphiques de consommation prochainement disponibles') }}</p>
        <div style="margin-top: 1rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
          <div>
            <div class="stat-card-value" style="font-size: 1.5rem;">{{ number_format($stats['hours_consumed_this_month'], 1) }}h</div>
            <div class="stat-card-title">{{ __('Heures consommées ce mois-ci') }}</div>
          </div>
          <div>
            <div class="stat-card-value" style="font-size: 1.5rem;">{{ $stats['hours_planned_next_7_days'] }}</div>
            <div class="stat-card-title">{{ __('Rituels prévus sur les 7 prochains jours') }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section Projets terminés -->
    @if($archivedSubscriptions->count() > 0)
      <section class="archived-projects">
        <h2 class="section-title">{{ __('Rituels terminés & archivés') }}</h2>
        <p class="section-subtitle">{{ __('Vos Rituels précédents avec leurs freelances.') }}</p>

        @foreach($archivedSubscriptions as $subscription)
          @php
            $freelancer = $subscription->freelancer->user ?? null;
            $freelancerName = $freelancer->name ?? 'N/A';
            $startDate = $subscription->starts_at ? \Carbon\Carbon::parse($subscription->starts_at) : null;
            $endDate = $subscription->ends_at ? \Carbon\Carbon::parse($subscription->ends_at) : $subscription->updated_at;
            $duration = $startDate ? $startDate->diffForHumans($endDate, true) : null;
          @endphp
          
          <div class="archived-project-item">
            <div class="archived-project-info">
              <h4>{{ __('Rituel') }} #{{ $subscription->id }}</h4>
              <div class="archived-project-meta">
                <span><i class="fas fa-user"></i> {{ $freelancerName }}</span>
                <span><i class="fas fa-clock"></i> {{ number_format($subscription->total_hours_worked, 1) }} h</span>
                @if($duration)
                  <span><i class="fas fa-calendar"></i> {{ $duration }}</span>
                @endif
                <span class="badge badge-secondary">{{ ucfirst($subscription->status) }}</span>
              </div>
            </div>
            <div style="display: flex; gap: 0.75rem;">
              <a href="{{ route('client.subscriptions.show', $subscription->id) }}" class="btn-project-action">
                {{ __('Voir le détail') }}
              </a>
            </div>
          </div>
        @endforeach
      </section>
    @endif

    <!-- Lien blog -->
    <div class="blog-link-section">
      <h3>{{ __('Envie de mieux piloter vos Rituels ?') }}</h3>
      <a href="{{ route('blog') }}">{{ __('Lire les conseils Junspro sur le blog') }}</a>
    </div>
  </div>
@endsection
