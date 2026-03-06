@extends('frontend.layout')

@section('style')
@include('nexus.onboarding._layout')
<style>
/* ── Variables step2/step3 alignées ─────────────────────────── */
:root {
  --preply-primary:       #EC4899;
  --preply-primary-dark:  #DB2777;
  --preply-primary-light: #2563EB;
  --preply-pink:          #F472B6;
  --preply-pink-light:    #3B82F6;
  --preply-text:          #1F2937;
  --preply-text-light:    #6B7280;
}

/* ── Hero banner ─────────────────────────────────────────────── */
.nxr-hero {
  background: linear-gradient(135deg, #2563EB 0%, #7C3AED 50%, #EC4899 100%);
  border-radius: 24px;
  padding: 2.75rem 3rem;
  margin-bottom: 2rem;
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
}
.nxr-hero::before {
  content:'';
  position:absolute; inset:0;
  background: radial-gradient(ellipse at 80% 50%, rgba(255,255,255,.08) 0%, transparent 65%);
  pointer-events:none;
}
.nxr-hero-dots {
  position:absolute; inset:0; pointer-events:none;
  background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='20' cy='20' r='1.5' fill='%23ffffff' fill-opacity='0.06'/%3E%3C/svg%3E") repeat;
}
.nxr-hero-left { position:relative; z-index:1; flex:1; }
.nxr-hero-eyebrow {
  display:inline-flex; align-items:center; gap:.4rem;
  background: rgba(255,255,255,.18); backdrop-filter:blur(6px);
  border: 1px solid rgba(255,255,255,.25);
  border-radius:100px; padding:.28rem .85rem;
  font-size:.72rem; font-weight:700; letter-spacing:.1em;
  text-transform:uppercase; color:#fff; margin-bottom:1rem;
}
.nxr-hero h1 {
  color:#fff; font-size:2rem; font-weight:900; line-height:1.2;
  margin:0 0 .6rem; letter-spacing:-.02em;
}
.nxr-hero p {
  color:rgba(255,255,255,.82); font-size:.975rem; margin:0;
}
.nxr-hero-right { position:relative; z-index:1; flex-shrink:0; }
.nxr-score-circle {
  width:110px; height:110px; border-radius:50%;
  background: rgba(255,255,255,.15); backdrop-filter:blur(8px);
  border:3px solid rgba(255,255,255,.35);
  display:flex; flex-direction:column;
  align-items:center; justify-content:center;
}
.nxr-score-num {
  color:#fff; font-size:2rem; font-weight:900; line-height:1;
}
.nxr-score-label {
  color:rgba(255,255,255,.75); font-size:.65rem; font-weight:600;
  letter-spacing:.1em; text-transform:uppercase; margin-top:.15rem;
}

/* ── Progress bar ────────────────────────────────────────────── */
.nxr-progress-bar-wrap {
  background: #fff;
  border-radius: 16px;
  padding: 1.25rem 1.75rem;
  margin-bottom: 2rem;
  box-shadow: 0 2px 12px rgba(0,0,0,.05);
  border: 1px solid rgba(124,58,237,.07);
  display: flex;
  align-items:center;
  gap: 1.5rem;
}
.nxr-progress-steps {
  display:flex; align-items:center; gap:0; flex:1;
}
.nxr-pstep {
  display:flex; align-items:center; gap:.5rem; flex:1;
}
.nxr-pstep-icon {
  width:32px; height:32px; border-radius:50%; flex-shrink:0;
  background: linear-gradient(135deg, #2563EB, #EC4899);
  display:flex; align-items:center; justify-content:center;
  font-size:.85rem; color:#fff; font-weight:700;
  box-shadow:0 2px 8px rgba(124,58,237,.25);
}
.nxr-pstep-txt { font-size:.8rem; font-weight:600; color:#374151; }
.nxr-pstep-sub { font-size:.7rem; color:#9ca3af; }
.nxr-pstep-line {
  flex:1; height:3px; border-radius:3px;
  background: linear-gradient(90deg, #2563EB, #EC4899);
  margin: 0 .25rem;
}
.nxr-progress-pct {
  font-size:.8rem; font-weight:700; white-space:nowrap;
  background: linear-gradient(135deg, #7C3AED, #EC4899);
  -webkit-background-clip:text; -webkit-text-fill-color:transparent;
}

/* ── Grid 2 colonnes ─────────────────────────────────────────── */
.nxr-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.25rem;
  margin-bottom: 1.25rem;
}
.nxr-grid.nxr-grid-1 { grid-template-columns: 1fr; }
@media(max-width:768px) { .nxr-grid { grid-template-columns:1fr; } }

/* ── Card récap ──────────────────────────────────────────────── */
.nxr-section {
  background: #fff;
  border-radius: 20px;
  border: 1px solid #e8edf5;
  padding: 1.5rem 1.75rem;
  box-shadow: 0 2px 12px rgba(0,0,0,.04);
  transition: box-shadow .2s;
  position: relative;
  overflow: hidden;
}
.nxr-section::before {
  content:'';
  position:absolute; top:0; left:0; right:0; height:3px;
  background: linear-gradient(90deg, #2563EB 0%, #7C3AED 50%, #EC4899 100%);
  border-radius:20px 20px 0 0;
}
.nxr-section:hover { box-shadow: 0 6px 24px rgba(124,58,237,.10); }

.nxr-section-head {
  display:flex; align-items:center; justify-content:space-between;
  margin-bottom:1rem; padding-bottom:.75rem;
  border-bottom:1px solid #f1f5f9;
}
.nxr-section-title {
  display:flex; align-items:center; gap:.6rem;
  font-size:.95rem; font-weight:700; color:#1e293b; margin:0;
}
.nxr-section-icon {
  width:34px; height:34px; border-radius:10px; flex-shrink:0;
  background: linear-gradient(135deg, rgba(37,99,235,.1), rgba(236,72,153,.1));
  display:flex; align-items:center; justify-content:center;
  font-size:1rem;
}
.nxr-edit-btn {
  display:inline-flex; align-items:center; gap:.3rem;
  font-size:.75rem; font-weight:600; color:#7C3AED;
  border:1px solid rgba(124,58,237,.2); border-radius:8px;
  padding:.3rem .7rem; text-decoration:none;
  background:rgba(124,58,237,.04);
  transition: all .2s;
}
.nxr-edit-btn:hover {
  background:rgba(124,58,237,.1); border-color:rgba(124,58,237,.4); color:#6D28D9;
}

/* ── Lignes de données ───────────────────────────────────────── */
.nxr-row {
  display:flex; align-items:flex-start; gap:.5rem;
  padding:.4rem 0; font-size:.875rem; border-bottom:1px solid #f8fafc;
}
.nxr-row:last-child { border-bottom:none; padding-bottom:0; }
.nxr-row-label {
  font-weight:600; color:#374151; white-space:nowrap; flex-shrink:0;
  min-width:100px;
}
.nxr-row-val { color:#6b7280; word-break:break-word; }
.nxr-row-val.emphasis { color:#1e293b; font-weight:600; }

/* ── Tags / chips ────────────────────────────────────────────── */
.nxr-tags {
  display:flex; flex-wrap:wrap; gap:.35rem; margin-top:.3rem;
}
.nxr-tag {
  display:inline-flex; align-items:center; gap:.3rem;
  padding:.22rem .65rem; border-radius:8px; font-size:.775rem; font-weight:500;
}
.nxr-tag.blue {
  background:rgba(37,99,235,.08); color:#1d4ed8;
  border:1px solid rgba(37,99,235,.18);
}
.nxr-tag.pink {
  background:rgba(236,72,153,.08); color:#be185d;
  border:1px solid rgba(236,72,153,.2);
}
.nxr-tag.purple {
  background:rgba(124,58,237,.08); color:#6d28d9;
  border:1px solid rgba(124,58,237,.2);
}
.nxr-tag.green {
  background:rgba(16,185,129,.08); color:#065f46;
  border:1px solid rgba(16,185,129,.2);
}
.nxr-tag.amber {
  background:rgba(245,158,11,.08); color:#92400e;
  border:1px solid rgba(245,158,11,.2);
}

/* ── Empty state ─────────────────────────────────────────────── */
.nxr-empty {
  font-size:.825rem; color:#c4c9d4; font-style:italic; padding:.25rem 0;
}

/* ── Zone activation ─────────────────────────────────────────── */
.nxr-activate-zone {
  background: #fff;
  border-radius: 24px;
  border: 1px solid #e8edf5;
  padding: 2.5rem 3rem;
  box-shadow: 0 4px 24px rgba(124,58,237,.08);
  position:relative; overflow:hidden;
}
.nxr-activate-zone::before {
  content:'';
  position:absolute; inset:0; border-radius:24px;
  background: radial-gradient(ellipse at 50% 0%, rgba(124,58,237,.04) 0%, transparent 60%);
  pointer-events:none;
}
.nxr-activate-badges {
  display:flex; align-items:center; gap:.75rem; flex-wrap:wrap;
  margin-bottom:1.5rem;
}
.nxr-a-badge {
  display:inline-flex; align-items:center; gap:.4rem;
  font-size:.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
  padding:.3rem .9rem; border-radius:100px;
}
.nxr-a-badge.gradient {
  background: linear-gradient(135deg, #2563EB 0%, #7C3AED 55%, #EC4899 100%);
  color:#fff;
}
.nxr-a-badge.outline {
  border:1px solid rgba(124,58,237,.25); color:#7C3AED;
  background:rgba(124,58,237,.04);
}
.nxr-activate-zone h2 {
  font-size:1.6rem; font-weight:900; color:#1e293b;
  margin:0 0 .5rem; letter-spacing:-.02em;
}
.nxr-activate-zone > p {
  color:#6b7280; font-size:.9rem; margin:0 0 1.75rem;
}
.nxr-charte-box {
  background: linear-gradient(135deg, #f8f9ff, #fdf2f8);
  border: 1.5px solid rgba(124,58,237,.15);
  border-radius: 16px;
  padding: 1.25rem 1.5rem;
  margin-bottom: 1.5rem;
  display:flex; align-items:flex-start; gap:1rem;
}
.nxr-charte-box input[type="checkbox"] {
  margin-top:.2rem; flex-shrink:0;
  width:20px; height:20px; cursor:pointer;
  accent-color: #7C3AED;
}
.nxr-charte-box label {
  font-size:.9rem; color:#374151; cursor:pointer; line-height:1.55;
}
.nxr-charte-box label strong { color:#1e293b; }
.nxr-activate-footer {
  display:flex; align-items:center; justify-content:space-between; gap:1rem;
  flex-wrap:wrap;
}
.nxr-btn-back {
  display:inline-flex; align-items:center; gap:.4rem;
  color:#6b7280; font-size:.875rem; font-weight:600; text-decoration:none;
  padding:.7rem 1.4rem; border-radius:12px;
  border:1.5px solid #e5e7eb;
  transition:all .2s;
}
.nxr-btn-back:hover { border-color:#d1d5db; color:#374151; background:#f9fafb; }
.nxr-btn-activate {
  display:inline-flex; align-items:center; gap:.6rem;
  background: linear-gradient(135deg, #2563EB 0%, #7C3AED 50%, #EC4899 100%);
  color:#fff; font-size:1rem; font-weight:800;
  padding:.9rem 2.25rem; border-radius:14px; border:none; cursor:pointer;
  box-shadow: 0 4px 20px rgba(124,58,237,.35);
  transition: all .25s; letter-spacing:-.01em;
  text-decoration:none;
}
.nxr-btn-activate:hover {
  transform:translateY(-2px);
  box-shadow: 0 8px 32px rgba(124,58,237,.45);
  color:#fff;
}
.nxr-btn-activate:disabled {
  opacity:.55; cursor:not-allowed; transform:none;
}
.nxr-guarantee {
  display:flex; align-items:center; gap:.5rem;
  font-size:.75rem; color:#9ca3af; margin-top:1rem;
}

/* ── Alerte erreur ───────────────────────────────────────────── */
.nxr-alert-error {
  background:rgba(239,68,68,.06); border:1px solid rgba(239,68,68,.2);
  border-radius:12px; padding:.875rem 1.25rem; margin-bottom:1.5rem;
  display:flex; gap:.75rem; align-items:flex-start;
  font-size:.875rem; color:#b91c1c;
}

@media(max-width:600px) {
  .nxr-hero { padding:1.75rem 1.25rem; flex-direction:column; }
  .nxr-hero h1 { font-size:1.5rem; }
  .nxr-hero-right { display:none; }
  .nxr-activate-zone { padding:1.5rem 1.25rem; }
  .nxr-progress-bar-wrap { flex-direction:column; align-items:flex-start; }
  .nxr-activate-footer { flex-direction:column-reverse; }
  .nxr-btn-activate, .nxr-btn-back { width:100%; justify-content:center; }
}
</style>
@endsection

@section('content')
<div class="nx-ob-page">
  <div class="nx-ob-wrap">

    {{-- Badge --}}
    <div class="nx-badge"><span>✦</span> Onboarding NEXUS</div>
    @include('nexus.onboarding._stepper', ['current' => 3])

    {{-- Alertes --}}
    @if(session('info'))
      <div class="nxr-alert-error" style="background:rgba(37,99,235,.06);border-color:rgba(37,99,235,.2);color:#1d4ed8;margin-bottom:1.5rem">
        <span>ℹ️</span> {{ session('info') }}
      </div>
    @endif
    @if($errors->any())
      <div class="nxr-alert-error">
        <span>⚠️</span>
        <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
      </div>
    @endif

    {{-- ═══ HERO ══════════════════════════════════════════════ --}}
    <div class="nxr-hero">
      <div class="nxr-hero-dots"></div>
      <div class="nxr-hero-left">
        <div class="nxr-hero-eyebrow">✦ Étape 3 sur 3 — Finalisation</div>
        <h1>Votre profil NEXUS est prêt !</h1>
        <p>Vérifiez votre récapitulatif ci-dessous, acceptez la charte et activez votre accès à la communauté premium.</p>
      </div>
      <div class="nxr-hero-right">
        <div class="nxr-score-circle">
          <div class="nxr-score-num">100%</div>
          <div class="nxr-score-label">Complet</div>
        </div>
      </div>
    </div>

    {{-- ═══ BARRE DE PROGRESSION ══════════════════════════════ --}}
    <div class="nxr-progress-bar-wrap">
      <div class="nxr-progress-steps">
        <div class="nxr-pstep">
          <div class="nxr-pstep-icon">✓</div>
          <div>
            <div class="nxr-pstep-txt">Identité</div>
            <div class="nxr-pstep-sub">Profil personnel</div>
          </div>
        </div>
        <div class="nxr-pstep-line"></div>
        <div class="nxr-pstep">
          <div class="nxr-pstep-icon">✓</div>
          <div>
            <div class="nxr-pstep-txt">Mon bien</div>
            <div class="nxr-pstep-sub">Offre d'échange</div>
          </div>
        </div>
        <div class="nxr-pstep-line"></div>
        <div class="nxr-pstep">
          <div class="nxr-pstep-icon" style="background:linear-gradient(135deg,#EC4899,#F472B6);box-shadow:0 2px 10px rgba(236,72,153,.4)">✦</div>
          <div>
            <div class="nxr-pstep-txt" style="color:#EC4899">Activation</div>
            <div class="nxr-pstep-sub">En cours</div>
          </div>
        </div>
      </div>
      <div class="nxr-progress-pct">3 / 3 étapes ✦</div>
    </div>

    {{-- ═══ GRILLE RÉCAP ══════════════════════════════════════ --}}
    <div class="nxr-grid">

      {{-- BLOC 1 : Identité --}}
      <div class="nxr-section">
        <div class="nxr-section-head">
          <h3 class="nxr-section-title">
            <span class="nxr-section-icon">👤</span>
            Mon identité
          </h3>
          <a href="{{ route('nexus.onboarding.step1') }}" class="nxr-edit-btn">✎ Modifier</a>
        </div>
        <div class="nxr-row">
          <span class="nxr-row-label">Nom complet</span>
          <span class="nxr-row-val emphasis">{{ trim(($saved['first_name'] ?? '') . ' ' . ($saved['last_name'] ?? '')) ?: '—' }}</span>
        </div>
        <div class="nxr-row">
          <span class="nxr-row-label">Localisation</span>
          <span class="nxr-row-val">📍 {{ $saved['city'] ?? '—' }}@if(!empty($saved['country'])), {{ $saved['country'] }}@endif</span>
        </div>
        @if(!empty($saved['contact_email']))
          <div class="nxr-row">
            <span class="nxr-row-label">E-mail</span>
            <span class="nxr-row-val">{{ $saved['contact_email'] }}</span>
          </div>
        @endif
        @if(!empty($saved['bio']))
          <div class="nxr-row" style="flex-direction:column;gap:.3rem">
            <span class="nxr-row-label">Présentation</span>
            <span class="nxr-row-val" style="font-size:.825rem;line-height:1.5">"{{ \Illuminate\Support\Str::limit($saved['bio'], 130) }}"</span>
          </div>
        @endif
        @if(!empty($saved['profile_photo']))
          <div class="nxr-row">
            <span class="nxr-row-label">Photo</span>
            <span class="nxr-row-val"><span class="nxr-tag green">✓ Ajoutée</span></span>
          </div>
        @endif
      </div>

      {{-- BLOC 2 : Mon bien --}}
      <div class="nxr-section">
        <div class="nxr-section-head">
          <h3 class="nxr-section-title">
            <span class="nxr-section-icon">🏠</span>
            Mon bien d'échange
          </h3>
          <a href="{{ route('nexus.onboarding.step2') }}" class="nxr-edit-btn">✎ Modifier</a>
        </div>
        @if(!empty($saved['property_type']))
          <div class="nxr-row">
            <span class="nxr-row-label">Type</span>
            <span class="nxr-row-val emphasis">{{ $saved['property_type'] }}</span>
          </div>
        @endif
        @if(!empty($saved['property_title']))
          <div class="nxr-row">
            <span class="nxr-row-label">Titre</span>
            <span class="nxr-row-val">"{{ $saved['property_title'] }}"</span>
          </div>
        @endif
        @if(!empty($saved['property_desc']))
          <div class="nxr-row">
            <span class="nxr-row-label">Description</span>
            <span class="nxr-row-val" style="font-style:italic;color:#6b7280;font-size:.88rem">{{ mb_substr($saved['property_desc'], 0, 120) }}{{ mb_strlen($saved['property_desc']) > 120 ? '…' : '' }}</span>
          </div>
        @endif
        @if(!empty($saved['property_capacity']))
          <div class="nxr-row">
            <span class="nxr-row-label">Capacité</span>
            <span class="nxr-row-val">{{ $saved['property_capacity'] }} {{ $saved['property_capacity'] > 1 ? 'personnes' : 'personne' }}</span>
          </div>
        @endif
        @if(!empty($saved['property_photos']))
          @php $photoCount = count(array_filter((array)$saved['property_photos'])); @endphp
          @if($photoCount > 0)
          <div class="nxr-row" style="flex-direction:column;gap:.5rem">
            <span class="nxr-row-label">Photos</span>
            <div style="display:flex;gap:.45rem;flex-wrap:wrap">
              @foreach(array_slice(array_filter((array)$saved['property_photos']), 0, 6) as $photo)
                <img src="{{ asset('storage/img/nexus-photos/' . $photo) }}"
                  alt="Photo du bien"
                  style="width:64px;height:48px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb">
              @endforeach
              @if($photoCount > 6)
                <span class="nxr-tag purple">+{{ $photoCount - 6 }}</span>
              @endif
            </div>
          </div>
          @endif
        @endif
        @if(!empty($saved['video_thumbnail']))
          <div class="nxr-row">
            <span class="nxr-row-label">Miniature</span>
            <span class="nxr-row-val">
              <img src="{{ asset('storage/img/nexus-thumbnails/' . $saved['video_thumbnail']) }}"
                alt="Miniature vidéo"
                style="width:96px;height:54px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb">
            </span>
          </div>
        @endif
        @if(!empty($saved['video_url']))
          <div class="nxr-row">
            <span class="nxr-row-label">Vidéo</span>
            <span class="nxr-row-val">
              <a href="{{ $saved['video_url'] }}" target="_blank" rel="noopener" class="nxr-tag blue" style="text-decoration:none">▶ Voir</a>
            </span>
          </div>
        @endif
        @if(!empty($saved['property_features']))
          <div class="nxr-row" style="flex-direction:column;gap:.5rem">
            <span class="nxr-row-label">Équipements</span>
            <div class="nxr-tags">
              @foreach(array_slice($saved['property_features'], 0, 8) as $feat)
                <span class="nxr-tag blue">{{ $feat }}</span>
              @endforeach
              @if(count($saved['property_features']) > 8)
                <span class="nxr-tag purple">+{{ count($saved['property_features']) - 8 }}</span>
              @endif
            </div>
          </div>
        @endif
        @if(empty($saved['property_type']) && empty($saved['property_title']))
          <div class="nxr-empty">Non renseigné — <a href="{{ route('nexus.onboarding.step2') }}" style="color:#7C3AED">compléter</a></div>
        @endif
      </div>
    </div>

    <div class="nxr-grid">

      {{-- BLOC 3 : Disponibilités --}}
      <div class="nxr-section">
        <div class="nxr-section-head">
          <h3 class="nxr-section-title">
            <span class="nxr-section-icon">📅</span>
            Disponibilités
          </h3>
          <a href="{{ route('nexus.onboarding.step2') }}" class="nxr-edit-btn">✎ Modifier</a>
        </div>
        @php
          $durLabels  = ['court'=>'Court séjour','moyen'=>'Moyen séjour','long'=>'Long séjour','flexible'=>'Durée flexible'];
          $flexLabels = ['flexible'=>'Très flexible','peu_flexible'=>'Peu flexible','pas_flexible'=>'Dates fixes'];
          $recLabels  = ['ponctuel'=>'Occasion unique','regulier'=>'Échange régulier','permanent'=>'Disponible en continu'];
          $durations  = array_filter((array) ($saved['stay_duration'] ?? []));
          $flexibs    = array_filter((array) ($saved['flexibility']   ?? []));
          // 'frequency' = clé HTML/autosave, 'recurrence' = alias step2Store — on prend la première non vide
          $recurs     = array_filter((array) (
              !empty($saved['frequency'])   ? $saved['frequency']   :
              (!empty($saved['recurrence']) ? $saved['recurrence']  : [])
          ));
          // Périodes multi-calendrier — fallback sur start_date/end_date si availability_periods vide
          $nxPeriods = [];
          $rawPeriods = $saved['availability_periods'] ?? '[]';
          if (is_array($rawPeriods)) $rawPeriods = json_encode($rawPeriods);
          $decoded = json_decode($rawPeriods, true);
          if (is_array($decoded) && !empty($decoded)) {
              $nxPeriods = array_values(array_filter($decoded, fn($p) => !empty($p['start'] ?? '') && !empty($p['end'] ?? '')));
          }
          // Fallback : start_date/end_date simple
          if (empty($nxPeriods)) {
              $s = $saved['start_date'] ?? $saved['date_from'] ?? null;
              $e = $saved['end_date']   ?? $saved['date_to']   ?? null;
              if ($s && $e) $nxPeriods = [['start' => $s, 'end' => $e]];
          }
          // Préavis
          $minDelay = (int) ($saved['min_delay'] ?? $saved['min_notice_days'] ?? 0);
        @endphp
        @if(!empty($durations))
          <div class="nxr-row" style="flex-direction:column;gap:.45rem">
            <span class="nxr-row-label">Durée souhaitée</span>
            <div class="nxr-tags">
              @foreach($durations as $d)
                <span class="nxr-tag purple">{{ $durLabels[$d] ?? $d }}</span>
              @endforeach
            </div>
          </div>
        @endif
        @if(!empty($flexibs))
          <div class="nxr-row" style="flex-direction:column;gap:.45rem">
            <span class="nxr-row-label">Flexibilité</span>
            <div class="nxr-tags">
              @foreach($flexibs as $f)
                <span class="nxr-tag blue">{{ $flexLabels[$f] ?? $f }}</span>
              @endforeach
            </div>
          </div>
        @endif
        @if(!empty($recurs))
          <div class="nxr-row" style="flex-direction:column;gap:.45rem">
            <span class="nxr-row-label">Fréquence</span>
            <div class="nxr-tags">
              @foreach($recurs as $r)
                <span class="nxr-tag pink">{{ $recLabels[$r] ?? $r }}</span>
              @endforeach
            </div>
          </div>
        @endif
        @if(!empty($nxPeriods))
          <div class="nxr-row" style="flex-direction:column;gap:.45rem">
            <span class="nxr-row-label">{{ count($nxPeriods) > 1 ? 'Périodes disponibles' : 'Période disponible' }}</span>
            <div style="display:flex;flex-direction:column;gap:6px;margin-top:2px">
              @foreach($nxPeriods as $nxP)
                @php
                  try {
                    $nxLabel = \Carbon\Carbon::parse($nxP['start'])->locale('fr')->translatedFormat('d M Y')
                               . ' → '
                               . \Carbon\Carbon::parse($nxP['end'])->locale('fr')->translatedFormat('d M Y');
                  } catch (\Exception $e) {
                    $nxLabel = ($nxP['start'] ?? '') . ' → ' . ($nxP['end'] ?? '');
                  }
                @endphp
                <span class="nxr-tag" style="background:rgba(236,72,153,.08);color:#EC4899;border:1px solid rgba(236,72,153,.25);width:fit-content">
                  📅 {{ $nxLabel }}
                </span>
              @endforeach
            </div>
          </div>
        @endif
        @if($minDelay > 0)
          <div class="nxr-row">
            <span class="nxr-row-label">Préavis</span>
            <span class="nxr-row-val">{{ $minDelay }} {{ $minDelay > 1 ? 'jours' : 'jour' }}</span>
          </div>
        @endif
      </div>

      {{-- BLOC 4 : Critères d'échange --}}
      <div class="nxr-section">
        <div class="nxr-section-head">
          <h3 class="nxr-section-title">
            <span class="nxr-section-icon">🤝</span>
            Critères d'échange
          </h3>
          <a href="{{ route('nexus.onboarding.step2') }}" class="nxr-edit-btn">✎ Modifier</a>
        </div>
        @php
          $ctLabels  = ['message'=>'💬 Message','video'=>'📹 Visio','visio'=>'📹 Visio','phone'=>'📞 Téléphone'];
          $etLabels  = ['simultane'=>'Simultané','non-simultane'=>'Non simultané','points'=>'Système de points','gratuit'=>'Gratuit'];
          $tpLabels  = ['vacances'=>'Vacances','travail-distance'=>'Travail à distance','echange-linguistique'=>'Échange linguistique','famille'=>'En famille','etudes'=>'Études','repos-pause-souffle'=>'Repos / Déconnexion','business'=>'Business','aventure'=>'Aventure'];
          // Contact : contact_preference (autosave homeswap-filters) en priorité sur preferred_contact (step2Store)
          $rawContact = $saved['contact_preference'] ?? $saved['preferred_contact'] ?? null;
          $contacts   = array_filter(is_array($rawContact) ? $rawContact : ($rawContact ? [$rawContact] : []));
          // Type d'échange
          $exchTypes  = array_filter((array)($saved['exchange_type'] ?? []));
          // Objectif du séjour
          $tripPurps  = array_filter((array)($saved['trip_purpose'] ?? []));
        @endphp
        @if(!empty($saved['offer_skills']))
          <div class="nxr-row" style="flex-direction:column;gap:.45rem">
            <span class="nxr-row-label">Ce que j'offre</span>
            <div class="nxr-tags">
              @foreach(array_filter($saved['offer_skills']) as $s)
                <span class="nxr-tag purple">{{ $s }}</span>
              @endforeach
            </div>
          </div>
        @endif
        @if(!empty($saved['seek_skills']))
          <div class="nxr-row" style="flex-direction:column;gap:.45rem">
            <span class="nxr-row-label">Ce que je recherche</span>
            <div class="nxr-tags">
              @foreach(array_filter($saved['seek_skills']) as $s)
                <span class="nxr-tag pink">{{ $s }}</span>
              @endforeach
            </div>
          </div>
        @endif
        @if(!empty($exchTypes))
          <div class="nxr-row" style="flex-direction:column;gap:.45rem">
            <span class="nxr-row-label">Type d'échange</span>
            <div class="nxr-tags">
              @foreach($exchTypes as $et)
                <span class="nxr-tag blue">{{ $etLabels[$et] ?? $et }}</span>
              @endforeach
            </div>
          </div>
        @endif
        @if(!empty($tripPurps))
          <div class="nxr-row" style="flex-direction:column;gap:.45rem">
            <span class="nxr-row-label">Objectif du séjour</span>
            <div class="nxr-tags">
              @foreach($tripPurps as $tp)
                <span class="nxr-tag purple">{{ $tpLabels[$tp] ?? $tp }}</span>
              @endforeach
            </div>
          </div>
        @endif
        @if(!empty($contacts))
          <div class="nxr-row" style="flex-direction:column;gap:.45rem">
            <span class="nxr-row-label">Contact préféré</span>
            <div class="nxr-tags">
              @foreach($contacts as $ct)
                <span class="nxr-tag green">{{ $ctLabels[$ct] ?? $ct }}</span>
              @endforeach
            </div>
          </div>
        @endif
        @if(!empty($saved['exchange_note']))
          <div class="nxr-row" style="flex-direction:column;gap:.35rem">
            <span class="nxr-row-label">Note personnelle</span>
            <span class="nxr-row-val" style="font-size:.825rem;font-style:italic;line-height:1.6">"{{ \Illuminate\Support\Str::limit($saved['exchange_note'], 150) }}"</span>
          </div>
        @endif
      </div>
    </div>

    {{-- BLOC 5 : Langues & destinations --}}
    <div class="nxr-grid nxr-grid-1" style="margin-bottom:1.5rem">
      <div class="nxr-section">
        <div class="nxr-section-head">
          <h3 class="nxr-section-title">
            <span class="nxr-section-icon">🌐</span>
            Langues &amp; destinations
          </h3>
          <a href="{{ route('nexus.onboarding.step2') }}" class="nxr-edit-btn">✎ Modifier</a>
        </div>
        @php
          $lvlColor = ['native'=>'amber','fluent'=>'green','C2'=>'blue','C1'=>'blue','B2'=>'purple','B1'=>'purple','A2'=>'pink','A1'=>'pink'];
          $lvlLabel = ['native'=>'Maternelle','fluent'=>'Bilingue','C2'=>'C2','C1'=>'C1','B2'=>'B2','B1'=>'B1','A2'=>'A2','A1'=>'A1'];
          $cNames   = ['FR'=>'France','GP'=>'Guadeloupe','MQ'=>'Martinique','RE'=>'La Réunion','BE'=>'Belgique','CH'=>'Suisse','ES'=>'Espagne','DE'=>'Allemagne','IT'=>'Italie','PT'=>'Portugal','NL'=>'Pays-Bas','GB'=>'Royaume-Uni','CA'=>'Canada','US'=>'États-Unis','MT'=>'Malte','MC'=>'Monaco','LU'=>'Luxembourg','MA'=>'Maroc','TN'=>'Tunisie','SN'=>'Sénégal','CI'=>"Côte d'Ivoire",'IE'=>'Irlande','HR'=>'Croatie','BR'=>'Brésil','JP'=>'Japon','AE'=>'Émirats','QA'=>'Qatar','SA'=>'Arabie Saoudite','SG'=>'Singapour','AU'=>'Australie','MX'=>'Mexique','CN'=>'Chine','KR'=>'Corée du Sud','IN'=>'Inde','GR'=>'Grèce','TH'=>'Thaïlande','MU'=>'Île Maurice','SC'=>'Seychelles','SE'=>'Suède','DK'=>'Danemark','NO'=>'Norvège','AT'=>'Autriche','CY'=>'Chypre','ID'=>'Indonésie','MY'=>'Malaisie','PH'=>'Philippines'];
          $langNames = ['fr'=>'Français','en'=>'Anglais','es'=>'Espagnol','de'=>'Allemand','it'=>'Italien','pt'=>'Portugais','nl'=>'Néerlandais','ru'=>'Russe','zh'=>'Chinois','ar'=>'Arabe','ja'=>'Japonais','pl'=>'Polonais','el'=>'Grec','tr'=>'Turc','sv'=>'Suédois','ko'=>'Coréen','hi'=>'Hindi'];

          // ── Consolidation des langues depuis les 3 sources possibles ──────────────
          // Source 1 : $saved['languages'] = [{language, level}] (widget step3)
          $langs = [];
          foreach ((array)($saved['languages'] ?? []) as $l) {
              if (!empty($l['language'])) $langs[$l['language']] = ['label' => $l['language'], 'level' => $l['level'] ?? 'native'];
          }
          // Source 2 : mother_tongue = code ISO (homeswap-filters)
          if (!empty($saved['mother_tongue'])) {
              $mtCode  = $saved['mother_tongue'];
              $mtLabel = $langNames[$mtCode] ?? ucfirst($mtCode);
              if (!isset($langs[$mtLabel])) $langs[$mtLabel] = ['label' => $mtLabel, 'level' => 'native'];
          }
          // Source 3 : other_languages = JSON string [{code, label, level}] (homeswap-filters)
          $otherLangs = $saved['other_languages'] ?? [];
          if (is_string($otherLangs)) $otherLangs = json_decode($otherLangs, true) ?: [];
          foreach ((array)$otherLangs as $ol) {
              $olLabel = $ol['label'] ?? ($langNames[$ol['code'] ?? ''] ?? ($ol['code'] ?? ''));
              $olLevel = $ol['level'] ?? 'B1';
              if (!empty($olLabel) && !isset($langs[$olLabel])) $langs[$olLabel] = ['label' => $olLabel, 'level' => $olLevel];
          }
        @endphp
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
          {{-- Langues parlées (fusionnées : languages + mother_tongue + other_languages) --}}
          <div>
            <div style="font-size:.78rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.75rem">Langues parlées</div>
            @if(!empty($langs))
              <div class="nxr-tags">
                @foreach($langs as $l)
                  <span class="nxr-tag {{ $lvlColor[$l['level'] ?? ''] ?? 'blue' }}">
                    {{ $l['label'] }}
                    @if(!empty($l['level']))
                      <span style="opacity:.55;font-size:.7em;margin-left:.2em">· {{ $lvlLabel[$l['level']] ?? $l['level'] }}</span>
                    @endif
                  </span>
                @endforeach
              </div>
            @else
              <span style="color:#9ca3af;font-size:.82rem;font-style:italic">Non renseigné</span>
            @endif
          </div>
          {{-- Destinations souhaitées (source : $saved['target_countries'] + open_worldwide) --}}
          <div>
            <div style="font-size:.78rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.75rem">Destinations souhaitées</div>
            @if(!empty($saved['open_worldwide']))
              <span class="nxr-tag green" style="font-size:.825rem;padding:.4rem 1rem">🌍 Ouvert au monde entier</span>
            @elseif(!empty($saved['target_countries']))
              <div class="nxr-tags">
                @foreach(array_slice($saved['target_countries'], 0, 12) as $code)
                  <span class="nxr-tag blue">{{ $cNames[$code] ?? $code }}</span>
                @endforeach
                @if(count($saved['target_countries']) > 12)
                  <span class="nxr-tag purple">+{{ count($saved['target_countries']) - 12 }}</span>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    {{-- ═══ ZONE ACTIVATION ══════════════════════════════════ --}}
    <div class="nxr-activate-zone">
      <div class="nxr-activate-badges">
        <span class="nxr-a-badge gradient">✦ Profil vérifié</span>
        <span class="nxr-a-badge outline">🔒 Données sécurisées</span>
        <span class="nxr-a-badge outline">🌐 Communauté premium</span>
      </div>
      <h2>Activer mon profil NEXUS</h2>
      <p>En activant votre profil, vous rejoignez une communauté exclusive d'échangeurs de biens et de savoirs à travers le monde.</p>

      <form action="{{ route('nexus.onboarding.step3.store') }}" method="POST" id="nxr-form">
        @csrf
        <div class="nxr-charte-box">
          <input type="checkbox" id="accept_terms" name="accept_terms" value="1"
            onchange="nxrToggleActivate(this.checked)"
            {{ old('accept_terms') ? 'checked' : '' }}>
          <label for="accept_terms">
            J'accepte la <strong>Charte NEXUS</strong> et m'engage sur l'exactitude des informations renseignées.
            Je m'engage à respecter les règles, valeurs et engagements de la communauté d'échanges NEXUS.
            Je comprends que tout manquement pourra entraîner la suspension de mon compte.
          </label>
        </div>
        @error('accept_terms')
          <div style="color:#b91c1c;font-size:.82rem;margin:-1rem 0 1rem;padding-left:.25rem">⚠ {{ $message }}</div>
        @enderror

        <div class="nxr-activate-footer">
          <a href="{{ route('nexus.onboarding.step2') }}" class="nxr-btn-back">← Retour à l'étape 2</a>
          <button type="submit" class="nxr-btn-activate" id="nxr-activate-btn"
            {{ old('accept_terms') ? '' : 'disabled' }}>
            ✦ Activer mon profil NEXUS
          </button>
        </div>
      </form>

      <div class="nxr-guarantee">
        <span>🔒</span>
        <span>Vos données sont protégées — vous pouvez modifier votre profil à tout moment depuis votre espace membre.</span>
      </div>
    </div>

  </div>
</div>
@endsection

@section('script')
<script>
  function nxrToggleActivate(checked) {
    const btn = document.getElementById('nxr-activate-btn');
    if (btn) btn.disabled = !checked;
  }
  const nxrTermsCb = document.getElementById('accept_terms');
  if (nxrTermsCb) nxrToggleActivate(nxrTermsCb.checked);
</script>
<script>
  window._nxAutosaveUrl = '{{ route('nexus.onboarding.autosave') }}';
</script>
<script src="{{ asset('assets/front/js/nexus-autosave.js') }}"></script>
@endsection
