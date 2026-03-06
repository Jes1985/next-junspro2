@extends('frontend.layout')

@section('style')
@include('nexus.onboarding._layout')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ asset('assets/front/css/homeswap-filters.css') }}">
<style>
/* ─── Variables couleurs HomeSwap — requises par homeswap-filters.css ─── */
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
/* Flatpickr */
.flatpickr-calendar { z-index: 9999 !important; }
.flatpickr-day.selected,.flatpickr-day.startRange,.flatpickr-day.endRange { background:#EC4899!important; border-color:#EC4899!important; }
.flatpickr-day.inRange { background:rgba(236,72,153,.15)!important; box-shadow:none!important; }

/* ─── Wrapper section offre ─── */
.nx-search-section {
  background: #fff;
  border-radius: 20px;
  border: 1px solid #e2e8f0;
  padding: 2rem;
  box-shadow: 0 2px 8px rgba(0,0,0,.06);
}
.nx-search-section-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 1.75rem; padding-bottom: 1.25rem;
  border-bottom: 1px solid #e2e8f0;
}
.nx-search-section-title {
  font-size: 1.2rem; font-weight: 700; color: #1e293b;
  display: flex; align-items: center; gap: .6rem; margin: 0;
}
.nx-search-section-title i { color: #EC4899; }
.nx-search-badge {
  font-size: .75rem; font-weight: 600;
  background: rgba(236,72,153,.08); color: #EC4899;
  border: 1px solid rgba(236,72,153,.2); border-radius: 999px;
  padding: .25rem .75rem;
}
/* Override : pas de double carte */
.nx-search-section .homeswap-search-filter-section {
  background: transparent !important;
  box-shadow: none !important;
  border: none !important;
  border-radius: 0 !important;
  padding: 0 !important;
  margin: 0 !important;
}
/* Bouton gradient NEXUS */
.nx-search-section .homeswap-filters-form .filter-submit-btn {
  background: linear-gradient(135deg, #EC4899 0%, #F472B6 40%, #2563EB 100%) !important;
}

/* ─── Bloc langue maternelle + autres langues ─── */
.homeswap-filters-form .filter-group--full { width: 100%; display: block; }
.homeswap-filters-form .homeswap-langues-row { width: 100%; }
.homeswap-filters-form .filter-group.besoin-langues {
  padding: 0.85rem 0 0.75rem;
  border-top: 1px solid rgba(236,72,153,.1);
  margin-top: 0.25rem;
}
.homeswap-filters-form .filter-label {
  font-size: .875rem; font-weight: 600; color: #374151;
  margin-bottom: .55rem; display: flex; align-items: center; gap: .4rem;
}
.homeswap-filters-form .filter-label i { color: #EC4899; }
.homeswap-filters-form .filter-select {
  width: 100%; padding: 10px 14px;
  border: 1px solid #e5e7eb; border-radius: 10px;
  font-size: .9375rem; background: #fff; color: #374151;
  appearance: auto; transition: border-color .2s, box-shadow .2s; cursor: pointer;
}
.homeswap-filters-form .filter-select:focus {
  outline: none;
  border-color: rgba(236,72,153,.5);
  box-shadow: 0 0 0 3px rgba(236,72,153,.1);
}
.homeswap-filters-form .besoin-langues-row {
  display: flex; flex-wrap: nowrap; align-items: flex-start; gap: 1rem 1.5rem;
}
.homeswap-filters-form .besoin-mother-tongue-wrap { min-width: 180px; max-width: 220px; flex-shrink: 0; }
.homeswap-filters-form .besoin-mother-tongue-wrap .filter-select { width: 100%; }
.homeswap-filters-form .besoin-other-langs-wrap {
  position: relative; flex: 1; min-width: 0;
  display: flex; flex-wrap: wrap; align-items: center; gap: .4rem .6rem;
}
.homeswap-filters-form .besoin-other-langs-label { font-size: .8rem; color: #6b7280; margin: 0; flex-shrink: 0; }
.homeswap-filters-form .besoin-lang-chips {
  display: inline-flex; flex-wrap: wrap; align-items: center; gap: .4rem .6rem;
  min-height: 2rem; padding: .1rem 0; min-width: 0;
}
.homeswap-filters-form .besoin-lang-chip {
  display: inline-flex; align-items: center; gap: .35rem;
  padding: .25rem .55rem; border-radius: 10px;
  background: rgba(236,72,153,.07); border: 1px solid rgba(236,72,153,.22);
  font-size: .8rem; color: #1f2937;
}
.homeswap-filters-form .besoin-lang-chip-remove {
  background: none; border: none; padding: 0; margin: 0;
  cursor: pointer; color: #9ca3af; font-size: .9em; line-height: 1;
}
.homeswap-filters-form .besoin-lang-chip-remove:hover { color: #ef4444; }
.homeswap-filters-form .besoin-add-lang-btn {
  display: inline-flex; align-items: center; padding: .3rem .7rem; flex-shrink: 0;
  background: rgba(236,72,153,.06); border: 1px solid rgba(236,72,153,.2);
  border-radius: 8px; color: #EC4899; font-size: .85rem; font-weight: 600;
  cursor: pointer; transition: background .2s, border-color .2s, color .2s; gap: .3rem;
}
.homeswap-filters-form .besoin-add-lang-btn:hover {
  background: rgba(236,72,153,.12); border-color: rgba(236,72,153,.4);
}
/* Popover CECRL */
.homeswap-filters-form .cecrl-popover {
  display: none; position: absolute; z-index: 200; top: 100%; left: 0; margin-top: .35rem;
  min-width: 320px; max-width: 420px; max-height: 280px; overflow-y: auto;
  background: #fff; border-radius: 12px;
  box-shadow: 0 10px 40px rgba(0,0,0,.12), 0 2px 8px rgba(0,0,0,.06);
  border: 1px solid rgba(0,0,0,.08);
}
.homeswap-filters-form .cecrl-popover:not([hidden]) { display: block; }
.homeswap-filters-form .cecrl-popover[hidden] { display: none !important; }
.homeswap-filters-form .cecrl-popover-inner { padding: .75rem 1rem; }
.homeswap-filters-form .cecrl-table-head {
  display: flex; padding: 0 0 .5rem; margin-bottom: .5rem;
  border-bottom: 1px solid #eee; font-size: .75rem; font-weight: 600;
  color: #6b7280; text-transform: uppercase;
}
.homeswap-filters-form .cecrl-th-lang { width: 100px; flex-shrink: 0; }
.homeswap-filters-form .cecrl-th-level { flex: 1; }
.homeswap-filters-form .cecrl-row {
  display: flex; align-items: center; gap: .5rem; padding: .35rem 0; font-size: .85rem;
}
.homeswap-filters-form .cecrl-lang { width: 100px; flex-shrink: 0; color: #374151; }
.homeswap-filters-form .cecrl-pills { display: flex; flex-wrap: wrap; gap: .25rem; }
.homeswap-filters-form .cecrl-pill {
  padding: .2rem .45rem; border-radius: 8px; border: 1px solid #e5e7eb;
  background: #fafafa; color: #6b7280; font-size: .75rem; font-weight: 500;
  cursor: pointer; transition: background .2s, border-color .2s, color .2s;
}
.homeswap-filters-form .cecrl-pill:hover { background: #fce7f3; border-color: #f9a8d4; color: #be185d; }
.homeswap-filters-form .cecrl-pill.is-selected {
  background: rgba(236,72,153,.1); border-color: rgba(236,72,153,.4); color: #EC4899;
}
@media (max-width: 768px) {
  .homeswap-filters-form .besoin-langues-row { flex-direction: column; }
  .homeswap-filters-form .besoin-mother-tongue-wrap { max-width: 100%; }
  .homeswap-filters-form .besoin-other-langs-wrap { min-width: 100%; }
}

/* ─── Ligne Domaine + Spécialisation ─── */
.homeswap-domain-spec-row {
  display: flex; align-items: center; gap: 20px; padding: 14px 24px 0; flex-wrap: wrap;
}
.filter-domain-nexus { flex: 0 0 auto; }
.filter-specialization-nexus { flex: 1 1 333px; min-width: 293px; max-width: 433px; }
@media (max-width: 640px) {
  .homeswap-domain-spec-row { padding: 12px 12px 0; gap: 12px; }
  .filter-specialization-nexus { max-width: 100%; flex: 1 1 100%; }
}

/* ─── Pills Mode d'intervention ─── */
.mode-intervention-label {
  display: block; font-size: .75rem; font-weight: 700;
  text-transform: uppercase; letter-spacing: .07em; color: #9CA3AF; margin-bottom: 6px;
}
.mode-intervention-segmented {
  display: flex; gap: .375rem; background: #f3f4f6;
  border-radius: 12px; padding: 4px; border: 1px solid #e5e7eb;
}
.mode-intervention-pill {
  flex: 1; display: flex; align-items: center; justify-content: center;
  gap: .35rem; padding: .5rem 1.1rem; border-radius: 8px;
  cursor: pointer; transition: all .2s cubic-bezier(.4,0,.2,1);
  background: transparent; border: none; white-space: nowrap; user-select: none;
}
.mode-intervention-pill:hover { background: rgba(255,255,255,.8); }
.mode-intervention-pill.is-active {
  background: linear-gradient(135deg, #EC4899 0%, #A855F7 55%, #3B82F6 100%);
  color: #fff; box-shadow: 0 2px 10px rgba(236,72,153,.28);
}
.mode-intervention-pill-icon { font-size: .95rem; line-height: 1; }
.mode-intervention-pill-text { font-size: .8125rem; font-weight: 600; color: #374151; transition: color .18s ease; }
.mode-intervention-pill.is-active .mode-intervention-pill-text { color: #fff; }
@media (max-width: 580px) {
  .mode-intervention-segmented { flex-wrap: wrap; }
  .mode-intervention-pill { flex: 1 1 calc(50% - .375rem); }
}

/* ════════════════════════════════════════════════════════
   STEP 2 — Harmonisation palette rose/bleu sur TOUT le step
   ════════════════════════════════════════════════════════ */

/* ─── Background page légèrement rosé ─── */
.nx-ob-page {
  background: linear-gradient(150deg, #fff0f7 0%, #f5f0ff 50%, #eff6ff 100%) !important;
}

/* ─── Inputs — focus rose au lieu de violet ─── */
.nx-input, .nx-select, .nx-textarea {
  border-color: #f3e8f0 !important;
  background: #fff !important;
}
.nx-input:hover, .nx-select:hover, .nx-textarea:hover {
  border-color: rgba(236, 72, 153, 0.35) !important;
}
.nx-input:focus, .nx-select:focus, .nx-textarea:focus {
  border-color: #EC4899 !important;
  box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.12) !important;
  outline: none !important;
}

/* ─── Labels — uppercase premium ─── */
.nx-card .nx-label,
.nx-search-section-bien .nx-label {
  font-size: .72rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: #9CA3AF;
  margin-bottom: .5rem;
}
.nx-card .nx-label-hint,
.nx-search-section-bien .nx-label-hint {
  text-transform: none;
  letter-spacing: 0;
  font-size: .78rem;
  font-weight: 400;
}

/* ─── Chips équipements — rose ─── */
.nx-chip-label {
  border: 1.5px solid #f3e8f0 !important;
  background: #fdf9fc !important;
  color: #374151 !important;
  border-radius: 10px !important;
  font-size: .85rem !important;
  transition: all .18s ease !important;
}
.nx-chip-label:hover {
  border-color: rgba(236, 72, 153, 0.45) !important;
  background: rgba(236, 72, 153, 0.05) !important;
  color: #EC4899 !important;
}
.nx-chip-input:checked + .nx-chip-label {
  border-color: #EC4899 !important;
  background: rgba(236, 72, 153, 0.09) !important;
  color: #EC4899 !important;
  font-weight: 700 !important;
  box-shadow: 0 2px 8px rgba(236, 72, 153, 0.18) !important;
}

/* ─── Radio cards type de bien — rose ─── */
.nx-radio-card {
  border-color: #f3e8f0 !important;
  background: #fdf9fc !important;
  transition: all .2s ease !important;
}
.nx-radio-card:hover {
  border-color: rgba(236, 72, 153, 0.4) !important;
  background: rgba(236, 72, 153, 0.04) !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 18px rgba(236, 72, 153, 0.13) !important;
}
.nx-radio-input:checked + .nx-radio-card {
  border-color: #EC4899 !important;
  background: rgba(236, 72, 153, 0.07) !important;
  box-shadow: 0 4px 18px rgba(236, 72, 153, 0.22) !important;
}
.nx-radio-input:checked + .nx-radio-card .nx-radio-card-label {
  color: #EC4899 !important;
}
.nx-radio-input:checked + .nx-radio-card .nx-radio-card-icon {
  filter: drop-shadow(0 0 5px rgba(236, 72, 153, 0.45));
}

/* ─── Drop zone photo / miniature vidéo — rose ─── */
.nx-photo-drop {
  border-color: rgba(236, 72, 153, 0.28) !important;
  background: #fdf9fc !important;
}
.nx-photo-drop:hover {
  border-color: #EC4899 !important;
  background: rgba(236, 72, 153, 0.04) !important;
}

/* ─── Bouton ghost ← Retour — rose ─── */
.nx-btn-ghost {
  color: #EC4899 !important;
  border-color: rgba(236, 72, 153, 0.3) !important;
}
.nx-btn-ghost:hover {
  background: rgba(236, 72, 153, 0.06) !important;
  border-color: #EC4899 !important;
  color: #EC4899 !important;
}

/* ─── Bouton Continuer → même gradient que « Enregistrer mon offre » ─── */
.nx-btn-primary {
  background: linear-gradient(135deg, #EC4899 0%, #A855F7 55%, #3B82F6 100%) !important;
  box-shadow: 0 4px 16px rgba(236, 72, 153, 0.32) !important;
}
.nx-btn-primary:hover {
  box-shadow: 0 8px 28px rgba(236, 72, 153, 0.44) !important;
  transform: translateY(-2px) !important;
}

/* ─── Footer inter-sections — séparateur rosé ─── */
.nx-form-footer {
  border-top: 1px solid rgba(236, 72, 153, 0.12) !important;
}

/* ─── Section header « Mon bien d'échange » — identique au bloc filtres ─── */
.nx-search-section-bien {
  background: #fff;
  border-radius: 20px;
  border: 1px solid #e2e8f0;
  padding: 2rem;
  box-shadow: 0 2px 8px rgba(0,0,0,.06);
  margin-top: 1.5rem;
}
.nx-search-section-bien .nx-search-section-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 1.75rem; padding-bottom: 1.25rem;
  border-bottom: 1px solid rgba(236, 72, 153, 0.12);
}
@media (max-width: 600px) {
  .nx-search-section-bien { padding: 1.5rem 1.25rem; }
}

/* ─── Toggle filtres avancés : forcer display sur step2 ─── */
#homeswapAdvancedFiltersPanel {
  display: none;
}
#homeswapAdvancedFiltersPanel.is-open {
  display: block !important;
}

/* ─── Accordéons sections (Langues / Dispo / Critères) ─── */
.nx-accordion-section {
  border: 1px solid rgba(236,72,153,.18);
  border-radius: 16px;
  overflow: hidden;
  margin-top: 1.25rem;
}
.nx-accordion-toggle {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1.35rem;
  background: linear-gradient(135deg, rgba(236,72,153,.06) 0%, rgba(168,85,247,.04) 50%, rgba(37,99,235,.04) 100%);
  border: none;
  cursor: pointer;
  font-size: 1rem;
  font-weight: 700;
  color: #1e293b;
  text-align: left;
  transition: background .2s;
  line-height: 1.4;
}
.nx-accordion-toggle:hover {
  background: linear-gradient(135deg, rgba(236,72,153,.11) 0%, rgba(168,85,247,.08) 50%, rgba(37,99,235,.08) 100%);
}
.nx-accordion-chevron {
  color: #EC4899;
  transition: transform .25s ease;
  font-size: .9rem;
  flex-shrink: 0;
}
.nx-accordion-body {
  padding: 1.25rem 1.35rem 1.5rem;
  border-top: 1px solid rgba(236,72,153,.1);
}

/* ─── Skills (critères) ─── */
.nx-skill-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(155px,1fr)); gap:.65rem; }
.nx-skill-input { display:none; }
.nx-skill-card {
  display:flex; align-items:center; gap:.6rem;
  padding:.7rem 1rem; border-radius:12px;
  border:2px solid #e5e7eb; background:#f9fafb;
  cursor:pointer; transition:all .18s;
  font-size:.875rem; font-weight:500; color:#374151;
  user-select:none;
}
.nx-skill-input:checked + .nx-skill-card {
  border-color:var(--nx-purple);
  background:rgba(124,58,237,.07);
  color:var(--nx-purple); font-weight:700;
}
.nx-skill-icon { font-size:1.2rem; flex-shrink:0; }
.nx-contact-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:.75rem; }
@media(max-width:480px){ .nx-contact-grid{ grid-template-columns:1fr 1fr; } }
.nx-rule-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(175px,1fr)); gap:.6rem; }

/* ─── Disponibilités ─── */
.nx-duration-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(140px,1fr)); gap:.75rem; }
.nx-flex-grid     { display:grid; grid-template-columns:repeat(3,1fr); gap:.75rem; }
.nx-recur-grid    { display:grid; grid-template-columns:repeat(3,1fr); gap:.75rem; }
@media(max-width:480px){
  .nx-flex-grid, .nx-recur-grid { grid-template-columns:1fr 1fr; }
}
/* ─── hw-freq-card dans onboarding ─── */
.hw-freq-grid { display:flex; gap:10px; flex-wrap:wrap; margin-top:4px; }
.hw-freq-card {
  display:flex; flex-direction:row; align-items:center; gap:8px;
  padding:10px 16px; border:1.5px solid #e5e7eb; background:#fff;
  border-radius:12px; cursor:pointer; transition:all .18s ease;
  user-select:none;
}
.hw-freq-card:hover { border-color:rgba(236,72,153,.45); background:rgba(236,72,153,.03); }
.hw-freq-input { display:none; }
.hw-freq-card:has(.hw-freq-input:checked) {
  border-color:#EC4899; background:rgba(236,72,153,.06);
  box-shadow:0 2px 10px rgba(236,72,153,.15);
}
.hw-freq-icon { font-size:1.2rem; line-height:1; flex-shrink:0; }
.hw-freq-text { display:flex; flex-direction:column; gap:1px; }
.hw-freq-label { font-weight:700; font-size:.88rem; color:#111827; line-height:1.2; }
.hw-freq-card:has(.hw-freq-input:checked) .hw-freq-label { color:#EC4899; }
.hw-freq-sub { font-size:.74rem; color:#9ca3af; line-height:1.2; }
.hw-freq-card:has(.hw-freq-input:checked) .hw-freq-sub { color:rgba(236,72,153,.7); }
.nx-date-range {
  display:grid; grid-template-columns:1fr 1fr; gap:1rem;
  padding:1.25rem; background:#f9fafb; border-radius:14px;
  border:1px solid #e5e7eb;
}
@media(max-width:480px){ .nx-date-range{ grid-template-columns:1fr; } }
.nx-notice-wrap { display:flex; align-items:center; gap:1rem; }
.nx-notice-wrap input[type=range]{ accent-color:var(--nx-purple); flex:1; }
.nx-notice-val { font-weight:700; color:var(--nx-purple); min-width:3.5rem; text-align:right; }

/* ─── Langues ─── */
.nx-lang-row {
  display:grid; grid-template-columns:1fr 1fr auto;
  align-items:end; gap:.75rem; margin-bottom:.65rem;
}
.nx-lang-remove {
  background:none; border:none; cursor:pointer;
  color:#9ca3af; font-size:1.1rem; padding:.35rem;
  transition:color .15s; line-height:1;
}
.nx-lang-remove:hover { color:#ef4444; }
@media(max-width:520px){ .nx-lang-row { grid-template-columns:1fr; } }
</style>
@endsection

@section('content')
<div class="nx-ob-page">
  <div class="nx-ob-wrap">

    <div class="nx-badge"><span>✦</span> Onboarding NEXUS</div>

    @include('nexus.onboarding._stepper', ['current' => 2])

    @if($errors->any())
      <div class="nx-alert nx-alert-error mb-3">
        <span>⚠️</span>
        <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
      </div>
    @endif

    {{-- ═══ Mon Offre NEXUS — miroir dashboard ?tab=search ═══ --}}
    <div class="nx-search-section" style="margin-bottom:1.75rem">
      <div class="nx-search-section-header">
        <h2 class="nx-search-section-title">
          <i class="fas fa-home"></i> Mon Offre NEXUS
        </h2>
        <span class="nx-search-badge">Miroir — ce que vous proposez à l'échange</span>
      </div>
      <p style="color:#94a3b8;font-size:.95rem;margin:-1rem 0 1.75rem;line-height:1.6;">
        Décrivez votre bien exactement comme sur la page HomeSwap. Ces critères alimentent en temps réel la recherche des autres membres — plus vous êtes précis, meilleurs sont les matchs.
      </p>
      <div class="homeswap-search-filter-section">
        <x-services.filters.homeswap-filters
          formId="preplyFiltersForm"
          :formAction="route('nexus.offer.save')"
          :openAdvanced="true"
          data-nx-autosave
        />
      </div>
      <script>
      document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('preplyFiltersForm');
        if (!form) return;
        var btn = form.querySelector('.filter-submit-btn');
        if (btn) { btn.innerHTML = '<i class="fas fa-save me-2"></i>Enregistrer mon offre'; }
      });
      </script>
    </div>

    <div class="nx-search-section-bien">
      <div class="nx-search-section-header">
        <h2 class="nx-search-section-title">
          <i class="fas fa-building"></i> Mon bien d'échange
        </h2>
        <span class="nx-search-badge">Votre carte de visite NEXUS</span>
      </div>
      <p style="color:#94a3b8;font-size:.95rem;margin:-1rem 0 1.75rem;line-height:1.6;">
        Décrivez l'espace que vous mettez à disposition — logement, bureau, salle pédagogique&hellip;
        Plus c'est précis, meilleurs sont vos matchs NEXUS.
      </p>

      <form action="{{ route('nexus.onboarding.step2.store') }}" method="POST" enctype="multipart/form-data" data-nx-autosave>
        @csrf

        {{-- Type de bien --}}
        <div class="nx-field">
          <label class="nx-label">Type de bien</label>
          <div class="nx-radio-grid">
            @foreach($propertyTypes as $pt)
              <input type="radio" name="property_type" value="{{ $pt['slug'] }}" id="pt_{{ $pt['slug'] }}" class="nx-radio-input"
                {{ old('property_type', $data['property_type']) === $pt['slug'] ? 'checked' : '' }}>
              <label for="pt_{{ $pt['slug'] }}" class="nx-radio-card">
                <span class="nx-radio-card-icon">{{ $pt['icon'] }}</span>
                <span class="nx-radio-card-label">{{ $pt['label'] }}</span>
                <span class="nx-radio-card-desc">{{ $pt['desc'] }}</span>
              </label>
            @endforeach
          </div>
          @error('property_type')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Titre --}}
        <div class="nx-field">
          <label class="nx-label" for="property_title">Titre accrocheur</label>
          <input type="text" id="property_title" name="property_title" class="nx-input"
            value="{{ old('property_title', $data['property_title']) }}"
            placeholder="Ex : Loft industriel 80m² au cœur de Paris" maxlength="255">
          @error('property_title')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Description --}}
        <div class="nx-field">
          <label class="nx-label" for="property_desc">Description détaillée <span class="nx-label-hint">· min 30 caractères</span></label>
          <textarea id="property_desc" name="property_desc" class="nx-textarea" placeholder="Décrivez l'atmosphère, l'environnement, les points forts de votre bien…" maxlength="2000">{{ old('property_desc', $data['property_desc']) }}</textarea>
          <div style="text-align:right;font-size:.75rem;color:#9ca3af;margin-top:.25rem">
            <span id="desc-count">{{ mb_strlen(old('property_desc', $data['property_desc'])) }}</span>/2000
          </div>
          @error('property_desc')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Photos du bien --}}
        <div class="nx-field">
          <label class="nx-label">Photos du bien <span class="nx-label-hint">· jusqu'à 6 photos</span></label>
          <p style="font-size:.85rem;color:#6b7280;margin:.15rem 0 .85rem">Ajoutez des photos pour illustrer votre bien et augmenter vos chances de match.</p>

          {{-- Input fichier caché --}}
          <input type="file" id="nx-photos-input" name="property_photos[]" multiple accept="image/*" style="display:none">
          {{-- Photos BDD à conserver (mis à jour par JS, même modèle que miniature vidéo) --}}
          <input type="hidden" id="nx-photos-keep" name="property_photos_keep" value="">

          {{-- Lightbox modal --}}
          <div id="nx-lightbox" onclick="nxLightboxClose()" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.82);align-items:center;justify-content:center;cursor:zoom-out">
            <img id="nx-lightbox-img" src="" alt="" style="max-width:92vw;max-height:90vh;border-radius:.75rem;box-shadow:0 8px 40px rgba(0,0,0,.5);object-fit:contain" onclick="event.stopPropagation()">
            <button onclick="event.stopPropagation();nxLightboxClose()" style="position:fixed;top:1.1rem;right:1.4rem;background:rgba(255,255,255,.18);border:none;border-radius:50%;width:38px;height:38px;cursor:pointer;display:flex;align-items:center;justify-content:center">
              <svg width="16" height="16" viewBox="0 0 14 14" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round"><line x1="2" y1="2" x2="12" y2="12"/><line x1="12" y1="2" x2="2" y2="12"/></svg>
            </button>
          </div>

          {{-- Bande 6 slots sur une ligne --}}
          <div style="overflow-x:auto;padding-bottom:.25rem">
            <div id="nx-photos-grid" style="display:grid;grid-template-columns:repeat(6,minmax(120px,1fr));gap:.65rem;min-width:600px">
              @for($i = 0; $i < 6; $i++)
              <div class="nx-photo-slot" data-slot="{{ $i }}" onclick="nxPhotoSlotClick({{ $i }})" style="position:relative;aspect-ratio:4/3;border:2px dashed #e5e7eb;border-radius:.65rem;background:#f9fafb;cursor:pointer;display:flex;flex-direction:column;align-items:center;justify-content:center;overflow:hidden;transition:border-color .2s,background .2s">
                {{-- Placeholder --}}
                <div class="nx-photo-placeholder" style="display:flex;flex-direction:column;align-items:center;gap:.3rem;pointer-events:none">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <span style="font-size:.68rem;color:#d1d5db;font-weight:500">Photo {{ $i + 1 }}</span>
                </div>
                {{-- Aperçu --}}
                <img class="nx-photo-preview" style="display:none;width:100%;height:100%;object-fit:cover;position:absolute;inset:0" src="" alt="">
                {{-- Bouton loupe (voir) --}}
                <button type="button" class="nx-photo-view" onclick="event.stopPropagation();nxLightboxOpen({{ $i }})" style="display:none;position:absolute;bottom:.4rem;left:.4rem;background:rgba(0,0,0,.52);border:none;border-radius:50%;width:24px;height:24px;cursor:pointer;align-items:center;justify-content:center;padding:0" title="Agrandir">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/></svg>
                </button>
                {{-- Bouton supprimer --}}
                <button type="button" class="nx-photo-remove" onclick="event.stopPropagation();nxPhotoRemove({{ $i }})" style="display:none;position:absolute;top:.4rem;right:.4rem;background:rgba(0,0,0,.55);border:none;border-radius:50%;width:24px;height:24px;cursor:pointer;align-items:center;justify-content:center;padding:0" title="Supprimer">
                  <svg width="12" height="12" viewBox="0 0 14 14" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round"><line x1="2" y1="2" x2="12" y2="12"/><line x1="12" y1="2" x2="2" y2="12"/></svg>
                </button>
              </div>
              @endfor
            </div>
          </div>

          {{-- Compteur --}}
          <div style="text-align:right;font-size:.75rem;color:#9ca3af;margin-top:.35rem">
            <span id="nx-photos-count">0</span>/6 photo(s) sélectionnée(s)
          </div>
        </div>

        {{-- Vidéo de présentation --}}
        <div class="nx-field">
          <label class="nx-label">Vidéo de présentation <span class="nx-label-hint">(optionnel)</span></label>
          <p style="font-size:.85rem;color:#6b7280;margin-bottom:.75rem">
            Ajoutez une URL YouTube ou Vimeo pour donner envie à vos futurs partenaires d'échange.
          </p>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;align-items:start" class="nx-video-grid">

            {{-- Input URL --}}
            <div>
              <label class="nx-label" for="video_url" style="font-size:.8rem">URL de la vidéo</label>
              <input type="url" id="video_url" name="video_url" class="nx-input"
                value="{{ old('video_url', $data['video_url'] ?? '') }}"
                placeholder="https://www.youtube.com/watch?v=..."
                oninput="nxVideoPreview(this.value)">
              @error('video_url')<div class="nx-error">⚠ {{ $message }}</div>@enderror

              {{-- Miniature upload --}}
              <div style="margin-top:.85rem">
                <label class="nx-label" style="font-size:.8rem">Miniature personnalisée <span class="nx-label-hint">(optionnel)</span></label>
                <div id="nx-thumb-drop" class="nx-photo-drop" style="border-radius:12px;aspect-ratio:16/9;max-width:100%;padding:1rem" onclick="document.getElementById('nx-thumb-input').click()">
                  @if(!empty($data['video_thumbnail']))
                    <img src="{{ asset('storage/img/nexus-thumbnails/' . $data['video_thumbnail']) }}"
                      id="nx-thumb-preview" alt="Miniature" style="width:100%;height:100%;object-fit:cover;border-radius:8px;display:block">
                  @else
                    <div id="nx-thumb-placeholder" style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;gap:.35rem">
                      <span style="font-size:1.75rem">🎬</span>
                      <span style="font-size:.78rem;font-weight:600;color:#374151">Ajouter une miniature</span>
                      <span style="font-size:.72rem;color:#9ca3af">JPG, PNG · 16:9 recommandé</span>
                    </div>
                    <img src="" id="nx-thumb-preview" alt="Miniature" style="display:none;width:100%;height:100%;object-fit:cover;border-radius:8px">
                  @endif
                </div>
                <input type="file" id="nx-thumb-input" name="video_thumbnail" accept="image/*" class="d-none">
                @error('video_thumbnail')<div class="nx-error">⚠ {{ $message }}</div>@enderror
              </div>
            </div>

            {{-- Prévisualisation iframe --}}
            <div>
              <label class="nx-label" style="font-size:.8rem">Aperçu</label>
              <div id="nx-video-preview-wrap" style="border-radius:12px;overflow:hidden;background:#111827;aspect-ratio:16/9;position:relative">
                <div id="nx-video-placeholder" style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;gap:.5rem;color:#6b7280">
                  <span style="font-size:2.5rem;opacity:.4">▶</span>
                  <span style="font-size:.8rem">L'aperçu de votre vidéo</span>
                  <span style="font-size:.8rem">apparaîtra ici</span>
                </div>
                <iframe id="nx-video-iframe" src="" frameborder="0"
                  allow="autoplay; encrypted-media" allowfullscreen
                  style="display:none;width:100%;height:100%;position:absolute;inset:0"></iframe>
              </div>
              <p style="font-size:.75rem;color:#9ca3af;margin-top:.4rem">
                💡 Conseil : une vidéo de 60–90 secondes filmant les différentes pièces suffit.
              </p>
            </div>

          </div>
        </div>

        {{-- Surface / Capacité --}}
        <div class="nx-row">
          <div class="nx-field">
            <label class="nx-label" for="property_surface">Surface <span class="nx-label-hint">(m² · optionnel)</span></label>
            <input type="number" id="property_surface" name="property_surface" class="nx-input"
              value="{{ old('property_surface', $data['property_surface']) }}" placeholder="Ex : 80" min="5" max="9999">
            @error('property_surface')<div class="nx-error">⚠ {{ $message }}</div>@enderror
          </div>
          <div class="nx-field">
            <label class="nx-label" for="property_capacity">Capacité d'accueil <span style="color:#ef4444">*</span></label>
            <input type="number" id="property_capacity" name="property_capacity" class="nx-input"
              value="{{ old('property_capacity', $data['property_capacity'] ?: 1) }}" placeholder="Nb de personnes" min="1" max="500">
            @error('property_capacity')<div class="nx-error">⚠ {{ $message }}</div>@enderror
          </div>
        </div>

        {{-- ═══════════════════════════════════════════════
             Accordéon 1 — Langues & destinations
        ═══════════════════════════════════════════════ --}}
        <div class="nx-accordion-section">
          <button type="button" class="nx-accordion-toggle" onclick="nxAccordionToggle('accordion-langues')">
            <span>� Destinations</span>
            <span class="nx-accordion-chevron" id="chev-accordion-langues">▼</span>
          </button>
          <div id="accordion-langues" class="nx-accordion-body" style="display:none">
            @php
              $nxSaved    = $saved;
              $topCountries = [
                'FR'=>'France','GP'=>'Guadeloupe','MQ'=>'Martinique','RE'=>'La Réunion',
                'BE'=>'Belgique','CH'=>'Suisse','ES'=>'Espagne','DE'=>'Allemagne',
                'IT'=>'Italie','PT'=>'Portugal','NL'=>'Pays-Bas','GB'=>'Royaume-Uni',
                'CA'=>'Canada','US'=>'États-Unis','MT'=>'Malte','MC'=>'Monaco',
                'LU'=>'Luxembourg','MA'=>'Maroc','TN'=>'Tunisie','SN'=>'Sénégal',
                'CI'=>"Côte d'Ivoire",'IE'=>'Irlande','HR'=>'Croatie','BR'=>'Brésil',
                'JP'=>'Japon','AE'=>'Émirats Arabes Unis','QA'=>'Qatar','SA'=>'Arabie Saoudite',
                'SG'=>'Singapour','AU'=>'Australie','MX'=>'Mexique','CN'=>'Chine',
                'KR'=>'Corée du Sud','IN'=>'Inde','GR'=>'Grèce','TH'=>'Thaïlande',
                'MU'=>'Île Maurice','SC'=>'Seychelles',
                'SE'=>'Suède','DK'=>'Danemark','NO'=>'Norvège','AT'=>'Autriche','CY'=>'Chypre',
                'ID'=>'Indonésie','MY'=>'Malaisie','PH'=>'Philippines',
              ];
            @endphp

            {{-- Pays ciblés --}}
            <div class="nx-field">
              <label class="nx-label">
                Destinations souhaitées
                <span class="nx-label-hint">· sélectionnez plusieurs pays</span>
              </label>
              <div class="nx-check-wrap mb-3">
                <input type="checkbox" name="open_worldwide" id="open_worldwide" value="1"
                  {{ old('open_worldwide', $nxSaved['open_worldwide'] ?? false) ? 'checked' : '' }}
                  onchange="document.getElementById('countries-wrap').style.opacity = this.checked ? '.3' : '1'">
                <label for="open_worldwide" class="nx-check-label">
                  🌍 <strong>Ouvert au monde entier</strong> — Je suis flexible sur la destination
                </label>
              </div>
              <div id="countries-wrap" style="{{ old('open_worldwide', $nxSaved['open_worldwide'] ?? false) ? 'opacity:.3' : '' }}">
                <div class="nx-chips">
                  @foreach($topCountries as $code => $name)
                    <input type="checkbox" name="target_countries[]" value="{{ $code }}" id="tc_{{ $code }}" class="nx-chip-input"
                      {{ in_array($code, old('target_countries', $nxSaved['target_countries'] ?? [])) ? 'checked' : '' }}>
                    <label for="tc_{{ $code }}" class="nx-chip-label">{{ $name }}</label>
                  @endforeach
                </div>
              </div>
              @error('target_countries')<div class="nx-error">⚠ {{ $message }}</div>@enderror
            </div>
          </div>{{-- /accordion-langues --}}
        </div>

        {{-- ═══════════════════════════════════════════════
             Accordéon 3 — Critères d'échange
        ═══════════════════════════════════════════════ --}}
        <div class="nx-accordion-section" style="margin-bottom:1.5rem">
          <button type="button" class="nx-accordion-toggle" onclick="nxAccordionToggle('accordion-criteres')">
            <span>🤝 Critères d'échange</span>
            <span class="nx-accordion-chevron" id="chev-accordion-criteres">▼</span>
          </button>
          <div id="accordion-criteres" class="nx-accordion-body" style="display:none">
            @php
              $nxSaved3 = $saved;
            @endphp

            {{-- Note libre --}}
            <div class="nx-field">
              <label class="nx-label" for="exchange_note">Note complémentaire <span class="nx-label-hint">(optionnel)</span></label>
              <textarea id="exchange_note" name="exchange_note" class="nx-textarea" placeholder="Ajoutez tout ce qui vous semble important pour votre futur partenaire…" maxlength="1000">{{ old('exchange_note', $nxSaved3['exchange_note'] ?? '') }}</textarea>
            </div>
          </div>{{-- /accordion-criteres --}}
        </div>

        {{-- Footer --}}
        <div class="nx-form-footer">
          <a href="{{ route('nexus.onboarding.step1') }}" class="nx-btn nx-btn-ghost">
            <i class="fas fa-arrow-left" style="font-size:.85em"></i> Retour
          </a>
          <button type="submit" class="nx-btn nx-btn-primary">
            Enregistrer et Continuer <i class="fas fa-arrow-right" style="font-size:.85em"></i>
          </button>
        </div>

      </form>
    </div>

  </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
