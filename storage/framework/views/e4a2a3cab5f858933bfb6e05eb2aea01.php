<?php
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'requests';
  
  // Simuler des données de demandes (à remplacer par les vraies données du contrôleur)
  $hasRequests = false; // À remplacer par la logique réelle : count($requests) > 0
  $requests = []; // À remplacer par les vraies données
?>

<div class="requests-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Bloc Tableau de bord Freelance -->
      <?php echo $__env->make('frontend.freelance.dashboard.partials.dashboard-header-section', [
        'freelancerProfile' => $freelancerProfile ?? null
      ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

      <!-- Header de page -->
  <div class="page-header">
      <h1>Demandes</h1>
        <p class="page-subtitle">
          Opportunités correspondant à votre expertise et votre disponibilité
        </p>
  </div>

      <!-- Contenu principal -->
      <div class="requests-page">
    <!-- ÉTAT AVEC DEMANDES (futur état) -->
    <div class="requests-container" style="display: <?php echo e($hasRequests ? 'block' : 'none'); ?>;">
      <div class="filter-bar">
        <div class="filter-tabs">
          <button class="filter-tab active">Nouvelles (2)</button>
          <button class="filter-tab">En attente (1)</button>
          <button class="filter-tab">Archivées (4)</button>
        </div>
        <div class="sort-select">
          <span>Tri :</span>
          <select>
            <option>Plus récentes</option>
            <option>Budget (haut → bas)</option>
            <option>Pertinence</option>
          </select>
        </div>
      </div>

      <div class="requests-grid">
        <!-- CARTE DE DEMANDE - EXEMPLE -->
        <div class="request-card new">
          <div class="request-header">
            <span class="badge new">NOUVEAU</span>
            <span class="budget">2 500 - 4 000 €</span>
          </div>
          <h3 class="request-title">Refonte de l'identité visuelle pour une marque de slow fashion</h3>
          <p class="request-description">Recherche d'un designer pour créer une identité complète (logo, palette, typographie) inspirée du minimalisme japonais...</p>
          
          <div class="request-meta">
            <div class="client-info">
              <div class="client-avatar">MB</div>
              <div>
                <p class="client-name">Maison Blanc</p>
                <p class="client-location">Paris • Depuis 2018</p>
              </div>
            </div>
            <div class="request-tags">
              <span class="tag">Identité visuelle</span>
              <span class="tag">Logo</span>
              <span class="tag">Minimalisme</span>
            </div>
          </div>
          
          <div class="request-actions">
            <button class="btn-outline">Décliner</button>
            <button class="btn-primary">Consulter la demande</button>
          </div>
          <div class="request-footer">
            <span class="time">Reçue il y a 2 heures</span>
            <span class="match">95% de correspondance</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ÉTAT SANS DEMANDES (état actuel) -->
    <div class="empty-state refined" style="display: <?php echo e($hasRequests ? 'none' : 'block'); ?>;">
      <div class="empty-state-illustration">
        <!-- Photo d'illustration avec flèche -->
        <div class="illustration-container">
          <div class="illustration-image-wrapper">
            <img 
              src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=600&h=420&fit=crop&q=90" 
              alt="Opportunités professionnelles" 
              class="illustration-image"
              loading="lazy"
            />
            <div class="illustration-overlay"></div>
          </div>
          <div class="illustration-arrow">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 15L20 25L30 15" stroke="#6C8CFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>
      
      <div class="empty-state-content">
        <h2>Votre espace opportunités est prêt</h2>
        <p class="empty-state-description">
          Les demandes correspondant à vos services et votre profil apparaîtront ici. 
          <br>Un profil optimisé vous positionne en tête des résultats.
        </p>
        
        <div class="empty-state-stats">
          <div class="stat-card">
            <div class="stat-value">+40%</div>
            <div class="stat-label">Visibilité avec un profil complet</div>
          </div>
          <div class="stat-card">
            <div class="stat-value">3x</div>
            <div class="stat-label">Plus de demandes qualifiées</div>
          </div>
        </div>
        
        <div class="empty-state-actions">
          <a href="<?php echo e(route('freelance.services.create')); ?>" class="btn-primary-large">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 4V16M4 10H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Créer un service
          </a>
          <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'profile'])); ?>" class="btn-refined">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 2L12.5 7.5L18 8.5L14 12.5L15 18L10 15L5 18L6 12.5L2 8.5L7.5 7.5L10 2Z" fill="currentColor"/>
            </svg>
            Optimiser mon profil
          </a>
        </div>
        
        <div class="empty-state-tip">
          <div class="tip-icon">💡</div>
          <p>
            <strong>Conseil premium :</strong> Des services bien détaillés avec des livrables clairs 
            attirent des clients mieux informés et réduisent les questions préalables.
          </p>
            </div>
        </div>
      </div>
    </div>
  </main>

    <!-- ===== SIDEBAR (30%) - LIGHT ===== -->
    <?php echo $__env->make('frontend.freelance.dashboard.partials.dashboard-sidebar-section', [
      'activeTab' => $activeTab ?? 'requests'
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
</div>


<?php echo $__env->make('frontend.freelance.dashboard.partials.dashboard-shell-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<style>
  /* ===== STYLES SPÉCIFIQUES À L'ONGLET DEMANDES ===== */
  /* Les styles communs sont dans dashboard-shell-styles.blade.php */
  
  /* ===== BLOC TABLEAU DE BORD FREELANCE ===== */
  .requests-page-wrapper-light .dashboard-header {
    margin-top: 2cm !important;
    margin-left: 2cm !important;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }

  .requests-page-wrapper-light .dashboard-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
  }

  .requests-page-wrapper-light .dashboard-header-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin-bottom: 1.25rem;
    line-height: 1.5;
  }

  .requests-page-wrapper-light .dashboard-header-ctas {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .requests-page-wrapper-light .btn-premium {
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

  .requests-page-wrapper-light .btn-premium-primary {
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .requests-page-wrapper-light .btn-premium-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    color: white;
    text-decoration: none;
  }

  .requests-page-wrapper-light .btn-premium-secondary {
    background: white;
    color: #1e40af;
    border: 2px solid #1e40af;
  }

  .requests-page-wrapper-light .btn-premium-secondary:hover {
    background: #f8fafc;
    transform: translateY(-1px);
    color: #1e40af;
    text-decoration: none;
  }

  /* ===== RESET ET VARIABLES LIGHT ===== */
  .requests-page-wrapper-light {
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
  
  .requests-page-wrapper-light * {
    box-sizing: border-box;
  }
  
  .requests-page-wrapper-light {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    min-height: 100vh;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT ===== */
  .requests-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite */
    box-sizing: border-box;
  }
  
  .requests-page-wrapper-light .dashboard-container {
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
  .requests-page-wrapper-light .main-content {
    padding: 4rem 10px !important; /* Padding vertical + 1cm (10px) de chaque côté */
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
  .requests-page-wrapper-light .page-header {
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
  
  .requests-page-wrapper-light .page-header::after {
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
  
  .requests-page-wrapper-light .page-header h1 {
    font-size: 3rem !important; /* 48px desktop - MÊME TAILLE QUE PRESTATIONS */
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
  
  .requests-page-wrapper-light .page-subtitle {
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
  
  /* ===== CONTENU PRINCIPAL ===== */
  .requests-page-wrapper-light .requests-page {
    min-height: 400px;
    width: 100% !important;
    max-width: 100% !important;
  }

  /* Filter Bar */
  .requests-page-wrapper-light .filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    flex-wrap: wrap;
    gap: 1rem;
  }

  .requests-page-wrapper-light .filter-tabs {
    display: flex;
    gap: 0.5rem;
  }

  .requests-page-wrapper-light .filter-tab {
    padding: 0.625rem 1.25rem;
    font-size: 0.9rem;
    font-weight: 500;
    color: #6b7280;
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .requests-page-wrapper-light .filter-tab:hover {
    background: rgba(124, 58, 237, 0.08);
    color: #7c3aed;
    border-color: rgba(124, 58, 237, 0.2);
  }

  .requests-page-wrapper-light .filter-tab.active {
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .requests-page-wrapper-light .sort-select {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #6b7280;
  }

  .requests-page-wrapper-light .sort-select select {
    padding: 0.5rem 1rem;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 8px;
    background: white;
    color: #111827;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .requests-page-wrapper-light .sort-select select:hover {
    border-color: rgba(124, 58, 237, 0.2);
  }

  /* Requests Grid */
  .requests-page-wrapper-light .requests-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 1.5rem;
  }

  /* Request Card */
  .requests-page-wrapper-light .request-card {
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: 16px;
    padding: 1.5rem;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  }

  .requests-page-wrapper-light .request-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(108, 140, 255, 0.1);
  }

  .requests-page-wrapper-light .request-card.new {
    border-color: rgba(124, 58, 237, 0.2);
    background: linear-gradient(to bottom, rgba(124, 58, 237, 0.02), white);
  }

  .requests-page-wrapper-light .request-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
  }

  .requests-page-wrapper-light .badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 12px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .requests-page-wrapper-light .badge.new {
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
  }

  .requests-page-wrapper-light .budget {
    font-size: 0.9rem;
    font-weight: 600;
    color: #10b981;
  }

  .requests-page-wrapper-light .request-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #111827;
    margin: 0 0 0.75rem 0;
    line-height: 1.4;
  }

  .requests-page-wrapper-light .request-description {
    font-size: 0.9rem;
    color: #6b7280;
    line-height: 1.6;
    margin: 0 0 1.25rem 0;
  }

  .requests-page-wrapper-light .request-meta {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.25rem;
  }

  .requests-page-wrapper-light .client-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .requests-page-wrapper-light .client-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    flex-shrink: 0;
  }

  .requests-page-wrapper-light .client-name {
    font-size: 0.95rem;
    font-weight: 600;
    color: #111827;
    margin: 0 0 0.25rem 0;
  }

  .requests-page-wrapper-light .client-location {
    font-size: 0.85rem;
    color: #6b7280;
    margin: 0;
  }

  .requests-page-wrapper-light .request-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
  }

  .requests-page-wrapper-light .tag {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
    color: #7c3aed;
    background: rgba(124, 58, 237, 0.1);
    border-radius: 8px;
  }

  .requests-page-wrapper-light .request-actions {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }

  .requests-page-wrapper-light .btn-outline {
    flex: 1;
    padding: 0.625rem 1.25rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: #6b7280;
    background: white;
    border: 1.5px solid rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .requests-page-wrapper-light .btn-outline:hover {
    background: #f8fafc;
    border-color: rgba(0, 0, 0, 0.2);
  }

  .requests-page-wrapper-light .btn-primary {
    flex: 1;
    padding: 0.625rem 1.25rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: white;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
    text-align: center;
  }

  .requests-page-wrapper-light .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .requests-page-wrapper-light .request-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    font-size: 0.85rem;
    color: #9ca3af;
  }

  .requests-page-wrapper-light .match {
    color: #10b981;
    font-weight: 600;
  }

  /* Empty State */
  .requests-page-wrapper-light .empty-state.refined {
    text-align: center;
    padding: 3rem 2rem;
    width: 100% !important;
    max-width: 100% !important;
  }

  .requests-page-wrapper-light .empty-state-illustration {
    margin-bottom: 2rem;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .requests-page-wrapper-light .illustration-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
  }

  .requests-page-wrapper-light .illustration-image-wrapper {
    position: relative;
    width: 400px;
    height: 280px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(108, 140, 255, 0.15);
    border: 2px solid rgba(108, 140, 255, 0.2);
    background: linear-gradient(135deg, rgba(30, 64, 175, 0.05) 0%, rgba(124, 58, 237, 0.05) 100%);
  }

  .requests-page-wrapper-light .illustration-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .requests-page-wrapper-light .illustration-image-wrapper:hover .illustration-image {
    transform: scale(1.05);
  }

  .requests-page-wrapper-light .illustration-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(108, 140, 255, 0.1) 0%, rgba(108, 140, 255, 0.05) 50%, transparent 100%);
    pointer-events: none;
  }

  .requests-page-wrapper-light .illustration-arrow {
    display: flex;
    align-items: center;
    justify-content: center;
    animation: bounce 2s infinite;
  }

  @keyframes bounce {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-8px);
    }
  }

  .requests-page-wrapper-light .empty-state-content h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 1rem 0;
  }

  .requests-page-wrapper-light .empty-state-description {
    font-size: 0.95rem;
    color: #6b7280;
    line-height: 1.6;
    margin: 0 0 2rem 0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
  }

  .requests-page-wrapper-light .empty-state-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
  }

  .requests-page-wrapper-light .stat-card {
    text-align: center;
  }

  .requests-page-wrapper-light .stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: #7c3aed;
    margin-bottom: 0.5rem;
  }

  .requests-page-wrapper-light .stat-label {
    font-size: 0.85rem;
    color: #6b7280;
  }

  .requests-page-wrapper-light .empty-state-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
  }

  .requests-page-wrapper-light .btn-primary-large {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: white;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    border-radius: 12px;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    transition: all 0.2s ease;
  }

  .requests-page-wrapper-light .btn-primary-large:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
  }

  .requests-page-wrapper-light .btn-refined {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: #7c3aed;
    background: white;
    border: 1.5px solid #7c3aed;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .requests-page-wrapper-light .btn-refined:hover {
    background: rgba(124, 58, 237, 0.05);
    transform: translateY(-1px);
  }

  .requests-page-wrapper-light .empty-state-tip {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    max-width: 600px;
    margin: 0 auto;
    padding: 1.25rem;
    background: rgba(124, 58, 237, 0.05);
    border-radius: 12px;
    text-align: left;
  }

  .requests-page-wrapper-light .tip-icon {
    font-size: 1.25rem;
    flex-shrink: 0;
  }

  .requests-page-wrapper-light .empty-state-tip p {
    font-size: 0.9rem;
    color: #374151;
    margin: 0;
    line-height: 1.6;
  }

  .requests-page-wrapper-light .empty-state-tip strong {
    color: #111827;
  }

  /* ===== SIDEBAR (30%) - DROITE - PREMIUM CARD AVEC SCROLL ===== */
  .requests-page-wrapper-light .sidebar {
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
  
  .requests-page-wrapper-light .sidebar .nav-section,
  .requests-page-wrapper-light .sidebar .stats-section,
  .requests-page-wrapper-light .sidebar .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
  }
  
  /* Style de la scrollbar pour un rendu premium - ÉPAISSE */
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important; /* Scrollbar épaisse (12px) */
  }
  
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 10px;
    margin: 8px 0;
  }
  
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 10px;
    border: 2px solid var(--bg-secondary);
  }
  
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }
  
  /* Support Firefox */
  .requests-page-wrapper-light .sidebar {
    scrollbar-width: thick !important;
    scrollbar-color: var(--border) var(--bg-secondary) !important;
  }
  
  /* ===== NAVIGATION ===== */
  .requests-page-wrapper-light .nav-section {
    margin-bottom: 3.5rem !important;
    width: 100% !important;
    box-sizing: border-box !important;
    position: relative !important;
    z-index: 1 !important;
    overflow: visible !important;
  }
  
  .requests-page-wrapper-light .nav-title {
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    color: var(--text-tertiary) !important;
    margin-bottom: 1.5rem !important;
    padding: 0 !important;
  }
  
  .requests-page-wrapper-light .nav-list {
    display: flex !important;
    flex-direction: column !important;
    gap: 0.75rem !important;
    width: 100% !important;
  }
  
  .requests-page-wrapper-light .nav-item {
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
  
  .requests-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05) !important;
    color: var(--primary) !important;
    border-color: rgba(59, 130, 246, 0.1) !important;
  }
  
  .requests-page-wrapper-light .nav-item.active {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%) !important;
    color: var(--primary) !important;
    border-color: var(--primary) !important;
    font-weight: 600 !important;
    }

  .requests-page-wrapper-light .nav-icon {
    font-size: 1.25rem !important;
    flex-shrink: 0 !important;
    width: 24px !important;
    text-align: center !important;
  }
  
  /* ===== STATISTIQUES ===== */
  .requests-page-wrapper-light .stats-section {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-bottom: 2.5rem;
    box-shadow: var(--shadow-sm);
  }
  
  .requests-page-wrapper-light .stats-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  
  .requests-page-wrapper-light .stats-title svg {
    color: var(--primary);
  }
  
  .requests-page-wrapper-light .stats-grid {
      display: grid;
    grid-template-columns: 1fr;
      gap: 1.5rem;
  }
  
  .requests-page-wrapper-light .stat-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .requests-page-wrapper-light .stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
  }
  
  .requests-page-wrapper-light .stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--primary);
    }

  .requests-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
  }
  
  /* ===== CONSEILS ===== */
  .requests-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-top: 2.5rem;
  }
  
  .requests-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .requests-page-wrapper-light .tip-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
  }
  
  .requests-page-wrapper-light .tip-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
  }
  
  .requests-page-wrapper-light .tip-content {
    font-size: 0.9rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
  }
  
  .requests-page-wrapper-light .tip-content strong {
    color: var(--text-primary);
    font-weight: 600;
  }
  
  /* ===== RESPONSIVE ===== */
  @media (max-width: 1200px) {
    .requests-page-wrapper-light {
      padding-inline: 10px !important;
    }
    
    .requests-page-wrapper-light .dashboard-container {
      grid-template-columns: 70% 30% !important;
      gap: 0 10px !important;
    }
    
    .requests-page-wrapper-light .main-content {
      padding: 3rem 10px !important;
    }
    
    .requests-page-wrapper-light .sidebar {
      padding: 2.5rem 10px 2.5rem 2rem !important;
    }
    
    .requests-page-wrapper-light .page-header h1 {
      font-size: 2.5rem !important; /* 40px tablette */
    }
  }
  
  @media (max-width: 1024px) {
    .requests-page-wrapper-light {
      padding-inline: 10px !important;
    }
    
    .requests-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 10px 0 !important;
    }
    
    .requests-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }
    
    .requests-page-wrapper-light .sidebar {
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
    
    .requests-page-wrapper-light .page-header h1 {
      font-size: 2rem !important; /* 32px mobile */
    }

    .requests-page-wrapper-light .requests-grid {
      grid-template-columns: 1fr;
    }

    .requests-page-wrapper-light .filter-bar {
      flex-direction: column;
      align-items: stretch;
    }

    .requests-page-wrapper-light .filter-tabs {
      flex-wrap: wrap;
    }

    .requests-page-wrapper-light .illustration-image-wrapper {
      width: 320px;
      height: 220px;
    }

    .requests-page-wrapper-light .empty-state-stats {
      flex-direction: column;
      gap: 1.5rem;
    }

    .requests-page-wrapper-light .empty-state-actions {
      flex-direction: column;
    }

    .requests-page-wrapper-light .btn-primary-large,
    .requests-page-wrapper-light .btn-refined {
      width: 100%;
      justify-content: center;
    }

    .requests-page-wrapper-light .nav-section {
      margin-bottom: 2.5rem !important;
    }

    .requests-page-wrapper-light .nav-list {
      gap: 0.75rem !important;
    }
    
    .requests-page-wrapper-light .nav-item {
      min-height: 52px !important;
      padding: 0.875rem 1rem !important;
    }
  }

  @media (max-width: 480px) {
    .requests-page-wrapper-light .illustration-image-wrapper {
      width: 280px;
      height: 190px;
    }
    
    .requests-page-wrapper-light .sidebar {
      padding: 1.5rem 1rem !important;
    }
    
    .requests-page-wrapper-light .nav-section {
      margin-bottom: 2rem !important;
    }
    
    .requests-page-wrapper-light .nav-item {
      min-height: 48px !important;
      padding: 0.75rem 0.875rem !important;
      gap: 0.875rem !important;
    }
    
    .requests-page-wrapper-light .nav-icon {
      font-size: 1.125rem !important;
    }
  }
</style>

<script>
  // Gestion de l'affichage des états (avec/sans demandes)
  document.addEventListener('DOMContentLoaded', function() {
    const requestsContainer = document.querySelector('.requests-container');
    const emptyState = document.querySelector('.empty-state.refined');
    
    // Cette logique sera remplacée par les vraies données du contrôleur
    <?php if($hasRequests): ?>
      if (requestsContainer) requestsContainer.style.display = 'block';
      if (emptyState) emptyState.style.display = 'none';
    <?php else: ?>
      if (requestsContainer) requestsContainer.style.display = 'none';
      if (emptyState) emptyState.style.display = 'block';
    <?php endif; ?>
  });
</script>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\dashboard\tabs\requests.blade.php ENDPATH**/ ?>