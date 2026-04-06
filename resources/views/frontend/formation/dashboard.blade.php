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
  --fd-muted: rgba(232,224,208,.75);
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
.fd-flash__inner { border-radius: 10px; padding: .85rem 1.25rem; font-size:1.1rem; margin-bottom: .5rem; }
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
.fd-hero__eyebrow { font-size:1.15rem; letter-spacing: .15em; text-transform: uppercase; color: var(--fd-gold); margin-bottom: .5rem; }
.fd-hero__name { font-size: 1.7rem; font-weight: 700; color: #fff; margin: 0 0 .4rem; }
.fd-hero__sub  { font-size:1.1rem; color: var(--fd-muted); }
.fd-hero__badge {
  background: linear-gradient(135deg, #3d2a00, #1a1200);
  border: 1.5px solid var(--fd-gold);
  border-radius: 14px;
  padding: 1.2rem 1.8rem;
  text-align: center;
  min-width: 170px;
}
.fd-hero__badge-pct { font-size: 2.2rem; font-weight: 800; color: var(--fd-gold); line-height: 1; }
.fd-hero__badge-label { font-size:1.1rem; text-transform: uppercase; letter-spacing: .1em; color: var(--fd-muted); margin-top: .3rem; }

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
  font-size:1.15rem;
  color: #fff;
  background: rgba(0,0,0,.4);
  padding: .3rem .8rem;
  border-radius: 6px;
  display: inline-block;
  letter-spacing: .08em;
}

/* Modules grid */
.fd-modules { max-width: 860px; margin: 2.5rem auto 0; padding: 0 2rem; }
.fd-modules__title { font-size:1.15rem; letter-spacing: .12em; text-transform: uppercase; color: var(--fd-muted); margin-bottom: 1.2rem; }
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
  font-size:1.05rem; font-weight: 700;
  flex-shrink: 0;
}
.fd-module-num--locked      { background: rgba(75,85,99,.2); color: var(--fd-locked); border: 1.5px solid #374151; }
.fd-module-num--available   { background: rgba(201,168,76,.15); color: var(--fd-gold); border: 1.5px solid var(--fd-gold); }
.fd-module-num--in_progress { background: rgba(59,130,246,.15); color: var(--fd-blue); border: 1.5px solid var(--fd-blue); }
.fd-module-num--completed   { background: rgba(34,197,94,.12); color: var(--fd-green); border: 1.5px solid var(--fd-green); }
.fd-module-body { flex: 1; min-width: 0; }
.fd-module-week { font-size:1.1rem; text-transform: uppercase; letter-spacing: .1em; color: var(--fd-muted); }
.fd-module-title { font-size:1.15rem; font-weight: 600; color: #fff; margin-top: .15rem; }
.fd-module-pct { font-size:1.15rem; color: var(--fd-muted); margin-top: .2rem; }
.fd-module-status-badge {
  font-size:1.1rem; text-transform: uppercase; letter-spacing: .07em;
  padding: .3rem .75rem; border-radius: 20px; font-weight: 600;
}
.fd-badge--locked      { background: rgba(75,85,99,.2); color: #9ca3af; }
.fd-badge--available   { background: rgba(201,168,76,.15); color: var(--fd-gold); }
.fd-badge--in_progress { background: rgba(59,130,246,.15); color: #93c5fd; }
.fd-badge--completed   { background: rgba(34,197,94,.12); color: #86efac; }
.fd-module-actions { display: flex; gap: .6rem; flex-wrap: wrap; align-items: center; }
.fd-btn-sm {
  font-size:1rem; font-weight: 600; padding: .4rem 1rem;
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
.fd-back a { font-size:1.05rem; color: var(--fd-muted); text-decoration: none; display: inline-flex; align-items: center; gap: .4rem; }
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
  font-size:1.15rem; line-height: 1.8; color: rgba(255,255,255,.75);
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
.fd-audio-label { font-size:1rem; color: var(--fd-muted); text-transform: uppercase; letter-spacing: .1em; flex: 1; min-width: 140px; }
.fd-audio-player audio { flex: 1; min-width: 200px; height: 36px; opacity: .85; }
.fd-audio-player audio::-webkit-media-controls-panel { background: #1e1e2e; }

/* Activités */
.fd-activities-title { font-size:1.1rem; text-transform: uppercase; letter-spacing: .12em; color: var(--fd-muted); margin-bottom: .8rem; }
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
.fd-activity-title { font-size:1.1rem; font-weight: 600; color: #fff; }
.fd-activity-meta  { font-size:1.15rem; color: var(--fd-muted); margin-top: .15rem; }
.fd-activity-desc  { font-size:1rem; color: rgba(255,255,255,.55); margin-top: .35rem; line-height: 1.6; }
.fd-module-conclusion {
  margin-top: 1.2rem; padding: .8rem 1.2rem;
  background: rgba(201,168,76,.07);
  border-left: 3px solid var(--fd-gold);
  border-radius: 0 8px 8px 0;
  font-size:1.05rem; font-style: italic; color: var(--fd-gold);
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

  {{-- Durée & format Formation Praticien --}}
  @if($showPraticienExtras)
  <div style="display:flex; flex-wrap:wrap; gap:.6rem; margin:.9rem 0 .5rem; padding:.8rem 1.1rem; background:rgba(201,168,76,.06); border:1px solid rgba(201,168,76,.18); border-radius:12px; align-items:center;">
    <div style="display:flex; align-items:center; gap:.45rem; font-size:1.15rem; font-weight:700; color:rgba(201,168,76,.9);">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
      {{ $language === 'en' ? '39h total training' : '39h de formation' }}
    </div>
    <span style="color:rgba(255,255,255,.15);">|</span>
    @foreach([
      ['80%', $language === 'en' ? '31h online — self-paced modules' : '31h en ligne — modules auto-guidés', '💻'],
      ['20%', $language === 'en' ? '7h48 — 1h video Ritual Terra + 1h video BodyFlow + 3h48 group live + 2h individual' : '7h48 — 1h vidéo Rituel Terra + 1h vidéo BodyFlow + 3h48 groupe live + 2h individuel', '🎥'],
    ] as [$pct, $label_t, $ic])
    <div style="display:flex; align-items:center; gap:.4rem; font-size:1.1rem; color:rgba(232,224,208,.78);">
      <span style="font-weight:700; color:rgba(201,168,76,.7);">{{ $pct }}</span>
      <span>{{ $ic }}</span>
      <span>{{ $label_t }}</span>
    </div>
    @endforeach
  </div>
  @endif

  {{-- Bannière attestation (si certifié PRATICIEN — rétrocompatibilité) --}}
  @if($showAttestationBanner && $is_certified)
  <div class="fd-attestation-banner">
    <div class="fd-attestation-banner__inner">
      <div class="fd-attestation-banner__icon">ðŸ…</div>
      <div class="fd-attestation-banner__body">
        <p class="fd-attestation-banner__title">Attestation Officielle Junspro délivrée !</p>
        <p style="font-size:1.05rem; color:rgba(232,224,208,.82); margin:.2rem 0 .6rem">
          Votre code d'attestation certifiée :
        </p>
        <span class="fd-attestation-banner__code">{{ $attestation_code }}</span>
        <div style="margin-top:.9rem;">
          <a href="{{ route($attestationRouteName) }}" style="display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#c9a84c,#a07820);color:#1a0e00;padding:.55rem 1.2rem;border-radius:9px;font-size:1rem;font-weight:700;text-decoration:none;">
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
      <div class="fd-attestation-banner__icon">ðŸ†</div>
      <div class="fd-attestation-banner__body">
        <p class="fd-attestation-banner__title" style="font-size:1.05rem;background:linear-gradient(90deg,#5eead4,#34d399);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Certification Niveau 3 · Praticien Pause Souffle · Maître</p>
        <p style="font-size:1rem;color:rgba(232,224,208,.78);margin:.15rem 0 .5rem;">
          Vous avez complété les 3 Parcours — 39 modules. Vous êtes Maître Pause Souffle.
        </p>
        <p style="font-size:1.15rem;color:rgba(232,224,208,.68);margin:0 0 .6rem;">Code : <span style="font-family:monospace;color:rgba(20,184,166,.9);letter-spacing:.08em;">{{ $attestation_code_lvl3 ?? '' }}</span></p>
        <a href="{{ route($attestationRouteName) }}" style="display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#14b8a6,#0d9488);color:#fff;padding:.5rem 1.1rem;border-radius:9px;font-size:1rem;font-weight:700;text-decoration:none;">
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
        <p style="font-size:1rem;color:rgba(232,224,208,.78);margin:.15rem 0 .5rem;">
          Parcours 1 & 2 complétés — 23 modules · Fondations solides de votre transformation.
        </p>
        <p style="font-size:1.15rem;color:rgba(232,224,208,.68);margin:0 0 .6rem;">Code : <span style="font-family:monospace;color:rgba(201,168,76,.9);letter-spacing:.08em;">{{ $attestation_code_lvl2 }}</span></p>
        <a href="{{ route($attestationRouteName) }}" style="display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#c9a84c,#a07820);color:#1a0e00;padding:.5rem 1.1rem;border-radius:9px;font-size:1rem;font-weight:700;text-decoration:none;">
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
        <p style="font-size:1.1rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(20,184,166,.7);margin:0 0 .3rem;">Dernière étape</p>
        <p style="font-size:1rem;font-weight:700;color:rgba(232,224,208,.95);margin:0 0 .25rem;">Parcours 3 — S'Ouvrir</p>
        <p style="font-size:1rem;color:rgba(232,224,208,.75);margin:0 0 .75rem;line-height:1.5;">
          16 modules · Certification Niveau 3 · Maître Pause Souffle<br>
          <em style="color:rgba(20,184,166,.65);">Vous vous êtes retrouvé(e). Vous vous êtes construit(e). Maintenant, ouvrez-vous au monde.</em>
        </p>
        <a href="{{ route('parcours.upgrade') ?? '#' }}" style="display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#14b8a6,#0d9488);color:#fff;padding:.55rem 1.2rem;border-radius:9px;font-size:1rem;font-weight:700;text-decoration:none;">
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
        <p style="font-size:1rem;color:rgba(232,224,208,.78);margin:.15rem 0 .5rem;">
          Parcours 1 «&nbsp;Se Retrouver&nbsp;» complété. Vous pouvez dès maintenant proposer vos <strong style="-webkit-text-fill-color:rgba(232,224,208,.85);">accompagnements Pause Souffle</strong>.
        </p>
        <p style="font-size:1.15rem;color:rgba(232,224,208,.68);margin:0 0 .8rem;">Code : <span style="font-family:monospace;color:rgba(147,197,253,.9);letter-spacing:.08em;">{{ $attestation_code_lvl1 }}</span></p>
        <div style="display:flex;flex-wrap:wrap;gap:.6rem;">
          <a href="{{ route($attestationRouteName) }}" style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(99,102,241,.2);border:1px solid rgba(99,102,241,.5);color:#c7d2fe;padding:.48rem 1rem;border-radius:9px;font-size:1rem;font-weight:700;text-decoration:none;">
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
        <p style="font-size:1.1rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(201,168,76,.7);margin:0 0 .3rem;">Prochaine étape</p>
        <p style="font-size:1rem;font-weight:700;color:rgba(232,224,208,.95);margin:0 0 .25rem;">Parcours 2 — Se Construire</p>
        <p style="font-size:1rem;color:rgba(232,224,208,.75);margin:0 0 .75rem;line-height:1.5;">
          13 modules · Certification Niveau 2 · Ancrage · Priorités, discipline, corps, émotions<br>
          <em style="color:rgba(201,168,76,.65);">Vous vous êtes retrouvé(e). Maintenant construisez les fondations qui durent.</em>
        </p>
        <a href="{{ route('parcours.upgrade') ?? '#' }}" style="display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#c9a84c,#a07820);color:#1a0e00;padding:.55rem 1.2rem;border-radius:9px;font-size:1rem;font-weight:700;text-decoration:none;">
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
    <span style="font-size:1.15rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.95);text-transform:uppercase;">Mode Créateur</span>
    <span style="font-size:1.15rem;color:rgba(255,255,255,.45);">— Tous les modules accessibles sans progression requise</span>
    <div style="margin-left:auto;display:flex;gap:.5rem;">
      @if($spaceKey === 'parcours')
        <a href="{{ route('formation.dashboard') }}" style="font-size:1.15rem;font-weight:600;color:rgba(201,168,76,.9);background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.35);padding:.3rem .8rem;border-radius:6px;text-decoration:none;">
          Espace Formation →
        </a>
      @else
        <a href="{{ route('parcours.dashboard') }}" style="font-size:1.15rem;font-weight:600;color:rgba(201,168,76,.9);background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.35);padding:.3rem .8rem;border-radius:6px;text-decoration:none;">
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
            <span style="font-size:1.05rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(99,102,241,.7);background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.25);padding:.25rem .75rem;border-radius:20px;white-space:nowrap;">🌱 Parcours 1 — Se Retrouver · Certification Niveau 1 · Éveil</span>
            <div style="flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(99,102,241,.35));"></div>
          </div>
        @elseif($__currentPart == 2)
          <div style="margin:2rem 0 .6rem;display:flex;align-items:center;gap:.75rem;">
            <div style="flex:1;height:1px;background:linear-gradient(90deg,rgba(201,168,76,.35),transparent);"></div>
            <span style="font-size:1.05rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(201,168,76,.8);background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.28);padding:.25rem .75rem;border-radius:20px;white-space:nowrap;">🔥 Parcours 2 — Se Construire · Certification Niveau 2 · Ancrage</span>
            <div style="flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(201,168,76,.35));"></div>
          </div>
        @elseif($__currentPart == 3)
          <div style="margin:2rem 0 .6rem;display:flex;align-items:center;gap:.75rem;">
            <div style="flex:1;height:1px;background:linear-gradient(90deg,rgba(20,184,166,.35),transparent);"></div>
            <span style="font-size:1.05rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(20,184,166,.85);background:rgba(20,184,166,.08);border:1px solid rgba(20,184,166,.28);padding:.25rem .75rem;border-radius:20px;white-space:nowrap;">🌊 Parcours 3 — S'Ouvrir · Certification Niveau 3 · Maître</span>
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
        $iconMap = ['lecture'=>'📖','pratique'=>'🌬ï¸','ecriture'=>'âœï¸','exercice'=>'💡','reflexion'=>'ðŸ”'];
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

      {{-- ─ Fin d'étape : timing complémentaire + attestation ─ --}}
      @if($spaceKey === 'parcours' && $__currentPart !== null)
        @php
          $__nextItem = $loop->last ? null : $modules->get($loop->index + 1);
          $__isLastInPart = $loop->last || ($__nextItem && $__nextItem['module']->part !== $__currentPart);
          $__partColorsMap = [
            1 => ['rgb' => '99,102,241',  'icon' => '🌱', 'emoji_attest' => '🌟'],
            2 => ['rgb' => '201,168,76',  'icon' => '🔥', 'emoji_attest' => '🎓'],
            3 => ['rgb' => '20,184,166',  'icon' => '🌊', 'emoji_attest' => 'ðŸ†'],
          ];
          $__pc = $__partColorsMap[$__currentPart] ?? $__partColorsMap[1];
          $__certifiedForPart = match((int)$__currentPart) {
            1 => !empty($is_certified_level_1),
            2 => !empty($is_certified_level_2),
            3 => !empty($is_certified_level_3),
            default => false,
          };
          $__attestCodeForPart = match((int)$__currentPart) {
            1 => $attestation_code_lvl1 ?? '',
            2 => $attestation_code_lvl2 ?? '',
            3 => $attestation_code_lvl3 ?? '',
            default => '',
          };
          $__partNames = [
            1 => ['fr' => 'Se Retrouver',  'en' => 'Finding Yourself', 'lvl_fr' => 'Niveau 1 · Éveil',   'lvl_en' => 'Level 1 · Awakening'],
            2 => ['fr' => 'Se Construire', 'en' => 'Building Yourself','lvl_fr' => 'Niveau 2 · Ancrage', 'lvl_en' => 'Level 2 · Anchoring'],
            3 => ['fr' => "S'Ouvrir",      'en' => 'Opening Up',       'lvl_fr' => 'Niveau 3 · Maître',  'lvl_en' => 'Level 3 · Master'],
          ];
          $__pn = $__partNames[$__currentPart] ?? $__partNames[1];
        @endphp
        @if($__isLastInPart)
        {{-- â•â• Bloc fin Parcours {{ $__currentPart }} â•â• --}}
        <div style="margin:2rem 0 .5rem; border:1px solid rgba({{ $__pc['rgb'] }},.32); border-radius:16px; overflow:hidden; background:linear-gradient(135deg,rgba({{ $__pc['rgb'] }},.05),rgba(0,0,0,.45));">

          {{-- En-tête --}}
          <div style="padding:.75rem 1.4rem; border-bottom:1px solid rgba({{ $__pc['rgb'] }},.2); display:flex; align-items:center; gap:.6rem;">
            <span style="font-size:1rem;">{{ $__pc['icon'] }}</span>
            <span style="font-size:1.05rem; font-weight:700; letter-spacing:.15em; text-transform:uppercase; color:rgba({{ $__pc['rgb'] }},.85);">
              {{ $language === 'en' ? 'End of Journey ' : 'Fin du Parcours ' }}{{ $__currentPart }} — {{ $language === 'en' ? $__pn['en'] : $__pn['fr'] }}
            </span>
          </div>

          <div style="padding:1.4rem 1.6rem; display:flex; flex-wrap:wrap; gap:1.5rem; align-items:flex-start;">

            {{-- Colonne gauche : sessions d'accompagnement --}}
            <div style="flex:1; min-width:220px;">
              <p style="font-size:1.1rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:rgba({{ $__pc['rgb'] }},.65); margin:0 0 .9rem;">
                {{ $language === 'en' ? 'Complementary sessions included' : 'Sessions complémentaires incluses' }}
              </p>
              @foreach([
                ['â±','3h', $language === 'en' ? 'Live Visio — Collective ritual' : 'Visio live — Rituel collectif'],
                ['👥','2h', $language === 'en' ? 'Group session — Practice & sharing' : 'Séance groupe — Pratique & partage'],
                ['🎯','1h', $language === 'en' ? 'Individual session — Personalised coaching' : 'Séance individuelle — Accompagnement personnalisé'],
              ] as [$icon_s, $dur, $label_s])
              <div style="display:flex; align-items:center; gap:.75rem; margin-bottom:.65rem;">
                <div style="width:36px; height:36px; border-radius:9px; background:rgba({{ $__pc['rgb'] }},.1); border:1px solid rgba({{ $__pc['rgb'] }},.22); display:flex; align-items:center; justify-content:center; font-size:1.05rem; flex-shrink:0;">{{ $icon_s }}</div>
                <div>
                  <span style="font-size:1.05rem; font-weight:700; color:rgba(232,224,208,.9);">{{ $dur }}</span>
                  <span style="font-size:1rem; color:rgba(232,224,208,.75); margin-left:.4rem;">{{ $label_s }}</span>
                </div>
              </div>
              @endforeach
              <div style="margin-top:.5rem; padding:.55rem .8rem; background:rgba({{ $__pc['rgb'] }},.07); border-radius:8px; font-size:1.15rem; color:rgba(232,224,208,.72); line-height:1.5;">
                {{ $language === 'en'
                  ? 'Sessions scheduled after completing all modules of this journey.'
                  : 'Sessions programmées après l\'achèvement de tous les modules de ce parcours.' }}
              </div>
            </div>

            {{-- Colonne droite : attestation --}}
            <div style="flex:0 0 auto; min-width:220px; max-width:300px;">
              <p style="font-size:1.1rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:rgba({{ $__pc['rgb'] }},.65); margin:0 0 .9rem;">
                {{ $language === 'en' ? 'Certification' : 'Attestation' }}
              </p>
              @if($__certifiedForPart)
              {{-- Déverrouillée --}}
              <div style="background:rgba({{ $__pc['rgb'] }},.08); border:1px solid rgba({{ $__pc['rgb'] }},.3); border-radius:12px; padding:1rem 1.1rem;">
                <div style="font-size:1.5rem; margin-bottom:.4rem;">{{ $__pc['emoji_attest'] }}</div>
                <p style="font-size:1rem; font-weight:700; color:rgba(232,224,208,.9); margin:0 0 .2rem;">
                  {{ $language === 'en' ? $__pn['lvl_en'] : $__pn['lvl_fr'] }}
                </p>
                @if($__attestCodeForPart)
                <p style="font-size:1.1rem; color:rgba(232,224,208,.65); font-family:monospace; letter-spacing:.08em; margin:.2rem 0 .6rem;">{{ $__attestCodeForPart }}</p>
                @endif
                <a href="{{ route($attestationRouteName) }}" style="display:inline-flex; align-items:center; gap:.4rem; background:rgba({{ $__pc['rgb'] }},.18); border:1px solid rgba({{ $__pc['rgb'] }},.45); color:rgba(232,224,208,.9); padding:.45rem .9rem; border-radius:8px; font-size:1.15rem; font-weight:700; text-decoration:none;">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                  {{ $language === 'en' ? 'Download certificate' : 'Télécharger l\'attestation' }}
                </a>
              </div>
              @else
              {{-- Verrouillée --}}
              <div style="background:rgba(40,40,50,.5); border:1px solid rgba(255,255,255,.08); border-radius:12px; padding:1rem 1.1rem; opacity:.6;">
                <div style="font-size:1.5rem; margin-bottom:.4rem;">🔒</div>
                <p style="font-size:1rem; font-weight:700; color:rgba(232,224,208,.72); margin:0 0 .2rem;">
                  {{ $language === 'en' ? $__pn['lvl_en'] : $__pn['lvl_fr'] }}
                </p>
                <p style="font-size:1.15rem; color:rgba(232,224,208,.55); margin:.3rem 0 .7rem; line-height:1.5;">
                  {{ $language === 'en' ? 'Complete all modules of this journey to unlock your certificate.' : 'Terminez tous les modules de ce parcours pour débloquer votre attestation.' }}
                </p>
                <span style="display:inline-flex; align-items:center; gap:.4rem; background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.1); color:rgba(232,224,208,.48); padding:.45rem .9rem; border-radius:8px; font-size:1.15rem; font-weight:700; cursor:not-allowed;">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                  {{ $language === 'en' ? 'Locked' : 'Verrouillé' }}
                </span>
              </div>
              @endif
            </div>

          </div>
        </div>
        @endif
      @endif

    @endforeach

  </div>

  @if($showPraticienExtras && $spaceKey !== 'parcours')
  {{-- Catalogue des Rituels Visio --}}
  <div style="font-size:1.05rem;letter-spacing:.16em;text-transform:uppercase;color:rgba(232,224,208,.7);margin:2rem 0 .75rem;display:flex;align-items:center;gap:.5rem;">
    <span style="flex:1;height:1px;background:rgba(255,255,255,.06);"></span>
    Séances Visio · 20% de la formation · 7h48 · Rituel Terra + BodyFlow
    <span style="flex:1;height:1px;background:rgba(255,255,255,.06);"></span>
  </div>

  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1rem;margin-bottom:1.5rem;">
    {{-- Rituel Terra --}}
    <div style="position:relative;overflow:hidden;background:linear-gradient(135deg,#0a0a0a,#160d00);border:1.5px solid rgba(201,168,76,.32);border-radius:16px;padding:1.5rem;">
      <div style="font-size:1.05rem;letter-spacing:.15em;text-transform:uppercase;color:rgba(201,168,76,.65);margin-bottom:.5rem;">Rituel Terra &nbsp;<span style="font-size:1rem;color:rgba(201,168,76,.7);font-style:italic;letter-spacing:0;text-transform:none;">(latin : la terre, le sol — corps ancré, racines)</span></div>
      <h4 style="font-size:1.1rem;font-weight:300;font-family:Georgia,serif;color:#fff;line-height:1.3;margin:0 0 .5rem;">
        Rituel 1 · Sur Futon —<br><em style="color:#c9a84c;font-style:italic;">Souffle · Cervicales · Pieds · Visage</em>
      </h4>
      <p style="font-size:1.05rem;color:rgba(232,224,208,.75);line-height:1.75;margin:0 0 1rem;">Cycles respiratoires, détente du cou, massages des pieds, shiatsu visage &amp; crâne. Protocole adaptable 15 · 30 · 45 · 60 min. Pratique individuelle sur futon.</p>
      <a href="{{ route('formation.visio') }}" style="display:inline-flex;align-items:center;gap:.4rem;font-size:1.05rem;font-weight:700;color:#c9a84c;background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.25);padding:.42rem .9rem;border-radius:20px;text-decoration:none;">
        <svg width="11" height="11" fill="currentColor" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
        Voir le programme
      </a>
    </div>

    {{-- Rituel BodyFlow --}}
    <div style="position:relative;overflow:hidden;background:linear-gradient(135deg,#070c10,#06100a);border:1.5px solid rgba(34,197,94,.32);border-radius:16px;padding:1.5rem;">
      <div style="font-size:1.05rem;letter-spacing:.15em;text-transform:uppercase;color:rgba(34,197,94,.65);margin-bottom:.5rem;">Rituel BodyFlow · Sur Tapis Pilates · 15 – 30 – 45 – 60 min</div>
      <h4 style="font-size:1.1rem;font-weight:300;font-family:Georgia,serif;color:#fff;line-height:1.3;margin:0 0 .5rem;">
        Rituel 2 · Tapis Pilates Épais —<br><em style="color:#4ade80;font-style:italic;">Taï-chi · Yoga · Pilates · Stretching · VisioBoard</em>
      </h4>
      <p style="font-size:1.05rem;color:rgba(232,224,208,.75);line-height:1.75;margin:0 0 .85rem;">Soulager le dos, libérer les hanches, renforcer les abdos, retrouver l'équilibre. Rituel fluide seul ou en groupe, toutes corpulences, tous niveaux.</p>
      <div style="display:flex;gap:.4rem;flex-wrap:wrap;margin-bottom:.85rem;">
        @foreach(['🥋 Taï-chi','🧘 Yoga','🛡ï¸ Pilates','↔ï¸ Stretching','🎯 VisioBoard'] as $__tag)
        <span style="font-size:1.05rem;background:rgba(34,197,94,.07);border:1px solid rgba(34,197,94,.2);color:rgba(134,239,172,.65);padding:.18rem .5rem;border-radius:20px;">{{ $__tag }}</span>
        @endforeach
      </div>
      <a href="{{ route('formation.visio') }}" style="display:inline-flex;align-items:center;gap:.4rem;font-size:1.05rem;font-weight:700;color:#4ade80;background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.25);padding:.42rem .9rem;border-radius:20px;text-decoration:none;">
        <svg width="11" height="11" fill="currentColor" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
        Voir le programme
      </a>
    </div>
  </div>
  @endif

  @if($showPraticienExtras)
  {{-- Bannière Séance Visio 20% --}}
  <div style="margin: 2rem 0; position:relative; overflow:hidden; background: linear-gradient(135deg, #0a0a0a, #160d00); border: 1px solid rgba(201,168,76,.3); border-radius: 18px; padding: 2rem 2.5rem;">
    <div style="position:absolute; top:-40px; right:-40px; width:180px; height:180px; background:radial-gradient(circle, rgba(201,168,76,.08), transparent 70%); pointer-events:none;"></div>
    <div style="display:flex; align-items:flex-start; gap:1.5rem; flex-wrap:wrap;">
      <div style="flex:1; min-width:240px;">
        <div style="font-size:1.05rem; letter-spacing:.2em; text-transform:uppercase; color:rgba(201,168,76,.7); margin-bottom:.6rem; display:flex; align-items:center; gap:.5rem;">
          <span style="width:16px; height:1px; background:rgba(201,168,76,.4); display:inline-block;"></span>
          20% de votre formation · 7h48 · Rituel Terra + BodyFlow
          <span style="width:16px; height:1px; background:rgba(201,168,76,.4); display:inline-block;"></span>
        </div>
        <h3 style="font-size:1.25rem; font-weight:300; font-family:Georgia,serif; color:#fff; line-height:1.35; margin:0 0 .6rem;">
          Rituel Terra + BodyFlow —<br><em style="color:#c9a84c; font-style:italic;">Deux rituels Pause Souffle · La pratique certifiée</em>
        </h3>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:.6rem;margin-bottom:1.25rem;">
          <div style="background:rgba(201,168,76,.05);border:1px solid rgba(201,168,76,.15);border-radius:10px;padding:.65rem .8rem;">
            <div style="font-size:1.05rem;font-weight:700;color:#c9a84c;">📹 1h Vidéo</div>
            <div style="font-size:1rem;color:rgba(232,224,208,.78);margin-top:.15rem;">Rituel Terra · Groupe</div>
          </div>
          <div style="background:rgba(34,197,94,.04);border:1px solid rgba(34,197,94,.15);border-radius:10px;padding:.65rem .8rem;">
            <div style="font-size:1.05rem;font-weight:700;color:#4ade80;">📹 1h Vidéo</div>
            <div style="font-size:1rem;color:rgba(232,224,208,.78);margin-top:.15rem;">BodyFlow · Groupe</div>
          </div>
          <div style="background:rgba(59,130,246,.04);border:1px solid rgba(59,130,246,.15);border-radius:10px;padding:.65rem .8rem;">
            <div style="font-size:1.05rem;font-weight:700;color:#93c5fd;">🎥 3h48 Live</div>
            <div style="font-size:1rem;color:rgba(232,224,208,.78);margin-top:.15rem;">Groupe · 2 Rituels + Q/R</div>
          </div>
          <div style="background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:.65rem .8rem;">
            <div style="font-size:1.05rem;font-weight:700;color:#fff;">👤 2h Live</div>
            <div style="font-size:1rem;color:rgba(232,224,208,.78);margin-top:.15rem;">Individuel · 1h Terra + 1h BodyFlow</div>
          </div>
        </div>
        <div style="display:flex; gap:.75rem; flex-wrap:wrap; align-items:center; margin-bottom:.5rem;">
          <a href="{{ route('formation.visio') }}" style="display:inline-flex; align-items:center; gap:.5rem; padding:.65rem 1.5rem; background:linear-gradient(135deg,#c9a84c,#a8883c); color:#000; border-radius:50px; font-size:1rem; font-weight:700; text-decoration:none; box-shadow:0 4px 16px rgba(201,168,76,.25); transition:transform .2s;">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/></svg>
            Voir le programme complet
          </a>
          <div style="font-size:1.05rem; color:rgba(232,224,208,.75);">
            <span style="color:rgba(201,168,76,.8);">&#9899;</span> 7h48 = 1h vidéo Terra + 1h vidéo BodyFlow + 3h48 groupe + 2h individuel
          </div>
        </div>
      </div>
      <div style="display:flex; flex-direction:column; gap:.5rem; min-width:160px;">
        @foreach([['ðŸ«','Rituel collectif guidé'],['🎯','Mission à voix haute'],['🔓','Maux à voix haute'],['🚪','Les 3 portes ouvertes']] as [$icon,$label])
        <div style="display:flex; align-items:center; gap:.6rem; font-size:1.15rem; color:rgba(232,224,208,.6);">
          <span style="width:24px; height:24px; background:rgba(201,168,76,.08); border:1px solid rgba(201,168,76,.15); border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:1rem; flex-shrink:0;">{{ $icon }}</span>
          {{ $label }}
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif

  {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
  {{-- FORMATION MENTOR — Le Leader Serviteur (après module 9)            --}}
  {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
  @if($showPraticienExtras && $spaceKey !== 'parcours')

  {{-- Séparateur thématique --}}
  <div style="margin:3.5rem 0 1.5rem;display:flex;align-items:center;gap:1rem;">
    <div style="flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(139,92,246,.45));"></div>
    <span style="font-size:1.05rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(167,139,250,.9);background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.3);padding:.3rem 1rem;border-radius:20px;white-space:nowrap;">🌿 Formation Mentor · Leadership par le Service</span>
    <div style="flex:1;height:1px;background:linear-gradient(90deg,rgba(139,92,246,.45),transparent);"></div>
  </div>

  {{-- Carte Hero : Valeurs + Bible --}}
  <div style="position:relative;overflow:hidden;background:radial-gradient(ellipse 90% 60% at 50% 0%,rgba(139,92,246,.09),transparent 65%),linear-gradient(135deg,#08060e,#0c0813);border:1px solid rgba(139,92,246,.22);border-radius:20px;padding:2.5rem 2rem 2rem;margin-bottom:1rem;">
    <div style="position:absolute;top:-40px;right:-40px;width:220px;height:220px;background:radial-gradient(circle,rgba(139,92,246,.07),transparent 70%);pointer-events:none;"></div>

    <div style="font-size:1.05rem;letter-spacing:.2em;text-transform:uppercase;color:rgba(167,139,250,.65);margin-bottom:.75rem;display:flex;align-items:center;gap:.55rem;">
      <span style="width:18px;height:1px;background:rgba(167,139,250,.4);display:inline-block;"></span>
      Formation Mentor · 9 modules · 80% en ligne · 20% en visio · 5h30
      <span style="width:18px;height:1px;background:rgba(167,139,250,.4);display:inline-block;"></span>
    </div>

    <h2 style="font-size:1.5rem;font-weight:300;font-family:Georgia,serif;color:#fff;line-height:1.3;margin:0 0 .5rem;">
      Devenir Mentor —<br><em style="color:#c9a84c;font-style:italic;">Le Leader est un Serviteur</em>
    </h2>

    <p style="font-size:1.05rem;color:rgba(232,224,208,.75);line-height:1.9;margin:0 0 1.5rem;max-width:500px;">
      Une formation pour transmettre ce que vous avez vécu. Pas depuis une chaire — depuis vos cicatrices. Le vrai mentor ne commande pas : il précède, il protège, il libère.
    </p>

    {{-- Verset biblique --}}
    <div style="background:rgba(201,168,76,.05);border-left:3px solid rgba(201,168,76,.5);border-radius:0 12px 12px 0;padding:1.1rem 1.4rem;margin-bottom:1.5rem;max-width:540px;">
      <div style="font-size:1.05rem;letter-spacing:.14em;text-transform:uppercase;color:rgba(201,168,76,.6);margin-bottom:.6rem;">Fondement · Marc 10:43-45</div>
      <p style="font-size:1.05rem;font-family:Georgia,serif;font-style:italic;color:rgba(232,224,208,.85);line-height:1.85;margin:0 0 .5rem;">
        « Celui qui voudra devenir grand parmi vous sera votre serviteur, et celui qui voudra être le premier parmi vous sera l'esclave de tous. Car le Fils de l'homme lui-même n'est pas venu pour être servi, mais pour servir et donner sa vie en rançon pour beaucoup. »
      </p>
      <div style="font-size:1.1rem;color:rgba(201,168,76,.55);">— Marc 10:43-45</div>
    </div>

    {{-- Ratio 80/20 --}}
    <div style="display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;margin-bottom:1.5rem;">
      <div style="flex:1;min-width:220px;">
        <div style="font-size:1.05rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(232,224,208,.75);margin-bottom:.5rem;">Répartition Formation Mentor</div>
        <div style="height:6px;background:rgba(255,255,255,.07);border-radius:4px;display:flex;overflow:hidden;margin-bottom:.45rem;">
          <div style="width:80%;background:linear-gradient(90deg,#3b82f6,#60a5fa);"></div>
          <div style="width:20%;background:linear-gradient(90deg,#c9a84c,#e8d17a);"></div>
        </div>
        <div style="display:flex;gap:1.25rem;font-size:1.1rem;color:rgba(232,224,208,.8);flex-wrap:wrap;">
          <span style="display:flex;align-items:center;gap:.35rem;"><i style="width:7px;height:7px;border-radius:50%;background:#3b82f6;flex-shrink:0;font-style:normal;display:inline-block;"></i> 80% en ligne — 9 modules · 4h30</span>
          <span style="display:flex;align-items:center;gap:.35rem;"><i style="width:7px;height:7px;border-radius:50%;background:#c9a84c;flex-shrink:0;font-style:normal;display:inline-block;"></i> 20% en visio — 3h en direct · 2h groupe + 1h Q/R</span>
        </div>
      </div>
      <div style="text-align:center;min-width:100px;background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.22);border-radius:12px;padding:.9rem 1.2rem;">
        <div style="font-size:1.6rem;font-weight:800;color:rgba(167,139,250,.9);line-height:1;">5h30</div>
        <div style="font-size:1.05rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(232,224,208,.75);margin-top:.3rem;">total formation</div>
      </div>
    </div>

    {{-- 3 valeurs clés --}}
    <div style="display:flex;gap:.65rem;flex-wrap:wrap;">
      @foreach([['🌱','Inspirer','Par l\'exemple incarné, pas le discours'],['⚡','Impacter','Transformer durablement sans emprise'],['🕊ï¸','Libérer','Autonomiser et non captiver']] as $__v)
      <div style="flex:1;min-width:120px;background:rgba(255,255,255,.025);border:1px solid rgba(255,255,255,.07);border-radius:12px;padding:.9rem .85rem;text-align:center;">
        <div style="font-size:1.25rem;margin-bottom:.35rem;">{{ $__v[0] }}</div>
        <div style="font-size:1.15rem;font-weight:700;color:rgba(232,224,208,.9);margin-bottom:.2rem;">{{ $__v[1] }}</div>
        <div style="font-size:1.05rem;color:rgba(232,224,208,.75);line-height:1.55;">{{ $__v[2] }}</div>
      </div>
      @endforeach
    </div>
  </div>

  {{-- Barre de progression Mentor --}}
  @php
    $__mentorTotal = \App\Models\FormationModule::where('track','mentor')->where('is_active',true)->count();
    $__mentorCompleted = 0;
    if(auth()->check() && $__mentorTotal > 0) {
      $__mentorEnroll = \App\Models\FormationEnrollment::where('user_id', auth()->id())->first();
      if($__mentorEnroll) {
        $__mentorModuleIds = \App\Models\FormationModule::where('track','mentor')->where('is_active',true)->pluck('id');
        $__mentorCompleted = \App\Models\FormationModuleProgress::where('enrollment_id', $__mentorEnroll->id)
          ->whereIn('module_id', $__mentorModuleIds)
          ->where('status','completed')
          ->count();
      }
    }
    $__mentorPct = $__mentorTotal > 0 ? round($__mentorCompleted / $__mentorTotal * 100) : 0;
  @endphp
  <div style="margin:1rem 0 1.25rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.4rem;">
      <span style="font-size:1rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(167,139,250,.85);">Progression Formation Mentor</span>
      <span style="font-size:1rem;font-weight:700;color:rgba(167,139,250,.9);">{{ $__mentorPct }}% <span style="font-weight:400;color:rgba(232,224,208,.6);">· {{ $__mentorCompleted }}/{{ $__mentorTotal }} modules</span></span>
    </div>
    <div style="height:5px;background:rgba(255,255,255,.08);border-radius:3px;overflow:hidden;">
      <div style="height:100%;width:{{ $__mentorPct }}%;background:linear-gradient(90deg,#7c3aed,#a78bfa);border-radius:3px;transition:width .6s ease;"></div>
    </div>
  </div>

  {{-- Les 9 Modules — rendu identique aux modules Formation/Parcours --}}
  <div class="fd-modules" style="margin-bottom:1rem;">
    <div class="fd-modules__title">Programme · Formation Mentor · 9 modules</div>

    @php
      $mentorModules = \App\Models\FormationModule::where('track','mentor')
          ->where('is_active', true)
          ->orderBy('order')
          ->get();
    @endphp

    @forelse($mentorModules as $mmod)
    <div class="fd-module-card fd-module-card--available">
      <div class="fd-module-num fd-module-num--available">{{ str_pad($mmod->order, 2, '0', STR_PAD_LEFT) }}</div>
      <div class="fd-module-body">
        <div class="fd-module-week">{{ $mmod->week_label }} · Méditation + Pratique</div>
        <div class="fd-module-title">{{ $mmod->title }}</div>
        @if($mmod->description)
        <div class="fd-module-pct">{{ $mmod->description }}</div>
        @endif
      </div>
      <div class="fd-module-actions">
        <span class="fd-module-status-badge fd-badge--available">Disponible</span>
        <a href="{{ route('mentor.formation.module.show', $mmod->slug) }}" class="fd-btn-sm fd-btn--outline">Voir le contenu</a>
        <form method="POST" action="{{ route('mentor.formation.module.start', $mmod->id) }}" style="display:inline;">
          @csrf
          <button type="submit" class="fd-btn-sm fd-btn--gold">▶ Commencer</button>
        </form>
      </div>
    </div>
    @empty
    {{-- Modules pas encore en base — affichage de fallback --}}
    @foreach(['01'=>'L\'Identité du Mentor','02'=>'La Posture du Serviteur','03'=>'L\'Écoute Active','04'=>'La Transmission Vivante','05'=>'Les Résistances','06'=>'L\'Énergie du Mentor','07'=>'Le Cadre Sacré','08'=>'L\'Art du Lâcher-Prise','09'=>'Ma Signature de Mentor'] as $__num => $__title)
    <div class="fd-module-card fd-module-card--available">
      <div class="fd-module-num fd-module-num--available">{{ $__num }}</div>
      <div class="fd-module-body">
        <div class="fd-module-week">MODULE {{ $__num }} · Méditation + Pratique</div>
        <div class="fd-module-title">{{ $__title }}</div>
      </div>
      <div class="fd-module-actions">
        <span class="fd-module-status-badge fd-badge--available">Prochainement</span>
      </div>
    </div>
    @endforeach
    @endforelse

  </div>

  @endif {{-- /Formation Mentor --}}

  {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
  {{-- FORMATION INDÉPENDANTE · MA PAUSE SOUFFLE — 499 €                 --}}
  {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
  @if($spaceKey !== 'parcours')

  {{-- Séparateur clair : on sort du périmètre de la formation incluse --}}
  <div style="margin:3.5rem 0 2rem;display:flex;align-items:center;gap:1rem;">
    <div style="flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(201,168,76,.35));"></div>
    <div style="text-align:center;">
      <div style="font-size:.9rem;letter-spacing:.18em;text-transform:uppercase;color:rgba(201,168,76,.6);margin-bottom:.3rem;">Formation Pause Souffle dans votre univers</div>
      <div style="font-size:1rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:rgba(232,224,208,.5);">· · · Formation séparée & indépendante · · ·</div>
    </div>
    <div style="flex:1;height:1px;background:linear-gradient(90deg,rgba(201,168,76,.35),transparent);"></div>
  </div>

  <div style="position:relative;overflow:hidden;background:linear-gradient(135deg,#100900,#0a0800,#08060a);border:2px solid rgba(201,168,76,.55);border-radius:20px;padding:2rem 2.5rem;box-shadow:0 0 40px rgba(201,168,76,.07),inset 0 1px 0 rgba(201,168,76,.12);">
    <div style="position:absolute;top:-60px;right:-60px;width:260px;height:260px;background:radial-gradient(circle,rgba(201,168,76,.12),transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-40px;left:-40px;width:180px;height:180px;background:radial-gradient(circle,rgba(201,168,76,.07),transparent 70%);pointer-events:none;"></div>

    <div style="display:flex;align-items:flex-start;gap:2rem;flex-wrap:wrap;position:relative;">
      <div style="flex:1;min-width:240px;">
        {{-- Badge Formation indépendante --}}
        <div style="display:inline-flex;align-items:center;gap:.5rem;margin-bottom:.9rem;padding:.3rem .85rem;background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.35);border-radius:20px;">
          <span style="width:7px;height:7px;border-radius:50%;background:#c9a84c;flex-shrink:0;display:inline-block;"></span>
          <span style="font-size:.9rem;letter-spacing:.14em;text-transform:uppercase;color:rgba(201,168,76,.9);">Formation indépendante · 5 modules · 999 €</span>
        </div>

        <h3 style="font-size:1.6rem;font-weight:300;font-family:Georgia,serif;color:#fff;line-height:1.2;margin:0 0 .3rem;">
          Ma Pause Souffle
        </h3>
        <div style="font-size:1.15rem;font-style:italic;color:#c9a84c;margin-bottom:1rem;">Le 5-5-5 dans votre univers</div>

        <p style="font-size:1.05rem;color:rgba(232,224,208,.82);line-height:1.9;margin:0 0 .75rem;max-width:460px;">
          Une formation à part entière — 5 modules essentiels. Conçue pour greffer le protocole Pause Souffle dans <strong style="color:#fff;">votre métier, votre espace, votre identité</strong>.
        </p>
        <p style="font-size:1rem;color:rgba(232,224,208,.6);line-height:1.75;margin:0 0 .6rem;max-width:440px;">
          Potier, prof de yoga, manager, éducateur, soignant — le protocole ne change pas. Ce qui change, c'est où vous l'activez.
        </p>
        <p style="font-size:1rem;color:rgba(201,168,76,.65);line-height:1.6;margin:0 0 1.25rem;max-width:440px;font-style:italic;">
          🎧 Audios guidés · Exercices pratiques · Protocole personnalisé — Contenu en cours de création.
        </p>

        <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
          <a href="{{ route('formation.ma-pause-souffle') }}" style="display:inline-flex;align-items:center;gap:.5rem;padding:.72rem 1.6rem;background:linear-gradient(135deg,#c9a84c,#a07820);color:#000;border-radius:50px;font-size:1.05rem;font-weight:700;text-decoration:none;box-shadow:0 4px 20px rgba(201,168,76,.3);">
            <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
            Découvrir la formation
          </a>
          <span style="font-size:.95rem;color:rgba(232,224,208,.5);">Non incluse dans la formation praticien</span>
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:.45rem;margin-top:1rem;">
          @foreach([['🎨','Créateurs & artisans'],['🤲','Soignants & thérapeutes'],['🏫','Enseignants'],['🏢','Leaders & managers'],['📚','Éducateurs & profs']] as [$__mps_icon,$__mps_lbl])
          <span style="display:inline-flex;align-items:center;gap:.35rem;font-size:.88rem;color:rgba(232,224,208,.75);background:rgba(201,168,76,.06);border:1px solid rgba(201,168,76,.15);border-radius:20px;padding:.22rem .65rem;">{{ $__mps_icon }} {{ $__mps_lbl }}</span>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @endif

  {{-- Bannière Retraite --}}
  <div style="margin: 2.5rem 0; background: linear-gradient(135deg, #06060f, #1a0f00); border: 1px solid rgba(212,168,83,0.25); border-radius: 16px; padding: 2rem 2.5rem; text-align: center;">
    <div style="color: #D4A853; font-size:1.1rem; letter-spacing: 2.5px; text-transform: uppercase; font-weight: 700; margin-bottom: .8rem;">La prochaine étape · 12 places seulement</div>
    <h3 style="color: #fff; font-family: Georgia, serif; font-weight: 300; font-size: 1.4rem; line-height: 1.4; margin-bottom: .75rem;">
      La formation se conclut par<br><em style="color: #D4A853; font-style: italic;">7 jours de retraite en Méditerranée</em>
    </h3>
    <p style="color: rgba(232,224,208,.75); font-size:1.05rem; margin-bottom: 1.25rem;">Blue Lagoon · Villa privée · 6 activités signature · Rituel de feu face à la mer</p>
    <a href="{{ route('presence.retraite') }}" style="display: inline-flex; align-items: center; gap: .5rem; padding: .7rem 1.8rem; background: linear-gradient(135deg,#D4A853,#B8893A); color: #fff; border-radius: 50px; font-size:1.05rem; font-weight: 600; text-decoration: none; box-shadow: 0 4px 16px rgba(212,168,83,.3);">
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
