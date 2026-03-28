{{--
  Difficulty Scorer Widget
  Usage : @include('frontend.mentorship.partials.difficulty-scorer', ['traineeType' => 'student'|'graduate'])
  $traineeType = 'student'  → stagiaire  (taux 10/20/30 % du net)
  $traineeType = 'graduate' → junior     (taux 70/50/30 % du net)
--}}
@php
  use App\Services\Mentorship\DifficultyScoringService;
  $widgetData   = DifficultyScoringService::getWidgetData();
  $widgetId     = 'ds-' . ($traineeType ?? 'student') . '-' . uniqid();
  $isJunior     = ($traineeType ?? 'student') === 'graduate';
  $accentColor  = $isJunior ? '#2563eb' : '#0d9488';
  $accentLight  = $isJunior ? '#eff6ff' : '#f0fdfa';
  $trLabel      = $isJunior ? 'Freelance Junior' : 'Stagiaire';
  $totalSteps   = count($widgetData['criteria']) + 1; // +1 pour la question bonus deal-bringer
@endphp

<style>
/* ── Scorer container ──────────────────────────────────────── */
.ds-wrap {
  background: #fff;
  border-radius: 24px;
  box-shadow: 0 8px 48px rgba(0,0,0,.08);
  overflow: hidden;
  max-width: 820px;
  margin: 2.5rem auto 0;
  font-family: inherit;
}

