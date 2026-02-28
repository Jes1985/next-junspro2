@php
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'settings';
@endphp

<div class="settings-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Bloc Tableau de bord Freelance -->
      @include('frontend.freelance.dashboard.partials.dashboard-header-section', [
        'freelancerProfile' => $freelancerProfile ?? null
      ])

      <!-- Header de page -->
      <div class="page-header">
        <h1>Paramètres</h1>
        <p class="page-subtitle">
          Gérez votre compte freelance, vos versements et vos préférences.
        </p>
      </div>

      <!-- Contenu principal -->
      <div class="content-section" style="padding:0;margin:0;">
<div class="settings-tiles-pro" style="padding:0;margin:0; margin-left: -4rem; margin-right: -32vw; width: calc(100% + 32vw); padding: 0 4rem;">
  <!-- Identité professionnelle -->
  <div class="settings-tile-pro">
    <div class="tile-icon" title="Identité professionnelle">
      <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" fill="#7c3aed" fill-opacity=".15"/><circle cx="12" cy="8" r="2.5" fill="#7c3aed"/><rect x="5" y="16" width="14" height="5" rx="2.5" fill="#7c3aed" fill-opacity=".10"/></svg>
    </div>
    <div class="tile-title">Identité professionnelle</div>
    <div class="tile-desc">Nom public, localisation, langue, activité.<br><span style="font-size:0.92em;color:#a1a1aa;">Ce que vous affichez au client.</span></div>
    <a href="{{ route('freelance.settings.identity') }}" class="tile-btn">Ouvrir</a>
  </div>

  <!-- Sécurité -->
  <div class="settings-tile-pro">
    <div class="tile-icon" title="Sécurité">
      <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="10" rx="2" fill="#ede9fe"/><rect x="8" y="14" width="8" height="2" rx="1" fill="#7c3aed"/><rect x="10" y="6" width="4" height="4" rx="2" fill="#7c3aed"/></svg>
    </div>
    <div class="tile-title">Sécurité</div>
    <div class="tile-desc">Mot de passe, connexion, protection du compte.</div>
    <a href="{{ route('freelance.settings.security') }}" class="tile-btn">Ouvrir</a>
  </div>

  <!-- Adresse e-mail -->
  <div class="settings-tile-pro">
    <div class="tile-icon" title="Adresse e-mail">
      <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="12" rx="3" fill="#ede9fe"/><path d="M3 8l9 6 9-6" stroke="#7c3aed" stroke-width="1.5"/></svg>
    </div>
    <div class="tile-title">Adresse e-mail</div>
    <div class="tile-desc">E-mail de connexion et notifications.</div>
    <a href="{{ route('freelance.settings.email') }}" class="tile-btn">Ouvrir</a>
  </div>

  <!-- Versements -->
  <div class="settings-tile-pro">
    <div class="tile-icon" title="Versements">
      <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><rect x="4" y="6" width="16" height="12" rx="3" fill="#d1fae5"/><path d="M8 12h8M12 8v8" stroke="#10b981" stroke-width="1.5"/></svg>
    </div>
    <div class="tile-title">Versements</div>
    <div class="tile-desc">RIB/IBAN, préférences de paiement, historique.<br><span style="font-size:0.92em;color:#a1a1aa;">Recommandé avant votre première mission.</span></div>
    <a href="{{ route('freelance.settings.payouts') }}" class="tile-btn">Configurer</a>
  </div>

  <!-- Notifications -->
  <div class="settings-tile-pro">
    <div class="tile-icon" title="Notifications">
      <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><rect x="5" y="7" width="14" height="10" rx="4" fill="#fef9c3"/><path d="M12 17v2" stroke="#f59e0b" stroke-width="1.5"/><circle cx="12" cy="12" r="2" fill="#f59e0b"/></svg>
    </div>
    <div class="tile-title">Notifications</div>
    <div class="tile-desc">Rappels, demandes, messages, bilans.</div>
    <a href="{{ route('freelance.settings.notifications') }}" class="tile-btn">Personnaliser</a>
  </div>

  <!-- Vidéo de présentation -->
  <div class="settings-tile-pro">
    <div class="tile-icon" title="Vidéo de présentation">
      <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><rect x="4" y="6" width="16" height="12" rx="3" fill="#f3e8ff"/><polygon points="11,10 16,13 11,16" fill="#a21caf"/></svg>
    </div>
    <div class="tile-title">Vidéo de présentation</div>
    <div class="tile-desc">Ajoutez ou modifiez votre vidéo de présentation.<br><span style="font-size:0.92em;color:#a1a1aa;">YouTube, Vimeo ou URL directe.</span></div>
    <a href="{{ route('freelance.settings.video') }}" class="tile-btn">Modifier</a>
  </div>

  <!-- Connexions & autorisations -->
  <div class="settings-tile-pro">
    <div class="tile-icon" title="Connexions & autorisations">
      <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><circle cx="8" cy="12" r="4" fill="#dbeafe"/><circle cx="16" cy="12" r="4" fill="#a5b4fc"/></svg>
    </div>
    <div class="tile-title">Connexions & autorisations</div>
    <div class="tile-desc">Gérer vos connexions sociales et accès.</div>
    <a href="{{ route('freelance.settings.integrations') }}" class="tile-btn">Gérer</a>
  </div>

  <!-- Fermer le compte -->
  <div class="settings-tile-pro danger">
    <div class="tile-icon" title="Fermer le compte">
      <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><rect x="4" y="6" width="16" height="12" rx="3" fill="#fee2e2"/><path d="M8 10l8 8M8 18l8-8" stroke="#ef4444" stroke-width="1.5"/></svg>
    </div>
    <div class="tile-title">Fermer le compte</div>
    <div class="tile-desc">Désactiver ou supprimer votre compte freelance.<br><span style="font-size:0.92em;color:#ef4444;">Action réversible 14 jours (si possible), sinon demander confirmation.</span></div>
    <a href="{{ route('freelance.settings.close') }}" class="tile-btn">Ouvrir</a>
    <span class="tile-badge">Danger</span>
  </div>
