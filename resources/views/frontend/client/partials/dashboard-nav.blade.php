{{-- Navigation du tableau de bord client --}}
<nav class="dashboard-nav">
  <a href="{{ route('client.dashboard.index') }}" class="dashboard-nav-item {{ request()->routeIs('user.dashboard') || request()->routeIs('client.dashboard.index') ? 'active' : '' }}">{{ __('Accueil') }}</a>
  <a href="{{ route('client.agenda.index') }}" class="dashboard-nav-item {{ request()->routeIs('client.agenda.*') ? 'active' : '' }}">{{ __('Agenda') }}</a>
  <a href="{{ route('user.messages.index') }}" class="dashboard-nav-item {{ request()->routeIs('user.messages.*') || request()->routeIs('client.messages.*') ? 'active' : '' }}">{{ __('Messages') }}</a>
  <a href="{{ route('client.subscriptions.first') }}" class="dashboard-nav-item {{ request()->routeIs('client.subscriptions.*') || request()->routeIs('user.projects_sessions.*') ? 'active' : '' }}">{{ __('Rituels') }}</a>
  <a href="{{ route('mentorship.subscription.index') }}" class="dashboard-nav-item {{ request()->routeIs('mentorship.subscription.*') ? 'active' : '' }}">🎓 {{ __('Mentorat') }}</a>
  <a href="{{ route('mentorship.become-intern') }}" class="dashboard-nav-item {{ request()->routeIs('mentorship.become-intern') ? 'active' : '' }}">🎓 {{ __('Devenir Stagiaire') }}</a>
  <a href="{{ route('mentorship.become-junior') }}" class="dashboard-nav-item {{ request()->routeIs('mentorship.become-junior') ? 'active' : '' }}">🚀 {{ __('Devenir Freelance Junior') }}</a>
  <a href="{{ route('user.settings.index') }}" class="dashboard-nav-item {{ request()->routeIs('user.settings.*') || request()->routeIs('user.edit_profile') || request()->routeIs('user.change_password') ? 'active' : '' }}">{{ __('Paramètres') }}</a>
</nav>

<style>
  .dashboard-nav {
    background: white;
    border-radius: 16px;
    padding: 0.5rem;
    margin-top: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    display: flex;
    gap: 0.5rem;
    overflow-x: auto;
    position: relative;
    z-index: 1;
  }
  
  .dashboard-nav a {
    pointer-events: auto !important;
  }
  
  .dashboard-nav a.dashboard-nav-item {
    pointer-events: auto !important;
  }

  .dashboard-nav-item {
    padding: 0.75rem 1.5rem;
    text-decoration: none;
    color: #6b7280;
    font-weight: 500;
    font-size: 0.95rem;
    border-radius: 12px;
    transition: all 0.2s ease;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
    position: relative;
    z-index: 1;
  }
  
  .dashboard-nav-item:not([href]),
  .dashboard-nav-item[href="#"],
  .dashboard-nav-item[href=""] {
    pointer-events: none;
    opacity: 0.5;
  }

  .dashboard-nav-item:hover {
    color: var(--junspro-purple, #7C3AED);
    background: #f3f4f6;
  }

  .dashboard-nav-item.active {
    color: #fff !important;
    background: linear-gradient(135deg, #7C3AED 0%, #1e40af 100%) !important;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3) !important;
    border-bottom: none !important;
  }
</style>
