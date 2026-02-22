http://localhost:8000/home<?php
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'services';
?>

<div class="services-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Header de page -->
      <div class="page-header">
        <h1>Services</h1>
        <p class="page-subtitle">
          Les offres que vous proposez aux clients. Structurez vos prestations, définissez vos tarifs 
          et rendez-vous visible pour recevoir des demandes qualifiées.
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
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Titre et description -->
        <h2 class="empty-state-title">
          Créez votre premier <span class="gradient-text">Rituel</span>
        </h2>
        <p class="empty-state-description">
          Les Rituels sont vos offres présentées aux clients. Un Rituel bien défini attire des clients 
          alignés et réduit les questions préalables de 70%.
        </p>

        <!-- Grille d'avantages -->
        <div class="workflow-section">
          <h3 class="workflow-title">Pourquoi créer des Rituels ?</h3>
          <div class="workflow-grid">
            <!-- Avantage 1 -->
            <div class="workflow-card">
              <div class="step-number">🎯</div>
              <h3>Précision client</h3>
              <p>
                Attirez des clients qui comprennent exactement ce que vous proposez.
                Moins de questions, plus de conversions.
              </p>
            </div>

            <!-- Avantage 2 -->
            <div class="workflow-card">
              <div class="step-number">💰</div>
              <h3>Tarification claire</h3>
              <p>
                Éliminez les négociations inutiles avec des prix transparents.
                Vos clients savent à quoi s'attendre.
              </p>
            </div>

            <!-- Avantage 3 -->
            <div class="workflow-card">
              <div class="step-number">⚡</div>
              <h3>Conversion rapide</h3>
              <p>
                Transformez les demandes en Rituels plus rapidement.
                Un processus fluide pour vous et vos clients.
              </p>
            </div>
          </div>
        </div>

        <!-- Prévisualisation tableau -->
        <div class="ritual-section">
          <div class="ritual-header">
            <span class="ritual-badge">📊 PRÉVISUALISATION</span>
            <h3 class="ritual-title">À quoi ressemblera votre tableau de Rituels</h3>
          </div>
          <p class="ritual-intro">
            Voici un exemple de ce à quoi ressemblera votre tableau de Rituels une fois que vous aurez 
            créé vos premières offres. Chaque Rituel peut être activé, désactivé ou modifié à tout moment.
          </p>

          <div class="services-table-preview">
            <div class="services-table-header">
              <div>SERVICE</div>
              <div>PRIX</div>
              <div>DÉLAI</div>
              <div>STATUT</div>
              <div>ACTIONS</div>
            </div>
            
            <div class="services-table-row">
              <div class="services-service-example">
                <div class="services-service-icon"></div>
                <div>
                  <div style="font-weight: 600; color: var(--text-primary);">Conception Logo Premium</div>
                  <div style="font-size: 0.875rem; color: var(--text-secondary);">Identité visuelle complète</div>
                </div>
              </div>
              <div style="font-weight: 600; color: var(--text-primary);">2 500 €</div>
              <div style="color: var(--text-secondary);">7 jours</div>
              <div><span class="services-status-badge services-status-active">Actif</span></div>
              <div><button class="services-btn-edit">Modifier</button></div>
            </div>
            
            <div class="services-table-row">
              <div class="services-service-example">
                <div class="services-service-icon"></div>
                <div>
                  <div style="font-weight: 600; color: var(--text-primary);">Audit UX/UI</div>
                  <div style="font-size: 0.875rem; color: var(--text-secondary);">Analyse complète interface</div>
                </div>
              </div>
              <div style="font-weight: 600; color: var(--text-primary);">1 800 €</div>
              <div style="color: var(--text-secondary);">3 jours</div>
              <div><span class="services-status-badge services-status-draft">Brouillon</span></div>
              <div><button class="services-btn-edit">Publier</button></div>
            </div>
          </div>
        </div>

        <!-- CTA Principal -->
        <div class="primary-cta">
          <a href="<?php echo e(route('freelance.services.create')); ?>" class="btn-primary-xl">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M12 5v14M5 12h14"/>
            </svg>
            Créer mon premier service
          </a>
        </div>
      </div>
    </main>

    <!-- ===== SIDEBAR (30%) - LIGHT ===== -->
    <?php echo $__env->make('frontend.freelance.dashboard.partials.dashboard-sidebar-section', [
      'activeTab' => $activeTab ?? 'services',
      'freelancerProfile' => $freelancerProfile ?? null,
      'user' => $user ?? null
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>
</div>

<style>
  /* ===== RESET ET VARIABLES LIGHT ===== */
  .services-page-wrapper-light {
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
  
  .services-page-wrapper-light * {
    box-sizing: border-box;
  }
  
  .services-page-wrapper-light {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    min-height: 100vh;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT ===== */
  .services-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite */
    box-sizing: border-box;
  }
  
  .services-page-wrapper-light .dashboard-container {
    display: grid !important;
    grid-template-columns: 70% 30% !important; /* Layout premium 70/30 */
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
  
  /* ===== ZONE PRINCIPALE (70%) - GAUCHE - PREMIUM ===== */
  .services-page-wrapper-light .main-content {
    padding: 4rem 10px 4rem 2cm !important; /* Padding vertical + 1cm à droite + 2cm à gauche pour décalage comme Demandes */
    border-right: none !important;
    min-height: 100vh;
    background: #F5F7FA;
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
  
  /* ===== HEADER PREMIUM - CENTRÉ ===== */
  .services-page-wrapper-light .page-header {
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
  
  .services-page-wrapper-light .page-header::after {
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
  
  .services-page-wrapper-light .page-header h1 {
    font-size: 3rem !important; /* 48px desktop - MÊME TAILLE QUE DEMANDES */
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
  
  .services-page-wrapper-light .page-subtitle {
    color: var(--text-secondary);
    font-size: 1.25rem; /* 20px */
    max-width: 100%;
    width: 100%;
    line-height: 1.75;
    font-weight: 400;
    word-wrap: break-word;
    margin-top: 0.5rem;
    text-align: center !important; /* Centrage du sous-texte */
  }
  
  /* ===== ÉTAT VIDE ===== */
  .services-page-wrapper-light .empty-state {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
    text-align: center;
  }
  
  .services-page-wrapper-light .empty-state-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--text-primary);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }
  
  .services-page-wrapper-light .empty-state-description {
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
  .services-page-wrapper-light .workflow-section {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 4rem 0 !important;
  }
  
  .services-page-wrapper-light .workflow-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
    color: var(--text-primary);
    text-align: center;
  }
  
  .services-page-wrapper-light .workflow-grid {
    display: grid !important;
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 2rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  
  .services-page-wrapper-light .workflow-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
  }
  
  .services-page-wrapper-light .workflow-card:hover {
    transform: translateY(-4px);
    border-color: var(--primary-light);
    box-shadow: var(--shadow-lg);
  }
  
  .services-page-wrapper-light .step-number {
    font-size: 2.5rem;
    margin-bottom: 1rem;
  }
  
  .services-page-wrapper-light .workflow-card h3 {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: var(--text-primary);
  }
  
  .services-page-wrapper-light .workflow-card p {
    color: var(--text-secondary);
    font-size: 0.9375rem;
    line-height: 1.6;
  }
  
  /* ===== RITUAL SECTION ===== */
  .services-page-wrapper-light .ritual-section {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 4rem 0 !important;
  }
  
  .services-page-wrapper-light .ritual-header {
    text-align: center;
    margin-bottom: 1.5rem;
  }
  
  .services-page-wrapper-light .ritual-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
    border: 1px solid var(--border);
    border-radius: 100px;
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  
  .services-page-wrapper-light .ritual-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
  }
  
  .services-page-wrapper-light .ritual-intro {
    color: var(--text-secondary);
    font-size: 1rem;
    line-height: 1.7;
    max-width: 800px;
    margin: 0 auto 2rem;
    text-align: center;
  }
  
  /* ===== TABLEAU SERVICES ===== */
  .services-page-wrapper-light .services-table-preview {
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 2rem;
    margin-top: 2rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }
  
  .services-page-wrapper-light .services-table-header {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
    padding: 1rem;
    background: var(--bg-card);
    border-radius: var(--radius-md);
    font-weight: 600;
    color: var(--text-secondary);
    font-size: 0.875rem;
    border: 1px solid var(--border);
    margin-bottom: 0.5rem;
  }
  
  .services-page-wrapper-light .services-table-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
    padding: 1rem;
    align-items: center;
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-card);
  }
  
  .services-page-wrapper-light .services-table-row:last-child {
    border-bottom: none;
  }
  
  .services-page-wrapper-light .services-service-example {
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  
  .services-page-wrapper-light .services-service-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-light);
    border-radius: var(--radius-sm);
  }
  
  .services-page-wrapper-light .services-status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 100px;
    font-size: 0.75rem;
    font-weight: 600;
  }
  
  .services-page-wrapper-light .services-status-active {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
  }
  
  .services-page-wrapper-light .services-status-draft {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning);
  }
  
  .services-page-wrapper-light .services-btn-edit {
    background: none;
    border: 1px solid var(--border);
    padding: 0.5rem 1rem;
    border-radius: var(--radius-sm);
    color: var(--primary);
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  
  .services-page-wrapper-light .services-btn-edit:hover {
    background: var(--primary);
    color: white;
  }
  
  /* ===== CTA PRINCIPAL ===== */
  .services-page-wrapper-light .primary-cta {
    text-align: center;
    margin: 4rem 0 0 0;
    padding: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }
  
  .services-page-wrapper-light .btn-primary-xl {
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
  
  .services-page-wrapper-light .btn-primary-xl:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
    color: white;
    text-decoration: none;
  }
  
  /* ===== SIDEBAR (30%) - DROITE - PREMIUM CARD AVEC SCROLL ===== */
  .services-page-wrapper-light .sidebar {
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
    overflow-x: hidden !important;
    box-sizing: border-box !important;
    grid-column: 2 !important;
    align-self: start !important;
  }
  
  .services-page-wrapper-light .sidebar .nav-section,
  .services-page-wrapper-light .sidebar .stats-section,
  .services-page-wrapper-light .sidebar .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
  }
  
  /* Style de la scrollbar pour un rendu premium - ÉPAISSE */
  .services-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important; /* Scrollbar épaisse (12px) */
  }
  
  .services-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 10px;
    margin: 8px 0;
  }
  
  .services-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 10px;
    border: 2px solid var(--bg-secondary);
  }
  
  .services-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }
  
  /* Support Firefox */
  .services-page-wrapper-light .sidebar {
    scrollbar-width: thick !important;
    scrollbar-color: var(--border) var(--bg-secondary) !important;
  }
  
  /* ===== NAVIGATION ===== */
  .services-page-wrapper-light .nav-section {
    margin-bottom: 3.5rem !important;
    width: 100% !important;
    box-sizing: border-box !important;
    position: relative !important;
    z-index: 1 !important;
    overflow: visible !important;
  }
  
  .services-page-wrapper-light .nav-title {
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    color: var(--text-tertiary) !important;
    margin-bottom: 1.5rem !important;
    padding: 0 !important;
  }
  
  .services-page-wrapper-light .nav-list {
    display: flex !important;
    flex-direction: column !important;
    gap: 0.75rem !important;
    width: 100% !important;
  }
  
  .services-page-wrapper-light .nav-item {
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
  }
  
  .services-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05) !important;
    color: var(--primary) !important;
    border-color: rgba(59, 130, 246, 0.1) !important;
  }
  
  .services-page-wrapper-light .nav-item.active {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%) !important;
    color: var(--primary) !important;
    border-color: var(--primary) !important;
    font-weight: 600 !important;
  }

  .services-page-wrapper-light .nav-icon {
    font-size: 1.25rem !important;
    flex-shrink: 0 !important;
    width: 24px !important;
    text-align: center !important;
  }
  
  .services-page-wrapper-light .stats-section,
  .services-page-wrapper-light .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
    margin-bottom: 2rem;
  }

  /* ===== ACTIONS RAPIDES (Boutons sidebar) ===== */
  .services-page-wrapper-light .actions-section {
    width: 100% !important;
    flex-shrink: 0 !important;
    margin-bottom: 2rem;
  }

  .services-page-wrapper-light .btn-sidebar-primary {
    display: block !important;
    width: 100% !important;
    text-align: center !important;
    padding: 1rem 1.25rem !important;
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%) !important;
    color: white !important;
    border-radius: var(--radius-md) !important;
    text-decoration: none !important;
    font-weight: 600 !important;
    font-size: 0.95rem !important;
    margin-bottom: 0.75rem !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 16px rgba(59, 130, 246, 0.2) !important;
    border: none !important;
  }

  .services-page-wrapper-light .btn-sidebar-primary:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3) !important;
    color: white !important;
    text-decoration: none !important;
  }

  .services-page-wrapper-light .btn-sidebar-secondary {
    display: block !important;
    width: 100% !important;
    text-align: center !important;
    padding: 1rem 1.25rem !important;
    background: white !important;
    color: var(--primary) !important;
    border: 2px solid var(--primary) !important;
    border-radius: var(--radius-md) !important;
    text-decoration: none !important;
    font-weight: 600 !important;
    font-size: 0.95rem !important;
    transition: all 0.3s ease !important;
  }

  .services-page-wrapper-light .btn-sidebar-secondary:hover {
    background: rgba(59, 130, 246, 0.05) !important;
    transform: translateY(-1px) !important;
    color: var(--primary) !important;
    text-decoration: none !important;
  }
  
  /* ===== STATISTIQUES ===== */
  .services-page-wrapper-light .stats-section {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-bottom: 2.5rem;
    box-shadow: var(--shadow-sm);
  }
  
  .services-page-wrapper-light .stats-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  
  .services-page-wrapper-light .stats-title svg {
    color: var(--primary);
  }
  
  .services-page-wrapper-light .stats-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  .services-page-wrapper-light .stat-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .services-page-wrapper-light .stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
  }
  
  .services-page-wrapper-light .stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--primary);
  }

  .services-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
  }
  
  /* ===== CONSEILS ===== */
  .services-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-top: 2.5rem;
  }
  
  .services-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .services-page-wrapper-light .tip-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
  }
  
  .services-page-wrapper-light .tip-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
  }
  
  .services-page-wrapper-light .tip-content {
    font-size: 0.9rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
  }
  
  .services-page-wrapper-light .tip-content strong {
    color: var(--text-primary);
    font-weight: 600;
  }
  
  /* ===== RESPONSIVE ===== */
  @media (max-width: 1200px) {
    .services-page-wrapper-light {
      padding-inline: 10px !important;
    }
    
    .services-page-wrapper-light .dashboard-container {
      grid-template-columns: 70% 30% !important;
      gap: 0 10px !important;
    }
    
    .services-page-wrapper-light .main-content {
      padding: 3rem 10px !important; /* Pas de décalage 2cm sur tablette */
    }
    
    .services-page-wrapper-light .sidebar {
      padding: 2.5rem 10px 2.5rem 2rem !important;
    }
    
    .services-page-wrapper-light .page-header h1 {
      font-size: 2.5rem !important; /* 40px tablette */
    }
  }
  
  @media (max-width: 1024px) {
    .services-page-wrapper-light {
      padding-inline: 10px !important;
    }
    
    .services-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 10px 0 !important;
    }
    
    .services-page-wrapper-light .main-content {
      padding: 2rem 10px !important; /* Pas de décalage 2cm sur mobile */
    }
    
    .services-page-wrapper-light .sidebar {
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
    
    .services-page-wrapper-light .page-header h1 {
      font-size: 2rem !important; /* 32px mobile */
    }

    .services-page-wrapper-light .workflow-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }
    
    .services-page-wrapper-light .services-table-header,
    .services-page-wrapper-light .services-table-row {
      grid-template-columns: 1fr;
      gap: 0.5rem;
    }

    .services-page-wrapper-light .nav-section {
      margin-bottom: 2.5rem !important;
    }

    .services-page-wrapper-light .nav-list {
      gap: 0.75rem !important;
    }
    
    .services-page-wrapper-light .nav-item {
      min-height: 52px !important;
      padding: 0.875rem 1rem !important;
    }
  }
  
  @media (max-width: 768px) {
    .services-page-wrapper-light .page-header h1 {
      font-size: 2rem !important;
    }
    
    .services-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }
    
    .services-page-wrapper-light .workflow-grid {
      grid-template-columns: 1fr !important;
    }
    
    .services-page-wrapper-light .empty-state-title {
      font-size: 1.5rem;
    }
  }

  @media (max-width: 480px) {
    .services-page-wrapper-light .sidebar {
      padding: 1.5rem 1rem !important;
    }
    
    .services-page-wrapper-light .nav-section {
      margin-bottom: 2rem !important;
    }
    
    .services-page-wrapper-light .nav-item {
      min-height: 48px !important;
      padding: 0.75rem 0.875rem !important;
      gap: 0.875rem !important;
    }
    
    .services-page-wrapper-light .nav-icon {
      font-size: 1.125rem !important;
    }
  }
</style>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\dashboard\tabs\services.blade.php ENDPATH**/ ?>