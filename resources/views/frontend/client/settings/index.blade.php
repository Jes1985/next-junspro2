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

    /* Bloc photo de profil */
    .profile-photo-section {
      display: flex;
      align-items: flex-start;
      gap: 2rem;
      margin-bottom: 3rem;
      padding-bottom: 2rem;
      border-bottom: 1px solid #e5e7eb;
    }

    .profile-photo-preview {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #e5e7eb;
      flex-shrink: 0;
    }

    .profile-photo-actions {
      flex: 1;
    }

    .profile-photo-actions h3 {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1a202c;
      margin: 0 0 1rem 0;
    }

    .btn-upload-photo {
      padding: 0.75rem 1.5rem;
      background: white;
      border: 2px solid var(--junspro-purple);
      color: var(--junspro-purple);
      border-radius: 12px;
      font-weight: 500;
      font-size: 0.95rem;
      cursor: pointer;
      transition: all 0.2s ease;
      display: inline-block;
      text-decoration: none;
    }

    .btn-upload-photo:hover {
      background: var(--junspro-purple);
      color: white;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .profile-photo-help {
      margin-top: 0.75rem;
      font-size: 0.875rem;
      color: #6b7280;
      line-height: 1.5;
    }

    /* Formulaire */
    .settings-form {
      margin-bottom: 3rem;
    }

    .form-section {
      margin-bottom: 2.5rem;
    }

    .form-section-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 1.5rem;
      padding-bottom: 0.75rem;
      border-bottom: 1px solid #e5e7eb;
    }

    .form-group {
      margin-bottom: 1.5rem;
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

    .form-error {
      margin-top: 0.5rem;
      font-size: 0.875rem;
      color: #ef4444;
    }

    .form-help {
      margin-top: 0.5rem;
      font-size: 0.875rem;
      color: #6b7280;
    }

    /* Réseaux sociaux */
    .social-connections {
      margin-bottom: 3rem;
      padding-bottom: 2rem;
      border-bottom: 1px solid #e5e7eb;
    }

    .social-connection-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem 0;
      border-bottom: 1px solid #f3f4f6;
    }

    .social-connection-item:last-child {
      border-bottom: none;
    }

    .social-connection-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .social-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      font-weight: 600;
      color: white;
    }

    .social-icon.facebook {
      background: #1877f2;
    }

    .social-icon.google {
      background: #ea4335;
    }

    .social-connection-text {
      flex: 1;
    }

    .social-connection-text strong {
      display: block;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.25rem;
    }

    .social-connection-text span {
      font-size: 0.875rem;
      color: #6b7280;
    }

    .social-connection-action {
      padding: 0.5rem 1.25rem;
      background: white;
      border: 1px solid #d1d5db;
      color: #374151;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
    }

    .social-connection-action:hover {
      background: #f9fafb;
      border-color: var(--junspro-purple);
      color: var(--junspro-purple);
    }

    .social-connection-action.connected {
      background: #f3f4f6;
      color: #6b7280;
      cursor: default;
    }

    /* Bouton de validation */
    .settings-form-submit {
      max-width: 500px;
      margin: 2rem auto 0;
    }

    .btn-save {
      width: 100%;
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
    }

    .btn-save:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .btn-save:active {
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

      .profile-photo-section {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .settings-form-submit {
        max-width: 100%;
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
              {{ __('Mot de passe') }}
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.settings.email.edit') }}" class="{{ request()->routeIs('user.settings.email.*') ? 'active' : '' }}">
              {{ __('Adresse e-mail') }}
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

        <div class="settings-sidebar-title" style="margin-top: 1.5rem;">{{ __('Activité') }}</div>
        <ul class="settings-menu">
          <li class="settings-menu-item">
            <a href="{{ route('user.service_orders') }}" class="{{ request()->routeIs('user.service_orders') || request()->routeIs('user.service_order.details') ? 'active' : '' }}">
              {{ __('Commandes de services') }}
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.service_wishlist') }}" class="{{ request()->routeIs('user.service_wishlist') ? 'active' : '' }}">
              {{ __('Liste de souhaits') }}
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.support_tickets') }}" class="{{ request()->routeIs('user.support_tickets') || request()->routeIs('user.support_tickets.create') || request()->routeIs('user.support_ticket.conversation') ? 'active' : '' }}">
              {{ __('Tickets de support') }}
            </a>
          </li>
          <li class="settings-menu-item">
            <a href="{{ route('user.followings') }}" class="{{ request()->routeIs('user.followings') ? 'active' : '' }}">
              {{ __('Abonnements') }}
            </a>
          </li>
        </ul>
      </aside>

      <!-- Contenu principal droite -->
      <main class="settings-content">
        @php
          $user = Auth::guard('web')->user();
          $avatarUrl = $user->image ? asset('assets/img/users/' . $user->image) : null;
          $initials = strtoupper(substr($user->first_name ?? $user->username ?? '', 0, 1) . substr($user->last_name ?? '', 0, 1));
          if (empty($initials) || $initials === ' ') {
            $initials = strtoupper(substr($user->username ?? 'U', 0, 2));
          }
        @endphp

        <!-- En-tête -->
        <div class="settings-header">
          <h1>{{ __('Paramètres du compte') }}</h1>
          <p>{{ __("Gérez vos informations personnelles et votre profil Junspro.") }}</p>
        </div>

        <!-- Bloc photo de profil -->
        <div class="profile-photo-section">
          @if($avatarUrl)
            <img src="{{ $avatarUrl }}" alt="{{ __('Photo de profil') }}" class="profile-photo-preview" id="profile-photo-preview">
          @else
            <div class="profile-photo-preview" id="profile-photo-preview" style="display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--junspro-purple) 0%, var(--junspro-blue) 100%); color: white; font-size: 2.5rem; font-weight: 700;">
              {{ $initials }}
            </div>
          @endif
          <div class="profile-photo-actions">
            <h3>{{ __('Photo de profil') }}</h3>
            <label for="profile-photo-input" class="btn-upload-photo">
              <i class="fas fa-upload"></i> {{ __('Importer une photo') }}
            </label>
            <input type="file" id="profile-photo-input" name="image" accept="image/jpeg,image/png,image/jpg" style="display: none;" form="settings-form">
            <div class="profile-photo-help">
              {{ __('Taille maximale : 2 Mo') }}<br>
              {{ __('Format JPG ou PNG') }}
            </div>
          </div>
        </div>

        <!-- Formulaire informations personnelles -->
        <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data" id="settings-form" class="settings-form">
          @csrf

          <div class="form-section">
            <h3 class="form-section-title">{{ __('Informations personnelles') }}</h3>

            <div class="form-group">
              <label for="first_name" class="form-label">{{ __('Prénom') }}</label>
              <input type="text" 
                     id="first_name" 
                     name="first_name" 
                     class="form-control @error('first_name') has-error @enderror" 
                     value="{{ old('first_name', $user->first_name) }}"
                     required>
              @error('first_name')
                <div class="form-error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="last_name" class="form-label">{{ __('Nom') }}</label>
              <input type="text" 
                     id="last_name" 
                     name="last_name" 
                     class="form-control @error('last_name') has-error @enderror" 
                     value="{{ old('last_name', $user->last_name) }}"
                     required>
              @error('last_name')
                <div class="form-error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="phone_number" class="form-label">{{ __('Numéro de téléphone') }}</label>
              <input type="tel" 
                     id="phone_number" 
                     name="phone_number" 
                     class="form-control @error('phone_number') has-error @enderror" 
                     value="{{ old('phone_number', $user->phone_number) }}"
                     required>
              @error('phone_number')
                <div class="form-error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="username" class="form-label">{{ __('Nom d\'utilisateur') }}</label>
              <input type="text" 
                     id="username" 
                     name="username" 
                     class="form-control @error('username') has-error @enderror" 
                     value="{{ old('username', $user->username) }}"
                     required>
              @error('username')
                <div class="form-error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="address" class="form-label">{{ __('Adresse') }}</label>
              <input type="text" 
                     id="address" 
                     name="address" 
                     class="form-control @error('address') has-error @enderror" 
                     value="{{ old('address', $user->address) }}"
                     required>
              @error('address')
                <div class="form-error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="city" class="form-label">{{ __('Ville') }}</label>
              <input type="text" 
                     id="city" 
                     name="city" 
                     class="form-control @error('city') has-error @enderror" 
                     value="{{ old('city', $user->city) }}"
                     required>
              @error('city')
                <div class="form-error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="country" class="form-label">{{ __('Pays') }}</label>
              <input type="text" 
                     id="country" 
                     name="country" 
                     class="form-control @error('country') has-error @enderror" 
                     value="{{ old('country', $user->country) }}"
                     required>
              @error('country')
                <div class="form-error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="timezone" class="form-label">{{ __('Fuseau horaire') }}</label>
              <select id="timezone" 
                      name="timezone" 
                      class="form-control @error('timezone') has-error @enderror">
                <option value="Europe/Paris" {{ old('timezone', $user->timezone ?? 'Europe/Paris') == 'Europe/Paris' ? 'selected' : '' }}>
                  Europe/Paris (GMT +1:00)
                </option>
                <option value="Europe/London" {{ old('timezone', $user->timezone) == 'Europe/London' ? 'selected' : '' }}>
                  Europe/London (GMT +0:00)
                </option>
                <option value="America/New_York" {{ old('timezone', $user->timezone) == 'America/New_York' ? 'selected' : '' }}>
                  America/New_York (GMT -5:00)
                </option>
                <option value="America/Los_Angeles" {{ old('timezone', $user->timezone) == 'America/Los_Angeles' ? 'selected' : '' }}>
                  America/Los_Angeles (GMT -8:00)
                </option>
                <option value="Asia/Tokyo" {{ old('timezone', $user->timezone) == 'Asia/Tokyo' ? 'selected' : '' }}>
                  Asia/Tokyo (GMT +9:00)
                </option>
              </select>
              @error('timezone')
                <div class="form-error">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Réseaux sociaux -->
          <div class="social-connections">
            <h3 class="form-section-title">{{ __('Réseaux sociaux') }}</h3>

            <div class="social-connection-item">
              <div class="social-connection-info">
                <div class="social-icon facebook">f</div>
                <div class="social-connection-text">
                  <strong>Facebook</strong>
                  <span id="facebook-status">{{ __('Le compte Facebook n\'est pas connecté') }}</span>
                </div>
              </div>
              <button type="button" class="social-connection-action" id="connect-facebook">
                {{ __('Connecter') }}
              </button>
            </div>

            <div class="social-connection-item">
              <div class="social-connection-info">
                <div class="social-icon google">G</div>
                <div class="social-connection-text">
                  <strong>Google</strong>
                  <span id="google-status">
                    @if($user->provider == 'google')
                      {{ __('Connecté(e) en tant que') }} {{ $user->email_address }}
                    @else
                      {{ __('Le compte Google n\'est pas connecté') }}
                    @endif
                  </span>
                </div>
              </div>
              @if($user->provider == 'google')
                <button type="button" class="social-connection-action connected" id="disconnect-google">
                  {{ __('Déconnecter') }}
                </button>
              @else
                <button type="button" class="social-connection-action" id="connect-google">
                  {{ __('Connecter') }}
                </button>
              @endif
            </div>
          </div>

          <!-- Bouton de validation -->
          <div class="settings-form-submit">
            <button type="submit" class="btn-save">
              <i class="fas fa-save"></i> {{ __('Enregistrer') }}
            </button>
          </div>
        </form>
      </main>
    </div>
  </div>

  <script>
    // Preview de la photo de profil
    document.getElementById('profile-photo-input')?.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const preview = document.getElementById('profile-photo-preview');
          if (preview.tagName === 'IMG') {
            preview.src = e.target.result;
          } else {
            // Remplacer la div par une image
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'profile-photo-preview';
            img.alt = '{{ __("Photo de profil") }}';
            preview.parentNode.replaceChild(img, preview);
            // Mettre à jour l'ID pour la référence future
            img.id = 'profile-photo-preview';
          }
        };
        reader.readAsDataURL(file);
      }
    });

    // Connexions OAuth Facebook/Google (à implémenter complètement plus tard)
    @php
      try {
        $facebookRoute = route('user.login.facebook');
      } catch (\Exception $e) {
        $facebookRoute = '#';
      }
      try {
        $googleRoute = route('user.login.google');
      } catch (\Exception $e) {
        $googleRoute = '#';
      }
    @endphp

    document.getElementById('connect-facebook')?.addEventListener('click', function() {
      @if($facebookRoute !== '#')
        // Note: Cette route est normalement pour la connexion, pas pour lier un compte existant
        // TODO: Créer une route dédiée pour lier un compte Facebook à un compte existant
        // window.location.href = '{{ $facebookRoute }}';
        alert('{{ __("La connexion Facebook sera disponible prochainement.") }}');
      @else
        alert('{{ __("La connexion Facebook n\'est pas disponible.") }}');
      @endif
    });

    document.getElementById('connect-google')?.addEventListener('click', function() {
      @if($googleRoute !== '#')
        // Note: Cette route est normalement pour la connexion, pas pour lier un compte existant
        // TODO: Créer une route dédiée pour lier un compte Google à un compte existant
        // window.location.href = '{{ $googleRoute }}';
        alert('{{ __("La connexion Google sera disponible prochainement.") }}');
      @else
        alert('{{ __("La connexion Google n\'est pas disponible.") }}');
      @endif
    });

    document.getElementById('disconnect-google')?.addEventListener('click', function() {
      // TODO: Implémenter la déconnexion OAuth
      if (confirm('{{ __("Êtes-vous sûr de vouloir déconnecter votre compte Google ?") }}')) {
        alert('{{ __("La déconnexion sera disponible prochainement.") }}');
        // Route vers déconnexion à créer : user.settings.disconnect_social
        // window.location.href = 'URL_DE_LA_ROUTE_A_CREER';
      }
    });
  </script>
@endsection

