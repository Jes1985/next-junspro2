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
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
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
      line-height: 1.6;
    }

    /* Alerts */
    .alert {
      padding: 1rem 1.5rem;
      border-radius: 12px;
      margin-bottom: 2rem;
      font-size: 0.95rem;
    }

    .alert-success {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #86efac;
    }

    .alert-error {
      background: #fef2f2;
      color: #dc2626;
      border: 1px solid #fca5a5;
    }

    /* Formulaires */
    .settings-form {
      margin-top: 2rem;
    }

    .form-group {
      margin-bottom: 2rem;
    }

    .form-hint {
      font-size: 0.875rem;
      color: #6b7280;
      margin-top: 0.5rem;
      line-height: 1.5;
    }

    .switch-hint {
      font-size: 0.875rem;
      color: #6b7280;
      margin-top: 0.5rem;
      margin-left: 3.75rem;
      line-height: 1.5;
    }

    .info-text {
      font-size: 0.95rem;
      color: #374151;
      line-height: 1.7;
      margin: 0;
    }

    .form-error {
      font-size: 0.875rem;
      color: #dc2626;
      margin-top: 0.5rem;
    }

    /* Switch Toggle */
    .switch-group {
      padding: 1.5rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      border-radius: 12px;
      border: 2px solid #e5e7eb;
      margin-bottom: 1.5rem;
    }

    .switch-label {
      display: flex;
      align-items: flex-start;
      cursor: pointer;
      gap: 1rem;
    }

    .switch-label input[type="checkbox"] {
      display: none;
    }

    .switch {
      position: relative;
      width: 52px;
      height: 28px;
      background: #d1d5db;
      border-radius: 14px;
      transition: all 0.3s ease;
      flex-shrink: 0;
      margin-top: 0.125rem;
    }

    .switch::before {
      content: '';
      position: absolute;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: white;
      top: 2px;
      left: 2px;
      transition: all 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .switch-label input[type="checkbox"]:checked + .switch {
      background: var(--junspro-purple);
    }

    .switch-label input[type="checkbox"]:checked + .switch::before {
      transform: translateX(24px);
    }

    .switch-content {
      flex: 1;
    }

    .switch-title {
      font-size: 1rem;
      font-weight: 600;
      color: #1a202c;
      margin: 0 0 0.25rem 0;
    }

    .switch-description {
      font-size: 0.875rem;
      color: #6b7280;
      margin: 0;
      line-height: 1.5;
    }

    /* Section grouping */
    .notification-section {
      margin-bottom: 2.5rem;
    }

    .notification-section-title {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1a202c;
      margin: 0 0 1.5rem 0;
      padding-bottom: 0.75rem;
      border-bottom: 2px solid #e5e7eb;
    }

    /* Actions */
    .form-actions {
      margin-top: 3rem;
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
    }

    .btn-primary-gradient:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .btn-primary-gradient i {
      margin-right: 0.5rem;
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

      .switch-group {
        padding: 1rem;
      }

      .form-hint {
        margin-left: 0;
        margin-top: 0.75rem;
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
      </aside>

      <!-- Contenu principal droite -->
      <main class="settings-content">
        <!-- En-tête -->
        <div class="settings-header">
          <h1>{{ __('Notifications') }}</h1>
          <p>{{ __('Choisissez les e-mails que vous souhaitez recevoir. L\'objectif : être informé des étapes importantes de vos projets, sans être submergé.') }}</p>
        </div>

        @if (session('status') === 'notifications-updated' || session('success'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Vos préférences de notifications ont été mises à jour.')) }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-error">
            <ul style="margin: 0; padding-left: 1.5rem;">
              @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('user.settings.notifications.update') }}" class="settings-form">
          @csrf

          <!-- Section : Projets & sessions -->
          <div class="notification-section">
            <h2 class="notification-section-title">{{ __('Projets & sessions') }}</h2>

            <!-- Sessions planifiées / modifiées / annulées -->
            <div class="switch-group">
              <label class="switch-label">
                <input type="checkbox"
                       name="email_sessions"
                       value="1"
                       @if(old('email_sessions', $settings['email_sessions'] ?? true)) checked @endif>
                <span class="switch"></span>
                <div class="switch-content">
                  <div class="switch-title">{{ __('Être informé des sessions planifiées, modifiées ou annulées') }}</div>
                  <div class="switch-description">
                    {{ __('Vous recevez un e-mail à chaque fois qu\'une nouvelle session est ajoutée à votre agenda ou qu\'un horaire change.') }}
                  </div>
                </div>
              </label>
            </div>

            <!-- Rapport après chaque session -->
            <div class="switch-group">
              <label class="switch-label">
                <input type="checkbox"
                       name="email_reports"
                       value="1"
                       @if(old('email_reports', $settings['email_reports'] ?? true)) checked @endif>
                <span class="switch"></span>
                <div class="switch-content">
                  <div class="switch-title">{{ __('Recevoir le rapport après chaque session') }}</div>
                  <div class="switch-description">
                    {{ __('Le freelance vous envoie un rapport écrit en fin de session (10 minutes). Vous pouvez le recevoir directement dans votre boîte mail.') }}
                  </div>
                </div>
              </label>
            </div>
          </div>

          <!-- Section : Messages -->
          <div class="notification-section">
            <h2 class="notification-section-title">{{ __('Messages') }}</h2>

            <!-- Nouveaux messages des freelances -->
            <div class="switch-group">
              <label class="switch-label">
                <input type="checkbox"
                       name="email_messages"
                       value="1"
                       @if(old('email_messages', $settings['email_messages'] ?? true)) checked @endif>
                <span class="switch"></span>
                <div class="switch-content">
                  <div class="switch-title">{{ __('Être averti des nouveaux messages de vos freelances') }}</div>
                  <div class="switch-description">
                    {{ __('Utile pour ne pas rater une question importante ou une mise à jour sur votre projet.') }}
                  </div>
                </div>
              </label>
            </div>
          </div>

          <!-- Section : Facturation -->
          <div class="notification-section">
            <h2 class="notification-section-title">{{ __('Facturation & abonnements') }}</h2>

            <!-- Factures et paiements -->
            <div class="switch-group">
              <label class="switch-label">
                <input type="checkbox"
                       name="email_billing"
                       value="1"
                       @if(old('email_billing', $settings['email_billing'] ?? true)) checked @endif>
                <span class="switch"></span>
                <div class="switch-content">
                  <div class="switch-title">{{ __('Recevoir les factures et informations de paiement') }}</div>
                  <div class="switch-description">
                    {{ __('Recommandé. Vous recevez vos factures, confirmations de paiement et alertes en cas de problème de prélèvement.') }}
                  </div>
                </div>
              </label>
            </div>
          </div>

          <!-- Section : Actualités Junspro -->
          <div class="notification-section">
            <h2 class="notification-section-title">{{ __('Actualités Junspro') }}</h2>

            <!-- News / nouveautés produits -->
            <div class="switch-group">
              <label class="switch-label">
                <input type="checkbox"
                       name="email_news"
                       value="1"
                       @if(old('email_news', $settings['email_news'] ?? false)) checked @endif>
                <span class="switch"></span>
                <div class="switch-content">
                  <div class="switch-title">{{ __('Recevoir les nouveautés Junspro (facultatif)') }}</div>
                  <div class="switch-description">
                    {{ __('Recevez de temps en temps des informations sur les nouvelles fonctionnalités, conseils pour mieux utiliser Junspro et retours d\'expérience clients.') }}
                  </div>
                </div>
              </label>
            </div>
          </div>

          <!-- Bloc pédagogique -->
          <div class="info-box">
            <h2 class="info-title">{{ __('Notre philosophie des notifications') }}</h2>
            <p class="info-text" style="margin: 0; font-size: 0.95rem; color: #374151; line-height: 1.7;">
              {{ __('Junspro est conçu pour vous aider à avancer sur vos projets sans vous fatiguer avec des e-mails inutiles. Nous vous recommandons de garder les notifications liées aux sessions, aux rapports et à la facturation, et de désactiver ce qui ne vous sert pas.') }}
            </p>
          </div>

          <!-- Actions -->
          <div class="form-actions">
            <button type="submit" class="btn-primary-gradient">
              <i class="fas fa-save"></i> {{ __('Enregistrer mes préférences') }}
            </button>
          </div>
        </form>
      </main>
    </div>
  </div>
@endsection

