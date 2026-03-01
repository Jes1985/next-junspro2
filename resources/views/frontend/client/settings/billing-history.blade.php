@extends('frontend.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-indigo: #4f46e5;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --junspro-gradient-reverse: linear-gradient(315deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --card-shadow: 0 4px 32px rgba(124,58,237,0.12);
      --card-shadow-hover: 0 20px 60px rgba(124,58,237,0.22);
      --card-shadow-lg: 0 25px 80px rgba(124,58,237,0.18);
      --gold: #f59e0b;
    }

    * {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Layout principal - Ultra Luxe */
    .settings-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 3rem 2rem;
      padding-top: 4rem;
      background: linear-gradient(180deg, #f8f7ff 0%, #f3e8ff 50%, #f0f0ff 100%);
      min-height: calc(100vh - 200px);
      position: relative;
    }

    .settings-container::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(ellipse 1200px 400px at 20% 10%, rgba(124,58,237,0.08) 0%, transparent 50%),
        radial-gradient(ellipse 1000px 600px at 80% 90%, rgba(78,70,229,0.06) 0%, transparent 50%);
      pointer-events: none;
      z-index: -1;
    }

    /* Container principal en 2 colonnes */
    .settings-wrapper {
      display: grid;
      grid-template-columns: 22% 78%;
      gap: 2.5rem;
      margin-top: 2rem;
    }

    /* Menu vertical gauche - Premium Glassmorphism */
    .settings-sidebar {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 28px;
      box-shadow: 0 8px 32px rgba(124,58,237,0.15);
      padding: 2rem 0;
      height: fit-content;
      position: sticky;
      top: 2.5rem;
      border: 1px solid rgba(124,58,237,0.12);
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .settings-sidebar:hover {
      box-shadow: var(--card-shadow-lg);
      border-color: rgba(124,58,237,0.2);
    }

    .settings-sidebar-title {
      padding: 0 2rem 1.25rem 2rem;
      font-size: 0.8rem;
      font-weight: 800;
      background: var(--junspro-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      border-bottom: 1.5px solid rgba(124,58,237,0.08);
      margin-bottom: 0.75rem;
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
      padding: 0.95rem 2rem;
      color: #4b5563;
      text-decoration: none;
      font-size: 0.93rem;
      font-weight: 600;
      transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      border-left: 4px solid transparent;
      position: relative;
      overflow: hidden;
      letter-spacing: 0.01em;
    }

    .settings-menu-item a::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      width: 4px;
      height: 0%;
      background: var(--junspro-gradient);
      transition: height 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .settings-menu-item a::after {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      right: 0;
      background: var(--junspro-gradient);
      opacity: 0;
      transition: opacity 0.25s;
      z-index: -1;
    }

    .settings-menu-item a:hover {
      color: var(--junspro-purple);
      padding-left: 2.3rem;
      background: rgba(124,58,237,0.06);
    }

    .settings-menu-item a:hover::before {
      height: 100%;
    }

    .settings-menu-item a.active {
      background: linear-gradient(135deg, rgba(124,58,237,0.12) 0%, rgba(78,70,229,0.08) 100%);
      color: var(--junspro-purple);
      font-weight: 800;
      border-left-color: var(--junspro-purple);
    }

    .settings-menu-item a.active::before {
      height: 100%;
    }

    /* Contenu principal droite - Ultra Premium */
    .settings-content {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 32px;
      box-shadow: 0 10px 40px rgba(124,58,237,0.15);
      padding: 3.5rem;
      border: 1px solid rgba(124,58,237,0.1);
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .settings-content:hover {
      box-shadow: var(--card-shadow-lg);
      border-color: rgba(124,58,237,0.15);
    }

    .settings-header {
      margin-bottom: 3rem;
      padding-bottom: 2rem;
      border-bottom: 1.5px solid rgba(124,58,237,0.08);
      position: relative;
    }

    .settings-header::after {
      content: '';
      position: absolute;
      bottom: -1.5px;
      left: 0;
      width: 60px;
      height: 3px;
      background: var(--junspro-gradient);
      border-radius: 2px;
    }

    .settings-header h1 {
      font-size: 2.8rem;
      font-weight: 900;
      background: var(--junspro-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin: 0 0 0.75rem 0;
      letter-spacing: -0.03em;
      line-height: 1.2;
    }

    .settings-header p {
      font-size: 1rem;
      color: #6b7280;
      margin: 0;
      line-height: 1.7;
      font-weight: 500;
    }

    /* Stats Bar Ultra Premium */
    .billing-stats-bar {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      margin-bottom: 3.5rem;
    }

    .billing-stat-card {
      background: linear-gradient(135deg, rgba(124,58,237,0.05) 0%, rgba(78,70,229,0.03) 100%);
      border: 1.5px solid rgba(124,58,237,0.15);
      border-radius: 24px;
      padding: 2rem;
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      position: relative;
      overflow: hidden;
      cursor: default;
    }

    .billing-stat-card::before {
      content: '';
      position: absolute;
      top: -100%;
      right: -100%;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(124,58,237,0.15) 0%, transparent 70%);
      pointer-events: none;
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .billing-stat-card::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.1) 100%);
      pointer-events: none;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .billing-stat-card:hover {
      border-color: rgba(124,58,237,0.3);
      transform: translateY(-6px);
      box-shadow: 0 20px 50px rgba(124,58,237,0.18);
    }

    .billing-stat-card:hover::before {
      top: -50%;
      right: -50%;
    }

    .billing-stat-card:hover::after {
      opacity: 1;
    }

    .billing-stat-label {
      font-size: 0.7rem;
      font-weight: 900;
      text-transform: uppercase;
      color: #9ca3af;
      letter-spacing: 0.12em;
      margin-bottom: 0.75rem;
      position: relative;
      z-index: 1;
    }

    .billing-stat-value {
      font-size: 2.2rem;
      font-weight: 900;
      background: var(--junspro-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin: 0;
      position: relative;
      z-index: 1;
      letter-spacing: -0.02em;
    }

    .billing-stat-icon {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      font-size: 2rem;
      opacity: 0.15;
      z-index: 0;
    }

    /* Tableau ultra luxe */
    .billing-table-wrapper {
      overflow-x: auto;
      margin-bottom: 2.5rem;
      border-radius: 24px;
      border: 1.5px solid rgba(124,58,237,0.1);
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(124,58,237,0.08);
      background: linear-gradient(135deg, rgba(124,58,237,0.02) 0%, rgba(78,70,229,0.01) 100%);
    }

    .billing-table {
      width: 100%;
      border-collapse: collapse;
    }

    .billing-table thead {
      background: linear-gradient(135deg, rgba(124,58,237,0.08) 0%, rgba(78,70,229,0.06) 100%);
    }

    .billing-table th {
      padding: 1.25rem 1.5rem;
      text-align: left;
      font-size: 0.77rem;
      font-weight: 800;
      color: #374151;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      border-bottom: 2px solid rgba(124,58,237,0.12);
      background: linear-gradient(135deg, rgba(124,58,237,0.08) 0%, rgba(78,70,229,0.06) 100%);
    }

    .billing-table th.text-right {
      text-align: right;
    }

    .billing-table td {
      padding: 1.35rem 1.5rem;
      border-bottom: 1px solid rgba(124,58,237,0.06);
      font-size: 0.95rem;
      color: #1a202c;
    }

    .billing-table tbody tr {
      transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      position: relative;
    }

    .billing-table tbody tr::before {
      content: '';
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      background: linear-gradient(135deg, rgba(124,58,237,0.06) 0%, rgba(78,70,229,0.04) 100%);
      opacity: 0;
      transition: opacity 0.25s;
      pointer-events: none;
    }

    .billing-table tbody tr:hover {
      background: rgba(124,58,237,0.04);
    }

    .billing-table tbody tr:hover::before {
      opacity: 1;
    }

    .billing-table td.text-right {
      text-align: right;
    }

    .billing-amount {
      font-weight: 900;
      background: var(--junspro-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-size: 1.1rem;
      letter-spacing: -0.01em;
    }

    /* Badges ultra premium */
    .badge {
      display: inline-flex;
      align-items: center;
      padding: 0.45rem 1rem;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      gap: 0.4rem;
      transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
    }

    .badge::before {
      content: '';
      width: 7px;
      height: 7px;
      border-radius: 50%;
      display: inline-block;
      animation: pulse 2.5s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.6; transform: scale(1.2); }
    }

    .badge-success {
      background: linear-gradient(135deg, rgba(34,197,94,0.1) 0%, rgba(22,101,52,0.05) 100%);
      color: #166534;
      border: 1px solid rgba(34,197,94,0.3);
    }

    .badge-success::before {
      background: #22c55e;
      box-shadow: 0 0 12px #22c55e;
    }

    .badge-warning {
      background: linear-gradient(135deg, rgba(249,115,22,0.1) 0%, rgba(154,52,18,0.05) 100%);
      color: #9a3412;
      border: 1px solid rgba(249,115,22,0.3);
    }

    .badge-warning::before {
      background: #f97316;
      box-shadow: 0 0 12px #f97316;
    }

    .badge-muted {
      background: linear-gradient(135deg, rgba(107,114,128,0.1) 0%, rgba(75,85,99,0.05) 100%);
      color: #4b5563;
      border: 1px solid rgba(107,114,128,0.2);
    }

    .badge-muted::before {
      background: #9ca3af;
      box-shadow: 0 0 12px #9ca3af;
    }

    .badge-danger {
      background: linear-gradient(135deg, rgba(239,68,68,0.1) 0%, rgba(220,38,38,0.05) 100%);
      color: #dc2626;
      border: 1px solid rgba(239,68,68,0.3);
    }

    .badge-danger::before {
      background: #ef4444;
      box-shadow: 0 0 12px #ef4444;
    }

    /* Liens premium ultra */
    .btn-link {
      color: var(--junspro-purple);
      text-decoration: none;
      font-size: 0.85rem;
      font-weight: 800;
      transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.45rem 0.8rem;
      border-radius: 10px;
      position: relative;
      letter-spacing: 0.02em;
    }

    .btn-link::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(124,58,237,0.1) 0%, rgba(78,70,229,0.08) 100%);
      border-radius: 10px;
      opacity: 0;
      transition: all 0.25s;
      z-index: -1;
    }

    .btn-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2.5px;
      bottom: -4px;
      left: 50%;
      background: var(--junspro-gradient);
      transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      transform: translateX(-50%);
      border-radius: 2px;
    }

    .btn-link:hover {
      color: var(--junspro-purple);
      transform: translateY(-2px);
    }

    .btn-link:hover::before {
      opacity: 1;
    }

    .btn-link:hover::after {
      width: 100%;
      bottom: -6px;
    }

    .text-muted {
      color: #9ca3af;
    }

    /* Pagination */
    .pagination-wrapper {
      margin-top: 3rem;
      display: flex;
      justify-content: center;
      gap: 0.5rem;
    }

    /* Empty state ultra luxe */
    .empty-state {
      text-align: center;
      padding: 6rem 2rem 5rem;
      color: #6b7280;
      position: relative;
    }

    .empty-state::before {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      width: 500px;
      height: 300px;
      background: radial-gradient(ellipse, rgba(124,58,237,0.08) 0%, transparent 70%);
      transform: translateX(-50%);
      pointer-events: none;
    }

    .empty-state-icon {
      font-size: 6.5rem;
      margin-bottom: 2rem;
      opacity: 0.8;
      background: var(--junspro-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      filter: drop-shadow(0 8px 24px rgba(124,58,237,0.2));
      animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-12px); }
    }

    .empty-state-title {
      font-size: 2rem;
      font-weight: 900;
      color: #1a202c;
      margin-bottom: 1rem;
      letter-spacing: -0.02em;
      position: relative;
      z-index: 1;
    }

    .empty-state-text {
      font-size: 1.05rem;
      margin-bottom: 2.5rem;
      max-width: 560px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.8;
      color: #6b7280;
      font-weight: 500;
      position: relative;
      z-index: 1;
    }

    .btn-primary {
      padding: 1.05rem 2.5rem;
      background: var(--junspro-gradient);
      color: white;
      border: none;
      border-radius: 16px;
      font-size: 1.05rem;
      font-weight: 800;
      letter-spacing: 0.02em;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      box-shadow: 0 12px 40px rgba(124, 58, 237, 0.4);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.7rem;
      position: relative;
      z-index: 1;
    }

    .btn-primary:hover {
      transform: translateY(-4px);
      box-shadow: 0 18px 50px rgba(124, 58, 237, 0.5);
    }

    .btn-primary:active {
      transform: translateY(-1px);
    }

    /* Section aide ultra premium */
    .settings-subsection {
      margin-top: 4rem;
      padding: 2.5rem;
      border-top: 1.5px solid rgba(124,58,237,0.08);
      background: linear-gradient(135deg, rgba(124,58,237,0.04) 0%, rgba(78,70,229,0.02) 100%);
      border-radius: 24px;
      border: 1px solid rgba(124,58,237,0.08);
      position: relative;
      overflow: hidden;
    }

    .settings-subsection::before {
      content: '';
      position: absolute;
      top: -100%;
      right: -100%;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(124,58,237,0.1) 0%, transparent 70%);
      pointer-events: none;
    }

    .settings-subsection h2 {
      font-size: 1.6rem;
      font-weight: 900;
      background: var(--junspro-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1rem;
      letter-spacing: -0.02em;
      position: relative;
      z-index: 1;
    }

    .settings-subsection p {
      font-size: 1rem;
      color: #6b7280;
      line-height: 1.8;
      margin: 0;
      position: relative;
      z-index: 1;
      font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .settings-wrapper {
        grid-template-columns: 1fr;
      }

      .settings-sidebar {
        position: relative;
        top: 0;
      }

      .settings-content {
        padding: 2.5rem;
      }
    }

    @media (max-width: 768px) {
      .settings-container {
        padding: 1.5rem;
        padding-top: 2rem;
      }

      .settings-content {
        padding: 1.5rem;
        border-radius: 20px;
      }

      .settings-header h1 {
        font-size: 2rem;
      }

      .billing-stats-bar {
        grid-template-columns: 1fr;
      }

      .billing-table th,
      .billing-table td {
        padding: 0.85rem 1rem;
        font-size: 0.9rem;
      }

      .empty-state {
        padding: 4rem 1.5rem 3.5rem;
      }
    }
    /* === Hero banner === */
    .page-hero-banner {
      background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 60%, #a855f7 100%);
      border-radius: 40px;
      padding: 3rem 4rem;
      margin-bottom: 2rem;
      color: white;
      position: relative;
      overflow: hidden;
      box-shadow: 0 32px 80px rgba(124, 58, 237, 0.3), inset 0 1px 1px rgba(255,255,255,0.2);
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 2rem;
    }
    .page-hero-banner::before { content: ''; position: absolute; top: -40%; left: -5%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%; pointer-events: none; }
    .page-hero-banner::after { content: ''; position: absolute; bottom: -20%; right: -10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; pointer-events: none; }
    .page-hero-title { font-size: 2.5rem; font-weight: 900; margin-bottom: 0.5rem; color: white; line-height: 1.1; letter-spacing: -0.03em; position: relative; z-index: 2; }
    .page-hero-subtitle { font-size: 1.1rem; opacity: 0.9; margin-bottom: 0; font-weight: 300; color: white; position: relative; z-index: 2; }
    .hero-text-content { flex: 1; position: relative; z-index: 2; }
    .hero-search-btn { background: white; color: #7c3aed; border-radius: 50px; padding: 0.85rem 1.8rem; font-weight: 600; font-size: 0.95rem; text-decoration: none !important; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; position: relative; z-index: 2; flex-shrink: 0; transition: background 0.2s, color 0.2s; }
    .hero-search-btn:hover { background: #f5f3ff; color: #6d28d9; text-decoration: none !important; }
  </style>
@endsection

@section('content')
  <div class="settings-container">
    @include('frontend.client.partials.dashboard-nav')
    @php $heroFirstName = Auth::guard('web')->user()?->first_name ?? Auth::guard('web')->user()?->username ?? 'vous'; @endphp
    <div class="page-hero-banner">
      <div class="hero-text-content">
        <h1 class="page-hero-title">Bonjour {{ $heroFirstName }} !</h1>
        <p class="page-hero-subtitle">Bienvenue dans votre espace</p>
      </div>
      <a href="/services" class="hero-search-btn"><i class="fas fa-search"></i> Trouver un freelance</a>
    </div>

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
        <!-- En-tête -->
        <div class="settings-header">
          <h1><i class="fas fa-receipt" style="margin-right: 0.5rem; color: var(--junspro-purple);"></i>{{ __('Historique de paiement') }}</h1>
          <p>{{ __('Consultez vos paiements Junspro, les détails de vos abonnements et téléchargez vos factures en toute autonomie.') }}</p>
        </div>

        @if($invoices && $invoices->count() > 0)
          <!-- Stats Bar -->
          <div class="billing-stats-bar">
            <div class="billing-stat-card">
              <div class="billing-stat-label">{{ __('Total paiements') }}</div>
              <h3 class="billing-stat-value">
                {{ number_format($invoices->sum(function($inv) { return $inv->amount; }), 0, ',', ' ') }}€
              </h3>
              <div class="billing-stat-icon"><i class="fas fa-coins"></i></div>
            </div>
            <div class="billing-stat-card">
              <div class="billing-stat-label">{{ __('Nombre de transactions') }}</div>
              <h3 class="billing-stat-value">{{ $invoices->count() }}</h3>
              <div class="billing-stat-icon"><i class="fas fa-exchange-alt"></i></div>
            </div>
            <div class="billing-stat-card">
              <div class="billing-stat-label">{{ __('Période') }}</div>
              <h3 class="billing-stat-value">
                @if($invoices->count() > 0)
                  {{ __('Tous les temps') }}
                @else
                  —
                @endif
              </h3>
              <div class="billing-stat-icon"><i class="fas fa-calendar-alt"></i></div>
            </div>
          </div>

          <!-- Tableau -->
          <div class="billing-table-wrapper">
            <table class="billing-table">
              <thead>
                <tr>
                  <th><i class="fas fa-calendar-alt" style="margin-right: 0.4rem; opacity: 0.6;"></i>{{ __('Date') }}</th>
                  <th><i class="fas fa-user" style="margin-right: 0.4rem; opacity: 0.6;"></i>{{ __('Rituel / freelance') }}</th>
                  <th><i class="fas fa-tags" style="margin-right: 0.4rem; opacity: 0.6;"></i>{{ __('Type') }}</th>
                  <th><i class="fas fa-euro-sign" style="margin-right: 0.4rem; opacity: 0.6;"></i>{{ __('Montant') }}</th>
                  <th><i class="fas fa-credit-card" style="margin-right: 0.4rem; opacity: 0.6;"></i>{{ __('Mode de paiement') }}</th>
                  <th><i class="fas fa-check-circle" style="margin-right: 0.4rem; opacity: 0.6;"></i>{{ __('Statut') }}</th>
                  <th class="text-right"><i class="fas fa-file-pdf" style="margin-right: 0.4rem; opacity: 0.6;"></i>{{ __('Facture') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($invoices as $invoice)
                  <tr>
                    <td>
                      <strong>{{ $invoice->date->format('d/m/Y') }}</strong><br>
                      <small style="color: #9ca3af;">{{ $invoice->date->format('H:i') }}</small>
                    </td>

                    <td>
                      <div style="font-weight: 600;">{{ $invoice->freelancer_name ?? __('—') }}</div>
                      @if($invoice->subscription_id)
                        <small style="color: #9ca3af;"><i class="fas fa-star" style="color: var(--gold); margin-right: 0.3rem;"></i>{{ __('Abonné') }}</small>
                      @endif
                    </td>

                    <td>
                      <span style="background: rgba(124,58,237,0.08); padding: 0.35rem 0.6rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; color: var(--junspro-purple);">
                        {{ $invoice->type_label ?? __('Paiement') }}
                      </span>
                    </td>

                    <td>
                      <strong class="billing-amount">
                        {{ number_format($invoice->amount, 2, ',', ' ') }}
                        {{ $invoice->currency === 'EUR' ? '€' : $invoice->currency }}
                      </strong>
                    </td>

                    <td>
                      <div style="display: flex; align-items: center; gap: 0.4rem;">
                        <i class="fas fa-credit-card" style="color: var(--junspro-purple); opacity: 0.6;"></i>
                        {{ $invoice->payment_method_label ?? __('Carte bancaire') }}
                      </div>
                    </td>

                    <td>
                      @php
                        $status = $invoice->status ?? 'paid';
                      @endphp
                      <span class="badge
                        @if($status === 'paid') badge-success
                        @elseif(in_array($status, ['pending', 'processing'])) badge-warning
                        @elseif(in_array($status, ['refunded', 'canceled'])) badge-muted
                        @else badge-danger @endif
                      ">
                        @switch($status)
                          @case('paid')
                            <i class="fas fa-check"></i>{{ __('Payé') }}
                            @break
                          @case('pending')
                          @case('processing')
                            <i class="fas fa-hourglass-half"></i>{{ __('En cours') }}
                            @break
                          @case('refunded')
                            <i class="fas fa-undo"></i>{{ __('Remboursé') }}
                            @break
                          @case('canceled')
                            <i class="fas fa-times"></i>{{ __('Annulé') }}
                            @break
                          @case('failed')
                            <i class="fas fa-exclamation-circle"></i>{{ __('Échoué') }}
                            @break
                          @default
                            {{ ucfirst($status) }}
                        @endswitch
                      </span>
                    </td>

                    <td class="text-right">
                      @if(!empty($invoice->invoice_url) || !empty($invoice->invoice_path))
                        <a href="{{ route('user.settings.billing_history.invoice', $invoice->id) }}" class="btn-link" target="_blank">
                          <i class="fas fa-download"></i>{{ __('Télécharger') }}
                        </a>
                      @else
                        <span class="text-muted" style="font-size: 0.875rem;"><i class="fas fa-file-pdf" style="opacity: 0.4; margin-right: 0.3rem;"></i>—</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          {{-- Pagination --}}
          @if(method_exists($invoices, 'links'))
            <div class="pagination-wrapper">
              {{ $invoices->links() }}
            </div>
          @endif
        @else
          <!-- Empty State -->
          <div class="empty-state">
            <div class="empty-state-icon">
              <i class="far fa-receipt"></i>
            </div>
            <div class="empty-state-title">{{ __('Aucun paiement enregistré pour le moment') }}</div>
            <div class="empty-state-text">
              {{ __('Dès que vous aurez réservé un Rituel ou souscrit un abonnement Junspro, vos paiements apparaîtront ici avec la possibilité de télécharger vos factures.') }}
            </div>
            <a href="{{ route('explore') ?? '#' }}" class="btn-primary">
              <i class="fas fa-search"></i> {{ __('Trouver un freelance et démarrer') }}
            </a>
          </div>
        @endif

        {{-- Section aide --}}
        <div class="settings-subsection">
          <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
            <div style="width: 4px; height: 24px; background: var(--junspro-gradient); border-radius: 2px;"></div>
            <h2 style="margin: 0;">{{ __('Besoin d\'aide concernant un paiement ?') }}</h2>
          </div>
          <p>
            <i class="fas fa-info-circle" style="color: var(--junspro-purple); margin-right: 0.5rem;"></i>
            {{ __('Si un montant vous semble incorrect ou si vous ne trouvez pas une facture, contactez le support Junspro en indiquant la date et le montant concernés. Nous vous répondrons dans les meilleurs délais.') }}
          </p>
          <div style="margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid rgba(124,58,237,0.12);">
            <a href="{{ route('user.support_tickets') ?? '#' }}" class="btn-link" style="font-size: 0.95rem;">
              <i class="fas fa-headset"></i>{{ __('Contacter le support') }}
            </a>
          </div>
        </div>
      </main>
    </div>
  </div>
@endsection

