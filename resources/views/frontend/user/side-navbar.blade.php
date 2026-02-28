<div class="col-lg-3">
  <aside class="settings-sidebar">
    @php
      if (!isset($basicInfo)) {
        $basicInfo = \App\Models\BasicSettings\Basic::first();
      }
    @endphp
    <style>
      .settings-sidebar {
        background: #FFFFFF;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
      }

      .settings-sidebar-title {
        background: #FFFFFF;
        color: #6B7280;
        padding: 1.5rem 1.5rem 0.5rem 1.5rem;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        text-transform: uppercase;
      }

      .settings-menu {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .settings-menu-item {
        padding: 0;
        margin: 0;
      }

      .settings-menu-item a {
        display: block;
        padding: 1rem 1.5rem;
        color: #4B5563;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
        background: #FFFFFF;
      }

      .settings-menu-item a:hover {
        background: #F3F4F6;
        color: #7C3AED;
        border-left-color: #7C3AED;
      }

      .settings-menu-item a.active {
        background: #F3F4F6;
        color: #7C3AED;
        border-left-color: #7C3AED;
      }

      .settings-menu-item a.danger-link {
        color: #DC2626 !important;
      }

      .settings-menu-item a.danger-link:hover {
        background: #FEE2E2;
        color: #B91C1C !important;
        border-left-color: #DC2626;
      }
    </style>

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
        <a href="{{ $deleteAccountUrl }}" class="danger-link {{ request()->routeIs('user.settings.delete_account*') ? 'active' : '' }}">
          {{ __('Supprimer le compte') }}
        </a>
      </li>
    </ul>
  </aside>
</div>
