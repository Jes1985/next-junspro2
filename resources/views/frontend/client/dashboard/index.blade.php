@extends('frontend.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
  @include('components.client-upcoming-actions-menu-styles')
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #7c3aed 0%, #1e40af 100%);
      --junspro-gradient-alt: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --shadow-sm: 0 2px 8px rgba(124, 58, 237, 0.12);
      --shadow-md: 0 8px 24px rgba(124, 58, 237, 0.15);
      --shadow-lg: 0 16px 48px rgba(124, 58, 237, 0.20);
      --shadow-xl: 0 24px 64px rgba(124, 58, 237, 0.25);
      --card-shadow: var(--shadow-md);
      --card-shadow-hover: var(--shadow-lg);
    }

    /* Layout principal (style Preply - fond blanc) */
    .client-dashboard-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 3rem 2rem;
      padding-top: 4rem;
      background: linear-gradient(135deg, #f9f5ff 0%, #f0f4ff 50%, #faf8ff 100%) !important;
      min-height: calc(100vh - 200px);
      color: #1a202c;
      position: relative;
    }

    .client-dashboard-container::before {
      content: '';
      position: fixed;
      top: -50%;
      right: -50%;
      width: 1000px;
      height: 1000px;
      background: radial-gradient(circle, rgba(124, 58, 237, 0.08) 0%, transparent 70%);
      pointer-events: none;
      z-index: -1;
    }

    /* ===================================================
       HERO CLIENT — ULTRA-LUX v2
       =================================================== */
    .dashboard-hero {
      position: relative;
      background: linear-gradient(135deg, #3b0764 0%, #4c1d95 40%, #7c3aed 75%, #a855f7 100%);
      border-radius: 36px;
      padding: 3rem 3.5rem;
      margin-bottom: 3rem;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 2.5rem;
      flex-wrap: wrap;
      overflow: hidden;
      box-shadow:
        0 40px 100px rgba(76,29,149,.45),
        0 0 0 1px rgba(255,255,255,.08) inset;
      animation: hero-bg-shift 12s ease-in-out infinite alternate;
    }
    @keyframes hero-bg-shift {
      0%   { background-position: 0% 50%; }
      100% { background-position: 100% 50%; }
    }
    /* ── Orbes décoratifs ── */
    .dashboard-hero::before {
      content:'';
      position:absolute;
      top:-80px; left:-60px;
      width:380px; height:380px;
      background: radial-gradient(circle, rgba(255,255,255,.09) 0%, transparent 65%);
      border-radius:50%;
      pointer-events:none;
    }
    .dashboard-hero::after {
      content:'';
      position:absolute;
      bottom:-120px; right:-80px;
      width:520px; height:520px;
      background: radial-gradient(circle, rgba(168,85,247,.18) 0%, transparent 65%);
      border-radius:50%;
      pointer-events:none;
    }
    /* ── Grille de points décoratifs ── */
    .hero-dots-deco {
      position:absolute;
      top:18px; right:260px;
      display:grid;
      grid-template-columns: repeat(5,8px);
      gap:7px;
      opacity:.18;
      pointer-events:none;
      z-index:1;
    }
    .hero-dots-deco span {
      width:4px; height:4px;
      background:#fff;
      border-radius:50%;
      display:block;
    }
    /* ── Zone gauche ── */
    .hero-left {
      flex:1;
      min-width:240px;
      position:relative;
      z-index:2;
    }
    .hero-eyebrow {
      display:inline-flex;
      align-items:center;
      gap:.4rem;
      background:rgba(255,255,255,.1);
      border:1px solid rgba(255,255,255,.2);
      border-radius:999px;
      padding:.28rem .9rem;
      font-size:.72rem;
      font-weight:700;
      letter-spacing:.1em;
      text-transform:uppercase;
      color:rgba(255,255,255,.85);
      margin-bottom:1rem;
    }
    .hero-eyebrow-dot {
      width:6px; height:6px;
      background:#a78bfa;
      border-radius:50%;
    }
    .dashboard-hero-title {
      font-size:2.8rem;
      font-weight:900;
      line-height:1.08;
      letter-spacing:-.035em;
      color:#fff;
      margin:0 0 .6rem;
      text-shadow: 0 2px 24px rgba(0,0,0,.2);
    }
    .dashboard-hero-subtitle {
      font-size:1.05rem;
      font-weight:400;
      color:rgba(255,255,255,.72);
      margin:0 0 1.8rem;
      letter-spacing:.01em;
      line-height:1.5;
    }
    .hero-cta-row {
      display:flex;
      gap:.75rem;
      flex-wrap:wrap;
      align-items:center;
    }
    /* Bouton primaire (blanc) */
    .hero-btn-main {
      display:inline-flex;
      align-items:center;
      gap:.45rem;
      background:#fff;
      color:#6d28d9;
      border:none;
      border-radius:14px;
      padding:.7rem 1.6rem;
      font-size:.9rem;
      font-weight:800;
      text-decoration:none;
      box-shadow:0 8px 24px rgba(0,0,0,.2);
      transition:all .25s cubic-bezier(.34,1.56,.64,1);
      position:relative;
      overflow:hidden;
    }
    .hero-btn-main::after {
      content:'';
      position:absolute;
      inset:0;
      background:linear-gradient(120deg, transparent 30%, rgba(255,255,255,.4) 50%, transparent 70%);
      transform:translateX(-100%);
      transition:transform .45s ease;
    }
    .hero-btn-main:hover {
      transform:translateY(-3px);
      box-shadow:0 16px 36px rgba(0,0,0,.28);
      color:#5b21b6;
      text-decoration:none;
    }
    .hero-btn-main:hover::after { transform:translateX(100%); }
    /* Bouton secondaire (verre) */
    .hero-btn-ghost {
      display:inline-flex;
      align-items:center;
      gap:.45rem;
      background:rgba(255,255,255,.12);
      color:#fff;
      border:1.5px solid rgba(255,255,255,.28);
      border-radius:14px;
      padding:.68rem 1.4rem;
      font-size:.88rem;
      font-weight:700;
      text-decoration:none;
      backdrop-filter:blur(10px);
      transition:all .22s ease;
    }
    .hero-btn-ghost:hover {
      background:rgba(255,255,255,.22);
      border-color:rgba(255,255,255,.5);
      color:#fff;
      transform:translateY(-2px);
      text-decoration:none;
    }

    /* ── Widget countdown (carte droite) ── */
    .hero-ritual-card {
      flex-shrink:0;
      width:300px;
      background:rgba(255,255,255,.1);
      backdrop-filter:blur(24px);
      -webkit-backdrop-filter:blur(24px);
      border:1px solid rgba(255,255,255,.18);
      border-radius:24px;
      padding:1.5rem 1.6rem 1.4rem;
      position:relative;
      z-index:2;
      box-shadow:0 8px 32px rgba(0,0,0,.15), 0 0 0 1px rgba(255,255,255,.06) inset;
    }
    /* Shine subtil sur la card */
    .hero-ritual-card::before {
      content:'';
      position:absolute;
      top:0; left:10%; right:10%;
      height:1px;
      background:linear-gradient(90deg, transparent, rgba(255,255,255,.45), transparent);
      pointer-events:none;
    }
    .ritual-status-pill {
      display:inline-flex;
      align-items:center;
      gap:6px;
      background:rgba(255,255,255,.15);
      border:1px solid rgba(255,255,255,.22);
      border-radius:999px;
      padding:4px 12px;
      font-size:.7rem;
      font-weight:700;
      letter-spacing:.1em;
      text-transform:uppercase;
      color:rgba(255,255,255,.9);
      margin-bottom:.9rem;
    }
    .ritual-status-dot {
      width:7px; height:7px;
      border-radius:50%;
      background:#4ade80;
      animation: ritual-pulse 1.8s ease-in-out infinite;
    }
    @keyframes ritual-pulse {
      0%,100%{box-shadow:0 0 0 0 rgba(74,222,128,.6)}
      50%{box-shadow:0 0 0 6px rgba(74,222,128,0)}
    }
    .ritual-countdown-blocks {
      display:flex;
      align-items:center;
      gap:5px;
      margin-bottom:.75rem;
    }
    .ritual-cd-block {
      display:flex;
      flex-direction:column;
      align-items:center;
      background:rgba(255,255,255,.13);
      border:1px solid rgba(255,255,255,.18);
      border-radius:12px;
      padding:9px 13px 7px;
      min-width:58px;
      transition:background .3s;
    }
    .ritual-cd-block span {
      font-size:1.85rem;
      font-weight:900;
      color:#fff;
      line-height:1;
      letter-spacing:-.03em;
      font-variant-numeric:tabular-nums;
      display:block;
    }
    .ritual-cd-block label {
      font-size:.58rem;
      font-weight:700;
      letter-spacing:.1em;
      text-transform:uppercase;
      color:rgba(255,255,255,.55);
      margin-top:3px;
      cursor:default;
      display:block;
    }
    .ritual-cd-sep {
      font-size:1.4rem;
      font-weight:900;
      color:rgba(255,255,255,.35);
      margin-bottom:12px;
      animation:sep-blink 1s step-end infinite;
    }
    @keyframes sep-blink{0%,100%{opacity:1}50%{opacity:.15}}
    .ritual-progress-wrap {
      display:flex;
      flex-direction:column;
      gap:4px;
      margin-bottom:.75rem;
    }
    .ritual-progress-bar {
      height:3px;
      background:rgba(255,255,255,.15);
      border-radius:99px;
      overflow:hidden;
    }
    .ritual-progress-fill {
      height:100%;
      background:linear-gradient(90deg,rgba(255,255,255,.4),white);
      border-radius:99px;
      transition:width 1s linear;
      width:0%;
    }
    .ritual-progress-label {
      font-size:.7rem;
      color:rgba(255,255,255,.5);
    }
    .ritual-notif-btn {
      width:100%;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:7px;
      background:rgba(255,255,255,.1);
      border:1.5px solid rgba(255,255,255,.25);
      border-radius:12px;
      color:rgba(255,255,255,.9);
      font-size:.8rem;
      font-weight:700;
      padding:8px 14px;
      cursor:pointer;
      transition:all .22s cubic-bezier(.34,1.56,.64,1);
      backdrop-filter:blur(8px);
      margin-top:.25rem;
    }
    .ritual-notif-btn:hover {
      background:rgba(255,255,255,.2);
      border-color:rgba(255,255,255,.45);
      transform:translateY(-1px);
    }
    .ritual-notif-btn.granted {
      background:rgba(74,222,128,.18);
      border-color:rgba(74,222,128,.4);
      color:#bbf7d0;
      pointer-events:none;
    }
    .ritual-notif-btn .btn-bell { font-size:.95rem; }
    .ritual-notif-btn.ringing .btn-bell { animation:bell-ring .5s cubic-bezier(.36,.07,.19,.97) 3; }
    @keyframes bell-ring{0%,100%{transform:rotate(0)}20%{transform:rotate(15deg)}40%{transform:rotate(-13deg)}60%{transform:rotate(10deg)}80%{transform:rotate(-8deg)}}
    .ritual-cd-block.urgent { background:rgba(251,191,36,.22); border-color:rgba(251,191,36,.4); }
    .ritual-cd-block.critical { background:rgba(248,113,113,.22); border-color:rgba(248,113,113,.4); animation:cd-flash 1s ease-in-out infinite; }
    @keyframes cd-flash{0%,100%{opacity:1}50%{opacity:.6}}
    .ritual-live-badge {
      display:inline-flex;
      align-items:center;
      gap:8px;
      background:rgba(74,222,128,.2);
      border:1.5px solid rgba(74,222,128,.45);
      border-radius:50px;
      padding:7px 16px;
      font-size:.85rem;
      font-weight:700;
      color:#bbf7d0;
      width:fit-content;
    }
    .hero-no-session {
      font-size:.85rem;
      color:rgba(255,255,255,.65);
      font-style:italic;
      margin:.4rem 0 .8rem;
    }
    @media(max-width:768px){
      .dashboard-hero { padding:2rem 1.5rem; flex-direction:column; }
      .hero-ritual-card { width:100%; max-width:360px; }
      .dashboard-hero-title { font-size:2.1rem; }
    }

    /* Carte Prochain Rituel (grande carte style Preply) */
    .next-ritual-card {
      background: white;
      border-radius: 28px;
      padding: 3rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 3rem;
      transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
      border: 1px solid rgba(124, 58, 237, 0.08);
      position: relative;
      overflow: hidden;
    }

    .next-ritual-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.2), transparent);
    }

    .next-ritual-card:hover {
      box-shadow: var(--card-shadow-hover);
      transform: translateY(-4px);
      border-color: rgba(124, 58, 237, 0.15);
    }

    .next-ritual-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 2.5rem;
      flex-wrap: wrap;
      gap: 2rem;
      padding-bottom: 2.5rem;
      border-bottom: 1px solid rgba(124, 58, 237, 0.08);
    }

    .next-ritual-info {
      flex: 1;
      min-width: 250px;
    }

    .next-ritual-badge {
      display: inline-block;
      padding: 0.6rem 1.2rem;
      background: linear-gradient(135deg, rgba(124, 58, 237, 0.12) 0%, rgba(30, 64, 175, 0.12) 100%);
      color: var(--junspro-purple);
      border-radius: 14px;
      font-size: 0.88rem;
      font-weight: 700;
      margin-bottom: 1.25rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border: 1px solid rgba(124, 58, 237, 0.15);
    }

    .next-ritual-title {
      font-size: 1.85rem;
      font-weight: 800;
      color: #1a202c;
      margin-bottom: 0.75rem;
      letter-spacing: -0.01em;
    }

    .next-ritual-subtitle {
      font-size: 1.1rem;
      color: #6b7280;
      margin-bottom: 2rem;
      font-weight: 400;
      letter-spacing: 0.01px;
    }

    .next-ritual-freelancer {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      margin-bottom: 2rem;
      background: linear-gradient(135deg, rgba(124, 58, 237, 0.06) 0%, rgba(30, 64, 175, 0.06) 100%);
      padding: 1.25rem;
      border-radius: 18px;
      border: 1px solid rgba(124, 58, 237, 0.1);
    }

    .next-ritual-avatar {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid white;
      background: var(--junspro-gradient);
      box-shadow: 0 4px 16px rgba(124, 58, 237, 0.25);
    }

    .next-ritual-freelancer-info h4 {
      font-size: 1.25rem;
      font-weight: 700;
      color: #1a202c;
      margin: 0 0 0.35rem 0;
    }

    .next-ritual-freelancer-info p {
      margin: 0;
      color: #6b7280;
      font-size: 1rem;
      font-weight: 400;
    }

    .next-ritual-details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem;
      margin-bottom: 2.5rem;
      padding: 2rem;
      background: linear-gradient(135deg, #fafafa 0%, #f5f3ff 100%);
      border-radius: 18px;
      border: 1px solid rgba(124, 58, 237, 0.1);
    }

    .next-ritual-detail-item {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .next-ritual-detail-item i {
      font-size: 1.4rem;
      color: var(--junspro-purple);
      min-width: 32px;
    }

    .next-ritual-detail-item span {
      font-size: 1rem;
      color: #1a202c;
      font-weight: 500;
    }

    .next-ritual-action {
      display: flex;
      justify-content: flex-end;
    }

    .btn-ritual-join {
      background: var(--junspro-gradient);
      color: white;
      border: none;
      padding: 1rem 2.5rem;
      border-radius: 14px;
      font-weight: 700;
      font-size: 1.05rem;
      transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
      box-shadow: 0 8px 24px rgba(124, 58, 237, 0.35);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
      position: relative;
      z-index: 1;
    }

    .btn-ritual-join:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 36px rgba(124, 58, 237, 0.45);
      color: white;
      text-decoration: none;
    }

    .btn-ritual-join:active {
      transform: translateY(-1px);
    }

    .btn-ritual-join:disabled {
      opacity: 0.55;
      cursor: not-allowed;
      transform: none;
    }

    /* Section Prochainement (Timeline style Preply) */
    .upcoming-section {
      background: white;
      border-radius: 28px;
      padding: 3rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 3rem;
      border: 1px solid rgba(124, 58, 237, 0.08);
      transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .upcoming-section:hover {
      box-shadow: var(--shadow-md);
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2.5rem;
    }

    .section-title {
      font-size: 1.75rem;
      font-weight: 800;
      color: #1a202c;
      margin: 0;
      letter-spacing: -0.01em;
    }

    .section-link {
      font-size: 1rem;
      color: var(--junspro-purple);
      text-decoration: none;
      font-weight: 700;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .section-link::after {
      content: '→';
      opacity: 0;
      transform: translateX(-4px);
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .section-link:hover {
      color: var(--junspro-blue);
    }

    .section-link:hover::after {
      opacity: 1;
      transform: translateX(0);
    }

    .timeline-list {
      position: relative;
      padding-left: 0;
      list-style: none;
    }

    .timeline-item {
      position: relative;
      padding-left: 3.5rem;
      padding-bottom: 2rem;
      border-left: 2px solid rgba(124, 58, 237, 0.15);
      margin-left: 1.25rem;
    }

    .timeline-item:last-child {
      border-left: none;
      padding-bottom: 0;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: -9.5px;
      top: 0.75rem;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: var(--junspro-gradient);
      border: 3px solid white;
      box-shadow: 0 0 0 2px var(--junspro-purple), 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .timeline-card {
      background: linear-gradient(135deg, #fafafa 0%, #f5f3ff 100%);
      border-radius: 14px;
      padding: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1.25rem;
      transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
      border: 1.5px solid rgba(124, 58, 237, 0.1);
    }

    .timeline-card:hover {
      background: white;
      border-color: rgba(124, 58, 237, 0.2);
      box-shadow: var(--shadow-md);
      transform: translateX(8px);
    }

    .timeline-content {
      flex: 1;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .timeline-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      background: var(--junspro-gradient);
      border: 2px solid #e5e7eb;
      flex-shrink: 0;
    }

    .timeline-info {
      flex: 1;
    }

    .timeline-date {
      font-size: 0.95rem;
      color: #1a202c;
      font-weight: 600;
      margin-bottom: 0.35rem;
    }

    .timeline-time {
      font-size: 0.9rem;
      color: #6b7280;
      margin-bottom: 0.35rem;
      font-weight: 400;
    }

    .timeline-project {
      font-size: 1.05rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.25rem;
    }

    .timeline-freelancer {
      font-size: 0.9rem;
      color: #6b7280;
      font-weight: 400;
    }


    /* Section Résumés de Rituels (IA) */
    .ai-reports-section {
      background: white;
      border-radius: 28px;
      padding: 3rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 3rem;
      border: 1px solid rgba(124, 58, 237, 0.08);
      transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .ai-reports-section:hover {
      box-shadow: var(--shadow-md);
    }

    .ai-reports-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .ai-report-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.5rem 1.75rem;
      border-radius: 14px;
      transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
      cursor: pointer;
      margin-bottom: 0.75rem;
      background: linear-gradient(135deg, #fafafa 0%, #f5f3ff 100%);
      border: 1.5px solid rgba(124, 58, 237, 0.1);
    }

    .ai-report-item:hover {
      background: white;
      border-color: rgba(124, 58, 237, 0.2);
      box-shadow: var(--shadow-md);
      transform: translateX(6px);
    }

    .ai-report-content {
      flex: 1;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .ai-report-info {
      flex: 1;
    }

    .ai-report-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 0.35rem;
    }

    .ai-report-meta {
      font-size: 0.9rem;
      color: #6b7280;
      font-weight: 400;
    }

    .ai-report-badge {
      display: inline-block;
      padding: 0.4rem 0.9rem;
      background: linear-gradient(135deg, rgba(124, 58, 237, 0.12) 0%, rgba(30, 64, 175, 0.12) 100%);
      color: var(--junspro-purple);
      border-radius: 12px;
      font-size: 0.8rem;
      font-weight: 700;
      margin-left: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      border: 1px solid rgba(124, 58, 237, 0.15);
    }

    .ai-report-arrow {
      color: #c4b5fd;
      font-size: 1.4rem;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .ai-report-item:hover .ai-report-arrow {
      color: var(--junspro-purple);
      transform: translateX(4px);
    }

    /* Section Continuez à avancer (Onglets style Preply) */
    .continue-section {
      background: white;
      border-radius: 28px;
      padding: 3rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 3rem;
      border: 1px solid rgba(124, 58, 237, 0.08);
      transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .continue-section:hover {
      box-shadow: var(--shadow-md);
    }

    .tabs-container {
      margin-bottom: 2.5rem;
    }

    .tabs-list {
      display: flex;
      gap: 0.5rem;
      border-bottom: 2px solid rgba(124, 58, 237, 0.1);
      margin-bottom: 2.5rem;
      overflow-x: auto;
    }

    .tab-button {
      padding: 1rem 1.75rem;
      background: none;
      border: none;
      color: #6b7280;
      font-weight: 600;
      font-size: 0.98rem;
      cursor: pointer;
      border-bottom: 3px solid transparent;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
      white-space: nowrap;
      position: relative;
    }

    .tab-button:hover {
      color: var(--junspro-purple);
      background: rgba(124, 58, 237, 0.06);
    }

    .tab-button.active {
      color: var(--junspro-purple);
      border-bottom-color: var(--junspro-purple);
      font-weight: 700;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    .tips-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .tip-card {
      background: linear-gradient(135deg, #fafafa 0%, #f5f3ff 100%);
      border-radius: 18px;
      padding: 2rem;
      border: 1.5px solid rgba(124, 58, 237, 0.1);
      transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
      backdrop-filter: blur(10px);
    }

    .tip-card:hover {
      background: white;
      box-shadow: var(--shadow-lg);
      transform: translateY(-4px);
      border-color: rgba(124, 58, 237, 0.2);
    }

    .tip-card-title {
      font-size: 1.15rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 0.75rem;
      letter-spacing: -0.005em;
    }

    .tip-card-text {
      font-size: 0.95rem;
      color: #4b5563;
      line-height: 1.7;
      margin-bottom: 0;
      font-weight: 400;
    }

    /* Section Abonnements (style Preply exact) */
    .subscriptions-section {
      background: white;
      border-radius: 28px;
      padding: 3rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 3rem;
      border: 1px solid rgba(124, 58, 237, 0.08);
      transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .subscriptions-section:hover {
      box-shadow: var(--shadow-md);
    }

    /* Carousel Abonnements Style Preply */

    .subscriptions-carousel-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .subscriptions-carousel {
      display: flex;
      gap: 1.5rem;
      overflow-x: auto;
      scroll-behavior: smooth;
      scrollbar-width: none;
      padding: 1rem 0;
      flex: 1;
    }

    .subscriptions-carousel::-webkit-scrollbar {
      display: none;
    }

    .carousel-nav {
      min-width: 48px;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      border: 2px solid rgba(124, 58, 237, 0.2);
      background: white;
      color: #1a202c;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      box-shadow: var(--shadow-sm);
    }

    .carousel-nav:hover {
      background: var(--junspro-gradient);
      border-color: var(--junspro-purple);
      color: white;
      transform: scale(1.1);
      box-shadow: var(--shadow-md);
    }

    /* JP Premium Card Style - adapté pour carousel */
    .subscription-preply-card {
      flex: 0 0 420px;
      background: white;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: var(--shadow-md);
      transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
      border: 1.5px solid rgba(124, 58, 237, 0.08);
      position: relative;
      display: flex;
      flex-direction: column;
    }

    .subscription-preply-card:hover {
      box-shadow: var(--shadow-lg);
      transform: translateY(-8px);
      border-color: rgba(124, 58, 237, 0.15);
    }

    /* Header band avec gradient et info */
    .subscription-preply-header {
      background: var(--junspro-gradient-alt);
      padding: 2rem 2rem 2.25rem;
      position: relative;
      display: flex;
      align-items: center;
      gap: 1.5rem;
    }

    .subscription-preply-avatar {
      width: 88px;
      height: 88px;
      border-radius: 16px;
      object-fit: cover;
      border: 3px solid rgba(255,255,255,0.75);
      box-shadow: 0 8px 24px rgba(0,0,0,0.22);
      flex-shrink: 0;
      background: white;
    }

    .subscription-preply-avatar-initials {
      width: 79px;
      height: 79px;
      border-radius: 14px;
      background: rgba(255,255,255,0.18);
      border: 2.5px solid rgba(255,255,255,0.5);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 1.5rem;
      flex-shrink: 0;
      backdrop-filter: blur(4px);
    }

    .subscription-preply-header-info {
      flex: 1;
      min-width: 0;
    }

    .subscription-preply-name {
      font-size: 1.2rem;
      font-weight: 800;
      color: white;
      margin: 0 0 0.25rem;
      text-shadow: 0 2px 8px rgba(0,0,0,0.15);
      letter-spacing: -0.01em;
    }

    .subscription-preply-subtitle {
      font-size: 0.85rem;
      color: rgba(255,255,255,0.85);
      margin: 0;
      font-weight: 400;
      letter-spacing: 0.02px;
    }

    /* Menu kebab button */
    .subscription-menu-wrapper {
      position: absolute;
      top: 1rem;
      right: 1rem;
      z-index: 100;
    }

    .subscription-menu-btn {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: rgba(255,255,255,0.15);
      border: 1.5px solid rgba(255,255,255,0.3);
      color: white;
      font-size: 1.4rem;
      font-weight: 900;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s;
      backdrop-filter: blur(4px);
      letter-spacing: -0.05em;
      line-height: 1;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .subscription-menu-btn:hover {
      background: rgba(255,255,255,0.28);
      transform: scale(1.08);
    }

    .subscription-menu-dropdown {
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      background: white;
      border-radius: 18px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.16), 0 4px 16px rgba(124,58,237,0.10);
      min-width: 260px;
      z-index: 9999;
      display: none;
      overflow: hidden;
      border: 1px solid rgba(124,58,237,0.08);
      animation: jpMenuIn 0.22s cubic-bezier(0.4,0,0.2,1);
    }

    @keyframes jpMenuIn {
      from { opacity: 0; transform: translateY(-8px) scale(0.97); }
      to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .subscription-menu-dropdown.active {
      display: block;
    }

    .subscription-menu-item {
      display: flex;
      align-items: center;
      gap: 0.85rem;
      padding: 0.82rem 1.25rem;
      color: #1f2937;
      background: none;
      border: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
      font-size: 0.88rem;
      font-weight: 500;
      transition: background 0.18s, color 0.18s;
      position: relative;
      text-decoration: none;
    }

    .subscription-menu-item:hover {
      background: #f5f3ff;
      color: #7c3aed;
    }

    /* Status badge pour header */
    .subscription-preply-status {
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      padding: 0.28rem 0.75rem;
      border-radius: 999px;
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.04em;
      position: relative;
    }

    .subscription-preply-header .subscription-preply-status {
      position: relative;
      top: auto;
      left: auto;
    }

    .subscription-preply-status.active {
      background: #d1fae5;
      color: #065f46;
    }

    .subscription-preply-status.paused {
      background: #fef3c7;
      color: #92400e;
    }

    .subscription-preply-status.cancelled {
      background: #fee2e2;
      color: #991b1b;
    }

    .status-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
    }

    .subscription-preply-status.active .status-dot {
      background: #10b981;
    }

    .subscription-preply-status.paused .status-dot {
      background: #f59e0b;
    }

    .subscription-preply-status.cancelled .status-dot {
      background: #ef4444;
    }

    /* Card body */
    .subscription-preply-body {
      padding: 2rem;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    /* Stats row */
    .subscription-stats-row {
      display: flex;
      gap: 1.25rem;
      margin-bottom: 1.5rem;
    }

    .subscription-stat {
      flex: 1;
      background: linear-gradient(135deg, #f5f3ff 0%, #fafafa 100%);
      border-radius: 14px;
      padding: 1rem;
      text-align: center;
      border: 1.5px solid rgba(124, 58, 237, 0.12);
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .subscription-preply-card:hover .subscription-stat {
      border-color: rgba(124, 58, 237, 0.2);
    }

    .subscription-stat-value {
      font-size: 1.5rem;
      font-weight: 900;
      color: #6d28d9;
      line-height: 1;
      margin-bottom: 0.35rem;
      letter-spacing: -0.02em;
    }

    .subscription-stat-label {
      font-size: 0.7rem;
      color: #9ca3af;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      font-weight: 700;
    }

    /* Usage gauge */
    .usage-gauge-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.6rem;
      margin: 1rem 0 0.5rem;
    }

    .gauge-svg {
      width: 100px;
      height: 100px;
      overflow: visible;
    }

    .gauge-track {
      fill: none;
      stroke: #e5e7eb;
      stroke-width: 8;
      stroke-linecap: round;
    }

    .gauge-fill {
      fill: none;
      stroke-width: 8;
      stroke-linecap: round;
      transition: stroke-dashoffset 0.6s ease, stroke 0.4s ease;
    }

    .gauge-pct {
      font-size: 18px;
      font-weight: 700;
      fill: #111827;
      text-anchor: middle;
      dominant-baseline: middle;
    }

    .gauge-sub {
      font-size: 9px;
      fill: #6b7280;
      text-anchor: middle;
      dominant-baseline: middle;
    }

    .gauge-legend {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.15rem;
    }

    .gauge-legend-used {
      font-size: 0.8rem;
      font-weight: 600;
    }

    .gauge-legend-left {
      font-size: 0.75rem;
      color: #6b7280;
    }

    /* Quick actions grid */
    .subscription-quick-actions {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 0.6rem;
      margin-top: 1rem;
      padding-top: 1rem;
      border-top: 1px solid #f3f4f6;
    }

    .qa-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 0.3rem;
      padding: 0.6rem;
      border-radius: 10px;
      border: 1.5px solid #e5e7eb;
      background: white;
      cursor: pointer;
      transition: all 0.22s cubic-bezier(0.4,0,0.2,1);
      font-size: 0.68rem;
      font-weight: 600;
      color: #374151;
      text-align: center;
      text-decoration: none;
    }

    .qa-btn:hover {
      border-color: #7c3aed;
      color: #7c3aed;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124,58,237,0.13);
    }

    .qa-icon {
      font-size: 1.2rem;
      line-height: 1;
    }

    /* États vides */
    .empty-state {
      text-align: center;
      padding: 3rem 2rem;
    }

    .empty-state-icon {
      font-size: 4rem;
      color: #d1d5db;
      margin-bottom: 1rem;
    }

    .empty-state-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 0.75rem;
    }

    .empty-state-text {
      font-size: 0.95rem;
      color: #6b7280;
      margin-bottom: 2rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .client-dashboard-container {
        max-width: 100%;
        padding: 1rem;
      }

      .dashboard-hero {
        flex-direction: column;
        padding: 2rem 1.5rem;
      }

      .dashboard-hero-title {
        font-size: 1.5rem;
      }

      .dashboard-hero-actions {
        width: 100%;
        flex-direction: column;
      }

      .btn-hero-primary,
      .btn-hero-secondary {
        width: 100%;
        justify-content: center;
      }

      .next-ritual-card {
        padding: 1.5rem;
      }

      .next-ritual-details {
        grid-template-columns: 1fr;
      }

      .timeline-item {
        padding-left: 2rem;
      }

      .subscriptions-grid,
      .tips-grid,
      .rewards-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Section Récompenses (style Preply) */
    .rewards-section {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
    }

    .rewards-header {
      margin-bottom: 1.5rem;
    }

    .rewards-count {
      font-size: 0.95rem;
      color: #6b7280;
      font-weight: 500;
    }

    .rewards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .reward-card {
      position: relative;
      background: #f9fafb;
      border-radius: 16px;
      padding: 1.5rem 1rem;
      text-align: center;
      transition: all 0.2s ease;
      border: 2px solid transparent;
      cursor: pointer;
    }

    .reward-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .reward-card.reward-unlocked {
      background: white;
      border-color: #e5e7eb;
    }

    .reward-card.reward-locked {
      opacity: 0.6;
      position: relative;
    }

    .reward-badge-new {
      position: absolute;
      top: 0.5rem;
      right: 0.5rem;
      background: #ec4899;
      color: white;
      font-size: 0.7rem;
      font-weight: 600;
      padding: 0.25rem 0.5rem;
      border-radius: 8px;
    }

    .reward-icon {
      width: 56px;
      height: 56px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 0.75rem;
      font-size: 1.5rem;
    }

    .reward-title {
      font-size: 0.875rem;
      font-weight: 500;
      color: #1f2937;
      margin-top: 0.5rem;
    }

    .reward-lock {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(255, 255, 255, 0.9);
      border-radius: 50%;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #9ca3af;
      font-size: 0.875rem;
    }

    .rewards-empty {
      text-align: center;
      padding: 2rem 1rem;
      color: #6b7280;
      font-size: 0.95rem;
    }

  </style>
@endsection

@section('content')
  <div class="client-dashboard-container">
    <!-- Navigation principale (onglets) -->
    @include('frontend.client.partials.dashboard-nav')

    @php
      $user = Auth::guard('web')->user();
      $firstName = $user->first_name ?? $user->username ?? 'Client';
      $nextRitual = $nextSession ?? null;
    @endphp

    {{-- ── Données JS pour le countdown et l'alarme ── --}}
    <script>
      window.nextRitualStartAt    = @json($nextRitual ? \Carbon\Carbon::parse($nextRitual->start_at)->toIso8601String() : null);
      window.nextRitualFreelancer = @json(optional(optional(optional($nextRitual?->subscription)->freelancer)->user)->first_name ?? optional(optional(optional($nextRitual?->subscription)->freelancer)->user)->name ?? null);
    </script>

    @php
      $aiReports = $lastReports->take(3)->map(function($report) {
        return [
          'id' => $report->id,
          'title' => 'Résumé de Rituel',
          'date' => \Carbon\Carbon::parse($report->end_at)->format('d/m/Y à H:i'),
          'project' => 'Rituel #' . $report->subscription_id,
          'freelancer' => $report->subscription->freelancer->user->name ?? 'Freelance',
        ];
      });
      
      // Si pas de rapports, créer des placeholders
      if ($aiReports->isEmpty()) {
        $aiReports = collect([
          ['id' => 1, 'title' => 'Résumé de Rituel', 'date' => 'Aucun résumé disponible', 'project' => '', 'freelancer' => ''],
        ]);
      }
    @endphp

    <!-- 1) Hero ultra-lux -->
    <div class="dashboard-hero">
      {{-- Grille de points décoratifs --}}
      <div class="hero-dots-deco">
        @for($i=0;$i<25;$i++)<span></span>@endfor
      </div>

      {{-- Gauche : salutation + CTAs --}}
      <div class="hero-left">
        <div class="hero-eyebrow">
          <span class="hero-eyebrow-dot"></span>
          Espace client
        </div>
        <h1 class="dashboard-hero-title">Bonjour {{ $firstName }}&nbsp;!</h1>
        <p class="dashboard-hero-subtitle">
          @if($nextRitual)
            Votre prochain Rituel commence bientôt.<br>Tout est prêt.
          @else
            Trouvez votre freelance idéal<br>et démarrez votre premier Rituel.
          @endif
        </p>
        <div class="hero-cta-row">
          @if($nextRitual)
            <a href="{{ route('client.subscriptions.show', $nextRitual->subscription_id) }}" class="hero-btn-main">
              <i class="far fa-calendar"></i>
              Voir le Rituel
            </a>
            <a href="{{ route('explore') }}" class="hero-btn-ghost">
              Explorer les profils
            </a>
          @else
            <a href="{{ route('explore') }}" class="hero-btn-main">
              <i class="fas fa-search"></i>
              Trouver un freelance
            </a>
          @endif
        </div>
      </div>

      {{-- Droite : widget countdown glassmorphism --}}
      <div class="hero-ritual-card" id="ritual-countdown-widget">
        @if($nextRitual)
          <div class="ritual-status-pill">
            <span class="ritual-status-dot"></span>
            <span id="ritual-status-label">Programmé</span>
          </div>
          <div class="ritual-countdown-blocks" id="ritual-cd-blocks">
            <div class="ritual-cd-block" id="cd-block-d"><span id="cd-days">--</span><label>jours</label></div>
            <div class="ritual-cd-sep">:</div>
            <div class="ritual-cd-block" id="cd-block-h"><span id="cd-hours">--</span><label>heures</label></div>
            <div class="ritual-cd-sep">:</div>
            <div class="ritual-cd-block" id="cd-block-m"><span id="cd-mins">--</span><label>min</label></div>
            <div class="ritual-cd-sep">:</div>
            <div class="ritual-cd-block" id="cd-block-s"><span id="cd-secs">--</span><label>sec</label></div>
          </div>
          <div class="ritual-progress-wrap">
            <div class="ritual-progress-bar"><div class="ritual-progress-fill" id="ritual-progress-fill"></div></div>
            <span class="ritual-progress-label" id="ritual-progress-label"></span>
          </div>
          @php
            $freelancerFirstName = optional(optional(optional($nextRitual->subscription)->freelancer)->user)->first_name;
          @endphp
          @if($freelancerFirstName)
            <div style="font-size:.72rem;color:rgba(255,255,255,.6);margin:.4rem 0 .6rem;">Avec : {{ $freelancerFirstName }}</div>
          @endif
          <button class="ritual-notif-btn" id="ritual-notif-btn">
            <i class="fas fa-bell btn-bell"></i>
            <span id="ritual-notif-label">Me rappeler 15 min avant</span>
          </button>
        @else
          <div class="ritual-status-pill" style="background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.12);">
            <span class="ritual-status-dot" style="background:#94a3b8;animation:none;"></span>
            <span>Aucun Rituel</span>
          </div>
          <p class="hero-no-session">Aucun Rituel planifié prochainement.</p>
          <a href="{{ route('explore') }}" class="hero-btn-ghost" style="font-size:.8rem;justify-content:center;">
            Planifier un Rituel →
          </a>
        @endif
      </div>
    </div>

    {{-- Module Pause Souffle Inline (en haut du contenu principal, avant sections secondaires) --}}
    <div style="margin: 1.5rem 0;">
      @include('frontend.components.pause-souffle.inline-premium')
    </div>

    <!-- 2) Section "Prochainement" (Timeline style Preply) -->
    <div class="upcoming-section">
      <div class="section-header">
        <h2 class="section-title">Prochainement</h2>
    @if($upcomingSessions->count() > 0)
          <a href="{{ route('client.subscriptions.index') }}" class="section-link">Voir tout</a>
        @endif
        </div>
        
      @php
        // Combiner nextRitual et upcomingSessions pour afficher tous les rituels à venir
        $allUpcomingSessions = collect();
        if ($nextRitual) {
          $allUpcomingSessions->push($nextRitual);
        }
        $allUpcomingSessions = $allUpcomingSessions->merge($upcomingSessions)->take(5);
      @endphp
      
      @if($allUpcomingSessions->count() > 0)
        <ul class="timeline-list">
          @foreach($allUpcomingSessions as $session)
            @php
              $sessionDate = \Carbon\Carbon::parse($session->start_at);
              $now = \Carbon\Carbon::now();
              $diffDays = $now->diffInDays($sessionDate, false);
              
              if ($diffDays == 0) {
                $dateLabel = 'Aujourd\'hui';
              } elseif ($diffDays == 1) {
                $dateLabel = 'Demain';
              } elseif ($diffDays == -1) {
                $dateLabel = 'Hier';
              } else {
                $dateLabel = $sessionDate->format('d M');
              }
              
              $dayName = $sessionDate->format('l');
              $timeRange = $sessionDate->format('H:i') . ' – ' . \Carbon\Carbon::parse($session->end_at)->format('H:i');
            @endphp
            <li class="timeline-item">
              <div class="timeline-card">
                <div class="timeline-content">
                  @if($session->subscription->freelancer->user->image)
                    <img src="{{ asset('assets/img/users/' . $session->subscription->freelancer->user->image) }}" 
                         alt="{{ $session->subscription->freelancer->user->name }}" 
                         class="timeline-avatar"
                         onerror="this.src='{{ asset('assets/img/blank-user.jpg') }}'">
                  @else
                    <div class="timeline-avatar" style="display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 1.1rem;">
                      {{ strtoupper(substr($session->subscription->freelancer->user->name, 0, 1)) }}
                    </div>
                  @endif
                  <div class="timeline-info">
                    <div class="timeline-date">{{ $dateLabel }}</div>
                    <div class="timeline-time">{{ $dayName }}, {{ $timeRange }}</div>
                    <div class="timeline-project">{{ $session->subscription->freelancer->user->name }}</div>
                  </div>
                </div>
                @include('components.client-upcoming-actions-menu', [
                  'sessionId' => $session->id,
                  'subscriptionId' => $session->subscription_id,
                  'freelancerId' => $session->subscription->freelancer->id,
                ])
              </div>
            </li>
          @endforeach
        </ul>
        @if($upcomingSessions->count() > 4 || ($nextRitual && $upcomingSessions->count() > 3))
          <div style="text-align: center; margin-top: 1.5rem;">
            <a href="{{ route('client.subscriptions.index') }}" class="section-link">Voir plus</a>
          </div>
        @endif
      @else
        <div class="empty-state">
          <div class="empty-state-icon"><i class="far fa-calendar"></i></div>
          <h3 class="empty-state-title">Aucun Rituel planifié</h3>
          <p class="empty-state-text">Planifiez de nouveaux Rituels pour continuer à avancer.</p>
          <a href="{{ route('explore') }}" class="btn-hero-primary">Planifier un Rituel</a>
        </div>
    @endif
      </div>

    <!-- 3) Section "Résumés de Rituels (IA)" -->
    <div class="ai-reports-section">
      <div class="section-header">
        <h2 class="section-title">Résumés de Rituels <span class="ai-report-badge">IA beta</span></h2>
        @if($lastReports->count() > 0)
          <a href="{{ route('client.subscriptions.index') }}" class="section-link">Voir tout</a>
        @endif
      </div>

      @if($lastReports->count() > 0)
        <ul class="ai-reports-list">
          @foreach($lastReports->take(3) as $report)
            <li class="ai-report-item" onclick="window.location.href='{{ route('client.subscriptions.show', $report->subscription_id) }}'">
              <div class="ai-report-content">
                <div class="ai-report-info">
                  <div class="ai-report-title">{{ Str::limit($report->report_text ?? 'Résumé de Rituel', 50) }}</div>
                  <div class="ai-report-meta">
                    {{ \Carbon\Carbon::parse($report->end_at)->format('d/m/Y à H:i') }} · Rituel #{{ $report->subscription_id }}
                    <span class="ai-report-badge">IA</span>
              </div>
              </div>
            </div>
              <i class="fas fa-chevron-right ai-report-arrow"></i>
            </li>
          @endforeach
        </ul>
      @else
        <div class="empty-state">
          <div class="empty-state-icon"><i class="fas fa-robot"></i></div>
          <h3 class="empty-state-title">Activez les résumés IA</h3>
          <p class="empty-state-text">Les résumés automatiques de vos Rituels apparaîtront ici une fois activés.</p>
          <a href="{{ route('client.subscriptions.index') }}" class="btn-hero-primary">Activer les résumés</a>
        </div>
      @endif
    </div>

    <!-- 4) Section "Continuez à avancer" (Onglets style Preply) -->
    <div class="continue-section">
      <div class="section-header">
        <h2 class="section-title">Continuez à avancer</h2>
        <a href="#" class="section-link">Voir plus</a>
      </div>

      <div class="tabs-container">
        <div class="tabs-list">
          <button class="tab-button active" data-tab="organization">Organisation</button>
          <button class="tab-button" data-tab="skills">Compétences</button>
          <button class="tab-button" data-tab="business">Business</button>
        </div>

        <div class="tab-content active" id="tab-organization">
          <div class="tips-grid">
            <div class="tip-card">
              <h3 class="tip-card-title">Optimisez votre briefing</h3>
              <p class="tip-card-text">Un briefing clair permet à votre freelance de mieux comprendre vos besoins et d'être plus efficace.</p>
            </div>
            <div class="tip-card">
              <h3 class="tip-card-title">Planifiez vos Rituels</h3>
              <p class="tip-card-text">Organisez vos Rituels à l'avance pour maintenir un rythme régulier et progresser efficacement.</p>
            </div>
          </div>
        </div>

        <div class="tab-content" id="tab-skills">
          <div class="tips-grid">
            <div class="tip-card">
              <h3 class="tip-card-title">Développez vos compétences</h3>
              <p class="tip-card-text">Chaque Rituel est une opportunité d'apprendre et de progresser.</p>
            </div>
            <div class="tip-card">
              <h3 class="tip-card-title">Utilisez les rapports</h3>
              <p class="tip-card-text">Les rapports de vos freelances vous aident à suivre l'avancement et à identifier les points d'amélioration.</p>
            </div>
          </div>
        </div>

        <div class="tab-content" id="tab-business">
          <div class="tips-grid">
            <div class="tip-card">
              <h3 class="tip-card-title">Gérez vos abonnements</h3>
              <p class="tip-card-text">Suivez vos Rituels à programmer et ajustez vos abonnements selon vos besoins réels.</p>
            </div>
            <div class="tip-card">
              <h3 class="tip-card-title">Optimisez vos coûts</h3>
              <p class="tip-card-text">Choisissez le bon nombre d'heures par semaine pour équilibrer qualité et budget.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 5) Section "Abonnements" (style Preply avec Carousel) -->
    <div class="subscriptions-section">
      <div class="section-header">
        <h2 class="section-title">Abonnements</h2>
        <a href="{{ route('user.settings.subscription') }}" class="section-link">Gérer</a>
      </div>

      @if($subscriptions->count() > 0)
        <div class="subscriptions-carousel-wrapper">
          <button class="carousel-nav carousel-nav-prev" onclick="scrollCarousel(-1)">
            <i class="fas fa-chevron-left"></i>
          </button>
          
          <div class="subscriptions-carousel" id="subscriptionsCarousel">
            @foreach($subscriptions as $subscription)
              @php
                $freelancer = $subscription->freelancer->user ?? null;
                $freelancerName = $freelancer ? ($freelancer->first_name . ' ' . $freelancer->last_name) : 'Freelance';
                $nextBillingDate = $subscription->next_billing_at ? \Carbon\Carbon::parse($subscription->next_billing_at) : null;
                $hoursRemaining = $subscription->calculated_hours_remaining ?? $subscription->hours_remaining ?? 0;
                
                // Service name from freelancer bio
                $bio = $freelancer && $freelancer->bio ? $freelancer->bio : null;
                $serviceName = 'Abonnement';
                if ($bio) { $serviceName = \Illuminate\Support\Str::limit($bio, 32); }
                
                // ── Données jauge cycle ──────────────────────────────
                $cycleUsageSvc = app(\App\Services\Junspro\CycleUsageService::class);
                $universeType = $cycleUsageSvc->universeType($subscription->universe ?? '');
                $hoursPerCycle = ($subscription->hours_per_week ?? 0) * 4;
                $palier = $cycleUsageSvc->snapToPalier($hoursPerCycle, $universeType);
                $usedHours = max(0, $hoursPerCycle - (float)$hoursRemaining);
                $usageRatio = $hoursPerCycle > 0 ? min(1, $usedHours / $hoursPerCycle) : 0;
                
                // SVG Gauge
                $svgR = 44;
                $svgCirc = round(2 * M_PI * $svgR, 2);
                $svgOffset = round($svgCirc * (1 - $usageRatio), 2);
                
                // Couleur selon ratio
                $gaugeColor = $usageRatio < 0.70 ? '#10B981' : ($usageRatio < 0.85 ? '#F59E0B' : '#EF4444');
                
                // Initiales
                $nameParts = explode(' ', $freelancerName);
                $initials = count($nameParts) >= 2
                  ? strtoupper(substr($nameParts[0],0,1).substr($nameParts[count($nameParts)-1],0,1))
                  : strtoupper(substr($freelancerName,0,2));
                
                // Pending sessions
                $pendingSessions = \App\Models\WorkSession::where('subscription_id', $subscription->id)
                  ->where('status', 'pending')
                  ->count();
              @endphp

              <div class="subscription-preply-card">
                
                {{-- Header band dégradé --}}
                <div class="subscription-preply-header">
                  {{-- Avatar --}}
                  @if($freelancer && $freelancer->image)
                    <img src="{{ asset('assets/img/users/'.$freelancer->image) }}"
                         alt="{{ $freelancerName }}"
                         class="subscription-preply-avatar"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div class="subscription-preply-avatar-initials" style="display:none;">{{ $initials }}</div>
                  @else
                    <div class="subscription-preply-avatar-initials">{{ $initials }}</div>
                  @endif

                  {{-- Header info --}}
                  <div class="subscription-preply-header-info">
                    <div style="display: flex; align-items: center; gap: 0.6rem;">
                      <p class="subscription-preply-name">{{ $freelancerName }}</p>
                      {{-- Status badge next to name --}}
                      <span class="subscription-preply-status {{ $subscription->status === 'active' ? 'active' : ($subscription->status === 'paused' ? 'paused' : 'cancelled') }}">
                        <span class="status-dot"></span>
                        @if($subscription->status === 'active') Actif
                        @elseif($subscription->status === 'paused') En pause
                        @else Annulé @endif
                      </span>
                    </div>
                  </div>

                  {{-- Bouton kebab --}}
                  <div class="subscription-menu-wrapper">
                    <button class="subscription-menu-btn" type="button" onclick="toggleSubscriptionMenu({{ $subscription->id }})" aria-label="Actions">⋯</button>
                    {{-- Menu --}}
                    <div class="subscription-menu-dropdown" id="menu-{{ $subscription->id }}">
                      <a href="{{ route('client.subscriptions.show', $subscription->id) }}" class="subscription-menu-item">
                        <span>📅</span> Programmer des Rituels
                      </a>
                      <button type="button" class="subscription-menu-item" onclick="window.openTopUpModal({subscriptionId: {{ $subscription->id }}, tutorName: '{{ addslashes($freelancerName) }}', avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/'.$freelancer->image) : '' }}', unitPrice: {{ $subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0 }}, scheduleUntil: '{{ $nextBillingDate ? $nextBillingDate->format('d M Y') : '' }}', postUrl: '{{ route('user.account.subscriptions.topup', $subscription->id) }}', quotaUrl: '{{ route('user.account.subscriptions.topup-quota', $subscription->id) }}', csrf: '{{ csrf_token() }}', ritualSignature: '', upgradeDetails: ''})">
                        <span>➕</span> Ajouter des Rituels
                      </button>
                      <button type="button" class="subscription-menu-item" onclick="window.openChangePlanFlow({subscriptionId: {{ $subscription->id }}, tutorName: '{{ addslashes($freelancerName) }}', avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/'.$freelancer->image) : '' }}', currentHours: {{ $subscription->hours_per_week }}, currentPrice: {{ $subscription->price_base ?? 0 }}, unitPrice: {{ $subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0 }}, nextBillingDate: '{{ $nextBillingDate ? $nextBillingDate->format('Y-m-d H:i:s') : '' }}', contextUrl: '{{ route('user.account.subscriptions.change-plan-context', $subscription->id) }}', submitUrl: '{{ route('user.account.subscriptions.change-plan', $subscription->id) }}', csrf: '{{ csrf_token() }}'})">
                        <span>🔄</span> Changer de formule
                      </button>
                      <button type="button" class="subscription-menu-item" onclick="window.openTransferEntryModal({subscriptionId: {{ $subscription->id }}, tutorName: '{{ addslashes($freelancerName) }}', avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/'.$freelancer->image) : '' }}', credit: {{ $subscription->hours_remaining ?? 0 }}, creditAmount: {{ ($subscription->hours_remaining ?? 0) * ($subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0) }}})">
                        <span>↗️</span> Transférer le solde
                      </button>
                      @if($subscription->status === 'active')
                        <form method="POST" action="{{ route('user.settings.subscription.pause', $subscription->id) }}" style="contents">
                          @csrf
                          <button type="submit" class="subscription-menu-item">
                            <span>⏸️</span> Mettre en pause
                          </button>
                        </form>
                      @elseif($subscription->status === 'paused')
                        <form method="POST" action="{{ route('user.settings.subscription.resume', $subscription->id) }}" style="contents">
                          @csrf
                          <button type="submit" class="subscription-menu-item">
                            <span>▶️</span> Reprendre
                          </button>
                        </form>
                      @endif
                    </div>
                  </div>
                </div>

                {{-- Card body --}}
                <div class="subscription-preply-body">
                  
                  {{-- Stats row --}}
                  <div class="subscription-stats-row">
                    <div class="subscription-stat">
                      <div class="subscription-stat-value">{{ number_format($hoursRemaining, 0) }}</div>
                      <div class="subscription-stat-label">Rituels à programmer</div>
                    </div>
                    <div class="subscription-stat">
                      <div class="subscription-stat-value">{{ $subscription->hours_per_week * 2 }}</div>
                      <div class="subscription-stat-label">Rituels / cycle de 4 sem</div>
                    </div>
                  </div>

                  {{-- Usage gauge --}}
                  <div class="usage-gauge-wrap">
                    <svg viewBox="0 0 100 100" class="gauge-svg" role="img" aria-label="{{ round($usageRatio * 100) }}% consommé">
                      <circle cx="50" cy="50" r="{{ $svgR }}" class="gauge-track"
                              stroke-dasharray="{{ $svgCirc }}" stroke-dashoffset="0"
                              transform="rotate(-90 50 50)"/>
                      <circle cx="50" cy="50" r="{{ $svgR }}" class="gauge-fill"
                              stroke="{{ $gaugeColor }}"
                              stroke-dasharray="{{ $svgCirc }}" stroke-dashoffset="{{ $svgOffset }}"
                              transform="rotate(-90 50 50)"/>
                      <text x="50" y="46" class="gauge-pct">{{ round($usageRatio * 100) }}%</text>
                      <text x="50" y="60" class="gauge-sub">utilisé</text>
                    </svg>
                    <div class="gauge-legend">
                      <span class="gauge-legend-used" style="color:{{ $gaugeColor }}">
                        {{ number_format($usedHours, 1) }} consommés
                      </span>
                      <span class="gauge-legend-left">
                        {{ number_format($hoursRemaining, 1) }} à programmer / {{ number_format($hoursPerCycle, 0) }}
                      </span>
                    </div>

                    {{-- Total cycle line --}}
                    <div style="margin-top: 0.5rem; font-size: 0.85rem; color: #6b7280;">
                      Total cycle (inclus + top-up) : {{ $hoursPerCycle }}
                    </div>
                  </div>

                  {{-- Infos --}}
                  <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid #f3f4f6;">
                    @if($nextBillingDate)
                      📄 Abonnement de {{ $hoursPerCycle / 2 }} Rituels,<br>renouvelé automatiquement le <strong>{{ $nextBillingDate->translatedFormat('d F') }}</strong>.
                    @endif
                  </div>

                  {{-- Quick actions --}}
                  <div class="subscription-quick-actions">
                    <a href="{{ route('client.subscriptions.show', $subscription->id) }}" class="qa-btn">
                      <span class="qa-icon">📅</span>
                      <span>Programmer des Rituels</span>
                    </a>
                    <button type="button" class="qa-btn" onclick="window.openChangePlanFlow({subscriptionId: {{ $subscription->id }}, tutorName: '{{ addslashes($freelancerName) }}', avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/'.$freelancer->image) : '' }}', currentHours: {{ $subscription->hours_per_week }}, currentPrice: {{ $subscription->price_base ?? 0 }}, unitPrice: {{ $subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0 }}, nextBillingDate: '{{ $nextBillingDate ? $nextBillingDate->format('Y-m-d H:i:s') : '' }}', contextUrl: '{{ route('user.account.subscriptions.change-plan-context', $subscription->id) }}', submitUrl: '{{ route('user.account.subscriptions.change-plan', $subscription->id) }}', csrf: '{{ csrf_token() }}'})">
                      <span class="qa-icon">🔄</span>
                      <span>Changer de formule</span>
                    </button>
                  </div>

                </div>

              </div>
            @endforeach
          </div>

          <button class="carousel-nav carousel-nav-next" onclick="scrollCarousel(1)">
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      @else
        <div class="empty-state">
          <div class="empty-state-icon"><i class="far fa-calendar-check"></i></div>
          <h3 class="empty-state-title">Vous n'avez pas encore d'abonnement actif</h3>
          <p class="empty-state-text">Découvrez nos offres pour démarrer un Rituel avec un freelance Junspro.</p>
          <a href="{{ route('explore') }}" class="btn-hero-primary">Découvrir les offres</a>
        </div>
      @endif
      </div>

    <!-- 6) Section "Récompenses" (style Preply) -->
    <div class="rewards-section">
      <div class="section-header">
        <h2 class="section-title">Récompenses</h2>
        <a href="#" class="section-link" onclick="showToast('Bientôt disponible'); return false;">Voir plus</a>
      </div>

      @php
        // Badges de progression Junspro
        $rewards = [
          ['id' => 1, 'icon' => 'fas fa-star', 'title' => 'Premier Rituel', 'unlocked' => $subscriptions->count() > 0, 'color' => '#fbbf24'],
          ['id' => 2, 'icon' => 'fas fa-user-check', 'title' => 'Profil complété', 'unlocked' => true, 'color' => '#3b82f6'],
          ['id' => 3, 'icon' => 'fas fa-paper-plane', 'title' => 'Brief envoyé', 'unlocked' => false, 'color' => '#8b5cf6'],
          ['id' => 4, 'icon' => 'fas fa-calendar-check', 'title' => 'Régularité', 'unlocked' => false, 'color' => '#10b981'],
          ['id' => 5, 'icon' => 'fas fa-trophy', 'title' => 'Rituel terminé', 'unlocked' => false, 'color' => '#f59e0b'],
          ['id' => 6, 'icon' => 'fas fa-fire', 'title' => 'Série de 5', 'unlocked' => false, 'color' => '#ef4444'],
        ];
        $unlockedCount = collect($rewards)->where('unlocked', true)->count();
      @endphp

      <div class="rewards-header">
        <span class="rewards-count">{{ $unlockedCount }}/{{ count($rewards) }}</span>
      </div>

      <div class="rewards-grid">
        @foreach($rewards as $reward)
          <div class="reward-card {{ $reward['unlocked'] ? 'reward-unlocked' : 'reward-locked' }}">
            @if($reward['unlocked'])
              <span class="reward-badge-new">Nouveau</span>
            @endif
            <div class="reward-icon" style="background: {{ $reward['color'] }}20; color: {{ $reward['color'] }};">
              <i class="{{ $reward['icon'] }}"></i>
            </div>
            <div class="reward-title">{{ $reward['title'] }}</div>
            @if(!$reward['unlocked'])
              <div class="reward-lock">
                <i class="fas fa-lock"></i>
              </div>
            @endif
          </div>
        @endforeach
      </div>

      @if($unlockedCount == 0)
        <div class="rewards-empty">
          <p>Débloquez vos récompenses en complétant votre profil et réservant vos premiers rituels.</p>
        </div>
      @endif
    </div>
  </div>

  @include('components.client-upcoming-actions-menu-scripts')
  <script>
    // Fonction globale pour afficher un toast
    function showToast(message) {
      const existingToast = document.querySelector('.client-upcoming-actions-toast');
      if (existingToast) {
        existingToast.remove();
      }

      const toast = document.createElement('div');
      toast.className = 'client-upcoming-actions-toast';
      toast.textContent = message;
      document.body.appendChild(toast);

      setTimeout(() => {
        toast.classList.add('show');
      }, 10);

      setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
          if (toast.parentNode) {
            toast.parentNode.removeChild(toast);
          }
        }, 300);
      }, 3000);
    }

    // Gestion des onglets "Continuez à avancer"
    document.addEventListener('DOMContentLoaded', function() {
      const tabButtons = document.querySelectorAll('.tab-button');
      const tabContents = document.querySelectorAll('.tab-content');

      tabButtons.forEach(button => {
        button.addEventListener('click', function() {
          const targetTab = this.getAttribute('data-tab');

          // Désactiver tous les onglets
          tabButtons.forEach(btn => btn.classList.remove('active'));
          tabContents.forEach(content => content.classList.remove('active'));

          // Activer l'onglet cliqué
          this.classList.add('active');
          document.getElementById('tab-' + targetTab).classList.add('active');
        });
      });

      // Carousel Abonnements
      window.scrollCarousel = function(direction) {
        const carousel = document.getElementById('subscriptionsCarousel');
        if (carousel) {
          const scrollAmount = 450;
          carousel.scrollLeft += direction * scrollAmount;
        }
      };

      // Menu Dropdown Abonnements - nouvelle structure
      window.toggleSubscriptionMenu = function(subscriptionId) {
        const menuDropdown = document.getElementById('menu-' + subscriptionId);
        if (menuDropdown) {
          menuDropdown.classList.toggle('active');
          
          // Fermer les autres menus
          document.querySelectorAll('.subscription-menu-dropdown.active').forEach(menu => {
            if (menu.id !== 'menu-' + subscriptionId) {
              menu.classList.remove('active');
            }
          });
        }
      };

      // Toggle menu ancienne API (backward compatibility)
      window.toggleMenu = function(btn) {
        if (btn && btn.closest) {
          const wrapper = btn.closest('.subscription-menu-wrapper');
          if (wrapper) {
            const dropdown = wrapper.querySelector('.subscription-menu-dropdown');
            if (dropdown) {
              dropdown.classList.toggle('active');
              document.querySelectorAll('.subscription-menu-dropdown.active').forEach(menu => {
                if (menu !== dropdown) {
                  menu.classList.remove('active');
                }
              });
            }
          }
        }
      };

      // Fermer les menus en cliquant ailleurs
      document.addEventListener('click', function(event) {
        if (!event.target.closest('.subscription-menu-wrapper') && !event.target.closest('.subscription-menu-btn')) {
          document.querySelectorAll('.subscription-menu-dropdown.active').forEach(menu => {
            menu.classList.remove('active');
          });
        }
      });

      // Pause abonnement (backward compatibility)
      window.pauseSubscription = function(id) {
        if (confirm('Êtes-vous sûr de vouloir mettre cet abonnement en pause ?')) {
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = '/user/account/subscriptions/' + id + '/pause';
          form.innerHTML = '<input type="hidden" name="_token" value="' + document.querySelector('meta[name="csrf-token"]').content + '">';
          document.body.appendChild(form);
          form.submit();
        }
      };
    });
  </script>

  <!-- ══════════════════════════════════════════════════════════════
       ALPINE.JS MODALES - Logique complète de subscription 
       ══════════════════════════════════════════════════════════ -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="{{ asset('assets/js/subscriptions/topupModal.js') }}?v={{ filemtime(public_path('assets/js/subscriptions/topupModal.js')) }}"></script>
  <script src="{{ asset('assets/js/subscriptions/changePlanFlow.js') }}?v={{ filemtime(public_path('assets/js/subscriptions/changePlanFlow.js')) }}"></script>
  
  <!-- Composants modales Alpine.js -->
  <x-subscription.topup-modal />
  <x-subscription.change-plan-root />

  <!-- CSS pour les modales (inclus dans les fichiers mais chargement explicite) -->
  <link rel="stylesheet" href="{{ asset('assets/css/components/topup-modal.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/change-plan-modal.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/transfer-modal.css') }}">

  <!-- Composants modales pour transfert de solde -->
  <x-subscription.transfer.entry />
  <x-subscription.transfer.replace.step1-select-freelance />
  <x-subscription.transfer.replace.step2-pick-plan />
  <x-subscription.transfer.replace.step3-confirm />
  <x-subscription.transfer.replace.step4-payment />
  <x-subscription.transfer.add.step2-select-freelance />
  <x-subscription.transfer.add.step3-pick-qty />
  <x-subscription.transfer.add.step4-pick-plan />
  <x-subscription.transfer.add.step5-confirm />
  <x-subscription.transfer.add.step6-payment />
  <x-subscription.transfer.active.step2-select-freelance />
  <x-subscription.transfer.active.step3-pick-qty />
  <x-subscription.transfer.active.step4-confirm />
  <x-subscription.transfer.active.step5-success />

  <!-- Fonction pour ouvrir la modal de transfert -->
  <script>
    function openTransferEntryModal(payload) {
      window.dispatchEvent(new CustomEvent('openTransferEntryModal', {
        detail: payload
      }));
    }
  </script>

  {{-- ── Rituel Alarm : countdown premium + notification 15 min avant ── --}}
  <script>
  (function () {
    const startAtRaw = window.nextRitualStartAt;
    const freelancer = window.nextRitualFreelancer || 'votre freelance';

    const elDays     = document.getElementById('cd-days');
    const elHours    = document.getElementById('cd-hours');
    const elMins     = document.getElementById('cd-mins');
    const elSecs     = document.getElementById('cd-secs');
    const elFill     = document.getElementById('ritual-progress-fill');
    const elProgLbl  = document.getElementById('ritual-progress-label');
    const elStatus   = document.getElementById('ritual-status-label');
    const elWidget   = document.getElementById('ritual-countdown-widget');
    const elCdBlocks = document.getElementById('ritual-cd-blocks');
    const elNotifBtn = document.getElementById('ritual-notif-btn');
    const elNotifLbl = document.getElementById('ritual-notif-label');
    const blockD     = document.getElementById('cd-block-d');
    const blockH     = document.getElementById('cd-block-h');
    const blockM     = document.getElementById('cd-block-m');
    const blockS     = document.getElementById('cd-block-s');

    if (!startAtRaw || !elWidget) return;

    const startMs   = new Date(startAtRaw).getTime();
    /* Durée totale de référence (24h max pour la barre) */
    const totalRef  = Math.min(startMs - Date.now(), 7 * 24 * 3600 * 1000);
    const refBase   = Date.now();

    /* ── Formater avec zéro ── */
    const z = (n) => String(n).padStart(2, '0');

    /* ── Masquer le bloc "jours" si < 1 jour ── */
    function hideDaysIfNeeded(days) {
      if (blockD) blockD.style.display = days > 0 ? '' : 'none';
      /* masquer aussi le séparateur juste après blockD */
      const seps = elCdBlocks ? elCdBlocks.querySelectorAll('.ritual-cd-sep') : [];
      if (seps[0]) seps[0].style.display = days > 0 ? '' : 'none';
    }

    /* ── Update chaque seconde ── */
    function tick() {
      const now  = Date.now();
      const diff = startMs - now;

      if (diff <= 0) {
        /* EN COURS */
        if (elCdBlocks) elCdBlocks.style.display = 'none';
        const live = document.createElement('div');
        live.className = 'ritual-live-badge';
        live.innerHTML = '<i class="fas fa-circle" style="color:#4ade80;font-size:0.6rem;"></i> Rituel en cours maintenant !';
        elWidget.insertBefore(live, elCdBlocks);
        if (elStatus) elStatus.textContent = 'En cours';
        if (elFill)   elFill.style.width = '100%';
        if (elProgLbl) elProgLbl.textContent = '';
        clearInterval(timer);
        return;
      }

      const days  = Math.floor(diff / 86400000);
      const hours = Math.floor((diff % 86400000) / 3600000);
      const mins  = Math.floor((diff % 3600000)  / 60000);
      const secs  = Math.floor((diff % 60000)    / 1000);
      const totalMins = Math.floor(diff / 60000);

      /* Affichage */
      hideDaysIfNeeded(days);
      if (elDays)  elDays.textContent  = z(days);
      if (elHours) elHours.textContent = z(hours);
      if (elMins)  elMins.textContent  = z(mins);
      if (elSecs)  elSecs.textContent  = z(secs);

      /* Barre de progression */
      if (elFill && totalRef > 0) {
        const elapsed = now - refBase;
        const pct = Math.min(100, (elapsed / totalRef) * 100);
        elFill.style.width = pct + '%';
      }
      if (elProgLbl) {
        const hh = z(new Date(startMs).getHours());
        const mm = z(new Date(startMs).getMinutes());
        elProgLbl.textContent = `Démarre à ${hh}:${mm}`;
      }

      /* Couleur urgence */
      const urgent   = totalMins < 60 && totalMins >= 15;
      const critical = totalMins < 15;
      [blockD, blockH, blockM, blockS].forEach(b => {
        if (!b) return;
        b.classList.toggle('urgent',   urgent && !critical);
        b.classList.toggle('critical', critical);
      });
      if (elStatus) {
        elStatus.textContent = critical ? '⚠ Imminent' : urgent ? 'Bientôt' : 'Programmé';
      }
    }

    tick();
    const timer = setInterval(tick, 1000);

    /* ── Notification / Service Worker ── */
    if (!elNotifBtn) return;

    function setGranted() {
      elNotifBtn.classList.add('granted');
      elNotifBtn.classList.add('ringing');
      if (elNotifLbl) elNotifLbl.textContent = 'Rappel activé ✓';
      setTimeout(() => elNotifBtn.classList.remove('ringing'), 2000);
    }

    function scheduleViaSW() {
      if (!('serviceWorker' in navigator)) { fallbackNotif(); return; }
      navigator.serviceWorker
        .register('/sw-ritual.js', { scope: '/' })
        .then(reg => {
          const sw = reg.active || reg.installing || reg.waiting;
          const send = (r) => r.postMessage({ type: 'SCHEDULE_RITUAL_ALARM', startAt: startAtRaw, freelancerName: freelancer });
          if (reg.active) { send(reg.active); }
          else if (reg.installing) { reg.installing.addEventListener('statechange', e => { if (e.target.state === 'activated') send(e.target); }); }
          setGranted();
        })
        .catch(() => fallbackNotif());
    }

    function fallbackNotif() {
      const delay = (startMs - 15 * 60000) - Date.now();
      if (delay > 0) setTimeout(() => new Notification('🔔 Rituel dans 15 min', { body: `Session avec ${freelancer} bientôt !`, icon: '/assets/img/logo.png' }), delay);
      setGranted();
    }

    function requestAndSchedule() {
      if (Notification.permission === 'granted') { scheduleViaSW(); return; }
      Notification.requestPermission().then(p => { if (p === 'granted') scheduleViaSW(); });
    }

    /* État initial du bouton */
    if (Notification.permission === 'granted') {
      scheduleViaSW();
      setGranted();
    } else {
      elNotifBtn.addEventListener('click', function handler() {
        elNotifBtn.removeEventListener('click', handler);
        requestAndSchedule();
      });
    }
  })();
  </script>

@endsection
