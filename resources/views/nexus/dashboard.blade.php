@extends('frontend.freelance.layouts.app')

@section('pageHeading')
  NEXUS — Mon espace
@endsection

@section('metaDescription')
  Votre espace NEXUS personnel : gérez vos échanges, explorez de nouvelles destinations et connectez avec la communauté.
@endsection

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ asset('assets/front/css/homeswap-filters.css') }}">
<style>
/* Variables couleurs HomeSwap — requises par homeswap-filters.css */
:root {
  --preply-primary:       #EC4899;
  --preply-primary-dark:  #DB2777;
  --preply-primary-light: #2563EB;
  --preply-pink:          #F472B6;
  --preply-pink-light:    #3B82F6;
  --preply-text:          #1F2937;
  --preply-text-light:    #6B7280;
  --preply-bg:            #FFFFFF;
  --preply-border:        #E5E7EB;
  --preply-hover:         #F9FAFB;
}
/* Flatpickr — z-index au-dessus de tout le dashboard */
.flatpickr-calendar { z-index: 9999 !important; }
.flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange {
  background: #EC4899 !important; border-color: #EC4899 !important;
}
.flatpickr-day.inRange { background: rgba(236,72,153,0.15) !important; box-shadow: none !important; }

/* Override : dans le dashboard, .homeswap-search-filter-section hérite du panel nx — pas de double carte */
.nx-search-section .homeswap-search-filter-section {
  background: transparent !important;
  box-shadow: none !important;
  border: none !important;
  border-radius: 0 !important;
  padding: 0 !important;
  margin: 0 !important;
}

