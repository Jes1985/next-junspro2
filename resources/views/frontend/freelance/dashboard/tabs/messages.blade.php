@php
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'messages';
@endphp

<div class="messages-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Bloc Tableau de bord Freelance -->
      @include('frontend.freelance.dashboard.partials.dashboard-header-section', [
        'freelancerProfile' => $freelancerProfile ?? null
      ])

      <!-- Header de page -->
      <div class="page-header">
        <h1>Messages</h1>
        <p class="page-subtitle">
          Vos conversations avec les clients, au même endroit. Centralisez vos échanges 
          pour une communication fluide et professionnelle.
        </p>
      </div>

      <!-- État vide amélioré -->
      <div class="empty-state">
        <!-- Illustration avec animation -->
        <div class="empty-state-illustration">
          <div class="illustration-wrapper">
            <div class="gradient-orb"></div>
            <div class="main-illustration">
              <svg class="illustration-icon" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Titre et description -->
        <h2 class="empty-state-title">
          Votre messagerie <span class="gradient-text">Junspro</span> vous attend
        </h2>
        <p class="empty-state-description">
          Ici, toutes vos conversations avec les clients sont organisées en un seul endroit. 
          Créez votre premier Rituel pour recevoir des demandes et démarrer des échanges significatifs.
        </p>

        <!-- Grille d'avantages -->
        <div class="workflow-section">
          <h3 class="workflow-title">Pourquoi utiliser la messagerie Junspro ?</h3>
          <div class="workflow-grid">
            <!-- Avantage 1 -->
            <div class="workflow-card">
              <div class="step-number">💬</div>
              <h3>Conversations unifiées</h3>
              <p>
                Tous vos échanges avec les clients au même endroit, organisés par projet.
                Plus besoin de jongler entre plusieurs outils.
              </p>
            </div>

            <!-- Avantage 2 -->
            <div class="workflow-card">
              <div class="step-number">⚡</div>
              <h3>Réponses rapides</h3>
              <p>
                Répondez directement depuis votre tableau de bord sans changer d'outil.
                Une interface simple et efficace.
              </p>
            </div>

            <!-- Avantage 3 -->
            <div class="workflow-card">
              <div class="step-number">🎯</div>
              <h3>Notifications intelligentes</h3>
              <p>
                Ne manquez jamais un message important avec nos alertes contextuelles.
                Restez informé en temps réel.
              </p>
            </div>
          </div>
        </div>

        <!-- CTA Principal -->
        <div class="primary-cta">
          <a href="{{ route('freelance.services.create') }}" class="btn-primary-xl">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M12 5v14M5 12h14"/>
            </svg>
            Créer un Rituel pour recevoir des messages
          </a>
        </div>
      </div>
    </main>

    <!-- ===== SIDEBAR (30%) - LIGHT ===== -->
    @include('frontend.freelance.dashboard.partials.dashboard-sidebar-section', [
      'activeTab' => $activeTab ?? 'messages'
    ])
  </div>
</div>

{{-- Styles CSS communs du shell premium --}}
@include('frontend.freelance.dashboard.partials.dashboard-shell-styles')

