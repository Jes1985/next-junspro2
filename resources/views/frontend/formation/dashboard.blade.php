@extends('frontend.layout')

@php
  $spaceKey = $spaceKey ?? 'formation';
  $dashboardRouteName = $dashboardRouteName ?? 'formation.dashboard';
  $moduleRouteName = $moduleRouteName ?? 'formation.module.show';
  $moduleStartRouteName = $moduleStartRouteName ?? 'formation.module.start';
  $attestationRouteName = $attestationRouteName ?? 'formation.attestation';
  $showPraticienExtras = $showPraticienExtras ?? true;
  $showAttestationBanner = $showAttestationBanner ?? true;
  $language = $language ?? 'fr';
  $pageTitle = $spaceKey === 'parcours'
    ? ($language === 'en' ? 'My Journey Space' : 'Mon Espace Parcours')
    : ($language === 'en' ? 'My Training Space' : 'Mon Espace Formation');
  $heroEyebrow = $spaceKey === 'parcours'
    ? ($language === 'en' ? 'Journey Space · Junspro' : 'Espace Parcours · Junspro')
    : ($language === 'en' ? 'Training Space · Junspro' : 'Espace Formation · Junspro');
  $heroSubtitle = $spaceKey === 'parcours'
    ? ($language === 'en' ? 'Personal transformation · Breathe Break' : 'Transformation personnelle · Pause Souffle')
    : ($language === 'en' ? 'Certified training · Freelance Breathe Break' : 'Formation certifiante · Freelance Pause Souffle');
@endphp

@section('pageHeading', __($pageTitle))

@section('style')
<style>
/* ── FORMATION DASHBOARD ─────────────────────────────────── */
:root {
  --fd-gold: #c9a84c;
  --fd-gold-light: #e8d17a;
  --fd-dark: #0f0f0f;
  --fd-surface: #1a1a1a;
  --fd-surface2: #242424;
  --fd-border: rgba(201,168,76,.18);
  --fd-text: #e8e0d0;
  --fd-muted: rgba(232,224,208,.5);
  --fd-green: #22c55e;
  --fd-orange: #f59e0b;
  --fd-blue: #3b82f6;
  --fd-locked: #4b5563;
}

.fd-page {
  min-height: 100vh;
  background: var(--fd-dark);
  color: var(--fd-text);
  font-family: 'Segoe UI', system-ui, sans-serif;
  padding: 0 0 4rem;
}

