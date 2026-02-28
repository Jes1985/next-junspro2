{{-- 
  Composant Shell Premium pour le Dashboard Freelance
  Référence : /freelance/dashboard?tab=requests (onglet Demandes)
  
  Usage :
  @include('frontend.freelance.dashboard.partials.dashboard-shell', [
    'activeTab' => $activeTab,
    'freelancerProfile' => $freelancerProfile,
    'pageTitle' => 'Titre de la page',
    'pageSubtitle' => 'Sous-titre de la page',
    'wrapperClass' => 'custom-page-wrapper-light' // Classe wrapper spécifique à l'onglet
  ])
  
  Le contenu spécifique de l'onglet sera injecté via @yield('dashboard-content')
--}}

@php
  $currentActiveTab = $activeTab ?? 'overview';
  $wrapperClass = $wrapperClass ?? 'dashboard-page-wrapper-light';
@endphp

<div class="{{ $wrapperClass }}">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Bloc Tableau de bord Freelance -->
      <div class="dashboard-header">
        <h1>Tableau de bord Freelance</h1>
        <p class="dashboard-header-subtitle">
          Un espace clair pour avancer sans relances : vos clients voient l'avancement, vous gardez le rythme.
        </p>
        <div class="dashboard-header-ctas">
          <a href="{{ route('freelance.services.create') }}" class="btn-premium btn-premium-primary">
            Créer un service
          </a>
          <a href="{{ route('freelance.show', ['id' => $freelancerProfile->id ?? 0]) }}" target="_blank" class="btn-premium btn-premium-secondary">
            Voir mon profil public
          </a>
        </div>
        <p style="margin-top: 0.75rem; font-size: 0.85rem; color: #6b7280;">💡 Plus vos informations sont complètes, plus vous remontez dans les résultats.</p>
      </div>

      <!-- Header de page spécifique -->
      @if(isset($pageTitle))
      <div class="page-header">
        <h1>{{ $pageTitle }}</h1>
        @if(isset($pageSubtitle))
        <p class="page-subtitle">{{ $pageSubtitle }}</p>
        @endif
      </div>
      @endif

      <!-- Contenu spécifique de l'onglet -->
      @if(isset($content))
        {!! $content !!}
      @else
        @yield('dashboard-content')
      @endif
    </main>

    <!-- ===== SIDEBAR (30%) - NAVIGATION ===== -->
    <aside class="sidebar">
      <!-- Navigation -->
      <div class="nav-section">
        <h4 class="nav-title">Navigation</h4>
        <div class="nav-list">
          <a href="{{ route('freelance.dashboard', ['tab' => 'overview']) }}" class="nav-item {{ $currentActiveTab === 'overview' ? 'active' : '' }}">
            <span class="nav-icon">📈</span>
            <span>Aperçu</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'requests']) }}" class="nav-item {{ $currentActiveTab === 'requests' ? 'active' : '' }}">
            <span class="nav-icon">📥</span>
            <span>Demandes</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'jobs']) }}" class="nav-item {{ $currentActiveTab === 'jobs' ? 'active' : '' }}">
            <span class="nav-icon">⚙️</span>
            <span>Prestations</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'calendar']) }}" class="nav-item {{ $currentActiveTab === 'calendar' ? 'active' : '' }}">
            <span class="nav-icon">📅</span>
            <span>Agenda</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'services']) }}" class="nav-item {{ $currentActiveTab === 'services' ? 'active' : '' }}">
            <span class="nav-icon">🛠️</span>
            <span>Services</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'messages']) }}" class="nav-item {{ $currentActiveTab === 'messages' ? 'active' : '' }}">
            <span class="nav-icon">✉️</span>
            <span>Messages</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'earnings']) }}" class="nav-item {{ $currentActiveTab === 'earnings' ? 'active' : '' }}">
            <span class="nav-icon">💳</span>
            <span>Revenus</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'profile']) }}" class="nav-item {{ $currentActiveTab === 'profile' ? 'active' : '' }}">
            <span class="nav-icon">👤</span>
            <span>Profil</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" class="nav-item {{ $currentActiveTab === 'settings' ? 'active' : '' }}">
            <span class="nav-icon">⚙️</span>
            <span>Paramètres</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'rituals']) }}" class="nav-item {{ $currentActiveTab === 'rituals' ? 'active' : '' }}">
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
    </aside>
  </div>
</div>

