@php
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'services';
@endphp

<div class="services-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Bloc Tableau de bord Freelance -->
      @include('frontend.freelance.dashboard.partials.dashboard-header-section', [
        'freelancerProfile' => $freelancerProfile ?? null
      ])

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
          <div class="workflow-grid" style="margin-left: -4rem; margin-right: -32vw; width: calc(100% + 32vw); padding: 0 4rem;">
            <!-- Avantage 1 -->
            <div class="workflow-card" style="background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #f8fafc 100%); border: 2.5px solid rgba(59, 130, 246, 0.25); box-shadow: 0 32px 80px rgba(59, 130, 246, 0.2), 0 12px 32px rgba(59, 130, 246, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8); border-radius: 32px; padding: 2.5rem; transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);\" onmouseover="this.style.boxShadow='0 40px 100px rgba(59, 130, 246, 0.3), 0 16px 48px rgba(59, 130, 246, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(-14px) scale(1.02)'; this.style.borderColor='rgba(59, 130, 246, 0.4)';" onmouseout="this.style.boxShadow='0 32px 80px rgba(59, 130, 246, 0.2), 0 12px 32px rgba(59, 130, 246, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8)'; this.style.transform='translateY(0) scale(1)'; this.style.borderColor='rgba(59, 130, 246, 0.25)';">
              <div class="step-number" style="font-size: 3rem;">🎯</div>
              <h3 style="font-size: 1.35rem; font-weight: 900; color: #0f172a; margin-bottom: 1rem; background: linear-gradient(135deg, #0f172a, #334155); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Précision client</h3>
              <p style="font-size: 1rem; line-height: 1.8; color: #334155; font-weight: 500;">
                Attirez des clients qui comprennent exactement ce que vous proposez.
                Moins de questions, plus de conversions.
              </p>
            </div>

            <!-- Avantage 2 -->
            <div class="workflow-card" style="background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #f8fafc 100%); border: 2.5px solid rgba(168, 85, 247, 0.25); box-shadow: 0 32px 80px rgba(168, 85, 247, 0.2), 0 12px 32px rgba(168, 85, 247, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8); border-radius: 32px; padding: 2.5rem; transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);" onmouseover="this.style.boxShadow='0 40px 100px rgba(168, 85, 247, 0.3), 0 16px 48px rgba(168, 85, 247, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(-14px) scale(1.02)'; this.style.borderColor='rgba(168, 85, 247, 0.4)';" onmouseout="this.style.boxShadow='0 32px 80px rgba(168, 85, 247, 0.2), 0 12px 32px rgba(168, 85, 247, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8)'; this.style.transform='translateY(0) scale(1)'; this.style.borderColor='rgba(168, 85, 247, 0.25)';">
              <div class="step-number" style="font-size: 3rem;">💰</div>
              <h3 style="font-size: 1.35rem; font-weight: 900; color: #0f172a; margin-bottom: 1rem; background: linear-gradient(135deg, #6d28d9, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Tarification claire</h3>
              <p style="font-size: 1rem; line-height: 1.8; color: #334155; font-weight: 500;">
                Éliminez les négociations inutiles avec des prix transparents.
                Vos clients savent à quoi s'attendre.
              </p>
            </div>

            <!-- Avantage 3 -->
            <div class="workflow-card" style="background: linear-gradient(135deg, #ffffff 0%, #fef3f2 50%, #f8fafc 100%); border: 2.5px solid rgba(30, 64, 175, 0.25); box-shadow: 0 32px 80px rgba(30, 64, 175, 0.2), 0 12px 32px rgba(30, 64, 175, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8); border-radius: 32px; padding: 2.5rem; transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);" onmouseover="this.style.boxShadow='0 40px 100px rgba(30, 64, 175, 0.3), 0 16px 48px rgba(30, 64, 175, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.9)'; this.style.transform='translateY(-14px) scale(1.02)'; this.style.borderColor='rgba(30, 64, 175, 0.4)';" onmouseout="this.style.boxShadow='0 32px 80px rgba(30, 64, 175, 0.2), 0 12px 32px rgba(30, 64, 175, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8)'; this.style.transform='translateY(0) scale(1)'; this.style.borderColor='rgba(30, 64, 175, 0.25)';">
              <div class="step-number" style="font-size: 3rem;">⚡</div>
              <h3 style="font-size: 1.35rem; font-weight: 900; color: #0f172a; margin-bottom: 1rem; background: linear-gradient(135deg, #1e40af, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Conversion rapide</h3>
              <p style="font-size: 1rem; line-height: 1.8; color: #334155; font-weight: 500;">
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
                <div class="services-service-icon services-icon-logo">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 6v6l4 2"/>
                  </svg>
                </div>
                <div>
                  <div style="font-weight: 600; color: var(--text-primary);">Conception Logo Premium</div>
                  <div style="font-size: 0.875rem; color: var(--text-secondary);">Identité visuelle complète</div>
                </div>
              </div>
              <div style="font-weight: 600; color: var(--text-primary);">2 500 €</div>
              <div style="color: var(--text-secondary);">7 jours</div>
              <div><span class="services-status-badge services-status-active">Actif</span></div>
              <div><button class="services-btn-edit"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.4rem; display: inline;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>Modifier</button></div>
            </div>
            
            <div class="services-table-row services-hidden-row" style="display: none;">
              <div class="services-service-example">
                <div class="services-service-icon services-icon-audit">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                  </svg>
                </div>
                <div>
                  <div style="font-weight: 600; color: var(--text-primary);">Audit UX/UI</div>
                  <div style="font-size: 0.875rem; color: var(--text-secondary);">Analyse complète interface</div>
                </div>
              </div>
              <div style="font-weight: 600; color: var(--text-primary);">1 800 €</div>
              <div style="color: var(--text-secondary);">3 jours</div>
              <div><span class="services-status-badge services-status-draft">Brouillon</span></div>
              <div><button class="services-btn-edit services-btn-publish"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.4rem; display: inline;"><path d="M5 13l4 4L19 7"/></svg>Publier</button></div>
            </div>
            
            <div class="services-table-toggle">
              <button class="services-toggle-btn" data-services-toggle>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transition: transform 0.3s ease;">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
                <span>Voir plus</span>
              </button>
            </div>
          </div>
        </div>

        <!-- CTA Principal -->
        <div class="primary-cta">
          <a href="{{ route('freelance.services.create') }}" class="btn-primary-xl">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M12 5v14M5 12h14"/>
            </svg>
            Créer mon premier service
          </a>
        </div>
      </div>
    </main>

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
    display: block !important;
    grid-template-columns: unset !important;
    min-height: 100vh;
    max-width: none !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    background: transparent;
    box-shadow: none;
    box-sizing: border-box;
    gap: 0 !important;
    overflow-x: visible !important;
  }
  
  /* ===== ZONE PRINCIPALE (100%) - PLEINE LARGEUR ===== */
  .services-page-wrapper-light .main-content {
    padding: 2rem 0 !important;
    border-right: none !important;
    min-height: auto;
    background: #F5F7FA;
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
  .services-page-wrapper-light .dashboard-overview-hero {
    position: relative !important;
    margin: 0 !important;
    margin-bottom: 3rem !important;
    padding: 0 !important;
    border: none !important;
    background: transparent !important;
    width: 100% !important;
    max-width: 100% !important;
    overflow: visible !important;
  }
  .services-page-wrapper-light .dashboard-overview-hero .hero-glow {
    position: absolute;
    top: -50px;
    left: 50%;
    transform: translateX(-50%);
    width: 800px;
    height: 600px;
    background: radial-gradient(circle at 30% 50%, rgba(124, 58, 237, 0.15) 0%, rgba(30, 64, 175, 0.1) 35%, transparent 80%);
    border-radius: 50%;
    filter: blur(100px);
    pointer-events: none;
    z-index: 0;
  }
  .services-page-wrapper-light .dashboard-overview-hero .hero-content {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    padding: 3rem 0;
    width: 100%;
    box-sizing: border-box;
  }
  .services-page-wrapper-light .dashboard-overview-hero .hero-text {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    padding: 0;
  }
  .services-page-wrapper-light .dashboard-overview-hero .hero-title {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1.2;
    color: #111827;
    margin: 0;
    letter-spacing: -0.02em;
    background: linear-gradient(135deg, #111827 0%, #374151 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  .services-page-wrapper-light .dashboard-overview-hero .hero-subtitle {
    font-size: 1.125rem;
    line-height: 1.6;
    color: #6b7280;
    margin: 0;
    font-weight: 400;
    max-width: 550px;
  }
  .services-page-wrapper-light .dashboard-overview-hero .hero-ctas {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 0.5rem;
  }
  .services-page-wrapper-light .dashboard-overview-hero .btn-hero {
    padding: 1rem 1.75rem;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 14px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-family: inherit;
  }
  .services-page-wrapper-light .dashboard-overview-hero .btn-hero-primary {
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    box-shadow: 0 10px 30px rgba(124, 58, 237, 0.25);
  }
  .services-page-wrapper-light .dashboard-overview-hero .btn-hero-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(124, 58, 237, 0.35);
    color: white;
    text-decoration: none;
  }
  .services-page-wrapper-light .dashboard-overview-hero .btn-hero-secondary {
    background: white;
    color: #1e40af;
    border: 2px solid #1e40af;
    box-shadow: 0 4px 12px rgba(30, 64, 175, 0.1);
  }
  .services-page-wrapper-light .dashboard-overview-hero .btn-hero-secondary:hover {
    background: #f0f4ff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(30, 64, 175, 0.15);
    color: #1e40af;
    text-decoration: none;
  }
  .services-page-wrapper-light .dashboard-overview-hero .btn-text { display: inline; }
  .services-page-wrapper-light .dashboard-overview-hero .btn-icon {
    font-size: 1.2rem;
    display: inline-block;
    transition: transform 0.3s ease;
  }
  .services-page-wrapper-light .dashboard-overview-hero .btn-hero:hover .btn-icon { transform: translateX(3px); }
  .services-page-wrapper-light .dashboard-overview-hero .hero-hint {
    font-size: 0.9rem;
    color: #6b7280;
    margin: 0;
    margin-top: 0.5rem;
    font-weight: 500;
  }
  .services-page-wrapper-light .dashboard-overview-hero .hero-visual {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
  }
  .services-page-wrapper-light .dashboard-overview-hero .hero-visual-card {
    position: relative;
    width: 100%;
    max-width: 350px;
    padding: 3rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    overflow: hidden;
  }
  .services-page-wrapper-light .dashboard-overview-hero .hero-visual-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(124, 58, 237, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(100px, -100px);
  }
  .services-page-wrapper-light .dashboard-overview-hero .visual-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: linear-gradient(135deg, #ddd6fe 0%, #e9d5ff 100%);
    color: #6d28d9;
    font-size: 0.85rem;
    font-weight: 600;
    border-radius: 20px;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
  }
  .services-page-wrapper-light .dashboard-overview-hero .visual-icon {
    font-size: 3.5rem;
    margin-bottom: 1rem;
    display: block;
    position: relative;
    z-index: 1;
  }
  .services-page-wrapper-light .dashboard-overview-hero .visual-text {
    font-size: 1.25rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.5;
    margin: 0;
    position: relative;
    z-index: 1;
  }
  @media (max-width: 1024px) {
    .services-page-wrapper-light .dashboard-overview-hero .hero-content {
      grid-template-columns: 1fr;
      gap: 2.5rem;
      padding: 2.5rem 0;
    }
    .services-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 2rem; }
    .services-page-wrapper-light .dashboard-overview-hero .hero-visual-card { max-width: 280px; }
  }
  @media (max-width: 768px) {
    .services-page-wrapper-light .dashboard-overview-hero .hero-content { padding: 2rem 0; }
    .services-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 1.75rem; }
    .services-page-wrapper-light .dashboard-overview-hero .hero-ctas { flex-direction: column; }
    .services-page-wrapper-light .dashboard-overview-hero .btn-hero { width: 100%; justify-content: center; }
    .services-page-wrapper-light .dashboard-overview-hero .hero-visual-card { max-width: 250px; padding: 2rem 1.5rem; }
  }
  @media (max-width: 480px) {
    .services-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 1.5rem; }
    .services-page-wrapper-light .dashboard-overview-hero .btn-hero { padding: 0.875rem 1.5rem; font-size: 0.95rem; }
    .services-page-wrapper-light .dashboard-overview-hero .visual-icon { font-size: 2.5rem; }
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
    border-bottom: 2px solid transparent;
    border-image: linear-gradient(90deg, transparent 0%, var(--primary) 30%, var(--accent) 70%, transparent 100%) 1;
    text-align: center !important; /* Centrage du contenu */
  }
  
  .services-page-wrapper-light .page-header::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    border-radius: 2px;
    filter: drop-shadow(0 4px 12px rgba(59, 130, 246, 0.3));
  }
  
  .services-page-wrapper-light .page-header h1 {
    font-size: 3rem !important; /* 48px desktop - MÊME TAILLE QUE DEMANDES */
    font-weight: 900;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #1e293b 0%, #475569 50%, #64748b 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.03em;
    max-width: 100%;
    width: 100%;
    word-wrap: break-word;
    line-height: 1.1;
    text-align: center !important; /* Centrage du titre */
    animation: fadeInDown 0.8s ease-out;
  }
  
  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .services-page-wrapper-light .page-subtitle {
    color: var(--text-secondary);
    font-size: 1.25rem; /* 20px */
    max-width: 100%;
    width: 100%;
    line-height: 1.8;
    font-weight: 500;
    word-wrap: break-word;
    margin-top: 0.5rem;
    text-align: center !important; /* Centrage du sous-texte */
    animation: fadeInUp 0.8s ease-out 0.2s both;
  }
  
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
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
    gap: 2.5rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
    animation: fadeInUp 0.8s ease-out 0.3s both;
  }
  
  .services-page-wrapper-light .workflow-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.85) 100%);
    border: 1.5px solid transparent;
    background-clip: padding-box;
    border-image: linear-gradient(135deg, rgba(59, 130, 246, 0.35) 0%, rgba(139, 92, 246, 0.25) 100%) 1;
    border-radius: 32px;
    padding: 2.5rem;
    text-align: center;
    transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
  }
  
  .services-page-wrapper-light .workflow-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.5) 0%, transparent 100%);
    opacity: 0;
    transition: opacity 0.5s ease;
    border-radius: 32px;
    pointer-events: none;
  }
  
  .services-page-wrapper-light .workflow-card:hover {
    transform: translateY(-16px) scale(1.03);
    box-shadow: 0 50px 120px rgba(59, 130, 246, 0.35), 0 20px 60px rgba(139, 92, 246, 0.25), inset 0 1px 2px rgba(255, 255, 255, 0.95);
    border-color: rgba(59, 130, 246, 0.5);
  }
  
  .services-page-wrapper-light .workflow-card:hover::before {
    opacity: 1;
  }
  
  .services-page-wrapper-light .step-number {
    font-size: 3.2rem;
    margin-bottom: 1.5rem;
  }
  
  .services-page-wrapper-light .workflow-card h3 {
    font-size: 1.35rem;
    font-weight: 900;
    margin-bottom: 1rem;
    color: var(--text-primary);
    letter-spacing: -0.03em;
  }
  
  .services-page-wrapper-light .workflow-card p {
    color: var(--text-secondary);
    font-size: 1rem;
    line-height: 1.8;
    font-weight: 500;
  }
  
  /* ===== RITUAL SECTION ===== */
  .services-page-wrapper-light .ritual-section {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 4rem 0 !important;
    animation: fadeInUp 0.8s ease-out 0.4s both;
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
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.95) 100%);
    border: 1px solid rgba(59, 130, 246, 0.15);
    border-radius: var(--radius-lg);
    padding: 2rem;
    margin-top: 2rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    box-shadow: 0 20px 60px rgba(59, 130, 246, 0.1), inset 0 1px 2px rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(20px);
    transition: all 0.3s ease;
  }
  
  .services-page-wrapper-light .services-table-preview:hover {
    border-color: rgba(59, 130, 246, 0.25);
    box-shadow: 0 30px 80px rgba(59, 130, 246, 0.15), inset 0 1px 2px rgba(255, 255, 255, 0.9);
  }
  
  .services-page-wrapper-light .services-table-header {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
    padding: 1.25rem;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(139, 92, 246, 0.05) 100%);
    border-radius: var(--radius-md);
    font-weight: 700;
    color: var(--primary);
    font-size: 0.85rem;
    border: 1px solid rgba(59, 130, 246, 0.15);
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  
  .services-page-wrapper-light .services-table-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
    padding: 1.25rem;
    align-items: center;
    border-bottom: 1px solid rgba(59, 130, 246, 0.08);
    background: linear-gradient(90deg, rgba(255, 255, 255, 0.5) 0%, transparent 100%);
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    border-radius: 8px;
  }

  .services-page-wrapper-light .services-table-row::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, rgba(59, 130, 246, 0.8), rgba(139, 92, 246, 0.4));
    border-radius: 8px 0 0 8px;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .services-page-wrapper-light .services-table-row:hover {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.12) 0%, rgba(139, 92, 246, 0.06) 100%);
    transform: translateX(6px) translateY(-2px);
    border-left: 3px solid var(--primary);
    padding-left: calc(1.25rem - 3px);
    box-shadow: 0 12px 32px rgba(59, 130, 246, 0.15), 0 4px 16px rgba(99, 102, 241, 0.1);
  }

  .services-page-wrapper-light .services-table-row:hover::before {
    opacity: 1;
  }
  
  .services-page-wrapper-light .services-table-row:hover .services-service-icon {
    transform: scale(1.1) rotate(-5deg);
    box-shadow: 
      inset -2px -2px 6px rgba(0, 0, 0, 0.1),
      inset 2px 2px 6px rgba(255, 255, 255, 0.4),
      0 16px 40px rgba(59, 130, 246, 0.35),
      0 0px 30px rgba(99, 102, 241, 0.25);
  }
  
  .services-page-wrapper-light .services-service-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, rgba(96, 165, 250, 0.9) 0%, rgba(59, 130, 246, 0.8) 50%, rgba(30, 58, 138, 0.7) 100%);
    border-radius: var(--radius-sm);
    box-shadow: 
      inset -2px -2px 6px rgba(0, 0, 0, 0.1),
      inset 2px 2px 6px rgba(255, 255, 255, 0.3),
      0 8px 24px rgba(59, 130, 246, 0.2),
      0 0px 20px rgba(99, 102, 241, 0.15);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }

  .services-page-wrapper-light .services-service-icon::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.3) 0%, transparent 50%, rgba(0, 0, 0, 0.1) 100%);
    border-radius: var(--radius-sm);
  }

  .services-page-wrapper-light .services-icon-logo {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.95) 0%, rgba(96, 165, 250, 0.85) 100%);
  }

  .services-page-wrapper-light .services-icon-audit {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.95) 0%, rgba(168, 85, 247, 0.85) 100%);
    box-shadow: 
      inset -2px -2px 6px rgba(0, 0, 0, 0.1),
      inset 2px 2px 6px rgba(255, 255, 255, 0.3),
      0 8px 24px rgba(139, 92, 246, 0.2),
      0 0px 20px rgba(168, 85, 247, 0.15);
  }

  .services-page-wrapper-light .services-table-row:hover .services-service-icon {
    transform: scale(1.1) rotate(-5deg);
    box-shadow: 
      inset -2px -2px 6px rgba(0, 0, 0, 0.1),
      inset 2px 2px 6px rgba(255, 255, 255, 0.4),
      0 16px 40px rgba(59, 130, 246, 0.35),
      0 0px 30px rgba(99, 102, 241, 0.25);
  }
  
  .services-page-wrapper-light .services-status-badge {
    padding: 0.35rem 0.85rem;
    border-radius: 100px;
    font-size: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 0px 12px rgba(0, 0, 0, 0.05), inset 0 1px 2px rgba(255, 255, 255, 0.4);
    position: relative;
  }

  .services-page-wrapper-light .services-status-active {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(16, 185, 129, 0.08) 100%);
    color: var(--success);
    border: 1px solid rgba(16, 185, 129, 0.3);
    box-shadow: 0 0px 16px rgba(16, 185, 129, 0.2), inset 0 1px 2px rgba(255, 255, 255, 0.5);
  }

  .services-page-wrapper-light .services-status-draft {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(245, 158, 11, 0.08) 100%);
    color: var(--warning);
    border: 1px solid rgba(245, 158, 11, 0.3);
    box-shadow: 0 0px 16px rgba(245, 158, 11, 0.2), inset 0 1px 2px rgba(255, 255, 255, 0.5);
  }

  .services-page-wrapper-light .services-table-row:hover .services-status-badge {
    transform: scale(1.05);
    box-shadow: 0 0px 24px var(--success), inset 0 1px 2px rgba(255, 255, 255, 0.6);
  
  .services-page-wrapper-light .services-btn-edit {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(99, 102, 241, 0.05) 100%);
    border: 1.5px solid rgba(59, 130, 246, 0.25);
    padding: 0.6rem 1.1rem;
    border-radius: var(--radius-sm);
    color: var(--primary);
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.08), inset 0 1px 2px rgba(255, 255, 255, 0.4);
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    white-space: nowrap;
  }

  .services-page-wrapper-light .services-btn-edit::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.2) 50%, transparent 70%);
    transform: translateX(-150%);
    transition: transform 0.6s ease;
  }

  .services-page-wrapper-light .services-btn-edit:hover {
    background: linear-gradient(135deg, var(--primary) 0%, rgba(59, 130, 246, 0.9) 100%);
    color: white;
    border-color: var(--primary);
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 16px 36px rgba(59, 130, 246, 0.35), 0 0px 24px rgba(99, 102, 241, 0.25), inset 0 1px 2px rgba(255, 255, 255, 0.3);
  }

  .services-page-wrapper-light .services-btn-edit:hover::before {
    transform: translateX(150%);
  }

  .services-page-wrapper-light .services-btn-publish:hover {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.95) 0%, rgba(16, 185, 129, 0.85) 100%);
    color: white;
    border-color: var(--success);
    box-shadow: 0 16px 36px rgba(16, 185, 129, 0.4), 0 0px 24px rgba(16, 185, 129, 0.3);
  }
  .services-page-wrapper-light .services-table-toggle {
    display: flex;
    justify-content: center;
    padding: 1.5rem 1rem;
    margin-top: 0.5rem;
  }

  .services-page-wrapper-light .services-toggle-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.75rem;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(59, 130, 246, 0.15) 100%);
    border: 1.5px solid rgba(99, 102, 241, 0.4);
    border-radius: 50px;
    color: var(--text-primary);
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 
      0 8px 24px rgba(99, 102, 241, 0.2),
      0 0px 20px rgba(59, 130, 246, 0.15),
      inset 0 1px 2px rgba(255, 255, 255, 0.5);
    position: relative;
    overflow: hidden;
  }

  .services-page-wrapper-light .services-toggle-btn::before {
    content: '';
    position: absolute;
    inset: -50%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.4s ease;
  }

  .services-page-wrapper-light .services-toggle-btn:hover {
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.28) 0%, rgba(59, 130, 246, 0.28) 100%);
    border-color: rgba(99, 102, 241, 0.7);
    transform: translateY(-4px) scale(1.02);
    box-shadow: 
      0 16px 48px rgba(99, 102, 241, 0.35),
      0 0px 32px rgba(59, 130, 246, 0.3),
      inset 0 1px 2px rgba(255, 255, 255, 0.6);
  }

  .services-page-wrapper-light .services-toggle-btn:hover::before {
    opacity: 1;
  }

  .services-page-wrapper-light .services-toggle-btn svg {
    width: 18px;
    height: 18px;
    transition: transform 0.3s ease;
  }

  .services-page-wrapper-light .services-toggle-btn[data-state="expanded"] svg {
    transform: rotate(180deg);
  }

  .services-page-wrapper-light .services-hidden-row {
    animation: fadeInDown 0.3s ease forwards !important;
  }

  .services-page-wrapper-light .services-hidden-row.hiding {
    animation: fadeOutUp 0.3s ease forwards !important;
  }

  @keyframes fadeOutUp {
    from {
      opacity: 1;
      transform: translateY(0);
    }
    to {
      opacity: 0;
      transform: translateY(-20px);
    }
  }
  
  /* ===== CTA PRINCIPAL ===== */
  .services-page-wrapper-light .primary-cta {
    text-align: center;
    margin: 4rem 0 0 0;
    padding: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    animation: fadeInUp 0.8s ease-out 0.5s both;
  }
  
  .services-page-wrapper-light .btn-primary-xl {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.5rem 3rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
    color: white;
    border: none;
    border-radius: 50px;
    font-size: 1.05rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 10px 40px rgba(59, 130, 246, 0.35), 0 4px 16px rgba(139, 92, 246, 0.2);
    position: relative;
    overflow: hidden;
  }
  
  .services-page-wrapper-light .btn-primary-xl::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.2) 50%, transparent 70%);
    transform: translateX(-150%);
    transition: transform 0.6s ease;
  }
  
  .services-page-wrapper-light .btn-primary-xl:hover {
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 20px 60px rgba(59, 130, 246, 0.45), 0 8px 32px rgba(139, 92, 246, 0.3);
    color: white;
    text-decoration: none;
  }
  
  .services-page-wrapper-light .btn-primary-xl:hover::before {
    transform: translateX(150%);
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
      display: block !important;
      grid-template-columns: unset !important;
      gap: 0 !important;
    }
    
    .services-page-wrapper-light .main-content {
      padding: 2rem 0 !important;
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
      display: block !important;
      grid-template-columns: unset !important;
      gap: 0 !important;
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

<script>
document.addEventListener('DOMContentLoaded', function() {
  const toggleBtn = document.querySelector('[data-services-toggle]');
  if (!toggleBtn) return;

  let isExpanded = false;

  toggleBtn.addEventListener('click', function() {
    const hiddenRows = document.querySelectorAll('.services-hidden-row');
    
    if (!isExpanded) {
      // Expand
      hiddenRows.forEach(row => {
        row.style.display = '';
        // Trigger animation
        setTimeout(() => {
          row.offsetHeight; // Force reflow
        }, 0);
      });
      toggleBtn.setAttribute('data-state', 'expanded');
      toggleBtn.querySelector('span').textContent = 'Voir moins';
      isExpanded = true;
    } else {
      // Collapse
      hiddenRows.forEach(row => {
        row.classList.add('hiding');
        setTimeout(() => {
          row.style.display = 'none';
          row.classList.remove('hiding');
        }, 300);
      });
      toggleBtn.removeAttribute('data-state');
      toggleBtn.querySelector('span').textContent = 'Voir plus';
      isExpanded = false;
    }
  });
});
</script>
