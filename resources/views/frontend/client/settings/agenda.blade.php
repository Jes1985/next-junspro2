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
      margin-bottom: 2.5rem;
    }

    .form-label {
      display: block;
      font-size: 0.95rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
    }

    .form-control {
      width: 100%;
      padding: 0.875rem 1rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 0.95rem;
      color: #1a202c;
      transition: all 0.2s ease;
      background: white;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .select {
      width: 100%;
      padding: 0.875rem 1rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 0.95rem;
      color: #1a202c;
      transition: all 0.2s ease;
      background: white;
      cursor: pointer;
    }

    .select:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-hint {
      font-size: 0.875rem;
      color: #6b7280;
      margin-top: 0.5rem;
      line-height: 1.5;
    }

    .form-error {
      font-size: 0.875rem;
      color: #dc2626;
      margin-top: 0.5rem;
    }

    /* Radio chips (inline options) */
    .inline-options {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .radio-chip {
      display: flex;
      align-items: center;
      padding: 0.875rem 1.5rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.2s ease;
      background: white;
      font-size: 0.95rem;
      font-weight: 500;
      color: #374151;
    }

    .radio-chip:hover {
      border-color: var(--junspro-purple);
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
    }

    .radio-chip input[type="radio"] {
      display: none;
    }

    .radio-chip input[type="radio"]:checked + span {
      color: var(--junspro-purple);
    }

    .radio-chip input[type="radio"]:checked ~ .radio-chip {
      border-color: var(--junspro-purple);
      background: #f3f4f6;
    }

    .radio-chip:has(input[type="radio"]:checked) {
      border-color: var(--junspro-purple);
      background: #f3f4f6;
      color: var(--junspro-purple);
    }

    /* Info box */
    .info-box {
      margin-top: 3rem;
      padding: 2rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      border-radius: 16px;
      border-left: 4px solid var(--junspro-purple);
    }

    .info-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1a202c;
      margin: 0 0 1.25rem 0;
    }

    .info-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .info-list li {
      padding: 0.75rem 0;
      font-size: 0.95rem;
      color: #374151;
      line-height: 1.7;
      padding-left: 1.75rem;
      position: relative;
    }

    .info-list li::before {
      content: '✓';
      position: absolute;
      left: 0;
      color: var(--junspro-purple);
      font-weight: 600;
      font-size: 1.1rem;
    }

    .info-list li strong {
      color: #1a202c;
      font-weight: 600;
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

      .inline-options {
        flex-direction: column;
      }

      .radio-chip {
        width: 100%;
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

      .info-box {
        padding: 1.5rem;
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
          <h1>{{ __('Agenda & fuseau horaire') }}</h1>
          <p>{{ __('Choisissez comment Junspro affiche les horaires de vos Rituels : fuseau horaire, format d\'heure et vue par défaut. Cela vous évite les décalages et les malentendus avec les freelances.') }}</p>
        </div>

        @if (session('status') === 'agenda-updated' || session('success'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Vos préférences d\'agenda ont été mises à jour.')) }}
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

        <form method="POST" action="{{ route('user.settings.agenda.update') }}" class="settings-form">
          @csrf

          {{-- Fuseau horaire --}}
          <div class="form-group">
            <label for="timezone" class="form-label">{{ __('Fuseau horaire') }}</label>
            <select id="timezone" name="timezone" class="select">
              @foreach($commonTimezones as $tzValue => $tzLabel)
                <option value="{{ $tzValue }}"
                  @if(old('timezone', $settings['timezone'] ?? 'Europe/Paris') === $tzValue) selected @endif>
                  {{ $tzLabel }}
                </option>
              @endforeach
            </select>
            <p class="form-hint">
              {{ __('Tous les horaires de vos Rituels (00h–23h) et de vos rapports seront affichés selon ce fuseau horaire.') }}
            </p>
          </div>

          {{-- Format d'heure --}}
          <div class="form-group">
            <label class="form-label">{{ __('Format d\'heure') }}</label>
            @php
              $timeFormat = old('time_format', $settings['time_format'] ?? '24h');
            @endphp
            <div class="inline-options">
              <label class="radio-chip">
                <input type="radio" name="time_format" value="24h"
                  @if($timeFormat === '24h') checked @endif>
                <span>24h (00:00 – 23:00)</span>
              </label>
              <label class="radio-chip">
                <input type="radio" name="time_format" value="12h"
                  @if($timeFormat === '12h') checked @endif>
                <span>12h (am / pm)</span>
              </label>
            </div>
            <p class="form-hint">
              {{ __('Junspro fonctionne nativement en 24h (00h–23h) pour éviter les confusions, mais vous pouvez choisir le format qui vous convient.') }}
            </p>
          </div>

          {{-- Jour de début de semaine --}}
          <div class="form-group">
            <label class="form-label">{{ __('Début de semaine') }}</label>
            @php
              $weekStart = old('week_start', $settings['week_start'] ?? 'monday');
            @endphp
            <div class="inline-options">
              <label class="radio-chip">
                <input type="radio" name="week_start" value="monday"
                  @if($weekStart === 'monday') checked @endif>
                <span>{{ __('Lundi') }}</span>
              </label>
              <label class="radio-chip">
                <input type="radio" name="week_start" value="sunday"
                  @if($weekStart === 'sunday') checked @endif>
                <span>{{ __('Dimanche') }}</span>
              </label>
            </div>
            <p class="form-hint">
              {{ __('Ce réglage influence l\'affichage de votre calendrier (vue semaine / mois).') }}
            </p>
          </div>

          {{-- Vue par défaut --}}
          <div class="form-group">
            <label for="default_view" class="form-label">{{ __('Vue par défaut de l\'agenda') }}</label>
            @php
              $defaultView = old('default_view', $settings['default_view'] ?? 'week');
            @endphp
            <select id="default_view" name="default_view" class="select">
              <option value="week" @if($defaultView === 'week') selected @endif>
                {{ __('Vue semaine (recommandé)') }}
              </option>
              <option value="month" @if($defaultView === 'month') selected @endif>
                {{ __('Vue mois') }}
              </option>
            </select>
            <p class="form-hint">
              {{ __('La vue semaine est idéale pour suivre les Rituels à venir et garder un bon rythme avec votre freelance.') }}
            </p>
          </div>

          {{-- Bloc pédagogique sur la réservation / reports --}}
          <div class="info-box">
            <h2 class="info-title">{{ __('Comment Junspro utilise ces réglages ?') }}</h2>
            <ul class="info-list">
              <li>
                {{ __('Quand vous réservez un Rituel, les créneaux affichés (00h–23h) sont automatiquement ajustés à votre fuseau horaire.') }}
              </li>
              <li>
                {{ __('Le freelance voit l\'horaire dans son propre fuseau, mais Junspro synchronise les deux pour éviter toute confusion.') }}
              </li>
              <li>
                {{ __('Les rapports envoyés par le freelance sont horodatés avec ce réglage, ce qui facilite le suivi de l\'avancement de vos Rituels.') }}
              </li>
            </ul>
          </div>

          {{-- Actions --}}
          <div class="form-actions">
            <button type="submit" class="btn-primary-gradient">
              <i class="fas fa-save"></i> {{ __('Enregistrer mes préférences') }}
            </button>
          </div>
        </form>
      </main>
    </div>
  </div>

  <script>
    // Gérer l'état visuel des radio chips
    document.addEventListener('DOMContentLoaded', function() {
      const radioChips = document.querySelectorAll('.radio-chip');
      
      radioChips.forEach(chip => {
        const radio = chip.querySelector('input[type="radio"]');
        
        // Mettre à jour visuellement au chargement
        if (radio && radio.checked) {
          chip.style.borderColor = 'var(--junspro-purple)';
          chip.style.background = '#f3f4f6';
          chip.style.color = 'var(--junspro-purple)';
        }
        
        // Mettre à jour visuellement au clic
        chip.addEventListener('click', function() {
          // Désélectionner tous les autres dans le même groupe
          const name = radio.name;
          document.querySelectorAll(`input[name="${name}"]`).forEach(r => {
            r.closest('.radio-chip').style.borderColor = '#e5e7eb';
            r.closest('.radio-chip').style.background = 'white';
            r.closest('.radio-chip').style.color = '#374151';
          });
          
          // Sélectionner celui-ci
          radio.checked = true;
          chip.style.borderColor = 'var(--junspro-purple)';
          chip.style.background = '#f3f4f6';
          chip.style.color = 'var(--junspro-purple)';
        });
      });
    });
  </script>
@endsection

