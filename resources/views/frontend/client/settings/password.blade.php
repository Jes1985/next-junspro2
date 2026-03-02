@extends('frontend.layout')

@section('style')
  <style>
    :root {
      --jp-purple: #7c3aed;
      --jp-purple-light: #ede9fe;
      --jp-blue: #1e40af;
      --jp-shadow: 0 8px 32px rgba(124,58,237,.12);
    }
    .settings-container {
      max-width: 1400px; margin: 0 auto;
      padding: 3rem 2rem; padding-top: 3.5rem;
      background: linear-gradient(160deg,#faf8ff 0%,#f3e8ff 40%,#ede9fe 100%);
      min-height: calc(100vh - 200px);
    }

    /* Layout 2 colonnes */
    .settings-wrapper { display: grid; grid-template-columns: 25% 75%; gap: 2.5rem; margin-top: 2rem; }
    @media(max-width:1024px){ .settings-wrapper { grid-template-columns: 1fr; } }

    /* Dummy to skip old sidebar CSS */
    .__skip {
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
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      color: var(--junspro-purple);
    }

    .settings-menu-item a.active {
      background: #f3f4f6;
      color: var(--junspro-purple);
      font-weight: 600;
      border-left-color: var(--junspro-purple);
    }

    .settings-menu-item a.danger-link {
      color: #dc2626;
    }

    .settings-menu-item a.danger-link:hover {
      background: #fef2f2;
      color: #b91c1c;
    }

    .settings-menu-item a.danger-link.active {
      background: #fee2e2;
      color: #dc2626;
      border-left-color: #dc2626;
    }

    /* Content card */
    .settings-content {
      background: white;
      border-radius: 28px;
      box-shadow: 0 8px 40px rgba(124,58,237,.1), 0 2px 12px rgba(0,0,0,.04);
      padding: 3rem;
      border: 1.5px solid rgba(196,181,253,.2);
    }
    .settings-header {
      margin-bottom: 2.5rem; padding-bottom: 1.75rem;
      border-bottom: 2px solid #f1f5f9;
    }
    .settings-header h1 {
      font-size: 1.75rem; font-weight: 900; color: #0f172a;
      margin: 0 0 .4rem; letter-spacing: -.03em;
      display: flex; align-items: center; gap: .75rem;
    }
    .settings-header h1 .h-icon {
      width: 42px; height: 42px; border-radius: 12px;
      background: linear-gradient(135deg, #ede9fe, #ddd6fe);
      display: flex; align-items: center; justify-content: center;
      color: #7c3aed; font-size: 1.1rem; flex-shrink: 0;
    }
    .settings-header p { font-size: .92rem; color: #64748b; margin: 0; line-height: 1.6; }

    /* Alertes */
    .alert { padding: 1rem 1.25rem; border-radius: 14px; margin-bottom: 1.5rem; font-size: .9rem; }
    .alert-success { background: #f0fdf4; color: #166534; border: 1.5px solid #86efac; }
    .alert-error   { background: #fef2f2; color: #991b1b; border: 1.5px solid #fca5a5; }
    .alert ul { margin: 0; padding-left: 1rem; list-style: none; }
    .alert ul li { margin: .2rem 0; }

    /* Form premium */
    .settings-form { margin-top: .5rem; }
    .form-group { margin-bottom: 2rem; }
    .form-label {
      display: flex; align-items: center; gap: .45rem;
      font-size: .78rem; font-weight: 700; color: #374151;
      text-transform: uppercase; letter-spacing: .08em; margin-bottom: .65rem;
    }
    .form-label i { color: #7c3aed; font-size: .85rem; }

    /* Input avec icône */
    .input-icon-wrap { position: relative; }
    .input-icon-wrap .input-prefix {
      position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
      color: #9ca3af; font-size: .95rem; pointer-events: none;
      transition: color .2s;
    }
    .input-icon-wrap .input-suffix {
      position: absolute; right: 1rem; top: 50%; transform: translateY(-50%);
      color: #9ca3af; cursor: pointer; font-size: .95rem;
      background: none; border: none; padding: 0; transition: color .2s;
    }
    .input-icon-wrap .input-suffix:hover { color: #7c3aed; }
    .form-control {
      width: 100%; padding: 1rem 1rem 1rem 3rem;
      font-size: .95rem; color: #0f172a;
      background: white; border: 2px solid #e5e7eb;
      border-radius: 14px; transition: all .25s ease;
      font-family: inherit; outline: none;
    }
    .form-control.has-suffix { padding-right: 3rem; }
    .form-control:focus {
      border-color: #7c3aed;
      box-shadow: 0 0 0 4px rgba(124,58,237,.1);
    }
    .form-control:focus + .input-prefix,
    .input-icon-wrap:has(.form-control:focus) .input-prefix { color: #7c3aed; }
    .form-control.has-error { border-color: #ef4444; }
    .form-error { margin-top: .45rem; font-size: .82rem; color: #ef4444; display: flex; align-items: center; gap: .3rem; }

    /* Strength meter */
    .strength-wrap { margin-top: .85rem; }
    .strength-bars { display: flex; gap: 4px; margin-bottom: .4rem; }
    .strength-bar {
      flex: 1; height: 4px; border-radius: 4px;
      background: #e5e7eb; transition: background .3s ease;
    }
    .strength-bar.weak   { background: #ef4444; }
    .strength-bar.fair   { background: #f59e0b; }
    .strength-bar.good   { background: #3b82f6; }
    .strength-bar.strong { background: #10b981; }
    .strength-label { font-size: .78rem; font-weight: 600; color: #9ca3af; }

    /* Rules check list */
    .password-rules { list-style: none; padding: 0; margin: 1rem 0 0; display: flex; flex-direction: column; gap: .45rem; }
    .rule-item {
      display: flex; align-items: center; gap: .55rem;
      font-size: .82rem; color: #9ca3af; transition: color .2s;
    }
    .rule-item.ok { color: #10b981; }
    .rule-item .rule-icon { width: 18px; height: 18px; border-radius: 50%; border: 1.5px solid #d1d5db; display: flex; align-items: center; justify-content: center; font-size: .65rem; transition: all .2s; flex-shrink: 0; }
    .rule-item.ok .rule-icon { background: #10b981; border-color: #10b981; color: white; }

    /* Actions */
    .form-actions {
      margin-top: 2.5rem; padding-top: 2rem;
      border-top: 1.5px solid #f1f5f9;
      display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;
    }
    .btn-primary-gradient {
      display: inline-flex; align-items: center; gap: .6rem;
      padding: 1rem 2.25rem;
      background: linear-gradient(135deg, #7c3aed 0%, #4f46e5 100%);
      color: white; border: none; border-radius: 16px;
      font-size: 1rem; font-weight: 700; cursor: pointer;
      transition: all .3s cubic-bezier(.34,1.56,.64,1);
      box-shadow: 0 8px 25px rgba(124,58,237,.35);
      font-family: inherit; text-decoration: none;
    }
    .btn-primary-gradient:hover {
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 14px 35px rgba(124,58,237,.45);
      color: white;
    }
    .btn-primary-gradient:active { transform: translateY(0) scale(.98); }
    .link-muted { color: #94a3b8; font-size: .875rem; text-decoration: none; transition: color .2s; }
    .link-muted:hover { color: #7c3aed; text-decoration: underline; }

    /* Hero banner */
    .page-hero-banner {
      background: linear-gradient(135deg,#4c1d95 0%,#7c3aed 60%,#a855f7 100%);
      border-radius: 36px; padding: 2.5rem 3.5rem; margin-bottom: 2rem;
      color: white; position: relative; overflow: hidden;
      box-shadow: 0 24px 64px rgba(124,58,237,.3), inset 0 1px 1px rgba(255,255,255,.2);
      display: flex; justify-content: space-between; align-items: center; gap: 2rem;
    }
    .page-hero-banner::before { content:''; position:absolute; top:-40%; left:-5%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,.08) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
    .page-hero-banner::after  { content:''; position:absolute; bottom:-20%; right:-10%; width:600px; height:600px; background:radial-gradient(circle,rgba(255,255,255,.1) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
    .page-hero-title { font-size:2.25rem; font-weight:900; margin-bottom:.5rem; color:white; line-height:1.1; letter-spacing:-.03em; position:relative; z-index:2; }
    .page-hero-subtitle { font-size:1rem; opacity:.9; margin:0; font-weight:300; color:white; position:relative; z-index:2; }
    .hero-text-content { flex:1; position:relative; z-index:2; }
    .hero-search-btn { background:white; color:#7c3aed; border-radius:50px; padding:.85rem 1.8rem; font-weight:600; font-size:.9rem; text-decoration:none !important; display:flex; align-items:center; gap:.5rem; white-space:nowrap; position:relative; z-index:2; flex-shrink:0; transition:background .2s,color .2s; }
    .hero-search-btn:hover { background:#f5f3ff; color:#6d28d9; text-decoration:none !important; }
    @media(max-width:640px){ .settings-content{padding:1.75rem;} .page-hero-banner{padding:2rem 1.75rem; border-radius:24px; flex-direction:column;} .form-actions{flex-direction:column;} .btn-primary-gradient{width:100%;} }
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
          <h1><span class="h-icon"><i class="fas fa-shield-alt"></i></span>{{ __('Sécurité du compte') }}</h1>
          <p>{{ __("Modifiez votre mot de passe Junspro. Pour votre sécurité, nous vous demandons d'abord votre mot de passe actuel.") }}</p>
        </div>

        @if (session('status') === 'password-updated' || session('success'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Votre mot de passe a été mis à jour avec succès.')) }}
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

        <form method="POST" action="{{ route('user.settings.password.update') }}" class="settings-form">
          @csrf

          <!-- Mot de passe actuel -->
          <div class="form-group">
            <label for="current_password" class="form-label"><i class="fas fa-lock"></i>{{ __('Mot de passe actuel') }}</label>
            <div class="input-icon-wrap">
              <i class="fas fa-lock input-prefix"></i>
              <input id="current_password" type="password" name="current_password"
                class="form-control has-suffix @error('current_password') has-error @enderror"
                autocomplete="current-password" required>
              <button type="button" class="input-suffix" onclick="togglePwd('current_password',this)" tabindex="-1">
                <i class="far fa-eye"></i>
              </button>
            </div>
            @error('current_password')
              <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
          </div>

          <!-- Nouveau mot de passe -->
          <div class="form-group">
            <label for="new_password" class="form-label"><i class="fas fa-key"></i>{{ __('Nouveau mot de passe') }}</label>
            <div class="input-icon-wrap">
              <i class="fas fa-key input-prefix"></i>
              <input id="new_password" type="password" name="new_password"
                class="form-control has-suffix @error('new_password') has-error @enderror"
                autocomplete="new-password" required oninput="checkStrength(this.value)">
              <button type="button" class="input-suffix" onclick="togglePwd('new_password',this)" tabindex="-1">
                <i class="far fa-eye"></i>
              </button>
            </div>
            @error('new_password')
              <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <!-- Strength meter -->
            <div class="strength-wrap">
              <div class="strength-bars">
                <div class="strength-bar" id="sb1"></div>
                <div class="strength-bar" id="sb2"></div>
                <div class="strength-bar" id="sb3"></div>
                <div class="strength-bar" id="sb4"></div>
              </div>
              <span class="strength-label" id="strengthLabel">Saisissez un mot de passe</span>
            </div>
            <!-- Check list animée -->
            <ul class="password-rules" id="pwdRules">
              <li class="rule-item" id="rule-length">
                <span class="rule-icon"><i class="fas fa-check"></i></span>
                {{ __('8 caractères minimum') }}
              </li>
              <li class="rule-item" id="rule-upper">
                <span class="rule-icon"><i class="fas fa-check"></i></span>
                {{ __('Une lettre majuscule') }}
              </li>
              <li class="rule-item" id="rule-digit">
                <span class="rule-icon"><i class="fas fa-check"></i></span>
                {{ __('Un chiffre') }}
              </li>
              <li class="rule-item" id="rule-special">
                <span class="rule-icon"><i class="fas fa-check"></i></span>
                {{ __('Un caractère spécial (! @ # ?)') }}
              </li>
            </ul>
          </div>

          <!-- Confirmation -->
          <div class="form-group">
            <label for="new_password_confirmation" class="form-label"><i class="fas fa-check-double"></i>{{ __('Confirmer le nouveau mot de passe') }}</label>
            <div class="input-icon-wrap">
              <i class="fas fa-check-double input-prefix"></i>
              <input id="new_password_confirmation" type="password" name="new_password_confirmation"
                class="form-control has-suffix @error('new_password_confirmation') has-error @enderror"
                autocomplete="new-password" required oninput="checkMatch()">
              <button type="button" class="input-suffix" onclick="togglePwd('new_password_confirmation',this)" tabindex="-1">
                <i class="far fa-eye"></i>
              </button>
            </div>
            <div id="matchMsg" style="margin-top:.45rem;font-size:.82rem;display:none;"></div>
            @error('new_password_confirmation')
              <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-primary-gradient">
              <i class="fas fa-shield-alt"></i> {{ __('Enregistrer le mot de passe') }}
            </button>
            <a href="{{ route('user.forget_password') ?? '#' }}" class="link-muted">
              <i class="fas fa-question-circle" style="font-size:.8rem;"></i> {{ __('Mot de passe oublié ?') }}
            </a>
          </div>
        </form>
      </main>
    </div>
  </div>

  <script>
  function togglePwd(id, btn) {
    var inp = document.getElementById(id);
    var icon = btn.querySelector('i');
    if (inp.type === 'password') { inp.type = 'text'; icon.classList.replace('fa-eye','fa-eye-slash'); }
    else { inp.type = 'password'; icon.classList.replace('fa-eye-slash','fa-eye'); }
  }
  function checkStrength(val) {
    var score = 0;
    if (val.length >= 8)           score++;
    if (/[A-Z]/.test(val))         score++;
    if (/[0-9]/.test(val))         score++;
    if (/[^A-Za-z0-9]/.test(val))  score++;
    var cls   = ['','weak','fair','good','strong'][score];
    var lbl   = document.getElementById('strengthLabel');
    lbl.textContent = ['Saisissez un mot de passe','Trop faible','Passable','Bon','Excellent \u2014 Parfait !'][score];
    lbl.style.color = ['#9ca3af','#ef4444','#f59e0b','#3b82f6','#10b981'][score];
    ['sb1','sb2','sb3','sb4'].forEach(function(b,i){
      var el = document.getElementById(b); el.className = 'strength-bar';
      if (i < score) el.classList.add(cls);
    });
    document.getElementById('rule-length') .classList.toggle('ok', val.length >= 8);
    document.getElementById('rule-upper')  .classList.toggle('ok', /[A-Z]/.test(val));
    document.getElementById('rule-digit')  .classList.toggle('ok', /[0-9]/.test(val));
    document.getElementById('rule-special').classList.toggle('ok', /[^A-Za-z0-9]/.test(val));
    checkMatch();
  }
  function checkMatch() {
    var a = document.getElementById('new_password').value;
    var b = document.getElementById('new_password_confirmation').value;
    var msg = document.getElementById('matchMsg');
    if (!b) { msg.style.display = 'none'; return; }
    msg.style.display = 'flex'; msg.style.alignItems = 'center'; msg.style.gap = '.3rem';
    if (a === b) { msg.style.color = '#10b981'; msg.innerHTML = '<i class="fas fa-check-circle"></i> Les mots de passe correspondent'; }
    else { msg.style.color = '#ef4444'; msg.innerHTML = '<i class="fas fa-times-circle"></i> Les mots de passe ne correspondent pas'; }
  }
  </script>
@endsection