/* ─── Bloc Ma langue maternelle + Autres langues (miroir homeswap) ─── */
.homeswap-filters-form .filter-group--full { width: 100%; display: block; }
.homeswap-filters-form .homeswap-langues-row { width: 100%; }
.homeswap-filters-form .filter-group.besoin-langues {
  padding: 0.85rem 0 0.75rem;
  border-top: 1px solid rgba(236, 72, 153, 0.1);
  margin-top: 0.25rem;
}
.homeswap-filters-form .filter-label {
  font-size: 0.875rem;
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.55rem;
  display: flex;
  align-items: center;
  gap: 0.4rem;
}
.homeswap-filters-form .filter-label i { color: #EC4899; }
.homeswap-filters-form .filter-select {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  font-size: 0.9375rem;
  background: #fff;
  color: #374151;
  appearance: auto;
  transition: border-color 0.2s, box-shadow 0.2s;
  cursor: pointer;
}
.homeswap-filters-form .filter-select:focus {
  outline: none;
  border-color: rgba(236, 72, 153, 0.5);
  box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
}
.homeswap-filters-form .besoin-langues-row {
  display: flex; flex-wrap: nowrap; align-items: flex-start; gap: 1rem 1.5rem;
}
.homeswap-filters-form .besoin-mother-tongue-wrap {
  min-width: 180px; max-width: 220px; flex-shrink: 0;
}
.homeswap-filters-form .besoin-mother-tongue-wrap .filter-select { width: 100%; }
.homeswap-filters-form .besoin-other-langs-wrap {
  position: relative; flex: 1; min-width: 0;
  display: flex; flex-wrap: wrap; align-items: center; gap: 0.4rem 0.6rem;
}
.homeswap-filters-form .besoin-other-langs-label {
  font-size: 0.8rem; color: #6b7280; margin: 0; flex-shrink: 0;
}
.homeswap-filters-form .besoin-lang-chips {
  display: inline-flex; flex-wrap: wrap; align-items: center; gap: 0.4rem 0.6rem;
  min-height: 2rem; padding: 0.1rem 0; min-width: 0;
}
.homeswap-filters-form .besoin-lang-chip {
  display: inline-flex; align-items: center; gap: 0.35rem;
  padding: 0.25rem 0.55rem; border-radius: 10px;
  background: rgba(236, 72, 153, 0.07); border: 1px solid rgba(236, 72, 153, 0.22);
  font-size: 0.8rem; color: #1f2937;
}
.homeswap-filters-form .besoin-lang-chip-remove {
  background: none; border: none; padding: 0; margin: 0;
  cursor: pointer; color: #9ca3af; font-size: 0.9em; line-height: 1;
}
.homeswap-filters-form .besoin-lang-chip-remove:hover { color: #ef4444; }
.homeswap-filters-form .besoin-add-lang-btn {
  display: inline-flex; align-items: center; padding: 0.3rem 0.7rem; flex-shrink: 0;
  background: rgba(236, 72, 153, 0.06); border: 1px solid rgba(236, 72, 153, 0.2);
  border-radius: 8px; color: #EC4899; font-size: 0.85rem; font-weight: 600;
  cursor: pointer; transition: background 0.2s, border-color 0.2s, color 0.2s; gap: 0.3rem;
}
.homeswap-filters-form .besoin-add-lang-btn:hover {
  background: rgba(236, 72, 153, 0.12); border-color: rgba(236, 72, 153, 0.4);
}
/* Popover CECRL */
.homeswap-filters-form .cecrl-popover {
  display: none; position: absolute; z-index: 200; top: 100%; left: 0; margin-top: 0.35rem;
  min-width: 320px; max-width: 420px; max-height: 280px; overflow-y: auto;
  background: #fff; border-radius: 12px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.12), 0 2px 8px rgba(0,0,0,0.06);
  border: 1px solid rgba(0,0,0,0.08);
}
.homeswap-filters-form .cecrl-popover:not([hidden]) { display: block; }
.homeswap-filters-form .cecrl-popover[hidden] { display: none !important; }
.homeswap-filters-form .cecrl-popover-inner { padding: 0.75rem 1rem; }
.homeswap-filters-form .cecrl-table-head {
  display: flex; padding: 0 0 0.5rem; margin-bottom: 0.5rem;
  border-bottom: 1px solid #eee; font-size: 0.75rem; font-weight: 600;
  color: #6b7280; text-transform: uppercase;
}
.homeswap-filters-form .cecrl-th-lang { width: 100px; flex-shrink: 0; }
.homeswap-filters-form .cecrl-th-level { flex: 1; }
.homeswap-filters-form .cecrl-row {
  display: flex; align-items: center; gap: 0.5rem; padding: 0.35rem 0; font-size: 0.85rem;
}
.homeswap-filters-form .cecrl-lang { width: 100px; flex-shrink: 0; color: #374151; }
.homeswap-filters-form .cecrl-pills { display: flex; flex-wrap: wrap; gap: 0.25rem; }
.homeswap-filters-form .cecrl-pill {
  padding: 0.2rem 0.45rem; border-radius: 8px; border: 1px solid #e5e7eb;
  background: #fafafa; color: #6b7280; font-size: 0.75rem; font-weight: 500;
  cursor: pointer; transition: background 0.2s, border-color 0.2s, color 0.2s;
}
.homeswap-filters-form .cecrl-pill:hover { background: #fce7f3; border-color: #f9a8d4; color: #be185d; }
.homeswap-filters-form .cecrl-pill.is-selected {
  background: rgba(236, 72, 153, 0.1); border-color: rgba(236, 72, 153, 0.4); color: #EC4899;
}
@media (max-width: 768px) {
  .homeswap-filters-form .besoin-langues-row { flex-direction: column; }
  .homeswap-filters-form .besoin-mother-tongue-wrap { max-width: 100%; }
  .homeswap-filters-form .besoin-other-langs-wrap { min-width: 100%; }
}

/* ─── Ligne Domaine + Spécialisation (miroir homeswap) ─── */
.homeswap-domain-spec-row {
  display: flex;
  align-items: center;
  gap: 20px;
  padding: 14px 24px 0;
  flex-wrap: wrap;
}
.filter-domain-nexus { flex: 0 0 auto; }
.filter-specialization-nexus {
  flex: 1 1 333px;
  min-width: 293px;
  max-width: 433px;
}
@media (max-width: 640px) {
  .homeswap-domain-spec-row { padding: 12px 12px 0; gap: 12px; }
  .filter-specialization-nexus { max-width: 100%; flex: 1 1 100%; }
}

/* ─── Pills Mode d'intervention ─── */
.mode-intervention-label {
  display: block;
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.07em;
  color: #9CA3AF;
  margin-bottom: 6px;
}
.mode-intervention-segmented {
  display: flex;
  gap: 0.375rem;
  background: #f3f4f6;
  border-radius: 12px;
  padding: 4px;
  border: 1px solid #e5e7eb;
}
.mode-intervention-pill {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.35rem;
  padding: 0.5rem 1.1rem;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  background: transparent;
  border: none;
  white-space: nowrap;
  user-select: none;
}
.mode-intervention-pill:hover { background: rgba(255, 255, 255, 0.8); }
.mode-intervention-pill.is-active {
  background: linear-gradient(135deg, #EC4899 0%, #A855F7 55%, #3B82F6 100%);
  color: #fff;
  box-shadow: 0 2px 10px rgba(236, 72, 153, 0.28);
}
.mode-intervention-pill-icon { font-size: 0.95rem; line-height: 1; }
.mode-intervention-pill-text {
  font-size: 0.8125rem;
  font-weight: 600;
  color: #374151;
  transition: color 0.18s ease;
}
.mode-intervention-pill.is-active .mode-intervention-pill-text { color: #fff; }
@media (max-width: 580px) {
  .mode-intervention-segmented { flex-wrap: wrap; }
  .mode-intervention-pill { flex: 1 1 calc(50% - 0.375rem); }
}
/* ═══════════════════════════════════════════════════════════
   NEXUS DASHBOARD — Design système ultra-lux
   Palette: rose #EC4899 | bleu #2563EB | dark #1e293b
   ═══════════════════════════════════════════════════════════ */
:root {
  --nx-pink:        #EC4899;
  --nx-pink-light:  #F472B6;
  --nx-blue:        #2563EB;
  --nx-blue-light:  #3B82F6;
  --nx-dark:        #0f172a;
  --nx-slate:       #1e293b;
  --nx-mid:         #475569;
  --nx-muted:       #94a3b8;
  --nx-border:      #e2e8f0;
  --nx-bg:          #f8fafc;
  --nx-white:       #ffffff;
  --nx-gradient:    linear-gradient(135deg, #EC4899 0%, #F472B6 40%, #2563EB 100%);
  --nx-gradient-dk: linear-gradient(135deg, #be185d 0%, #EC4899 45%, #1d4ed8 100%);
  --nx-shadow-sm:   0 2px 8px rgba(0,0,0,.06);
  --nx-shadow-md:   0 8px 32px rgba(0,0,0,.1);
  --nx-shadow-lg:   0 24px 64px rgba(0,0,0,.14);
  --nx-radius:      20px;
  --nx-radius-sm:   12px;
}

body { background: var(--nx-bg) !important; }

/* ── Wrapper global ────────────────────────────────────── */
.nx-dashboard {
  min-height: 100vh;
  background: var(--nx-bg);
  padding-bottom: 5rem;
}

/* ═══════════════════════════════════════════════════════════
   HERO
   ═══════════════════════════════════════════════════════════ */
.nx-hero {
  position: relative;
  background: var(--nx-gradient-dk);
  overflow: hidden;
  padding: 3rem 2.5rem 2.5rem;
  margin: 0;
  color: #fff;
}
.nx-hero::before {
  content: '';
  position: absolute;
  top: -100px; left: -80px;
  width: 480px; height: 480px;
  background: radial-gradient(circle, rgba(255,255,255,.08) 0%, transparent 65%);
  border-radius: 50%;
  pointer-events: none;
}
.nx-hero::after {
  content: '';
  position: absolute;
  bottom: -140px; right: -100px;
  width: 600px; height: 600px;
  background: radial-gradient(circle, rgba(37,99,235,.22) 0%, transparent 65%);
  border-radius: 50%;
  pointer-events: none;
}
.nx-hero-inner {
  position: relative;
  z-index: 2;
  max-width: 1280px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 2rem;
}
.nx-hero-left { flex: 1; min-width: 260px; }
.nx-hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: .5rem;
  background: rgba(255,255,255,.12);
  border: 1px solid rgba(255,255,255,.2);
  border-radius: 999px;
  padding: .3rem .9rem;
  font-size: .75rem;
  font-weight: 600;
  letter-spacing: .08em;
  text-transform: uppercase;
  margin-bottom: 1rem;
  backdrop-filter: blur(8px);
}
.nx-hero-eyebrow-dot {
  width: 6px; height: 6px;
  background: #10b981;
  border-radius: 50%;
  animation: nx-pulse 2s infinite;
}
@keyframes nx-pulse {
  0%,100% { opacity: 1; transform: scale(1); }
  50%      { opacity: .6; transform: scale(1.4); }
}
.nx-hero-title {
  font-size: clamp(1.75rem, 3vw, 2.5rem);
  font-weight: 800;
  margin: 0 0 .5rem;
  line-height: 1.15;
}
.nx-hero-subtitle {
  font-size: 1rem;
  color: rgba(255,255,255,.72);
  margin: 0 0 1.75rem;
  font-weight: 400;
}
.nx-hero-ctas {
  display: flex; gap: .75rem; flex-wrap: wrap; align-items: center;
}
.nx-btn-hero-primary {
  display: inline-flex; align-items: center; gap: .5rem;
  padding: .7rem 1.5rem; border-radius: 12px;
  background: white; color: var(--nx-pink);
  font-size: .9rem; font-weight: 700; text-decoration: none;
  transition: all .25s ease;
  box-shadow: 0 4px 16px rgba(0,0,0,.2);
  border: none; cursor: pointer;
}
.nx-btn-hero-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(0,0,0,.25);
  color: var(--nx-blue);
  text-decoration: none;
}
.nx-btn-hero-ghost {
  display: inline-flex; align-items: center; gap: .5rem;
  padding: .65rem 1.4rem; border-radius: 12px;
  background: rgba(255,255,255,.12); color: #fff;
  border: 1px solid rgba(255,255,255,.28);
  font-size: .9rem; font-weight: 600; text-decoration: none;
  transition: all .25s ease;
  cursor: pointer;
  backdrop-filter: blur(6px);
}
.nx-btn-hero-ghost:hover {
  background: rgba(255,255,255,.2);
  transform: translateY(-1px);
  color: #fff;
  text-decoration: none;
}

/* ── Stats hero ─────────────────────────────────────────── */
.nx-hero-stats {
  display: flex; gap: 1.25rem; flex-wrap: wrap;
}
.nx-stat-card {
  background: rgba(255,255,255,.1);
  border: 1px solid rgba(255,255,255,.18);
  border-radius: 16px;
  padding: 1.1rem 1.4rem;
  min-width: 130px;
  text-align: center;
  backdrop-filter: blur(10px);
  transition: transform .2s ease;
}
.nx-stat-card:hover { transform: translateY(-3px); }
.nx-stat-value {
  font-size: 1.75rem; font-weight: 800; line-height: 1;
  margin-bottom: .3rem;
}
.nx-stat-label {
  font-size: .75rem; font-weight: 500;
  color: rgba(255,255,255,.65);
  text-transform: uppercase; letter-spacing: .06em;
}

/* ── Dots déco ───────────────────────────────────────────── */
.nx-hero-dots {
  position: absolute; top: 1.5rem; right: 2rem;
  display: grid; grid-template-columns: repeat(6, 8px); gap: 7px;
  opacity: .12; pointer-events: none; z-index: 1;
}
.nx-hero-dots span {
  width: 4px; height: 4px; background: #fff;
  border-radius: 50%; display: block;
}

/* ═══════════════════════════════════════════════════════════
   NAVIGATION TABS
   ═══════════════════════════════════════════════════════════ */
.nx-tabs-bar {
  background: var(--nx-white);
  border-bottom: 1px solid var(--nx-border);
  position: sticky; top: 0; z-index: 100;
  box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.nx-tabs-inner {
  max-width: 1280px; margin: 0 auto;
  padding: 0 2.5rem;
  display: flex; gap: 0; align-items: stretch;
  overflow-x: auto; scrollbar-width: none;
}
.nx-tabs-inner::-webkit-scrollbar { display: none; }
.nx-tab {
  display: inline-flex; align-items: center; gap: .45rem;
  padding: 1rem 1.25rem;
  font-size: .875rem; font-weight: 600;
  color: var(--nx-muted);
  text-decoration: none; white-space: nowrap;
  border-bottom: 3px solid transparent;
  transition: color .2s ease, border-color .2s ease;
  cursor: pointer; background: none; border-left: none; border-right: none; border-top: none;
}
.nx-tab:hover { color: var(--nx-pink); text-decoration: none; }
.nx-tab.is-active {
  color: var(--nx-pink);
  border-bottom-color: var(--nx-pink);
}
.nx-tab i { font-size: .875rem; }
.nx-tab-badge {
  background: var(--nx-pink); color: #fff;
  font-size: .65rem; font-weight: 700;
  border-radius: 999px; padding: .1rem .45rem;
  min-width: 1.2rem; text-align: center; line-height: 1.4;
}

/* ═══════════════════════════════════════════════════════════
   CONTENU PRINCIPAL
   ═══════════════════════════════════════════════════════════ */
.nx-content {
  max-width: 1280px; margin: 0 auto;
  padding: 2.5rem 2.5rem 0;
}
.nx-tab-panel { display: none; }
.nx-tab-panel.is-active { display: block; }

/* ═══════════════════════════════════════════════════════════
   ONGLET APERÇU — EFFET MIROIR
   ═══════════════════════════════════════════════════════════ */
.nx-mirror {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  align-items: start;
}
@media (max-width: 1024px) {
  .nx-mirror { grid-template-columns: 1fr; }
}

/* ── Panel générique ─────────────────────────────────────── */
.nx-panel {
  background: var(--nx-white);
  border-radius: var(--nx-radius);
  border: 1px solid var(--nx-border);
  box-shadow: var(--nx-shadow-sm);
  overflow: hidden;
  transition: box-shadow .25s ease;
}
.nx-panel:hover { box-shadow: var(--nx-shadow-md); }
.nx-panel-header {
  padding: 1.35rem 1.5rem;
  border-bottom: 1px solid var(--nx-border);
  display: flex; align-items: center; justify-content: space-between;
}
.nx-panel-title {
  font-size: 1rem; font-weight: 700; color: var(--nx-slate);
  display: flex; align-items: center; gap: .5rem;
  margin: 0;
}
.nx-panel-title i { color: var(--nx-pink); font-size: .9rem; }
.nx-panel-body { padding: 1.5rem; }

/* ── Profil card ─────────────────────────────────────────── */
.nx-profile-avatar {
  width: 64px; height: 64px; border-radius: 50%;
  background: var(--nx-gradient);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.5rem; font-weight: 800; color: #fff;
  flex-shrink: 0;
  box-shadow: 0 8px 20px rgba(236,72,153,.3);
}
.nx-profile-info { flex: 1; min-width: 0; }
.nx-profile-name {
  font-size: 1.2rem; font-weight: 700; color: var(--nx-slate);
  margin: 0 0 .2rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.nx-profile-meta {
  font-size: .8rem; color: var(--nx-muted); margin: 0;
  display: flex; align-items: center; gap: .4rem;
}
.nx-badge-nexus {
  display: inline-flex; align-items: center; gap: .3rem;
  background: linear-gradient(135deg, rgba(236,72,153,.1), rgba(37,99,235,.08));
  border: 1px solid rgba(236,72,153,.25);
  color: var(--nx-pink);
  font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em;
  border-radius: 999px; padding: .2rem .6rem;
}

/* Score confiance */
.nx-trust-bar-wrap { margin-top: 1.2rem; }
.nx-trust-label {
  display: flex; justify-content: space-between; align-items: center;
  font-size: .8rem; font-weight: 600; color: var(--nx-mid); margin-bottom: .4rem;
}
.nx-trust-bar {
  height: 6px; background: #f1f5f9; border-radius: 99px; overflow: hidden;
}
.nx-trust-fill {
  height: 100%; border-radius: 99px;
  background: var(--nx-gradient);
  transition: width 1.2s cubic-bezier(.22,1,.36,1);
}
.nx-trust-tips {
  font-size: .75rem; color: var(--nx-muted);
  margin-top: .5rem; line-height: 1.5;
}

/* Liens rapides profil */
.nx-quick-links {
  display: flex; flex-direction: column; gap: .6rem; margin-top: 1.2rem;
}
.nx-quick-link {
  display: flex; align-items: center; gap: .75rem;
  padding: .65rem .9rem; border-radius: 10px;
  background: var(--nx-bg); color: var(--nx-slate);
  text-decoration: none; font-size: .875rem; font-weight: 500;
  transition: background .2s ease, color .2s ease;
  border: 1px solid transparent;
}
.nx-quick-link:hover {
  background: linear-gradient(135deg, rgba(236,72,153,.06), rgba(37,99,235,.04));
  border-color: rgba(236,72,153,.18);
  color: var(--nx-pink);
  text-decoration: none;
}
.nx-quick-link i { color: var(--nx-pink); width: 16px; text-align: center; flex-shrink: 0; }

/* ── Activité ────────────────────────────────────────────── */
.nx-activity-list { display: flex; flex-direction: column; gap: 0; }
.nx-activity-item {
  display: flex; align-items: flex-start; gap: .9rem;
  padding: .9rem 1.5rem;
  border-bottom: 1px solid #f8fafc;
  transition: background .15s ease;
}
.nx-activity-item:last-child { border-bottom: none; }
.nx-activity-item:hover { background: #fafbff; }
.nx-activity-icon {
  width: 36px; height: 36px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: .9rem; flex-shrink: 0;
}
.nx-activity-icon-pink  { background: rgba(236,72,153,.1); color: var(--nx-pink); }
.nx-activity-icon-blue  { background: rgba(37,99,235,.1); color: var(--nx-blue); }
.nx-activity-icon-green { background: rgba(16,185,129,.1); color: #10b981; }
.nx-activity-icon-amber { background: rgba(245,158,11,.1); color: #f59e0b; }
.nx-activity-text { flex: 1; min-width: 0; }
.nx-activity-text p { margin: 0 0 .15rem; font-size: .875rem; color: var(--nx-slate); line-height: 1.4; }
.nx-activity-time { font-size: .75rem; color: var(--nx-muted); }
.nx-activity-amount { font-size: .8rem; font-weight: 700; color: #10b981; white-space: nowrap; }

/* ── Widget recherche miroir ─────────────────────────────── */
.nx-search-mirror {
  background: linear-gradient(160deg, #fff9fe 0%, #f0f4ff 100%);
  border: 1px solid rgba(236,72,153,.15);
  border-radius: var(--nx-radius);
  overflow: hidden;
  box-shadow: var(--nx-shadow-sm);
}
.nx-search-mirror-header {
  background: var(--nx-gradient);
  padding: 1.5rem 1.75rem;
  color: #fff;
}
.nx-search-mirror-title {
  font-size: 1.1rem; font-weight: 700; margin: 0 0 .3rem;
  display: flex; align-items: center; gap: .5rem;
}
.nx-search-mirror-subtitle {
  font-size: .8rem; opacity: .75; margin: 0;
}
.nx-search-mirror-body { padding: 1.5rem; }

/* Mini filtre dans le widget */
.nx-mini-filter { display: flex; flex-direction: column; gap: .85rem; }
.nx-mini-field {
  display: flex; align-items: center; gap: .7rem;
  background: #fff; border: 1.5px solid var(--nx-border);
  border-radius: 12px; padding: .7rem 1rem;
  transition: border-color .2s ease, box-shadow .2s ease;
  cursor: pointer;
}
.nx-mini-field:hover { border-color: var(--nx-pink-light); }
.nx-mini-field i { color: var(--nx-pink); font-size: .9rem; width: 16px; flex-shrink: 0; }
.nx-mini-field-label { font-size: .8rem; color: var(--nx-muted); }
.nx-mini-field-value { font-size: .9rem; color: var(--nx-slate); font-weight: 500; }
.nx-mini-search-btn {
  display: flex; align-items: center; justify-content: center; gap: .5rem;
  width: 100%; padding: .85rem;
  background: var(--nx-gradient);
  color: #fff; font-size: .95rem; font-weight: 700;
  border: none; border-radius: 12px; cursor: pointer;
  transition: opacity .2s ease, transform .2s ease;
  text-decoration: none;
  box-shadow: 0 4px 16px rgba(236,72,153,.3);
}
.nx-mini-search-btn:hover {
  opacity: .92; transform: translateY(-1px);
  box-shadow: 0 8px 24px rgba(236,72,153,.4);
  color: #fff; text-decoration: none;
}

/* Destinations suggérées */
.nx-destinations {
  margin-top: 1.25rem;
  display: flex; flex-direction: column; gap: .5rem;
}
.nx-dest-title {
  font-size: .75rem; font-weight: 600; color: var(--nx-muted);
  text-transform: uppercase; letter-spacing: .07em; margin-bottom: .35rem;
}
.nx-dest-chips {
  display: flex; flex-wrap: wrap; gap: .4rem;
}
.nx-dest-chip {
  display: inline-flex; align-items: center; gap: .3rem;
  padding: .3rem .7rem; border-radius: 999px;
  background: #fff; border: 1px solid var(--nx-border);
  font-size: .8rem; color: var(--nx-mid); cursor: pointer;
  transition: border-color .2s, color .2s, background .2s;
  text-decoration: none;
}
.nx-dest-chip:hover {
  border-color: var(--nx-pink); color: var(--nx-pink);
  background: rgba(236,72,153,.04);
  text-decoration: none;
}

/* ── Section stats miroir ───────────────────────────────── */
.nx-stats-row {
  display: grid; grid-template-columns: repeat(3, 1fr);
  gap: 1rem; margin-bottom: 1.5rem;
}
.nx-stat-mini {
  background: var(--nx-white); border-radius: var(--nx-radius-sm);
  border: 1px solid var(--nx-border); padding: 1rem 1.1rem;
  box-shadow: var(--nx-shadow-sm);
  transition: transform .2s ease, box-shadow .2s ease;
}
.nx-stat-mini:hover { transform: translateY(-2px); box-shadow: var(--nx-shadow-md); }
.nx-stat-mini-value {
  font-size: 1.5rem; font-weight: 800; color: var(--nx-slate);
  margin-bottom: .2rem; display: flex; align-items: baseline; gap: .2rem;
}
.nx-stat-mini-unit { font-size: .8rem; font-weight: 500; color: var(--nx-muted); }
.nx-stat-mini-label { font-size: .75rem; color: var(--nx-muted); }
.nx-stat-mini-trend {
  font-size: .7rem; font-weight: 600; margin-top: .3rem;
}
.trend-up   { color: #10b981; }
.trend-down { color: #ef4444; }

/* ═══════════════════════════════════════════════════════════
   ONGLET RECHERCHE — PLEIN ÉCRAN FILTRE NEXUS
   ═══════════════════════════════════════════════════════════ */
.nx-search-section {
  background: var(--nx-white);
  border-radius: var(--nx-radius);
  border: 1px solid var(--nx-border);
  padding: 2rem;
  box-shadow: var(--nx-shadow-sm);
}
.nx-search-section-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 1.75rem; padding-bottom: 1.25rem;
  border-bottom: 1px solid var(--nx-border);
}
.nx-search-section-title {
  font-size: 1.2rem; font-weight: 700; color: var(--nx-slate);
  display: flex; align-items: center; gap: .6rem; margin: 0;
}
.nx-search-section-title i { color: var(--nx-pink); }
.nx-search-badge {
  font-size: .75rem; font-weight: 600;
  background: rgba(236,72,153,.08); color: var(--nx-pink);
  border: 1px solid rgba(236,72,153,.2); border-radius: 999px;
  padding: .25rem .75rem;
}

/* Filtre intégré dans le dashboard (override léger) */
.nx-search-section .homeswap-filters-form .filter-row-main {
  gap: .85rem;
}
.nx-search-section .homeswap-filters-form .filter-submit-btn {
  background: var(--nx-gradient) !important;
}

/* ── Formulaire préférences (onglet Recherche) ───────────── */
.nx-prefs-form { display: flex; flex-direction: column; gap: 1.5rem; }
.nx-prefs-section { display: flex; flex-direction: column; gap: .55rem; }
.nx-prefs-grid {
  display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;
}
@media (max-width: 600px) { .nx-prefs-grid { grid-template-columns: 1fr; } }
.nx-prefs-label {
  font-size: .8rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .07em; color: var(--nx-muted);
  display: flex; align-items: center; gap: .4rem;
}
.nx-prefs-label i { color: var(--nx-pink); width: 14px; text-align: center; }

/* ═══════════════════════════════════════════════════════════
   ONGLET MES ÉCHANGES
   ═══════════════════════════════════════════════════════════ */
.nx-exchanges-grid {
  display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}
.nx-exchange-card {
  background: var(--nx-white); border-radius: var(--nx-radius);
  border: 1px solid var(--nx-border); overflow: hidden;
  box-shadow: var(--nx-shadow-sm);
  transition: transform .25s ease, box-shadow .25s ease;
}
.nx-exchange-card:hover { transform: translateY(-4px); box-shadow: var(--nx-shadow-lg); }
.nx-exchange-img {
  width: 100%; height: 180px; object-fit: cover;
  background: linear-gradient(135deg, rgba(236,72,153,.15), rgba(37,99,235,.1));
  display: flex; align-items: center; justify-content: center;
  font-size: 2.5rem;
}
.nx-exchange-body { padding: 1.2rem; }
.nx-exchange-location {
  font-size: .8rem; color: var(--nx-muted); margin-bottom: .35rem;
  display: flex; align-items: center; gap: .3rem;
}
.nx-exchange-location i { color: var(--nx-pink); }
.nx-exchange-title {
  font-size: 1rem; font-weight: 700; color: var(--nx-slate);
  margin: 0 0 .5rem;
}
.nx-exchange-dates {
  font-size: .8rem; color: var(--nx-mid);
  display: flex; align-items: center; gap: .3rem;
}
.nx-exchange-dates i { color: var(--nx-blue); }
.nx-exchange-footer {
  display: flex; align-items: center; justify-content: space-between;
  padding: .9rem 1.2rem;
  border-top: 1px solid var(--nx-border);
}
.nx-exchange-status {
  font-size: .75rem; font-weight: 600;
  padding: .25rem .7rem; border-radius: 999px;
}
.status-active    { background: rgba(16,185,129,.1); color: #059669; }
.status-pending   { background: rgba(245,158,11,.1); color: #d97706; }
.status-completed { background: rgba(37,99,235,.1); color: var(--nx-blue); }

/* ═══════════════════════════════════════════════════════════
   ONGLET MESSAGES (stub)
   ═══════════════════════════════════════════════════════════ */
.nx-messages-layout {
  display: grid; grid-template-columns: 320px 1fr;
  gap: 0; height: 600px;
  background: var(--nx-white); border-radius: var(--nx-radius);
  border: 1px solid var(--nx-border); overflow: hidden;
  box-shadow: var(--nx-shadow-sm);
}
.nx-messages-list {
  border-right: 1px solid var(--nx-border);
  overflow-y: auto;
}
.nx-msg-item {
  display: flex; gap: .75rem; padding: 1rem 1.1rem;
  border-bottom: 1px solid #f8fafc; cursor: pointer;
  transition: background .15s ease;
}
.nx-msg-item.is-active { background: linear-gradient(135deg, rgba(236,72,153,.05), rgba(37,99,235,.03)); }
.nx-msg-item:hover { background: var(--nx-bg); }
.nx-msg-avatar {
  width: 42px; height: 42px; border-radius: 50%;
  background: var(--nx-gradient);
  display: flex; align-items: center; justify-content: center;
  font-size: .85rem; font-weight: 700; color: #fff; flex-shrink: 0;
}
.nx-msg-name { font-size: .875rem; font-weight: 600; color: var(--nx-slate); margin: 0 0 .15rem; }
.nx-msg-preview { font-size: .8rem; color: var(--nx-muted); margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.nx-messages-pane {
  display: flex; flex-direction: column; align-items: center;
  justify-content: center; gap: .75rem; color: var(--nx-muted);
  padding: 2rem;
}
.nx-messages-pane i { font-size: 2.5rem; color: var(--nx-border); }

/* ═══════════════════════════════════════════════════════════
   ONGLET PROFIL
   ═══════════════════════════════════════════════════════════ */
.nx-profile-layout {
  display: grid; grid-template-columns: 340px 1fr;
  gap: 1.5rem; align-items: start;
}
@media (max-width: 900px) { .nx-profile-layout { grid-template-columns: 1fr; } }
.nx-profile-card-large {
  background: var(--nx-white); border-radius: var(--nx-radius);
  border: 1px solid var(--nx-border); overflow: hidden;
  box-shadow: var(--nx-shadow-sm); text-align: center;
}
.nx-profile-cover {
  height: 120px;
  background: var(--nx-gradient); position: relative;
}
.nx-profile-avatar-lg {
  width: 80px; height: 80px; border-radius: 50%;
  background: var(--nx-gradient);
  border: 4px solid #fff;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.75rem; font-weight: 800; color: #fff;
  margin: -40px auto 0; position: relative; z-index: 2;
  box-shadow: 0 8px 24px rgba(236,72,153,.3);
}
.nx-profile-card-body { padding: 1.2rem 1.5rem 1.5rem; }
.nx-profile-card-name { font-size: 1.2rem; font-weight: 700; color: var(--nx-slate); margin: .6rem 0 .2rem; }
.nx-profile-card-email { font-size: .8rem; color: var(--nx-muted); margin: 0 0 1rem; }
.nx-profile-card-edit {
  display: inline-flex; align-items: center; gap: .4rem;
  padding: .6rem 1.2rem; border-radius: 10px;
  background: var(--nx-gradient); color: #fff;
  font-size: .85rem; font-weight: 600; text-decoration: none;
  transition: opacity .2s ease;
}
.nx-profile-card-edit:hover { opacity: .88; color: #fff; text-decoration: none; }

/* ═══════════════════════════════════════════════════════════
   EMPTY STATE
   ═══════════════════════════════════════════════════════════ */
.nx-empty {
  text-align: center; padding: 4rem 2rem;
  background: var(--nx-white); border-radius: var(--nx-radius);
  border: 1px solid var(--nx-border);
}
.nx-empty-icon { font-size: 3rem; color: var(--nx-border); margin-bottom: 1rem; }
.nx-empty h3 { font-size: 1.1rem; font-weight: 700; color: var(--nx-slate); margin: 0 0 .5rem; }
.nx-empty p { font-size: .875rem; color: var(--nx-muted); margin: 0 0 1.5rem; }
.nx-empty-cta {
  display: inline-flex; align-items: center; gap: .5rem;
  padding: .75rem 1.5rem; border-radius: 12px;
  background: var(--nx-gradient); color: #fff;
  font-size: .9rem; font-weight: 700; text-decoration: none;
  transition: opacity .2s ease, transform .2s ease;
  box-shadow: 0 4px 16px rgba(236,72,153,.3);
}
.nx-empty-cta:hover { opacity: .9; transform: translateY(-2px); color: #fff; text-decoration: none; }

/* ═══════════════════════════════════════════════════════════
   SECTION TITRE
   ═══════════════════════════════════════════════════════════ */
.nx-section-label {
  font-size: .7rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .1em; color: var(--nx-muted);
  margin-bottom: 1rem; display: flex; align-items: center; gap: .5rem;
}
.nx-section-label::after {
  content: ''; flex: 1; height: 1px; background: var(--nx-border);
}

/* ── Responsive ─────────────────────────────────────────── */
@media (max-width: 768px) {
  .nx-hero { padding: 1.75rem 1.25rem; }
  .nx-content { padding: 1.5rem 1.25rem 0; }
  .nx-stats-row { grid-template-columns: 1fr 1fr; }
  .nx-tabs-inner { padding: 0 1rem; }
  .nx-messages-layout { grid-template-columns: 1fr; height: auto; }
  .nx-messages-list { max-height: 250px; }
}

/* ═══════════════════════════════════════════════════════════
   PILLS DOMAINE (miroir homeswap) — scopé au dashboard
   ═══════════════════════════════════════════════════════════ */
.nx-search-mirror .nx-domain-form { display: flex; flex-direction: column; gap: 1.1rem; }
.nx-search-mirror .nx-domain-row { display: flex; flex-direction: column; gap: 6px; }

/* Étiquette DOMAINE */
.nx-search-mirror .mode-intervention-label {
  display: block; font-size: .75rem; font-weight: 700;
  text-transform: uppercase; letter-spacing: .07em; color: #9CA3AF;
}

/* Conteneur pills */
.nx-search-mirror .mode-intervention-segmented {
  display: flex; gap: .375rem;
  background: #f3f4f6; border-radius: 12px;
  padding: 4px; border: 1px solid #e5e7eb;
}

/* Pill unitaire */
.nx-search-mirror .mode-intervention-pill {
  flex: 1; display: flex; align-items: center; justify-content: center;
  gap: .35rem; padding: .5rem 1rem; border-radius: 8px;
  cursor: pointer; transition: all .2s ease;
  background: transparent; border: none; white-space: nowrap; user-select: none;
}
.nx-search-mirror .mode-intervention-pill:hover { background: rgba(255,255,255,.8); }
.nx-search-mirror .mode-intervention-pill.is-active {
  background: linear-gradient(135deg, #EC4899 0%, #A855F7 55%, #3B82F6 100%);
  color: #fff; box-shadow: 0 2px 10px rgba(236,72,153,.28);
}
.nx-search-mirror .mode-intervention-pill-icon { font-size: .95rem; line-height: 1; }
.nx-search-mirror .mode-intervention-pill-text {
  font-size: .8125rem; font-weight: 600; color: #374151; transition: color .18s;
}
.nx-search-mirror .mode-intervention-pill.is-active .mode-intervention-pill-text { color: #fff; }

/* Ligne spécialisation */
.nx-search-mirror .nx-spec-row {
  display: flex; align-items: center; gap: .75rem;
  background: #fff; border: 1.5px solid #fce7f3; border-radius: 12px;
  padding: .7rem 1rem; transition: border-color .2s;
}
.nx-search-mirror .nx-spec-row:focus-within { border-color: var(--nx-pink); }
.nx-search-mirror .nx-spec-icon { color: var(--nx-pink); font-size: 1rem; flex-shrink: 0; }
.nx-search-mirror .nx-spec-select {
  flex: 1; border: none; outline: none; background: transparent;
  font-size: 1rem; font-weight: 600; color: var(--nx-slate); cursor: pointer;
  appearance: none; -webkit-appearance: none;
}

@media(max-width:580px){
  .nx-search-mirror .mode-intervention-segmented { flex-wrap: wrap; }
  .nx-search-mirror .mode-intervention-pill { flex: 1 1 calc(50% - .375rem); }
}

/* ═══════════════════════════════════════════════════════════
   CTA EXPLORER
   ═══════════════════════════════════════════════════════════ */
.nx-cta-icon {
  width: 56px; height: 56px; border-radius: 16px;
  background: var(--nx-gradient);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; font-size: 1.4rem; color: #fff;
  box-shadow: 0 6px 18px rgba(236,72,153,.3);
}
.nx-cta-text { flex: 1; min-width: 0; }
.nx-cta-title {
  font-size: 1.1rem; font-weight: 700;
  color: var(--nx-slate); margin: 0 0 .35rem;
}
.nx-cta-desc {
  font-size: .95rem; color: var(--nx-muted); margin: 0; line-height: 1.5;
}
.nx-cta-btn {
  flex-shrink: 0; padding: .75rem 1.4rem; border-radius: 12px;
  background: var(--nx-gradient); color: #fff; border: none;
  font-size: 1rem; font-weight: 700; cursor: pointer;
  white-space: nowrap; display: inline-flex; align-items: center; gap: .4rem;
  transition: opacity .2s, transform .2s;
  box-shadow: 0 4px 14px rgba(236,72,153,.3);
}
.nx-cta-btn:hover { opacity: .88; transform: translateY(-2px); }

/* ═══════════════════════════════════════════════════════════
   MESSAGES — classes nommées
   ═══════════════════════════════════════════════════════════ */
.nx-msg-list-header {
  padding: 1rem 1.25rem; border-bottom: 1px solid var(--nx-border);
}
.nx-msg-list-title {
  font-size: .8rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .08em; color: var(--nx-muted);
}
.nx-msg-time {
  font-size: .8rem; color: var(--nx-muted); flex-shrink: 0; margin-left: auto; padding-left: .5rem;
}
.nx-messages-pane-icon { font-size: 3rem; color: var(--nx-border); margin-bottom: .75rem; }
.nx-messages-pane-title { font-size: 1.1rem; font-weight: 600; color: var(--nx-mid); margin: 0 0 .4rem; }
.nx-messages-pane-sub { font-size: .95rem; color: var(--nx-muted); margin: 0; text-align: center; max-width: 300px; line-height: 1.6; }

/* ═══════════════════════════════════════════════════════════
   PROFIL — grille infos
   ═══════════════════════════════════════════════════════════ */
.nx-info-grid { display: flex; flex-direction: column; gap: 0; }
.nx-info-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: .85rem 0; border-bottom: 1px solid #f1f5f9;
  gap: 1rem;
}
.nx-info-row:last-child { border-bottom: none; }
.nx-info-label {
  font-size: 1rem; color: var(--nx-muted);
  display: flex; align-items: center; gap: .5rem; flex-shrink: 0;
}
.nx-info-label i { color: var(--nx-pink); width: 16px; text-align: center; }
.nx-info-value {
  font-size: 1rem; font-weight: 600; color: var(--nx-slate);
  text-align: right; word-break: break-all;
}

/* ═══════════════════════════════════════════════════════════
   PARAMÈTRES — grille + lignes
   ═══════════════════════════════════════════════════════════ */
.nx-settings-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
  gap: 1.5rem;
  align-items: start;
}
.nx-setting-link {
  display: flex; align-items: center; gap: 1rem;
  padding: 1rem 1.5rem;
  border-bottom: 1px solid #f8fafc;
  text-decoration: none; color: inherit;
  transition: background .15s ease;
  cursor: pointer;
}
.nx-setting-link:last-child { border-bottom: none; }
.nx-setting-link:hover { background: #fafbff; text-decoration: none; }
.nx-setting-link-icon {
  width: 42px; height: 42px; border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1rem; flex-shrink: 0;
}
.nx-setting-link-text { flex: 1; min-width: 0; }
.nx-setting-link-title { font-size: 1rem; font-weight: 600; color: var(--nx-slate); display: block; }
.nx-setting-link-sub { font-size: .875rem; color: var(--nx-muted); display: block; margin-top: .1rem; }
.nx-setting-link-arrow { color: var(--nx-border); font-size: .875rem; flex-shrink: 0; }

/* Toggle switch */
.nx-toggle { position: relative; display: inline-flex; width: 44px; height: 24px; flex-shrink: 0; }
.nx-toggle input { opacity: 0; width: 0; height: 0; }
.nx-toggle-slider {
  position: absolute; inset: 0; background: #cbd5e1;
  border-radius: 999px; cursor: pointer;
  transition: background .25s ease;
}
.nx-toggle-slider::before {
  content: ''; position: absolute;
  width: 18px; height: 18px; background: #fff;
  border-radius: 50%; left: 3px; top: 3px;
  transition: transform .25s ease;
  box-shadow: 0 2px 4px rgba(0,0,0,.15);
}
.nx-toggle input:checked + .nx-toggle-slider { background: var(--nx-pink); }
.nx-toggle input:checked + .nx-toggle-slider::before { transform: translateX(20px); }

/* ═══════════════════════════════════════════════════════════
   LISIBILITÉ — polices augmentées uniformément
.nx-dashboard { font-size: 1.175rem; } /* ~19px — base généreuse */

/* Hero */
.nx-hero-eyebrow        { font-size: 1.05rem; }
.nx-hero-subtitle       { font-size: 1.25rem; }
.nx-btn-hero-primary,
.nx-btn-hero-ghost      { font-size: 1.1rem; }
.nx-stat-label          { font-size: 1rem; }
.nx-stat-value          { font-size: 2.25rem; }

/* Navigation tabs */
.nx-tab                 { font-size: 1.1rem; }
.nx-tab i               { font-size: 1.1rem; }
.nx-tab-badge           { font-size: .9rem; }

/* Panels */
.nx-panel-title         { font-size: 1.25rem; }
.nx-panel-title i       { font-size: 1.1rem; }

/* Stats mini (aperçu) */
.nx-stat-mini-value     { font-size: 2rem; }
.nx-stat-mini-unit      { font-size: 1rem; }
.nx-stat-mini-label     { font-size: 1rem; }
.nx-stat-mini-trend     { font-size: .95rem; }

/* Profil */
.nx-profile-name        { font-size: 1.45rem; }
.nx-profile-meta        { font-size: 1.05rem; }
.nx-trust-label         { font-size: 1.05rem; }
.nx-trust-tips          { font-size: 1rem; }
.nx-quick-link          { font-size: 1.1rem; }
.nx-badge-nexus         { font-size: .92rem; }

/* Activité */
.nx-activity-text p     { font-size: 1.1rem; }
.nx-activity-time       { font-size: .975rem; }
.nx-activity-amount     { font-size: 1rem; }

/* Widget recherche rapide */
.nx-search-mirror-title    { font-size: 1.35rem; }
.nx-search-mirror-subtitle { font-size: 1.05rem; }
.nx-mini-field-label       { font-size: 1rem; }
.nx-mini-field-value       { font-size: 1.1rem; }
.nx-mini-search-btn        { font-size: 1.1rem; }
.nx-dest-title             { font-size: 1rem; }
.nx-dest-chip              { font-size: 1.05rem; }

/* Section recherche NEXUS */
.nx-search-section-title { font-size: 1.5rem; }
.nx-search-badge         { font-size: 1rem; }

/* Échanges */
.nx-exchange-location   { font-size: 1.05rem; }
.nx-exchange-title      { font-size: 1.25rem; }
.nx-exchange-dates      { font-size: 1.05rem; }
.nx-exchange-status     { font-size: .975rem; }

/* Messages */
.nx-msg-name            { font-size: 1.15rem; }
.nx-msg-preview         { font-size: 1.05rem; }

/* Profil — grande carte */
.nx-profile-card-name   { font-size: 1.5rem; }
.nx-profile-card-email  { font-size: 1.05rem; }

/* Labels de section */
.nx-section-label       { font-size: .975rem; }

/* États vides */
.nx-empty h3            { font-size: 1.4rem; }
.nx-empty p             { font-size: 1.1rem; }
.nx-empty-cta           { font-size: 1.1rem; }
</style>
@endsection

@section('content')
<div class="nx-dashboard">

  {{-- ═══════════════════ HERO ═══════════════════ --}}
  <div class="nx-hero">
    <div class="nx-hero-dots">
      @for($i=0;$i<30;$i++) <span></span> @endfor
    </div>
    <div class="nx-hero-inner">
      <div class="nx-hero-left">
        <div class="nx-hero-eyebrow">
          <span class="nx-hero-eyebrow-dot"></span>
          Espace NEXUS
        </div>
        <h1 class="nx-hero-title">Bonjour, {{ $displayName }} ✦</h1>
        <p class="nx-hero-subtitle">Habitez le monde. Échangez autrement.</p>
        <div class="nx-hero-ctas">
          <a href="#recherche" class="nx-btn-hero-primary nx-tab-trigger" data-tab="search">
            <i class="fas fa-search"></i> Nouvelle recherche
          </a>
          <a href="#echanges" class="nx-btn-hero-ghost nx-tab-trigger" data-tab="exchanges">
            <i class="fas fa-exchange-alt"></i> Mes échanges
          </a>
        </div>
      </div>
      <div class="nx-hero-stats">
        <div class="nx-stat-card">
          <div class="nx-stat-value">0</div>
          <div class="nx-stat-label">Échanges actifs</div>
        </div>
        <div class="nx-stat-card">
          <div class="nx-stat-value">30+</div>
          <div class="nx-stat-label">Pays disponibles</div>
        </div>
        <div class="nx-stat-card">
          <div class="nx-stat-value">100%</div>
          <div class="nx-stat-label">Sécurisé</div>
        </div>
      </div>
    </div>
  </div>

  {{-- ═══════════════════ NAV TABS ═══════════════════ --}}
  <div class="nx-tabs-bar" id="nxTabsBar">
    <div class="nx-tabs-inner">
      <button class="nx-tab is-active"         data-tab="overview"   id="nx-tab-overview">
        <i class="fas fa-th-large"></i> Aperçu
      </button>
      <button class="nx-tab"                  data-tab="search"     id="nx-tab-search">
        <i class="fas fa-home"></i> Mon Offre
      </button>
      <button class="nx-tab"                  data-tab="exchanges"  id="nx-tab-exchanges">
        <i class="fas fa-exchange-alt"></i> Mes échanges
        <span class="nx-tab-badge" id="nxExchangesBadge" style="display:none">0</span>
      </button>
      <button class="nx-tab"                  data-tab="messages"   id="nx-tab-messages">
        <i class="fas fa-comment-dots"></i> Messages
      </button>
      <button class="nx-tab"                  data-tab="profile"    id="nx-tab-profile">
        <i class="fas fa-user"></i> Mon profil NEXUS
      </button>
      <button class="nx-tab"                  data-tab="settings"   id="nx-tab-settings">
        <i class="fas fa-sliders-h"></i> Paramètres
      </button>
    </div>
  </div>

  {{-- ═══════════════════ CONTENU ═══════════════════ --}}
  <div class="nx-content">

    {{-- ─── ONGLET APERÇU ─── --}}
    <div class="nx-tab-panel is-active" id="nx-panel-overview">

      {{-- Stats rapides --}}
      <div class="nx-stats-row">
        <div class="nx-stat-mini">
          <div class="nx-stat-mini-value">0 <span class="nx-stat-mini-unit">échanges</span></div>
          <div class="nx-stat-mini-label">Actifs en cours</div>
          <div class="nx-stat-mini-trend trend-up"><i class="fas fa-arrow-right" style="font-size:.8em"></i> Démarrez votre premier</div>
        </div>
        <div class="nx-stat-mini">
          <div class="nx-stat-mini-value">0 <span class="nx-stat-mini-unit">demandes</span></div>
          <div class="nx-stat-mini-label">Reçues cette semaine</div>
          <div class="nx-stat-mini-trend" style="color:var(--nx-muted)"><i class="fas fa-info-circle" style="font-size:.8em"></i> Complétez votre profil</div>
        </div>
        <div class="nx-stat-mini">
          <div class="nx-stat-mini-value">0 <span class="nx-stat-mini-unit">favoris</span></div>
          <div class="nx-stat-mini-label">Destinations sauvegardées</div>
          <div class="nx-stat-mini-trend" style="color:var(--nx-blue)"><i class="fas fa-compass" style="font-size:.8em"></i> Explorez la carte</div>
        </div>
      </div>

      {{-- Effet miroir --}}
      <div class="nx-mirror">

        {{-- Gauche : Profil + activité --}}
        <div style="display:flex;flex-direction:column;gap:1.5rem;">

          {{-- Card profil --}}
          <div class="nx-panel">
            <div class="nx-panel-header">
              <h3 class="nx-panel-title"><i class="fas fa-user"></i> Mon profil NEXUS</h3>
              <span class="nx-badge-nexus">✦ Membre</span>
            </div>
            <div class="nx-panel-body">
              <div style="display:flex;gap:1rem;align-items:center;margin-bottom:1rem;">
                <div class="nx-profile-avatar">{{ $initials }}</div>
                <div class="nx-profile-info">
                  <p class="nx-profile-name">{{ $displayName }}</p>
                  <p class="nx-profile-meta">
                    <i class="fas fa-envelope" style="color:var(--nx-pink);"></i>
                    {{ $user->email_address }}
                  </p>
                </div>
              </div>

              <div class="nx-trust-bar-wrap">
                <div class="nx-trust-label">
                  <span>Score de confiance NEXUS</span>
                  <strong style="color:var(--nx-pink)">40%</strong>
                </div>
                <div class="nx-trust-bar">
                  <div class="nx-trust-fill" style="width:40%"></div>
                </div>
                <p class="nx-trust-tips">Complétez votre profil pour augmenter votre visibilité et obtenir plus d'échanges.</p>
              </div>

              <div class="nx-quick-links">
                <a href="{{ route('nexus.onboarding.step1') }}" class="nx-quick-link" style="background:linear-gradient(135deg,#2563EB,#7C3AED,#EC4899);color:#fff;border-radius:10px;justify-content:center;font-weight:700;">
                  ✦ Configurer mon profil NEXUS
                </a>
                <button type="button" class="nx-quick-link nx-tab-trigger" data-tab="search" style="background:none;border:none;text-align:left;width:100%;cursor:pointer;">
                  <i class="fas fa-home"></i> Publier mon logement
                </button>
                @if($freelancerProfile)
                <a href="{{ route('freelance.dashboard') }}" class="nx-quick-link">
                  <i class="fas fa-briefcase"></i> Mon espace Freelance
                </a>
                @endif
              </div>
            </div>
          </div>

          {{-- Activité récente --}}
          <div class="nx-panel">
            <div class="nx-panel-header">
              <h3 class="nx-panel-title"><i class="fas fa-bell"></i> Activité récente</h3>
            </div>
            <div class="nx-activity-list">
              <div class="nx-activity-item">
                <div class="nx-activity-icon nx-activity-icon-pink">
                  <i class="fas fa-user-plus"></i>
                </div>
                <div class="nx-activity-text">
                  <p>Bienvenue dans l'espace <strong>NEXUS</strong> ! Commencez par compléter votre profil.</p>
                  <span class="nx-activity-time">Aujourd'hui</span>
                </div>
              </div>
              <div class="nx-activity-item">
                <div class="nx-activity-icon nx-activity-icon-blue">
                  <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="nx-activity-text">
                  <p><strong>30+ destinations</strong> disponibles pour votre premier échange.</p>
                  <span class="nx-activity-time">Explorez maintenant</span>
                </div>
              </div>
              <div class="nx-activity-item">
                <div class="nx-activity-icon nx-activity-icon-green">
                  <i class="fas fa-shield-alt"></i>
                </div>
                <div class="nx-activity-text">
                  <p>Tous les échanges sont <strong>vérifiés et sécurisés</strong> par l'équipe NEXUS.</p>
                  <span class="nx-activity-time">Garantie NEXUS</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Droite : Widget recherche miroir --}}
        <div style="display:flex;flex-direction:column;gap:1.5rem;">

          {{-- Widget recherche --}}
          <div class="nx-search-mirror">
            <div class="nx-search-mirror-header">
              <div class="nx-search-mirror-title">
                <i class="fas fa-sliders-h"></i> Mon profil miroir
              </div>
              <p class="nx-search-mirror-subtitle">Vos préférences alimentent la recherche communautaire</p>
            </div>
            <div class="nx-search-mirror-body">
              <form action="{{ route('nexus.preferences.save') }}" method="POST" class="nx-domain-form">
                @csrf

                {{-- Ligne Domaine : pills --}}
                <div class="nx-domain-row">
                  <span class="mode-intervention-label">Domaine</span>
                  <div class="mode-intervention-segmented" role="group" id="nxDomainSegmented" aria-label="Domaine">
                    <label class="mode-intervention-pill is-active" data-domain="logement">
                      <input type="radio" name="nexus_domain" value="logement" checked class="sr-only nx-domain-radio">
                      <span class="mode-intervention-pill-icon">🏠</span>
                      <span class="mode-intervention-pill-text">Logement</span>
                    </label>
                    <label class="mode-intervention-pill" data-domain="infrastructure-pro">
                      <input type="radio" name="nexus_domain" value="infrastructure-pro" class="sr-only nx-domain-radio">
                      <span class="mode-intervention-pill-icon">🏢</span>
                      <span class="mode-intervention-pill-text">Infrastructure Pro</span>
                    </label>
                    <label class="mode-intervention-pill" data-domain="enseignement">
                      <input type="radio" name="nexus_domain" value="enseignement" class="sr-only nx-domain-radio">
                      <span class="mode-intervention-pill-icon">🎓</span>
                      <span class="mode-intervention-pill-text">Enseignement</span>
                    </label>
                  </div>
                </div>

                {{-- Select Spécialisation contextuel --}}
                <div class="nx-spec-row">
                  <i class="fas fa-th-large nx-spec-icon"></i>

                  {{-- Logement --}}
                  <select name="specialization" id="nxSpecLogement" class="nx-spec-select" data-domain="logement">
                    <option value="">Spécialisation — Logement</option>
                    <option value="chambre">Chambre</option>
                    <option value="studio">Studio</option>
                    <option value="appartement">Appartement</option>
                    <option value="maison">Maison</option>
                    <option value="penthouse">Penthouse</option>
                    <option value="villa">Villa</option>
                    <option value="chalet">Chalet</option>
                    <option value="bungalow">Bungalow</option>
                    <option value="tiny-house">Tiny House / Cabane</option>
                    <option value="bateau">Bateau</option>
                  </select>

                  {{-- Infrastructure Pro --}}
                  <select name="specialization" id="nxSpecPro" class="nx-spec-select" data-domain="infrastructure-pro" disabled style="display:none">
                    <option value="">Spécialisation — Infrastructure Pro</option>
                    <option value="bureau">Bureau</option>
                    <option value="salle-reunion">Salle de réunion</option>
                    <option value="salle-evenement">Salle d'événement</option>
                    <option value="coworking">Espace coworking</option>
                    <option value="atelier-fablab">Atelier / Fablab</option>
                    <option value="studio-photo-video">Studio photo / vidéo</option>
                    <option value="scene-auditorium">Scène / Auditorium</option>
                  </select>

                  {{-- Enseignement --}}
                  <select name="specialization" id="nxSpecEnseignement" class="nx-spec-select" data-domain="enseignement" disabled style="display:none">
                    <option value="">Spécialisation — Enseignement</option>
                    <option value="college">Collège</option>
                    <option value="lycee">Lycée</option>
                    <option value="universite">Université</option>
                    <option value="institut-superieur">Institut Supérieur</option>
                    <option value="grande-ecole">Grande École</option>
                    <option value="ecole-langues">École de langues</option>
                    <option value="centre-formation">Centre de formation</option>
                    <option value="campus-international">Campus international</option>
                  </select>
                </div>

                <button type="submit" class="nx-mini-search-btn">
                  <i class="fas fa-save"></i> Enregistrer mes préférences
                </button>
              </form>

              {{-- JS sync pills → spec --}}
              <script>
              (function(){
                document.addEventListener('DOMContentLoaded', function(){
                  var pills  = document.querySelectorAll('#nxDomainSegmented .mode-intervention-pill');
                  var specs  = document.querySelectorAll('.nx-spec-select');
                  function applyDomain(domain){
                    pills.forEach(function(p){ p.classList.toggle('is-active', p.getAttribute('data-domain')===domain); });
                    specs.forEach(function(s){
                      var active = s.getAttribute('data-domain')===domain;
                      s.style.display = active ? '' : 'none';
                      s.disabled = !active;
                    });
                    var r = document.querySelector('#nxDomainSegmented input[value="'+domain+'"]');
                    if(r) r.checked = true;
                  }
                  applyDomain('logement');
                  pills.forEach(function(label){
                    label.addEventListener('click', function(){ applyDomain(label.getAttribute('data-domain')); });
                  });
                });
              })();
              </script>
            </div>
          </div>

          {{-- CTA Explorer --}}
          <div class="nx-panel nx-cta-explorer">
            <div class="nx-panel-body" style="display:flex;align-items:center;gap:1.5rem;padding:1.5rem;">
              <div class="nx-cta-icon">
                <i class="fas fa-map"></i>
              </div>
              <div class="nx-cta-text">
                <p class="nx-cta-title">Explorer les échanges disponibles</p>
                <p class="nx-cta-desc">Accédez à la recherche complète avec tous les filtres NEXUS — pays, dates, type de logement…</p>
              </div>
              <button type="button" class="nx-tab-trigger nx-cta-btn" data-tab="search">
                <i class="fas fa-search"></i> Explorer
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- ─── ONGLET MON OFFRE ─── --}}
    <div class="nx-tab-panel" id="nx-panel-search">
      <div class="nx-search-section">

        <div class="nx-search-section-header">
          <h2 class="nx-search-section-title">
            <i class="fas fa-home"></i> Mon Offre NEXUS
          </h2>
          <span class="nx-search-badge">Miroir — ce que vous proposez à l'échange</span>
        </div>
        <p style="color:var(--nx-muted);font-size:.95rem;margin:-1rem 0 1.75rem;line-height:1.6;">
          Décrivez votre bien exactement comme sur la page HomeSwap. Ces critères alimentent en temps réel la recherche des autres membres — plus vous êtes précis, meilleurs sont les matchs.
        </p>

        @if(session('success'))
          <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:12px;padding:1rem 1.25rem;margin-bottom:1.5rem;color:#15803d;display:flex;align-items:center;gap:.75rem;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
          </div>
        @endif

        {{-- Wrapper .homeswap-search-filter-section = active tout le CSS de homeswap-filters.css --}}
        <div class="homeswap-search-filter-section">
          <x-services.filters.homeswap-filters
            formId="preplyFiltersForm"
            :formAction="route('nexus.offer.save')"
          />
        </div>

        {{-- Renomme le bouton submit en "Enregistrer mon offre" --}}
        <script>
        document.addEventListener('DOMContentLoaded', function () {
          var form = document.getElementById('preplyFiltersForm');
          if (!form) return;
          var btn = form.querySelector('.filter-submit-btn');
          if (btn) { btn.innerHTML = '<i class="fas fa-save me-2"></i>Enregistrer mon offre'; }
        });
        </script>

      </div>
    </div>

    {{-- ─── ONGLET MES ÉCHANGES ─── --}}
    <div class="nx-tab-panel" id="nx-panel-exchanges">
      <div class="nx-empty">
        <div class="nx-empty-icon"><i class="fas fa-exchange-alt"></i></div>
        <h3>Aucun échange pour le moment</h3>
        <p>Lancez votre première recherche et trouvez l'échange idéal parmi nos destinations.</p>
        <button class="nx-empty-cta nx-tab-trigger" data-tab="search">
          <i class="fas fa-search"></i> Rechercher un échange
        </button>
      </div>
    </div>

    {{-- ─── ONGLET MESSAGES ─── --}}
    <div class="nx-tab-panel" id="nx-panel-messages">
      <div class="nx-messages-layout">
        <div class="nx-messages-list">
          <div class="nx-msg-list-header">
            <span class="nx-msg-list-title">Conversations</span>
          </div>
          <div class="nx-msg-item is-active">
            <div class="nx-msg-avatar" style="background:linear-gradient(135deg,#10b981,#059669);">JN</div>
            <div style="flex:1;min-width:0;">
              <p class="nx-msg-name">Équipe NEXUS</p>
              <p class="nx-msg-preview">Bienvenue dans votre espace NEXUS !</p>
            </div>
            <span class="nx-msg-time">Auj.</span>
          </div>
        </div>
        <div class="nx-messages-pane">
          <div class="nx-messages-pane-icon"><i class="fas fa-comments"></i></div>
          <p class="nx-messages-pane-title">Sélectionnez une conversation</p>
          <p class="nx-messages-pane-sub">Vos échanges avec d'autres membres de la communauté NEXUS apparaîtront ici.</p>
        </div>
      </div>
    </div>

    {{-- ─── ONGLET PROFIL ─── --}}
    <div class="nx-tab-panel" id="nx-panel-profile">
      <div class="nx-profile-layout">

        {{-- Carte identité --}}
        <div class="nx-profile-card-large">
          <div class="nx-profile-cover"></div>
          <div class="nx-profile-avatar-lg">{{ $initials }}</div>
          <div class="nx-profile-card-body">
            <p class="nx-profile-card-name">{{ $displayName }}</p>
            <p class="nx-profile-card-email">{{ $user->email_address }}</p>
            <span class="nx-badge-nexus" style="margin-bottom:1.25rem;display:inline-flex;">✦ Membre NEXUS</span>

            {{-- Score confiance --}}
            @php
              $trust = 20; // compte créé
              if ($user->email_verified_at) $trust += 25;
              if (!empty($user->phone))     $trust += 20;
              if (!empty($user->first_name)) $trust += 15;
              if (!empty($user->country_code)) $trust += 10;
              $trust = min($trust, 95);
            @endphp
            <div class="nx-trust-bar-wrap" style="margin-bottom:1.25rem;">
              <div class="nx-trust-label">
                <span style="font-size:1rem;">Score de confiance</span>
                <strong style="color:var(--nx-pink);font-size:1.05rem;">{{ $trust }}%</strong>
              </div>
              <div class="nx-trust-bar">
                <div class="nx-trust-fill" style="width:{{ $trust }}%"></div>
              </div>
            </div>

            <a href="{{ route('user.settings.profile') }}" class="nx-profile-card-edit">
              <i class="fas fa-edit"></i> Modifier mon profil
            </a>
            <a href="{{ route('nexus.onboarding.step1') }}" class="nx-profile-card-edit" style="margin-top:.65rem;background:linear-gradient(135deg,#2563EB,#7C3AED,#EC4899);">
              ✦ Onboarding NEXUS
            </a>
          </div>
        </div>

        {{-- Contenu droit --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

          {{-- Infos du compte --}}
          <div class="nx-panel">
            <div class="nx-panel-header">
              <h3 class="nx-panel-title"><i class="fas fa-id-card"></i> Informations du compte</h3>
            </div>
            <div class="nx-panel-body">
              <div class="nx-info-grid">
                <div class="nx-info-row">
                  <span class="nx-info-label"><i class="fas fa-user"></i> Nom d'utilisateur</span>
                  <span class="nx-info-value">{{ $user->username ?? '—' }}</span>
                </div>
                <div class="nx-info-row">
                  <span class="nx-info-label"><i class="fas fa-envelope"></i> Email</span>
                  <span class="nx-info-value">{{ $user->email_address }}</span>
                </div>
                <div class="nx-info-row">
                  <span class="nx-info-label"><i class="fas fa-phone"></i> Téléphone</span>
                  <span class="nx-info-value">{{ $user->phone ?? '—' }}</span>
                </div>
                <div class="nx-info-row">
                  <span class="nx-info-label"><i class="fas fa-globe"></i> Pays</span>
                  <span class="nx-info-value">{{ $user->country_code ?? '—' }}</span>
                </div>
                <div class="nx-info-row">
                  <span class="nx-info-label"><i class="fas fa-shield-check"></i> Email vérifié</span>
                  <span class="nx-info-value">
                    @if($user->email_verified_at)
                      <span style="color:#10b981;font-weight:600;"><i class="fas fa-check-circle"></i> Oui</span>
                    @else
                      <span style="color:#ef4444;font-weight:600;"><i class="fas fa-times-circle"></i> Non</span>
                    @endif
                  </span>
                </div>
              </div>
              <a href="{{ route('user.settings.profile') }}" class="nx-quick-link" style="margin-top:1rem;">
                <i class="fas fa-pencil-alt"></i> Modifier ces informations
              </a>
            </div>
          </div>

          {{-- Mon logement --}}
          <div class="nx-panel">
            <div class="nx-panel-header">
              <h3 class="nx-panel-title"><i class="fas fa-home"></i> Mon logement NEXUS</h3>
            </div>
            <div class="nx-panel-body">
              <div class="nx-empty" style="padding:1.75rem 1rem;box-shadow:none;border:none;">
                <div class="nx-empty-icon"><i class="fas fa-plus-circle"></i></div>
                <h3>Publiez votre logement</h3>
                <p>Proposez votre bien à la communauté NEXUS pour recevoir des demandes d'échange.</p>
                <a href="{{ route('services.homeswap') }}" class="nx-empty-cta">
                  <i class="fas fa-plus"></i> Ajouter un logement
                </a>
              </div>
            </div>
          </div>

          {{-- Évaluations --}}
          <div class="nx-panel">
            <div class="nx-panel-header">
              <h3 class="nx-panel-title"><i class="fas fa-star"></i> Évaluations & réputation</h3>
              <span style="font-size:.9rem;color:var(--nx-muted);">0 avis</span>
            </div>
            <div class="nx-panel-body" style="text-align:center;padding:2.5rem 1.5rem;">
              <div style="font-size:2.5rem;color:var(--nx-border);margin-bottom:.75rem;"><i class="fas fa-star"></i></div>
              <p style="color:var(--nx-mid);font-size:1rem;margin:0;">Vos évaluations apparaîtront ici après vos premiers échanges.</p>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- ─── ONGLET PARAMÈTRES ─── --}}
    <div class="nx-tab-panel" id="nx-panel-settings">
      <div class="nx-settings-grid">

        {{-- Compte --}}
        <div class="nx-panel">
          <div class="nx-panel-header">
            <h3 class="nx-panel-title"><i class="fas fa-user-cog"></i> Mon compte</h3>
          </div>
          <div class="nx-panel-body" style="padding:.5rem 0;">
            <a href="{{ route('user.settings.profile') }}" class="nx-setting-link">
              <div class="nx-setting-link-icon" style="background:rgba(236,72,153,.1);color:var(--nx-pink);"><i class="fas fa-user"></i></div>
              <div class="nx-setting-link-text">
                <span class="nx-setting-link-title">Profil public</span>
                <span class="nx-setting-link-sub">Nom, photo, biographie</span>
              </div>
              <i class="fas fa-chevron-right nx-setting-link-arrow"></i>
            </a>
            <a href="{{ route('user.settings.email.edit') }}" class="nx-setting-link">
              <div class="nx-setting-link-icon" style="background:rgba(37,99,235,.1);color:var(--nx-blue);"><i class="fas fa-envelope"></i></div>
              <div class="nx-setting-link-text">
                <span class="nx-setting-link-title">Adresse e-mail</span>
                <span class="nx-setting-link-sub">{{ $user->email_address }}</span>
              </div>
              <i class="fas fa-chevron-right nx-setting-link-arrow"></i>
            </a>
            <a href="{{ route('user.settings.password') }}" class="nx-setting-link">
              <div class="nx-setting-link-icon" style="background:rgba(16,185,129,.1);color:#10b981;"><i class="fas fa-lock"></i></div>
              <div class="nx-setting-link-text">
                <span class="nx-setting-link-title">Mot de passe</span>
                <span class="nx-setting-link-sub">Modifier votre mot de passe</span>
              </div>
              <i class="fas fa-chevron-right nx-setting-link-arrow"></i>
            </a>
          </div>
        </div>

        {{-- Paiement --}}
        <div class="nx-panel">
          <div class="nx-panel-header">
            <h3 class="nx-panel-title"><i class="fas fa-credit-card"></i> Paiement & sécurité</h3>
          </div>
          <div class="nx-panel-body" style="padding:.5rem 0;">
            <a href="{{ route('user.settings.payment_methods.index') }}" class="nx-setting-link">
              <div class="nx-setting-link-icon" style="background:rgba(245,158,11,.1);color:#f59e0b;"><i class="fas fa-credit-card"></i></div>
              <div class="nx-setting-link-text">
                <span class="nx-setting-link-title">Moyens de paiement</span>
                <span class="nx-setting-link-sub">Cartes, virement, portefeuille</span>
              </div>
              <i class="fas fa-chevron-right nx-setting-link-arrow"></i>
            </a>
            <a href="{{ route('user.settings.index') }}" class="nx-setting-link">
              <div class="nx-setting-link-icon" style="background:rgba(139,92,246,.1);color:#8b5cf6;"><i class="fas fa-shield-alt"></i></div>
              <div class="nx-setting-link-text">
                <span class="nx-setting-link-title">Confidentialité</span>
                <span class="nx-setting-link-sub">Données personnelles, cookies</span>
              </div>
              <i class="fas fa-chevron-right nx-setting-link-arrow"></i>
            </a>
          </div>
        </div>

        {{-- NEXUS --}}
        <div class="nx-panel">
          <div class="nx-panel-header">
            <h3 class="nx-panel-title"><i class="fas fa-star"></i> Préférences NEXUS</h3>
          </div>
          <div class="nx-panel-body" style="padding:.5rem 0;">
            <div class="nx-setting-link" style="cursor:default;">
              <div class="nx-setting-link-icon" style="background:rgba(236,72,153,.08);color:var(--nx-pink);"><i class="fas fa-bell"></i></div>
              <div class="nx-setting-link-text">
                <span class="nx-setting-link-title">Notifications d'échange</span>
                <span class="nx-setting-link-sub">Nouvelles demandes, messages</span>
              </div>
              <label class="nx-toggle">
                <input type="checkbox" checked>
                <span class="nx-toggle-slider"></span>
              </label>
            </div>
            <div class="nx-setting-link" style="cursor:default;">
              <div class="nx-setting-link-icon" style="background:rgba(37,99,235,.08);color:var(--nx-blue);"><i class="fas fa-envelope-open"></i></div>
              <div class="nx-setting-link-text">
                <span class="nx-setting-link-title">Emails NEXUS</span>
                <span class="nx-setting-link-sub">Newsletter, offres de destinations</span>
              </div>
              <label class="nx-toggle">
                <input type="checkbox">
                <span class="nx-toggle-slider"></span>
              </label>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div style="height:3rem;"></div>
  </div>{{-- /.nx-content --}}
</div>{{-- /.nx-dashboard --}}

<script>
(function() {
  'use strict';

  var tabs      = document.querySelectorAll('.nx-tab');
  var panels    = document.querySelectorAll('.nx-tab-panel');
  var tabsBar   = document.getElementById('nxTabsBar');

  function activateTab(tabKey) {
    tabs.forEach(function(t) { t.classList.toggle('is-active', t.dataset.tab === tabKey); });
    panels.forEach(function(p) { p.classList.toggle('is-active', p.id === 'nx-panel-' + tabKey); });
    // Mettre à jour l'URL sans reload
    try {
      var url = new URL(window.location.href);
      url.searchParams.set('tab', tabKey);
      window.history.replaceState({}, '', url.toString());
    } catch(e) {}
  }

  // Clics sur les tabs
  tabs.forEach(function(btn) {
    btn.addEventListener('click', function() { activateTab(btn.dataset.tab); });
  });

  // CTAs avec data-tab (hero + elsewhere)
  document.querySelectorAll('.nx-tab-trigger').forEach(function(el) {
    el.addEventListener('click', function(e) {
      e.preventDefault();
      activateTab(el.dataset.tab);
      tabsBar && tabsBar.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });

  // Lire l'onglet depuis l'URL
  var initTab = '{{ $activeTab }}';
  activateTab(initTab || 'overview');

  // Animation trust bar
  document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
      var fill = document.querySelector('.nx-trust-fill');
      if (fill) { fill.style.width = fill.style.width || '40%'; }
    }, 400);
  });

  // Widget miroir : synchronise le select caché avec l'affichage du champ
  document.querySelectorAll('.nx-mini-field select[data-no-cs]').forEach(function(sel) {
    sel.addEventListener('change', function() {
      var valueDisplay = sel.closest('.nx-mini-field').querySelector('.nx-mini-field-value');
      if (valueDisplay && sel.selectedIndex >= 0) {
        var opt = sel.options[sel.selectedIndex];
        valueDisplay.textContent = opt.value ? opt.text : valueDisplay.dataset.default || 'Tous';
      }
    });
    if (sel.parentElement) {
      var inp = sel.closest('.nx-mini-field').querySelector('.nx-mini-field-value');
      if (inp) inp.dataset.default = inp.textContent;
    }
  });
})();
</script>

{{-- Flatpickr : requis pour le champ calendrier dates du séjour --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
{{-- Filtres avancés HomeSwap : toggle + calendrier + domaine (même JS que /services/homeswap) --}}
<script src="{{ asset('assets/front/js/homeswap-filters.js') }}"></script>
@endsection