</div>
      </div>
    </main>

    <!-- ===== SIDEBAR (30%) - LIGHT ===== -->
    @include('frontend.freelance.dashboard.partials.dashboard-sidebar-section', [
      'activeTab' => $activeTab ?? 'settings'
    ])
  </div>
</div>

{{-- Styles CSS communs du shell premium --}}
@include('frontend.freelance.dashboard.partials.dashboard-shell-styles')

<style>
  /* ===== STYLES SPÉCIFIQUES À L'ONGLET PARAMÈTRES ===== */
  /* Les styles communs sont dans dashboard-shell-styles.blade.php */
  
  /* ===== RESET ET VARIABLES LIGHT ===== */
  .settings-page-wrapper-light {
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
  
  .settings-page-wrapper-light * {
    box-sizing: border-box;
  }
  
  .settings-page-wrapper-light {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    min-height: 100vh;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT (Style identique à Demandes) ===== */
  .settings-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite comme Demandes */
    box-sizing: border-box;
  }
  
  .settings-page-wrapper-light .dashboard-container {
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
  .settings-page-wrapper-light .main-content {
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
  .settings-page-wrapper-light .dashboard-overview-hero {
    position: relative !important; margin: 0 !important; margin-bottom: 3rem !important;
    padding: 0 !important; border: none !important; background: transparent !important;
    width: 100% !important; max-width: 100% !important; overflow: visible !important;
  }
  .settings-page-wrapper-light .dashboard-overview-hero .hero-glow {
    position: absolute; top: -50px; left: 50%; transform: translateX(-50%);
    width: 800px; height: 600px;
    background: radial-gradient(circle at 30% 50%, rgba(124, 58, 237, 0.15) 0%, rgba(30, 64, 175, 0.1) 35%, transparent 80%);
    border-radius: 50%; filter: blur(100px); pointer-events: none; z-index: 0;
  }
  .settings-page-wrapper-light .dashboard-overview-hero .hero-content {
    position: relative; z-index: 1; display: grid; grid-template-columns: 1fr 1fr;
    gap: 4rem; align-items: center; padding: 3rem 0; width: 100%; box-sizing: border-box;
  }
  .settings-page-wrapper-light .dashboard-overview-hero .hero-text { display: flex; flex-direction: column; gap: 1.5rem; padding: 0; }
  .settings-page-wrapper-light .dashboard-overview-hero .hero-title {
    font-size: 2.5rem; font-weight: 800; line-height: 1.2; color: #111827; margin: 0; letter-spacing: -0.02em;
    background: linear-gradient(135deg, #111827 0%, #374151 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
  }
  .settings-page-wrapper-light .dashboard-overview-hero .hero-subtitle { font-size: 1.125rem; line-height: 1.6; color: #6b7280; margin: 0; font-weight: 400; max-width: 550px; }
  .settings-page-wrapper-light .dashboard-overview-hero .hero-ctas { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 0.5rem; }
  .settings-page-wrapper-light .dashboard-overview-hero .btn-hero {
    padding: 1rem 1.75rem; font-size: 1rem; font-weight: 600; border-radius: 14px; border: none;
    cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-family: inherit;
  }
  .settings-page-wrapper-light .dashboard-overview-hero .btn-hero-primary { background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); color: white; box-shadow: 0 10px 30px rgba(124, 58, 237, 0.25); }
  .settings-page-wrapper-light .dashboard-overview-hero .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(124, 58, 237, 0.35); color: white; text-decoration: none; }
  .settings-page-wrapper-light .dashboard-overview-hero .btn-hero-secondary { background: white; color: #1e40af; border: 2px solid #1e40af; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.1); }
  .settings-page-wrapper-light .dashboard-overview-hero .btn-hero-secondary:hover { background: #f0f4ff; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30, 64, 175, 0.15); color: #1e40af; text-decoration: none; }
  .settings-page-wrapper-light .dashboard-overview-hero .btn-text { display: inline; }
  .settings-page-wrapper-light .dashboard-overview-hero .btn-icon { font-size: 1.2rem; display: inline-block; transition: transform 0.3s ease; }
  .settings-page-wrapper-light .dashboard-overview-hero .btn-hero:hover .btn-icon { transform: translateX(3px); }
  .settings-page-wrapper-light .dashboard-overview-hero .hero-hint { font-size: 0.9rem; color: #6b7280; margin: 0; margin-top: 0.5rem; font-weight: 500; }
  .settings-page-wrapper-light .dashboard-overview-hero .hero-visual { display: flex; align-items: center; justify-content: center; padding: 2rem; }
  .settings-page-wrapper-light .dashboard-overview-hero .hero-visual-card {
    position: relative; width: 100%; max-width: 350px; padding: 3rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border: 1px solid #e2e8f0;
    border-radius: 24px; text-align: center; box-shadow: 0 20px 60px rgba(0,0,0,0.08); overflow: hidden;
  }
  .settings-page-wrapper-light .dashboard-overview-hero .hero-visual-card::before {
    content: ''; position: absolute; top: 0; right: 0; width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(124,58,237,0.1) 0%, transparent 70%);
    border-radius: 50%; transform: translate(100px, -100px);
  }
  .settings-page-wrapper-light .dashboard-overview-hero .visual-badge {
    display: inline-block; padding: 0.5rem 1rem; background: linear-gradient(135deg, #ddd6fe 0%, #e9d5ff 100%);
    color: #6d28d9; font-size: 0.85rem; font-weight: 600; border-radius: 20px; margin-bottom: 1.5rem; position: relative; z-index: 1;
  }
  .settings-page-wrapper-light .dashboard-overview-hero .visual-icon { font-size: 3.5rem; margin-bottom: 1rem; display: block; position: relative; z-index: 1; }
  .settings-page-wrapper-light .dashboard-overview-hero .visual-text { font-size: 1.25rem; font-weight: 700; color: #111827; line-height: 1.5; margin: 0; position: relative; z-index: 1; }
  @media (max-width: 1024px) {
    .settings-page-wrapper-light .dashboard-overview-hero .hero-content { grid-template-columns: 1fr; gap: 2.5rem; padding: 2.5rem 0; }
    .settings-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 2rem; }
    .settings-page-wrapper-light .dashboard-overview-hero .hero-visual-card { max-width: 280px; }
  }
  @media (max-width: 768px) {
    .settings-page-wrapper-light .dashboard-overview-hero .hero-content { padding: 2rem 0; }
    .settings-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 1.75rem; }
    .settings-page-wrapper-light .dashboard-overview-hero .hero-ctas { flex-direction: column; }
    .settings-page-wrapper-light .dashboard-overview-hero .btn-hero { width: 100%; justify-content: center; }
    .settings-page-wrapper-light .dashboard-overview-hero .hero-visual-card { max-width: 250px; padding: 2rem 1.5rem; }
  }
  @media (max-width: 480px) {
    .settings-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 1.5rem; }
    .settings-page-wrapper-light .dashboard-overview-hero .btn-hero { padding: 0.875rem 1.5rem; font-size: 0.95rem; }
    .settings-page-wrapper-light .dashboard-overview-hero .visual-icon { font-size: 2.5rem; }
  }

  /* ===== HEADER PREMIUM - CENTRÉ (Style identique à Demandes) ===== */
  .settings-page-wrapper-light .page-header {
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
  
  .settings-page-wrapper-light .page-header::after {
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
  
  .settings-page-wrapper-light .page-header h1 {
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
  
  .settings-page-wrapper-light .page-subtitle {
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
  .settings-page-wrapper-light .content-section {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  
  /* ===== SIDEBAR (30%) ===== */
  .settings-page-wrapper-light .sidebar {
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
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important;
  }
  
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 6px;
  }
  
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 6px;
  }
  
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }
  
  .settings-page-wrapper-light .nav-section,
  .settings-page-wrapper-light .stats-section,
  .settings-page-wrapper-light .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
    margin-bottom: 2rem;
    padding-left: 10px !important; /* Décalage de 1cm (10px) vers la droite pour voir les icônes */
  }
  
  .settings-page-wrapper-light .nav-title {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--text-tertiary);
    margin-bottom: 1.25rem;
    font-weight: 600;
  }
  
  .settings-page-wrapper-light .nav-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .settings-page-wrapper-light .nav-item {
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
  
  .settings-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05);
    color: var(--primary);
    text-decoration: none;
  }
  
  .settings-page-wrapper-light .nav-item.active {
    background: rgba(59, 130, 246, 0.1);
    color: var(--primary);
    font-weight: 600;
    border-left: 3px solid var(--primary);
  }
  
  .settings-page-wrapper-light .nav-icon {
    font-size: 1.125rem;
    width: 24px;
    text-align: center;
  }
  
  .settings-page-wrapper-light .stats-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .settings-page-wrapper-light .stats-grid {
    display: grid;
    gap: 1rem;
  }
  
  .settings-page-wrapper-light .stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-light);
  }
  
  .settings-page-wrapper-light .stat-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }
  
  .settings-page-wrapper-light .stat-label {
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
  }
  
  .settings-page-wrapper-light .stat-value {
    font-weight: 700;
    font-size: 1.125rem;
    color: var(--text-primary);
  }
  
  .settings-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
    font-weight: 800;
  }
  
  .settings-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .settings-page-wrapper-light .tip-icon {
    color: var(--accent);
    font-size: 1.25rem;
  }
  
  .settings-page-wrapper-light .tip-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-primary);
  }
  
  .settings-page-wrapper-light .tip-content {
    color: var(--text-secondary);
    font-size: 0.875rem;
    line-height: 1.5;
  }
  
  .settings-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.75rem;
  }
  
  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .settings-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 2rem 0 !important;
    }
    
    .settings-page-wrapper-light .main-content {
      padding: 3rem 10px !important;
    }
    
    .settings-page-wrapper-light .sidebar {
      position: relative !important;
      top: 0 !important;
      padding: 2.5rem 10px !important;
      max-height: none !important;
    }
  }
  
  @media (max-width: 768px) {
    .settings-page-wrapper-light .page-header h1 {
      font-size: 2rem !important;
    }
    
    .settings-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }
  }

  @media (max-width: 480px) {
    .settings-page-wrapper-light .page-header h1 {
      font-size: 1.75rem !important;
    }

    .settings-page-wrapper-light .page-subtitle {
      font-size: 1rem !important;
    }
    
    .settings-page-wrapper-light .main-content {
      padding: 1.5rem 8px !important;
    }

    .settings-page-wrapper-light .settings-tile {
      padding: 1.25rem !important;
    }
  }
</style>
