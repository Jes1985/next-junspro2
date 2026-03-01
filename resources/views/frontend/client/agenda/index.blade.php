@extends('frontend.layout')

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/l10n/fr.js"></script>
@endsection

@section('content')

@php
  /* ── Données injectées en JS ── */
  $sessionsByDate = [];
  foreach ($sessions as $sess) {
    $fl       = optional(optional(optional($sess->subscription)->freelancer)->user);
    $flId     = optional($sess->subscription->freelancer ?? null)->id ?? null;
    $flName   = trim(($fl->first_name ?? '') . ' ' . ($fl->last_name ?? ''));
    if (empty(trim($flName))) $flName = $fl->name ?? 'Freelance';
    $dateKey  = \Carbon\Carbon::parse($sess->start_at)->format('Y-m-d');
    $sessionsByDate[$dateKey][] = [
      'id'             => $sess->id,
      'date'           => $dateKey,
      'start_time'     => \Carbon\Carbon::parse($sess->start_at)->format('H:i'),
      'end_time'       => $sess->end_at ? \Carbon\Carbon::parse($sess->end_at)->format('H:i') : \Carbon\Carbon::parse($sess->start_at)->addMinutes($sess->duration_minutes ?? 60)->format('H:i'),
      'freelancer_name'=> $flName,
      'freelancer_id'  => $flId,
      'subscription_id'=> $sess->subscription_id,
      'status'         => $sess->status ?? 'confirmed',
    ];
  }

  /* ── Abonnements actifs pour le CTA ── */
  $activeSubs = $subscriptions->map(function($sub) {
    $fl     = optional(optional($sub->freelancer)->user);
    $flId   = optional($sub->freelancer)->id;
    $flName = trim(($fl->first_name ?? '') . ' ' . ($fl->last_name ?? ''));
    if (empty(trim($flName))) $flName = $fl->name ?? 'Freelance';
    return [
      'sub_id'        => $sub->id,
      'freelancer_id' => $flId,
      'name'          => $flName,
      'image'         => $fl->image ?? null,
      'status'        => $sub->status,
      'hours_left'    => number_format($sub->calculated_hours_remaining ?? $sub->hours_remaining ?? 0, 1),
    ];
  })->values()->toArray();
@endphp

{{-- Data JS injectée --}}
<script>
  window.clientAgendaSessions = @json($sessionsByDate);
  window.clientActiveSubs     = @json($activeSubs);
  window.clientTimezone       = @json($userTimezone);
</script>

