<?php
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'rituals';
?>

<div class="rituals-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Header de page -->
      <div class="page-header">
        <h1>Rituels Junspro</h1>
        <p class="page-subtitle">
          Une routine simple : 50 minutes de focus, puis 10 minutes de bilan — visible côté client.
        </p>
        <p class="page-subtitle" style="margin-top: 0.5rem; font-size: 1rem;">
          Le but n'est pas de "produire à la chaîne", mais d'installer une discipline douce qui évite la procrastination et les relances.
        </p>
      </div>

      <!-- Contenu principal -->
      <div class="content-section">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
          <!-- Carte A — "Démarrer un Rituel" -->
          <div class="premium-card">
            <h3 class="premium-card-title">Démarrer un Rituel</h3>
            <p class="premium-card-text">Lancez 50 minutes de focus. À la fin, un bilan guidé (10 min) est envoyé au client.</p>
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; margin-top: 1rem;">
              <a href="#" class="btn-premium btn-premium-primary">Démarrer un Rituel (50 min)</a>
              <a href="#" class="btn-premium btn-premium-secondary">Rédiger un bilan</a>
            </div>
            <p class="premium-card-microcopy">📌 Un bilan clair = un client rassuré, sans effort de relance.</p>
          </div>

          <!-- Carte B — "Reprogrammation (1 fois)" -->
          <div class="premium-card" style="background: #f0f9ff; border-color: rgba(30, 64, 175, 0.2);">
            <h3 class="premium-card-title">Reprogrammation (1 fois)</h3>
            <p class="premium-card-text">En cas d'imprévu, vous pouvez proposer UNE reprogrammation.</p>
            <div style="display: inline-block; padding: 0.5rem 1rem; background: rgba(30, 64, 175, 0.1); border-radius: 8px; font-size: 0.85rem; color: #1e40af; font-weight: 600; margin: 0.75rem 0;">
              Fenêtre autorisée : entre 24h et 72h après l'horaire initial.
            </div>
            <p class="premium-card-text" style="margin-top: 0.5rem;">L'annulation reste possible à tout moment.</p>
            <p class="premium-card-microcopy">Cette marge protège votre organisation et clarifie la suite pour le client.</p>
          </div>

          <!-- Carte C — "Visibilité (sanction naturelle)" -->
          <div class="premium-card">
            <h3 class="premium-card-title">Visibilité (sanction naturelle, sans menace)</h3>
            <p class="premium-card-text">Votre visibilité s'améliore quand vos engagements sont tenus et que vos bilans sont réguliers.</p>
            <p class="premium-card-text" style="margin-top: 0.5rem;">Des reports répétés peuvent réduire la mise en avant automatiquement.</p>
            <p class="premium-card-microcopy">🌿 Transparence + régularité = plus de confiance, donc plus de demandes.</p>
          </div>
        </div>

        <!-- Option IA -->
        <div style="margin-top: 2rem; padding: 1.5rem; background: #f8fafc; border-radius: 12px; border: 1px solid rgba(0, 0, 0, 0.06);">
          <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <a href="#" class="btn-premium btn-premium-primary" style="background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);">
              ✨ Générer un bilan avec l'IA
            </a>
            <span title="L'IA propose un brouillon : vous gardez le contrôle avant envoi." style="cursor: help; font-size: 0.85rem; color: #6b7280;">ℹ️</span>
          </div>
          <p style="font-size: 0.9rem; color: #6b7280; margin: 0;">Transforme vos notes en un bilan clair (fait → prochaine étape → délai).</p>
        </div>
      </div>
    </main>

    <!-- ===== SIDEBAR (30%) - LIGHT ===== -->
    <?php echo $__env->make('frontend.freelance.dashboard.partials.dashboard-sidebar-section', [
      'activeTab' => $activeTab ?? 'rituals'
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>
</div>


<?php echo $__env->make('frontend.freelance.dashboard.partials.dashboard-shell-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<style>
  /* ===== STYLES SPÉCIFIQUES À L'ONGLET RITUELS ===== */
  /* Les styles communs sont dans dashboard-shell-styles.blade.php */
  
  /* ===== RESET ET VARIABLES LIGHT ===== */
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
  
  .rituals-page-wrapper-light * {
    box-sizing: border-box;
  }
  
  .rituals-page-wrapper-light {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    min-height: 100vh;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT (Style identique à Demandes) ===== */
  .rituals-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite comme Demandes */
    box-sizing: border-box;
  }
  
  .rituals-page-wrapper-light .dashboard-container {
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
    display: flex;
    flex-direction: column;
  }
  
  /* ===== HEADER PREMIUM - CENTRÉ (Style identique à Demandes) ===== */
  .rituals-page-wrapper-light .page-header {
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
  
  .rituals-page-wrapper-light .page-header::after {
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
  
  .rituals-page-wrapper-light .page-header h1 {
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
  
  .rituals-page-wrapper-light .page-subtitle {
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
  .rituals-page-wrapper-light .content-section {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  
  /* ===== SIDEBAR (30%) ===== */
  .rituals-page-wrapper-light .sidebar {
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
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important;
  }
  
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 6px;
  }
  
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 6px;
  }
  
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }
  
  .rituals-page-wrapper-light .nav-section,
  .rituals-page-wrapper-light .stats-section,
  .rituals-page-wrapper-light .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
    margin-bottom: 2rem;
    padding-left: 10px !important; /* Décalage de 1cm (10px) vers la droite pour voir les icônes */
  }
  
  .rituals-page-wrapper-light .nav-title {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--text-tertiary);
    margin-bottom: 1.25rem;
    font-weight: 600;
  }
  
  .rituals-page-wrapper-light .nav-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .rituals-page-wrapper-light .nav-item {
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
  
  .rituals-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05);
    color: var(--primary);
    text-decoration: none;
  }
  
  .rituals-page-wrapper-light .nav-item.active {
    background: rgba(59, 130, 246, 0.1);
    color: var(--primary);
    font-weight: 600;
    border-left: 3px solid var(--primary);
  }
  
  .rituals-page-wrapper-light .nav-icon {
    font-size: 1.125rem;
    width: 24px;
    text-align: center;
  }
  
  .rituals-page-wrapper-light .stats-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .rituals-page-wrapper-light .stats-grid {
    display: grid;
    gap: 1rem;
  }
  
  .rituals-page-wrapper-light .stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-light);
  }
  
  .rituals-page-wrapper-light .stat-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }
  
  .rituals-page-wrapper-light .stat-label {
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
  }
  
  .rituals-page-wrapper-light .stat-value {
    font-weight: 700;
    font-size: 1.125rem;
    color: var(--text-primary);
  }
  
  .rituals-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
    font-weight: 800;
  }
  
  .rituals-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .rituals-page-wrapper-light .tip-icon {
    color: var(--accent);
    font-size: 1.25rem;
  }
  
  .rituals-page-wrapper-light .tip-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-primary);
  }
  
  .rituals-page-wrapper-light .tip-content {
    color: var(--text-secondary);
    font-size: 0.875rem;
    line-height: 1.5;
  }
  
  .rituals-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.75rem;
  }
  
  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .rituals-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 2rem 0 !important;
    }
    
    .rituals-page-wrapper-light .main-content {
      padding: 3rem 10px !important;
    }
    
    .rituals-page-wrapper-light .sidebar {
      position: relative !important;
      top: 0 !important;
      padding: 2.5rem 10px !important;
      max-height: none !important;
    }
  }
  
  @media (max-width: 768px) {
    .rituals-page-wrapper-light .page-header h1 {
      font-size: 2rem !important;
    }
    
    .rituals-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }
  }

  @media (max-width: 480px) {
    .rituals-page-wrapper-light .page-header h1 {
      font-size: 1.75rem !important;
    }

    .rituals-page-wrapper-light .page-subtitle {
      font-size: 1rem !important;
    }
    
    .rituals-page-wrapper-light .main-content {
      padding: 1.5rem 8px !important;
    }

    .rituals-page-wrapper-light .premium-card {
      padding: 1.5rem !important;
    }
  }
</style>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\dashboard\tabs\rituals.blade.php ENDPATH**/ ?>