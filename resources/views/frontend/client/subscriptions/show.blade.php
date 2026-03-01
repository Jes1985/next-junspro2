@extends('frontend.layout')

@section('style')
  <style>
    * { box-sizing: border-box; }

    /* ═════════════════════════════════════════════════════════════
       FORCER LE FOND DE TOUTE LA PAGE
       ═════════════════════════════════════════════════════════════ */

    html,
    body,
    .main-wrapper,
    .page-content,
    main {
      background: linear-gradient(135deg, #f8f6ff 0%, #f0f4ff 50%, #faf8ff 100%) !important;
      background-attachment: fixed !important;
      min-height: 100vh !important;
    }

    /* ═════════════════════════════════════════════════════════════
       BREADCRUMB ULTRA LUXE GRADIENT
       ═════════════════════════════════════════════════════════════ */

    .breadcrumbs-area,
    .breadcrumb-area,
    .page-heading {
      background: linear-gradient(135deg, #7c3aed 0%, #1e40af 50%, #06388e 100%) !important;
      padding: 4rem 2rem !important;
      position: relative;
      overflow: hidden;
    }

    .breadcrumbs-area::before,
    .breadcrumb-area::before {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 70% 30%, rgba(255,255,255,0.12) 0%, transparent 60%);
      pointer-events: none;
    }

    .breadcrumbs-area h1,
    .breadcrumb-area h1,
    .page-heading h1 {
      color: white !important;
      font-size: 3rem !important;
      font-weight: 900 !important;
      text-shadow: 0 4px 20px rgba(0,0,0,0.2) !important;
      margin: 0 !important;
      letter-spacing: -0.02em !important;
    }

    .breadcrumbs-area .breadcrumb,
    .breadcrumb-area .breadcrumb,
    .page-heading .breadcrumb {
      color: rgba(255,255,255,0.95) !important;
      font-weight: 500;
      gap: 1rem;
    }

    .breadcrumbs-area .breadcrumb a,
    .breadcrumb-area .breadcrumb a {
      color: rgba(255,255,255,0.9) !important;
      text-decoration: none;
    }

    .breadcrumbs-area .breadcrumb a:hover,
    .breadcrumb-area .breadcrumb a:hover {
      color: white !important;
      text-decoration: underline;
    }

    /* ═════════════════════════════════════════════════════════════
       BACKGROUND DÉCORATION
       ═════════════════════════════════════════════════════════════ */

    body::before {
      content: '';
      position: fixed;
      top: -500px;
      right: -300px;
      width: 1200px;
      height: 1200px;
      background: radial-gradient(circle, rgba(124, 58, 237, 0.15) 0%, transparent 60%);
      border-radius: 50%;
      pointer-events: none;
      z-index: 0;
    }

    /* ═════════════════════════════════════════════════════════════
       USER DASHBOARD SECTION
       ═════════════════════════════════════════════════════════════ */

    .user-dashboard {
      background: transparent !important;
      min-height: 100vh;
      position: relative;
      z-index: 1;
    }

    /* ═════════════════════════════════════════════════════════════
       PROFILE DETAILS CONTAINER - ULTRA LUXURY
       ═════════════════════════════════════════════════════════════ */

    .user-profile-details {
      background: white !important;
      border-radius: 40px !important;
      padding: 4rem !important;
      box-shadow: 
        0 40px 120px rgba(124, 58, 237, 0.28),
        0 12px 40px rgba(124, 58, 237, 0.18),
        inset 0 1px 2px rgba(255,255,255,0.6) !important;
      border: 1.5px solid rgba(124, 58, 237, 0.15) !important;
      position: relative;
      z-index: 2;
      animation: slideUp 0.7s cubic-bezier(0.23, 1, 0.32, 1);
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(50px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ═════════════════════════════════════════════════════════════
       TITLES AVEC GRADIENT JUNSPRO
       ═════════════════════════════════════════════════════════════ */

    .title {
      padding-bottom: 2.5rem !important;
      border-bottom: 3px solid;
      border-image: linear-gradient(90deg, #7c3aed, #1e40af) 1;
      margin-bottom: 3.5rem !important;
    }

    .title h4,
    .title h5,
    .title h6 {
      font-size: 2.2rem !important;
      font-weight: 900 !important;
      margin: 0 !important;
      background: linear-gradient(135deg, #7c3aed 0%, #1e40af 100%) !important;
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      background-clip: text !important;
      letter-spacing: -0.025em !important;
    }

    /* ═════════════════════════════════════════════════════════════
       CARDS PREMIUM LUXURY
       ═════════════════════════════════════════════════════════════ */

    .card {
      background: linear-gradient(135deg, #faf8ff 0%, white 100%) !important;
      border: none !important;
      border-radius: 32px !important;
      box-shadow: 
        0 28px 72px rgba(124, 58, 237, 0.2),
        0 6px 20px rgba(0,0,0,0.1) !important;
      transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1) !important;
      overflow: hidden;
      position: relative;
      border-left: 4px solid transparent;
      border-image: linear-gradient(180deg, #7c3aed, #1e40af) 1;
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 4px;
      background: linear-gradient(90deg, #7c3aed, #1e40af, #065f46, #7c3aed);
      background-size: 200% 100%;
      transform: scaleX(0);
      transform-origin: center;
      transition: transform 0.7s cubic-bezier(0.23, 1, 0.32, 1);
      z-index: 10;
    }

    .card:hover {
      box-shadow: 
        0 56px 128px rgba(124, 58, 237, 0.35),
        0 12px 48px rgba(0,0,0,0.15) !important;
      transform: translateY(-16px) !important;
    }

    .card:hover::before {
      transform: scaleX(1);
    }

    .card-body {
      padding: 3.5rem !important;
    }

    .card-body h5 {
      font-size: 1.7rem !important;
      font-weight: 800 !important;
      color: #0f172a !important;
      margin-bottom: 2.5rem !important;
      letter-spacing: -0.01em;
    }

    .card-body ul {
      list-style: none;
      padding: 0;
    }

    .card-body ul li {
      padding: 1.2rem 0 1.2rem 1.5rem !important;
      font-size: 1.1rem !important;
      color: #374151 !important;
      border-left: 4px solid transparent;
      transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
      position: relative;
    }

    .card-body ul li::before {
      content: '▸';
      position: absolute;
      left: 0;
      color: #7c3aed;
      font-weight: bold;
    }

    .card-body ul li:hover {
      border-left-color: #7c3aed;
      color: #7c3aed;
      padding-left: 2rem;
      background: rgba(124, 58, 237, 0.05);
    }

    .card-body strong {
      color: #0f172a !important;
      font-weight: 700;
    }

    /* ═════════════════════════════════════════════════════════════
       BADGES PREMIUM AVEC GRADIENTS
       ═════════════════════════════════════════════════════════════ */

    .badge {
      font-weight: 800 !important;
      letter-spacing: 0.07em !important;
      text-transform: uppercase !important;
      padding: 0.8rem 2rem !important;
      border-radius: 20px !important;
      font-size: 0.8rem !important;
      box-shadow: 0 12px 32px rgba(124, 58, 237, 0.25) !important;
      transition: all 0.35s cubic-bezier(0.23, 1, 0.32, 1) !important;
      border: none !important;
    }

    .badge-junspro {
      background: linear-gradient(135deg, #7c3aed 0%, #1e40af 100%) !important;
      color: white !important;
    }

    .badge-junspro:hover {
      transform: translateY(-6px) scale(1.1) !important;
      box-shadow: 0 20px 48px rgba(124, 58, 237, 0.4) !important;
    }

    .badge-warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
      color: white !important;
    }

    .badge-warning:hover {
      transform: translateY(-6px) scale(1.1) !important;
      box-shadow: 0 20px 48px rgba(245, 158, 11, 0.4) !important;
    }

    .badge-info {
      background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important;
      color: white !important;
    }

    .badge-info:hover {
      transform: translateY(-6px) scale(1.1) !important;
      box-shadow: 0 20px 48px rgba(6, 182, 212, 0.4) !important;
    }

    .badge-secondary {
      background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
      color: white !important;
    }

    /* ═════════════════════════════════════════════════════════════
       TABLE PREMIUM AVEC DÉGRADÉS
       ═════════════════════════════════════════════════════════════ */

    .table-responsive {
      border-radius: 32px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(124, 58, 237, 0.18) !important;
      border: 1.5px solid rgba(124, 58, 237, 0.15);
      margin-top: 2rem;
    }

    .table {
      margin: 0 !important;
      border-collapse: separate;
      border-spacing: 0;
    }

    .table thead {
      background: linear-gradient(135deg, #7c3aed 0%, #1e40af 100%) !important;
    }

    .table thead th {
      color: white !important;
      font-weight: 900 !important;
      font-size: 1.15rem !important;
      letter-spacing: 0.04em;
      padding: 2rem !important;
      border: none !important;
      text-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .table tbody td {
      padding: 1.8rem 2rem !important;
      vertical-align: middle;
      border-bottom: 1px solid rgba(124, 58, 237, 0.12) !important;
      color: #374151 !important;
      font-weight: 500;
      transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .table tbody tr {
      transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .table tbody tr:hover {
      background: linear-gradient(135deg, rgba(124, 58, 237, 0.15) 0%, rgba(30, 64, 175, 0.1) 100%) !important;
      box-shadow: inset 0 0 24px rgba(124, 58, 237, 0.1);
      transform: scale(1.01);
    }

    .table tbody tr:last-child td {
      border-bottom: none !important;
    }

    /* ═════════════════════════════════════════════════════════════
       BUTTONS ULTRA PREMIUM
       ═════════════════════════════════════════════════════════════ */

    .btn {
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      border-radius: 22px !important;
      padding: 1.1rem 2.4rem !important;
      transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1) !important;
      border: none !important;
      position: relative;
      overflow: hidden;
      font-size: 1.05rem !important;
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255,255,255,0.5) 0%, transparent 70%);
      transform: translate(-50%, -50%);
      transition: width 0.7s, height 0.7s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .btn:hover::before {
      width: 500px;
      height: 500px;
    }

    .btn-warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
      color: white !important;
      box-shadow: 0 16px 40px rgba(245, 158, 11, 0.4) !important;
    }

    .btn-warning:hover {
      transform: translateY(-8px) !important;
      box-shadow: 0 28px 64px rgba(245, 158, 11, 0.5) !important;
    }

    .btn-secondary {
      background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
      color: white !important;
      box-shadow: 0 16px 40px rgba(107, 114, 128, 0.4) !important;
    }

    .btn-secondary:hover {
      transform: translateY(-8px) !important;
      box-shadow: 0 28px 64px rgba(107, 114, 128, 0.5) !important;
    }

    .btn-sm {
      padding: 0.8rem 1.6rem !important;
      font-size: 0.95rem !important;
    }

    /* ═════════════════════════════════════════════════════════════
       MODALS ULTRA LUXE
       ═════════════════════════════════════════════════════════════ */

    .modal-content {
      background: linear-gradient(135deg, #faf8ff 0%, white 100%) !important;
      border: none !important;
      border-radius: 40px !important;
      box-shadow: 0 48px 120px rgba(124, 58, 237, 0.35) !important;
    }

    .modal-header {
      background: linear-gradient(135deg, #7c3aed 0%, #1e40af 100%) !important;
      border: none !important;
      border-radius: 40px 40px 0 0 !important;
      padding: 3rem !important;
    }

    .modal-header .modal-title {
      color: white !important;
      font-weight: 900 !important;
      font-size: 1.6rem !important;
      letter-spacing: -0.015em;
    }

    .modal-header .btn-close {
      filter: brightness(0) invert(1) !important;
      opacity: 0.85;
      transition: opacity 0.3s;
    }

    .modal-header .btn-close:hover {
      opacity: 1;
    }

    .modal-body {
      padding: 3.5rem !important;
    }

    .modal-footer {
      border: none !important;
      padding: 3rem !important;
      background: linear-gradient(135deg, rgba(124, 58, 237, 0.08) 0%, rgba(30, 64, 175, 0.05) 100%) !important;
      border-radius: 0 0 40px 40px;
    }

    /* ═════════════════════════════════════════════════════════════
       FORM CONTROLS PREMIUM
       ═════════════════════════════════════════════════════════════ */

    .form-label {
      font-weight: 700 !important;
      color: #0f172a !important;
      font-size: 1.15rem !important;
      margin-bottom: 1.2rem !important;
      letter-spacing: -0.005em;
    }

    .form-control {
      border: 2.5px solid rgba(124, 58, 237, 0.22) !important;
      border-radius: 24px !important;
      padding: 1.4rem 2rem !important;
      font-size: 1.1rem !important;
      font-weight: 500 !important;
      transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1) !important;
      background: linear-gradient(135deg, #faf8ff 0%, white 100%) !important;
      box-shadow: 0 6px 16px rgba(124, 58, 237, 0.1) !important;
    }

    .form-control:focus {
      border-color: #7c3aed !important;
      box-shadow: 
        0 0 0 5px rgba(124, 58, 237, 0.18),
        0 12px 32px rgba(124, 58, 237, 0.2) !important;
      outline: none !important;
      transform: scale(1.01);
    }

    /* ═════════════════════════════════════════════════════════════
       ALERTS PREMIUM
       ═════════════════════════════════════════════════════════════ */

    .alert {
      border-radius: 28px !important;
      border: 2px solid !important;
      padding: 2.5rem !important;
      font-weight: 600 !important;
      font-size: 1.08rem !important;
      transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
      box-shadow: 0 16px 48px rgba(0,0,0,0.12) !important;
    }

    .alert-info {
      background: linear-gradient(135deg, #e0f7ff 0%, #dbeafe 100%) !important;
      color: #164e63 !important;
      border-color: rgba(6, 182, 212, 0.4) !important;
      box-shadow: 0 16px 48px rgba(6, 182, 212, 0.18) !important;
    }

    .alert-warning {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
      color: #78350f !important;
      border-color: rgba(245, 158, 11, 0.4) !important;
      box-shadow: 0 16px 48px rgba(245, 158, 11, 0.18) !important;
    }

    small {
      opacity: 0.95;
      font-weight: 600;
    }

    /* ═════════════════════════════════════════════════════════════
       PAGINATION PREMIUM
       ═════════════════════════════════════════════════════════════ */

    .pagination {
      gap: 1rem;
      margin-top: 3.5rem;
    }

    .pagination .page-link {
      color: #7c3aed !important;
      border: 2.5px solid rgba(124, 58, 237, 0.3) !important;
      border-radius: 16px !important;
      font-weight: 700 !important;
      transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1) !important;
      font-size: 1.05rem !important;
      padding: 0.8rem 1.2rem !important;
    }

    .pagination .page-link:hover {
      background: linear-gradient(135deg, #7c3aed 0%, #1e40af 100%) !important;
      color: white !important;
      border-color: transparent !important;
      transform: translateY(-6px) !important;
      box-shadow: 0 16px 40px rgba(124, 58, 237, 0.4) !important;
    }

    .pagination .page-item.active .page-link {
      background: linear-gradient(135deg, #7c3aed 0%, #1e40af 100%) !important;
      border-color: transparent !important;
      box-shadow: 0 16px 40px rgba(124, 58, 237, 0.4) !important;
    }

    /* ═════════════════════════════════════════════════════════════
       RESPONSIVE
       ═════════════════════════════════════════════════════════════ */

    @media (max-width: 768px) {
      .user-profile-details {
        padding: 2rem !important;
      }

      .breadcrumbs-area h1,
      .breadcrumb-area h1 {
        font-size: 2rem !important;
      }

      .title h4, .title h5 {
        font-size: 1.5rem !important;
      }

      .card-body {
        padding: 2rem !important;
      }

      .table {
        font-size: 0.9rem !important;
      }

      .table thead th,
      .table tbody td {
        padding: 1rem !important;
      }

      .btn {
        padding: 0.85rem 1.6rem !important;
        font-size: 0.95rem !important;
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
    .page-hero-banner::before {
      content: '';
      position: absolute;
      top: -40%; left: -5%;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }
    .page-hero-banner::after {
      content: '';
      position: absolute;
      bottom: -20%; right: -10%;
      width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }
    .page-hero-title {
      font-size: 2.5rem;
      font-weight: 900;
      margin-bottom: 0.5rem;
      color: white;
      line-height: 1.1;
      letter-spacing: -0.03em;
      position: relative;
      z-index: 2;
    }
    .page-hero-subtitle {
      font-size: 1.1rem;
      opacity: 0.9;
      margin-bottom: 0;
      font-weight: 300;
      color: white;
      position: relative;
      z-index: 2;
    }
    .hero-text-content { flex: 1; position: relative; z-index: 2; }
    .hero-search-btn {
      background: white;
      color: #7c3aed;
      border-radius: 50px;
      padding: 0.85rem 1.8rem;
      font-weight: 600;
      font-size: 0.95rem;
      text-decoration: none !important;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      white-space: nowrap;
      position: relative;
      z-index: 2;
      flex-shrink: 0;
      transition: background 0.2s, color 0.2s;
    }
    .hero-search-btn:hover {
      background: #f5f3ff;
      color: #6d28d9;
      text-decoration: none !important;
    }
  </style>
@endsection

@section('content')
  @php $heroFirstName = Auth::guard('web')->user()?->first_name ?? Auth::guard('web')->user()?->username ?? 'vous'; @endphp
  <div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem 0;">
    @include('frontend.client.partials.dashboard-nav')
    <div class="page-hero-banner">
      <div class="hero-text-content">
        <h1 class="page-hero-title">Bonjour {{ $heroFirstName }} !</h1>
        <p class="page-hero-subtitle">Bienvenue dans votre espace</p>
      </div>
      <a href="/services" class="hero-search-btn">
        <i class="fas fa-search"></i> Trouver un freelance
      </a>
    </div>
  </div>

  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="user-profile-details mb-30">
            <div class="title mb-30">
              <h4>{{ __('Rituel avec') }} {{ $subscription->freelancer->user->name ?? 'N/A' }}</h4>
            </div>

            <div class="card mb-30">
              <div class="card-body">
                <h5>{{ __('Détails du Rituel') }}</h5>
                <ul class="list-unstyled">
                  <li><strong>{{ __('Heures par semaine') }}:</strong> {{ $subscription->hours_per_week }}h</li>
                  <li><strong>{{ __('Prix de base (4 semaines') }}:</strong> {{ number_format($subscription->price_base, 2, ',', ' ') }} €</li>
                  <li><strong>{{ __('Heures restantes') }}:</strong> {{ $subscription->hours_remaining }}h</li>
                  <li><strong>{{ __('Statut') }}:</strong> 
                    <span class="badge {{ $subscription->status === 'active' ? 'badge-junspro' : ($subscription->status === 'paused' ? 'badge-warning' : 'badge-secondary') }}">
                      {{ ucfirst($subscription->status) }}
                    </span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="title mb-30">
              <h5>{{ __('Livraisons (Rituels)') }}</h5>
            </div>

            @if($workSessions->count() > 0)
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{ __('Date') }}</th>
                      <th>{{ __('Heures') }}</th>
                      <th>{{ __('Résumé') }}</th>
                      <th>{{ __('Statut') }}</th>
                      <th>{{ __('Rectifications') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($workSessions as $session)
                      <tr>
                        <td>{{ $session->start_at ? $session->start_at->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $session->duration_minutes ? number_format($session->duration_minutes / 60, 1) : 'N/A' }}h</td>
                        <td>{{ Str::limit($session->report_text ?? 'N/A', 50) }}</td>
                        <td>
                          <span class="badge {{ $session->status === 'validated' ? 'badge-junspro' : ($session->status === 'delivered' ? 'badge-info' : ($session->status === 'rectification_requested' ? 'badge-warning' : 'badge-secondary')) }}">
                            {{ ucfirst($session->status) }}
                          </span>
                        </td>
                        <td>
                          {{ $session->rectification_count ?? 0 }}/{{ $subscription->max_rectifications_per_delivery ?? 2 }}
                          @if($session->status === 'delivered' && ($session->rectification_count ?? 0) < ($subscription->max_rectifications_per_delivery ?? 2))
                            <br>
                            <button type="button" class="btn btn-sm btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#rectificationModal{{ $session->id }}">
                              <i class="fas fa-edit me-1"></i>{{ __('Demander rectification') }}
                            </button>
                          @endif
                        </td>
                      </tr>
                      
                      <!-- Modal rectification -->
                      <div class="modal fade" id="rectificationModal{{ $session->id }}" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">{{ __('Demander une rectification') }}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('client.work-session.rectify', $session->id) }}" method="POST">
                              @csrf
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label class="form-label">{{ __('Raison de la rectification') }} *</label>
                                  <textarea name="reason" class="form-control" rows="4" required placeholder="{{ __('Expliquez ce qui doit être modifié...') }}"></textarea>
                                </div>
                                <div class="alert alert-info">
                                  <small>
                                    {{ __('Rectifications restantes') }} : {{ ($subscription->max_rectifications_per_delivery ?? 2) - ($session->rectification_count ?? 0) }}
                                  </small>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                                <button type="submit" class="btn btn-warning">{{ __('Demander la rectification') }}</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <div class="mt-30">
                {{ $workSessions->links() }}
              </div>
            @else
              <div class="alert alert-info">
                {{ __('Aucune livraison pour le moment.') }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection



