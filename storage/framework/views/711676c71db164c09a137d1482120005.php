<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    }

    /* Layout principal - Fond blanc solide (empêche toute zone sombre résiduelle) */
    body {
      background: #ffffff !important;
      background-color: #ffffff !important;
      position: relative;
    }

    /* Pseudo-élément body::before désactivé pour éviter tout halo sombre */
    body::before {
      display: none !important;
      content: none !important;
    }

    .freelance-dashboard-wrapper {
      position: relative;
      z-index: 1;
      padding: 2rem 1rem;
      min-height: calc(100vh - 200px);
      background: #ffffff;
      overflow: hidden;
    }

    /* Container glass premium */
    .freelance-dashboard-container {
      max-width: 1400px;
      margin: 0 auto;
      background: #ffffff;
      border: 1px solid rgba(255, 255, 255, 0.8);
      border-radius: 24px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
      padding: 2.5rem;
      color: #1f2937;
      overflow: hidden;
    }
    
    /* CORRECTION CAUSE RACINE : Supprimer max-width et padding pour jobs-page-wrapper-light */
    .freelance-dashboard-container .jobs-page-wrapper-light {
      margin: 0 !important; /* Pas de marge négative qui interfère */
      width: 100% !important; /* Largeur normale */
    }
    
    .freelance-dashboard-wrapper:has(.jobs-page-wrapper-light) .freelance-dashboard-container,
    .freelance-dashboard-container:has(.jobs-page-wrapper-light),
    .freelance-dashboard-container:has(.overview-page-wrapper-light),
    .freelance-dashboard-container:has(.calendar-page-wrapper-light),
    .freelance-dashboard-container:has(.services-page-wrapper-light),
    .freelance-dashboard-container:has(.messages-page-wrapper-light),
    .freelance-dashboard-container:has(.earnings-page-wrapper-light),
    .freelance-dashboard-container:has(.profile-page-wrapper-light),
    .freelance-dashboard-container:has(.settings-page-wrapper-light),
    .freelance-dashboard-container:has(.rituals-page-wrapper-light) {
      max-width: none !important;
      width: 100% !important;
      padding: 0 !important; /* Supprime tout le padding pour que les marges de 1cm fonctionnent */
    }

    /* Container pour l'onglet overview, requests, jobs et calendar (sans padding supplémentaire) */
    .dashboard-tab-content:has(.dashboard-luxury),
    .dashboard-tab-content:has(.requests-page-wrapper),
    .dashboard-tab-content:has(.jobs-page-wrapper),
    .dashboard-tab-content:has(.jobs-page-wrapper-dark),
    .dashboard-tab-content:has(.jobs-page-wrapper-light),
    .dashboard-tab-content:has(.overview-page-wrapper-light),
    .dashboard-tab-content:has(.calendar-page-wrapper-light),
    .dashboard-tab-content:has(.calendar-page-wrapper),
    .dashboard-tab-content:has(.services-page-wrapper-light),
    .dashboard-tab-content:has(.messages-page-wrapper-light),
    .dashboard-tab-content:has(.earnings-page-wrapper-light),
    .dashboard-tab-content:has(.profile-page-wrapper-light),
    .dashboard-tab-content:has(.settings-page-wrapper-light),
    .dashboard-tab-content:has(.rituals-page-wrapper-light) {
      padding: 0;
    }

    /* ===== CORRECTION ROBUSTE - DISPOSITION HORIZONTALE SANS SUPERPOSITION ===== */
    
    /* 1. Navigation fixe à gauche pour overview */
    .dashboard-luxury .overview-panel-nav {
      position: fixed;
      left: 0;
      top: 0;
      width: 280px;
      height: 100vh;
      background: white;
      z-index: 100;
      overflow-y: auto;
      overflow-x: hidden;
      border-right: 1px solid #E2E8F0;
      padding: 20px;
      box-sizing: border-box;
    }

    /* 2. Sidebars fixes pour autres pages - SUPPRIMÉ pour éviter conflits avec CSS des onglets individuels */
    /* Les sidebars sont maintenant gérées par le CSS de chaque fichier d'onglet individuel */

    /* 3. Conteneur principal pour overview - Grid horizontal propre */
    .dashboard-luxury {
      position: relative;
      width: 100%;
      min-height: 100vh;
    }

    .dashboard-luxury-header {
      position: relative;
      margin-left: 280px;
      width: calc(100% - 280px);
      padding: 1.5rem 2rem;
      box-sizing: border-box;
    }

    .dashboard-luxury-main {
      position: relative;
      display: grid;
      grid-template-columns: minmax(300px, 1fr) minmax(300px, 1fr);
      gap: 2rem;
      align-items: start;
      margin-left: 280px;
      width: calc(100% - 280px);
      padding: 0 2rem;
      box-sizing: border-box;
    }

    /* 4. Cartes horizontales - Grid responsive avec auto-fill */
    .cards-horizontal-row {
      position: relative;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
      margin-left: 280px;
      width: calc(100% - 280px);
      padding: 0 2rem 2rem;
      box-sizing: border-box;
    }

    /* 5. Espacement pour autres pages - SUPPRIMÉ pour éviter conflits avec CSS des onglets individuels */
    /* Les espacements sont maintenant gérés par le CSS de chaque fichier d'onglet individuel */

    /* 3. Garantir l'espacement des items */
    .nav-list, 
    .vertical-nav, 
    .nav-section > div {
      display: flex !important;
      flex-direction: column !important;
      gap: 8px !important;
    }

    .freelance-dashboard-wrapper .nav-item, 
    .vertical-nav a {
      display: flex !important;
      align-items: center !important;
      padding: 12px 16px !important;
      margin: 2px 0 !important;
      text-decoration: none !important;
    }

    /* 4. Responsive */
    @media (max-width: 768px) {
      .navigation-sidebar, 
      .sidebar, 
      .nav-section, 
      .overview-panel {
        position: static !important;
        width: 100% !important;
        height: auto !important;
        border-right: none !important;
        border-bottom: 1px solid #E2E8F0 !important;
      }
      
      .requests-page-wrapper .requests-page,
      .jobs-page-wrapper-light .main-content,
      .calendar-page-wrapper .main-content,
      .calendar-page-wrapper .dashboard-container,
      .jobs-page-wrapper-light .dashboard-container {
        margin-left: 0 !important;
        width: 100% !important;
      }
      
      .nav-list, 
      .vertical-nav {
        flex-direction: row !important;
        overflow-x: auto !important;
      }
    }

    /* Header de page - Décalage de 2 cm du bord gauche et haut */
    .dashboard-header {
      margin-top: 2cm !important;
      margin-left: 2cm !important;
      margin-bottom: 2rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .dashboard-header h1 {
      font-size: 1.75rem;
      font-weight: 700;
      color: #111827;
      margin: 0 0 0.5rem 0;
      line-height: 1.2;
    }

    .dashboard-header-subtitle {
      font-size: 0.95rem;
      color: #6b7280;
      margin-bottom: 1.25rem;
      line-height: 1.5;
    }

    .dashboard-header-ctas {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    .btn-premium {
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

    .btn-premium-primary {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .btn-premium-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .btn-premium-secondary {
      background: white;
      color: #1e40af;
      border: 2px solid #1e40af;
    }

    .btn-premium-secondary:hover {
      background: #f8fafc;
      transform: translateY(-1px);
    }

    /* Onglets premium */
    .dashboard-tabs-nav {
      display: flex;
      gap: 0.5rem;
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid rgba(0, 0, 0, 0.08);
      flex-wrap: wrap;
      overflow-x: auto;
    }

    .dashboard-tab-item {
      padding: 0.625rem 1.25rem;
      font-size: 0.9rem;
      font-weight: 500;
      color: #6b7280;
      text-decoration: none;
      border-radius: 10px;
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .dashboard-tab-item:hover {
      background: rgba(124, 58, 237, 0.08);
      color: #7c3aed;
    }

    .dashboard-tab-item.active {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    /* Zone de contenu des onglets */
    .dashboard-tab-content {
      min-height: 400px;
    }

    /* Cartes premium */
    .premium-card {
      background: white;
      border: 1px solid rgba(0, 0, 0, 0.08);
      border-radius: 16px;
      padding: 1.5rem;
      transition: all 0.2s ease;
    }

    .premium-card:hover {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transform: translateY(-2px);
    }

    .premium-card-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: #111827;
      margin: 0 0 0.75rem 0;
    }

    .premium-card-text {
      font-size: 0.9rem;
      color: #6b7280;
      line-height: 1.5;
      margin: 0 0 0.75rem 0;
    }

    .premium-card-microcopy {
      font-size: 0.8rem;
      color: #9ca3af;
      margin-top: 0.75rem;
      margin-bottom: 0;
    }

    /* Tuiles settings */
    .settings-tile {
      background: white;
      border: 1px solid rgba(0, 0, 0, 0.08);
      border-radius: 12px;
      padding: 1.25rem;
      transition: all 0.2s ease;
    }

    .settings-tile:hover {
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
      transform: translateY(-1px);
    }

    .settings-tile-title {
      font-size: 1rem;
      font-weight: 600;
      color: #111827;
      margin: 0 0 0.5rem 0;
    }

    .settings-tile-desc {
      font-size: 0.85rem;
      color: #6b7280;
      margin: 0 0 0.5rem 0;
      line-height: 1.4;
    }

    .settings-tile-microcopy {
      font-size: 0.75rem;
      color: #9ca3af;
      margin: 0.25rem 0 0.75rem 0;
    }

    .settings-tile-button {
      display: inline-block;
      padding: 0.5rem 1rem;
      font-size: 0.85rem;
      font-weight: 600;
      color: #7c3aed;
      text-decoration: none;
      border: 1px solid rgba(124, 58, 237, 0.3);
      border-radius: 8px;
      transition: all 0.2s ease;
    }

    .settings-tile-button:hover {
      background: rgba(124, 58, 237, 0.08);
      border-color: #7c3aed;
    }

    /* SectionHeader */
    .section-header {
      margin-bottom: 1.5rem;
    }

    .section-header h2 {
      font-size: 1.75rem;
      font-weight: 700;
      color: #111827;
      margin: 0 0 0.5rem 0;
    }

    .section-header-subtitle {
      font-size: 0.95rem;
      color: #6b7280;
      margin: 0;
      line-height: 1.5;
    }

    .section-header-microtext {
      font-size: 0.85rem;
      color: #9ca3af;
      margin-top: 0.5rem;
    }

    /* Tableaux premium */
    .premium-table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 12px;
      overflow: hidden;
      border: 1px solid rgba(0, 0, 0, 0.08);
      margin-bottom: 1.5rem;
    }

    .premium-table thead {
      background: #f8fafc;
    }

    .premium-table th {
      padding: 1rem;
      text-align: left;
      font-size: 0.85rem;
      font-weight: 600;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .premium-table td {
      padding: 1rem;
      font-size: 0.9rem;
      color: #374151;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .premium-table tbody tr:last-child td {
      border-bottom: none;
    }

    .premium-table tbody tr:hover {
      background: #f8fafc;
    }

    /* EmptyStatePremium */
    .empty-state-premium {
      text-align: center;
      padding: 2.5rem 1.5rem;
      color: #6b7280;
    }

    .empty-state-icon {
      width: 64px;
      height: 64px;
      margin: 0 auto 1.25rem;
      opacity: 0.5;
      color: #9ca3af;
    }

    .empty-state-premium-text {
      font-size: 0.95rem;
      margin-bottom: 1.25rem;
      line-height: 1.6;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
    }

    .empty-state-premium-cta {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.625rem 1.25rem;
      font-size: 0.9rem;
      font-weight: 600;
      color: #1e40af;
      text-decoration: none;
      border-radius: 10px;
      background: rgba(30, 64, 175, 0.08);
      transition: all 0.2s ease;
    }

    .empty-state-premium-cta:hover {
      background: rgba(30, 64, 175, 0.12);
      transform: translateY(-1px);
    }

    .empty-state-tip {
      font-size: 0.8rem;
      color: #9ca3af;
      margin-top: 1rem;
      font-style: italic;
    }

    /* Dashboard Luxury - Layout 3 colonnes */
    .dashboard-luxury {
      display: flex;
      flex-direction: column;
      gap: 2rem;
      margin-top: 0;
    }

    /* Masquer les onglets horizontaux uniquement sur l'overview, requests, jobs et calendar (on utilise la nav verticale) */
    .dashboard-tab-content:has(.dashboard-luxury) ~ .dashboard-tabs-nav,
    .dashboard-tab-content:has([data-overview-page="true"]) ~ .dashboard-tabs-nav,
    .dashboard-tab-content:has(.requests-page-wrapper) ~ .dashboard-tabs-nav,
    .dashboard-tab-content:has(.jobs-page-wrapper) ~ .dashboard-tabs-nav,
    .dashboard-tab-content:has(.jobs-page-wrapper-dark) ~ .dashboard-tabs-nav,
    .dashboard-tab-content:has(.jobs-page-wrapper-light) ~ .dashboard-tabs-nav,
    .dashboard-tab-content:has(.calendar-page-wrapper) ~ .dashboard-tabs-nav {
      display: none;
    }

    /* Alternative JavaScript pour navigateurs qui ne supportent pas :has() */
    body.overview-active .dashboard-tabs-nav,
    body.requests-active .dashboard-tabs-nav,
    body.jobs-active .dashboard-tabs-nav,
    body.calendar-active .dashboard-tabs-nav {
      display: none;
    }

    /* Alternative pour navigateurs qui ne supportent pas :has() - utiliser une classe */
    body:has(.dashboard-luxury) .dashboard-tabs-nav,
    body:has(.requests-page-wrapper) .dashboard-tabs-nav,
    body:has(.jobs-page-wrapper) .dashboard-tabs-nav,
    body:has(.jobs-page-wrapper-dark) .dashboard-tabs-nav,
    body:has(.jobs-page-wrapper-light) .dashboard-tabs-nav,
    body:has(.calendar-page-wrapper) .dashboard-tabs-nav {
      display: none;
    }

    .dashboard-luxury-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid rgba(0, 0, 0, 0.06);
      margin-left: 280px;
      width: calc(100% - 280px);
      padding-left: 2rem;
    }

    .dashboard-luxury-header h1 {
      font-size: 1.5rem;
      font-weight: 600;
      color: #111827;
      margin: 0;
    }

    .user-avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.2);
    }

    .user-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .avatar-initials {
      color: white;
      font-weight: 600;
      font-size: 1rem;
    }

    .dashboard-luxury-main {
      display: grid;
      grid-template-columns: 1fr 1.2fr 0.8fr;
      gap: 2rem;
      align-items: start;
    }

    /* Section Focus Area */
    .focus-area {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .welcome-card {
      background: white;
      border: 1px solid rgba(0, 0, 0, 0.06);
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .welcome-card .tagline {
      font-size: 0.95rem;
      color: #6b7280;
      margin: 0 0 1.5rem 0;
      font-style: italic;
    }

    .welcome-card h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #111827;
      margin: 0 0 1.5rem 0;
    }

    .today-status {
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.05) 0%, rgba(124, 58, 237, 0.05) 100%);
      border-radius: 16px;
      padding: 1.5rem;
      margin-bottom: 1rem;
    }

    .time-slot {
      font-size: 0.85rem;
      color: #6b7280;
      margin-bottom: 0.75rem;
    }

    .today-status h3 {
      font-size: 1.25rem;
      font-weight: 600;
      color: #111827;
      margin: 0 0 0.5rem 0;
    }

    .today-status .client {
      font-size: 0.9rem;
      color: #6b7280;
      margin: 0 0 1.25rem 0;
    }

    .btn-primary {
      display: inline-block;
      padding: 0.75rem 1.5rem;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      font-weight: 600;
      border-radius: 12px;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
      transition: all 0.2s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .welcome-card .hint {
      font-size: 0.85rem;
      color: #9ca3af;
      margin: 0;
    }

    .welcome-card .hint a {
      color: #7c3aed;
      text-decoration: none;
    }

    .priority-card {
      background: white;
      border: 1px solid rgba(0, 0, 0, 0.06);
      border-radius: 20px;
      padding: 1.75rem;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .card-header {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 1rem;
    }

    .card-header .icon {
      font-size: 1.5rem;
    }

    .card-header h3 {
      font-size: 1.1rem;
      font-weight: 600;
      color: #111827;
      margin: 0;
    }

    .priority-card p {
      font-size: 0.9rem;
      color: #6b7280;
      margin: 0 0 1rem 0;
      line-height: 1.5;
    }

    .progress-bar {
      width: 100%;
      height: 8px;
      background: #e5e7eb;
      border-radius: 4px;
      overflow: hidden;
      margin-bottom: 1.25rem;
    }

    .progress-fill {
      height: 100%;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      border-radius: 4px;
      transition: width 0.3s ease;
    }

    .btn-refined {
      display: inline-block;
      padding: 0.625rem 1.25rem;
      background: white;
      color: #7c3aed;
      border: 1.5px solid #7c3aed;
      font-weight: 600;
      border-radius: 10px;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .btn-refined:hover {
      background: rgba(124, 58, 237, 0.05);
      transform: translateY(-1px);
    }

    /* Section Activity Area */
    .activity-area {
      background: white;
      border: 1px solid rgba(0, 0, 0, 0.06);
      border-radius: 20px;
      padding: 1.75rem;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .activity-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .activity-header h2 {
      font-size: 1.25rem;
      font-weight: 700;
      color: #111827;
      margin: 0;
    }

    .badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      background: rgba(124, 58, 237, 0.1);
      color: #7c3aed;
      font-size: 0.75rem;
      font-weight: 600;
      border-radius: 12px;
    }

    .activity-feed {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .activity-item {
      display: flex;
      gap: 1rem;
      padding: 1rem;
      background: #f8fafc;
      border-radius: 12px;
      transition: all 0.2s ease;
    }

    .activity-item.new {
      background: rgba(124, 58, 237, 0.05);
      border: 1px solid rgba(124, 58, 237, 0.2);
    }

    .activity-item:hover {
      background: #f1f5f9;
      transform: translateX(4px);
    }

    .activity-item .icon {
      font-size: 1.25rem;
      flex-shrink: 0;
    }

    .activity-item > div {
      flex: 1;
    }

    .activity-item p {
      font-size: 0.9rem;
      color: #111827;
      margin: 0 0 0.25rem 0;
    }

    .activity-item .time {
      font-size: 0.75rem;
      color: #9ca3af;
    }

    .activity-item .amount {
      font-size: 0.9rem;
      font-weight: 600;
      color: #10b981;
    }

    .link-elegant {
      display: inline-block;
      color: #7c3aed;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .link-elegant:hover {
      color: #4c1d95;
      transform: translateX(4px);
    }

    .activity-toggle-btn {
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      font-family: inherit;
      text-align: left;
    }

    .activity-feed-expanded {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin-bottom: 1.5rem;
      animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        max-height: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        max-height: 1000px;
        transform: translateY(0);
      }
    }

    .activity-area.expanded {
      transition: all 0.3s ease;
    }

    /* Section Overview Panel - maintenant séparée */
    .overview-panel {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    /* Panel d'activité à droite */
    .activity-panel {
      display: flex;
      flex-direction: column;
    }

    .vertical-nav {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      background: white;
      border: 1px solid rgba(0, 0, 0, 0.06);
      border-radius: 16px;
      padding: 1rem;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .vertical-nav .nav-item {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 48px;
      height: 48px;
      font-size: 1.5rem;
      text-decoration: none;
      border-radius: 12px;
      transition: all 0.2s ease;
      cursor: pointer;
    }

    .vertical-nav .nav-item:hover {
      background: rgba(124, 58, 237, 0.1);
      transform: scale(1.1);
    }

    .vertical-nav .nav-item.active {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .stats-card {
      background: white;
      border: 1px solid rgba(0, 0, 0, 0.06);
      border-radius: 20px;
      padding: 1.75rem;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .stats-card h4 {
      font-size: 1.1rem;
      font-weight: 600;
      color: #111827;
      margin: 0 0 1.5rem 0;
    }

    .stat {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
      padding-bottom: 1.25rem;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      margin-bottom: 1.25rem;
    }

    .stat:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .stat .value {
      font-size: 1.75rem;
      font-weight: 700;
      color: #111827;
    }

    .stat .label {
      font-size: 0.85rem;
      color: #6b7280;
    }

    .quote-card {
      background: white;
      border: 1px solid rgba(0, 0, 0, 0.06);
      border-radius: 20px;
      padding: 0;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      display: flex;
      flex-direction: column;
    }

    .quote-image-wrapper {
      width: 100%;
      height: 220px;
      overflow: hidden;
      position: relative;
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
    }

    .quote-image-wrapper::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.1) 100%);
      pointer-events: none;
    }

    .quote-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      display: block;
    }

    .quote-card:hover .quote-image {
      transform: scale(1.08);
    }

    .quote-image-placeholder {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .quote-content {
      padding: 1.75rem;
      background: white;
    }

    .quote-card .quote {
      font-size: 1rem;
      font-style: italic;
      color: #374151;
      margin: 0 0 1rem 0;
      line-height: 1.6;
    }

    .quote-card .author {
      font-size: 0.85rem;
      color: #6b7280;
      margin: 0;
      text-align: right;
    }

    /* Section horizontale pour les cartes - Grid auto-fill responsive */
    /* Utilise repeat(auto-fill, minmax(...)) pour un retour à la ligne propre */
    .cards-horizontal-row {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
      margin-left: 280px;
      width: calc(100% - 280px);
      padding: 0 2rem 2rem;
      box-sizing: border-box;
    }

    /* ===== RESPONSIVE - DISPOSITION ADAPTATIVE SANS SUPERPOSITION ===== */
    @media (max-width: 1200px) {
      /* Navigation devient statique - évite superposition */
      .dashboard-luxury .overview-panel-nav {
        position: relative;
        width: 100%;
        height: auto;
        border-right: none;
        border-bottom: 1px solid #E2E8F0;
        margin-bottom: 1rem;
      }

      /* Contenu principal en pleine largeur - uniquement pour overview */
      .dashboard-luxury-header,
      .dashboard-luxury-main,
      .cards-horizontal-row {
        margin-left: 0;
        width: 100%;
        padding-left: 1rem;
        padding-right: 1rem;
        box-sizing: border-box;
      }
      
      /* Les autres pages (requests, jobs, calendar) gèrent leur propre responsive */

      /* Grid adaptatif pour cartes - auto-fill avec min-width réduit */
      .cards-horizontal-row {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      }

      /* Grid 1 colonne pour contenu principal sur tablette */
      .dashboard-luxury-main {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
    }

    @media (max-width: 768px) {
      /* Une seule colonne sur mobile */
      .dashboard-luxury-main {
        grid-template-columns: 1fr;
      }

      .cards-horizontal-row {
        grid-template-columns: 1fr;
      }

      /* Padding réduit sur mobile */
      .dashboard-luxury-header,
      .dashboard-luxury-main,
      .cards-horizontal-row {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
      }
    }

    @media (max-width: 768px) {
      .freelance-dashboard-wrapper {
        padding: 1rem 0.5rem;
      }

      .freelance-dashboard-container {
        padding: 1.5rem;
        border-radius: 16px;
      }

      .dashboard-header h1 {
        font-size: 1.5rem;
      }

      .dashboard-header-ctas {
        flex-direction: column;
      }

      .btn-premium {
        width: 100%;
        justify-content: center;
      }

      .section-header h2 {
        font-size: 1.25rem;
      }

      .premium-table {
        font-size: 0.85rem;
      }

      .premium-table th,
      .premium-table td {
        padding: 0.75rem 0.5rem;
      }

      .dashboard-luxury-main {
        grid-template-columns: 1fr;
      }

      .overview-panel {
        display: flex;
        flex-direction: column;
      }

      .vertical-nav {
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="freelance-dashboard-wrapper">
    <div class="freelance-dashboard-container">
      <?php if($activeTab !== 'overview' && $activeTab !== 'requests' && $activeTab !== 'jobs' && $activeTab !== 'calendar'): ?>
        <!-- Header de page (masqué sur l'onglet Aperçu, Demandes, Prestations et Agenda) -->
        <div class="dashboard-header">
          <h1>Tableau de bord Freelance</h1>
          <p class="dashboard-header-subtitle">
            Un espace clair pour avancer sans relances : vos clients voient l'avancement, vous gardez le rythme.
          </p>
          <div class="dashboard-header-ctas">
            <a href="<?php echo e(route('freelance.services.create')); ?>" class="btn-premium btn-premium-primary">
              Créer un service
            </a>
            <?php if(isset($freelancerProfile) && $freelancerProfile && $freelancerProfile->id): ?>
              <a href="<?php echo e(route('freelance.show', ['id' => $freelancerProfile->id])); ?>" target="_blank" class="btn-premium btn-premium-secondary">
                Voir mon profil public
              </a>
            <?php else: ?>
              <a href="#" class="btn-premium btn-premium-secondary" onclick="alert('Vous devez compléter votre profil freelance pour voir votre profil public.'); return false;">
                Voir mon profil public
              </a>
            <?php endif; ?>
          </div>
          <p style="margin-top: 0.75rem; font-size: 0.85rem; color: #6b7280;">💡 Plus vos informations sont complètes, plus vous remontez dans les résultats.</p>
        </div>
      <?php endif; ?>

      
      <div style="margin: 1.5rem 0;">
        <?php echo $__env->make('frontend.components.pause-souffle.inline-premium', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>

      <!-- Contenu de l'onglet actif -->
      <div class="dashboard-tab-content" data-active-tab="<?php echo e($activeTab); ?>">
        <?php echo $__env->make('frontend.freelance.dashboard.tabs.' . $activeTab, [
          'activeTab' => $activeTab,
          'freelancerProfile' => $freelancerProfile,
          'user' => $user
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
    </div>
  </div>

  <script>
    // Masquer les onglets horizontaux sur l'overview, requests, jobs et calendar (fallback pour navigateurs sans :has())
    document.addEventListener('DOMContentLoaded', function() {
      const activeTab = document.querySelector('[data-active-tab]');
      const tabsNav = document.querySelector('.dashboard-tabs-nav');
      const tabValue = activeTab ? activeTab.getAttribute('data-active-tab') : null;
      
      if (tabValue === 'overview' || tabValue === 'requests' || tabValue === 'jobs' || tabValue === 'calendar') {
        // Masquer les onglets horizontaux sur l'overview, requests, jobs et calendar
        if (tabsNav) {
          tabsNav.style.display = 'none';
        }
        // Ajouter une classe au body pour le fallback CSS
        if (tabValue === 'overview') {
          document.body.classList.add('overview-active');
        } else if (tabValue === 'requests') {
          document.body.classList.add('requests-active');
        } else if (tabValue === 'jobs') {
          document.body.classList.add('jobs-active');
        } else if (tabValue === 'calendar') {
          document.body.classList.add('calendar-active');
        }
      } else {
        // Afficher les onglets horizontaux sur les autres pages
        if (tabsNav) {
          tabsNav.style.display = 'flex';
        }
        document.body.classList.remove('overview-active', 'requests-active', 'jobs-active', 'calendar-active');
      }
    });

    /**
     * ===== SCRIPT DE RECALCUL DES POSITIONS - GARANTIE LAYOUT HORIZONTAL =====
     * Recalcule les positions lors du redimensionnement pour éviter les superpositions
     */
    function recalculateLayout() {
      const windowWidth = window.innerWidth;
      const sidebarWidth = 280;
      const breakpoint = 1200;

      // Sélectionner uniquement les éléments de l'overview (les autres pages gèrent leur propre layout)
      const sidebars = document.querySelectorAll(
        '.dashboard-luxury .overview-panel-nav'
      );

      const mainContents = document.querySelectorAll(
        '.dashboard-luxury-header, .dashboard-luxury-main, .cards-horizontal-row'
      );

      if (windowWidth > breakpoint) {
        // Desktop : sidebar fixe, contenu décalé
        sidebars.forEach(sidebar => {
          sidebar.style.position = 'fixed';
          sidebar.style.left = '0';
          sidebar.style.width = sidebarWidth + 'px';
        });

        mainContents.forEach(content => {
          content.style.marginLeft = sidebarWidth + 'px';
          content.style.width = `calc(100% - ${sidebarWidth}px)`;
        });
      } else {
        // Mobile/Tablette : sidebar statique, contenu pleine largeur
        sidebars.forEach(sidebar => {
          sidebar.style.position = 'relative';
          sidebar.style.left = 'auto';
          sidebar.style.width = '100%';
        });

        mainContents.forEach(content => {
          content.style.marginLeft = '0';
          content.style.width = '100%';
        });
      }
    }

    // Recalculer au chargement et au redimensionnement
    document.addEventListener('DOMContentLoaded', function() {
      recalculateLayout();
      window.addEventListener('resize', recalculateLayout);
    });

    // Fonction pour déplier/replier la carte d'activité
    function toggleActivityFeed() {
      const expandedFeed = document.getElementById('activityFeedExpanded');
      const toggleBtn = document.getElementById('activityToggleBtn');
      const activityCard = document.getElementById('activityCard');
      
      if (expandedFeed && toggleBtn && activityCard) {
        if (expandedFeed.style.display === 'none' || expandedFeed.style.display === '') {
          // Déployer
          expandedFeed.style.display = 'flex';
          expandedFeed.classList.add('show');
          toggleBtn.innerHTML = 'Réduire ↑';
          activityCard.classList.add('expanded');
          
          // Scroll doux vers le bas pour voir les nouvelles activités
          setTimeout(() => {
            expandedFeed.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
          }, 200);
        } else {
          // Replier
          expandedFeed.style.display = 'none';
          expandedFeed.classList.remove('show');
          toggleBtn.innerHTML = 'Voir toute l\'activité →';
          activityCard.classList.remove('expanded');
          
          // Scroll vers le haut de la carte si nécessaire
          const rect = activityCard.getBoundingClientRect();
          if (rect.top < 0) {
            activityCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        }
      }
    }
  </script>

  <style>
    /* ===== FIX GLOBAL : Empêcher les min-height: 100vh empilés de créer un débordement sous le footer ===== */
    .dashboard-tab-content [class$="-page-wrapper-light"],
    .dashboard-tab-content [class$="-page-wrapper-light"] .dashboard-container,
    .dashboard-tab-content [class$="-page-wrapper-light"] .main-content {
      min-height: auto !important;
    }

    /* ===== GARANTIE VISIBILITÉ DU FOOTER ===== */
    /* S'assurer que le footer Junspro est toujours visible */
    .junspro-footer {
      display: block !important;
      visibility: visible !important;
      position: relative !important;
      z-index: 10 !important;
      width: 100% !important;
      margin-top: 4rem !important;
      background: #050816 !important;
    }

    /* S'assurer que le footer n'est pas masqué par le dashboard */
    .freelance-dashboard-wrapper,
    .freelance-dashboard-container {
      position: relative;
      z-index: 1;
    }

    .junspro-footer {
      position: relative;
      z-index: 10;
    }

    /* Espacement pour que le footer soit visible après le contenu */
    .freelance-dashboard-wrapper {
      padding-bottom: 2rem;
    }

    /* Supprimer tout espace sous le footer-bottom */
    .junspro-footer {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }

    .junspro-footer .footer-bottom {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }

    .junspro-footer .footer-bottom-content {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }

    .junspro-footer .footer-copyright,
    .junspro-footer .footer-social {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }

    .junspro-footer .footer-copyright p {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }

    /* Supprimer tout espace sous le footer */
    body:has(.junspro-footer),
    html:has(.junspro-footer),
    .main-wrapper:has(.junspro-footer) {
      padding-bottom: 0 !important;
      margin-bottom: 0 !important;
    }

    /* ===== STYLES GLOBAUX POUR LES BOUTONS DE LA SIDEBAR ===== */
    .actions-section {
      width: 100% !important;
      flex-shrink: 0 !important;
      margin-bottom: 2rem;
    }

    .btn-sidebar-primary {
      display: block !important;
      width: 100% !important;
      text-align: center !important;
      padding: 1rem 1.25rem !important;
      background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%) !important;
      color: white !important;
      border-radius: 12px !important;
      text-decoration: none !important;
      font-weight: 600 !important;
      font-size: 0.95rem !important;
      margin-bottom: 0.75rem !important;
      transition: all 0.3s ease !important;
      box-shadow: 0 4px 16px rgba(59, 130, 246, 0.2) !important;
      border: none !important;
    }

    .btn-sidebar-primary:hover {
      transform: translateY(-2px) !important;
      box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3) !important;
      color: white !important;
      text-decoration: none !important;
    }

    .btn-sidebar-secondary {
      display: block !important;
      width: 100% !important;
      text-align: center !important;
      padding: 1rem 1.25rem !important;
      background: white !important;
      color: #1e40af !important;
      border: 2px solid #1e40af !important;
      border-radius: 12px !important;
      text-decoration: none !important;
      font-weight: 600 !important;
      font-size: 0.95rem !important;
      transition: all 0.3s ease !important;
    }

    .btn-sidebar-secondary:hover {
      background: rgba(59, 130, 246, 0.05) !important;
      transform: translateY(-1px) !important;
      color: #1e40af !important;
      text-decoration: none !important;
    }
  </style>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.freelance.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\dashboard\index.blade.php ENDPATH**/ ?>