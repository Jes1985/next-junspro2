@extends('frontend.layout')

@section('pageHeading')
  {{ $user->name ?? __('Freelance') }}
@endsection

@section('metaDescription')
  {{ Str::limit($freelancer->bio ?? '', 150) }}
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/front/css/freelancer-profile-premium.css') }}?v={{ time() }}">
<style>
  /* Variables Junspro Premium */
  :root {
    --junspro-primary: #4F46E5;
    --junspro-primary-dark: #4338CA;
    --junspro-secondary: #7C3AED;
    --junspro-gradient: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    --junspro-bg-light: #F9FAFB;
    --junspro-border: #E5E7EB;
    --junspro-text: #111827;
    --junspro-text-light: #6B7280;
  }

  /* Hero Section avec vidéo */
  .freelancer-profile-hero-premium {
    background: white;
    padding: 40px 0;
    border-bottom: 1px solid var(--junspro-border);
  }

  .freelancer-profile-hero-content-premium {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 40px;
    align-items: start;
  }

  .freelancer-profile-video-section {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    background: #000;
    aspect-ratio: 16/9;
  }

  .freelancer-profile-video-thumbnail {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .freelancer-profile-video-play-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.95);
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    z-index: 2;
  }

  .freelancer-profile-video-play-btn:hover {
    background: white;
    transform: translate(-50%, -50%) scale(1.1);
  }

  .freelancer-profile-video-play-btn svg {
    color: var(--junspro-primary);
    margin-left: 4px;
  }

  /* Sidebar droite premium */
  .freelancer-profile-sidebar-premium {
    position: sticky;
    top: 100px;
  }

  .freelancer-profile-sidebar-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 1px solid var(--junspro-border);
    margin-bottom: 20px;
  }

  .freelancer-profile-popularity-box {
    background: linear-gradient(135deg, rgba(236, 72, 153, 0.1) 0%, rgba(244, 114, 182, 0.1) 100%);
    border: 1px solid rgba(236, 72, 153, 0.2);
    border-radius: 12px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
  }

  .freelancer-profile-popularity-box i {
    color: #EC4899;
    font-size: 18px;
  }

  .freelancer-profile-stats-box {
    text-align: center;
    padding: 20px;
    background: var(--junspro-bg-light);
    border-radius: 12px;
    margin-bottom: 20px;
  }

  .freelancer-profile-stats-box .stat-number {
    font-size: 32px;
    font-weight: 700;
    color: var(--junspro-text);
    line-height: 1;
  }

  .freelancer-profile-stats-box .stat-label {
    font-size: 14px;
    color: var(--junspro-text-light);
    margin-top: 4px;
  }

  .freelancer-profile-cta-buttons-premium {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .freelancer-profile-cta-primary-premium {
    padding: 14px 20px;
    background: var(--junspro-gradient);
    color: white;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .freelancer-profile-cta-primary-premium:hover {
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
    transform: translateY(-1px);
    color: white;
  }

  .freelancer-profile-cta-secondary-premium {
    padding: 12px 20px;
    background: white;
    color: var(--junspro-text);
    border: 1px solid var(--junspro-border);
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .freelancer-profile-cta-secondary-premium:hover {
    background: var(--junspro-bg-light);
    border-color: var(--junspro-primary);
    color: var(--junspro-primary);
  }

  /* Sections principales */
  .freelancer-profile-section-premium {
    background: white;
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--junspro-border);
  }

  .freelancer-profile-section-title {
    font-size: 24px;
    font-weight: 700;
    color: var(--junspro-text);
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .freelancer-profile-section-title i {
    color: var(--junspro-primary);
  }

  /* Résumé du profil */
  .freelancer-profile-summary-item {
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--junspro-border);
  }

  .freelancer-profile-summary-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
  }

  .freelancer-profile-summary-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--junspro-text);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .freelancer-profile-summary-title i {
    color: var(--junspro-primary);
    font-size: 18px;
  }

  .freelancer-profile-summary-text {
    font-size: 14px;
    line-height: 1.7;
    color: var(--junspro-text-light);
  }

  .freelancer-profile-ai-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    color: var(--junspro-text-light);
    margin-top: 8px;
  }

  /* Note du projet */
  .freelancer-profile-rating-criteria {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 16px;
  }

  .freelancer-profile-rating-item {
    text-align: center;
    padding: 16px;
    background: var(--junspro-bg-light);
    border-radius: 12px;
  }

  .freelancer-profile-rating-item-number {
    font-size: 28px;
    font-weight: 700;
    color: var(--junspro-text);
    line-height: 1;
    margin-bottom: 8px;
  }

  .freelancer-profile-rating-item-icon {
    font-size: 24px;
    color: var(--junspro-primary);
    margin-bottom: 8px;
  }

  .freelancer-profile-rating-item-label {
    font-size: 13px;
    color: var(--junspro-text-light);
    font-weight: 500;
  }

  /* Avis clients */
  .freelancer-profile-reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--junspro-border);
  }

  .freelancer-profile-reviews-rating-large {
    text-align: center;
  }

  .freelancer-profile-reviews-rating-number {
    font-size: 48px;
    font-weight: 700;
    color: var(--junspro-primary);
    line-height: 1;
    margin-bottom: 8px;
  }

  .freelancer-profile-reviews-stars {
    font-size: 24px;
    color: #FCD34D;
    margin-bottom: 8px;
  }

  .freelancer-profile-reviews-summary {
    background: var(--junspro-bg-light);
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 24px;
  }

  .freelancer-profile-review-card-premium {
    padding: 20px;
    border-bottom: 1px solid var(--junspro-border);
    margin-bottom: 20px;
  }

  .freelancer-profile-review-card-premium:last-child {
    border-bottom: none;
    margin-bottom: 0;
  }

  .freelancer-profile-review-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
  }

  .freelancer-profile-review-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--junspro-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 18px;
  }

  /* CV Tabs */
  .freelancer-profile-cv-tabs-premium {
    display: flex;
    gap: 8px;
    margin-bottom: 24px;
    border-bottom: 2px solid var(--junspro-border);
  }

  .freelancer-profile-cv-tab {
    padding: 12px 24px;
    background: transparent;
    border: none;
    border-bottom: 3px solid transparent;
    font-size: 15px;
    font-weight: 600;
    color: var(--junspro-text-light);
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: -2px;
  }

  .freelancer-profile-cv-tab:hover {
    color: var(--junspro-primary);
  }

  .freelancer-profile-cv-tab.active {
    color: var(--junspro-primary);
    border-bottom-color: var(--junspro-primary);
  }

  .freelancer-profile-cv-tab-content {
    display: none;
  }

  .freelancer-profile-cv-tab-content.active {
    display: block;
  }

  .freelancer-profile-cv-timeline-item {
    display: grid;
    grid-template-columns: 150px 1fr;
    gap: 24px;
    padding-bottom: 24px;
    margin-bottom: 24px;
    border-bottom: 1px solid var(--junspro-border);
  }

  .freelancer-profile-cv-timeline-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
  }

  .freelancer-profile-cv-date {
    font-size: 14px;
    font-weight: 600;
    color: var(--junspro-primary);
  }

  /* Spécialisations */
  .freelancer-profile-specialization-item {
    border: 1px solid var(--junspro-border);
    border-radius: 12px;
    margin-bottom: 12px;
    overflow: hidden;
  }

  .freelancer-profile-specialization-toggle {
    width: 100%;
    padding: 16px 20px;
    background: white;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    font-size: 15px;
    font-weight: 600;
    color: var(--junspro-text);
    transition: all 0.2s;
  }

  .freelancer-profile-specialization-toggle:hover {
    background: var(--junspro-bg-light);
  }

  .freelancer-profile-specialization-toggle svg {
    transition: transform 0.2s;
  }

  .freelancer-profile-specialization-item.active .freelancer-profile-specialization-toggle svg {
    transform: rotate(180deg);
  }

  .freelancer-profile-specialization-content {
    padding: 0 20px;
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s;
  }

  .freelancer-profile-specialization-item.active .freelancer-profile-specialization-content {
    padding: 20px;
    max-height: 500px;
  }

  /* Recommandation alternative */
  .freelancer-profile-alternative-box {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
    border: 1px solid rgba(16, 185, 129, 0.2);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    gap: 16px;
    align-items: start;
  }

  .freelancer-profile-alternative-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--junspro-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    flex-shrink: 0;
  }

  .freelancer-profile-alternative-badge {
    position: absolute;
    bottom: -4px;
    left: 50%;
    transform: translateX(-50%);
    background: white;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    color: var(--junspro-text);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  /* Responsive */
  @media (max-width: 992px) {
    .freelancer-profile-hero-content-premium {
      grid-template-columns: 1fr;
    }

    .freelancer-profile-sidebar-premium {
      position: static;
    }

    .freelancer-profile-rating-criteria {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 768px) {
    .freelancer-profile-rating-criteria {
      grid-template-columns: 1fr;
    }
  }
</style>
@endsection

@section('content')
  @php
    $avgRating = $averageRating ?? ($freelancer->reliability_score / 20 ?? 4.5);
    $reviewsCount = $reviews->count() ?? 0;
    $projectsCount = $freelancer->subscriptions()->count() ?? 0;
    $recurringClients = $freelancer->subscriptions()->where('status', 'active')->count() ?? 0;
    
    // Calculer les notes par critère (simulé pour l'instant)
    $ratingSupport = 5.0;
    $ratingClarity = 4.9;
    $ratingProgress = 4.8;
    $ratingPreparation = 5.0;
  @endphp

  <!-- Hero Section avec vidéo -->
  <section class="freelancer-profile-hero-premium">
    <div class="container">
      <div class="freelancer-profile-hero-content-premium">
        <!-- Vidéo de présentation -->
        <div class="freelancer-profile-video-section">
          <img src="{{ asset('assets/img/video-placeholder.jpg') }}" 
               alt="Vidéo de présentation" 
               class="freelancer-profile-video-thumbnail">
          <button class="freelancer-profile-video-play-btn" id="play-video-btn">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polygon points="5 3 19 12 5 21 5 3"></polygon>
            </svg>
          </button>
        </div>

        <!-- Sidebar droite -->
        <div class="freelancer-profile-sidebar-premium">
          <!-- Popularité -->
          <div class="freelancer-profile-popularity-box">
            <i class="fas fa-fire"></i>
            <span>{{ __('Très populaire') }}. {{ rand(10, 50) }} {{ __('réservations récentes') }}</span>
          </div>

          <!-- Stats -->
          <div class="freelancer-profile-sidebar-card">
            <div class="freelancer-profile-stats-box">
              <div class="stat-number">{{ number_format($avgRating, 1) }}</div>
              <div class="stat-label">{{ __('Note') }}</div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-top: 16px;">
              <div>
                <div class="stat-number" style="font-size: 24px;">{{ $projectsCount }}</div>
                <div class="stat-label">{{ __('Rituels') }}</div>
              </div>
              <div>
                <div class="stat-number" style="font-size: 24px;">{{ $recurringClients }}</div>
                <div class="stat-label">{{ __('clients') }}</div>
              </div>
              <div>
                <div class="stat-number" style="font-size: 24px;">{{ number_format($freelancer->hourly_rate, 0) }} €</div>
                <div class="stat-label">{{ __('par heure') }}</div>
              </div>
            </div>
            <div style="text-align: center; margin-top: 12px; font-size: 14px; color: var(--junspro-text-light);">
              {{ $reviewsCount }} {{ __('avis') }}
            </div>
          </div>

          <!-- CTA Buttons -->
          <div class="freelancer-profile-sidebar-card">
            <div class="freelancer-profile-cta-buttons-premium">
              <a href="#agenda" class="freelancer-profile-cta-primary-premium">
                <i class="fas fa-bolt"></i>
                {{ __('Réserver 1h d\'essai') }}
              </a>
              <a href="#" class="freelancer-profile-cta-secondary-premium">
                <i class="fas fa-envelope"></i>
                {{ __('Envoyer un message') }}
              </a>
              <a href="#" class="freelancer-profile-cta-secondary-premium">
                <i class="fas fa-heart"></i>
                {{ __('Sauvegarder dans ma liste') }}
              </a>
            </div>
          </div>

          <!-- Recommandation alternative -->
          <div class="freelancer-profile-sidebar-card">
            <div class="freelancer-profile-alternative-box">
              <div style="position: relative;">
                <div class="freelancer-profile-alternative-avatar">
                  {{ strtoupper(substr($user->name ?? 'F', 0, 1)) }}
                </div>
                <div class="freelancer-profile-alternative-badge">{{ __('Changement gratuit') }}</div>
              </div>
              <div style="flex: 1;">
                <p style="font-size: 14px; line-height: 1.6; color: var(--junspro-text); margin: 0;">
                  {{ $user->name }} {{ __('ne vous correspond pas ?') }} {{ __('Vous pouvez encore suivre 2 Rituels d\'essai gratuits pour trouver le freelance idéal.') }}
                </p>
              </div>
            </div>
          </div>

          <!-- Temps de réponse -->
          <div style="text-align: center; font-size: 13px; color: var(--junspro-text-light);">
            <i class="fas fa-clock"></i>
            {{ __('Temps de réponse moyen') }} : ~{{ rand(1, 6) }}h
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contenu principal -->
  <section class="pt-40 pb-60">
    <div class="container">
      <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
          
          <!-- Résumé du profil -->
          <div class="freelancer-profile-section-premium">
            <h2 class="freelancer-profile-section-title">
              <i class="fas fa-user-circle"></i>
              {{ __('Résumé du profil') }}
            </h2>

            <!-- Points forts -->
            <div class="freelancer-profile-summary-item">
              <div class="freelancer-profile-summary-title">
                <i class="fas fa-thumbs-up"></i>
                {{ __('Points forts') }}
              </div>
              <div class="freelancer-profile-summary-text">
                {{ $user->name }} {{ __('a') }} {{ rand(2, 5) }} {{ __('ans d\'expérience et une note de') }} {{ number_format($avgRating, 1) }} {{ __('sur') }} {{ $reviewsCount }} {{ __('avis, ce qui indique ses méthodes de travail efficaces et son bon rapport avec les clients.') }}
              </div>
              <div class="freelancer-profile-ai-badge">
                <i class="fas fa-sparkles"></i>
                {{ __('Résumé généré par l\'IA à partir des données du profil') }}
              </div>
            </div>

            <!-- Style de travail -->
            <div class="freelancer-profile-summary-item">
              <div class="freelancer-profile-summary-title">
                <i class="fas fa-graduation-cap"></i>
                {{ __('Style de travail') }}
              </div>
              <div class="freelancer-profile-summary-text">
                {{ __('Il utilise des plans de Rituel personnalisés adaptés aux besoins et aux objectifs de chaque client, favorisant un environnement encourageant pour la collaboration et l\'atteinte des résultats.') }}
              </div>
              <div class="freelancer-profile-ai-badge">
                <i class="fas fa-sparkles"></i>
                {{ __('Résumé généré par l\'IA à partir des données du profil') }}
              </div>
            </div>

            <!-- Freelance qualifié -->
            <div class="freelancer-profile-summary-item">
              <div class="freelancer-profile-summary-title">
                <i class="fas fa-check-circle" style="color: #10B981;"></i>
                {{ __('Freelance qualifié') }}
              </div>
              <div class="freelancer-profile-summary-text">
                {{ $user->name }} {{ __('détient des certifications qui attestent de ses compétences.') }}
              </div>
              <a href="#certifications" style="color: var(--junspro-primary); font-size: 14px; font-weight: 500;">
                {{ __('En savoir plus') }}
              </a>
            </div>
          </div>

          <!-- À propos de moi -->
          @if($freelancer->bio)
            <div class="freelancer-profile-section-premium">
              <h2 class="freelancer-profile-section-title">
                <i class="fas fa-user"></i>
                {{ __('À propos de moi') }}
              </h2>
              <div style="position: relative;">
                <div class="freelancer-profile-summary-text" id="about-text">
                  {!! nl2br($freelancer->bio) !!}
                </div>
                @if(strlen($freelancer->bio) > 500)
                  <button class="btn btn-link p-0 mt-2" id="about-toggle" style="color: var(--junspro-primary);">
                    {{ __('Voir plus') }}
                  </button>
                @endif
              </div>
            </div>
          @endif

          <!-- Je parle (Langues) -->
          @if(!empty($freelancer->languages))
            <div class="freelancer-profile-section-premium">
              <h2 class="freelancer-profile-section-title">
                <i class="fas fa-language"></i>
                {{ __('Je parle') }}
              </h2>
              <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                @foreach($freelancer->languages as $lang)
                  <div style="display: flex; align-items: center; gap: 8px; padding: 8px 14px; background: var(--junspro-bg-light); border-radius: 8px;">
                    <span style="font-weight: 600; color: var(--junspro-text);">{{ $lang['name'] ?? $lang }}</span>
                    <span style="padding: 4px 10px; background: var(--junspro-primary); color: white; border-radius: 6px; font-size: 12px; font-weight: 600;">
                      {{ $lang['level'] ?? 'Natif' }}
                    </span>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Note du Rituel -->
          <div class="freelancer-profile-section-premium">
            <h2 class="freelancer-profile-section-title">
              <i class="fas fa-star"></i>
              {{ __('Note du Rituel') }}
            </h2>
            <div class="freelancer-profile-rating-criteria">
              <div class="freelancer-profile-rating-item">
                <div class="freelancer-profile-rating-item-icon">😊</div>
                <div class="freelancer-profile-rating-item-number">{{ number_format($ratingSupport, 1) }}</div>
                <div class="freelancer-profile-rating-item-label">{{ __('Soutien') }}</div>
              </div>
              <div class="freelancer-profile-rating-item">
                <div class="freelancer-profile-rating-item-icon">💬</div>
                <div class="freelancer-profile-rating-item-number">{{ number_format($ratingClarity, 1) }}</div>
                <div class="freelancer-profile-rating-item-label">{{ __('Clarté') }}</div>
              </div>
              <div class="freelancer-profile-rating-item">
                <div class="freelancer-profile-rating-item-icon">📈</div>
                <div class="freelancer-profile-rating-item-number">{{ number_format($ratingProgress, 1) }}</div>
                <div class="freelancer-profile-rating-item-label">{{ __('Progrès') }}</div>
              </div>
              <div class="freelancer-profile-rating-item">
                <div class="freelancer-profile-rating-item-icon">✏️</div>
                <div class="freelancer-profile-rating-item-number">{{ number_format($ratingPreparation, 1) }}</div>
                <div class="freelancer-profile-rating-item-label">{{ __('Préparation') }}</div>
              </div>
            </div>
            <p style="text-align: center; font-size: 13px; color: var(--junspro-text-light); margin-top: 16px;">
              {{ __('D\'après') }} {{ $reviewsCount }} {{ __('avis de clients anonymes') }}
            </p>
          </div>

          <!-- L'avis de mes clients -->
          @if($reviews->isNotEmpty())
            <div class="freelancer-profile-section-premium">
              <div class="freelancer-profile-reviews-header">
                <div>
                  <h2 class="freelancer-profile-section-title" style="margin-bottom: 8px;">
                    {{ __('L\'avis de mes clients') }}
                  </h2>
                  <p style="font-size: 14px; color: var(--junspro-text-light); margin: 0;">
                    {{ __('D\'après') }} {{ $reviewsCount }} {{ __('avis de clients') }}
                  </p>
                </div>
                <div class="freelancer-profile-reviews-rating-large">
                  <div class="freelancer-profile-reviews-rating-number">{{ number_format($avgRating, 1) }}</div>
                  <div class="freelancer-profile-reviews-stars">
                    @for($i = 0; $i < 5; $i++)
                      <i class="fas fa-star"></i>
                    @endfor
                  </div>
                </div>
              </div>

              <!-- Résumé des avis -->
              <div class="freelancer-profile-reviews-summary">
                <div style="display: flex; align-items: start; gap: 12px;">
                  <i class="fas fa-file-alt" style="color: var(--junspro-primary); font-size: 20px; margin-top: 2px;"></i>
                  <div>
                    <p style="font-size: 14px; line-height: 1.7; color: var(--junspro-text); margin: 0;">
                      {{ __('Les clients disent que') }} {{ $user->name }} {{ __('est professionnel, compétent et rend le travail agréable.') }}
                    </p>
                    <div class="freelancer-profile-ai-badge" style="margin-top: 8px;">
                      <i class="fas fa-sparkles"></i>
                      {{ __('Résumé généré par l\'IA à partir des avis des clients') }}
                    </div>
                  </div>
                </div>
              </div>

              <!-- Liste des avis -->
              @foreach($reviews->take(6) as $review)
                <div class="freelancer-profile-review-card-premium">
                  <div class="freelancer-profile-review-header">
                    <div class="freelancer-profile-review-avatar">
                      {{ strtoupper(substr($review->user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div style="flex: 1;">
                      <div style="font-weight: 600; color: var(--junspro-text); margin-bottom: 4px;">
                        {{ $review->user->name ?? __('Anonyme') }}
                      </div>
                      <div style="font-size: 12px; color: var(--junspro-text-light);">
                        {{ $review->created_at->format('d F Y') }}
                      </div>
                    </div>
                    <div>
                      @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star" style="color: {{ $i < $review->rating ? '#FCD34D' : '#E5E7EB' }};"></i>
                      @endfor
                    </div>
                  </div>
                  @if($review->comment)
                    <p style="font-size: 14px; line-height: 1.7; color: var(--junspro-text); margin: 12px 0 0 0;">
                      {{ $review->comment }}
                    </p>
                  @endif
                </div>
              @endforeach

              @if($reviewsCount > 6)
                <button class="btn btn-outline-primary w-100 mt-3">
                  {{ __('Afficher') }} {{ $reviewsCount }} {{ __('avis') }}
                </button>
              @endif
            </div>
          @endif

          <!-- CV (Expérience & Certifications) -->
          <div class="freelancer-profile-section-premium">
            <h2 class="freelancer-profile-section-title">
              <i class="fas fa-file-alt"></i>
              {{ __('CV') }}
            </h2>

            <!-- Tabs -->
            <div class="freelancer-profile-cv-tabs-premium">
              <button class="freelancer-profile-cv-tab active" data-tab="experience">
                {{ __('Expérience professionnelle') }}
              </button>
              <button class="freelancer-profile-cv-tab" data-tab="certifications">
                {{ __('Certifications') }}
              </button>
            </div>

            <!-- Contenu Expérience -->
            <div class="freelancer-profile-cv-tab-content active" id="cv-experience">
              <div class="freelancer-profile-cv-timeline-item">
                <div class="freelancer-profile-cv-date">2024 — 2025</div>
                <div>
                  <h4 style="font-size: 18px; font-weight: 600; color: var(--junspro-text); margin-bottom: 4px;">
                    {{ __('Freelance indépendant') }}
                  </h4>
                  <p style="font-size: 14px; color: var(--junspro-text-light); margin-bottom: 8px;">
                    {{ __('Spécialisé en développement web et design') }}
                  </p>
                  <p style="font-size: 14px; line-height: 1.6; color: var(--junspro-text-light);">
                    {{ __('Création de projets web pour des clients dans le secteur du coaching et de l\'infopreneuriat.') }}
                  </p>
                </div>
              </div>
              <div class="freelancer-profile-cv-timeline-item">
                <div class="freelancer-profile-cv-date">2022 — 2024</div>
                <div>
                  <h4 style="font-size: 18px; font-weight: 600; color: var(--junspro-text); margin-bottom: 4px;">
                    {{ __('Agence Marketing Digital') }}
                  </h4>
                  <p style="font-size: 14px; color: var(--junspro-text-light); margin-bottom: 8px;">
                    {{ __('Responsable Projets Web') }}
                  </p>
                  <p style="font-size: 14px; line-height: 1.6; color: var(--junspro-text-light);">
                    {{ __('Direction d\'une équipe et création de projets pour des clients e-commerce.') }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Contenu Certifications -->
            <div class="freelancer-profile-cv-tab-content" id="cv-certifications">
              <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; gap: 16px; padding: 16px; background: var(--junspro-bg-light); border-radius: 12px;">
                  <div style="font-size: 32px;">🎓</div>
                  <div>
                    <h4 style="font-size: 16px; font-weight: 600; color: var(--junspro-text); margin-bottom: 4px;">
                      {{ __('Master en Marketing Digital') }}
                    </h4>
                    <p style="font-size: 13px; color: var(--junspro-text-light); margin: 0;">
                      {{ __('Université Paris-Dauphine') }} • 2021
                    </p>
                  </div>
                </div>
                <div style="display: flex; gap: 16px; padding: 16px; background: var(--junspro-bg-light); border-radius: 12px;">
                  <div style="font-size: 32px;">🏆</div>
                  <div>
                    <h4 style="font-size: 16px; font-weight: 600; color: var(--junspro-text); margin-bottom: 4px;">
                      {{ __('Certification Google Ads') }}
                    </h4>
                    <p style="font-size: 13px; color: var(--junspro-text-light); margin: 0;">
                      {{ __('Google') }} • 2022
                    </p>
                  </div>
                </div>
                <div style="display: flex; gap: 16px; padding: 16px; background: var(--junspro-bg-light); border-radius: 12px;">
                  <div style="font-size: 32px;">⭐</div>
                  <div>
                    <h4 style="font-size: 16px; font-weight: 600; color: var(--junspro-text); margin-bottom: 4px;">
                      {{ __('Top Junspro Freelance') }}
                    </h4>
                    <p style="font-size: 13px; color: var(--junspro-text-light); margin: 0;">
                      {{ __('Junspro') }} • 2024
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Mes spécialisations -->
          @if(!empty($freelancer->skills))
            <div class="freelancer-profile-section-premium">
              <h2 class="freelancer-profile-section-title">
                <i class="fas fa-briefcase"></i>
                {{ __('Mes spécialisations') }}
              </h2>
              <div>
                @foreach($freelancer->skills as $index => $skill)
                  <div class="freelancer-profile-specialization-item {{ $index === 0 ? 'active' : '' }}">
                    <button class="freelancer-profile-specialization-toggle">
                      <span>{{ $skill }}</span>
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                      </svg>
                    </button>
                    <div class="freelancer-profile-specialization-content">
                      <p style="font-size: 14px; line-height: 1.7; color: var(--junspro-text-light); margin-bottom: 12px;">
                        <strong>{{ __('Types de missions') }}</strong> : {{ __('Projets complets, refontes, optimisations') }}
                      </p>
                      <p style="font-size: 14px; line-height: 1.7; color: var(--junspro-text-light); margin-bottom: 12px;">
                        <strong>{{ __('Exemples de résultats') }}</strong> : {{ __('+300% de conversions, Rituels livrés dans les délais') }}
                      </p>
                      <p style="font-size: 14px; line-height: 1.7; color: var(--junspro-text-light); margin: 0;">
                        <strong>{{ __('Fourchette de prix') }}</strong> : {{ number_format($freelancer->hourly_rate * 10, 0) }}€ - {{ number_format($freelancer->hourly_rate * 50, 0) }}€ / Rituel
                      </p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Agenda (déjà existant) -->
          @include('frontend.freelance.partials.agenda-premium', ['freelancer' => $freelancer, 'user' => $user])

        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
<script src="{{ asset('assets/front/js/freelancer-profile-premium.js') }}?v={{ time() }}"></script>
<script>
  // Gestion des tabs CV
  document.querySelectorAll('.freelancer-profile-cv-tab').forEach(tab => {
    tab.addEventListener('click', function() {
      const targetTab = this.dataset.tab;
      
      // Mettre à jour les tabs
      document.querySelectorAll('.freelancer-profile-cv-tab').forEach(t => t.classList.remove('active'));
      this.classList.add('active');
      
      // Mettre à jour le contenu
      document.querySelectorAll('.freelancer-profile-cv-tab-content').forEach(content => {
        content.classList.remove('active');
      });
      document.getElementById(`cv-${targetTab}`).classList.add('active');
    });
  });

  // Gestion des spécialisations (accordéons)
  document.querySelectorAll('.freelancer-profile-specialization-toggle').forEach(toggle => {
    toggle.addEventListener('click', function() {
      const item = this.closest('.freelancer-profile-specialization-item');
      item.classList.toggle('active');
    });
  });

  // Toggle "Voir plus" pour À propos
  const aboutToggle = document.getElementById('about-toggle');
  const aboutText = document.getElementById('about-text');
  if (aboutToggle && aboutText) {
    let isExpanded = false;
    const originalText = aboutText.innerHTML;
    
    if (aboutText.scrollHeight > 200) {
      aboutText.style.maxHeight = '200px';
      aboutText.style.overflow = 'hidden';
      
      aboutToggle.addEventListener('click', function() {
        if (isExpanded) {
          aboutText.style.maxHeight = '200px';
          this.textContent = '{{ __("Voir plus") }}';
        } else {
          aboutText.style.maxHeight = 'none';
          this.textContent = '{{ __("Voir moins") }}';
        }
        isExpanded = !isExpanded;
      });
    } else {
      aboutToggle.style.display = 'none';
    }
  }

  // Bouton play vidéo
  document.getElementById('play-video-btn')?.addEventListener('click', function() {
    // Ouvrir la vidéo en modal ou rediriger
    alert('{{ __("Fonctionnalité vidéo à implémenter") }}');
  });
</script>
@endsection