/* Header */
.ds-header {
  background: linear-gradient(135deg, #0f172a, {{ $isJunior ? '#1e1b4b' : '#134e4a' }});
  padding: 2rem 2.5rem 1.5rem;
  color: #fff;
}
.ds-header__eyebrow {
  font-size: .72rem; font-weight:700; text-transform:uppercase; letter-spacing:.12em;
  color: {{ $isJunior ? '#93c5fd' : '#5eead4' }}; margin-bottom:.5rem;
}
.ds-header__title { font-size: 1.35rem; font-weight:800; margin-bottom:.35rem; }
.ds-header__sub { font-size: .85rem; color: rgba(255,255,255,.65); }
.ds-progress-bar {
  margin-top: 1.25rem;
  background: rgba(255,255,255,.12);
  border-radius: 999px; height: 6px;
}
.ds-progress-fill {
  height: 6px; border-radius: 999px;
  background: linear-gradient(90deg, {{ $accentColor }}, {{ $isJunior ? '#7c3aed' : '#0891b2' }});
  transition: width .4s cubic-bezier(.4,0,.2,1);
  width: 0%;
}
.ds-step-counter {
  margin-top: .75rem; font-size:.78rem; color:rgba(255,255,255,.5);
}

/* Body */
.ds-body { padding: 2rem 2.5rem 2.5rem; }

/* Question step */
.ds-step { display:none; }
.ds-step.ds-step--active { display:block; animation: dsSlideIn .3s ease; }
@keyframes dsSlideIn {
  from { opacity:0; transform:translateX(18px); }
  to   { opacity:1; transform:translateX(0); }
}

.ds-question-icon { font-size:2rem; margin-bottom:.5rem; display:block; }
.ds-question-label {
  display: inline-flex; align-items:center; gap:.4rem;
  font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.1em;
  color: {{ $accentColor }}; background: {{ $accentLight }};
  border-radius:999px; padding:.22rem .75rem; margin-bottom:.75rem;
}
.ds-question-text {
  font-size: 1.05rem; font-weight:700; color:#0f172a;
  margin-bottom: 1.25rem; line-height:1.45;
}

/* Options */
.ds-options { display:flex; flex-direction:column; gap:.75rem; }
.ds-option {
  display:flex; align-items:center; gap:1rem;
  padding: 1rem 1.25rem;
  border: 2px solid #e2e8f0;
  border-radius: 14px;
  cursor: pointer;
  transition: all .2s;
  background: #fafafa;
  position: relative;
}
.ds-option:hover {
  border-color: {{ $accentColor }};
  background: {{ $accentLight }};
  transform: translateX(4px);
}
.ds-option.ds-option--selected {
  border-color: {{ $accentColor }};
  background: {{ $accentLight }};
  box-shadow: 0 0 0 3px {{ $accentColor }}22;
}
.ds-option__emoji { font-size:1.5rem; flex-shrink:0; width:36px; text-align:center; }
.ds-option__content { flex:1; }
.ds-option__label { font-size:.9rem; font-weight:700; color:#0f172a; }
.ds-option__desc  { font-size:.78rem; color:#64748b; margin-top:.1rem; }
.ds-option__check {
  width:22px; height:22px; border-radius:50%;
  border:2px solid #cbd5e1;
  display:flex; align-items:center; justify-content:center;
  flex-shrink:0; transition: all .2s;
}
.ds-option--selected .ds-option__check {
  background: {{ $accentColor }};
  border-color: {{ $accentColor }};
}
.ds-option--selected .ds-option__check::after {
  content:'✓'; font-size:.7rem; color:#fff; font-weight:900;
}

/* Nav buttons */
.ds-nav {
  display:flex; justify-content:space-between; align-items:center;
  margin-top: 1.75rem; padding-top: 1.25rem;
  border-top: 1px solid #f1f5f9;
}
.ds-btn {
  display:inline-flex; align-items:center; gap:.4rem;
  font-size:.88rem; font-weight:700; border-radius:10px;
  padding:.65rem 1.5rem; border:none; cursor:pointer; transition:all .2s;
}
.ds-btn--back {
  background:#f1f5f9; color:#64748b;
}
.ds-btn--back:hover { background:#e2e8f0; }
.ds-btn--next {
  background: {{ $accentColor }}; color:#fff;
  box-shadow: 0 4px 14px {{ $accentColor }}44;
}
.ds-btn--next:hover { filter:brightness(1.08); transform:translateY(-1px); }
.ds-btn--next:disabled {
  background:#e2e8f0; color:#94a3b8;
  box-shadow:none; cursor:not-allowed; transform:none;
}

/* Result */
.ds-result { display:none; }
.ds-result--show { display:block; animation: dsSlideIn .4s ease; }
.ds-result-badge {
  display:flex; align-items:center; justify-content:center; gap:1rem;
  padding: 1.75rem; border-radius:20px; margin-bottom:1.5rem;
}
.ds-result-badge__icon { font-size:3.5rem; }
.ds-result-badge__level { font-size:1.6rem; font-weight:900; }
.ds-result-badge__score { font-size:.88rem; opacity:.8; margin-top:.2rem; }
.ds-result-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.5rem; }
.ds-result-card {
  border-radius:16px; padding:1.25rem 1.5rem; text-align:center;
}
.ds-result-card--intern { background:linear-gradient(135deg,#f0fdfa,#ccfbf1); border:2px solid #0d9488; }
.ds-result-card--junior { background:linear-gradient(135deg,#eff6ff,#dbeafe); border:2px solid #2563eb; }
.ds-result-card__role { font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.5rem; }
.ds-result-card--intern .ds-result-card__role { color:#0f766e; }
.ds-result-card--junior .ds-result-card__role { color:#1e40af; }
.ds-result-card__pct { font-size:2.2rem; font-weight:900; }
.ds-result-card--intern .ds-result-card__pct { color:#0d9488; }
.ds-result-card--junior .ds-result-card__pct { color:#2563eb; }
.ds-result-card__amount { font-size:.82rem; color:#64748b; margin-top:.25rem; }
.ds-result-card__highlight {
  border-width:3px; transform:scale(1.03);
  box-shadow:0 8px 24px rgba(0,0,0,.1);
}

.ds-result-breakdown {
  background:#f8fafc; border-radius:14px; padding:1.25rem 1.5rem;
  margin-bottom:1.5rem;
}
.ds-result-breakdown h4 {
  font-size:.78rem; font-weight:700; text-transform:uppercase; color:#94a3b8;
  letter-spacing:.08em; margin-bottom:.75rem;
}
.ds-breakdown-row {
  display:flex; justify-content:space-between; align-items:center;
  padding:.4rem 0; border-bottom:1px solid #e2e8f0; font-size:.85rem;
}
.ds-breakdown-row:last-child { border-bottom:none; }
.ds-breakdown-row__label { color:#64748b; display:flex; align-items:center; gap:.4rem; }
.ds-breakdown-row__pts { font-weight:700; color:#0f172a; }
.ds-breakdown-dot {
  width:8px; height:8px; border-radius:50%; flex-shrink:0;
}

.ds-result-actions {
  display:flex; gap:.75rem; flex-wrap:wrap;
}
.ds-btn-cta {
  flex:1; display:inline-flex; align-items:center; justify-content:center; gap:.5rem;
  font-size:.9rem; font-weight:700; border-radius:12px;
  padding:.8rem 1.5rem; text-decoration:none; transition:all .2s;
}
.ds-btn-reset {
  background:#f1f5f9; color:#475569; border:none; cursor:pointer;
  font-size:.82rem; font-weight:600; border-radius:10px;
  padding:.65rem 1.25rem; transition:background .2s;
}
.ds-btn-reset:hover { background:#e2e8f0; }

@media(max-width:540px) {
  .ds-body { padding:1.5rem; }
  .ds-result-grid { grid-template-columns:1fr; }
  .ds-header { padding:1.5rem; }
}

/* ── Question Deal-Bringer ───────────────────────────────── */
.ds-deal-grid {
  display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;
}
.ds-deal-card {
  border-radius: 16px; padding: 1.5rem; text-align: center; cursor: pointer;
  border: 2px solid #e2e8f0; transition: all .25s; background: #fafafa;
}
.ds-deal-card:hover { transform: translateY(-3px); }
.ds-deal-card--yes { border-color: #10b981; background: #f0fdf4; }
.ds-deal-card--yes:hover { box-shadow: 0 8px 24px rgba(16,185,129,.2); border-color: #059669; }
.ds-deal-card--no:hover  { border-color: #94a3b8; box-shadow: 0 4px 14px rgba(0,0,0,.08); }
.ds-deal-card__icon  { font-size: 2.5rem; margin-bottom: .75rem; display: block; }
.ds-deal-card__title { font-size: .95rem; font-weight: 800; margin-bottom: .35rem; color: #0f172a; }
.ds-deal-card__desc  { font-size: .78rem; color: #64748b; line-height: 1.5; }
.ds-deal-card__bonus { font-size: .72rem; font-weight: 700; color: #059669; margin-top: .6rem;
  padding: .2rem .65rem; background: #dcfce7; border-radius: 999px; display: inline-block; }
.ds-deal-note {
  background: #fffbeb; border: 1px solid #fcd34d; border-radius: 12px;
  padding: .9rem 1.25rem; font-size: .82rem; color: #92400e;
  display: flex; align-items: flex-start; gap: .6rem; margin-top: .75rem;
}
/* Bannière résultat deal-bringer */
.ds-deal-banner {
  background: linear-gradient(135deg,#dcfce7,#bbf7d0);
  border: 2px solid #16a34a; border-radius: 14px;
  padding: 1rem 1.5rem; margin-bottom: 1.25rem;
  display: none; align-items: center; gap: .75rem;
}
.ds-deal-banner--show { display: flex; animation: dsSlideIn .3s ease; }
.ds-deal-banner__icon { font-size: 1.75rem; flex-shrink: 0; }
.ds-deal-banner__text h5 { font-size: .88rem; font-weight: 800; color: #14532d; margin-bottom: .1rem; }
.ds-deal-banner__text p  { font-size: .78rem; color: #166534; margin: 0; }
@media(max-width:480px) { .ds-deal-grid { grid-template-columns:1fr; } }
</style>

<div class="ds-wrap" id="{{ $widgetId }}">

  {{-- Header --}}
  <div class="ds-header">
    <div class="ds-header__eyebrow">{{ $isJunior ? '🚀 Freelance Junior' : '🎓 Stagiaire' }} · Évaluation de mission</div>
    <div class="ds-header__title">Quel niveau correspond à votre mission ?</div>
    <div class="ds-header__sub">{{ $totalSteps }} questions · 2 minutes · Résultat objectif et transparent</div>
    <div class="ds-progress-bar">
      <div class="ds-progress-fill" id="{{ $widgetId }}-fill"></div>
    </div>
    <div class="ds-step-counter" id="{{ $widgetId }}-counter">Question 1 sur {{ $totalSteps }}</div>
  </div>

  {{-- Body --}}
  <div class="ds-body">

    {{-- Steps --}}
    @php $criteria = $widgetData['criteria']; $stepIdx = 0; @endphp
    @foreach($criteria as $key => $c)
    @php $stepIdx++; @endphp
    <div class="ds-step {{ $stepIdx === 1 ? 'ds-step--active' : '' }}"
         data-step="{{ $stepIdx }}" data-key="{{ $key }}">

      <span class="ds-question-icon">{{ $c['icon'] }}</span>
      <span class="ds-question-label">{{ $c['label'] }}</span>
      <div class="ds-question-text">{{ $c['question'] }}</div>

      <div class="ds-options">
        @foreach($c['options'] as $opt)
        <div class="ds-option"
             data-value="{{ $opt['value'] }}"
             data-step="{{ $stepIdx }}"
             data-key="{{ $key }}"
             onclick="dsSelectOption('{{ $widgetId }}', {{ $stepIdx }}, '{{ $key }}', {{ $opt['value'] }}, this)">
          <span class="ds-option__emoji">{{ $opt['emoji'] }}</span>
          <div class="ds-option__content">
            <div class="ds-option__label">{{ $opt['label'] }}</div>
            <div class="ds-option__desc">{{ $opt['desc'] }}</div>
          </div>
          <div class="ds-option__check"></div>
        </div>
        @endforeach
      </div>

      <div class="ds-nav">
        @if($stepIdx > 1)
        <button class="ds-btn ds-btn--back" onclick="dsGoBack('{{ $widgetId }}', {{ $stepIdx }})">
          ← Précédent
        </button>
        @else
        <span></span>
        @endif

        @if($stepIdx < $totalSteps)
        <button class="ds-btn ds-btn--next" id="{{ $widgetId }}-next-{{ $stepIdx }}"
                disabled onclick="dsGoNext('{{ $widgetId }}', {{ $stepIdx }}, {{ $totalSteps }})">
          Suivant →
        </button>
        @else
        <button class="ds-btn ds-btn--next" id="{{ $widgetId }}-next-{{ $stepIdx }}"
                disabled onclick="dsShowResult('{{ $widgetId }}', '{{ $traineeType ?? 'student' }}')">
          Voir mon niveau 🎯
        </button>
        @endif
      </div>
    </div>
    @endforeach

    {{-- Étape DEAL-BRINGER (bonus commercial, non scorée) --}}
    <div class="ds-step" data-step="{{ $totalSteps }}" data-key="deal_bringer">

      <span class="ds-question-icon">💼</span>
      <span class="ds-question-label">Bonus commercial</span>
      <div class="ds-question-text">
        Avez-vous personnellement trouvé et amené cette mission à la plateforme ?
      </div>

      <div class="ds-deal-grid">
        <div class="ds-deal-card ds-deal-card--yes"
             onclick="dsSetDealBringer('{{ $widgetId }}', true, '{{ $traineeType ?? 'student' }}')">
          <span class="ds-deal-card__icon">🤝</span>
          <div class="ds-deal-card__title">Oui, c'est moi</div>
          <div class="ds-deal-card__desc">J'ai trouvé ce client et proposé la mission via Junspro.</div>
          <span class="ds-deal-card__bonus">🎁 Bonus apporteur activé</span>
        </div>
        <div class="ds-deal-card ds-deal-card--no"
             onclick="dsSetDealBringer('{{ $widgetId }}', false, '{{ $traineeType ?? 'student' }}')">
          <span class="ds-deal-card__icon">🏢</span>
          <div class="ds-deal-card__title">Non, mission du réseau</div>
          <div class="ds-deal-card__desc">Le mentor ou Junspro a apporté ce client.</div>
        </div>
      </div>

      <div class="ds-deal-note">
        <span>💡</span>
        <span>Ce bonus est <strong>validé par votre mentor</strong> avant application — l'objectif est de récompenser un véritable effort commercial, jamais de contourner le système.</span>
      </div>

      <div class="ds-nav">
        <button class="ds-btn ds-btn--back"
                onclick="dsGoBack('{{ $widgetId }}', {{ $totalSteps }})">
          ← Précédent
        </button>
        <span style="font-size:.82rem; color:#94a3b8;">Cliquez une option pour voir votre résultat</span>
      </div>
    </div>

    {{-- Résultat --}}
    <div class="ds-result" id="{{ $widgetId }}-result">
      <div class="ds-result-badge" id="{{ $widgetId }}-result-badge">
        <span class="ds-result-badge__icon" id="{{ $widgetId }}-result-emoji"></span>
        <div>
          <div class="ds-result-badge__level" id="{{ $widgetId }}-result-level"></div>
          <div class="ds-result-badge__score" id="{{ $widgetId }}-result-score"></div>
        </div>
      </div>

      {{-- Bannière bonus deal-bringer --}}
      <div class="ds-deal-banner" id="{{ $widgetId }}-deal-banner">
        <span class="ds-deal-banner__icon">🎯</span>
        <div class="ds-deal-banner__text">
          <h5>Bonus Apporteur de Mission activé !</h5>
          <p>Vous avez amené cette mission — votre taux est bonifié et validé par votre mentor.</p>
        </div>
      </div>

      <div class="ds-result-grid" id="{{ $widgetId }}-result-grid">
        <div class="ds-result-card ds-result-card--intern {{ !$isJunior ? 'ds-result-card--highlight' : '' }}" id="{{ $widgetId }}-card-intern">
          <div class="ds-result-card__role">Stagiaire reçoit</div>
          <div class="ds-result-card__pct" id="{{ $widgetId }}-intern-pct">—</div>
          <div class="ds-result-card__amount" id="{{ $widgetId }}-intern-amount">sur 300 € brut</div>
          <div style="font-size:.7rem; font-weight:700; margin-top:.4rem; opacity:.75;" id="{{ $widgetId }}-intern-sub">taux standard</div>
        </div>
        <div class="ds-result-card ds-result-card--junior {{ $isJunior ? 'ds-result-card--highlight' : '' }}" id="{{ $widgetId }}-card-junior">
          <div class="ds-result-card__role">Freelance junior reçoit</div>
          <div class="ds-result-card__pct" id="{{ $widgetId }}-junior-pct">—</div>
          <div class="ds-result-card__amount" id="{{ $widgetId }}-junior-amount">sur 300 € brut</div>
          <div style="font-size:.7rem; font-weight:700; margin-top:.4rem; opacity:.75;" id="{{ $widgetId }}-junior-sub">taux standard</div>
        </div>
      </div>

      <div class="ds-result-breakdown">
        <h4>Détail de votre score</h4>
        <div id="{{ $widgetId }}-breakdown"></div>
        <div class="ds-breakdown-row" style="margin-top:.5rem; background:none; padding-top:.6rem; border-top:2px solid #e2e8f0;">
          <span style="font-weight:700; color:#0f172a;">Score total</span>
          <span style="font-weight:900; font-size:1rem;" id="{{ $widgetId }}-total-score"></span>
        </div>
      </div>

      <div class="ds-result-actions">
        <a href="{{ route('mentorship.subscription.index') }}"
           class="ds-btn-cta"
           style="background:{{ $accentColor }}; color:#fff; box-shadow:0 4px 14px {{ $accentColor }}44;">
          <i class="fa fa-check-circle"></i>
          {{ $isJunior ? 'Souscrire — programme junior' : 'Souscrire — programme stagiaire' }}
        </a>
        <button class="ds-btn-reset" onclick="dsReset('{{ $widgetId }}')">
          ↺ Recommencer
        </button>
      </div>
    </div>

  </div>{{-- /ds-body --}}
</div>

<script>
(function() {
  var DS_DATA        = @json($widgetData);
  var TOTAL_CRITERIA = Object.keys(DS_DATA.criteria).length;
  var TOTAL_STEPS    = TOTAL_CRITERIA + 1; // +1 question deal-bringer
  var MAX_SCORE      = TOTAL_CRITERIA * 3; // score max sur les critères uniquement

  /* ── State ────────────────────────────────────────────── */
  var states = {};

  function getState(wid) {
    if (!states[wid]) states[wid] = { scores: {}, step: 1, dealBringer: null };
    return states[wid];
  }

  /* ── Helpers ───────────────────────────────────────── */
  function el(id) { return document.getElementById(id); }

  /* ── Sélection d'option ───────────────────────────────── */
  window.dsSelectOption = function(wid, step, key, val, elem) {
    var st = getState(wid);
    st.scores[key] = val;

    var container = elem.closest('.ds-options');
    container.querySelectorAll('.ds-option').forEach(function(o) {
      o.classList.remove('ds-option--selected');
    });
    elem.classList.add('ds-option--selected');

    var btn = el(wid + '-next-' + step);
    if (btn) btn.disabled = false;

    // Auto-avance vers la prochaine étape (y compris vers deal-bringer)
    if (step < TOTAL_STEPS) {
      setTimeout(function() { dsGoNext(wid, step, TOTAL_STEPS); }, 320);
    }
  };

  /* ── Navigation ──────────────────────────────────────── */
  window.dsGoNext = function(wid, currentStep, total) {
    var st = getState(wid);
    if (currentStep <= TOTAL_CRITERIA) {
      var currentKey = Object.keys(DS_DATA.criteria)[currentStep - 1];
      if (!st.scores[currentKey]) return;
    }
    showStep(wid, currentStep + 1);
  };

  window.dsGoBack = function(wid, currentStep) {
    showStep(wid, currentStep - 1);
  };

  function showStep(wid, step) {
    var wrap = el(wid);
    wrap.querySelectorAll('.ds-step').forEach(function(s) {
      s.classList.remove('ds-step--active');
    });
    var res = el(wid + '-result');
    if (res) { res.classList.remove('ds-result--show'); res.style.display = 'none'; }

    var target = wrap.querySelector('[data-step="' + step + '"]');
    if (target) target.classList.add('ds-step--active');

    var fill = el(wid + '-fill');
    if (fill) fill.style.width = ((step - 1) / TOTAL_STEPS * 100) + '%';

    var counter = el(wid + '-counter');
    if (counter) {
      if (step === TOTAL_STEPS) {
        counter.textContent = '💼 Bonus commercial · Question finale';
      } else {
        counter.textContent = 'Question ' + step + ' sur ' + TOTAL_STEPS;
      }
    }
    getState(wid).step = step;
  }

  /* ── Deal-Bringer ──────────────────────────────────────── */
  window.dsSetDealBringer = function(wid, isDeal, traineeType) {
    getState(wid).dealBringer = isDeal;
    dsShowResult(wid, traineeType);
  };

  /* ── Affichage du résultat ──────────────────────────────── */
  window.dsShowResult = function(wid, traineeType) {
    var st          = getState(wid);
    var criteriaKeys = Object.keys(DS_DATA.criteria);
    var lastKey      = criteriaKeys[criteriaKeys.length - 1];
    if (!st.scores[lastKey]) return;

    // Score total (critères uniquement)
    var total = 0;
    criteriaKeys.forEach(function(k) { total += parseInt(st.scores[k] || 0); });

    // Niveau
    var level = 'intermediate';
    DS_DATA.thresholds.forEach(function(t) {
      if (total >= t.min && total <= t.max) level = t.level;
    });
    var threshold = DS_DATA.thresholds.find(function(t) { return t.level === level; });

    // Taux : standard ou bonus deal-bringer
    var deal = st.dealBringer;
    var internRate = deal ? DS_DATA.dealBringerInternRates[level] : DS_DATA.internRates[level];
    var juniorRate = deal ? DS_DATA.dealBringerJuniorRates[level] : DS_DATA.juniorRates[level];

    // Delta bonus visible dans les cartes
    var internDelta = DS_DATA.dealBringerInternRates[level] - DS_DATA.internRates[level];
    var juniorDelta = DS_DATA.dealBringerJuniorRates[level] - DS_DATA.juniorRates[level];

    var net       = 300 * 0.80;
    var internAmt = Math.round(net * internRate  / 100);
    var juniorAmt = Math.round(net * juniorRate  / 100);

    // Masquer toutes les étapes
    var wrap = el(wid);
    wrap.querySelectorAll('.ds-step').forEach(function(s) { s.classList.remove('ds-step--active'); });

    var fill = el(wid + '-fill');
    if (fill) fill.style.width = '100%';
    var counter = el(wid + '-counter');
    if (counter) counter.textContent = 'Résultat · Score ' + total + '/' + MAX_SCORE;

    // Badge niveau
    var badge = el(wid + '-result-badge');
    if (badge) badge.style.background = 'linear-gradient(135deg,' + threshold.color + '22,' + threshold.color + '11)';
    el(wid + '-result-emoji').textContent = threshold.emoji;
    el(wid + '-result-level').textContent = threshold.label;
    el(wid + '-result-level').style.color = threshold.color;
    el(wid + '-result-score').textContent = 'Score : ' + total + '/' + MAX_SCORE;

    // Bannière deal-bringer
    var dealBanner = el(wid + '-deal-banner');
    if (dealBanner) {
      if (deal) { dealBanner.classList.add('ds-deal-banner--show'); }
      else      { dealBanner.classList.remove('ds-deal-banner--show'); }
    }

    // Cards
    el(wid + '-intern-pct').textContent    = internRate + ' % du net';
    el(wid + '-junior-pct').textContent    = juniorRate + ' % du net';
    el(wid + '-intern-amount').textContent = '≈ ' + internAmt + ' € sur 300 € brut';
    el(wid + '-junior-amount').textContent = '≈ ' + juniorAmt + ' € sur 300 € brut';

    // Suffix bonus deal-bringer sur les cartes
    var internSubEl = el(wid + '-intern-sub');
    var juniorSubEl = el(wid + '-junior-sub');
    if (internSubEl) internSubEl.textContent = deal ? '+' + internDelta + ' % bonus apporteur' : 'taux standard';
    if (juniorSubEl) juniorSubEl.textContent = deal ? '+' + juniorDelta + ' % bonus apporteur' : 'taux standard';

    var cardIntern = el(wid + '-card-intern');
    var cardJunior = el(wid + '-card-junior');
    if (traineeType === 'graduate') {
      cardJunior.classList.add('ds-result-card--highlight');
      cardIntern.classList.remove('ds-result-card--highlight');
    } else {
      cardIntern.classList.add('ds-result-card--highlight');
      cardJunior.classList.remove('ds-result-card--highlight');
    }

    // Détail score par critère
    var breakdownHtml = '';
    var dotColors   = { 1: '#06b6d4', 2: '#3b82f6', 3: '#7c3aed' };
    var levelLabels = { 1: 'Débutant (1 pt)', 2: 'Intermédiaire (2 pts)', 3: 'Avancé (3 pts)' };
    criteriaKeys.forEach(function(k) {
      var c   = DS_DATA.criteria[k];
      var pts = st.scores[k] || 0;
      breakdownHtml +=
        '<div class="ds-breakdown-row">' +
          '<span class="ds-breakdown-row__label">' +
            '<span class="ds-breakdown-dot" style="background:' + dotColors[pts] + '"></span>' +
            c.icon + ' ' + c.label +
          '</span>' +
          '<span class="ds-breakdown-row__pts">' + levelLabels[pts] + '</span>' +
        '</div>';
    });
    // Ligne deal-bringer dans le breakdown
    if (deal) {
      breakdownHtml +=
        '<div class="ds-breakdown-row" style="background:#f0fdf4; border-radius:8px; margin-top:.25rem;">' +
          '<span class="ds-breakdown-row__label">' +
            '<span class="ds-breakdown-dot" style="background:#16a34a"></span>' +
            '💼 Bonus apporteur de mission' +
          '</span>' +
          '<span class="ds-breakdown-row__pts" style="color:#16a34a">🎁 Activé</span>' +
        '</div>';
    }
    el(wid + '-breakdown').innerHTML = breakdownHtml;
    el(wid + '-total-score').textContent = total + '/' + MAX_SCORE + ' → ' + threshold.label;
    el(wid + '-total-score').style.color = threshold.color;

    var res = el(wid + '-result');
    res.style.display = 'block';
    setTimeout(function() { res.classList.add('ds-result--show'); }, 10);
  };

  /* ── Reset ────────────────────────────────────────────────── */
  window.dsReset = function(wid) {
    states[wid] = { scores: {}, step: 1, dealBringer: null };
    var wrap = el(wid);
    wrap.querySelectorAll('.ds-option').forEach(function(o) { o.classList.remove('ds-option--selected'); });
    wrap.querySelectorAll('.ds-btn--next').forEach(function(b) { b.disabled = true; });
    var res = el(wid + '-result');
    if (res) { res.classList.remove('ds-result--show'); res.style.display = 'none'; }
    var dealBanner = el(wid + '-deal-banner');
    if (dealBanner) dealBanner.classList.remove('ds-deal-banner--show');
    showStep(wid, 1);
  };

})();
</script>
