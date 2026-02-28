@extends('frontend.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/topup-modal.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/change-plan-modal.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    [x-cloak] { display: none !important; }
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --card-shadow: 0 4px 24px rgba(124,58,237,0.10);
      --card-shadow-hover: 0 12px 40px rgba(124,58,237,0.18);
      --gold: #f59e0b;
    }

    /* Layout principal */
    .settings-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
      padding-top: 3rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      min-height: calc(100vh - 200px);
    }

    /* ── PREMIUM QUICK ACTIONS GRID ──────────────────────────── */
    .jp-quick-actions {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 0.65rem;
      margin-top: 1.25rem;
    }
    .jp-quick-actions.jp-actions-5 {
      grid-template-columns: repeat(3, 1fr);
    }
    .jp-qa-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 0.4rem;
      padding: 0.75rem 0.5rem;
      border-radius: 14px;
      border: 1.5px solid #e5e7eb;
      background: #fafafa;
      cursor: pointer;
      transition: all 0.22s cubic-bezier(0.4,0,0.2,1);
      font-size: 0.72rem;
      font-weight: 600;
      color: #374151;
      letter-spacing: 0.01em;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .jp-qa-btn:before {
      content: '';
      position: absolute;
      inset: 0;
      background: var(--junspro-gradient);
      opacity: 0;
      transition: opacity 0.22s;
    }
    .jp-qa-btn:hover:before { opacity: 0.06; }
    .jp-qa-btn:hover {
      border-color: #7c3aed;
      color: #7c3aed;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124,58,237,0.13);
    }
    .jp-qa-btn:active { transform: translateY(0) scale(0.97); }
    .jp-qa-icon {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.15rem;
      background: linear-gradient(135deg,#ede9fe,#ddd6fe);
      color: #6d28d9;
      transition: all 0.22s;
      position: relative;
      z-index: 1;
    }
    .jp-qa-btn:hover .jp-qa-icon {
      background: linear-gradient(135deg,#7c3aed,#4f46e5);
      color: #fff;
    }
    .jp-qa-label { position: relative; z-index: 1; line-height: 1.2; }
    .jp-qa-btn.jp-qa-danger:hover {
      border-color: #dc2626;
      color: #dc2626;
    }
    .jp-qa-btn.jp-qa-danger:hover .jp-qa-icon {
      background: linear-gradient(135deg,#fca5a5,#ef4444);
      color: #fff;
    }
    .jp-qa-btn.jp-qa-danger .jp-qa-icon {
      background: linear-gradient(135deg,#fee2e2,#fca5a5);
      color: #dc2626;
    }
    /* ── FIN QUICK ACTIONS ───────────────────────────────────── */

    /* ── PREMIUM CARD ────────────────────────────────────────── */
    .jp-premium-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      overflow: hidden;
      margin-bottom: 1.5rem;
      transition: box-shadow 0.3s, transform 0.3s;
      border: 1px solid rgba(124,58,237,0.08);
    }
    .jp-premium-card:hover {
      box-shadow: var(--card-shadow-hover);
      transform: translateY(-2px);
    }
    .jp-card-header-band {
      background: var(--junspro-gradient);
      padding: 1.25rem 1.5rem 1rem;
      position: relative;
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    .jp-card-avatar {
      width: 60px;
      height: 60px;
      border-radius: 14px;
      object-fit: cover;
      border: 2.5px solid rgba(255,255,255,0.7);
      box-shadow: 0 4px 12px rgba(0,0,0,0.18);
      flex-shrink: 0;
      background: #fff;
    }
    .jp-card-avatar-initials {
      width: 60px;
      height: 60px;
      border-radius: 14px;
      background: rgba(255,255,255,0.18);
      border: 2.5px solid rgba(255,255,255,0.5);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 1.5rem;
      flex-shrink: 0;
      backdrop-filter: blur(4px);
    }
    .jp-card-header-info { flex: 1; min-width: 0; }
    .jp-card-name {
      font-size: 1.1rem;
      font-weight: 700;
      color: #fff;
      margin: 0 0 0.15rem;
      text-shadow: 0 1px 4px rgba(0,0,0,0.15);
    }
    .jp-card-subtitle {
      font-size: 0.78rem;
      color: rgba(255,255,255,0.82);
      margin: 0;
    }
    .jp-card-kebab-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: rgba(255,255,255,0.15);
      border: 1.5px solid rgba(255,255,255,0.3);
      color: #fff;
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
    }
    .jp-card-kebab-btn:hover {
      background: rgba(255,255,255,0.28);
      transform: scale(1.08);
    }
    .jp-card-body {
      padding: 1.25rem 1.5rem 1.5rem;
    }
    .jp-card-stats-row {
      display: flex;
      gap: 1rem;
      margin-bottom: 1rem;
    }
    .jp-card-stat {
      flex: 1;
      background: #f8f5ff;
      border-radius: 12px;
      padding: 0.75rem;
      text-align: center;
      border: 1px solid #ede9fe;
    }
    .jp-card-stat-value {
      font-size: 1.35rem;
      font-weight: 800;
      color: #6d28d9;
      line-height: 1;
      margin-bottom: 0.2rem;
    }
    .jp-card-stat-label {
      font-size: 0.65rem;
      color: #9ca3af;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      font-weight: 600;
    }
    .jp-card-renewal-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 0.8rem;
      color: #6b7280;
      margin-bottom: 0;
    }
    .jp-card-renewal-date {
      font-weight: 600;
      color: #374151;
    }
    /* Badge statut inline haut de gamme */
    .jp-status-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      padding: 0.28rem 0.75rem;
      border-radius: 999px;
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.04em;
    }
    .jp-status-pill.active { background: #d1fae5; color: #065f46; }
    .jp-status-pill.paused { background: #fef3c7; color: #92400e; }
    .jp-status-pill.cancelled { background: #fee2e2; color: #991b1b; }
    .jp-status-dot { width:7px; height:7px; border-radius:50%; }
    .jp-status-pill.active .jp-status-dot { background:#10b981; }
    .jp-status-pill.paused .jp-status-dot { background:#f59e0b; }
    .jp-status-pill.cancelled .jp-status-dot { background:#ef4444; }
    /* ── FIN PREMIUM CARD ─────────────────────────────────────── */

    /* ── MENU DROPDOWN PREMIUM ───────────────────────────────── */
    .jp-menu-wrap {
      position: absolute;
      top: 1rem;
      right: 1rem;
      z-index: 100;
    }
    .jp-menu-dropdown {
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      background: #fff;
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
    .jp-menu-dropdown.show { display: block; }
    .jp-menu-dropdown-header {
      padding: 1rem 1.25rem 0.6rem;
      font-size: 0.65rem;
      font-weight: 700;
      color: #9ca3af;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }
    .jp-menu-item {
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
    }
    .jp-menu-item:hover {
      background: #f5f3ff;
      color: #7c3aed;
    }
    .jp-menu-item:hover .jp-mi-icon-wrap { background: #ede9fe; color: #7c3aed; }
    .jp-mi-icon-wrap {
      width: 34px;
      height: 34px;
      border-radius: 10px;
      background: #f3f4f6;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      font-size: 0.95rem;
      transition: background 0.18s, color 0.18s;
      color: #6b7280;
    }
    .jp-mi-text { flex: 1; }
    .jp-mi-label { display: block; font-size: 0.88rem; font-weight: 500; line-height: 1.2; }
    .jp-mi-sublabel { display: block; font-size: 0.68rem; color: #9ca3af; margin-top: 0.1rem; }
    .jp-mi-arrow { font-size: 0.7rem; color: #d1d5db; }
    .jp-menu-sep { height: 1px; background: #f3f4f6; margin: 0.25rem 0; }
    .jp-menu-item.jp-mi-danger { color: #dc2626; }
    .jp-menu-item.jp-mi-danger:hover { background: #fff5f5; }
    .jp-menu-item.jp-mi-danger .jp-mi-icon-wrap { background: #fee2e2; color: #ef4444; }
    .jp-menu-item.jp-mi-danger:hover .jp-mi-icon-wrap { background: #fca5a5; color: #fff; }
    /* ── FIN MENU PREMIUM ─────────────────────────────────────── */

    /* ══ SUBSCRIPTION PREPLY CARD STYLES ══════════════════════════ */
    /* ══ CAROUSEL PREMIUM ════════════════════════════════════ */
    .subscriptions-carousel-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      gap: 1.5rem;
      margin-bottom: 2rem;
    }
    .subscriptions-carousel-container {
      flex: 1;
      overflow: hidden;
      border-radius: 20px;
    }
    .subscriptions-carousel-inner {
      display: flex;
      gap: 1.5rem;
      scroll-behavior: smooth;
      overflow-x: auto;
      overflow-y: hidden;
      scrollbar-width: none;
      -ms-overflow-style: none;
      padding: 0.5rem 0;
    }
    .subscriptions-carousel-inner::-webkit-scrollbar {
      display: none;
    }
    .subscriptions-carousel-item {
      flex: 0 0 calc(50% - 0.75rem);
      min-width: 0;
    }
    .subscriptions-carousel-btn {
      flex-shrink: 0;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: linear-gradient(135deg, #7c3aed, #6d28d9);
      border: none;
      color: #fff;
      font-size: 1.3rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.22s cubic-bezier(0.4,0,0.2,1);
      box-shadow: 0 4px 16px rgba(124,58,237,0.3);
    }
    .subscriptions-carousel-btn:hover:not(:disabled) {
      transform: scale(1.1);
      box-shadow: 0 8px 24px rgba(124,58,237,0.4);
    }
    .subscriptions-carousel-btn:disabled {
      opacity: 0.4;
      cursor: not-allowed;
    }
    .subscriptions-carousel-btn-prev { order: -1; }
    .subscriptions-carousel-btn-next { order: 1; }
    /* Cas 1 seule carte : centered élégant */
    .subscriptions-carousel-wrapper.single-card .subscriptions-carousel-container {
      max-width: 500px;
      margin: 0 auto;
    }
    .subscriptions-carousel-wrapper.single-card .subscriptions-carousel-item {
      flex: 1;
    }
    @media (max-width: 768px) {
      .subscriptions-carousel-inner {
        gap: 1rem;
      }
      .subscriptions-carousel-item {
        flex: 0 0 100%;
      }
      .subscriptions-carousel-btn {
        width: 44px;
        height: 44px;
        font-size: 1.1rem;
      }
      .subscriptions-carousel-wrapper {
        gap: 1rem;
      }
    }
    /* ══ FIN CAROUSEL PREMIUM ════════════════════════════════════ */
    .subscription-preply-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
      transition: box-shadow 0.3s, transform 0.3s;
      border: 1px solid rgba(124,58,237,0.08);
      position: relative;
      display: flex;
      flex-direction: column;
    }
    .subscription-preply-card:hover {
      box-shadow: 0 12px 40px rgba(124,58,237,0.18);
      transform: translateY(-2px);
    }
    .subscription-preply-header {
      background: var(--junspro-gradient, linear-gradient(135deg, #7c3aed 0%, #6d28d9 50%, #5b21b6 100%));
      padding: 1.75rem 1.5rem 1.5rem;
      position: relative;
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    .subscription-preply-avatar {
      width: 79px;
      height: 79px;
      border-radius: 14px;
      object-fit: cover;
      border: 2.5px solid rgba(255,255,255,0.7);
      box-shadow: 0 4px 12px rgba(0,0,0,0.18);
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
      padding-top: 0.25rem;
    }
    .subscription-preply-name {
      font-size: 1.1rem;
      font-weight: 700;
      color: white;
      margin: 0 0 0.15rem;
      text-shadow: 0 1px 4px rgba(0,0,0,0.15);
    }
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
    .subscription-preply-status.active { background: #d1fae5; color: #065f46; }
    .subscription-preply-status.paused { background: #fef3c7; color: #92400e; }
    .subscription-preply-status.cancelled { background: #fee2e2; color: #991b1b; }
    .status-dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; }
    .subscription-preply-status.active .status-dot { background: #10b981; }
    .subscription-preply-status.paused .status-dot { background: #f59e0b; }
    .subscription-preply-status.cancelled .status-dot { background: #ef4444; }
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
      top: calc(100% + 12px);
      right: 0;
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.16), 0 4px 16px rgba(124,58,237,0.10);
      min-width: 260px;
      z-index: 9999;
      display: none;
      overflow: hidden;
      border: 1px solid rgba(124,58,237,0.08);
      animation: subscriptionMenuIn 0.22s cubic-bezier(0.4,0,0.2,1);
      padding: 0.7rem;
    }
    @keyframes subscriptionMenuIn {
      from { opacity: 0; transform: translateY(-8px) scale(0.97); }
      to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    .subscription-menu-dropdown.show { display: block; }
    .subscription-menu-dropdown-title {
      font-size: 0.65rem;
      font-weight: 700;
      color: #9ca3af;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      margin-bottom: 0.7rem;
    }
    .subscription-menu-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.55rem 0;
      color: #374151;
      text-decoration: none;
      font-size: 0.85rem;
      transition: all 0.2s;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
      border-bottom: 1px solid #f3f4f6;
    }
    .subscription-menu-item:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }
    .subscription-menu-item:hover {
      color: #1a202c;
    }
    .subscription-menu-item-icon {
      width: 36px;
      height: 36px;
      border-radius: 9px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
      flex-shrink: 0;
    }
    .subscription-menu-item-text {
      flex: 1;
      padding-top: 0.25rem;
    }
    .subscription-menu-item-title {
      font-weight: 600;
      font-size: 0.8rem;
      margin-bottom: 0;
      color: #111827;
    }
    .subscription-menu-item-desc {
      font-size: 0.85rem;
      color: #9ca3af;
      line-height: 1.4;
      display: none;
    }
    .subscription-preply-body {
      padding: 1.25rem 1.5rem 1.5rem;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .subscription-stats-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.7rem;
      margin-bottom: 0.8rem;
    }
    .subscription-stat {
      background: #f8f5ff;
      border-radius: 12px;
      padding: 0.755rem;
      text-align: center;
      border: 1px solid #ede9fe;
    }
    .subscription-stat-value {
      font-size: 1.35rem;
      font-weight: 800;
      color: #6d28d9;
      line-height: 1;
      margin-bottom: 0.155rem;
    }
    .subscription-stat-label {
      font-size: 0.7rem;
      color: #9ca3af;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      font-weight: 600;
    }
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
      gap: 0.2em;
      text-align: center;
    }
    .gauge-legend-used {
      font-size: 0.8em;
      font-weight: 600;
    }
    .gauge-legend-left {
      font-size: 0.755rem;
      color: #6b7280;
    }
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
      padding: 0.665rem 0.75rem;
      border-radius: 14px;
      border: 1.5px solid #e5e7eb;
      background: #fafafa;
      cursor: pointer;
      transition: all 0.22s cubic-bezier(0.4,0,0.2,1);
      font-size: 0.7rem;
      font-weight: 600;
      color: #374151;
      letter-spacing: 0.01em;
      text-align: center;
      text-decoration: none;
    }
    .qa-btn:hover {
      border-color: #7c3aed;
      color: #7c3aed;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124,58,237,0.13);
      background: #fff;
    }
    .qa-btn:active { transform: translateY(0) scale(0.97); }
    .qa-icon {
      font-size: 1m;
    }
    /* ══ FIN SUBSCRIPTION PREPLY ═════════════════════════════════ */

    /* Container principal en 2 colonnes */
    .settings-wrapper {
      display: grid;
      grid-template-columns: 25% 75%;
      gap: 2rem;
      margin-top: 2rem;
    }

    /* Menu vertical gauche */
    .settings-sidebar {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 1.5rem 0;
      height: fit-content;
      position: sticky;
      top: 2rem;
    }

    .settings-sidebar-title {
      padding: 0 1.5rem 1rem 1.5rem;
      font-size: 0.875rem;
      font-weight: 600;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border-bottom: 1px solid #e5e7eb;
      margin-bottom: 0.5rem;
    }

    .settings-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .settings-menu-item {
      margin: 0;
    }

    .settings-menu-item a {
      display: block;
      padding: 0.875rem 1.5rem;
      color: #374151;
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 500;
      transition: all 0.2s ease;
      border-left: 3px solid transparent;
      position: relative;
    }

    .settings-menu-item a:hover {
      background: #f9fafb;
      color: var(--junspro-purple);
    }

    .settings-menu-item a.active {
      background: #f3f4f6;
      color: var(--junspro-purple);
      font-weight: 600;
      border-left-color: var(--junspro-purple);
    }

    /* Contenu principal droite */
    .settings-content {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 2.5rem;
    }

    /* Header style Preply - Titre aligné à droite */
    .settings-header {
      margin-bottom: 2rem;
      text-align: right;
    }

    .settings-header h1 {
      font-size: 1.75rem;
      font-weight: 700;
      color: #1a202c;
      margin: 0;
    }

    /* Liste de cartes style Preply */
    .subscriptions-list {
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
    }

    .subscription-card-preply {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 1.75rem;
      position: relative;
      transition: all 0.2s ease;
      margin-bottom: 1rem;
    }

    .subscription-card-preply:hover {
      border-color: #d1d5db;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .subscription-card-header {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .subscription-avatar {
      width: 80px;
      height: 80px;
      border-radius: 12px;
      object-fit: cover;
      flex-shrink: 0;
      border: 1px solid #e5e7eb;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .subscription-avatar-initials {
      width: 80px;
      height: 80px;
      border-radius: 12px;
      background: var(--junspro-gradient);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 2rem;
      flex-shrink: 0;
      border: 1px solid #e5e7eb;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .subscription-info {
      flex: 1;
      min-width: 0;
    }

    .subscription-name {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.25rem;
    }

    .subscription-service {
      font-size: 0.9rem;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    .subscription-details-line {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    /* ── Jauge d'utilisation du cycle jp- ─────────────────────────── */
    .jp-usage-gauge-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.6rem;
      margin: 1rem 0 0.5rem;
    }
    .jp-gauge-svg {
      width: 110px;
      height: 110px;
      overflow: visible;
    }
    .jp-gauge-track {
      fill: none;
      stroke: #e5e7eb;
      stroke-width: 8;
      stroke-linecap: round;
    }
    .jp-gauge-fill {
      fill: none;
      stroke-width: 8;
      stroke-linecap: round;
      transition: stroke-dashoffset 0.6s ease, stroke 0.4s ease;
    }
    .jp-gauge-pct {
      font-size: 18px;
      font-weight: 700;
      fill: #111827;
      text-anchor: middle;
      dominant-baseline: middle;
    }
    .jp-gauge-sub {
      font-size: 9px;
      fill: #6b7280;
      text-anchor: middle;
      dominant-baseline: middle;
    }
    .jp-gauge-legend {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.15rem;
    }
    .jp-gauge-legend-used {
      font-size: 0.8rem;
      font-weight: 600;
    }
    .jp-gauge-legend-left {
      font-size: 0.75rem;
      color: #6b7280;
    }
    .jp-gauge-legend-topup {
      font-size: 0.7rem;
      color: #9ca3af;
      font-style: italic;
    }
    /* ── fin jauge ─────────────────────────────────────────────────── */

    /* ── Nudge banner (inline dans la carte) ───────────────────────── */
    .jp-nudge-banner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 0.5rem;
      margin-top: 0.75rem;
      padding: 0.6rem 0.8rem;
      border-radius: 8px;
      cursor: pointer;
      transition: opacity 0.15s;
      border: 1px solid transparent;
      user-select: none;
    }
    .jp-nudge-banner:hover { opacity: 0.85; }
    .jp-nudge-banner.jp-nudge-soft70    { background: #fffbeb; border-color: #fcd34d; }
    .jp-nudge-banner.jp-nudge-strong85,
    .jp-nudge-banner.jp-nudge-repeat    { background: #fff1f2; border-color: #fca5a5; }
    .jp-nudge-banner.jp-nudge-afterTopup { background: #eff6ff; border-color: #93c5fd; }
    .jp-nudge-content { display: flex; align-items: flex-start; gap: 0.4rem; flex: 1; min-width: 0; }
    .jp-nudge-icon { font-size: 1rem; flex-shrink: 0; line-height: 1.4; }
    .jp-nudge-text { font-size: 0.75rem; color: #374151; line-height: 1.4; }
    .jp-nudge-cta  { font-size: 0.7rem; font-weight: 600; color: #4f46e5; white-space: nowrap; flex-shrink: 0; }

    /* ── Bottom-sheet nudge upgrade ────────────────────────────────── */
    .jp-nudge-backdrop {
      position: fixed; inset: 0;
      background: rgba(0,0,0,0.45);
      z-index: 9990;
      display: flex; align-items: flex-end; justify-content: center;
      opacity: 0; pointer-events: none;
      transition: opacity 0.25s;
    }
    .jp-nudge-backdrop.active {
      opacity: 1; pointer-events: all;
    }
    .jp-nudge-sheet {
      width: 100%; max-width: 520px;
      background: #fff;
      border-radius: 20px 20px 0 0;
      padding-bottom: env(safe-area-inset-bottom, 0);
      transform: translateY(100%);
      transition: transform 0.3s cubic-bezier(0.33, 1, 0.68, 1);
    }
    .jp-nudge-backdrop.active .jp-nudge-sheet {
      transform: translateY(0);
    }
    .jp-sheet-handle-bar {
      width: 44px; height: 5px;
      background: #e5e7eb;
      border-radius: 3px;
      margin: 12px auto 0;
    }
    .jp-sheet-inner {
      padding: 0.75rem 1.5rem 2rem;
      position: relative;
      text-align: center;
    }
    .jp-sheet-close-btn {
      position: absolute; top: 0.25rem; right: 1rem;
      background: none; border: none;
      font-size: 1.1rem; color: #9ca3af;
      cursor: pointer; padding: 0.25rem; line-height: 1;
    }
    .jp-sheet-eyebrow {
      font-size: 0.65rem; text-transform: uppercase;
      letter-spacing: 0.08em; color: #6b7280;
      margin: 0.5rem 0 0.2rem;
    }
    .jp-sheet-title {
      font-size: 1.05rem; font-weight: 700; color: #111827;
      margin: 0 0 1rem;
    }
    .jp-sheet-compare {
      display: flex; align-items: center; justify-content: center;
      gap: 0.75rem; margin-bottom: 0.875rem;
    }
    .jp-sheet-plan {
      flex: 1; padding: 0.6rem 0.5rem;
      border-radius: 12px; border: 2px solid #e5e7eb;
      background: #f9fafb;
    }
    .jp-sheet-plan-next { border-color: #4f46e5; background: #eef2ff; }
    .jp-sheet-plan-label { font-size: 0.6rem; text-transform: uppercase; color: #9ca3af; margin: 0 0 0.2rem; }
    .jp-sheet-plan-hours { font-size: 1.6rem; font-weight: 800; color: #111827; margin: 0; line-height: 1.1; }
    .jp-sheet-plan-next .jp-sheet-plan-hours { color: #4f46e5; }
    .jp-sheet-plan-sub { font-size: 0.6rem; color: #6b7280; margin: 0.1rem 0 0; }
    .jp-sheet-arrow { font-size: 1.3rem; color: #9ca3af; flex-shrink: 0; }
    .jp-sheet-reason {
      font-size: 0.78rem; color: #4b5563;
      line-height: 1.5; margin-bottom: 1rem;
      background: #f3f4f6; border-radius: 8px;
      padding: 0.55rem 0.75rem; text-align: left;
    }
    .jp-sheet-upgrade-btn {
      display: block; width: 100%;
      padding: 0.8rem 1rem;
      background: linear-gradient(135deg, #4f46e5, #7c3aed);
      color: #fff; font-weight: 700; font-size: 0.875rem;
      border-radius: 10px; text-decoration: none;
      margin-bottom: 0.5rem;
      transition: opacity 0.15s;
      text-align: center;
    }
    .jp-sheet-upgrade-btn:hover { opacity: 0.9; color: #fff; }
    .jp-sheet-dismiss-btn {
      background: none; border: none;
      font-size: 0.78rem; color: #9ca3af;
      cursor: pointer; padding: 0.25rem;
    }
    /* ── fin bottom-sheet nudge ─────────────────────────────────────── */

    .subscription-status-badge {
      display: block;
      padding: 0.375rem 0.875rem;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
      margin: 0.75rem auto 0 auto;
      text-align: center;
      width: fit-content;
    }

    .subscription-status-badge.active {
      background: #d1fae5;
      color: #065f46;
    }

    .subscription-status-badge.paused {
      background: #fef3c7;
      color: #92400e;
    }

    .subscription-status-badge.cancelled {
      background: #fee2e2;
      color: #991b1b;
    }

    .subscription-action-box {
      margin-top: 1rem;
      padding-top: 1rem;
      border-top: 1px solid #e5e7eb;
      text-align: center;
    }

    .subscription-action-box-button {
      display: inline-block;
      padding: 0.75rem 1.5rem;
      background: white;
      color: #1a202c;
      border: 1px solid #1a202c;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      width: 100%;
      max-width: 300px;
      text-align: center;
    }

    .subscription-action-box-button:hover {
      background: #1a202c;
      color: white;
      text-decoration: none;
    }

    .subscription-action-box-button.primary {
      background: var(--junspro-gradient);
      color: white;
      border: none;
    }

    .subscription-action-box-button.primary:hover {
      background: var(--junspro-gradient);
      opacity: 0.9;
      color: white;
      text-decoration: none;
    }

    .subscription-action-box-button.danger {
      background: white;
      color: #dc2626;
      border-color: #dc2626;
    }

    .subscription-action-box-button.danger:hover {
      background: #fef2f2;
      color: #991b1b;
      border-color: #991b1b;
      text-decoration: none;
    }

    .subscription-action-button {
      margin-top: 1rem;
      padding: 0.75rem 1.5rem;
      background: white;
      color: #1a202c;
      border: 1px solid #1a202c;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
      width: 100%;
      text-align: center;
    }

    .subscription-action-button:hover {
      background: #1a202c;
      color: white;
      text-decoration: none;
    }

    /* Menu kebab "…" style Preply - styles déjà définis plus haut */

    /* Amélioration visibilité du bouton kebab sur fond dégradé violet - Scoped uniquement sur la carte abonnement */
    .subscription-card-preply .jspro-subscription-kebab {
      width: 36px;
      height: 36px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.18);
      border-radius: 50%;
      color: #000000;
      font-size: 1.75rem;
      font-weight: 900;
      line-height: 1;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      letter-spacing: -0.05em;
    }

    .subscription-card-preply .jspro-subscription-kebab:hover {
      background: rgba(255, 255, 255, 0.18);
      border-color: rgba(255, 255, 255, 0.25);
      color: #000000;
      transform: scale(1.05);
    }

    .subscription-card-preply .jspro-subscription-kebab:focus {
      outline: 2px solid rgba(255, 255, 255, 0.55);
      outline-offset: 2px;
      background: rgba(255, 255, 255, 0.18);
    }

    .subscription-card-preply .jspro-subscription-kebab:active {
      transform: scale(0.95);
    }

    /* Section Fonctionnement de l'abonnement */
    .subscription-faq-section {
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .subscription-faq-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 1.5rem;
    }

    .subscription-faq-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .subscription-faq-item {
      border-bottom: 1px solid #e5e7eb;
    }

    .subscription-faq-item:last-child {
      border-bottom: none;
    }

    .subscription-faq-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1.25rem 0;
      cursor: pointer;
      transition: all 0.2s ease;
      user-select: none;
    }

    .subscription-faq-header:hover {
      color: var(--junspro-purple);
    }

    .subscription-faq-question {
      font-size: 0.95rem;
      font-weight: 500;
      color: #374151;
      flex: 1;
    }

    .subscription-faq-chevron {
      color: #9ca3af;
      font-size: 0.875rem;
      transition: transform 0.3s ease;
      flex-shrink: 0;
      margin-left: 1rem;
    }

    .subscription-faq-item.active .subscription-faq-chevron {
      transform: rotate(180deg);
      color: var(--junspro-purple);
    }

    .subscription-faq-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease, padding 0.3s ease;
      padding: 0 0 0 0;
    }

    .subscription-faq-item.active .subscription-faq-content {
      max-height: 500px;
      padding: 0 0 1.25rem 0;
    }

    .subscription-faq-answer {
      font-size: 0.9rem;
      color: #6b7280;
      line-height: 1.7;
      padding-top: 0.5rem;
    }

    .subscription-faq-answer p {
      margin-bottom: 0.75rem;
    }

    .subscription-faq-answer p:last-child {
      margin-bottom: 0;
    }

    .subscription-faq-answer strong {
      color: #374151;
      font-weight: 600;
    }

    .subscription-faq-answer ul {
      margin: 0.75rem 0;
      padding-left: 1.5rem;
    }

    .subscription-faq-answer li {
      margin-bottom: 0.5rem;
    }

    /* Empty state */
    .empty-state {
      text-align: center;
      padding: 4rem 2rem;
      color: #6b7280;
    }

    .empty-state-icon {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      opacity: 0.5;
      color: var(--junspro-purple);
    }

    .empty-state-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
    }

    .empty-state-text {
      font-size: 1rem;
      margin-bottom: 2rem;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Alertes */
    .alert {
      padding: 1rem 1.5rem;
      border-radius: 12px;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .alert-success {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #86efac;
    }

    .alert-error {
      background: #fef2f2;
      color: #991b1b;
      border: 1px solid #fca5a5;
    }

    /* Responsive */
    @media (max-width: 968px) {
      .settings-wrapper {
        grid-template-columns: 1fr;
      }

      .settings-sidebar {
        position: relative;
        top: 0;
      }

      .settings-menu {
        display: flex;
        overflow-x: auto;
        padding: 0 1rem;
        -webkit-overflow-scrolling: touch;
      }

      .settings-menu-item {
        flex-shrink: 0;
      }

      .settings-menu-item a {
        white-space: nowrap;
        border-left: none;
        border-bottom: 3px solid transparent;
        padding: 0.875rem 1rem;
      }

      .settings-menu-item a.active {
        border-left: none;
        border-bottom-color: var(--junspro-purple);
      }

      .settings-header {
        text-align: left;
      }
    }

    @media (max-width: 640px) {
      .settings-container {
        padding: 1rem;
        padding-top: 2rem;
      }

      .settings-content {
        padding: 1.5rem;
      }

      .subscription-card-preply {
        padding: 1rem;
      }
    }
  </style>
@endsection

@section('content')
  <div class="settings-container">
    @include('frontend.client.partials.dashboard-nav')

    <div class="settings-wrapper">
      <!-- Menu vertical gauche -->
      <aside class="settings-sidebar">
        <div class="settings-sidebar-title">{{ __('Compte') }}</div>
        <ul class="settings-menu">
          <li class="settings-menu-item">
            <a href="{{ route('user.settings.index') }}" class="{{ request()->routeIs('user.settings.index') ? 'active' : '' }}">
              {{ __('Compte') }}
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.settings.password') }}" class="{{ request()->routeIs('user.settings.password') ? 'active' : '' }}">
              Modifiez le mot de passe
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.settings.email.edit') }}" class="{{ request()->routeIs('user.settings.email.*') ? 'active' : '' }}">
              Modifiez votre adresse email
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.edit_profile') }}" class="{{ request()->routeIs('user.edit_profile') ? 'active' : '' }}">
              Modifiez votre profil
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.settings.payment_methods.index') }}" class="{{ request()->routeIs('user.settings.payment_methods.*') ? 'active' : '' }}">
              {{ __('Modes de paiement') }}
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.settings.subscription') }}" class="{{ request()->routeIs('user.settings.subscription') ? 'active' : '' }}">
              {{ __('Abonnement Junspro') }}
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.settings.billing_history') }}" class="{{ request()->routeIs('user.settings.billing_history.*') ? 'active' : '' }}">
              {{ __('Historique de paiement') }}
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.settings.auto_confirmation') }}" class="{{ request()->routeIs('user.settings.auto_confirmation*') ? 'active' : '' }}">
              {{ __('Confirmation automatique') }}
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.settings.agenda') }}" class="{{ request()->routeIs('user.settings.agenda*') ? 'active' : '' }}">
              {{ __('Agenda & fuseau horaire') }}
            </a>
          </li>
          <li class="settings-menu-item">
            @php
              try {
                $notificationsUrl = route('user.settings.notifications');
              } catch (\Exception $e) {
                $notificationsUrl = url('/user/settings/notifications');
              }
            @endphp
            <a href="{{ $notificationsUrl }}" class="{{ request()->routeIs('user.settings.notifications*') ? 'active' : '' }}">
              {{ __('Notifications') }}
            </a>
          </li>
          <li class="settings-menu-item">
            @php
              try {
                $connectionsUrl = route('user.settings.connections');
              } catch (\Exception $e) {
                $connectionsUrl = url('/user/settings/connections');
              }
            @endphp
            <a href="{{ $connectionsUrl }}" class="{{ request()->routeIs('user.settings.connections*') ? 'active' : '' }}">
              {{ __('Connexions & autorisations') }}
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.service_orders') }}" class="{{ request()->routeIs('user.service_orders') || request()->routeIs('user.service_order.details') ? 'active' : '' }}">
              Commandes de service
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.service_wishlist') }}" class="{{ request()->routeIs('user.service_wishlist') ? 'active' : '' }}">
              Favoris de service
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.support_tickets') }}" class="{{ request()->routeIs('user.support_tickets') || request()->routeIs('user.support_tickets.create') || request()->routeIs('user.support_ticket.conversation') ? 'active' : '' }}">
              Tickets de support
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.followings') }}" class="{{ request()->routeIs('user.followings') ? 'active' : '' }}">
              Mes favoris
            </a>
          </li>
          <li class="settings-menu-item">
            @php
              try {
                $deleteAccountUrl = route('user.settings.delete_account');
              } catch (\Exception $e) {
                $deleteAccountUrl = url('/user/settings/delete-account');
              }
            @endphp
            <a href="{{ $deleteAccountUrl }}" class="danger-link {{ request()->routeIs('user.settings.delete_account*') ? 'active' : '' }}" style="color: #dc2626;">
              {{ __('Supprimer le compte') }}
            </a>
          </li>
        </ul>
      </aside>

      <!-- Contenu principal droite -->
      <main class="settings-content">
        <!-- En-tête style Preply - Titre aligné à droite -->
        <div class="settings-header">
          <h1>{{ __('Gérez vos abonnements') }}</h1>
        </div>

        @if (session('status') === 'subscription-paused' || (session('success') && session('status') === 'subscription-paused'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Votre abonnement a été mis en pause.')) }}
          </div>
        @endif

        @if (session('status') === 'subscription-resumed' || (session('success') && session('status') === 'subscription-resumed'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Votre abonnement a été repris.')) }}
          </div>
        @endif

        @if (session('status') === 'subscription-cancelled' || (session('success') && session('status') === 'subscription-cancelled'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Votre abonnement a été annulé.')) }}
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-error">
            ⚠️ {{ session('error') }}
          </div>
        @endif

        @if($subscriptions && $subscriptions->count() > 0)
          <div class="subscriptions-carousel-wrapper {{ $subscriptions->count() === 1 ? 'single-card' : '' }}" x-data="subscriptionsCarousel()">
            <button class="subscriptions-carousel-btn subscriptions-carousel-btn-prev" @click="scrollPrev()" :disabled="!canScrollPrev" aria-label="Précédent">
              <span style="display: flex; align-items: center; justify-content: center;">‹</span>
            </button>
            <div class="subscriptions-carousel-container">
              <div class="subscriptions-carousel-inner" @scroll="updateScrollState()" x-ref="carousel">
          @foreach($subscriptions as $subscription)
            <div class="subscriptions-carousel-item">
            @php
              $freelancer = $subscription->freelancer->user ?? null;
                $freelancerName = $freelancer ? ($freelancer->first_name . ' ' . $freelancer->last_name) : 'Freelance';
              $nextBillingDate = $subscription->next_billing_at ? \Carbon\Carbon::parse($subscription->next_billing_at) : null;
                $daysUntilRenewal = $nextBillingDate ? now()->diffInDays($nextBillingDate, false) : null;
                $hoursRemaining = $subscription->calculated_hours_remaining ?? 0;

              // ── Données jauge cycle ──────────────────────────────
              $cycleUsageSvc  = app(\App\Services\Junspro\CycleUsageService::class);
              $universeType   = $cycleUsageSvc->universeType($subscription->universe ?? '');
              $hoursPerCycle  = ($subscription->hours_per_week ?? 0) * 4;
              $palier         = $cycleUsageSvc->snapToPalier($hoursPerCycle, $universeType);
              $cycleMax       = $cycleUsageSvc->cycleMaxTotal($hoursPerCycle, $universeType);
              $topupMax       = $cycleUsageSvc->topupCap($hoursPerCycle, $universeType);
              $usedHours      = max(0, $hoursPerCycle - (float)$hoursRemaining);
              $usageRatio     = $hoursPerCycle > 0 ? min(1, $usedHours / $hoursPerCycle) : 0;
              // Arc SVG : cercle r=44, circonférence = 2π×44 ≈ 276.5
              $svgR           = 44;
              $svgCirc        = round(2 * M_PI * $svgR, 2);
              $svgOffset      = round($svgCirc * (1 - $usageRatio), 2);
              // Couleur selon ratio
              $gaugeColor     = $usageRatio < 0.70 ? '#10B981' : ($usageRatio < 0.85 ? '#F59E0B' : '#EF4444');
              $nudge          = $cycleUsageSvc->shouldShowUpgradeNudge(
                $usageRatio,
                false, // topup utilisé — à brancher plus tard depuis la DB
                0
              );

              // ── Palier suivant (pour bottom-sheet nudge) ─────────
              $paliersArr       = $universeType === \App\Services\Junspro\CycleUsageService::UNIVERSE_B
                                    ? \App\Services\Junspro\CycleUsageService::PALIERS_B
                                    : \App\Services\Junspro\CycleUsageService::PALIERS_A;
              $currentPalierIdx = array_search($palier, $paliersArr);
              $nextPalierCycle  = ($currentPalierIdx !== false && isset($paliersArr[$currentPalierIdx + 1]))
                                    ? $paliersArr[$currentPalierIdx + 1]
                                    : $palier;
              $isAtMaxPalier    = ($nextPalierCycle === $palier);
            @endphp

              @php
                $freelancerProfile = $subscription->freelancer ?? null;
                $serviceName = 'Abonnement';
                if ($freelancerProfile && isset($freelancerProfile->user)) {
                  $bio = $freelancerProfile->user->freelancerProfile->bio ?? null;
                  if ($bio) { $serviceName = \Illuminate\Support\Str::limit($bio, 32); }
                }
                $priceBase = $subscription->price_base ?? 0;
                $formattedPrice = number_format($priceBase, 2, ',', ' ');
                $nameParts = explode(' ', $freelancerName);
                $initials = count($nameParts) >= 2
                  ? strtoupper(substr($nameParts[0],0,1).substr($nameParts[count($nameParts)-1],0,1))
                  : strtoupper(substr($freelancerName,0,2));
                $months = ['janv.','févr.','mars','avr.','mai','juin','juil.','août','sept.','oct.','nov.','déc.'];
                $formattedDate = $nextBillingDate ? ($nextBillingDate->format('d').' '.$months[(int)$nextBillingDate->format('n')-1].' '.$nextBillingDate->format('Y')) : null;
                $daysRounded = $daysUntilRenewal !== null ? round($daysUntilRenewal) : null;
              @endphp

              {{-- ══ CARTE PREMIUM STYLE DASHBOARD ══════════════════════ --}}
              <div class="subscription-preply-card">
                
                {{-- Header band dégradé --}}
                <div class="subscription-preply-header">
                  {{-- Avatar --}}
                  @if($freelancer && $freelancer->image)
                    <img src="{{ asset('assets/img/users/'.$freelancer->image) }}"
                         alt="{{ $freelancerName }}"
                         class="subscription-preply-avatar"
                         onerror="(function(el) { el.style.display='none'; var sibling = el.nextElementSibling; if(sibling) sibling.style.display='flex'; })(this)">
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
                      <div class="subscription-menu-dropdown-title">Actions sur l'abonnement</div>
                      
                      <a href="{{ route('client.subscriptions.show', $subscription->id) }}" class="subscription-menu-item">
                        <div class="subscription-menu-item-icon" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">📅</div>
                        <div class="subscription-menu-item-text">
                          <div class="subscription-menu-item-title">Programmer des Rituels</div>
                          <div class="subscription-menu-item-desc">Réserver un Rituel avec {{ $freelancerName }}</div>
                        </div>
                      </a>
                      
                      <button type="button" class="subscription-menu-item" onclick="window.openTopUpModal({subscriptionId: {{ $subscription->id }}, tutorName: '{{ addslashes($freelancerName) }}', avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/'.$freelancer->image) : '' }}', unitPrice: {{ $subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0 }}, scheduleUntil: '{{ $nextBillingDate ? $nextBillingDate->format('d M Y') : '' }}', postUrl: '{{ route('user.account.subscriptions.topup', $subscription->id) }}', quotaUrl: '{{ route('user.account.subscriptions.topup-quota', $subscription->id) }}', csrf: '{{ csrf_token() }}', ritualSignature: '', upgradeDetails: ''})">
                        <div class="subscription-menu-item-icon" style="background: linear-gradient(135deg, #c7d2fe, #a5b4fc);">➕</div>
                        <div class="subscription-menu-item-text">
                          <div class="subscription-menu-item-title">Ajouter des Rituels</div>
                          <div class="subscription-menu-item-desc">Acheter des heures supplémentaires</div>
                        </div>
                      </button>
                      
                      <button type="button" class="subscription-menu-item" onclick="window.openChangePlanFlow({subscriptionId: {{ $subscription->id }}, tutorName: '{{ addslashes($freelancerName) }}', avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/'.$freelancer->image) : '' }}', currentHours: {{ $subscription->hours_per_week }}, currentPrice: {{ $subscription->price_base ?? 0 }}, unitPrice: {{ $subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0 }}, nextBillingDate: '{{ $nextBillingDate ? $nextBillingDate->format('Y-m-d H:i:s') : '' }}', contextUrl: '{{ route('user.account.subscriptions.change-plan-context', $subscription->id) }}', submitUrl: '{{ route('user.account.subscriptions.change-plan', $subscription->id) }}', csrf: '{{ csrf_token() }}'})">
                        <div class="subscription-menu-item-icon" style="background: linear-gradient(135deg, #93c5fd, #60a5fa);">🔄</div>
                        <div class="subscription-menu-item-text">
                          <div class="subscription-menu-item-title">Changer de formule</div>
                          <div class="subscription-menu-item-desc">Augmenter ou réduire les Rituels</div>
                        </div>
                      </button>
                      
                      <button type="button" class="subscription-menu-item" onclick="window.openTransferEntryModal({subscriptionId: {{ $subscription->id }}, tutorName: '{{ addslashes($freelancerName) }}', avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/'.$freelancer->image) : '' }}', credit: {{ $subscription->hours_remaining ?? 0 }}, creditAmount: {{ ($subscription->hours_remaining ?? 0) * ($subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0) }}})">
                        <div class="subscription-menu-item-icon" style="background: linear-gradient(135deg, #86efac, #4ade80);">↗️</div>
                        <div class="subscription-menu-item-text">
                          <div class="subscription-menu-item-title">Transférer le solde</div>
                          <div class="subscription-menu-item-desc">Vers un autre freelance ou abonnement</div>
                        </div>
                      </button>
                      
                      @if($subscription->status === 'active')
                        <form method="POST" action="{{ route('user.settings.subscription.pause', $subscription->id) }}" style="contents">
                          @csrf
                          <button type="submit" class="subscription-menu-item">
                            <div class="subscription-menu-item-icon" style="background: linear-gradient(135deg, #fbbf24, #f59e0b);">⏸️</div>
                            <div class="subscription-menu-item-text">
                              <div class="subscription-menu-item-title">Mettre en pause</div>
                              <div class="subscription-menu-item-desc">Aucune facturation pendant la pause</div>
                            </div>
                          </button>
                        </form>
                      @elseif($subscription->status === 'paused')
                        <form method="POST" action="{{ route('user.settings.subscription.resume', $subscription->id) }}" style="contents">
                          @csrf
                          <button type="submit" class="subscription-menu-item">
                            <div class="subscription-menu-item-icon" style="background: linear-gradient(135deg, #93c5fd, #60a5fa);">▶️</div>
                            <div class="subscription-menu-item-text">
                              <div class="subscription-menu-item-title">Reprendre</div>
                              <div class="subscription-menu-item-desc">Reprendre la facturation</div>
                            </div>
                          </button>
                        </form>
                      @endif
                      
                      <button type="button" class="subscription-menu-item" onclick="openSubscriptionCancelFlow({subscriptionId: {{ $subscription->id }}, tutorName: '{{ addslashes($freelancerName) }}', avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/'.$freelancer->image) : '' }}'})">
                        <div class="subscription-menu-item-icon" style="background: linear-gradient(135deg, #fecaca, #fca5a5);">✕</div>
                        <div class="subscription-menu-item-text">
                          <div class="subscription-menu-item-title" style="color: #dc2626;">Annuler l'abonnement</div>
                          <div class="subscription-menu-item-desc">Prend effet à la fin du cycle</div>
                        </div>
                      </button>
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

              {{-- ══ FIN CARTE PREMIUM ══════════════════════════════ --}}
            </div>
          @endforeach
              </div>
            </div>
            <button class="subscriptions-carousel-btn subscriptions-carousel-btn-next" @click="scrollNext()" :disabled="!canScrollNext" aria-label="Suivant">
              <span style="display: flex; align-items: center; justify-content: center;">›</span>
            </button>
          </div>
        @else
          <div class="empty-state">
            <div class="empty-state-icon">
              <i class="far fa-calendar-check"></i>
            </div>
            <div class="empty-state-title">{{ __('Aucun abonnement actif') }}</div>
            <div class="empty-state-text">
              {{ __("Vous n'avez pas encore d'abonnement actif. Découvrez nos freelances et trouvez celui qui correspond à vos Rituels.") }}
            </div>
            <a href="{{ route('explore') ?? '#' }}" class="subscription-action-button">
              <i class="fas fa-search"></i> {{ __('Découvrir les freelances') }}
            </a>
          </div>
        @endif

        {{-- ══════════════════════════════════════════════════════════════════
             SECTION : CHANGER OU CHOISIR UNE FORMULE (style Preply unifié)
        ════════════════════════════════════════════════════════════════════ --}}
        @if(!empty($plansA) || !empty($plansB))
        <div style="margin-top:3rem;padding-top:2.5rem;border-top:1px solid #e5e7eb;">
          {{-- En-tête de section --}}
          <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;margin-bottom:1.5rem;">
            <div>
              <h2 style="font-size:1.35rem;font-weight:800;color:#111827;margin:0 0 0.3rem;">
                Choisir ou changer de formule
              </h2>
              <p style="font-size:0.82rem;color:#6b7280;margin:0;">
                1 Rituel = 50 min focus + 10 min rapport &nbsp;·&nbsp; Cycles de 4 semaines &nbsp;·&nbsp; Sans engagement
              </p>
            </div>
            <a href="{{ route('pricing') }}" style="display:inline-flex;align-items:center;gap:0.35rem;font-size:0.8rem;font-weight:600;color:#7c3aed;text-decoration:none;padding:0.45rem 0.9rem;border:2px solid #ede9fe;border-radius:999px;transition:all 0.18s;" onmouseover="this.style.background='#ede9fe'" onmouseout="this.style.background='transparent'">
              <i class="fas fa-external-link-alt" style="font-size:0.7rem;"></i> Voir la page complète
            </a>
          </div>

          {{-- Onglets Univers A / B --}}
          <div style="display:flex;gap:0.5rem;flex-wrap:wrap;margin-bottom:1.5rem;">
            <button id="jp-tab-A" onclick="jpSwitchUnivers('A')"
              style="padding:0.5rem 1.15rem;border-radius:999px;font-size:0.82rem;font-weight:700;border:none;cursor:pointer;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;box-shadow:0 3px 10px rgba(124,58,237,0.3);transition:all 0.2s;">
              🎓 Cours, Bien-être &amp; Corporate
            </button>
            <button id="jp-tab-B" onclick="jpSwitchUnivers('B')"
              style="padding:0.5rem 1.15rem;border-radius:999px;font-size:0.82rem;font-weight:700;border:2px solid #e5e7eb;cursor:pointer;background:#fff;color:#374151;transition:all 0.2s;">
              🏗️ Projets, Services &amp; Échanges
            </button>
          </div>

          {{-- ── Grille plans UNIVERS A ──────────────────────────────────── --}}
          <div id="jp-plans-A">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(175px,1fr));gap:0.9rem;">
              @foreach($plansA as $plan)
                @php
                  $isCurrent = isset($currentPalier) && (int)$currentPalier === (int)$plan['hours_per_cycle'];
                  $firstActive = $subscriptions->where('status','active')->first() ?? $subscriptions->first();
                  $cardBg     = $isCurrent ? 'linear-gradient(135deg,#4f46e5,#7c3aed)' : '#fff';
                  $cardBorder = $isCurrent ? 'transparent' : ($plan['popular'] ? '#7c3aed' : '#e5e7eb');
                  $cardShadow = $isCurrent ? '0 8px 28px rgba(79,70,229,0.35)' : '0 2px 10px rgba(0,0,0,0.06)';
                  $textMain   = $isCurrent ? '#fff' : '#111827';
                  $textSub    = $isCurrent ? 'rgba(255,255,255,0.75)' : '#9ca3af';
                  $textGreen  = $isCurrent ? '#a5f3fc' : '#10b981';
                  $textStrong = $isCurrent ? '#fff' : '#374151';
                @endphp
                <div style="background:{{ $cardBg }};border:2px solid {{ $cardBorder }};border-radius:18px;padding:1.3rem 1rem 1.1rem;text-align:center;position:relative;box-shadow:{{ $cardShadow }};transition:transform 0.18s,box-shadow 0.18s;"
                     onmouseover="if(!{{ $isCurrent ? 'true' : 'false' }}){this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)';}"
                     onmouseout="if(!{{ $isCurrent ? 'true' : 'false' }}){this.style.transform='translateY(0)';this.style.boxShadow='{{ $cardShadow }}';}">
                  @if($plan['popular'] && !$isCurrent)
                    <div style="position:absolute;top:-11px;left:50%;transform:translateX(-50%);background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;font-size:0.58rem;font-weight:800;padding:0.22rem 0.7rem;border-radius:999px;white-space:nowrap;letter-spacing:0.05em;">⭐ LE PLUS POPULAIRE</div>
                  @endif
                  @if($isCurrent)
                    <div style="position:absolute;top:-11px;left:50%;transform:translateX(-50%);background:#10b981;color:#fff;font-size:0.58rem;font-weight:800;padding:0.22rem 0.7rem;border-radius:999px;white-space:nowrap;">✓ FORMULE ACTUELLE</div>
                  @endif
                  <div style="font-size:1.6rem;margin-bottom:0.4rem;">
                    <i class="{{ $plan['icon'] }}" style="color:{{ $isCurrent ? '#fff' : '#7c3aed' }};"></i>
                  </div>
                  <div style="font-size:0.95rem;font-weight:800;color:{{ $textMain }};margin-bottom:0.15rem;">{{ $plan['name'] }}</div>
                  <div style="font-size:0.63rem;color:{{ $textSub }};margin-bottom:0.75rem;line-height:1.4;min-height:2rem;">{{ $plan['description'] }}</div>
                  <div style="font-size:2.1rem;font-weight:900;color:{{ $textMain }};line-height:1;">{{ $plan['hours_per_cycle'] }}</div>
                  <div style="font-size:0.63rem;color:{{ $textSub }};margin-bottom:0.15rem;">Rituels / cycle 4 sem.</div>
                  <div style="font-size:0.72rem;font-weight:700;color:{{ $textGreen }};margin-bottom:0.8rem;">≈ {{ $plan['hours_per_week'] }}h par semaine</div>
                  <div style="font-size:0.62rem;color:{{ $textSub }};margin-bottom:0.7rem;line-height:1.55;">
                    Top-up max&nbsp;<strong style="color:{{ $textStrong }};">+{{ $plan['topup_max'] }}</strong><br>
                    Max cycle &nbsp;&nbsp;<strong style="color:{{ $textStrong }};">{{ $plan['cycle_max_total'] }} Rituels</strong>
                  </div>
                  @if($isCurrent)
                    <div style="font-size:0.75rem;color:rgba(255,255,255,0.9);font-weight:700;padding:0.45rem;background:rgba(255,255,255,0.18);border-radius:10px;">✓ Votre formule</div>
                  @elseif($firstActive && $firstActive->freelancer_id)
                    <form method="POST" action="{{ route('pricing.subscribe') }}" style="margin:0;">
                      @csrf
                      <input type="hidden" name="freelancer_id" value="{{ $firstActive->freelancer_id }}">
                      <input type="hidden" name="weekly_hours" value="{{ $plan['hours_per_week'] }}">
                      <button type="submit"
                        style="width:100%;padding:0.5rem 0.25rem;border:2px solid {{ $plan['popular'] ? '#7c3aed' : '#e5e7eb' }};border-radius:11px;font-size:0.77rem;font-weight:700;cursor:pointer;background:{{ $plan['popular'] ? 'linear-gradient(135deg,#4f46e5,#7c3aed)' : '#fff' }};color:{{ $plan['popular'] ? '#fff' : '#374151' }};transition:all 0.18s;"
                        onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                        Choisir {{ $plan['name'] }}
                      </button>
                    </form>
                  @else
                    <a href="{{ route('explore') }}" style="display:block;width:100%;padding:0.5rem 0.25rem;border:2px solid {{ $plan['popular'] ? '#7c3aed' : '#e5e7eb' }};border-radius:11px;font-size:0.77rem;font-weight:700;cursor:pointer;background:{{ $plan['popular'] ? 'linear-gradient(135deg,#4f46e5,#7c3aed)' : '#fff' }};color:{{ $plan['popular'] ? '#fff' : '#374151' }};text-decoration:none;text-align:center;box-sizing:border-box;">
                      Choisir {{ $plan['name'] }}
                    </a>
                  @endif
                </div>
              @endforeach
            </div>
          </div>

          {{-- ── Grille plans UNIVERS B ──────────────────────────────────── --}}
          <div id="jp-plans-B" style="display:none;">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(175px,1fr));gap:0.9rem;">
              @foreach($plansB as $plan)
                @php
                  $isCurrent = isset($currentPalier) && (int)$currentPalier === (int)$plan['hours_per_cycle'];
                  $firstActive = $subscriptions->where('status','active')->first() ?? $subscriptions->first();
                  $cardBg     = $isCurrent ? 'linear-gradient(135deg,#4f46e5,#7c3aed)' : '#fff';
                  $cardBorder = $isCurrent ? 'transparent' : ($plan['popular'] ? '#7c3aed' : '#e5e7eb');
                  $cardShadow = $isCurrent ? '0 8px 28px rgba(79,70,229,0.35)' : '0 2px 10px rgba(0,0,0,0.06)';
                  $textMain   = $isCurrent ? '#fff' : '#111827';
                  $textSub    = $isCurrent ? 'rgba(255,255,255,0.75)' : '#9ca3af';
                  $textGreen  = $isCurrent ? '#a5f3fc' : '#10b981';
                  $textStrong = $isCurrent ? '#fff' : '#374151';
                @endphp
                <div style="background:{{ $cardBg }};border:2px solid {{ $cardBorder }};border-radius:18px;padding:1.3rem 1rem 1.1rem;text-align:center;position:relative;box-shadow:{{ $cardShadow }};transition:transform 0.18s,box-shadow 0.18s;"
                     onmouseover="if(!{{ $isCurrent ? 'true' : 'false' }}){this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)';}"
                     onmouseout="if(!{{ $isCurrent ? 'true' : 'false' }}){this.style.transform='translateY(0)';this.style.boxShadow='{{ $cardShadow }}';}">
                  @if($plan['popular'] && !$isCurrent)
                    <div style="position:absolute;top:-11px;left:50%;transform:translateX(-50%);background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;font-size:0.58rem;font-weight:800;padding:0.22rem 0.7rem;border-radius:999px;white-space:nowrap;">⭐ LE PLUS POPULAIRE</div>
                  @endif
                  @if($isCurrent)
                    <div style="position:absolute;top:-11px;left:50%;transform:translateX(-50%);background:#10b981;color:#fff;font-size:0.58rem;font-weight:800;padding:0.22rem 0.7rem;border-radius:999px;white-space:nowrap;">✓ FORMULE ACTUELLE</div>
                  @endif
                  <div style="font-size:1.6rem;margin-bottom:0.4rem;">
                    <i class="{{ $plan['icon'] }}" style="color:{{ $isCurrent ? '#fff' : '#7c3aed' }};"></i>
                  </div>
                  <div style="font-size:0.95rem;font-weight:800;color:{{ $textMain }};margin-bottom:0.15rem;">{{ $plan['name'] }}</div>
                  <div style="font-size:0.63rem;color:{{ $textSub }};margin-bottom:0.75rem;line-height:1.4;min-height:2rem;">{{ $plan['description'] }}</div>
                  <div style="font-size:2.1rem;font-weight:900;color:{{ $textMain }};line-height:1;">{{ $plan['hours_per_cycle'] }}</div>
                  <div style="font-size:0.63rem;color:{{ $textSub }};margin-bottom:0.15rem;">Rituels / cycle 4 sem.</div>
                  <div style="font-size:0.72rem;font-weight:700;color:{{ $textGreen }};margin-bottom:0.8rem;">≈ {{ $plan['hours_per_week'] }}h par semaine</div>
                  <div style="font-size:0.62rem;color:{{ $textSub }};margin-bottom:0.7rem;line-height:1.55;">
                    Top-up max&nbsp;<strong style="color:{{ $textStrong }};">+{{ $plan['topup_max'] }}</strong><br>
                    Max cycle &nbsp;&nbsp;<strong style="color:{{ $textStrong }};">{{ $plan['cycle_max_total'] }} Rituels</strong>
                  </div>
                  @if($isCurrent)
                    <div style="font-size:0.75rem;color:rgba(255,255,255,0.9);font-weight:700;padding:0.45rem;background:rgba(255,255,255,0.18);border-radius:10px;">✓ Votre formule</div>
                  @elseif($firstActive && $firstActive->freelancer_id)
                    <form method="POST" action="{{ route('pricing.subscribe') }}" style="margin:0;">
                      @csrf
                      <input type="hidden" name="freelancer_id" value="{{ $firstActive->freelancer_id }}">
                      <input type="hidden" name="weekly_hours" value="{{ $plan['hours_per_week'] }}">
                      <button type="submit"
                        style="width:100%;padding:0.5rem 0.25rem;border:2px solid {{ $plan['popular'] ? '#7c3aed' : '#e5e7eb' }};border-radius:11px;font-size:0.77rem;font-weight:700;cursor:pointer;background:{{ $plan['popular'] ? 'linear-gradient(135deg,#4f46e5,#7c3aed)' : '#fff' }};color:{{ $plan['popular'] ? '#fff' : '#374151' }};transition:all 0.18s;"
                        onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                        Choisir {{ $plan['name'] }}
                      </button>
                    </form>
                  @else
                    <a href="{{ route('explore') }}" style="display:block;width:100%;padding:0.5rem 0.25rem;border:2px solid {{ $plan['popular'] ? '#7c3aed' : '#e5e7eb' }};border-radius:11px;font-size:0.77rem;font-weight:700;cursor:pointer;background:{{ $plan['popular'] ? 'linear-gradient(135deg,#4f46e5,#7c3aed)' : '#fff' }};color:{{ $plan['popular'] ? '#fff' : '#374151' }};text-decoration:none;text-align:center;box-sizing:border-box;">
                      Choisir {{ $plan['name'] }}
                    </a>
                  @endif
                </div>
              @endforeach
            </div>
          </div>

          {{-- Script : switch d'onglet + auto-sélection de l'univers courant --}}
          <script>
          function jpSwitchUnivers(u) {
            var showA = (u === 'A');
            document.getElementById('jp-plans-A').style.display = showA ? 'block' : 'none';
            document.getElementById('jp-plans-B').style.display = showA ? 'none' : 'block';
            var on  = 'linear-gradient(135deg,#4f46e5,#7c3aed)';
            var off = '#fff';
            var tabA = document.getElementById('jp-tab-A');
            var tabB = document.getElementById('jp-tab-B');
            if (showA) {
              tabA.style.background = on;  tabA.style.color = '#fff';    tabA.style.border = 'none'; tabA.style.boxShadow = '0 3px 10px rgba(124,58,237,0.3)';
              tabB.style.background = off; tabB.style.color = '#374151'; tabB.style.border = '2px solid #e5e7eb'; tabB.style.boxShadow = 'none';
            } else {
              tabB.style.background = on;  tabB.style.color = '#fff';    tabB.style.border = 'none'; tabB.style.boxShadow = '0 3px 10px rgba(124,58,237,0.3)';
              tabA.style.background = off; tabA.style.color = '#374151'; tabA.style.border = '2px solid #e5e7eb'; tabA.style.boxShadow = 'none';
            }
          }
          @php
            $univBSlugs = ['projects','at-home','homeswap'];
            $autoUnivTab = (isset($currentUniverse) && in_array($currentUniverse, $univBSlugs)) ? 'B' : 'A';
          @endphp
          document.addEventListener('DOMContentLoaded', function() { jpSwitchUnivers('{{ $autoUnivTab }}'); });
          </script>
        </div>
        @endif
        {{-- ════════════════════════════════ FIN SECTION FORMULES ════════════ --}}

        <!-- Section Fonctionnement de l'abonnement -->
        <div class="subscription-faq-section">
          <h2 class="subscription-faq-title">{{ __('Fonctionnement de l\'abonnement') }}</h2>
          <ul class="subscription-faq-list">
            <!-- Item 1: Rechargement du solde et facturation -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Rechargement du solde et facturation') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Facturation mensuelle') }}</strong></p>
                  <p>{{ __('Votre abonnement est facturé automatiquement toutes les 4 semaines. Le montant correspond à votre formule (Rituels par semaine × tarif × 4 semaines).') }}</p>
                  <p><strong>{{ __('Rituels restants') }}</strong></p>
                  <p>{{ __('Les Rituels non utilisés s\'accumulent dans votre solde. Vous pouvez les utiliser à tout moment, même après le renouvellement de votre abonnement.') }}</p>
                  <p><strong>{{ __('Ajout de Rituels supplémentaires') }}</strong></p>
                  <p>{{ __('Vous pouvez ajouter des Rituels supplémentaires à tout moment depuis la page de gestion de votre abonnement. Ils sont facturés au tarif Rituel de votre freelance.') }}</p>
                </div>
              </div>
            </li>

            <!-- Item 2: Programmation des Rituels -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Programmation des Rituels') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Rituels') }}</strong></p>
                  <p>{{ __('Chaque Rituel dure 50 minutes de travail effectif + 10 minutes de rapport détaillé. Un Rituel complet consomme 1 Rituel de votre abonnement.') }}</p>
                  <p><strong>{{ __('Planification') }}</strong></p>
                  <p>{{ __('Vous pouvez planifier vos Rituels en fonction de la disponibilité de votre freelance. Les Rituels peuvent être programmés à l\'avance selon le calendrier de votre freelance.') }}</p>
                  <p><strong>{{ __('Reprogrammation') }}</strong></p>
                  <p>{{ __('Vous pouvez reprogrammer un Rituel une fois, sous réserve de disponibilité. La reprogrammation doit être effectuée au moins 24h avant le Rituel prévu.') }}</p>
                </div>
              </div>
            </li>

            <!-- Item 3: Annulation et remboursement -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Annulation et remboursement') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Annulation d\'abonnement') }}</strong></p>
                  <p>{{ __('Vous pouvez annuler votre abonnement à tout moment depuis cette page. L\'annulation prend effet à la fin de votre période de facturation en cours.') }}</p>
                  <p><strong>{{ __('Remboursement') }}</strong></p>
                  <p>{{ __('Les Rituels déjà payés et non utilisés peuvent être remboursés selon nos conditions générales. Les Rituels déjà consommés ne sont pas remboursables.') }}</p>
                  <p><strong>{{ __('Rituels restants après annulation') }}</strong></p>
                  <p>{{ __('Vos Rituels restants restent disponibles pendant 30 jours après l\'annulation. Passé ce délai, ils expirent.') }}</p>
                </div>
              </div>
            </li>

            <!-- Item 4: Mettre en pause -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Mettre votre abonnement en pause') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Mise en pause') }}</strong></p>
                  <p>{{ __('Vous pouvez mettre votre abonnement en pause à tout moment. Pendant la pause, aucune nouvelle facturation n\'est effectuée et aucun nouveau Rituel ne peut être planifié.') }}</p>
                  <p><strong>{{ __('Heures pendant la pause') }}</strong></p>
                  <p>{{ __('Vos Rituels restants sont conservés pendant la pause. Vous pouvez les utiliser dès la reprise de votre abonnement.') }}</p>
                  <p><strong>{{ __('Reprendre l\'abonnement') }}</strong></p>
                  <p>{{ __('Vous pouvez reprendre votre abonnement à tout moment. La facturation reprendra au prochain cycle de facturation.') }}</p>
                </div>
              </div>
            </li>

            <!-- Item 5: Modifier la formule -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Diminuer ou augmenter le nombre d\'heures de l\'abonnement') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Changement de formule') }}</strong></p>
                  <p>{{ __('Vous pouvez modifier votre formule (Rituels par semaine) depuis la page de gestion de votre abonnement. Les formules disponibles sont : 1, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20 ou 24 Rituels par semaine.') }}</p>
                  <p><strong>{{ __('Effet du changement') }}</strong></p>
                  <p>{{ __('Le changement de formule prend effet au prochain cycle de facturation. Votre facture sera ajustée en fonction de la nouvelle formule.') }}</p>
                  <p><strong>{{ __('Heures existantes') }}</strong></p>
                  <p>{{ __('Vos Rituels restants actuels sont conservés et s\'ajoutent aux nouveaux Rituels de votre nouvelle formule.') }}</p>
                </div>
              </div>
            </li>

            <!-- Item 6: Transférer -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Transférer votre solde et votre abonnement à un nouveau freelance') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Transfert d\'abonnement') }}</strong></p>
                  <p>{{ __('Vous pouvez transférer votre solde d\'heures et votre abonnement vers un nouveau freelance si cette fonctionnalité est activée pour votre compte.') }}</p>
                  <p><strong>{{ __('Conditions') }}</strong></p>
                  <p>{{ __('Le transfert est possible uniquement si votre abonnement actuel le permet. Les Rituels restants sont transférés au nouveau freelance au tarif de ce dernier.') }}</p>
                  <p><strong>{{ __('Processus') }}</strong></p>
                  <p>{{ __('Contactez notre support pour initier un transfert. Le processus nécessite l\'accord des deux freelances concernés et peut prendre quelques jours.') }}</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </main>
    </div>
  </div>

  <script>
    /* ── Menu premium jpToggleMenu ──────────────────────────────── */
    function jpToggleMenu(subscriptionId) {
      const menu = document.getElementById('jp-menu-' + subscriptionId);
      const isOpen = menu.classList.contains('show');
      // fermer tous
      document.querySelectorAll('.jp-menu-dropdown').forEach(m => m.classList.remove('show'));
      if (!isOpen) { menu.classList.add('show'); }
    }
    
    /* ── Menu subscription Preply ──────────────────────────────── */
    function toggleSubscriptionMenu(subscriptionId) {
      const menu = document.getElementById('menu-' + subscriptionId);
      const isOpen = menu.classList.contains('show');
      // fermer tous
      document.querySelectorAll('.subscription-menu-dropdown').forEach(m => m.classList.remove('show'));
      if (!isOpen) { menu.classList.add('show'); }
    }
    
    // fermer au clic dehors
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.jp-menu-wrap') && !e.target.closest('.subscription-menu-wrapper')) {
        document.querySelectorAll('.jp-menu-dropdown, .subscription-menu-dropdown').forEach(m => m.classList.remove('show'));
      }
    });
    // fermer ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        document.querySelectorAll('.jp-menu-dropdown, .subscription-menu-dropdown').forEach(m => m.classList.remove('show'));
        jpCloseNudgeSheet();
      }
    });

    // Gestion des items FAQ expandables
    function toggleFaqItem(header) {
      const item = header.closest('.subscription-faq-item');
      const isActive = item.classList.contains('active');
      
      // Fermer tous les autres items
      document.querySelectorAll('.subscription-faq-item').forEach(faqItem => {
        faqItem.classList.remove('active');
      });
      
      // Ouvrir/fermer l'item cliqué
      if (!isActive) {
        item.classList.add('active');
      }
    }
  </script>

  {{-- Modal de renouvellement d'abonnement --}}
  @include('components.subscription-renew-modal')

  {{-- Script du modal --}}
  <script src="{{ asset('assets/js/subscription-renew-modal.js') }}"></script>

  {{-- Modal d'ajout d'heures supplémentaires --}}
  <x-subscription.topup-modal />

  {{-- Modal de changement de formule --}}
  <x-subscription.change-plan-root />
  
  {{-- Modal de transfert (nouvelle structure) --}}
  <x-subscription.transfer.entry />
  
  {{-- Flow Remplacer : Étapes 1, 2, 3, 4 --}}
  <x-subscription.transfer.replace.step1-select-freelance />
  <x-subscription.transfer.replace.step2-pick-plan />
  <x-subscription.transfer.replace.step3-confirm />
  <x-subscription.transfer.replace.step4-payment />
  
  {{-- Flow Ajouter : Étapes 2, 3, 4, 5, 6 --}}
  <x-subscription.transfer.add.step2-select-freelance />
  <x-subscription.transfer.add.step3-pick-qty />
  <x-subscription.transfer.add.step4-pick-plan />
  <x-subscription.transfer.add.step5-confirm />
  <x-subscription.transfer.add.step6-payment />
  
  {{-- Flow Transférer vers actif : Étapes 2, 3, 4, 5 --}}
  <x-subscription.transfer.active.step2-select-freelance />
  <x-subscription.transfer.active.step3-pick-qty />
  <x-subscription.transfer.active.step4-confirm />
  <x-subscription.transfer.active.step5-success />
  
  {{-- Flow Annulation : Étapes 1, 2, 3, 4 --}}
  <x-subscription.cancel.step1-prevention />
  <x-subscription.cancel.step2-reason />
  <x-subscription.cancel.step3-confirm />
  <x-subscription.cancel.step4-alternative />

  {{-- ── BOTTOM-SHEET NUDGE UPGRADE ────────────────────────────────── --}}
  <div id="jp-nudge-backdrop" class="jp-nudge-backdrop"
       role="dialog" aria-modal="true" aria-labelledby="jp-sheet-title"
       onclick="jpCloseNudgeSheet()">
    <div id="jp-nudge-sheet" class="jp-nudge-sheet" onclick="event.stopPropagation()">
      <div class="jp-sheet-handle-bar"></div>
      <div class="jp-sheet-inner">
        <button class="jp-sheet-close-btn" onclick="jpCloseNudgeSheet()" aria-label="Fermer">✕</button>
        <p class="jp-sheet-eyebrow">Optimisez votre rythme</p>
        <h3 class="jp-sheet-title" id="jp-sheet-title">Passez au palier supérieur</h3>
        <div class="jp-sheet-compare">
          <div class="jp-sheet-plan jp-sheet-plan-current">
            <p class="jp-sheet-plan-label">Formule actuelle</p>
            <p class="jp-sheet-plan-hours" id="jp-sheet-current-hrs">–</p>
            <p class="jp-sheet-plan-sub">Rituels/semaine</p>
          </div>
          <div class="jp-sheet-arrow">→</div>
          <div class="jp-sheet-plan jp-sheet-plan-next">
            <p class="jp-sheet-plan-label">Formule suivante</p>
            <p class="jp-sheet-plan-hours" id="jp-sheet-next-hrs">–</p>
            <p class="jp-sheet-plan-sub">Rituels/semaine</p>
          </div>
        </div>
        <p class="jp-sheet-reason" id="jp-sheet-reason"></p>
        <a id="jp-sheet-upgrade-btn" href="/pricing" class="jp-sheet-upgrade-btn">
          Voir la formule suivante
        </a>
        <button class="jp-sheet-dismiss-btn" onclick="jpCloseNudgeSheet()">Plus tard</button>
      </div>
    </div>
  </div>
  {{-- ── FIN BOTTOM-SHEET ───────────────────────────────────────────── --}}

  {{-- Script Alpine.js pour les modals - déjà chargé dans head --}}
  <script src="{{ asset('assets/js/subscriptions/topupModal.js') }}?v={{ filemtime(public_path('assets/js/subscriptions/topupModal.js')) }}"></script>
  <script src="{{ asset('assets/js/subscriptions/changePlanFlow.js') }}?v={{ filemtime(public_path('assets/js/subscriptions/changePlanFlow.js')) }}"></script>
  
  <script>
    // Gestionnaire global pour les promises non capturées
    window.addEventListener('unhandledrejection', function(event) {
      console.error('Promise non capturée:', event.reason);
      // Empêcher l'erreur de s'afficher dans la console
      event.preventDefault();
    });
    // Fonction pour ouvrir la modal de transfert (nouvelle structure)
    function openTransferEntryModal(payload) {
      try {
        // Déclencher l'événement pour ouvrir la modal
        window.dispatchEvent(new CustomEvent('openTransferEntryModal', {
          detail: payload
        }));
      } catch (error) {
        console.error('Erreur lors de l\'ouverture de la modal de transfert:', error);
      }
    }
 
    // ── Nudge bottom-sheet ──────────────────────────────────────────
    function jpOpenNudgeSheet(subId, currentWeekly, universeType, nextPalierCycle, nudgeLevel, nudgeMsg) {
      var nextWeekly = Math.round(nextPalierCycle / 4);
      var atMax      = (nextWeekly === currentWeekly);
      document.getElementById('jp-sheet-current-hrs').textContent = currentWeekly;
      document.getElementById('jp-sheet-next-hrs').textContent    = atMax ? currentWeekly : nextWeekly;
      document.getElementById('jp-sheet-reason').textContent      = nudgeMsg || '';
      var btn = document.getElementById('jp-sheet-upgrade-btn');
      if (atMax) {
        btn.textContent           = 'Vous êtes à la formule maximum';
        btn.style.pointerEvents   = 'none';
        btn.style.background      = '#9ca3af';
        btn.removeAttribute('href');
      } else {
        btn.textContent           = 'Voir la formule ' + nextWeekly + ' Rituels/semaine';
        btn.style.pointerEvents   = '';
        btn.style.background      = '';
        btn.href = '/pricing?suggest=' + nextWeekly + '&from_subscription=' + subId;
      }
      document.getElementById('jp-nudge-backdrop').classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    function jpCloseNudgeSheet() {
      document.getElementById('jp-nudge-backdrop').classList.remove('active');
      document.body.style.overflow = '';
    }
    // Fermeture au clavier (Echap)
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') jpCloseNudgeSheet();
    });
    // ── fin nudge bottom-sheet ──────────────────────────────────────

    // ── Carousel Premium ────────────────────────────────────────────
    function subscriptionsCarousel() {
      return {
        canScrollPrev: false,
        canScrollNext: true,
        scrollPrev() {
          const carousel = this.$refs.carousel;
          const itemWidth = carousel.querySelector('.subscriptions-carousel-item').offsetWidth;
          const gap = 24; // 1.5rem = 24px
          carousel.scrollBy({
            left: -(itemWidth * 2 + gap),
            behavior: 'smooth'
          });
        },
        scrollNext() {
          const carousel = this.$refs.carousel;
          const itemWidth = carousel.querySelector('.subscriptions-carousel-item').offsetWidth;
          const gap = 24; // 1.5rem = 24px
          carousel.scrollBy({
            left: itemWidth * 2 + gap,
            behavior: 'smooth'
          });
        },
        updateScrollState() {
          const carousel = this.$refs.carousel;
          this.canScrollPrev = carousel.scrollLeft > 0;
          const maxScroll = carousel.scrollWidth - carousel.clientWidth;
          this.canScrollNext = carousel.scrollLeft < maxScroll - 10; // 10px tolerance
        }
      };
    }
    // ── fin carousel premium ────────────────────────────────────────

    // Fonction pour ouvrir le flow d'annulation
    function openSubscriptionCancelFlow(payload) {
      try {
        window.dispatchEvent(new CustomEvent('openSubscriptionCancelStep1', {
          detail: {
            subscriptionId: payload.subscriptionId,
            tutorName: payload.tutorName,
            tutorAvatar: payload.avatarUrl
          }
        }));
      } catch (error) {
        console.error('Erreur lors de l\'ouverture du flow d\'annulation:', error);
      }
    }
  </script>
@endsection
