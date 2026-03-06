@extends('frontend.layout')

@section('style')
@include('nexus.onboarding._layout')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
  .nx-duration-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(140px,1fr)); gap:.75rem; }
  .nx-flex-grid     { display:grid; grid-template-columns:repeat(3,1fr); gap:.75rem; }
  .nx-recur-grid    { display:grid; grid-template-columns:repeat(3,1fr); gap:.75rem; }
  @media(max-width:480px){
    .nx-flex-grid, .nx-recur-grid { grid-template-columns:1fr 1fr; }
  }
  /* ─── hw-freq-card ─── */
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
  .nx-notice-wrap input[type=range]{accent-color:var(--nx-purple);flex:1;}
  .nx-notice-val { font-weight:700; color:var(--nx-purple); min-width:3.5rem; text-align:right; }
</style>
@endsection

@section('content')
<div class="nx-ob-page">
  <div class="nx-ob-wrap">

    <div class="nx-badge"><span>✦</span> Onboarding NEXUS</div>
    @include('nexus.onboarding._stepper', ['current' => 4])

    @if($errors->any())
      <div class="nx-alert nx-alert-error mb-3">
        <span>⚠️</span>
        <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
      </div>
    @endif

    <div class="nx-card">
      <h1 class="nx-title">Mes disponibilités</h1>
      <p class="nx-subtitle">Indiquez les périodes où votre bien est disponible et la durée idéale d'un échange.</p>

      <form action="{{ route('nexus.onboarding.step4.store') }}" method="POST">
        @csrf

        {{-- Durée de séjour --}}
        <div class="nx-field">
          <label class="nx-label">Durée souhaitée de l'échange</label>
          <div class="nx-duration-grid">
            @php
              $durations = [
                'court'    => ['label'=>'Court séjour',   'sub'=>'< 7 jours',     'icon'=>'⚡'],
                'moyen'    => ['label'=>'Moyen séjour',   'sub'=>'1 – 4 semaines','icon'=>'🌙'],
                'long'     => ['label'=>'Long séjour',    'sub'=>'> 1 mois',      'icon'=>'🏡'],
                'flexible' => ['label'=>'Flexible',       'sub'=>'Peu importe',   'icon'=>'🤸'],
              ];
            @endphp
            @foreach($durations as $slug => $d)
              <input type="radio" name="stay_duration" value="{{ $slug }}" id="dur_{{ $slug }}" class="nx-radio-input"
                {{ old('stay_duration', $data['stay_duration']) === $slug ? 'checked' : '' }}>
              <label for="dur_{{ $slug }}" class="nx-radio-card">
                <span class="nx-radio-card-icon">{{ $d['icon'] }}</span>
                <span class="nx-radio-card-label">{{ $d['label'] }}</span>
                <span class="nx-radio-card-desc">{{ $d['sub'] }}</span>
              </label>
            @endforeach
          </div>
          @error('stay_duration')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Plage de dates --}}
        <div class="nx-field">
          <label class="nx-label">Période de disponibilité <span class="nx-label-hint">(optionnel)</span></label>
          <div class="nx-date-range">
            <div>
              <label class="nx-label" style="font-size:.8rem">Du</label>
              <input type="text" id="date_from" name="date_from" class="nx-input flatpickr-date"
                value="{{ old('date_from', $data['date_from']) }}" placeholder="jj/mm/aaaa" readonly>
            </div>
            <div>
              <label class="nx-label" style="font-size:.8rem">Au</label>
              <input type="text" id="date_to" name="date_to" class="nx-input flatpickr-date"
                value="{{ old('date_to', $data['date_to']) }}" placeholder="jj/mm/aaaa" readonly>
            </div>
          </div>
          @error('date_from')<div class="nx-error">⚠ {{ $message }}</div>@enderror
          @error('date_to')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Flexibilité --}}
        <div class="nx-field">
          <label class="nx-label" style="display:block;font-size:.75rem;font-weight:700;letter-spacing:.06em;color:#6b7280;text-transform:uppercase;margin-bottom:10px;">Flexibilité sur les dates</label>
          <div class="hw-freq-grid">
            @php
              $flexes = [
                'flexible'      => ['icon'=>'😌', 'label'=>'Flexible',        'sub'=>'Ouvert à tout'],
                'peu_flexible'  => ['icon'=>'🤔', 'label'=>'Peu flexible',    'sub'=>'±quelques jours'],
                'pas_flexible'  => ['icon'=>'📌', 'label'=>'Dates fixes',     'sub'=>'Périodes précises'],
              ];
            @endphp
            @foreach($flexes as $slug => $f)
              <label class="hw-freq-card">
                <input type="radio" name="flexibility" value="{{ $slug }}" class="hw-freq-input"
                  {{ old('flexibility', $data['flexibility']) === $slug ? 'checked' : '' }}>
                <span class="hw-freq-icon">{{ $f['icon'] }}</span>
                <span class="hw-freq-text">
                  <span class="hw-freq-label">{{ $f['label'] }}</span>
                  <span class="hw-freq-sub">{{ $f['sub'] }}</span>
                </span>
              </label>
            @endforeach
          </div>
          @error('flexibility')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Récurrence --}}
        <div class="nx-field">
          <label class="nx-label">Fréquence souhaitée</label>
          <div class="nx-recur-grid">
            @php
              $recurrences = [
                'ponctuel'  => ['icon'=>'🎯', 'label'=>'Ponctuel',  'sub'=>'Une seule fois'],
                'regulier'  => ['icon'=>'🔄', 'label'=>'Régulier',  'sub'=>'Plusieurs fois/an'],
                'permanent' => ['icon'=>'∞',  'label'=>'Permanent', 'sub'=>'En continu'],
              ];
            @endphp
            @foreach($recurrences as $slug => $r)
              <input type="radio" name="recurrence" value="{{ $slug }}" id="recur_{{ $slug }}" class="nx-radio-input"
                {{ old('recurrence', $data['recurrence']) === $slug ? 'checked' : '' }}>
              <label for="recur_{{ $slug }}" class="nx-radio-card">
                <span class="nx-radio-card-icon">{{ $r['icon'] }}</span>
                <span class="nx-radio-card-label">{{ $r['label'] }}</span>
                <span class="nx-radio-card-desc">{{ $r['sub'] }}</span>
              </label>
            @endforeach
          </div>
          @error('recurrence')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Délai minimum --}}
        <div class="nx-field">
          <label class="nx-label" for="min_notice_days">
            Délai minimum de réservation
            <span class="nx-label-hint">· prévenez-moi au moins X jours avant</span>
          </label>
          <div class="nx-notice-wrap">
            <input type="range" id="notice_slider" min="0" max="90" step="1"
              value="{{ old('min_notice_days', $data['min_notice_days'] ?? 7) }}"
              oninput="updateNotice(this.value)">
            <div class="nx-notice-val"><span id="notice-val">{{ old('min_notice_days', $data['min_notice_days'] ?? 7) }}</span> j</div>
          </div>
          <input type="hidden" id="min_notice_days" name="min_notice_days" value="{{ old('min_notice_days', $data['min_notice_days'] ?? 7) }}">
          @error('min_notice_days')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Footer --}}
        <div class="nx-form-footer">
          <a href="{{ route('nexus.onboarding.step3') }}" class="nx-btn nx-btn-ghost">← Retour</a>
          <button type="submit" class="nx-btn nx-btn-primary">Continuer →</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
<script>
  // Flatpickr
  const fpFrom = flatpickr('#date_from', {
    locale: 'fr',
    dateFormat: 'Y-m-d',
    altInput: true,
    altFormat: 'd/m/Y',
    minDate: 'today',
    onChange(sel) {
      if (sel[0]) fpTo.set('minDate', sel[0]);
    }
  });

  const fpTo = flatpickr('#date_to', {
    locale: 'fr',
    dateFormat: 'Y-m-d',
    altInput: true,
    altFormat: 'd/m/Y',
    minDate: 'today',
  });

  // Slider
  function updateNotice(val) {
    document.getElementById('notice-val').textContent = val;
    document.getElementById('min_notice_days').value = val;
  }
</script>
@endsection
