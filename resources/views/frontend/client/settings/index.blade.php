@extends('frontend.layout')

@section('style')
<style>
/* =======================================================
   CLIENT SETTINGS — DESIGN SYSTÈME PREMIUM
   Hub de tuiles identique au profil Freelance, adapté client
   ======================================================= */
:root {
  --junspro-purple: #7C3AED;
  --junspro-blue:   #1e40af;
}

/* ── Conteneur principal ── */
.settings-container {
  max-width: 1320px;
  margin: 0 auto;
  padding: 2.5rem 1.5rem 4rem;
  background: linear-gradient(155deg, #f3e8ff 0%, #ede9fe 35%, #e0f2fe 100%);
  min-height: calc(100vh - 200px);
}

/* ── Hero banner ── */
.cs-hero {
  background: linear-gradient(135deg, #3730a3 0%, #4c1d95 40%, #7c3aed 80%, #a855f7 100%);
  border-radius: 28px;
  padding: 3rem 4rem;
  margin-bottom: 3rem;
  color: white;
  position: relative;
  overflow: hidden;
  box-shadow: 0 32px 80px rgba(124,58,237,.35), inset 0 1px 1px rgba(255,255,255,.2);
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 2rem;
}
.cs-hero::before {
  content: '';
  position: absolute; top: -40%; left: -5%;
  width: 380px; height: 380px;
  background: radial-gradient(circle, rgba(255,255,255,.10) 0%, transparent 70%);
  border-radius: 50%; pointer-events: none;
}
.cs-hero::after {
  content: '';
  position: absolute; bottom: -20%; right: -10%;
  width: 550px; height: 550px;
  background: radial-gradient(circle, rgba(255,255,255,.08) 0%, transparent 70%);
  border-radius: 50%; pointer-events: none;
}
.cs-hero-text { flex: 1; position: relative; z-index: 2; }
.cs-hero-badge {
  display: inline-flex; align-items: center; gap: .5rem;
  background: rgba(255,255,255,.18); border: 1.5px solid rgba(255,255,255,.3);
  color: white; font-size: .8rem; font-weight: 700; letter-spacing: .06em;
  padding: .45rem 1rem; border-radius: 50px; margin-bottom: 1.2rem;
  text-transform: uppercase; backdrop-filter: blur(8px);
}
.cs-hero-title {
  font-size: 2.6rem; font-weight: 900; margin: 0 0 .6rem; color: white;
  line-height: 1.1; letter-spacing: -.03em; position: relative; z-index: 2;
}
.cs-hero-subtitle {
  font-size: 1.05rem; opacity: .85; margin: 0; font-weight: 300; color: white;
  position: relative; z-index: 2; max-width: 520px;
}
.cs-hero-cta {
  background: white; color: #7c3aed; border-radius: 50px;
  padding: .9rem 2rem; font-weight: 700; font-size: .95rem;
  text-decoration: none !important; display: flex; align-items: center; gap: .5rem;
  white-space: nowrap; position: relative; z-index: 2; flex-shrink: 0;
  transition: background .2s, color .2s, transform .2s, box-shadow .2s;
  box-shadow: 0 8px 24px rgba(0,0,0,.15);
}
.cs-hero-cta:hover {
  background: #f5f3ff; color: #6d28d9; transform: translateY(-2px);
  box-shadow: 0 12px 32px rgba(0,0,0,.2); text-decoration: none !important;
}
@media(max-width:768px){
  .cs-hero { flex-direction: column; align-items: flex-start; padding: 2rem; }
  .cs-hero-title { font-size: 1.8rem; }
  .cs-hero-cta { align-self: flex-start; }
}

/* ── Labels de section ── */
.cs-section-label {
  font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em;
  color: #7c3aed; margin-bottom: 1.25rem; display: flex; align-items: center; gap: .5rem;
}
.cs-section-label::after {
  content: ''; flex: 1; height: 1px;
  background: linear-gradient(90deg, rgba(124,58,237,.3), transparent);
}
.cs-section-title {
  font-size: 2.2rem; font-weight: 900; color: #0f172a; margin: 0 0 .5rem;
  letter-spacing: -.04em;
  background: linear-gradient(135deg, #0f172a 0%, #4c1d95 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.cs-section-subtitle { font-size: 1.05rem; color: #64748b; margin: 0 0 2.5rem; font-weight: 400; }

/* ═══════════════════════════════════════
   TUILES SETTINGS PREMIUM
   ═══════════════════════════════════════ */
.settings-tiles-hub {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
  width: 100%;
}
@media(max-width:1024px) { .settings-tiles-hub { grid-template-columns: repeat(2, 1fr); } }
@media(max-width:600px)  { .settings-tiles-hub { grid-template-columns: 1fr; } }

.cs-tile {
  background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
  border-radius: 24px;
  box-shadow: 0 16px 48px rgba(80,36,180,.14), 0 4px 16px rgba(80,36,180,.07), inset 0 1px 0 rgba(255,255,255,.85);
  padding: 2.5rem 2rem 2rem;
  display: flex; flex-direction: column; align-items: flex-start;
  transition: all .35s cubic-bezier(.34,1.56,.64,1);
  position: relative; min-height: 250px;
  border: 2px solid rgba(124,58,237,.12);
  overflow: hidden; text-decoration: none;
}
.cs-tile::before {
  content: ''; position: absolute; top: -80px; left: -80px;
  width: 180px; height: 180px;
  background: radial-gradient(circle, rgba(124,58,237,.12) 0%, transparent 70%);
  border-radius: 50%; pointer-events: none; filter: blur(30px);
}
.cs-tile::after {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,.8), transparent);
  pointer-events: none;
}
.cs-tile:hover {
  box-shadow: 0 28px 72px rgba(80,36,180,.22), 0 10px 28px rgba(80,36,180,.12), inset 0 1px 0 rgba(255,255,255,.9);
  transform: translateY(-10px) scale(1.025);
  border-color: rgba(124,58,237,.35);
  text-decoration: none;
}

/* Icone */
.cs-tile-icon {
  width: 64px; height: 64px; border-radius: 18px;
  background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 40%, #c7d2fe 100%);
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 1.5rem;
  box-shadow: 0 10px 28px rgba(124,58,237,.18), 0 3px 10px rgba(124,58,237,.1), inset 0 2px 6px rgba(255,255,255,.6);
  transition: all .35s cubic-bezier(.34,1.56,.64,1);
  position: relative; z-index: 1;
}
.cs-tile:hover .cs-tile-icon {
  background: linear-gradient(135deg, #a5b4fc 0%, #818cf8 40%, #6366f1 100%);
  box-shadow: 0 14px 40px rgba(124,58,237,.32), 0 6px 16px rgba(124,58,237,.18), inset 0 2px 6px rgba(255,255,255,.25);
  transform: scale(1.12) rotate(-4deg);
}
.cs-tile:hover .cs-tile-icon svg { stroke: white !important; }

.cs-tile-title {
  font-size: 1.3rem; font-weight: 900; color: #0f172a; margin-bottom: .7rem;
  letter-spacing: -.03em; position: relative; z-index: 1; line-height: 1.2;
  background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.cs-tile-desc {
  color: #64748b; font-size: .9rem; margin-bottom: auto; line-height: 1.65;
  position: relative; z-index: 1; font-weight: 500; flex: 1; padding-bottom: 1.5rem;
}
.cs-tile-btn {
  background: linear-gradient(135deg, #7c3aed 0%, #6366f1 50%, #4f46e5 100%);
  color: #fff; border: none; border-radius: 14px;
  padding: .75rem 1.5rem; font-weight: 800; font-size: .88rem;
  box-shadow: 0 7px 20px rgba(124,58,237,.28), 0 2px 6px rgba(0,0,0,.07);
  cursor: pointer; transition: all .35s cubic-bezier(.34,1.56,.64,1);
  position: relative; z-index: 1; letter-spacing: .02em; text-decoration: none;
  display: inline-block; font-family: inherit;
}
.cs-tile-btn:hover {
  background: linear-gradient(135deg, #5b21b6 0%, #4338ca 100%);
  box-shadow: 0 12px 32px rgba(124,58,237,.40), 0 4px 14px rgba(0,0,0,.10);
  transform: scale(1.06) translateY(-2px); color: #fff; text-decoration: none;
}

/* Tuile accent bleu (client specifique) */
.cs-tile.client-accent { border-color: rgba(59,130,246,.18); }
.cs-tile.client-accent .cs-tile-icon {
  background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 40%, #c7d2fe 100%);
  box-shadow: 0 10px 28px rgba(59,130,246,.18), inset 0 2px 6px rgba(255,255,255,.6);
}
.cs-tile.client-accent:hover .cs-tile-icon {
  background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 40%, #2563eb 100%);
}
.cs-tile.client-accent .cs-tile-title {
  background: linear-gradient(135deg, #1e3a5f 0%, #1e40af 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.cs-tile.client-accent .cs-tile-btn {
  background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
}
.cs-tile.client-accent:hover .cs-tile-icon svg { stroke: white !important; }

/* Tuile accent vert (agenda / automatisation) */
.cs-tile.client-success { border-color: rgba(16,185,129,.18); }
.cs-tile.client-success .cs-tile-icon {
  background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 40%, #6ee7b7 100%);
  box-shadow: 0 10px 28px rgba(16,185,129,.18), inset 0 2px 6px rgba(255,255,255,.6);
}
.cs-tile.client-success:hover .cs-tile-icon {
  background: linear-gradient(135deg, #34d399 0%, #10b981 40%, #059669 100%);
}
.cs-tile.client-success .cs-tile-title {
  background: linear-gradient(135deg, #064e3b 0%, #047857 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.cs-tile.client-success .cs-tile-btn {
  background: linear-gradient(135deg, #059669 0%, #10b981 100%);
}
.cs-tile.client-success:hover .cs-tile-icon svg { stroke: white !important; }

/* Tuile danger */
.cs-tile.cs-danger {
  border-color: rgba(239,68,68,.18);
  background: linear-gradient(135deg, #fff5f5 0%, #fff2f2 100%);
}
.cs-tile.cs-danger::before {
  background: radial-gradient(circle, rgba(239,68,68,.12) 0%, transparent 70%);
}
.cs-tile.cs-danger:hover {
  box-shadow: 0 28px 72px rgba(239,68,68,.2), 0 10px 28px rgba(239,68,68,.1), inset 0 1px 0 rgba(255,255,255,.9);
  border-color: rgba(239,68,68,.38);
}
.cs-tile.cs-danger .cs-tile-icon {
  background: linear-gradient(135deg, #fee2e2 0%, #fecaca 40%, #fca5a5 100%);
  box-shadow: 0 10px 28px rgba(239,68,68,.18), inset 0 2px 6px rgba(255,255,255,.6);
}
.cs-tile.cs-danger:hover .cs-tile-icon {
  background: linear-gradient(135deg, #fca5a5 0%, #f87171 40%, #ef4444 100%);
}
.cs-tile.cs-danger .cs-tile-title {
  background: linear-gradient(135deg, #7f1d1d 0%, #dc2626 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.cs-tile.cs-danger .cs-tile-btn {
  background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
}
.cs-tile.cs-danger:hover .cs-tile-icon svg { stroke: white !important; }

/* Badge sur tuile */
.cs-tile-badge {
  position: absolute; top: 1.5rem; right: 1.5rem;
  background: linear-gradient(135deg, #f59e0b 0%, #f97316 50%, #ea580c 100%);
  color: #fff; font-size: .7rem; font-weight: 900; border-radius: 10px;
  padding: .4rem .9rem; letter-spacing: .06em; z-index: 2;
  border: 2px solid rgba(255,255,255,.3); text-transform: uppercase;
  box-shadow: 0 6px 18px rgba(245,158,11,.3);
}
.cs-tile-badge.new {
  background: linear-gradient(135deg, #7c3aed 0%, #6366f1 100%);
  box-shadow: 0 6px 18px rgba(124,58,237,.3);
}

/* ── Divider avec label ── */
.cs-divider {
  margin: 3.5rem 0 2.5rem;
  display: flex; align-items: center; gap: 1.5rem;
}
.cs-divider-line {
  flex: 1; height: 1px;
  background: linear-gradient(90deg, rgba(124,58,237,.25), rgba(99,102,241,.1), transparent);
}
.cs-divider-label {
  font-size: .82rem; font-weight: 700; text-transform: uppercase; letter-spacing: .09em;
  color: #7c3aed; white-space: nowrap;
}

/* ── Carte formulaire profil ── */
.cs-profile-card {
  background: #fff; border-radius: 24px;
  box-shadow: 0 12px 40px rgba(80,36,180,.10), 0 4px 12px rgba(0,0,0,.04);
  padding: 3rem; border: 1.5px solid rgba(124,58,237,.12);
  scroll-margin-top: 100px;
}
.cs-profile-card-header {
  display: flex; align-items: center; gap: 1.25rem;
  margin-bottom: 2.5rem; padding-bottom: 1.75rem;
  border-bottom: 1px solid #f1f5f9;
}
.cs-profile-card-icon {
  width: 52px; height: 52px; border-radius: 16px; flex-shrink: 0;
  background: linear-gradient(135deg, #ede9fe, #ddd6fe);
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 8px 20px rgba(124,58,237,.2);
}
.cs-profile-card-header h2 {
  font-size: 1.6rem; font-weight: 900; color: #0f172a; margin: 0 0 .25rem; letter-spacing: -.03em;
}
.cs-profile-card-header p { font-size: .92rem; color: #64748b; margin: 0; }

/* Photo de profil */
.profile-photo-section {
  display: flex; align-items: flex-start; gap: 2rem;
  margin-bottom: 2.5rem; padding-bottom: 2rem; border-bottom: 1px solid #f1f5f9;
}
.profile-photo-preview {
  width: 110px; height: 110px; border-radius: 50%; object-fit: cover;
  border: 3px solid #e0d9ff; flex-shrink: 0;
  box-shadow: 0 8px 24px rgba(124,58,237,.2);
}
.profile-photo-actions h3 { font-size: 1.05rem; font-weight: 700; color: #1a202c; margin: 0 0 .75rem; }
.btn-upload-photo {
  padding: .7rem 1.4rem; background: white; border: 2px solid var(--junspro-purple);
  color: var(--junspro-purple); border-radius: 12px; font-weight: 600; font-size: .9rem;
  cursor: pointer; transition: all .2s ease; display: inline-block; text-decoration: none;
}
.btn-upload-photo:hover {
  background: var(--junspro-purple); color: white; transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(124,58,237,.3); text-decoration: none;
}
.profile-photo-help { margin-top: .65rem; font-size: .85rem; color: #6b7280; line-height: 1.5; }

/* Formulaire */
.settings-form { margin-bottom: 0; }
.form-section { margin-bottom: 2rem; }
.form-section-title {
  font-size: 1.1rem; font-weight: 700; color: #1a202c; margin-bottom: 1.25rem;
  padding-bottom: .65rem; border-bottom: 1px solid #f1f5f9;
}
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
@media(max-width:640px) { .form-row { grid-template-columns: 1fr; } }
.form-group { margin-bottom: 1.25rem; }
.form-label { display: block; font-size: .92rem; font-weight: 600; color: #374151; margin-bottom: .4rem; }
.form-control {
  width: 100%; padding: .75rem 1rem; font-size: .92rem; color: #1a202c;
  background: white; border: 1.5px solid #e2e8f0; border-radius: 12px;
  transition: all .2s ease; font-family: inherit;
}
.form-control:focus { outline: none; border-color: var(--junspro-purple); box-shadow: 0 0 0 3px rgba(124,58,237,.1); }
.form-control.has-error { border-color: #ef4444; }
.form-error { margin-top: .4rem; font-size: .84rem; color: #ef4444; }
.form-help  { margin-top: .4rem; font-size: .84rem; color: #6b7280; }

/* Connexions sociales */
.social-connections { margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid #f1f5f9; }
.social-connection-item {
  display: flex; align-items: center; justify-content: space-between;
  padding: 1rem 0; border-bottom: 1px solid #f8f9fb;
}
.social-connection-item:last-child { border-bottom: none; }
.social-connection-info { display: flex; align-items: center; gap: 1rem; }
.social-icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; font-weight: 700; color: white; }
.social-icon.facebook { background: #1877f2; }
.social-icon.google   { background: #ea4335; }
.social-connection-text strong { display: block; font-weight: 700; color: #1a202c; margin-bottom: .2rem; }
.social-connection-text span { font-size: .85rem; color: #6b7280; }
.social-connection-action {
  padding: .5rem 1.2rem; background: white; border: 1.5px solid #d1d5db; color: #374151;
  border-radius: 10px; font-size: .85rem; font-weight: 600; cursor: pointer;
  transition: all .2s ease; text-decoration: none; display: inline-block;
}
.social-connection-action:hover { background: #f9fafb; border-color: var(--junspro-purple); color: var(--junspro-purple); }
.social-connection-action.connected { background: #f3f4f6; color: #6b7280; cursor: default; }

/* Bouton sauvegarder */
.settings-form-submit { max-width: 480px; margin: 2rem auto 0; }
.btn-save {
  width: 100%; padding: .95rem 2rem;
  background: linear-gradient(135deg, #7c3aed 0%, #4c1d95 50%, #1e40af 100%);
  color: white; border: none; border-radius: 14px; font-size: 1rem; font-weight: 700;
  cursor: pointer; transition: all .3s ease; box-shadow: 0 4px 16px rgba(124,58,237,.3);
  font-family: inherit;
}
.btn-save:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(124,58,237,.4); }

/* Responsive */
@media(max-width:640px) {
  .settings-container { padding: 1rem; }
  .cs-profile-card { padding: 1.75rem; }
  .profile-photo-section { flex-direction: column; align-items: center; text-align: center; }
  .settings-form-submit { max-width: 100%; }
}
</style>
@endsection

@section('content')
<div class="settings-container">
  @include('frontend.client.partials.dashboard-nav')

  @php
    $user          = Auth::guard('web')->user();
    $heroFirstName = $user->first_name ?? $user->username ?? 'vous';
    $avatarUrl     = $user->image ? asset('assets/img/users/' . $user->image) : null;
    $initials      = strtoupper(substr($user->first_name ?? $user->username ?? 'U', 0, 1) . substr($user->last_name ?? '', 0, 1));
    if (trim($initials) === '') $initials = strtoupper(substr($user->username ?? 'U', 0, 2));
  @endphp

  {{-- ============================================================
       HERO BANNER
       ============================================================ --}}
  <div class="cs-hero">
    <div class="cs-hero-text">
      <div class="cs-hero-badge">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
          <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
        </svg>
        Espace personnel
      </div>
      <h1 class="cs-hero-title">Bonjour {{ $heroFirstName }}&nbsp;!</h1>
      <p class="cs-hero-subtitle">
        Gerez votre compte, vos paiements, vos notifications et vos preferences Junspro depuis cet espace.
      </p>
    </div>
    <a href="/services" class="cs-hero-cta">
      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
      </svg>
      Trouver un freelance
    </a>
  </div>

  {{-- ============================================================
       SECTION TILES
       ============================================================ --}}
  <div class="cs-section-label">
    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
      <rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/>
      <rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>
    </svg>
    Parametres du compte
  </div>
  <h2 class="cs-section-title">Votre espace de configuration</h2>
  <p class="cs-section-subtitle">Acces a tous vos reglages. Cliquez sur une tuile pour la configurer.</p>

  <div class="settings-tiles-hub">

    {{-- 1. Profil personnel --}}
    <a href="#profil" class="cs-tile">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="1.8">
          <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
        </svg>
      </div>
      <div class="cs-tile-title">Profil personnel</div>
      <div class="cs-tile-desc">
        Photo, prenom, nom, ville, pays, fuseau horaire.<br>
        <span style="font-size:.88em;color:#a1a1aa;">Ce que vous presentez sur la plateforme.</span>
      </div>
      <span class="cs-tile-btn">Modifier</span>
    </a>

    {{-- 2. Securite --}}
    <a href="{{ route('user.settings.password') }}" class="cs-tile">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="1.8">
          <rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/>
          <circle cx="12" cy="15.5" r="1.5" fill="#7c3aed"/>
        </svg>
      </div>
      <div class="cs-tile-title">Securite</div>
      <div class="cs-tile-desc">Mot de passe, authentification, protection du compte.</div>
      <span class="cs-tile-btn">Configurer</span>
    </a>

    {{-- 3. Adresse e-mail --}}
    <a href="{{ route('user.settings.email.edit') }}" class="cs-tile">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="1.8">
          <rect x="2" y="5" width="20" height="14" rx="2.5"/><path d="m2 7 10 7 10-7"/>
        </svg>
      </div>
      <div class="cs-tile-title">Adresse e-mail</div>
      <div class="cs-tile-desc">E-mail de connexion, verification et notifications.</div>
      <span class="cs-tile-btn">Modifier</span>
    </a>

    {{-- 4. Modes de paiement (CLIENT) --}}
    <a href="{{ route('user.settings.payment_methods.index') }}" class="cs-tile client-accent">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="1.8">
          <rect x="2" y="5" width="20" height="14" rx="3"/><path d="M2 10h20"/><path d="M6 15h3"/>
        </svg>
      </div>
      <div class="cs-tile-title">Modes de paiement</div>
      <div class="cs-tile-desc">
        Cartes bancaires Stripe, CB enregistrees.<br>
        <span style="font-size:.88em;color:#a1a1aa;">Necessaire pour reserver vos rituels.</span>
      </div>
      <span class="cs-tile-btn">Gerer</span>
      <span class="cs-tile-badge new">Client</span>
    </a>

    {{-- 5. Abonnement Junspro (CLIENT) --}}
    <a href="{{ route('user.settings.subscription') }}" class="cs-tile client-accent">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="1.8">
          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
        </svg>
      </div>
      <div class="cs-tile-title">Abonnement Junspro</div>
      <div class="cs-tile-desc">
        Plan actuel, renouvellement, pause ou resiliation.<br>
        <span style="font-size:.88em;color:#a1a1aa;">Gerez votre acces a la plateforme.</span>
      </div>
      <span class="cs-tile-btn">Voir mon plan</span>
    </a>

    {{-- 6. Historique de paiement (CLIENT) --}}
    <a href="{{ route('user.settings.billing_history') }}" class="cs-tile client-accent">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="1.8">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14,2 14,8 20,8"/>
          <line x1="9" y1="13" x2="15" y2="13"/>
          <line x1="9" y1="17" x2="13" y2="17"/>
        </svg>
      </div>
      <div class="cs-tile-title">Historique de paiement</div>
      <div class="cs-tile-desc">Factures, recus et recapitulatifs de transactions.</div>
      <span class="cs-tile-btn">Consulter</span>
    </a>

    {{-- 7. Agenda & fuseau horaire (CLIENT) --}}
    <a href="{{ route('user.settings.agenda') }}" class="cs-tile client-success">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#059669" stroke-width="1.8">
          <rect x="3" y="4" width="18" height="18" rx="2"/>
          <path d="M16 2v4M8 2v4M3 10h18"/>
          <circle cx="12" cy="16" r="1.5" fill="#059669"/>
        </svg>
      </div>
      <div class="cs-tile-title">Agenda &amp; fuseau horaire</div>
      <div class="cs-tile-desc">
        Calendrier de rituels, fuseau horaire affiche.<br>
        <span style="font-size:.88em;color:#a1a1aa;">Indispensable pour la gestion de vos seances.</span>
      </div>
      <span class="cs-tile-btn">Configurer</span>
    </a>

    {{-- 8. Confirmation automatique (CLIENT) --}}
    <a href="{{ route('user.settings.auto_confirmation') }}" class="cs-tile client-success">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#059669" stroke-width="1.8">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
          <polyline points="22,4 12,14.01 9,11.01"/>
        </svg>
      </div>
      <div class="cs-tile-title">Confirmation automatique</div>
      <div class="cs-tile-desc">
        Acceptation automatique des rituels programmes.<br>
        <span style="font-size:.88em;color:#a1a1aa;">Simplifiez la gestion de vos reservations.</span>
      </div>
      <span class="cs-tile-btn">Parametrer</span>
      <span class="cs-tile-badge new">Nouveau</span>
    </a>

    {{-- 9. Notifications --}}
    @php
      try { $notificationsUrl = route('user.settings.notifications'); }
      catch (\Exception $e) { $notificationsUrl = url('/user/settings/notifications'); }
    @endphp
    <a href="{{ $notificationsUrl }}" class="cs-tile">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="1.8">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
          <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
      </div>
      <div class="cs-tile-title">Notifications</div>
      <div class="cs-tile-desc">Rappels, alertes rituels, messages et bilans hebdomadaires.</div>
      <span class="cs-tile-btn">Personnaliser</span>
    </a>

    {{-- 10. Connexions & autorisations --}}
    @php
      try { $connectionsUrl = route('user.settings.connections'); }
      catch (\Exception $e) { $connectionsUrl = url('/user/settings/connections'); }
    @endphp
    <a href="{{ $connectionsUrl }}" class="cs-tile">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="1.8">
          <circle cx="8" cy="12" r="3"/><circle cx="16" cy="6" r="3"/><circle cx="16" cy="18" r="3"/>
          <line x1="10.8" y1="10.7" x2="13.2" y2="7.3"/>
          <line x1="10.8" y1="13.3" x2="13.2" y2="16.7"/>
        </svg>
      </div>
      <div class="cs-tile-title">Connexions &amp; autorisations</div>
      <div class="cs-tile-desc">Gerer vos connexions sociales (Google, Facebook) et acces OAuth.</div>
      <span class="cs-tile-btn">Gerer</span>
    </a>

    {{-- 11. Supprimer le compte --}}
    @php
      try { $deleteAccountUrl = route('user.settings.delete_account'); }
      catch (\Exception $e) { $deleteAccountUrl = url('/user/settings/delete-account'); }
    @endphp
    <a href="{{ $deleteAccountUrl }}" class="cs-tile cs-danger">
      <div class="cs-tile-icon">
        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="1.8">
          <polyline points="3,6 5,6 21,6"/>
          <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
          <path d="M10 11v6M14 11v6"/>
          <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
        </svg>
      </div>
      <div class="cs-tile-title">Supprimer le compte</div>
      <div class="cs-tile-desc">
        Desactiver ou supprimer definitivement votre compte client.<br>
        <span style="font-size:.88em;color:#ef4444;">Action irreversible &mdash; toutes vos donnees seront effacees.</span>
      </div>
      <span class="cs-tile-btn">Ouvrir</span>
      <span class="cs-tile-badge" style="background:linear-gradient(135deg,#dc2626,#ef4444);box-shadow:0 6px 18px rgba(220,38,38,.3);">Danger</span>
    </a>

  </div>{{-- /settings-tiles-hub --}}

  {{-- ============================================================
       DIVIDER → FORMULAIRE PROFIL
       ============================================================ --}}
  <div class="cs-divider" id="profil">
    <div class="cs-divider-line"></div>
    <div class="cs-divider-label">Modifier votre profil</div>
    <div class="cs-divider-line" style="background:linear-gradient(90deg,transparent,rgba(99,102,241,.1),rgba(124,58,237,.25));"></div>
  </div>

  {{-- ============================================================
       FORMULAIRE PROFIL
       ============================================================ --}}
  <div class="cs-profile-card">
    <div class="cs-profile-card-header">
      <div class="cs-profile-card-icon">
        <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="2">
          <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
        </svg>
      </div>
      <div>
        <h2>Profil personnel</h2>
        <p>Photo, coordonnees et informations affichees sur la plateforme.</p>
      </div>
    </div>

    {{-- Photo de profil --}}
    <div class="profile-photo-section">
      @if($avatarUrl)
        <img src="{{ $avatarUrl }}" alt="Photo de profil" class="profile-photo-preview" id="profile-photo-preview">
      @else
        <div class="profile-photo-preview" id="profile-photo-preview"
             style="display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#7c3aed 0%,#1e40af 100%);color:white;font-size:2.2rem;font-weight:800;">
          {{ $initials }}
        </div>
      @endif
      <div class="profile-photo-actions">
        <h3>Photo de profil</h3>
        <label for="profile-photo-input" class="btn-upload-photo">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"
               style="display:inline;vertical-align:middle;margin-right:5px;">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
            <polyline points="17,8 12,3 7,8"/><line x1="12" y1="3" x2="12" y2="15"/>
          </svg>
          Importer une photo
        </label>
        <input type="file" id="profile-photo-input" name="image" accept="image/jpeg,image/png,image/jpg"
               style="display:none;" form="settings-form">
        <div class="profile-photo-help">
          Taille maximale : 2 Mo<br>Format JPG ou PNG
        </div>
      </div>
    </div>

    {{-- Formulaire --}}
    <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data"
          id="settings-form" class="settings-form">
      @csrf

      <div class="form-section">
        <h3 class="form-section-title">Identite</h3>
        <div class="form-row">
          <div class="form-group">
            <label for="first_name" class="form-label">Prenom</label>
            <input type="text" id="first_name" name="first_name"
                   class="form-control @error('first_name') has-error @enderror"
                   value="{{ old('first_name', $user->first_name) }}">
            @error('first_name')<div class="form-error">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="last_name" class="form-label">Nom</label>
            <input type="text" id="last_name" name="last_name"
                   class="form-control @error('last_name') has-error @enderror"
                   value="{{ old('last_name', $user->last_name) }}">
            @error('last_name')<div class="form-error">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" id="username" name="username"
                   class="form-control @error('username') has-error @enderror"
                   value="{{ old('username', $user->username) }}">
            @error('username')<div class="form-error">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="phone_number" class="form-label">Telephone</label>
            <input type="tel" id="phone_number" name="phone_number"
                   class="form-control @error('phone_number') has-error @enderror"
                   value="{{ old('phone_number', $user->phone_number) }}">
            @error('phone_number')<div class="form-error">{{ $message }}</div>@enderror
          </div>
        </div>
      </div>

      <div class="form-section">
        <h3 class="form-section-title">Localisation</h3>
        <div class="form-row">
          <div class="form-group">
            <label for="city" class="form-label">Ville</label>
            <input type="text" id="city" name="city"
                   class="form-control @error('city') has-error @enderror"
                   value="{{ old('city', $user->city) }}">
            @error('city')<div class="form-error">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="country" class="form-label">Pays</label>
            <input type="text" id="country" name="country"
                   class="form-control @error('country') has-error @enderror"
                   value="{{ old('country', $user->country) }}">
            @error('country')<div class="form-error">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="form-group">
          <label for="address" class="form-label">Adresse</label>
          <input type="text" id="address" name="address"
                 class="form-control @error('address') has-error @enderror"
                 value="{{ old('address', $user->address) }}">
          @error('address')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label for="timezone" class="form-label">Fuseau horaire</label>
          <select id="timezone" name="timezone" class="form-control @error('timezone') has-error @enderror">
            @foreach([
              'Europe/Paris'        => 'Europe/Paris (GMT +1:00)',
              'Europe/London'       => 'Europe/London (GMT +0:00)',
              'Europe/Berlin'       => 'Europe/Berlin (GMT +1:00)',
              'Africa/Casablanca'   => 'Africa/Casablanca (GMT +1:00)',
              'Africa/Tunis'        => 'Africa/Tunis (GMT +1:00)',
              'Africa/Algiers'      => 'Africa/Algiers (GMT +1:00)',
              'America/New_York'    => 'America/New_York (GMT -5:00)',
              'America/Los_Angeles' => 'America/Los_Angeles (GMT -8:00)',
              'America/Montreal'    => 'America/Montreal (GMT -5:00)',
              'Asia/Dubai'          => 'Asia/Dubai (GMT +4:00)',
              'Asia/Tokyo'          => 'Asia/Tokyo (GMT +9:00)',
            ] as $tz => $label)
              <option value="{{ $tz }}" {{ old('timezone', $user->timezone ?? 'Europe/Paris') == $tz ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
          @error('timezone')<div class="form-error">{{ $message }}</div>@enderror
        </div>
      </div>

      {{-- Connexions sociales --}}
      <div class="social-connections">
        <h3 class="form-section-title">Connexions sociales</h3>
        <div class="social-connection-item">
          <div class="social-connection-info">
            <div class="social-icon facebook">f</div>
            <div class="social-connection-text">
              <strong>Facebook</strong>
              <span>Le compte Facebook n'est pas connecte</span>
            </div>
          </div>
          <button type="button" class="social-connection-action" id="connect-facebook">Connecter</button>
        </div>
        <div class="social-connection-item">
          <div class="social-connection-info">
            <div class="social-icon google">G</div>
            <div class="social-connection-text">
              <strong>Google</strong>
              <span>
                @if($user->provider == 'google')
                  Connecte(e) en tant que {{ $user->email_address }}
                @else
                  Le compte Google n'est pas connecte
                @endif
              </span>
            </div>
          </div>
          @if($user->provider == 'google')
            <button type="button" class="social-connection-action connected" id="disconnect-google">Deconnecter</button>
          @else
            <button type="button" class="social-connection-action" id="connect-google">Connecter</button>
          @endif
        </div>
      </div>

      {{-- Bouton sauvegarder --}}
      <div class="settings-form-submit">
        <button type="submit" class="btn-save">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.3"
               style="display:inline;vertical-align:middle;margin-right:6px;">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
            <polyline points="17,21 17,13 7,13 7,21"/>
            <polyline points="7,3 7,8 15,8"/>
          </svg>
          Enregistrer les modifications
        </button>
      </div>
    </form>
  </div>{{-- /cs-profile-card --}}

</div>{{-- /settings-container --}}

<script>
  // Preview photo de profil
  document.getElementById('profile-photo-input')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
      const preview = document.getElementById('profile-photo-preview');
      if (preview.tagName === 'IMG') {
        preview.src = ev.target.result;
      } else {
        const img = document.createElement('img');
        img.src = ev.target.result;
        img.className = 'profile-photo-preview';
        img.id = 'profile-photo-preview';
        img.alt = 'Photo de profil';
        preview.parentNode.replaceChild(img, preview);
      }
    };
    reader.readAsDataURL(file);
  });

  // OAuth placeholders
  document.getElementById('connect-facebook')?.addEventListener('click', () => {
    alert('La connexion Facebook sera disponible prochainement.');
  });
  document.getElementById('connect-google')?.addEventListener('click', () => {
    alert('La connexion Google sera disponible prochainement.');
  });
  document.getElementById('disconnect-google')?.addEventListener('click', function() {
    if (confirm('Etes-vous sur de vouloir deconnecter votre compte Google ?')) {
      alert('La deconnexion sera disponible prochainement.');
    }
  });

  // Smooth scroll vers #profil
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
</script>
@endsection