<div class="calendar-page-wrapper-light">
  <div class="dashboard-container">
    <main class="main-content">

      {{-- ── Nav client ── --}}
      @include('frontend.client.partials.dashboard-nav')

      {{-- ── Page header (identique à la vue freelance) ── --}}
      <div class="page-header">
        <h1>Mon Agenda</h1>
        <p class="page-subtitle">
          Consultez vos Rituels programmés et réservez de nouveaux créneaux avec vos freelances.
        </p>
      </div>

      {{-- ── Contenu principal ── --}}
      <div class="calendar-content" data-calendar-root>

        {{-- Section Sessions (= "Disponibilités" côté freelance) --}}
        <div class="availability-section">
          <div class="section-header">
            <div>
              <h2 class="section-title">Rituels programmés</h2>
              <p class="section-description">
                Vos sessions à venir semaine par semaine. Cliquez sur une session pour la reprogrammer.
              </p>
            </div>
            <div class="section-actions">
              <a href="{{ route('user.settings.agenda') }}" class="timezone-chip" data-week-timezone aria-label="Modifier le fuseau horaire" title="Cliquez pour modifier votre fuseau horaire">Fuseau : —</a>
            </div>
          </div>

          <div class="week-controls">
            <button type="button" class="btn-ghost" data-week-nav="prev" aria-label="Semaine précédente">⟵</button>
            <div class="week-label">
              <div class="week-range" data-week-range>Semaine en cours</div>
              <div class="week-sub" data-week-sub>Synchronisé en temps réel</div>
            </div>
            <button type="button" class="btn-ghost" data-week-nav="next" aria-label="Semaine suivante">⟶</button>
          </div>

          <div class="calendar-grid" data-calendar-grid></div>

          <div class="calendar-empty" data-empty-state>
            <div class="empty-illustration">✨</div>
            <div class="empty-title">Aucun Rituel cette semaine</div>
            <div class="empty-sub">Programmez votre prochain Rituel avec l'un de vos freelances.</div>
            <button type="button" class="btn-primary" data-open-booking>Programmer un Rituel</button>
          </div>

          <div class="calendar-loader" data-calendar-loader style="display: none;">Chargement...</div>

          <div class="calendar-cta">
            <button class="btn-primary" type="button" data-open-booking>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
              </svg>
              Programmer un Rituel
            </button>
          </div>
        </div>

        {{-- Section Rituels actifs (= "Visio" côté freelance) --}}
        <div class="visio-section">
          <div class="visio-header">
            <div class="visio-icon">🔥</div>
            <div>
              <h2 class="visio-title">Rituels actifs</h2>
              <p class="visio-description">
                Vos abonnements en cours. Cliquez sur un freelance pour programmer vos prochains créneaux directement dans son agenda.
              </p>
            </div>
          </div>

          @if($subscriptions->count() > 0)
            <div style="display:flex;flex-direction:column;gap:12px;margin-top:1.5rem;">
              @foreach($subscriptions as $sub)
                @php
                  $fl     = optional(optional($sub->freelancer)->user);
                  $flId   = optional($sub->freelancer)->id;
                  $flName = trim(($fl->first_name ?? '') . ' ' . ($fl->last_name ?? ''));
                  if (empty(trim($flName))) $flName = $fl->name ?? 'Freelance';
                  $hrs    = number_format($sub->calculated_hours_remaining ?? $sub->hours_remaining ?? 0, 1);
                  $isAct  = $sub->status === 'active';
                @endphp
                <a href="{{ $flId ? route('freelance.booking', $flId) : route('client.subscriptions.show', $sub->id) }}"
                   style="display:flex;align-items:center;gap:14px;padding:14px 18px;background:white;border:1.5px solid #E5E7EB;border-radius:16px;text-decoration:none;color:inherit;transition:all 0.2s;"
                   onmouseover="this.style.borderColor='#3B82F6';this.style.boxShadow='0 8px 24px rgba(59,130,246,0.15)';this.style.transform='translateY(-2px)';"
                   onmouseout="this.style.borderColor='#E5E7EB';this.style.boxShadow='none';this.style.transform='translateY(0)';">
                  @if($fl->image ?? false)
                    <img src="{{ asset('assets/img/users/'.$fl->image) }}" alt="{{ $flName }}"
                         style="width:46px;height:46px;border-radius:50%;object-fit:cover;flex-shrink:0;"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div style="display:none;width:46px;height:46px;border-radius:50%;background:linear-gradient(135deg,#3B82F6,#8B5CF6);color:white;font-size:18px;font-weight:700;align-items:center;justify-content:center;flex-shrink:0;">{{ strtoupper(substr($flName,0,1)) }}</div>
                  @else
                    <div style="width:46px;height:46px;border-radius:50%;background:linear-gradient(135deg,#3B82F6,#8B5CF6);color:white;font-size:18px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;">{{ strtoupper(substr($flName,0,1)) }}</div>
                  @endif
                  <div style="flex:1;min-width:0;">
                    <div style="font-size:15px;font-weight:700;color:#111827;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $flName }}</div>
                    <div style="font-size:13px;color:#6B7280;margin-top:2px;">
                      <strong style="color:{{ $isAct ? '#3B82F6' : '#F59E0B' }};">{{ $hrs }}h</strong> restante{{ $hrs != 1 ? 's' : '' }} ·
                      <span style="color:{{ $isAct ? '#10B981' : '#F59E0B' }};font-weight:600;">{{ $isAct ? 'Actif' : 'En pause' }}</span>
                    </div>
                  </div>
                  <div style="background:linear-gradient(135deg,#3B82F6,#8B5CF6);color:white;border-radius:10px;padding:8px 16px;font-size:13px;font-weight:700;white-space:nowrap;flex-shrink:0;box-shadow:0 4px 12px rgba(59,130,246,0.3);">
                    <i class="fas fa-calendar-plus" style="margin-right:4px;"></i> Programmer
                  </div>
                </a>
              @endforeach
            </div>
          @else
            <div style="margin-top:1.5rem;padding:1.5rem;text-align:center;background:#F8FAFC;border-radius:16px;border:1px dashed #E2E8F0;">
              <p style="color:#64748B;margin:0 0 1rem;">Vous n'avez pas encore d'abonnement actif.</p>
              <a href="{{ route('explore') }}" class="btn-primary" style="text-decoration:none;">Trouver un freelance</a>
            </div>
          @endif
        </div>

        {{-- Toast stack --}}
        <div class="toast-stack" data-toast-stack></div>

      </div>{{-- /calendar-content --}}
    </main>
  </div>
