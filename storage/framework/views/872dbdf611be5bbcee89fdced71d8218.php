<?php
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'jobs';
  
  // Simuler des données de prestations (à remplacer par les vraies données du contrôleur)
  $hasJobs = false; // À remplacer par la logique réelle : count($jobs) > 0
  $jobs = []; // À remplacer par les vraies données
?>

<div class="jobs-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Bloc Tableau de bord Freelance -->
      <?php echo $__env->make('frontend.freelance.dashboard.partials.dashboard-header-section', [
        'freelancerProfile' => $freelancerProfile ?? null
      ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

      <!-- Header de page -->
      <div class="page-header">
        <h1>Prestations</h1>
        <p class="page-subtitle">
          Gérez vos missions et sessions Rituel. Structurez votre travail, suivez votre progression,
          et gardez vos clients informés automatiquement.
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
                <rect x="3" y="3" width="18" height="18" rx="2" stroke-linecap="round"/>
                <path d="M3 9h18M9 21V9" stroke-linecap="round"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Titre et description -->
        <h2 class="empty-state-title">
          Votre espace <span class="gradient-text">prestations</span> vous attend
        </h2>
        <p class="empty-state-description">
          C'est ici que vous gérerez toutes vos missions Rituel. Créez votre premier service
          pour commencer à recevoir des demandes et transformer votre expertise en résultats
          mesurables pour vos clients.
        </p>

        <!-- Workflow en 3 étapes -->
        <div class="workflow-section">
          <h3 class="workflow-title">Comment démarrer en 3 étapes</h3>
          <div class="workflow-grid">
            <!-- Étape 1 -->
            <div class="workflow-card">
              <div class="step-number">1</div>
              <h3>Créer un Rituel</h3>
              <p>
                Définissez clairement ce que vous proposez, vos livrables,
                et votre tarification. Un Rituel bien défini attire des clients alignés.
              </p>
            </div>

            <!-- Étape 2 -->
            <div class="workflow-card">
              <div class="step-number">2</div>
              <h3>Recevoir des demandes</h3>
              <p>
                Vos services apparaissent dans les recherches des clients correspondants.
                Un profil optimisé augmente votre visibilité.
              </p>
            </div>

            <!-- Étape 3 -->
            <div class="workflow-card">
              <div class="step-number">3</div>
              <h3>Lancer un Rituel</h3>
              <p>
                Transformez une demande acceptée en Rituel - l'unité de travail standard
                qui garantit transparence et cadence pour vos clients.
              </p>
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

        <!-- Section Rituel -->
        <div class="ritual-section">
          <div class="ritual-header">
            <span class="ritual-badge">⚡ RITUEL JUNSPRO</span>
            <h3 class="ritual-title">L'unité de travail universelle</h3>
          </div>
          <p class="ritual-intro">
            Sur Junspro, toutes vos prestations suivent le modèle Rituel unique :
            50 minutes de focus concentré + 10 minutes de bilan automatique envoyé au client.
            Plus de relances, plus de stress : vos clients voient l'avancement en temps réel.
          </p>

          <div class="ritual-grid">
            <!-- Rituel en ligne -->
            <div class="ritual-card online">
              <div class="ritual-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
              </div>
              <h4>En ligne</h4>
              <p class="ritual-mode">Cours, coaching, consultation en direct</p>
              <div class="ritual-process">
                <div class="process-step">
                  <span class="process-time">50 min</span>
                  <span class="process-label">Session focus</span>
                </div>
                <div class="process-plus">+</div>
                <div class="process-step">
                  <span class="process-time">10 min</span>
                  <span class="process-label">Pause entre sessions</span>
                </div>
              </div>
            </div>

            <!-- Rituel hors ligne -->
            <div class="ritual-card offline">
              <div class="ritual-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4zm2.5 2.1h-15V5h15v14.1zm0-16.1h-15c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
                </svg>
              </div>
              <h4>Hors ligne</h4>
              <p class="ritual-mode">Design, développement, rédaction autonome</p>
              <div class="ritual-process">
                <div class="process-step">
                  <span class="process-time">50 min</span>
                  <span class="process-label">Focus concentré</span>
                </div>
                <div class="process-plus">+</div>
                <div class="process-step">
                  <span class="process-time">10 min</span>
                  <span class="process-label">Rapport automatique</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- ===== SIDEBAR (30%) - LIGHT ===== -->
    <?php echo $__env->make('frontend.freelance.dashboard.partials.dashboard-sidebar-section', [
      'activeTab' => $activeTab ?? 'jobs'
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>
        </div>


<?php echo $__env->make('frontend.freelance.dashboard.partials.dashboard-shell-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<style>
  /* ===== STYLES SPÉCIFIQUES À L'ONGLET PRESTATIONS ===== */
  /* Les styles communs sont dans dashboard-shell-styles.blade.php */
  
  /* ===== BLOC TABLEAU DE BORD FREELANCE - Décalage de 2 cm du bord gauche et haut ===== */
  .jobs-page-wrapper-light .dashboard-header {
    margin-top: 2cm !important;
    margin-left: 2cm !important;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }

  .jobs-page-wrapper-light .dashboard-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
  }

  .jobs-page-wrapper-light .dashboard-header-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin-bottom: 1.25rem;
    line-height: 1.5;
  }

  .jobs-page-wrapper-light .dashboard-header-ctas {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .jobs-page-wrapper-light .btn-premium {
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

  .jobs-page-wrapper-light .btn-premium-primary {
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .jobs-page-wrapper-light .btn-premium-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    color: white;
    text-decoration: none;
  }

  .jobs-page-wrapper-light .btn-premium-secondary {
    background: white;
    color: #1e40af;
    border: 2px solid #1e40af;
  }

  .jobs-page-wrapper-light .btn-premium-secondary:hover {
    background: #f8fafc;
    transform: translateY(-1px);
    color: #1e40af;
    text-decoration: none;
  }

  /* ===== RESET ET VARIABLES LIGHT ===== */
  .jobs-page-wrapper-light {
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
  
  .jobs-page-wrapper-light * {
    box-sizing: border-box;
  }
  
  .jobs-page-wrapper-light {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    min-height: 100vh;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT - CORRECTION SUPERPOSITION ===== */
  /* DIAGNOSTIC :
   * - Sidebar fixe à gauche (280px) avec position: fixed
   * - Container principal doit être décalé pour éviter superposition
   * - Grid interne doit utiliser auto-fill pour retour à la ligne propre
   * - Tous les éléments doivent utiliser box-sizing: border-box
   */
  
  /* ===== STRUCTURE 70/30 LIGHT (Style identique à Demandes) ===== */
  .jobs-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite comme Demandes */
    box-sizing: border-box;
  }
  
  .jobs-page-wrapper-light .dashboard-container {
    display: grid !important;
    grid-template-columns: 70% 30% !important; /* Layout premium 70/30 */
    min-height: 100vh;
    max-width: none !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 2rem !important; /* Padding pour créer l'espace autour du contenu comme dans Demandes */
    background: white !important; /* Fond blanc comme dans Demandes */
    border-radius: var(--radius-xl) !important; /* Bords arrondis (20px) comme dans Demandes */
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important; /* Ombre légère identique à Demandes */
    box-sizing: border-box;
    gap: 0 10px !important; /* Espacement de 1cm (10px) entre les zones 70% et 30% */
    align-items: start !important;
    overflow-x: visible !important;
  }
  
  /* ===== ZONE PRINCIPALE (70%) - GAUCHE - PREMIUM ===== */
  .jobs-page-wrapper-light .main-content {
    padding: 4rem 10px !important; /* Padding vertical + 1cm (10px) de chaque côté */
    border-right: none !important; /* Suppression complète de la bordure */
    min-height: 100vh;
    background: #F5F7FA;
    box-sizing: border-box;
    overflow-x: visible !important; /* Permet au contenu de s'étendre */
    position: relative;
    max-width: none !important; /* Pas de limite de largeur */
    width: 100% !important; /* Force la pleine largeur */
    min-width: 0 !important; /* Permet au grid de gérer la largeur */
    grid-column: 1 !important; /* Première colonne (gauche) */
    display: flex;
    flex-direction: column;
  }
  
  /* ===== HEADER PREMIUM - CENTRÉ (Style identique à Demandes) ===== */
  .jobs-page-wrapper-light .page-header {
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
  
  .jobs-page-wrapper-light .page-header::after {
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
  
  .jobs-page-wrapper-light .page-header h1 {
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
  
  .jobs-page-wrapper-light .page-subtitle {
    color: var(--text-secondary);
    font-size: 1.25rem; /* 20px - Plus grand pour lisibilité premium */
    max-width: 100%; /* Utilise toute la largeur */
    width: 100%;
    line-height: 1.75; /* Line-height généreux */
    font-weight: 400;
    word-wrap: break-word;
    margin-top: 0.5rem;
    text-align: center !important; /* Centrage du sous-texte */
  }
  
  /* ===== ÉTAT VIDE PREMIUM - CENTRÉ ET RAISONNABLE ===== */
  .jobs-page-wrapper-light .empty-state {
    max-width: 100% !important; /* Utilise toute la largeur disponible de la colonne 70% */
    margin: 0 !important; /* Pas de marge pour utiliser tout l'espace */
    width: 100% !important;
    box-sizing: border-box !important;
    overflow-x: visible !important; /* Permet au contenu de s'étendre */
    position: relative !important;
    display: flex;
    flex-direction: column;
    gap: 0; /* Gap géré par les marges des sections */
    padding: 0 !important; /* Pas de padding supplémentaire */
    align-items: stretch !important; /* Étire le contenu sur toute la largeur */
  }
  
  /* La section workflow utilise toute la largeur disponible de l'empty-state */
  .jobs-page-wrapper-light .empty-state .workflow-section {
    max-width: 100% !important; /* Utilise toute la largeur de l'empty-state */
    width: 100% !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding-left: 0 !important; /* Pas de padding qui limite la largeur */
    padding-right: 0 !important;
  }
  
  /* ===== ILLUSTRATION PREMIUM ===== */
  .jobs-page-wrapper-light .empty-state-illustration {
    text-align: center;
    margin: 2rem 0 3rem; /* Espacement premium optimisé */
    position: relative;
    max-width: 100%;
    width: 100%;
    box-sizing: border-box;
  }
  
  .jobs-page-wrapper-light .illustration-wrapper {
    position: relative;
    display: inline-block;
  }
  
  .jobs-page-wrapper-light .gradient-orb {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: radial-gradient(circle at 30% 30%, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 70%, transparent 100%);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: float-orb 6s ease-in-out infinite;
  }
  
  @keyframes float-orb {
    0%, 100% { transform: translate(-50%, -50%) scale(1); }
    50% { transform: translate(-50%, -50%) scale(1.05); }
  }
  
  .jobs-page-wrapper-light .main-illustration {
    position: relative;
    z-index: 2;
    width: 200px;
    max-width: 100%;
    height: auto;
    aspect-ratio: 1;
    background: var(--bg-card);
    border-radius: var(--radius-2xl);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-xl);
    box-sizing: border-box;
  }
  
  .jobs-page-wrapper-light .illustration-icon {
    color: var(--primary);
    opacity: 0.9;
    max-width: 100%;
    height: auto;
  }
  
  /* ===== TITRE PRINCIPAL PREMIUM ===== */
  .jobs-page-wrapper-light .empty-state-title {
    font-size: 2.75rem; /* 44px desktop - Plus grand pour impact */
    font-weight: 800;
    text-align: center;
    margin-bottom: 1.5rem;
    line-height: 1.15; /* Line-height serré pour élégance */
    letter-spacing: -0.02em;
    max-width: 100% !important;
    width: 100% !important;
    min-width: 100% !important; /* Force l'utilisation de toute la largeur */
    word-wrap: break-word;
    padding: 0 !important; /* Pas de padding qui limite */
  }
  
  .jobs-page-wrapper-light .empty-state-title .gradient-text {
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 900;
  }
  
  /* ===== DESCRIPTION PREMIUM ===== */
  .jobs-page-wrapper-light .empty-state-description {
    text-align: center;
    color: var(--text-secondary);
    font-size: 1.25rem; /* 20px - Plus grand pour lisibilité premium */
    line-height: 1.75; /* Line-height généreux */
    max-width: 100% !important; /* Utilise toute la largeur disponible */
    width: 100% !important;
    min-width: 100% !important; /* Force l'utilisation de toute la largeur */
    margin: 0 0 3rem 0; /* Espacement premium */
    font-weight: 400;
    word-wrap: break-word;
    padding: 0 !important; /* Pas de padding qui limite */
  }
  
  /* ===== WORKFLOW PREMIUM - UTILISE TOUTE LA LARGEUR ===== */
  .jobs-page-wrapper-light .workflow-section {
    margin: 4rem 0 !important;
    padding: 0 !important; /* Pas de padding, utilise toute la largeur */
    max-width: none !important; /* Pas de limite de largeur */
    width: 100% !important;
    min-width: 100% !important; /* Force l'utilisation de toute la largeur disponible */
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    box-sizing: border-box !important;
    position: relative !important;
    overflow: visible !important;
    display: block !important;
  }
  
  .jobs-page-wrapper-light .workflow-title {
    font-size: 2.5rem; /* 40px desktop - Taille premium */
    font-weight: 800;
    margin-bottom: 3.5rem; /* Espacement premium généreux */
    text-align: center;
    color: var(--text-primary);
    position: relative;
    display: block;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    letter-spacing: -0.02em;
    line-height: 1.1;
    padding: 0 !important; /* Pas de padding qui limite */
    margin-left: 0 !important;
    margin-right: 0 !important;
  }
  
  .jobs-page-wrapper-light .workflow-title::after {
    content: '';
    position: absolute;
    bottom: -0.75rem;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    border-radius: 2px;
  }
  
  /* ===== WORKFLOW GRID - SOLUTION CSS GRID =====
   * Utilisation de CSS Grid pour un contrôle précis de la largeur
   * et garantir que les 3 cartes utilisent toute la zone 70% disponible
   */
  .jobs-page-wrapper-light .workflow-grid {
    display: grid !important;
    grid-template-columns: 1fr !important; /* Mobile : 1 colonne par défaut */
    gap: 1.5rem !important; /* Espacement entre les cartes */
    margin-top: 3rem !important;
    margin-bottom: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    width: 100% !important;
    max-width: none !important; /* Pas de limite de largeur */
    min-width: 100% !important; /* Force l'utilisation de toute la largeur */
    box-sizing: border-box !important;
    position: relative !important;
    overflow: visible !important;
    padding-left: 0 !important; /* Pas de padding qui limite */
    padding-right: 0 !important;
  }
  
  .jobs-page-wrapper-light .workflow-card {
    width: 100% !important;
    min-width: 0 !important; /* Permet le shrink si nécessaire */
    max-width: 100% !important;
    margin-bottom: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
  }
  
  /* Tablette : 2 colonnes (768px - 1023px) */
  @media (min-width: 768px) {
    .jobs-page-wrapper-light .workflow-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr)) !important; /* 2 colonnes égales */
      gap: 2rem !important; /* Espacement de 32px entre les cartes */
    }
  }
  
  /* Desktop : 3 colonnes (≥ 1024px) - UTILISE TOUTE LA LARGEUR */
  @media (min-width: 1024px) {
    .jobs-page-wrapper-light .workflow-grid {
      grid-template-columns: repeat(3, minmax(0, 1fr)) !important; /* 3 colonnes égales qui utilisent toute la largeur */
      gap: 2rem !important; /* Espacement de 32px entre les cartes */
      width: 100% !important;
      max-width: none !important; /* Pas de limite de largeur */
      min-width: 100% !important;
    }
    
    .jobs-page-wrapper-light .workflow-card {
      width: 100% !important;
      min-width: 0 !important;
      max-width: none !important; /* Pas de limite de largeur */
    }
  }
  
  /* Très grands écrans (≥ 1440px) - Espacement optimisé */
  @media (min-width: 1440px) {
    .jobs-page-wrapper-light .workflow-grid {
      gap: 2.5rem !important; /* Espacement légèrement augmenté sur grands écrans */
    }
  }
  
  /* ===== STYLES DES CARTES WORKFLOW =====
   * Chaque carte doit avoir :
   * - Largeur égale (gérée par CSS Grid)
   * - Alignement vertical et horizontal cohérent
   * - Transition fluide en responsive
   * - Utilise toute la largeur disponible dans sa colonne Grid
   */
  .jobs-page-wrapper-light .workflow-card {
    box-sizing: border-box !important;
    background: var(--bg-card) !important;
    border: 1px solid rgba(148, 163, 184, 0.45) !important; /* Border translucide */
    border-radius: 24px !important; /* 20-24px comme demandé */
    padding: 28px !important; /* 24-28px comme demandé */
    text-align: left !important; /* Alignement gauche pour meilleure lisibilité */
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important; /* Transition fluide */
    position: relative !important; /* Relative pour les pseudo-éléments */
    overflow: hidden !important; /* Empêche tout débordement interne */
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06) !important; /* Shadow très douce */
    display: flex !important;
    flex-direction: column !important; /* Contenu aligné verticalement */
    justify-content: flex-start !important; /* Alignement en haut */
    align-items: flex-start !important; /* Alignement à gauche */
    min-height: 340px !important; /* Hauteur cohérente pour alignement vertical */
    width: 100% !important; /* Utilise toute la largeur de la colonne Grid */
    max-width: 100% !important; /* Pas de limite de largeur */
    min-width: 0 !important; /* Permet le shrink si nécessaire */
    float: none !important; /* Pas de float */
    clear: both !important; /* Clear float */
    margin: 0 !important; /* Pas de marge qui pourrait limiter */
  }
  
  /* Empêcher toute superposition via position absolute sur les cartes */
  .jobs-page-wrapper-light .workflow-card[style*="position: absolute"],
  .jobs-page-wrapper-light .workflow-card[style*="position:absolute"] {
    position: relative !important;
  }
  
  /* Alignement du contenu à l'intérieur de chaque carte */
  .jobs-page-wrapper-light .workflow-card .step-number {
    align-self: flex-start !important; /* Badge aligné à gauche */
    margin-bottom: 1.5rem !important;
  }
  
  .jobs-page-wrapper-light .workflow-card h3 {
    align-self: flex-start !important;
    width: 100% !important;
  }
  
  .jobs-page-wrapper-light .workflow-card p {
    align-self: flex-start !important;
    width: 100% !important;
    flex-grow: 1 !important; /* Prend l'espace disponible */
  }
  
  .jobs-page-wrapper-light .workflow-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    opacity: 0;
    transition: opacity 0.3s ease;
  }
  
  .jobs-page-wrapper-light .workflow-card:hover {
    transform: translateY(-8px);
    border-color: var(--primary-light);
    box-shadow: var(--shadow-xl);
  }
  
  .jobs-page-wrapper-light .workflow-card:hover::before {
    opacity: 1;
  }
  
  .jobs-page-wrapper-light .step-number {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color: white;
    border-radius: 18px; /* Border-radius pour badge */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1.125rem;
    margin-bottom: 22px; /* Aligné en haut */
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.2);
    flex-shrink: 0; /* Empêche la compression */
  }
  
  .jobs-page-wrapper-light .workflow-card h3 {
    font-size: 1.5rem; /* 24px */
    font-weight: 800;
    margin-bottom: 1rem;
    margin-top: 0;
    color: var(--text-primary);
    line-height: 1.3;
  }
  
  .jobs-page-wrapper-light .workflow-card p {
    color: var(--text-secondary);
    line-height: 1.7;
    font-size: 1rem; /* 16px */
    margin-bottom: 0;
    flex-grow: 1; /* Prend l'espace disponible */
  }
  
  /* Alignement du contenu en colonne avec espacement */
  .jobs-page-wrapper-light .workflow-card > *:not(:last-child) {
    margin-bottom: 1rem;
  }
  
  /* ===== CTA PRINCIPAL PREMIUM ===== */
  .jobs-page-wrapper-light .primary-cta {
    text-align: center;
    margin: 4rem 0 5rem !important; /* Espacement premium généreux */
    margin-left: 0 !important;
    margin-right: 0 !important;
    position: relative;
    max-width: 100% !important;
    width: 100% !important;
    min-width: 100% !important; /* Force l'utilisation de toute la largeur */
    box-sizing: border-box;
    padding: 0 !important; /* Pas de padding horizontal qui limite */
  }
  
  .jobs-page-wrapper-light .btn-primary-xl {
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
    color: white;
    border: none;
    padding: 1.25rem 3.5rem;
    font-size: 1.125rem;
    font-weight: 600;
    border-radius: var(--radius-lg);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.25);
    position: relative;
    overflow: hidden;
    text-decoration: none;
  }
  
  .jobs-page-wrapper-light .btn-primary-xl::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.7s ease;
  }
  
  .jobs-page-wrapper-light .btn-primary-xl:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(59, 130, 246, 0.35);
  }
  
  .jobs-page-wrapper-light .btn-primary-xl:hover::before {
    left: 100%;
  }
  
  /* ===== SECTION RITUEL PREMIUM - UTILISE TOUTE LA LARGEUR ===== */
  .jobs-page-wrapper-light .ritual-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-2xl);
    padding: 4rem 2rem; /* Padding horizontal réduit pour utiliser toute la largeur */
    margin: 4rem 0 5rem 0 !important; /* Espacement premium */
    margin-left: 0 !important;
    margin-right: 0 !important;
    position: relative;
    overflow: visible; /* Permet au contenu de s'étendre */
    max-width: 100% !important; /* Utilise toute la largeur */
    width: 100% !important;
    box-sizing: border-box;
    min-width: 100% !important; /* Force l'utilisation de toute la largeur */
  }
  
  .jobs-page-wrapper-light .ritual-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--primary-light), transparent);
  }
  
  .jobs-page-wrapper-light .ritual-header {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    margin-bottom: 2.5rem;
  }
  
  .jobs-page-wrapper-light .ritual-badge {
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color: white;
    padding: 0.625rem 1.75rem;
    border-radius: 100px;
    font-weight: 600;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
    letter-spacing: 0.02em;
  }
  
  .jobs-page-wrapper-light .ritual-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-primary);
  }
  
  .jobs-page-wrapper-light .ritual-intro {
    color: var(--text-secondary);
    font-size: 1.125rem;
    margin-bottom: 3rem;
    line-height: 1.7;
    max-width: 100% !important; /* Utilise toute la largeur disponible */
    width: 100% !important;
    min-width: 100% !important; /* Force l'utilisation de toute la largeur */
  }
  
  /* Grid ritual - 2 colonnes égales sur toute la largeur */
  .jobs-page-wrapper-light .ritual-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr) !important; /* 2 colonnes égales qui utilisent toute la largeur */
    gap: 2rem;
    width: 100% !important;
    min-width: 100% !important; /* Force l'utilisation de toute la largeur */
    box-sizing: border-box;
    max-width: 100% !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
  }
  
  /* Garantir que les cartes ritual utilisent toute la largeur de leur colonne */
  .jobs-page-wrapper-light .ritual-card {
    min-width: 0;
    max-width: 100%;
    width: 100% !important; /* Utilise toute la largeur de la colonne */
    box-sizing: border-box;
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-md);
    overflow: hidden; /* Empêche débordement interne */
  }
  
  .jobs-page-wrapper-light .ritual-card:hover {
    transform: translateY(-4px);
    border-color: var(--primary-light);
    box-shadow: var(--shadow-lg);
  }
  
  .jobs-page-wrapper-light .ritual-icon {
    width: 64px;
    height: 64px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.75rem;
    font-size: 1.75rem;
  }
  
  .jobs-page-wrapper-light .ritual-card.online .ritual-icon {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
    color: var(--primary);
  }
  
  .jobs-page-wrapper-light .ritual-card.offline .ritual-icon {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
    color: var(--accent);
  }
  
  .jobs-page-wrapper-light .ritual-card h4 {
    font-size: 1.375rem;
    margin-bottom: 0.75rem;
    color: var(--text-primary);
    font-weight: 700;
  }
  
  .jobs-page-wrapper-light .ritual-mode {
    color: var(--text-secondary);
    font-size: 0.95rem;
    margin-bottom: 2rem;
    font-weight: 500;
  }
  
  .jobs-page-wrapper-light .ritual-process {
    display: flex;
    align-items: center;
    justify-content: space-around;
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    margin-top: 1.5rem;
    border: 1px solid var(--border-light);
  }
  
  .jobs-page-wrapper-light .process-step {
    text-align: center;
    flex: 1;
  }
  
  .jobs-page-wrapper-light .process-time {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--primary);
    display: block;
    margin-bottom: 0.25rem;
  }
  
  .jobs-page-wrapper-light .ritual-card.offline .process-time {
    color: var(--accent);
  }
  
  .jobs-page-wrapper-light .process-label {
    font-size: 0.875rem;
    color: var(--text-tertiary);
    font-weight: 500;
  }
  
  .jobs-page-wrapper-light .process-plus {
    color: var(--text-tertiary);
    font-size: 1.5rem;
    font-weight: 300;
    padding: 0 1rem;
  }
  
  /* ===== SIDEBAR (30%) - DROITE - PREMIUM CARD AVEC SCROLL ===== */
  .jobs-page-wrapper-light .sidebar {
    padding: 2.5rem 10px 2.5rem 2rem !important; /* Padding vertical + 1cm (10px) à droite, padding gauche normal */
    background: var(--bg-card) !important; /* Fond card premium */
    border: 1px solid var(--border-light) !important; /* Bordure légère */
    border-radius: var(--radius-xl) !important; /* Radius premium */
    box-shadow: var(--shadow-md) !important; /* Shadow subtile premium */
    position: sticky !important; /* Sticky pour rester visible au scroll */
    top: 2rem !important; /* Top réduit pour plus d'espace */
    width: 100% !important; /* Largeur naturelle (30% du grid) */
    min-width: 0 !important; /* Permet au grid de gérer */
    max-width: 100% !important; /* Pas de limite */
    min-height: 0 !important; /* Permet le scroll */
    height: calc(100vh - 4rem) !important; /* Hauteur adaptée à la fenêtre */
    max-height: calc(100vh - 4rem) !important; /* Max height pour activer le scroll */
    overflow-y: auto !important; /* Scroll vertical pour voir tous les indicateurs */
    overflow-x: hidden !important;
    box-sizing: border-box !important;
    grid-column: 2 !important; /* Deuxième colonne (droite) */
    align-self: start !important; /* Alignement en haut */
  }
  
  /* S'assurer que le contenu de la sidebar peut scroller */
  .jobs-page-wrapper-light .sidebar .nav-section,
  .jobs-page-wrapper-light .sidebar .stats-section,
  .jobs-page-wrapper-light .sidebar .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important; /* Empêche la compression */
  }
  
  /* Style de la scrollbar pour un rendu premium - ÉPAISSE */
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important; /* Scrollbar plus épaisse (12px au lieu de 6px) */
  }
  
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 10px;
    margin: 8px 0; /* Espacement vertical pour un meilleur rendu */
  }
  
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 10px;
    border: 2px solid var(--bg-secondary); /* Bordure pour un meilleur contraste */
  }
  
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }
  
  /* Support Firefox */
  .jobs-page-wrapper-light .sidebar {
    scrollbar-width: thick !important; /* Scrollbar épaisse pour Firefox */
    scrollbar-color: var(--border) var(--bg-secondary) !important;
  }
  
  /* ===== NAVIGATION - CORRECTION LAYOUT FLEXBOX ===== */
  .jobs-page-wrapper-light .nav-section {
    margin-bottom: 3.5rem !important;
    width: 100% !important;
    box-sizing: border-box !important;
    position: relative !important;
    z-index: 1 !important; /* Z-index cohérent */
    overflow: visible !important;
  }
  
  .jobs-page-wrapper-light .nav-title {
    font-size: 0.75rem !important;
    text-transform: uppercase !important;
    letter-spacing: 1.5px !important;
    color: var(--text-tertiary) !important;
    margin-bottom: 1.5rem !important;
    margin-top: 0 !important;
    font-weight: 600 !important;
    width: 100% !important;
    box-sizing: border-box !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
  }
  
  /* ===== NAV-LIST - FLEXBOX COLONNE CORRIGÉ ===== */
  .jobs-page-wrapper-light .nav-list {
    display: flex !important;
    flex-direction: column !important;
    gap: 0.5rem !important;
    width: 100% !important;
    box-sizing: border-box !important;
    position: relative !important;
    z-index: 1 !important;
    overflow: visible !important;
    /* Empêcher le wrap et garantir l'alignement vertical */
    flex-wrap: nowrap !important;
    align-items: stretch !important;
  }
  
  /* ===== NAV-ITEM - CORRECTION COMPLÈTE ===== */
  .jobs-page-wrapper-light .nav-item {
    display: flex !important;
    flex-direction: row !important; /* Alignement horizontal icon + texte */
    align-items: center !important; /* Alignement vertical centré */
    justify-content: flex-start !important; /* Alignement à gauche */
    gap: 1rem !important; /* Espacement entre icon et texte */
    padding: 1rem 1.25rem !important;
    border-radius: var(--radius-md) !important;
    color: var(--text-secondary) !important;
    text-decoration: none !important;
    transition: all 0.2s ease !important;
    font-weight: 500 !important;
    min-height: 56px !important;
    max-height: none !important; /* Pas de limite de hauteur */
    line-height: 1.5 !important;
    overflow: visible !important;
    position: relative !important; /* Relative pour les pseudo-éléments */
    z-index: 1 !important; /* Z-index cohérent */
    width: 100% !important;
    box-sizing: border-box !important;
    /* Empêcher le débordement de texte */
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    white-space: normal !important;
    /* Empêcher toute superposition */
    margin: 0 !important;
    float: none !important;
    clear: both !important;
  }
  
  /* État hover - sans transform pour éviter décalage */
  .jobs-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05) !important;
    color: var(--primary) !important;
    /* Transform retiré pour éviter problèmes d'alignement */
    padding-left: 1.5rem !important; /* Animation subtile via padding */
  }
  
  /* État actif */
  .jobs-page-wrapper-light .nav-item.active {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%) !important;
    color: var(--primary) !important;
    font-weight: 600 !important;
    border-left: 3px solid var(--primary) !important;
    padding-left: calc(1.25rem - 3px) !important; /* Compenser le border */
  }
  
  /* ===== NAV-ICON - CORRECTION EMOJIS ===== */
  .jobs-page-wrapper-light .nav-icon {
    font-size: 1.5rem !important;
    width: 40px !important;
    min-width: 40px !important; /* Largeur minimale garantie */
    max-width: 40px !important; /* Largeur maximale pour éviter expansion */
    height: 40px !important;
    min-height: 40px !important;
    max-height: 40px !important;
    text-align: center !important;
    opacity: 0.8 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    line-height: 1 !important;
    overflow: visible !important;
    flex-shrink: 0 !important; /* Ne jamais rétrécir */
    flex-grow: 0 !important; /* Ne jamais grandir */
    padding: 0 !important; /* Pas de padding qui pourrait causer débordement */
    margin: 0 !important;
    vertical-align: middle !important;
    font-family: 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji', sans-serif !important;
    font-style: normal !important;
    font-variant: normal !important;
    text-rendering: auto !important;
    -webkit-font-smoothing: antialiased !important;
    position: relative !important;
    z-index: 2 !important; /* Z-index légèrement supérieur pour être au-dessus */
    box-sizing: border-box !important; /* Border-box pour dimensions précises */
    /* Empêcher le débordement d'emoji */
    text-overflow: clip !important;
    white-space: nowrap !important; /* Emoji sur une seule ligne */
    word-wrap: normal !important;
  }
  
  /* Texte à côté de l'icon */
  .jobs-page-wrapper-light .nav-item > span:not(.nav-icon) {
    flex: 1 !important; /* Prend l'espace disponible */
    min-width: 0 !important; /* Permet le shrink si nécessaire */
    overflow: hidden !important;
    text-overflow: ellipsis !important; /* Ellipsis si texte trop long */
    white-space: nowrap !important; /* Texte sur une ligne */
    word-wrap: normal !important;
    line-height: 1.5 !important;
  }
  
  /* Stats compactes */
  .jobs-page-wrapper-light .stats-section {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-bottom: 2.5rem;
    box-shadow: var(--shadow-sm);
  }
  
  .jobs-page-wrapper-light .stats-title {
    font-size: 1.125rem;
    font-weight: 700;
    margin-bottom: 1.75rem;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  
  .jobs-page-wrapper-light .stats-grid {
    display: grid;
    gap: 1.25rem;
  }
  
  .jobs-page-wrapper-light .stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-light);
  }
  
  .jobs-page-wrapper-light .stat-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }
  
  .jobs-page-wrapper-light .stat-label {
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
  }
  
  .jobs-page-wrapper-light .stat-value {
    font-weight: 700;
    font-size: 1.25rem;
    color: var(--text-primary);
  }
  
  .jobs-page-wrapper-light .stat-value.highlight {
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
  }
  
  /* Conseils */
  .jobs-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-top: 2.5rem;
  }
  
  .jobs-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
  }
  
  .jobs-page-wrapper-light .tip-icon {
    color: var(--accent);
    font-size: 1.25rem;
  }
  
  .jobs-page-wrapper-light .tip-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary);
  }
  
  .jobs-page-wrapper-light .tip-content {
    color: var(--text-secondary);
    font-size: 0.875rem;
    line-height: 1.6;
  }
  
  /* ===== RESPONSIVE ===== */
  @media (max-width: 1200px) {
    .jobs-page-wrapper-light {
      padding: 10px !important; /* Décalage de 1cm (10px) sur tous les bords */
    }
    
    .jobs-page-wrapper-light .dashboard-container {
      grid-template-columns: 70% 30% !important; /* Maintien du ratio 70/30 */
      gap: 0 10px !important; /* Gap de 1cm maintenu */
    }
    
    .jobs-page-wrapper-light .main-content {
      padding: 3rem 10px !important; /* Padding vertical + 1cm de chaque côté */
      max-width: none !important;
      min-width: 0 !important; /* Permet au grid de gérer */
    }
    
    .jobs-page-wrapper-light .sidebar {
      padding: 2.5rem 10px 2.5rem 2rem !important; /* Padding avec 1cm à droite */
    }
    
    .jobs-page-wrapper-light .workflow-section {
      max-width: none !important;
      width: 100% !important;
      padding: 0 !important; /* Pas de padding, utilise toute la largeur */
    }
    
    .jobs-page-wrapper-light .ritual-section {
      padding: 3.5rem 0 !important; /* Padding vertical uniquement */
    }
  }
  
  @media (max-width: 1024px) {
    .jobs-page-wrapper-light {
      padding: 10px !important; /* Décalage de 1cm (10px) sur tous les bords */
    }
    
    .jobs-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important; /* Une seule colonne sur mobile */
      gap: 10px 0 !important; /* Gap vertical de 1cm entre contenu et sidebar */
      margin: 0 !important;
      width: 100% !important;
      max-width: none !important;
    }
    
    .jobs-page-wrapper-light .main-content {
      border-right: none !important;
      padding: 2rem 10px !important; /* Padding vertical + 1cm de chaque côté */
      overflow-x: visible !important; /* Permet au contenu de s'étendre */
      grid-column: 1 !important; /* Pleine largeur sur mobile */
    }
    
    .jobs-page-wrapper-light .sidebar {
      position: static !important; /* Plus de sticky sur mobile */
      top: auto !important;
      width: 100% !important;
      min-width: 100% !important;
      max-width: 100% !important;
      height: auto !important;
      max-height: none !important;
      padding: 2.5rem 10px !important; /* Padding avec 1cm de chaque côté sur mobile */
      grid-column: 1 !important; /* Même colonne que le contenu */
    }
    
    .jobs-page-wrapper-light .empty-state {
      max-width: 100% !important; /* Pleine largeur sur mobile */
    }
    
    .jobs-page-wrapper-light .page-header h1 {
      font-size: 2.25rem !important; /* Taille mobile adaptée */
    }
    
    .jobs-page-wrapper-light .page-subtitle {
      font-size: 1.125rem !important; /* Taille mobile adaptée */
    }
    
    .jobs-page-wrapper-light .empty-state-title {
      font-size: 2rem !important; /* Taille mobile adaptée */
    }
    
    .jobs-page-wrapper-light .empty-state-description {
      font-size: 1.125rem !important; /* Taille mobile adaptée */
    }
    
    .jobs-page-wrapper-light .ritual-section {
      padding: 2.5rem 1rem !important; /* Padding mobile réduit pour utiliser toute la largeur */
    }
    
    /* Sidebar devient statique sur tablette/mobile */
    .jobs-page-wrapper-light .sidebar {
      position: static !important;
      right: auto !important; /* Plus de position fixe à droite */
      width: 100% !important;
      height: auto !important;
      display: block !important;
      padding: 2rem 1.5rem !important;
      overflow-x: hidden !important;
      z-index: auto !important;
      /* Empêcher toute superposition */
      isolation: auto !important;
      grid-column: 1 !important; /* Pleine largeur sur mobile */
    }
    
    /* Navigation reste fonctionnelle en responsive */
    .jobs-page-wrapper-light .nav-section {
      margin-bottom: 2.5rem !important;
    }
    
    .jobs-page-wrapper-light .nav-list {
      gap: 0.75rem !important; /* Espacement légèrement augmenté */
    }
    
    .jobs-page-wrapper-light .nav-item {
      min-height: 52px !important; /* Légèrement réduit sur mobile */
      padding: 0.875rem 1rem !important;
    }
    
    .jobs-page-wrapper-light .nav-icon {
      width: 36px !important;
      min-width: 36px !important;
      max-width: 36px !important;
      height: 36px !important;
      min-height: 36px !important;
      max-height: 36px !important;
      font-size: 1.25rem !important;
    }
    
    .jobs-page-wrapper-light .ritual-grid {
      grid-template-columns: 1fr !important;
    }
    
    .jobs-page-wrapper-light .workflow-section {
      padding: 3rem 1rem !important;
    }
    
    .jobs-page-wrapper-light .workflow-title {
      font-size: 2rem !important; /* 32px mobile */
    }
  }
  
  @media (max-width: 768px) {
    .jobs-page-wrapper-light .page-header h1 {
      font-size: 2.25rem;
    }
    
    .jobs-page-wrapper-light .empty-state-title {
      font-size: 2rem;
    }
    
    .jobs-page-wrapper-light .main-content {
      padding: 1.5rem 1rem !important; /* Padding horizontal réduit */
    }
    
    /* Sidebar mobile - corrections supplémentaires */
    .jobs-page-wrapper-light .sidebar {
      padding: 1.5rem 1rem !important;
    }
    
    .jobs-page-wrapper-light .nav-section {
      margin-bottom: 2rem !important;
    }
    
    .jobs-page-wrapper-light .nav-item {
      min-height: 48px !important;
      padding: 0.75rem 0.875rem !important;
      gap: 0.875rem !important;
    }
    
    .jobs-page-wrapper-light .nav-icon {
      width: 32px !important;
      min-width: 32px !important;
      max-width: 32px !important;
      height: 32px !important;
      min-height: 32px !important;
      max-height: 32px !important;
      font-size: 1.125rem !important;
    }
    
    /* Texte des onglets sur mobile */
    .jobs-page-wrapper-light .nav-item > span:not(.nav-icon) {
      font-size: 0.9375rem !important; /* Légèrement réduit */
    }
    
    .jobs-page-wrapper-light .workflow-section {
      padding: 2.5rem 1rem !important;
      margin: 3rem 0 !important;
    }
    
    .jobs-page-wrapper-light .workflow-title {
      font-size: 1.75rem !important; /* 28px mobile */
      margin-bottom: 2rem !important;
    }
    
    .jobs-page-wrapper-light .workflow-grid {
      gap: 0 !important; /* Gap géré par margin sur mobile */
    }
    
    .jobs-page-wrapper-light .workflow-grid {
      grid-template-columns: 1fr !important; /* 1 colonne sur mobile */
      gap: 1.5rem !important;
    }
    
    .jobs-page-wrapper-light .workflow-card {
      width: 100% !important;
      min-height: 300px !important; /* Légèrement réduit sur mobile */
      padding: 24px !important;
    }
    
    .jobs-page-wrapper-light .ritual-section {
      padding: 2rem 1rem !important; /* Padding horizontal réduit */
    }
    
    .jobs-page-wrapper-light .ritual-card {
      padding: 1.75rem !important;
    }
  }
  
  @media (max-width: 640px) {
    .jobs-page-wrapper-light .workflow-section {
      padding: 2rem 1rem;
    }
    
    .jobs-page-wrapper-light .workflow-title {
      font-size: 1.5rem; /* 24px très petit mobile */
    }
  }
