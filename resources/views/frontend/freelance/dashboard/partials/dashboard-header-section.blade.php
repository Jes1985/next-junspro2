{{-- Hero Premium Freelance — Countdown Rituel ultra-lux --}}
@php
  $flFirstName     = isset($user) && $user->first_name ? $user->first_name : 'Freelance';
  $flNextSession   = $nextSession ?? null;
  $flSessionType   = $nextSessionType ?? null; // 'worksession' | 'availability' | null

  // Nom du client : uniquement pour les WorkSessions
  if ($flSessionType === 'worksession') {
    $flClientName = $flNextSession?->subscription?->client?->user?->first_name ?? null;
    $flSessionLabel = $flClientName ? "Avec : {$flClientName}" : 'Session confirmée';
  } elseif ($flSessionType === 'availability') {
    $flClientName   = null;
    $flSessionLabel = 'Créneau personnel planifié';
  } else {
    $flClientName   = null;
    $flSessionLabel = '';
  }
@endphp

<style>
/* ===== HERO FREELANCE — ULTRA-LUX v2 ===== */
.fl-hero {
  position: relative;
  background: linear-gradient(135deg, #3b0764 0%, #4c1d95 40%, #7c3aed 75%, #a855f7 100%);
  border-radius: 36px;
  padding: 3rem 3.5rem;
  margin: 0 0 2rem;
  overflow: hidden;
  box-shadow:
    0 40px 100px rgba(76,29,149,.45),
    0 0 0 1px rgba(255,255,255,.08) inset;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2.5rem;
  flex-wrap: wrap;
}
/* ── Orbes ── */
.fl-hero::before {
  content:'';
  position:absolute;
  top:-80px; left:-60px;
  width:380px; height:380px;
  background: radial-gradient(circle, rgba(255,255,255,.09) 0%, transparent 65%);
  border-radius:50%;
  pointer-events:none;
}
.fl-hero::after {
  content:'';
  position:absolute;
  bottom:-120px; right:-80px;
  width:520px; height:520px;
  background: radial-gradient(circle, rgba(168,85,247,.18) 0%, transparent 65%);
  border-radius:50%;
  pointer-events:none;
}
/* ── Dots déco ── */
.fl-hero-dots {
  position:absolute;
  top:18px; right:360px;
  display:grid;
  grid-template-columns: repeat(5,8px);
  gap:7px;
  opacity:.15;
  pointer-events:none;
  z-index:1;
}
.fl-hero-dots span {
  width:4px; height:4px;
  background:#fff;
  border-radius:50%;
  display:block;
}
/* ── Zone gauche ── */
.fl-hero-left { flex:1; min-width:240px; position:relative; z-index:2; }
.fl-hero-eyebrow {
  display:inline-flex;
  align-items:center;
  gap:.4rem;
  background:rgba(255,255,255,.1);
  border:1px solid rgba(255,255,255,.2);
  border-radius:999px;
  padding:.28rem .9rem;
  font-size:.72rem;
  font-weight:700;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:rgba(255,255,255,.85);
  margin-bottom:1rem;
}
.fl-hero-eyebrow-dot {
  width:6px; height:6px;
  background:#a78bfa;
  border-radius:50%;
}
.fl-hero-greeting {
  font-size:2.8rem;
  font-weight:900;
  letter-spacing:-.035em;
  line-height:1.08;
  margin:0 0 .6rem;
  color:#fff;
  text-shadow: 0 2px 24px rgba(0,0,0,.2);
}
.fl-hero-sub {
  font-size:1.05rem;
  color:rgba(255,255,255,.72);
  margin:0 0 1.8rem;
  font-weight:400;
  line-height:1.5;
}
.fl-hero-ctas { display:flex; gap:.75rem; flex-wrap:wrap; align-items:center; }
/* Bouton primaire */
.fl-btn-main {
  display:inline-flex; align-items:center; gap:.45rem;
  background:#fff; color:#6d28d9;
  border:none; border-radius:14px;
  padding:.7rem 1.6rem;
  font-size:.9rem; font-weight:800;
  text-decoration:none;
  box-shadow:0 8px 24px rgba(0,0,0,.2);
  transition:all .25s cubic-bezier(.34,1.56,.64,1);
  position:relative; overflow:hidden;
}
.fl-btn-main::after {
  content:''; position:absolute; inset:0;
  background:linear-gradient(120deg, transparent 30%, rgba(255,255,255,.4) 50%, transparent 70%);
  transform:translateX(-100%); transition:transform .45s ease;
}
.fl-btn-main:hover { transform:translateY(-3px); box-shadow:0 16px 36px rgba(0,0,0,.28); color:#5b21b6; text-decoration:none; }
.fl-btn-main:hover::after { transform:translateX(100%); }
/* Bouton ghost */
.fl-btn-ghost {
  display:inline-flex; align-items:center; gap:.45rem;
  background:rgba(255,255,255,.12); color:#fff;
  border:1.5px solid rgba(255,255,255,.28);
  border-radius:14px; padding:.68rem 1.4rem;
  font-size:.88rem; font-weight:700;
  text-decoration:none;
  backdrop-filter:blur(10px);
  transition:all .22s ease;
}
.fl-btn-ghost:hover { background:rgba(255,255,255,.22); border-color:rgba(255,255,255,.5); color:#fff; transform:translateY(-2px); text-decoration:none; }

/* ── Widget countdown (carte droite) ── */
.fl-ritual-widget {
  flex-shrink:0;
  width:300px;
  background:rgba(255,255,255,.1);
  backdrop-filter:blur(24px);
  -webkit-backdrop-filter:blur(24px);
  border:1px solid rgba(255,255,255,.18);
  border-radius:24px;
  padding:1.5rem 1.6rem 1.4rem;
  position:relative; z-index:2;
  box-shadow:0 8px 32px rgba(0,0,0,.15), 0 0 0 1px rgba(255,255,255,.06) inset;
}
.fl-ritual-widget::before {
  content:''; position:absolute;
  top:0; left:10%; right:10%; height:1px;
  background:linear-gradient(90deg, transparent, rgba(255,255,255,.45), transparent);
  pointer-events:none;
}
.fl-ritual-status-pill {
  display:inline-flex; align-items:center; gap:6px;
  background:rgba(255,255,255,.15);
  border:1px solid rgba(255,255,255,.22);
  border-radius:999px; padding:4px 12px;
  font-size:.7rem; font-weight:700;
  letter-spacing:.1em; text-transform:uppercase;
  color:rgba(255,255,255,.9); margin-bottom:.9rem;
}
.fl-ritual-status-pill.live {
  background:rgba(16,185,129,.3);
  border-color:rgba(16,185,129,.5);
}
.fl-pill-dot {
  width:7px; height:7px; border-radius:50%;
  background:#4ade80;
  animation: fl-pulse 1.8s ease-in-out infinite;
}
@keyframes fl-pulse {
  0%,100%{box-shadow:0 0 0 0 rgba(74,222,128,.6)}
  50%{box-shadow:0 0 0 6px rgba(74,222,128,0)}
}
.fl-cd-blocks {
  display:flex; align-items:center; gap:5px; margin-bottom:.75rem;
}
.fl-cd-block {
  display:flex; flex-direction:column; align-items:center;
  background:rgba(255,255,255,.13);
  border:1px solid rgba(255,255,255,.18);
  border-radius:12px; padding:9px 13px 7px; min-width:58px;
  transition:background .3s;
}
.fl-cd-val {
  font-size:1.85rem; font-weight:900; color:#fff;
  line-height:1; letter-spacing:-.03em;
  font-variant-numeric:tabular-nums; display:block;
}
.fl-cd-label {
  font-size:.58rem; font-weight:700; letter-spacing:.1em;
  text-transform:uppercase; color:rgba(255,255,255,.55);
  margin-top:3px; display:block;
}
.fl-cd-sep {
  font-size:1.4rem; font-weight:900;
  color:rgba(255,255,255,.35); margin-bottom:12px;
  animation:fl-sep-blink 1s step-end infinite;
}
@keyframes fl-sep-blink{0%,100%{opacity:1}50%{opacity:.15}}
.fl-ritual-progress-row {
  display:flex; align-items:center; justify-content:space-between;
  gap:.5rem; margin-bottom:.6rem;
}
.fl-ritual-progress-bar {
  flex:1; height:3px;
  background:rgba(255,255,255,.15);
  border-radius:99px; overflow:hidden;
}
.fl-ritual-progress-fill {
  height:100%;
  background:linear-gradient(90deg,rgba(255,255,255,.4),white);
  border-radius:99px; transition:width .5s ease;
}
.fl-ritual-progress-label {
  font-size:.7rem; color:rgba(255,255,255,.5); white-space:nowrap;
}
.fl-ritual-notif-btn {
  width:100%; padding:.5rem;
  border-radius:12px;
  border:1.5px solid rgba(255,255,255,.25);
  background:rgba(255,255,255,.1);
  color:rgba(255,255,255,.9);
  font-size:.8rem; font-weight:700;
  cursor:pointer;
  display:flex; align-items:center; justify-content:center; gap:.4rem;
  transition:all .22s cubic-bezier(.34,1.56,.64,1);
  margin-top:.35rem;
}
.fl-ritual-notif-btn:hover { background:rgba(255,255,255,.2); border-color:rgba(255,255,255,.45); transform:translateY(-1px); }
.fl-ritual-notif-btn.granted { background:rgba(74,222,128,.18); border-color:rgba(74,222,128,.4); color:#bbf7d0; pointer-events:none; }
.fl-ritual-notif-btn .bell-icon { display:inline-block; transition:transform .3s; }
.fl-ritual-notif-btn.ringing .bell-icon { animation:fl-bell-ring .5s ease-in-out 2; }
@keyframes fl-bell-ring{0%,100%{transform:rotate(0)}20%{transform:rotate(-20deg)}60%{transform:rotate(16deg)}80%{transform:rotate(-10deg)}}
.fl-cd-block.urgent { background:rgba(251,191,36,.22); border-color:rgba(251,191,36,.4); }
.fl-cd-block.critical { background:rgba(239,68,68,.25); border-color:rgba(239,68,68,.5); animation:fl-flash .6s ease-in-out infinite; }
@keyframes fl-flash{0%,100%{opacity:1}50%{opacity:.65}}
.fl-no-session {
  font-size:.85rem; color:rgba(255,255,255,.65);
  font-style:italic; margin:.4rem 0 .8rem;
}
.fl-hint { font-size:.72rem; color:rgba(255,255,255,.5); margin-top:.85rem; }
@media(max-width:768px){
  .fl-hero { padding:2rem 1.5rem; flex-direction:column; }
  .fl-ritual-widget { width:100%; max-width:360px; }
  .fl-hero-greeting { font-size:2.1rem; }
}
</style>

<div class="fl-hero">
  {{-- Dots déco --}}
  <div class="fl-hero-dots">
    @for($i=0;$i<25;$i++)<span></span>@endfor
  </div>

  {{-- Gauche : Bonjour + CTA --}}
  <div class="fl-hero-left">
    <div class="fl-hero-eyebrow">
      <span class="fl-hero-eyebrow-dot"></span> Espace freelance
    </div>
    <h1 class="fl-hero-greeting">Bonjour {{ $flFirstName }} !</h1>
    <p class="fl-hero-sub">
      @if($flNextSession)
        Votre prochain Rituel est confirmé — tout est prêt.
      @else
        Gérez vos missions, gardez le rythme, développez votre activité.
      @endif
    </p>
    <div class="fl-hero-ctas">
      <a href="{{ route('freelance.services.create') }}" class="fl-btn-main">
        ✦ Créer un service
      </a>
      @if(isset($freelancerProfile) && $freelancerProfile?->id)
        <a href="{{ route('freelance.show', ['id' => $freelancerProfile->id]) }}" target="_blank" class="fl-btn-ghost">
          Voir mon profil →
        </a>
      @endif
    </div>
    <p class="fl-hint">💡 Plus vos informations sont complètes, plus vous remontez dans les résultats.</p>
  </div>

  {{-- Droite : Widget countdown --}}
  <div class="fl-ritual-widget">
    @if($flNextSession)
      @php
        $flStartIso  = \Carbon\Carbon::parse($flNextSession->start_at)->toIso8601String();
        $flStartTime = \Carbon\Carbon::parse($flNextSession->start_at)->format('H:i');
      @endphp

      {{-- Pill status --}}
      <div class="fl-ritual-status-pill" id="fl-status-pill">
        <span class="fl-pill-dot"></span>
        <span id="fl-pill-txt">PROGRAMMÉ</span>
      </div>

      {{-- Blocs countdown --}}
      <div class="fl-cd-blocks">
        <div class="fl-cd-block" id="fl-cd-days" style="display:none">
          <span class="fl-cd-val" id="fl-val-days">00</span>
          <span class="fl-cd-label">JOURS</span>
        </div>
        <span class="fl-cd-sep" id="fl-sep-days" style="display:none">:</span>
        <div class="fl-cd-block" id="fl-cd-hours">
          <span class="fl-cd-val" id="fl-val-hours">00</span>
          <span class="fl-cd-label">HEURES</span>
        </div>
        <span class="fl-cd-sep">:</span>
        <div class="fl-cd-block" id="fl-cd-mins">
          <span class="fl-cd-val" id="fl-val-mins">00</span>
          <span class="fl-cd-label">MIN</span>
        </div>
        <span class="fl-cd-sep">:</span>
        <div class="fl-cd-block" id="fl-cd-secs">
          <span class="fl-cd-val" id="fl-val-secs">00</span>
          <span class="fl-cd-label">SEC</span>
        </div>
      </div>

      {{-- Barre de progression --}}
      <div class="fl-ritual-progress-row">
        <div class="fl-ritual-progress-bar">
          <div class="fl-ritual-progress-fill" id="fl-progress-fill" style="width:0%"></div>
        </div>
        <span class="fl-ritual-progress-label">Démarre à {{ $flStartTime }}</span>
      </div>
      <div style="font-size:.72rem;color:rgba(255,255,255,.6);margin-bottom:.6rem;">{{ $flSessionLabel }}</div>

      {{-- Bouton rappel --}}
      <button class="fl-ritual-notif-btn" id="fl-notif-btn" onclick="flRequestNotif()">
        <span class="bell-icon">🔔</span>
        <span class="fl-notif-txt">Me rappeler 15 min avant</span>
      </button>

      {{-- Injection des variables JS --}}
      <script>
        window.flNextRitualStartAt = @json($flStartIso);
        window.flRitualClientName = @json($flSessionLabel);
      </script>

    @else
      <div class="fl-ritual-status-pill">
        <span class="fl-pill-dot" style="background:#94a3b8;animation:none"></span>
        <span>AUCUN RITUEL</span>
      </div>
      <p class="fl-no-session">Aucun Rituel planifié prochainement.</p>
      <a href="{{ route('freelance.dashboard', ['tab' => 'calendar']) }}" class="fl-btn-ghost" style="margin-top:.8rem;font-size:.78rem;display:inline-flex;">
        Voir l'agenda →
      </a>
    @endif
  </div>
</div>

{{-- Pause Souffle — sous le hero --}}
<div style="margin: 1.5rem 0;">
  @include('frontend.components.pause-souffle.inline-premium')
</div>

{{-- JS Countdown Freelance --}}
@if($flNextSession)
<script>
(function() {
  var targetMs = new Date(window.flNextRitualStartAt).getTime();
  var dayBlock  = document.getElementById('fl-cd-days');
  var daySep    = document.getElementById('fl-sep-days');
  var hBlock    = document.getElementById('fl-cd-hours');
  var mBlock    = document.getElementById('fl-cd-mins');
  var sBlock    = document.getElementById('fl-cd-secs');
  var pill      = document.getElementById('fl-status-pill');
  var pillTxt   = document.getElementById('fl-pill-txt');
  var fill      = document.getElementById('fl-progress-fill');
  var notifBtn  = document.getElementById('fl-notif-btn');

  function pad(n) { return String(Math.max(0, n)).padStart(2, '0'); }

  function hideDaysIfNeeded(diff) {
    if (diff <= 86400000) {
      dayBlock.style.display = 'none';
      daySep.style.display = 'none';
    } else {
      dayBlock.style.display = '';
      daySep.style.display = '';
    }
  }

  function applyUrgency(diff) {
    [hBlock, mBlock, sBlock].forEach(function(b) {
      b.classList.remove('urgent','critical');
    });
    if (diff <= 300000) {
      [hBlock, mBlock, sBlock].forEach(function(b) { b.classList.add('critical'); });
    } else if (diff <= 900000) {
      [hBlock, mBlock, sBlock].forEach(function(b) { b.classList.add('urgent'); });
    }
  }

  function setLive() {
    pill.className = 'fl-ritual-status-pill live';
    pillTxt.textContent = 'EN COURS';
    document.getElementById('fl-val-hours').textContent = '00';
    document.getElementById('fl-val-mins').textContent = '00';
    document.getElementById('fl-val-secs').textContent = '00';
    if (fill) fill.style.width = '100%';
    if (notifBtn) notifBtn.style.display = 'none';
  }

  function setGranted() {
    if (!notifBtn) return;
    notifBtn.classList.add('granted','ringing');
    notifBtn.querySelector('.fl-notif-txt').textContent = 'Rappel activé ✓';
    setTimeout(function() { notifBtn.classList.remove('ringing'); }, 1200);
  }

  function tick() {
    var now  = Date.now();
    var diff = targetMs - now;

    if (diff <= 0) { setLive(); return; }

    var totalWindow = 4 * 3600 * 1000;
    var elapsed = totalWindow - Math.max(0, diff);
    var pct = Math.min(100, Math.round((elapsed / totalWindow) * 100));
    if (fill) fill.style.width = pct + '%';

    var d = Math.floor(diff / 86400000);
    var h = Math.floor((diff % 86400000) / 3600000);
    var m = Math.floor((diff % 3600000) / 60000);
    var s = Math.floor((diff % 60000) / 1000);

    document.getElementById('fl-val-days').textContent  = pad(d);
    document.getElementById('fl-val-hours').textContent = pad(h);
    document.getElementById('fl-val-mins').textContent  = pad(m);
    document.getElementById('fl-val-secs').textContent  = pad(s);

    hideDaysIfNeeded(diff);
    applyUrgency(diff);

    setTimeout(tick, 1000);
  }

  tick();

  // SW notification
  /* ── Notification / Service Worker (version robuste) ── */
  function flFallbackNotif() {
    var delay = (targetMs - 15 * 60000) - Date.now();
    if (delay > 0) setTimeout(function() {
      new Notification('🔔 Rituel dans 15 min', {
        body: 'Votre session "' + (window.flRitualClientName || 'Rituel') + '" commence bientôt !',
        icon: '/assets/img/logo.png'
      });
    }, delay);
    setGranted();
  }

  function flScheduleViaSW() {
    if (!('serviceWorker' in navigator)) { flFallbackNotif(); return; }
    navigator.serviceWorker.register('/sw-ritual.js', { scope: '/' }).then(function(reg) {
      var send = function(r) {
        r.postMessage({
          type: 'SCHEDULE_RITUAL_ALARM',
          startAt: window.flNextRitualStartAt,
          freelancerName: window.flRitualClientName,
          dashboardUrl: '/freelance/dashboard'
        });
      };
      if (reg.active) {
        send(reg.active);
      } else if (reg.installing) {
        reg.installing.addEventListener('statechange', function(e) {
          if (e.target.state === 'activated') send(e.target);
        });
      } else if (reg.waiting) {
        reg.waiting.addEventListener('statechange', function(e) {
          if (e.target.state === 'activated') send(e.target);
        });
      }
      setGranted();
    }).catch(function() { flFallbackNotif(); });
  }

  /* État initial : permission déjà accordée → planifier directement */
  if ('Notification' in window && Notification.permission === 'granted') {
    flScheduleViaSW();
    setGranted();
  }

  /* Bouton "Activer le rappel" */
  window.flRequestNotif = function() {
    if (!('Notification' in window)) {
      alert('Les notifications ne sont pas supportées par votre navigateur.');
      return;
    }
    if (Notification.permission === 'granted') { flScheduleViaSW(); return; }
    Notification.requestPermission().then(function(perm) {
      if (perm === 'granted') flScheduleViaSW();
    });
  };
})();
</script>
@endif

