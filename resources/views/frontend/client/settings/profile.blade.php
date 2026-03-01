@extends('frontend.layout')

@section('style')
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .settings-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
      padding-top: 3rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      min-height: calc(100vh - 200px);
    }

    .settings-wrapper {
      display: grid;
      grid-template-columns: 25% 75%;
      gap: 2rem;
      margin-top: 2rem;
    }

    .settings-sidebar {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 1.5rem 0;
      height: fit-content;
      position: sticky;
      top: 2rem;
    }

    .settings-content {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 2.5rem;
    }

    .settings-header {
      margin-bottom: 2rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid #f1f5f9;
    }
    .settings-header h1 { font-size: 1.6rem; font-weight: 800; color: #0f172a; margin: 0 0 .4rem; }
    .settings-header p  { font-size: .95rem; color: #64748b; margin: 0; }

    /* Photo de profil */
    .profile-photo-section {
      display: flex; align-items: flex-start; gap: 2rem;
      margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 1px solid #f1f5f9;
    }
    .profile-photo-preview {
      width: 100px; height: 100px; border-radius: 50%; object-fit: cover;
      border: 3px solid #ede9fe; flex-shrink: 0;
      box-shadow: 0 8px 24px rgba(124,58,237,.18);
    }
    .profile-photo-actions h3 { font-size: 1rem; font-weight: 700; color: #1a202c; margin: 0 0 .75rem; }
    .btn-upload-photo {
      padding: .6rem 1.4rem; background: white; border: 2px solid #7c3aed;
      color: #7c3aed; border-radius: 12px; font-weight: 600; font-size: .9rem;
      cursor: pointer; transition: all .2s ease; display: inline-block; text-decoration: none;
    }
    .btn-upload-photo:hover { background: #7c3aed; color: white; }
    .profile-photo-help { margin-top: .5rem; font-size: .82rem; color: #6b7280; }

    /* Formulaire */
    .form-section { margin-bottom: 2rem; }
    .form-section-title {
      font-size: 1rem; font-weight: 700; color: #1a202c; margin-bottom: 1rem;
      padding-bottom: .6rem; border-bottom: 1px solid #f1f5f9;
    }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    @media(max-width:640px) { .form-row { grid-template-columns: 1fr; } }
    .form-group { margin-bottom: 1.25rem; }
    .form-label { display: block; font-size: .9rem; font-weight: 600; color: #374151; margin-bottom: .4rem; }
    .form-control {
      width: 100%; padding: .75rem 1rem; font-size: .92rem; color: #1a202c;
      background: white; border: 1.5px solid #e2e8f0; border-radius: 12px;
      transition: all .2s ease; font-family: inherit;
    }
    .form-control:focus { outline: none; border-color: #7c3aed; box-shadow: 0 0 0 3px rgba(124,58,237,.1); }
    .form-control.has-error { border-color: #ef4444; }
    .form-error { margin-top: .4rem; font-size: .84rem; color: #ef4444; }

    /* Connexions sociales */
    .social-connections { margin-bottom: 2rem; }
    .social-connection-item {
      display: flex; align-items: center; justify-content: space-between;
      padding: 1rem 0; border-bottom: 1px solid #f8f9fb;
    }
    .social-connection-item:last-child { border-bottom: none; }
    .social-connection-info { display: flex; align-items: center; gap: 1rem; }
    .social-icon { width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; font-weight: 700; color: white; }
    .social-icon.facebook { background: #1877f2; }
    .social-icon.google   { background: #ea4335; }
    .social-connection-text strong { display: block; font-weight: 700; color: #1a202c; margin-bottom: .15rem; }
    .social-connection-text span { font-size: .85rem; color: #6b7280; }
    .social-connection-action {
      padding: .45rem 1.1rem; background: white; border: 1.5px solid #d1d5db; color: #374151;
      border-radius: 10px; font-size: .85rem; font-weight: 600; cursor: pointer;
      transition: all .2s ease; text-decoration: none; display: inline-block;
    }
    .social-connection-action:hover { border-color: #7c3aed; color: #7c3aed; }

    /* Submit */
    .form-actions { margin-top: 2rem; }
    .btn-primary-gradient {
      display: inline-flex; align-items: center; gap: .5rem;
      padding: .85rem 2rem;
      background: linear-gradient(135deg, #7c3aed 0%, #4c1d95 50%, #1e40af 100%);
      color: white; border: none; border-radius: 14px; font-size: 1rem; font-weight: 700;
      cursor: pointer; transition: all .3s ease; box-shadow: 0 4px 16px rgba(124,58,237,.3);
      font-family: inherit;
    }
    .btn-primary-gradient:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(124,58,237,.4); }

    .alert { padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; font-size: .93rem; }
    .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
    .alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; }
    .alert-error ul { margin: 0; padding-left: 1rem; }

    /* Hero banner */
    .page-hero-banner {
      background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 60%, #a855f7 100%);
      border-radius: 40px; padding: 3rem 4rem; margin-bottom: 2rem;
      color: white; position: relative; overflow: hidden;
      box-shadow: 0 32px 80px rgba(124,58,237,.3), inset 0 1px 1px rgba(255,255,255,.2);
      display: flex; justify-content: space-between; align-items: center; gap: 2rem;
    }
    .page-hero-banner::before {
      content: ''; position: absolute; top: -40%; left: -5%;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(255,255,255,.08) 0%, transparent 70%);
      border-radius: 50%; pointer-events: none;
    }
    .page-hero-banner::after {
      content: ''; position: absolute; bottom: -20%; right: -10%;
      width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(255,255,255,.1) 0%, transparent 70%);
      border-radius: 50%; pointer-events: none;
    }
    .page-hero-title { font-size: 2.5rem; font-weight: 900; margin-bottom: .5rem; color: white; line-height: 1.1; letter-spacing: -.03em; position: relative; z-index: 2; }
    .page-hero-subtitle { font-size: 1.1rem; opacity: .9; margin-bottom: 0; font-weight: 300; color: white; position: relative; z-index: 2; }
    .hero-text-content { flex: 1; position: relative; z-index: 2; }
    .hero-search-btn {
      background: white; color: #7c3aed; border-radius: 50px; padding: .85rem 1.8rem;
      font-weight: 600; font-size: .95rem; text-decoration: none !important;
      display: flex; align-items: center; gap: .5rem; white-space: nowrap;
      position: relative; z-index: 2; flex-shrink: 0; transition: background .2s, color .2s;
    }
    .hero-search-btn:hover { background: #f5f3ff; color: #6d28d9; text-decoration: none !important; }

    @media(max-width:1024px) { .settings-wrapper { grid-template-columns: 1fr; } }
    @media(max-width:640px) {
      .profile-photo-section { flex-direction: column; align-items: center; text-align: center; }
      .settings-content { padding: 1.5rem; }
    }
  </style>
@endsection

@section('content')
  <div class="settings-container">
    @include('frontend.client.partials.dashboard-nav')

    @php
      $heroFirstName = Auth::guard('web')->user()?->first_name ?? Auth::guard('web')->user()?->username ?? 'vous';
    @endphp
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

      <main class="settings-content">
        <div class="settings-header">
          <h1>Profil personnel</h1>
          <p>Photo, prénom, nom, ville, pays et fuseau horaire affichés sur la plateforme.</p>
        </div>

        @if(session('success'))
          <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="alert alert-error">
            <ul>
              @foreach($errors->all() as $error)
                <li>• {{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data" id="settings-form">
          @csrf
          <input type="hidden" name="_redirect" value="{{ route('user.settings.profile') }}">

          <!-- Photo de profil -->
          <div class="profile-photo-section">
            @if($avatarUrl)
              <img src="{{ $avatarUrl }}" alt="Photo de profil" class="profile-photo-preview" id="profile-photo-preview">
            @else
              <div class="profile-photo-preview" id="profile-photo-preview"
                   style="display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#7c3aed,#1e40af);color:white;font-size:2rem;font-weight:800;">
                {{ $initials }}
              </div>
            @endif
            <div class="profile-photo-actions">
              <h3>Photo de profil</h3>
              <label for="profile-photo-input" class="btn-upload-photo">
                Importer une photo
              </label>
              <input type="file" id="profile-photo-input" name="image" accept="image/jpeg,image/png,image/jpg"
                     style="display:none;" form="settings-form">
              <div class="profile-photo-help">Taille max : 2 Mo — Format JPG ou PNG</div>
            </div>
          </div>

          <!-- Identité -->
          <div class="form-section">
            <h3 class="form-section-title">Identité</h3>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Prénom</label>
                <input type="text" name="first_name"
                       class="form-control @error('first_name') has-error @enderror"
                       value="{{ old('first_name', $user->first_name) }}">
                @error('first_name')<div class="form-error">{{ $message }}</div>@enderror
              </div>
              <div class="form-group">
                <label class="form-label">Nom</label>
                <input type="text" name="last_name"
                       class="form-control @error('last_name') has-error @enderror"
                       value="{{ old('last_name', $user->last_name) }}">
                @error('last_name')<div class="form-error">{{ $message }}</div>@enderror
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Nom d'utilisateur</label>
                <input type="text" name="username"
                       class="form-control @error('username') has-error @enderror"
                       value="{{ old('username', $user->username) }}">
                @error('username')<div class="form-error">{{ $message }}</div>@enderror
              </div>
              <div class="form-group">
                <label class="form-label">Téléphone</label>
                <input type="tel" name="phone_number"
                       class="form-control @error('phone_number') has-error @enderror"
                       value="{{ old('phone_number', $user->phone_number) }}">
                @error('phone_number')<div class="form-error">{{ $message }}</div>@enderror
              </div>
            </div>
          </div>

          <!-- Localisation -->
          <div class="form-section">
            <h3 class="form-section-title">Localisation</h3>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Ville</label>
                <input type="text" name="city"
                       class="form-control @error('city') has-error @enderror"
                       value="{{ old('city', $user->city) }}">
                @error('city')<div class="form-error">{{ $message }}</div>@enderror
              </div>
              <div class="form-group">
                <label class="form-label">Pays</label>
                <input type="text" name="country"
                       class="form-control @error('country') has-error @enderror"
                       value="{{ old('country', $user->country) }}">
                @error('country')<div class="form-error">{{ $message }}</div>@enderror
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Adresse</label>
              <input type="text" name="address"
                     class="form-control @error('address') has-error @enderror"
                     value="{{ old('address', $user->address) }}">
              @error('address')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
              <label class="form-label">Fuseau horaire</label>
              <select name="timezone" class="form-control @error('timezone') has-error @enderror">
                @foreach([
                  'Europe/Paris'        => 'Europe/Paris (GMT +1:00)',
                  'Europe/London'       => 'Europe/London (GMT +0:00)',
                  'Europe/Berlin'       => 'Europe/Berlin (GMT +1:00)',
                  'Africa/Casablanca'   => 'Africa/Casablanca (GMT +1:00)',
                  'Africa/Tunis'        => 'Africa/Tunis (GMT +1:00)',
                  'Africa/Algiers'      => 'Africa/Algiers (GMT +1:00)',
                  'America/New_York'    => 'America/New_York (GMT -5:00)',
                  'America/Los_Angeles' => 'America/Los_Angeles (GMT -8:00)',
                  'America/Montreal'    => 'America/Montreal (GMT -5:00)',
                  'Asia/Dubai'          => 'Asia/Dubai (GMT +4:00)',
                  'Asia/Tokyo'          => 'Asia/Tokyo (GMT +9:00)',
                ] as $tz => $label)
                  <option value="{{ $tz }}" {{ old('timezone', $user->timezone ?? 'Europe/Paris') == $tz ? 'selected' : '' }}>
                    {{ $label }}
                  </option>
                @endforeach
              </select>
              @error('timezone')<div class="form-error">{{ $message }}</div>@enderror
            </div>
          </div>

          <!-- Connexions sociales -->
          <div class="social-connections">
            <h3 class="form-section-title">Connexions sociales</h3>
            <div class="social-connection-item">
              <div class="social-connection-info">
                <div class="social-icon facebook">f</div>
                <div class="social-connection-text">
                  <strong>Facebook</strong>
                  <span>Le compte Facebook n'est pas connecté</span>
                </div>
              </div>
              <button type="button" class="social-connection-action">Connecter</button>
            </div>
            <div class="social-connection-item">
              <div class="social-connection-info">
                <div class="social-icon google">G</div>
                <div class="social-connection-text">
                  <strong>Google</strong>
                  <span>
                    @if(isset($user->provider) && $user->provider == 'google')
                      Connecté en tant que {{ $user->email_address }}
                    @else
                      Le compte Google n'est pas connecté
                    @endif
                  </span>
                </div>
              </div>
              @if(isset($user->provider) && $user->provider == 'google')
                <button type="button" class="social-connection-action" onclick="alert('La déconnexion sera disponible prochainement.')">Déconnecter</button>
              @else
                <button type="button" class="social-connection-action" onclick="alert('La connexion Google sera disponible prochainement.')">Connecter</button>
              @endif
            </div>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-primary-gradient">
              <i class="fas fa-save"></i> Enregistrer les modifications
            </button>
          </div>
        </form>
      </main>
    </div>
  </div>

  <script>
    document.getElementById('profile-photo-input')?.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = ev => {
        const prev = document.getElementById('profile-photo-preview');
        if (prev.tagName === 'IMG') { prev.src = ev.target.result; }
        else {
          const img = document.createElement('img');
          img.src = ev.target.result;
          img.className = 'profile-photo-preview'; img.id = 'profile-photo-preview'; img.alt = 'Photo';
          prev.parentNode.replaceChild(img, prev);
        }
      };
      reader.readAsDataURL(file);
    });
  </script>
@endsection
