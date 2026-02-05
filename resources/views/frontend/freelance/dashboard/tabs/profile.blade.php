@php
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'profile';
@endphp

<div class="profile-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Header de page -->
      <div class="page-header">
        <h1>Profil</h1>
        <p class="page-subtitle">
          Votre vitrine publique. C'est elle qui convertit les visites en demandes.
        </p>
      </div>

      <!-- Contenu principal -->
      <div class="content-section">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
          <!-- Carte A — "Visibilité" -->
          <div class="premium-card">
            <h3 class="premium-card-title">Visibilité</h3>
            <p class="premium-card-text">Complétez votre profil pour être mieux mis en avant dans les résultats.</p>
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; margin-top: 1rem;">
              <a href="{{ route('freelance.settings.identity') }}" class="btn-premium btn-premium-primary">Modifier mon profil</a>
              <a href="{{ route('freelance.show', ['id' => $freelancerProfile->id ?? 0]) }}" target="_blank" class="btn-premium btn-premium-secondary">Voir mon profil public</a>
            </div>
            <p class="premium-card-microcopy">📸 Photo + titre clair + services bien définis = meilleure confiance.</p>
          </div>

          <!-- Carte B — "Qualité" -->
          <div class="premium-card">
            <h3 class="premium-card-title">Qualité</h3>
            <p class="premium-card-text">Un bon rythme (Rituels + bilans) réduit les relances et augmente les avis positifs.</p>
            <a href="{{ route('freelance.dashboard', ['tab' => 'rituals']) }}" class="empty-state-premium-cta" style="margin-top: 1rem;">Découvrir les Rituels</a>
            <p class="premium-card-microcopy">✅ Les clients préfèrent un suivi simple à des promesses vagues.</p>
          </div>
        </div>
      </div>
    </main>

    <!-- ===== SIDEBAR (30%) - LIGHT ===== -->
    @include('frontend.freelance.dashboard.partials.dashboard-sidebar-section', [
      'activeTab' => $activeTab ?? 'profile'
    ])
  </div>
</div>

{{-- Styles CSS communs du shell premium --}}
@include('frontend.freelance.dashboard.partials.dashboard-shell-styles')

