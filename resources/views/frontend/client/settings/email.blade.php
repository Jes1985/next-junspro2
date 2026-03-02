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

    /* État de l'email actuel */
    .email-status-section {
      margin-bottom: 2rem;
      padding: 1.25rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      border-radius: 12px;
      border: 1px solid #e5e7eb;
    }

    .email-status-label {
      font-size: 0.875rem;
      font-weight: 500;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    .email-status-value {
      font-size: 0.95rem;
      color: #1a202c;
      font-weight: 500;
      margin-bottom: 0.75rem;
    }

    .email-status-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.375rem 0.75rem;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 500;
    }

    .email-status-badge.verified {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #86efac;
    }

    .email-status-badge.pending {
      background: #fff7ed;
      color: #9a3412;
      border: 1px solid #fdba74;
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

    .alert ul {
      margin: 0;
      padding-left: 1.25rem;
      list-style: none;
    }

    .alert ul li {
      margin: 0.25rem 0;
    }

    /* Formulaire */
    .settings-form {
      margin-top: 2rem;
    }

    .form-group {
      margin-bottom: 2rem;
    }

    .form-label {
      display: block;
      font-size: 0.95rem;
      font-weight: 500;
      color: #374151;
      margin-bottom: 0.5rem;
    }

    .form-control {
      width: 100%;
      padding: 0.75rem 1rem;
      font-size: 0.95rem;
      color: #1a202c;
      background: white;
      border: 1px solid #d1d5db;
      border-radius: 12px;
      transition: all 0.2s ease;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-control.has-error {
      border-color: #ef4444;
    }

    /* ---- Icon-prefix inputs ---- */
    .input-wrap {
      position: relative;
      display: flex;
      align-items: center;
    }
    .input-prefix {
      position: absolute;
      left: 1rem;
      color: #9ca3af;
      font-size: .9rem;
      pointer-events: none;
      transition: color .2s;
      z-index: 1;
    }
    .input-wrap .form-control {
      padding-left: 2.6rem;
      padding-right: 1rem;
    }
    .input-wrap .form-control.has-suffix {
      padding-right: 2.8rem;
    }
    .input-suffix {
      position: absolute;
      right: .75rem;
      background: none;
      border: none;
      cursor: pointer;
      color: #9ca3af;
      font-size: .9rem;
      padding: .25rem;
      line-height: 1;
      transition: color .2s;
    }
    .input-suffix:hover { color: var(--junspro-purple); }
    .input-wrap:focus-within .input-prefix { color: var(--junspro-purple); }
    /* Email status premium */
    .email-status-section {
      margin-bottom: 2rem;
      padding: 1.25rem 1.5rem;
      background: linear-gradient(135deg,#f5f3ff 0%,#ede9fe 100%);
      border-radius: 16px;
      border: 1.5px solid #ddd6fe;
      display: flex;
      align-items: center;
      gap: 1.2rem;
    }
    .email-status-icon {
      width: 44px; height: 44px;
      border-radius: 12px;
      background: linear-gradient(135deg,#7c3aed,#4c1d95);
      display: flex; align-items: center; justify-content: center;
      color: white; font-size: 1.1rem; flex-shrink: 0;
    }
    .email-status-meta { flex: 1; }
    .email-status-label { font-size: .78rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: .06em; margin-bottom: .2rem; }
    .email-status-value { font-size: 1rem; font-weight: 700; color: #1a202c; }

    .form-error {
      margin-top: 0.5rem;
      font-size: 0.875rem;
      color: #ef4444;
    }

    /* Actions du formulaire */
    .form-actions {
      margin-top: 2.5rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
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
    }

    @media (max-width: 640px) {
      .settings-container {
        padding: 1rem;
        padding-top: 2rem;
      }

      .settings-content {
        padding: 1.5rem;
      }

      .form-actions {
        width: 100%;
      }

      .btn-primary-gradient {
        width: 100%;
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
        @php
          $user = Auth::guard('web')->user();
          $isEmailVerified = $user->email_verified_at !== null;
        @endphp

        <!-- En-tête -->
        <div class="settings-header">
          <h1>{{ __('Sécurisez votre e-mail') }}</h1>
          <p>{{ __("Mettez à jour l'adresse e-mail de votre compte Junspro. Pour votre sécurité, nous vous demandons d'abord votre mot de passe actuel. Une fois modifiée, nous vous enverrons un e-mail de confirmation.") }}</p>
        </div>

        @if (session('status') === 'email-updated' || session('success'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Votre adresse e-mail a été mise à jour. Vérifiez votre boîte de réception pour confirmer ce changement.')) }}
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

        <!-- État de l'email actuel -->
        <div class="email-status-section">
          <div class="email-status-icon"><i class="fas fa-envelope"></i></div>
          <div class="email-status-meta">
            <div class="email-status-label">E-mail actuel</div>
            <div class="email-status-value">{{ $user->email_address }}</div>
          </div>
          @if($isEmailVerified)
            <span class="email-status-badge verified" style="background:#f0fdf4;color:#166534;border:1.5px solid #86efac;padding:.35rem .9rem;border-radius:50px;font-size:.82rem;font-weight:600;display:flex;align-items:center;gap:.4rem;"><i class="fas fa-check-circle"></i> Vérifié</span>
          @else
            <span class="email-status-badge pending" style="background:#fff7ed;color:#9a3412;border:1.5px solid #fdba74;padding:.35rem .9rem;border-radius:50px;font-size:.82rem;font-weight:600;display:flex;align-items:center;gap:.4rem;"><i class="fas fa-clock"></i> En attente</span>
          @endif
        </div>

        <form method="POST" action="{{ route('user.settings.email.update') }}" class="settings-form">
          @csrf

          <!-- Mot de passe actuel -->
          <div class="form-group">
            <label for="current_password" class="form-label"><i class="fas fa-lock" style="color:#7c3aed;margin-right:.4rem;"></i>{{ __('Mot de passe actuel') }}</label>
            <div class="input-wrap">
              <span class="input-prefix"><i class="fas fa-lock"></i></span>
              <input
                id="current_password"
                type="password"
                name="current_password"
                class="form-control has-suffix @error('current_password') has-error @enderror"
                autocomplete="current-password"
                placeholder="Votre mot de passe actuel"
                required
              >
              <button type="button" class="input-suffix" onclick="toggleEmailPwd('current_password',this)" tabindex="-1">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            @error('current_password')
              <div class="form-error"><i class="fas fa-exclamation-circle" style="margin-right:.3rem;"></i>{{ $message }}</div>
            @enderror
          </div>

          <!-- Nouvelle adresse e-mail -->
          <div class="form-group">
            <label for="email_address" class="form-label"><i class="fas fa-envelope" style="color:#7c3aed;margin-right:.4rem;"></i>{{ __('Nouvelle adresse e-mail') }}</label>
            <div class="input-wrap">
              <span class="input-prefix"><i class="fas fa-envelope"></i></span>
              <input
                id="email_address"
                type="email"
                name="email_address"
                class="form-control @error('email_address') has-error @enderror"
                autocomplete="email"
                placeholder="nouvelle@adresse.com"
                value="{{ old('email_address') }}"
                required
              >
            </div>
            @error('email_address')
              <div class="form-error"><i class="fas fa-exclamation-circle" style="margin-right:.3rem;"></i>{{ $message }}</div>
            @enderror
          </div>

          <!-- Confirmation de la nouvelle adresse e-mail -->
          <div class="form-group">
            <label for="email_confirmation" class="form-label"><i class="fas fa-envelope-open-text" style="color:#7c3aed;margin-right:.4rem;"></i>{{ __('Confirmer la nouvelle adresse e-mail') }}</label>
            <div class="input-wrap">
              <span class="input-prefix"><i class="fas fa-envelope-open-text"></i></span>
              <input
                id="email_confirmation"
                type="email"
                name="email_confirmation"
                class="form-control @error('email_confirmation') has-error @enderror"
                autocomplete="email"
                placeholder="Confirmez votre nouvelle adresse"
                value="{{ old('email_confirmation') }}"
                required
                oninput="checkEmailMatch()"
              >
            </div>
            <div id="emailMatchMsg" style="display:none;font-size:.85rem;margin-top:.5rem;"></div>
            @error('email_confirmation')
              <div class="form-error"><i class="fas fa-exclamation-circle" style="margin-right:.3rem;"></i>{{ $message }}</div>
            @enderror
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-primary-gradient" style="border-radius:50px;padding:1rem 2.5rem;letter-spacing:.02em;">
              <i class="fas fa-paper-plane" style="margin-right:.5rem;"></i>{{ __('Mettre à jour mon e-mail') }}
            </button>
          </div>
        </form>
      </main>
    </div>
  </div>

  <script>
  function toggleEmailPwd(id, btn) {
    var inp = document.getElementById(id);
    var icon = btn.querySelector('i');
    if (inp.type === 'password') { inp.type = 'text'; icon.classList.replace('fa-eye','fa-eye-slash'); }
    else { inp.type = 'password'; icon.classList.replace('fa-eye-slash','fa-eye'); }
  }
  function checkEmailMatch() {
    var a = document.getElementById('email_address').value;
    var b = document.getElementById('email_confirmation').value;
    var msg = document.getElementById('emailMatchMsg');
    if (!b) { msg.style.display = 'none'; return; }
    msg.style.display = 'flex'; msg.style.alignItems = 'center'; msg.style.gap = '.35rem';
    if (a === b) { msg.style.color = '#10b981'; msg.innerHTML = '<i class="fas fa-check-circle"></i> Les adresses correspondent'; }
    else { msg.style.color = '#ef4444'; msg.innerHTML = '<i class="fas fa-times-circle"></i> Les adresses ne correspondent pas'; }
  }
  </script>
@endsection