/* Flash messages */
.fd-flash { padding: 1rem 2rem 0; max-width: 860px; margin: 0 auto; }
.fd-flash__inner { border-radius: 10px; padding: .85rem 1.25rem; font-size: .9rem; margin-bottom: .5rem; }
.fd-flash__inner--success { background: rgba(34,197,94,.12); border: 1px solid rgba(34,197,94,.3); color: #86efac; }
.fd-flash__inner--info    { background: rgba(59,130,246,.12); border: 1px solid rgba(59,130,246,.3); color: #93c5fd; }
.fd-flash__inner--error   { background: rgba(239,68,68,.12); border: 1px solid rgba(239,68,68,.3); color: #fca5a5; }

/* Hero */
.fd-hero {
  background: linear-gradient(135deg, #1a0e00 0%, #0f0f0f 55%, #0a0a1a 100%);
  border-bottom: 1px solid var(--fd-border);
  padding: 3rem 2rem 2.5rem;
}
.fd-hero__inner { max-width: 860px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 2rem; flex-wrap: wrap; }
.fd-hero__eyebrow { font-size: .75rem; letter-spacing: .15em; text-transform: uppercase; color: var(--fd-gold); margin-bottom: .5rem; }
.fd-hero__name { font-size: 1.7rem; font-weight: 700; color: #fff; margin: 0 0 .4rem; }
.fd-hero__sub  { font-size: .9rem; color: var(--fd-muted); }
.fd-hero__badge {
  background: linear-gradient(135deg, #3d2a00, #1a1200);
  border: 1.5px solid var(--fd-gold);
  border-radius: 14px;
  padding: 1.2rem 1.8rem;
  text-align: center;
  min-width: 170px;
}
.fd-hero__badge-pct { font-size: 2.2rem; font-weight: 800; color: var(--fd-gold); line-height: 1; }
.fd-hero__badge-label { font-size: .7rem; text-transform: uppercase; letter-spacing: .1em; color: var(--fd-muted); margin-top: .3rem; }

/* Progression globale */
.fd-progress-bar-wrap { max-width: 860px; margin: 0 auto; padding: 1.5rem 2rem 0; }
.fd-progress-track { height: 6px; background: rgba(255,255,255,.1); border-radius: 3px; overflow: hidden; }
.fd-progress-fill  { height: 100%; background: linear-gradient(90deg, var(--fd-gold), var(--fd-gold-light)); border-radius: 3px; transition: width .6s ease; }

/* Attestation banner */
.fd-attestation-banner {
  max-width: 860px;
  margin: 2rem auto 0;
  padding: 0 2rem;
}
.fd-attestation-banner__inner {
  background: linear-gradient(135deg, rgba(201,168,76,.15), rgba(201,168,76,.05));
  border: 1.5px solid var(--fd-gold);
  border-radius: 14px;
  padding: 1.5rem 2rem;
  display: flex;
  align-items: center;
  gap: 1.5rem;
  flex-wrap: wrap;
}
.fd-attestation-banner__icon { font-size: 2.5rem; line-height: 1; }
.fd-attestation-banner__body { flex: 1; }
.fd-attestation-banner__title { font-size: 1rem; font-weight: 700; color: var(--fd-gold); margin: 0 0 .3rem; }
.fd-attestation-banner__code {
  font-family: 'Courier New', monospace;
  font-size: .95rem;
  color: #fff;
  background: rgba(0,0,0,.4);
  padding: .3rem .8rem;
  border-radius: 6px;
  display: inline-block;
  letter-spacing: .08em;
}

/* Modules grid */
.fd-modules { max-width: 860px; margin: 2.5rem auto 0; padding: 0 2rem; }
.fd-modules__title { font-size: .75rem; letter-spacing: .12em; text-transform: uppercase; color: var(--fd-muted); margin-bottom: 1.2rem; }
.fd-module-card {
  background: var(--fd-surface);
  border: 1px solid var(--fd-border);
  border-radius: 14px;
  padding: 1.4rem 1.5rem;
  margin-bottom: .85rem;
  display: flex;
  align-items: center;
  gap: 1.2rem;
  transition: border-color .2s, background .2s;
}
.fd-module-card:hover:not(.fd-module-card--locked) { border-color: rgba(201,168,76,.4); background: var(--fd-surface2); }
.fd-module-card--locked { opacity: .45; }
.fd-module-card--completed { border-color: rgba(34,197,94,.25); background: rgba(34,197,94,.04); }
.fd-module-num {
  width: 42px; height: 42px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: .85rem; font-weight: 700;
  flex-shrink: 0;
}
.fd-module-num--locked      { background: rgba(75,85,99,.2); color: var(--fd-locked); border: 1.5px solid #374151; }
.fd-module-num--available   { background: rgba(201,168,76,.15); color: var(--fd-gold); border: 1.5px solid var(--fd-gold); }
.fd-module-num--in_progress { background: rgba(59,130,246,.15); color: var(--fd-blue); border: 1.5px solid var(--fd-blue); }
.fd-module-num--completed   { background: rgba(34,197,94,.12); color: var(--fd-green); border: 1.5px solid var(--fd-green); }
.fd-module-body { flex: 1; min-width: 0; }
.fd-module-week { font-size: .7rem; text-transform: uppercase; letter-spacing: .1em; color: var(--fd-muted); }
.fd-module-title { font-size: .95rem; font-weight: 600; color: #fff; margin-top: .15rem; }
.fd-module-pct { font-size: .75rem; color: var(--fd-muted); margin-top: .2rem; }
.fd-module-status-badge {
  font-size: .7rem; text-transform: uppercase; letter-spacing: .07em;
  padding: .3rem .75rem; border-radius: 20px; font-weight: 600;
}
.fd-badge--locked      { background: rgba(75,85,99,.2); color: #9ca3af; }
.fd-badge--available   { background: rgba(201,168,76,.15); color: var(--fd-gold); }
.fd-badge--in_progress { background: rgba(59,130,246,.15); color: #93c5fd; }
.fd-badge--completed   { background: rgba(34,197,94,.12); color: #86efac; }
.fd-module-actions { display: flex; gap: .6rem; flex-wrap: wrap; align-items: center; }
.fd-btn-sm {
  font-size: .8rem; font-weight: 600; padding: .4rem 1rem;
  border-radius: 8px; cursor: pointer; border: none;
  text-decoration: none; display: inline-flex; align-items: center; gap: .35rem;
  transition: opacity .2s;
}
.fd-btn-sm:hover { opacity: .85; }
.fd-btn--gold    { background: var(--fd-gold); color: #000; }
.fd-btn--outline { background: transparent; border: 1px solid rgba(255,255,255,.2); color: var(--fd-text); }
.fd-btn--green   { background: rgba(34,197,94,.15); color: #86efac; border: 1px solid rgba(34,197,94,.25); }

/* Retour */
.fd-back { max-width: 860px; margin: 2rem auto 0; padding: 0 2rem; }
.fd-back a { font-size: .85rem; color: var(--fd-muted); text-decoration: none; display: inline-flex; align-items: center; gap: .4rem; }
.fd-back a:hover { color: var(--fd-gold); }

/* Panneau détail module */
.fd-module-detail {
  max-width: 860px; margin: 0 auto 1rem; padding: 0 2rem;
  display: none;
}
.fd-module-detail.is-open { display: block; }
.fd-module-detail__inner {
  background: var(--fd-surface2);
  border: 1px solid rgba(201,168,76,.2);
  border-radius: 16px;
  padding: 1.8rem 2rem;
  animation: fdSlideIn .25s ease;
}
@keyframes fdSlideIn { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }
.fd-module-detail__intro {
  font-size: .95rem; line-height: 1.8; color: rgba(255,255,255,.75);
  margin-bottom: 1.4rem; white-space: pre-line;
}

/* Lecteur audio */
.fd-audio-player {
  background: rgba(0,0,0,.3);
  border: 1px solid rgba(201,168,76,.25);
  border-radius: 12px;
  padding: 1.1rem 1.4rem;
  margin-bottom: 1.6rem;
  display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
}
.fd-audio-icon { color: var(--fd-gold); flex-shrink: 0; }
.fd-audio-label { font-size: .8rem; color: var(--fd-muted); text-transform: uppercase; letter-spacing: .1em; flex: 1; min-width: 140px; }
.fd-audio-player audio { flex: 1; min-width: 200px; height: 36px; opacity: .85; }
.fd-audio-player audio::-webkit-media-controls-panel { background: #1e1e2e; }

/* Activités */
.fd-activities-title { font-size: .7rem; text-transform: uppercase; letter-spacing: .12em; color: var(--fd-muted); margin-bottom: .8rem; }
.fd-activity-row {
  display: flex; gap: .9rem; align-items: flex-start;
  padding: .85rem 1rem; border-radius: 10px;
  background: rgba(255,255,255,.03);
  border: 1px solid rgba(255,255,255,.05);
  margin-bottom: .5rem;
}
.fd-activity-icon {
  width: 34px; height: 34px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1rem; flex-shrink: 0;
}
.fd-ai-lecture  { background: rgba(124,58,237,.15); }
.fd-ai-pratique { background: rgba(201,168,76,.12); }
.fd-ai-ecriture { background: rgba(59,130,246,.12); }
.fd-ai-exercice { background: rgba(239,68,68,.1); }
.fd-ai-reflexion{ background: rgba(16,185,129,.1); }
.fd-activity-body { flex: 1; }
.fd-activity-title { font-size: .9rem; font-weight: 600; color: #fff; }
.fd-activity-meta  { font-size: .75rem; color: var(--fd-muted); margin-top: .15rem; }
.fd-activity-desc  { font-size: .82rem; color: rgba(255,255,255,.55); margin-top: .35rem; line-height: 1.6; }
.fd-module-conclusion {
  margin-top: 1.2rem; padding: .8rem 1.2rem;
  background: rgba(201,168,76,.07);
  border-left: 3px solid var(--fd-gold);
  border-radius: 0 8px 8px 0;
  font-size: .88rem; font-style: italic; color: var(--fd-gold);
}

@media (max-width: 600px) {
  .fd-hero__inner { flex-direction: column; }
  .fd-module-card { flex-wrap: wrap; }
  .fd-audio-player { flex-direction: column; align-items: flex-start; }
}
</style>
@endsection

@section('content')
<div class="fd-page">

  {{-- Flash messages --}}
  @if(session('success') || session('info') || session('error'))
  <div class="fd-flash">
    @if(session('success'))
      <div class="fd-flash__inner fd-flash__inner--success">{{ session('success') }}</div>
    @endif
    @if(session('info'))
      <div class="fd-flash__inner fd-flash__inner--info">{{ session('info') }}</div>
    @endif
    @if(session('error'))
      <div class="fd-flash__inner fd-flash__inner--error">{{ session('error') }}</div>
    @endif
  </div>
  @endif

  {{-- Hero --}}
  <div class="fd-hero">
    <div class="fd-hero__inner">
      <div>
        <div class="fd-hero__eyebrow">{{ $heroEyebrow }}</div>
        <h1 class="fd-hero__name">{{ auth()->user()->first_name ?? auth()->user()->name ?? 'Praticien' }}</h1>
        <p class="fd-hero__sub">{{ $heroSubtitle }}</p>
      </div>
      <div class="fd-hero__badge">
        <div class="fd-hero__badge-pct">{{ round($global_progress) }}%</div>
        <div class="fd-hero__badge-label">{{ $language === 'en' ? 'Progress' : 'Progression' }}</div>
      </div>
    </div>
  </div>

  {{-- Barre de progression --}}
  <div class="fd-progress-bar-wrap">
    <div class="fd-progress-track">
      <div class="fd-progress-fill" style="width: {{ $global_progress }}%"></div>
    </div>
  </div>

  {{-- Bannière attestation (si certifié PRATICIEN — rétrocompatibilité) --}}
  @if($showAttestationBanner && $is_certified)
  <div class="fd-attestation-banner">
    <div class="fd-attestation-banner__inner">
      <div class="fd-attestation-banner__icon">🏅</div>
      <div class="fd-attestation-banner__body">
        <p class="fd-attestation-banner__title">Attestation Officielle Junspro délivrée !</p>
        <p style="font-size:.85rem; color:rgba(232,224,208,.6); margin:.2rem 0 .6rem">
          Votre code d'attestation certifiée :
        </p>
        <span class="fd-attestation-banner__code">{{ $attestation_code }}</span>
        <div style="margin-top:.9rem;">
          <a href="{{ route($attestationRouteName) }}" style="display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#c9a84c,#a07820);color:#1a0e00;padding:.55rem 1.2rem;border-radius:9px;font-size:.82rem;font-weight:700;text-decoration:none;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 12l2 2 4-4"/></svg>
            Voir mon attestation
          </a>
        </div>
      </div>
    </div>
  </div>
  @endif

  {{-- ── CERTIFICATIONS PARCOURS (Niveaux 1, 2 & 3) ─────────────────────────── --}}
  @if($showAttestationBanner && !empty($is_certified_level_3))
  {{-- Certification Niveau 3 · Maître --}}
  <div class="fd-attestation-banner" style="background:linear-gradient(135deg,rgba(20,184,166,.18),rgba(16,185,129,.10));border-top:2px solid rgba(20,184,166,.6);">
    <div class="fd-attestation-banner__inner">
      <div class="fd-attestation-banner__icon">🏆</div>
      <div class="fd-attestation-banner__body">
        <p class="fd-attestation-banner__title" style="font-size:1.05rem;background:linear-gradient(90deg,#5eead4,#34d399);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Certification Niveau 3 · Praticien Pause Souffle · Maître</p>
        <p style="font-size:.82rem;color:rgba(232,224,208,.55);margin:.15rem 0 .5rem;">
          Vous avez complété les 3 Parcours — 39 modules. Vous êtes Maître Pause Souffle.
        </p>
        <p style="font-size:.75rem;color:rgba(232,224,208,.4);margin:0 0 .6rem;">Code : <span style="font-family:monospace;color:rgba(20,184,166,.9);letter-spacing:.08em;">{{ $attestation_code_lvl3 ?? '' }}</span></p>
        <a href="{{ route($attestationRouteName) }}" style="display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#14b8a6,#0d9488);color:#fff;padding:.5rem 1.1rem;border-radius:9px;font-size:.8rem;font-weight:700;text-decoration:none;">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 12l2 2 4-4"/></svg>
          Voir ma certification Maître
        </a>
      </div>
    </div>
  </div>
  @elseif($showAttestationBanner && !empty($is_certified_level_2))
  {{-- Certification Niveau 2 · Ancrage --}}
  <div class="fd-attestation-banner" style="background:linear-gradient(135deg,rgba(168,112,32,.18),rgba(201,168,76,.10));border-top:2px solid rgba(201,168,76,.6);">
    <div class="fd-attestation-banner__inner">
      <div class="fd-attestation-banner__icon">🎓</div>
      <div class="fd-attestation-banner__body">
        <p class="fd-attestation-banner__title" style="font-size:1.05rem;">Certification Niveau 2 · Praticien Pause Souffle · Ancrage</p>
        <p style="font-size:.82rem;color:rgba(232,224,208,.55);margin:.15rem 0 .5rem;">
          Parcours 1 & 2 complétés — 23 modules · Fondations solides de votre transformation.
        </p>
        <p style="font-size:.75rem;color:rgba(232,224,208,.4);margin:0 0 .6rem;">Code : <span style="font-family:monospace;color:rgba(201,168,76,.9);letter-spacing:.08em;">{{ $attestation_code_lvl2 }}</span></p>
        <a href="{{ route($attestationRouteName) }}" style="display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#c9a84c,#a07820);color:#1a0e00;padding:.5rem 1.1rem;border-radius:9px;font-size:.8rem;font-weight:700;text-decoration:none;">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 12l2 2 4-4"/></svg>
          Voir ma certification Ancrage
        </a>
      </div>
    </div>
  </div>

  {{-- Upsell Parcours 3 pour les certifiés Niveau 2 --}}
  <div style="background:linear-gradient(135deg,rgba(20,184,166,.08),rgba(16,185,129,.05));border:1px solid rgba(20,184,166,.22);border-radius:14px;padding:1.4rem 1.6rem;margin:.5rem 0 1rem;">
    <div style="display:flex;align-items:flex-start;gap:1rem;flex-wrap:wrap;">
      <div style="font-size:1.8rem;line-height:1;">🌊</div>
      <div style="flex:1;min-width:200px;">
        <p style="font-size:.72rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(20,184,166,.7);margin:0 0 .3rem;">Dernière étape</p>
        <p style="font-size:1rem;font-weight:700;color:rgba(232,224,208,.95);margin:0 0 .25rem;">Parcours 3 — S'Ouvrir</p>
        <p style="font-size:.82rem;color:rgba(232,224,208,.5);margin:0 0 .75rem;line-height:1.5;">
          16 modules · Certification Niveau 3 · Maître Pause Souffle<br>
          <em style="color:rgba(20,184,166,.65);">Vous vous êtes retrouvé(e). Vous vous êtes construit(e). Maintenant, ouvrez-vous au monde.</em>
        </p>
        <a href="{{ route('parcours.upgrade') ?? '#' }}" style="display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#14b8a6,#0d9488);color:#fff;padding:.55rem 1.2rem;border-radius:9px;font-size:.82rem;font-weight:700;text-decoration:none;">
          Accéder au Parcours 3 — 2 990 €
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </div>
  @elseif($showAttestationBanner && !empty($is_certified_level_1))
  {{-- Certification Niveau 1 · Éveil --}}
  <div class="fd-attestation-banner" style="background:linear-gradient(135deg,rgba(59,130,246,.10),rgba(99,102,241,.08));border-top:2px solid rgba(99,102,241,.45);">
    <div class="fd-attestation-banner__inner">
      <div class="fd-attestation-banner__icon">🌟</div>
      <div class="fd-attestation-banner__body">
        <p class="fd-attestation-banner__title" style="font-size:1.05rem;background:linear-gradient(90deg,#93c5fd,#a5b4fc);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Certification Niveau 1 · Praticien Pause Souffle · Éveil</p>
        <p style="font-size:.82rem;color:rgba(232,224,208,.55);margin:.15rem 0 .5rem;">
          Parcours 1 «&nbsp;Se Retrouver&nbsp;» complété. Vous pouvez dès maintenant proposer vos <strong style="-webkit-text-fill-color:rgba(232,224,208,.85);">accompagnements Pause Souffle</strong>.
        </p>
        <p style="font-size:.75rem;color:rgba(232,224,208,.4);margin:0 0 .8rem;">Code : <span style="font-family:monospace;color:rgba(147,197,253,.9);letter-spacing:.08em;">{{ $attestation_code_lvl1 }}</span></p>
        <div style="display:flex;flex-wrap:wrap;gap:.6rem;">
          <a href="{{ route($attestationRouteName) }}" style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(99,102,241,.2);border:1px solid rgba(99,102,241,.5);color:#c7d2fe;padding:.48rem 1rem;border-radius:9px;font-size:.8rem;font-weight:700;text-decoration:none;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 12l2 2 4-4"/></svg>
            Voir ma certification Éveil
          </a>
        </div>
      </div>
    </div>
  </div>

  {{-- Upsell Parcours 2 pour les certifiés Niveau 1 --}}
  <div style="background:linear-gradient(135deg,rgba(201,168,76,.08),rgba(168,112,32,.05));border:1px solid rgba(201,168,76,.22);border-radius:14px;padding:1.4rem 1.6rem;margin:.5rem 0 1rem;">
    <div style="display:flex;align-items:flex-start;gap:1rem;flex-wrap:wrap;">
      <div style="font-size:1.8rem;line-height:1;">✨</div>
      <div style="flex:1;min-width:200px;">
        <p style="font-size:.72rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(201,168,76,.7);margin:0 0 .3rem;">Prochaine étape</p>
        <p style="font-size:1rem;font-weight:700;color:rgba(232,224,208,.95);margin:0 0 .25rem;">Parcours 2 — Se Construire</p>
        <p style="font-size:.82rem;color:rgba(232,224,208,.5);margin:0 0 .75rem;line-height:1.5;">
          13 modules · Certification Niveau 2 · Ancrage · Priorités, discipline, corps, émotions<br>
          <em style="color:rgba(201,168,76,.65);">Vous vous êtes retrouvé(e). Maintenant construisez les fondations qui durent.</em>
        </p>
        <a href="{{ route('parcours.upgrade') ?? '#' }}" style="display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#c9a84c,#a07820);color:#1a0e00;padding:.55rem 1.2rem;border-radius:9px;font-size:.82rem;font-weight:700;text-decoration:none;">
          Accéder au Parcours 2 — 2 990 €
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </div>
  @endif

  {{-- Bannière Mode Créateur --}}
  @if(!empty($creator_mode))
  <div style="background:linear-gradient(90deg,rgba(201,168,76,.12),rgba(201,168,76,.06));border-top:1px solid rgba(201,168,76,.35);border-bottom:1px solid rgba(201,168,76,.35);padding:.65rem 1.5rem;display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;flex-wrap:wrap;">
    <span style="font-size:1rem;">🔑</span>
    <span style="font-size:.78rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.95);text-transform:uppercase;">Mode Créateur</span>
    <span style="font-size:.75rem;color:rgba(255,255,255,.45);">— Tous les modules accessibles sans progression requise</span>
    <div style="margin-left:auto;display:flex;gap:.5rem;">
      @if($spaceKey === 'parcours')
        <a href="{{ route('formation.dashboard') }}" style="font-size:.75rem;font-weight:600;color:rgba(201,168,76,.9);background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.35);padding:.3rem .8rem;border-radius:6px;text-decoration:none;">
          Espace Formation →
        </a>
      @else
        <a href="{{ route('parcours.dashboard') }}" style="font-size:.75rem;font-weight:600;color:rgba(201,168,76,.9);background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.35);padding:.3rem .8rem;border-radius:6px;text-decoration:none;">
          Espace Parcours →
        </a>
      @endif
    </div>
  </div>
  @endif

  <div class="fd-modules">
    <div class="fd-modules__title">{{ $language === 'en' ? 'Your modules' : 'Modules de votre espace' }}</div>
    @php $__lastPart = null; @endphp
    @foreach($modules as $item)
      @php
        $mod    = $item['module'];
        $status = $item['status'];
        $pct    = $item['completion_pct'];
        $moduleSlugKey = preg_replace('/^formation-/', '', $mod->slug);
        $statusLabels = $language === 'en' ? [
          'locked'      => 'Locked',
          'available'   => 'Available',
          'in_progress' => 'In progress',
          'completed'   => 'Completed',
        ] : [
          'locked'      => 'Verrouillé',
          'available'   => 'Disponible',
          'in_progress' => 'En cours',
          'completed'   => 'Terminé',
        ];
        $label = $statusLabels[$status] ?? $status;
        $__currentPart = $mod->part;
      @endphp

      {{-- ─ En-tête de section Formation (Parcours uniquement) ─ --}}
      @if($spaceKey === 'parcours' && $__currentPart !== null && $__currentPart !== $__lastPart)
        @if($__currentPart == 1)
          <div style="margin:1.5rem 0 .6rem;display:flex;align-items:center;gap:.75rem;">
            <div style="flex:1;height:1px;background:linear-gradient(90deg,rgba(99,102,241,.35),transparent);"></div>
            <span style="font-size:.68rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(99,102,241,.7);background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.25);padding:.25rem .75rem;border-radius:20px;white-space:nowrap;">🌱 Parcours 1 — Se Retrouver · Certification Niveau 1 · Éveil</span>
            <div style="flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(99,102,241,.35));"></div>
          </div>
        @elseif($__currentPart == 2)
          <div style="margin:2rem 0 .6rem;display:flex;align-items:center;gap:.75rem;">
            <div style="flex:1;height:1px;background:linear-gradient(90deg,rgba(201,168,76,.35),transparent);"></div>
            <span style="font-size:.68rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(201,168,76,.8);background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.28);padding:.25rem .75rem;border-radius:20px;white-space:nowrap;">🔥 Parcours 2 — Se Construire · Certification Niveau 2 · Ancrage</span>
            <div style="flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(201,168,76,.35));"></div>
          </div>
        @elseif($__currentPart == 3)
          <div style="margin:2rem 0 .6rem;display:flex;align-items:center;gap:.75rem;">
            <div style="flex:1;height:1px;background:linear-gradient(90deg,rgba(20,184,166,.35),transparent);"></div>
            <span style="font-size:.68rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(20,184,166,.85);background:rgba(20,184,166,.08);border:1px solid rgba(20,184,166,.28);padding:.25rem .75rem;border-radius:20px;white-space:nowrap;">🌊 Parcours 3 — S'Ouvrir · Certification Niveau 3 · Maître</span>
            <div style="flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(20,184,166,.35));"></div>
          </div>
        @endif
        @php $__lastPart = $__currentPart; @endphp
      @endif
      <div class="fd-module-card fd-module-card--{{ $status }}">
        <div class="fd-module-num fd-module-num--{{ $status }}">{{ $mod->display_order }}</div>
        <div class="fd-module-body">
          <div class="fd-module-week">{{ $mod->week_label }}</div>
          <div class="fd-module-title">{{ $mod->title }}</div>
          @if($mod->description)
            <div class="fd-module-pct" style="color:rgba(255,255,255,.45);margin-top:.2rem">{{ $mod->description }}</div>
          @endif
          @if($status === 'in_progress')
            <div class="fd-module-pct" style="margin-top:.3rem">{{ $pct }}% {{ $language === 'en' ? 'completed' : 'complété' }}</div>
          @endif
        </div>
        <div class="fd-module-actions">
          <span class="fd-module-status-badge fd-badge--{{ $status }}">{{ $label }}</span>
          @if($status !== 'locked')
            <a href="{{ route($moduleRouteName, $mod->slug) }}" class="fd-btn-sm fd-btn--outline">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg>
              {{ $language === 'en' ? 'View content' : 'Voir le contenu' }}
            </a>
          @endif
          @if($status === 'available')
            <form method="POST" action="{{ route($moduleStartRouteName, $mod->id) }}" style="display:inline;">
              @csrf
              <button type="submit" class="fd-btn-sm fd-btn--gold" onclick="this.form.submit(); window.location='{{ route($moduleRouteName, $mod->slug) }}';">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                {{ $language === 'en' ? 'Start' : 'Commencer' }}
              </button>
            </form>
          @elseif($status === 'in_progress')
            <a href="{{ route($moduleRouteName, $mod->slug) }}" class="fd-btn-sm fd-btn--gold">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              {{ $language === 'en' ? 'Continue' : 'Continuer' }}
            </a>
          @elseif($status === 'completed')
            <span class="fd-btn-sm fd-btn--green">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12l5 5L20 7"/></svg>
              {{ $language === 'en' ? 'Completed' : 'Terminé' }}
            </span>
          @endif
        </div>
      </div>

      {{-- Panneau détail module --}}
      @if($status !== 'locked')
      @php
        $rawActivities = ($language === 'en' && !empty($mod->activities_en))
          ? $mod->activities_en
          : $mod->activities;
        $activities = is_array($rawActivities) ? $rawActivities : json_decode($rawActivities ?? '[]', true);
        $iconMap = ['lecture'=>'📖','pratique'=>'🌬️','ecriture'=>'✍️','exercice'=>'💡','reflexion'=>'🔍'];
      @endphp
      <div class="fd-module-detail" id="detail-{{ $mod->slug }}">
        <div class="fd-module-detail__inner">

          {{-- Lecteur audio --}}
          @if($mod->audio_path)
          <div class="fd-audio-player">
            <div class="fd-audio-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/></svg>
            </div>
            <div class="fd-audio-label">{{ $language === 'en' ? 'Listen to the guided module' : 'Écouter le module guidé' }}</div>
            <audio controls preload="none">
              <source src="{{ asset('storage/' . $mod->audio_path) }}" type="audio/mpeg">
              {{ $language === 'en' ? 'Your browser does not support audio.' : 'Votre navigateur ne supporte pas l\'audio.' }}
            </audio>
          </div>
          @endif

          {{-- Intro textuelle --}}
          @php $displayIntro = ($language === 'en' && !empty($mod->intro_text_en)) ? $mod->intro_text_en : $mod->intro_text; @endphp
          @if($displayIntro ?? '')
          <div class="fd-module-detail__intro">{{ $displayIntro }}</div>
          @endif

          {{-- Activités --}}
          @if(count($activities) > 0)
          <div class="fd-activities-title">{{ $language === 'en' ? 'Activities in this module' : 'Activités de ce module' }}</div>
          @foreach($activities as $act)
          <div class="fd-activity-row">
            <div class="fd-activity-icon fd-ai-{{ $act['type'] ?? 'pratique' }}">{{ $iconMap[$act['type'] ?? 'pratique'] ?? '▸' }}</div>
            <div class="fd-activity-body">
              <div class="fd-activity-title">{{ $act['title'] }}</div>
              <div class="fd-activity-meta">{{ ucfirst($act['type'] ?? '') }} · {{ $act['duration'] ?? '' }}</div>
              @if(!empty($act['description']))
              <div class="fd-activity-desc">{{ $act['description'] }}</div>
              @endif
            </div>
          </div>
          @endforeach
          @endif

          {{-- Conclusion --}}
          @php
            $conclusions = [
              '01-je-me-rencontre'          => 'Infiniment + présent(e) à vous-même qu\'au début de cette semaine.',
              '02-je-reconnais-mes-blessures'=> 'Infiniment + proche de vous-même dans votre vérité.',
              '03-je-decris-mon-bonheur'    => 'Infiniment + proche de votre propre boussole intérieure.',
              '04-j-ecoute-mon-souffle'     => 'Infiniment + à l\'écoute de votre souffle intérieur.',
              '05-je-decouvre-ma-mission'   => 'Infiniment + proche de votre raison d\'être.',
              '06-je-visualise-ma-vie'      => 'Infiniment + conscient(e) de la vie que vous appelez et de celle que vous construisez.',
              '07-je-transmets-le-rituel'   => 'Vous avez fait le voyage. Vous pouvez maintenant le transmettre avec justesse.',
              '08-je-maitrise-la-vision'    => 'La vision n\'est plus une idée. Elle devient une pratique incarnée.',
            ];
          @endphp
          @if(isset($conclusions[$moduleSlugKey]))
          <div class="fd-module-conclusion">{{ $conclusions[$moduleSlugKey] }}</div>
          @endif

        </div>
      </div>
      @endif

    @endforeach

  </div>

  @if($showPraticienExtras)
  {{-- Bannière Ma Pause Souffle — Module d'intégration --}}
  <div style="margin: 2rem 0; position:relative; overflow:hidden; background:linear-gradient(135deg,#0a0a0a,#080a0f); border:1px solid rgba(201,168,76,.22); border-radius:18px; padding:2rem 2.5rem;">
    <div style="position:absolute;top:-30px;right:-30px;width:160px;height:160px;background:radial-gradient(circle,rgba(201,168,76,.07),transparent 70%);pointer-events:none;"></div>
    <div style="display:flex;align-items:flex-start;gap:1.5rem;flex-wrap:wrap;">
      <div style="flex:1;min-width:240px;">
        <div style="font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;color:rgba(201,168,76,.6);margin-bottom:.6rem;">
          Module d'intégration · Votre pratique amplifiée
        </div>
        <h3 style="font-size:1.2rem;font-weight:300;font-family:Georgia,serif;color:#fff;line-height:1.35;margin:0 0 .55rem;">
          Ma Pause Souffle —<br><em style="color:#c9a84c;font-style:italic;">Le 5-5-5 dans votre univers</em>
        </h3>
        <p style="font-size:.84rem;color:rgba(232,224,208,.5);line-height:1.8;margin:0 0 1.1rem;max-width:400px;">
          Potier, prof de yoga, manager, éducateur, soignant — le protocole ne change pas. Ce qui change, c'est où vous l'activez. Construisez votre signature personnelle.
        </p>
        <a href="{{ route('formation.ma-pause-souffle') }}" style="display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.35rem;background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.3);color:#c9a84c;border-radius:50px;font-size:.8rem;font-weight:600;text-decoration:none;transition:background .2s;">
          <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/></svg>
          Découvrir mon module
        </a>
      </div>
      <div style="display:flex;flex-direction:column;gap:.45rem;min-width:160px;">
        @foreach([['🎨','Créateurs & artisans'],['🤲','Soignants & thérapeutes'],['🧘','Enseignants du corps'],['🏢','Leaders & managers'],['📚','Éducateurs & profs']] as [$icon,$label])
        <div style="display:flex;align-items:center;gap:.55rem;font-size:.76rem;color:rgba(232,224,208,.55);">
          <span style="width:22px;height:22px;background:rgba(201,168,76,.07);border:1px solid rgba(201,168,76,.12);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:.78rem;flex-shrink:0;">{{ $icon }}</span>
          {{ $label }}
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif

  @if($showPraticienExtras)
  {{-- Bannière Séance Visio 20% --}}
  <div style="margin: 2rem 0; position:relative; overflow:hidden; background: linear-gradient(135deg, #0a0a0a, #160d00); border: 1px solid rgba(201,168,76,.3); border-radius: 18px; padding: 2rem 2.5rem;">
    <div style="position:absolute; top:-40px; right:-40px; width:180px; height:180px; background:radial-gradient(circle, rgba(201,168,76,.08), transparent 70%); pointer-events:none;"></div>
    <div style="display:flex; align-items:flex-start; gap:1.5rem; flex-wrap:wrap;">
      <div style="flex:1; min-width:240px;">
        <div style="font-size:.68rem; letter-spacing:.2em; text-transform:uppercase; color:rgba(201,168,76,.7); margin-bottom:.6rem; display:flex; align-items:center; gap:.5rem;">
          <span style="width:16px; height:1px; background:rgba(201,168,76,.4); display:inline-block;"></span>
          20% de votre formation · 3h visio
          <span style="width:16px; height:1px; background:rgba(201,168,76,.4); display:inline-block;"></span>
        </div>
        <h3 style="font-size:1.25rem; font-weight:300; font-family:Georgia,serif; color:#fff; line-height:1.35; margin:0 0 .6rem;">
          Rituel sur tapis —<br><em style="color:#c9a84c; font-style:italic;">2h groupe + 1h clinique Q/R</em>
        </h3>
        <p style="font-size:.85rem; color:rgba(232,224,208,.55); line-height:1.8; margin:0 0 1.25rem; max-width:400px;">
          Après les modules 00 à 06, place au passage en pratique guidée : cycles respiratoires, détente cou/cervicales, jambes, massage des pieds, bras, puis tête et visage. Un protocole adaptable en 15, 30 ou 45 minutes.
        </p>
        <div style="display:flex; gap:.75rem; flex-wrap:wrap; align-items:center; margin-bottom:.5rem;">
          <a href="{{ route('formation.visio') }}" style="display:inline-flex; align-items:center; gap:.5rem; padding:.65rem 1.5rem; background:linear-gradient(135deg,#c9a84c,#a8883c); color:#000; border-radius:50px; font-size:.82rem; font-weight:700; text-decoration:none; box-shadow:0 4px 16px rgba(201,168,76,.25); transition:transform .2s;">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/></svg>
            Voir le programme complet
          </a>
          <div style="font-size:.75rem; color:rgba(232,224,208,.35);">
            <span style="color:rgba(201,168,76,.5);">◉</span> 3h · 2h groupe + 1h clinique Q/R
          </div>
        </div>
      </div>
      <div style="display:flex; flex-direction:column; gap:.5rem; min-width:160px;">
        @foreach([['🫁','Rituel collectif guidé'],['🎯','Mission à voix haute'],['🔓','Maux à voix haute'],['🚪','Les 3 portes ouvertes']] as [$icon,$label])
        <div style="display:flex; align-items:center; gap:.6rem; font-size:.78rem; color:rgba(232,224,208,.6);">
          <span style="width:24px; height:24px; background:rgba(201,168,76,.08); border:1px solid rgba(201,168,76,.15); border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:.8rem; flex-shrink:0;">{{ $icon }}</span>
          {{ $label }}
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif

  {{-- Bannière Retraite --}}
  <div style="margin: 2.5rem 0; background: linear-gradient(135deg, #06060f, #1a0f00); border: 1px solid rgba(212,168,83,0.25); border-radius: 16px; padding: 2rem 2.5rem; text-align: center;">
    <div style="color: #D4A853; font-size: 0.7rem; letter-spacing: 2.5px; text-transform: uppercase; font-weight: 700; margin-bottom: .8rem;">La prochaine étape · 12 places seulement</div>
    <h3 style="color: #fff; font-family: Georgia, serif; font-weight: 300; font-size: 1.4rem; line-height: 1.4; margin-bottom: .75rem;">
      La formation se conclut par<br><em style="color: #D4A853; font-style: italic;">7 jours de retraite en Méditerranée</em>
    </h3>
    <p style="color: rgba(232,224,208,.5); font-size: .875rem; margin-bottom: 1.25rem;">Blue Lagoon · Villa privée · 6 activités signature · Rituel de feu face à la mer</p>
    <a href="{{ route('presence.retraite') }}" style="display: inline-flex; align-items: center; gap: .5rem; padding: .7rem 1.8rem; background: linear-gradient(135deg,#D4A853,#B8893A); color: #fff; border-radius: 50px; font-size: .875rem; font-weight: 600; text-decoration: none; box-shadow: 0 4px 16px rgba(212,168,83,.3);">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
      Découvrir la retraite
    </a>
  </div>

  {{-- Lien retour --}}
  <div class="fd-back">
    <a href="{{ $spaceKey === 'parcours' ? route('presence.parcours') : route('presence.formation-praticien') }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      {{ $language === 'en' ? 'Back to presentation' : 'Retour à la présentation' }}
    </a>
  </div>

</div>
@endsection

@section('script')
<script>
function toggleModuleDetail(slug) {
  const panel = document.getElementById('detail-' + slug);
  if (!panel) return;
  const isOpen = panel.classList.contains('is-open');
  // Fermer tous les panneaux ouverts
  document.querySelectorAll('.fd-module-detail.is-open').forEach(el => el.classList.remove('is-open'));
  // Ouvrir celui-ci si ce n'était pas déjà lui
  if (!isOpen) {
    panel.classList.add('is-open');
    panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }
}
</script>
@endsection
