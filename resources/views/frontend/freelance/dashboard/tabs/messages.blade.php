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
            <div class="workflow-card" style="background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #f8fafc 100%); border: 2.5px solid rgba(59, 130, 246, 0.25); box-shadow: 0 32px 80px rgba(59, 130, 246, 0.2), 0 12px 32px rgba(59, 130, 246, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8); border-radius: 32px; padding: 2.5rem; transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);" onmouseover="this.style.boxShadow='0 40px 100px rgba(59, 130, 246, 0.3), 0 16px 48px rgba(59, 130, 246, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(-14px) scale(1.02)'; this.style.borderColor='rgba(59, 130, 246, 0.4)';" onmouseout="this.style.boxShadow='0 32px 80px rgba(59, 130, 246, 0.2), 0 12px 32px rgba(59, 130, 246, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8)'; this.style.transform='translateY(0) scale(1)'; this.style.borderColor='rgba(59, 130, 246, 0.25)';">
              <div class="step-number" style="font-size: 3rem; margin-bottom: 1.5rem;">💬</div>
              <h3 style="font-size: 1.35rem; font-weight: 900; color: #0f172a; margin-bottom: 1rem; letter-spacing: -0.03em;">Conversations unifiées</h3>
              <p style="font-size: 1rem; line-height: 1.8; color: #334155; font-weight: 500;">
                Tous vos échanges avec les clients au même endroit, organisés par projet.
                Plus besoin de jongler entre plusieurs outils.
              </p>
            </div>

            <!-- Avantage 2 -->
            <div class="workflow-card" style="background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #f8fafc 100%); border: 2.5px solid rgba(168, 85, 247, 0.25); box-shadow: 0 32px 80px rgba(168, 85, 247, 0.2), 0 12px 32px rgba(168, 85, 247, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8); border-radius: 32px; padding: 2.5rem; transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);" onmouseover="this.style.boxShadow='0 40px 100px rgba(168, 85, 247, 0.3), 0 16px 48px rgba(168, 85, 247, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(-14px) scale(1.02)'; this.style.borderColor='rgba(168, 85, 247, 0.4)';" onmouseout="this.style.boxShadow='0 32px 80px rgba(168, 85, 247, 0.2), 0 12px 32px rgba(168, 85, 247, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8)'; this.style.transform='translateY(0) scale(1)'; this.style.borderColor='rgba(168, 85, 247, 0.25)';">
              <div class="step-number" style="font-size: 3rem; margin-bottom: 1.5rem;">⚡</div>
              <h3 style="font-size: 1.35rem; font-weight: 900; color: #0f172a; margin-bottom: 1rem; letter-spacing: -0.03em;">Réponses rapides</h3>
              <p style="font-size: 1rem; line-height: 1.8; color: #334155; font-weight: 500;">
                Répondez directement depuis votre tableau de bord sans changer d'outil.
                Une interface simple et efficace.
              </p>
            </div>

            <!-- Avantage 3 -->
            <div class="workflow-card" style="background: linear-gradient(135deg, #ffffff 0%, #fef3f2 50%, #f8fafc 100%); border: 2.5px solid rgba(30, 64, 175, 0.25); box-shadow: 0 32px 80px rgba(30, 64, 175, 0.2), 0 12px 32px rgba(30, 64, 175, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8); border-radius: 32px; padding: 2.5rem; transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);" onmouseover="this.style.boxShadow='0 40px 100px rgba(30, 64, 175, 0.3), 0 16px 48px rgba(30, 64, 175, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(-14px) scale(1.02)'; this.style.borderColor='rgba(30, 64, 175, 0.4)';" onmouseout="this.style.boxShadow='0 32px 80px rgba(30, 64, 175, 0.2), 0 12px 32px rgba(30, 64, 175, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8)'; this.style.transform='translateY(0) scale(1)'; this.style.borderColor='rgba(30, 64, 175, 0.25)';">
              <div class="step-number" style="font-size: 3rem; margin-bottom: 1.5rem;">🎯</div>
              <h3 style="font-size: 1.35rem; font-weight: 900; color: #0f172a; margin-bottom: 1rem; letter-spacing: -0.03em;">Notifications intelligentes</h3>
              <p style="font-size: 1rem; line-height: 1.8; color: #334155; font-weight: 500;">
                Ne manquez jamais un message important avec nos alertes contextuelles.
                Restez informé en temps réel.
              </p>
            </div>
          </div>
        </div>

        <!-- CTA Principal -->
        <div class="primary-cta">
          <a href="{{ route('freelance.services.create') }}" class="btn-primary-xl" style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 1.5rem 3.5rem; background: linear-gradient(135deg, #3B82F6, #60A5FA); color: white; border: none; border-radius: 32px; font-size: 1.1rem; font-weight: 700; text-decoration: none; transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); box-shadow: 0 12px 32px rgba(59, 130, 246, 0.3); letter-spacing: -0.02em;" onmouseover="this.style.transform='translateY(-3px) scale(1.02)'; this.style.boxShadow='0 20px 48px rgba(59, 130, 246, 0.4)';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 12px 32px rgba(59, 130, 246, 0.3)';">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M12 5v14M5 12h14"/>
            </svg>
            Créer un Rituel pour recevoir des messages
          </a>
        </div>
      </div>
    </main>

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
    display: block !important;
    grid-template-columns: unset !important;
    min-height: 100vh;
    max-width: none !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 2rem !important;
    background: white !important;
    border-radius: var(--radius-xl) !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
    box-sizing: border-box;
    gap: 0 !important;
    overflow-x: visible !important;
  }
  
  /* ===== ZONE PRINCIPALE (100%) ===== */
  .messages-page-wrapper-light .main-content {
    padding: 2rem 0 !important;
    border-right: none !important;
    min-height: auto;
    background: transparent;
    box-sizing: border-box;
    overflow-x: visible !important;
    position: relative;
    max-width: none !important;
    width: 100% !important;
    min-width: 0 !important;
    display: flex;
    flex-direction: column;
  }
  
  /* ===== HERO HEADER - IDENTIQUE À OVERVIEW ===== */
  .messages-page-wrapper-light .dashboard-overview-hero {
    position: relative !important; margin: 0 !important; margin-bottom: 3rem !important;
    padding: 0 !important; border: none !important; background: transparent !important;
    width: 100% !important; max-width: 100% !important; overflow: visible !important;
  }
  .messages-page-wrapper-light .dashboard-overview-hero .hero-glow {
    position: absolute; top: -50px; left: 50%; transform: translateX(-50%);
    width: 800px; height: 600px;
    background: radial-gradient(circle at 30% 50%, rgba(124, 58, 237, 0.15) 0%, rgba(30, 64, 175, 0.1) 35%, transparent 80%);
    border-radius: 50%; filter: blur(100px); pointer-events: none; z-index: 0;
  }
  .messages-page-wrapper-light .dashboard-overview-hero .hero-content {
    position: relative; z-index: 1; display: grid; grid-template-columns: 1fr 1fr;
    gap: 4rem; align-items: center; padding: 3rem 0; width: 100%; box-sizing: border-box;
  }
  .messages-page-wrapper-light .dashboard-overview-hero .hero-text { display: flex; flex-direction: column; gap: 1.5rem; padding: 0; }
  .messages-page-wrapper-light .dashboard-overview-hero .hero-title {
    font-size: 2.5rem; font-weight: 800; line-height: 1.2; color: #111827; margin: 0; letter-spacing: -0.02em;
    background: linear-gradient(135deg, #111827 0%, #374151 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
  }
  .messages-page-wrapper-light .dashboard-overview-hero .hero-subtitle { font-size: 1.125rem; line-height: 1.6; color: #6b7280; margin: 0; font-weight: 400; max-width: 550px; }
  .messages-page-wrapper-light .dashboard-overview-hero .hero-ctas { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 0.5rem; }
  .messages-page-wrapper-light .dashboard-overview-hero .btn-hero {
    padding: 1rem 1.75rem; font-size: 1rem; font-weight: 600; border-radius: 14px; border: none;
    cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-family: inherit;
  }
  .messages-page-wrapper-light .dashboard-overview-hero .btn-hero-primary { background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); color: white; box-shadow: 0 10px 30px rgba(124, 58, 237, 0.25); }
  .messages-page-wrapper-light .dashboard-overview-hero .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(124, 58, 237, 0.35); color: white; text-decoration: none; }
  .messages-page-wrapper-light .dashboard-overview-hero .btn-hero-secondary { background: white; color: #1e40af; border: 2px solid #1e40af; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.1); }
  .messages-page-wrapper-light .dashboard-overview-hero .btn-hero-secondary:hover { background: #f0f4ff; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30, 64, 175, 0.15); color: #1e40af; text-decoration: none; }
  .messages-page-wrapper-light .dashboard-overview-hero .btn-text { display: inline; }
  .messages-page-wrapper-light .dashboard-overview-hero .btn-icon { font-size: 1.2rem; display: inline-block; transition: transform 0.3s ease; }
  .messages-page-wrapper-light .dashboard-overview-hero .btn-hero:hover .btn-icon { transform: translateX(3px); }
  .messages-page-wrapper-light .dashboard-overview-hero .hero-hint { font-size: 0.9rem; color: #6b7280; margin: 0; margin-top: 0.5rem; font-weight: 500; }
  .messages-page-wrapper-light .dashboard-overview-hero .hero-visual { display: flex; align-items: center; justify-content: center; padding: 2rem; }
  .messages-page-wrapper-light .dashboard-overview-hero .hero-visual-card {
    position: relative; width: 100%; max-width: 350px; padding: 3rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border: 1px solid #e2e8f0;
    border-radius: 24px; text-align: center; box-shadow: 0 20px 60px rgba(0,0,0,0.08); overflow: hidden;
  }
  .messages-page-wrapper-light .dashboard-overview-hero .hero-visual-card::before {
    content: ''; position: absolute; top: 0; right: 0; width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(124,58,237,0.1) 0%, transparent 70%);
    border-radius: 50%; transform: translate(100px, -100px);
  }
  .messages-page-wrapper-light .dashboard-overview-hero .visual-badge {
    display: inline-block; padding: 0.5rem 1rem; background: linear-gradient(135deg, #ddd6fe 0%, #e9d5ff 100%);
    color: #6d28d9; font-size: 0.85rem; font-weight: 600; border-radius: 20px; margin-bottom: 1.5rem; position: relative; z-index: 1;
  }
  .messages-page-wrapper-light .dashboard-overview-hero .visual-icon { font-size: 3.5rem; margin-bottom: 1rem; display: block; position: relative; z-index: 1; }
  .messages-page-wrapper-light .dashboard-overview-hero .visual-text { font-size: 1.25rem; font-weight: 700; color: #111827; line-height: 1.5; margin: 0; position: relative; z-index: 1; }
  @media (max-width: 1024px) {
    .messages-page-wrapper-light .dashboard-overview-hero .hero-content { grid-template-columns: 1fr; gap: 2.5rem; padding: 2.5rem 0; }
    .messages-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 2rem; }
    .messages-page-wrapper-light .dashboard-overview-hero .hero-visual-card { max-width: 280px; }
  }
  @media (max-width: 768px) {
    .messages-page-wrapper-light .dashboard-overview-hero .hero-content { padding: 2rem 0; }
    .messages-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 1.75rem; }
    .messages-page-wrapper-light .dashboard-overview-hero .hero-ctas { flex-direction: column; }
    .messages-page-wrapper-light .dashboard-overview-hero .btn-hero { width: 100%; justify-content: center; }
    .messages-page-wrapper-light .dashboard-overview-hero .hero-visual-card { max-width: 250px; padding: 2rem 1.5rem; }
  }
  @media (max-width: 480px) {
    .messages-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 1.5rem; }
    .messages-page-wrapper-light .dashboard-overview-hero .btn-hero { padding: 0.875rem 1.5rem; font-size: 0.95rem; }
    .messages-page-wrapper-light .dashboard-overview-hero .visual-icon { font-size: 2.5rem; }
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
    border-bottom: 2.5px solid rgba(59, 130, 246, 0.2);
    text-align: center !important; /* Centrage du contenu */
  }
  
  .messages-page-wrapper-light .page-header::after {
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
  
  .messages-page-wrapper-light .page-header h1 {
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
    font-weight: 900;
    margin-bottom: 2rem;
    color: var(--text-primary);
    text-align: center;
    letter-spacing: -0.03em;
  }
  
  .messages-page-wrapper-light .workflow-grid {
    display: grid !important;
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 2.5rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  
  .messages-page-wrapper-light .workflow-card {
    background: var(--bg-card);
    border: 2.5px solid var(--border);
    border-radius: 32px;
    padding: 2.5rem;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 32px 80px rgba(15, 23, 42, 0.15), 0 12px 32px rgba(15, 23, 42, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
  }
  
  .messages-page-wrapper-light .workflow-card:hover {
    transform: translateY(-14px) scale(1.02);
    border-color: var(--primary-light);
    box-shadow: 0 40px 100px rgba(15, 23, 42, 0.25), 0 16px 48px rgba(15, 23, 42, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.9);
  }
  
  .messages-page-wrapper-light .step-number {
    font-size: 3rem;
    margin-bottom: 1.5rem;
  }
  
  .messages-page-wrapper-light .workflow-card h3 {
    font-size: 1.35rem;
    font-weight: 900;
    margin-bottom: 1rem;
    color: var(--text-primary);
    letter-spacing: -0.03em;
  }
  
  .messages-page-wrapper-light .workflow-card p {
    color: var(--text-secondary);
    font-size: 1rem;
    line-height: 1.8;
    font-weight: 500;
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
    padding: 1.5rem 3.5rem;
    background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%);
    color: white;
    border: none;
    border-radius: 32px;
    font-size: 1.1rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 12px 32px rgba(59, 130, 246, 0.3);
    letter-spacing: -0.02em;
  }
  
  .messages-page-wrapper-light .btn-primary-xl:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 20px 48px rgba(59, 130, 246, 0.4);
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
      display: block !important;
      grid-template-columns: unset !important;
      gap: 0 !important;
    }
    
    .messages-page-wrapper-light .main-content {
      padding: 2rem 0 !important;
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
