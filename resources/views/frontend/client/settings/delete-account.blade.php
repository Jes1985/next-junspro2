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

    .settings-header h1.text-danger {
      color: #dc2626;
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

    .alert-error {
      background: #fef2f2;
      color: #dc2626;
      border: 1px solid #fca5a5;
    }

    /* Warning box */
    .warning-box {
      margin: 2rem 0;
      padding: 2rem;
      background: #fef2f2;
      border-radius: 16px;
      border-left: 4px solid #dc2626;
    }

    .warning-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #991b1b;
      margin: 0 0 1rem 0;
    }

    .warning-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .warning-list li {
      padding: 0.75rem 0;
      padding-left: 1.5rem;
      position: relative;
      color: #374151;
      line-height: 1.6;
    }

    .warning-list li:before {
      content: "⚠️";
      position: absolute;
      left: 0;
    }

    .info-text {
      font-size: 0.95rem;
      color: #374151;
      line-height: 1.7;
      margin: 1.5rem 0;
    }

    .info-text a {
      color: var(--junspro-purple);
      text-decoration: underline;
    }

    .info-text a:hover {
      color: var(--junspro-blue);
    }

    .settings-divider {
      border: none;
      border-top: 1px solid #e5e7eb;
      margin: 2.5rem 0;
    }

    /* Formulaires */
    .settings-form {
      margin-top: 2rem;
    }

    .form-group {
      margin-bottom: 2rem;
    }

    .form-group label {
      display: block;
      font-size: 0.95rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.5rem;
    }

    .form-group input[type="password"],
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 0.95rem;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
    }

    .form-error {
      font-size: 0.875rem;
      color: #dc2626;
      margin-top: 0.5rem;
    }

    .form-hint {
      font-size: 0.875rem;
      color: #6b7280;
      margin-top: 0.5rem;
      line-height: 1.5;
    }

    /* Checkbox */
    .checkbox-group {
      margin-bottom: 2rem;
    }

    .checkbox-label {
      display: flex;
      align-items: flex-start;
      cursor: pointer;
      gap: 1rem;
    }

    .checkbox-label input[type="checkbox"] {
      display: none;
    }

    .checkbox-box {
      width: 24px;
      height: 24px;
      border: 2px solid #d1d5db;
      border-radius: 6px;
      background: white;
      flex-shrink: 0;
      margin-top: 2px;
      transition: all 0.2s ease;
      position: relative;
    }

    .checkbox-label input[type="checkbox"]:checked + .checkbox-box {
      background: var(--junspro-purple);
      border-color: var(--junspro-purple);
    }

    .checkbox-label input[type="checkbox"]:checked + .checkbox-box:after {
      content: "✓";
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      font-size: 0.875rem;
      font-weight: bold;
    }

    .checkbox-text {
      font-size: 0.95rem;
      color: #374151;
      line-height: 1.6;
    }

    /* Radio options */
    .radio-group {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    .radio-option {
      display: flex;
      align-items: flex-start;
      cursor: pointer;
      padding: 0.75rem;
      border-radius: 10px;
      transition: all 0.2s ease;
      border: 2px solid #e5e7eb;
      background: white;
    }

    .radio-option:hover {
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      border-color: #d1d5db;
    }

    .radio-option input[type="radio"] {
      display: none;
    }

    .radio-option input[type="radio"]:checked + .radio-text {
      color: var(--junspro-purple);
      font-weight: 600;
    }

    .radio-option input[type="radio"]:checked ~ .radio-text {
      color: var(--junspro-purple);
      font-weight: 600;
    }

    .radio-option input[type="radio"]:checked ~ .radio-text:before {
      border-color: var(--junspro-purple);
      background: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .radio-option input[type="radio"]:checked ~ .radio-text:after {
      content: "";
      position: absolute;
      left: 5px;
      top: 50%;
      transform: translateY(-50%);
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: white;
    }

    .radio-option:has(input[type="radio"]:checked) {
      background: #f3f4f6;
      border-color: var(--junspro-purple);
    }

    .radio-text {
      font-size: 0.95rem;
      color: #374151;
      line-height: 1.5;
      position: relative;
      padding-left: 1.75rem;
      flex: 1;
    }

    .radio-text:before {
      content: "";
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 18px;
      height: 18px;
      border: 2px solid #d1d5db;
      border-radius: 50%;
      background: white;
      transition: all 0.2s ease;
    }

    .other-reason-field textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 0.95rem;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .other-reason-field textarea:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    /* Buttons */
    .form-actions {
      display: flex;
      gap: 1rem;
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .form-actions-danger {
      flex-direction: column;
      align-items: stretch;
    }

    .btn {
      padding: 0.875rem 1.75rem;
      border-radius: 12px;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
      border: 2px solid transparent;
      text-align: center;
    }

    .btn-danger {
      background: #dc2626;
      color: white;
      border: none;
    }

    .btn-danger:hover {
      background: #b91c1c;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    .btn-ghost {
      background: white;
      color: #6b7280;
      border: 2px solid #e5e7eb;
    }

    .btn-ghost:hover {
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      border-color: #d1d5db;
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

      .settings-menu-item a.danger-link.active {
        border-bottom-color: #dc2626;
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

      .warning-box {
        padding: 1.5rem;
      }

      .form-actions {
        flex-direction: column;
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
          <li class="settings-menu-item">            <a href="{{ route('user.service_orders') }}" class="{{ request()->routeIs('user.service_orders') || request()->routeIs('user.service_order.details') ? 'active' : '' }}">
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
          <li class="settings-menu-item">            @php
              try {
                $deleteAccountUrl = route('user.settings.delete_account');
              } catch (\Exception $e) {
                $deleteAccountUrl = url('/user/settings/delete-account');
              }
            @endphp
            <a href="{{ $deleteAccountUrl }}" class="danger-link {{ request()->routeIs('user.settings.delete_account*') ? 'active' : '' }}">
              {{ __('Supprimer le compte') }}
            </a>
          </li>
        </ul>
      </aside>

      <!-- Contenu principal droite -->
      <main class="settings-content">
        @php
          $user = Auth::guard('web')->user();
        @endphp

        <!-- En-tête -->
        <div class="settings-header">
          <h1 class="text-danger">{{ __('Supprimer mon compte Junspro') }}</h1>
          <p>{{ __('Cette action est définitive. Une fois votre compte supprimé, vous ne pourrez plus accéder à votre tableau de bord Junspro. Lisez attentivement les informations ci-dessous avant de confirmer.') }}</p>
        </div>

        @if (session('error'))
          <div class="alert alert-error">
            ⚠️ {!! session('error') !!}
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

        <!-- Warning box -->
        <div class="warning-box">
          <h2 class="warning-title">{{ __('Ce qui va se passer :') }}</h2>
          <ul class="warning-list">
            <li>{{ __('Votre accès au tableau de bord Junspro sera désactivé (Rituels, messages, agenda…).') }}</li>
            <li>{{ __('Vos abonnements en cours seront résiliés ou clôturés selon les conditions de votre formule.') }}</li>
            <li>{{ __('Vos factures et informations de paiement pourront être conservées à des fins légales (comptabilité, obligations réglementaires).') }}</li>
            <li>{{ __('Les freelances avec lesquels vous travaillez ne pourront plus planifier de nouveaux Rituels via votre compte.') }}</li>
          </ul>
        </div>

        <p class="info-text">
          {{ __('Si vous souhaitez simplement faire une pause, vous pouvez d\'abord') }}
          <a href="{{ route('user.settings.subscription') }}">{{ __('mettre votre abonnement en pause') }}</a>
          {{ __('ou réduire votre rythme de Rituels, plutôt que de supprimer définitivement votre compte.') }}
        </p>

        <hr class="settings-divider">

        <form method="POST" action="{{ route('user.settings.delete_account.destroy') }}" class="settings-form">
          @csrf

          <!-- Mot de passe actuel -->
          <div class="form-group">
            <label for="current_password">{{ __('Mot de passe actuel') }}</label>
            <input
              id="current_password"
              type="password"
              name="current_password"
              autocomplete="current-password"
              required
              class="@error('current_password') border-red-500 @enderror"
            >
            @error('current_password')
              <p class="form-error">{{ $message }}</p>
            @enderror
          </div>

          <!-- Confirmation via case à cocher -->
          <div class="form-group checkbox-group">
            <label class="checkbox-label">
              <input type="checkbox" name="confirmation" value="1" required>
              <span class="checkbox-box"></span>
              <span class="checkbox-text">
                {{ __('Je comprends que la suppression de mon compte Junspro est définitive et que je ne pourrai plus accéder à mon tableau de bord.') }}
              </span>
            </label>
            @error('confirmation')
              <p class="form-error">{{ $message }}</p>
            @enderror
          </div>

          <!-- Raison -->
          <div class="form-group">
            <label>{{ __('Raison de votre départ') }}</label>
            <div class="radio-group">
              @php
                $selectedReason = old('reason_type', '');
                $selectedOther = old('reason_other', '');
              @endphp
              
              <label class="radio-option">
                <input type="radio" name="reason_type" value="no_longer_needed" {{ $selectedReason === 'no_longer_needed' ? 'checked' : '' }}>
                <span class="radio-text">{{ __('Je n\'ai plus besoin du Rituel pour le moment') }}</span>
              </label>

              <label class="radio-option">
                <input type="radio" name="reason_type" value="too_expensive" {{ $selectedReason === 'too_expensive' ? 'checked' : '' }}>
                <span class="radio-text">{{ __('Le Rituel est trop cher pour mon budget') }}</span>
              </label>

              <label class="radio-option">
                <input type="radio" name="reason_type" value="prefer_other_service" {{ $selectedReason === 'prefer_other_service' ? 'checked' : '' }}>
                <span class="radio-text">{{ __('Je préfère utiliser un autre service') }}</span>
              </label>

              <label class="radio-option">
                <input type="radio" name="reason_type" value="quality_issues" {{ $selectedReason === 'quality_issues' ? 'checked' : '' }}>
                <span class="radio-text">{{ __('Je n\'étais pas satisfait de la qualité du service') }}</span>
              </label>

              <label class="radio-option">
                <input type="radio" name="reason_type" value="personal_reasons" {{ $selectedReason === 'personal_reasons' ? 'checked' : '' }}>
                <span class="radio-text">{{ __('Raisons personnelles ou changement de situation') }}</span>
              </label>

              <label class="radio-option">
                <input type="radio" name="reason_type" value="other" id="reason_type_other" {{ $selectedReason === 'other' ? 'checked' : '' }}>
                <span class="radio-text">{{ __('Autre') }}</span>
              </label>
              
              <!-- Champ texte pour "Autre" -->
              <div class="other-reason-field" id="other_reason_field" style="display: {{ $selectedReason === 'other' ? 'block' : 'none' }}; margin-top: 1rem; margin-left: 2rem;">
                <textarea
                  id="reason_other"
                  name="reason_other"
                  rows="3"
                  placeholder="{{ __('Précisez votre raison…') }}"
                >{{ $selectedOther }}</textarea>
                @error('reason_other')
                  <p class="form-error">{{ $message }}</p>
                @enderror
              </div>
            </div>
            @error('reason_type')
              <p class="form-error">{{ $message }}</p>
            @enderror
            <p class="form-hint">
              {{ __('Votre feedback nous aide à améliorer Junspro pour les autres utilisateurs.') }}
            </p>
          </div>

          <div class="form-actions form-actions-danger">
            <button type="submit" class="btn btn-danger">
              {{ __('Supprimer mon compte définitivement') }}
            </button>

            <a href="{{ route('user.settings.index') }}" class="btn btn-ghost">
              {{ __('Annuler et revenir aux paramètres') }}
            </a>
          </div>
        </form>
      </main>
    </div>
  </div>

  <script>
    // Gérer l'affichage du champ "Autre" quand l'option est sélectionnée
    document.addEventListener('DOMContentLoaded', function() {
      const otherRadio = document.getElementById('reason_type_other');
      const otherField = document.getElementById('other_reason_field');
      const reasonOtherInput = document.getElementById('reason_other');
      
      if (otherRadio && otherField) {
        // Fonction pour mettre à jour l'affichage
        function updateOtherField() {
          if (otherRadio.checked) {
            otherField.style.display = 'block';
            if (reasonOtherInput) {
              reasonOtherInput.focus();
            }
          } else {
            otherField.style.display = 'none';
            if (reasonOtherInput) {
              reasonOtherInput.value = '';
            }
          }
        }
        
        // Vérifier l'état initial
        updateOtherField();
        
        // Écouter les changements sur tous les radio buttons
        document.querySelectorAll('input[name="reason_type"]').forEach(function(radio) {
          radio.addEventListener('change', function() {
            // Mettre à jour le style des options radio
            document.querySelectorAll('.radio-option').forEach(function(option) {
              const radioInOption = option.querySelector('input[type="radio"]');
              if (radioInOption && radioInOption.checked) {
                option.style.background = '#f3f4f6';
                option.style.borderColor = '#7C3AED';
              } else {
                option.style.background = 'white';
                option.style.borderColor = '#e5e7eb';
              }
            });
            
            // Mettre à jour le champ "Autre"
            updateOtherField();
          });
        });
        
        // Initialiser le style des options radio
        document.querySelectorAll('.radio-option').forEach(function(option) {
          const radioInOption = option.querySelector('input[type="radio"]');
          if (radioInOption && radioInOption.checked) {
            option.style.background = '#f3f4f6';
            option.style.borderColor = '#7C3AED';
          }
        });
      }
    });
  </script>
@endsection

