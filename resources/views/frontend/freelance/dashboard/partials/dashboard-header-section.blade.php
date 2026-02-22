{{-- Bloc "Tableau de bord Freelance" réutilisable - Hero Premium --}}
<div class="dashboard-header dashboard-overview-hero @if(request('tab') == 'overview' || !request('tab')) is-overview @endif">
  <div class="hero-glow"></div>
  <div class="hero-content">
    <div class="hero-text">
      <h1 class="hero-title">Tableau de bord Freelance</h1>
      <p class="hero-subtitle">
        Un espace clair pour avancer sans relances : vos clients voient l'avancement, vous gardez le rythme.
      </p>
      <div class="hero-ctas">
        <a href="{{ route('freelance.services.create') }}" class="btn-hero btn-hero-primary">
          <span class="btn-text">Créer un service</span>
          <span class="btn-icon">→</span>
        </a>
        @if(isset($freelancerProfile) && $freelancerProfile && $freelancerProfile->id)
          <a href="{{ route('freelance.show', ['id' => $freelancerProfile->id]) }}" target="_blank" class="btn-hero btn-hero-secondary">
            <span class="btn-text">Voir mon profil public</span>
          </a>
        @else
          <a href="#" class="btn-hero btn-hero-secondary" onclick="alert('Vous devez compléter votre profil freelance pour voir votre profil public.'); return false;">
            <span class="btn-text">Voir mon profil public</span>
          </a>
        @endif
      </div>
      <p class="hero-hint">💡 Plus vos informations sont complètes, plus vous remontez dans les résultats.</p>
    </div>
    <div class="hero-visual">
      <div class="hero-visual-card">
        <div class="visual-badge">Bienvenue</div>
        <div class="visual-icon">✨</div>
        <p class="visual-text">Gérez vos missions,<br>augmentez vos revenus</p>
      </div>
    </div>
  </div>
</div>

