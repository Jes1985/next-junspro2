@php
  $tabs = [
    'overview' => 'Aperçu',
    'requests' => 'Demandes',
    'jobs' => 'Prestations',
    'calendar' => 'Agenda',
    'services' => 'Services',
    'messages' => 'Messages',
    'earnings' => 'Revenus',
    'profile' => 'Profil',
    'settings' => 'Paramètres',
    'rituals' => 'Rituels'
  ];
@endphp

<nav class="dashboard-tabs-nav">
  @foreach($tabs as $tabKey => $tabLabel)
    <a href="{{ route('freelance.dashboard', ['tab' => $tabKey]) }}" 
       class="dashboard-tab-item {{ $activeTab === $tabKey ? 'active' : '' }}">
      {{ $tabLabel }}
    </a>
  @endforeach
</nav>

