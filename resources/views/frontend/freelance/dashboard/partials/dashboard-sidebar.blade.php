{{-- Carte Navigation réutilisable --}}
<aside class="sidebar-premium">
  <!-- Navigation -->
  <div class="nav-section">
    <h4 class="nav-title">Navigation</h4>
    <div class="nav-list">
      <a href="{{ route('freelance.dashboard', ['tab' => 'overview']) }}" class="nav-item {{ ($activeTab ?? 'overview') === 'overview' ? 'active' : '' }}">
        <span class="nav-icon">📈</span>
        <span>Aperçu</span>
      </a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'requests']) }}" class="nav-item {{ ($activeTab ?? 'overview') === 'requests' ? 'active' : '' }}">
        <span class="nav-icon">📥</span>
        <span>Demandes</span>
      </a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'jobs']) }}" class="nav-item {{ ($activeTab ?? 'overview') === 'jobs' ? 'active' : '' }}">
        <span class="nav-icon">⚙️</span>
        <span>Prestations</span>
      </a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'calendar']) }}" class="nav-item {{ ($activeTab ?? 'overview') === 'calendar' ? 'active' : '' }}">
        <span class="nav-icon">📅</span>
        <span>Agenda</span>
      </a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'services']) }}" class="nav-item {{ ($activeTab ?? 'overview') === 'services' ? 'active' : '' }}">
        <span class="nav-icon">🛠️</span>
        <span>Services</span>
      </a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'messages']) }}" class="nav-item {{ ($activeTab ?? 'overview') === 'messages' ? 'active' : '' }}">
        <span class="nav-icon">✉️</span>
        <span>Messages</span>
      </a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'earnings']) }}" class="nav-item {{ ($activeTab ?? 'overview') === 'earnings' ? 'active' : '' }}">
        <span class="nav-icon">💳</span>
        <span>Revenus</span>
      </a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'profile']) }}" class="nav-item {{ ($activeTab ?? 'overview') === 'profile' ? 'active' : '' }}">
        <span class="nav-icon">👤</span>
        <span>Profil</span>
      </a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" class="nav-item {{ ($activeTab ?? 'overview') === 'settings' ? 'active' : '' }}">
        <span class="nav-icon">⚙️</span>
        <span>Paramètres</span>
      </a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'rituals']) }}" class="nav-item {{ ($activeTab ?? 'overview') === 'rituals' ? 'active' : '' }}">
        <span class="nav-icon">✨</span>
        <span>Rituels</span>
      </a>
    </div>
  </div>

  <!-- Statistiques -->
  <div class="stats-section">
    <h4 class="stats-title">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
      </svg>
      Vos indicateurs
    </h4>
    <div class="stats-grid">
      <div class="stat-item">
        <span class="stat-label">Prestations actives</span>
        <span class="stat-value">0</span>
      </div>
      <div class="stat-item">
        <span class="stat-label">Profil complété</span>
        <span class="stat-value">85%</span>
      </div>
      <div class="stat-item">
        <span class="stat-label">Services publiés</span>
        <span class="stat-value">3</span>
      </div>
      <div class="stat-item">
        <span class="stat-label">Taux de satisfaction</span>
        <span class="stat-value highlight">—</span>
      </div>
    </div>
  </div>

  <!-- Conseils -->
  <div class="tips-section">
    <div class="tip-header">
      <span class="tip-icon">💡</span>
      <h4 class="tip-title">Conseil stratégique</h4>
    </div>
    <p class="tip-content">
      Les services avec des livrables clairement définis attirent 70% moins de questions
      préalables et convertissent 40% mieux. Soyez précis sur les résultats.
    </p>
  </div>

  <!-- Citation -->
  <div class="tips-section" style="margin-top: 1.5rem;">
    <div class="tip-header">
      <span class="tip-icon">🚀</span>
      <h4 class="tip-title">Boost de visibilité</h4>
    </div>
    <p class="tip-content">
      Les freelances avec un profil à 100% reçoivent en moyenne
      <strong>3× plus de demandes qualifiées</strong> dans leur premier mois.
    </p>
  </div>

  <!-- Mini CTA -->
  <div class="tips-section" style="margin-top: 1.5rem; background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(139, 92, 246, 0.03) 100%); border-color: rgba(59, 130, 246, 0.2);">
    <div class="tip-header">
      <span class="tip-icon">🎯</span>
      <h4 class="tip-title">Prêt à commencer ?</h4>
    </div>
    <p class="tip-content" style="font-size: 0.8rem; margin-bottom: 1rem;">
      Créez votre premier Rituel en moins de 5 minutes.
    </p>
    <a href="{{ route('freelance.services.create') }}" style="display: block; width: 100%; padding: 0.75rem; background: var(--primary); color: white; border: none; border-radius: var(--radius-md); font-weight: 600; cursor: pointer; font-size: 0.875rem; transition: all 0.2s ease; text-align: center; text-decoration: none;">
      + Nouveau service
    </a>
  </div>
</aside>

