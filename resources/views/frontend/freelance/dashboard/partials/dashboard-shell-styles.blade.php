{{-- Styles CSS communs pour le shell premium du dashboard freelance --}}
{{-- À inclure dans chaque fichier d'onglet --}}

<style>
  /* ===== VARIABLES CSS COMMUNES ===== */
  .dashboard-page-wrapper-light,
  .overview-page-wrapper-light,
  .requests-page-wrapper-light,
  .jobs-page-wrapper-light,
  .calendar-page-wrapper-light,
  .services-page-wrapper-light,
  .messages-page-wrapper-light,
  .earnings-page-wrapper-light,
  .profile-page-wrapper-light,
  .settings-page-wrapper-light,
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

  /* ===== RESET GLOBAL ===== */
  .dashboard-page-wrapper-light *,
  .overview-page-wrapper-light *,
  .requests-page-wrapper-light *,
  .jobs-page-wrapper-light *,
  .calendar-page-wrapper-light *,
  .services-page-wrapper-light *,
  .messages-page-wrapper-light *,
  .earnings-page-wrapper-light *,
  .profile-page-wrapper-light *,
  .settings-page-wrapper-light *,
  .rituals-page-wrapper-light * {
    box-sizing: border-box;
  }

  /* ===== STRUCTURE 70/30 PREMIUM ===== */
  .dashboard-page-wrapper-light,
  .overview-page-wrapper-light,
  .requests-page-wrapper-light,
  .jobs-page-wrapper-light,
  .calendar-page-wrapper-light,
  .services-page-wrapper-light,
  .messages-page-wrapper-light,
  .earnings-page-wrapper-light,
  .profile-page-wrapper-light,
  .settings-page-wrapper-light,
  .rituals-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 20px 32px 20px 32px !important; /* 2cm (20px) top/bottom, 2cm (32px) left/right */
    box-sizing: border-box;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    line-height: 1.5;
  }

  .dashboard-page-wrapper-light .dashboard-container,
  .overview-page-wrapper-light .dashboard-container,
  .requests-page-wrapper-light .dashboard-container,
  .jobs-page-wrapper-light .dashboard-container,
  .calendar-page-wrapper-light .dashboard-container,
  .services-page-wrapper-light .dashboard-container,
  .messages-page-wrapper-light .dashboard-container,
  .earnings-page-wrapper-light .dashboard-container,
  .profile-page-wrapper-light .dashboard-container,
  .settings-page-wrapper-light .dashboard-container,
  .rituals-page-wrapper-light .dashboard-container {
    display: grid !important;
    grid-template-columns: 70% 30% !important;
    min-height: 100vh;
    max-width: none !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    background: transparent;
    box-shadow: none;
    box-sizing: border-box;
    gap: 0 32px !important; /* Espacement de 2cm (32px) entre les zones 70% et 30% */
    align-items: start !important;
    overflow-x: visible !important;
  }

  /* ===== ZONE PRINCIPALE (70%) ===== */
  .dashboard-page-wrapper-light .main-content,
  .overview-page-wrapper-light .main-content,
  .requests-page-wrapper-light .main-content,
  .jobs-page-wrapper-light .main-content,
  .calendar-page-wrapper-light .main-content,
  .services-page-wrapper-light .main-content,
  .messages-page-wrapper-light .main-content,
  .earnings-page-wrapper-light .main-content,
  .profile-page-wrapper-light .main-content,
  .settings-page-wrapper-light .main-content,
  .rituals-page-wrapper-light .main-content {
    padding: 4rem 32px !important; /* Padding horizontal de 2cm (32px) pour espacement premium */
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
  }

  /* ===== BLOC TABLEAU DE BORD FREELANCE ===== */
  .dashboard-page-wrapper-light .dashboard-header,
  .overview-page-wrapper-light .dashboard-header,
  .requests-page-wrapper-light .dashboard-header,
  .jobs-page-wrapper-light .dashboard-header,
  .calendar-page-wrapper-light .dashboard-header,
  .services-page-wrapper-light .dashboard-header,
  .messages-page-wrapper-light .dashboard-header,
  .earnings-page-wrapper-light .dashboard-header,
  .profile-page-wrapper-light .dashboard-header,
  .settings-page-wrapper-light .dashboard-header,
  .rituals-page-wrapper-light .dashboard-header {
    margin-top: 2rem;
    margin-left: 0;
    margin-right: 0;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    width: 100vw !important;
    max-width: 100vw !important;
    min-width: 100vw !important;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .dashboard-page-wrapper-light .dashboard-header h1,
  .overview-page-wrapper-light .dashboard-header h1,
  .requests-page-wrapper-light .dashboard-header h1,
  .jobs-page-wrapper-light .dashboard-header h1,
  .calendar-page-wrapper-light .dashboard-header h1,
  .services-page-wrapper-light .dashboard-header h1,
  .messages-page-wrapper-light .dashboard-header h1,
  .earnings-page-wrapper-light .dashboard-header h1,
  .profile-page-wrapper-light .dashboard-header h1,
  .settings-page-wrapper-light .dashboard-header h1,
  .rituals-page-wrapper-light .dashboard-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
  }

  .dashboard-page-wrapper-light .dashboard-header-subtitle,
  .overview-page-wrapper-light .dashboard-header-subtitle,
  .requests-page-wrapper-light .dashboard-header-subtitle,
  .jobs-page-wrapper-light .dashboard-header-subtitle,
  .calendar-page-wrapper-light .dashboard-header-subtitle,
  .services-page-wrapper-light .dashboard-header-subtitle,
  .messages-page-wrapper-light .dashboard-header-subtitle,
  .earnings-page-wrapper-light .dashboard-header-subtitle,
  .profile-page-wrapper-light .dashboard-header-subtitle,
  .settings-page-wrapper-light .dashboard-header-subtitle,
  .rituals-page-wrapper-light .dashboard-header-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin-bottom: 1.25rem;
    line-height: 1.5;
  }

  .dashboard-page-wrapper-light .dashboard-header-ctas,
  .overview-page-wrapper-light .dashboard-header-ctas,
  .requests-page-wrapper-light .dashboard-header-ctas,
  .jobs-page-wrapper-light .dashboard-header-ctas,
  .calendar-page-wrapper-light .dashboard-header-ctas,
  .services-page-wrapper-light .dashboard-header-ctas,
  .messages-page-wrapper-light .dashboard-header-ctas,
  .earnings-page-wrapper-light .dashboard-header-ctas,
  .profile-page-wrapper-light .dashboard-header-ctas,
  .settings-page-wrapper-light .dashboard-header-ctas,
  .rituals-page-wrapper-light .dashboard-header-ctas {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .dashboard-page-wrapper-light .btn-premium,
  .overview-page-wrapper-light .btn-premium,
  .requests-page-wrapper-light .btn-premium,
  .jobs-page-wrapper-light .btn-premium,
  .calendar-page-wrapper-light .btn-premium,
  .services-page-wrapper-light .btn-premium,
  .messages-page-wrapper-light .btn-premium,
  .earnings-page-wrapper-light .btn-premium,
  .profile-page-wrapper-light .btn-premium,
  .settings-page-wrapper-light .btn-premium,
  .rituals-page-wrapper-light .btn-premium {
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

  .dashboard-page-wrapper-light .btn-premium-primary,
  .overview-page-wrapper-light .btn-premium-primary,
  .requests-page-wrapper-light .btn-premium-primary,
  .jobs-page-wrapper-light .btn-premium-primary,
  .calendar-page-wrapper-light .btn-premium-primary,
  .services-page-wrapper-light .btn-premium-primary,
  .messages-page-wrapper-light .btn-premium-primary,
  .earnings-page-wrapper-light .btn-premium-primary,
  .profile-page-wrapper-light .btn-premium-primary,
  .settings-page-wrapper-light .btn-premium-primary,
  .rituals-page-wrapper-light .btn-premium-primary {
    background: #ede9fe;
    color: #7c3aed;
    border: 1px solid #ddd6fe;
    box-shadow: 0 2px 8px rgba(167, 139, 250, 0.2);
  }

  .dashboard-page-wrapper-light .btn-premium-primary:hover,
  .overview-page-wrapper-light .btn-premium-primary:hover,
  .requests-page-wrapper-light .btn-premium-primary:hover,
  .jobs-page-wrapper-light .btn-premium-primary:hover,
  .calendar-page-wrapper-light .btn-premium-primary:hover,
  .services-page-wrapper-light .btn-premium-primary:hover,
  .messages-page-wrapper-light .btn-premium-primary:hover,
  .earnings-page-wrapper-light .btn-premium-primary:hover,
  .profile-page-wrapper-light .btn-premium-primary:hover,
  .settings-page-wrapper-light .btn-premium-primary:hover,
  .rituals-page-wrapper-light .btn-premium-primary:hover {
    background: #ddd6fe;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(167, 139, 250, 0.35);
    color: #7c3aed;
    text-decoration: none;
  }

  .dashboard-page-wrapper-light .btn-premium-secondary,
  .overview-page-wrapper-light .btn-premium-secondary,
  .requests-page-wrapper-light .btn-premium-secondary,
  .jobs-page-wrapper-light .btn-premium-secondary,
  .calendar-page-wrapper-light .btn-premium-secondary,
  .services-page-wrapper-light .btn-premium-secondary,
  .messages-page-wrapper-light .btn-premium-secondary,
  .earnings-page-wrapper-light .btn-premium-secondary,
  .profile-page-wrapper-light .btn-premium-secondary,
  .settings-page-wrapper-light .btn-premium-secondary,
  .rituals-page-wrapper-light .btn-premium-secondary {
    background: white;
    color: #1e40af;
    border: 2px solid #1e40af;
  }

  .dashboard-page-wrapper-light .btn-premium-secondary:hover,
  .overview-page-wrapper-light .btn-premium-secondary:hover,
  .requests-page-wrapper-light .btn-premium-secondary:hover,
  .jobs-page-wrapper-light .btn-premium-secondary:hover,
  .calendar-page-wrapper-light .btn-premium-secondary:hover,
  .services-page-wrapper-light .btn-premium-secondary:hover,
  .messages-page-wrapper-light .btn-premium-secondary:hover,
  .earnings-page-wrapper-light .btn-premium-secondary:hover,
  .profile-page-wrapper-light .btn-premium-secondary:hover,
  .settings-page-wrapper-light .btn-premium-secondary:hover,
  .rituals-page-wrapper-light .btn-premium-secondary:hover {
    background: #f8fafc;
    transform: translateY(-1px);
    color: #1e40af;
    text-decoration: none;
  }

  /* ===== SIDEBAR (30%) - NAVIGATION PREMIUM ===== */
  .dashboard-page-wrapper-light .sidebar,
  .overview-page-wrapper-light .sidebar,
  .requests-page-wrapper-light .sidebar,
  .jobs-page-wrapper-light .sidebar,
  .calendar-page-wrapper-light .sidebar,
  .services-page-wrapper-light .sidebar,
  .messages-page-wrapper-light .sidebar,
  .earnings-page-wrapper-light .sidebar,
  .profile-page-wrapper-light .sidebar,
  .settings-page-wrapper-light .sidebar,
  .rituals-page-wrapper-light .sidebar {
    padding: 2.5rem 32px 2.5rem 2rem !important; /* Padding horizontal de 2cm (32px) à droite, 2rem à gauche */
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
    overflow-x: visible !important; /* IMPORTANT : permet aux icônes de ne pas être coupées */
    box-sizing: border-box !important;
    grid-column: 2 !important;
    align-self: start !important;
  }

  .dashboard-page-wrapper-light .sidebar .nav-section,
  .dashboard-page-wrapper-light .sidebar .stats-section,
  .dashboard-page-wrapper-light .sidebar .tips-section,
  .overview-page-wrapper-light .sidebar .nav-section,
  .overview-page-wrapper-light .sidebar .stats-section,
  .overview-page-wrapper-light .sidebar .tips-section,
  .requests-page-wrapper-light .sidebar .nav-section,
  .requests-page-wrapper-light .sidebar .stats-section,
  .requests-page-wrapper-light .sidebar .tips-section,
  .jobs-page-wrapper-light .sidebar .nav-section,
  .jobs-page-wrapper-light .sidebar .stats-section,
  .jobs-page-wrapper-light .sidebar .tips-section,
  .calendar-page-wrapper-light .sidebar .nav-section,
  .calendar-page-wrapper-light .sidebar .stats-section,
  .calendar-page-wrapper-light .sidebar .tips-section,
  .services-page-wrapper-light .sidebar .nav-section,
  .services-page-wrapper-light .sidebar .stats-section,
  .services-page-wrapper-light .sidebar .tips-section,
  .messages-page-wrapper-light .sidebar .nav-section,
  .messages-page-wrapper-light .sidebar .stats-section,
  .messages-page-wrapper-light .sidebar .tips-section,
  .earnings-page-wrapper-light .sidebar .nav-section,
  .earnings-page-wrapper-light .sidebar .stats-section,
  .earnings-page-wrapper-light .sidebar .tips-section,
  .profile-page-wrapper-light .sidebar .nav-section,
  .profile-page-wrapper-light .sidebar .stats-section,
  .profile-page-wrapper-light .sidebar .tips-section,
  .settings-page-wrapper-light .sidebar .nav-section,
  .settings-page-wrapper-light .sidebar .stats-section,
  .settings-page-wrapper-light .sidebar .tips-section,
  .rituals-page-wrapper-light .sidebar .nav-section,
  .rituals-page-wrapper-light .sidebar .stats-section,
  .rituals-page-wrapper-light .sidebar .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
    overflow: visible !important; /* IMPORTANT : permet aux icônes de ne pas être coupées */
    position: relative !important;
    z-index: 1 !important;
  }

  /* Scrollbar premium épaisse */
  .dashboard-page-wrapper-light .sidebar::-webkit-scrollbar,
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar,
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar,
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar,
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar,
  .services-page-wrapper-light .sidebar::-webkit-scrollbar,
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar,
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar,
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar,
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar,
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important;
  }

  .dashboard-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .services-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar-track,
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 10px;
    margin: 8px 0;
  }

  .dashboard-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .services-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb,
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 10px;
    border: 2px solid var(--bg-secondary);
  }

  .dashboard-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .requests-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .jobs-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .services-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .messages-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .earnings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .profile-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .settings-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover,
  .rituals-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }

  /* Support Firefox */
  .dashboard-page-wrapper-light .sidebar,
  .overview-page-wrapper-light .sidebar,
  .requests-page-wrapper-light .sidebar,
  .jobs-page-wrapper-light .sidebar,
  .calendar-page-wrapper-light .sidebar,
  .services-page-wrapper-light .sidebar,
  .messages-page-wrapper-light .sidebar,
  .earnings-page-wrapper-light .sidebar,
  .profile-page-wrapper-light .sidebar,
  .settings-page-wrapper-light .sidebar,
  .rituals-page-wrapper-light .sidebar {
    scrollbar-width: thick !important;
    scrollbar-color: var(--border) var(--bg-secondary) !important;
  }

  /* ===== NAVIGATION - CORRECTION ICÔNES ===== */
  .dashboard-page-wrapper-light .nav-section,
  .overview-page-wrapper-light .nav-section,
  .requests-page-wrapper-light .nav-section,
  .jobs-page-wrapper-light .nav-section,
  .calendar-page-wrapper-light .nav-section,
  .services-page-wrapper-light .nav-section,
  .messages-page-wrapper-light .nav-section,
  .earnings-page-wrapper-light .nav-section,
  .profile-page-wrapper-light .nav-section,
  .settings-page-wrapper-light .nav-section,
  .rituals-page-wrapper-light .nav-section {
    margin-bottom: 3.5rem !important;
    width: 100% !important;
    box-sizing: border-box !important;
    position: relative !important;
    z-index: 1 !important;
    overflow: visible !important; /* CRITIQUE : permet aux icônes de ne pas être coupées */
    padding-left: 10px !important; /* Décalage de 1cm pour voir les icônes */
  }

  .dashboard-page-wrapper-light .nav-title,
  .overview-page-wrapper-light .nav-title,
  .requests-page-wrapper-light .nav-title,
  .jobs-page-wrapper-light .nav-title,
  .calendar-page-wrapper-light .nav-title,
  .services-page-wrapper-light .nav-title,
  .messages-page-wrapper-light .nav-title,
  .earnings-page-wrapper-light .nav-title,
  .profile-page-wrapper-light .nav-title,
  .settings-page-wrapper-light .nav-title,
  .rituals-page-wrapper-light .nav-title {
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    color: var(--text-tertiary) !important;
    margin-bottom: 1.5rem !important;
    padding: 0 !important;
  }

  .dashboard-page-wrapper-light .nav-list,
  .overview-page-wrapper-light .nav-list,
  .requests-page-wrapper-light .nav-list,
  .jobs-page-wrapper-light .nav-list,
  .calendar-page-wrapper-light .nav-list,
  .services-page-wrapper-light .nav-list,
  .messages-page-wrapper-light .nav-list,
  .earnings-page-wrapper-light .nav-list,
  .profile-page-wrapper-light .nav-list,
  .settings-page-wrapper-light .nav-list,
  .rituals-page-wrapper-light .nav-list {
    display: flex !important;
    flex-direction: column !important;
    gap: 0.75rem !important;
    width: 100% !important;
    overflow: visible !important; /* CRITIQUE : permet aux icônes de ne pas être coupées */
  }

  .dashboard-page-wrapper-light .nav-item,
  .overview-page-wrapper-light .nav-item,
  .requests-page-wrapper-light .nav-item,
  .jobs-page-wrapper-light .nav-item,
  .calendar-page-wrapper-light .nav-item,
  .services-page-wrapper-light .nav-item,
  .messages-page-wrapper-light .nav-item,
  .earnings-page-wrapper-light .nav-item,
  .profile-page-wrapper-light .nav-item,
  .settings-page-wrapper-light .nav-item,
  .rituals-page-wrapper-light .nav-item {
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
    overflow: visible !important; /* CRITIQUE : permet aux icônes de ne pas être coupées */
    position: relative !important;
    z-index: 1 !important;
  }

  .dashboard-page-wrapper-light .nav-item:hover,
  .overview-page-wrapper-light .nav-item:hover,
  .requests-page-wrapper-light .nav-item:hover,
  .jobs-page-wrapper-light .nav-item:hover,
  .calendar-page-wrapper-light .nav-item:hover,
  .services-page-wrapper-light .nav-item:hover,
  .messages-page-wrapper-light .nav-item:hover,
  .earnings-page-wrapper-light .nav-item:hover,
  .profile-page-wrapper-light .nav-item:hover,
  .settings-page-wrapper-light .nav-item:hover,
  .rituals-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05) !important;
    color: var(--primary) !important;
    border-color: rgba(59, 130, 246, 0.1) !important;
  }

  .dashboard-page-wrapper-light .nav-item.active,
  .overview-page-wrapper-light .nav-item.active,
  .requests-page-wrapper-light .nav-item.active,
  .jobs-page-wrapper-light .nav-item.active,
  .calendar-page-wrapper-light .nav-item.active,
  .services-page-wrapper-light .nav-item.active,
  .messages-page-wrapper-light .nav-item.active,
  .earnings-page-wrapper-light .nav-item.active,
  .profile-page-wrapper-light .nav-item.active,
  .settings-page-wrapper-light .nav-item.active,
  .rituals-page-wrapper-light .nav-item.active {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%) !important;
    color: var(--primary) !important;
    border-color: var(--primary) !important;
    font-weight: 600 !important;
  }

  /* ===== CORRECTION ICÔNES - VISIBILITÉ ET ALIGNEMENT ===== */
  .dashboard-page-wrapper-light .nav-icon,
  .overview-page-wrapper-light .nav-icon,
  .requests-page-wrapper-light .nav-icon,
  .jobs-page-wrapper-light .nav-icon,
  .calendar-page-wrapper-light .nav-icon,
  .services-page-wrapper-light .nav-icon,
  .messages-page-wrapper-light .nav-icon,
  .earnings-page-wrapper-light .nav-icon,
  .profile-page-wrapper-light .nav-icon,
  .settings-page-wrapper-light .nav-icon,
  .rituals-page-wrapper-light .nav-icon {
    font-size: 1.25rem !important;
    flex-shrink: 0 !important;
    width: 28px !important; /* Largeur fixe pour éviter la coupe */
    min-width: 28px !important;
    max-width: 28px !important;
    text-align: center !important;
    line-height: 1 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    overflow: visible !important; /* CRITIQUE : permet aux icônes de ne pas être coupées */
    position: relative !important;
    z-index: 2 !important; /* Au-dessus du texte */
    opacity: 1 !important; /* Visibilité maximale */
    filter: none !important; /* Pas de filtre qui éteint les icônes */
  }

  /* ===== STATISTIQUES ===== */
  .dashboard-page-wrapper-light .stats-section,
  .overview-page-wrapper-light .stats-section,
  .requests-page-wrapper-light .stats-section,
  .jobs-page-wrapper-light .stats-section,
  .calendar-page-wrapper-light .stats-section,
  .services-page-wrapper-light .stats-section,
  .messages-page-wrapper-light .stats-section,
  .earnings-page-wrapper-light .stats-section,
  .profile-page-wrapper-light .stats-section,
  .settings-page-wrapper-light .stats-section,
  .rituals-page-wrapper-light .stats-section {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-bottom: 2.5rem;
    box-shadow: var(--shadow-sm);
    overflow: visible !important;
    padding-left: 10px !important; /* Décalage de 1cm pour voir les icônes */
  }

  .dashboard-page-wrapper-light .stats-title,
  .overview-page-wrapper-light .stats-title,
  .requests-page-wrapper-light .stats-title,
  .jobs-page-wrapper-light .stats-title,
  .calendar-page-wrapper-light .stats-title,
  .services-page-wrapper-light .stats-title,
  .messages-page-wrapper-light .stats-title,
  .earnings-page-wrapper-light .stats-title,
  .profile-page-wrapper-light .stats-title,
  .settings-page-wrapper-light .stats-title,
  .rituals-page-wrapper-light .stats-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .dashboard-page-wrapper-light .stats-title svg,
  .overview-page-wrapper-light .stats-title svg,
  .requests-page-wrapper-light .stats-title svg,
  .jobs-page-wrapper-light .stats-title svg,
  .calendar-page-wrapper-light .stats-title svg,
  .services-page-wrapper-light .stats-title svg,
  .messages-page-wrapper-light .stats-title svg,
  .earnings-page-wrapper-light .stats-title svg,
  .profile-page-wrapper-light .stats-title svg,
  .settings-page-wrapper-light .stats-title svg,
  .rituals-page-wrapper-light .stats-title svg {
    color: var(--primary);
  }

  .dashboard-page-wrapper-light .stats-grid,
  .overview-page-wrapper-light .stats-grid,
  .requests-page-wrapper-light .stats-grid,
  .jobs-page-wrapper-light .stats-grid,
  .calendar-page-wrapper-light .stats-grid,
  .services-page-wrapper-light .stats-grid,
  .messages-page-wrapper-light .stats-grid,
  .earnings-page-wrapper-light .stats-grid,
  .profile-page-wrapper-light .stats-grid,
  .settings-page-wrapper-light .stats-grid,
  .rituals-page-wrapper-light .stats-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .dashboard-page-wrapper-light .stat-item,
  .overview-page-wrapper-light .stat-item,
  .requests-page-wrapper-light .stat-item,
  .jobs-page-wrapper-light .stat-item,
  .calendar-page-wrapper-light .stat-item,
  .services-page-wrapper-light .stat-item,
  .messages-page-wrapper-light .stat-item,
  .earnings-page-wrapper-light .stat-item,
  .profile-page-wrapper-light .stat-item,
  .settings-page-wrapper-light .stat-item,
  .rituals-page-wrapper-light .stat-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .dashboard-page-wrapper-light .stat-label,
  .overview-page-wrapper-light .stat-label,
  .requests-page-wrapper-light .stat-label,
  .jobs-page-wrapper-light .stat-label,
  .calendar-page-wrapper-light .stat-label,
  .services-page-wrapper-light .stat-label,
  .messages-page-wrapper-light .stat-label,
  .earnings-page-wrapper-light .stat-label,
  .profile-page-wrapper-light .stat-label,
  .settings-page-wrapper-light .stat-label,
  .rituals-page-wrapper-light .stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
  }

  .dashboard-page-wrapper-light .stat-value,
  .overview-page-wrapper-light .stat-value,
  .requests-page-wrapper-light .stat-value,
  .jobs-page-wrapper-light .stat-value,
  .calendar-page-wrapper-light .stat-value,
  .services-page-wrapper-light .stat-value,
  .messages-page-wrapper-light .stat-value,
  .earnings-page-wrapper-light .stat-value,
  .profile-page-wrapper-light .stat-value,
  .settings-page-wrapper-light .stat-value,
  .rituals-page-wrapper-light .stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--primary);
  }

  .dashboard-page-wrapper-light .stat-value.highlight,
  .overview-page-wrapper-light .stat-value.highlight,
  .requests-page-wrapper-light .stat-value.highlight,
  .jobs-page-wrapper-light .stat-value.highlight,
  .calendar-page-wrapper-light .stat-value.highlight,
  .services-page-wrapper-light .stat-value.highlight,
  .messages-page-wrapper-light .stat-value.highlight,
  .earnings-page-wrapper-light .stat-value.highlight,
  .profile-page-wrapper-light .stat-value.highlight,
  .settings-page-wrapper-light .stat-value.highlight,
  .rituals-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
  }

  /* ===== CONSEILS ===== */
  .dashboard-page-wrapper-light .tips-section,
  .overview-page-wrapper-light .tips-section,
  .requests-page-wrapper-light .tips-section,
  .jobs-page-wrapper-light .tips-section,
  .calendar-page-wrapper-light .tips-section,
  .services-page-wrapper-light .tips-section,
  .messages-page-wrapper-light .tips-section,
  .earnings-page-wrapper-light .tips-section,
  .profile-page-wrapper-light .tips-section,
  .settings-page-wrapper-light .tips-section,
  .rituals-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-top: 2.5rem;
    overflow: visible !important;
    padding-left: 10px !important; /* Décalage de 1cm pour voir les icônes */
  }

  .dashboard-page-wrapper-light .tip-header,
  .overview-page-wrapper-light .tip-header,
  .requests-page-wrapper-light .tip-header,
  .jobs-page-wrapper-light .tip-header,
  .calendar-page-wrapper-light .tip-header,
  .services-page-wrapper-light .tip-header,
  .messages-page-wrapper-light .tip-header,
  .earnings-page-wrapper-light .tip-header,
  .profile-page-wrapper-light .tip-header,
  .settings-page-wrapper-light .tip-header,
  .rituals-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }

  .dashboard-page-wrapper-light .tip-icon,
  .overview-page-wrapper-light .tip-icon,
  .requests-page-wrapper-light .tip-icon,
  .jobs-page-wrapper-light .tip-icon,
  .calendar-page-wrapper-light .tip-icon,
  .services-page-wrapper-light .tip-icon,
  .messages-page-wrapper-light .tip-icon,
  .earnings-page-wrapper-light .tip-icon,
  .profile-page-wrapper-light .tip-icon,
  .settings-page-wrapper-light .tip-icon,
  .rituals-page-wrapper-light .tip-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
  }

  .dashboard-page-wrapper-light .tip-title,
  .overview-page-wrapper-light .tip-title,
  .requests-page-wrapper-light .tip-title,
  .jobs-page-wrapper-light .tip-title,
  .calendar-page-wrapper-light .tip-title,
  .services-page-wrapper-light .tip-title,
  .messages-page-wrapper-light .tip-title,
  .earnings-page-wrapper-light .tip-title,
  .profile-page-wrapper-light .tip-title,
  .settings-page-wrapper-light .tip-title,
  .rituals-page-wrapper-light .tip-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
  }

  .dashboard-page-wrapper-light .tip-content,
  .overview-page-wrapper-light .tip-content,
  .requests-page-wrapper-light .tip-content,
  .jobs-page-wrapper-light .tip-content,
  .calendar-page-wrapper-light .tip-content,
  .services-page-wrapper-light .tip-content,
  .messages-page-wrapper-light .tip-content,
  .earnings-page-wrapper-light .tip-content,
  .profile-page-wrapper-light .tip-content,
  .settings-page-wrapper-light .tip-content,
  .rituals-page-wrapper-light .tip-content {
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
  }

  .dashboard-page-wrapper-light .tip-content strong,
  .overview-page-wrapper-light .tip-content strong,
  .requests-page-wrapper-light .tip-content strong,
  .jobs-page-wrapper-light .tip-content strong,
  .calendar-page-wrapper-light .tip-content strong,
  .services-page-wrapper-light .tip-content strong,
  .messages-page-wrapper-light .tip-content strong,
  .earnings-page-wrapper-light .tip-content strong,
  .profile-page-wrapper-light .tip-content strong,
  .settings-page-wrapper-light .tip-content strong,
  .rituals-page-wrapper-light .tip-content strong {
    color: var(--text-primary);
    font-weight: 600;
  }

  /* ===== RESPONSIVE ===== */
  
  /* Tablettes et petits écrans (768px et moins) - Passage en colonne unique */
  @media (max-width: 768px) {
    .dashboard-page-wrapper-light,
    .overview-page-wrapper-light,
    .requests-page-wrapper-light,
    .jobs-page-wrapper-light,
    .calendar-page-wrapper-light,
    .services-page-wrapper-light,
    .messages-page-wrapper-light,
    .earnings-page-wrapper-light,
    .profile-page-wrapper-light,
    .settings-page-wrapper-light,
    .rituals-page-wrapper-light {
      padding: 16px 8px !important;
    }

    .dashboard-page-wrapper-light .dashboard-container,
    .overview-page-wrapper-light .dashboard-container,
    .requests-page-wrapper-light .dashboard-container,
    .jobs-page-wrapper-light .dashboard-container,
    .calendar-page-wrapper-light .dashboard-container,
    .services-page-wrapper-light .dashboard-container,
    .messages-page-wrapper-light .dashboard-container,
    .earnings-page-wrapper-light .dashboard-container,
    .profile-page-wrapper-light .dashboard-container,
    .settings-page-wrapper-light .dashboard-container,
    .rituals-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 8px 0 !important;
    }
      display: flex !important;
      flex-direction: column;
      min-height: 100vh;
      max-width: 100vw !important;
      width: 100vw !important;
      margin: 0 auto !important;
      padding: 0 !important;
      background: transparent;
      box-shadow: none;
      box-sizing: border-box;
      align-items: center !important;
      justify-content: flex-start !important;
      overflow-x: visible !important;
    }

    .dashboard-page-wrapper-light .sidebar,
    .overview-page-wrapper-light .sidebar,
    .requests-page-wrapper-light .sidebar,
    .jobs-page-wrapper-light .sidebar,
    .calendar-page-wrapper-light .sidebar,
    .services-page-wrapper-light .sidebar,
    .messages-page-wrapper-light .sidebar,
    .earnings-page-wrapper-light .sidebar,
    .profile-page-wrapper-light .sidebar,
    .settings-page-wrapper-light .sidebar,
    .rituals-page-wrapper-light .sidebar {
      position: static !important;
      top: auto !important;
      width: 100% !important;
      min-width: 100% !important;
      max-width: 100% !important;
      height: auto !important;
      max-height: none !important;
      padding: 2rem 8px !important;
      grid-column: 1 !important;
    }
  }

  /* Tablettes grandes (769px à 1024px) - Layout adaptatif */
  @media (max-width: 1024px) {
    .dashboard-page-wrapper-light,
    .overview-page-wrapper-light,
    .requests-page-wrapper-light,
    .jobs-page-wrapper-light,
    .calendar-page-wrapper-light,
    .services-page-wrapper-light,
    .messages-page-wrapper-light,
    .earnings-page-wrapper-light,
    .profile-page-wrapper-light,
    .settings-page-wrapper-light,
    .rituals-page-wrapper-light {
      padding: 20px 10px !important;
    }

    .dashboard-page-wrapper-light .dashboard-container,
    .overview-page-wrapper-light .dashboard-container,
    .requests-page-wrapper-light .dashboard-container,
    .jobs-page-wrapper-light .dashboard-container,
    .calendar-page-wrapper-light .dashboard-container,
    .services-page-wrapper-light .dashboard-container,
    .messages-page-wrapper-light .dashboard-container,
    .earnings-page-wrapper-light .dashboard-container,
    .profile-page-wrapper-light .dashboard-container,
    .settings-page-wrapper-light .dashboard-container,
    .rituals-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 10px 0 !important;
    }

    .dashboard-page-wrapper-light .main-content,
    .overview-page-wrapper-light .main-content,
    .requests-page-wrapper-light .main-content,
    .jobs-page-wrapper-light .main-content,
    .calendar-page-wrapper-light .main-content,
    .services-page-wrapper-light .main-content,
    .messages-page-wrapper-light .main-content,
    .earnings-page-wrapper-light .main-content,
    .profile-page-wrapper-light .main-content,
    .settings-page-wrapper-light .main-content,
    .rituals-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }

    .dashboard-page-wrapper-light .sidebar,
    .overview-page-wrapper-light .sidebar,
    .requests-page-wrapper-light .sidebar,
    .jobs-page-wrapper-light .sidebar,
    .calendar-page-wrapper-light .sidebar,
    .services-page-wrapper-light .sidebar,
    .messages-page-wrapper-light .sidebar,
    .earnings-page-wrapper-light .sidebar,
    .profile-page-wrapper-light .sidebar,
    .settings-page-wrapper-light .sidebar,
    .rituals-page-wrapper-light .sidebar {
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
  }

  /* Très petits écrans (< 480px) - Optimisations supplémentaires */
  @media (max-width: 480px) {
    .dashboard-page-wrapper-light,
    .overview-page-wrapper-light,
    .requests-page-wrapper-light,
    .jobs-page-wrapper-light,
    .calendar-page-wrapper-light,
    .services-page-wrapper-light,
    .messages-page-wrapper-light,
    .earnings-page-wrapper-light,
    .profile-page-wrapper-light,
    .settings-page-wrapper-light,
    .rituals-page-wrapper-light {
      padding: 12px 4px !important;
    }

    .dashboard-page-wrapper-light .main-content,
    .overview-page-wrapper-light .main-content,
    .requests-page-wrapper-light .main-content,
    .jobs-page-wrapper-light .main-content,
    .calendar-page-wrapper-light .main-content,
    .services-page-wrapper-light .main-content,
    .messages-page-wrapper-light .main-content,
    .earnings-page-wrapper-light .main-content,
    .profile-page-wrapper-light .main-content,
    .settings-page-wrapper-light .main-content,
    .rituals-page-wrapper-light .main-content {
      padding: 1rem 4px !important;
    }

    .dashboard-page-wrapper-light .sidebar,
    .overview-page-wrapper-light .sidebar,
    .requests-page-wrapper-light .sidebar,
    .jobs-page-wrapper-light .sidebar,
    .calendar-page-wrapper-light .sidebar,
    .services-page-wrapper-light .sidebar,
    .messages-page-wrapper-light .sidebar,
    .earnings-page-wrapper-light .sidebar,
    .profile-page-wrapper-light .sidebar,
    .settings-page-wrapper-light .sidebar,
    .rituals-page-wrapper-light .sidebar {
      padding: 1.5rem 4px !important;
    }
</style>

<style>
/* ===== TUILES PARAMÈTRES PREMIUM ===== */
  .settings-tiles-pro {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2.5rem;
    width: 100%;
    max-width: none;
    margin: 2.5rem 0 0 0;
    padding: 0;
  }
  @media (min-width: 600px) {
    .settings-tiles-pro {
      grid-template-columns: repeat(2, 1fr);
      gap: 2.5rem;
    }
  }
  @media (min-width: 1024px) {
    .settings-tiles-pro {
      grid-template-columns: repeat(3, 1fr);
      gap: 2.5rem;
    }
  }
@media (min-width: 600px) {
  .settings-tiles-pro {
    grid-template-columns: repeat(2, 1fr);
    gap: 2.5rem;
  }
}
@media (min-width: 1024px) {
  .settings-tiles-pro {
    grid-template-columns: repeat(3, 1fr);
    gap: 2.5rem;
  }
}
.settings-tile-pro {
  background: linear-gradient(135deg, #ffffff 0%, #f8fafb 100%);
  border-radius: 28px;
  box-shadow: 0 24px 64px rgba(80, 36, 180, 0.18), 0 8px 24px rgba(80, 36, 180, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
  padding: 3rem 2.5rem 2.5rem 2.5rem;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
  position: relative;
  min-height: 280px;
  border: 2px solid rgba(124, 58, 237, 0.15);
  overflow: hidden;
}

.settings-tile-pro::before {
  content: '';
  position: absolute;
  top: -100px;
  left: -100px;
  width: 200px;
  height: 200px;
  background: radial-gradient(circle, rgba(124, 58, 237, 0.15) 0%, transparent 70%);
  border-radius: 50%;
  pointer-events: none;
  filter: blur(40px);
}

.settings-tile-pro::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
  pointer-events: none;
}

.settings-tile-pro:hover {
  box-shadow: 0 32px 80px rgba(80, 36, 180, 0.25), 0 12px 32px rgba(80, 36, 180, 0.14), inset 0 1px 0 rgba(255, 255, 255, 0.9);
  transform: translateY(-12px) scale(1.03);
  border-color: rgba(124, 58, 237, 0.4);
  background: linear-gradient(135deg, #fafbfc 0%, #f3f4f9 100%);
}

.tile-icon {
  width: 72px;
  height: 72px;
  border-radius: 20px;
  background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 40%, #c7d2fe 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2.2rem;
  color: #7c3aed;
  margin-bottom: 2rem;
  box-shadow: 0 12px 32px rgba(124, 58, 237, 0.2), 0 4px 12px rgba(124, 58, 237, 0.12), inset 0 2px 8px rgba(255, 255, 255, 0.6);
  transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
  position: relative;
  z-index: 1;
}

.tile-icon::before {
  content: '';
  position: absolute;
  inset: -2px;
  border-radius: 20px;
  background: linear-gradient(135deg, rgba(124, 58, 237, 0.2), transparent);
  opacity: 0;
  transition: opacity 0.35s ease;
  pointer-events: none;
}

.settings-tile-pro:hover .tile-icon {
  background: linear-gradient(135deg, #a5b4fc 0%, #818cf8 40%, #6366f1 100%);
  color: #fff;
  box-shadow: 0 16px 48px rgba(124, 58, 237, 0.35), 0 8px 20px rgba(124, 58, 237, 0.2), inset 0 2px 8px rgba(255, 255, 255, 0.3);
  transform: scale(1.15) rotate(-5deg);
}

.settings-tile-pro:hover .tile-icon::before {
  opacity: 1;
}

.tile-title {
  font-size: 1.5rem;
  font-weight: 900;
  color: #0f172a;
  margin-bottom: 1rem;
  letter-spacing: -0.03em;
  position: relative;
  z-index: 1;
  background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.tile-desc {
  color: #64748b;
  font-size: 1rem;
  margin-bottom: 1.75rem;
  line-height: 1.7;
  position: relative;
  z-index: 1;
  font-weight: 500;
}

.tile-btn {
  background: linear-gradient(135deg, #7c3aed 0%, #6366f1 50%, #4f46e5 100%);
  color: #fff;
  border: none;
  border-radius: 16px;
  padding: 0.9rem 1.8rem;
  font-weight: 800;
  font-size: 0.95rem;
  box-shadow: 0 8px 24px rgba(124, 58, 237, 0.32), 0 2px 8px rgba(0, 0, 0, 0.08);
  cursor: pointer;
  transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
  position: relative;
  z-index: 1;
  letter-spacing: 0.03em;
  font-family: inherit;
  border: 2px solid transparent;
}

.tile-btn::before {
  content: '';
  position: absolute;
  inset: 0;
  border-radius: 16px;
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
  opacity: 0;
  transition: opacity 0.3s ease;
  pointer-events: none;
}

.tile-btn:hover {
  background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
  box-shadow: 0 12px 36px rgba(124, 58, 237, 0.42), 0 4px 16px rgba(0, 0, 0, 0.12);
  transform: scale(1.08) translateY(-3px);
}

.tile-btn:hover::before {
  opacity: 1;
}

.tile-btn:active {
  transform: scale(0.96) translateY(0px);
}

.tile-badge {
  position: absolute;
  top: 1.8rem;
  right: 1.8rem;
  background: linear-gradient(135deg, #f59e0b 0%, #f97316 50%, #ea580c 100%);
  color: #fff;
  font-size: 0.75rem;
  font-weight: 900;
  border-radius: 12px;
  padding: 0.5rem 1rem;
  box-shadow: 0 8px 24px rgba(245, 158, 11, 0.35), 0 2px 8px rgba(0, 0, 0, 0.1);
  letter-spacing: 0.06em;
  position: relative;
  z-index: 2;
  border: 2px solid rgba(255, 255, 255, 0.3);
  text-transform: uppercase;
}

.settings-tile-pro.danger {
  border-color: rgba(239, 68, 68, 0.2);
  background: linear-gradient(135deg, #fff5f5 0%, #fff2f2 100%);
}

.settings-tile-pro.danger::before {
  background: radial-gradient(circle, rgba(239, 68, 68, 0.15) 0%, transparent 70%);
}

.settings-tile-pro.danger:hover {
  box-shadow: 0 32px 80px rgba(239, 68, 68, 0.22), 0 12px 32px rgba(239, 68, 68, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.9);
  border-color: rgba(239, 68, 68, 0.4);
  background: linear-gradient(135deg, #fffdfd 0%, #fff8f8 100%);
}

.settings-tile-pro.danger .tile-title {
  background: linear-gradient(135deg, #7f1d1d 0%, #dc2626 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.settings-tile-pro.danger .tile-icon {
  background: linear-gradient(135deg, #fee2e2 0%, #fecaca 40%, #fca5a5 100%);
  color: #dc2626;
  box-shadow: 0 12px 32px rgba(220, 38, 38, 0.2), 0 4px 12px rgba(220, 38, 38, 0.12), inset 0 2px 8px rgba(255, 255, 255, 0.6);
}

.settings-tile-pro.danger:hover .tile-icon {
  background: linear-gradient(135deg, #fca5a5 0%, #f87171 40%, #ef4444 100%);
  color: #fff;
  box-shadow: 0 16px 48px rgba(239, 68, 68, 0.35), 0 8px 20px rgba(239, 68, 68, 0.2), inset 0 2px 8px rgba(255, 255, 255, 0.3);
  transform: scale(1.15) rotate(5deg);
}

.settings-tile-pro.danger .tile-btn {
  background: linear-gradient(135deg, #fff 0%, #faf5f5 100%);
  color: #dc2626;
  border: 2.5px solid #ef4444;
  box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
}

.settings-tile-pro.danger .tile-btn:hover {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 50%, #b91c1c 100%);
  color: #fff;
  box-shadow: 0 12px 36px rgba(239, 68, 68, 0.42), 0 4px 16px rgba(0, 0, 0, 0.12);
}
</style>