</style>

<script>
  // ===== SCRIPT DE FALLBACK POUR CSS GRID =====
  // Ce script garantit que CSS Grid fonctionne même si les media queries CSS échouent
  // Il sert aussi de fallback pour les navigateurs très anciens
  
  (function() {
    'use strict';
    
    function initWorkflowGrid() {
      const grid = document.querySelector('.jobs-page-wrapper-light .workflow-grid');
      if (!grid) return;
      
      // S'assurer que CSS Grid est activé
      const computedStyle = window.getComputedStyle(grid);
      if (computedStyle.display !== 'grid') {
        grid.style.display = 'grid';
        grid.style.width = '100%';
        grid.style.maxWidth = '100%';
        grid.style.minWidth = '100%';
      }
      
      function updateLayout() {
        const width = window.innerWidth;
        
        // Réinitialiser les styles inline
        grid.style.gridTemplateColumns = '';
        grid.style.gap = '';
        
        if (width >= 1024) {
          // Desktop : 3 colonnes égales qui utilisent toute la largeur
          grid.style.gridTemplateColumns = 'repeat(3, minmax(0, 1fr))';
          grid.style.gap = '2rem';
        } else if (width >= 768) {
          // Tablette : 2 colonnes
          grid.style.gridTemplateColumns = 'repeat(2, minmax(0, 1fr))';
          grid.style.gap = '2rem';
        } else {
          // Mobile : 1 colonne
          grid.style.gridTemplateColumns = '1fr';
          grid.style.gap = '1.5rem';
        }
        
        // S'assurer que la largeur est toujours à 100%
        grid.style.width = '100%';
        grid.style.maxWidth = '100%';
        grid.style.minWidth = '100%';
      }
      
      // Exécuter au chargement
      updateLayout();
      
      // Exécuter au redimensionnement (avec debounce pour performance)
      let resizeTimeout;
      window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
          updateLayout();
        }, 150);
      });
      
      // Observer les changements de taille du conteneur (plus robuste)
      if (window.ResizeObserver) {
        const resizeObserver = new ResizeObserver(function(entries) {
          updateLayout();
        });
        resizeObserver.observe(grid);
      }
    }
    
    // Attendre que le DOM soit chargé
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initWorkflowGrid);
    } else {
      initWorkflowGrid();
    }
  })();
</script>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\dashboard\tabs\jobs.blade.php ENDPATH**/ ?>