</div>

{{-- Modale "Programmer un Rituel" (= modale "Ajouter un créneau" côté freelance) --}}
<div id="booking-modal" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,0.45);align-items:center;justify-content:center;padding:1rem;z-index:1200;">
  <div style="background:white;border-radius:20px;padding:1.5rem;width:min(480px,100%);box-shadow:0 20px 60px rgba(0,0,0,0.15);">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
      <div>
        <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#94A3B8;">Rituels</div>
        <h3 style="margin:0;font-size:1.4rem;color:#1E293B;">Choisir un Rituel</h3>
      </div>
      <button type="button" id="booking-modal-close" style="background:transparent;border:none;font-size:1.2rem;cursor:pointer;color:#94A3B8;">✕</button>
    </div>
    <div id="booking-modal-list" style="display:flex;flex-direction:column;gap:10px;"></div>
    <div id="booking-modal-empty" style="display:none;padding:1.5rem;text-align:center;">
      <p style="color:#64748B;margin:0 0 1rem;">Aucun abonnement actif.</p>
      <a href="{{ route('explore') }}" style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#3B82F6,#8B5CF6);color:white;border-radius:12px;padding:12px 24px;font-weight:700;text-decoration:none;">Trouver un freelance</a>
    </div>
  </div>
</div>

<style>
  /* ===== RESET ET VARIABLES (= calendar-page-wrapper-light freelance) ===== */
  .calendar-page-wrapper-light {
    --bg-primary: #FFFFFF;
    --bg-secondary: #F8FAFC;
    --bg-card: #FFFFFF;
    --text-primary: #1E293B;
    --text-secondary: #64748B;
    --text-tertiary: #94A3B8;
    --primary: #3B82F6;
    --primary-light: #60A5FA;
    --accent: #8B5CF6;
    --border: #E2E8F0;
    --border-light: #F1F5F9;
    --success: #10B981;
    --warning: #F59E0B;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
    --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05);
    --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.05);
    --radius-sm: 8px; --radius-md: 12px; --radius-lg: 16px;
    --radius-xl: 20px; --radius-2xl: 24px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #F8FAFC 0%, #FFFFFF 100%);
    color: var(--text-primary);
    line-height: 1.5;
    position: relative;
    width: 100%;
    overflow-x: clip;
    padding: 0 10px !important;
    box-sizing: border-box;
  }
  .calendar-page-wrapper-light * { box-sizing: border-box; }
  .calendar-page-wrapper-light .dashboard-container {
    display: block !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    background: transparent;
  }
  .calendar-page-wrapper-light .main-content {
    padding: 2rem 0 !important;
    background: transparent;
    max-width: 100% !important;
    width: 100% !important;
    display: flex;
    flex-direction: column;
  }

  /* ===== HEADER (identique freelance) ===== */
  .calendar-page-wrapper-light .page-header {
    margin-bottom: 4rem;
    padding-bottom: 2rem;
    border-bottom: 2.5px solid rgba(59,130,246,0.2);
    text-align: center;
    position: relative;
  }
  .calendar-page-wrapper-light .page-header::after {
    content: ''; position: absolute; bottom: -2.5px; left: 50%; transform: translateX(-50%);
    width: 120px; height: 4px;
    background: linear-gradient(90deg,#3B82F6 0%,#60A5FA 50%,#8B5CF6 100%);
    border-radius: 2px; box-shadow: 0 8px 20px rgba(59,130,246,0.3);
  }
  .calendar-page-wrapper-light .page-header h1 {
    font-size: 3rem !important;
    font-weight: 900;
    margin-bottom: 1rem;
    background: linear-gradient(135deg,#1e40af 0%,#3B82F6 50%,#8B5CF6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.03em;
  }
  .calendar-page-wrapper-light .page-subtitle {
    color: var(--text-secondary);
    font-size: 1.25rem;
    line-height: 1.75;
    font-weight: 500;
  }

  /* ===== LAYOUT CONTENU ===== */
  .calendar-page-wrapper-light .calendar-content {
    width: 100% !important;
    display: flex; flex-direction: column; gap: 2rem;
    padding: 0 !important; margin: 0 !important;
  }

  /* ===== SECTION DISPONIBILITÉS ULTRA PREMIUM (= sessions client) ===== */
  .calendar-page-wrapper-light .availability-section {
    background: linear-gradient(135deg,#ffffff 0%,#f0f9ff 50%,#f8fafc 100%);
    border: 2.5px solid rgba(59,130,246,0.25);
    box-shadow: 0 32px 80px rgba(59,130,246,0.2), 0 12px 32px rgba(59,130,246,0.12), inset 0 1px 0 rgba(255,255,255,0.8);
    border-radius: 32px; padding: 2.5rem;
    width: 100% !important; transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
  }
  .calendar-page-wrapper-light .availability-section:hover {
    box-shadow: 0 40px 100px rgba(59,130,246,0.3), 0 16px 48px rgba(59,130,246,0.18);
    border-color: rgba(59,130,246,0.4);
  }
  .calendar-page-wrapper-light .section-header {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;
  }
  .calendar-page-wrapper-light .section-title {
    font-size: 1.5rem; font-weight: 900; color: var(--text-primary);
    margin-bottom: 0.5rem; letter-spacing: -0.03em;
  }
  .calendar-page-wrapper-light .section-description {
    color: var(--text-secondary); margin-bottom: 0; line-height: 1.6; font-size: 1rem; font-weight: 500;
  }
  .calendar-page-wrapper-light .section-actions { display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap; }
  .calendar-page-wrapper-light .timezone-chip {
    display: inline-flex; align-items: center; gap: 0.35rem;
    padding: 0.5rem 0.75rem; border-radius: var(--radius-md);
    background: var(--bg-secondary); border: 1px solid var(--border);
    color: var(--text-secondary); font-size: 0.9rem; cursor: pointer;
    text-decoration: none; transition: all 0.2s ease;
  }
  .calendar-page-wrapper-light .timezone-chip:hover {
    background: #EFF6FF; border-color: var(--primary-light);
    color: var(--primary); text-decoration: none;
  }

  /* ===== BOUTONS ===== */
  .calendar-page-wrapper-light .btn-primary {
    background: linear-gradient(135deg,#3B82F6 0%,#60A5FA 100%);
    color: white; border: none; padding: 1rem 2rem; border-radius: 32px;
    font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 0.75rem;
    transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1); font-size: 1rem; text-decoration: none;
    box-shadow: 0 12px 32px rgba(59,130,246,0.3); letter-spacing: -0.02em;
  }
  .calendar-page-wrapper-light .btn-primary:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 20px 48px rgba(59,130,246,0.4); color: white; text-decoration: none; }
  .calendar-page-wrapper-light .btn-ghost {
    background: transparent; color: var(--text-primary); border: 1px solid var(--border);
    padding: 0.65rem 0.9rem; border-radius: var(--radius-md); font-weight: 600; cursor: pointer;
    transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; gap: 0.35rem; text-decoration: none;
  }
  .calendar-page-wrapper-light .btn-ghost:hover { color: var(--primary); border-color: var(--primary-light); box-shadow: var(--shadow-sm); }

  /* ===== WEEK CONTROLS ===== */
  .calendar-page-wrapper-light .week-controls {
    display: flex; align-items: center; justify-content: space-between; gap: 1rem;
    padding: 0.85rem 1rem; border: 1px solid var(--border);
    border-radius: var(--radius-lg); background: var(--bg-primary); box-shadow: var(--shadow-sm);
  }
  .calendar-page-wrapper-light .week-label { display: flex; flex-direction: column; align-items: center; gap: 0.25rem; text-align: center; }
  .calendar-page-wrapper-light .week-range { font-weight: 700; color: var(--text-primary); }
  .calendar-page-wrapper-light .week-sub { font-size: 0.9rem; color: var(--text-tertiary); }

  /* ===== GRILLE CALENDRIER (identique freelance) ===== */
  .calendar-page-wrapper-light .calendar-grid {
    display: grid; grid-template-columns: repeat(7, minmax(0, 1fr));
    gap: 0.75rem; margin: 1.5rem 0 1rem; width: 100% !important;
    background: radial-gradient(circle at 10% 10%,rgba(59,130,246,0.08),transparent 28%), radial-gradient(circle at 90% 15%,rgba(139,92,246,0.1),transparent 32%);
    padding: 0.5rem; border-radius: var(--radius-lg);
  }
  .calendar-page-wrapper-light .calendar-day {
    background: linear-gradient(160deg,rgba(255,255,255,0.92) 0%,rgba(247,250,255,0.96) 100%);
    border: 1px solid rgba(59,130,246,0.18); border-radius: var(--radius-lg);
    padding: 1.1rem; display: flex; flex-direction: column; gap: 0.5rem;
    box-shadow: 0 18px 45px rgba(17,24,39,0.08); min-height: 180px; position: relative;
  }
  .calendar-page-wrapper-light .calendar-day.today { border: 1px solid var(--primary); box-shadow: 0 20px 50px rgba(59,130,246,0.18); }
  .calendar-page-wrapper-light .calendar-day::after {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(circle at 75% 20%,rgba(59,130,246,0.12),transparent 40%); pointer-events: none;
  }
  .calendar-page-wrapper-light .day-head { display: flex; align-items: center; justify-content: space-between; gap: 0.5rem; }
  .calendar-page-wrapper-light .day-name { font-weight: 600; color: var(--text-tertiary); text-transform: uppercase; font-size: 0.85rem; }
  .calendar-page-wrapper-light .day-number { font-size: 1.4rem; font-weight: 700; color: var(--text-primary); }
  .calendar-page-wrapper-light .slots-stack {
    display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.35rem;
    flex: 1; min-height: 0; overflow-y: auto; overflow-x: hidden; padding-right: 0.25rem;
  }
  .calendar-page-wrapper-light .slots-stack::-webkit-scrollbar { width: 6px; }
  .calendar-page-wrapper-light .slots-stack::-webkit-scrollbar-thumb { background: rgba(59,130,246,0.3); border-radius: 3px; }

  /* Pill session (adaptation du slot-pill freelance) */
  .calendar-page-wrapper-light .slot-pill {
    display: flex; align-items: center; justify-content: space-between; gap: 0.5rem;
    padding: 0.65rem 0.8rem; border-radius: var(--radius-md); border: 1.5px solid var(--border);
    background: var(--bg-secondary); cursor: pointer; transition: all 0.2s ease;
    flex-shrink: 0; min-height: 40px; text-decoration: none; color: inherit;
  }
  .calendar-page-wrapper-light .slot-pill:hover {
    transform: translateY(-2px); box-shadow: 0 8px 16px rgba(59,130,246,0.15);
    border-color: var(--primary-light); background: rgba(255,255,255,0.8); text-decoration: none; color: inherit;
  }
  .calendar-page-wrapper-light .slot-pill .slot-time { font-weight: 700; color: var(--text-primary); font-size: 0.92rem; flex: 0 0 auto; }
  .calendar-page-wrapper-light .slot-pill .slot-meta { font-size: 0.82rem; color: var(--text-tertiary); font-weight: 600; text-align: right; flex: 0 0 auto; }
  .calendar-page-wrapper-light .slot-pill.status-confirmed { border-color: rgba(16,185,129,0.4); background: rgba(16,185,129,0.1); }
  .calendar-page-wrapper-light .slot-pill.status-confirmed:hover { border-color: rgba(16,185,129,0.6); box-shadow: 0 8px 16px rgba(16,185,129,0.2); }
  .calendar-page-wrapper-light .slot-pill.status-pending   { border-color: rgba(245,158,11,0.4); background: rgba(245,158,11,0.1); }
  .calendar-page-wrapper-light .slot-pill.status-completed { border-color: rgba(148,163,184,0.5); background: rgba(148,163,184,0.12); color:#475569; }
  .calendar-page-wrapper-light .slot-empty {
    color: var(--text-tertiary); font-size: 0.9rem;
    border: 1px dashed var(--border); border-radius: var(--radius-md);
    padding: 0.65rem 0.75rem; background: var(--bg-secondary);
  }

  /* Empty state */
  .calendar-page-wrapper-light .calendar-empty {
    text-align: center; border: 1px dashed var(--border); border-radius: var(--radius-lg);
    padding: 1.5rem; background: var(--bg-primary); box-shadow: var(--shadow-sm);
  }
  .calendar-page-wrapper-light .calendar-empty .empty-illustration { font-size: 2rem; margin-bottom: 0.5rem; }
  .calendar-page-wrapper-light .calendar-empty .empty-title { font-weight: 700; color: var(--text-primary); margin-bottom: 0.25rem; }
  .calendar-page-wrapper-light .calendar-empty .empty-sub  { color: var(--text-secondary); margin-bottom: 1rem; }
  .calendar-page-wrapper-light .calendar-cta { text-align: center; margin-top: 1.5rem; }

  /* ===== SECTION VISIO (Rituels actifs) - identique freelance ===== */
  .calendar-page-wrapper-light .visio-section {
    background: linear-gradient(135deg,#ffffff 0%,#fef3f2 50%,#f8fafc 100%);
    border: 2.5px solid rgba(30,64,175,0.25);
    box-shadow: 0 32px 80px rgba(30,64,175,0.2), 0 12px 32px rgba(30,64,175,0.12), inset 0 1px 0 rgba(255,255,255,0.8);
    border-radius: 32px; padding: 2.5rem; width: 100% !important;
    transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
  }
  .calendar-page-wrapper-light .visio-section:hover {
    box-shadow: 0 40px 100px rgba(30,64,175,0.3);
    border-color: rgba(30,64,175,0.4);
  }
  .calendar-page-wrapper-light .visio-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem; }
  .calendar-page-wrapper-light .visio-icon {
    width: 72px; height: 72px;
    background: linear-gradient(135deg,rgba(30,64,175,0.15) 0%,rgba(30,64,175,0.08) 100%);
    border-radius: 24px; display: flex; align-items: center; justify-content: center;
    color: #1e40af; font-size: 2rem; flex-shrink: 0; box-shadow: 0 12px 32px rgba(30,64,175,0.2);
  }
  .calendar-page-wrapper-light .visio-title { font-size: 1.35rem; font-weight: 900; color: var(--text-primary); margin-bottom: 0.5rem; letter-spacing: -0.03em; }
  .calendar-page-wrapper-light .visio-description { color: var(--text-secondary); line-height: 1.8; margin-bottom: 0; font-size: 1rem; font-weight: 500; }

  /* ===== TOASTS ===== */
  .toast-stack { position: fixed; top: 1rem; right: 1rem; display: flex; flex-direction: column; gap: 0.75rem; z-index: 1300; }
  .toast { background: var(--bg-primary); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 0.75rem 1rem; box-shadow: var(--shadow-lg); display: flex; align-items: center; gap: 0.5rem; min-width: 260px; }
  .toast.success { border-color: rgba(16,185,129,0.4); }
  .toast.error   { border-color: rgba(239,68,68,0.4); }
  .toast .toast-title { font-weight: 700; font-size: 0.95rem; }
  .toast .toast-text  { font-size: 0.9rem; color: var(--text-secondary); }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 1200px) { .calendar-page-wrapper-light .calendar-grid { grid-template-columns: repeat(4, 1fr); } }
  @media (max-width: 1024px) {
    .calendar-page-wrapper-light .calendar-grid { grid-template-columns: repeat(2, 1fr); }
    .calendar-page-wrapper-light .section-header { flex-direction: column; align-items: flex-start; }
    .calendar-page-wrapper-light .visio-header { flex-direction: column; align-items: flex-start; }
    .calendar-page-wrapper-light .page-header h1 { font-size: 2rem !important; }
  }
  @media (max-width: 480px) {
    .calendar-page-wrapper-light .calendar-grid { grid-template-columns: 1fr; }
    .calendar-page-wrapper-light .page-header h1 { font-size: 1.5rem !important; }
  }
</style>

<script>
(() => {
  const root = document.querySelector('[data-calendar-root]');
  if (!root) return;

  const grid        = root.querySelector('[data-calendar-grid]');
  const weekRangeEl = root.querySelector('[data-week-range]');
  const weekSubEl   = root.querySelector('[data-week-sub]');
  const timezoneChip = root.querySelector('[data-week-timezone]');
  const emptyState  = root.querySelector('[data-empty-state]');
  const ctaSection  = root.querySelector('.calendar-cta');
  const toastStack  = root.querySelector('[data-toast-stack]');

  // Données PHP injectées (comme loadWeek() côté freelance)
  const allSessions = window.clientAgendaSessions || {};
  const activeSubs  = window.clientActiveSubs     || [];

  const state = {
    timezone: window.clientTimezone || Intl.DateTimeFormat().resolvedOptions().timeZone || 'Europe/Paris',
    weekStart: startOfWeek(new Date()),
  };

  const dayLabels = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];

  /* ── Helpers date (identiques à la version freelance) ── */
  function startOfWeek(date) {
    const d = new Date(date);
    const day = d.getDay();
    const diff = day === 0 ? -6 : 1 - day;
    d.setHours(0, 0, 0, 0);
    d.setDate(d.getDate() + diff);
    return d;
  }
  function addDays(date, days) { const d = new Date(date); d.setDate(d.getDate() + days); return d; }
  function formatDateKey(date) {
    return `${date.getFullYear()}-${String(date.getMonth()+1).padStart(2,'0')}-${String(date.getDate()).padStart(2,'0')}`;
  }
  function formatRangeLabel(start, end) {
    const opts = { day: '2-digit', month: 'short' };
    return `${start.toLocaleDateString('fr-FR', opts)} – ${end.toLocaleDateString('fr-FR', opts)}`;
  }
  function isToday(date) {
    const t = new Date();
    return date.getFullYear() === t.getFullYear() && date.getMonth() === t.getMonth() && date.getDate() === t.getDate();
  }

  /* ── Rendu semaine (= renderWeek() côté freelance) ── */
  function renderWeek() {
    if (!grid) return;
    grid.innerHTML = '';

    const weekEnd = addDays(state.weekStart, 6);
    if (weekRangeEl) weekRangeEl.textContent = formatRangeLabel(state.weekStart, weekEnd);
    if (timezoneChip) timezoneChip.textContent = `⏱ ${state.timezone}`;

    let totalSessions = 0;

    for (let i = 0; i < 7; i++) {
      const dayDate = addDays(state.weekStart, i);
      const dateKey = formatDateKey(dayDate);
      const sessions = allSessions[dateKey] || [];
      totalSessions += sessions.length;

      const card = document.createElement('div');
      card.className = 'calendar-day' + (isToday(dayDate) ? ' today' : '');

      const head = document.createElement('div');
      head.className = 'day-head';
      head.innerHTML = `<div><div class="day-name">${dayLabels[dayDate.getDay()]}</div><div class="day-number">${dayDate.getDate()}</div></div>`;
      card.appendChild(head);

      const stack = document.createElement('div');
      stack.className = 'slots-stack';

      if (sessions.length === 0) {
        const empty = document.createElement('div');
        empty.className = 'slot-empty';
        empty.textContent = 'Aucun Rituel';
        stack.appendChild(empty);
      } else {
        sessions.forEach(sess => {
          const pill = document.createElement('a');
          pill.className = `slot-pill status-${sess.status || 'confirmed'}`;
          // Lien vers la page booking du freelance (= page planning que le client connaît)
          pill.href = sess.freelancer_id
            ? `/freelance/${sess.freelancer_id}/booking`
            : (sess.subscription_id ? `/user/account/subscriptions/${sess.subscription_id}` : '#');
          pill.innerHTML = `
            <div class="slot-time">${sess.start_time} – ${sess.end_time}</div>
            <div class="slot-meta">${sess.freelancer_name || ''}</div>
          `;
          stack.appendChild(pill);
        });
      }

      card.appendChild(stack);
      grid.appendChild(card);
    }

    if (weekSubEl)   weekSubEl.textContent   = `${totalSessions} Rituel${totalSessions > 1 ? 's' : ''}`;
    if (emptyState)  emptyState.style.display = totalSessions === 0 ? 'block' : 'none';
    if (ctaSection)  ctaSection.style.display  = totalSessions === 0 ? 'none'  : 'block';
  }

  /* ── Modale "Programmer" (= modale "Ajouter créneau" côté freelance) ── */
  const bookingModal     = document.getElementById('booking-modal');
  const bookingModalList = document.getElementById('booking-modal-list');
  const bookingModalEmpty= document.getElementById('booking-modal-empty');
  const bookingModalClose= document.getElementById('booking-modal-close');

  function openBookingModal() {
    if (!bookingModal) return;
    bookingModalList.innerHTML = '';

    if (activeSubs.length === 0) {
      bookingModalEmpty.style.display = 'block';
      bookingModalList.style.display  = 'none';
    } else {
      bookingModalEmpty.style.display = 'none';
      bookingModalList.style.display  = 'flex';
      activeSubs.forEach(sub => {
        const el = document.createElement('a');
        el.href  = sub.freelancer_id ? `/freelance/${sub.freelancer_id}/booking` : '#';
        el.style.cssText = 'display:flex;align-items:center;gap:12px;padding:12px 16px;background:#F8FAFC;border:1.5px solid #E2E8F0;border-radius:14px;text-decoration:none;color:inherit;transition:all 0.2s;';
        el.onmouseover = () => { el.style.borderColor='#3B82F6'; el.style.background='#EFF6FF'; };
        el.onmouseout  = () => { el.style.borderColor='#E2E8F0'; el.style.background='#F8FAFC'; };
        const initials = (sub.name || 'F')[0].toUpperCase();
        el.innerHTML = `
          <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#3B82F6,#8B5CF6);color:white;font-size:16px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;">${initials}</div>
          <div style="flex:1;min-width:0;">
            <div style="font-weight:700;color:#1E293B;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${sub.name}</div>
            <div style="font-size:12px;color:#64748B;">${sub.hours_left}h restante(s)</div>
          </div>
          <div style="background:linear-gradient(135deg,#3B82F6,#8B5CF6);color:white;border-radius:8px;padding:6px 12px;font-size:12px;font-weight:700;white-space:nowrap;flex-shrink:0;">Programmer →</div>
        `;
        bookingModalList.appendChild(el);
      });
    }
    bookingModal.style.display = 'flex';
  }
  function closeBookingModal() { if (bookingModal) bookingModal.style.display = 'none'; }

  /* ── Bindings (= bindEvents() côté freelance) ── */
  root.querySelectorAll('[data-open-booking]').forEach(btn => btn.addEventListener('click', openBookingModal));
  if (bookingModalClose) bookingModalClose.addEventListener('click', closeBookingModal);
  if (bookingModal) bookingModal.addEventListener('click', e => { if (e.target === bookingModal) closeBookingModal(); });

  const prev = root.querySelector('[data-week-nav="prev"]');
  const next = root.querySelector('[data-week-nav="next"]');
  if (prev) prev.addEventListener('click', () => { state.weekStart = addDays(state.weekStart, -7); renderWeek(); });
  if (next) next.addEventListener('click', () => { state.weekStart = addDays(state.weekStart, 7);  renderWeek(); });

  /* ── Init ── */
  renderWeek();
})();
</script>

@endsection