<script src="{{ asset('assets/front/js/homeswap-filters.js') }}"></script>
<script>
(function () {
  // Compteur description
  var nxDescEl    = document.getElementById('property_desc');
  var nxDescCount = document.getElementById('desc-count');
  if (nxDescEl && nxDescCount) {
    nxDescEl.addEventListener('input', function () { nxDescCount.textContent = nxDescEl.value.length; });
  }

  // Miniature preview
  var thumbInput = document.getElementById('nx-thumb-input');
  if (thumbInput) {
    thumbInput.addEventListener('change', function () {
      var file = this.files[0];
      if (!file) return;
      var reader = new FileReader();
      reader.onload = function (e) {
        var preview     = document.getElementById('nx-thumb-preview');
        var placeholder = document.getElementById('nx-thumb-placeholder');
        if (preview) { preview.src = e.target.result; preview.style.display = 'block'; }
        if (placeholder) placeholder.style.display = 'none';
      };
      reader.readAsDataURL(file);
    });
  }
})(); // fin du bloc isolé description + miniature

  // ─── Système photos (6 slots) ─────────────────────────────────────────────
  var nxPhotosInput  = document.getElementById('nx-photos-input');
  const nxPhotosGrid   = document.getElementById('nx-photos-grid');
  const nxPhotosCountEl = document.getElementById('nx-photos-count');
  let nxPhotoFiles = new Array(6).fill(null); // tableau indexé par slot

  // Clic sur un slot vide → ouvre le sélecteur de fichier
  function nxPhotoSlotClick(index) {
    if (nxPhotoFiles[index]) return; // slot déjà rempli → rien
    nxPhotosInput._targetSlot = index;
    nxPhotosInput.value = '';
    nxPhotosInput.removeAttribute('multiple');
    nxPhotosInput.click();
  }

  nxPhotosInput && nxPhotosInput.addEventListener('change', function () {
    const slot  = this._targetSlot;
    const file  = this.files[0];
    if (slot === undefined || !file) return;
    if (!file.type.startsWith('image/')) return;
    nxPhotoFiles[slot] = file;
    const reader = new FileReader();
    reader.onload = (e) => nxPhotoRender(slot, e.target.result);
    reader.readAsDataURL(file);
    nxPhotosCountUpdate();
    nxPhotosRebuildInput();
  });

  function nxPhotoRender(slot, src) {
    const slotEl   = nxPhotosGrid.querySelector('[data-slot="' + slot + '"]');
    if (!slotEl) return;
    const preview  = slotEl.querySelector('.nx-photo-preview');
    const ph       = slotEl.querySelector('.nx-photo-placeholder');
    const btnRm    = slotEl.querySelector('.nx-photo-remove');
    const btnView  = slotEl.querySelector('.nx-photo-view');
    preview.src    = src;
    preview.style.display   = 'block';
    ph.style.display        = 'none';
    btnRm.style.display     = 'flex';
    btnView.style.display   = 'flex';
    slotEl.style.borderColor   = '#a78bfa';
    slotEl.style.background    = '#faf5ff';
    slotEl.style.cursor        = 'default';
  }

  function nxPhotoRemove(slot) {
    nxPhotoFiles[slot] = null;
    const slotEl   = nxPhotosGrid.querySelector('[data-slot="' + slot + '"]');
    if (!slotEl) return;
    const preview  = slotEl.querySelector('.nx-photo-preview');
    const ph       = slotEl.querySelector('.nx-photo-placeholder');
    const btnRm    = slotEl.querySelector('.nx-photo-remove');
    const btnView  = slotEl.querySelector('.nx-photo-view');
    preview.src    = '';
    preview.style.display   = 'none';
    ph.style.display        = 'flex';
    btnRm.style.display     = 'none';
    btnView.style.display   = 'none';
    slotEl.style.borderColor   = '';
    slotEl.style.background    = '';
    slotEl.style.cursor        = 'pointer';
    nxPhotosCountUpdate();
    nxPhotosRebuildInput();
  }

  // ─── Lightbox ───────────────────────────────────────────────────────────────
  const nxLightbox    = document.getElementById('nx-lightbox');
  const nxLightboxImg = document.getElementById('nx-lightbox-img');

  function nxLightboxOpen(slot) {
    const slotEl = nxPhotosGrid.querySelector('[data-slot="' + slot + '"]');
    if (!slotEl) return;
    const previewSrc = slotEl.querySelector('.nx-photo-preview').src;
    if (!previewSrc) return;
    nxLightboxImg.src = previewSrc;
    nxLightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function nxLightboxClose() {
    nxLightbox.style.display = 'none';
    nxLightboxImg.src = '';
    document.body.style.overflow = '';
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') nxLightboxClose();
  });
  // ─────────────────────────────────────────────────────────────────────────────

  function nxPhotosCountUpdate() {
    const count = nxPhotoFiles.filter(Boolean).length;
    if (nxPhotosCountEl) nxPhotosCountEl.textContent = count;
  }

  // Reconstruit le DataTransfer (nouveaux File) + synchronise property_photos_keep (filenames BDD)
  // Même modèle que miniature vidéo : sépare les objets File des strings filename
  function nxPhotosRebuildInput() {
    try {
      var dt   = new DataTransfer();
      var keep = [];
      nxPhotoFiles.forEach(function(f) {
        if (!f) return;
        if (f instanceof File) {
          dt.items.add(f);          // nouveau fichier → dans l'input file
        } else {
          keep.push(f);             // filename BDD → dans property_photos_keep
        }
      });
      nxPhotosInput.files = dt.files;
      var keepEl = document.getElementById('nx-photos-keep');
      if (keepEl) keepEl.value = JSON.stringify(keep);
    } catch(e) {}
  }

  // Hover sur slots vides
  document.querySelectorAll('.nx-photo-slot').forEach(slot => {
    slot.addEventListener('mouseenter', function() {
      if (!nxPhotoFiles[+this.dataset.slot]) {
        this.style.borderColor = '#a78bfa';
        this.style.background  = '#faf5ff';
      }
    });
    slot.addEventListener('mouseleave', function() {
      if (!nxPhotoFiles[+this.dataset.slot]) {
        this.style.borderColor = '';
        this.style.background  = '';
      }
    });
  });
  // ─────────────────────────────────────────────────────────────────────────────

  // ─── Hydratation photos depuis BDD — même modèle que miniature vidéo ────────
  // Si des photos ont déjà été sauvegardées, on les affiche dans les slots
  // et on initialise property_photos_keep avec les filenames à conserver.
  @php
    $nxPhotoFiles6 = array_pad($data['property_photos'] ?? [], 6, null);
    $nxPhotoUrls6  = array_map(function($f) { return $f ? asset('storage/img/nexus-photos/' . $f) : null; }, $nxPhotoFiles6);
  @endphp
  (function () {
    var existingUrls  = @json($nxPhotoUrls6);
    var existingFiles = @json($nxPhotoFiles6);
    existingUrls.forEach(function (url, i) {
      if (url) {
        nxPhotoFiles[i] = existingFiles[i]; // string filename = photo BDD (≠ File object = nouveau)
        nxPhotoRender(i, url);
      }
    });
    nxPhotosCountUpdate();
    nxPhotosRebuildInput(); // Pré-remplit property_photos_keep avec les filenames existants
  })();
  // ─────────────────────────────────────────────────────────────────────────────

  // Aperçu vidéo YouTube / Vimeo
  function nxVideoPreview(url) {
    const iframe  = document.getElementById('nx-video-iframe');
    const placeholder = document.getElementById('nx-video-placeholder');
    if (!iframe || !url) return;

    let embed = null;

    // YouTube
    const ytMatch = url.match(/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([\w-]{11})/);
    if (ytMatch) embed = 'https://www.youtube.com/embed/' + ytMatch[1] + '?autoplay=0&rel=0';

    // Vimeo
    const vmMatch = url.match(/vimeo\.com\/(\d+)/);
    if (vmMatch) embed = 'https://player.vimeo.com/video/' + vmMatch[1];

    if (embed) {
      iframe.src = embed;
      iframe.style.display = 'block';
      if (placeholder) placeholder.style.display = 'none';
    } else {
      iframe.src = '';
      iframe.style.display = 'none';
      if (placeholder) placeholder.style.display = 'flex';
    }
  }

  // Initialiser l'aperçu si une URL est déjà saisie
  const existingUrl = document.getElementById('video_url');
  if (existingUrl && existingUrl.value) nxVideoPreview(existingUrl.value);

  // Responsive: passer en colonne sur mobile
  function nxVideoResponsive() {
    const grid = document.querySelector('.nx-video-grid');
    if (!grid) return;
    grid.style.gridTemplateColumns = window.innerWidth < 640 ? '1fr' : '1fr 1fr';
  }
  nxVideoResponsive();
  window.addEventListener('resize', nxVideoResponsive);

  // ─── Renommage labels "Mon Offre NEXUS" (preplyFiltersForm) ──────────────────
  // Le composant homeswap-filters est conçu pour la recherche.
  // On surcharge les libellés côté client pour le bloc "offre" uniquement,
  // sans toucher au composant partagé (utilisé ailleurs en mode recherche).
  (function () {
    var MAP = {
      // Titres de blocs
      "Je pose mon besoin"          : "Mon espace en un coup d'œil",
      "Affiner la recherche"        : "Détails de mon espace",
      // Sous-titres filtres
      "Objectif du séjour"          : "Usage proposé",
      "Caractéristiques du logement": "Caractéristiques de mon bien",
      "Caractéristiques de l'espace": "Caractéristiques de mon espace",
      "Caractéristiques de la salle": "Caractéristiques de ma salle",
    };

    function walkTextNodes(root, callback) {
      var walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, null, false);
      var node;
      while ((node = walker.nextNode())) {
        callback(node);
      }
    }

    function renameOfferLabels() {
      var form = document.getElementById('preplyFiltersForm');
      if (!form) return;

      walkTextNodes(form, function(node) {
        var trimmed = node.textContent.trim();
        if (MAP[trimmed]) {
          // conserver l'espacement blanc autour du texte
          node.textContent = node.textContent.replace(trimmed, MAP[trimmed]);
        }
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', renameOfferLabels);
    } else {
      renameOfferLabels();
    }
  })();

  // ─── Toggle Filtres avancés (capture phase pour résister à stopPropagation) ───
  (function () {
    function initAdvancedToggle() {
      var btn   = document.getElementById('homeswapToggleAdvancedFilters');
      var panel = document.getElementById('homeswapAdvancedFiltersPanel');
      var chev  = document.getElementById('homeswapAdvancedChevron');
      if (!btn || !panel) return;

      btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var isOpen = panel.classList.contains('is-open');
        panel.classList.toggle('is-open', !isOpen);
        panel.style.display  = isOpen ? 'none' : 'block';
        panel.setAttribute('aria-hidden', isOpen ? 'true' : 'false');
        btn.setAttribute('aria-expanded',  isOpen ? 'false' : 'true');
        if (chev) chev.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
      }, true); // capture = true → avant tout autre handler
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initAdvancedToggle);
    } else {
      initAdvancedToggle();
    }
  })();

  // ─── Accordéons (Langues / Dispo / Critères) ───────────────────────────────
  function nxAccordionToggle(id) {
    var body = document.getElementById(id);
    var chev = document.getElementById('chev-' + id);
    if (!body) return;
    var open = body.style.display !== 'none';
    body.style.display = open ? 'none' : 'block';
    if (chev) chev.style.transform = open ? 'rotate(0deg)' : 'rotate(180deg)';
  }

  // ─── Gestion dynamique des langues ─────────────────────────────────────────
  var nxLangIdx = document.querySelectorAll('#langs-container .nx-lang-row').length || 1;

  function nxAddLang() {
    var container = document.getElementById('langs-container');
    var div = document.createElement('div');
    div.className = 'nx-lang-row';
    div.setAttribute('data-idx', nxLangIdx);
    div.innerHTML =
      '<div><label class="nx-label" style="font-size:.8rem">Langue</label>' +
      '<input type="text" name="languages[' + nxLangIdx + '][language]" class="nx-input" placeholder="Ex : Anglais" list="nx-lang-list"></div>' +
      '<div><label class="nx-label" style="font-size:.8rem">Niveau</label>' +
      '<select name="languages[' + nxLangIdx + '][level]" class="nx-select" style="min-width:130px">' +
      '<option value="native">Langue maternelle</option><option value="fluent">Bilingue / Courant</option>' +
      '<option value="C2">C2</option><option value="C1">C1</option>' +
      '<option value="B2">B2</option><option value="B1">B1</option>' +
      '<option value="A2">A2</option><option value="A1">A1 (débutant)</option>' +
      '</select></div>' +
      '<button type="button" class="nx-lang-remove" onclick="nxRemoveLang(this)" title="Supprimer">✕</button>';
    container.appendChild(div);
    div.querySelector('input').focus();
    nxLangIdx++;
  }

  function nxRemoveLang(btn) {
    var row       = btn.closest('.nx-lang-row');
    var container = document.getElementById('langs-container');
    if (container.querySelectorAll('.nx-lang-row').length > 1) row.remove();
  }

</script>
<script>
  window._nxAutosaveUrl = '{{ route('nexus.onboarding.autosave') }}';
</script>
<script src="{{ asset('assets/front/js/nexus-autosave.js') }}"></script>
{{-- preplyFiltersForm porte data-nx-autosave via le composant → géré par nexus-autosave.js --}}
@endsection
