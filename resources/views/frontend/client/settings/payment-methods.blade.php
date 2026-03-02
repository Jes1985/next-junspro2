@extends('frontend.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --card-shadow-hover: 0 8px 30px rgba(30, 64, 175, 0.15);
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

    /* Container principal en 2 colonnes */
    .settings-wrapper {
      display: grid;
      grid-template-columns: 25% 75%;
      gap: 2rem;
      margin-top: 2rem;
    }

    /* Contenu principal droite */
    .settings-content {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 2.5rem;
    }

    .settings-header {
      margin-bottom: 2.5rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid #e5e7eb;
    }

    .settings-header h1 {
      font-size: 2rem;
      font-weight: 700;
      color: #1a202c;
      margin: 0 0 0.5rem 0;
    }

    .settings-header p {
      font-size: 0.95rem;
      color: #6b7280;
      margin: 0;
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

    /* Section liste des moyens de paiement */
    .payment-methods-list {
      margin-bottom: 3rem;
    }

    .payment-method-card {
      padding: 1.5rem;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: all 0.2s ease;
      background: white;
    }

    .payment-method-card:hover {
      border-color: var(--junspro-purple);
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.1);
    }

    .payment-method-info {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex: 1;
    }

    .payment-method-icon {
      width: 48px;
      height: 32px;
      border-radius: 6px;
      background: linear-gradient(135deg, #1e40af 0%, #7C3AED 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 0.875rem;
      flex-shrink: 0;
    }

    .payment-method-details {
      flex: 1;
    }

    .payment-method-brand {
      font-size: 1rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.25rem;
    }

    .payment-method-number {
      font-size: 0.875rem;
      color: #6b7280;
      font-family: 'Courier New', monospace;
      letter-spacing: 0.05em;
    }

    .payment-method-expiry {
      font-size: 0.875rem;
      color: #6b7280;
      margin-top: 0.25rem;
    }

    .payment-method-badge {
      display: inline-flex;
      align-items: center;
      padding: 0.25rem 0.75rem;
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #86efac;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
      margin-top: 0.5rem;
    }

    .payment-method-actions {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .btn-delete {
      padding: 0.5rem 1rem;
      background: white;
      border: 1px solid #e5e7eb;
      color: #ef4444;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-delete:hover {
      background: #fef2f2;
      border-color: #fca5a5;
    }

    /* Section ajout */
    .add-payment-method-section {
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .add-payment-method-section h2 {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.5rem;
    }

    .add-payment-method-section p {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 1.5rem;
    }

    .card-element-container {
      margin-bottom: 1.5rem;
      padding: 1.25rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      border: 1px solid #e5e7eb;
      border-radius: 12px;
    }

    #card-element {
      padding: 0.75rem;
      background: white;
      border: 1px solid #d1d5db;
      border-radius: 8px;
    }

    .card-element-container .form-label {
      display: block;
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      margin-bottom: 0.5rem;
    }

    .btn-primary-gradient {
      padding: 1rem 2rem;
      background: linear-gradient(135deg, var(--junspro-purple) 0%, var(--junspro-blue) 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
      text-decoration: none;
      display: inline-block;
    }

    .btn-primary-gradient:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .btn-primary-gradient:active {
      transform: translateY(0);
    }

    .empty-state {
      text-align: center;
      padding: 3rem 1rem;
      color: #6b7280;
    }

    .empty-state-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
      opacity: 0.5;
    }

    .empty-state-text {
      font-size: 1rem;
      margin-bottom: 0.5rem;
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

      .payment-method-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }

      .payment-method-actions {
        width: 100%;
        justify-content: flex-end;
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

      .btn-primary-gradient {
        width: 100%;
      }
    }

    /* ===== Premium Card Form ===== */
    .add-payment-section-wrap {
      padding-top: 2.5rem;
      border-top: 1px solid #f1f5f9;
    }
    .add-payment-section-wrap h2 {
      font-size: 1.5rem; font-weight: 800; color: #1a202c; margin: 0 0 .35rem;
    }
    .add-payment-section-wrap > p {
      font-size: .875rem; color: #6b7280; margin: 0 0 2.5rem;
    }
    .pm-cols { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start; }
    @media(max-width:800px){ .pm-cols { grid-template-columns: 1fr; gap: 2rem; } }

    /* --- Live card preview --- */
    .card-preview-scene { perspective: 1000px; width: 100%; max-width: 360px; margin: 0 auto 1.5rem; }
    .card-preview-flipper {
      position: relative; width: 100%; padding-bottom: 62%;
      transform-style: preserve-3d; transition: transform .6s cubic-bezier(.4,0,.2,1);
    }
    .card-preview-flipper.is-flipped { transform: rotateY(180deg); }
    .card-face {
      position: absolute; inset: 0; border-radius: 20px;
      backface-visibility: hidden; -webkit-backface-visibility: hidden;
      box-shadow: 0 30px 60px rgba(124,58,237,.35), 0 6px 20px rgba(0,0,0,.15);
      overflow: hidden;
    }
    .card-face-front {
      background: linear-gradient(135deg, #1e1b4b 0%, #4c1d95 40%, #7c3aed 75%, #a78bfa 100%);
    }
    .card-face-back {
      background: linear-gradient(135deg, #312e81 0%, #4c1d95 60%, #6d28d9 100%);
      transform: rotateY(180deg);
    }
    /* Holographic shimmer */
    .card-face::before {
      content:''; position:absolute; inset:0;
      background: linear-gradient(115deg, transparent 40%, rgba(255,255,255,.08) 50%, transparent 60%);
      background-size: 200% 100%; animation: cardShimmer 3s ease-in-out infinite;
    }
    @keyframes cardShimmer { 0%,100%{background-position:200% 0} 50%{background-position:-200% 0} }
    /* Circles deco */
    .card-face::after {
      content:''; position:absolute; top:-30%; right:-10%;
      width:280px; height:280px; border-radius:50%;
      background: radial-gradient(circle, rgba(255,255,255,.07) 0%, transparent 70%);
      pointer-events:none;
    }
    .card-front-inner { position:absolute; inset:0; padding:1.5rem; display:flex; flex-direction:column; justify-content:space-between; }
    .card-chip { width:44px; height:33px; border-radius:6px; background:linear-gradient(135deg,#ffd700,#f0a500); display:flex; align-items:center; justify-content:center; }
    .card-chip-lines { width:30px; height:22px; border:2px solid rgba(0,0,0,.3); border-radius:3px; display:grid; grid-template-rows:1fr 1fr 1fr; gap:2px; padding:2px; }
    .card-chip-line { background:rgba(0,0,0,.2); border-radius:1px; }
    .card-number-display { font-family:'Courier New',monospace; font-size:1.15rem; font-weight:700; color:white; letter-spacing:.2em; text-shadow:0 1px 3px rgba(0,0,0,.3); }
    .card-bottom-row { display:flex; justify-content:space-between; align-items:flex-end; }
    .card-holder-label,.card-expiry-label { font-size:.55rem; text-transform:uppercase; letter-spacing:.12em; color:rgba(255,255,255,.6); margin-bottom:.2rem; }
    .card-holder-name,.card-expiry-val { font-size:.8rem; font-weight:600; color:white; letter-spacing:.05em; }
    .card-brand-logo { font-size:1.4rem; font-weight:900; color:white; opacity:.9; }
    /* Back face */
    .card-back-stripe { position:absolute; top:18%; left:0; right:0; height:45px; background:rgba(0,0,0,.45); }
    .card-back-cvv-wrap { position:absolute; top:calc(18% + 60px); left:0; right:0; padding:0 1.5rem; }
    .card-back-cvv-label { font-size:.65rem; color:rgba(255,255,255,.6); text-transform:uppercase; letter-spacing:.1em; margin-bottom:.3rem; }
    .card-back-cvv-box { background:white; border-radius:6px; padding:.5rem 1rem; font-family:'Courier New',monospace; font-size:1rem; font-weight:700; color:#1a202c; letter-spacing:.3em; text-align:right; }
    .card-back-brand { position:absolute; bottom:1.2rem; right:1.5rem; font-size:1.4rem; font-weight:900; color:white; opacity:.9; }

    /* Form fields */
    .pm-form-group { margin-bottom: 1.5rem; }
    .pm-form-label {
      display: block; font-size: .8rem; font-weight: 700; color: #374151;
      text-transform: uppercase; letter-spacing: .08em; margin-bottom: .6rem;
    }
    .pm-input-wrap { position: relative; }
    .pm-input {
      width: 100%; padding: .9rem 1.1rem .9rem 3rem;
      border: 2px solid #e5e7eb; border-radius: 14px;
      font-size: 1rem; color: #1a202c; background: white;
      transition: border-color .25s, box-shadow .25s;
      font-family: 'Courier New', monospace; letter-spacing: .05em;
      outline: none;
    }
    .pm-input:focus {
      border-color: #7c3aed;
      box-shadow: 0 0 0 4px rgba(124,58,237,.1);
    }
    .pm-input-icon {
      position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
      color: #9ca3af; font-size: .9rem; pointer-events: none;
      transition: color .25s;
    }
    .pm-input:focus + .pm-input-icon, .pm-input-wrap:has(.pm-input:focus) .pm-input-icon { color: #7c3aed; }
    .pm-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    /* Brand chips */
    .pm-brand-chips { display: flex; gap: .5rem; margin-bottom: 1.75rem; }
    .pm-brand-chip {
      flex: 1; padding: .6rem; border: 2px solid #e5e7eb; border-radius: 12px;
      display: flex; align-items: center; justify-content: center; gap: .4rem;
      cursor: pointer; transition: all .2s; background: white;
      font-size: .8rem; font-weight: 600; color: #6b7280;
    }
    .pm-brand-chip:hover { border-color: #a78bfa; color: #7c3aed; }
    .pm-brand-chip.active { border-color: #7c3aed; background: #f5f3ff; color: #6d28d9; box-shadow: 0 0 0 3px rgba(124,58,237,.1); }
    /* Submit btn */
    .pm-submit-btn {
      width: 100%; padding: 1.1rem; border: none; border-radius: 16px;
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
      color: white; font-size: 1rem; font-weight: 700; cursor: pointer;
      transition: all .3s; box-shadow: 0 8px 25px rgba(124,58,237,.35);
      display: flex; align-items: center; justify-content: center; gap: .6rem;
      letter-spacing: .02em;
    }
    .pm-submit-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 35px rgba(124,58,237,.45); }
    .pm-submit-btn:active { transform: translateY(0); }
    .pm-secure-note {
      display: flex; align-items: center; justify-content: center; gap: .5rem;
      margin-top: 1rem; font-size: .78rem; color: #9ca3af;
    }
    .pm-secure-note i { color: #10b981; }
    /* Card number brand icon inside input */
    .pm-brand-in-input {
      position: absolute; right: 1rem; top: 50%; transform: translateY(-50%);
      font-size: .85rem; font-weight: 900; color: #6b7280; pointer-events: none;
      transition: all .2s;
    }

    /* === Sélecteur pays (Step 1) === */
    .payout-step { margin-bottom: 2rem; }
    .step-label { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .12em; color: #7c3aed; margin-bottom: .25rem; }
    .step-title  { font-size: 1.1rem; font-weight: 700; color: #1a202c; margin-bottom: 1.25rem; }

    .country-search-wrap {
      position: relative; max-width: 480px;
      display: flex; align-items: center;
      background: white; border: 2px solid #e5e7eb; border-radius: 14px;
      padding: .75rem 1rem; gap: .6rem;
      transition: border-color .25s, box-shadow .25s;
    }
    .country-search-wrap:focus-within {
      border-color: #7c3aed; box-shadow: 0 0 0 4px rgba(124,58,237,.1);
    }
    .country-search-icon { color: #9ca3af; font-size: .95rem; flex-shrink: 0; }
    .country-search-input {
      flex: 1; border: none; outline: none; font-size: .95rem;
      color: #1a202c; background: transparent;
    }
    .country-search-input::placeholder { color: #9ca3af; }
    .country-search-clear {
      color: #9ca3af; cursor: pointer; font-size: 1.1rem; display: none;
    }
    .country-search-clear.vis { display: block; }
    .country-dropdown {
      position: absolute; top: calc(100% + 6px); left: 0; right: 0; z-index: 200;
      background: #fff; border: 1.5px solid #e5e7eb; border-radius: 14px;
      box-shadow: 0 20px 60px rgba(0,0,0,.15); max-height: 320px; overflow-y: auto;
      display: none;
    }
    .country-dropdown.open { display: block; }
    .country-opt {
      display: flex; align-items: center; gap: .75rem;
      padding: .7rem 1rem; cursor: pointer; transition: background .15s;
      border-bottom: 1px solid #f9fafb;
    }
    .country-opt:last-child { border-bottom: none; }
    .country-opt:hover { background: #f5f3ff; }
    .country-opt-flag { font-size: 1.4rem; line-height: 1; flex-shrink: 0; }
    .country-opt-name { font-size: .9rem; font-weight: 600; color: #111827; }
    .country-opt-system { font-size: .7rem; color: #6b7280; font-weight: 500; letter-spacing: .3px; }
    .country-opt-none { padding: 1.5rem; text-align: center; color: #9ca3af; font-size: .875rem; }

    .country-selected-chip {
      display: none; align-items: center; gap: .75rem;
      background: #f5f3ff; border: 1.5px solid #c4b5fd;
      border-radius: 12px; padding: .6rem 1rem; margin-top: .75rem; max-width: 480px;
    }
    .country-selected-chip.vis { display: flex; }
    .country-chip-flag { font-size: 1.5rem; }
    .country-chip-name { font-size: .92rem; font-weight: 700; color: #5b21b6; }
    .country-chip-sys  { font-size: .72rem; color: #7c3aed; font-weight: 600; letter-spacing: .5px; text-transform: uppercase; }
    .country-chip-change { margin-left: auto; font-size: .8rem; color: #7c3aed; cursor: pointer; font-weight: 600; text-decoration: underline; }

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
  <div class="settings-container">
    @include('frontend.client.partials.dashboard-nav')
    @php $heroFirstName = Auth::guard('web')->user()?->first_name ?? Auth::guard('web')->user()?->username ?? 'vous'; @endphp
    <div class="page-hero-banner">
      <div class="hero-text-content">
        <h1 class="page-hero-title">Bonjour {{ $heroFirstName }} !</h1>
        <p class="page-hero-subtitle">Bienvenue dans votre espace</p>
      </div>
      <a href="/services" class="hero-search-btn">
        <i class="fas fa-search"></i> Trouver un freelance
      </a>
    </div>

    <div class="settings-wrapper">
      @include('frontend.client.settings._sidebar')

      <!-- Contenu principal droite -->
      <main class="settings-content">
        <!-- En-tête -->
        <div class="settings-header">
          <h1>{{ __('Gérez vos modes de paiement') }}</h1>
          <p>{{ __('Ajoutez et gérez vos moyens de paiement en toute sécurité. Vos informations sont cryptées et protégées.') }}</p>
        </div>

        @if (session('status') === 'payment-method-added' || (session('success') && session('status') === 'payment-method-added'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Votre moyen de paiement a été ajouté avec succès.')) }}
          </div>
        @endif

        @if (session('status') === 'payment-method-removed' || (session('success') && session('status') === 'payment-method-removed'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Le moyen de paiement a été supprimé avec succès.')) }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-error">
            <ul>
              @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- Liste des moyens de paiement -->
        <div class="payment-methods-list">
          @if($paymentMethods && $paymentMethods->count() > 0)
            @foreach($paymentMethods as $method)
              <div class="payment-method-card">
                <div class="payment-method-info">
                  <div class="payment-method-icon">
                    {{ strtoupper(substr($method->brand ?? 'CARD', 0, 1)) }}
                  </div>
                  <div class="payment-method-details">
                    <div class="payment-method-brand">{{ $method->brand ?? __('Carte bancaire') }}</div>
                    <div class="payment-method-number">• • • • {{ $method->last4 ?? '0000' }}</div>
                    <div class="payment-method-expiry">
                      {{ __('Expire le') }} {{ str_pad($method->exp_month ?? '00', 2, '0', STR_PAD_LEFT) }}/{{ substr($method->exp_year ?? '0000', -2) }}
                    </div>
                    @if($method->is_default ?? false)
                      <span class="payment-method-badge">{{ __('Mode de paiement principal') }}</span>
                    @endif
                  </div>
                </div>
                <div class="payment-method-actions">
                  <form method="POST" action="{{ route('user.settings.payment_methods.destroy', $method->id) }}" style="display: inline;" onsubmit="return confirm('{{ __("Êtes-vous sûr de vouloir supprimer ce moyen de paiement ?") }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                      <i class="fas fa-trash"></i> {{ __('Supprimer') }}
                    </button>
                  </form>
                </div>
              </div>
            @endforeach
          @else
            <div class="empty-state">
              <div class="empty-state-icon">
                <i class="far fa-credit-card"></i>
              </div>
              <div class="empty-state-text">{{ __("Vous n'avez pas encore ajouté de moyen de paiement.") }}</div>
            </div>
          @endif
        </div>

        <!-- Section ajout -->
        <div class="add-payment-section-wrap">
          <h2>Ajouter un moyen de paiement</h2>
          <p>Vos informations sont chiffrées de bout en bout. Aucune donnée bancaire n'est stockée sur nos serveurs.</p>

          {{-- ── ÉTAPE 1 : Sélection du pays ── --}}
          <div class="payout-step" id="step1Area">
            <div class="step-label">Étape 1</div>
            <div class="step-title">Dans quel pays se trouve votre carte bancaire ?</div>
            <div class="country-search-wrap" id="countrySearchWrap">
              <span class="country-search-icon"><i class="fas fa-search"></i></span>
              <input type="text" class="country-search-input" id="countrySearchInput"
                     placeholder="Rechercher un pays…" autocomplete="off" />
              <span class="country-search-clear" id="countrySearchClear">✕</span>
              <div class="country-dropdown" id="countryDropdown"></div>
            </div>
            <div class="country-selected-chip" id="selectedChip">
              <span class="country-chip-flag" id="chipFlag"></span>
              <div>
                <div class="country-chip-name" id="chipName"></div>
                <div class="country-chip-sys"  id="chipSys"></div>
              </div>
              <span class="country-chip-change" id="chipChange">Modifier</span>
            </div>
          </div>

          {{-- ── ÉTAPE 2 : Formulaire carte (masqué jusqu'au choix pays) ── --}}
          <div id="step2Area" style="display:none;">
            <div class="payout-step" style="margin-bottom:1.5rem;">
              <div class="step-label">Étape 2</div>
              <div class="step-title">Informations de votre carte bancaire</div>
            </div>

          <div class="pm-cols">

            {{-- Colonne gauche : aperçu de la carte --}}
            <div>
              <div class="card-preview-scene">
                <div class="card-preview-flipper" id="cardFlipper">
                  {{-- Face avant --}}
                  <div class="card-face card-face-front">
                    <div class="card-front-inner">
                      <div style="display:flex;justify-content:space-between;align-items:center;">
                        <div class="card-chip">
                          <div class="card-chip-lines">
                            <div class="card-chip-line"></div>
                            <div class="card-chip-line"></div>
                            <div class="card-chip-line"></div>
                          </div>
                        </div>
                        <div class="card-brand-logo" id="cardBrandFront">VISA</div>
                      </div>
                      <div class="card-number-display" id="cardNumberDisplay">•••• &nbsp;•••• &nbsp;•••• &nbsp;••••</div>
                      <div class="card-bottom-row">
                        <div>
                          <div class="card-holder-label">Titulaire</div>
                          <div class="card-holder-name" id="cardHolderDisplay">VOTRE NOM</div>
                        </div>
                        <div>
                          <div class="card-expiry-label">Expire</div>
                          <div class="card-expiry-val" id="cardExpiryDisplay">MM/AA</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- Face arrière --}}
                  <div class="card-face card-face-back">
                    <div class="card-back-stripe"></div>
                    <div class="card-back-cvv-wrap">
                      <div class="card-back-cvv-label">CVV</div>
                      <div class="card-back-cvv-box" id="cardCvvDisplay">•••</div>
                    </div>
                    <div class="card-back-brand" id="cardBrandBack">VISA</div>
                  </div>
                </div>
              </div>

              {{-- Logos acceptés --}}
              <div style="display:flex;align-items:center;justify-content:center;gap:1rem;opacity:.55;margin-top:.5rem;">
                <span style="font-size:.75rem;color:#6b7280;">Acceptés :</span>
                <span style="font-weight:900;font-size:1.1rem;color:#1a1f71;font-style:italic;">VISA</span>
                <span style="font-weight:900;font-size:.85rem;color:#eb001b;">Master<span style="color:#f79e1b;">card</span></span>
                <span style="font-weight:900;font-size:.85rem;color:#2e77bc;">AMEX</span>
              </div>
            </div>

            {{-- Colonne droite : formulaire --}}
            <div>
              <form method="POST" action="{{ route('user.settings.payment_methods.store') }}" id="pm-form" novalidate>
                @csrf
                <input type="hidden" name="payment_method_token" id="pm_token" value="">
                <input type="hidden" name="billing_country" id="hBillingCountry" value="">

                {{-- Numéro de carte --}}
                <div class="pm-form-group">
                  <label class="pm-form-label" for="pm_number">Numéro de carte</label>
                  <div class="pm-input-wrap">
                    <input type="text" id="pm_number" class="pm-input" placeholder="0000  0000  0000  0000"
                           maxlength="22" autocomplete="cc-number" inputmode="numeric" style="padding-left:3rem;padding-right:5rem;">
                    <i class="far fa-credit-card pm-input-icon"></i>
                    <span class="pm-brand-in-input" id="pmBrandInInput">VISA</span>
                  </div>
                </div>

                {{-- Titulaire --}}
                <div class="pm-form-group">
                  <label class="pm-form-label" for="pm_holder">Nom du titulaire</label>
                  <div class="pm-input-wrap">
                    <input type="text" id="pm_holder" class="pm-input" placeholder="JEAN DUPONT"
                           autocomplete="cc-name" style="text-transform:uppercase;letter-spacing:.08em;">
                    <i class="far fa-user pm-input-icon"></i>
                  </div>
                </div>

                {{-- Expiry + CVV --}}
                <div class="pm-row-2">
                  <div class="pm-form-group">
                    <label class="pm-form-label" for="pm_expiry">Date d'expiration</label>
                    <div class="pm-input-wrap">
                      <input type="text" id="pm_expiry" class="pm-input" placeholder="MM / AA"
                             maxlength="7" autocomplete="cc-exp" inputmode="numeric">
                      <i class="far fa-calendar pm-input-icon"></i>
                    </div>
                  </div>
                  <div class="pm-form-group">
                    <label class="pm-form-label" for="pm_cvv">CVV / CVC</label>
                    <div class="pm-input-wrap">
                      <input type="text" id="pm_cvv" class="pm-input" placeholder="•••"
                             maxlength="4" autocomplete="cc-csc" inputmode="numeric">
                      <i class="fas fa-lock pm-input-icon"></i>
                    </div>
                  </div>
                </div>

                <button type="submit" class="pm-submit-btn" id="pm-submit-btn">
                  <i class="fas fa-shield-alt"></i>
                  Enregistrer la carte en toute sécurité
                </button>
                <div class="pm-secure-note">
                  <i class="fas fa-lock"></i> Chiffrement SSL 256-bit &nbsp;·&nbsp;
                  <i class="far fa-check-circle"></i> PCI-DSS compliant
                </div>
              </form>
            </div>

          </div>{{-- /pm-cols --}}
          </div>{{-- /step2Area --}}
        </div>{{-- /add-payment-section-wrap --}}
      </main>
    </div>
  </div>

  <script>
  /* ── Sélecteur pays (Step 1) ── */
  (function() {
    function flagEmoji(cc) {
      var o = 127397;
      return String.fromCodePoint(cc.charCodeAt(0)+o) + String.fromCodePoint(cc.charCodeAt(1)+o);
    }

    var COUNTRIES = [
      {c:'FR',n:'France',              s:'Carte bancaire'},
      {c:'GP',n:'Guadeloupe',          s:'Carte bancaire'},
      {c:'MQ',n:'Martinique',          s:'Carte bancaire'},
      {c:'GF',n:'Guyane',              s:'Carte bancaire'},
      {c:'RE',n:'La Réunion',          s:'Carte bancaire'},
      {c:'NC',n:'Nouvelle-Calédonie',  s:'Carte bancaire'},
      {c:'PF',n:'Polynésie française', s:'Carte bancaire'},
      {c:'BE',n:'Belgique',            s:'Carte bancaire'},
      {c:'CH',n:'Suisse',              s:'Carte bancaire'},
      {c:'DE',n:'Allemagne',           s:'Carte bancaire'},
      {c:'ES',n:'Espagne',             s:'Carte bancaire'},
      {c:'HR',n:'Croatie',             s:'Carte bancaire'},
      {c:'IE',n:'Irlande',             s:'Carte bancaire'},
      {c:'IT',n:'Italie',              s:'Carte bancaire'},
      {c:'LU',n:'Luxembourg',          s:'Carte bancaire'},
      {c:'MC',n:'Monaco',              s:'Carte bancaire'},
      {c:'MT',n:'Malte',               s:'Carte bancaire'},
      {c:'NL',n:'Pays-Bas',            s:'Carte bancaire'},
      {c:'PT',n:'Portugal',            s:'Carte bancaire'},
      {c:'GB',n:'Royaume-Uni',         s:'Debit / Credit card'},
      {c:'CA',n:'Canada',              s:'Credit card'},
      {c:'US',n:'États-Unis',          s:'Credit card'},
      {c:'CI',n:"Côte d'Ivoire",       s:'Carte bancaire'},
      {c:'MA',n:'Maroc',               s:'Carte bancaire'},
      {c:'SN',n:'Sénégal',             s:'Carte bancaire'},
      {c:'TN',n:'Tunisie',             s:'Carte bancaire'},
    ];

    var searchInput = document.getElementById('countrySearchInput');
    var clearBtn    = document.getElementById('countrySearchClear');
    var dropdown    = document.getElementById('countryDropdown');
    var selectedChip= document.getElementById('selectedChip');
    var chipFlag    = document.getElementById('chipFlag');
    var chipName    = document.getElementById('chipName');
    var chipSys     = document.getElementById('chipSys');
    var chipChange  = document.getElementById('chipChange');
    var step2Area   = document.getElementById('step2Area');
    var hCountry    = document.getElementById('hBillingCountry');

    if (!searchInput) return;

    function renderDropdown(list) {
      if (!list.length) {
        dropdown.innerHTML = '<div class="country-opt-none">Aucun pays trouvé</div>';
      } else {
        dropdown.innerHTML = list.map(function(c){
          return '<div class="country-opt" data-code="'+c.c+'">' +
            '<span class="country-opt-flag">'+flagEmoji(c.c)+'</span>' +
            '<div><div class="country-opt-name">'+c.n+'</div>' +
            '<div class="country-opt-system">'+c.s+'</div></div></div>';
        }).join('');
        dropdown.querySelectorAll('.country-opt').forEach(function(el){
          el.addEventListener('click', function(){
            var code = this.getAttribute('data-code');
            var obj  = COUNTRIES.find(function(x){ return x.c === code; });
            if (obj) selectCountry(obj);
          });
        });
      }
      dropdown.classList.add('open');
    }

    function selectCountry(obj) {
      chipFlag.textContent = flagEmoji(obj.c);
      chipName.textContent = obj.n;
      chipSys.textContent  = obj.s;
      selectedChip.classList.add('vis');
      searchInput.value = '';
      clearBtn.classList.remove('vis');
      dropdown.classList.remove('open');
      hCountry.value = obj.c;
      step2Area.style.display = '';
    }

    searchInput.addEventListener('input', function(){
      var q = this.value.trim().toLowerCase();
      clearBtn.classList.toggle('vis', q.length > 0);
      if (!q) { dropdown.classList.remove('open'); return; }
      var filtered = COUNTRIES.filter(function(c){
        return c.n.toLowerCase().includes(q) || c.c.toLowerCase().includes(q);
      });
      renderDropdown(filtered);
    });

    searchInput.addEventListener('focus', function(){
      renderDropdown(COUNTRIES);
      dropdown.classList.add('open');
    });

    clearBtn.addEventListener('click', function(){
      searchInput.value = '';
      clearBtn.classList.remove('vis');
      dropdown.classList.remove('open');
    });

    chipChange.addEventListener('click', function(){
      selectedChip.classList.remove('vis');
      step2Area.style.display = 'none';
      hCountry.value = '';
      renderDropdown(COUNTRIES);
      dropdown.classList.add('open');
      searchInput.focus();
    });

    document.addEventListener('click', function(e){
      var wrap = document.getElementById('countrySearchWrap');
      var chip = document.getElementById('selectedChip');
      if (!wrap.contains(e.target) && !chip.contains(e.target)) {
        dropdown.classList.remove('open');
      }
    });
  })();

  /* =====================================================================
     PREMIUM CARD FORM — Live preview + validation + brand detection
     Prêt pour Stripe Elements : remplacer les inputs par stripe.elements()
     quand les clés Stripe sont configurées dans .env
     ===================================================================== */
  (function () {

    /* ── Références DOM ── */
    var numInput    = document.getElementById('pm_number');
    var holderInput = document.getElementById('pm_holder');
    var expiryInput = document.getElementById('pm_expiry');
    var cvvInput    = document.getElementById('pm_cvv');
    var flipper     = document.getElementById('cardFlipper');
    var numDisplay  = document.getElementById('cardNumberDisplay');
    var holderDisp  = document.getElementById('cardHolderDisplay');
    var expiryDisp  = document.getElementById('cardExpiryDisplay');
    var cvvDisp     = document.getElementById('cardCvvDisplay');
    var brandFront  = document.getElementById('cardBrandFront');
    var brandBack   = document.getElementById('cardBrandBack');
    var brandInInput= document.getElementById('pmBrandInInput');
    var form        = document.getElementById('pm-form');
    var submitBtn   = document.getElementById('pm-submit-btn');

    if (!numInput) return;

    /* ── Détection de marque ── */
    function detectBrand(val) {
      val = val.replace(/\s/g,'');
      if (/^3[47]/.test(val))  return 'AMEX';
      if (/^5[1-5]/.test(val)) return 'MC';
      if (/^4/.test(val))      return 'VISA';
      if (/^6/.test(val))      return 'CB';
      return 'VISA';
    }
    function brandLabel(b) {
      if (b==='AMEX') return 'AMEX';
      if (b==='MC')   return '●● MC';
      if (b==='CB')   return 'CB';
      return 'VISA';
    }
    function updateBrand(raw) {
      var b = detectBrand(raw);
      var lbl = brandLabel(b);
      if (brandFront)   brandFront.textContent  = lbl;
      if (brandBack)    brandBack.textContent   = lbl;
      if (brandInInput) brandInInput.textContent = lbl;
    }

    /* ── Numéro de carte ── */
    numInput.addEventListener('input', function () {
      var raw = this.value.replace(/\D/g,'');
      /* AMEX : 4-6-5, autres : 4-4-4-4 */
      var isAmex = /^3[47]/.test(raw);
      var formatted;
      if (isAmex) {
        formatted = raw.replace(/^(\d{4})(\d{0,6})(\d{0,5}).*/, function(_,a,b,c){
          return b ? (c ? a+' '+b+' '+c : a+' '+b) : a;
        });
      } else {
        formatted = raw.replace(/(.{4})/g,'$1 ').trim().substring(0,22);
      }
      this.value = formatted;
      /* Preview */
      var display = raw.padEnd(16,'•');
      if (isAmex) display = raw.padEnd(15,'•');
      var parts = isAmex
        ? [display.slice(0,4), display.slice(4,10), display.slice(10,15)]
        : [display.slice(0,4), display.slice(4,8), display.slice(8,12), display.slice(12,16)];
      numDisplay.innerHTML = parts.join(' &nbsp;');
      updateBrand(raw);
    });

    /* ── Titulaire ── */
    holderInput.addEventListener('input', function () {
      var v = this.value.toUpperCase();
      this.value = v;
      holderDisp.textContent = v || 'VOTRE NOM';
    });

    /* ── Expiry ── */
    expiryInput.addEventListener('input', function () {
      var raw = this.value.replace(/\D/g,'');
      if (raw.length >= 3) raw = raw.slice(0,2) + ' / ' + raw.slice(2,4);
      else if (raw.length === 2 && this._prev && this._prev.length < 2) raw = raw + ' / ';
      this._prev = raw;
      this.value = raw;
      expiryDisp.textContent = raw.replace(' / ','/') || 'MM/AA';
    });

    /* ── CVV (flip) ── */
    cvvInput.addEventListener('focus', function () {
      if (flipper) flipper.classList.add('is-flipped');
    });
    cvvInput.addEventListener('blur', function () {
      if (flipper) flipper.classList.remove('is-flipped');
    });
    cvvInput.addEventListener('input', function () {
      var raw = this.value.replace(/\D/g,'');
      this.value = raw;
      cvvDisp.textContent = raw.padEnd(3,'•').slice(0,4);
    });

    /* ── Soumission ── */
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var num    = numInput.value.replace(/\s/g,'');
      var holder = holderInput.value.trim();
      var expiry = expiryInput.value.replace(/\s/g,'');
      var cvv    = cvvInput.value.trim();

      /* Validation basique */
      var errors = [];
      if (num.length < 13) errors.push('Numéro de carte invalide');
      if (!holder)         errors.push('Nom du titulaire requis');
      if (!/^\d{2}\/\d{2}$/.test(expiry)) errors.push('Date d\'expiration invalide (MM/AA)');
      if (cvv.length < 3)  errors.push('CVV invalide');

      /* Vérification date expi */
      if (errors.length === 0) {
        var parts = expiry.split('/');
        var now   = new Date();
        var expiDate = new Date(2000 + parseInt(parts[1]), parseInt(parts[0]) - 1, 1);
        if (expiDate < now) errors.push('Cette carte est expirée');
      }

      if (errors.length > 0) {
        /* Afficher erreurs */
        var existing = document.getElementById('pm-errors');
        if (existing) existing.remove();
        var errEl = document.createElement('div');
        errEl.id = 'pm-errors';
        errEl.style.cssText = 'background:#fef2f2;color:#991b1b;border:1px solid #fca5a5;border-radius:12px;padding:1rem 1.25rem;margin-bottom:1.5rem;font-size:.875rem;';
        errEl.innerHTML = errors.map(function(e){ return '• ' + e; }).join('<br>');
        form.insertBefore(errEl, form.firstChild);
        return;
      }

      /* Animation de chargement */
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sécurisation en cours…';

      /* == Stripe Elements ==
         Quand les clés Stripe sont configurées dans .env (STRIPE_KEY),
         décommenter ce bloc et supprimer le submit direct ci-dessous :

      var stripe   = Stripe('{{ config("services.stripe.key") }}');
      var elements = stripe.elements();
      var card     = elements.create('card');
      card.mount('#stripe-card-element'); // ajouter ce div dans la vue

      stripe.createPaymentMethod({
        type: 'card',
        card: card,
        billing_details: { name: holder }
      }).then(function(result) {
        if (result.error) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = '<i class="fas fa-shield-alt"></i> Enregistrer la carte en toute sécurité';
          // afficher result.error.message
        } else {
          document.getElementById('pm_token').value = result.paymentMethod.id;
          form.submit();
        }
      });
      */

      /* Soumission directe (mode sans Stripe — le token sera vide,
         le contrôleur UserController@storePaymentMethod le traitera
         quand l'intégration Stripe sera activée) */
      document.getElementById('pm_token').value = 'mock_' + num.slice(-4) + '_' + Date.now();
      setTimeout(function() { form.submit(); }, 800);
    });

  })();
  </script>
@endsection

