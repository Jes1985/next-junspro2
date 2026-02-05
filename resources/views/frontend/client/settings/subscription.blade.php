@extends('frontend.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/topup-modal.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/change-plan-modal.css') }}">
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

    /* Header style Preply - Titre aligné à droite */
    .settings-header {
      margin-bottom: 2rem;
      text-align: right;
    }

    .settings-header h1 {
      font-size: 1.75rem;
      font-weight: 700;
      color: #1a202c;
      margin: 0;
    }

    /* Liste de cartes style Preply */
    .subscriptions-list {
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
    }

    .subscription-card-preply {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 1.75rem;
      position: relative;
      transition: all 0.2s ease;
      margin-bottom: 1rem;
    }

    .subscription-card-preply:hover {
      border-color: #d1d5db;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .subscription-card-header {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .subscription-avatar {
      width: 80px;
      height: 80px;
      border-radius: 12px;
      object-fit: cover;
      flex-shrink: 0;
      border: 1px solid #e5e7eb;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .subscription-avatar-initials {
      width: 80px;
      height: 80px;
      border-radius: 12px;
      background: var(--junspro-gradient);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 2rem;
      flex-shrink: 0;
      border: 1px solid #e5e7eb;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .subscription-info {
      flex: 1;
      min-width: 0;
    }

    .subscription-name {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.25rem;
    }

    .subscription-service {
      font-size: 0.9rem;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    .subscription-details-line {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    .subscription-status-badge {
      display: block;
      padding: 0.375rem 0.875rem;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
      margin: 0.75rem auto 0 auto;
      text-align: center;
      width: fit-content;
    }

    .subscription-status-badge.active {
      background: #d1fae5;
      color: #065f46;
    }

    .subscription-status-badge.paused {
      background: #fef3c7;
      color: #92400e;
    }

    .subscription-status-badge.cancelled {
      background: #fee2e2;
      color: #991b1b;
    }

    .subscription-action-box {
      margin-top: 1rem;
      padding-top: 1rem;
      border-top: 1px solid #e5e7eb;
      text-align: center;
    }

    .subscription-action-box-button {
      display: inline-block;
      padding: 0.75rem 1.5rem;
      background: white;
      color: #1a202c;
      border: 1px solid #1a202c;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      width: 100%;
      max-width: 300px;
      text-align: center;
    }

    .subscription-action-box-button:hover {
      background: #1a202c;
      color: white;
      text-decoration: none;
    }

    .subscription-action-box-button.primary {
      background: var(--junspro-gradient);
      color: white;
      border: none;
    }

    .subscription-action-box-button.primary:hover {
      background: var(--junspro-gradient);
      opacity: 0.9;
      color: white;
      text-decoration: none;
    }

    .subscription-action-box-button.danger {
      background: white;
      color: #dc2626;
      border-color: #dc2626;
    }

    .subscription-action-box-button.danger:hover {
      background: #fef2f2;
      color: #991b1b;
      border-color: #991b1b;
      text-decoration: none;
    }

    .subscription-action-button {
      margin-top: 1rem;
      padding: 0.75rem 1.5rem;
      background: white;
      color: #1a202c;
      border: 1px solid #1a202c;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
      width: 100%;
      text-align: center;
    }

    .subscription-action-button:hover {
      background: #1a202c;
      color: white;
      text-decoration: none;
    }

    /* Menu kebab "…" style Preply */
    .subscription-menu {
      position: absolute;
      top: 1rem;
      right: 1rem;
    }

    .subscription-menu-btn {
      background: none;
      border: none;
      color: #6b7280;
      font-size: 1.25rem;
      cursor: pointer;
      padding: 0.5rem;
      border-radius: 6px;
      transition: all 0.2s ease;
      line-height: 1;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .subscription-menu-btn:hover {
      background: #f3f4f6;
      color: #374151;
    }

    /* Amélioration visibilité du bouton kebab sur fond dégradé violet - Scoped uniquement sur la carte abonnement */
    .subscription-card-preply .jspro-subscription-kebab {
      width: 36px;
      height: 36px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.18);
      border-radius: 50%;
      color: #000000;
      font-size: 1.75rem;
      font-weight: 900;
      line-height: 1;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      letter-spacing: -0.05em;
    }

    .subscription-card-preply .jspro-subscription-kebab:hover {
      background: rgba(255, 255, 255, 0.18);
      border-color: rgba(255, 255, 255, 0.25);
      color: #000000;
      transform: scale(1.05);
    }

    .subscription-card-preply .jspro-subscription-kebab:focus {
      outline: 2px solid rgba(255, 255, 255, 0.55);
      outline-offset: 2px;
      background: rgba(255, 255, 255, 0.18);
    }

    .subscription-card-preply .jspro-subscription-kebab:active {
      transform: scale(0.95);
    }

    .subscription-menu-dropdown {
      position: absolute;
      top: 100%;
      right: 0;
      margin-top: 0.5rem;
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      min-width: 240px;
      z-index: 1000;
      display: none;
      overflow: hidden;
    }

    .subscription-menu-dropdown.show {
      display: block;
    }

    .subscription-menu-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1rem;
      color: #374151;
      text-decoration: none;
      font-size: 0.9rem;
      transition: all 0.2s ease;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
    }

    .subscription-menu-item:hover {
      background: #f9fafb;
      color: #1a202c;
    }

    .subscription-menu-item.danger {
      color: #dc2626;
    }

    .subscription-menu-item.danger:hover {
      background: #fef2f2;
      color: #991b1b;
    }

    .subscription-menu-separator {
      height: 1px;
      background: #e5e7eb;
      margin: 0.25rem 0;
    }

    .subscription-menu-icon {
      width: 18px;
      height: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    /* Section Fonctionnement de l'abonnement */
    .subscription-faq-section {
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .subscription-faq-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 1.5rem;
    }

    .subscription-faq-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .subscription-faq-item {
      border-bottom: 1px solid #e5e7eb;
    }

    .subscription-faq-item:last-child {
      border-bottom: none;
    }

    .subscription-faq-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1.25rem 0;
      cursor: pointer;
      transition: all 0.2s ease;
      user-select: none;
    }

    .subscription-faq-header:hover {
      color: var(--junspro-purple);
    }

    .subscription-faq-question {
      font-size: 0.95rem;
      font-weight: 500;
      color: #374151;
      flex: 1;
    }

    .subscription-faq-chevron {
      color: #9ca3af;
      font-size: 0.875rem;
      transition: transform 0.3s ease;
      flex-shrink: 0;
      margin-left: 1rem;
    }

    .subscription-faq-item.active .subscription-faq-chevron {
      transform: rotate(180deg);
      color: var(--junspro-purple);
    }

    .subscription-faq-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease, padding 0.3s ease;
      padding: 0 0 0 0;
    }

    .subscription-faq-item.active .subscription-faq-content {
      max-height: 500px;
      padding: 0 0 1.25rem 0;
    }

    .subscription-faq-answer {
      font-size: 0.9rem;
      color: #6b7280;
      line-height: 1.7;
      padding-top: 0.5rem;
    }

    .subscription-faq-answer p {
      margin-bottom: 0.75rem;
    }

    .subscription-faq-answer p:last-child {
      margin-bottom: 0;
    }

    .subscription-faq-answer strong {
      color: #374151;
      font-weight: 600;
    }

    .subscription-faq-answer ul {
      margin: 0.75rem 0;
      padding-left: 1.5rem;
    }

    .subscription-faq-answer li {
      margin-bottom: 0.5rem;
    }

    /* Empty state */
    .empty-state {
      text-align: center;
      padding: 4rem 2rem;
      color: #6b7280;
    }

    .empty-state-icon {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      opacity: 0.5;
      color: var(--junspro-purple);
    }

    .empty-state-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
    }

    .empty-state-text {
      font-size: 1rem;
      margin-bottom: 2rem;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
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

      .settings-header {
        text-align: left;
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

      .subscription-card-preply {
        padding: 1rem;
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
        <!-- En-tête style Preply - Titre aligné à droite -->
        <div class="settings-header">
          <h1>{{ __('Gérez vos abonnements') }}</h1>
        </div>

        @if (session('status') === 'subscription-paused' || (session('success') && session('status') === 'subscription-paused'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Votre abonnement a été mis en pause.')) }}
          </div>
        @endif

        @if (session('status') === 'subscription-resumed' || (session('success') && session('status') === 'subscription-resumed'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Votre abonnement a été repris.')) }}
          </div>
        @endif

        @if (session('status') === 'subscription-cancelled' || (session('success') && session('status') === 'subscription-cancelled'))
          <div class="alert alert-success">
            ✅ {{ session('success', __('Votre abonnement a été annulé.')) }}
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-error">
            ⚠️ {{ session('error') }}
          </div>
        @endif

        @if($subscriptions && $subscriptions->count() > 0)
          <div class="subscriptions-list">
          @foreach($subscriptions as $subscription)
            @php
              $freelancer = $subscription->freelancer->user ?? null;
                $freelancerName = $freelancer ? ($freelancer->first_name . ' ' . $freelancer->last_name) : 'Freelance';
              $nextBillingDate = $subscription->next_billing_at ? \Carbon\Carbon::parse($subscription->next_billing_at) : null;
                $daysUntilRenewal = $nextBillingDate ? now()->diffInDays($nextBillingDate, false) : null;
                $hoursRemaining = $subscription->calculated_hours_remaining ?? 0;
            @endphp

              <div class="subscription-card-preply">
                <!-- Menu kebab "…" -->
                <div class="subscription-menu">
                  <button class="subscription-menu-btn jspro-subscription-kebab" type="button" onclick="toggleMenu({{ $subscription->id }})" aria-label="{{ __('Actions') }}">
                    ⋯
                  </button>
                  <div class="subscription-menu-dropdown" id="menu-{{ $subscription->id }}">
                    @if($subscription->status === 'paused')
                      <form method="POST" action="{{ route('user.settings.subscription.resume', $subscription->id) }}">
                        @csrf
                        <button type="submit" class="subscription-menu-item">
                          <span class="subscription-menu-icon"><i class="fas fa-play"></i></span>
                          <span>{{ __('S\'abonner à nouveau') }}</span>
                        </button>
                      </form>
                    @endif
                    
                    <button 
                      type="button"
                      class="subscription-menu-item"
                      onclick="openTopUpModal({
                        subscriptionId: {{ $subscription->id }},
                        tutorName: '{{ addslashes($freelancerName) }}',
                        avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/' . $freelancer->image) : '' }}',
                        unitPrice: {{ $subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0 }},
                        scheduleUntil: '{{ $nextBillingDate ? $nextBillingDate->format('d M Y') : '' }}',
                        postUrl: '{{ route('user.account.subscriptions.topup', $subscription->id) }}',
                        quotaUrl: '{{ route('user.account.subscriptions.topup-quota', $subscription->id) }}',
                        csrf: '{{ csrf_token() }}',
                        ritualSignature: '{{ addslashes($ritualSignature ?? '') }}',
                        upgradeDetails: '{{ __('Passez de') }} {{ $subscription->hours_per_week }} {{ __('Rituels/semaine') }} {{ __('à') }} {{ min(24, $subscription->hours_per_week + 1) }} {{ __('Rituels/semaine') }}'
                      }); toggleMenu({{ $subscription->id }});"
                    >
                      <span class="subscription-menu-icon"><i class="fas fa-plus-circle"></i></span>
                      <span>{{ __('Ajouter des Rituels supplémentaires') }}</span>
                    </button>
                    
                    <button 
                      type="button"
                      class="subscription-menu-item"
                      onclick="openChangePlanFlow({
                        subscriptionId: {{ $subscription->id }},
                        tutorName: '{{ addslashes($freelancerName) }}',
                        avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/' . $freelancer->image) : '' }}',
                        currentHours: {{ $subscription->hours_per_week }},
                        currentPrice: {{ $subscription->price_base ?? 0 }},
                        unitPrice: {{ $subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0 }},
                        nextBillingDate: '{{ $nextBillingDate ? $nextBillingDate->format('Y-m-d H:i:s') : '' }}',
                        contextUrl: '{{ route('user.account.subscriptions.change-plan-context', $subscription->id) }}',
                        submitUrl: '{{ route('user.account.subscriptions.change-plan', $subscription->id) }}',
                        csrf: '{{ csrf_token() }}'
                      }); toggleMenu({{ $subscription->id }});"
                    >
                      <span class="subscription-menu-icon"><i class="fas fa-exchange-alt"></i></span>
                      <span>{{ __('Changer de formule') }}</span>
                    </button>
                    
                    <button 
                      type="button"
                      class="subscription-menu-item"
                      onclick="openTransferEntryModal({
                        subscriptionId: {{ $subscription->id }},
                        tutorName: '{{ addslashes($freelancerName) }}',
                        avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/' . $freelancer->image) : '' }}',
                        credit: {{ $subscription->hours_remaining ?? 0 }},
                        creditAmount: {{ ($subscription->hours_remaining ?? 0) * ($subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0) }}
                      }); toggleMenu({{ $subscription->id }});"
                    >
                      <span class="subscription-menu-icon"><i class="fas fa-share-alt"></i></span>
                      <span>{{ __('Transférer le solde ou un abonnement') }}</span>
                    </button>
                    
                    <div class="subscription-menu-separator"></div>
                    
                    @if($subscription->status === 'active')
                      <form method="POST" action="{{ route('user.settings.subscription.pause', $subscription->id) }}">
                        @csrf
                        <button type="submit" class="subscription-menu-item">
                          <span class="subscription-menu-icon"><i class="fas fa-pause"></i></span>
                          <span>{{ __('Mettre l\'abonnement en pause') }}</span>
                        </button>
                      </form>
                    @elseif($subscription->status === 'paused')
                      <form method="POST" action="{{ route('user.settings.subscription.resume', $subscription->id) }}">
                        @csrf
                        <button type="submit" class="subscription-menu-item">
                          <span class="subscription-menu-icon"><i class="fas fa-play"></i></span>
                          <span>{{ __('Reprendre l\'abonnement') }}</span>
                        </button>
                      </form>
                    @endif
                    
                    <div class="subscription-menu-separator"></div>
                    
                    <button 
                      type="button"
                      class="subscription-menu-item danger"
                      onclick="openSubscriptionCancelFlow({
                        subscriptionId: {{ $subscription->id }},
                        tutorName: '{{ addslashes($freelancerName) }}',
                        avatarUrl: '{{ $freelancer && $freelancer->image ? asset('assets/img/users/' . $freelancer->image) : '' }}'
                      }); toggleMenu({{ $subscription->id }});"
                    >
                        <span class="subscription-menu-icon"><i class="fas fa-times"></i></span>
                        <span>{{ __('Annuler l\'abonnement') }}</span>
                      </button>
                </div>
                </div>

                <!-- Contenu de la carte style Preply -->
                <div class="subscription-card-header">
                  @if($freelancer && $freelancer->image)
                    <img src="{{ asset('assets/img/users/' . $freelancer->image) }}" 
                         alt="{{ $freelancerName }}" 
                         class="subscription-avatar"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="subscription-avatar-initials" style="display: none;">
                      @php
                        $nameParts = explode(' ', $freelancerName);
                        $initials = count($nameParts) >= 2 
                          ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[count($nameParts) - 1], 0, 1))
                          : strtoupper(substr($freelancerName, 0, 2));
                      @endphp
                      {{ $initials }}
                </div>
                      @else
                    <div class="subscription-avatar-initials">
                      @php
                        $nameParts = explode(' ', $freelancerName);
                        $initials = count($nameParts) >= 2 
                          ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[count($nameParts) - 1], 0, 1))
                          : strtoupper(substr($freelancerName, 0, 2));
                      @endphp
                      {{ $initials }}
                  </div>
                @endif

                  <div class="subscription-info">
                    <div class="subscription-name">{{ $freelancerName }}</div>
                    @php
                      $freelancerProfile = $subscription->freelancer ?? null;
                      $serviceName = 'Service';
                      if ($freelancerProfile && isset($freelancerProfile->user)) {
                        $bio = $freelancerProfile->user->freelancerProfile->bio ?? null;
                        if ($bio) {
                          $serviceName = \Illuminate\Support\Str::limit($bio, 25);
                        } else {
                          $serviceName = 'Abonnement';
                        }
                      }
                      $priceBase = $subscription->price_base ?? 0;
                      $formattedPrice = number_format($priceBase, 2, ',', ' ');
                  @endphp
                    <div class="subscription-service">
                      {{ $serviceName }} | {{ $subscription->hours_per_week }} {{ __('Rituels/semaine') }} (= {{ $subscription->hours_per_week }}h) – {{ $formattedPrice }} € {{ __('toutes les 4 semaines') }}
                    </div>
                    @if(!empty($ritualSignature))
                      <p class="subscription-ritual-signature" style="font-size: 0.75rem; color: #6b7280; margin: 0.25rem 0 0 0;">{{ $ritualSignature }}</p>
                    @endif
                    <div class="subscription-details-line">
                      @if($nextBillingDate)
                        @php
                          $months = ['janv.', 'févr.', 'mars', 'avr.', 'mai', 'juin', 'juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.'];
                          $monthIndex = (int)$nextBillingDate->format('n') - 1;
                          $formattedDate = $nextBillingDate->format('d') . ' ' . $months[$monthIndex] . ' ' . $nextBillingDate->format('Y');
                        @endphp
                          Renouvellement le {{ $formattedDate }} |
                      @endif
                      {{ number_format($hoursRemaining, 1) }} {{ __('Rituels restants') }} (= {{ number_format($hoursRemaining, 1) }}h)
                  </div>
                    @if(isset($subscription->nudge_show) && $subscription->nudge_show && !empty($subscription->nudge_message))
                      <p class="subscription-nudge-helper" style="font-size: 0.8rem; color: #6b7280; margin-top: 0.5rem; font-style: italic;">{{ $subscription->nudge_message }}</p>
                    @endif
                    <div style="display: flex; justify-content: center; margin-top: 0.75rem;">
                      <span class="subscription-status-badge {{ $subscription->status === 'active' ? 'active' : ($subscription->status === 'paused' ? 'paused' : 'cancelled') }}">
                        @if($subscription->status === 'active')
                          {{ __('Actif') }}
                        @elseif($subscription->status === 'paused')
                          {{ __('En pause') }}
                        @else
                          {{ __('Abonnement annulé') }}
                @endif
                      </span>
              </div>
                  </div>
                  </div>

                <!-- Encadrement action selon la situation -->
                <div class="subscription-action-box">
                  @if($subscription->status === 'cancelled')
                    <a href="{{ route('client.subscriptions.show', $subscription->id) }}" class="subscription-action-box-button primary">
                      {{ __('S\'abonner') }}
                    </a>
                  @elseif($subscription->status === 'active' && $nextBillingDate && $daysUntilRenewal !== null)
                    @php
                      $daysRounded = round($daysUntilRenewal);
                    @endphp
                    @if($daysRounded <= 7 && $daysRounded >= 0)
                      <button type="button" class="subscription-action-box-button" data-renew-subscription="{{ $subscription->id }}">
                        {{ __('Renouveler l\'abonnement') }}
                    </button>
                    @endif
                @elseif($subscription->status === 'paused')
                  <form method="POST" action="{{ route('user.settings.subscription.resume', $subscription->id) }}" style="display: inline;">
                    @csrf
                      <button type="submit" class="subscription-action-box-button primary">
                        {{ __('Reprendre l\'abonnement') }}
                    </button>
                  </form>
                @endif
              </div>
            </div>
          @endforeach
            </div>
        @else
          <div class="empty-state">
            <div class="empty-state-icon">
              <i class="far fa-calendar-check"></i>
            </div>
            <div class="empty-state-title">{{ __('Aucun abonnement actif') }}</div>
            <div class="empty-state-text">
              {{ __("Vous n'avez pas encore d'abonnement actif. Découvrez nos freelances et trouvez celui qui correspond à vos projets.") }}
            </div>
            <a href="{{ route('explore') ?? '#' }}" class="subscription-action-button">
              <i class="fas fa-search"></i> {{ __('Découvrir les freelances') }}
            </a>
          </div>
        @endif

        <!-- Section Fonctionnement de l'abonnement -->
        <div class="subscription-faq-section">
          <h2 class="subscription-faq-title">{{ __('Fonctionnement de l\'abonnement') }}</h2>
          <ul class="subscription-faq-list">
            <!-- Item 1: Rechargement du solde et facturation -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Rechargement du solde et facturation') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Facturation mensuelle') }}</strong></p>
                  <p>{{ __('Votre abonnement est facturé automatiquement toutes les 4 semaines. Le montant correspond à votre formule (Rituels par semaine × tarif × 4 semaines).') }}</p>
                  <p><strong>{{ __('Rituels restants') }}</strong></p>
                  <p>{{ __('Les Rituels non utilisés s\'accumulent dans votre solde. Vous pouvez les utiliser à tout moment, même après le renouvellement de votre abonnement.') }}</p>
                  <p><strong>{{ __('Ajout de Rituels supplémentaires') }}</strong></p>
                  <p>{{ __('Vous pouvez ajouter des Rituels supplémentaires à tout moment depuis la page de gestion de votre abonnement. Ils sont facturés au tarif Rituel de votre freelance.') }}</p>
                </div>
              </div>
            </li>

            <!-- Item 2: Programmation des sessions -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Programmation des sessions') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Sessions de travail') }}</strong></p>
                  <p>{{ __('Chaque Rituel dure 50 minutes de travail effectif + 10 minutes de rapport détaillé. Un Rituel complet consomme 1 Rituel de votre abonnement.') }}</p>
                  <p><strong>{{ __('Planification') }}</strong></p>
                  <p>{{ __('Vous pouvez planifier vos sessions en fonction de la disponibilité de votre freelance. Les sessions peuvent être programmées à l\'avance selon le calendrier de votre freelance.') }}</p>
                  <p><strong>{{ __('Reprogrammation') }}</strong></p>
                  <p>{{ __('Vous pouvez reprogrammer une session une fois, sous réserve de disponibilité. La reprogrammation doit être effectuée au moins 24h avant la session prévue.') }}</p>
                </div>
              </div>
            </li>

            <!-- Item 3: Annulation et remboursement -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Annulation et remboursement') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Annulation d\'abonnement') }}</strong></p>
                  <p>{{ __('Vous pouvez annuler votre abonnement à tout moment depuis cette page. L\'annulation prend effet à la fin de votre période de facturation en cours.') }}</p>
                  <p><strong>{{ __('Remboursement') }}</strong></p>
                  <p>{{ __('Les Rituels déjà payés et non utilisés peuvent être remboursés selon nos conditions générales. Les Rituels déjà consommés ne sont pas remboursables.') }}</p>
                  <p><strong>{{ __('Rituels restants après annulation') }}</strong></p>
                  <p>{{ __('Vos Rituels restants restent disponibles pendant 30 jours après l\'annulation. Passé ce délai, ils expirent.') }}</p>
                </div>
              </div>
            </li>

            <!-- Item 4: Mettre en pause -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Mettre votre abonnement en pause') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Mise en pause') }}</strong></p>
                  <p>{{ __('Vous pouvez mettre votre abonnement en pause à tout moment. Pendant la pause, aucune nouvelle facturation n\'est effectuée et aucune nouvelle session ne peut être planifiée.') }}</p>
                  <p><strong>{{ __('Heures pendant la pause') }}</strong></p>
                  <p>{{ __('Vos Rituels restants sont conservés pendant la pause. Vous pouvez les utiliser dès la reprise de votre abonnement.') }}</p>
                  <p><strong>{{ __('Reprendre l\'abonnement') }}</strong></p>
                  <p>{{ __('Vous pouvez reprendre votre abonnement à tout moment. La facturation reprendra au prochain cycle de facturation.') }}</p>
                </div>
              </div>
            </li>

            <!-- Item 5: Modifier la formule -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Diminuer ou augmenter le nombre d\'heures de l\'abonnement') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Changement de formule') }}</strong></p>
                  <p>{{ __('Vous pouvez modifier votre formule (Rituels par semaine) depuis la page de gestion de votre abonnement. Les formules disponibles sont : 1, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20 ou 24 Rituels par semaine.') }}</p>
                  <p><strong>{{ __('Effet du changement') }}</strong></p>
                  <p>{{ __('Le changement de formule prend effet au prochain cycle de facturation. Votre facture sera ajustée en fonction de la nouvelle formule.') }}</p>
                  <p><strong>{{ __('Heures existantes') }}</strong></p>
                  <p>{{ __('Vos Rituels restants actuels sont conservés et s\'ajoutent aux nouveaux Rituels de votre nouvelle formule.') }}</p>
                </div>
              </div>
            </li>

            <!-- Item 6: Transférer -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question">{{ __('Transférer votre solde et votre abonnement à un nouveau freelance') }}</span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong>{{ __('Transfert d\'abonnement') }}</strong></p>
                  <p>{{ __('Vous pouvez transférer votre solde d\'heures et votre abonnement vers un nouveau freelance si cette fonctionnalité est activée pour votre compte.') }}</p>
                  <p><strong>{{ __('Conditions') }}</strong></p>
                  <p>{{ __('Le transfert est possible uniquement si votre abonnement actuel le permet. Les Rituels restants sont transférés au nouveau freelance au tarif de ce dernier.') }}</p>
                  <p><strong>{{ __('Processus') }}</strong></p>
                  <p>{{ __('Contactez notre support pour initier un transfert. Le processus nécessite l\'accord des deux freelances concernés et peut prendre quelques jours.') }}</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </main>
    </div>
  </div>

  <script>
    // Gestion du menu dropdown
    function toggleMenu(subscriptionId) {
      const menu = document.getElementById('menu-' + subscriptionId);
      const isOpen = menu.classList.contains('show');
      
      // Fermer tous les autres menus
      document.querySelectorAll('.subscription-menu-dropdown').forEach(m => {
        m.classList.remove('show');
      });
      
      // Ouvrir/fermer le menu cliqué
      if (!isOpen) {
        menu.classList.add('show');
      }
    }

    // Fermer le menu au clic dehors
    document.addEventListener('click', function(event) {
      if (!event.target.closest('.subscription-menu')) {
        document.querySelectorAll('.subscription-menu-dropdown').forEach(menu => {
          menu.classList.remove('show');
        });
      }
    });

    // Fermer le menu avec ESC
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        document.querySelectorAll('.subscription-menu-dropdown').forEach(menu => {
          menu.classList.remove('show');
        });
      }
    });

    // Gestion des items FAQ expandables
    function toggleFaqItem(header) {
      const item = header.closest('.subscription-faq-item');
      const isActive = item.classList.contains('active');
      
      // Fermer tous les autres items
      document.querySelectorAll('.subscription-faq-item').forEach(faqItem => {
        faqItem.classList.remove('active');
      });
      
      // Ouvrir/fermer l'item cliqué
      if (!isActive) {
        item.classList.add('active');
      }
    }
  </script>

  {{-- Modal de renouvellement d'abonnement --}}
  @include('components.subscription-renew-modal')

  {{-- Script du modal --}}
  <script src="{{ asset('assets/js/subscription-renew-modal.js') }}"></script>

  {{-- Modal d'ajout d'heures supplémentaires --}}
  <x-subscription.topup-modal />

  {{-- Modal de changement de formule --}}
  <x-subscription.change-plan-root />
  
  {{-- Modal de transfert (nouvelle structure) --}}
  <x-subscription.transfer.entry />
  
  {{-- Flow Remplacer : Étapes 1, 2, 3, 4 --}}
  <x-subscription.transfer.replace.step1-select-freelance />
  <x-subscription.transfer.replace.step2-pick-plan />
  <x-subscription.transfer.replace.step3-confirm />
  <x-subscription.transfer.replace.step4-payment />
  
  {{-- Flow Ajouter : Étapes 2, 3, 4, 5, 6 --}}
  <x-subscription.transfer.add.step2-select-freelance />
  <x-subscription.transfer.add.step3-pick-qty />
  <x-subscription.transfer.add.step4-pick-plan />
  <x-subscription.transfer.add.step5-confirm />
  <x-subscription.transfer.add.step6-payment />
  
  {{-- Flow Transférer vers actif : Étapes 2, 3, 4, 5 --}}
  <x-subscription.transfer.active.step2-select-freelance />
  <x-subscription.transfer.active.step3-pick-qty />
  <x-subscription.transfer.active.step4-confirm />
  <x-subscription.transfer.active.step5-success />
  
  {{-- Flow Annulation : Étapes 1, 2, 3, 4 --}}
  <x-subscription.cancel.step1-prevention />
  <x-subscription.cancel.step2-reason />
  <x-subscription.cancel.step3-confirm />
  <x-subscription.cancel.step4-alternative />

  {{-- Script Alpine.js pour les modals --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="{{ asset('assets/js/subscriptions/topupModal.js') }}?v={{ filemtime(public_path('assets/js/subscriptions/topupModal.js')) }}"></script>
  <script src="{{ asset('assets/js/subscriptions/changePlanFlow.js') }}?v={{ filemtime(public_path('assets/js/subscriptions/changePlanFlow.js')) }}"></script>
  
  <script>
    // Fonction pour ouvrir la modal de transfert (nouvelle structure)
    function openTransferEntryModal(payload) {
      // Déclencher l'événement pour ouvrir la modal
      window.dispatchEvent(new CustomEvent('openTransferEntryModal', {
        detail: payload
      }));
    }
 
    // Fonction pour ouvrir le flow d'annulation
    function openSubscriptionCancelFlow(payload) {
      window.dispatchEvent(new CustomEvent('openSubscriptionCancelStep1', {
        detail: {
        subscriptionId: payload.subscriptionId,
          tutorName: payload.tutorName,
          tutorAvatar: payload.avatarUrl
        }
      }));
    }
  </script>
@endsection
