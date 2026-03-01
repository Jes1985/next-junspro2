@extends('frontend.layout')

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
  :root {
    --purple: #7C3AED;
    --blue:   #1e40af;
    --grad:   linear-gradient(135deg, #7c3aed 0%, #1e40af 100%);
    --shadow: 0 8px 24px rgba(124,58,237,0.15);
  }

  /* ── Layout ── */
  .agenda-page {
    max-width: 1280px;
    margin: 0 auto;
    padding: 3rem 2rem 4rem;
    min-height: calc(100vh - 200px);
    background: linear-gradient(135deg,#f9f5ff 0%,#f0f4ff 50%,#faf8ff 100%);
  }

  /* ── Hero ── */
  .agenda-hero {
    background: var(--grad);
    border-radius: 24px;
    padding: 2.5rem 2.5rem 2rem;
    color: white;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
  }
  .agenda-hero::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 300px; height: 300px;
    background: rgba(255,255,255,0.06);
    border-radius: 50%;
    pointer-events: none;
  }
  .agenda-hero::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -40px;
    width: 220px; height: 220px;
    background: rgba(255,255,255,0.04);
    border-radius: 50%;
    pointer-events: none;
  }
  .agenda-hero-eyebrow {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    opacity: 0.7;
    margin-bottom: 0.4rem;
  }
  .agenda-hero h1 {
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 800;
    margin: 0 0 0.5rem;
    letter-spacing: -0.5px;
  }
  .agenda-hero p {
    opacity: 0.8;
    font-size: 15px;
    margin: 0;
  }
  .agenda-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.18);
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 20px;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    margin-top: 1rem;
    backdrop-filter: blur(4px);
  }

  /* ── Nav semaine ── */
  .week-nav {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: white;
    border-radius: 16px;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    flex-wrap: wrap;
  }
  .week-nav-label {
    flex: 1;
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    text-align: center;
  }
  .week-nav-label span {
    display: block;
    font-size: 12px;
    font-weight: 500;
    color: #9CA3AF;
    margin-top: 2px;
  }
  .week-nav-btn {
    width: 42px;
    height: 42px;
    border: 2px solid #E5E7EB;
    border-radius: 12px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-decoration: none;
    color: #4B5563;
    font-size: 16px;
    transition: all 0.2s;
    flex-shrink: 0;
  }
  .week-nav-btn:hover {
    border-color: var(--purple);
    background: #F5F3FF;
    color: var(--purple);
    text-decoration: none;
  }
  .week-nav-btn--today {
    background: var(--grad);
    border-color: transparent;
    color: white;
    font-size: 11px;
    font-weight: 700;
    width: auto;
    padding: 0 14px;
    letter-spacing: 0.5px;
  }
  .week-nav-btn--today:hover {
    background: var(--grad);
    color: white;
    opacity: 0.9;
  }

  /* ── Grille calendrier ── */
  .calendar-grid {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 2px 16px rgba(0,0,0,0.07);
    margin-bottom: 2rem;
  }
  .calendar-header-row {
    display: grid;
    grid-template-columns: 70px repeat(7, 1fr);
    border-bottom: 2px solid #F3F4F6;
  }
  .cal-header-cell {
    padding: 14px 8px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
  }
  .cal-header-cell:first-child { border-right: 1px solid #F3F4F6; }
  .cal-day-name {
    font-size: 11px;
    font-weight: 700;
    color: #9CA3AF;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  .cal-day-num {
    font-size: 20px;
    font-weight: 800;
    color: #1F2937;
    line-height: 1;
  }
  .cal-header-cell--today .cal-day-name { color: var(--purple); }
  .cal-header-cell--today .cal-day-num {
    background: var(--grad);
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    box-shadow: 0 4px 12px rgba(124,58,237,0.35);
  }

  /* Ligne des sessions */
  .calendar-body-row {
    display: grid;
    grid-template-columns: 70px repeat(7, 1fr);
    min-height: 120px;
    border-top: 1px solid #F9FAFB;
  }
  .cal-time-slot {
    padding: 12px 8px;
    border-right: 1px solid #F3F4F6;
    display: flex;
    flex-direction: column;
    gap: 4px;
    align-items: center;
    justify-content: flex-start;
    padding-top: 14px;
  }
  .cal-time-label {
    font-size: 10px;
    font-weight: 600;
    color: #D1D5DB;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .cal-day-col {
    padding: 8px 6px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    border-right: 1px solid #F9FAFB;
    min-height: 120px;
  }
  .cal-day-col--today { background: #FAFAFF; }
  .cal-day-col:last-child { border-right: none; }

  /* Session card */
  .session-card {
    background: linear-gradient(135deg, #F5F3FF 0%, #EEF2FF 100%);
    border: 1.5px solid #DDD6FE;
    border-left: 4px solid var(--purple);
    border-radius: 10px;
    padding: 8px 10px;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: block;
    color: inherit;
  }
  .session-card:hover {
    border-color: var(--purple);
    box-shadow: 0 4px 16px rgba(124,58,237,0.2);
    transform: translateY(-2px);
    text-decoration: none;
    color: inherit;
  }
  .session-time {
    font-size: 11px;
    font-weight: 700;
    color: var(--purple);
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
  }
  .session-fl-row {
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .session-fl-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
  }
  .session-fl-initials {
    background: var(--grad);
    color: white;
    font-size: 10px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .session-fl-name {
    font-size: 12px;
    font-weight: 600;
    color: #1F2937;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .session-status-badge {
    display: inline-block;
    font-size: 10px;
    font-weight: 600;
    padding: 2px 7px;
    border-radius: 6px;
    margin-top: 5px;
    text-transform: uppercase;
    letter-spacing: 0.4px;
  }
  .badge--confirmed { background: #DCFCE7; color: #166534; }
  .badge--pending   { background: #FEF9C3; color: #854D0E; }
  .badge--live      { background: #EFF6FF; color: #1D4ED8; }

  /* Empty state colonne */
  .cal-empty-day {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    min-height: 100px;
    color: #E5E7EB;
    font-size: 20px;
  }

  /* ── Empty state global ── */
  .agenda-empty {
    background: white;
    border-radius: 20px;
    padding: 4rem 2rem;
    text-align: center;
    box-shadow: 0 2px 16px rgba(0,0,0,0.06);
    margin-bottom: 2rem;
  }
  .agenda-empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg,#F5F3FF,#EEF2FF);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    margin: 0 auto 1.5rem;
    color: var(--purple);
    box-shadow: 0 8px 24px rgba(124,58,237,0.12);
  }
  .agenda-empty h3 {
    font-size: 20px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 0.5rem;
  }
  .agenda-empty p {
    color: #6B7280;
    font-size: 15px;
    margin-bottom: 1.5rem;
    max-width: 380px;
    margin-left: auto;
    margin-right: auto;
  }

  /* ── Section abonnements actifs ── */
  .active-subs-section {
    margin-top: 2.5rem;
  }
  .active-subs-section h2 {
    font-size: 18px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .active-subs-section h2 .icon-badge {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg,#F5F3FF,#EEF2FF);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--purple);
    font-size: 15px;
  }
  .subs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1rem;
  }
  .sub-card {
    background: white;
    border-radius: 18px;
    border: 1px solid #E5E7EB;
    padding: 1.25rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  }
  .sub-card:hover {
    border-color: var(--purple);
    box-shadow: 0 8px 24px rgba(124,58,237,0.14);
    transform: translateY(-3px);
    text-decoration: none;
    color: inherit;
  }
  .sub-avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
  }
  .sub-initials {
    background: var(--grad);
    color: white;
    font-size: 18px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .sub-info { flex: 1; min-width: 0; }
  .sub-name {
    font-size: 15px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 3px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .sub-meta {
    font-size: 13px;
    color: #6B7280;
  }
  .sub-meta strong { color: var(--purple); }
  .sub-cta {
    background: var(--grad);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    box-shadow: 0 4px 12px rgba(124,58,237,0.3);
  }
  .sub-cta:hover {
    opacity: 0.9;
    transform: translateY(-1px);
    text-decoration: none;
    color: white;
    box-shadow: 0 6px 18px rgba(124,58,237,0.4);
  }

  /* ── Prochaine session banner ── */
  .next-session-banner {
    background: white;
    border: 2px solid #E0E7FF;
    border-radius: 18px;
    padding: 1.25rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1.2rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 16px rgba(99,102,241,0.1);
    flex-wrap: wrap;
  }
  .nsb-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #10B981;
    flex-shrink: 0;
    box-shadow: 0 0 0 4px rgba(16,185,129,0.2);
    animation: pulse-green 2s infinite;
  }
  @keyframes pulse-green {
    0%,100% { box-shadow: 0 0 0 4px rgba(16,185,129,0.2); }
    50%      { box-shadow: 0 0 0 8px rgba(16,185,129,0.08); }
  }
  .nsb-content { flex: 1; }
  .nsb-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #10B981;
    margin-bottom: 2px;
  }
  .nsb-date {
    font-size: 16px;
    font-weight: 800;
    color: #111827;
  }
  .nsb-fl { font-size: 13px; color: #6B7280; margin-top: 2px; }
  .nsb-btn {
    background: #10B981;
    color: white;
    border-radius: 10px;
    padding: 9px 18px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(16,185,129,0.3);
  }
  .nsb-btn:hover { opacity: 0.9; color: white; text-decoration: none; }

  /* ── Btn principal ── */
  .btn-agenda-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--grad);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 4px 16px rgba(124,58,237,0.3);
  }
  .btn-agenda-primary:hover {
    opacity: 0.9;
    text-decoration: none;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(124,58,237,0.4);
  }

  /* ── Responsive ── */
  @media (max-width: 900px) {
    .calendar-header-row,
    .calendar-body-row { grid-template-columns: 50px repeat(7, 1fr); }
    .cal-day-num { font-size: 15px; }
    .session-fl-name,
    .session-time { font-size: 10px; }
  }
  @media (max-width: 640px) {
    .agenda-page { padding: 1.5rem 1rem 3rem; }
    .agenda-hero { padding: 1.5rem; }
    .week-nav { gap: 0.5rem; padding: 0.8rem 1rem; }
    .subs-grid { grid-template-columns: 1fr; }
    .calendar-header-row,
    .calendar-body-row { grid-template-columns: 40px repeat(7, 1fr); }
    .cal-day-name { font-size: 9px; }
    .cal-day-num  { font-size: 13px; }
    .session-time,
    .session-fl-name,
    .session-status-badge { display: none; }
    .session-card { padding: 5px; border-left-width: 3px; }
    .session-fl-avatar,
    .session-fl-initials { width: 20px; height: 20px; font-size: 8px; }
  }
</style>
@endsection

@section('content')

@php
  $user = Auth::guard('web')->user();
  $heroName = $user ? ($user->first_name ?? explode(' ', $user->name ?? 'vous')[0]) : 'vous';

  $frDays   = ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'];
  $frMonths = ['janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre'];

  // Grouper les sessions par date
  $sessionsByDate = $sessions->groupBy(fn($s) => \Carbon\Carbon::parse($s->start_at)->format('Y-m-d'));

  // Jours de la semaine
  $weekDays = [];
  for ($d = 0; $d < 7; $d++) {
    $day = $weekStart->copy()->addDays($d);
    $weekDays[] = [
      'date'     => $day,
      'label'    => $frDays[$d],
      'sessions' => $sessionsByDate->get($day->format('Y-m-d'), collect()),
      'isToday'  => $day->isToday(),
    ];
  }

  // Libellé semaine
  $startLabel = $weekStart->day . ' ' . $frMonths[$weekStart->month - 1];
  $endLabel   = $weekEnd->day . ' ' . $frMonths[$weekEnd->month - 1] . ' ' . $weekEnd->year;
  $weekLabel  = $startLabel . ' – ' . $endLabel;
@endphp

<div class="agenda-page">

  {{-- ── Nav client ── --}}
  @include('frontend.client.partials.dashboard-nav')

  {{-- ── Hero ── --}}
  <div class="agenda-hero">
    <div class="agenda-hero-eyebrow">Mon calendrier</div>
    <h1>Bonjour {{ ucfirst($heroName) }}, voici votre Agenda</h1>
    <p>Consultez vos sessions bookées et programmez de nouveaux Rituels.</p>
    @if($nextSession)
      @php
        $ns    = $nextSession;
        $nsFL  = optional(optional(optional($ns->subscription)->freelancer)->user);
        $nsName = trim(($nsFL->first_name ?? '') . ' ' . ($nsFL->last_name ?? ''));
        if(empty(trim($nsName))) $nsName = $nsFL->name ?? 'Votre freelance';
        $nsDate = \Carbon\Carbon::parse($ns->start_at)->translatedFormat('l d M · H:i');
      @endphp
      <div class="agenda-hero-badge">
        <i class="fas fa-circle" style="font-size:8px; color:#6EE7B7;"></i>
        Prochain Rituel : {{ $nsDate }} avec {{ $nsName }}
      </div>
    @endif
  </div>

  {{-- ── Alerte erreur ── --}}
  @if(session('error'))
    <div class="alert alert-warning" style="border-radius:12px; margin-bottom:1rem;">
      <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
    </div>
  @endif

  {{-- ── Nav semaine ── --}}
  <div class="week-nav">
    <a href="{{ route('client.agenda.index', ['week' => $weekOffset - 1]) }}" class="week-nav-btn" title="Semaine précédente">
      <i class="fas fa-chevron-left"></i>
    </a>

    @if($weekOffset !== 0)
      <a href="{{ route('client.agenda.index') }}" class="week-nav-btn week-nav-btn--today">
        Aujourd'hui
      </a>
    @endif

    <div class="week-nav-label">
      {{ $weekLabel }}
      <span>{{ $sessions->count() }} session{{ $sessions->count() !== 1 ? 's' : '' }} cette semaine</span>
    </div>

    <a href="{{ route('client.agenda.index', ['week' => $weekOffset + 1]) }}" class="week-nav-btn" title="Semaine suivante">
      <i class="fas fa-chevron-right"></i>
    </a>
  </div>

  {{-- ── Grille calendrier ── --}}
  @if($sessions->count() > 0)
  <div class="calendar-grid">

    {{-- En-tête jours --}}
    <div class="calendar-header-row">
      <div class="cal-header-cell" style="border-right:1px solid #F3F4F6;">
        <div class="cal-day-name" style="font-size:9px; color:#D1D5DB;">SEM.</div>
        <div class="cal-day-num" style="font-size:12px; color:#D1D5DB; font-weight:600;">
          {{ $weekStart->weekOfYear }}
        </div>
      </div>
      @foreach($weekDays as $wd)
        <div class="cal-header-cell {{ $wd['isToday'] ? 'cal-header-cell--today' : '' }}">
          <div class="cal-day-name">{{ $wd['label'] }}</div>
          @if($wd['isToday'])
            <div class="cal-day-num"><span>{{ $wd['date']->format('d') }}</span></div>
          @else
            <div class="cal-day-num">{{ $wd['date']->format('d') }}</div>
          @endif
        </div>
      @endforeach
    </div>

    {{-- Corps sessions --}}
    <div class="calendar-body-row">
      <div class="cal-time-slot">
        <span class="cal-time-label">Sessions</span>
      </div>
      @foreach($weekDays as $wd)
        <div class="cal-day-col {{ $wd['isToday'] ? 'cal-day-col--today' : '' }}">
          @if($wd['sessions']->count() > 0)
            @foreach($wd['sessions'] as $sess)
              @php
                $sFL   = optional(optional(optional($sess->subscription)->freelancer)->user);
                $sName = trim(($sFL->first_name ?? '') . ' ' . ($sFL->last_name ?? ''));
                if(empty(trim($sName))) $sName = $sFL->name ?? 'Freelance';
                $sTime = \Carbon\Carbon::parse($sess->start_at)->format('H:i');
                $sDur  = $sess->duration_minutes ?? 60;
                $sStatus = $sess->status ?? 'confirmed';
                $sBadge  = match($sStatus) {
                  'completed' => ['badge--confirmed', 'Fait'],
                  'pending'   => ['badge--pending',   'À conf.'],
                  default     => ['badge--live',      'Confirmé'],
                };
                $sLink = route('client.subscriptions.show', optional($sess->subscription)->id ?? '#');
              @endphp
              <a href="{{ $sLink }}" class="session-card">
                <div class="session-time">
                  <i class="fas fa-clock" style="font-size:9px;"></i>
                  {{ $sTime }} · {{ $sDur }}min
                </div>
                <div class="session-fl-row">
                  @if($sFL->image ?? false)
                    <img src="{{ asset('assets/img/users/'.$sFL->image) }}"
                         alt="{{ $sName }}"
                         class="session-fl-avatar"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div class="session-fl-avatar session-fl-initials" style="display:none; border-radius:50%;">{{ strtoupper(substr($sName,0,1)) }}</div>
                  @else
                    <div class="session-fl-avatar session-fl-initials" style="border-radius:50%;">{{ strtoupper(substr($sName,0,1)) }}</div>
                  @endif
                  <div class="session-fl-name">{{ $sName }}</div>
                </div>
                <span class="session-status-badge {{ $sBadge[0] }}">{{ $sBadge[1] }}</span>
              </a>
            @endforeach
          @else
            <div class="cal-empty-day">
              <i class="far fa-calendar"></i>
            </div>
          @endif
        </div>
      @endforeach
    </div>
  </div>

  @else
  {{-- ── Empty state ── --}}
  <div class="agenda-empty">
    <div class="agenda-empty-icon">
      <i class="fas fa-calendar-week"></i>
    </div>
    <h3>Aucun Rituel prévu cette semaine</h3>
    <p>Vous n'avez pas de session bookée du {{ $startLabel }} au {{ $endLabel }}.<br>Programmez un Rituel avec votre freelance !</p>
    @if($subscriptions->count() > 0)
      <a href="{{ route('client.subscriptions.first') }}" class="btn-agenda-primary">
        <i class="fas fa-calendar-plus"></i> Programmer un Rituel
      </a>
    @else
      <a href="{{ route('explore') }}" class="btn-agenda-primary">
        <i class="fas fa-search"></i> Trouver un freelance
      </a>
    @endif
  </div>
  @endif

  {{-- ── Section abonnements actifs ── --}}
  @if($subscriptions->count() > 0)
  <div class="active-subs-section">
    <h2>
      <div class="icon-badge"><i class="fas fa-fire"></i></div>
      Vos Rituels actifs
    </h2>
    <div class="subs-grid">
      @foreach($subscriptions as $sub)
        @php
          $flUser = optional(optional($sub->freelancer)->user);
          $flName = trim(($flUser->first_name ?? '') . ' ' . ($flUser->last_name ?? ''));
          if(empty(trim($flName))) $flName = $flUser->name ?? 'Freelance';
          $hoursLeft = number_format($sub->calculated_hours_remaining ?? $sub->hours_remaining ?? 0, 1);
          $isActive  = $sub->status === 'active';
        @endphp
        <div class="sub-card">
          @if($flUser->image ?? false)
            <img src="{{ asset('assets/img/users/'.$flUser->image) }}"
                 alt="{{ $flName }}"
                 class="sub-avatar"
                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
            <div class="sub-avatar sub-initials" style="display:none; border-radius:50%;">{{ strtoupper(substr($flName,0,1)) }}</div>
          @else
            <div class="sub-avatar sub-initials" style="border-radius:50%;">{{ strtoupper(substr($flName,0,1)) }}</div>
          @endif

          <div class="sub-info">
            <div class="sub-name">{{ $flName }}</div>
            <div class="sub-meta">
              <strong>{{ $hoursLeft }}h</strong> restante{{ $hoursLeft != 1 ? 's' : '' }} ·
              <span style="color:{{ $isActive ? '#10B981' : '#F59E0B' }}; font-weight:600;">
                {{ $isActive ? 'Actif' : 'En pause' }}
              </span>
            </div>
          </div>

          <a href="{{ route('client.subscriptions.show', $sub->id) }}" class="sub-cta">
            <i class="fas fa-calendar-plus"></i> Programmer
          </a>
        </div>
      @endforeach
    </div>
  </div>
  @endif

</div>

@endsection