{{-- Styles CSS communs pour le shell premium --}}
<style>
  /* ===== VARIABLES CSS COMMUNES ===== */
  .dashboard-page-wrapper-light,
  .overview-page-wrapper-light,
  .requests-page-wrapper-light,
  .jobs-page-wrapper-light,
  .calendar-page-wrapper-light,
  .services-page-wrapper-light,
  .messages-page-wrapper-light,
  .earnings-page-wrapper-light,
  .profile-page-wrapper-light,
  .settings-page-wrapper-light,
  .rituals-page-wrapper-light {
    --bg-primary: #FFFFFF;
    --bg-secondary: #F8FAFC;
    --bg-card: #FFFFFF;
    --text-primary: #1E293B;
    --text-secondary: #64748B;
    --text-tertiary: #94A3B8;
    --primary: #3B82F6;
    --primary-light: #60A5FA;
    --accent: #8B5CF6;
    --accent-light: #A78BFA;
    --border: #E2E8F0;
    --border-light: #F1F5F9;
    --success: #10B981;
    --warning: #F59E0B;
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.01);
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-xl: 20px;
    --radius-2xl: 24px;
  }

  /* ===== RESET GLOBAL ===== */
  .dashboard-page-wrapper-light *,
  .overview-page-wrapper-light *,
  .requests-page-wrapper-light *,
  .jobs-page-wrapper-light *,
  .calendar-page-wrapper-light *,
  .services-page-wrapper-light *,
  .messages-page-wrapper-light *,
  .earnings-page-wrapper-light *,
  .profile-page-wrapper-light *,
  .settings-page-wrapper-light *,
  .rituals-page-wrapper-light * {
    box-sizing: border-box;
  }

  /* ===== STRUCTURE 70/30 PREMIUM ===== */
  .dashboard-page-wrapper-light,
  .overview-page-wrapper-light,
  .requests-page-wrapper-light,
  .jobs-page-wrapper-light,
  .calendar-page-wrapper-light,
  .services-page-wrapper-light,
  .messages-page-wrapper-light,
  .earnings-page-wrapper-light,
  .profile-page-wrapper-light,
  .settings-page-wrapper-light,
  .rituals-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 20px 10px 20px 20px !important; /* 2cm top/bottom/left, 1cm right */
    box-sizing: border-box;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    line-height: 1.5;
  }

  .dashboard-page-wrapper-light .dashboard-container,
  .overview-page-wrapper-light .dashboard-container,
  .requests-page-wrapper-light .dashboard-container,
  .jobs-page-wrapper-light .dashboard-container,
  .calendar-page-wrapper-light .dashboard-container,
  .services-page-wrapper-light .dashboard-container,
  .messages-page-wrapper-light .dashboard-container,
  .earnings-page-wrapper-light .dashboard-container,
  .profile-page-wrapper-light .dashboard-container,
  .settings-page-wrapper-light .dashboard-container,
  .rituals-page-wrapper-light .dashboard-container {
    display: grid !important;
    grid-template-columns: 70% 30% !important;
    min-height: 100vh;
    max-width: none !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    background: transparent;
    box-shadow: none;
    box-sizing: border-box;
    gap: 0 10px !important; /* Espacement de 1cm (10px) entre les zones 70% et 30% */
    align-items: start !important;
    overflow-x: visible !important;
  }

  /* ===== ZONE PRINCIPALE (70%) ===== */
  .dashboard-page-wrapper-light .main-content,
  .overview-page-wrapper-light .main-content,
  .requests-page-wrapper-light .main-content,
  .jobs-page-wrapper-light .main-content,
  .calendar-page-wrapper-light .main-content,
  .services-page-wrapper-light .main-content,
  .messages-page-wrapper-light .main-content,
  .earnings-page-wrapper-light .main-content,
  .profile-page-wrapper-light .main-content,
  .settings-page-wrapper-light .main-content,
  .rituals-page-wrapper-light .main-content {
    padding: 4rem 10px !important;
    border-right: none !important;
    min-height: 100vh;
    background: transparent;
    box-sizing: border-box;
    overflow-x: visible !important;
    position: relative;
    max-width: none !important;
    width: 100% !important;
    min-width: 0 !important;
    grid-column: 1 !important;
  }

  /* ===== BLOC TABLEAU DE BORD FREELANCE ===== */
  .dashboard-page-wrapper-light .dashboard-header,
  .overview-page-wrapper-light .dashboard-header,
  .requests-page-wrapper-light .dashboard-header,
  .jobs-page-wrapper-light .dashboard-header,
  .calendar-page-wrapper-light .dashboard-header,
  .services-page-wrapper-light .dashboard-header,
  .messages-page-wrapper-light .dashboard-header,
  .earnings-page-wrapper-light .dashboard-header,
  .profile-page-wrapper-light .dashboard-header,
  .settings-page-wrapper-light .dashboard-header,
  .rituals-page-wrapper-light .dashboard-header {
    margin-top: 2cm;
    margin-left: 2cm;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }

  .dashboard-page-wrapper-light .dashboard-header h1,
  .overview-page-wrapper-light .dashboard-header h1,
  .requests-page-wrapper-light .dashboard-header h1,
  .jobs-page-wrapper-light .dashboard-header h1,
  .calendar-page-wrapper-light .dashboard-header h1,
  .services-page-wrapper-light .dashboard-header h1,
  .messages-page-wrapper-light .dashboard-header h1,
  .earnings-page-wrapper-light .dashboard-header h1,
  .profile-page-wrapper-light .dashboard-header h1,
  .settings-page-wrapper-light .dashboard-header h1,
  .rituals-page-wrapper-light .dashboard-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
  }

  .dashboard-page-wrapper-light .dashboard-header-subtitle,
  .overview-page-wrapper-light .dashboard-header-subtitle,
  .requests-page-wrapper-light .dashboard-header-subtitle,
  .jobs-page-wrapper-light .dashboard-header-subtitle,
  .calendar-page-wrapper-light .dashboard-header-subtitle,
  .services-page-wrapper-light .dashboard-header-subtitle,
  .messages-page-wrapper-light .dashboard-header-subtitle,
  .earnings-page-wrapper-light .dashboard-header-subtitle,
  .profile-page-wrapper-light .dashboard-header-subtitle,
  .settings-page-wrapper-light .dashboard-header-subtitle,
  .rituals-page-wrapper-light .dashboard-header-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin-bottom: 1.25rem;
    line-height: 1.5;
  }

  .dashboard-page-wrapper-light .dashboard-header-ctas,
  .overview-page-wrapper-light .dashboard-header-ctas,
  .requests-page-wrapper-light .dashboard-header-ctas,
  .jobs-page-wrapper-light .dashboard-header-ctas,
  .calendar-page-wrapper-light .dashboard-header-ctas,
  .services-page-wrapper-light .dashboard-header-ctas,
  .messages-page-wrapper-light .dashboard-header-ctas,
  .earnings-page-wrapper-light .dashboard-header-ctas,
  .profile-page-wrapper-light .dashboard-header-ctas,
  .settings-page-wrapper-light .dashboard-header-ctas,
  .rituals-page-wrapper-light .dashboard-header-ctas {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .dashboard-page-wrapper-light .btn-premium,
  .overview-page-wrapper-light .btn-premium,
  .requests-page-wrapper-light .btn-premium,
  .jobs-page-wrapper-light .btn-premium,
  .calendar-page-wrapper-light .btn-premium,
  .services-page-wrapper-light .btn-premium,
  .messages-page-wrapper-light .btn-premium,
  .earnings-page-wrapper-light .btn-premium,
  .profile-page-wrapper-light .btn-premium,
  .settings-page-wrapper-light .btn-premium,
  .rituals-page-wrapper-light .btn-premium {
    padding: 0.625rem 1.25rem;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .dashboard-page-wrapper-light .btn-premium-primary,
  .overview-page-wrapper-light .btn-premium-primary,
  .requests-page-wrapper-light .btn-premium-primary,
  .jobs-page-wrapper-light .btn-premium-primary,
  .calendar-page-wrapper-light .btn-premium-primary,
  .services-page-wrapper-light .btn-premium-primary,
  .messages-page-wrapper-light .btn-premium-primary,
  .earnings-page-wrapper-light .btn-premium-primary,
  .profile-page-wrapper-light .btn-premium-primary,
  .settings-page-wrapper-light .btn-premium-primary,
  .rituals-page-wrapper-light .btn-premium-primary {
    background: #ede9fe;
    color: #7c3aed;
    border: 1px solid #ddd6fe;
    box-shadow: 0 2px 8px rgba(167, 139, 250, 0.2);
  }

  .dashboard-page-wrapper-light .btn-premium-primary:hover,
  .overview-page-wrapper-light .btn-premium-primary:hover,
  .requests-page-wrapper-light .btn-premium-primary:hover,
  .jobs-page-wrapper-light .btn-premium-primary:hover,
  .calendar-page-wrapper-light .btn-premium-primary:hover,
  .services-page-wrapper-light .btn-premium-primary:hover,
  .messages-page-wrapper-light .btn-premium-primary:hover,
  .earnings-page-wrapper-light .btn-premium-primary:hover,
  .profile-page-wrapper-light .btn-premium-primary:hover,
  .settings-page-wrapper-light .btn-premium-primary:hover,
  .rituals-page-wrapper-light .btn-premium-primary:hover {
    background: #ddd6fe;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(167, 139, 250, 0.35);
    color: #7c3aed;
    text-decoration: none;
  }

  .dashboard-page-wrapper-light .btn-premium-secondary,
  .overview-page-wrapper-light .btn-premium-secondary,
  .requests-page-wrapper-light .btn-premium-secondary,
  .jobs-page-wrapper-light .btn-premium-secondary,
  .calendar-page-wrapper-light .btn-premium-secondary,
  .services-page-wrapper-light .btn-premium-secondary,
  .messages-page-wrapper-light .btn-premium-secondary,
  .earnings-page-wrapper-light .btn-premium-secondary,
  .profile-page-wrapper-light .btn-premium-secondary,
  .settings-page-wrapper-light .btn-premium-secondary,
  .rituals-page-wrapper-light .btn-premium-secondary {
    background: white;
    color: #1e40af;
    border: 2px solid #1e40af;
  }

  .dashboard-page-wrapper-light .btn-premium-secondary:hover,
  .overview-page-wrapper-light .btn-premium-secondary:hover,
  .requests-page-wrapper-light .btn-premium-secondary:hover,
  .jobs-page-wrapper-light .btn-premium-secondary:hover,
  .calendar-page-wrapper-light .btn-premium-secondary:hover,
  .services-page-wrapper-light .btn-premium-secondary:hover,
  .messages-page-wrapper-light .btn-premium-secondary:hover,
  .earnings-page-wrapper-light .btn-premium-secondary:hover,
  .profile-page-wrapper-light .btn-premium-secondary:hover,
  .settings-page-wrapper-light .btn-premium-secondary:hover,
  .rituals-page-wrapper-light .btn-premium-secondary:hover {
    background: #f8fafc;
    transform: translateY(-1px);
    color: #1e40af;
    text-decoration: none;
  }

  /* ===== SIDEBAR (30%) - NAVIGATION PREMIUM ===== */
  .dashboard-page-wrapper-light .sidebar,
  .overview-page-wrapper-light .sidebar,
  .requests-page-wrapper-light .sidebar,
  .jobs-page-wrapper-light .sidebar,
  .calendar-page-wrapper-light .sidebar,
  .services-page-wrapper-light .sidebar,
  .messages-page-wrapper-light .sidebar,
  .earnings-page-wrapper-light .sidebar,
  .profile-page-wrapper-light .sidebar,
  .settings-page-wrapper-light .sidebar,
  .rituals-page-wrapper-light .sidebar {
    padding: 2.5rem 10px 2.5rem 2rem !important;
    background: var(--bg-card) !important;
    border: 1px solid var(--border-light) !important;
    border-radius: var(--radius-xl) !important;
    box-shadow: var(--shadow-md) !important;
    position: sticky !important;
    top: 2rem !important;
    width: 100% !important;
    min-width: 0 !important;
    max-width: 100% !important;
    min-height: 0 !important;
    height: calc(100vh - 4rem) !important;
    max-height: calc(100vh - 4rem) !important;
    overflow-y: auto !important;
    overflow-x: visible !important; /* IMPORTANT : permet aux icônes de ne pas être coupées */
    box-sizing: border-box !important;
    grid-column: 2 !important;
    align-self: start !important;
  }

  .dashboard-page-wrapper-light .sidebar .nav-section,
  .dashboard-page-wrapper-light .sidebar .stats-section,
  .dashboard-page-wrapper-light .sidebar .tips-section,
  .overview-page-wrapper-light .sidebar .nav-section,
  .overview-page-wrapper-light .sidebar .stats-section,
  .overview-page-wrapper-light .sidebar .tips-section,
  .requests-page-wrapper-light .sidebar .nav-section,
  .requests-page-wrapper-light .sidebar .stats-section,
  .requests-page-wrapper-light .sidebar .tips-section,
  .jobs-page-wrapper-light .sidebar .nav-section,
  .jobs-page-wrapper-light .sidebar .stats-section,
  .jobs-page-wrapper-light .sidebar .tips-section,
  .calendar-page-wrapper-light .sidebar .nav-section,
  .calendar-page-wrapper-light .sidebar .stats-section,
  .calendar-page-wrapper-light .sidebar .tips-section,
  .services-page-wrapper-light .sidebar .nav-section,
  .services-page-wrapper-light .sidebar .stats-section,
  .services-page-wrapper-light .sidebar .tips-section,
  .messages-page-wrapper-light .sidebar .nav-section,
  .messages-page-wrapper-light .sidebar .stats-section,
  .messages-page-wrapper-light .sidebar .tips-section,
  .earnings-page-wrapper-light .sidebar .nav-section,
  .earnings-page-wrapper-light .sidebar .stats-section,
  .earnings-page-wrapper-light .sidebar .tips-section,
  .profile-page-wrapper-light .sidebar .nav-section,
  .profile-page-wrapper-light .sidebar .stats-section,
  .profile-page-wrapper-light .sidebar .tips-section,
  .settings-page-wrapper-light .sidebar .nav-section,
  .settings-page-wrapper-light .sidebar .stats-section,
  .settings-page-wrapper-light .sidebar .tips-section,
  .rituals-page-wrapper-light .sidebar .nav-section,
  .rituals-page-wrapper-light .sidebar .stats-section,
  .rituals-page-wrapper-light .sidebar .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
    overflow: visible !important; /* IMPORTANT : permet aux icônes de ne pas être coupées */
    position: relative !important;
    z-index: 1 !important;
  }

  /* Scrollbar premium épaisse */
  .dashboard-page-wrapper-light .sidebar::-webkit-scrollbar,
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar,
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar,
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar,
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar,
  .services-page-wrapper-light .sidebar::-webkit-scrollbar,
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar,
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar,
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar,
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar,
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important;
  }

  .dashboard-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .services-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 10px;
    margin: 8px 0;
  }

  .dashboard-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .services-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 10px;
    border: 2px solid var(--bg-secondary);
  }

  .dashboard-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .services-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }

  /* Support Firefox */
  .dashboard-page-wrapper-light .sidebar,
  .overview-page-wrapper-light .sidebar,
  .requests-page-wrapper-light .sidebar,
  .jobs-page-wrapper-light .sidebar,
  .calendar-page-wrapper-light .sidebar,
  .services-page-wrapper-light .sidebar,
  .messages-page-wrapper-light .sidebar,
  .earnings-page-wrapper-light .sidebar,
  .profile-page-wrapper-light .sidebar,
  .settings-page-wrapper-light .sidebar,
  .rituals-page-wrapper-light .sidebar {
    scrollbar-width: thick !important;
    scrollbar-color: var(--border) var(--bg-secondary) !important;
  }

  /* ===== NAVIGATION - CORRECTION ICÔNES ===== */
  .dashboard-page-wrapper-light .nav-section,
  .overview-page-wrapper-light .nav-section,
  .requests-page-wrapper-light .nav-section,
  .jobs-page-wrapper-light .nav-section,
  .calendar-page-wrapper-light .nav-section,
  .services-page-wrapper-light .nav-section,
  .messages-page-wrapper-light .nav-section,
  .earnings-page-wrapper-light .nav-section,
  .profile-page-wrapper-light .nav-section,
  .settings-page-wrapper-light .nav-section,
  .rituals-page-wrapper-light .nav-section {
    margin-bottom: 3.5rem !important;
    width: 100% !important;
    box-sizing: border-box !important;
    position: relative !important;
    z-index: 1 !important;
    overflow: visible !important; /* CRITIQUE : permet aux icônes de ne pas être coupées */
    padding-left: 10px !important; /* Décalage de 1cm pour voir les icônes */
  }

  .dashboard-page-wrapper-light .nav-title,
  .overview-page-wrapper-light .nav-title,
  .requests-page-wrapper-light .nav-title,
  .jobs-page-wrapper-light .nav-title,
  .calendar-page-wrapper-light .nav-title,
  .services-page-wrapper-light .nav-title,
  .messages-page-wrapper-light .nav-title,
  .earnings-page-wrapper-light .nav-title,
  .profile-page-wrapper-light .nav-title,
  .settings-page-wrapper-light .nav-title,
  .rituals-page-wrapper-light .nav-title {
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    color: var(--text-tertiary) !important;
    margin-bottom: 1.5rem !important;
    padding: 0 !important;
  }

  .dashboard-page-wrapper-light .nav-list,
  .overview-page-wrapper-light .nav-list,
  .requests-page-wrapper-light .nav-list,
  .jobs-page-wrapper-light .nav-list,
  .calendar-page-wrapper-light .nav-list,
  .services-page-wrapper-light .nav-list,
  .messages-page-wrapper-light .nav-list,
  .earnings-page-wrapper-light .nav-list,
  .profile-page-wrapper-light .nav-list,
  .settings-page-wrapper-light .nav-list,
  .rituals-page-wrapper-light .nav-list {
    display: flex !important;
    flex-direction: column !important;
    gap: 0.75rem !important;
    width: 100% !important;
    overflow: visible !important; /* CRITIQUE : permet aux icônes de ne pas être coupées */
  }

  .dashboard-page-wrapper-light .nav-item,
  .overview-page-wrapper-light .nav-item,
  .requests-page-wrapper-light .nav-item,
  .jobs-page-wrapper-light .nav-item,
  .calendar-page-wrapper-light .nav-item,
  .services-page-wrapper-light .nav-item,
  .messages-page-wrapper-light .nav-item,
  .earnings-page-wrapper-light .nav-item,
  .profile-page-wrapper-light .nav-item,
  .settings-page-wrapper-light .nav-item,
  .rituals-page-wrapper-light .nav-item {
    display: flex !important;
    align-items: center !important;
    gap: 1rem !important;
    padding: 1rem 1.25rem !important;
    border-radius: var(--radius-md) !important;
    text-decoration: none !important;
    color: var(--text-secondary) !important;
    font-weight: 500 !important;
    font-size: 0.95rem !important;
    transition: all 0.2s ease !important;
    background: transparent !important;
    border: 1px solid transparent !important;
    width: 100% !important;
    box-sizing: border-box !important;
    min-height: 56px !important;
    overflow: visible !important; /* CRITIQUE : permet aux icônes de ne pas être coupées */
    position: relative !important;
    z-index: 1 !important;
  }

  .dashboard-page-wrapper-light .nav-item:hover,
  .overview-page-wrapper-light .nav-item:hover,
  .requests-page-wrapper-light .nav-item:hover,
  .jobs-page-wrapper-light .nav-item:hover,
  .calendar-page-wrapper-light .nav-item:hover,
  .services-page-wrapper-light .nav-item:hover,
  .messages-page-wrapper-light .nav-item:hover,
  .earnings-page-wrapper-light .nav-item:hover,
  .profile-page-wrapper-light .nav-item:hover,
  .settings-page-wrapper-light .nav-item:hover,
  .rituals-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05) !important;
    color: var(--primary) !important;
    border-color: rgba(59, 130, 246, 0.1) !important;
  }

  .dashboard-page-wrapper-light .nav-item.active,
  .overview-page-wrapper-light .nav-item.active,
  .requests-page-wrapper-light .nav-item.active,
  .jobs-page-wrapper-light .nav-item.active,
  .calendar-page-wrapper-light .nav-item.active,
  .services-page-wrapper-light .nav-item.active,
  .messages-page-wrapper-light .nav-item.active,
  .earnings-page-wrapper-light .nav-item.active,
  .profile-page-wrapper-light .nav-item.active,
  .settings-page-wrapper-light .nav-item.active,
  .rituals-page-wrapper-light .nav-item.active {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%) !important;
    color: var(--primary) !important;
    border-color: var(--primary) !important;
    font-weight: 600 !important;
  }

  /* ===== CORRECTION ICÔNES - VISIBILITÉ ET ALIGNEMENT ===== */
  .dashboard-page-wrapper-light .nav-icon,
  .overview-page-wrapper-light .nav-icon,
  .requests-page-wrapper-light .nav-icon,
  .jobs-page-wrapper-light .nav-icon,
  .calendar-page-wrapper-light .nav-icon,
  .services-page-wrapper-light .nav-icon,
  .messages-page-wrapper-light .nav-icon,
  .earnings-page-wrapper-light .nav-icon,
  .profile-page-wrapper-light .nav-icon,
  .settings-page-wrapper-light .nav-icon,
  .rituals-page-wrapper-light .nav-icon {
    font-size: 1.25rem !important;
    flex-shrink: 0 !important;
    width: 28px !important; /* Largeur fixe pour éviter la coupe */
    min-width: 28px !important;
    max-width: 28px !important;
    text-align: center !important;
    line-height: 1 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    overflow: visible !important; /* CRITIQUE : permet aux icônes de ne pas être coupées */
    position: relative !important;
    z-index: 2 !important; /* Au-dessus du texte */
    opacity: 1 !important; /* Visibilité maximale */
    filter: none !important; /* Pas de filtre qui éteint les icônes */
  }

  /* ===== STATISTIQUES ===== */
  .dashboard-page-wrapper-light .stats-section,
  .overview-page-wrapper-light .stats-section,
  .requests-page-wrapper-light .stats-section,
  .jobs-page-wrapper-light .stats-section,
  .calendar-page-wrapper-light .stats-section,
  .services-page-wrapper-light .stats-section,
  .messages-page-wrapper-light .stats-section,
  .earnings-page-wrapper-light .stats-section,
  .profile-page-wrapper-light .stats-section,
  .settings-page-wrapper-light .stats-section,
  .rituals-page-wrapper-light .stats-section {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-bottom: 2.5rem;
    box-shadow: var(--shadow-sm);
    overflow: visible !important;
    padding-left: 10px !important; /* Décalage de 1cm pour voir les icônes */
  }

  .dashboard-page-wrapper-light .stats-title,
  .overview-page-wrapper-light .stats-title,
  .requests-page-wrapper-light .stats-title,
  .jobs-page-wrapper-light .stats-title,
  .calendar-page-wrapper-light .stats-title,
  .services-page-wrapper-light .stats-title,
  .messages-page-wrapper-light .stats-title,
  .earnings-page-wrapper-light .stats-title,
  .profile-page-wrapper-light .stats-title,
  .settings-page-wrapper-light .stats-title,
  .rituals-page-wrapper-light .stats-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .dashboard-page-wrapper-light .stats-title svg,
  .overview-page-wrapper-light .stats-title svg,
  .requests-page-wrapper-light .stats-title svg,
  .jobs-page-wrapper-light .stats-title svg,
  .calendar-page-wrapper-light .stats-title svg,
  .services-page-wrapper-light .stats-title svg,
  .messages-page-wrapper-light .stats-title svg,
  .earnings-page-wrapper-light .stats-title svg,
  .profile-page-wrapper-light .stats-title svg,
  .settings-page-wrapper-light .stats-title svg,
  .rituals-page-wrapper-light .stats-title svg {
    color: var(--primary);
  }

  .dashboard-page-wrapper-light .stats-grid,
  .overview-page-wrapper-light .stats-grid,
  .requests-page-wrapper-light .stats-grid,
  .jobs-page-wrapper-light .stats-grid,
  .calendar-page-wrapper-light .stats-grid,
  .services-page-wrapper-light .stats-grid,
  .messages-page-wrapper-light .stats-grid,
  .earnings-page-wrapper-light .stats-grid,
  .profile-page-wrapper-light .stats-grid,
  .settings-page-wrapper-light .stats-grid,
  .rituals-page-wrapper-light .stats-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .dashboard-page-wrapper-light .stat-item,
  .overview-page-wrapper-light .stat-item,
  .requests-page-wrapper-light .stat-item,
  .jobs-page-wrapper-light .stat-item,
  .calendar-page-wrapper-light .stat-item,
  .services-page-wrapper-light .stat-item,
  .messages-page-wrapper-light .stat-item,
  .earnings-page-wrapper-light .stat-item,
  .profile-page-wrapper-light .stat-item,
  .settings-page-wrapper-light .stat-item,
  .rituals-page-wrapper-light .stat-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .dashboard-page-wrapper-light .stat-label,
  .overview-page-wrapper-light .stat-label,
  .requests-page-wrapper-light .stat-label,
  .jobs-page-wrapper-light .stat-label,
  .calendar-page-wrapper-light .stat-label,
  .services-page-wrapper-light .stat-label,
  .messages-page-wrapper-light .stat-label,
  .earnings-page-wrapper-light .stat-label,
  .profile-page-wrapper-light .stat-label,
  .settings-page-wrapper-light .stat-label,
  .rituals-page-wrapper-light .stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
  }

  .dashboard-page-wrapper-light .stat-value,
  .overview-page-wrapper-light .stat-value,
  .requests-page-wrapper-light .stat-value,
  .jobs-page-wrapper-light .stat-value,
  .calendar-page-wrapper-light .stat-value,
  .services-page-wrapper-light .stat-value,
  .messages-page-wrapper-light .stat-value,
  .earnings-page-wrapper-light .stat-value,
  .profile-page-wrapper-light .stat-value,
  .settings-page-wrapper-light .stat-value,
  .rituals-page-wrapper-light .stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--primary);
  }

  .dashboard-page-wrapper-light .stat-value.highlight,
  .overview-page-wrapper-light .stat-value.highlight,
  .requests-page-wrapper-light .stat-value.highlight,
  .jobs-page-wrapper-light .stat-value.highlight,
  .calendar-page-wrapper-light .stat-value.highlight,
  .services-page-wrapper-light .stat-value.highlight,
  .messages-page-wrapper-light .stat-value.highlight,
  .earnings-page-wrapper-light .stat-value.highlight,
  .profile-page-wrapper-light .stat-value.highlight,
  .settings-page-wrapper-light .stat-value.highlight,
  .rituals-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
  }

  /* ===== CONSEILS ===== */
  .dashboard-page-wrapper-light .tips-section,
  .overview-page-wrapper-light .tips-section,
  .requests-page-wrapper-light .tips-section,
  .jobs-page-wrapper-light .tips-section,
  .calendar-page-wrapper-light .tips-section,
  .services-page-wrapper-light .tips-section,
  .messages-page-wrapper-light .tips-section,
  .earnings-page-wrapper-light .tips-section,
  .profile-page-wrapper-light .tips-section,
  .settings-page-wrapper-light .tips-section,
  .rituals-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-top: 2.5rem;
    overflow: visible !important;
    padding-left: 10px !important; /* Décalage de 1cm pour voir les icônes */
  }

  .dashboard-page-wrapper-light .tip-header,
  .overview-page-wrapper-light .tip-header,
  .requests-page-wrapper-light .tip-header,
  .jobs-page-wrapper-light .tip-header,
  .calendar-page-wrapper-light .tip-header,
  .services-page-wrapper-light .tip-header,
  .messages-page-wrapper-light .tip-header,
  .earnings-page-wrapper-light .tip-header,
  .profile-page-wrapper-light .tip-header,
  .settings-page-wrapper-light .tip-header,
  .rituals-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }

  .dashboard-page-wrapper-light .tip-icon,
  .overview-page-wrapper-light .tip-icon,
  .requests-page-wrapper-light .tip-icon,
  .jobs-page-wrapper-light .tip-icon,
  .calendar-page-wrapper-light .tip-icon,
  .services-page-wrapper-light .tip-icon,
  .messages-page-wrapper-light .tip-icon,
  .earnings-page-wrapper-light .tip-icon,
  .profile-page-wrapper-light .tip-icon,
  .settings-page-wrapper-light .tip-icon,
  .rituals-page-wrapper-light .tip-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
  }

  .dashboard-page-wrapper-light .tip-title,
  .overview-page-wrapper-light .tip-title,
  .requests-page-wrapper-light .tip-title,
  .jobs-page-wrapper-light .tip-title,
  .calendar-page-wrapper-light .tip-title,
  .services-page-wrapper-light .tip-title,
  .messages-page-wrapper-light .tip-title,
  .earnings-page-wrapper-light .tip-title,
  .profile-page-wrapper-light .tip-title,
  .settings-page-wrapper-light .tip-title,
  .rituals-page-wrapper-light .tip-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
  }

  .dashboard-page-wrapper-light .tip-content,
  .overview-page-wrapper-light .tip-content,
  .requests-page-wrapper-light .tip-content,
  .jobs-page-wrapper-light .tip-content,
  .calendar-page-wrapper-light .tip-content,
  .services-page-wrapper-light .tip-content,
  .messages-page-wrapper-light .tip-content,
  .earnings-page-wrapper-light .tip-content,
  .profile-page-wrapper-light .tip-content,
  .settings-page-wrapper-light .tip-content,
  .rituals-page-wrapper-light .tip-content {
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
  }

  .dashboard-page-wrapper-light .tip-content strong,
  .overview-page-wrapper-light .tip-content strong,
  .requests-page-wrapper-light .tip-content strong,
  .jobs-page-wrapper-light .tip-content strong,
  .calendar-page-wrapper-light .tip-content strong,
  .services-page-wrapper-light .tip-content strong,
  .messages-page-wrapper-light .tip-content strong,
  .earnings-page-wrapper-light .tip-content strong,
  .profile-page-wrapper-light .tip-content strong,
  .settings-page-wrapper-light .tip-content strong,
  .rituals-page-wrapper-light .tip-content strong {
    color: var(--text-primary);
    font-weight: 600;
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .dashboard-page-wrapper-light,
    .overview-page-wrapper-light,
    .requests-page-wrapper-light,
    .jobs-page-wrapper-light,
    .calendar-page-wrapper-light,
    .services-page-wrapper-light,
    .messages-page-wrapper-light,
    .earnings-page-wrapper-light,
    .profile-page-wrapper-light,
    .settings-page-wrapper-light,
    .rituals-page-wrapper-light {
      padding: 20px 10px !important;
    }

    .dashboard-page-wrapper-light .dashboard-container,
    .overview-page-wrapper-light .dashboard-container,
    .requests-page-wrapper-light .dashboard-container,
    .jobs-page-wrapper-light .dashboard-container,
    .calendar-page-wrapper-light .dashboard-container,
    .services-page-wrapper-light .dashboard-container,
    .messages-page-wrapper-light .dashboard-container,
    .earnings-page-wrapper-light .dashboard-container,
    .profile-page-wrapper-light .dashboard-container,
    .settings-page-wrapper-light .dashboard-container,
    .rituals-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 10px 0 !important;
    }

    .dashboard-page-wrapper-light .main-content,
    .overview-page-wrapper-light .main-content,
    .requests-page-wrapper-light .main-content,
    .jobs-page-wrapper-light .main-content,
    .calendar-page-wrapper-light .main-content,
    .services-page-wrapper-light .main-content,
    .messages-page-wrapper-light .main-content,
    .earnings-page-wrapper-light .main-content,
    .profile-page-wrapper-light .main-content,
    .settings-page-wrapper-light .main-content,
    .rituals-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }

    .dashboard-page-wrapper-light .sidebar,
    .overview-page-wrapper-light .sidebar,
    .requests-page-wrapper-light .sidebar,
    .jobs-page-wrapper-light .sidebar,
    .calendar-page-wrapper-light .sidebar,
    .services-page-wrapper-light .sidebar,
    .messages-page-wrapper-light .sidebar,
    .earnings-page-wrapper-light .sidebar,
    .profile-page-wrapper-light .sidebar,
    .settings-page-wrapper-light .sidebar,
    .rituals-page-wrapper-light .sidebar {
      position: static !important;
      top: auto !important;
      width: 100% !important;
      min-width: 100% !important;
      max-width: 100% !important;
      height: auto !important;
      max-height: none !important;
      padding: 2.5rem 10px !important;
      grid-column: 1 !important;
    }
  }
</style>