<style>
  /* ===== STYLES SPÉCIFIQUES À L'ONGLET PROFIL ===== */
  /* Les styles communs sont dans dashboard-shell-styles.blade.php */
  
  /* ===== RESET ET VARIABLES LIGHT ===== */
  .profile-page-wrapper-light {
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
  
  .profile-page-wrapper-light * {
    box-sizing: border-box;
  }
  
  .profile-page-wrapper-light {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    min-height: 100vh;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT (Style identique à Demandes) ===== */
  .profile-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite comme Demandes */
    box-sizing: border-box;
  }
  
  .profile-page-wrapper-light .dashboard-container {
    display: grid !important;
    grid-template-columns: 70% 30% !important;
    min-height: 100vh;
    max-width: none !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 2rem !important; /* Padding pour créer l'espace autour du contenu comme dans Demandes */
    background: white !important; /* Fond blanc comme dans Demandes */
    border-radius: var(--radius-xl) !important; /* Bords arrondis (20px) comme dans Demandes */
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important; /* Ombre légère identique à Demandes */
    box-sizing: border-box;
    gap: 0 10px !important;
    align-items: start !important;
    overflow-x: visible !important;
  }
  
  /* ===== ZONE PRINCIPALE (70%) ===== */
  .profile-page-wrapper-light .main-content {
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
    display: flex;
    flex-direction: column;
  }
  
  /* ===== HEADER PREMIUM - CENTRÉ (Style identique à Demandes) ===== */
  .profile-page-wrapper-light .page-header {
    margin-top: 0 !important;
    margin-bottom: 4rem;
    position: relative;
    max-width: 100% !important;
    width: 100% !important;
    min-width: 100% !important;
    box-sizing: border-box;
    padding-bottom: 2rem;
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    border-bottom: 1px solid var(--border-light);
    text-align: center !important; /* Centrage du contenu */
  }
  
  .profile-page-wrapper-light .page-header::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    border-radius: 2px;
  }
  
  .profile-page-wrapper-light .page-header h1 {
    font-size: 3rem !important; /* MÊME TAILLE QUE DEMANDES */
    font-weight: 800;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--text-primary) 0%, var(--text-secondary) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.03em;
    max-width: 100%;
    width: 100%;
    word-wrap: break-word;
    line-height: 1.1;
    text-align: center !important; /* Centrage du titre */
  }
  
  .profile-page-wrapper-light .page-subtitle {
    color: var(--text-secondary);
    font-size: 1.25rem; /* 20px - Style identique à Demandes */
    max-width: 100%;
    width: 100%;
    line-height: 1.75;
    font-weight: 400;
    word-wrap: break-word;
    margin-top: 0.5rem;
    text-align: center !important; /* Centrage du sous-texte */
  }
  
  /* ===== CONTENU ===== */
  .profile-page-wrapper-light .content-section {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  
  /* ===== SIDEBAR (30%) ===== */
  .profile-page-wrapper-light .sidebar {
    padding: 2.5rem 10px 2.5rem 2rem !important;
    background: var(--bg-card) !important;
    border: 1px solid var(--border-light) !important;
    border-radius: var(--radius-xl) !important;
    box-shadow: var(--shadow-md) !important;
    position: sticky !important;
    top: 120px !important;
    width: 100% !important;
    min-width: 0 !important;
    max-width: 100% !important;
    height: fit-content !important;
    max-height: calc(100vh - 140px) !important;
    overflow-y: auto !important;
    min-height: 0 !important;
    grid-column: 2 !important;
  }
  
  /* Scrollbar personnalisée pour sidebar */
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important;
  }
  
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 6px;
  }
  
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 6px;
  }
  
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }
  
  .profile-page-wrapper-light .nav-section,
  .profile-page-wrapper-light .stats-section,
  .profile-page-wrapper-light .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
    margin-bottom: 2rem;
    padding-left: 10px !important; /* Décalage de 1cm (10px) vers la droite pour voir les icônes */
  }
  
  .profile-page-wrapper-light .nav-title {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--text-tertiary);
    margin-bottom: 1.25rem;
    font-weight: 600;
  }
  
  .profile-page-wrapper-light .nav-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .profile-page-wrapper-light .nav-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.875rem 1rem;
    border-radius: var(--radius-sm);
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.2s ease;
    font-weight: 500;
  }
  
  .profile-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05);
    color: var(--primary);
    text-decoration: none;
  }
  
  .profile-page-wrapper-light .nav-item.active {
    background: rgba(59, 130, 246, 0.1);
    color: var(--primary);
    font-weight: 600;
    border-left: 3px solid var(--primary);
  }
  
  .profile-page-wrapper-light .nav-icon {
    font-size: 1.125rem;
    width: 24px;
    text-align: center;
  }
  
  .profile-page-wrapper-light .stats-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .profile-page-wrapper-light .stats-grid {
    display: grid;
    gap: 1rem;
  }
  
  .profile-page-wrapper-light .stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-light);
  }
  
  .profile-page-wrapper-light .stat-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }
  
  .profile-page-wrapper-light .stat-label {
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
  }
  
  .profile-page-wrapper-light .stat-value {
    font-weight: 700;
    font-size: 1.125rem;
    color: var(--text-primary);
  }
  
  .profile-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
    font-weight: 800;
  }
  
  .profile-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .profile-page-wrapper-light .tip-icon {
    color: var(--accent);
    font-size: 1.25rem;
  }
  
  .profile-page-wrapper-light .tip-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-primary);
  }
  
  .profile-page-wrapper-light .tip-content {
    color: var(--text-secondary);
    font-size: 0.875rem;
    line-height: 1.5;
  }
  
  .profile-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.75rem;
  }
  
  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .profile-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 2rem 0 !important;
    }
    
    .profile-page-wrapper-light .main-content {
      padding: 3rem 10px !important;
    }
    
    .profile-page-wrapper-light .sidebar {
      position: relative !important;
      top: 0 !important;
      padding: 2.5rem 10px !important;
      max-height: none !important;
    }
  }
  
  @media (max-width: 768px) {
    .profile-page-wrapper-light .page-header h1 {
      font-size: 2rem !important;
    }
    
    .profile-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }
  }

  @media (max-width: 480px) {
    .profile-page-wrapper-light .page-header h1 {
      font-size: 1.75rem !important;
    }

    .profile-page-wrapper-light .page-subtitle {
      font-size: 1rem !important;
    }
    
    .profile-page-wrapper-light .main-content {
      padding: 1.5rem 8px !important;
    }

    .profile-page-wrapper-light .premium-card {
      padding: 1.5rem !important;
    }
  }
</style>

