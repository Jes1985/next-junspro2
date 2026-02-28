@php
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'earnings';
@endphp

<div class="earnings-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Bloc Tableau de bord Freelance -->
      @include('frontend.freelance.dashboard.partials.dashboard-header-section', [
        'freelancerProfile' => $freelancerProfile ?? null
      ])

      <!-- Header de page -->
      <div class="page-header">
        <h1>Revenus</h1>
        <p class="page-subtitle">
          Suivez vos gains et vos versements. Gérez vos informations bancaires et 
          consultez l'historique de vos paiements.
        </p>
      </div>

      <!-- Contenu principal -->
      <div class="content-section">
        <div class="section-header-inline">
          <h2>
            Résumé gains + versements
            <span title="RIB/IBAN + préférences de paiement. Modifiable à tout moment." style="cursor: help; font-size: 0.7em; color: #9ca3af; margin-left: 0.5rem; font-weight: normal;">ℹ️</span>
          </h2>
        </div>

        <div class="empty-state-premium" style="background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #f8fafc 100%); border: 2.5px solid rgba(59, 130, 246, 0.25); box-shadow: 0 32px 80px rgba(59, 130, 246, 0.2), 0 12px 32px rgba(59, 130, 246, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8); border-radius: 32px; margin-top: 2rem; padding: 4rem 3rem;">
          <p class="empty-state-premium-text" style="font-size: 1.25rem; font-weight: 500; color: #334155; margin-bottom: 2rem; line-height: 1.8;">Vos revenus apparaîtront ici une fois que vous aurez finalisé des prestations.</p>
          <a href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" class="empty-state-premium-cta" style="display: inline-block; background: linear-gradient(135deg, #3B82F6, #60A5FA); color: white; padding: 1.25rem 3rem; font-size: 1.1rem; font-weight: 700; border-radius: 32px; text-decoration: none; transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); box-shadow: 0 12px 32px rgba(59, 130, 246, 0.3); border: none; cursor: pointer; margin-top: 1rem; letter-spacing: -0.02em;" onmouseover="this.style.transform='translateY(-3px) scale(1.02)'; this.style.boxShadow='0 20px 48px rgba(59, 130, 246, 0.4)';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 12px 32px rgba(59, 130, 246, 0.3)';">Configurer les versements</a>
          <p class="empty-state-tip" style="margin-top: 1.5rem; font-size: 1rem; color: #64748B; font-weight: 500; line-height: 1.6;">💡 Configurez vos versements avant votre première mission pour être payé sans délai.</p>
        </div>
      </div>
    </main>

    <!-- ===== SIDEBAR (30%) - LIGHT ===== -->
    @include('frontend.freelance.dashboard.partials.dashboard-sidebar-section', [
      'activeTab' => $activeTab ?? 'earnings'
    ])
  </div>
</div>

{{-- Styles CSS communs du shell premium --}}
@include('frontend.freelance.dashboard.partials.dashboard-shell-styles')

<style>
  /* ===== STYLES SPÉCIFIQUES À L'ONGLET REVENUS ===== */
  /* Les styles communs sont dans dashboard-shell-styles.blade.php */

  /* ===== RESET ET VARIABLES LIGHT ===== */
  .earnings-page-wrapper-light {
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
  
  .earnings-page-wrapper-light * {
    box-sizing: border-box;
  }
  
  .earnings-page-wrapper-light {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    min-height: 100vh;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT (Style identique à Demandes) ===== */
  .earnings-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite comme Demandes */
    box-sizing: border-box;
  }
  
  .earnings-page-wrapper-light .dashboard-container {
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
  .earnings-page-wrapper-light .main-content {
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
  
  /* ===== HERO HEADER - IDENTIQUE À OVERVIEW ===== */
  .earnings-page-wrapper-light .dashboard-overview-hero {
    position: relative !important; margin: 0 !important; margin-bottom: 3rem !important;
    padding: 0 !important; border: none !important; background: transparent !important;
    width: 100% !important; max-width: 100% !important; overflow: visible !important;
  }
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-glow {
    position: absolute; top: -50px; left: 50%; transform: translateX(-50%);
    width: 800px; height: 600px;
    background: radial-gradient(circle at 30% 50%, rgba(124, 58, 237, 0.15) 0%, rgba(30, 64, 175, 0.1) 35%, transparent 80%);
    border-radius: 50%; filter: blur(100px); pointer-events: none; z-index: 0;
  }
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-content {
    position: relative; z-index: 1; display: grid; grid-template-columns: 1fr 1fr;
    gap: 4rem; align-items: center; padding: 3rem 0; width: 100%; box-sizing: border-box;
  }
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-text { display: flex; flex-direction: column; gap: 1.5rem; padding: 0; }
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-title {
    font-size: 2.5rem; font-weight: 800; line-height: 1.2; color: #111827; margin: 0; letter-spacing: -0.02em;
    background: linear-gradient(135deg, #111827 0%, #374151 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
  }
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-subtitle { font-size: 1.125rem; line-height: 1.6; color: #6b7280; margin: 0; font-weight: 400; max-width: 550px; }
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-ctas { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 0.5rem; }
  .earnings-page-wrapper-light .dashboard-overview-hero .btn-hero {
    padding: 1rem 1.75rem; font-size: 1rem; font-weight: 600; border-radius: 14px; border: none;
    cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-family: inherit;
  }
  .earnings-page-wrapper-light .dashboard-overview-hero .btn-hero-primary { background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); color: white; box-shadow: 0 10px 30px rgba(124, 58, 237, 0.25); }
  .earnings-page-wrapper-light .dashboard-overview-hero .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(124, 58, 237, 0.35); color: white; text-decoration: none; }
  .earnings-page-wrapper-light .dashboard-overview-hero .btn-hero-secondary { background: white; color: #1e40af; border: 2px solid #1e40af; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.1); }
  .earnings-page-wrapper-light .dashboard-overview-hero .btn-hero-secondary:hover { background: #f0f4ff; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30, 64, 175, 0.15); color: #1e40af; text-decoration: none; }
  .earnings-page-wrapper-light .dashboard-overview-hero .btn-text { display: inline; }
  .earnings-page-wrapper-light .dashboard-overview-hero .btn-icon { font-size: 1.2rem; display: inline-block; transition: transform 0.3s ease; }
  .earnings-page-wrapper-light .dashboard-overview-hero .btn-hero:hover .btn-icon { transform: translateX(3px); }
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-hint { font-size: 0.9rem; color: #6b7280; margin: 0; margin-top: 0.5rem; font-weight: 500; }
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-visual { display: flex; align-items: center; justify-content: center; padding: 2rem; }
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-visual-card {
    position: relative; width: 100%; max-width: 350px; padding: 3rem 2rem;
    background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #f8fafc 100%); 
    border: 2.5px solid rgba(59, 130, 246, 0.25);
    border-radius: 32px; text-align: center; 
    box-shadow: 0 32px 80px rgba(59, 130, 246, 0.2), 0 12px 32px rgba(59, 130, 246, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8); 
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
  }
  
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-visual-card:hover {
    transform: translateY(-14px) scale(1.02);
    box-shadow: 0 40px 100px rgba(59, 130, 246, 0.3), 0 16px 48px rgba(59, 130, 246, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.9);
    border-color: rgba(59, 130, 246, 0.4);
  }
  .earnings-page-wrapper-light .dashboard-overview-hero .hero-visual-card::before {
    content: ''; position: absolute; top: 0; right: 0; width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(124,58,237,0.1) 0%, transparent 70%);
    border-radius: 50%; transform: translate(100px, -100px);
  }
  .earnings-page-wrapper-light .dashboard-overview-hero .visual-badge {
    display: inline-block; padding: 0.5rem 1rem; background: linear-gradient(135deg, #ddd6fe 0%, #e9d5ff 100%);
    color: #6d28d9; font-size: 0.85rem; font-weight: 600; border-radius: 20px; margin-bottom: 1.5rem; position: relative; z-index: 1;
  }
  .earnings-page-wrapper-light .dashboard-overview-hero .visual-icon { font-size: 3.5rem; margin-bottom: 1rem; display: block; position: relative; z-index: 1; }
  .earnings-page-wrapper-light .dashboard-overview-hero .visual-text { font-size: 1.25rem; font-weight: 700; color: #111827; line-height: 1.5; margin: 0; position: relative; z-index: 1; }
  @media (max-width: 1024px) {
    .earnings-page-wrapper-light .dashboard-overview-hero .hero-content { grid-template-columns: 1fr; gap: 2.5rem; padding: 2.5rem 0; }
    .earnings-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 2rem; }
    .earnings-page-wrapper-light .dashboard-overview-hero .hero-visual-card { max-width: 280px; }
  }
  @media (max-width: 768px) {
    .earnings-page-wrapper-light .dashboard-overview-hero .hero-content { padding: 2rem 0; }
    .earnings-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 1.75rem; }
    .earnings-page-wrapper-light .dashboard-overview-hero .hero-ctas { flex-direction: column; }
    .earnings-page-wrapper-light .dashboard-overview-hero .btn-hero { width: 100%; justify-content: center; }
    .earnings-page-wrapper-light .dashboard-overview-hero .hero-visual-card { max-width: 250px; padding: 2rem 1.5rem; }
  }
  @media (max-width: 480px) {
    .earnings-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 1.5rem; }
    .earnings-page-wrapper-light .dashboard-overview-hero .btn-hero { padding: 0.875rem 1.5rem; font-size: 0.95rem; }
    .earnings-page-wrapper-light .dashboard-overview-hero .visual-icon { font-size: 2.5rem; }
  }

  /* ===== HEADER PREMIUM - CENTRÉ (Style identique à Demandes) ===== */
  .earnings-page-wrapper-light .page-header {
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
    border-bottom: 2.5px solid rgba(59, 130, 246, 0.2);
    text-align: center !important; /* Centrage du contenu */
  }
  
  .earnings-page-wrapper-light .page-header::after {
    content: '';
    position: absolute;
    bottom: -2.5px;
    left: 50%;
    transform: translateX(-50%);
    width: 120px;
    height: 4px;
    background: linear-gradient(90deg, #3B82F6 0%, #60A5FA 50%, #8B5CF6 100%);
    border-radius: 2px;
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
  }
  
  .earnings-page-wrapper-light .page-header h1 {
    font-size: 3rem !important; /* MÊME TAILLE QUE DEMANDES */
    font-weight: 900;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #1e40af 0%, #3B82F6 50%, #8B5CF6 100%);
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
  
  .earnings-page-wrapper-light .page-subtitle {
    color: var(--text-secondary);
    font-size: 1.25rem; /* 20px - Style identique à Demandes */
    max-width: 100%;
    width: 100%;
    line-height: 1.75;
    font-weight: 500;
    word-wrap: break-word;
    margin-top: 0.5rem;
    text-align: center !important; /* Centrage du sous-texte */
  }
  
  /* ===== CONTENU ===== */
  .earnings-page-wrapper-light .content-section {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  
  .earnings-page-wrapper-light .section-header-inline h2 {
    font-size: 1.5rem;
    font-weight: 900;
    color: var(--text-primary);
    margin-bottom: 1rem;
    letter-spacing: -0.03em;
  }
  
  /* ===== SIDEBAR (30%) ===== */
  .earnings-page-wrapper-light .sidebar {
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
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important;
  }
  
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 6px;
  }
  
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 6px;
  }
  
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }
  
  .earnings-page-wrapper-light .nav-section,
  .earnings-page-wrapper-light .stats-section,
  .earnings-page-wrapper-light .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
    margin-bottom: 2rem;
    padding-left: 10px !important; /* Décalage de 1cm (10px) vers la droite pour voir les icônes */
  }
  
  .earnings-page-wrapper-light .nav-title {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--text-tertiary);
    margin-bottom: 1.25rem;
    font-weight: 600;
  }
  
  .earnings-page-wrapper-light .nav-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .earnings-page-wrapper-light .nav-item {
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
  
  .earnings-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05);
    color: var(--primary);
    text-decoration: none;
  }
  
  .earnings-page-wrapper-light .nav-item.active {
    background: rgba(59, 130, 246, 0.1);
    color: var(--primary);
    font-weight: 600;
    border-left: 3px solid var(--primary);
  }
  
  .earnings-page-wrapper-light .nav-icon {
    font-size: 1.125rem;
    width: 24px;
    text-align: center;
  }
  
  .earnings-page-wrapper-light .stats-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .earnings-page-wrapper-light .stats-grid {
    display: grid;
    gap: 1rem;
  }
  
  .earnings-page-wrapper-light .stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-light);
  }
  
  .earnings-page-wrapper-light .stat-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }
  
  .earnings-page-wrapper-light .stat-label {
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
  }
  
  .earnings-page-wrapper-light .stat-value {
    font-weight: 700;
    font-size: 1.125rem;
    color: var(--text-primary);
  }
  
  .earnings-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
    font-weight: 800;
  }
  
  .earnings-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .earnings-page-wrapper-light .tip-icon {
    color: var(--accent);
    font-size: 1.25rem;
  }
  
  .earnings-page-wrapper-light .tip-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-primary);
  }
  
  .earnings-page-wrapper-light .tip-content {
    color: var(--text-secondary);
    font-size: 0.875rem;
    line-height: 1.5;
  }
  
  .earnings-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.75rem;
  }
  
  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .earnings-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 2rem 0 !important;
    }
    
    .earnings-page-wrapper-light .main-content {
      padding: 3rem 10px !important;
    }
    
    .earnings-page-wrapper-light .sidebar {
      position: relative !important;
      top: 0 !important;
      padding: 2.5rem 10px !important;
      max-height: none !important;
    }
  }
  
  @media (max-width: 768px) {
    .earnings-page-wrapper-light .page-header h1 {
      font-size: 2rem !important;
    }
    
    .earnings-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }
  }

  @media (max-width: 480px) {
    .earnings-page-wrapper-light .page-header h1 {
      font-size: 1.75rem !important;
    }

    .earnings-page-wrapper-light .page-subtitle {
      font-size: 1rem !important;
    }
    
    .earnings-page-wrapper-light .main-content {
      padding: 1.5rem 8px !important;
    }
  }
</style>
