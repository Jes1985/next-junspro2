<style>
/* ===== SIDEBAR PREMIUM PARAMETRES CLIENT ===== */
.prem-settings-sidebar {
  background: white;
  border-radius: 24px;
  box-shadow: 0 16px 48px rgba(80,36,180,.13), 0 4px 12px rgba(80,36,180,.07), inset 0 1px 0 rgba(255,255,255,.8);
  overflow: hidden;
  border: 1.5px solid rgba(124,58,237,.12);
  height: fit-content;
  position: sticky;
  top: 2rem;
}
.prem-sidebar-top {
  background: linear-gradient(135deg, #3730a3 0%, #4c1d95 50%, #7c3aed 100%);
  padding: 1.75rem 1.5rem 1.5rem;
  position: relative;
  overflow: hidden;
}
.prem-sidebar-top::before {
  content: '';
  position: absolute; top: -40px; right: -30px;
  width: 120px; height: 120px;
  background: radial-gradient(circle, rgba(255,255,255,.12) 0%, transparent 70%);
  border-radius: 50%;
}
.prem-back-btn {
  display: inline-flex; align-items: center; gap: .45rem;
  background: rgba(255,255,255,.18); border: 1px solid rgba(255,255,255,.3);
  color: rgba(255,255,255,.9); font-size: .78rem; font-weight: 600;
  padding: .4rem .9rem; border-radius: 50px; text-decoration: none;
  transition: background .2s; margin-bottom: 1rem; letter-spacing: .03em;
  backdrop-filter: blur(8px);
}
.prem-back-btn:hover { background: rgba(255,255,255,.28); color: white; text-decoration: none; }
.prem-sidebar-title {
  color: white; font-size: 1.2rem; font-weight: 900; margin: 0; letter-spacing: -.02em;
}
.prem-sidebar-subtitle { color: rgba(255,255,255,.7); font-size: .8rem; margin: .25rem 0 0; }

/* Nav items */
.prem-sidebar-nav { padding: .75rem 0; }
.prem-nav-group {
  padding: .5rem 1.25rem .25rem;
  font-size: .7rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .1em; color: #94a3b8;
}
.prem-nav-item {
  display: flex; align-items: center; gap: .9rem;
  padding: .75rem 1.5rem;
  color: #374151; text-decoration: none;
  font-size: .92rem; font-weight: 500;
  transition: all .2s ease;
  border-left: 3px solid transparent;
  position: relative;
}
.prem-nav-item:hover {
  background: linear-gradient(90deg, rgba(124,58,237,.06), rgba(99,102,241,.03));
  color: #7c3aed; text-decoration: none;
  border-left-color: rgba(124,58,237,.3);
}
.prem-nav-item.active {
  background: linear-gradient(90deg, rgba(124,58,237,.1), rgba(99,102,241,.04));
  color: #7c3aed; font-weight: 700;
  border-left-color: #7c3aed;
}
.prem-nav-item.active .prem-nav-icon-wrap {
  background: linear-gradient(135deg, #ede9fe, #ddd6fe);
  box-shadow: 0 4px 10px rgba(124,58,237,.2);
}
.prem-nav-icon-wrap {
  width: 34px; height: 34px; border-radius: 10px; flex-shrink: 0;
  background: #f8f9fc; display: flex; align-items: center; justify-content: center;
  transition: all .2s ease;
}
.prem-nav-item:hover .prem-nav-icon-wrap {
  background: linear-gradient(135deg, #ede9fe, #ddd6fe);
}
.prem-nav-item.danger-item { color: #dc2626; }
.prem-nav-item.danger-item:hover, .prem-nav-item.danger-item.active {
  background: rgba(239,68,68,.06); border-left-color: #ef4444; color: #dc2626;
}
.prem-nav-item.danger-item .prem-nav-icon-wrap { background: #fff5f5; }
.prem-nav-item.danger-item:hover .prem-nav-icon-wrap { background: #fee2e2; }
.prem-nav-divider { height: 1px; background: #f1f5f9; margin: .5rem 1.5rem; }
</style>

<aside class="prem-settings-sidebar">
  <div class="prem-sidebar-top">
    <a href="{{ route('user.settings.index') }}" class="prem-back-btn">
      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path d="M15 18l-6-6 6-6"/>
      </svg>
      Vue d'ensemble
    </a>
    <div class="prem-sidebar-title">Parametres</div>
    <div class="prem-sidebar-subtitle">Gestion du compte client</div>
  </div>

  <nav class="prem-sidebar-nav">
    <div class="prem-nav-group">Identite</div>

    <a href="{{ route('user.settings.index') }}" class="prem-nav-item {{ request()->routeIs('user.settings.index') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="2">
          <rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/>
          <rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>
        </svg>
      </span>
      <span>Tableau de bord</span>
    </a>

    <a href="{{ route('user.settings.index') }}#profil" class="prem-nav-item {{ request()->routeIs('user.settings.index') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="2">
          <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
        </svg>
      </span>
      <span>Profil personnel</span>
    </a>

    <a href="{{ route('user.settings.password') }}" class="prem-nav-item {{ request()->routeIs('user.settings.password') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="2">
          <rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/>
        </svg>
      </span>
      <span>Securite</span>
    </a>

    <a href="{{ route('user.settings.email.edit') }}" class="prem-nav-item {{ request()->routeIs('user.settings.email.*') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="2">
          <rect x="2" y="5" width="20" height="14" rx="2.5"/><path d="m2 7 10 7 10-7"/>
        </svg>
      </span>
      <span>Adresse e-mail</span>
    </a>

    <div class="prem-nav-divider"></div>
    <div class="prem-nav-group">Paiements</div>

    <a href="{{ route('user.settings.payment_methods.index') }}" class="prem-nav-item {{ request()->routeIs('user.settings.payment_methods.*') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2">
          <rect x="2" y="5" width="20" height="14" rx="3"/><path d="M2 10h20"/>
        </svg>
      </span>
      <span>Modes de paiement</span>
    </a>

    <a href="{{ route('user.settings.subscription') }}" class="prem-nav-item {{ request()->routeIs('user.settings.subscription') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2">
          <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z"/>
        </svg>
      </span>
      <span>Abonnement Junspro</span>
    </a>

    <a href="{{ route('user.settings.billing_history') }}" class="prem-nav-item {{ request()->routeIs('user.settings.billing_history.*') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14,2 14,8 20,8"/>
        </svg>
      </span>
      <span>Historique de paiement</span>
    </a>

    <div class="prem-nav-divider"></div>
    <div class="prem-nav-group">Agenda</div>

    <a href="{{ route('user.settings.agenda') }}" class="prem-nav-item {{ request()->routeIs('user.settings.agenda*') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#059669" stroke-width="2">
          <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
        </svg>
      </span>
      <span>Agenda &amp; fuseau</span>
    </a>

    <a href="{{ route('user.settings.auto_confirmation') }}" class="prem-nav-item {{ request()->routeIs('user.settings.auto_confirmation*') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#059669" stroke-width="2">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/>
        </svg>
      </span>
      <span>Confirmation auto</span>
    </a>

    <div class="prem-nav-divider"></div>
    <div class="prem-nav-group">Preferences</div>

    @php
      try { $notificationsUrl = route('user.settings.notifications'); }
      catch (\Exception $e) { $notificationsUrl = url('/user/settings/notifications'); }
      try { $connectionsUrl = route('user.settings.connections'); }
      catch (\Exception $e) { $connectionsUrl = url('/user/settings/connections'); }
      try { $deleteAccountUrl = route('user.settings.delete_account'); }
      catch (\Exception $e) { $deleteAccountUrl = url('/user/settings/delete-account'); }
    @endphp

    <a href="{{ $notificationsUrl }}" class="prem-nav-item {{ request()->routeIs('user.settings.notifications*') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="2">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
      </span>
      <span>Notifications</span>
    </a>

    <a href="{{ $connectionsUrl }}" class="prem-nav-item {{ request()->routeIs('user.settings.connections*') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="2">
          <circle cx="8" cy="12" r="3"/><circle cx="16" cy="6" r="3"/><circle cx="16" cy="18" r="3"/>
          <line x1="10.8" y1="10.7" x2="13.2" y2="7.3"/><line x1="10.8" y1="13.3" x2="13.2" y2="16.7"/>
        </svg>
      </span>
      <span>Connexions OAuth</span>
    </a>

    <div class="prem-nav-divider"></div>

    <a href="{{ $deleteAccountUrl }}" class="prem-nav-item danger-item {{ request()->routeIs('user.settings.delete_account*') ? 'active' : '' }}">
      <span class="prem-nav-icon-wrap">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2">
          <polyline points="3,6 5,6 21,6"/>
          <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
        </svg>
      </span>
      <span>Supprimer le compte</span>
    </a>
  </nav>
</aside>
