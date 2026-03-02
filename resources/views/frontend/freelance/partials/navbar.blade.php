{{-- Navigation du tableau de bord freelance --}}
@php
  $currentHash = request()->get('tab') ?: (request()->get('hash') ?: 'overview');
@endphp

@if(request()->routeIs('freelance.*'))
<nav class="freelance-dashboard-nav">
  <div class="freelance-nav-wrapper">
      <a href="{{ route('freelance.dashboard', ['tab' => 'overview']) }}" 
         class="freelance-nav-item {{ request('tab') === 'overview' || (!request('tab') && request()->routeIs('freelance.dashboard')) ? 'active' : '' }}" 
         data-tab="overview">Aperçu</a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'requests']) }}" 
         class="freelance-nav-item {{ request('tab') === 'requests' ? 'active' : '' }}" 
         data-tab="requests">Demandes</a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'jobs']) }}" 
         class="freelance-nav-item {{ request('tab') === 'jobs' ? 'active' : '' }}" 
         data-tab="jobs">Prestations</a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'calendar']) }}" 
         class="freelance-nav-item {{ request('tab') === 'calendar' ? 'active' : '' }}" 
         data-tab="calendar">Agenda</a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'services']) }}" 
         class="freelance-nav-item {{ request('tab') === 'services' ? 'active' : '' }}" 
         data-tab="services">Services</a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'messages']) }}" 
         class="freelance-nav-item {{ request('tab') === 'messages' ? 'active' : '' }}" 
         data-tab="messages">Messages</a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'earnings']) }}" 
         class="freelance-nav-item {{ request('tab') === 'earnings' ? 'active' : '' }}" 
         data-tab="earnings">Revenus</a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'profile']) }}" 
         class="freelance-nav-item {{ request('tab') === 'profile' ? 'active' : '' }}" 
         data-tab="profile">Profil</a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" 
         class="freelance-nav-item {{ request('tab') === 'settings' ? 'active' : '' }}" 
         data-tab="settings">Paramètres</a>
      <a href="{{ route('freelance.dashboard', ['tab' => 'rituals']) }}" 
         class="freelance-nav-item {{ request('tab') === 'rituals' ? 'active' : '' }}" 
         data-tab="rituals">Rituels</a>
  </div>
</nav>
@endif

<style>
  .freelance-dashboard-nav {
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
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
  }

  .freelance-dashboard-nav::-webkit-scrollbar { height: 0; }

  .freelance-nav-wrapper {
    display: contents; /* les enfants directs sont les liens */
  }

  .freelance-nav-item {
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

  .freelance-nav-item:hover {
    color: var(--junspro-purple, #7C3AED);
    background: #f3f4f6;
    text-decoration: none;
  }

  .freelance-nav-item.active {
    color: #fff !important;
    background: linear-gradient(135deg, #7C3AED 0%, #1e40af 100%) !important;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3) !important;
    text-decoration: none;
  }

  @media (max-width: 768px) {
    .freelance-nav-item {
      padding: 0.625rem 1.25rem;
      font-size: 0.85rem;
    }
  }
</style>

