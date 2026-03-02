@extends('frontend.layout')

@section('style')
<style>
/* ===== TUILES PARAMETRES PREMIUM (identique freelance) ===== */
.settings-tiles-pro {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2.5rem;
  width: 100%;
  max-width: none;
  margin: 2.5rem 0 0 0;
  padding: 0;
}
@media (max-width: 1023px) {
  .settings-tiles-pro { grid-template-columns: repeat(2, 1fr); gap: 2rem; }
}
@media (max-width: 599px) {
  .settings-tiles-pro { grid-template-columns: 1fr; gap: 1.5rem; }
}

.settings-tile-pro {
  background: linear-gradient(135deg, #ffffff 0%, #f8fafb 100%);
  border-radius: 28px;
  box-shadow: 0 24px 64px rgba(80,36,180,.18), 0 8px 24px rgba(80,36,180,.08), inset 0 1px 0 rgba(255,255,255,.8);
  padding: 3rem 2.5rem 2.5rem;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  transition: all .35s cubic-bezier(.34,1.56,.64,1);
  position: relative;
  min-height: 280px;
  border: 2px solid rgba(124,58,237,.15);
  overflow: hidden;
}
.settings-tile-pro::before {
  content: '';
  position: absolute;
  top: -100px; left: -100px;
  width: 200px; height: 200px;
  background: radial-gradient(circle, rgba(124,58,237,.15) 0%, transparent 70%);
  border-radius: 50%;
  pointer-events: none;
  filter: blur(40px);
}
.settings-tile-pro::after {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,.8), transparent);
  pointer-events: none;
}
.settings-tile-pro:hover {
  box-shadow: 0 32px 80px rgba(80,36,180,.25), 0 12px 32px rgba(80,36,180,.14), inset 0 1px 0 rgba(255,255,255,.9);
  transform: translateY(-12px) scale(1.03);
  border-color: rgba(124,58,237,.4);
  background: linear-gradient(135deg, #fafbfc 0%, #f3f4f9 100%);
}

.tile-icon {
  width: 72px; height: 72px; border-radius: 20px;
  background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 40%, #c7d2fe 100%);
  display: flex; align-items: center; justify-content: center;
  font-size: 2.2rem; color: #7c3aed;
  margin-bottom: 2rem;
  box-shadow: 0 12px 32px rgba(124,58,237,.2), 0 4px 12px rgba(124,58,237,.12), inset 0 2px 8px rgba(255,255,255,.6);
  transition: all .35s cubic-bezier(.34,1.56,.64,1);
  position: relative; z-index: 1;
}
.tile-icon::before {
  content: '';
  position: absolute; inset: -2px; border-radius: 20px;
  background: linear-gradient(135deg, rgba(124,58,237,.2), transparent);
  opacity: 0; transition: opacity .35s ease; pointer-events: none;
}
.settings-tile-pro:hover .tile-icon {
  background: linear-gradient(135deg, #a5b4fc 0%, #818cf8 40%, #6366f1 100%);
  color: #fff;
  box-shadow: 0 16px 48px rgba(124,58,237,.35), 0 8px 20px rgba(124,58,237,.2), inset 0 2px 8px rgba(255,255,255,.3);
  transform: scale(1.15) rotate(-5deg);
}
.settings-tile-pro:hover .tile-icon::before { opacity: 1; }

.tile-title {
  font-size: 1.5rem; font-weight: 900; color: #0f172a;
  margin-bottom: 1rem; letter-spacing: -.03em;
  position: relative; z-index: 1;
  background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.tile-desc {
  color: #64748b; font-size: 1rem; margin-bottom: 1.75rem; line-height: 1.7;
  position: relative; z-index: 1; font-weight: 500;
}
.tile-btn {
  background: linear-gradient(135deg, #7c3aed 0%, #6366f1 50%, #4f46e5 100%);
  color: #fff; border: none; border-radius: 16px;
  padding: .9rem 1.8rem; font-weight: 800; font-size: .95rem;
  box-shadow: 0 8px 24px rgba(124,58,237,.32), 0 2px 8px rgba(0,0,0,.08);
  cursor: pointer; transition: all .35s cubic-bezier(.34,1.56,.64,1);
  position: relative; z-index: 1; letter-spacing: .03em;
  font-family: inherit; text-decoration: none; display: inline-block;
}
.tile-btn::before {
  content: '';
  position: absolute; inset: 0; border-radius: 16px;
  background: linear-gradient(135deg, rgba(255,255,255,.2), transparent);
  opacity: 0; transition: opacity .3s ease; pointer-events: none;
}
.tile-btn:hover {
  background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
  box-shadow: 0 12px 36px rgba(124,58,237,.42), 0 4px 16px rgba(0,0,0,.12);
  transform: scale(1.08) translateY(-3px); color: #fff; text-decoration: none;
}
.tile-btn:hover::before { opacity: 1; }
.tile-btn:active { transform: scale(.96) translateY(0); }

.tile-badge {
  position: absolute; top: 1.8rem; right: 1.8rem;
  background: linear-gradient(135deg, #f59e0b 0%, #f97316 50%, #ea580c 100%);
  color: #fff; font-size: .75rem; font-weight: 900; border-radius: 12px;
  padding: .5rem 1rem;
  box-shadow: 0 8px 24px rgba(245,158,11,.35), 0 2px 8px rgba(0,0,0,.1);
  letter-spacing: .06em; z-index: 2;
  border: 2px solid rgba(255,255,255,.3);
  text-transform: uppercase;
}
.tile-badge.new {
  background: linear-gradient(135deg, #7c3aed 0%, #6366f1 100%);
  box-shadow: 0 8px 24px rgba(124,58,237,.35);
}

/* Variante danger */
.settings-tile-pro.danger {
  border-color: rgba(239,68,68,.2);
  background: linear-gradient(135deg, #fff5f5 0%, #fff2f2 100%);
}
.settings-tile-pro.danger::before {
  background: radial-gradient(circle, rgba(239,68,68,.15) 0%, transparent 70%);
}
.settings-tile-pro.danger:hover {
  box-shadow: 0 32px 80px rgba(239,68,68,.22), 0 12px 32px rgba(239,68,68,.12), inset 0 1px 0 rgba(255,255,255,.9);
  border-color: rgba(239,68,68,.4);
  background: linear-gradient(135deg, #fffdfd 0%, #fff8f8 100%);
}
.settings-tile-pro.danger .tile-title {
  background: linear-gradient(135deg, #7f1d1d 0%, #dc2626 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.settings-tile-pro.danger .tile-icon {
  background: linear-gradient(135deg, #fee2e2 0%, #fecaca 40%, #fca5a5 100%);
  color: #dc2626;
  box-shadow: 0 12px 32px rgba(220,38,38,.2), 0 4px 12px rgba(220,38,38,.12), inset 0 2px 8px rgba(255,255,255,.6);
}
.settings-tile-pro.danger:hover .tile-icon {
  background: linear-gradient(135deg, #fca5a5 0%, #f87171 40%, #ef4444 100%);
  color: #fff;
  box-shadow: 0 16px 48px rgba(239,68,68,.35), 0 8px 20px rgba(239,68,68,.2), inset 0 2px 8px rgba(255,255,255,.3);
  transform: scale(1.15) rotate(5deg);
}
.settings-tile-pro.danger .tile-btn {
  background: linear-gradient(135deg, #fff 0%, #faf5f5 100%);
  color: #dc2626;
  border: 2.5px solid #ef4444;
  box-shadow: 0 4px 12px rgba(239,68,68,.15);
}
.settings-tile-pro.danger .tile-btn:hover {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 50%, #b91c1c 100%);
  color: #fff;
  box-shadow: 0 12px 36px rgba(239,68,68,.42), 0 4px 16px rgba(0,0,0,.12);
}

/* Variante bleu client (paiements / abonnement / facturation) */
.settings-tile-pro.client-blue {
  border-color: rgba(37,99,235,.18);
}
.settings-tile-pro.client-blue::before {
  background: radial-gradient(circle, rgba(37,99,235,.12) 0%, transparent 70%);
}
.settings-tile-pro.client-blue:hover {
  box-shadow: 0 32px 80px rgba(37,99,235,.22), 0 12px 32px rgba(37,99,235,.12), inset 0 1px 0 rgba(255,255,255,.9);
  border-color: rgba(37,99,235,.4);
}
.settings-tile-pro.client-blue .tile-icon {
  background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 40%, #c7d2fe 100%);
  color: #2563eb;
  box-shadow: 0 12px 32px rgba(37,99,235,.2), 0 4px 12px rgba(37,99,235,.12), inset 0 2px 8px rgba(255,255,255,.6);
}
.settings-tile-pro.client-blue:hover .tile-icon {
  background: linear-gradient(135deg, #93c5fd 0%, #60a5fa 40%, #3b82f6 100%);
  color: #fff;
}
.settings-tile-pro.client-blue .tile-title {
  background: linear-gradient(135deg, #1e3a5f 0%, #1e40af 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.settings-tile-pro.client-blue .tile-btn {
  background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
}
.settings-tile-pro.client-blue .tile-btn:hover {
  background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
}

/* Variante vert client (agenda / auto-confirmation) */
.settings-tile-pro.client-green {
  border-color: rgba(5,150,105,.18);
}
.settings-tile-pro.client-green::before {
  background: radial-gradient(circle, rgba(16,185,129,.12) 0%, transparent 70%);
}
.settings-tile-pro.client-green:hover {
  box-shadow: 0 32px 80px rgba(16,185,129,.2), 0 12px 32px rgba(16,185,129,.1), inset 0 1px 0 rgba(255,255,255,.9);
  border-color: rgba(16,185,129,.4);
}
.settings-tile-pro.client-green .tile-icon {
  background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 40%, #6ee7b7 100%);
  color: #059669;
  box-shadow: 0 12px 32px rgba(16,185,129,.2), 0 4px 12px rgba(16,185,129,.12), inset 0 2px 8px rgba(255,255,255,.6);
}
.settings-tile-pro.client-green:hover .tile-icon {
  background: linear-gradient(135deg, #6ee7b7 0%, #34d399 40%, #10b981 100%);
  color: #fff;
}
.settings-tile-pro.client-green .tile-title {
  background: linear-gradient(135deg, #064e3b 0%, #047857 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.settings-tile-pro.client-green .tile-btn {
  background: linear-gradient(135deg, #059669 0%, #10b981 100%);
}
.settings-tile-pro.client-green .tile-btn:hover {
  background: linear-gradient(135deg, #047857 0%, #059669 100%);
}

/* ===== WRAPPER PAGE ===== */
.settings-page-wrapper-light {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  background: linear-gradient(135deg, #F8FAFC 0%, #FFFFFF 100%);
  color: #1E293B;
  min-height: 100vh;
  padding: 0 10px;
  box-sizing: border-box;
}
.settings-page-wrapper-light * { box-sizing: border-box; }

/* Header de page */
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

.page-header { margin-bottom: 2rem; }
.page-header h1 {
  font-size: 2rem; font-weight: 900; color: #0f172a;
  margin: 0 0 .5rem; letter-spacing: -.04em;
}
.page-header .page-subtitle { font-size: 1rem; color: #64748b; margin: 0; }


</style>
@endsection

@section('content')

@php
  $user          = Auth::guard('web')->user();
  $heroFirstName = $user->first_name ?? $user->username ?? 'vous';

@endphp

<div class="settings-page-wrapper-light">
  <div style="max-width:1400px;margin:0 auto;padding:2rem;">

    @include('frontend.client.partials.dashboard-nav')

    <!-- Hero banner -->
    <div class="page-hero-banner">
      <div class="hero-text-content">
        <h1 class="page-hero-title">Bonjour {{ $heroFirstName }} !</h1>
        <p class="page-hero-subtitle">Bienvenue dans votre espace</p>
      </div>
      <a href="/services" class="hero-search-btn">
        <i class="fas fa-search"></i> Trouver un freelance
      </a>
    </div>

    <!-- Header de page -->
    <div class="page-header" style="margin-top:2rem;">
      <h1>Paramètres</h1>
      <p class="page-subtitle">Gérez votre compte client, vos paiements et vos préférences.</p>
    </div>

    <!-- ===== GRILLE DE TUILES ===== -->
    <div class="settings-tiles-pro">

      <!-- 1. Profil personnel -->
      <div class="settings-tile-pro">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" fill="#7c3aed" fill-opacity=".15"/>
            <circle cx="12" cy="8" r="2.5" fill="#7c3aed"/>
            <rect x="5" y="16" width="14" height="5" rx="2.5" fill="#7c3aed" fill-opacity=".1"/>
          </svg>
        </div>
        <div class="tile-title">Profil personnel</div>
        <div class="tile-desc">Photo, prénom, nom, ville, pays, fuseau horaire.<br><span style="font-size:.92em;color:#a1a1aa;">Ce que vous présentez sur la plateforme.</span></div>
        <a href="{{ route('user.settings.profile') }}" class="tile-btn">Modifier</a>
      </div>

      <!-- 2. Securite -->
      <div class="settings-tile-pro">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <rect x="4" y="10" width="16" height="10" rx="2" fill="#ede9fe"/>
            <rect x="8" y="14" width="8" height="2" rx="1" fill="#7c3aed"/>
            <rect x="10" y="6" width="4" height="4" rx="2" fill="#7c3aed"/>
          </svg>
        </div>
        <div class="tile-title">Sécurité</div>
        <div class="tile-desc">Mot de passe, connexion, protection du compte.</div>
        <a href="{{ route('user.settings.password') }}" class="tile-btn">Ouvrir</a>
      </div>

      <!-- 3. Adresse e-mail -->
      <div class="settings-tile-pro">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <rect x="3" y="6" width="18" height="12" rx="3" fill="#ede9fe"/>
            <path d="M3 8l9 6 9-6" stroke="#7c3aed" stroke-width="1.5"/>
          </svg>
        </div>
        <div class="tile-title">Adresse e-mail</div>
        <div class="tile-desc">E-mail de connexion et notifications.</div>
        <a href="{{ route('user.settings.email.edit') }}" class="tile-btn">Ouvrir</a>
      </div>

      <!-- 4. Modes de paiement (CLIENT) -->
      <div class="settings-tile-pro client-blue">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <rect x="2" y="5" width="20" height="14" rx="3" fill="#dbeafe"/>
            <rect x="2" y="10" width="20" height="3" fill="#2563eb" fill-opacity=".3"/>
            <rect x="5" y="15" width="5" height="2" rx="1" fill="#2563eb"/>
          </svg>
        </div>
        <div class="tile-title">Modes de paiement</div>
        <div class="tile-desc">Cartes bancaires, CB enregistrées sur Stripe.<br><span style="font-size:.92em;color:#a1a1aa;">Nécessaire pour réserver vos rituels.</span></div>
        <a href="{{ route('user.settings.payment_methods.index') }}" class="tile-btn">Gerer</a>
        <span class="tile-badge new">Client</span>
      </div>

      <!-- 5. Abonnement Junspro (CLIENT) -->
      <div class="settings-tile-pro client-blue">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="#dbeafe" stroke="#2563eb" stroke-width="1.2"/>
          </svg>
        </div>
        <div class="tile-title">Abonnement Junspro</div>
        <div class="tile-desc">Plan actuel, renouvellement, pause ou résiliation.<br><span style="font-size:.92em;color:#a1a1aa;">Gérez votre accès à la plateforme.</span></div>
        <a href="{{ route('user.settings.subscription') }}" class="tile-btn">Voir mon plan</a>
      </div>

      <!-- 6. Historique de paiement (CLIENT) -->
      <div class="settings-tile-pro client-blue">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" fill="#dbeafe"/>
            <polyline points="14,2 14,8 20,8" fill="#bfdbfe" stroke="#2563eb" stroke-width="1.2"/>
            <line x1="9" y1="13" x2="15" y2="13" stroke="#2563eb" stroke-width="1.5"/>
            <line x1="9" y1="17" x2="13" y2="17" stroke="#2563eb" stroke-width="1.5"/>
          </svg>
        </div>
        <div class="tile-title">Historique de paiement</div>
        <div class="tile-desc">Factures, recus et recapitulatifs de transactions.</div>
        <a href="{{ route('user.settings.billing_history') }}" class="tile-btn">Consulter</a>
      </div>

      <!-- 7. Agenda & fuseau horaire (CLIENT) -->
      <div class="settings-tile-pro client-green">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2" fill="#d1fae5"/>
            <path d="M16 2v4M8 2v4M3 10h18" stroke="#059669" stroke-width="1.5"/>
            <circle cx="12" cy="16" r="2" fill="#059669" fill-opacity=".5"/>
          </svg>
        </div>
        <div class="tile-title">Agenda &amp; fuseau horaire</div>
        <div class="tile-desc">Calendrier de rituels, fuseau horaire affiché.<br><span style="font-size:.92em;color:#a1a1aa;">Indispensable pour vos séances.</span></div>
        <a href="{{ route('user.settings.agenda') }}" class="tile-btn">Configurer</a>
      </div>

      <!-- 8. Confirmation automatique (CLIENT) -->
      <div class="settings-tile-pro client-green">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9" fill="#d1fae5"/>
            <path d="M8 12l3 3 5-6" stroke="#059669" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
        <div class="tile-title">Confirmation automatique</div>
        <div class="tile-desc">Acceptation automatique des rituels programmés.<br><span style="font-size:.92em;color:#a1a1aa;">Simplifiez vos réservations.</span></div>
        <a href="{{ route('user.settings.auto_confirmation') }}" class="tile-btn">Parametrer</a>
        <span class="tile-badge new">Nouveau</span>
      </div>

      <!-- 9. Notifications -->
      @php
        try { $notificationsUrl = route('user.settings.notifications'); }
        catch (\Exception $e) { $notificationsUrl = url('/user/settings/notifications'); }
      @endphp
      <div class="settings-tile-pro">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <rect x="5" y="7" width="14" height="10" rx="4" fill="#fef9c3"/>
            <path d="M12 17v2" stroke="#f59e0b" stroke-width="1.5"/>
            <circle cx="12" cy="12" r="2" fill="#f59e0b"/>
          </svg>
        </div>
        <div class="tile-title">Notifications</div>
        <div class="tile-desc">Rappels, alertes rituels, messages, bilans.</div>
        <a href="{{ $notificationsUrl }}" class="tile-btn">Personnaliser</a>
      </div>

      <!-- 10. Connexions & autorisations -->
      @php
        try { $connectionsUrl = route('user.settings.connections'); }
        catch (\Exception $e) { $connectionsUrl = url('/user/settings/connections'); }
      @endphp
      <div class="settings-tile-pro">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <circle cx="8" cy="12" r="4" fill="#dbeafe"/>
            <circle cx="16" cy="12" r="4" fill="#a5b4fc"/>
          </svg>
        </div>
        <div class="tile-title">Connexions &amp; autorisations</div>
        <div class="tile-desc">Gérer vos connexions sociales (Google, Facebook) et accès OAuth.</div>
        <a href="{{ $connectionsUrl }}" class="tile-btn">Gerer</a>
      </div>

      <!-- 11. Supprimer le compte -->
      @php
        try { $deleteAccountUrl = route('user.settings.delete_account'); }
        catch (\Exception $e) { $deleteAccountUrl = url('/user/settings/delete-account'); }
      @endphp
      <div class="settings-tile-pro danger">
        <div class="tile-icon">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
            <rect x="4" y="6" width="16" height="12" rx="3" fill="#fee2e2"/>
            <path d="M8 10l8 8M8 18l8-8" stroke="#ef4444" stroke-width="1.5"/>
          </svg>
        </div>
        <div class="tile-title">Supprimer le compte</div>
        <div class="tile-desc">Désactiver ou supprimer votre compte client.<br><span style="font-size:.92em;color:#ef4444;">Action irréversible — toutes vos données seront effacées.</span></div>
        <a href="{{ $deleteAccountUrl }}" class="tile-btn">Ouvrir</a>
        <span class="tile-badge">Danger</span>
      </div>

    </div><!-- /settings-tiles-pro -->


  </div>
</div><!-- /settings-page-wrapper-light -->


@endsection