<style>
  /* ===== STYLES SPÉCIFIQUES À L'ONGLET MESSAGES ===== */
  /* Les styles communs sont dans dashboard-shell-styles.blade.php */
  
  /* ===== BLOC TABLEAU DE BORD FREELANCE ===== */
  .messages-page-wrapper-light .dashboard-header {
    margin-top: 2cm !important;
    margin-left: 2cm !important;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }

  .messages-page-wrapper-light .dashboard-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
  }

  .messages-page-wrapper-light .dashboard-header-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin-bottom: 1.25rem;
    line-height: 1.5;
  }

  .messages-page-wrapper-light .dashboard-header-ctas {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .messages-page-wrapper-light .btn-premium {
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

  .messages-page-wrapper-light .btn-premium-primary {
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .messages-page-wrapper-light .btn-premium-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    color: white;
    text-decoration: none;
  }

  .messages-page-wrapper-light .btn-premium-secondary {
    background: white;
    color: #1e40af;
    border: 2px solid #1e40af;
  }

  .messages-page-wrapper-light .btn-premium-secondary:hover {
    background: #f8fafc;
    transform: translateY(-1px);
    color: #1e40af;
    text-decoration: none;
  }

  /* ===== RESET ET VARIABLES LIGHT ===== */
  .messages-page-wrapper-light {
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
  
  .messages-page-wrapper-light * {
    box-sizing: border-box;
  }
  
  .messages-page-wrapper-light {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    min-height: 100vh;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT (Style identique à Demandes) ===== */
  .messages-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite comme Demandes */
    box-sizing: border-box;
  }
  
  .messages-page-wrapper-light .dashboard-container {
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
  .messages-page-wrapper-light .main-content {
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
  .messages-page-wrapper-light .page-header {
    margin-top: 2cm !important; /* Décalage de 2 cm du bloc Tableau de bord Freelance */
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
  
  .messages-page-wrapper-light .page-header::after {
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
  
  .messages-page-wrapper-light .page-header h1 {
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
  
  .messages-page-wrapper-light .page-subtitle {
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
  
  /* ===== ÉTAT VIDE ===== */
  .messages-page-wrapper-light .empty-state {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
    text-align: center;
  }
  
  .messages-page-wrapper-light .empty-state-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--text-primary);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }
  
  .messages-page-wrapper-light .empty-state-description {
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto 2.5rem;
    line-height: 1.6;
    font-size: 1rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }
  
  /* ===== WORKFLOW SECTION ===== */
  .messages-page-wrapper-light .workflow-section {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 4rem 0 !important;
  }
  
  .messages-page-wrapper-light .workflow-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
    color: var(--text-primary);
    text-align: center;
  }
  
  .messages-page-wrapper-light .workflow-grid {
    display: grid !important;
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 2rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  
  .messages-page-wrapper-light .workflow-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
  }
  
  .messages-page-wrapper-light .workflow-card:hover {
    transform: translateY(-4px);
    border-color: var(--primary-light);
    box-shadow: var(--shadow-lg);
  }
  
  .messages-page-wrapper-light .step-number {
    font-size: 2.5rem;
    margin-bottom: 1rem;
  }
  
  .messages-page-wrapper-light .workflow-card h3 {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: var(--text-primary);
  }
  
  .messages-page-wrapper-light .workflow-card p {
    color: var(--text-secondary);
    font-size: 0.9375rem;
    line-height: 1.6;
  }
  
  /* ===== ILLUSTRATION ===== */
  .messages-page-wrapper-light .empty-state-illustration {
    text-align: center;
    margin: 2rem 0 3rem;
    position: relative;
    max-width: 100%;
    width: 100%;
    box-sizing: border-box;
  }
  
  .messages-page-wrapper-light .illustration-wrapper {
    position: relative;
    display: inline-block;
  }
  
  .messages-page-wrapper-light .gradient-orb {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: pulse 3s ease-in-out infinite;
  }
  
  @keyframes pulse {
    0%, 100% {
      opacity: 0.5;
      transform: translate(-50%, -50%) scale(1);
    }
    50% {
      opacity: 0.8;
      transform: translate(-50%, -50%) scale(1.1);
    }
  }
  
  .messages-page-wrapper-light .main-illustration {
    position: relative;
    z-index: 1;
    width: 160px;
    height: 160px;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-lg);
  }
  
  .messages-page-wrapper-light .illustration-icon {
    color: var(--primary);
    opacity: 0.8;
  }
  
  .messages-page-wrapper-light .gradient-text {
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  
  /* ===== CTA PRINCIPAL ===== */
  .messages-page-wrapper-light .primary-cta {
    text-align: center;
    margin: 4rem 0 0 0;
    padding: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }
  
  .messages-page-wrapper-light .btn-primary-xl {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.25rem 2.5rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
    color: white;
    border: none;
    border-radius: var(--radius-md);
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(59, 130, 246, 0.2);
  }
  
  .messages-page-wrapper-light .btn-primary-xl:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
    color: white;
    text-decoration: none;
  }
  
  /* ===== SIDEBAR (30%) ===== */
  .messages-page-wrapper-light .sidebar {
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
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important;
  }
  
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 6px;
  }
  
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 6px;
  }
  
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }
  
  .messages-page-wrapper-light .nav-section,
  .messages-page-wrapper-light .stats-section,
  .messages-page-wrapper-light .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
    margin-bottom: 2rem;
  }
  
  .messages-page-wrapper-light .nav-title {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--text-tertiary);
    margin-bottom: 1.25rem;
    font-weight: 600;
  }
  
  .messages-page-wrapper-light .nav-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .messages-page-wrapper-light .nav-item {
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
  
  .messages-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05);
    color: var(--primary);
    text-decoration: none;
  }
  
  .messages-page-wrapper-light .nav-item.active {
    background: rgba(59, 130, 246, 0.1);
    color: var(--primary);
    font-weight: 600;
    border-left: 3px solid var(--primary);
  }
  
  .messages-page-wrapper-light .nav-icon {
    font-size: 1.125rem;
    width: 24px;
    text-align: center;
  }
  
  .messages-page-wrapper-light .stats-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .messages-page-wrapper-light .stats-grid {
    display: grid;
    gap: 1rem;
  }
  
  .messages-page-wrapper-light .stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-light);
  }
  
  .messages-page-wrapper-light .stat-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }
  
  .messages-page-wrapper-light .stat-label {
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
  }
  
  .messages-page-wrapper-light .stat-value {
    font-weight: 700;
    font-size: 1.125rem;
    color: var(--text-primary);
  }
  
  .messages-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
    font-weight: 800;
  }
  
  .messages-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .messages-page-wrapper-light .tip-icon {
    color: var(--accent);
    font-size: 1.25rem;
  }
  
  .messages-page-wrapper-light .tip-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-primary);
  }
  
  .messages-page-wrapper-light .tip-content {
    color: var(--text-secondary);
    font-size: 0.875rem;
    line-height: 1.5;
  }
  
  .messages-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.75rem;
  }
  
  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .messages-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 2rem 0 !important;
    }
    
    .messages-page-wrapper-light .main-content {
      padding: 3rem 10px !important;
    }
    
    .messages-page-wrapper-light .sidebar {
      position: relative !important;
      top: 0 !important;
      padding: 2.5rem 10px !important;
      max-height: none !important;
    }
    
    .messages-page-wrapper-light .workflow-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }
  }
  
  @media (max-width: 768px) {
    .messages-page-wrapper-light .page-header h1 {
      font-size: 2rem !important;
    }
    
    .messages-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }
    
    .messages-page-wrapper-light .workflow-grid {
      grid-template-columns: 1fr !important;
    }
    
    .messages-page-wrapper-light .empty-state-title {
      font-size: 1.5rem;
    }
  }
</style>
